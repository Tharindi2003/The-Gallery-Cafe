<?php
// Start session for logged-in users
session_start();

// If user is not logged in, redirect to login page
if (!isset($_SESSION['user_name'])) {
    header("Location: login.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - The Gallery Cafe</title>
    <!-- Link to external CSS file -->
    <link rel="stylesheet" href="staff_panel.css">
    <!-- Include boxicons for the logout icon -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <header>
        <div class="container">
            <h1>The Gallery Cafe</h1>
            <div class="welcome">
                <span>Welcome Staff Login</span>
                <a href="logout.php" class="logout-btn">
                    <i class='bx bx-log-out'></i> Log Out
                </a>
            </div>
        </div>
    </header>

    <main>
        <div class="container">
            <div class="menu-grid">
                <a href="orders_handle.php" class="menu-item">Orders Handling</a>
                <a href="admin_reservation.php" class="menu-item">Reservation Handling</a>
                <a href="admin_parking.php" class="menu-item">Car Parking</a>
                
        </div>
    </main>
</body>
</html>
