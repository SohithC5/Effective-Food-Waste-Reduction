<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Storage</title>
    <style>
        /* Page background */
        body {
            background-color: #f2f2f2;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        /* Navigation buttons */
        .nav-buttons {
            display: flex;
            justify-content: flex-end;
            margin: 20px;
        }

        .nav-buttons a {
            text-decoration: none;
            padding: 10px 20px;
            background-color: #333;
            color: white;
            font-weight: bold;
            border-radius: 5px;
            margin-left: 10px;
            transition: background-color 0.3s;
        }

        .nav-buttons a:hover {
            background-color: #555;
        }

        /* Center table container */
        .table-container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            min-height: 70vh;
            width: 100%;
        }

        /* Table styling */
        table {
            border-collapse: collapse;
            width: 80%;
            max-width: 800px;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            overflow: hidden;
        }

        th, td {
            padding: 12px 15px;
            border: 1px solid #ddd;
            text-align: center;
        }

        th {
            background-color: #333;
            color: #ffffff;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #e0e0e0;
        }

        /* Reservation details styling */
        .reservation-details {
            width: 80%;
            max-width: 800px;
            background-color: #fff;
            border: 1px solid #ddd;
            padding: 20px;
            margin-top: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
    <script>
        // Function to handle the "Add to Cart" button click
        function addToCart(username, mobileNumber) {
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "reserve.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // Update the reservation details section with the server response
                    document.getElementById("reservation-details").innerHTML = xhr.responseText;

                    // Optional: Remove the row from the table (this can be done by targeting the specific row in the table)
                    const row = document.getElementById(username + '-' + mobileNumber);
                    if (row) {
                        row.remove();
                    }
                } else if (xhr.readyState == 4) {
                    document.getElementById("reservation-details").innerHTML = "Error: Could not complete reservation.";
                }
            };
            xhr.send("username=" + encodeURIComponent(username) + "&mobile_number=" + encodeURIComponent(mobileNumber));
        }
    </script>
</head>
<body>

<!-- Navigation Buttons -->
<div class="nav-buttons">
    <a href="main.html">Home</a>
    <a href="LoginR.html">Login</a>
    <a href="Registration.html">Register</a>
</div>

<div class="table-container">
    <?php
    $conn = mysqli_connect("localhost", "root", "", "csp");

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT Username, Type, location, Mobile_Number, Type_food FROM storing";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        echo "<table>";
        echo "<tr><th>Username</th><th>Type</th><th>Location</th><th>Mobile Number</th><th>Type of Food</th><th>Action</th></tr>";
        
        while($row = mysqli_fetch_assoc($result)) {
            echo "<tr id='" . htmlspecialchars($row['Username']) . "-" . htmlspecialchars($row['Mobile_Number']) . "'>";
            echo "<td>" . htmlspecialchars($row['Username']) . "</td>";
            echo "<td>" . htmlspecialchars($row['Type']) . "</td>";
            echo "<td>" . htmlspecialchars($row['location']) . "</td>";
            echo "<td>" . htmlspecialchars($row['Mobile_Number']) . "</td>";
            echo "<td>" . htmlspecialchars($row['Type_food']) . "</td>";
            echo "<td><button onclick=\"addToCart('" . htmlspecialchars($row['Username']) . "', '" . htmlspecialchars($row['Mobile_Number']) . "')\">Add to Cart</button></td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No data found.</p>";
    }

    mysqli_close($conn);
    ?>
</div>

<!-- Reservation Details Container -->
<div id="reservation-details" class="reservation-details"></div>

</body>
</html>
