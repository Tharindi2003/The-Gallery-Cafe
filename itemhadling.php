<?php
// Connect to the database
$servername = "localhost";
$username = "root"; // Change this to your DB username
$password = ""; // Change this to your DB password
$dbname = "thegallerycafe";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle Add Item
if (isset($_POST['add_item'])) {
    $category = $_POST['category'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    $sql = "INSERT INTO menu_items (category, name, description, price) 
            VALUES ('$category', '$name', '$description', '$price')";

    if ($conn->query($sql) === TRUE) {
        echo "New item added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Handle Delete Item
if (isset($_POST['delete_item'])) {
    $id = $_POST['id'];

    $sql = "DELETE FROM menu_items WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Item deleted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Handle Update Item
if (isset($_POST['update_item'])) {
    $id = $_POST['id'];
    $category = $_POST['category'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    $sql = "UPDATE menu_items 
            SET category='$category', name='$name', description='$description', price='$price'
            WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Item updated successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Parking Reservations</title>
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

        input[type="text"], input[type="number"], input[type="datetime-local"] {
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
        <h1>Admin Dashboard - Menu Items</h1>

        <!-- Add New Item Form -->
        <h3>Add New Item</h3>
        <form method="POST" action="">
            Category: <input type="text" name="category" required><br>
            Name: <input type="text" name="name" required><br>
            Description: <textarea name="description" required></textarea><br>
            Price: <input type="number" name="price" step="0.01" required><br>
            <input type="submit" name="add_item" value="Add Item">
        </form>

        <!-- Display All Items -->
        <h3>Current Menu Items</h3>
        <table>
            <tr>
                <th>ID</th>
                <th>Category</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Action</th>
            </tr>
            <?php
            $sql = "SELECT * FROM menu_items";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['category']}</td>
                            <td>{$row['name']}</td>
                            <td>{$row['description']}</td>
                            <td>{$row['price']}</td>
                            <td>
                                <!-- Delete Form -->
                                <form method='POST' action='' style='display:inline;'>
                                    <input type='hidden' name='id' value='{$row['id']}'>
                                    <input type='submit' name='delete_item' value='Delete'>
                                </form>
                                <!-- Update Form -->
                                <form method='POST' action='' style='display:inline;'>
                                    <input type='hidden' name='id' value='{$row['id']}'>
                                    <input type='hidden' name='category' value='{$row['category']}'>
                                    <input type='hidden' name='name' value='{$row['name']}'>
                                    <input type='hidden' name='description' value='{$row['description']}'>
                                    <input type='hidden' name='price' value='{$row['price']}'>
                                    <input type='submit' name='update_item' value='Edit'>
                                </form>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No items found</td></tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>
