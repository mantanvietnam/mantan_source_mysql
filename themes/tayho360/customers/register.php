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
                    <div class="col-7 box-sign box-register">
                        <ul class="nav nav-tabs nav-sign nav-sign-in" id="myTab">
                           	<li class="nav-item nav-item-sign">
                                <p class="nav-link-sign" id="sign-up-tab">Đăng ký</p>
                            </li>
                        </ul>

                        <div class="tab-content tab-content-sign" id="myTabContent">
                           
                            <!-- Đăng ký tab -->
                            <div class="tab-pane-sign tab-pane fade active show" id="sign-up" role="tabpanel" aria-labelledby="sign-up-tab">
                                <form action="" method="post">
                                	<input type="hidden" value="<?php echo $csrfToken;?>" name="_csrfToken">
                                    <div class="input-group input-sign-in-user">
                                        <label for="sign-in-name" class="user-label"><i
                                                class="fa-solid fa-user"></i></label>
                                        <input type="text" class="form-control" id="full_name" name="full_name" 
                                            placeholder="Tên đăng nhập" required>
                                    </div>
                                    <div class="input-group input-sign-in-password">
                                        <label for="sign-in-email" class="password-label"><i class="fa-solid fa-phone"></i></label>
                                        <input type="text" class="form-control" id="phone" name="phone"
                                            placeholder="Nhập số điên thoại" required>
                                    </div>
                                    <div class="input-group input-sign-in-password">
                                        <label for="sign-in-email" class="password-label"><i class="fa-solid fa-envelope"></i></label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            placeholder="Nhập email" required>
                                    </div>
                                    <div class="input-group input-change-password">
                                        <label for="change-password" class="change-password-label"><i
                                                class="fa-solid fa-lock"></i></label>
                                        <input type="password" class="form-control" id="pass" name="pass"
                                            placeholder="Mật khẩu" required>
                                        <div class="icon-eye-button">
                                            <img class="eye-icon" value="close" src="<?= $urlThemeActive ?>/img/eyeclose.png" alt="">
                                        </div>
                                    </div>
                                    <div class="input-group input-change-password">
                                        <label for="verify-change-password" class="change-password-label"><i
                                                class="fa-solid fa-lock"></i></label>
                                        <input type="password" class="form-control" id="passAgain" name="passAgain"
                                            placeholder="Nhập lại Mật khẩu" required>
                                        <div class="icon-eye-button">
                                            <img class="eye-icon" value="close" src="<?= $urlThemeActive ?>/img/eyeclose.png" alt="">
                                        </div>
                                    </div>
                                    <button class="button-sign-in button-register" type="submit">Đăng ký</button>
                               </form>
                                <div class="sign-in-other register-other">
                                    <p>Hoặc Đăng ký với</p>
                                    <a class="sign-in-mobile" href=""><i class="fa-solid fa-mobile-screen"></i></a>
                                    <a class="sign-in-google" href=""><i class="fa-brands fa-google"></i></a>
                                    <a class="sign-in-facebook" href=""><i class="fa-brands fa-facebook"></i></a>
                                </div>
                                <div class="register-text">
                                    <p>Chưa có tài khoản? <a href="">Đăng ký ngay</a></p>
                                </div>
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