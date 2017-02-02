<?php

// default Heroku Postgres configuration URL
$dbUrl = getenv('DATABASE_URL');

if (empty($dbUrl)) {
 // If accessing the database not on Heroku, use this config
 $dbUrl = "postgres://qebkqyxiqvsflj:c86156bcaa1172bc179daf4520f42a0549552cbe0de6ab44c9804f53e95af2a9@ec2-54-163-253-94.compute-1.amazonaws.com:5432/d2nre3mi3v2jrs";
}

$dbopts = parse_url($dbUrl);


$dbHost = $dbopts["host"];
$dbPort = $dbopts["port"];
$dbUser = $dbopts["user"];
$dbPassword = $dbopts["pass"];
$dbName = ltrim($dbopts["path"],'/');


// Create PDO object
try {
    $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);
    // Sets PDO Error Mode, all errors are converted to Exceptions
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
    echo $e->getMessage();
    die();
}
?>