<?php getHeader();
    global $settingThemes;

?>
<main>
        <section id="section-banner-top" class="contact">
            <div class="container">
                <div class="banner-contain">
                    <div>
                        <div class="desktop-banner">
                            <img src="../Asset/images/news.jpg" alt="">
                        </div>
                        <div class="banner-contain-title">
                            <p>Liên hệ với chúng tôi</p>
                            <h3>Chúng tôi <span>luôn ở đây</span> <br>mỗi khi <span>bạn cần</span></h3>
                        </div>
                    </div>

                </div>

                <div class="banner-contain-3">
                    <div class="row">
                        <div class="col-lg-6 col-12 no-padding-right">
                            <div class="contact-form">
                                <h4>Chúng tôi sẽ liên hệ với bạn theo thông tin bạn gửi, vui lòng điền vào khung thông tin bên dưới.</h4>
                                <?= $mess; ?>
                                <form action="" method="POST">
                                    <input type="text" placeholder="Họ và tên *" name="name" required>
                                    <input type="hidden" value="<?php echo $csrfToken; ?>" name="_csrfToken">
                                    <input type="text" placeholder="Số điện thoại *" name="phone" required>
                                    <input type="email" placeholder="Email *" name="email" required>
                                    <select name="subject" id="" required>
                                        <option value="Đối tác">Đối tác</option>
                                        <option value="Khách hàng">Khách hàng</option>
                                    </select>
                                    <textarea  id="" cols="30" rows="5" placeholder="Nội dung tin nhắn *" name="content" required></textarea>

                                    <div>
                                        <button href="" class="custom-btn" type="submit">Gửi</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="col-lg-6 col-12 no-padding">
                            <div class="contact-form-img">
                                <img src=" <?= @$settingThemes['imagecontact'];?>" alt="">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <section id="section-company-address">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 col-12">
                        <div class="company-address">
                            <ul>
                                <li>Email <br> <span><?= @$settingThemes['email'];?></span></li>
                                <li>Hotline <br> <span><?= @$settingThemes['phone'];?></li>
                                <li>Trụ sở <br> <span><?= @$settingThemes['address'];?></span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-7 col-12">
                        <div class="company-address-map">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3725.391816728569!2d105.77771597612795!3d20.97692538955525!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3134530050a89895%3A0x1038921026f5fc65!2sPhoenix%20Building%20-%2018%20Thanh%20B%C3%ACnh!5e0!3m2!1svi!2s!4v1708933628319!5m2!1svi!2s"
                                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </main>
<?php 
    getFooter();
?>