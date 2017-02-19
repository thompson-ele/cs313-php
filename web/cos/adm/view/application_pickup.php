<?php
//*********************************************************************************
//*                         VIEW/APPLICATION_PICKUP.PHP
//*          Allows student workers to search for an existing application
//**               and mark them off as picked up once printed
//*********************************************************************************
?>
<main>
    <div class="container">
        <a href="applications.php" class="btn btn-primary"><i class="fa fa-reply"></i> Back to Applications</a>
        
        <?php
        if(isset($success)) { // Success message
            echo '<br><p class="alert alert-success"><strong>Success!</strong> '.$success.'</p>';
        }
        
        if(!empty($error)) { // Error message
            echo '<br><p class="alert alert-danger"><strong>Oh snap!</strong> There was a problem updating the following certificates:';
            echo $error;
            echo '</p>';
        }
        ?>
        
        <h1><i class="fa fa-print icon-warning"></i> Pickup Certificate</h1>
        <form action="applications.php?id=pickup" method="POST">
            <table class="table table-bordered table-striped data-table">
                <thead>
                    <tr>
                        <th>Student ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Name Printed on Certificate</th>
                        <th>Certificate Name</th>
                        <th>Approved?</th>
                        <th>Picked Up?</th>
                        <th>Pickup Date</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach(getApplications(null, 'pickup') as $application): ?>
                    <tr>
                        <td><?php echo $application['student_id']; ?></td>
                        <td><?php echo getStudent($application['student_id'])['first_name']; ?></td>
                        <td><?php echo getStudent($application['student_id'])['last_name']; ?></td>
                        <td><?php echo $application['printed_name']; ?></td>
                        <td><?php echo getCertificate($application['program_id'])['program_name']; ?></td>
                        <td>
                            <?php
                            if($application['approved'] == 'Y') {
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
                        <td><?php echo (!is_null($application['pickup_date'])) ? date('m/d/Y', strtotime($application['pickup_date'])) : ''; ?></td>
                        <td>
                            <input type="checkbox" name="applications[]" value="<?php echo $application['application_id']; ?>"
                            <?php echo (!is_null($application['pickup_date'])) ? ' disabled' : ''; ?>>
                        </td>
                    </tr>    
                <?php endforeach; ?>
                
                </tbody>
            </table>

            <button type="submit" class="btn btn-primary pull-right right-submit-button"><i class="fa fa-print"></i> Pickup Certificate(s)</button>
        </form>
    </div><!--/.container-->
</main>