<?php
session_start();
if (!isset($_SESSION['sister_auth'])) { header("Location: index.php"); exit(); }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>For My Dearest Sonali ❤️</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="card-container personalized-card">
        
        <div class="festival-header">
            <h1>To My Dearest Sonali ✨</h1>
            <p class="subtitle">A bond that grows stronger every single year!</p>
        </div>

        <div class="letter-box">
            <p>Dear Seenu Didi, thank you for being such an incredible part of my life. This Raksha Bandhan, I want to remind you how deeply blessed I am to have you as my sister.</p>
            <p>Through all the ups and downs, your presence has always brought joy, laughter, and light into our family. No matter how much time passes or how busy life gets, our bond remains unshakable and extremely close to my heart.</p>
            <p>I promise to always stand by you, support your biggest dreams, and protect your happiness forever. Thank you for your care, your wisdom, and the beautiful Rakhis you tie every year.</p>
            <p class="highlight-text">May our beautiful bond continue to thrive forever! 💫</p>
        </div>

        <div class="navigation-menu" style="margin-top: 30px;">
            <a href="gallery.php" class="btn-sister btn-gallery">Next: See Our Photo Memory 📸</a>
        </div>
    </div>
</body>
</html>
