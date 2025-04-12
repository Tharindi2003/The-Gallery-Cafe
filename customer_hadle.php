<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Manage Customers</title>
    <style>
       
        body {
            background-color: #000; 
            color: #fff; 
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #1a1a1a; 
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
            background-color: #333; 
            color: #fff;
        }

        input[type="submit"] {
            padding: 10px 20px;
            background-color: #fff; 
            color: #000; 
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }

        input[type="submit"]:hover {
            background-color: #f0f0f0; 
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
            background-color: #333;
        }

        td {
            background-color: #222; 
        }

        td form input[type="submit"] {
            background-color: #ff4d4d; 
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
        }

        td form input[type="submit"]:hover {
            background-color: #ff1a1a; 
        }
    </style>
</head>
<body>
    
    <div class="container">
        <h1>Admin Dashboard - Manage Customers</h1>

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

        // Add customer
        if (isset($_POST['add_customer'])) {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Secure the password

            // Insert new customer into the database
            $sql = "INSERT INTO customer (C_Username, C_Email, C_Password) VALUES ('$username', '$email', '$password')";

            if ($conn->query($sql) === TRUE) {
                echo "<p>New customer added successfully.</p>";
            } else {
                echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
            }
        }

        // Delete customer
        if (isset($_POST['delete_customer'])) {
            $id = $_POST['id'];
            $sql = "DELETE FROM customer WHERE C_Id='$id'";

            if ($conn->query($sql) === TRUE) {
                echo "<p>Customer deleted successfully.</p>";
            } else {
                echo "<p>Error deleting customer: " . $conn->error . "</p>";
            }
        }
        ?>

        <!-- Add customer Form -->
        <h3>Add New Customer</h3>
        <form method="POST" action="">
            Username: <input type="text" name="username" required><br>
            Email: <input type="email" name="email" required><br>
            Password: <input type="password" name="password" required><br>
            <input type="submit" name="add_customer" value="Add Customer">
        </form>

        <!-- Display All Customers -->
        <h3>Current Customers</h3>
        <table>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
            <?php
            // Fetch all customers from the 'customer' table
            $sql = "SELECT * FROM customer";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Output each customer as a table row
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['C_Id']}</td>
                            <td>{$row['C_Username']}</td>
                            <td>{$row['C_Email']}</td>
                            <td>
                                <form method='POST' action='' style='display:inline;'>
                                    <input type='hidden' name='id' value='{$row['C_Id']}'>
                                    <input type='submit' name='delete_customer' value='Delete'>
                                </form>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No customers found</td></tr>";
            }
            ?>
        </table>
    </div>

</body>
</html>
