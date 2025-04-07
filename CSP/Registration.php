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

// Retrieve form data
$Uname = $_POST['username'];
$Password =$_POST['password']; // Hash the password
$type = $_POST['type'];

// Set default values for dynamic fields
$name = $location = $contact_number = $additional_info = "";

try {
    // Assign values based on the type
    if ($type === "Restaurant") {
        $name = $_POST['Restaurant_Name'];
        $location = $_POST['Location'];
        $contact_number = $_POST['Mobile_Number'];
        $additional_info = $_POST['Opening_Hours'];
    } elseif ($type === "Function_Hall") {
        $name = $_POST['Function_Hall_Name'];
        $location = $_POST['Location'];
        $contact_number = $_POST['Mobile_Number'];
        $additional_info = $_POST['Seating_Capacity'];
    } elseif ($type === "Orphan_Home") {
        $name = $_POST['Orphan_Home_Name'];
        $location = $_POST['Location'];
        $contact_number = $_POST['Mobile_Number'];
        $additional_info = $_POST['Number_of_Children'];
    }
} catch (Exception $e) {
    echo "Error in taking values: " . $e->getMessage();
    exit; // Exit the script if there is an error
}

// Insert data into the database
$sql = "INSERT INTO register 
        (username, password, type, name, location, contact_number, additional_info) 
        VALUES 
        ('$Uname', '$Password', '$type', '$name', '$location', '$contact_number', '$additional_info')";

// Execute the query
$results = mysqli_query($conn, $sql);

// Check if the query was successful
if ($results) {
    echo "Record successfully added";
} else {
    echo "Error in inserting values: " . mysqli_error($conn);
}

echo "<br><br><a href='main.html' style='padding: 10px 20px; background-color: #007BFF; color: white; text-decoration: none; border-radius: 5px;'>Home</a>";


// Close connection
mysqli_close($conn);
?>