
<?php 
    global $settingThemes;
    global $modelAlbums;
?>

<?php getHeader();?>
    <main>
        <section id="section-banner-page">
            <div class="banner-page">
                <img src="<?php echo $urlThemeActive; ?>/asset/img/banner-library.png" alt="">
            </div>
        </section>

        <section id="section-info-contact">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-12 info-contact-left">
                        <div class="info-contact-title">
                            <p>Liên hệ</p>
                        </div>

                        <div class="info-contact-box">
                            <div class="info-contact-item">
                                <div class="info-contact-name">
                                    <div class="info-contact-text">
                                        <p>Văn phòng Yên Lâm</p>
                                    </div>
                                </div>
                
                                <div class="info-contact-address info-contact">
                                    <div class="info-contact-icon">
                                        <i class="fa-solid fa-location-dot"></i>
                                        <p>Địa chỉ</p>
                                    </div>
                                    <div class="info-contact-text">
                                        <a href=""><?php echo $contactSite['address'];?></a>
                                    </div>
                                </div>
            
                                <div class="info-contact-hotline info-contact">
                                    <div class="info-contact-icon">
                                        <i class="fa-solid fa-phone"></i>
                                        <p>Hotline</p>                        
                                    </div>
                                    <div class="info-contact-text">
                                        <a href=""><?php echo $contactSite['phone'];?></a>
                                    </div>
                                </div>
            
                                <div class="info-contact-email info-contact">
                                    <div class="info-contact-icon">
                                        <i class="fa-solid fa-envelope"></i>
                                        <p>Email</p>
                                    </div>
                                    <div class="info-contact-text">
                                        <a href=""><?php echo $contactSite['email'];?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
            
                        
                    </div>

                    <div class="col-lg-6 col-md-6 col-12 info-contact-right">
                        <div>
                            <div class="info-contact-img-map">
                                <img src="<?php echo $urlThemeActive; ?>/asset/img/map.jpg" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="section-form-contact">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 col-md-7 col-12 ">
                        <div class="form-contact">
                            <form action="" method="post">
                                <input type="hidden" name="_csrfToken" value="<?php echo $csrfToken;?>">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-12 input-contact">
                                        <input class="form-control" value="" name="name" type="text" placeholder="Tên của bạn" required>
                                    </div>

                                    <div class="col-lg-12 col-md-12 col-12 input-contact">
                                        <input type="text" class="form-control" placeholder="Doanh nghiệp *" name="company" required>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-12 input-contact">
                                        <input class="form-control" type="text" placeholder="Số điện thoại của bạn" required value="" name="phone_number">
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-12 input-contact">
                                        <input class="form-control" type="email" placeholder="Email của bạn" value="" name="email" required>
                                    </div>

                                    <div class="col-lg-12 col-md-12 col-12 input-contact">
                                        <input class="form-control" type="text" placeholder="Tiêu đề" required value="" name="subject">
                                    </div>

                                    <div class="col-lg-12 col-md-6 col-12 input-contact">
                                        <textarea type="text" id="content" name="content" rows="2" class="form-control md-textarea" placeholder="Nội dung"></textarea>
                                    </div>
                                    <div class="col-lg-12 col-md-6 col-12 button-submit-contact">
                                        <button>Gửi liên hệ</button>
                                    </div>
                                </div>
                            </form>
                            <?php echo $mess;?>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
<?php getFooter();?>
