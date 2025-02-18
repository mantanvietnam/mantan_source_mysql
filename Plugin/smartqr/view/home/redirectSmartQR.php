<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo @$data->title;?></title>
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-141Q664ZHZ"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'G-141Q664ZHZ');
    </script>
    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(135deg, #667eea, #764ba2);
            font-family: 'Arial', sans-serif;
            color: white;
        }

        .countdown-container {
            text-align: center;
        }

        .countdown {
            font-size: 5rem;
            font-weight: bold;
            background: rgba(255, 255, 255, 0.2);
            padding: 20px 50px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            transition: transform 0.2s ease;
        }

        .countdown:hover {
            transform: scale(1.1);
        }

        .message {
            margin-top: 20px;
            font-size: 1.5rem;
        }
    </style>
</head>
<body>
    <div class="countdown-container">
        <div class="countdown" id="countdown">10</div>
        <div class="message" id="message">Đợi chút để truy cập vào mã QR của <?php echo @$data->title;?></div>
    </div>

    <script>
        let countdownValue = 10;
        const countdownElement = document.getElementById("countdown");
        const messageElement = document.getElementById("message");

        const interval = setInterval(() => {
            countdownValue--;
            countdownElement.textContent = countdownValue;

            if (countdownValue === 0) {
                clearInterval(interval);
                countdownElement.textContent = "🎉";
                messageElement.textContent = "Cảm ơn bạn đã chờ!";
                window.location = '<?php echo @$link_redirect;?>';
            }
        }, 1000);
    </script>
</body>
</html>
