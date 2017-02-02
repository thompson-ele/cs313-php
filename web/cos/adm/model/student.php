<?php
# model/student.php
# These functions are related to interactions with the
# student table in the database

function getStudents()
    {
        include("database.php");
        
        try {
            return $db->query("SELECT * FROM student");
        } catch(Exception $e) {
            echo "Error!: " . $e->getMessage() . "<br>"   ;
            return false;
        }
    }

function getStudent($student_id)
    {
        include ("database.php");
        
        $sql = "SELECT * FROM student WHERE student_id = ?";
        
        try {
            // Create a prepared statement
            $results = $db->prepare($sql);
            
            // Bind values to the statement
            $results->bindValue(1, $student_id, PDO::PARAM_INT);
            $results->execute();
        } catch(Exception $e) {
            echo "Error!: " . $e->getMessage() . "<br>"   ;
            return false;
        }
        
        return $results->fetch();
    }

function addStudent($student_id, $first_name, $last_name, $email)
    {
        include("database.php");
        
        try {
            $sql = "INSERT INTO student (student_id, first_name, last_name, email)
                    VALUES (?, ?, ?, ?)";
        
            $result = $db->prepare($sql);
            $result->bindValue(1, $student_id, PDO::PARAM_INT);
            $result->bindValue(2, $first_name, PDO::PARAM_STR);
            $result->bindValue(3, $last_name, PDO::PARAM_STR);
            $result->bindValue(4, $email, PDO::PARAM_STR);
            $result->execute();
        } catch(Exception $e) {
            echo "Error!: ". $e->getMessage() . "<br>";
            return false;
        }
        
        return true;
    }

function deleteStudent($student_id)
    {
        // Function doesn't actually delete student, but inactivates their record
    }

function updateStudent($student_id, $first_name, $last_name, $email)
    {   include("database.php");
    
        try {
            $sql = "UPDATE student SET first_name = ?, last_name = ?, email = ?
                    WHERE student_id = ?";
                    
            $result = $db->prepare($sql);
            $result->bindValue(1, $first_name, PDO::PARAM_STR);
            $result->bindValue(2, $last_name, PDO::PARAM_STR);
            $result->bindValue(3, $email, PDO::PARAM_STR);
            $result->bindValue(4, $student_id, PDO::PARAM_INT);
            $result->execute();
        } catch(Exception $e) {
            echo "Error!: ". $e->getMessage() . "<br>";
            return false;
        }
        
        return true;
    }

?>