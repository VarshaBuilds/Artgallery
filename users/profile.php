<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    echo "Please log in to view your profile.";
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch favorite artworks
$favorites_query = "SELECT a.title FROM favorites f JOIN artworks a ON f.artwork_id = a.id WHERE f.user_id = $user_id";
$favorites_result = $conn->query($favorites_query);

// Fetch RSVPs
$rsvp_query = "SELECT e.title, e.date FROM rsvps r JOIN exhibitions e ON r.exhibition_id = e.id WHERE r.user_id = $user_id";
$rsvp_result = $conn->query($rsvp_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
</head>
<body>
    <h2>Your Favorite Artworks</h2>
    <ul>
        <?php while ($row = $favorites_result->fetch_assoc()) : ?>
            <li><?php echo htmlspecialchars($row['title']); ?></li>
        <?php endwhile; ?>
    </ul>

    <h2>Your RSVPs for Exhibitions</h2>
    <ul>
        <?php while ($row = $rsvp_result->fetch_assoc()) : ?>
            <li><?php echo htmlspecialchars($row['title']) . " on " . htmlspecialchars($row['date']); ?></li>
        <?php endwhile; ?>
    </ul>
</body>
</html>
