var attr = ["BookID", "Name", "Author", "Pubdate", "Subject", "Publisher", "Price", "AddOn"];

//模拟php获取url参数
var $_GET = (function() {
    var url = window.document.location.href.toString();
    var u = url.split("?");
    if(typeof(u[1]) == "string") {
        u = u[1].split("&");
        var get = {};
        for(var i in u){
            var j = u[i].split("=");
            get[j[0]] = j[1];
        }
        return get;
    } else {
        return {};
    }
})();

function LoginInputCheck(LoginForm) {
    if (LoginForm.username.value == "") {
        alert("请输入用户名!");
        LoginForm.username.focus();
        return false;
    }
    if (LoginForm.password.value == "") {
        alert("请输入密码!");
        LoginForm.password.focus();
        return false;
    }
    return true;
}

function GetXmlHttpObject() {
    var xmlHttp = null;
    try {
        // Firefox, Opera 8.0+, Safari
        xmlHttp = new XMLHttpRequest();
    } catch(e) {
        //Internet Explorer
        try {
            xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
        } catch(e) {
            xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
    }
    return xmlHttp;
}