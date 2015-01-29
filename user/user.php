<?php
require_once('../common/security.php');
require_once('../common/db.php');

class User {
	private $has_session = false;
	private $db;

	public function __construct() {
		$this->db = new DB();
	}

	public  function begin_session() {
		if (!$this->has_session)
			session_start();
		$this->has_session = true;
	}

	public function is_login() {
		$this->begin_session();
		if (isset($_SESSION['username']))
			return array(
				'code' => 0,
				'msg'  => '',
				'data' => $_SESSION['username']
			);
		return array(
			'code' => 1,
			'msg'  => 'has no login',
			'data' => ''
		);
	}

	public function login($username, $password) {
		$this->begin_session();
		$result = $this->db->search("managers", array(
			'username' => $username,
			'password' => $password
		));
		if ($result['code'] != 0)
			return $result;
		if (count($result['data']) == 0)
			return array(
				'code' => 1,
				'msg'  => 'login error',
				'data' => ''
			);
		$_SESSION['username'] = $username;
		return array(
			'code' => 0,
			'msg'  => '',
			'data' => $result['data']
		);
	}

	public function add($username, $password) {
		return $this->db->insert("managers", array(
			'username' => $username,
			'password' => $password
		));
	}

	public function del($username) {
		return $this->db->delete("managers", array(
			'username' => $username
		));
	}

	public function get_all_users() {
		return $this->db->select("managers");
	}
};
?>