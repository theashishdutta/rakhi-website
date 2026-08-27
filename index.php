<?php
// Set the timezone and calculate the countdown to Raksha Bandhan
date_default_timezone_set('Asia/Kolkata');
$rakhi_date = strtotime("August 28, 2026 00:00:00"); // Update year dynamically if needed
$current_date = time();
$diff = $rakhi_date - $current_date;

if ($diff > 0) {
    $days = floor($diff / (60 * 60 * 24));
    $countdown_message = "Only <strong>$days days</strong> left until we celebrate!";
} else {
    $countdown_message = "Happy Raksha Bandhan to the best sisters in the world! ❤️";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Happy Raksha Bandhan!</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="card-container">
        <div class="festival-header">
            <h1>✨ Happy Raksha Bandhan ✨</h1>
            <p class="subtitle">To My Amazing Sisters</p>
        </div>
        
        <div class="sister-gallery">
            <!-- Replace placeholder names and customize your message -->
            <div class="sister-card">
                <h3>Dear Sister,</h3>
                <p>Thank you for always being my constant support system, my secret keeper, and my best friend. Distance might keep us apart, but our bond grows stronger every single year!</p>
            </div>
        </div>

        <div class="dynamic-status">
            <p><?php echo $countdown_message; ?></p>
        </div>

        <div class="footer">
            <p>Made with ❤️ by your Brother</p>
        </div>
    </div>
</body>
</html>
