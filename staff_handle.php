<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
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

        input[type="text"], input[type="email"], input[type="password"] {
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
        <h1>Admin Dashboard - Manage Staff</h1>

        <?php
        // Database connection
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "thegallerycafe";
        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Add Staff Member
        if (isset($_POST['add_staff'])) {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $role = 'staff';

            $sql = "INSERT INTO users (Username, Email, Password, Role) VALUES ('$username', '$email', '$password', '$role')";

            if ($conn->query($sql) === TRUE) {
                echo "New staff member added successfully.";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }

        // Delete Staff Member
        if (isset($_POST['delete_staff'])) {
            $id = $_POST['id'];
            $sql = "DELETE FROM users WHERE id='$id'";

            if ($conn->query($sql) === TRUE) {
                echo "Staff member deleted successfully.";
            } else {
                echo "Error deleting staff member: " . $conn->error;
            }
        }
        ?>

        <!-- Add Staff Member Form -->
        <h3>Add New Staff Member</h3>
        <form method="POST" action="">
            Username: <input type="text" name="username" required><br>
            Email: <input type="email" name="email" required><br>
            Password: <input type="password" name="password" required><br>
            <input type="submit" name="add_staff" value="Add Staff">
        </form>

        <!-- Display All Staff Members -->
        <h3>Current Staff Members</h3>
        <table>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
            <?php
            $sql = "SELECT * FROM users WHERE Role = 'staff'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['Username']}</td>
                            <td>{$row['Email']}</td>
                            <td>{$row['Role']}</td>
                            <td>
                                <form method='POST' action='' style='display:inline;'>
                                    <input type='hidden' name='id' value='{$row['id']}'>
                                    <input type='submit' name='delete_staff' value='Delete'>
                                </form>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No staff members found</td></tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>
