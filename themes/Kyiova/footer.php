<?php
global $urlThemeActive;
$setting = setting();?>

    <footer>
        <secrion id="section-footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-12">
                        <div class="footer-item">
                            <div class="footer-logo">
                                <img src="<?php echo @$setting['image_logo'] ?>" alt="">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-12">
                        <div class="footer-item">
                            <div class="footer-title">
                                <h3><?php echo @$setting['title_footer_left'] ?></h3>
                            </div>

                            <div class="footer-subtitle">
                                <p><?php echo @$setting['title_footer_green'] ?></p>
                            </div>

                            <div class="footer-list">
                                <ul>
                                    <li>Địa chỉ: <strong><?php echo @$setting['address_footer'] ?></strong></li>
                                    <li>Điện thoại: <strong><?php echo @$setting['phone_footer'] ?></strong></li>
                                    <li>Email: <a href="mailto:<?php echo @$setting['email_footer'] ?>"><?php echo @$setting['email_footer'] ?></a></li>
                                    <li>Website: <a href=""><?php echo @$setting['web_footer'] ?></a></li>
                                    <li>Fanpage Facebook: <a href="<?php echo @$setting['title_footer_left'] ?>"><?php echo @$setting['page_footer'] ?></a></li>
                                </ul>
                            </div>

                        </div>
                    </div>

                    <div class="col-lg-3 col-md-12">
                        <div class="footer-item">
                            <div class="footer-menu-title">
                                <h3><?php echo @$setting['title_footer_right'] ?></h3>
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
                        </div>
                    </div>
                </div>

                <div class="section-footer-info">
                    <div class="container">
                        <p><?php echo @$setting['business_certificates'] ?></p>
                        <p>Người đại diện theo pháp luật: <?php echo @$setting['represent'] ?>.</p>
                        <p>Email: <?php echo @$setting['email_footer'] ?>, Điện thoại: <?php echo @$setting['phone_footer'] ?></p>
                    </div>
                </div>
            </div>
        </secrion>

        <section id="section-search">
            <div class="overlay" id="overlay">
                <button type="button" class="close-btn" onclick="closeOverlay()"><i class="fa-solid fa-xmark"></i></button>

                <div class="overlay-content">

                    <form class="search-form">
                        <input type="text" class="search-input" placeholder="Nhập từ khóa">
                        <button type="submit" class="search-btn"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </form>
                </div>
            </div>
        </section>

        <section id="section-footer-bottom">
            <p>Copyright 2024 © Zikii Việt Nam</p>
        </section>

        <!-- Magnific Popup core JS file -->
        <script src="<?php echo $urlThemeActive ?>asset/magnific-popup/jquery.magnific-popup.min.js"></script>

        <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
        <script>
            AOS.init();
        </script>

        <script src="<?php echo $urlThemeActive ?>asset/js/slick.js"></script>
        <script src="<?php echo $urlThemeActive ?>asset/js/emhieu.js"></script>
    </footer>
</body>

</html>

