var attr = ["BookID", "Name", "Author", "Pubdate", "Subject", "Publisher", "Price", "AddOn"];

function LoadHandle() {
    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert ("Browser does not support HTTP Request");
        return false;
    }
    var url = "book.php?action=info";
    xmlHttp.onreadystatechange = stateChanged;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);
}

function stateChanged() {
    if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete") {
        var info = eval('('+ xmlHttp.responseText +')');
        if (info.code != 0) {
            location.href = "login.html";
        } else {
            var data = info.data;
            var table = document.getElementById("info");
            for (var i=0; i<data.length; i++) {
                var row = document.createElement("tr");
                for (var j=0; j<attr.length; j++) {
                    var item = document.createElement("td");
                    item.innerHTML = data[i][attr[j]];
                    row.appendChild(item);
                }
                table.appendChild(row);
            }
        }
    }
}

LoadHandle();