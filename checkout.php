<?php
// Database connection settings
$servername = "localhost";  
$username = "root";         
$password = "";             
$dbname = "thegallerycafe";  

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Receive cart data from POST request
$cartData = json_decode(file_get_contents('php://input'), true);

if ($cartData && isset($cartData['items'])) {
    // Prepare the SQL statement to insert data into the orders table
    $stmt = $conn->prepare("INSERT INTO orders (item_name, quantity, price, total) VALUES (?, ?, ?, ?)");

    // Loop through the cart items and insert each into the database
    foreach ($cartData['items'] as $item) {
        $item_name = $item['name'];
        $quantity = $item['quantity'];
        $price = $item['price'];
        $total = $price * $quantity;

        // Bind parameters and execute SQL query
        $stmt->bind_param("sidd", $item_name, $quantity, $price, $total);
        $stmt->execute();
    }

    // Return success response
    echo json_encode(['status' => 'success', 'message' => 'Order placed successfully!']);
} else {
    // Return error if no items found in the cart
    echo json_encode(['status' => 'error', 'message' => 'No items in cart']);
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
