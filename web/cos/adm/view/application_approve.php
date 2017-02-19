<?php
//*********************************************************************************
//*                         VIEW/APPLICATION_APPROVE.PHP
//*                Allows admin to view approve any new applications
//*********************************************************************************
?>
<main>
    <div class="container">
        <a class="btn btn-primary" href="applications.php"><i class="fa fa-reply"></i> Back to All Applications</a>
        
        <?php
        if(isset($success)) { // Success message
            echo '<br><p class="alert alert-success"><strong>Success!</strong> '.$success.'</p>';
        }
        
        if(!empty($error)) { // Error message
            echo '<br><p class="alert alert-danger"><strong>Oh snap!</strong> There was a problem approving the following certificates:';
            echo $error;
            echo '</p>';
        }
        ?>

        <h1><i class="fa fa-pencil-square-o icon-danger"></i> Approve Certificate Applications</h1>

        <form action="applications.php?id=approve" method="POST">
            <table class="table table-bordered table-striped data-table">
                <thead>
                    <tr>
                        <th>Last Name</th>
                        <th>First Name</th>
                        <th>Student ID</th>
                        <th>Certificate Name</th>
                        <th>Date Submitted</th>
                        <th>Approve?</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach(getApplications(null, 'unapproved') as $application): ?>
                    <tr>
                        <td><?php echo getStudent($application['student_id'])['last_name']; ?></td>
                        <td><?php echo getStudent($application['student_id'])['first_name']; ?></td>
                        <td><?php echo $application['student_id']; ?></td>
                        <td><?php echo getCertificate($application['program_id'])['program_name']; ?></td>
                        <td><?php echo $application['submit_date']; ?></td>
                        <td><input type="checkbox" name="approved[]" value="<?php echo $application['application_id']; ?>"></td>
                    </tr>    
                <?php endforeach; ?>
                </tbody>
            </table>
        
            <button type="submit" class="btn btn-success pull-right right-submit-button"><i class="fa fa-check"></i> Approve Certificate(s)</button>
        </form>
        
    </div><!--/.container-->
</main>