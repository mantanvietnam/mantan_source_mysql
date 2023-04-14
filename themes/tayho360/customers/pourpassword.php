<?php
getHeader();
global $urlThemeActive;
?>
<main class="bg-pt">
        <div class="container py-5">
            <section id="user-page">
                <div class="row g-0">
                    <div class="col-12 col-lg-3 bg-white">
                        <section class="side-bar h-100">
                            <div class="background h-100">
                                <a href="/infoUser" >Cá nhân</a>
                                <a href="/pourpassword" class="active">Đổi mật khẩu</a>
                                <a href="/editInfoUser">Sửa thông tin </a>
                            </div>
                        </section>
                    </div>
                    <div class="col-12 col-lg-9 bg-white">
                        <section class="content p-2 p-md-4 pe-md-5">
                            <div class="user-edit password pe-md-5">
                                <div class="body mt-3">
                                    <h1 class="change-pass" for="">Đổi mật khẩu</h1>
                                    <?php echo @$mess; ?>
                                    <div class="row g-3">
                                         <form action="" method="post">
                                            <input type="hidden" value="<?php echo $csrfToken;?>" name="_csrfToken">
                                            <div class="col-12">
                                                <div class="form-group-user mb-4">
                                                    <div class="d-flex align-items-center input-password">
                                                        
                                                        <img src="<?= $urlThemeActive ?>assets/lou_icon/icon-password-pre.svg" alt="">
                                                        <input type="password" placeholder="Nhập lại mật khẩu hiện tại" name="oldpass" class="form-control" required>
                                                        <img class="eye-password" value="hiden" src="../assets/lou_icon/icon-eye.svg" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group-user mb-4">
                                                    <div class="d-flex align-items-center input-password">
                                                        <img src="<?= $urlThemeActive ?>assets/lou_icon/icon-password.svg" alt="">
                                                        <input type="password" placeholder="Mật khẩu mới" name="pass" class="form-control" required>
                                                        <img class="eye-password" value="hiden" src="<?= $urlThemeActive ?>assets/lou_icon/icon-eye.svg" alt="">
                                                    </div>                                            </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group-user mb-4">
                                                    <div class="d-flex align-items-center input-password">
                                                        <img src="<?= $urlThemeActive ?>assets/lou_icon/icon-password.svg" alt="">
                                                        <input type="password" placeholder="Xác nhận lại mật khẩu" name="passAgain" class="form-control" required>
                                                        <img class="eye-password" value="hiden" src="<?= $urlThemeActive ?>assets/lou_icon/icon-eye.svg" alt="">
                                                    </div>                                            
                                                </div>
                                            </div>

                                            <button type="submit" class="mt-3 btn button-submit-custom">Lưu</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </section>
        </div>
    </main>
<?php
getFooter();?>