<?php getHeader();?>
    <div class="register">
        <div class="container">
            <div class="register-main">
                <h1>LIÊN HỆ VỚI <?php echo @$setting_value['name_web'];?></h1>
                <p>Nếu bạn có thắc mắc gì, có thể gửi yêu cầu cho chúng tôi, và chúng tôi sẽ liên lạc lại với bạn sớm nhất có thể.</p>
                <?php echo $mess;?>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-12 contact-box-left">
                        <form action="" method="post">
                            <input type="hidden" name="_csrfToken" value="<?php echo $csrfToken;?>">
                            <div class="contact-form">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-12 mb-3">
                                        <div class="input-group">
                                            <input class="form-control" value="" name="name" type="text" placeholder="Tên của bạn" required>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-6 col-md-6 col-12 mb-3">
                                        <div class="input-group">
                                            <input class="form-control" type="email" placeholder="Email của bạn" value="" name="email">
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-12 mb-3">
                                        <div class="input-group">
                                            <input class="form-control" type="text" placeholder="Số điện thoại của bạn" required value="" name="phone">
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12 col-12 mb-3">
                                        <div class="input-group">
                                            <input class="form-control" type="text" placeholder="Tiêu đề" required value="" name="subject">
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12 col-12 mb-3">
                                        <div class="input-group">
                                            <textarea class="form-control" name="content" id="" placeholder="Nội dung" required></textarea>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12 col-12">
                                        <div class="register-btn">
                                            <button class="btn-logup" type="submit">Gửi cho chúng tôi</button>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12 contact-box-right">
                        <h2><b>THÔNG TIN LIÊN HỆ</b></h2>
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
        </div>
    </div>

<?php getFooter();?>





