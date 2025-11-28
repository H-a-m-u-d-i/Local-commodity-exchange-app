<?php
// Establish a database connection
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'db';


$conn = mysqli_connect($host, $username, $password, $database);

// Check if the connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>