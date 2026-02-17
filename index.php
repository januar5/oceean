<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secret Message</title>
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
            position: relative;
            overflow-y: auto;
            overflow-x: hidden;
        }

        .particles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 1;
        }

        .particle {
            position: absolute;
            font-size: 24px;
            animation: float 10s infinite;
            opacity: 0.6;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(100vh) rotate(0deg);
                opacity: 0;
            }
            10% {
                opacity: 0.6;
            }
            90% {
                opacity: 0.6;
            }
            100% {
                transform: translateY(-100px) rotate(360deg);
                opacity: 0;
            }
        }

        .lock-screen, .birthday-page, .menu-page, .gallery-page, .cake-page {
            display: none;
            position: relative;
            z-index: 10;
        }

        .lock-screen.active, .birthday-page.active, .menu-page.active, .gallery-page.active, .cake-page.active {
            display: block;
        }

        .menu-container {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(20px);
            padding: 50px 40px;
            border-radius: 30px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.15);
            text-align: center;
            animation: slideInScale 0.5s ease;
            max-width: 450px;
        }

        @keyframes slideInScale {
            0% {
                opacity: 0;
                transform: translateY(-30px) scale(0.9);
            }
            100% {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .menu-header {
            margin-bottom: 40px;
        }

        .menu-container h1 {
            font-size: 2.8em;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 10px;
            font-weight: 800;
        }

        .menu-subtitle {
            font-size: 1.1em;
            color: #666;
            font-weight: 500;
        }

        .menu-list {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .menu-item {
            background: white;
            padding: 0;
            border-radius: 18px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            text-decoration: none;
            display: block;
            overflow: hidden;
            border: 2px solid transparent;
        }

        .menu-item:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
            border-color: rgba(102, 126, 234, 0.3);
        }

        .menu-item-content {
            display: flex;
            align-items: center;
            padding: 20px 25px;
            gap: 20px;
        }

        .menu-icon-circle {
            width: 55px;
            height: 55px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            flex-shrink: 0;
            transition: transform 0.3s ease;
        }

        .menu-item:hover .menu-icon-circle {
            transform: scale(1.1) rotate(5deg);
        }

        .menu-item.game .menu-icon-circle {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        }

        .menu-item.gallery .menu-icon-circle {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        }

        .menu-item.message .menu-icon-circle {
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
        }

        .menu-item.wishes .menu-icon-circle {
            background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
        }

        .menu-text {
            flex: 1;
            text-align: left;
        }

        .menu-title {
            color: #333;
            font-size: 1.2em;
            font-weight: 700;
            margin-bottom: 3px;
        }

        .menu-desc {
            color: #999;
            font-size: 0.85em;
            font-weight: 500;
        }

        .menu-arrow {
            color: #ccc;
            font-size: 20px;
            transition: transform 0.3s ease;
        }

        .menu-item:hover .menu-arrow {
            transform: translateX(5px);
            color: #667eea;
        }

        .lock-container {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(20px);
            padding: 50px 40px;
            border-radius: 30px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.15);
            text-align: center;
            animation: slideInScale 0.5s ease;
            max-width: 450px;
        }

        .lock-icon {
            width: 180px;
            height: 180px;
            border-radius: 50%;
            margin: 0 auto 30px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 80px;
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
            border: 5px solid white;
            overflow: hidden;
        }

        .lock-icon img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        h2 {
            color: #333;
            margin-bottom: 10px;
            font-size: 24px;
            font-weight: 600;
            letter-spacing: 1px;
        }

        .hint {
            color: #999;
            font-size: 13px;
            margin-bottom: 35px;
            font-weight: 400;
        }

        .password-display {
            background: transparent;
            border: none;
            padding: 20px;
            border-radius: 15px;
            font-size: 32px;
            letter-spacing: 15px;
            margin-bottom: 35px;
            min-height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Courier New', monospace;
            color: #333;
        }

        .keypad {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
            margin-bottom: 0;
        }

        .key {
            padding: 20px;
            font-size: 24px;
            font-weight: 500;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            background: rgba(240, 240, 245, 0.9);
            color: #333;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            transition: all 0.2s ease;
        }

        .key:hover {
            background: rgba(230, 230, 240, 0.95);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .key:active {
            transform: translateY(0);
            background: rgba(220, 220, 235, 1);
        }

        .key.zero {
            grid-column: 2;
        }

        .key.clear {
            background: rgba(255, 240, 240, 0.9);
            color: #ff6b6b;
            box-shadow: 0 2px 8px rgba(255, 107, 107, 0.1);
        }

        .key.clear:hover {
            background: rgba(255, 230, 230, 0.95);
            box-shadow: 0 4px 12px rgba(255, 107, 107, 0.15);
        }

        .submit-btn {
            display: none;
        }

        .error {
            color: #ff6b6b;
            font-size: 14px;
            margin-top: 25px;
            min-height: 25px;
            font-weight: 500;
        }

        .error.shake {
            animation: shake 0.5s;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-10px); }
            75% { transform: translateX(10px); }
        }

        .gallery-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            padding: 50px 40px;
            border-radius: 30px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.2);
            text-align: center;
            animation: slideInScale 0.5s ease;
            max-width: 900px;
        }

        .gallery-container h1 {
            font-size: 3em;
            color: #667eea;
            margin-bottom: 40px;
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .gallery-item {
            aspect-ratio: 1;
            border-radius: 20px;
            background: #667eea;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 80px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
            overflow: hidden;
        }

        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .gallery-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 35px rgba(102, 126, 234, 0.4);
        }

        .back-btn {
            padding: 15px 40px;
            font-size: 1.2em;
            font-weight: bold;
            background: #667eea;
            color: white;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
        }

        .back-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(102, 126, 234, 0.4);
        }

        .birthday-page {
            width: 100%;
            max-width: 1000px;
            padding: 20px;
        }

        .confirmation-step {
            display: none;
        }

        .confirmation-step.active {
            display: block;
        }

        .confirm-container {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(20px);
            padding: 50px 40px;
            border-radius: 30px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.15);
            text-align: center;
            animation: slideInScale 0.5s ease;
            max-width: 500px;
            margin: 0 auto;
        }

        .confirm-illustration {
            margin-bottom: 30px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .confirm-illustration .emoji-large {
            font-size: 150px;
            animation: bounceEmoji 2s infinite;
        }

        .confirm-illustration img {
            width: 220px;
            height: 220px;
            object-fit: contain;
            border-radius: 20px;
            animation: bounceEmoji 2s infinite;
        }

        @keyframes bounceEmoji {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .confirm-question {
            font-size: 1.8em;
            color: #333;
            margin-bottom: 40px;
            font-weight: 600;
            line-height: 1.5;
        }

        .confirm-buttons {
            display: flex;
            gap: 15px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .confirm-btn {
            padding: 18px 45px;
            font-size: 1.2em;
            font-weight: 600;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .confirm-btn.yes {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .confirm-btn.yes:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 30px rgba(102, 126, 234, 0.4);
        }

        .confirm-btn.no {
            background: linear-gradient(135deg, #ffc3a0 0%, #ffafbd 100%);
            color: white;
        }

        .confirm-btn.no:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 30px rgba(255, 175, 189, 0.4);
        }

        .hearts-floating {
            position: absolute;
            font-size: 30px;
            animation: heartFloat 3s ease-in-out infinite;
        }

        @keyframes heartFloat {
            0%, 100% { 
                transform: translateY(0) rotate(0deg);
                opacity: 0.8;
            }
            50% { 
                transform: translateY(-20px) rotate(10deg);
                opacity: 1;
            }
        }

        .birthday-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            padding: 60px 40px;
            border-radius: 30px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.2);
            text-align: center;
            animation: slideInScale 0.5s ease;
        }

        .birthday-header {
            margin-bottom: 40px;
        }

        .profile-section {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 30px;
            margin-bottom: 40px;
            flex-wrap: wrap;
        }

        .profile-image-container {
            position: relative;
        }

        .profile-image {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            object-fit: cover;
            border: 6px solid white;
            box-shadow: 0 15px 40px rgba(102, 126, 234, 0.3);
            animation: float-gentle 3s ease-in-out infinite;
        }

        @keyframes float-gentle {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
        }

        .sparkles {
            position: absolute;
            top: -10px;
            right: -10px;
            font-size: 40px;
            animation: sparkle-rotate 4s linear infinite;
        }

        @keyframes sparkle-rotate {
            0%, 100% { transform: rotate(0deg) scale(1); }
            50% { transform: rotate(180deg) scale(1.2); }
        }

        .birthday-info {
            flex: 1;
            min-width: 300px;
            text-align: left;
        }

        .birthday-info h1 {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-size: 3em;
            margin-bottom: 15px;
            font-weight: 800;
        }

        .birthday-info .name {
            color: #333;
            font-size: 1.8em;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .birthday-info .date {
            color: #999;
            font-size: 1.2em;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .letter-container {
            background: linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%);
            padding: 50px 40px;
            border-radius: 25px;
            box-shadow: 0 15px 40px rgba(252, 182, 159, 0.4);
            position: relative;
            margin: 30px 0;
            overflow: hidden;
        }

        .letter-container::before {
            content: '✉️';
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 60px;
            opacity: 0.2;
        }

        .letter-content {
            position: relative;
            z-index: 1;
        }

        .letter-title {
            font-size: 2em;
            color: #764ba2;
            margin-bottom: 25px;
            font-weight: 700;
            font-family: 'Georgia', serif;
        }

        .letter-text {
            color: #333;
            font-size: 1.2em;
            line-height: 2;
            text-align: left;
            font-weight: 500;
            margin-bottom: 15px;
        }

        .letter-signature {
            text-align: right;
            color: #764ba2;
            font-size: 1.3em;
            font-weight: 600;
            margin-top: 30px;
            font-style: italic;
        }

        .decorative-line {
            width: 80%;
            height: 3px;
            background: linear-gradient(90deg, transparent, #764ba2, transparent);
            margin: 30px auto;
            border-radius: 2px;
        }

        .wishes-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin: 40px 0;
        }

        .wish-card {
            background: white;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .wish-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(102, 126, 234, 0.2);
        }

        .wish-icon {
            width: 90px;
            height: 90px;
            margin: 0 auto 15px;
        }

        .wish-icon img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            border-radius: 18px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
        }

        .wish-title {
            color: #667eea;
            font-size: 1.3em;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .wish-text {
            color: #666;
            font-size: 1em;
            line-height: 1.6;
        }

        .balloons-decoration {
            font-size: 50px;
            margin-top: 30px;
            letter-spacing: 15px;
            animation: balloon-float 3s ease-in-out infinite;
        }

        @keyframes balloon-float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }

        .cake-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            padding: 50px 40px;
            border-radius: 30px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.2);
            text-align: center;
            animation: slideInScale 0.5s ease;
            max-width: 600px;
        }

        .cake-container h1 {
            font-size: 2.5em;
            background: linear-gradient(135deg, #ff6b9d 0%, #c06c84 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 20px;
            font-weight: 800;
        }

        @keyframes valentineHeartBeat {
            0%, 100% { transform: scale(1); }
            25% { transform: scale(1.1); }
            50% { transform: scale(1); }
            75% { transform: scale(1.15); }
        }

        @keyframes numberPulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.2); }
        }

        .send-love-btn:hover {
            transform: translateY(-3px) scale(1.05) !important;
            box-shadow: 0 12px 35px rgba(255, 107, 157, 0.6) !important;
        }

        .send-love-btn:active {
            transform: scale(0.95) !important;
        }

        .valentine-yes-btn:hover {
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 12px 35px rgba(255, 107, 157, 0.6);
        }

        .valentine-yes-btn:active {
            transform: scale(0.95);
        }

        .valentine-no-btn:hover {
            background: linear-gradient(135deg, #ffcdd2 0%, #ef9a9a 100%) !important;
            color: #c62828 !important;
            z-index: 9999 !important;
        }

        .valentine-confirm-buttons {
            position: relative;
            min-height: 80px;
        }

        .valentine-no-btn {
            z-index: 100;
        }

        .floating-heart {
            position: absolute;
            font-size: 30px;
            animation: floatUpHeart 3s ease-in forwards;
        }

        @keyframes floatUpHeart {
            0% {
                transform: translateY(0) rotate(0deg);
                opacity: 1;
            }
            100% {
                transform: translateY(-500px) rotate(180deg);
                opacity: 0;
            }
        }

        .confetti-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 1000;
        }

        .confetti {
            position: absolute;
            font-size: 30px;
            animation: confettiFall 3s linear;
        }

        @keyframes confettiFall {
            0% {
                transform: translateY(-100px) rotate(0deg);
                opacity: 1;
            }
            100% {
                transform: translateY(100vh) rotate(720deg);
                opacity: 0;
            }
        }

        @media (max-width: 768px) {
            .birthday-page {
                padding: 15px;
            }

            .birthday-card {
                padding: 40px 20px;
                margin: 0;
            }

            .confirm-container {
                padding: 40px 25px;
                margin: 0 15px;
            }

            .confirm-question {
                font-size: 1.4em;
            }

            .confirm-btn {
                padding: 15px 35px;
                font-size: 1.1em;
            }

            .birthday-info h1 {
                font-size: 2.2em;
            }

            .letter-container {
                padding: 35px 25px;
                margin: 20px 0;
            }

            .letter-title {
                font-size: 1.6em;
            }

            .letter-text {
                font-size: 1.05em;
            }

            .menu-list {
                gap: 12px;
            }
        }

        @media (max-width: 480px) {
            .lock-container, .menu-container, .gallery-container, .cake-container {
                padding: 35px 25px;
            }
            
            .key {
                padding: 20px;
                font-size: 22px;
            }
            
            .password-display {
                font-size: 30px;
                letter-spacing: 8px;
            }

            .birthday-page {
                padding: 10px;
                width: 100%;
                box-sizing: border-box;
            }

            .birthday-card {
                padding: 30px 15px;
                margin: 0;
                width: 100%;
                box-sizing: border-box;
            }

            .confirm-container {
                padding: 35px 20px;
                margin: 0 10px;
                max-width: calc(100% - 20px);
            }

            .confirm-illustration img {
                width: 160px;
                height: 160px;
            }

            .confirm-question {
                font-size: 1.2em;
                margin-bottom: 30px;
            }

            .confirm-buttons {
                gap: 12px;
            }

            .confirm-btn {
                padding: 14px 30px;
                font-size: 1em;
            }

            .profile-section {
                flex-direction: column;
                gap: 20px;
            }

            .profile-image {
                width: 140px;
                height: 140px;
            }

            .sparkles {
                font-size: 30px;
                top: -5px;
                right: -5px;
            }

            .birthday-info {
                text-align: center;
                width: 100%;
            }

            .birthday-info h1 {
                font-size: 1.8em;
                margin-bottom: 10px;
            }

            .birthday-info .name {
                font-size: 1.3em;
            }

            .birthday-info .date {
                justify-content: center;
                font-size: 0.95em;
            }

            .letter-container {
                padding: 25px 18px;
                margin: 20px 0;
            }

            .letter-container::before {
                font-size: 40px;
                top: 15px;
                right: 15px;
            }

            .letter-title {
                font-size: 1.3em;
                margin-bottom: 20px;
            }

            .letter-text {
                font-size: 0.95em;
                line-height: 1.7;
            }

            .letter-signature {
                font-size: 1.1em;
                margin-top: 20px;
            }

            .wishes-grid {
                grid-template-columns: 1fr;
                gap: 15px;
                margin: 30px 0;
            }

            .wish-card {
                padding: 25px 20px;
            }

            .balloons-decoration {
                font-size: 35px;
                letter-spacing: 10px;
            }

            .menu-container h1 {
                font-size: 2.2em;
            }

            .menu-subtitle {
                font-size: 0.95em;
            }

            .menu-item-content {
                padding: 18px 20px;
                gap: 15px;
            }

            .menu-icon-circle {
                width: 48px;
                height: 48px;
                font-size: 24px;
            }

            .menu-title {
                font-size: 1.1em;
            }

            .menu-desc {
                font-size: 0.8em;
            }

            .gallery-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 15px;
            }

            .gallery-item {
                font-size: 50px;
            }

            .wish-icon {
                width: 70px;
                height: 70px;
                margin-bottom: 12px;
            }

            .wish-icon img {
                border-radius: 14px;
            }

            .cake-container h1 {
                font-size: 2em;
            }

            .valentine-confirm-buttons {
                min-height: 140px !important;
                padding: 15px !important;
            }

            .valentine-yes-btn, .valentine-no-btn {
                padding: 15px 40px !important;
                font-size: 1.1em !important;
            }
        }
    </style>
