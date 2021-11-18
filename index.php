<?php
require "dbconfig/config.php";
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Athlete's Info</title>
	<link rel="stylesheet" href="style.css" type="text/css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>

</head>

<body>
	<?php include("navbar.php"); ?>

	<div class="container">
		<div class="row">
			<div class="col-3" id="pname">
				<h1>Players</h1>

				<?php
				// fill in the blanks	- Select SQL
				$query = "SELECT PlayerName FROM players";
				$result = mysqli_query($con, $query);
				while ($row = mysqli_fetch_array($result)) {
					$name = $row['PlayerName'];
					echo "<h4><a href='index.php?name=$name'> $name<br></a>
							</h4>";
				}
				if (!$result) {
					printf("Error: %s\n", mysqli_error($con));
					exit();
				}
				?>
			</div>
			<div class="col-6">
				<?php
				// fill in the blanks	- player is click, show the description
				if (isset($_GET["name"])) {
					$name = $_GET["name"];
					$query = "SELECT Description FROM players WHERE PlayerName = '$name' ";
					$query_run = mysqli_query($con, $query);
					$row = mysqli_fetch_array($query_run);
					$desc = $row['Description'];

					echo
					"<h2>$name</h2>
							<p>$desc<br></p>";
				} else {
					echo "<h2>Choose a player, or add a player!</h2>";
				}
				?>
			</div>
			<div class="col-3" id="picpic">
				<?php
				// fill in the blanks	- display & delete the image
				if (isset($_POST["delete"])) {
					$query = "DELETE FROM players WHERE PlayerName = '$name'";
					$query_run = mysqli_query($con, $query);
					if ($query_run) {
						echo "<script> alert('Player deleted'); 
								location.href = 'index.php';
								</script>";
					}
				}

				if (isset($_GET["name"])) {
					$name = $_GET["name"];
					$query = "SELECT Image FROM players WHERE PlayerName = '$name'";
					$query_run = mysqli_query($con, $query);
					$row = mysqli_fetch_array($query_run);

					echo '
						<form method= "post" action ="index.php?name=' . $name . '" >
						<div class="btns">
						<input type="button" value="Hide Pic" id="hidebtn">
						<input type="submit" name="delete" value="Delete Player">
						</div>
						<img id="hide" src="data:image/jpeg;base64,' . base64_encode($row['Image']) . '" height="200" />
						</form>';
				}
				?>
			</div>
		</div>
	</div>

	<script>
		$("#hidebtn").click(function() {
			$("#hide").toggle(100);
			if ($('#hidebtn').val() === 'Hide Pic') {
				$('#hidebtn').val("Show Pic");
			} else {
				$('#hidebtn').val("Hide Pic");
			}
		});
	</script>

</body>

</html>