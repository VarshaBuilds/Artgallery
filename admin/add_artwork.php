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
    $artist_id = $_POST['artist_id'];

    $target_dir = "../images/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
    $image_path = basename($_FILES["image"]["name"]);

    $sql = "INSERT INTO artworks (title, description, artist_id, image) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssis", $title, $description, $artist_id, $image_path);
    if ($stmt->execute()) {
        echo "<p class='success-message'>Artwork added successfully!</p>";
    } else {
        echo "<p class='error-message'>Error: " . $conn->error . "</p>";
    }
    $stmt->close();
}

$artist_query = "SELECT id, name FROM artists";
$artist_result = $conn->query($artist_query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Artwork</title>
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

        .form-container input, .form-container select, .form-container textarea {
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

<h2>Add New Artwork</h2>

<div class="form-container">
    <form action="add_artwork.php" method="POST" enctype="multipart/form-data">
        <label for="title">Title:</label>
        <input type="text" name="title" required>

        <label for="description">Description:</label>
        <textarea name="description" required></textarea>

        <label for="artist_id">Artist:</label>
        <select name="artist_id" required>
            <?php while ($artist = $artist_result->fetch_assoc()) : ?>
                <option value="<?php echo $artist['id']; ?>"><?php echo $artist['name']; ?></option>
            <?php endwhile; ?>
        </select>

        <label for="image">Upload Image:</label>
        <input type="file" name="image" required>

        <button type="submit">Add Artwork</button>
    </form>
</div>

</body>
</html>
