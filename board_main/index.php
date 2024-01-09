<?
  include_once("./common.php");
  
  $db_conn = mysql_conn();

  # Search Logic
  $search_type = isset($_POST["search_type"]) ? $_POST["search_type"] : "";
  $keyword = isset($_POST["keyword"]) ? $_POST["keyword"] : "";
  $query = "select * from {$tb_name} where gubun='{$gubun}' order by idx desc";

  $result = $db_conn->query($query);
  $num = $result->num_rows;
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>LEARNING_PHP</title>

    <!-- Bootstrap core CSS -->
    <link href="./css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="./css/pricing.css" rel="stylesheet">
  </head>

  <body>

    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
      <h1 class="display-4">USER BOARD</h1>
      <hr>
    </div>
    
    <div class="container">
		<div class="text-right">
			<button type="button" class="btn btn-outline-secondary" onclick="location.href='write.php'">Write</button>
      <button type="button" class="btn btn-outline-secondary" onclick="location.href='/board_login.php?mode=logout'">Logout</button>
    </div>
    <br>
		<table class="table">
		  <thead class="thead-dark">
			<tr>
			  <th width="10%" scope="col" class="text-center">No</th>
			  <th width="50%" scope="col" class="text-center">Title</th>
			  <th width="20%" scope="col" class="text-center">Write</th>
			  <th width="20%" scope="col" class="text-center">Date</th>
			</tr>
		  </thead>
		  <tbody>
			<?
			if($num != 0) {
				for ( $i=0; $i<$num; $i++ ) {
				  $row = $result->fetch_assoc();
			?>
			<tr>
			  <th scope="row" class="text-center"><?=$row["idx"]?></th>
        <td><a href="view.php?idx=<?=$row["idx"]?>"><?=$row["title"]?></a></td>
			  <td class="text-center"><?=$row["writer"]?></td>
			  <td class="text-center"><?=$row["regdate"]?></td>
			</tr>
			<?
				}
			} else {
			?>
            <tr>
              <td colspan="4" class="text-center">Posts does not exist.</td>
            </tr>
			<?
			}
			?>
		  </tbody>
		</table>
    </div>
    <!-- Icons -->
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script>
      feather.replace()
    </script>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="./js/jquery-slim.min.js"><\/script>')</script>
    <script src="./js/popper.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/holder.min.js"></script>
    <script>
      Holder.addTheme('thumb', {
        bg: '#55595c',
        fg: '#eceeef',
        text: 'Thumbnail'
      });
    </script>
  </body>
</html>
<?
	$db_conn->close();
?>
