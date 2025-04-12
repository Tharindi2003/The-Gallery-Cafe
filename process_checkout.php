<?php
// Database connection credentials
$servername = "localhost";
$username = "root"; // default for XAMPP or WAMP
$password = ""; // default for XAMPP or WAMP
$dbname = "thegallerycafe"; // The database you created earlier

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Capture form data
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$table_number = $_POST['table_number'];
$total_amount = $_POST['total_amount'];

// Insert data into the database
$sql = "INSERT INTO orders (customer_name, email, phone, table_number, total_amount) 
        VALUES ('$name', '$email', '$phone', '$table_number','$total_amount')";

if ($conn->query($sql) === TRUE) {
    echo "Order placed successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the connection
$conn->close();
?>
