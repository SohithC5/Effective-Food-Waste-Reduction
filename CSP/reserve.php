<?php
// reserve.php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Connect to the database
    $conn = mysqli_connect("localhost", "root", "", "csp");
    
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Retrieve the parameters sent via AJAX
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $mobile_number = mysqli_real_escape_string($conn, $_POST['mobile_number']);

    // Delete the record from the database
    $sql = "DELETE FROM storing WHERE Username = '$username' AND Mobile_Number = '$mobile_number'";

    if (mysqli_query($conn, $sql)) {
        // Fetch the details to return to the frontend
        $details = "Reserved by: " . htmlspecialchars($username) . "<br>";
        $details .= "Mobile: " . htmlspecialchars($mobile_number) . "<br>";
        $details .= "Status: Reservation Confirmed!";
        
        // Return the reserved details as response
        echo $details;
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
