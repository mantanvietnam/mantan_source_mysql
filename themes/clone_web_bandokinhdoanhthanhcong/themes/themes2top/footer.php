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
                    <img src="<?=$urlThemeActive?>asset/image/wave.webp" alt="">
                </div>
                <div class="row">
                    <div class="col-lg-4 col-12" data-aos="fade-right">
                        <div class="footer-company-info">
                            <div class="footer-company-intro">
                                <div class="footer-company-logo">
                                    <img src="<?=$urlThemeActive?>asset/image/toptop-logo.png" alt="">
                                </div>
                                <p>TOPTOP ra đời với sứ mệnh đồng hành và nâng tầm thương hiệu của bạn trên thị trường Internet. Chúng tôi giúp bạn phát triển với sự hỗ trợ của hệ sinh thái các giải pháp Marketing toàn diện. Đặc biệt với dịch vụ thiết kế
                                    website chuyên nghiệp tại TOPTOP, bạn và doanh nghiệp bạn sẽ có bệ phóng vững chắc cho mọi hoạt động kinh doanh.</p>
                            </div>

                            <div class="footer-company-address">
                                <h4>Trụ sở chính</h4>
                                <ul>
                                    <li><span>Địa chỉ:</span><?php echo $setting['diachi']; ?></li>
                                    <li><span>Số điện thoại:</span> <?php echo $setting['sdt']; ?></li>
                                    <li><span>Email</span> <?php echo $setting['email']; ?></li>
                                    <li><span>Thời gian hoạt động:</span> <?php echo $setting['timeaction']; ?></li>
                                </ul>

                            </div>

                            <div class="footer-company-icons-contact">
                                <h4>Kết nối với chúng tôi</h4>
                                <ul>
                                    <li><a href="<?php echo !empty(@$setting['facebook']) ? htmlspecialchars(@$setting['facebook']) : ''; ?>"><i class="fa-brands fa-facebook-f"></i></a></li>
                                    <li><a href="<?php echo !empty(@$setting['youtube']) ? htmlspecialchars(@$setting['youtube']) : ''; ?>"><i class="fa-brands fa-youtube"></i></a></li>
                                    <li><a href="<?php echo !empty(@$setting['youtube']) ? htmlspecialchars(@$setting['youtube']) : ''; ?>"><i class="fa-brands fa-instagram"></i></a></li>
                                    <li><a href="<?php echo !empty(@$setting['youtube']) ? htmlspecialchars(@$setting['youtube']) : ''; ?>"><i class="fa-brands fa-linkedin-in"></i></a></li>
                                    <li><a href="<?php echo !empty(@$setting['youtube']) ? htmlspecialchars(@$setting['youtube']) : ''; ?>"><i class="fa-brands fa-tiktok"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-12" data-aos="fade-up">
                        <div class="footer-company-services">
                            <h4>DỊCH VỤ</h4>
                            <ul>
                                <li><a href="">Thiết kế Website, App</a></li>
                                <li><a href="">Làm nội dung</a></li>
                                <li><a href="">Chạy quảng cáo</a></li>
                                <li><a href="">Dịch vụ PR</a></li>
                                <li><a href="">Vitual tour 360°</a></li>
                                <li><a href="">Tên miên - Web hosting</a></li>
                                <li><a href="">Dịch vụ dịch thuật</a></li>
                                <li><a href="">Dịch vụ lưu trú</a></li>
                                <li><a href="">Dịch vụ khác</a></li>
                            </ul>
                        </div>
                        <div class="footer-company-recruitment">
                            <h4>TUYỂN DỤNG</h4>
                            <ul>
                                <li>Gửi thông tin ứng tuyển tại</li>
                                <li><span>Email:</span> tuyendung@toptop.vn</li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-5 col-12" data-aos="fade-up-left">
                        <div class="footer-advise">
                            <div class="footer-advise-title">
                                <h4>GỬI YÊU CẦU BÁO GIÁ DỊCH VỤ</h4>
                                <p>TOP TOP luôn tư vấn dịch vụ miễn phí. Chúng tôi sẽ liên hệ báo giá theo thông tin mà bạn để lại.</p>
                            </div>
                            <div class="footer-advise-form">
                                <form action="">
                                    <div class="flex-input">
                                        <input type="text" placeholder="Họ và tên *" required>
                                        <input type="text" placeholder="Email *" required>
                                    </div>
                                    <input type="text" placeholder="Số điện thoại *" required>
                                    <input type="text" placeholder="Dịch vụ cần tư vấn *" required>
                                    <textarea name="" id="" rows="6" placeholder="Nội dung tin nhắn"></textarea>

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
            <p>© 2024 Top Top. All rights reserved.</p>
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
    <script src="<?= $urlThemeActive?>/asset/js/main.js"></script>
</body>

</html>