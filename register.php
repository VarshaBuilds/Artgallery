<?php
include 'db.php';

$success = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_name = trim($_POST['user_name']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $is_admin = isset($_POST['is_admin']) ? 1 : 0;

    $errors = [];

    if (empty($user_name) || empty($password) || empty($confirm_password)) {
        $errors[] = "All fields are required.";
    }

    if (!preg_match("/^[a-zA-Z0-9]{3,20}$/", $user_name)) {
        $errors[] = "Username must be alphanumeric and between 3 to 20 characters long.";
    }

    if (!preg_match("/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,10}$/", $password)) {
        $errors[] = "Password must contain one uppercase, one lowercase, one number, and one special character.";
    }

    if ($password !== $confirm_password) {
        $errors[] = "Passwords do not match.";
    }

    if (empty($errors)) {
        $stmt = $conn->prepare("SELECT * FROM users WHERE user_name = ?");
        if ($stmt) {
            $stmt->bind_param("s", $user_name);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $errors[] = "Username already taken.";
            } else {
                $hashed_password = password_hash($password, PASSWORD_BCRYPT);

                $insert_stmt = $conn->prepare("INSERT INTO users (user_name, password, is_admin) VALUES (?, ?, ?)");
                if ($insert_stmt) {
                    $insert_stmt->bind_param("ssi", $user_name, $hashed_password, $is_admin);
                    if ($insert_stmt->execute()) {
                        $success = true;
                    } else {
                        $errors[] = "Registration failed. Please try again.";
                    }
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Art Gallery</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('images/background.jpg');
            background-color: #f7f7f7;
            font-family: 'Arial', sans-serif;
        }
        .container {
            margin-top: 80px;
        }
        .form-container {
            background-color: lightgreen;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .form-container h2 {
            text-align: center;
            margin-bottom: 30px;
        }
        .form-control {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 form-container">
            <h2>Register</h2>

            <?php if (!empty($errors)): ?>
                <div class="alert alert-danger">
                    <ul><?php foreach ($errors as $error): ?><li><?php echo $error; ?></li><?php endforeach; ?></ul>
                </div>
            <?php endif; ?>

            <?php if ($success): ?>
                <div class="alert alert-success">Registration successful! You can now Login.</div>
            <?php endif; ?>

            <form method="POST" action="">
                <div class="mb-3">
                    <label for="user_name" class="form-label">Username</label>
                    <input type="text" class="form-control" id="user_name" name="user_name" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="mb-3">
                    <label for="confirm_password" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                </div>
                <div class="mb-3">
                    <input type="checkbox" id="is_admin" name="is_admin" value="1">
                    <label for="is_admin" class="form-label">Register as Admin</label>
                </div>
                <button type="submit" class="btn btn-warning w-100">Register</button>
            </form>
            <div class="text-center mt-3">
                <p>Already have an account? <a href="login.php">Login here</a></p>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>
</html>
