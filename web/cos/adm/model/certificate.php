<?php
function getCertificates()
    {
        include("database.php");

        try {
            $query =    "SELECT *
    			        FROM program
    			        WHERE program_type_id = 2 AND
    					      active_flag = 'A'
    			        ORDER BY program_name";
            return $db->query($query);
        } catch(Exception $e) {
            echo "Error!: " . $e->getMessage() . "<br>"   ;
            return false;
        }
        
    }

function getCertificate($certificate_id)
    {
        include ("database.php");
        
        $sql = "SELECT * FROM program
                WHERE program_id = ?";
        
        try {
            // Create a prepared statement
            $results = $db->prepare($sql);
            
            // Bind values to the statement
            $results->bindValue(1, $certificate_id, PDO::PARAM_INT);
            $results->execute();
        } catch(Exception $e) {
            echo "Error!: " . $e->getMessage() . "<br>"   ;
            return false;
        }
        
        return $results->fetch();
    }

?>