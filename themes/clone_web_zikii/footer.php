<?php global $settingThemes;?>

    <footer>
        <secrion id="section-footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-12">
                        <div class="footer-item">
                            <div class="footer-logo">
                                <img src="<?php echo show_text_clone(@$settingThemes['image_logo']); ?>" alt="">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-12">
                        <div class="footer-item">
                            <div class="footer-title">
                                <h3><?php echo show_text_clone(@$settingThemes['title_footer_left']); ?></h3>
                            </div>

                            <div class="footer-subtitle">
                                <p><?php echo show_text_clone(@$settingThemes['title_footer_green']); ?></p>
                            </div>

                            <div class="footer-list">
                                <ul>
                                    <li>Địa chỉ: <strong><?php echo show_text_clone(@$settingThemes['address_footer']); ?></strong></li>
                                    <li>Điện thoại: <strong><?php echo show_text_clone(@$settingThemes['phone_footer']); ?></strong></li>
                                    <li>Email: <a href="mailto:<?php echo show_text_clone(@$settingThemes['email_footer']); ?>"><?php echo show_text_clone(@$settingThemes['email_footer']); ?></a></li>
                                    <li>Website: <a href=""><?php echo show_text_clone(@$settingThemes['web_footer']); ?></a></li>
                                    <li>Fanpage Facebook: <a href="<?php echo show_text_clone(@$settingThemes['link_page']); ?>"><?php echo show_text_clone(@$settingThemes['page_footer']); ?></a></li>
                                </ul>
                            </div>

                        </div>
                    </div>

                    <div class="col-lg-3 col-md-12">
                        <div class="footer-item">
                            <div class="footer-menu-title">
                                <h3><?php echo show_text_clone(@$settingThemes['title_footer_right']); ?></h3>
                            </div>

                            <div class="footer-menu">
                                <ul>
                                    <!-- <li><a href="">Hướng dẫn đặt hàng</a></li>
                                    <li><a href="">Hướng dẫn thanh toán</a></li>
                                    <li><a href="">Điều khoản và trách nhiệm</a></li>
                                    <li><a href="">Đổi trả và bảo hành</a></li>
                                    <li><a href="">Tuyển dụng</a></li> -->
                                    <?php $category = getCategorieProduct();
                                        if(!empty($category)){
                                            foreach($category as $key => $item){
                                                echo '<li><a href="/category/'.$item->slug.'.html">'.$item->name.'</a></li>';
                                            }
                                        }
                                     ?>
                                    <li></li>
                                </ul>
                            </div>

                            <div class="social-list">
                                <ul class="d-flex">
                                    <li class="social-item">
                                        <a target="_blank" href="<?php echo show_text_clone(@$settingThemes['link_page']); ?>">
                                            <img src="<?php echo $urlThemeActive ?>asset/image/face.png" alt="">
                                        </a>
                                    </li>

                                    <li class="social-item">
                                        <a target="_blank" href="<?php echo show_text_clone(@$settingThemes['insta']); ?>">
                                            <img src="<?php echo $urlThemeActive ?>asset/image/logozalo.png" alt="">
                                        </a>
                                    </li>

                                    <li class="social-item">
                                        <a target="_blank" href="<?php echo show_text_clone(@$settingThemes['youtube']); ?>">
                                            <img src="<?php echo $urlThemeActive ?>asset/image/youtube.png" alt="">
                                        </a>
                                    </li>

                                    <li class="social-item">
                                        <a target="_blank" href="<?php echo show_text_clone(@$settingThemes['tiktok']); ?>">
                                            <img src="<?php echo $urlThemeActive ?>asset/image/tiktok.png" alt="">
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="section-footer-info">
                    <div class="container">
                        <p><?php echo show_text_clone(@$settingThemes['business_certificates']); ?></p>
                        <p>Người đại diện theo pháp luật: <?php echo show_text_clone(@$settingThemes['represent']); ?></p>
                        <p>Email: <?php echo show_text_clone(@$settingThemes['email_footer']); ?>, Điện thoại: <?php echo show_text_clone(@$settingThemes['phone_footer']); ?></p>
                    </div>
                </div>
            </div>
        </secrion>
        <section id="section-footer-bottom">
            <p><?php echo show_text_clone(@$settingThemes['textfooter']); ?></p>
        </section>
        <section id="scroll-top">
            <button id="scrollToTopBtn" onclick="scrollToTop()"><i class="fa-solid fa-angles-up fa-bounce"></i></button>
        </section>

        <section id="section-search">
            <div class="overlay" id="overlay">
                <button type="button" class="close-btn" onclick="closeOverlay()"><i class="fa-solid fa-xmark"></i></button>
                <div class="overlay-content">

                    <form onsubmit="" action="/search-product" method="get" id="myForm" class="form-custom">
                        <input type="text" class="search-input"  name="key" placeholder="Nhập từ khóa">
                        <button type="submit" class="search-btn"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </form>
                </div>
            </div>
        </section>

        <!-- Magnific Popup core JS file -->
        <script src="<?php echo $urlThemeActive ?>asset/magnific-popup/jquery.magnific-popup.min.js"></script>

        <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
        <script>
            AOS.init({
            // ... các tùy chọn khác
            disable: 'mobile', 
            });
        </script>
        <script src="<?php echo $urlThemeActive ?>asset/js/main.js"></script>

        <script src="<?php echo $urlThemeActive ?>asset/js/slick.js"></script>
        <script src="<?php echo $urlThemeActive ?>asset/js/emhieu.js"></script>
    </footer>
</body>

</html>

