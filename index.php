<?php
	require_once(dirname(__FILE__) . '/user/user.php');
	$user = new User();
	$result = $user->is_login();
	if ($result['code'] == 0) {
		header("Location:info.html");
		exit();
	}
	header("Location:login.html");
?>