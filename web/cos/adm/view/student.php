<?php
//***********************************************************************************
//*                             VIEW/STUDENT.PHP
//* Displays an individual student and their applications (view for adm/students.php)
//***********************************************************************************

// Include a form to edit student information
// Display a list of all student applications
// Include link to delete student (and their applications)
// Include link to edit, approve or delete student application
?>

<main>
    <div class="container">
        <a href="students.php">Back to Student List</a>
        <?php
        if(isset($success)) { // Success message
            echo '<p class="bg-success">'.$success.'</p>';
        } else if(isset($error)) { // Error message
            echo '<p class="bg-danger">'.$error.'</p>';
        }
        ?>
        <form action="students.php?id=<?php echo $student['student_id']; ?>" method="POST">
            <p>Student ID: <?php echo $student['student_id']; ?></p>
            
            <div class="form-group">
                <label for="first_name" class="control-label">First Name: </label>
                <input id="first_name" name="first_name" class="form-control" type="text" value="<?php echo $student['first_name']; ?>" required>
            </div>
            
            <label for="last_name" class="control-label">Last Name: </label>
            <input id="last_name" name="last_name" type="text" class="form-control" value="<?php echo $student['last_name']; ?>" required>
            
            <label for="email" class="control-label">Email: </label>
            <input id="email" name="email" type="email" class="form-control" value="<?php echo $student['email']; ?>" required>
            
            <input type="hidden" name="student_id" value="<?php echo $student['student_id']; ?>">
            <input type="submit" value="Update Student">
        </form>
        
        
        <?php
        if(!empty($applications)): ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Application ID</th>
                    <th>Certificate Name</th>
                    <th>Date Submitted</th>
                    <th>Approved?</th>
                    <th>Picked Up?</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($applications as $application): ?>
                <tr>
                    <td><?php echo $application['application_id']; ?></td>
                    <td><?php echo getCertificate($application['program_id'])['program_name']; ?></td>
                    <td><?php echo $application['submit_date']; ?></td>
                    <td><?php echo $application['approved']; ?></td>
                    <td><?php echo (is_null($application['pickup_date'])) ? 'N' : 'Y'; ?></td>
                </tr>    
            <?php endforeach; ?>
            </tbody>
        </table>
        <?php
        else:
            echo 'This student has not submitted any applications yet';
        endif;?>
    </div><!--/.container-->
</main>
