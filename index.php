<?php
session_start();

$error = "";
if (isset($_POST['enter_site'])) {
    $sister_name = trim($_POST['sister_name']);
    
    if (!empty($sister_name)) {
        // --- अपनी Supabase क्रेडेंशियल्स यहाँ डालें ---
        $supabase_url = "https://YOUR_PROJECT_ID.supabase.co"; 
        $supabase_key = "YOUR_ANON_PUBLIC_KEY"; 
        
        // नाम चेक करने का लॉजिक (डेटाबेस में भेजने से पहले ही वैलिडेशन)
        $name_lower = strtolower($sister_name);
        $is_valid_sister = false;
        $redirect_page = "";

        if (strpos($name_lower, 'suhani') !== false) {
            $is_valid_sister = true;
            $redirect_page = "suhani.php";
        } elseif (strpos($name_lower, 'sonali') !== false) {
            $is_valid_sister = true;
            $redirect_page = "sonali.php";
        } elseif (strpos($name_lower, 'deepti') !== false) {
            $is_valid_sister = true;
            $redirect_page = "deepti.php";
        }

        // अगर नाम गलत है, तो डेटाबेस में एंट्री नहीं होगी और सीधे एरर दिखेगा
        if (!$is_valid_sister) {
            $error = "Access Denied! This corner is reserved only for my specific sisters. ❌";
        } else {
            // नाम सही होने पर ही डेटाबेस पेलोड तैयार करें
            $data = json_encode([
                "sister_name" => $sister_name
            ]);
            
            // Supabase को cURL द्वारा डेटा भेजें
            $ch = curl_init($supabase_url . "/rest/v1/sisters_attendance");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                "Content-Type: application/json",
                "apikey: " . $supabase_key,
                "Authorization: Bearer " . $supabase_key
            ]);
            
            $response = curl_exec($ch);
            $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
            
            // अगर डेटाबेस में नाम सेव हो गया या लोकल ऑफलाइन टेस्टिंग (http_code 0) के लिए
            if ($http_code == 201 || $http_code == 200 || $http_code == 0) {
                $_SESSION['sister_auth'] = $sister_name; 
                header("Location: " . $redirect_page); // सीधे उसी बहन के पर्सनल पेज पर भेजें
                exit();
            } else {
                $error = "Database connectivity issue. Please try again! ⚠️";
            }
        }
    } else {
        $error = "Please enter your beautiful name! 😊";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Sister ✨</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="card-container login-card" style="max-width: 420px;">
        <div class="festival-header">
            <h1>✨ Raksha Bandhan ✨</h1>
            <p class="subtitle">A special corner built by your brother</p>
        </div>
        
        <form method="POST" action="index.php" style="margin-top: 25px;">
            <div style="margin-bottom: 20px;">
                <label style="display:block; text-align:left; font-weight:bold; margin-bottom:8px; color:#8b0000;">Enter Your Name to Unlock:</label>
                <input type="text" name="sister_name" placeholder="Type your name here..." required 
                       style="width: 100%; padding: 12px; border-radius: 8px; border: 2px solid #d4af37; box-sizing: border-box; font-size: 1.1rem; text-align: center;">
            </div>
            
            <?php if (!empty($error)): ?>
                <p style="color: red; font-weight: bold; font-size: 0.95rem; margin-bottom: 15px; text-align: center; line-height: 1.4;"><?php echo $error; ?></p>
            <?php endif; ?>

            <button type="submit" name="enter_site" class="btn-sister" style="width: 100%; cursor: pointer;">Unlock My Message 💖</button>
        </form>
    </div>
</body>
</html>
