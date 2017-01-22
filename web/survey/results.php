<?php
session_start();
// Check if survey has already been completed
if(isset($_SESSION['survey_completed']) && $_SESSION['survey_completed'] == TRUE) {
	$survey_completed = TRUE;
}

include('functions.php');
$data = getFile();

$cats = array(
			'rufus' 	=> 'primary',
			'seymour' 	=> 'success',
			'milo' 		=> 'warning',
			'haru' 		=> 'danger'
		);
$categories = array("A little ploos", "Somewhat ploos", "Ploos", "Extremely ploos");
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>CS 313 - Ele Thompson - PHP Survey</title>
	
	<!-- BOOTSTRAP CSS -->
	<link href="../css/bootstrap.min.css" type="text/css" rel="stylesheet">
    
    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Roboto|Roboto+Slab" rel="stylesheet">
	
	<!-- CUSTOM STYLESHEETS-->
	<link href="css/responsive-bar-chart.css" type="text/css" rel="stylesheet"> <!-- http://bootsnipp.com/snippets/GXkjV -->
	<link href="css/styles.css" type="text/css" rel="stylesheet">
</head>

<body>
	<div class="container">
		<div class="row">
        	<div class="col-md-8 col-md-offset-2">
            	<blockquote>
                    <h3>ploos [plüs] - <i>adj.</i><br>
                    a state of being larger than average. Includes behavioral traits such as fluffy belly, waddling, extreme laziness, etc.</h3>
                </blockquote>
            </div>
		</div>
		
		<div class="row">
			<h1>Results</h1>
			<hr>
			
			<?php if(isset($survey_completed) && $survey_completed == TRUE) { echo '<p id="msg" class="bg-success">Thank you for completing our survey! The kitties appreciate your input :)</p>'; } ?>
			
			<div class="row">
			
				<?php foreach($cats as $cat => $color): ?>
				<div class="col-sm-6">
					<h1><?php echo ucfirst($cat); ?></h1>
					<div class="bar-chart">
						<div class="chart clearfix">

						<?php foreach($categories as $number => $category): ?>
							<div class="item">
								<div class="bar">
									<span class="percent"><?php echo getCount($data, $cat, $number + 1); ?> votes</span>
									<span class="title"><?php echo $category; ?></span>
									<div class="item-progress <?php echo $color;?>-bg" data-percent="<?php echo getCount($data, $cat, $number + 1) / count($data) * 100; ?>"></div>
								</div><!-- /.bar -->
							</div><!-- /.item -->
						<?php endforeach; ?>

						</div><!--/.chart clearfix -->
					</div><!--/.bar-chart -->
				</div><!--/.col-sm-6-->
				<?php endforeach; ?>
				
			</div>
			<!-- /.row -->
			<p><a href="index.php">Back to Survey</a></p>
		</div><!--/row-->
	</div><!--/.container-->
	
	<!-- JQUERY -->
	<script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
	
	<!-- BOOTSTRAP JS -->
	<script src="../js/bootstrap.min.js" type="text/javascript"></script>
	
	<!-- CUSTOM JS -->
	<script src="js/responsive-bar-chart.js" type="text/javascript"></script>
</body>
</html>