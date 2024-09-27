<?php global $settingThemes; ?>
<footer>
        <section id="footer">
            <div class="container">

                <div class="footer-contact-absolute">
                    <div class="footer-contact">
                        <div class="footer-contact-text">
                            <p>Ngay bây giờ chính là thời điểm sớm nhất<br> Bước gần hơn đến thành công của bạn bằng cách trò chuyện với chúng tôi</p>
                        </div>

                        <div class="footer-contact-btn">
                            <button class="advise-button" data-aos="zoom-in">Liên hệ ngay</button>
                        </div>

                    </div>
                </div>

                <div class="footer-contact-wave">
                    <img src="<?php echo $urlThemeActive;?>/asset/image/wave.webp" alt="">
                </div>


                <div class="row">
                    <div class="col-lg-4 col-12" data-aos="fade-right">
                        <div class="footer-company-info">
                            <div class="footer-company-intro">
                                <div class="footer-company-logo">
                                    <img src="<?php echo @$settingThemes['logo'];?>" alt="">
                                </div>
                                <p><?php echo @$settingThemes['content1_footer'];?></p>
                            </div>

                            <div class="footer-company-address">
                                <h4>Trụ sở chính</h4>
                                <ul>
                                    <li><span>Địa chỉ:</span> <?php echo $contactSite['address'];?></li>
                                    <li><span>Số điện thoại:</span> <?php echo $contactSite['phone'];?></li>
                                    <li><span>Email</span> <?php echo $contactSite['email'];?></li>
                                </ul>

                            </div>

                            <div class="footer-company-icons-contact">
                                <h4>Kết nối với chúng tôi</h4>
                                <ul>
                                    <li><a href="<?php echo @$settingThemes['facebook'];?>"><i class="fa-brands fa-facebook-f"></i></a></li>
                                    <li><a href="<?php echo @$settingThemes['youtube'];?>"><i class="fa-brands fa-youtube"></i></a></li>
                                    <li><a href="<?php echo @$settingThemes['instagram'];?>"><i class="fa-brands fa-instagram"></i></a></li>
                                    <li><a href="<?php echo @$settingThemes['linkedIn'];?>"><i class="fa-brands fa-linkedin-in"></i></a></li>
                                    <li><a href="<?php echo @$settingThemes['tiktok'];?>"><i class="fa-brands fa-tiktok"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-12" data-aos="fade-up">
                        <div class="footer-company-services">
                            <h4>LIÊN KẾT</h4>
                            <ul>
                                <li><a href="">PHOENIX TECH</a></li>
                                <li><a href="">DATA CRM</a></li>
                                <li><a href="">DATA BOT</a></li>
                                <li><a href="">DATA SPA</a></li>
                                <li><a href="">EZPICS</a></li>
                            </ul>
                        </div>
                        <div class="footer-company-recruitment">
                            <h4>TUYỂN DỤNG</h4>
                            <ul>
                                <li>Gửi thông tin ứng tuyển tại</li>
                                <li><span>Email:</span> <?php echo $contactSite['email'];?></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-5 col-12" data-aos="fade-up-left">
                        <div class="footer-advise">
                            <div class="footer-advise-title">
                                <h4>GỬI YÊU CẦU BÁO GIÁ DỊCH VỤ</h4>
                                <p><?php echo @$settingThemes['name_brand'];?> luôn tư vấn dịch vụ miễn phí. Chúng tôi sẽ liên hệ báo giá theo thông tin mà bạn để lại.</p>
                            </div>
                            <div class="footer-advise-form">
                                <form action="/contact" method="POST">
                                    <input type="hidden" name="_csrfToken" value="<?php echo $csrfToken;?>">
                                    <div class="flex-input">
                                        <input type="text" placeholder="Họ và tên *" required value="" name="name">
                                        <input type="text" placeholder="Email *" required value="" name="email">
                                    </div>
                                    <input type="text" placeholder="Số điện thoại *" required value="" name="phone_number">
                                    <input type="text" placeholder="Tiêu đề *" required value="" name="subject">
                                    <textarea name="content" id="" rows="6" placeholder="Nội dung tin nhắn"></textarea>

                                    <div class="footer-advise-form-btn">
                                        <button type="submit">Gửi</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>

        <section id="copy-right">
            <p>© 2024 <?php echo @$settingThemes['name_brand'];?>. All rights reserved.</p>
        </section>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="<?php echo $urlThemeActive;?>/asset/js/main.js?time=1234"></script>
</body>

</html>