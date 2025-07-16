<!-- Please Login... -->
<?php

// Set connection variables
$server = 'localhost';
$username = 'root';
$password = '';
$database = 'project';

// Create database connection
$con = mysqli_connect($server, $username, $password, $database);

// Check for connection success
if (!$con)
 {
    die("Connection to database failed due to " . mysqli_connect_error());
}
?>
