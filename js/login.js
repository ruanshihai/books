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

if ($_GET['status'] == "error") {
    document.getElementById("login_status").innerHTML = "用户名或者密码错误";
}