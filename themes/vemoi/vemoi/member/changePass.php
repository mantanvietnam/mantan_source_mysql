   
   <?php 
    getHeader();
    global $urlThemeActive;
?>

   <div class="body body__register">
        <img src="<?php echo $urlThemeActive;?>/asset/image/anhdep.jpg" alt="">
        <div class="auth-container">
            <div class="form-container">
                <!-- Tab content -->
                <div class="tab-content" id="authTabContent">
                    <h4 class="text-center text-danger">Đổi mật khẩu</h4>
                    <?=$mess?>
                    <form method="POST" action="">
                        <input type="hidden" value="<?php echo $csrfToken; ?>" name="_csrfToken">
                        <div class="mb-3">
                            <label for="change-password" class="form-label">Nhập lại mật khẩu hiện tại</label>
                            <input type="text" name="passOld" class="form-control" id="passOld" placeholder="Nhập lại mật khẩu hiện tại" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="change-password" class="form-label">Mật khẩu mới</label>
                            <input type="text" name="passNew" class="form-control" id="passNew" placeholder="Mật khẩu mới" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="change-password" class="form-label">Xác nhận lại mật khẩu</label>
                            <input type="text" name="passAgain" class="form-control" id="passAgain" placeholder="Xác nhận lại mật khẩu" required>
                        </div>
                        
                        <button type="submit" class="btn btn-danger w-100">Đổi mật khẩu</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php getFooter();?>