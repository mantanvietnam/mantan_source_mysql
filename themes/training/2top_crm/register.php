<?php getHeader();?>
<main id="sign" style="background-image: url('<?php echo $urlThemeActive;?>/assets/img/sign-bg.png');">
    <section class="sign-form">
        <div class="container">
            <div class="sign-form-contain bg-white rounded-4">
                <h1 class="text-center fw-bold text-primary-custom mb-2">Đăng ký</h1>
                <p class="text-center form-description">Đăng ký làm thành viên của chúng tôi để tham gia các khóa học của hệ thống</p>

                <div class="form-contain">
                    <div>
                        <p><?php echo @$mess;?></p>
                        <form action="" method="post">
                            <input type="hidden" value="<?php echo $csrfToken;?>" name="_csrfToken">
                            <div>
                                <div class="form-group mb-2 dynamic-input">
                                    <label for="">Họ tên (*)</label>
                                    <input type="text" class="form-control mt-1" value="" name="full_name" required>
                                </div>
                                <div class="form-group mb-2 dynamic-input">
                                    <label for="">Số điện thoại (*)</label>
                                    <input type="text" class="form-control mt-1" value="" name="phone" required>
                                </div>
                                <div class="form-group mb-2 dynamic-input">
                                    <label for="">Địa chỉ Email (*)</label>
                                    <input type="email" class="form-control mt-1" value="" name="email" required>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="">Mật khẩu (*)</label>
                                    <input type="password" class="form-control mt-1" value="" name="pass" required>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="">Nhập lại mật khẩu (*)</label>
                                    <input type="password" class="form-control mt-1" value="" name="passAgain" required>
                                </div>
                            </div>
                            <div class="submit">
                                <button class="btn" type="submit">Đăng ký</button>
                            </div>
                            <div class="forget-pass mb-3 d-no">
                                <div class="d-flex justify-content-end">
                                    <a href="" class="fw-bold text-secondary-custom">Quên mật khẩu?</a>
                                </div>
                            </div>
                            <div class="sign-up-with-social mb-3">
                                <p class="text-center">Hoặc <a href="/register">đăng ký</a> bằng</p>
                                <div class="row g-4">
                                    <div class="col-12 col-lg-6">
                                        <div class="social-btn-contain">
                                            <div class="contain">
                                                <button
                                                    class="btn d-flex align-items-center justify-content-center">
                                                    <img class="me-2" src="<?php echo $urlThemeActive;?>/assets/img/google.svg" alt="">
                                                    <span>Google</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <div class="social-btn-contain">
                                            <div class="contain">
                                                <button
                                                    class="btn d-flex align-items-center justify-content-center">
                                                    <img class="me-2" src="<?php echo $urlThemeActive;?>/assets/img/facebook.svg" alt="">
                                                    <span>Facebook</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="policy">
                                <p class="text-center">
                                    Bằng cách đăng nhập hoặc tạo tài khoản, bạn đồng ý với
                                    <a href="" class="text-primary-custom fw-semibold">Điều khoản</a>
                                    và
                                    <a href="" class="text-primary-custom fw-semibold">Điều kiện
                                        và Chính sách Bảo mật</a> của chúng tôi.
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<?php getFooter();?>