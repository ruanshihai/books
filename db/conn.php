<?php
	require_once('config.php');
	require_once('func.php');

	$con = db_connect($db['DB_HOST'], $db['DB_USER'], $db['DB_PWD']);
	if (!$con)
		die('Could not connect: ' . mysql_error());

	db_select_db("books", $con);
?>