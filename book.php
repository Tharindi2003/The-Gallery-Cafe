<?php
// Database configuration
$servername = "localhost";  
$username = "root";         
$password = "";          
$dbname = "parking_system"; 

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if 'slot' is sent via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape the input to prevent SQL injection
    $slot = $conn->real_escape_string($_POST['slot']);

    // Check if slot is already booked
    $checkSlot = "SELECT * FROM booked_slots WHERE slot_id = '$slot'";
    $result = $conn->query($checkSlot);

    if ($result->num_rows > 0) {
        // If slot is already booked
        echo "Sorry, this slot is already reserved!";
    } else {
        // Insert the selected slot into the booked_slots table
        $sql = "INSERT INTO booked_slots (slot_id) VALUES ('$slot')";

        if ($conn->query($sql) === TRUE) {
            echo "Slot $slot has been successfully booked!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

// Close connection
$conn->close();
?>
