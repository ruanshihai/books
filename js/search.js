var pageid = 1;
var recordscount = 0;
var attr = ["BookID", "Name", "Author", "Pubdate", "Subject", "Publisher", "Price", "AddOn"];

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
    url = "../content/book.php";
    data = "BookID="+BookID+"&Name="+Name+"&Author="+Author
    	+"&Pubdate="+Pubdate+"&Subject="+Subject+"&Publisher="+Publisher+"&Price="+Price+"&AddOn="+AddOn;
    xmlHttp.onreadystatechange = stateChanged;
    xmlHttp.open("POST", url, true);
    xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    xmlHttp.send("action=search&"+data);

    return false;
}

function PageHandle(id) {
	pageid += id;
	xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert ("Browser does not support HTTP Request");
        return false;
    }
    xmlHttp.onreadystatechange = pageChanged;
    xmlHttp.open("GET", url+"?action=search&pageid="+pageid+"&"+data, true);
    xmlHttp.send(null);
}

function stateChanged() {
    if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete") {
        var info = eval("("+xmlHttp.responseText+")");
        if (info.action=="search" && info.status=="ok") {
        	document.getElementById("info").style.display = "block";
        	recordscount = info.recordscount;
        	if (recordscount != 0) {
	        	xmlHttp = GetXmlHttpObject();
		        if (xmlHttp == null) {
		            alert ("Browser does not support HTTP Request");
		            return false;
		        }
		        xmlHttp.onreadystatechange = pageChanged;
		        xmlHttp.open("GET", url+"?action=search&pageid="+pageid+"&"+data, true);
		        xmlHttp.send(null);
	    	}
        }
    }
}

function pageChanged() {
    if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete") {
    	var lines = document.getElementsByClassName("dynamic");
    	for (var i=0; i<lines.length; i++) {
    		lines[i].parentNode.removeChild(lines[i]);
    	}

        var info = eval('('+ xmlHttp.responseText +')');
        for (var i=0; i<info.length; i++) {
        	var row = document.createElement("tr");
        	row.setAttribute("calss", "dynamic");
        	for (var j=0; j<attr.length; j++) {
        		var item = document.createElement("td");
        		item.innerHTML = info[i][attr[j]];
        		row.appendChild(item);
        	}
        	var bt = document.createElement("td");
        	bt.innerHTML = "<a href='alter.php?BookID="+info[i].BookID+"'>修改</a>";
        	row.appendChild(bt);
        	document.getElementById("record").appendChild(row);
        }

        var pageContainer = document.createElement("div");
        pageContainer.setAttribute("class", "dynamic");
        if (pageid > 1) {
        	var pageup = document.createElement("a");
        	pageup.setAttribute("onclick", "PageHandle(-1)");
        	pageup.style.margin = "0 10px";
        	pageup.innerHTML = "上一页";
        	pageContainer.appendChild(pageup);
        }
        if (pageid < (recordscount+9)/10) {
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