<?php
//*********************************************************************************
//*                           APPLICATIONS.PHP
//*             Lists all applications sorted by approved/not approved
//*             Applications are listed in chronological order
//*********************************************************************************

include('model/certificate.php');
include('model/application.php');
include('model/student.php');

include('view/header.php');
include('view/navbar.php');

// $_GET id is an application_id
if(isset($_GET['id']) && is_numeric($_GET['id'])) {
    echo 'Individual application page';
    
// Add a new application    
} else if(isset($_GET['id']) && $_GET['id'] == 'new') {
    
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Get form data
        $first_name     = $_POST['first_name'];
        $last_name      = $_POST['last_name'];
        $student_id     = $_POST['student_id'];
        $email          = $_POST['email'];
        $printed_name   = $_POST['printed_name'];
        $program_id     = $_POST['program_id'];
        $addApplication = false;
        
        // Check if student is already in system
        if(getStudent($student_id)) { // Student is in the database
            $addApplication = true;
        } else {                      // Add the student to the database
            if(addStudent($student_id, $first_name, $last_name, $email)) {
                $addApplication = true;
            }
        }
        
        if($addApplication) {
            // Create the new application
            if(addApplication($student_id, $printed_name, $program_id, '')) {
                $success = 'Successfully added the application';
            } else {
                $error = 'There was a problem adding the application to the database. Double-check that this is not a duplicate certificate application for this student.';
            }
        } else {
            $error = 'There was a problem adding the student to the database. Please try again.';
        }
    }
    include('view/application_new.php');
    
// Approve applications
} else if(isset($_GET['id']) && $_GET['id'] == 'approve') {
    
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        foreach($_POST['approved'] as $cert) {
            approveApplication($cert);
            // TODO: Include validation for approval success/fail
            // TODO: Send email to each student that was approved
        }
    }
    include('view/application_approve.php');

// Certificate lookup for when students pickup certificates
} else if(isset($_GET['id']) && $_GET['id'] == 'pickup') {
    include('view/application_pickup.php');

// List all applications
} else {
    include('view/application_list.php');
}

include('view/footer.php');
?>