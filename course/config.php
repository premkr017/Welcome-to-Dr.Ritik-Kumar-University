<?php
// DATABASE CONNECTION SETTINGS

$host     = "localhost";   // Database host
$user     = "root";        // Database username
$password = "";            // Database password
$database = "Dr_Ritik_kumar_university";  // Database name

// CREATE CONNECTION
$conn = mysqli_connect($host, $user, $password, $database);

// CHECK CONNECTION
if (!$conn) {
    die("Database Connection Failed: " . mysqli_connect_error());
}
?>
