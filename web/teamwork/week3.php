<?php 
	error_reporting(E_ALL);
	ini_set("display_errors", 1);
	$showForm = true;
	$majors = array(
				array(
					"name" => "Computer Science", 
					"val"  => "CS"
					),
				array(
					"name" => "Web Design and Development", 
					"val"  => "WDD"
					),
				array(
					"name" => "Computer information Technology", 
					"val"  => "CIT"
					),
				array(
					"name" => "Computer Engineering", 
					"val"  => "CE"
					)
	);
	$continents = array(
    	array("name" => "North America", "val" => "na"),
    	array("name" => "South America", "val" => "sa"),
    	array("name" => "Europe",        "val" => "eu"),
    	array("name" => "Asia",          "val" => "as"),
    	array("name" => "Australia",     "val" => "au"),
    	array("name" => "Africa",        "val" => "af"),
    	array("name" => "Antarctica",    "val" => "an")
    );   
      
	$name;
	$email;
	$displayMajor;
	$comments;
	$displayContinents = array();
	if (isset($_POST["Name"])) {
		$showForm = false;
		$name  = $_POST["Name"];
		$email = $_POST["Email"];
		foreach ($majors as $major) {
			if ($_POST["Major"] === $major["val"]) {
				$displayMajor = $major["name"];
			}
		}
		$comments = $_POST["Comments"];
      
        foreach ($continents as $continent) {
          	foreach ($_POST["Continents"] as $postCont) {
                if ($postCont === $continent["val"]) {
                    array_push($displayContinents, $continent["name"]);
                }
            }
        }
      	$displayContString = implode(", ", $displayContinents);
	}
 ?>

<!DOCTYPE html>
<html lang="en-us">
	<head>
		<title>Form!</title>
	</head>
	<body>
		<?php if ($showForm): ?>
			<form action="week3.php" method="POST">
				<label for="Name">Name: </label>
				<input type="text" name="Name" id="Name" placeholder="Name">
				<br>
				<br>
				<label for="Email">Email: </label>
				<input type="text" name="Email" id="Email" placeholder="Email">
				<br>
				<br>
				<label for="Major">Major: </label>
				<br>
				<?php foreach ($majors as $major): ?>
					<input type="radio" name="Major" id="<?php echo $major["val"]; ?>" value="<?php echo $major["val"]; ?>">
					<label for="<?php echo $major["val"]; ?>"><?php echo $major["name"] ?></label>	
					<br>
				<?php endforeach ?>
				<br>
				<label for="Continents">Continents: </label>
				<br>
   				<?php foreach ($continents as $continent): ?>
					<input type="checkbox" name="Continents[]" id="<?php echo $continent["val"]; ?>" value="<?php echo $continent["val"]; ?>">
					<label for="<?php echo $continent["val"]; ?>"><?php echo $continent["name"] ?></label>	
					<br>
				<?php endforeach ?>
				
				<label for="Comments">Comments</label>
				<br>
				<textarea name="Comments" placeholder="Comments"></textarea>
				<br>
				<br>
				<input type="submit" name="Submit" value="Submit">
			</form>
		<?php else: ?>
			<div class="result">
				<p>
					Name: <?php echo $name; ?>
				</p>
				<p>
					Email: <a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a>
				</p>
				<p>
					Major: <?php echo $displayMajor; ?>
				</p>
				<p>
					Continents: <?php echo $displayContString; ?>
				</p>
				<p>
					Comments: <?php echo $comments; ?>
				</p>
			</div>
		<?php endif; ?>
	</body>
</html>