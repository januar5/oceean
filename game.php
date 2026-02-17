<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game! 🎮</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 0;
            overflow: hidden;
        }

        .game-container {
            background: white;
            border-radius: 30px;
            width: 100%;
            max-width: 420px;
            height: 100vh;
            max-height: 900px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.4);
            display: flex;
            flex-direction: column;
            position: relative;
            overflow: hidden;
            margin: auto;
        }

        @media (max-width: 480px) {
            .game-container {
                border-radius: 0;
                max-height: none;
                max-width: 100%;
                height: 100vh;
            }
        }

        .back-button {
            position: absolute;
            top: 15px;
            left: 15px;
            background: rgba(255, 255, 255, 0.9);
            color: #667eea;
            border: none;
            padding: 8px 16px;
            border-radius: 20px;
            cursor: pointer;
            font-size: 0.9em;
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            transition: all 0.3s ease;
            z-index: 100;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .back-button:active {
            transform: scale(0.95);
        }

        @media (max-width: 480px) {
            .back-button {
                padding: 6px 12px;
                font-size: 0.8em;
                top: 10px;
                left: 10px;
            }
        }

        .game-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 50px 20px 25px;
            text-align: center;
            border-radius: 0 0 30px 30px;
            color: white;
        }

        @media (max-width: 480px) {
            .game-header {
                padding: 30px 15px 20px;
                border-radius: 0;
            }
        }

        .game-header h1 {
            font-size: 1.4em;
            margin-bottom: 5px;
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        @media (max-width: 480px) {
            .game-header h1 {
                font-size: 1.1em;
            }
        }

        .game-header .subtitle {
            font-size: 0.85em;
            opacity: 0.9;
            font-weight: 400;
        }

        .content-wrapper {
            flex: 1;
            overflow-y: auto;
            padding: 20px;
            display: flex;
            flex-direction: column;
        }

        @media (max-width: 480px) {
            .content-wrapper {
                padding: 15px;
                gap: 10px;
            }
        }

        /* Start Screen */
        .start-screen {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .welcome-card {
            background: linear-gradient(135deg, #FFE66D, #FF6B6B);
            border-radius: 20px;
            padding: 25px;
            text-align: center;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        }

        @media (max-width: 480px) {
            .welcome-card {
                padding: 18px;
                border-radius: 15px;
            }
        }

        .welcome-card h2 {
            font-size: 1.8em;
            margin-bottom: 10px;
            color: white;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
        }

        .welcome-card p {
            color: rgba(255,255,255,0.95);
            font-size: 0.95em;
            line-height: 1.5;
        }

        @media (max-width: 480px) {
            .welcome-card h2 {
                font-size: 1.3em;
            }

            .welcome-card p {
                font-size: 0.85em;
            }
        }

        .instructions-card {
            background: #F8F9FA;
            border-radius: 20px;
            padding: 20px;
        }

        @media (max-width: 480px) {
            .instructions-card {
                padding: 15px;
                border-radius: 15px;
            }
        }

        .instructions-card h3 {
            color: #667eea;
            font-size: 1.1em;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        @media (max-width: 480px) {
            .instructions-card h3 {
                font-size: 0.95em;
                margin-bottom: 12px;
            }
        }

        .instruction-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px;
            background: white;
            border-radius: 15px;
            margin-bottom: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        @media (max-width: 480px) {
            .instruction-item {
                gap: 10px;
                padding: 10px;
                margin-bottom: 8px;
            }
        }

        .instruction-item:last-child {
            margin-bottom: 0;
        }

        .legend-img {
            width: 45px;
            height: 45px;
            object-fit: cover;
            border-radius: 12px;
            flex-shrink: 0;
        }

        @media (max-width: 480px) {
            .legend-img {
                width: 38px;
                height: 38px;
                border-radius: 10px;
            }
        }

        .instruction-text {
            flex: 1;
            font-size: 0.9em;
            color: #333;
            line-height: 1.4;
        }

        .instruction-text strong {
            color: #667eea;
            display: block;
            font-size: 0.95em;
            margin-bottom: 2px;
        }

        .instruction-text .points {
            color: #FF6B6B;
            font-weight: 600;
        }

        @media (max-width: 480px) {
            .instruction-text {
                font-size: 0.8em;
            }

            .instruction-text strong {
                font-size: 0.85em;
            }
        }

        .start-button {
            background: linear-gradient(135deg, #667eea, #764ba2);
            border: none;
            padding: 18px;
            font-size: 1.1em;
            border-radius: 20px;
            cursor: pointer;
            color: white;
            font-weight: 700;
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
            transition: all 0.3s ease;
            margin-top: auto;
        }

        .start-button:active {
            transform: scale(0.97);
        }

        @media (max-width: 480px) {
            .start-button {
                padding: 14px;
                font-size: 0.95em;
                border-radius: 15px;
            }
        }

        /* Game Screen */
        .game-screen {
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .score-board {
            display: flex;
            justify-content: space-around;
            padding: 15px 20px;
            gap: 10px;
        }

        @media (max-width: 480px) {
            .score-board {
                padding: 10px 15px;
                gap: 8px;
            }
        }

        .score-item {
            background: linear-gradient(135deg, #FFE66D, #FF6B6B);
            padding: 12px 20px;
            border-radius: 20px;
            text-align: center;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            flex: 1;
        }

        @media (max-width: 480px) {
            .score-item {
                padding: 8px 12px;
                border-radius: 15px;
            }
        }

        .score-item .label {
            font-size: 0.8em;
            opacity: 0.9;
            display: block;
            margin-bottom: 3px;
        }

        .score-item .value {
            font-size: 1.4em;
            font-weight: 700;
            color: white;
        }

        @media (max-width: 480px) {
            .score-item .label {
                font-size: 0.7em;
            }

            .score-item .value {
                font-size: 1.1em;
            }
        }

        .game-area {
            flex: 1;
            background: linear-gradient(180deg, #87CEEB 0%, #E0F6FF 100%);
            margin: 0 20px 20px;
            border-radius: 20px;
            position: relative;
            overflow: hidden;
            box-shadow: inset 0 4px 10px rgba(0,0,0,0.1);
        }

        @media (max-width: 480px) {
            .game-area {
                margin: 0 15px 15px;
                border-radius: 15px;
            }
        }

        .catcher {
            position: absolute;
            bottom: 20px;
            width: 55px;
            height: 55px;
            font-size: 45px;
            transition: left 0.1s;
            cursor: grab;
            z-index: 10;
            filter: drop-shadow(0 4px 6px rgba(0,0,0,0.2));
        }

        @media (max-width: 480px) {
            .catcher {
                width: 45px;
                height: 45px;
                font-size: 35px;
                bottom: 15px;
            }
        }

        .falling-item {
            position: absolute;
            width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: fall linear;
            cursor: pointer;
        }

        @media (max-width: 480px) {
            .falling-item {
                width: 38px;
                height: 38px;
            }
        }

        .falling-img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            pointer-events: none;
            filter: drop-shadow(0 2px 4px rgba(0,0,0,0.2));
        }

        @keyframes fall {
            to {
                top: 100%;
            }
        }

        .explosion {
            position: absolute;
            font-size: 28px;
            animation: explode 0.5s ease-out;
            pointer-events: none;
        }

        @keyframes explode {
            0% {
                transform: scale(0);
                opacity: 1;
            }
            100% {
                transform: scale(2);
                opacity: 0;
            }
        }

        /* End Screen */
        .end-screen {
            display: flex;
            flex-direction: column;
            gap: 20px;
            padding-bottom: 10px;
        }

        .end-screen h2 {
            color: #667eea;
            font-size: 1.6em;
            text-align: center;
            margin-bottom: 5px;
        }

        @media (max-width: 480px) {
            .end-screen h2 {
                font-size: 1.2em;
            }
        }

        .result-card {
            background: linear-gradient(135deg, #FFE66D, #FF6B6B);
            border-radius: 20px;
            padding: 25px;
            text-align: center;
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        }

        @media (max-width: 480px) {
            .result-card {
                padding: 18px;
                border-radius: 15px;
            }
        }

        .result-card h3 {
            font-size: 1.3em;
            color: white;
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
        }

        .final-score-big {
            font-size: 3em;
            font-weight: 700;
            color: white;
            text-shadow: 3px 3px 6px rgba(0,0,0,0.3);
            margin: 10px 0;
        }

        @media (max-width: 480px) {
            .result-card h3 {
                font-size: 1.1em;
            }

            .final-score-big {
                font-size: 2em;
            }
        }

        .result-message {
            color: rgba(255,255,255,0.95);
            font-size: 1em;
            line-height: 1.5;
        }

        .message-card {
            background: #F8F9FA;
            border-radius: 20px;
            padding: 20px;
        }

        @media (max-width: 480px) {
            .message-card {
                padding: 15px;
                border-radius: 15px;
            }
        }

        .message-card h3 {
            color: #667eea;
            font-size: 1.1em;
            margin-bottom: 12px;
            text-align: center;
        }

        .message-card p {
            color: #555;
            font-size: 0.95em;
            line-height: 1.6;
            text-align: center;
        }

        @media (max-width: 480px) {
            .message-card h3 {
                font-size: 0.95em;
            }

            .message-card p {
                font-size: 0.85em;
            }
        }

        .restart-button {
            background: linear-gradient(135deg, #667eea, #764ba2);
            border: none;
            padding: 18px;
            font-size: 1.1em;
            border-radius: 20px;
            cursor: pointer;
            color: white;
            font-weight: 700;
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
            transition: all 0.3s ease;
            margin-top: auto;
        }

        .restart-button:active {
            transform: scale(0.97);
        }

        @media (max-width: 480px) {
            .restart-button {
                padding: 14px;
                font-size: 0.95em;
                border-radius: 15px;
            }
        }

        .hidden {
            display: none !important;
        }

        .confetti-bg {
            position: fixed;
            width: 10px;
            height: 10px;
            animation: confettiFall 3s linear infinite;
        }

        @keyframes confettiFall {
            to {
                transform: translateY(100vh) rotate(360deg);
                opacity: 0;
            }
        }

        /* Scrollbar styling */
        .content-wrapper::-webkit-scrollbar {
            width: 6px;
        }

        .content-wrapper::-webkit-scrollbar-track {
            background: transparent;
        }

        .content-wrapper::-webkit-scrollbar-thumb {
            background: rgba(102, 126, 234, 0.3);
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <div class="game-container">
        <button class="back-button" onclick="backToMenu()">← Menu</button>
        
        <div class="game-header">
            <h1>🎮 Game Terbaik Sepanjang masa</h1>
            <div class="subtitle">Semoga game ini bisa membuatmu bahagia</div>
        </div>

        <!-- Start Screen -->
        <div id="start-screen" class="content-wrapper">
            <div class="start-screen">
                <div class="welcome-card">
                    <h2>Permainan Dimulai!</h2>
                    <p>Tangkap ocee sebanyak mungkin yang berjatuhan, good luck!</p>
                </div>

                <div class="instructions-card">
                    <h3>📋 Cara Bermain</h3>
                    
                    <div class="instruction-item">
                        <img src="assets/ocee8.jpg" alt="Ocee" class="legend-img">
                        <div class="instruction-text">
                            <strong>Tangkap Ocee</strong>
                            <span class="points">+10 poin</span>
                        </div>
                    </div>

                    <div class="instruction-item">
                        <img src="assets/ocee6.jpg" alt="Rose" class="legend-img">
                        <div class="instruction-text">
                            <strong>Tangkap Rose</strong>
                            <span class="points">+15 poin</span>
                        </div>
                    </div>

                    <div class="instruction-item">
                        <img src="assets/ocee4.jpg" alt="Kadew" class="legend-img">
                        <div class="instruction-text">
                            <strong>Tangkap Kadew</strong>
                            <span class="points">+5 poin</span>
                        </div>
                    </div>

                    <div class="instruction-item">
                        <img src="assets/bomb.svg" alt="Bom" class="legend-img">
                        <div class="instruction-text">
                            <strong>HINDARI BOM!</strong>
                            <span class="points">-20 poin</span>
                        </div>
                    </div>

                    <div class="instruction-item">
                        <img src="assets/clock.svg" alt="Waktu" class="legend-img">
                        <div class="instruction-text">
                            <strong>Waktu Bermain</strong>
                            Kamu punya 30 detik!
                        </div>
                    </div>
                </div>

                <button class="start-button" onclick="startGame()">MULAI MAIN! 🚀</button>
            </div>
        </div>

        <!-- Game Screen -->
        <div id="game-screen" class="game-screen hidden">
            <div class="score-board">
                <div class="score-item">
                    <span class="label">🎯 Skor</span>
                    <div class="value" id="score">0</div>
                </div>
                <div class="score-item">
                    <span class="label">⏱️ Waktu</span>
                    <div class="value"><span id="timer">30</span>s</div>
                </div>
            </div>
            
            <div class="game-area" id="game-area">
                <div class="catcher" id="catcher">🧺</div>
            </div>
        </div>

        <!-- End Screen -->
        <div id="end-screen" class="content-wrapper hidden">
            <div class="end-screen">
                <h2>🎊 PERMAINAN SELESAI! 🎊</h2>
                
                <div class="result-card">
                    <h3>Skor Akhir</h3>
                    <div class="final-score-big" id="final-score">0</div>
                    <p class="result-message" id="result-message"></p>
                </div>

                <div class="message-card">
                    <h3> mission complete 🥳</h3>
                    <p> Yey selesai 🤍🌟</p>
                </div>

                <button class="restart-button" onclick="restartGame()">MAIN LAGI! 🔄</button>
            </div>
        </div>
    </div>

    <script>
        let score = 0;
        let timeLeft = 30;
        let gameInterval;
        let timerInterval;
        let spawnInterval;
        let gameActive = false;
        let catcherPos = 50;

        const gameArea = document.getElementById('game-area');
        const catcher = document.getElementById('catcher');
        const items = [
            { src: 'assets/ocee8.jpg', alt: 'ocee', points: 10, prob: 0.3 },
            { src: 'assets/ocee6.jpg', alt: 'Rose', points: 15, prob: 0.25 },
            { src: 'assets/ocee4.jpg', alt: 'kadew', points: 5, prob: 0.3 },
            { src: 'assets/bomb.svg', alt: 'Bom', points: -20, prob: 0.15 }
        ];

        // Mouse movement
        gameArea.addEventListener('mousemove', (e) => {
            if (!gameActive) return;
            const rect = gameArea.getBoundingClientRect();
            const catcherWidth = catcher.offsetWidth;
            let x = e.clientX - rect.left - (catcherWidth / 2);
            x = Math.max(0, Math.min(x, rect.width - catcherWidth));
            catcher.style.left = x + 'px';
            catcherPos = x + (catcherWidth / 2);
        });

        // Touch movement for mobile
        gameArea.addEventListener('touchmove', (e) => {
            if (!gameActive) return;
            e.preventDefault();
            const rect = gameArea.getBoundingClientRect();
            const catcherWidth = catcher.offsetWidth;
            let x = e.touches[0].clientX - rect.left - (catcherWidth / 2);
            x = Math.max(0, Math.min(x, rect.width - catcherWidth));
            catcher.style.left = x + 'px';
            catcherPos = x + (catcherWidth / 2);
        });

        function startGame() {
            document.getElementById('start-screen').classList.add('hidden');
            document.getElementById('game-screen').classList.remove('hidden');
            
            score = 0;
            timeLeft = 30;
            gameActive = true;
            updateScore();
            updateTimer();

            const rect = gameArea.getBoundingClientRect();
            const catcherWidth = catcher.offsetWidth;
            catcher.style.left = (rect.width / 2 - catcherWidth / 2) + 'px';
            catcherPos = rect.width / 2;

            spawnInterval = setInterval(spawnItem, 800);
            timerInterval = setInterval(() => {
                timeLeft--;
                updateTimer();
                if (timeLeft <= 0) {
                    endGame();
                }
            }, 1000);
        }

        function spawnItem() {
            if (!gameActive) return;

            const rand = Math.random();
            let cumProb = 0;
            let selectedItem;

            for (let item of items) {
                cumProb += item.prob;
                if (rand <= cumProb) {
                    selectedItem = item;
                    break;
                }
            }

            const fallingItem = document.createElement('div');
            fallingItem.className = 'falling-item';
            fallingItem.dataset.points = selectedItem.points;

            if (selectedItem.src) {
                const img = document.createElement('img');
                img.src = selectedItem.src;
                img.alt = selectedItem.alt || '';
                img.className = 'falling-img';
                fallingItem.appendChild(img);
            } else if (selectedItem.emoji) {
                fallingItem.textContent = selectedItem.emoji;
            }

            const rect = gameArea.getBoundingClientRect();
            const randomX = Math.random() * (rect.width - 50);
            fallingItem.style.left = randomX + 'px';
            fallingItem.style.top = '-60px';

            const duration = 3 + Math.random() * 2;
            fallingItem.style.animationDuration = duration + 's';

            gameArea.appendChild(fallingItem);

            const checkCollision = setInterval(() => {
                if (!gameActive) {
                    clearInterval(checkCollision);
                    return;
                }

                const itemRect = fallingItem.getBoundingClientRect();
                const catcherRect = catcher.getBoundingClientRect();
                const gameRect = gameArea.getBoundingClientRect();

                if (itemRect.bottom >= catcherRect.top &&
                    itemRect.top <= catcherRect.bottom &&
                    itemRect.right >= catcherRect.left &&
                    itemRect.left <= catcherRect.right) {
                    
                    const points = parseInt(fallingItem.dataset.points);
                    score += points;
                    updateScore();

                    createExplosion(itemRect.left - gameRect.left, itemRect.top - gameRect.top, points > 0 ? '✨' : '💥');
                    
                    fallingItem.remove();
                    clearInterval(checkCollision);
                }

                if (itemRect.top > gameRect.bottom) {
                    fallingItem.remove();
                    clearInterval(checkCollision);
                }
            }, 50);

            setTimeout(() => {
                if (fallingItem.parentNode) {
                    fallingItem.remove();
                }
            }, duration * 1000);
        }

        function createExplosion(x, y, emoji) {
            for (let i = 0; i < 5; i++) {
                const explosion = document.createElement('div');
                explosion.className = 'explosion';
                explosion.textContent = emoji;
                explosion.style.left = x + 'px';
                explosion.style.top = y + 'px';
                gameArea.appendChild(explosion);

                setTimeout(() => explosion.remove(), 500);
            }
        }

        function updateScore() {
            document.getElementById('score').textContent = score;
        }

        function updateTimer() {
            document.getElementById('timer').textContent = timeLeft;
        }

        function endGame() {
            gameActive = false;
            clearInterval(spawnInterval);
            clearInterval(timerInterval);

            document.getElementById('game-screen').classList.add('hidden');
            document.getElementById('end-screen').classList.remove('hidden');
            document.getElementById('final-score').textContent = score;

            let message = '';
            if (score >= 200) {
                message = '🏆 Keren banget cewe ini! 🌟';
            } else if (score >= 150) {
                message = '🎉 Hebat kamu rose! dikit lagi perfect💪';
            } else if (score >= 100) {
                message = '😊 Keren rose! Coba sekali lagi yaa 🎈';
            } else if (score >= 50) {
                message = '👍 Tetap Semangat rose! Lain kali pasti bisa lebih 🎯';
            } else {
                message = '😄 WKKWKKWKWWKWK! Ini game gampang  kok gabisa wkwk 🎊';
            }

            document.getElementById('result-message').textContent = message;
            createConfetti();
        }

        function createConfetti() {
            const colors = ['#FF6B6B', '#4ECDC4', '#FFE66D', '#95E1D3', '#F38181'];
            for (let i = 0; i < 50; i++) {
                const confetti = document.createElement('div');
                confetti.className = 'confetti-bg';
                confetti.style.left = Math.random() * 100 + '%';
                confetti.style.background = colors[Math.floor(Math.random() * colors.length)];
                confetti.style.animationDelay = Math.random() * 3 + 's';
                document.body.appendChild(confetti);

                setTimeout(() => confetti.remove(), 3000);
            }
        }

        function restartGame() {
            document.getElementById('end-screen').classList.add('hidden');
            document.getElementById('start-screen').classList.remove('hidden');
            
            const items = document.querySelectorAll('.falling-item');
            items.forEach(item => item.remove());
        }

function backToMenu() {
    location.href = './';
}


    </script>
</body>
</html>