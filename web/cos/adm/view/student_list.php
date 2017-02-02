<?php
//*********************************************************************************
//*                             VIEW/STUDENT_LIST.PHP
//*               Lists all students (view for adm/students.php)
//*********************************************************************************
?>
<main>
    <div class="container">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Student ID #</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Number of Applications</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($students as $student): ?>
                <tr>
                    <td><a href="students.php?id=<?php echo $student['student_id']; ?>"><?php echo $student['student_id']; ?></a></td>
                    <td><?php echo $student['first_name']; ?></td>
                    <td><?php echo $student['last_name']; ?></td>
                    <td><?php echo count(getApplications($student['student_id'])); ?></td>
                </tr>    
            <?php endforeach; ?>
            </tbody>
        </table>
    </div><!--/.container-->
</main>