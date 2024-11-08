<?php
     global $settingThemes;
?>
<footer class="footer">
            <div class="container">
                <div class="footer__main">
                    <div class="row">
                        <!-- Company Info -->
                        <div class="col-md-4">
                            <div class="footer__brand">
                                <img src="<?= @$settingThemes['logo'];?>" alt="PHONGTRUYEN" class="footer__logo">
                                <p class="footer__name">PHONGTRUYENTHONG.COM</p>
                            </div>
                            <div class="footer__contact">
                                <p class="footer__address">
                                    <i class="fas fa-map-marker-alt"></i> <?= @$settingThemes['address'];?>
                                </p>
                                <p class="footer__phone">
                                    <i class="fas fa-phone"></i> <?= @$settingThemes['phone'];?>
                                </p>
                                <p class="footer__email">
                                    <i class="fas fa-envelope"></i> <?= @$settingThemes['email'];?>
                                </p>
                            </div>
                        </div>

                        <!-- Company Links -->
                        <div class="col-lg -2">
                            <h3 class="footer__title">Company</h3>
                            <ul class="footer__list">
                                <li><a href="#" class="footer__link">About Us</a></li>
                                <li><a href="#" class="footer__link">Membership</a></li>
                                <li><a href="#" class="footer__link">Careers</a></li>
                            </ul>
                        </div>

                        <!-- Support Links -->
                        <div class="col-lg -2">
                            <h3 class="footer__title">Support</h3>
                            <ul class="footer__list">
                                <li><a href="#" class="footer__link">Contact Us</a></li>
                                <li><a href="#" class="footer__link">Online Chat</a></li>
                                <li><a href="#" class="footer__link">Help Center</a></li>
                            </ul>
                        </div>

                        <!-- Newsletter -->
                        <div class="col-lg -4">
                            <h3 class="footer__newsletter-title">
                                Nhận ngay tư vấn về chuyển đổi số ứng dụng công nghệ
                            </h3>
                            <div class="footer__form">
                                <input type="email" class="footer__input" placeholder="Enter your email">
                                <button class="footer__button">Đăng ký</button>
                            </div>
                            <div class="footer__social">
                                <a href="<?= @$settingThemes['youtube'];?>" class="footer__social-link"><i class="fab fa-linkedin"></i></a>
                                <a href="<?= @$settingThemes['twiter'];?>" class="footer__social-link"><i class="fab fa-twitter"></i></a>
                                <a href="<?= @$settingThemes['facebook'];?>" class="footer__social-link"><i class="fab fa-facebook-f"></i></a>
                                <a href="<?= @$settingThemes['youtube'];?>" class="footer__social-link"><i class="fab fa-youtube"></i></a>
                                <a href="<?= @$settingThemes['instagram'];?>" class="footer__social-link"><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer Bottom -->
                <div class="footer__bottom">
                    <div class="row align-items-center">
                        <div class="col-md-8 d-flex align-items-center">
                            <div class="footer__certificate mx-4">
                                <img src="<?= @$settingThemes['imagedeep'];?>" style="width: 170px; height: auto;" alt="Chứng nhận Bộ Công Thương">
                            </div>
                            <div class="footer__logo">
                                <p class="footer__copyright">
                                    Copyright © 2021 VSDS. All rights reserved
                                </p>
                                <p class="footer__registration">
                                    Mã số DN: 0123456789, đăng ký lần đầu ngày 01/01/2021, thay đổi lần thứ 5 ngày 21/8/2022
                                </p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="footer__links">
                                <a href="#" class="footer__bottom-link">FAQ</a>
                                <a href="#" class="footer__bottom-link">Terms of Condition</a>
                                <a href="#" class="footer__bottom-link">Privacy Policy</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

        <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
        <script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="<?php echo $urlThemeActive;?>/asset/js/toptop.js"></script>
    </body>

</html>