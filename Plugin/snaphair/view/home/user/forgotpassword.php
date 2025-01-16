<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quên Mật Khẩu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/plugins/snaphair/view/home/assets/css/style.css">
</head>

<body>
    <div class="container form-container">
        <div class="row g-0">
            <div class="col-lg-6 d-none d-lg-block banner"></div>
            <div class="col-lg-6 col-12 form-content">
                <h1>Quên mật khẩu</h1>
                <p>Nhập số điện thoại của bạn để nhận liên kết khôi phục mật khẩu</p>
                <?php echo @$mess; ?>
                <form  action="" method="post">
                    <input type="hidden" value="<?php echo $csrfToken;?>" name="_csrfToken">
                    <div class="mb-3">
                        <input type="text" class="form-control" placeholder="Địa chỉ só điện thoại của bạn" name="phone" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Gửi</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>