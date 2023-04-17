<?php
getHeader();
global $urlThemeActive;
?>

    <main>
        <section class="section-background-index">
            <div class="container-fluid background-index">
                <img src="<?= $urlThemeActive ?>/img/ttten.png" alt="">
            </div>
        </section>

        <section id="section-sign">
            <div class="container-sign container">
                <div class="row row-sign">
                    <div class="col-7 box-sign">
                        <ul class="nav nav-tabs nav-sign" id="myTab">
                            <li class="nav-item nav-item-sign">
                                <p class="nav-link-sign active" id="sign-in-tab" >Thay đổi mật khẩu mới</p>
                            </li> 

                            
                        </ul>

                        <div class="tab-content tab-content-sign" id="myTabContent">
                            <!-- Đăng nhập tab -->
                            <?php echo @$mess; ?>
                            <div class="tab-pane-sign tab-pane fade show active" id="sign-in" role="tabpanel"
                                aria-labelledby="sign-in-tab">
                                  <form action="" method="post">
                                            <input type="hidden" value="<?php echo $csrfToken;?>" name="_csrfToken">
                                            <div class="col-12">
                                                <div class="form-group-user mb-4">
                                                    <div class="d-flex align-items-center input-password">
                                                        
                                                        <img src="<?= $urlThemeActive ?>assets/lou_icon/icon-password-pre.svg" alt="">
                                                        <input type="password" placeholder="check email lấy mật khẩu " name="oldpass" class="form-control" required>
                                                        <img class="eye-password" value="hiden" src="../assets/lou_icon/icon-eye.svg" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group-user mb-4">
                                                    <div class="d-flex align-items-center input-password">
                                                        <img src="<?= $urlThemeActive ?>assets/lou_icon/icon-password.svg" alt="">
                                                        <input type="password" placeholder="Đổi mật khẩu mới" name="pass" class="form-control" required>
                                                        <img class="eye-password" value="hiden" src="<?= $urlThemeActive ?>assets/lou_icon/icon-eye.svg" alt="">
                                                    </div>                                            </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group-user mb-4">
                                                    <div class="d-flex align-items-center input-password">
                                                        <img src="<?= $urlThemeActive ?>assets/lou_icon/icon-password.svg" alt="">
                                                        <input type="password" placeholder="Xác nhận lại mật khẩu mới" name="passAgain" class="form-control" required>
                                                        <img class="eye-password" value="hiden" src="<?= $urlThemeActive ?>assets/lou_icon/icon-eye.svg" alt="">
                                                    </div>                                            
                                                </div>
                                            </div>

                                            <button type="submit" class="mt-3 btn button-submit-custom">Lưu</button>
                                        </form>
                                


                            </div>
                           
                        </div>
                    </div>

                    <div class="col-5 background-right-sign">
                        <div class="background-right-sign-circle">
                        </div>
                        <div class="background-right-sign-scene">
                            <img src="<?= $urlThemeActive ?>/img/tayhobackground.jpg" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>


<?php
getFooter();?>