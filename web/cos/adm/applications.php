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
    
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        $application_id     = $_GET['id'];
        $printed_name       = $_POST['printed_name'];
        
        // Format $approve_date and $pickup_date
        if(!empty($_POST['approve_date'])) {
            // Convert form input into time, then to db format
            $approve_date = strtotime($_POST['approve_date']);
            $approve_date = date('Y-m-d H:i:s', $approve_date);
        } else {
            $approve_date = NULL;
        }
        
        if(!empty($_POST['pickup_date'])) {
            $pickup_date = strtotime($_POST['pickup_date']);
            $pickup_date = date('Y-m-d H:i:s', $pickup_date);
        } else {
            $pickup_date = NULL;
        }
        
        // Update the application
        if(updateApplication($application_id, $printed_name, $approve_date, $pickup_date)) {
            $success = 'Updated the application';
        } else {
            $error = 'There was a problem updating the application';
        }
    }
    
    $application    = getApplication($_GET['id']);
    $student        = getStudent($application['student_id']);
    $certificate    = getCertificate($application['program_id']);
    
    include('view/application_edit.php');
    
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
    
    $datatables = true;
    $error = '';
    
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        foreach($_POST['approved'] as $cert) {
            if(!approveApplication($cert)) {
                $error .= $cert . ', ';
            }
            // TODO: Send email to each student that was approved
        }
        
        if(empty($error)) {
            $success = 'Updated all newly approved applications';
        }
    }
    include('view/application_approve.php');

// Certificate lookup for when students pickup certificates
} else if(isset($_GET['id']) && $_GET['id'] == 'pickup') {
    
    $datatables = true;
    $error = '';
    
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        foreach($_POST['applications'] as $app) {
            if(!pickupCertificate($app)) {
                $error .= $app . ', ';
            }
        }
        
        if(empty($error)) {
            $success = 'Picked up the application(s)';
        }
    }
    
    include('view/application_pickup.php');

// Delete an application
} else if(isset($_GET['id']) && $_GET['id'] == 'delete') {
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $application_id = $_POST['delete'];
        
        if(deleteApplication($application_id)) {
            // TODO:
        }   
    }

// List all applications
} else {
    $datatables = true;
    $applications = getApplications();
    
    include('view/application_list.php');
}

include('view/footer.php');
?>