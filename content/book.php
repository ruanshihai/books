<?php
require_once('../common/global.php');
require_once("../common/security.php");
login_handle();

$attr = array("BookID", "Name", "Author", "Pubdate", "Subject", "Publisher", "Price", "AddOn");
if ($_SERVER['REQUEST_METHOD'] == "POST") {
	if ($_POST['action'] == "search") {
		for ($x=0; $x<count($attr); $x++) {
			if ($_POST[$attr[$x]]) {
				if ($values)
					$values = $values . " AND ";
				$values = $values . $attr[$x] . "=" . '"' . sql_transform($_POST[$attr[$x]]) . '"';
				$url = $url . "&" . $attr[$x] . "=" . $_POST[$attr[$x]];
			}
		}

		$recordscount = 0;
		if ($values) {
			require_once("../db/conn.php");
			$result = db_query("SELECT COUNT(*) FROM book_info WHERE $values");
			$recordscount = db_fetch_array($result)[0];
			db_close($conn);
		}
		$info = array(
			'action' => 'search',
			'status' => 'ok',
			'recordscount' => "$recordscount"
			);
		ob_clean();
		echo json_encode($info);
		exit();
	}
}

if ($_GET['action']=="search") {
	$pageid = $_GET['pageid'];
	for ($x=0; $x<count($attr); $x++) {
		if ($_GET[$attr[$x]]) {
			if ($values)
				$values = $values . " AND ";
			$values = $values . $attr[$x] . "=" . '"' . sql_transform($_GET[$attr[$x]]) . '"';
		}
	}

	include("../db/conn.php");
	$result = db_query("SELECT * FROM book_info WHERE $values LIMIT " . (($pageid-1)*10) . ", 10");
	while ($row = db_fetch_array($result)) {
		$info[] = $row;
	}
	ob_clean();
	echo json_encode($info);
	db_close($con);
	exit();
}
?>