<?php
session_start();
if (!isset($_SESSION['user_id']) || !$_SESSION['is_admin']) {
    header("Location: login.php");
    exit();
}

include '../db.php';

$artists_count = $conn->query("SELECT COUNT(*) FROM artists")->fetch_row()[0];
$artworks_count = $conn->query("SELECT COUNT(*) FROM artworks")->fetch_row()[0];
$exhibitions_count = $conn->query("SELECT COUNT(*) FROM exhibitions")->fetch_row()[0];
$messages_count = $conn->query("SELECT COUNT(*) FROM messages")->fetch_row()[0];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Art Gallery</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f7f9fc;
            font-family: Arial, sans-serif;
        }
        .dashboard-header {
            text-align: center;
            margin-top: 20px;
        }
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: 0.3s;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .nav-link {
            color: #fff;
        }
        .nav-link:hover {
            color: #ffcc00;
        }
        .btn {
            background-color: #ffcc00;
            color: #fff;
        }
        .btn:hover {
            background-color: #e0b300;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Art Gallery Admin</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="../index.html">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <h1 class="dashboard-header">Admin Dashboard</h1>

    <div class="row mt-4">
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Artists</h5>
                    <p class="card-text display-4"><?php echo $artists_count; ?></p>
                    <a href="add_artist.php" class="btn">Manage Artists</a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Artworks</h5>
                    <p class="card-text display-4"><?php echo $artworks_count; ?></p>
                    <a href="add_artwork.php" class="btn">Manage Artworks</a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Exhibitions</h5>
                    <p class="card-text display-4"><?php echo $exhibitions_count; ?></p>
                    <a href="add_exhibition.php" class="btn">Manage Exhibitions</a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Messages</h5>
                    <p class="card-text display-4"><?php echo $messages_count; ?></p>
                    <a href="view_messages.php" class="btn">View Messages</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
