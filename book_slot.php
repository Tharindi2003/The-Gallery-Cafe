<?php
// db.php (create this file to handle the database connection)
include 'db.php';

header('Content-Type: application/json');

// Get the request body
$data = json_decode(file_get_contents('php://input'), true);
$slot = $data['slot'];

// Check if the slot is available
$query = $conn->prepare("SELECT status FROM parking_slots WHERE slot = :slot");
$query->execute(['slot' => $slot]);
$slotData = $query->fetch(PDO::FETCH_ASSOC);

if ($slotData && $slotData['status'] === 'available') {
    // Update the slot status to reserved
    $update = $conn->prepare("UPDATE parking_slots SET status = 'reserved', booked_by = 'User' WHERE slot = :slot");
    $update->execute(['slot' => $slot]);

    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false]);
}
?>
