<?php
include 'db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Art Gallery - Artists</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="index.html">Art Gallery</a>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a class="nav-link" href="index.html">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="gallery.php">Gallery</a></li>
            <li class="nav-item"><a class="nav-link" href="exhibitions.php">Exhibitions</a></li>
            <li class="nav-item"><a class="nav-link" href="contact.html">Contact</a></li>
        </ul>
    </div>
</nav>

<div class="container mt-5">
    <h2 class="text-center">Meet Our Artists</h2>
    <div class="row mt-4">
        <?php
        // Fetch artists from the database
        $sql = "SELECT * FROM artists";
        $result = $conn->query($sql);

        // Check if there are any artists
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $image = !empty($row['image']) ? $row['image'] : 'images/pp.jfif';

                echo '
                <div class="col-md-4 mb-4">
                    <div class="card border-0 shadow">
                        <img src="'.$image.'" class="card-img-top" alt="'.$row['name'].'">
                        <div class="card-body">
                            <h5 class="card-title">'.$row['name'].'</h5>
                            <p class="card-text">'.$row['bio'].'</p>
                        </div>
                    </div>
                </div>';
            }
        } else {
            echo '<p class="text-center">No artists available at the moment.</p>';
        }
        ?>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
