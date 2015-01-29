<?php
require_once('config.php');
$conn = false;
function db_connect($host, $username, $password) {
	global $db;
	if ($db['DB_TYPE'] == 'mysql')
		return mysql_connect($host, $username, $password);
}

function db_select_db($db_name) {
	global $db;
	if ($db['DB_TYPE'] == 'mysql')
		return mysql_select_db($db_name);
}

function db_query($sql) {
	global $db;
	return mysql_query($sql);
}

function db_num_rows($result) {
	global $db;
	return mysql_num_rows($result);
}

function db_fetch_array($result) {
	global $db;
	if ($db['DB_TYPE'] == 'mysql')
	return mysql_fetch_array($result);
}

function db_fetch_row($result) {
	global $db;
	return mysql_fetch_row($result);
}

function db_close($con) {
	global $db;
	return mysql_close($con);
}
function db_select(){

}
?>