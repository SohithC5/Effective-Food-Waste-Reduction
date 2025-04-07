<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data from Register Table</title>
    <style>
        /* Basic reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Body styling */
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #8ec5fc, #e0c3fc);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 20px;
        }

        /* Container for the table */
        .table-container {
            width: 80%;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            padding: 20px;
            position: relative;
        }

        /* Navigation buttons */
        .nav-buttons {
            position: absolute;
            top: 10px;
            right: 10px;
        }

        .nav-buttons a {
            text-decoration: none;
            color: #007BFF;
            font-weight: bold;
            margin-left: 15px;
            padding: 8px 12px;
            border: 1px solid #007BFF;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .nav-buttons a:hover {
            background-color: #007BFF;
            color: #ffffff;
        }

        /* Table styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #007BFF;
            color: #ffffff;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f7f8fa;
        }

        tr:hover {
            background-color: #eef7ff;
        }
    </style>
</head>
<body>
    <div class="table-container">
        <!-- Navigation Buttons -->
        <div class="nav-buttons">
            <a href="home.php">Home</a>
            <a href="login.php">Login</a>
        </div>

        <h2>Data from Register Table</h2>
        
        <!-- PHP code to fetch and display data -->
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "csp";

        try {
            // Create a new connection to the csp database
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Prepare and execute the query
            $stmt = $conn->prepare("SELECT username, password, type, name, location, contact_number, additional_info FROM register");
            $stmt->execute();

            // Check if there are any rows to display
            if ($stmt->rowCount() > 0) {
                echo "<table>";
                echo "<tr>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Type</th>
                        <th>Name</th>
                        <th>Location</th>
                        <th>Contact Number</th>
                        <th>Additional Info</th>
                      </tr>";

                // Fetch and display each row of data
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['username']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['password']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['type']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['location']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['contact_number']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['additional_info']) . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "<p>No data found in the register table.</p>";
            }
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        $conn = null; // Close the connection
        ?>
    </div>
</body>
</html>
