<?php getHeader();
    global $settingThemes;

?>
<main>
        <section id="section-banner-top" class="contact" style=" background-image: url('<?= @$settingThemes['imageheadercontact'];?>');background-repeat: no-repeat;background-size: cover;background-position: center;">
            <div class="container">
                <div class="banner-contain-3">
                    <div class="row">
                        <div class="col-lg-6 col-12 no-padding-right">
                            <div class="contact-form">
                                <h4>Liên Hệ Ngay</h4>
                                <?= $mess; ?>
                                <form action="" method="POST">
                                    <input type="text" placeholder="Họ và tên *" name="name" required>
                                    <input type="hidden" value="<?php echo $csrfToken; ?>" name="_csrfToken">
                                    <input type="text" placeholder="Số điện thoại *" name="phone" required>
                                    <input type="email" placeholder="Email " name="email" required>
                                    <input type="hidden" placeholder="" name="subject" value=" ">
                                    <textarea  id="" cols="30" rows="5" placeholder="Nội dung tin nhắn " name="content" required></textarea>

                                    <div>
                                        <button href="" class="custom-btn" type="submit">Gửi</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="col-lg-6 col-12 no-padding">
                            <div class="contact-us-infor">
                                <div class="contact-us-infor-title">
                                    <h3>Liên hệ với chúng tôi</h3>
                                </div>
                                <div class="contact-us-infor-detail">
                                    <p><i class="fa-solid fa-location-dot" aria-hidden="true"></i><?= @$settingThemes['address'];?></p>
                                    <p><i class="fa-solid fa-phone" aria-hidden="true"></i><?= @$settingThemes['phone'];?></p>
                                    <p><i class="fa-solid fa-envelope" aria-hidden="true"></i><?= @$settingThemes['emailfooter'];?></p>
                                    <!-- <p><i class="fa-solid fa-globe" aria-hidden="true"></i>http://donganh360.vn/</p> -->
                                </div>
                                <div class="bg-earth">
                                    <img src="/Content/fe/images/bg3.png" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
<?php 
    getFooter();
?>