<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
	
	// Grab survey results from data.txt file
	$file = 'data.txt';
	$handle = fopen($file, 'r');
	$read_file = fread($handle, filesize($file));
	$data = json_decode($read_file, true);
	//echo print_r($data);
}

function getCount($data, $question, $answer) {
	$count = 0;
	// For each row in the array,
	foreach($data as $row) {
		// Check the value of whichever question we're looking at
		if($row[$question] == $answer) {
			// Add to count if it's the same as the answer we're looking for
			$count++;
		}
	}
	// Return number of selected
	return $count;
}

?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>CS 313 - Ele Thompson - PHP Survey</title>
	
	<!-- BOOTSTRAP CSS -->
	<link href="../css/bootstrap.min.css" type="text/css" rel="stylesheet">
</head>

<body>
	<div class="container">
		<div class="row">
			<h2>ploos [plüs] - <i>adj.</i><br>
			a state of being larger than average. Includes behavioral traits such as fluffy belly, waddling, extreme laziness, etc.</h2>
			
			<form action="index.php" method="post">
				<p>How ploos do you think Rufus is?</p>
				<div class="btn-group" data-toggle="buttons">
					<label class="btn btn-primary" for="rufus1">
						<input name="rufus" id="rufus1" type="radio" value="1">A little ploos (ploosqueno)
					</label>
					<label class="btn btn-primary" for="rufus2">
						<input name="rufus" id="rufus2" type="radio" value="2">Somewhat ploos (ploosquito)
					</label>
					<label class="btn btn-primary" for="rufus3">
						<input name="rufus" id="rufus3" type="radio" value="3">Ploos
					</label>
					<label class="btn btn-primary" for="rufus4">
						<input name="rufus" id="rufus4" type="radio" value="4">Extremely ploos (muy ploos)
					</label>
				</div>

				<p>How ploos do you think Seymour is?</p>
				<div class="btn-group" data-toggle="buttons">
					<label class="btn btn-success" for="seymour1">
						<input name="seymour" id="seymour1" type="radio" value="1">A little ploos (ploosqueno)
					</label>
					<label class="btn btn-success" for="seymour2">
						<input name="seymour" id="seymour2" type="radio" value="2">Somewhat ploos (ploosquito)
					</label>
					<label class="btn btn-success" for="seymour3">
						<input name="seymour" id="seymour3" type="radio" value="3">Ploos
					</label>
					<label class="btn btn-success" for="seymour4">
						<input name="seymour" id="seymour4" type="radio" value="4">Extremely ploos (muy ploos)
					</label>
				</div>

				<p>How ploos do you think Milo is?</p>
				<div class="btn-group" data-toggle="buttons">
					<label class="btn btn-warning" for="milo1">
						<input name="milo" id="milo1" type="radio" value="1">A little ploos (ploosqueno)
					</label>
					<label class="btn btn-warning" for="milo2">
						<input name="milo" id="milo2" type="radio" value="2">Somewhat ploos (ploosquito)
					</label>
					<label class="btn btn-warning" for="milo3">
						<input name="milo" id="milo3" type="radio" value="3">Ploos
					</label>
					<label class="btn btn-warning" for="milo4">
						<input name="milo" id="milo4" type="radio" value="4">Extremely ploos (muy ploos)
					</label>
				</div>

				<p>How ploos do you think Haru is?</p>
				<div class="btn-group" data-toggle="buttons">
					<label class="btn btn-danger" for="haru1">
						<input name="haru" id="haru1" type="radio" value="1">A little ploos (ploosqueno)
					</label>
					<label class="btn btn-danger" for="haru2">
						<input name="haru" id="haru2" type="radio" value="2">Somewhat ploos (ploosquito)
					</label>
					<label class="btn btn-danger" for="haru3">
						<input name="haru" id="haru3" type="radio" value="3">Ploos
					</label>
					<label class="btn btn-danger" for="haru4">
						<input name="haru" id="haru4" type="radio" value="4">Extremely ploos (muy ploos)
					</label>
				</div>
				
				<input type="submit" value="Submit Survey">
			</form>

			<p><a href="">See survey results</a></p>
		</div><!--/.row-->
		
		
		<div class="row">
			<h1>Results</h1>
			<hr>
			<h2>Rufus</h2>
			<p>A little ploos: <?php echo getCount($data, 'rufus', 1); ?></p>
			<p>Somewhat ploos: <?php echo getCount($data, 'rufus', 2); ?></p>
			<p>Ploos: <?php echo getCount($data, 'rufus', 3); ?></p>
			<p>Extremely Ploos: <?php echo getCount($data, 'rufus', 4); ?></p>
			
			<h2>Seymour</h2>
			
			<h2>Milo</h2>
			
			<h2>Haru</h2>
		</div><!--/row-->
	</div><!--/.container-->
	
	<!-- JQUERY -->
	<script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
	
	<!-- BOOTSTRAP JS -->
	<script src="../js/bootstrap.min.js" type="text/javascript"></script>
</body>
</html>