<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    echo "Please log in to save favorite artworks.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['artwork_id'])) {
    $user_id = $_SESSION['user_id'];
    $artwork_id = $_POST['artwork_id'];

    $stmt = $conn->prepare("INSERT INTO favorites (user_id, artwork_id) VALUES (?, ?)");
    $stmt->bind_param("ii", $user_id, $artwork_id);
    
    if ($stmt->execute()) {
        echo "Artwork added to favorites!";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
}
?>
