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

// Handle delete request
if (isset($_POST['delete'])) {
    $slot_id = $_POST['slot_id'];
    $delete_sql = "DELETE FROM booked_slots WHERE slot_id = ?";
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param("i", $slot_id);
    $stmt->execute();
    $stmt->close();
}

// Handle new reservation submission
if (isset($_POST['add'])) {
    $slot_id = $_POST['new_slot_id'];
    $booking_time = $_POST['booking_time'];
    $insert_sql = "INSERT INTO booked_slots (slot_id, booking_time) VALUES (?, ?)";
    $stmt = $conn->prepare($insert_sql);
    $stmt->bind_param("is", $slot_id, $booking_time);
    $stmt->execute();
    $stmt->close();
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
        /* Black and White Theme */
        body {
            background-color: #000; /* Black background */
            color: #fff; /* White text */
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #1a1a1a; /* Dark grey container background */
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.1);
        }

        h1, h3 {
            color: #fff;
            text-align: center;
        }

        form {
            margin: 20px 0;
        }

        input[type="text"], input[type="datetime-local"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #333;
            border-radius: 5px;
            background-color: #333; /* Dark input background */
            color: #fff; /* White text */
        }

        input[type="submit"] {
            padding: 10px 20px;
            background-color: #fff; /* White button */
            color: #000; /* Black text */
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }

        input[type="submit"]:hover {
            background-color: #f0f0f0; /* Lighter hover effect */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #444;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #333; /* Dark header background */
        }

        td {
            background-color: #222; /* Darker row background */
        }

        td form input[type="submit"] {
            background-color: #ff4d4d; /* Red delete button */
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
        }

        td form input[type="submit"]:hover {
            background-color: #ff1a1a; /* Darker red on hover */
        } 
    </style>
</head>
<body>

    <div class="container">
        <h1>Admin Dashboard</h1>
        <h3>View and Manage Booked Parking Slots</h3>

        <!-- Add New Reservation Form -->
        <form method="POST">
            <h3>Add New Reservation</h3>
            <input type="text" name="new_slot_id" placeholder="Enter Slot ID" required>
            <input type="datetime-local" name="booking_time" placeholder="Booking Time" required>
            <input type="submit" name="add" value="Add Reservation">
        </form>

        <?php if ($result->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Slot ID</th>
                        <th>Booking Time</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['slot_id']; ?></td>
                            <td><?php echo $row['booking_time']; ?></td>
                            <td>
                                <form method="POST">
                                    <input type="hidden" name="slot_id" value="<?php echo $row['slot_id']; ?>">
                                    <input type="submit" name="delete" value="Delete">
                                </form>
                            </td>
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
