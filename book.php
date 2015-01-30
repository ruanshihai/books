<?php
require_once(dirname(__FILE__) . '/user/user.php');
require_once(dirname(__FILE__) . '/book/book.php');
$user = new User();
$book = new Book();

if (isset($_GET['action'])) {
	$action = $_GET['action'];
	if ($action == "search")
		search();
	elseif ($action == "add")
		add();
	elseif ($action == "alter")
		alter();
	elseif ($action == "del")
		del();
	elseif ($action == "info")
		info();
	else
		exit("非法访问！");
	exit();
}
exit("非法访问！");

function login_handle() {
	global $user;

	$result = $user->is_login();
	if ($result['code'] != 0) {
		echo json_encode($result);
		exit();
	}
	echo json_encode($result);
}

function info() {
	global $book;
	login_handle();

	$result = $book->search();
	ob_clean();
	echo json_encode($result);
}

function search() {
	global $book;
	login_handle();

	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		$result = $book->search(
			$_POST['BookID'],
			$_POST['Name'],
			$_POST['Author'],
			$_POST['Pubdate'],
			$_POST['Subject'],
			$_POST['Publisher'],
			$_POST['Price'],
			$_POST['AddOn'],
			$_POST['pageid']*10,
			10
		);
		if ($_POST['pageid'] == "0") {
			$count = $book->count(
				$_POST['BookID'],
				$_POST['Name'],
				$_POST['Author'],
				$_POST['Pubdate'],
				$_POST['Subject'],
				$_POST['Publisher'],
				$_POST['Price'],
				$_POST['AddOn']
			);
			$result['count'] = $count['data'];
		}
		ob_clean();
		echo json_encode($result);
	}
}

function add() {
	global $book;
	login_handle();

	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		$result = $book->insert(
			$_POST['BookID'],
			$_POST['Name'],
			$_POST['Author'],
			$_POST['Pubdate'],
			$_POST['Subject'],
			$_POST['Publisher'],
			$_POST['Price'],
			$_POST['AddOn']
		);
		$result = $book->search(
			$_POST['BookID'],
			$_POST['Name'],
			$_POST['Author'],
			$_POST['Pubdate'],
			$_POST['Subject'],
			$_POST['Publisher'],
			$_POST['Price'],
			$_POST['AddOn'],
			1
		);
		ob_clean();
		echo json_encode($result);
	}
}

function alter() {
	global $book;
	login_handle();

	if ($_SERVER['REQUEST_METHOD'] == "GET") {
		$result = $book->search($_GET['BookID']);
		ob_clean();
		echo json_encode($result);
	} elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
		$result = $book->update(
			$_GET['BookID'],
			$_POST['Name'],
			$_POST['Author'],
			$_POST['Pubdate'],
			$_POST['Subject'],
			$_POST['Publisher'],
			$_POST['Price'],
			$_POST['AddOn']
		);
		$result = $book->search($_GET['BookID']);
		ob_clean();
		echo json_encode($result);
	}
}

function del() {
	global $book;
	login_handle();

	$result = $book->delete($_GET['BookID']);
	ob_clean();
	echo json_encode($result);
}
?>