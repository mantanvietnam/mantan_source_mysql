<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/plugins/snaphair/view/home/assets/css/style.css">
</head>

<body>
    <div class="container form-container">
        <div class="row g-0">
            <div class="col-lg-6 d-none d-lg-block banner"></div>
            <div class="col-lg-6 col-12 form-content">
                <h1>Tạo mật khẩu mới </h1>
                <?php echo @$mess; ?>
                <form  action="" method="post">
                    <input type="hidden" value="<?php echo $csrfToken;?>" name="_csrfToken">
                   
                    <div class="mb-3">
                        <input type="password" class="form-control" placeholder="Nhập mật khẩu mới" required name="password">
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control" placeholder="Nhập mật lại khẩu mới" required name="password_confirmation">
                    </div>
                    <button type="submit" class="btn btn-primary w-100 mb-3">Đăng ký</button>
                    <div class="footer-text mt-3">
                        Đã có tài khoản? <a href="index.html">Đăng nhập</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>