<?php
class Security {
	function html_transform($str) {
		return htmlspecialchars($str);
	}

	function sql_transform($str) {
		return addslashes($str);
	}

	function encrypt($str) {
		return $str;
		$cluster = "jkja~1!jnw_90eui23h@3@ew+";
		$res = MD5($cluster . MD5($str . $cluster));
		return $res;
	}
}
?>