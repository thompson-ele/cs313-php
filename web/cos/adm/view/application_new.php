<?php
//*********************************************************************************
//*                             VIEW/APPLICATION_NEW.PHP
//*               Allows admin to manually input a new application
//*********************************************************************************
?>

<main>
    <div class="container">
        <a class="btn btn-primary" href="applications.php"><i class="fa fa-reply"></i> Back to All Applications</a>
        
        <div class="row">
            <div class="col-sm-offset-2 col-sm-8">
                <?php
                if(isset($success)) { // Success message
                    echo '<p class="alert alert-success"><strong>Success!</strong> '.$success.'</p>';
                }
                
                if(isset($error)) { // Error message
                    echo '<p class="alert alert-danger"><strong>Oh snap!</strong> '.$error.'</p>';
                }
                ?>
            </div>
        </div><!--/.row-->
        
        <div class="row">
            <div class="col-sm-offset-2">
                <h1><i class="fa fa-graduation-cap text-primary"></i>Add a New Application</h1>
            </div>
        </div>
        
        <form action="applications.php?id=new" method="POST" class="form-horizontal">
            <div class="form-group">
                <label for="first_name" class="control-label col-sm-2">First Name:</label>
                <div class="col-sm-8">
                    <input id="first_name" name="first_name" type="text" class="form-control" required>
                </div>
            </div>
            
            <div class="form-group">
                <label for="last_name" class="control-label col-sm-2">Last Name:</label>
                <div class="col-sm-8">
                    <input id="last_name" name="last_name" type="text" class="form-control" required>
                </div>
            </div>
            
            <div class="form-group">
                <label for="student_id" class="control-label col-sm-2">Student ID #:</label>
                <div class="col-sm-8">
                    <input id="student_id" name="student_id" type="text" class="form-control" pattern="[0-9]{7}" title="Seven digit student ID number" required>
                </div>
            </div>
            
            <div class="form-group">
                <label for="email" class="control-label col-sm-2">Email:</label>
                <div class="col-sm-8">
                    <input id="email" name="email" type="email" class="form-control" required>
                </div>
            </div>
            
            <div class="form-group">
                <label for="printed_name" class="control-label col-sm-2">Name As Printed on the Certificate:</label>
                <div class="col-sm-8">
                    <input id="printed_name" name="printed_name" class="form-control" type="text" required>
                </div>
            </div>
            
            <div class="form-group">
            	<label for="program_id" class="control-label col-sm-2">Please choose a certificate:</label>
            	<div class="col-sm-8">
                    <select name="program_id" id="certificate" class="form-control">
                    	<option value="">Select a Certificate</option>
                        <?php foreach(getCertificates() as $certificate): ?>
                            	<option value="<?php echo $certificate['program_id']; ?>"><?php echo $certificate['program_name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-8">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane"></i> Submit New Application</button>
                </div>
            </div>
            
        </form>
    </div><!--/.container-->
</main>