<?php
session_start();
if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="admin-box">
        <h1>Welcome Admin: <span><?= htmlspecialchars($_SESSION['name']) ?></span></h1>
        <p>This is the <strong>Admin</strong> dashboard.</p>
        <a href="logout.php"><button>Logout</button></a>
    </div>
</body>
</html>
