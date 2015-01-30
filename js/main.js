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