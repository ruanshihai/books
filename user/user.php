<?php
require_once(dirname(__FILE__) . '/../common/security.php');
require_once(dirname(__FILE__) . '/../common/db.php');

class User {
	private $has_session = false;
	private $db;
	private $security;

	public function __construct() {
		$this->db = new DB();
		$this->security = new Security();
	}

	public function begin_session() {
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
		$result = $this->db->select("managers", array(
			'username' => $username,
			'password' => $this->security->encrypt($password)
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

	public function logout() {
		$this->begin_session();
		unset($_SESSION['username']);
		session_destroy();
		return array(
			'code' => 0,
			'msg'  => '',
			'data' => ''
		);
	}

	public function add($username, $password) {
		$this->begin_session();
		return $this->db->insert("managers", array(
			'username' => $username,
			'password' => $this->security->encrypt($password)
		));
	}

	public function del($username) {
		$this->begin_session();
		return $this->db->delete("managers", array(
			'username' => $username
		));
	}

	public function get_all_users() {
		$this->begin_session();
		return $this->db->select("managers");
	}
};
?>