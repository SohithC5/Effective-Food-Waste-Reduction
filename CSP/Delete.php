<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "csp";

// Check if POST variables are set
if (isset($_POST['Name']) && isset($_POST['M_number'])) {
    $Name = $_POST['Name'];
    $Contact_Number = $_POST['M_number'];

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Sanitize inputs and use quotes around string values
    $Name = mysqli_real_escape_string($conn, $Name);
    $Contact_Number = mysqli_real_escape_string($conn, $Contact_Number);
    
    $sql = "DELETE FROM storing WHERE username='$Name' AND contact_number='$Contact_Number'";

    if (mysqli_query($conn, $sql)) {
        echo "Data deleted";
        header('Location: Retrive.php');
        exit(); // Add exit to ensure the redirect occurs properly
    } else {
        echo "Error in Opting the food: " . mysqli_error($conn);
    }

    // Close the connection
    mysqli_close($conn);
} else {
    echo "Name and Contact Number are required.";
}
?>
