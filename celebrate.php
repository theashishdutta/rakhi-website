<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Celebrate Rakhi Digitally ✨</title>
    <link rel="stylesheet" href="style.css">
    
    <style>
        /* थाली की डिफ़ॉल्ट डिज़ाइन बिना किसी रोटेशन एरर के */
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
            /* शुरुआत में थाली बिल्कुल सेंटर में रहेगी */
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

        <div class="photo-ritual-box">
            <div class="celebration-workspace">
                
                <div class="brother-interactive-frame">
                    <img src="photo.jpg" alt="Brother" class="brother-photo-bg">
                    <div id="tilak-spot" class="tilak-hidden"></div>

                    <!-- पवित्र पीतल की आरती की थाली -->
                    <div id="aarti-plate" class="aarti-hidden">
                        <span class="thali-item t1">🪔</span>
                        <span class="thali-item t2">🌸</span>
                        <span class="thali-item t3">🔴</span>
                        <span class="thali-item t4">🌸</span>
                    </div>

                    <div id="sweet-spot" class="sweet-hidden">🧁✨</div>
                </div>

                <div class="brother-wrist-sidebar">
                    <div class="digital-arm">
                        <div id="rakhi-spot" class="rakhi-hidden">✨💝✨</div>
                    </div>
                    <p class="wrist-label">Wrist</p>
                </div>

            </div>
            <p class="avatar-label" style="margin-top: 20px;">Click below to perform rituals!</p>
        </div>

        <div class="celebration-actions-grid">
            <button id="btn-tilak" class="action-btn tilak-btn" onclick="applyTilak()">🔴 Apply Tilak</button>
            <button id="btn-aarti" class="action-btn aarti-btn" onclick="startJavaScriptAarti()">🪔 Start Aarti</button>
            <button id="btn-rakhi" class="action-btn rakhi-btn" onclick="tieRakhi()">💝 Tie Rakhi</button>
            <button id="btn-sweet" class="action-btn sweet-btn" onclick="toggleSweet()">🧁 Sweets</button>
        </div>

        <div id="success-alert" class="alert-hidden">
            <h3>Best Sister Ever! ❤️</h3>
            <p>You have successfully performed all the rituals: Tilak, Aarti, Rakhi, and Sweet! Sending you virtual blessings and lots of love! 🤗🎁</p>
        </div>

        <div class="footer" style="margin-top: 40px;">
            <p><a href="index.php" style="color: #b8860b; text-decoration: none; font-weight: bold;">Back to Home Screen</a></p>
        </div>
    </div>

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

        // 🌟 100% वर्किंग जावास्क्रिप्ट रोटेशन एनीमेशन
        function startJavaScriptAarti() {
            const aarti = document.getElementById('aarti-plate');
            const btn = document.getElementById('btn-aarti');
            
            // थाली दिखाएँ
            aarti.className = "photo-aarti-visible";
            btn.innerHTML = "⏳ Aarti in Progress...";
            btn.disabled = true; 

            let angle = 0;
            // हर 16 मिलीसेकंड में थाली को 2 डिग्री घुमाएगा (एकदम स्मूथ मोशन)
            const rotationInterval = setInterval(() => {
                angle += 2;
                aarti.style.setProperty('transform', `translate(-50%, -50%) rotate(${angle}deg)`, 'important');
            }, 16);

            // ठीक 7.5 सेकंड (7500ms) बाद घूमना बंद करें और थाली गायब करें
            setTimeout(() => {
                clearInterval(rotationInterval); // घुमाना बंद करें
                aarti.className = "aarti-hidden"; // थाली छुपा दी
                btn.innerHTML = "✅ Aarti Done";
                btn.style.opacity = "0.6";
                aartiDone = true;
                checkCelebrationComplete();
            }, 7500); 
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
                btn.innerHTML = "✅ sweets (Feed Again)";
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
