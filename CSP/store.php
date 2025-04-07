<?php
$servername = "localhost"; // Replace with your database server
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "csp"; // Database name

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve form data and sanitize
$user_name = mysqli_real_escape_string($conn, $_POST['UName']);
$types = mysqli_real_escape_string($conn, $_POST['Type']);
$passwo = mysqli_real_escape_string($conn, $_POST['Pass']);

// SQL query to count matching records
$sql = "SELECT COUNT(username) AS user_count FROM register WHERE username='$user_name' AND password='$passwo' AND type='$types'";
$result = mysqli_query($conn, $sql);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    if ($row['user_count'] > 0) {
        // Redirect to another page if login is successful
        header('Location: Food_Donation.html');
        exit(); // Ensures no further code is executed
    } else {
        echo "<script>alert('Error in username or password');</script>";
    }
} else {
    echo "Error in query: " . mysqli_error($conn);
}

// Close connection
mysqli_close($conn);
?>
