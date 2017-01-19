<?php
// Check if the user already has submitted the survey ($_SESSION)


include('functions.php');
$data = getFile();

if($_SERVER['REQUEST_METHOD'] == 'POST') {
	// Add $_POST result to the array
	array_push($data, $_POST);
	// Turn the array back into JSON
	$updated_data = json_encode($data, JSON_PRETTY_PRINT);
	// Update the data.txt file
	if(file_put_contents('data.txt', $updated_data)) {
		$msg = true;
		
		// Create $_SESSION
		// Add $_SESSION variables, msg
		
		// Redirect to results.php
		
	} else {
		$msg = false;
	}
}
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>CS 313 - Ele Thompson - PHP Survey</title>
	
	<!-- BOOTSTRAP CSS -->
	<link href="../css/bootstrap.min.css" type="text/css" rel="stylesheet">
	
	<!-- FONT AWESOME -->
	<script src="https://use.fontawesome.com/fae7a79c55.js"></script>
	
	<!-- CUSTOM STYLESHEET -->
	<link href="css/styles.css" type="text/css" rel="stylesheet">
</head>

<body>
	<main>
		<div class="container">
			<div class="row">
				<blockquote>
					<h2>ploos [plüs] - <i>adj.</i><br>
					a state of being larger than average. Includes behavioral traits such as fluffy belly, waddling, extreme laziness, etc.</h2>
				</blockquote>

				<h3>Please rank the following cats based on their level of ploos-ness:</h3>

				<form action="index.php" method="post">
					<?php
						outputForm('rufus', 'primary');
						outputForm('seymour', 'success');
						outputForm('milo', 'warning');
						outputForm('haru', 'danger');
					?>
					<button type="submit" class="btn btn-lg btn-primary">
						<i class="fa fa-paper-plane"></i>  Submit Survey
					</button>
				</form>

				<p><a href="results.php">See survey results</a></p>
			</div><!--/.row-->
		</div><!--/.container-->
	</main>
	
	<footer>
		<div class="container text-center">
			<h4>ploos [plüs] - <i>adj.</i><br>
			a state of being larger than average. Includes behavioral traits such as fluffy belly, waddling, extreme laziness, etc.</h4>
		</div>
	</footer>
	
	<!-- JQUERY -->
	<script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
	
	<!-- BOOTSTRAP JS -->
	<script src="../js/bootstrap.min.js" type="text/javascript"></script>
</body>
</html>