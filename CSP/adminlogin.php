<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "csp";

$NAME = $_POST['UName'];
$PASSWORD = $_POST['Pass'];
$HOME_Name = $_POST['OName'];

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT COUNT(*) as count FROM register WHERE (username='$NAME' AND password='$PASSWORD' AND name='$HOME_Name')";

$res = mysqli_query($conn, $sql);

if ($res) {
    $row = mysqli_fetch_assoc($res);  // Fetch the result as an associative array
    if ($row['count'] > 0) {
            header('Location: Retrive.php');
    } else {
        echo "Error in login: Incorrect username, password, or home name.";
    }
} else {
    echo "Error in query execution: " . mysqli_error($conn);
}

// Close the connection
mysqli_close($conn);
?>
