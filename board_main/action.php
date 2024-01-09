<?
	header("Content-Type: text/html; charset=UTF-8");
	include ( './common.php' );

	$mode = $_REQUEST["mode"];
	$db_conn = mysql_conn();
	
	if($mode == "write") {
		$title = $_POST["title"];
		$writer = $_POST["writer"];
		$password = $_POST["password"];
		$content = $_POST["content"];
		$uploadFile = "";

		if(empty($title) || empty($writer) || empty($password) || empty($content)) {
			echo "<script>alert('빈칸이 존재합니다.');history.back(-1);</script>";
			exit();
		}
		
		if(!empty($_FILES["userfile"]["name"])) {
			$uploadFile = $_FILES["userfile"]["name"];
			$uploadPath = "{$upload_path}/{$uploadFile}";
			
			if(!(@move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadPath))) {
				echo("<script>alert('파일 업로드를 실패 하셨습니다.');history.back(-1);</script>");
				exit;
			}
		}   
		
		$content = str_replace("\r\n", "<br>", $content);
		$query = "insert into {$tb_name}(title, writer, password, content, file, regdate, gubun) values('{$title}', '{$writer}', '{$password}', '{$content}', '{$uploadFile}', now(), '{$gubun}')";
		$db_conn->query($query);
	} else if($mode == "modify") {
		$idx = $_POST["idx"];
		$title = $_POST["title"];
		$writer = $_POST["writer"];
		$password = $_POST["password"];
		$content = $_POST["content"];
		$uploadFile = $_POST["oldfile"];

		if(empty($idx) || empty($title) || empty($writer) || empty($password) || empty($content)) {
			echo "<script>alert('빈칸이 존재합니다.');history.back(-1);</script>";
			exit();
		}

		# Password Check Logic
		$query = "select * from {$tb_name} where idx={$idx} and password='{$password}'";
		$result = $db_conn->query($query);
		$num = $result->num_rows;

		if($num == 0) {
			echo "<script>alert('패스워드가 일치하지 않습니다.');history.back(-1);</script>";
			exit();
		}

		if(!empty($_FILES["userfile"]["name"])) {
			$uploadFile = $_FILES["userfile"]["name"];
			$uploadPath = "{$upload_path}/{$uploadFile}";
			
			if(!(@move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadPath))) {
				echo("<script>alert('파일 업로드를 실패 하셨습니다.');history.back(-1);</script>");
				exit;
			}
		}   
		
		$content = str_replace("\r\n", "<br>", $content);
		
		$query = "update {$tb_name} set title='{$title}', writer='{$writer}', content='{$content}', file='{$uploadFile}', regdate=now(), gubun='{$gubun}' where idx={$idx}";
		$db_conn->query($query);
	} else if($mode == "delete") {
		$idx = $_POST["idx"];
		$password = $_POST["password"];
		
		# Password Check Logic
		$query = "select * from {$tb_name} where idx={$idx} and password='{$password}'";
		$result = $db_conn->query($query);
		$num = $result->num_rows;

		if($num == 0) {
			echo "<script>alert('패스워드가 일치하지 않습니다.');history.back(-1);</script>";
			exit();
		}
		
		
		$query = "delete from {$tb_name} where idx={$idx}";
		$db_conn->query($query);
	}

	echo "<script>location.href='index.php';</script>";
	$db_conn->close();
?>