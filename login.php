<?php
    session_start();

    //注销登录
    if($_GET['action'] == "logout") {
        unset($_SESSION['username']);
        echo '注销登录成功！点击此处 <a href="login.html">登录</a>';
        exit();
    }

    //登录
    if(!isset($_POST['submit'])) {
        exit('非法访问!');
    }

    $username = htmlspecialchars($_POST['username']);
    //$password = MD5($_POST['password']);
    $password = $_POST['password'];

    //包含数据库连接文件
    include('mysql/conn.php');
    //检测用户名及密码是否正确
    $check_query = mysql_query("SELECT * FROM managers WHERE username='$username' AND password='$password'");
    if($result = mysql_fetch_array($check_query)) {
        //登录成功
        $_SESSION['username'] = $username;
        header("Location:index.php");
        exit();
    } else {
        header("Location:login.html?status=error");
        exit();
    }
?>