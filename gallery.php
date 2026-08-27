<?php
session_start();
if (!isset($_SESSION['sister_auth'])) { header("Location: index.php"); exit(); }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Memory 📸</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="card-container gallery-container">
        
        <div class="festival-header">
            <h1>Our Favorite Memory ✨</h1>
            <p class="subtitle">Frozen in time, cherished forever</p>
        </div>

        <div class="single-photo-layout">
            <div class="photo-frame feature-frame">
                <img src="pic.jpg" alt="us" class="responsive-pic">
                <div class="img-caption">Growing up with you is my life's greatest blessing! 💫</div>
            </div>
        </div>

        <div class="navigation-menu" style="margin-top: 30px; margin-bottom: 20px;">
            <a href="celebrate.php" class="btn-sister">Next: Celebrate Rakhi Digitally! 🎁</a>
        </div>
    </div>
</body>
</html>
