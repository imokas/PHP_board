<?
    include_once("./common.php");
    header("Content-Type: text/html; charset=UTF-8");
    $filename = $_GET["filename"];
    $filepath = "{$upload_path}/{$filename}";

    if(empty($filename)) {
        echo "<script>alert('파일명이 존재하지 않습니다.');history.back(-1);</script>";
        exit();
    }

    if(strpos($filename, "/") !== false || strpos($filename, "..") !== false || strpos($filename, "\\") !== false) {
        echo "<script>alert('허용되지 않은 문자가 포함되었습니다.');history.back(-1);</script>";
        exit();
    }

    header("Content-Type: application/octet-stream");
    header("Content-Disposition: attachment; filename={$filename}");

    readfile($filepath);

?>