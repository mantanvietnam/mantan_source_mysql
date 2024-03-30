<?php 
global $urlThemeActive;
$setting = setting(); 
?>

    <footer>
        <section id="section-footer-main">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 ">
                        <div class="logo-footer">
                            <img src="<?php echo show_text_clone(@$setting['logo']) ?>" alt="">
                        </div>
                    </div>

                    <div class="col-lg-5">
                        <div class="footer-center">
                            <p class="footer-company"><?php echo show_text_clone(@$setting['name_company']) ?></p>
                            <p class="footer-address">Địa chỉ: <?php echo show_text_clone(@$setting['address']) ?></p>
                            <p class="footer-phone">Hotline: <?php echo show_text_clone(@$setting['phone']) ?></p>
                            <p class="footer-email">Email: <?php echo show_text_clone(@$setting['email']) ?></p>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="footer-right">
                            <div class="footer-right-title">
                                Về Chúng Tôi
                            </div>

                            <div class="footer-right-description"><?php echo nl2br(show_text_clone(@$setting['aboutus'])) ?></div>

                            <div class="footer-list-social">
                                <ul>
                                    <li>
                                        <a href="<?php echo show_text_clone(@$setting['facebook']) ?>"><i class="fa-brands fa-facebook-f"></i></a>
                                    </li>
                                    <li>
                                        <a href="<?php echo show_text_clone(@$setting['twitter']) ?>"><i class="fa-brands fa-twitter"></i></a>
                                    </li>
                                    <li>
                                        <a href="<?php echo show_text_clone(@$setting['tiktok']) ?>"><i class="fa-brands fa-tiktok"></i></a>
                                    </li>
                                    <li></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="section-footer-bottom">
            <div class="container">
                <div class="footer-bottom text-center">
                    <p><?php echo show_text_clone(@$setting['textfooter']) ?></p>
                </div>
            </div>
        </section>
       
        <a id="button"></a>
    </footer>

    <!-- Magnific Popup core JS file -->
    <script src="asset/magnific-popup/jquery.magnific-popup.min.js"></script>

    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
         AOS.init();
    </script>

    <script src="<?php echo $urlThemeActive ?>/asset/js/main.js"></script>
    <script src="<?php echo $urlThemeActive ?>/asset/js/slick.js"></script>
    <script src="<?php echo $urlThemeActive ?>/asset/js/style_product.js"></script>
    <!-- // Ẩn phần tử -->
</body>
</html>


