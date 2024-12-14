<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    echo "Please log in to RSVP.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['exhibition_id'])) {
    $user_id = $_SESSION['user_id'];
    $exhibition_id = $_POST['exhibition_id'];

    $stmt = $conn->prepare("INSERT INTO rsvps (user_id, exhibition_id) VALUES (?, ?)");
    $stmt->bind_param("ii", $user_id, $exhibition_id);
    
    if ($stmt->execute()) {
        echo "RSVP successful!";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
}
?>
