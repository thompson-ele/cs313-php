<?php
//*********************************************************************************
//*                         VIEW/APPLICATION_EDIT.PHP
//*                Allows admin to edit an existing application
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
        
        <div class="col-sm-offset-2">
            <h1><i class="fa fa-pencil text-primary"></i> Edit Application</h1>
        </div>

        <form action="applications.php?id=<?php echo $application['application_id']; ?>" method="POST" class="form-horizontal">
            
            <div class="form-group">
                <label for="printed_name" class="control-label col-sm-2">Name As Printed on Certificate:</label>
                <div class="col-sm-8">
                    <input type="text" id="printed_name" name="printed_name" class="form-control" value="<?php echo $application['printed_name']; ?>">
                </div>
            </div>
            
            <div class="form-group">
                <label for="approve_date" class="control-label col-sm-2">Approved Date:</label>
                <div class="col-sm-8">
                    <input type="date" id="approve_date" name="approve_date" class="form-control" value="<?php if(!is_null($application['approve_date'])) { echo date('Y-m-d', strtotime($application['approve_date']));} ?>">
                </div>
            </div>
            
            <div class="form-group">
                <label for="pickup_date" class="control-label col-sm-2">Pickup Date:</label>
                <div class="col-sm-8">
                    <input type="date" id="pickup_date" name="pickup_date" class="form-control" value="<?php if(!is_null($application['pickup_date'])) { echo date('Y-m-d', strtotime($application['pickup_date']));} ?>">
                </div>
            </div>
            
            <div class="col-sm-offset-2">
                <div class="row">
                    <div class="col-md-4">
                        <p><span class="bold-text">Student ID #:</span> <?php echo $student['student_id']; ?></p>
                        <p><span class="bold-text">Student Name:</span> <?php echo $student['first_name'].' '.$student['last_name']; ?></p>
                        <p><span class="bold-text">Certificate Name:</span> <?php echo $certificate['program_name']; ?></p>
                        <p><span class="bold-text">Submitted On:</span> <?php echo date('m/d/Y', strtotime($application['submit_date'])); ?></p>
                    </div>
                    
                    <div class="col-md-8">
                        <p><span class="bold-text">Comments:</span> <?php echo $application['comments']; ?></p>
                    </div>
                </div><!--/.row-->
                
                <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Update Application</button>
            </div><!--/.col-sm-offset-2-->
        </form>
        
        <form action="applications.php?id=delete" method="POST" class="col-sm-offset-2">
            <input type="hidden" name="delete" value="<?php echo $application['application_id']; ?>">
            <button type="submit" class="btn btn-danger button-margin"><i class="fa fa-trash"></i> Delete Application</button>
        </form>
    </div><!--/.container-->
</main>