<?
    session_start();
    header("Content-Type: text/html; charset=UTF-8");

    $mode = isset($_REQUEST["mode"]) ? $_REQUEST["mode"] : "";
    $dbhost = "127.0.0.1";
    $dbname = "pentest";
    $input_id = isset($_POST["input_id"]) ? $_POST["input_id"] : "";
    $input_password = isset($_POST["input_password"]) ? $_POST["input_password"] : "";
    $page = basename($_SERVER["PHP_SELF"]);
    $accessFlag = isset($_SESSION["accessFlag"]) ? $_SESSION["accessFlag"] : "";

    if($accessFlag == "Y"){
        if ($mode == "logout"){
            unset($_SESSION["accessFlag"]);
            session_destroy();
            echo "<script>location.href='{$page}'</script>";
            exit();
        }
    } else{
        if ($mode == "login" && !empty($input_password) && !empty($input_id)){
            try{
                $dbConn = mysqli_connect($dbhost, $input_id, $input_password, $dbname);
            }
            catch(mysqli_sql_exception $e){
                echo "<script>alert('Login Failed...');location.href='{$page}';</script>";
                exit();
            }
            $_SESSION["accessFlag"] = "Y";
            echo "<script>location.href='{$page}'</script>";
            $input_password = "";
            $input_id = "";
            exit();
        }
    }


?>
<!DOCTYPE html>
<html lang="ko">
    <head>
        <title>LEARNING_PHP</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <? if ($accessFlag != "Y") {?>
                    <form action="<?=$page?>?mode=login" method="POST" style="margin-top:24px">
                    <div class="login-wrapper">
                        <h2>Login</h2>
                        <form method="post" action=<?=$page?> id="login-form">
                            <input type="text" name="input_id" placeholder="Id">
                            <input type="password" name="input_password" placeholder="Password">
                            </label>
                            <input type="submit" value="Login">
                    </form>
                    </div>
                    </form>
                <? } else {
                    echo "<script>location.href='board_main'</script>";
                } ?>
            <div>
            <div class="col-md-3"></div>
        </div>    
    </body>
</html>