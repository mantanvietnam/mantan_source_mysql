<?php 
    getHeader();
    global $session;
$info = $session->read('infoUser');
?>

    <div class="body">
        <img src="<?php echo $urlThemeActive;?>/asset/image/anhdep.jpg" alt="">
        <div class="auth-container">
            <div class="form-container">
                <!-- Tab content -->
                <div class="tab-content" id="authTabContent">
                    <h4 class="text-center text-danger">Sửa thông tin</h4>
                    <?php echo @$mess; ?>
                    <form method="POST">
                        <input type="hidden" value="<?php echo $csrfToken;?>" name="_csrfToken">
                        <div class="mb-3">
                            <label for="loginEmail" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" id="loginEmail" placeholder="Nhập tên của bạn của bạn" value="<?php echo @$info['name'] ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="loginPassword" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" id="loginemail" placeholder="Nhập email cua bạn" value="<?php echo @$info['email'] ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="loginEmail" class="form-label">Address</label>
                            <input type="text" class="form-control" name="address" id="loginEmail"  placeholder="Nhập địa chỉ của bạn" value="<?php echo @$info['address'] ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="loginPassword" class="form-label">Facebook</label>
                            <input type="text" name="facebook" class="form-control" id="loginemail" placeholder="Nhập Facebook của bạn" value="<?php echo @$info['facebook'] ?>" required>
                        </div>
                        <button type="submit" class="btn btn-danger w-100">Xác nhận</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
<?php getFooter();?>