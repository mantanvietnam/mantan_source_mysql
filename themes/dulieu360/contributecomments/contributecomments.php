<?php
getHeader();
?>
  <main>
        <section id="section-banner-top" class="contact">

            <div class="container">
                <div class="banner-contain">
                    <div>
                        <div class="desktop-banner">
                            <img src="<?= $urlThemeActive?>assets/img/Screenshot_2.png" alt="">
                        </div>
                        <div class="banner-contain-title">
                            <p>Góc đóng góp</p>
                            <h3>Đóng góp ý kiến của bạn để phát triển <br> quận <span>Đống Đa</span> ngày càng tốt đẹp</h3>
                        </div>
                    </div>

                </div>

                <div class="banner-contain-3">
                    <div class="row">
                        <div class="col-lg-6 col-12 no-padding-right">
                            <div class="contact-form">
                                <h4>Cảm ơn bạn đã đóng góp ý kiến! <br> Chúng tôi sẽ sử dụng thông tin bạn đã cung cấp.</h4>
                                <?= $mess; ?>
                                <form action="" method="post">
                                    <input type="hidden" value="<?php echo $csrfToken; ?>" name="_csrfToken">
                                    <input type="text" name="name" placeholder="Họ và tên *" required>

                                    <input type="text" name="phone" placeholder="Số điện thoại *" required>

                                    <input type="email" name="email" placeholder="Email *" required>

                                    <textarea name="content" id="" cols="30" rows="5" placeholder="Nội dung đóng gop *" required></textarea>

                                    <div><button class="custom-btn" type="submit">Gửi</button></div>
                                </form>
                            </div>
                        </div>

                        <div class="col-lg-6 col-12 no-padding">
                            <div class="contact-form-img">
                                <img src="<?= $urlThemeActive?>assets/img/tayhobackground.jpg" alt="">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </main>
<?php getFooter();?>