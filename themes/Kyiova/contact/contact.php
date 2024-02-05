<?php
getHeader();
global $urlThemeActive;

$setting = setting();?>
    <main>
        <section id="contact-us">
            <div class="container">
                <div class="contact-us-title">
                    <h2>Liên hệ</h2>
                </div>
                <div class="row">
                    <div class="col-lg-7 order-custom">
                        <div class="contact-infor">
                            <form id="formContact" onsubmit="" action="" method="post" class="form-custom-1 py-3">
                                 <input type="hidden" value="<?php echo $csrfToken; ?>" name="_csrfToken">
                            <div class="contact-infor-title">
                                <h3>Thông tin liên hệ</h3>
                                <?php echo @$mess; ?>
                            </div>
                            <div class="col-lg-12 combo-input">
                                <input type="text" name="name"  placeholder="Họ và tên">
                                <input type="email" name="email"  placeholder="Email">
                            </div>

                            <div class="col-lg-12">
                                <input type="tel" name="phone" placeholder="Số điện thoại">
                            </div>
                            <div class="col-lg-12">
                                <input type="text" name="subject" placeholder="Chủ đề">
                            </div>
                            <div class="col-lg-12">
                                <textarea  cols="30"  name="content" rows="8" placeholder="Nội dung"></textarea>
                            </div>

                            <div class="contact-infor-btn">
                                <button type="submit">Gửi </button>
                            </div>
                        </form>
                        </div>
                    </div>

                    <div class="col-lg-5">
                        <div class="contact-us-infor">
                            <div class="contact-us-infor-title">
                                <h3>Liên hệ với chúng tôi</h3>
                            </div>
                            <div class="contact-us-infor-detail">
                                <p><i class="fa-solid fa-location-dot"></i><?php echo @$setting['address_footer'] ?></p>
                                <p><i class="fa-solid fa-phone"></i><?php echo @$setting['phone_footer'] ?></p>
                                <p><i class="fa-solid fa-envelope"></i><?php echo @$setting['email_footer'] ?></p>
                                <p><i class="fa-solid fa-globe"></i><?php echo @$setting['web_footer'] ?></p>
                            </div>
                            <div class="bg-earth">
                                <img src="<?php echo $urlThemeActive; ?>/asset/image/thanks.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>

<?php
getFooter();?>