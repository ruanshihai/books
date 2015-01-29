<?php
require_once("../common/db.php");

class Book {
	private $db;

	public function __construct() {
		$this->da = new DB();
	}

	public function insert($BookID='', $Name='', $Author='', $Pubdate='', $Subject='', $Publisher='', $Price='', $AddOn='') {
		return $this->db->insert("book_info", array(
			'BookID' => $BookID,
			'Name' => $Name,
			'Author' => $Author,
			'Pubdate' => $Pubdate,
			'Subject' => $Subject,
			'Publisher' => $Publisher,
			'Price' => $Price,
			'AddOn' => $AddOn
		));
	}

	public function delete($BookID) {
		return $this->db->delete("book_info", array(
			'BookID' => $BookID
		));
	}

	public function search($BookID='', $Name='', $Author='', $Pubdate='', $Subject='', $Publisher='', $Price='', $AddOn='') {
		return $this->db->search("book_info", array(
			'BookID' => $BookID,
			'Name' => $Name,
			'Author' => $Author,
			'Pubdate' => $Pubdate,
			'Subject' => $Subject,
			'Publisher' => $Publisher,
			'Price' => $Price,
			'AddOn' => $AddOn
		));
	}

	public function update($BookID='', $Name='', $Author='', $Pubdate='', $Subject='', $Publisher='', $Price='', $AddOn='') {
		return $this->db->update("book_info", array('BookID' => $BookID), array(
			'BookID' => $BookID,
			'Name' => $Name,
			'Author' => $Author,
			'Pubdate' => $Pubdate,
			'Subject' => $Subject,
			'Publisher' => $Publisher,
			'Price' => $Price,
			'AddOn' => $AddOn
		));
	}

	public function count($BookID='', $Name='', $Author='', $Pubdate='', $Subject='', $Publisher='', $Price='', $AddOn='') {
		return $this->db->count("book_info", array(
			'BookID' => $BookID,
			'Name' => $Name,
			'Author' => $Author,
			'Pubdate' => $Pubdate,
			'Subject' => $Subject,
			'Publisher' => $Publisher,
			'Price' => $Price,
			'AddOn' => $AddOn
		));
	}
};
?>