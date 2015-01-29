<?php
	require_once('user/user.php');
	$user = new User();
	$result = $user->is_login();
	if ($result['code'] == 0) {
		header("Location:info.html");
		exit();
	}
	header("Location:login.html");
?>