<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt Lại Mật Khẩu</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #1a1a1a;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: url('https://via.placeholder.com/800x600');
            background-size: cover;
            background-position: center;
        }

        .reset-container {
            background-color: rgba(0, 0, 0, 0.8);
            padding: 20px;
            border-radius: 10px;
            width: 350px;
            text-align: center;
        }

        .reset-container h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .input-field {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: none;
            border-radius: 5px;
            background-color: #2e2e2e;
            color: #fff;
            font-size: 16px;
        }

        .btn {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #ff007f;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #e60073;
        }
    </style>
</head>

<body>
    <div class="reset-container">
        <h1>Đặt Lại Mật Khẩu</h1>
        <p><a href="reset.html" class="link">Đặt lại mật khẩu</a></p>
        <form>
            <input type="password" class="input-field" placeholder="Mật khẩu mới" required>
            <input type="password" class="input-field" placeholder="Xác nhận mật khẩu" required>
            <button type="submit" class="btn">Cập Nhật</button>
        </form>
        <p><a href="login.html" class="link">Quay lại trang đăng nhập</a></p>
    </div>
</body>

</html>