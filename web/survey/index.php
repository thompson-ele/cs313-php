<?php
session_start();
// Check if the user already has submitted the survey ($_SESSION)
if(isset($_SESSION['survey_completed']) && $_SESSION['survey_completed'] == TRUE) {
	header('Location: results.php');
}

include('functions.php');
$data = getFile();

if($_SERVER['REQUEST_METHOD'] == 'POST') {
	// Add $_POST result to the array
	array_push($data, $_POST);
	// Turn the array back into JSON
	$updated_data = json_encode($data, JSON_PRETTY_PRINT);
	// Update the data.txt file
	if(file_put_contents('data.txt', $updated_data)) {
		// Assign $_SESSION variables, survey_completed
		$_SESSION['survey_completed'] = TRUE;
		
		// Redirect to results.php
		header('Location: results.php');
	} else {
		echo '<p class="bg-danger">There was a problem submitting your survey. Please try again.</p>';
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
    
    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Roboto|Roboto+Slab" rel="stylesheet">
	
	<!-- CUSTOM STYLESHEET -->
	<link href="css/styles.css" type="text/css" rel="stylesheet">
</head>

<body>
	<main>
		<div class="container">
        	<div class="row">
            	<div class="col-md-8 col-md-offset-2">
                    <h1>Ploos Survey</h1>
                    <p>My brother's friend recently coined a new term when referring to the fluffiness that is his cat Milo:</p>
                    <blockquote>
                        <h3>ploos [plüs] - <i>adj.</i><br>
                        a state of being larger than average. Includes behavioral traits such as fluffy belly, waddling, extreme laziness, etc.</h3>
                    </blockquote>
                    <p>Now that we have an accurate descriptor for our cats, it is time to actually rank them by their ploos-ness.</p>
                </div>
            </div>
			<div class="row">
				<h3>Please rank the following cats based on their level of ploos-ness:</h3>

				<form action="index.php" method="post">
					<?php
						outputForm('rufus', 'primary');
						outputForm('seymour', 'success');
						outputForm('milo', 'warning');
						outputForm('haru', 'danger');
					?>
					<div class="row">
						<div class="col-xs-2 col-xs-offset-5 text-center">
							<button type="submit" class="btn btn-lg btn-primary">
								<i class="fa fa-paper-plane"></i>  Submit Survey
							</button>
							<p><a href="results.php">See survey results</a></p>
						</div>
					</div>
				</form>

			</div><!--/.row-->
		</div><!--/.container-->
	</main>
	
	<footer>
		<div class="container text-center">
			<hp>ploos [plüs] - <i>adj.</i><br>
			a state of being larger than average. Includes behavioral traits such as fluffy belly, waddling, extreme laziness, etc.</p>
		</div>
	</footer>
	
	<!-- JQUERY -->
	<script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
	
	<!-- BOOTSTRAP JS -->
	<script src="../js/bootstrap.min.js" type="text/javascript"></script>
</body>
</html>