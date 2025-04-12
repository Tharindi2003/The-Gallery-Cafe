<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "thegallerycafe";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "";


$sql = "SELECT DATABASE()";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {
        echo "";
    }
} else {
    echo "";
}

