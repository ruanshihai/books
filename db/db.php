<?php
require_once('config.php');
require_once('../common/security.php');
class DB{
	var $mysqldb = false;
	var $isOpen = false;
	function connect(){
		global $dbconfig;
		if( $this->isOpen == true )
			return $this->mysqldb;
		$this->mysqldb = mysql_connect($dbconfig['DB_HOST'], $dbconfig['DB_USER'], $dbconfig['DB_PWD']);
		mysql_select_db("books", $this->mysqldb);
		return $this->mysqldb;
	}

	function select($table,$where,$pageId=-1){
		$this->connect();

		$whereSql = '';
		if (count($where)!=0) {
			$whereSql = ' where ';
			$isFirst = true;
			foreach($where as $key=>$value){
				if ($isFirst == false )
					$whereSql .= " AND ";
				$whereSql .= $key . '="' . sql_transform($value) . '"';
				$isFirst = false;
			}
		}
		$limitSql = '';
		if( $pageId >= 0 ){
			$limitSql .= ' limit '.$pageId.' , 10 ';
		}
		$sql = 'select * from '.$table.$whereSql.$limitSql;
		$result = mysql_query($sql);
		$data = array();
		while( $singleRow = mysql_fetch_array($result)){
			$data[] = $singleRow;
		}
		return $data;
	}

	function count($table,$where){
		$this->connect();

		$whereSql = '';
		if (count($where)!=0) {
			$whereSql = ' where ';
			$isFirst = false;
			foreach($where as $key=>$value){
				if ($isFirst == false )
					$whereSql .= " AND ";
				$whereSql .= $key . '="' . sql_transform($value) . '"';
			}
		}
		$sql = 'select count(*) from '.$table.$whereSql.$limitSql;
		$result = mysql_query($sql);
		$data = mysql_fetch_array($result);
		return $data[0];
	}

};

?>