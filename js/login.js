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