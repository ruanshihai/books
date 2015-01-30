function SubmitHandle(LoginForm) {
    if (LoginInputCheck(LoginForm)) {
        xmlHttp = GetXmlHttpObject();
        if (xmlHttp == null) {
            alert ("Browser does not support HTTP Request");
            return false;
        }
        var url = "user.php?action=register";
        var username = LoginForm.username.value;
        var password = LoginForm.password.value;
        var postdata = "username="+username+"&password="+password;
        xmlHttp.onreadystatechange = stateChanged;
        xmlHttp.open("POST", url, true);
        xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
        xmlHttp.send(postdata);
    }
    return false;
}

function stateChanged() {
    if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete") {
        var info = eval('('+ xmlHttp.responseText +')');
        if (info.code == 0) {
            document.getElementById("reg").style.display = "none";
            document.getElementById("error").style.display = "none";
            document.getElementById("goback").style.display = "block";
        } else {
            document.getElementById("error").style.display = "block";
        }
    }
}