<?php 
    getHeader();
?>

    <div class="body body__register">
        <img src="<?php echo $urlThemeActive;?>/asset/image/anhdep.jpg" alt="">
        <div class="auth-container">
            <div class="form-container">
                <!-- Tab content -->
                <div class="tab-content" id="authTabContent">
                    <h4 class="text-center text-danger">Mã xác nhận</h4>
                    <p class="text-center text-secondary">Chào mừng bạn đã quay trở lại với Vemoi.net!</p>
                    
                    <form method="POST">
                        <?php echo @$mess; ?>
                        <input type="hidden" value="<?php echo $csrfToken;?>" name="_csrfToken">
                        <div class="mb-3">
                            <label for="code" class="form-label">Mã xác nhận</label>
                            <input type="text" class="form-control" name="code" id="code" placeholder="Nhập Mã xác nhận của bạn" required>
                        </div>
                         <div class="mb-3">
                            <label for="code" class="form-label">Mật khẩu mới</label>
                            <input type="text" class="form-control" name="pass" id="pass" placeholder="Nhập mật khẩu mới nhận của bạn" required>
                        </div>
                         <div class="mb-3">
                            <label for="code" class="form-label">Xác nhận lại mật khẩu mới</label>
                            <input type="text" class="form-control" name="passAgain" id="passAgain" placeholder="Nhập xác nhận lại mật khẩu mới nhận của bạn" required>
                        </div>
                        
                        <button type="submit" class="btn btn-danger w-100">Gửi</button>
                         <div class="forgot-password">
                            <a href="/login">Đăng nhập</a> | 
                            <a href="/register">Đăng ký</a>
                        </div>
                        <!-- <p class="text-center mt-3">Hoặc đăng nhập bằng</p>
                        <div class="social-login-btn">
                            <button type="button" class="btn btn-outline-danger"><img src="<?php echo $urlThemeActive;?>/asset/image/gg.png" style="margin-bottom: 3px; width: 13px; height: 13px;" alt=""> Google</button>
                            <button type="button" class="btn btn-outline-primary"><img src="<?php echo $urlThemeActive;?>/asset/image/fb.png" style="margin-bottom: 3px; width: 13px; height: 13px;" alt="">Facebook</button>
                        </div> -->
                        <p class="text-center mt-3 text-secondary">Bằng cách đăng nhập hoặc tạo tài khoản, bạn đồng ý với <span class="text-danger">Điều khoản</span> và <span class="text-danger">Điều kiện</span> và <span class="text-danger">Chính sách Bảo mật</span> của chúng tôi.</p>
                      
                    </form>
                </div>
            </div>
        </div>
    </div>
    
<?php getFooter();?>