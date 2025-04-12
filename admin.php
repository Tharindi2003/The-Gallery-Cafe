<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['register'])) {
        // Registration logic
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $role = $_POST['role']; 

        // Hash the password for security
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Check if the email or username already exists in the user table
        $sql = "SELECT * FROM users WHERE Email = ? OR Username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $email, $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $existing_user = $result->fetch_assoc();
            if ($existing_user['Email'] === $email) {
                echo "<script>alert('This email is already registered!');</script>";
            } elseif ($existing_user['Username'] === $username) {
                echo "<script>alert('This username is already taken!');</script>";
            }
        } else {
            // Insert new user into the users table with the selected role
            $sql = "INSERT INTO users (Username, Email, Password, Role) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssss", $username, $email, $hashed_password, $role);

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
        $role = $_POST['role']; // Capturing the role (admin or staff)

        // Prepare and execute a query to retrieve the user from the users table using username and role
        $sql = "SELECT * FROM users WHERE Username = ? AND Role = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $username, $role);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            // Verify the password
            if (password_verify($password, $user['Password'])) {
                // Start a session for the logged-in user
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['Username'];
                $_SESSION['user_role'] = $user['Role']; // Store user role in session

                echo "<script>alert('Login successful!');</script>";

                // Redirect based on the role
                if ($role === 'admin') {
                    header("Location: adminpanel.php"); // Redirect to admin panel
                } elseif ($role === 'staff') {
                    header("Location: staff_panel.php"); // Redirect to staff dashboard
                }
                exit(); // Stop further script execution after redirection
            } else {
                echo "<script>alert('Incorrect password.');</script>";
            }
        } else {
            echo "<script>alert('No account found with that username and role.');</script>";
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
    <title>Admin & Staff Login/Registration</title>
    <!-- boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style2.css">
</head>
<body>
<div class="login-container">
    <div class="login-form" id="loginForm">
        <h1>Welcome Admin/Staff Login</h1>
        <div class="form-message-container">
            <span>Choose your role and login using your username and password</span>
        </div>
        <form action="admin.php" method="POST">
            <select name="role" required>
                <option value="" disabled selected>Select Role</option>
                <option value="admin">Admin</option>
                <option value="staff">Staff</option>
            </select>
            <input type="text" placeholder="Username" name="username" required>
            <input type="password" placeholder="Password" name="password" required>
            <button type="submit" name="login">Sign In</button>
        </form>
        <p>Don't have an account? <a href="#" id="showSignup">Sign Up</a></p>
    </div>
    <div class="signup-form hidden" id="signupForm">
        <h1>Create An Account</h1>
        <div class="form-message-container">
            <span>Select your role and register using your details</span>
        </div>
        <form action="admin.php" method="POST">
            <select name="role" required>
                <option value="" disabled selected>Select Role</option>
                <option value="admin">Admin</option>
                <option value="staff">Staff</option>
            </select>
            <input type="text" placeholder="Name" name="username" required>
            <input type="email" placeholder="Email" name="email" required>
            <input type="password" placeholder="Password" name="password" required>
            <button type="submit" name="register">Sign Up</button>
        </form>
        <p>Already have an account? <a href="#" id="showLogin">Sign In</a></p>
    </div>
</div>
<script src="admin.js"></script>
</body>
</html>
