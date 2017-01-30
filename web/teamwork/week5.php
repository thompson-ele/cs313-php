<?php
function getScriptures() {// Query for all scriptures

    // Connect to the database
    require('database.php');
    
    try {
        $query = "SELECT *
                  FROM cs313_scriptures";
        return $db->query($query);
    } catch (Exception $e) {
        echo "Error!: " . $e->getMessage() . "<br>";
        return false;
    }
}
?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>CS 313 Team Assignment | Week 5</title>
    </head>
    
    <body>
        <h1>Scripture Resources</h1>
        <?php 
        $scriptures = getScriptures();
        
        foreach($scriptures as $scripture) {
        
        $reference = $scripture['book'] .' '. $scripture['chapter'] .':'. $scripture['verse'];
        
        echo '<p><b>'.$reference.'</b> - "'.$scripture['content'].'"</p>';
        
        } ?>
    </body>
</html>