<?php
include '../db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $bio = $_POST['bio'];

    $stmt = $conn->prepare("INSERT INTO artists (name, bio) VALUES (?, ?)");
    $stmt->bind_param("ss", $name, $bio);

    if ($stmt->execute()) {
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Failed to add artist.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Artist</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f4f7;
            font-family: 'Arial', sans-serif;
        }

        .container {
            margin-top: 50px;
        }

        .form-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .form-group label {
            font-weight: bold;
        }

        .form-control {
            border-radius: 5px;
            border: 1px solid #ddd;
            margin-bottom: 20px;
        }

        .form-control:focus {
            border-color: #4caf50;
            box-shadow: 0 0 5px rgba(76, 175, 80, 0.5);
        }

        .btn {
            background-color: #4caf50;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            width: 100%;
            font-size: 16px;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #45a049;
        }

        .text-center {
            margin-top: 20px;
        }

        .alert {
            font-size: 16px;
            color: red;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="form-container">
        <h2>Add New Artist</h2>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="form-group">
                <label for="name">Artist Name</label>
                <input type="text" class="form-control" id="name" name="name" required placeholder="Enter artist's name">
            </div>
            <div class="form-group">
                <label for="bio">Artist Bio</label>
                <textarea class="form-control" id="bio" name="bio" required rows="4" placeholder="Enter artist's biography"></textarea>
            </div>
            <button type="submit" class="btn">Add Artist</button>
        </form>

        <div class="text-center mt-3">
            <p><a href="dashboard.php">Back to Dashboard</a></p>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
