<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Manage Reservations</title>
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

        input[type="text"], input[type="email"], input[type="number"], input[type="date"], input[type="time"] {
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
        <h1>Admin Dashboard - Manage Reservations</h1>

        <?php
        // Database connection
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "thegallerycafe"; // Change this to match your database name
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Add reservation
        if (isset($_POST['add_reservation'])) {
            $date = $_POST['r_date'];
            $time = $_POST['r_time'];
            $people = $_POST['r_people'];
            $name = $_POST['r_name'];
            $email = $_POST['r_email'];
            $phone = $_POST['r_phone'];

            // Insert new reservation into the database
            $sql = "INSERT INTO reservation (R_Date, R_Time, R_People, R_Name, R_Email, R_Phone) 
                    VALUES ('$date', '$time', '$people', '$name', '$email', '$phone')";

            if ($conn->query($sql) === TRUE) {
                echo "<p>New reservation added successfully.</p>";
            } else {
                echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
            }
        }

        // Delete reservation
        if (isset($_POST['delete_reservation'])) {
            $id = $_POST['id'];
            $sql = "DELETE FROM reservation WHERE R_Id='$id'";

            if ($conn->query($sql) === TRUE) {
                echo "<p>Reservation deleted successfully.</p>";
            } else {
                echo "<p>Error deleting reservation: " . $conn->error . "</p>";
            }
        }
        ?>

        <!-- Add reservation Form -->
        <h3>Add New Reservation</h3>
        <form method="POST" action="">
            Date: <input type="date" name="r_date" required><br>
            Time: <input type="time" name="r_time" required><br>
            Number of People: <input type="number" name="r_people" required><br>
            Name: <input type="text" name="r_name" required><br>
            Email: <input type="email" name="r_email" required><br>
            Phone: <input type="text" name="r_phone" required><br>
            <input type="submit" name="add_reservation" value="Add Reservation">
        </form>

        <!-- Display All Reservations -->
        <h3>Current Reservations</h3>
        <table>
            <tr>
                <th>ID</th>
                <th>Date</th>
                <th>Time</th>
                <th>People</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Action</th>
            </tr>
            <?php
            // Fetch all reservations from the 'reservation' table
            $sql = "SELECT * FROM reservation";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Output each reservation as a table row
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['R_Id']}</td>
                            <td>{$row['R_Date']}</td>
                            <td>{$row['R_Time']}</td>
                            <td>{$row['R_People']}</td>
                            <td>{$row['R_Name']}</td>
                            <td>{$row['R_Email']}</td>
                            <td>{$row['R_Phone']}</td>
                            <td>
                                <form method='POST' action='' style='display:inline;'>
                                    <input type='hidden' name='id' value='{$row['R_Id']}'>
                                    <input type='submit' name='delete_reservation' value='Delete'>
                                </form>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='8'>No reservations found</td></tr>";
            }
            ?>
        </table>
    </div>

</body>
</html>
