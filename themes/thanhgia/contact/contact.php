<?php 
    global $settingThemes;
    getHeader();
?>
    <main>
        <section id="section-breadcrumb">
            <div class="container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Liên hệ</li>
                    </ol>
                </nav>
            </div>
        </section>

        <section id="section-map-contact">
            <div class="map-contact" id="mapContact">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d232.68919418483935!2d105.89958532418642!3d21.071579538198435!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135a9781fca550f%3A0x22459c5b088ea9a7!2zQ8O0bmcgdHkgcGjDom4gcGjhu5FpIHBo4bulIHTDuW5nIHhlIG3DoXkgVGjDoG5oIEdpYQ!5e0!3m2!1svi!2s!4v1690711715352!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </section>

        <section id="section-contact-content">
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
                                            <input class="form-control" type="text" placeholder="Số điện thoại của bạn" required value="" name="phone_number">
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
                                    <span><img src="<?php echo $urlThemeActive;?>/asset/img/place.png" alt=""></span>
                                </div>
                                <div class="contact-info-detail">
                                    <strong>Địa chỉ</strong>
                                    <br>
                                    <p><?php echo $contactSite['address'];?></p>
                                </div>
                            </div>


                            <div class="contact-info-item">
                                <div class="contact-info-img">
                                    <span><img src="<?php echo $urlThemeActive;?>/asset/img/telephone.png" alt=""></span>
                                </div>
                                <div class="contact-info-detail">
                                    <strong>Số điện thoại</strong>
                                    <br>
                                    <p><?php echo $contactSite['phone'];?></p>
                                </div>
                            </div>

                            <div class="contact-info-item">
                                <div class="contact-info-img">
                                    <span><img src="<?php echo $urlThemeActive;?>/asset/img/nine-oclock-on-circular-clock.png" alt=""></span>
                                </div>
                                <div class="contact-info-detail">
                                    <strong>Thời gian làm việc</strong>
                                    <br>
                                    <p><?php echo $settingThemes['time_open'];?></p>
                                </div>
                            </div>

                            <div class="contact-info-item">
                                <div class="contact-info-img">
                                    <span><img src="<?php echo $urlThemeActive;?>/asset/img/email.png" alt=""></span>
                                </div>
                                <div class="contact-info-detail">
                                    <strong>Email</strong>
                                    <br>
                                    <p><?php echo $contactSite['email'];?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

<?php getFooter();?>





