<?php
	header("Content-Type: text/html; charset=UTF-8;");

	$tb_name = "tb_board";
	$upload_path = "upload";
	$gubun = "prob2";

	function mysql_conn() {
		$host = "127.0.0.1";
		$id = "xodzmsms";
		$pw = "password";
		$db = "pentest";
	
		$db_conn = new mysqli($host, $id, $pw, $db);

		return $db_conn;
	}
?>