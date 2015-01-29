<?php
if ($_POST['action'] == "reg") {
	require_once("../db/conn.php");
	require_once("../common/security.php");

	$username = sql_transform($_POST['username']);
	$password = sql_transform($_POST['password']);

	db_query("INSERT INTO managers VALUES('$username', '$password')");
	$info = array('action' => 'reg', 'status' => 'ok');
	echo json_encode($info);

	db_close($con);
}
?>