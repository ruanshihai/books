function LoginHandle() {
    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert ("Browser does not support HTTP Request");
        return false;
    }
    var url = "book.php?action=alter&BookID="+$_GET['BookID'];
    xmlHttp.onreadystatechange = loginStateChanged;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);
}

function AlterHandle(LoginForm) {
    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert ("Browser does not support HTTP Request");
        return false;
    }
    var Name = LoginForm.Name.value;
    var Author = LoginForm.Author.value;
    var Pubdate = LoginForm.Pubdate.value;
    var Subject = LoginForm.Subject.value;
    var Publisher = LoginForm.Publisher.value;
    var Price = LoginForm.Price.value;
    var AddOn = LoginForm.AddOn.value;
    var url = "book.php?action=alter&BookID="+$_GET['BookID'];
    data = "Name="+Name+"&Author="+Author
        +"&Pubdate="+Pubdate+"&Subject="+Subject+"&Publisher="+Publisher+"&Price="+Price+"&AddOn="+AddOn;
    xmlHttp.onreadystatechange = alterStateChanged;
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
        } else {
            var data = info.data;
            var form = document.getElementById("form");
            document.getElementById("BookID").innerHTML = data[0]['BookID'];
            form.Name.value = data[0]['Name'];
            form.Author.value = data[0]['Author'];
            form.Pubdate.value = data[0]['Pubdate'];
            form.Subject.value = data[0]['Subject'];
            form.Publisher.value = data[0]['Publisher'];
            form.Price.value = data[0]['Price'];
            form.AddOn.value = data[0]['AddOn'];
        }
    }
}

function alterStateChanged() {
    if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete") {
        var info = eval('('+ xmlHttp.responseText +')');
        document.getElementById("feedback").style.display = "block";
        if (info.code == 0) {
            document.getElementById("yes_alter").style.display = "block";
            document.getElementById("no_alter").style.display = "none";
            var data = info.data;
            var nodes = document.getElementById("record").childNodes;
            for (var i=0; i<attr.length; i++) {
                nodes[2*i+1].innerHTML = data[0][attr[i]];
            }
        } else {
            document.getElementById("yes_alter").style.display = "none";
            document.getElementById("no_alter").style.display = "block";
        }
    }
}

LoginHandle();