var attr = ["BookID", "Name", "Author", "Pubdate", "Subject", "Publisher", "Price", "AddOn"];

function LoginHandle() {
    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert ("Browser does not support HTTP Request");
        return false;
    }
    var url = "book.php?action=add";
    xmlHttp.onreadystatechange = loginStateChanged;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);
}

function SubmitHandle(LoginForm) {
    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert ("Browser does not support HTTP Request");
        return false;
    }
    var BookID = LoginForm.BookID.value;
    var Name = LoginForm.Name.value;
    var Author = LoginForm.Author.value;
    var Pubdate = LoginForm.Pubdate.value;
    var Subject = LoginForm.Subject.value;
    var Publisher = LoginForm.Publisher.value;
    var Price = LoginForm.Price.value;
    var AddOn = LoginForm.AddOn.value;
    var url = "book.php?action=add";
    data = "BookID="+BookID+"&Name="+Name+"&Author="+Author
        +"&Pubdate="+Pubdate+"&Subject="+Subject+"&Publisher="+Publisher+"&Price="+Price+"&AddOn="+AddOn;
    xmlHttp.onreadystatechange = submitStateChanged;
    xmlHttp.open("POST", url, true);
    xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    xmlHttp.send(data);

    return false;
}

function loginStateChanged() {
    if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete") {
        var info = eval('('+ xmlHttp.responseText +')');
        if (info.code != 0) {
            location.href = "login.html";
        }
    }
}

function submitStateChanged() {
    if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete") {
        var info = eval('('+ xmlHttp.responseText +')');
        document.getElementById("feedback").style.display = "block";
        if (info.code == 0) {
            document.getElementById("yes_insert").style.display = "block";
            document.getElementById("no_insert").style.display = "none";
            var data = info.data;
            var nodes = document.getElementById("record").childNodes;
            for (var i=0; i<attr.length; i++) {
                nodes[2*i+1].innerHTML = data[0][attr[i]];
            }
        } else {
            document.getElementById("yes_insert").style.display = "none";
            document.getElementById("no_insert").style.display = "block";
        }
    }
}

LoginHandle();