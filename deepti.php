<?php
session_start();
if (!isset($_SESSION['sister_auth'])) { header("Location: index.php"); exit(); }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>For My Dearest Deepti ❤️</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="card-container personalized-card">
        
        <div class="festival-header">
            <h1>To My Dearest Deepti ✨</h1>
            <p class="subtitle">You fill my life with absolute joy and smiles!</p>
        </div>

        <div class="letter-box">
            <p>Dear Dee, wishing you a very Happy and wonderful Raksha Bandhan! Having you as my sister is one of the greatest privileges of my life.</p>
            <p>Your kindness, warm heart, and constant encouragement mean the absolute world to me. Thank you for always listening to me, keeping my secrets, and guiding me like a true friend whenever I needed it most.</p>
            <p>Today, I want to promise you that no matter where life takes us, your brother will always be just a single phone call away, ready to protect you and cheer you on.</p>
            <p class="highlight-text">Wishing you endless happiness and success always! 💫</p>
        </div>

        <div class="navigation-menu" style="margin-top: 30px;">
            <a href="celebrate.php" class="btn-sister">Next: Celebrate Rakhi Digitally! 🎁</a>
        </div>
    </div>
</body>
</html>
