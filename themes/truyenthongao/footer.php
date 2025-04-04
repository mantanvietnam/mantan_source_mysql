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
                                <img src="<?= @$settingThemes['logo'];?>" alt="<?= @$settingThemes['name_company'];?>" class="footer__logo">
                                <p class="footer__name"><?php echo strtoupper($_SERVER['HTTP_HOST']);?></p>
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
                        <div class="col-lg-4">
                            <h3 class="footer__title"><?= @$settingThemes['name_company'];?></h3>
                            <ul class="footer__list">
                                <li>Mã số thuế: <?= @$settingThemes['codebusiness'];?></li>
                                <li>Đại diện pháp luật: <?= @$settingThemes['legal_representative'];?></li>
                                <li>Ngày cấp giấy phép: <?= @$settingThemes['date_start_company'];?></li>
                            </ul>
                        </div>

                        <!-- Newsletter -->
                        <div class="col-lg -4">
                            <h3 class="footer__newsletter-title">
                                Nhận ngay tư vấn về chuyển đổi số ứng dụng công nghệ
                            </h3>
                            <div class="footer__form">
                                <form method="post" action="/addSubscribe">
                                    <input type="hidden" value="<?php echo $csrfToken; ?>" name="_csrfToken">
                                    <input type="email" class="footer__input" required name="email" placeholder="Nhập email của bạn">
                                    <button type="submit" class="footer__button">Đăng ký</button>
                                </form>
                            </div>
                            <div class="footer__social">
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
                        <div class="col-md-12 d-flex align-items-center">
                            <div class="footer__logo">
                                <p class="footer__copyright">
                                    Copyright © 2024 <?php echo strtoupper($_SERVER['HTTP_HOST']);?>. All rights reserved
                                </p>
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
        <script src="<?php echo $urlThemeActive;?>/asset/js/toptop.js?time=12223qs152"></script>
    </body>

</html>