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
        .popup {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }
        .popup-content {
            background: white;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            max-width: 400px;
        }
        .popup img {
            width: 200px;
            height: auto;
            margin-top: 10px;
        }
        .close-btn {
            margin-top: 10px;
            padding: 8px 15px;
            background: red;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }
        .close-btn:hover {
            background: darkred;
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

        <!-- Đăng ký nhận bản đầy đủ -->
        <p><a href="#" onclick="openPopup()">Đăng ký nhận bản đầy đủ</a></p>

        <!-- Nút quay lại -->
        <a href="/registerform" class="back-button">Quay lại</a>
    </div>

    <!-- Popup -->
    <div class="popup" id="paymentPopup">
        <div class="popup-content">
            <h3>Nhận bản tử vi đầy đủ</h3>
            <p><strong>Giá bản đầy đủ:</strong> <?= !empty($price) ? number_format($price, 0, ',', '.') . ' VNĐ' : 'Liên hệ'; ?></p>
            <p>Quét mã QR bên dưới để thanh toán:</p>
            <img src="https://tuvi.mundaythi.com/upload/admin/files/t%E1%BA%A3i%20xu%E1%BB%91ng.png" alt="QR Code Thanh Toán">
            <br>
            <button class="close-btn" onclick="closePopup()">Đóng</button>
        </div>
    </div>

    <script>
        function openPopup() {
            document.getElementById("paymentPopup").style.display = "flex";
        }
        function closePopup() {
            document.getElementById("paymentPopup").style.display = "none";
        }
    </script>

</body>
</html>
