<?php
require_once('../common/global.php');
require_once("../common/security.php");
require_once("../common/db.php");
login_handle();
$db = new DB();

$attr = array("BookID", "Name", "Author", "Pubdate", "Subject", "Publisher", "Price", "AddOn");
if ($_SERVER['REQUEST_METHOD'] == "POST") {
	if ($_POST['action'] == "search") {
		$where = array();
		for ($x=0; $x<count($attr); $x++) {
			if ($_POST[$attr[$x]]) {
				$where[$attr[$x]] = $_POST[$attr[$x]];
			}
		}
		$info = $db->count('book_info',$where);
		ob_clean();
		echo json_encode($info);
		exit();
	}
}

if ($_GET['action']=="search") {
	$pageid = $_GET['pageid'];
	$where = array();
		for ($x=0; $x<count($attr); $x++) {
			if ($_POST[$attr[$x]]) {
				$where[$attr[$x]] = $_POST[$attr[$x]];
			}
		}
	$info = $db->select('book_info',$where,$pageid);

	ob_clean();
	echo json_encode($info);
	db_close($con);
	exit();
}
?>