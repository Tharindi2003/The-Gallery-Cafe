<?php
// Database connection
$host = 'localhost';  
$dbname = 'thegallerycafe'; 
$username = 'root';  
$password = '';  


$conn = new mysqli($host, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT * FROM menu_items";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link rel="stylesheet" href="menu.css">
</head>
<body>
    <header>
        <h1>Our Menu</h1>
        <nav>
            <a href="home.php">Home</a>
        </nav>
    </header>

    <section>
        <h2>Menu Items</h2>
        <div class="menu-container">
            <?php
            if ($result->num_rows > 0) {
                // Output data of each row
                while($row = $result->fetch_assoc()) {
                    echo '
                    <div class="menu-item">
                        <img src="./images/' . $row["image"] . '" alt="' . $row["name"] . '">
                        <div class="item-content">
                            <h3>' . $row["name"] . '</h3>
                            <p>' . $row["description"] . '</p>
                            <p><strong>Price:</strong> LKR ' . number_format($row["price"], 2) . '</p>
                        </div>
                    </div>';
                }
            } else {
                echo '<p>No menu items available.</p>';
            }
            $conn->close();
            ?>
        </div>
    </section>
    
    <footer></footer>
</body>
</html>
