<?php 
    getHeader();
?>

    <div class="body">
        <img src="<?php echo $urlThemeActive;?>/asset/image/anhdep.jpg" alt="">
        <div class="auth-container">
            <div class="form-container">
                <!-- Tab content -->
                <div class="tab-content" id="authTabContent">
                    <h4 class="text-center text-danger">Đăng nhập</h4>
                    <p class="text-center text-secondary">Chào mừng bạn đã quay trở lại với Vemoi.net!</p>
                    <form>
                        <div class="mb-3">
                            <label for="loginEmail" class="form-label">Địa chỉ Email</label>
                            <input type="email" class="form-control" id="loginEmail" placeholder="Nhập địa chỉ Email của bạn">
                        </div>
                        <div class="mb-3">
                            <label for="loginPassword" class="form-label">Mật khẩu</label>
                            <input type="password" class="form-control" id="loginPassword" placeholder="Nhập mật khẩu của bạn">
                        </div>
                        <button type="submit" class="btn btn-danger w-100">Đăng nhập</button>
                        <p class="text-center mt-3">Hoặc đăng nhập bằng</p>
                        <div class="social-login-btn">
                            <button type="button" class="btn btn-outline-danger"><img src="<?php echo $urlThemeActive;?>/asset/image/gg.png" style="margin-bottom: 3px; width: 13px; height: 13px;" alt=""> Google</button>
                            <button type="button" class="btn btn-outline-primary"><img src="<?php echo $urlThemeActive;?>/asset/image/fb.png" style="margin-bottom: 3px; width: 13px; height: 13px;" alt="">Facebook</button>
                        </div>
                        <p class="text-center mt-3 text-secondary">Bằng cách đăng nhập hoặc tạo tài khoản, bạn đồng ý với <span class="text-danger">Điều khoản</span> và <span class="text-danger">Điều kiện</span> và <span class="text-danger">Chính sách Bảo mật</span> của chúng tôi.</p>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
<?php getFooter();?>