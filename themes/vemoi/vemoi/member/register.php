

<?php 
    getHeader();
?>


    <div class="body">
        <img src="<?php echo $urlThemeActive;?>/asset/image/anhdep.jpg" alt="">
        <div class="auth-container">
            <div class="form-container">
                <!-- Tab content -->
                <div class="tab-content" id="authTabContent">
                    <h4 class="text-center text-danger">Đăng ký</h4>
                    <p class="text-center text-secondary">Đăng ký làm thành viên của chúng tôi và trải nghiệm những sự kiện cực hấp dẫn!</p>
                    <form method="POST" action="">
                        <input type="hidden" value="<?php echo $csrfToken; ?>" name="_csrfToken">
                        <div class="mb-3">
                            <label for="registerName" class="form-label">Tên</label>
                            <input type="text" name="name" class="form-control" id="registerName" placeholder="Nhập tên của bạn" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="registerEmail" class="form-label">Địa chỉ Email</label>
                            <input type="email" name="email" class="form-control" id="registerEmail" placeholder="Nhập địa chỉ Email của bạn" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="registerPhone" class="form-label">Số điện thoại</label>
                            <input type="text" name="phone" class="form-control" id="registerPhone" placeholder="Nhập số điện thoại của bạn" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="registerPassword" class="form-label">Mật khẩu</label>
                            <input type="password" name="password" class="form-control" id="registerPassword" placeholder="Nhập mật khẩu của bạn" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="confirmPassword" class="form-label">Nhập lại mật khẩu</label>
                            <input type="password" name="password_again" class="form-control" id="confirmPassword" placeholder="Nhập lại mật khẩu của bạn" required>
                        </div>
                        
                        <button type="submit" class="btn btn-danger w-100">Đăng ký</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
<?php getFooter();?>