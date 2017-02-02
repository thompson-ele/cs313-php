<?php
//*********************************************************************************
//*                             VIEW/APPLICATION_NEW.PHP
//*               Allows admin to manually input a new application
//*********************************************************************************
?>

<main>
    <div class="container">
        <a href="applications.php">Back to All Applications</a>
        <?php
        if(isset($success)) { // Success message
            echo '<p class="bg-success">'.$success.'</p>';
        }
        
        if(isset($error)) { // Error message
            echo '<p class="bg-danger">'.$error.'</p>';
        }
        ?>
        <form action="applications.php?id=new" method="POST">
            <div class="form-group">
                <label for="first_name" class="control-label">First Name:</label>
                <input id="first_name" name="first_name" type="text" required>
            </div>
            
            <div class="form-group">
                <label for="last_name" class="control-label">Last Name:</label>
                <input id="last_name" name="last_name" type="text" required>
            </div>
            
            <div class="form-group">
                <label for="student_id" class="control-label">Student ID #:</label>
                <input id="student_id" name="student_id" type="text" pattern="[0-9]{7}" title="Seven digit student ID number" required>
            </div>
            
            <div class="form-group">
                <label for="email" class="control-label">Email:</label>
                <input id="email" name="email" type="email" required>
            </div>
            
            <div class="form-group">
                <label for="printed_name" class="control-label">Name As Printed on the Certificate:</label>
                <input id="printed_name" name="printed_name" type="text" required>
            </div>
            
            <div class="form-group">
            	<label for="program_id">Please choose a certificate:</label>
                <select name="program_id" id="certificate" class="form-control">
                	<option value="">Select a Certificate</option>
                    <?php foreach(getCertificates() as $certificate): ?>
                        	<option value="<?php echo $certificate['program_id']; ?>"><?php echo $certificate['program_name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <input type="submit" value="Create New Application">
        </form>
    </div><!--/.container-->
</main>