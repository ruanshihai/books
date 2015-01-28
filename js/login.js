function InputCheck(LoginForm) {
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
}

var $_GET = (function(){
    var url = window.document.location.href.toString();
    var u = url.split("?");
    if(typeof(u[1]) == "string"){
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

if ($_GET['status'] == "error") {
    document.getElementById("login_status").innerHTML = "用户名或者密码错误";
}