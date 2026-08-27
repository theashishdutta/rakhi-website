<?php
session_start();
if (!isset($_SESSION['sister_auth'])) { header("Location: index.php"); exit(); }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Brother's Surprise Gift 🎁</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* गिफ्ट स्क्रीन के विशेष सीएसएस रूल्स */
        .gift-stage { margin-top: 30px; text-align: center; }
        .prank-actions { display: flex; gap: 20px; justify-content: center; position: relative; height: 60px; margin-top: 25px; }
        
        .prank-btn { padding: 12px 35px; font-size: 1.1rem; font-weight: bold; border-radius: 8px; border: none; cursor: pointer; }
        .yes-btn { background: #22c55e; color: white; box-shadow: 0 4px 12px rgba(34,197,94,0.3); }
        
        /* प्रैंक नो बटन पोजीशन */
        .no-btn { background: #ef4444; color: white; position: absolute; transition: all 0.15s cubic-bezier(0.25, 0.46, 0.45, 0.94); box-shadow: 0 4px 12px rgba(239,68,68,0.3); }

        /* पज़ल गेम बोर्ड लेआउट */
        .puzzle-box { display: none; background: #fffbf4; border: 2px dashed #d4af37; padding: 20px; border-radius: 15px; margin-top: 25px; }
        .puzzle-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 8px; width: 300px; height: 300px; margin: 0 auto; background: #f0dec2; padding: 8px; border-radius: 8px; }
        .puzzle-tile { background: #8b0000; color: #ffd700; font-size: 1.8rem; font-weight: bold; display: flex; align-items: center; justify-content: center; border-radius: 6px; cursor: pointer; user-select: none; box-shadow: 0 4px 6px rgba(0,0,0,0.1); transition: background 0.2s; }
        .puzzle-tile:hover { background: #b8860b; }
        .puzzle-tile.empty { background: transparent; box-shadow: none; cursor: default; }

        /* शगुन मनी बॉक्स */
        .money-box { display: none; background: #f0fdf4; border: 3px solid #22c55e; padding: 25px; border-radius: 15px; margin-top: 25px; }
        .money-title { color: #15803d; font-size: 1.6rem; font-weight: bold; margin-bottom: 10px; }
        .money-value { font-size: 3rem; font-weight: bold; color: #16a34a; text-shadow: 0 2px 4px rgba(0,0,0,0.1); margin: 15px 0; animation: pulseMoney 1s ease infinite alternate; }
        
        @keyframes pulseMoney { 0% { transform: scale(1); } 100% { transform: scale(1.06); } }
    </style>
</head>
<body>
    <div class="card-container text-center" style="max-width: 550px;">
        
        <div class="festival-header">
            <h1>🎁 Your Brother's Surprise Gift</h1>
            <p class="subtitle">The ultimate reward screen for the best sisters!</p>
        </div>

        <!-- स्टेज 1: प्रैंक स्क्रीन प्रॉमिस लाइन -->
        <div id="stage-prank" class="gift-stage">
            <h2 style="color: #4a0e17; font-size: 1.4rem; line-height: 1.6; background: #fff8eb; padding: 15px; border-radius: 10px; border-left: 5px solid #8b0000;">
                "Your brother's love and blessings are waiting for you... Do you want to accept them? ❤️"
            </h2>
            
            <div class="prank-actions">
                <button class="prank-btn yes-btn" onclick="startPuzzle()">YES! 😍</button>
                <!-- भागने वाला नो बटन -->
                <button id="btn-no" class="prank-btn no-btn" style="left: 60%;" onmouseover="dodgeNoButton()" onclick="dodgeNoButton()">NO 😢</button>
            </div>
        </div>

        <!-- स्टेज 2: स्लाइडिंग नंबर पज़ल गेम -->
        <div id="stage-puzzle" class="puzzle-box">
            <h3 style="color: #8b0000; margin-top: 0;">🧩 Crack the Brother-Sister Code!</h3>
            <p style="font-size: 0.95rem; margin-bottom: 15px; color: #7a7a7a;">Click adjacent tiles to sort numbers from <b>1 to 8</b> in right order!</p>
            
            <div class="puzzle-grid" id="board">
                <!-- जावास्क्रिप्ट से पज़ल ब्लॉक जनरेट होंगे -->
            </div>
            
            <button class="action-btn sweet-btn" style="margin-top: 20px; font-size: 0.9rem; padding: 8px 15px;" onclick="cheatWin()">Cheat/Skip Game 🤫</button>
        </div>

        <!-- स्टेज 3: जीतने पर शगुन मनी ब्लास्ट स्क्रीन -->
        <div id="stage-money" class="money-box animate-pop">
            <div style="font-size: 3.5rem;">🎉💵🤩</div>
            <div class="money-title">Congratulations! You Won!</div>
            <p style="color: #4b5563; font-size: 1.05rem; line-height: 1.5;">Your intelligence and dedication are unmatched. Here is your official Rakhi Shagun offer note from your brother:</p>
            
            <!-- यहाँ अपना शगुन अमाउंट सेट कर सकते हैं -->
            <div class="money-value">₹ 1100 /-</div>
            
            <p style="font-weight: bold; color: #8b0000; font-style: italic; margin-top: 15px;">"Take a screenshot of this page and send it to your brother right now to claim your instant cash/UPI shagun award! 💸📱"</p>
        </div>

        <div class="footer" style="margin-top: 45px;">
            <p><a href="index.php" style="color: #b8860b; text-decoration: none; font-weight: bold;">Back to Entrance Page</a></p>
        </div>
    </div>

    <!-- प्रैंक बटन, पज़ल गेम इंजन और विनिंग ट्रिगर्स का लॉजिक -->
    <script>
        // 1. नो बटन को डॉज (भागने) करने का कोड
        function dodgeNoButton() {
            const noBtn = document.getElementById('btn-no');
            // स्टेज कंटेनर के अंदर रैंडम कोऑर्डिनेट्स निकालना ताकि बटन कार्ड से बाहर न भागे
            const maxX = 120;
            const minX = -120;
            const maxY = 80;
            const minY = -40;

            const randomX = Math.floor(Math.random() * (maxX - minX + 1)) + minX;
            const randomY = Math.floor(Math.random() * (maxY - minY + 1)) + minY;

            noBtn.style.left = `calc(50% + ${randomX}px)`;
            noBtn.style.top = `${randomY}px`;
        }

        // 2. पज़ल गेम का डेटा और स्टेट
        let tiles = [1, 2, 3, 4, 5, 6, 7, 8, ""]; // 3x3 ग्रिड पज़ल एरे
        const winningCombination = "1,2,3,4,5,6,7,8,";

        function startPuzzle() {
            document.getElementById('stage-prank').style.display = 'none';
            document.getElementById('stage-puzzle').style.display = 'block';
            shuffleTiles();
            renderBoard();
        }

        // ब्लॉक्स को शफल (उलट-पुलट) करना ताकि गेम खेलने योग्य बने
        function shuffleTiles() {
            // सॉल्वेबल पज़ल जनरेट करने के लिए रैंडम पेयर्स को मूव करना बेहतर होता है
            for (let i = tiles.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [tiles[i], tiles[j]] = [tiles[j], tiles[i]];
            }
            // खाली ब्लॉक लास्ट में न रहे, यह पक्का करने के लिए री-चेक
            if (tiles.join(',') === winningCombination) shuffleTiles();
        }

        function renderBoard() {
            const board = document.getElementById('board');
            board.innerHTML = '';
            
            tiles.forEach((tile, index) => {
                const tileDiv = document.createElement('div');
                tileDiv.className = `puzzle-tile ${tile === "" ? 'empty' : ''}`;
                tileDiv.innerHTML = tile;
                if (tile !== "") {
                    tileDiv.onclick = () => moveTile(index);
                }
                board.appendChild(tileDiv);
            });
        }

        function moveTile(index) {
            const emptyIndex = tiles.indexOf("");
            // वैलिड मूव्स चेक करें (सिर्फ ऊपर, नीचे, बाएं, दाएं वाले ब्लॉक्स ही खाली जगह जा सकते हैं)
            const validMoves = [index - 1, index + 1, index - 3, index + 3];
            
            // ग्रिड किनारों (Row wrap checks) को फिक्स करने का लॉजिक
            const isLeftEdge = (index % 3 === 0);
            const isRightEdge = (index % 3 === 2);
            
            if (validMoves.includes(emptyIndex)) {
                if (isLeftEdge && emptyIndex === index - 1) return;
                if (isRightEdge && emptyIndex === index + 1) return;

                // स्वैप (फाइल एक्सचेंज)
                [tiles[index], tiles[emptyIndex]] = [tiles[emptyIndex], tiles[index]];
                renderBoard();
                checkWinCondition();
            }
        }

        function checkWinCondition() {
            if (tiles.join(',') === winningCombination) {
                setTimeout(() => {
                    document.getElementById('stage-puzzle').style.display = 'none';
                    document.getElementById('stage-money').style.display = 'block';
                }, 400);
            }
        }

        // चीट/स्किप बटन ताकि बहनें अगर गेम में अटक जाएं तो सीधे जीत सकें!
        function cheatWin() {
            document.getElementById('stage-puzzle').style.display = 'none';
            document.getElementById('stage-money').style.display = 'block';
        }
    </script>
</body>
</html>
