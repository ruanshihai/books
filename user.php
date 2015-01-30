<?php
require_once(dirname(__FILE__) . '/user/user.php');
$user = new User();

if (isset($_GET['action'])) {
	$action = $_GET['action'];
	if ($action == "login")
		login();
	elseif ($action == "logout")
		logout();
	elseif ($action == "register")
		register();
	elseif ($action == "del")
		del();
	else
		exit("非法访问！");
	exit();
}
exit("非法访问！");

function login() {
	global $user;
	$result = $user->login($_POST['username'], $_POST['password']);
	if ($result['code'] != 0) {
		header("Location:login.html?status=error");
		exit();
	}
	header("Location:info.html");
	exit();
}

function logout() {
	global $user;
	$result = $user->logout();
	echo '注销登录成功！点击此处 <a href="login.html">登录</a>';
}

function register() {
	global $user;
	$result = $user->is_login();
	if ($result['code'] != 0) {
		header("Location:login.html");
		exit();
	}
	$result = $user->add($_POST['username'], $_POST['password']);
	echo json_encode($result);
}

function del() {
	global $user;
	$result = $user->is_login();
	if ($result['code'] != 0) {
		header("Location:login.html");
		exit();
	}
	$result = $user->del($_POST['username']);
	echo json_encode($result);
}