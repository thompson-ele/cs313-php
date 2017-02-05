<?php
//*********************************************************************************
//*                         VIEW/APPLICATION_APPROVE.PHP
//*                Allows admin to view approve any new applications
//*********************************************************************************
?>
<main>
    <div class="container">
        <h1>Approve Applications</h1>
        <a class="btn btn-default" href="applications.php">Go Back to List of Applications</a>
        
        <form action="applications.php?id=approve" method="POST">
        <table class="table table-bordered">
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
        <input type="submit" value="Approve these applications">
        </form>
        
    </div><!--/.container-->
</main>