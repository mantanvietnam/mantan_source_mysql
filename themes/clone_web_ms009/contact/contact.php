<?php 
    global $settingThemes;
    getHeader();
    $setting = setting(); 
?>
    <main>
        <section id="blog">
            <div id="section-contact-content">
                <div class="container">
                    
                    <div class="row">
                        <div class="col-lg-6 col-md-12 col-12 contact-box-left">
                            <h2>Gửi thắc mắc cho chúng tôi</h2>
                            <?php echo $mess;?>
                            <p>Nếu bạn có thắc mắc gì, có thể gửi yêu cầu cho chúng tôi, và chúng tôi sẽ liên lạc lại với bạn sớm nhất có thể .</p>
                            <form action="" method="post">
                                <input type="hidden" name="_csrfToken" value="<?php echo $csrfToken;?>">
                                <div class="contact-form">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-12">
                                            <div class="input-group">
                                                <input class="form-control" value="" name="name" type="text" placeholder="Tên của bạn" required>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="input-group">
                                                <input class="form-control" type="email" placeholder="Email của bạn" value="" name="email">
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="input-group">
                                                <input class="form-control" type="text" placeholder="Số điện thoại của bạn" required value="" name="phone">
                                            </div>
                                        </div>

                                        <div class="col-lg-12 col-md-12 col-12">
                                            <div class="input-group">
                                                <input class="form-control" type="text" placeholder="Tiêu đề" required value="" name="subject">
                                            </div>
                                        </div>

                                        <div class="col-lg-12 col-md-12 col-12">
                                            <div class="input-group">
                                                <textarea class="form-control" name="content" id="" placeholder="Nội dung" required></textarea>
                                            </div>
                                        </div>

                                        <div class="col-lg-12 col-md-12 col-12">
                                            <button class="button-contact">Gửi cho chúng tôi</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                           
                        </div>
                      
        
                        <div class="col-lg-6 col-md-12 col-12 contact-box-right">
                            <h2>Thông tin liên hệ</h2>
                            <div class="contact-info">
                                <div class="contact-info-item">
                                    <div class="contact-info-img">
                                        <span><img src="<?php echo $urlThemeActive;?>/asset/image/place.png" alt=""></span>
                                    </div>
                                    <div class="contact-info-detail">
                                        <strong>Địa chỉ</strong>
                                        <br>
                                        <p><?php echo show_text_clone(@$setting['address']); ?></p>
                                    </div>
                                </div>


                                <div class="contact-info-item">
                                    <div class="contact-info-img">
                                        <span><img src="<?php echo $urlThemeActive;?>/asset/image/telephone.png" alt=""></span>
                                    </div>
                                    <div class="contact-info-detail">
                                        <strong>Số điện thoại</strong>
                                        <br>
                                        <p><?php echo show_text_clone(@$setting['phone']); ?></p>
                                    </div>
                                </div>

                                <div class="contact-info-item">
                                    <div class="contact-info-img">
                                        <span><img src="<?php echo $urlThemeActive;?>/asset/image/nine-oclock-on-circular-clock.png" alt=""></span>
                                    </div>
                                    <div class="contact-info-detail">
                                        <strong>Thời gian làm việc</strong>
                                        <br>
                                        <p>24/7</p>
                                    </div>
                                </div>

                                <div class="contact-info-item">
                                    <div class="contact-info-img">
                                        <span><img src="<?php echo $urlThemeActive;?>/asset/image/email.png" alt=""></span>
                                    </div>
                                    <div class="contact-info-detail">
                                        <strong>Email</strong>
                                        <br>
                                        <p><?php echo show_text_clone(@$setting['email']); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

<?php getFooter();?>





