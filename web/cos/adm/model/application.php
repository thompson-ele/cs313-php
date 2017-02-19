<?php
# model/application.php
# These functions are related to interactions with the
# application table in the database

function addApplication($student_id, $printed_name, $program_id, $comments)
    {   include("database.php");
        
        // Confirm this is not a duplicate application
        $sql = "SELECT * FROM application
                WHERE student_id = ?
                AND program_id = ?";
        $check = $db->prepare($sql);
        $check->bindValue(1, $student_id, PDO::PARAM_INT);
        $check->bindValue(2, $program_id, PDO::PARAM_INT);
        $check->execute();
        
        // If this is not a duplicate application, INSERT into the database
        if(empty($check->fetchAll())) {
            try {
                $sql = "INSERT INTO application (student_id, printed_name, program_id, comments)
                        VALUES(?, ?, ?, ?)";
                        
                $result = $db->prepare($sql);
                $result->bindValue(1, $student_id, PDO::PARAM_INT);
                $result->bindValue(2, $printed_name, PDO::PARAM_STR);
                $result->bindValue(3, $program_id, PDO::PARAM_INT);
                $result->bindValue(4, $comments, PDO::PARAM_STR);
                $result->execute();
            } catch(Exception $e) {
                echo "Error!: ".$e->getMessage()."<br>";
                return false;
            }
            return true;
        } else {
            return false;
        }

    }
    
# Return true if successful    
function approveApplication($application_id)
    {   include("database.php");
    
        try {
            $sql = "UPDATE application
                    SET approved = 'Y', approve_date = ?
                    WHERE application_id = ?";
            
            $results = $db->prepare($sql);
            $results->bindValue(1, date("Y-m-d H:i:s"), PDO::PARAM_STR);
            $results->bindValue(2, $application_id, PDO::PARAM_INT);
            $results->execute();
        } catch(Exception $e) {
            echo "Error!: " . $e->getMessage() . "<br>";
            return false;
        }
        return true;
    }

# Return all applications, or applications based on student_id number
function getApplications($student_id = null, $filter = null)
    {   include("database.php");
        
        $sql = "SELECT * FROM application";
        
        try {
            // If the OPTIONAL student_id parameter is used
            // Query for all applications based on student_id
            if(!is_null($student_id)) {
                $sql .= " WHERE student_id = ?";
                        
                $results = $db->prepare($sql);
                $results->bindValue(1, $student_id, PDO::PARAM_INT);
                $results->execute();
            
            // Query for all applications based on filter
            // Approved, Unapproved
            } else if (!is_null($filter)) {
                switch($filter) {
                    case 'approved':    $sql .= " WHERE approved = 'Y' ORDER BY submit_date";
                        break;
                    case 'unapproved':  $sql .= " WHERE approved = 'N' ORDER BY approve_date ASC";
                        break;
                    case 'pickup':      $sql .= " WHERE approved = 'Y' ORDER BY pickup_date DESC";
                        break;
                    default:            $sql .= "";
                }
                
                return $db->query($sql);
                
            // else Query and return all applications   
            } else {
                return $db->query("SELECT * FROM application");
            }
            
        } catch(Exception $e) {
            echo "Error!: " . $e->getMessage() . "<br>"   ;
            return false;
        }
        
        return $results->fetchAll();
    }

function getApplication($application_id)
    {
        include ("database.php");
        
        $sql = "SELECT * FROM application WHERE application_id = ?";
        
        try {
            // Create a prepared statement
            $results = $db->prepare($sql);
            
            // Bind values to the statement
            $results->bindValue(1, $application_id, PDO::PARAM_INT);
            $results->execute();
        } catch(Exception $e) {
            echo "Error!: " . $e->getMessage() . "<br>"   ;
            return false;
        }
        
        return $results->fetch();
    }

function submitApplication($student_id, $first_name, $last_name, $email, $printed_name, $program_id, $comments)
    {
       // Function requires model/certificate.php
       // and model/student.php
       
       // Check if the student exists in the database
       $student = getStudent($student_id);
        if(empty($student)) {
            // If they don't, add them to the database
            if(!addStudent($student_id, $first_name, $last_name, $email)) {
                // Student couldn't be added to the database
                return "We were unable to add you to our database. Please check your information and try again";
            }
        } //else { TODO: Do we want the student to be able to update their information in a later application
            // UPDATE student record
        //}
        
        if(!addApplication($student_id, $printed_name, $program_id, $comments)) {
            // Couldn't add application to the database
            return "You've already applied for this certificate.";
        }

        return true;
    }
    
function getNotPickedUpCertificates()
    {   include("database.php");
    
        try {
            $sql = "SELECT application.*, first_name, last_name
                    FROM application, student
                    WHERE application.student_id = student.student_id 
                    AND approved = 'Y'
                    AND pickup_date IS NULL";
            return $db->query($sql);
        } catch(Exception $e) {
            echo "Error!: " . $e->getMessage() . "<br>"   ;
            return false;
        }
        
    }
    
function pickupCertificate($application_id)
    {   include("database.php");
    
        try {
            $sql = "UPDATE application
                    SET pickup_date = ?
                    WHERE application_id = ?";
            
            $results = $db->prepare($sql);       
            $results->bindValue(1, date("Y-m-d H:i:s"), PDO::PARAM_STR);
            $results->bindValue(2, $application_id, PDO::PARAM_INT);
            $results->execute();
        } catch(Exception $e) {
            echo "Error!: " . $e->getMessage() . "<br>"   ;
            return false;
        }
        
        return true;
    }

# Certain values should not be updateable
# Only update values should be printed_name, approve_date, and pickup_date
function updateApplication($application_id, $printed_name, $approve_date, $pickup_date)
    {   include("database.php");
        
        try {
            $sql = "UPDATE application
                    SET printed_name = ?,
                        approve_date = ?,
                        pickup_date = ?";
                        
            // If approve_date is being updated, also update approved column to Y
            if($approve_date !== NULL) {
            $sql .= ", approved = 'Y' ";
            } else {
            $sql .= ", approved = 'N' ";
            }
                  
            $sql .= "WHERE application_id = ?";
            
            // Set $approve_date and $pickup_date to NULL values instead of empty
            $approve_date = ($approve_date == '' ? NULL : $approve_date);
            $pickup_date = ($pickup_date == '' ? NULL : $pickup_date);
            
            $results = $db->prepare($sql);
            $results->bindValue(1, $printed_name, PDO::PARAM_STR);
            $results->bindValue(2, $approve_date); // TODO: Format date? Here or before
            $results->bindValue(3, $pickup_date);  // TODO: Format date? Here or before
            $results->bindValue(4, $application_id, PDO:: PARAM_INT);
            $results->execute();
            
        } catch(Exception $e) {
            echo "Error!: " . $e->getMessage() . "<br>"   ;
            return false;
        }
        
        return true;
    }

# Deletes application from the database
# TODO: On live server change to update of active_flag
function deleteApplication()
    {   include("database.php");
        
        try {
            
        } catch(Exception $e) {
            echo "Error!: " . $e->getMessage() . "<br>"   ;
            return false;
        }
    }
?>