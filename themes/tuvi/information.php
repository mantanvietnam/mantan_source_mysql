<?php
// debug($_GET['id']);
// die();
?>
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

        <p><a href="#" onclick="openPopup()">Đăng ký nhận bản đầy đủ</a></p>

        <a href="/registerform" class="back-button">Quay lại</a>
    </div>

    <div class="popup" id="paymentPopup">
        <div class="popup-content">
            <h3>Nhận bản tử vi đầy đủ</h3>
            <p><strong>Giá bản đầy đủ:</strong> <?= !empty($price) ? number_format($price, 0, ',', '.') . ' VNĐ' : 'Liên hệ'; ?></p>
            <p>Quét mã QR bên dưới để thanh toán:</p>
            <img id="qrImage" src="" alt="QR Code Thanh Toán">
            <br>
            <button class="close-btn" onclick="checkTransaction()">Kiểm tra giao dịch</button>
        </div>
    </div>

    <div class="popup" id="successPopup">
        <div class="popup-content">
            <h3>✅ Thanh toán thành công!</h3>
            <p>Truy cập email của bạn để nhận bản đầy đủ.</p>
            <img src="upload/admin/images/Success.gif" alt="Thanh toán thành công" style="width: 200px; height: auto;">
            <br>
            <button class="close-btn" onclick="document.getElementById('successPopup').style.display='none'">Đóng</button>
        </div>
    </div>


</body>
</html>

<script>
        function openPopup() {
            let userId = <?= !empty($id_customer) ? $id_customer : 0 ?>;
            let amount = <?= !empty($price) ? $price : 0 ?>;

            if (userId <= 0 || amount <= 0) {
                alert("Lỗi: Không thể lấy thông tin thanh toán!");
                return;
            }

            fetch('/apis/createQRPayAPI', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    id_customer: userId,
                    money: amount
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById("qrImage").src = data.data.link_qr_bank;
                    document.getElementById("paymentPopup").style.display = "flex";
                } else {
                    alert("Lỗi: " + data.message);
                }
            })
            .catch(error => {
                console.error("Lỗi khi lấy QR code:", error);
                alert("Lỗi hệ thống! Vui lòng thử lại sau.");
            });
        }

        function checkTransaction() {
            let userId = <?= !empty($id_customer) ? $id_customer : 0 ?>;

            if (userId <= 0) {
                alert("Lỗi: Không thể kiểm tra giao dịch!");
                return;
            }

            fetch('/apis/checkTransaction', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ id_customer: userId })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    if (data.data.status == 1) {
                        document.getElementById("paymentPopup").style.display = "none";
                        document.getElementById("successPopup").style.display = "flex";

                        setTimeout(() => {
                            document.getElementById("successPopup").style.display = "none";
                        }, 10000);
                    } else {
                        alert("⏳ Đang chờ thanh toán");
                    }
                } else {
                    alert("Lỗi: " + data.message);
                }
            })
            .catch(error => {
                console.error("Lỗi khi kiểm tra giao dịch:", error);
                alert("Lỗi hệ thống! Vui lòng thử lại sau.");
            });
        }

    </script>