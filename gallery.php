<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Art Gallery - Gallery</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.min.css">
    <style>
        .gallery-item {
            transition: transform 0.3s ease;
        }
        .gallery-item:hover {
            transform: scale(1.05);
        }
        .gallery-title {
            color: #333;
            text-align: center;
            margin-bottom: 30px;
            font-size: 2.5rem;
            font-weight: bold;
        }
        .card-body p {
            color: #666;
        }
        .card-img-top {
            height: 250px;
            object-fit: cover;
        }
        .no-artworks {
            text-align: center;
            font-size: 1.5rem;
            color: #888;
            margin-top: 50px;
        }
    </style>
</head>
<body>

<!-- <?php include 'db.php'; ?> -->

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="index.html">Art Gallery</a>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a class="nav-link" href="index.html">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="artists.php">Artists</a></li>
            <li class="nav-item"><a class="nav-link" href="exhibitions.php">Exhibitions</a></li>
            <li class="nav-item"><a class="nav-link" href="contact.html">Contact</a></li>
        </ul>
    </div>
</nav>

<div class="container mt-5">
    <h2 class="gallery-title">Gallery</h2>
    <div class="row">
        <?php
        $sql = "SELECT * FROM artworks";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '
                <div class="col-md-4 mb-4">
                    <div class="card border-0 shadow-sm gallery-item">
                        <a href="images/'.$row['image'].'" data-toggle="lightbox">
                            <img src="images/'.$row['image'].'" class="card-img-top" alt="'.$row['title'].'">
                        </a>
                        <div class="card-body">
                            <h5 class="card-title">'.$row['title'].'</h5>
                            <p class="card-text">'.substr($row['description'], 0, 60).'...</p>
                        </div>
                    </div>
                </div>';
            }
        } else {
            echo '<div class="col-12 no-artworks">No artworks available at the moment. Check back soon!</div>';
        }
        ?>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.min.js"></script>

<script>
$(document).on('click', '[data-toggle="lightbox"]', function(event) {
    event.preventDefault();
    $(this).ekkoLightbox();
});
</script>

</body>
</html>
