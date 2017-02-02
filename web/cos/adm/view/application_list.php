<?php
//*********************************************************************************
//*                             VIEW/APPLICATION_LIST.PHP
//*                     Allows admin to view all applications
//*********************************************************************************
?>
<main>
    <div class="container">
        <h1>All Applications</h1>
        <a href="applications.php?id=new">Add a New Application</a>

        <h2>Unapproved Applications</h2>
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
            <?php foreach(getApplications(null, 'unapproved') as $application): ?>
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
        
        <h2>Approved Applications</h2>
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
            <?php foreach(getApplications(null, 'approved') as $application): ?>
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
        
        

    </div><!--/.container-->
</main>