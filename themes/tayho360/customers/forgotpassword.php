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
                                <p class="nav-link-sign active" id="sign-in-tab" >Xách nhận Email</p>
                            </li> 

                            
                        </ul>

                        <div class="tab-content tab-content-sign" id="myTabContent">
                            <!-- Đăng nhập tab -->
                            <?php echo @$mess; ?>
                            <div class="tab-pane-sign tab-pane fade show active" id="sign-in" role="tabpanel"
                                aria-labelledby="sign-in-tab">
                                  <form action="" method="post">
                                	<input type="hidden" value="<?php echo $csrfToken;?>" name="_csrfToken">
                                    <div class="input-group input-sign-in-user">
                                        <label for="sign-in-name" class="user-label"><i
                                                class="fa-solid fa-user"></i></label>
                                        <input type="text" class="form-control" id="email" name="email"
                                            placeholder="Email" required>
                                    </div>
                                    
                                    <button class="button-sign-in" type="submit">Gửi</button>
                                    
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