<?php
$servername = "localhost"; // Replace with your database server
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password

try {
    // Create a connection
    $conn = new PDO("mysql:host=$servername", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Create database if it doesn't exist
    $conn->exec("CREATE DATABASE IF NOT EXISTS csp");
    echo "Database created successfully.<br>";

    // Connect to the csp database
    $conn->exec("use csp");

    // Create the register table
    $sql = "CREATE TABLE register (
        username VARCHAR(20),
        password VARCHAR(20),
        type VARCHAR(20),
        name VARCHAR(20),
        location VARCHAR(20),
        contact_number VARCHAR(20),
        additional_info VARCHAR(20) NULL
    )";

    $conn->exec($sql);
    echo "Table 'register' created successfully.<br>";

} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null; // Close the connection
?>
