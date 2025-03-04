<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký Thông Tin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background: #e3f2fd;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            width: 100%;
            text-align: center;
        }
        h2 {
            background: #b28a2f;
            color: white;
            padding: 15px;
            border-radius: 10px 10px 0 0;
            margin: -30px -30px 20px -30px;
            font-size: 20px;
        }
        .form-group {
            text-align: left;
            margin-bottom: 15px;
        }
        label {
            font-weight: bold;
        }
        input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            margin-top: 5px;
        }
        .submit-button {
            width: 100%;
            padding: 10px;
            background: #b28a2f;
            color: white;
            font-size: 18px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }
        .submit-button:hover {
            background: #8c6e23;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Đăng Ký Thông Tin</h2>
        <form action="process.php" method="POST">
            <div class="form-group">
                <label for="name">Họ Tên</label>
                <input type="text" id="name" name="name" required placeholder="Nhập họ tên của bạn">
            </div>

            <div class="form-group">
                <label for="phone">Số điện thoại</label>
                <input type="text" id="phone" name="phone" required placeholder="Nhập số điện thoại">
            </div>

            <div class="form-group">
                <label for="address">Địa chỉ</label>
                <input type="text" id="address" name="address" required placeholder="Nhập địa chỉ của bạn">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required placeholder="Nhập địa chỉ email">
            </div>

            <button type="submit" class="submit-button">Đăng Ký</button>
        </form>
    </div>

</body>
</html>
