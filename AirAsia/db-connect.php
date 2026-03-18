<?php
// Database connection settings
$hn = 'localhost:3306';
$db = 'rewards';
$un = 'root';
$pw = 'root'; // Use 'root' for MAMP

// Create connection
$conn = new mysqli($hn, $un, $pw, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
