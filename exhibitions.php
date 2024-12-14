<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Art Gallery - Exhibitions</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="index.html">Art Gallery</a>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a class="nav-link" href="index.html">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="gallery.php">Gallery</a></li>
            <li class="nav-item"><a class="nav-link" href="artists.php">Artists</a></li>
            <li class="nav-item"><a class="nav-link" href="contact.html">Contact</a></li>
        </ul>
    </div>
</nav>

<div class="container mt-5">
    <h2 class="text-center">Upcoming Exhibitions</h2>
    <div class="row mt-4">
        <?php
        include 'db.php';

        // Fetch exhibitions from the database
        $sql = "SELECT * FROM exhibitions";
        $result = $conn->query($sql);

        // Check if there are any exhibitions
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo '
                <div class="col-md-4 mb-4">
                    <div class="card border-0 shadow">
                        <div class="card-body">
                            <h5 class="card-title">'.$row['title'].'</h5>
                            <p class="card-text">'.substr($row['description'], 0, 150).'...</p>
                            <p><strong>Date:</strong> '.date("M d, Y", strtotime($row['date'])).'</p>
                            <p><strong>Location:</strong> '.$row['location'].'</p>
                        </div>
                    </div>
                </div>';
            }
        } else {
            echo '<p class="text-center">No exhibitions available at the moment.</p>';
        }
        ?>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
