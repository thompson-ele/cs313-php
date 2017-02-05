<?php
//*********************************************************************************
//*                             VIEW/APPLICATION_LIST.PHP
//*                     Allows admin to view all applications
//*********************************************************************************
?>
<main>
    <div class="container">
        <h1>All Applications</h1>
        <a class="btn btn-default" href="applications.php?id=new">Add a New Application</a>
        <a class="btn btn-default" href="applications.php?id=approve">Approve Applications</a>
        <a class="btn btn-default" href="applications.php?id=pickup">Pick Up Certificate</a>

        <h2>Unapproved Applications</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Last Name</th>
                    <th>First Name</th>
                    <th>Student ID</th>
                    <th>Certificate Name</th>
                    <th>Date Submitted</th>
                    <th>Approved?</th>
                    <th>Picked Up?</th>
                    <th></th>
                    <th></th>
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
                    <td><span class="label label-danger"><?php echo $application['approved']; ?></span></td>
                    <td><?php echo (is_null($application['pickup_date'])) ? 'N' : 'Y'; ?></td>
                    <td><a class="btn btn-primary" href="applications.php?id=<?php echo $application['application_id']; ?>"><i class="fa fa-pencil"></i></a></td>
                    <td><a class="btn btn-danger"><i class="fa fa-trash"></i></a></td>
                </tr>    
            <?php endforeach; ?>
            </tbody>
        </table>
        
        <h2>Approved Applications</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Last Name</th>
                    <th>First Name</th>
                    <th>Student ID</th>
                    <th>Certificate Name</th>
                    <th>Date Submitted</th>
                    <th>Approved?</th>
                    <th>Picked Up?</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?php foreach(getApplications(null, 'approved') as $application): ?>
                <tr>
                    <td><?php echo getStudent($application['student_id'])['last_name']; ?></td>
                    <td><?php echo getStudent($application['student_id'])['first_name']; ?></td>
                    <td><?php echo $application['student_id']; ?></td>
                    <td><?php echo getCertificate($application['program_id'])['program_name']; ?></td>
                    <td><?php echo $application['submit_date']; ?></td>
                    <td><span class="label label-success"><?php echo $application['approved']; ?></span></td>
                    <td><?php echo (is_null($application['pickup_date'])) ? 'N' : 'Y'; ?></td>
                    <td><a class="btn btn-primary" href="applications.php?id=<?php echo $application['application_id']; ?>"><i class="fa fa-pencil"></i></a></td>
                    <td><a class="btn btn-danger"><i class="fa fa-trash"></i></a></td>
                </tr>    
            <?php endforeach; ?>
            </tbody>
        </table>
        
        

    </div><!--/.container-->
</main>