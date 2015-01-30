<?php
require_once(dirname(__FILE__) . '/../common/db.php');

class Book {
	private $db;
	private $attr = array("BookID", "Name", "Author", "Pubdate", "Subject", "Publisher", "Price", "AddOn");

	public function __construct() {
		$this->db = new DB();
	}

	public function insert($BookID, $Name, $Author, $Pubdate, $Subject, $Publisher, $Price, $AddOn) {
		$record = array(
			'BookID' => $BookID,
			'Name' => $Name,
			'Author' => $Author,
			'Pubdate' => $Pubdate,
			'Subject' => $Subject,
			'Publisher' => $Publisher,
			'Price' => $Price,
			'AddOn' => $AddOn
		);
		foreach ($record as $key => $value) {
			if ($value == "")
				unset($record[$key]);
		}
		return $this->db->insert("book_info", $record);
	}

	public function delete($BookID) {
		return $this->db->delete("book_info", array(
			'BookID' => $BookID
		));
	}

	public function search($BookID='', $Name='', $Author='', $Pubdate='', $Subject='', $Publisher='', $Price='', $AddOn='', $from='', $count='') {
		$where = array(
			'BookID' => $BookID,
			'Name' => $Name,
			'Author' => $Author,
			'Pubdate' => $Pubdate,
			'Subject' => $Subject,
			'Publisher' => $Publisher,
			'Price' => $Price,
			'AddOn' => $AddOn
		);
		foreach ($where as $key => $value) {
			if ($value == "")
				unset($where[$key]);
		}
		$limit = array();
		if ($from != "")
			$limit[] = $from;
		if ($count != "")
			$limit[] = $count;
		return $this->db->select("book_info", $where, $limit);
	}

	public function update($BookID='', $Name='', $Author='', $Pubdate='', $Subject='', $Publisher='', $Price='', $AddOn='') {
		$action = array(
			'Name' => $Name,
			'Author' => $Author,
			'Pubdate' => $Pubdate,
			'Subject' => $Subject,
			'Publisher' => $Publisher,
			'Price' => $Price,
			'AddOn' => $AddOn
		);
		foreach ($action as $key => $value) {
			if ($value == "")
				unset($action[$key]);
		}
		return $this->db->update("book_info", array('BookID' => $BookID), $action);
	}

	public function count($BookID='', $Name='', $Author='', $Pubdate='', $Subject='', $Publisher='', $Price='', $AddOn='') {
		$where = array(
			'BookID' => $BookID,
			'Name' => $Name,
			'Author' => $Author,
			'Pubdate' => $Pubdate,
			'Subject' => $Subject,
			'Publisher' => $Publisher,
			'Price' => $Price,
			'AddOn' => $AddOn
		);
		foreach ($where as $key => $value) {
			if ($value == "")
				unset($where[$key]);
		}
		return $this->db->count("book_info", $where);
	}
};
?>