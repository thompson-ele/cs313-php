<?php
//*********************************************************************************
//*                         VIEW/APPLICATION_PICKUP.PHP
//*          Allows student workers to search for an existing application
//**               and mark them off as picked up once printed
//*********************************************************************************
?>
<main>
    <div class="container">
        <h1>Pickup Certificate</h1>
        
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Student ID</th>
                    <th>Name Printed on Certificate</th>
                    <th>Certificate Name</th>
                    <th>Approved?</th>
                    <th>Picked Up?</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?php foreach(getApplications(null, 'pickup') as $application): ?>
                <tr>
                    <td><?php echo $application['student_id']; ?></td>
                    <td><?php echo $application['printed_name']; ?></td>
                    <td><?php echo getCertificate($application['program_id'])['program_name']; ?></td>
                    <td>
                        <?php
                        if($application['approved'] == 'Y') {
                            echo '<span class="label label-success">'.$application['approved'].'</span>';
                        } else {
                            echo '<span class="label label-danger">'.$application['approved'].'</span>';
                        }
                        ?>
                    </td>
                    <td><?php echo (is_null($application['pickup_date'])) ? 'N' : 'Y'; ?></td>
                    <td><input type="checkbox"></a></td>
                </tr>    
            <?php endforeach; ?>
            </tbody>
        </table>
    </div><!--/.container-->
</main>