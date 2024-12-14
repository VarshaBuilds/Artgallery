<?php
session_start();
if (!isset($_SESSION['user_id']) || !$_SESSION['is_admin']) {
    header("Location: login.php");
    exit();
}

include '../db.php';

$messages_result = $conn->query("SELECT * FROM messages");

?>
<!DOCTYPE html>
<html>
<head>
    <title>View Messages</title>
    <link href="../css/style.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .table-container {
            width: 80%;
            margin: auto;
            padding: 20px;
            background-color: #f9f9f9;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
            color: #333;
            font-weight: bold;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>
    <div class="table-container">
        <h1>Messages</h1>
        <table>
            <tr>
                <th>ID</th>
                <th>Sender</th>
                <th>Message</th>
                <th>Date</th>
            </tr>
            <?php while($message = $messages_result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $message['id']; ?></td>
                    <td><?php echo $message['name']; ?></td>
                    <td><?php echo $message['message']; ?></td>
                    <td><?php echo $message['created_at']; ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>
