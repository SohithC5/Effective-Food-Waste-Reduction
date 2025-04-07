<?php 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "csp";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$Username = $_POST['Name'];
$Types = $_POST['Type'];
$Location = $_POST['loc'];
$Mobile_Number = $_POST['M_number'];
$Type_food = $_POST['T_food'];

// Prepare SQL statement with quotes around variables
$sql1 = "INSERT INTO storing (Username, Type, location, Mobile_Number, Type_food) VALUES ('$Username', '$Types', '$Location', '$Mobile_Number', '$Type_food')";
$res = mysqli_query($conn, $sql1);

// Check if insertion was successful
if ($res) {
    echo "Data has been inserted";
} else {
    echo "Error in updating values: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
