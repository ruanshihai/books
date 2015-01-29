<?php
	require_once('common/global.php');
	session_start();

	//检测是否登录，若没登录则转向登录界面
	if(!isset($_SESSION['username'])){
	    header("Location:content/login.html");
	    exit();
	}
	header("Location:content/info.php");
	exit();
?>