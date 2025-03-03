<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông Tin Tử vi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            padding: 20px;
            background-color: #f4f4f4;
            text-align: center;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: auto;
        }
        h2 {
            color: #333;
        }
        .mascot-box {
            background: #fff3cd;
            padding: 15px;
            border-left: 5px solid #ffc107;
            margin-top: 20px;
            font-size: 18px;
        }
        .back-button {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 15px;
            background: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .back-button:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Thông Tin Tử vi</h2>
        <div class="mascot-box">
            <p>
                <?= !empty($overview) ? ($overview) : "Không có dữ liệu!"; ?>
            </p>
        </div>

        <!-- Đường link đăng ký nhận bản đầy đủ -->
        <p><a href="/regis">Đăng ký nhận bản đầy đủ</a></p>

        <!-- Nút quay lại -->
        <a href="/registerform" class="back-button">Quay lại</a>
    </div>

</body>
</html>
