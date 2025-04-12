<?php
// Include the database connection
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $user_name = $_POST['user_name'];
    $date_order = $_POST['date_order'];
    $status = $_POST['status'];

    // Prepare and execute the SQL query to insert data
    $sql = "INSERT INTO orders (user_name, date_order, status) VALUES (:user_name, :date_order, :status)";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['user_name' => $user_name, 'date_order' => $date_order, 'status' => $status]);

    // Redirect back to the dashboard or show a success message
    echo "Order added successfully!";
}
?>
