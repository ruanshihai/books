<?php
require_once('config.php');
require_once('security.php');

class DB {
	private $con = false;
	private $security;

	public function __construct() {
		this->security = new Security();
	}

	public function connect() {
		global $DBCONFIG;
		if ($this->con != false)
			return array(
				'code' => 0,
				'msg'  => '',
				'data' => $this->con;
			);
		$this->con = mysql_connect($DBCONFIG['DB_HOST']+":"+$DBCONFIG['DB_POST'], $DBCONFIG['DB_USER'], $DBCONFIG['DB_PWD']);
		if (!this->con)
			return array(
				'code' => 1,
				'msg'  => 'database connection error',
				'data' => '';
			);
		if (mysql_select_db($DBCONFIG['DB_NAME']), $this->con)
			return array(
				'code' => 0,
				'msg'  => '',
				'data' => $this->con;
			);
		return array(
			'code' => 2,
			'msg'  => 'database selection error',
			'data' => '';
		);
	}

	public function select($table, $where=array(), $limit=array()) {
		$result = $this->connect();
		if ($result['code'] != 0)
			return $result;
		$db = $result['data'];

		$sql = "SELECT * FROM " . security->sql_transform($table);
		if (count($where) != 0) {
			$sql .= " WHERE ";
			$is_first = true;
			foreach ($where as $key => $value){
				if ($is_first)
					$is_first = false;
				else
					$sql .= " AND ";
				$sql = $sql . $key . '="' . security->sql_transform($value) . '"';
			}
		}
		
		if (count($limit) != 0) {
			$sql .= " LIMIT ";
			$is_first = true;
			foreach ($limit as $key => $value) {
				if ($is_first)
					$is_first = false;
				else
					$sql .= ", ";
				$sql = $sql . security->sql_transform($value);
			}
		}

		$result = mysql_query($sql, $db);
		if ($result == false)
			return array(
				'code' => 3,
				'msg'  => "execute $sql error",
				'data' => '';
			);
		$data = array();
		while($row = mysql_fetch_array($result)) {
			$data[] = $row;
		}
		return array(
			'code' => 0,
			'msg'  => '',
			'data' => $data;
		);
	}

	public function count($table, $where=array()){
		$result = $this->connect();
		if ($result['code'] != 0)
			return $result;
		$db = $result['data'];

		$sql = "SELECT COUNT(*) FROM " . security->sql_transform($table);
		if (count($where) != 0) {
			$sql .= " WHERE ";
			$is_first = true;
			foreach ($where as $key => $value){
				if ($is_first)
					$is_first = false;
				else
					$sql .= " AND ";
				$sql = $sql . $key . '="' . security->sql_transform($value) . '"';
			}
		}

		$result = mysql_query($sql, $db);
		if ($result == false)
			return array(
				'code' => 3,
				'msg'  => "execute $sql error",
				'data' => '';
			);
		$data = mysql_fetch_array($result)[0];
		return array(
			'code' => 0,
			'msg'  => '',
			'data' => $data;
		);
	}

	public function insert($table, $attr) {
		$result = $this->connect();
		if ($result['code'] != 0)
			return $result;
		$db = $result['data'];

		$sql = "INSERT INTO" . security->sql_transform($table) . " SET ";
		if (count($attr) != 0) {
			$is_first = true;
			foreach ($attr as $key => $value){
				if ($is_first)
					$is_first = false;
				else
					$sql .= ", ";
				$sql = $sql . $key . '="' . security->sql_transform($value) . '"';
			}
		}

		$result = mysql_query($sql, $db);
		if ($result == false)
			return array(
				'code' => 3,
				'msg'  => "execute $sql error",
				'data' => '';
			);
		return array(
			'code' => 0,
			'msg'  => '',
			'data' => $result;
		);
	}

	public function update($table, $where=array(), $attr) {
		$result = $this->connect();
		if ($result['code'] != 0)
			return $result;
		$db = $result['data'];

		$sql = "UPDATE" . security->sql_transform($table) . " SET ";
		if (count($attr) != 0) {
			$is_first = true;
			foreach ($attr as $key => $value){
				if ($is_first)
					$is_first = false;
				else
					$sql .= ", ";
				$sql = $sql . $key . '="' . security->sql_transform($value) . '"';
			}
		}

		if (count($where) != 0) {
			$sql .= " WHERE ";
			$is_first = true;
			foreach ($where as $key => $value){
				if ($is_first)
					$is_first = false;
				else
					$sql .= " AND ";
				$sql = $sql . $key . '="' . security->sql_transform($value) . '"';
			}
		}

		$result = mysql_query($sql, $db);
		if ($result == false)
			return array(
				'code' => 3,
				'msg'  => "execute $sql error",
				'data' => '';
			);
		return array(
			'code' => 0,
			'msg'  => '',
			'data' => $result;
		);
	}

	public function delete($table, $where) {
		$result = $this->connect();
		if ($result['code'] != 0)
			return $result;
		$db = $result['data'];

		$sql = "DELETE FROM " . security->sql_transform($table);
		if (count($where) != 0) {
			$sql .= " WHERE ";
			$is_first = true;
			foreach ($where as $key => $value){
				if ($is_first)
					$is_first = false;
				else
					$sql .= " AND ";
				$sql = $sql . $key . '="' . security->sql_transform($value) . '"';
			}
		}

		$result = mysql_query($sql, $db);
		if ($result == false)
			return array(
				'code' => 3,
				'msg'  => "execute $sql error",
				'data' => '';
			);
		return array(
			'code' => 0,
			'msg'  => '',
			'data' => $result;
		);
	}
};
?>