</head>
<body>
    <div class="particles" id="particles"></div>

    <div class="lock-screen active">
        <div class="lock-container">
            <div class="lock-icon">
                <img src="assets/ocee2.jpg" alt="Profile Photo" id="profilePhoto">
            </div>
            <h2>Masukin kodenya dulu yaa </h2>
            <p class="hint">Petunjuk : Tanggal dan Bulan ulang tahun kamu</p>
            
            <div class="password-display" id="display">○ ○ ○ ○</div>
            
            <div class="keypad">
                <button class="key" onclick="addNumber('1')">1</button>
                <button class="key" onclick="addNumber('2')">2</button>
                <button class="key" onclick="addNumber('3')">3</button>
                <button class="key" onclick="addNumber('4')">4</button>
                <button class="key" onclick="addNumber('5')">5</button>
                <button class="key" onclick="addNumber('6')">6</button>
                <button class="key" onclick="addNumber('7')">7</button>
                <button class="key" onclick="addNumber('8')">8</button>
                <button class="key" onclick="addNumber('9')">9</button>
                <button class="key clear" onclick="clearPassword()">⌫</button>
                <button class="key zero" onclick="addNumber('0')">0</button>
            </div>
            
            <div class="error" id="error"></div>
        </div>
    </div>

    <div class="menu-page">
        <div class="menu-container">
            <div class="menu-header">
                <h1>🎉 Selamat Datang Oceee!</h1>
                <p class="menu-subtitle">Bebas pilih mau coba apa dulu selamat bersenang senang!</p>
            </div>
            
            <div class="menu-list">
                <a href="game.php" class="menu-item game">
                    <div class="menu-item-content">
                        <div class="menu-icon-circle">🎮</div>
                        <div class="menu-text">
                            <div class="menu-title">Game</div>
                            <div class="menu-desc">Gamenya seru banget tau (menurut aku sih hehe)</div>
                        </div>
                        <div class="menu-arrow">›</div>
                    </div>
                </a>
                
                <div class="menu-item gallery" onclick="showGallery()">
                    <div class="menu-item-content">
                        <div class="menu-icon-circle">📸</div>
                        <div class="menu-text">
                            <div class="menu-title">Our Memories 💌</div>
                            <div class="menu-desc">Dunia Roblox</div>
                        </div>
                        <div class="menu-arrow">›</div>
                    </div>
                </div>
                
                <div class="menu-item message" onclick="showBirthday()">
                    <div class="menu-item-content">
                        <div class="menu-icon-circle">💌</div>
                        <div class="menu-text">
                            <div class="menu-title">Surat spesial</div>
                            <div class="menu-desc">Isinya kata kata hari ini</div>
                        </div>
                        <div class="menu-arrow">›</div>
                    </div>
                </div>
                
                <div class="menu-item wishes" onclick="showCake()">
                    <div class="menu-item-content">
                        <div class="menu-icon-circle">💖</div>
                        <div class="menu-text">
                            <div class="menu-title">Valentine Special</div>
                            <div class="menu-desc">Hari Penuh Kasih Sayang</div>
                        </div>
                        <div class="menu-arrow">›</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="gallery-page">
        <div class="gallery-container">
            <h1>📸 Our Beautiful Memories</h1>
            
            <div class="gallery-grid">
                <div class="gallery-item"><img src="assets/memori1.jpg" alt="Roblox 1"></div>
                <div class="gallery-item"><img src="assets/memori2.png" alt="Roblox 2"></div>
                <div class="gallery-item"><img src="assets/memori3.png" alt="Roblox 3"></div>
                <div class="gallery-item"><img src="assets/memori4.png" alt="Roblox 4"></div>
                <div class="gallery-item"><img src="assets/memori5.png" alt="Roblox 5"></div>
                <div class="gallery-item"><img src="assets/memori6.jpg" alt="Roblox 6"></div>
            </div>
            
            <button class="back-btn" onclick="showMenu()">← Kembali ke Menu</button>
        </div>
    </div>

    <div class="birthday-page">
        <div class="confirmation-step active" id="step1">
            <div class="confirm-container">
                <div class="confirm-illustration">
                    <img src="assets/capybara1.png" alt="Gift" onerror="this.style.display='none'; this.parentElement.innerHTML='<div class=\'emoji-large\'>🎁</div>';">
                </div>
                <div class="confirm-question">
                    aku punya sesuatu<br>
                    kamu mau buka nggak? 🎀
                </div>
                <div class="confirm-buttons">
                    <button class="confirm-btn yes" onclick="nextStep(2)">Mau dong! 💖</button>
                    <button class="confirm-btn no" onclick="showShy()">Nanti deh...</button>
                </div>
            </div>
        </div>

        <div class="confirmation-step" id="step2">
            <div class="confirm-container">
                <div class="confirm-illustration">
                    <img src="assets/capybara2.png" alt="Letter" onerror="this.style.display='none'; this.parentElement.innerHTML='<div class=\'emoji-large\'>💌</div>';">
                </div>
                <div class="confirm-question">
                    okey tapi janji dulu...<br>
                    kamu nggak boleh sedih lagi yaa! 🥺
                </div>
                <div class="confirm-buttons">
                    <button class="confirm-btn yes" onclick="nextStep(3)">Janji! 🤞</button>
                    <button class="confirm-btn no" onclick="showTease()">Aku kuat kok!</button>
                </div>
            </div>
        </div>

        <div class="confirmation-step" id="step3">
            <div class="confirm-container">
                <div class="confirm-illustration">
                    <img src="assets/capybara3.png" alt="Heart" onerror="this.style.display='none'; this.parentElement.innerHTML='<div class=\'emoji-large\'>🥰</div>';">
                </div>
                <div class="confirm-question">
                    are u ready to open thisss? 💝<br>
                </div>
                <div class="confirm-buttons">
                    <button class="confirm-btn yes" onclick="showMessage()">sure bby! 💕</button>
                    <button class="confirm-btn no" onclick="showExcited()">mmm no sowwy...</button>
                </div>
            </div>
        </div>

        <div class="birthday-card" id="birthdayCard" style="display: none;">
            <div class="birthday-header">
                <div class="emoji">🎉</div>
            </div>

            <div class="profile-section">
                <div class="profile-image-container">
                    <img src="assets/ocee2.jpg" alt="oceean" class="profile-image">
                    <div class="sparkles">✨</div>
                </div>
                
                <div class="birthday-info">
                    <h1>oceean_rose</h1>
                </div>
            </div>

            <div class="decorative-line"></div>

            <div class="letter-container">
                <div class="letter-content">
                    <div class="letter-title">Surat Spesial ✉️</div>
                    
                    <div class="letter-text">
                        aloo rose  🌸🎮<br><br>
                        
                        aku mau bilang makasih yaaa selama ini udah jadi temen mabar paling seru sedunia 😭✨
