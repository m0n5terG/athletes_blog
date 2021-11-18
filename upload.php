<?php
	require "dbconfig/config.php";
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>blog</title>
		<link rel="stylesheet" href="style.css" type="text/css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
		<script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>

	</head>
	<body>
		<?php include("navbar.php"); ?>
		<?php
			// fill in the blanks
			$player = $desc = "";
			if(isset($_POST["upload"])){
				$player = $_POST["player"];
				$desc = $_POST["description"];
				$file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));

				$query = "INSERT into players VALUES('$player', '$desc', '$file')";
				$query_run = mysqli_query($con, $query);

				if($query_run){
					echo "<script> alert('Player added')</script>";
				} else {
					echo "<script> alert('Player was NOT added!)</script>";
				}
			}
		?>
		<div class="container-fluid">
			<div class="row">
				<div class="col-2"></div>
				<div class="col-8">
					<form method = "post" enctype="multipart/form-data" action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
						<h2>Player</h2>
						<input class="player" type="text" name="player">
						<h2>Description</h2>
						<textarea class="desc" name="description"></textarea>
						<input type="file" name="image">
						<input type="submit" value="Submit" name="upload">
					</form>
				</div>
				<div class="col-2"></div>
			</div>
		</div>

	</body>
</html>