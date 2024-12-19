<?php
// Database connection using PDO
$host = 'localhost'; // MySQL server
$dbname = 'tasks'; // Database name
$username = 'mae'; // MySQL username (default in XAMPP is 'root')
$password = 'almonia12345'; // MySQL password (default is empty for XAMPP)

try {
    // Establish a PDO connection
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Enable exception mode for error handling
} catch (PDOException $e) {
    // Catch any connection errors
    echo "Connection failed: " . $e->getMessage();
}
?>