main bareng kamu tuh selalu seru banget (walaupun kadang ngeselin dikit), entah lagi panik dikejar killer, gagal muncak berkali kali cukup lama yaa aku nunggu setiap obstacle tapi gapapa atau cuma ngobrol bahas tentang kehidupan kita berdua. honestly part ini yang paling seru menurutku, aku  banyak dapet cerita dari kamu yang menurut aku itu cukup seru yang bahkan di hidup aku belum sempet dapet pengalaman itu.<br><br>
                        
                        makasih juga udah jadi tempat cerita, tempat ngeluh kalo ada apa apa bahkan kamu mau dengerin cerita konyol tugas TA aku sama kelurahan itu.
jangan pernah berubah yaaa, tetep jadi rose yang receh, ceria, random, selalu jadi pribadi yang aku kenal yaa<br><br>
                        
                        always shine bright like a star ✨! semoga kita masih terus mabar, bikin momen random dan punya inside jokes yang orang lain ga ngerti 🤝💕
dan tolong yaa… janganlah kita sering miskom gitu !! hahaha 😆✨, oiyaa selamat berpuasaa yaa 🤍🌙 semoga puasanya lancar, penuh berkah, lebih baik dari puasa tahun lalu dan tetep kuat walaupun godaannya banyak HAHA
                    </div>

                </div>
            </div>

            <div class="wishes-grid">
                <div class="wish-card">
                    <div class="wish-icon"><img src="assets/ocee1.jpg" alt="Selalu Bahagia"></div>
                    <div class="wish-title">Selalu Bahagia</div>
                    <div class="wish-text">Semoga setiap harimu dipenuhi senyuman dan kebahagiaan!</div>
                </div>
                
                <div class="wish-card">
                    <div class="wish-icon"><img src="assets/ocee4.jpg" alt="Sukses Selalu"></div>
                    <div class="wish-title">Sukses Selalu</div>
                    <div class="wish-text">Khususnya dalam waktu dekat ini kamu cepet dapet kerjaan yang kamu mau yaa</div>
                </div>
                
                <div class="wish-card">
                    <div class="wish-icon"><img src="assets/ocee3.jpg" alt="Dicintai Semua"></div>
                    <div class="wish-title">Dicintai Semua</div>
                    <div class="wish-text">Tetap jadi orang yang baik hati dan menyenangkan seperti sekarang!</div>
                </div>
            </div>

            <div class="balloons-decoration">🎈🎈🎈🎈🎈</div>
            
            <br><br>
            <button class="back-btn" onclick="showMenu()">← Kembali ke Menu</button>
        </div>
    </div>

    <div class="cake-page">
        <div class="cake-container">
            <!-- Valentine Confirmation Step -->
            <div id="valentineConfirm" class="valentine-confirm-step">
                <h1 style="font-size: 2.5em; background: linear-gradient(135deg, #ff6b9d 0%, #c06c84 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; margin-bottom: 30px; font-weight: 800;">💖 Valentine Special 💖</h1>
                
                <div style="font-size: 100px; margin: 30px 0; animation: valentineHeartBeat 1.5s ease-in-out infinite;">💝</div>
                
                <h2 style="font-size: 1.8em; color: #333; margin-bottom: 40px; font-weight: 600; line-height: 1.5;">
                    Aku punya surat cinta spesial...<br>
                    Mau baca nggak? 🥰
                </h2>
                
                <div class="valentine-confirm-buttons" style="display: flex; gap: 20px; justify-content: center; flex-wrap: wrap; position: relative; min-height: 120px; align-items: flex-start; padding: 20px;">
                    <button class="valentine-yes-btn" onclick="showValentineCard()" style="padding: 18px 50px; font-size: 1.3em; font-weight: 700; background: linear-gradient(135deg, #ff6b9d 0%, #f67280 100%); color: white; border: none; border-radius: 50px; cursor: pointer; transition: all 0.3s ease; box-shadow: 0 8px 25px rgba(255, 107, 157, 0.4); position: relative; z-index: 1;">
                        ❤️ Mau Banget!
                    </button>
                    
                    <button class="valentine-no-btn" id="noBtn" onmouseover="moveButton()" onclick="moveButton()" style="padding: 18px 50px; font-size: 1.3em; font-weight: 700; background: linear-gradient(135deg, #e0e0e0 0%, #bdbdbd 100%); color: #666; border: none; border-radius: 50px; cursor: pointer; transition: left 0.3s ease, top 0.3s ease; box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1); position: relative; z-index: 2;">
                        💔 Nggak Deh...
                    </button>
                </div>
                
            </div>

            <!-- Valentine Card Content (Hidden Initially) -->
            <div id="valentineCard" style="display: none;">
                <h1>💖 Valentine Special Message 💖</h1>
                
                <div class="heart-animation">
                    <span class="heart-icon" style="font-size: 100px; display: inline-block; animation: valentineHeartBeat 1.5s ease-in-out infinite;">❤️</span>
                </div>

                <div class="valentine-card" style="background: linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%); padding: 40px; border-radius: 25px; box-shadow: 0 15px 40px rgba(252, 182, 159, 0.4); margin: 40px 0; position: relative; overflow: hidden;">
                    <div style="content: '💝'; position: absolute; top: 20px; right: 20px; font-size: 80px; opacity: 0.15;">💝</div>
                    
                    <div style="text-align: center; margin-bottom: 30px; position: relative; z-index: 1;">
                        <span style="font-size: 60px; display: block; margin-bottom: 15px;">💌</span>
                        <h3 style="color: #764ba2; font-size: 1.8em; font-weight: 700;">Surat Cinta Valentine</h3>
                    </div>
                    
                    <div style="position: relative; z-index: 1;">
                        <p style="color: #333; font-size: 1.2em; line-height: 1.9; text-align: left; font-weight: 500;">
                            hai rose! 💕<br><br>
                            
                            happy valentine’s day yaaa 🤍! Telat dikit gapapa yaa hehe, 
                            
                            di hari yang penuh cinta ini aku cuma mau bilang makasih banget udah jadi bagian penting di hidupku. serius deh, kamu tuh bikin hari-hariku jadi lebih rame, lebih seru, dan pastinya lebih berwarna 🌷✨<br><br>
                            
                            dari mabar roblox bareng, ngobrol random sampe tengah malem bahkan kita sering sampe pagi loh, saling support kalo lagi capek, sampe ketawa karena hal receh… itu semua berharga banget buat aku.<br><br>
                            
                            aku bersyukur banget bisa kenal kamu, rose.
                        </p>
                        
                        <div style="margin-top: 30px; text-align: right;">
                            <p style="color: #764ba2; font-size: 1.1em; font-weight: 600; margin: 5px 0;">With love,</p>
                            <p style="font-size: 1.4em; font-weight: 800; font-style: italic; background: linear-gradient(135deg, #ff6b9d 0%, #c06c84 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">Your Special Friend,Janu 💝</p>
                        </div>
                    </div>
                </div>

                <div class="love-interaction" style="background: white; padding: 40px; border-radius: 25px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1); text-align: center; margin-bottom: 40px;">
                    <h3 style="color: #ff6b9d; font-size: 2em; margin-bottom: 10px;">💝 Send Love! 💝</h3>
                    <p style="color: #999; font-size: 1.1em; margin-bottom: 30px;">Klik tombol di bawah untuk kirim love!</p>
                    
                    <div style="margin: 30px 0;">
                        <div style="display: flex; flex-direction: column; align-items: center; gap: 10px;">
                            <span class="count-number" id="loveCount" style="font-size: 4em; font-weight: 800; background: linear-gradient(135deg, #ff6b9d 0%, #c06c84 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">0</span>
                            <span style="font-size: 1.3em; color: #666; font-weight: 600;">❤️ Loves</span>
                        </div>
                    </div>
                    
                    <button class="send-love-btn" onclick="sendLove()" style="padding: 20px 50px; font-size: 1.4em; font-weight: bold; background: linear-gradient(135deg, #ff6b9d 0%, #f67280 100%); color: white; border: none; border-radius: 50px; cursor: pointer; transition: all 0.3s ease; box-shadow: 0 8px 25px rgba(255, 107, 157, 0.4); display: inline-flex; align-items: center; gap: 10px;">
                        <span style="font-size: 1.2em;">💖</span>
                        <span>Send Love!</span>
                    </button>
                    
                    <div id="loveMessage" style="margin-top: 20px; font-size: 1.2em; color: #ff6b9d; font-weight: 600; min-height: 30px;"></div>
                </div>

                <div class="valentine-wishes" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-top: 40px;">
                    <div style="background: linear-gradient(135deg, #ffeef8 0%, #ffe5f1 100%); padding: 30px 20px; border-radius: 20px; text-align: center; box-shadow: 0 8px 20px rgba(255, 107, 157, 0.15); transition: all 0.3s ease; border: 2px solid rgba(255, 107, 157, 0.2);">
                        <span style="font-size: 50px; display: block; margin-bottom: 15px;">🌹</span>
                        <p style="color: #764ba2; font-size: 1.1em; font-weight: 600; margin: 0;">Selalu penuh senyum!</p>
                    </div>
                    <div style="background: linear-gradient(135deg, #ffeef8 0%, #ffe5f1 100%); padding: 30px 20px; border-radius: 20px; text-align: center; box-shadow: 0 8px 20px rgba(255, 107, 157, 0.15); transition: all 0.3s ease; border: 2px solid rgba(255, 107, 157, 0.2);">
                        <span style="font-size: 50px; display: block; margin-bottom: 15px;">💕</span>
                        <p style="color: #764ba2; font-size: 1.1em; font-weight: 600; margin: 0;">Dipenuhi cinta setiap hari!</p>
                    </div>
                    <div style="background: linear-gradient(135deg, #ffeef8 0%, #ffe5f1 100%); padding: 30px 20px; border-radius: 20px; text-align: center; box-shadow: 0 8px 20px rgba(255, 107, 157, 0.15); transition: all 0.3s ease; border: 2px solid rgba(255, 107, 157, 0.2);">
                        <span style="font-size: 50px; display: block; margin-bottom: 15px;">✨</span>
                        <p style="color: #764ba2; font-size: 1.1em; font-weight: 600; margin: 0;">Rezeki lancar terus!</p>
                    </div>
                </div>
            </div>
            
            <br>
            <button class="back-btn" onclick="showMenu()">← Kembali ke Menu</button>
        </div>
    </div>

    <div class="floating-hearts" id="floatingHearts" style="position: fixed; pointer-events: none; z-index: 999;"></div>
    <div class="confetti-container" id="confettiContainer"></div>

    <script>
        const particlesContainer = document.getElementById('particles');
        const emojis = ['🎉', '🎊', '🎈', '🎁', '⭐', '✨', '🎂', '💝'];
        
        function createParticle() {
            const particle = document.createElement('div');
            particle.className = 'particle';
            particle.textContent = emojis[Math.floor(Math.random() * emojis.length)];
            particle.style.left = Math.random() * 100 + '%';
            particle.style.animationDuration = (Math.random() * 5 + 8) + 's';
            particle.style.animationDelay = Math.random() * 5 + 's';
            particlesContainer.appendChild(particle);
            
            setTimeout(() => {
                particle.remove();
            }, 13000);
        }

        for (let i = 0; i < 15; i++) {
            setTimeout(createParticle, i * 300);
        }

        setInterval(createParticle, 1000);

        let password = '';
        const correctPassword = '0312';

        function updateDisplay() {
            const display = document.getElementById('display');
            let circles = '';
            
            for (let i = 0; i < 4; i++) {
                if (i < password.length) {
                    circles += '● ';
                } else {
                    circles += '○ ';
                }
            }
            
            display.textContent = circles.trim();
            
            if (password.length === 4) {
                setTimeout(checkPassword, 300);
            }
        }

        function addNumber(num) {
            if (password.length < 4) {
                password += num;
                updateDisplay();
                document.getElementById('error').textContent = '';
            }
        }

        function clearPassword() {
            password = '';
            updateDisplay();
            document.getElementById('error').textContent = '';
        }

        function checkPassword() {
            if (password === correctPassword) {
                document.querySelector('.lock-screen').classList.remove('active');
                document.querySelector('.menu-page').classList.add('active');
            } else {
                const errorElement = document.getElementById('error');
                errorElement.textContent = 'Wrong passcode. Try again.';
                errorElement.classList.add('shake');
                
                setTimeout(() => {
                    errorElement.classList.remove('shake');
                    clearPassword();
                    errorElement.textContent = '';
                }, 1500);
            }
        }

        function showMenu() {
            document.querySelector('.gallery-page').classList.remove('active');
            document.querySelector('.birthday-page').classList.remove('active');
            document.querySelector('.cake-page').classList.remove('active');
            document.querySelector('.menu-page').classList.add('active');
            
            // Reset valentine section when going back to menu
            resetValentineSection();
        }

        function resetValentineSection() {
            // Show confirmation step again
            const confirmStep = document.getElementById('valentineConfirm');
            const valentineCard = document.getElementById('valentineCard');
            
            if (confirmStep && valentineCard) {
                confirmStep.style.display = 'block';
                valentineCard.style.display = 'none';
                
                // Reset No button position
                const noBtn = document.getElementById('noBtn');
                if (noBtn) {
                    noBtn.style.position = 'relative';
                    noBtn.style.left = '';
                    noBtn.style.top = '';
                    noBtn.style.zIndex = '2';
                }
            }
        }

        function showGallery() {
            document.querySelector('.menu-page').classList.remove('active');
            document.querySelector('.gallery-page').classList.add('active');
        }

        function showBirthday() {
            document.querySelector('.menu-page').classList.remove('active');
            document.querySelector('.birthday-page').classList.add('active');
            
            document.querySelectorAll('.confirmation-step').forEach(step => {
                step.classList.remove('active');
            });
            document.getElementById('step1').classList.add('active');
            document.getElementById('birthdayCard').style.display = 'none';
        }

        function nextStep(stepNumber) {
            document.querySelectorAll('.confirmation-step').forEach(step => {
                step.classList.remove('active');
            });
            document.getElementById('step' + stepNumber).classList.add('active');
        }

        function showMessage() {
            document.querySelectorAll('.confirmation-step').forEach(step => {
                step.classList.remove('active');
            });
            document.getElementById('birthdayCard').style.display = 'block';
            createHearts();
        }

        function showShy() {
            alert('Ayolah... cuma sebentar kok 🥺👉👈');
        }

        function showTease() {
            alert('Hehe iya deh percaya kamu kuat! 💪✨');
            nextStep(3);
        }

        function showExcited() {
            alert('Ehhh kok nggak mau sih 😭 Yaudah deh buka aja ya! 💕');
            showMessage();
        }

        function createHearts() {
            const confettiContainer = document.getElementById('confettiContainer');
            const hearts = ['💕', '💖', '💗', '💝', '💓', '❤️'];
            
            for (let i = 0; i < 20; i++) {
                setTimeout(() => {
                    const heart = document.createElement('div');
                    heart.className = 'confetti';
                    heart.textContent = hearts[Math.floor(Math.random() * hearts.length)];
                    heart.style.left = Math.random() * 100 + '%';
                    heart.style.animationDuration = (Math.random() * 2 + 2) + 's';
                    confettiContainer.appendChild(heart);
                    
                    setTimeout(() => heart.remove(), 4000);
                }, i * 100);
            }
        }

        function showCake() {
            document.querySelector('.menu-page').classList.remove('active');
            document.querySelector('.cake-page').classList.add('active');
            
            // Reset valentine section to show confirmation again
            resetValentineSection();
        }

        // Valentine Functions
        let loveCounter = 0;

        function moveButton() {
            const noBtn = document.getElementById('noBtn');
            
            // Change to fixed position on first hover to move freely across screen
            if (noBtn.style.position !== 'fixed') {
                noBtn.style.position = 'fixed';
                noBtn.style.transition = 'all 0.3s ease';
            }
            
            // Get random position anywhere on screen
            const maxX = window.innerWidth - noBtn.offsetWidth - 50;
            const maxY = window.innerHeight - noBtn.offsetHeight - 50;
            
            const randomX = Math.random() * maxX + 25;
            const randomY = Math.random() * maxY + 25;
            
            // Move button to random position
            noBtn.style.left = randomX + 'px';
            noBtn.style.top = randomY + 'px';
            noBtn.style.zIndex = '9999';
            
            // Add shake animation
            noBtn.style.animation = 'shake 0.3s';
            setTimeout(() => {
                noBtn.style.animation = '';
            }, 300);
        }

        function showValentineCard() {
            // Hide confirmation step
            document.getElementById('valentineConfirm').style.display = 'none';
            // Show valentine card with animation
            const card = document.getElementById('valentineCard');
            card.style.display = 'block';
            card.style.animation = 'slideInScale 0.5s ease';
            
            // Create hearts celebration
            createValentineConfetti();
        }

        function sendLove() {
            loveCounter++;
            const countElement = document.getElementById('loveCount');
            const messageElement = document.getElementById('loveMessage');
            
            // Update counter with animation
            countElement.style.animation = 'none';
            setTimeout(() => {
                countElement.textContent = loveCounter;
                countElement.style.animation = 'numberPulse 0.3s ease';
            }, 10);
            
            // Create floating heart animation
            const heartsContainer = document.getElementById('floatingHearts');
            const heart = document.createElement('div');
            heart.className = 'floating-heart';
            heart.textContent = ['❤️', '💕', '💖', '💗', '💝', '💓'][Math.floor(Math.random() * 6)];
            heart.style.left = (Math.random() * 90 + 5) + '%';
            heart.style.top = '100%';
            heartsContainer.appendChild(heart);
            
            setTimeout(() => heart.remove(), 3000);
            
            // Show milestone messages
            if (loveCounter === 1) {
                messageElement.textContent = 'Aww, sweet! 💕';
            } else if (loveCounter === 5) {
                messageElement.textContent = 'You\'re so lovely! 💖';
            } else if (loveCounter === 10) {
                messageElement.textContent = 'Amazing! Keep going! 💗';
                createValentineConfetti();
            } else if (loveCounter === 25) {
                messageElement.textContent = 'Wow, so much love! 💝';
            } else if (loveCounter === 50) {
                messageElement.textContent = 'Incredible! You\'re the best! 💓';
                createValentineConfetti();
            } else if (loveCounter === 100) {
                messageElement.textContent = '💯 CENTURY OF LOVE! 🎉💖';
                createValentineConfetti();
            } else if (loveCounter % 10 === 0) {
                messageElement.textContent = loveCounter + ' loves! 💕';
            }
            
            // Clear message after 2 seconds
            setTimeout(() => {
                if (messageElement.textContent !== '💯 CENTURY OF LOVE! 🎉💖') {
                    messageElement.textContent = '';
                }
            }, 2000);
        }

        function createValentineConfetti() {
            const confettiContainer = document.getElementById('confettiContainer');
            const valentineEmojis = ['💕', '💖', '💗', '💝', '💓', '❤️', '💘', '💌'];
            
            for (let i = 0; i < 40; i++) {
                setTimeout(() => {
                    const confetti = document.createElement('div');
                    confetti.className = 'confetti';
                    confetti.textContent = valentineEmojis[Math.floor(Math.random() * valentineEmojis.length)];
                    confetti.style.left = Math.random() * 100 + '%';
                    confetti.style.animationDuration = (Math.random() * 2 + 2) + 's';
                    confettiContainer.appendChild(confetti);
                    
                    setTimeout(() => confetti.remove(), 3000);
                }, i * 40);
            }
        }

        document.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                checkPassword();
            }
        });

        document.addEventListener('keydown', function(e) {
            if (e.key >= '0' && e.key <= '9') {
                addNumber(e.key);
            } else if (e.key === 'Backspace') {
                password = password.slice(0, -1);
                updateDisplay();
            }
        });

        updateDisplay();
    </script>
</body>
</html>