<?php
// Database configuration
$servername = "localhost";  // Your database server
$username = "root";         // Your MySQL username
$password = "";             // Your MySQL password
$dbname = "parking_system"; // The name of the database you created

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch all booked slots
$sql = "SELECT slot_id, booking_time FROM booked_slots";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Booked Slots</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .header {
            background-color: #35424a;
            color: white;
            padding: 20px;
            text-align: center;
        }

        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        table th, table td {
            padding: 12px;
            border: 1px solid #dddddd;
            text-align: center;
        }

        table th {
            background-color: #35424a;
            color: white;
        }

        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        table tr:hover {
            background-color: #ddd;
        }

        .empty-message {
            text-align: center;
            font-size: 18px;
            color: red;
            margin-top: 20px;
        }

        footer {
            text-align: center;
            padding: 10px;
            background-color: #35424a;
            color: white;
            position: relative;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>Admin Dashboard</h1>
        <p>View Booked Parking Slots</p>
    </div>

    <div class="container">
        <?php if ($result->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Slot ID</th>
                        <th>Booking Time</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['slot_id']; ?></td>
                            <td><?php echo $row['booking_time']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="empty-message">No parking slots have been booked yet.</p>
        <?php endif; ?>
    </div>

    <footer>
        <p>&copy; 2024 Parking System</p>
    </footer>

<?php
// Close connection
$conn->close();
?>

</body>
</html>
