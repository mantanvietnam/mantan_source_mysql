
<?php 
    getHeader();
?>

    <div class="body body__register">
        <img src="<?php echo $urlThemeActive;?>/asset/image/anhdep.jpg" alt="">
        <div class="auth-container">
            <div class="form-container">
                <!-- Tab content -->
                <div class="tab-content" id="authTabContent">
                    <h4 class="text-center text-danger">Check in sự kiện</h4>
                    <p class="text-center text-secondary"><?php echo @$dataEvent->name; ?></p>
                    
                    <form method="POST">
                        <?php echo @$mess; ?>
                        <input type="hidden" value="<?php echo $csrfToken;?>" name="_csrfToken">
                        <div class="mb-3">
                            <label for="loginEmail" class="form-label">Số điện thoại</label>
                            <input type="text" class="form-control" name="phone" id="phone" placeholder="Nhập SDT của bạn" required>
                        </div>
                        <!-- <div class="mb-3">
                            <label for="loginPassword" class="form-label">Mã check in</label>
                            <input type="text" name="code_checkin" class="form-control" id="code_checkin" placeholder="Mã check in của bạn" required>
                        </div> -->
                        <button type="submit" class="btn btn-danger w-100">Check in</button>
                       
                    </form>
                </div>
            </div>
        </div>
    </div>
    
<?php getFooter();?>