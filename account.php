<?php
session_start();

// Redirect if not logged in
if (!isset($_SESSION["user_id"])) {
    header("Location: signup.php");
    exit();
}

// Connect to DB
$mysqli = require __DIR__ . "/data-base.php";
$stmt = $mysqli->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param("i", $_SESSION["user_id"]);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Handle missing user
if (!$user) {
    session_destroy();
    header("Location: signup.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Account</title>
    <link rel="stylesheet" href="style.css?v=<?= filemtime('style.css'); ?>">
</head>
<body>
    <div class="container">
        <h1>Account Page for <?= htmlspecialchars($user["name"]); ?></h1>
        <div class="links">
            <a href="index.php">Home</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>
</body>
</html>
