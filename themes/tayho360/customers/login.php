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
                                <p class="nav-link-sign active" id="sign-in-tab" >Đăng nhập</p>
                            </li> 

                            
                        </ul>

                        <div class="tab-content tab-content-sign" id="myTabContent">
                            <!-- Đăng nhập tab -->
                            <div class="tab-pane-sign tab-pane fade show active" id="sign-in" role="tabpanel"
                                aria-labelledby="sign-in-tab">
                                  <form action="" method="post">
                                	<input type="hidden" value="<?php echo $csrfToken;?>" name="_csrfToken">
                                    <div class="input-group input-sign-in-user">
                                        <label for="sign-in-name" class="user-label"><i
                                                class="fa-solid fa-user"></i></label>
                                        <input type="text" class="form-control" id="email" name="email"
                                            placeholder="Tên đăng nhập" required>
                                    </div>
                                    <div class="input-group input-sign-in-password">
                                        <label for="sign-in-password" class="password-label"><i
                                                class="fa-solid fa-lock"></i></label>
                                        <input type="password" class="form-control" id="pass" name="pass"
                                            placeholder="Mật khẩu" required>
                                        <div class="icon-eye-button">
                                            <img class="eye-icon" value="close" src="<?= $urlThemeActive ?>/img/eyeclose.png" alt="">
                                        </div>
                                    </div>
                                    <button class="button-sign-in" type="submit">Đăng nhập</button>
                                    <div class="forgot-password">
                                        <a href="">Quên mật khẩu</a> | 
                                        <a href="/register">Đăng ký</a>
                                    </div>
                                </form>
                                <div class="sign-in-other">
                                    <p>Hoặc Đăng nhập với</p>
                                    <a class="sign-in-mobile" href=""><i class="fa-solid fa-mobile-screen"></i></a>
                                    <a class="sign-in-google" href=""><i class="fa-brands fa-google"></i></a>
                                    <a class="sign-in-facebook" href=""><i class="fa-brands fa-facebook"></i></a>
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