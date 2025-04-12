<?php
// Include the database connection file
include('db_connection.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data and sanitize inputs to prevent SQL injection
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $time = mysqli_real_escape_string($conn, $_POST['time']);
    $people = mysqli_real_escape_string($conn, $_POST['people']);
    $name = mysqli_real_escape_string($conn, $_POST['firstname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);

    // Insert data into the 'reservation' table
    $query = "INSERT INTO reservation (R_Date, R_Time, R_People, R_Name, R_Email, R_Phone)
              VALUES ('$date', '$time', '$people', '$name', '$email', '$phone')";

    // Execute the query and check if it's successful
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Reservation successful!'); window.location.href='thank_you.php';</script>";
        
    } else {
        echo "<script>alert('Error: Could not process your reservation. Please try again.'); window.location.href='reservation.php';</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Form</title>
    <link rel="stylesheet" href="reservation.css">
</head>
<body>

    <div class="container">
        <div class="booking-form">
            <h1>BOOKING</h1>
            <form action="reservation.php" method="POST">
                <div class="form-group">
                    <label for="date">Date*</label>
                    <input type="date" id="date" name="date" required>
                </div>

                <div class="form-group">
                    <label for="time">Time*</label>
                    <input type="time" id="time" name="time" required>
                </div>

                <div class="form-group">
                    <label for="people">People*</label>
                    <input type="number" id="people" name="people" min="1" placeholder="Enter number of people" required>
                </div>

                <div class="form-group">
                    <label for="firstname">First name*</label>
                    <input type="text" id="firstname" name="firstname" required>
                </div>

                <div class="form-group">
                    <label for="email">Email*</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="phone">Phone*</label>
                    <input type="tel" id="phone" name="phone" required>
                </div>

                <button type="submit" class="book-btn">Book a table</button>  </br></br></br>
               
                
            </form>
            <a href="parking.html" class="book-btn">Parking Availability</a> </br> </br></br>
            <a href="cart.html" class="book-btn">Book your foods</a>
        </div>
        

       

</body>
</html>
