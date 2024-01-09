<?
	include_once("./common.php");

	$db_conn = mysql_conn();
	$idx = $_REQUEST["idx"];
	$query = "select * from {$tb_name} where idx={$idx}";

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
		<h1 class="display-4">View Page</h1>
    	<hr>
    </div>
    
    <div class="container">
	<?
	if($num != 0) {
		$row = $result->fetch_assoc();
	?>

		<table class="table table-bordered">
		  <tbody>
			<tr>
			  <th scope="row" width="20%" class="text-center">Title</th>
			  <td><?=$row["title"]?></td>
			</tr>
			<tr>
			  <th scope="row" width="20%" class="text-center">Writer</th>
			  <td><?=$row["writer"]?></td>
			</tr>
			<tr>
			  <th scope="row" width="20%" class="text-center">Date</th>
			  <td><?=$row["regdate"]?></td>
			</tr>
			<tr>
			  <th scope="row" width="20%" class="text-center">Contents</th>
			  <td><?=$row["content"]?></td>
			</tr>
			<? if(!empty($row["file"])) { ?>
			<tr>
			  <th scope="row" width="20%" class="text-center">File</th>
			  <td><a href="download.php?filename=<?=$row["file"]?>"><?=$row["file"]?></a></td>
			</tr>
			<? } ?>
		  </tbody>
		</table>
		<div class="text-right">
			<button type="button" class="btn btn-outline-secondary" onclick="location.href='modify.php?idx=<?=$row["idx"]?>'">Modify</button>
			<button type="button" class="btn btn-outline-danger" onclick="location.href='auth.php?mode=delete&idx=<?=$row["idx"]?>'">Delete</button>
			<button type="button" class="btn btn-outline-warning" onclick="location.href='index.php'">List</button>
		</div>
    </div>
	<?
	} else {
	?>
		<script>alert("존재하지 않는 게시글 입니다.");history.back(-1);</script>
	<?
	}
	?>
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
