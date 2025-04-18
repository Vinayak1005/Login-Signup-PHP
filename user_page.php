<?php
session_start();
if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'user') {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="user-box">
        <h1>Welcome User: <span><?= htmlspecialchars($_SESSION['name']) ?></span></h1>
        <p>This is your <strong>User</strong> dashboard.</p>
        <a href="logout.php"><button>Logout</button></a>
    </div>
</body>
</html>
