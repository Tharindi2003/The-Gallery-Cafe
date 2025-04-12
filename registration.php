<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['register'])) {
        // Registration logic
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Hash the password for security
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Check if the email or username already exists in the customer table
        $sql = "SELECT * FROM customer WHERE C_Email = ? OR C_Username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $email, $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $existing_user = $result->fetch_assoc();
            if ($existing_user['C_Email'] === $email) {
                echo "<script>alert('This email is already registered!');</script>";
            } elseif ($existing_user['C_Username'] === $username) {
                echo "<script>alert('This username is already taken!');</script>";
            }
        } else {
            // Insert new user into the customer table
            $sql = "INSERT INTO customer (C_Username, C_Email, C_Password) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $username, $email, $hashed_password);

            if ($stmt->execute()) {
                echo "<script>alert('Registration successful!');</script>";
            } else {
                echo "<script>alert('Error: " . $sql . "<br>" . $conn->error . "');</script>";
            }
        }
        
        $stmt->close();
    } elseif (isset($_POST['login'])) {
        // Login logic using username instead of email
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Prepare and execute a query to retrieve the user from the customer table using username
        $sql = "SELECT * FROM customer WHERE C_Username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            // Verify the password
            if (password_verify($password, $user['C_Password'])) {
                // Start a session for the logged-in user
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['C_Username'];
                
                echo "<script>alert('Login successful!');</script>";
                header("Location: reservation.php");
                exit(); 
                
            } else {
                echo "<script>alert('Incorrect password.');</script>";
            }
        } else {
            echo "<script>alert('No account found with that username.');</script>";
        }

        $stmt->close();
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Sign In/Sign Up Page</title>
    <!-- boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="registration.css">
</head>
<body>
<div class="login-container">
    <div class="login-form" id="loginForm">
        <h1>Sign In</h1>
        <div class="form-message-container">
            <span>Or use your username and password</span>
        </div>
        <form action="registration.php" method="POST">
            <input type="text" placeholder="Username" name="username" required>
            <input type="password" placeholder="Password" name="password" required>
            <button type="submit" name="login">Sign In</button>
        </form>
        <p>Don't have an account? <a href="#" id="showSignup">Sign Up</a></p>
    </div>
    <div class="signup-form hidden" id="signupForm">
        <h1>Create An Account</h1>
        <div class="form-message-container">
            <span>Or use your email for registration</span>
        </div>
        <form action="registration.php" method="POST">
            <input type="text" placeholder="Name" name="username" required>
            <input type="email" placeholder="Email" name="email" required>
            <input type="password" placeholder="Password" name="password" required>
            <button type="submit" name="register">Sign Up</button>
        </form>
        <p>Already have an account? <a href="#"  id="showLogin">Sign In</a></p>
    </div>
</div>
<script src="admin.js"></script>
</body>
</html>