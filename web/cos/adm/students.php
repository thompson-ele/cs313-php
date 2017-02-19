<?php
//*********************************************************************************
//*                             STUDENTS.PHP
//*             Lists all students unless a $_GET['id'] is set
//*      Updates student information if $_GET['id'] is set and $_POST data
//*********************************************************************************

include('model/student.php');
include('model/application.php');
include('model/certificate.php');

include('view/header.php');
include('view/navbar.php');

if(isset($_GET['id']) && is_numeric($_GET['id'])) {
    // Display a single student - view/student.php
    
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Update student information
        $student_id     = $_POST['student_id'];
        $first_name     = $_POST['first_name'];
        $last_name      = $_POST['last_name'];
        $email          = $_POST['email'];
        
        if(updateStudent($student_id, $first_name, $last_name, $email)) {
            $success = 'Updated this student';
        } else {
            $error = 'There was a problem updating this student';
        }
    }
    
    // Get student information
    $student = getStudent($_GET['id']);
    // Get all applications for this student
    $applications = getApplications($_GET['id']);
    
    include('view/student.php');
} else {
    // Display all students - view/student_list.php
    $students = getStudents();
    $datatables = true;
    
    include('view/student_list.php');
}


include('view/footer.php');
?>