<?php
session_start();
// Protect area: If she didn't insert a name, bounce her back out to index.php
if (!isset($_SESSION['sister_auth'])) {
    header("Location: index.php");
    exit();
}
$name = htmlspecialchars($_SESSION['sister_auth']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Happy Raksha Bandhan ✨</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="card-container home-card">
        <div class="festival-header">
            <h1>✨ Welcome, <?php echo $name; ?>! ✨</h1>
            <p class="subtitle">Happy Raksha Bandhan to My Pillar of Strength</p>
        </div>
        
        <div class="welcome-box">
            <p>Childhood memories, endless laughter, and the priceless thread tied around the wrist every year. This digital corner is built entirely for you...</p>
        </div>

        <div class="navigation-menu">
            <h3>Start Your Journey Here ❤️</h3>
            <a href="suhani.php" class="btn-sister">Open My Message for You 🌟</a>
        </div>

        <div class="footer">
            <p>Made with ❤️ by your Brother</p>
        </div>
    </div>
</body>
</html>
