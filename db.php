<?php
$host = 'localhost'; // Assuming you're using localhost
$db = 'dashboardDB'; // Database name
$user = 'root'; // Your phpMyAdmin username
$pass = ''; // Your phpMyAdmin password

try {
    $conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
