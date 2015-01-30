var pageid = 0;
var recordscount = 0;
var attr = ["BookID", "Name", "Author", "Pubdate", "Subject", "Publisher", "Price", "AddOn"];

function LoadHandle() {
    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert ("Browser does not support HTTP Request");
        return false;
    }
    var url = "book.php?action=search";
    xmlHttp.onreadystatechange = loadStateChanged;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);
}

function loadStateChanged() {
    if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete") {
        var info = eval('('+ xmlHttp.responseText +')');
        if (info.code != 0) {
            location.href = "login.html";
        }
    }
}

function SearchHandle(LoginForm) {
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
    url = "book.php?action=search";
    data = "BookID="+BookID+"&Name="+Name+"&Author="+Author
    	+"&Pubdate="+Pubdate+"&Subject="+Subject+"&Publisher="+Publisher+"&Price="+Price+"&AddOn="+AddOn;
    xmlHttp.onreadystatechange = stateChanged;
    xmlHttp.open("POST", url, true);
    xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    xmlHttp.send(data+"&pageid="+pageid);

    return false;
}

function PageHandle(id) {
	pageid += id;
	xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert ("Browser does not support HTTP Request");
        return false;
    }
    xmlHttp.onreadystatechange = stateChanged;
    xmlHttp.open("POST", url, true);
    xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    xmlHttp.send(data+"&pageid="+pageid);
}

function stateChanged() {
    if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete") {
    	var lines = document.getElementsByClassName("dynamic");
    	for (var i=lines.length-1; i>=0; i--) {
    		lines[i].parentNode.removeChild(lines[i]);
    	}

        var info = eval('('+ xmlHttp.responseText +')');
        if (info.count) {
            recordscount = info.count;
            document.getElementById("info").style.display = "block";
        }
        var data = info.data;
        for (var i=0; i<data.length; i++) {
        	var row = document.createElement("tr");
        	row.setAttribute("class", "dynamic");
        	for (var j=0; j<attr.length; j++) {
        		var item = document.createElement("td");
        		item.innerHTML = data[i][attr[j]];
        		row.appendChild(item);
        	}
        	var bt = document.createElement("td");
        	bt.innerHTML = "<a href='alter.html?BookID="+data[i].BookID+"'>修改</a>";
        	row.appendChild(bt);
        	document.getElementById("record").appendChild(row);
        }

        var pageContainer = document.createElement("div");
        pageContainer.setAttribute("class", "dynamic");
        if (pageid > 0) {
        	var pageup = document.createElement("a");
        	pageup.setAttribute("onclick", "PageHandle(-1)");
        	pageup.style.margin = "0 10px";
        	pageup.innerHTML = "上一页";
        	pageContainer.appendChild(pageup);
        }
        if (pageid < recordscount/10-1) {
        	var pagedown = document.createElement("a");
        	pagedown.setAttribute("onclick", "PageHandle(1)");
        	pagedown.style.margin = "0 10px";
        	pagedown.innerHTML = "下一页";
        	pageContainer.appendChild(pagedown);
        }
        var result = document.createElement("span");
        result.style.float = "right";
        result.style.margin = "0 128px 0 0";
        result.innerHTML = "共"+recordscount+"条结果";
        pageContainer.appendChild(result);
        document.getElementById("info").appendChild(pageContainer);
    }
}

LoadHandle();