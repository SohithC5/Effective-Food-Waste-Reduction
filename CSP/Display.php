<?php
// Database connection details
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

// SQL query to retrieve all data from the 'register' table
$sql = "SELECT * FROM register";
$result = mysqli_query($conn, $sql);

echo "<h2 class='title'>Contact Information</h2>";

if (mysqli_num_rows($result) > 0) {
    echo "<table class='data-table'>";
    echo "<tr class='table-header'>
            <th>Username</th>
            <th>Type</th>
            <th>Name</th>
            <th>Location</th>
            <th>Contact Number</th>
            <th>Additional Info</th>
          </tr>";
    
    // Fetch and display each row of data with alternating background colors
    $row_count = 0;
    while($row = mysqli_fetch_assoc($result)) {
        $row_color = ($row_count % 2 == 0) ? "#f2f2f2" : "#ffffff"; // Alternating row colors
        echo "<tr class='table-row' style='background-color: $row_color;'>
                <td>" . htmlspecialchars($row['username']) . "</td>
                <td>" . htmlspecialchars($row['type']) . "</td>
                <td>" . htmlspecialchars($row['name']) . "</td>
                <td>" . htmlspecialchars($row['location']) . "</td>
                <td>" . htmlspecialchars($row['contact_number']) . "</td>
                <td>" . htmlspecialchars($row['additional_info']) . "</td>
              </tr>";
        $row_count++;
    }
    echo "</table>";
} else {
    echo "<p class='no-data'>No data found in the register table.</p>";
}

// Close the connection
mysqli_close($conn);
?>

<!-- Home Button -->
<div class="home-button">
    <a href="main.html">Home</a>
</div>

<!-- CSS Styling -->
<style>
    /* General Body Styling */
    body {
        font-family: Arial, sans-serif;
        background-color: #f2f2f2;
        margin: 0;
        padding: 0;
    }

    /* Title Styling */
    .title {
        text-align: center;
        font-size: 2em;
        color: #333;
        margin-top: 30px;
    }

    /* Table Styling */
    .data-table {
        width: 80%;
        margin: 30px auto;
        border-collapse: collapse;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        background-color: #fff;
    }

    .table-header {
        background-color:#3a3f44;
        color: #fff;
        font-weight: bold;
        text-align: center;
    }

    .data-table th, .data-table td {
        padding: 12px;
        border: 1px solid #ddd;
        text-align: center;
    }

    .table-row:hover {
        background-color: #e0f2f1; /* Light teal on hover */
    }

    /* Home Button Styling */
    .home-button {
        text-align: center;
        margin-top: 30px;
    }

    .home-button a {
        text-decoration: none;
        padding: 10px 20px;
        background-color: #3a3f44;
        color: #fff;
        font-weight: bold;
        border-radius: 5px;
        font-size: 16px;
        transition: background-color 0.3s;
    }

    .home-button a:hover {
        background-color: #004d40;
    }

    /* Message Styling */
    .no-data {
        text-align: center;
        font-size: 1.2em;
        color: #ff5722;
    }
</style>
