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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="style.css?v=<?= filemtime('style.css'); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>
    <nav>
        <a href="index.php"><h1>Lors</h1></a>
        <ul>
            <li><a href="dresses.html">Dresses</a></li>
            <li><a href="tops.html">Tops</a></li>
            <li><a href="bottoms.html">Bottoms</a></li>
            <li><a href="active.html">Active wear</a></li>
        </ul>
        <div class="icons">
            <button><a href="#"><i class="fa-solid fa-magnifying-glass"></i></a></button>
            <button><a href="account.php"><i class="fa-solid fa-user"></i></a></button>
        </div>
    </nav>

    <header>
        <div class="interheader">
            <h1>Lor's Clothing</h1>
            <button><a href="dresses.html">Discover</a></button>
        </div>
    </header>

    <main>
        <div class="outercontainer">
            <img id="dress" src="https://media.istockphoto.com/id/2170815342/photo/serie-of-studio-photos-of-young-female-model-in-green-viscose-wrap-dress.jpg?s=612x612&w=0&k=20&c=mkL3q950t_-XwIkXVa-y9sDq7I3_Ze8JjZG4J5N3Bsc=" alt="">
            <img id="dress" src="https://images.pexels.com/photos/2065195/pexels-photo-2065195.jpeg?cs=srgb&dl=pexels-anastasiya-gepp-654466-2065195.jpg&fm=jpg" alt="">
            <img id="dress" src="https://media.istockphoto.com/id/618034600/photo/beauty-in-white.jpg?s=612x612&w=0&k=20&c=Tfc9edS_-4kbLnqdOSg-q45YdrtMujfYzE7ONJZP-lI=" alt="">
        </div>
    </main>

    <footer></footer>
</body>
</html>
