<?php
session_start();
if (!isset($_SESSION['sister_auth'])) { header("Location: index.php"); exit(); }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Celebrate Rakhi Digitally ✨</title>
    <link rel="stylesheet" href="style.css">
    
    <style>
        /* ब्राउज़र कैशे को बायपास करने के लिए थाली की ज़रूरी इनलाइन डिज़ाइन */
        .photo-aarti-visible {
            position: absolute !important;
            top: 50% !important;
            left: 50% !important;
            width: 200px !important; 
            height: 200px !important;
            background: radial-gradient(circle, #fff3cc 20%, #fcdb82 60%, #d4af37 100%) !important;
            border: 5px double #8b0000 !important; 
            outline: 2px solid #ffd700 !important;
            border-radius: 50% !important;
            box-shadow: 0 10px 25px rgba(139, 0, 0, 0.3), inset 0 0 15px rgba(139, 0, 0, 0.2) !important;
            z-index: 998 !important;
            transform: translate(-50%, -50%) rotate(0deg) !important; 
            display: block !important;
        }
    </style>
</head>
<body>
    <div class="card-container celebration-container">
        
        <a href="gallery.php" class="back-link">⬅ Back to Memory</a>

        <div class="festival-header">
            <h1>Celebrate Digitally ✨</h1>
            <p class="subtitle">Perform all the traditional rituals on your brother!</p>
        </div>

        <!-- Interactive Photo & Side-Arm Ritual Area -->
        <div class="photo-ritual-box">
            <div class="celebration-workspace">
                
                <div class="brother-interactive-frame">
                    <!-- आपकी फोटो -->
                    <img src="photo.jpg" alt="Brother" class="brother-photo-bg">
                    
                    <!-- माठे पर तिलक -->
                    <div id="tilak-spot" class="tilak-hidden"></div>

                    <!-- पवित्र पीतल की आरती की थाली -->
                    <div id="aarti-plate" class="aarti-hidden">
                        <span class="thali-item t1">🪔</span>
                        <span class="thali-item t2">🌸</span>
                        <span class="thali-item t3">🔴</span>
                        <span class="thali-item t4">🌸</span>
                    </div>

                    <!-- मुंह के पास काजू कतली की प्लेट -->
                    <div id="sweet-spot" class="sweet-hidden">🧁✨</div>
                </div>

                <!-- फोटो के ठीक बगल में दिखने वाली डिजिटल बाजू -->
                <div class="brother-wrist-sidebar">
                    <div class="digital-arm">
                        <!-- कलाई पर सजने वाली राखी -->
                        <div id="rakhi-spot" class="rakhi-hidden">✨💝✨</div>
                    </div>
                    <p class="wrist-label">Brother's Wrist</p>
                </div>

            </div>
            <p class="avatar-label" style="margin-top: 20px;">Click below to perform rituals!</p>
        </div>

        <!-- 4 Interactive Action Buttons -->
        <div class="celebration-actions-grid">
            <button id="btn-tilak" class="action-btn tilak-btn" onclick="applyTilak()">🔴 Apply Tilak</button>
            <button id="btn-aarti" class="action-btn aarti-btn" onclick="startJavaScriptAarti()">🪔 Start Aarti</button>
            <button id="btn-rakhi" class="action-btn rakhi-btn" onclick="tieRakhi()">💝 Tie Rakhi</button>
            <button id="btn-sweet" class="action-btn sweet-btn" onclick="toggleSweet()">🧁 Feed swets </button>
        </div>

        <!-- Pop-up Success Message WITH NEW GIFT LINK -->
        <div id="success-alert" class="alert-hidden">
            <h3>Best Sister Ever! ❤️</h3>
            <p>You have successfully performed all the rituals! Your brother is super proud of you. Now, a special surprise is waiting for you... 🤗🎁</p>
            <div style="margin-top:20px;">
                <a href="gift.php" class="btn-sister" style="display:inline-block; text-decoration:none; padding:12px 25px; width:auto; margin:0;">🎁 Claim Your Gift Screen</a>
            </div>
        </div>

        <div class="footer" style="margin-top: 40px;">
            <p><a href="index.php" style="color: #b8860b; text-decoration: none; font-weight: bold;">Back to Main Entrance</a></p>
        </div>
    </div>

    <!-- JavaScript to Handle Clicks, Toggle and Exact Animations -->
    <script>
        let tilakApplied = false;
        let aartiDone = false;
        let rakhiTied = false;
        let sweetActive = false;
        let sweetDoneAtLeastOnce = false;

        function applyTilak() {
            const tilak = document.getElementById('tilak-spot');
            const btn = document.getElementById('btn-tilak');
            tilak.className = "photo-tilak-visible animate-pop";
            btn.innerHTML = "✅ Tilak Applied";
            btn.disabled = true;
            btn.style.opacity = "0.6";
            tilakApplied = true;
            checkCelebrationComplete();
        }

        // जादुई जावास्क्रिप्ट रोटेशन जो 3 बार घूमकर अपने आप बंद होगा
                // Magic JavaScript rotation that automatically stops after exactly 1 second
        function startJavaScriptAarti() {
            const aarti = document.getElementById('aarti-plate');
            const btn = document.getElementById('btn-aarti');
            
            aarti.className = "photo-aarti-visible";
            btn.innerHTML = "⏳ Aarti in Progress...";
            btn.disabled = true; 

            let angle = 0;
            // Rotates the plate 6 degrees every 16ms for a faster spin matching the 1sec constraint
            const rotationInterval = setInterval(() => {
                angle += 6;
                aarti.style.setProperty('transform', `translate(-50%, -50%) rotate(${angle}deg)`, 'important');
            }, 16);

            // CHANGED: Exactly 1 second (1000ms) cutoff threshold interval limit
            setTimeout(() => {
                clearInterval(rotationInterval); // Stop spinning execution engine loop
                aarti.className = "aarti-hidden"; // Completely hide the plate instantly
                btn.innerHTML = "✅ Aarti Done";
                btn.style.opacity = "0.6";
                aartiDone = true;
                checkCelebrationComplete();
            }, 1000); 
        }


        function tieRakhi() {
            const rakhi = document.getElementById('rakhi-spot');
            const btn = document.getElementById('btn-rakhi');
            rakhi.className = "sidebar-rakhi-visible animate-pop-wrist";
            btn.innerHTML = "✅ Rakhi Tied";
            btn.disabled = true;
            btn.style.opacity = "0.6";
            rakhiTied = true;
            checkCelebrationComplete();
        }

        function toggleSweet() {
            const sweet = document.getElementById('sweet-spot');
            const btn = document.getElementById('btn-sweet');
            
            if (!sweetActive) {
                sweet.className = "photo-sweet-visible animate-eat";
                btn.innerHTML = "🛑 Stop Feeding";
                btn.style.background = "#d32f2f"; 
                sweetActive = true;
                sweetDoneAtLeastOnce = true;
            } else {
                sweet.className = "sweet-hidden";
                btn.innerHTML = "✅ Sweets Fed (Feed Again)";
                btn.style.background = "#20b2aa"; 
                sweetActive = false;
                checkCelebrationComplete();
            }
        }

        function checkCelebrationComplete() {
            if (tilakApplied && aartiDone && rakhiTied && sweetDoneAtLeastOnce && !sweetActive) {
                setTimeout(() => {
                    const alertBox = document.getElementById('success-alert');
                    alertBox.className = "alert-visible animate-bounce";
                }, 400);
            }
        }
    </script>
</body>
</html>
