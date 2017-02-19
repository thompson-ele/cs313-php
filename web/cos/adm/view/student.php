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
        <a class="btn btn-primary" href="students.php"><i class="fa fa-reply"></i> Back to Student List</a>
        
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
        
        <div class="col-sm-offset-2">
            <h1><i class="fa fa-user icon-success"></i> Edit Student: ID #<?php echo $student['student_id']; ?></h1>
        </div>

        <form action="students.php?id=<?php echo $student['student_id']; ?>" method="POST" class="form-horizontal">
            
            <div class="form-group">
                <label for="first_name" class="control-label col-sm-2">First Name: </label>
                <div class="col-sm-8">
                    <input id="first_name" name="first_name" class="form-control" type="text" value="<?php echo $student['first_name']; ?>" required>
                </div>
            </div>
            
            <div class="form-group">
                <label for="last_name" class="control-label col-sm-2">Last Name: </label>
                <div class="col-sm-8">
                    <input id="last_name" name="last_name" type="text" class="form-control" value="<?php echo $student['last_name']; ?>" required>
                </div>
            </div>
            
            <div class="form-group">
                <label for="email" class="control-label col-sm-2">Email: </label>
                <div class="col-sm-8">
                    <input id="email" name="email" type="email" class="form-control" value="<?php echo $student['email']; ?>" required>
                </div>
            </div>
            
            <input type="hidden" name="student_id" value="<?php echo $student['student_id']; ?>">
            
            <div class="col-sm-offset-2">
                <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Update Student</button>
            </div>
        </form>
        
        <br>
        <br>
        
        <div class="row">
            <div class="col-sm-offset-2 col-sm-8">
                <?php
                if(!empty($applications)): ?>
                <table class="table table-bordered table-striped">
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
                            <td><?php echo date('m/d/Y', $application['submit_date']); ?></td>
                            <td>
                                <?php
                                if($application['approved'] = 'Y') {
                                    echo '<span class="label label-success">Approved</span>';
                                } else {
                                    echo '<span class="label label-danger">Pending Approval</span>';
                                }
                                ?>
                            </td>
                            <td>
                                <?php
                                if(!is_null($application['pickup_date'])) {
                                    echo '<span class="label label-success">Picked Up</span>';
                                } else {
                                    echo '<span class="label label-danger">Not Picked Up</span>';
                                }
                                ?>
                            </td>
                        </tr>    
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <?php
                else:
                    echo 'This student has not submitted any applications yet';
                endif;?>
            </div>
        </div><!--/.row-->
        
    </div><!--/.container-->
</main>
