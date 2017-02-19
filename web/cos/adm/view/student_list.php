<?php
//*********************************************************************************
//*                             VIEW/STUDENT_LIST.PHP
//*               Lists all students (view for adm/students.php)
//*********************************************************************************
?>
<main>
    <div class="container">
        <a class="btn btn-primary" href="applications.php"><i class="fa fa-reply"></i> Back to All Applications</a>
        <h1><i class="fa fa-user icon-success"></i> Students</h1>
        <table class="table table-bordered data-table">
            <thead>
                <tr>
                    <th>Student ID #</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Number of Applications</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($students as $student): ?>
                <tr>
                    <td><?php echo $student['student_id']; ?></td>
                    <td><?php echo $student['first_name']; ?></td>
                    <td><?php echo $student['last_name']; ?></td>
                    <td><?php echo count(getApplications($student['student_id'])); ?></td>
                    <td><a class="btn btn-primary" href="students.php?id=<?php echo $student['student_id']; ?>"><i class="fa fa-pencil"></i></a></td>
                </tr>    
            <?php endforeach; ?>
            </tbody>
        </table>
    </div><!--/.container-->
</main>