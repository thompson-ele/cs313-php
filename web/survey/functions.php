<?php
//-----------------------------------------------------
// displayResults(file data, name of cat)
//-----------------------------------------------------
function displayResults($data, $name) {
	echo '<h2>'.ucfirst($name).'</h2>';
	echo '<p>A little ploos: '. getCount($data, $name, 1) .'</p>';
	echo '<p>Somewhat ploos: '. getCount($data, $name, 2) .'</p>';
	echo '<p>Ploos: '. getCount($data, $name, 3) .'</p>';
	echo '<p>Extremely Ploos: '. getCount($data, $name, 4) .'</p>';
}

//--------------------------------------------------------------------
// getCount(file data, name of cat, which question you are looking up)
//--------------------------------------------------------------------
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

//--------------------------------------------------------------------
// getFile() - gets data.txt file and converts from JSON to an array
//--------------------------------------------------------------------
function getFile() {
	// Declare file name
	$file = 'data.txt';
	// Get data.txt contents and put into a string
	$read_file = file_get_contents($file);
	// Convert file string into an array
	return json_decode($read_file, true);
}

//-----------------------------------------------------
// outputForm(name of cat, color)
//-----------------------------------------------------
function outputForm($name, $color) {
	echo '<section class="'.$color.'">';
	echo '<h3>How ploos do you think '.ucfirst($name).' is?</h3>';
	// IMAGES
	echo '<div class="row">';
	echo '	<div class="col-sm-3 col-xs-6"><img class="img-responsive" src="img/'.$name.'1.png"></div>';
	echo '	<div class="col-sm-3 col-xs-6"><img class="img-responsive" src="img/'.$name.'2.png"></div>';
	echo '	<div class="col-sm-3 col-xs-6"><img class="img-responsive" src="img/'.$name.'3.png"></div>';
	echo '	<div class="col-sm-3 col-xs-6"><img class="img-responsive" src="img/'.$name.'4.png"></div>';
	echo '</div><br>';
	// END IMAGES
	
	echo '<div class="btn-group" data-toggle="buttons">';
	
	echo '	<label class="btn btn-'.$color.'" for="'.$name.'1">
				<input name="'.$name.'" id="'.$name.'1" type="radio" value="1" required>A little ploos (ploosqueño)
			</label>
			<label class="btn btn-'.$color.'" for="'.$name.'2">
				<input name="'.$name.'" id="'.$name.'2" type="radio" value="2">Somewhat ploos (ploosquito)
			</label>
			<label class="btn btn-'.$color.'" for="'.$name.'3">
				<input name="'.$name.'" id="'.$name.'3" type="radio" value="3">Ploos
			</label>
			<label class="btn btn-'.$color.'" for="'.$name.'4">
				<input name="'.$name.'" id="'.$name.'4" type="radio" value="4">Extremely ploos (muy ploos)
			</label>';
	
	echo '</div>';
	echo '</section>';
}
?>