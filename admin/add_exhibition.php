<?php
session_start();
require_once "../db.php";

if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    header("Location: ../login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $date = $_POST['date'];
    $location = $_POST['location'];

    $sql = "INSERT INTO exhibitions (title, description, date, location) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param("ssss", $title, $description, $date, $location);
    if ($stmt->execute()) {
        echo "<p class='success-message'>Exhibition added successfully!</p>";
    } else {
        echo "<p class='error-message'>Error: " . $stmt->error . "</p>";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Exhibition</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7f6;
            padding: 20px;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        .form-container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 0 auto;
        }

        .form-container label {
            font-weight: bold;
            color: #555;
            display: block;
            margin: 10px 0 5px;
        }

        .form-container input, .form-container textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        .form-container button {
            background-color: #4CAF50;
            color: white;
            padding: 15px 30px;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
            width: 100%;
        }

        .form-container button:hover {
            background-color: #45a049;
        }

        .success-message {
            color: green;
            text-align: center;
        }

        .error-message {
            color: red;
            text-align: center;
        }

        .form-container textarea {
            resize: vertical;
            min-height: 100px;
        }

        @media (max-width: 600px) {
            .form-container {
                padding: 20px;
                margin: 10px;
            }
        }
    </style>
</head>
<body>

<h2>Add New Exhibition</h2>

<div class="form-container">
    <form action="add_exhibition.php" method="POST">
        <label for="title">Title:</label>
        <input type="text" name="title" required>

        <label for="description">Description:</label>
        <textarea name="description" required></textarea>

        <label for="date">Date:</label>
        <input type="date" name="date" required>

        <label for="location">Location:</label>
        <input type="text" name="location" required>

        <button type="submit">Add Exhibition</button>
    </form>
</div>

</body>
</html>
