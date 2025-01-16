<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/plugins/snaphair/view/home/assets/css/style.css">
</head>

<body>
    <div class="container form-container">
        <div class="row g-0">
            <!-- Cột banner -->
            <div class="col-lg-6 d-none d-lg-block banner"></div>

            <!-- Cột form đăng nhập -->
            <div class="col-lg-6 col-12 form-content">
                <h1>Chào mừng 👋</h1>
                <p> Vui lòng đăng nhập để tham gia vào SNAPHAIR </p>
                <?php echo @$mess; ?>
                <!-- Form đăng nhập -->
                <form  action="" method="post">
                    <input type="hidden" value="<?php echo $csrfToken;?>" name="_csrfToken">
                    <div class="mb-3">
                        <input type="text" class="form-control" placeholder="Số điện thoại của bạn" id="phone" name="phone" required>
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control" placeholder="Mật khẩu của bạn" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 mb-3">Đăng nhập</button>
                </form>

                <!-- Điều hướng -->
                <div class="d-flex justify-content-between mb-3">
                    <div>
                        <input type="checkbox" id="rememberMe">
                        <label for="rememberMe" class="ms-1">Ghi nhớ tôi</label>
                    </div>
                    <!-- Liên kết đến trang quên mật khẩu -->
                    <a href="/forgotpassword" class="text-decoration-none">Quên mật khẩu?</a>
                </div>

                <!-- Nút đăng nhập mạng xã hội -->
                <button type="button" class="btn social-btn w-100 google mb-2">Đăng nhập bằng Google</button>
                <button type="button" class="btn social-btn w-100 apple">Đăng nhập bằng Apple</button>

                <!-- Liên kết sang trang đăng ký -->
                <div class="footer-text mt-3">
                    Không có tài khoản? <a href="register.html" class="text-decoration-none">Hãy đăng ký</a>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>