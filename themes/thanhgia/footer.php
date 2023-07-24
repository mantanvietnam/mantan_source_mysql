<?php global $settingThemes;?>
<!-- footer -->
    <footer>
        <section id="main-footer">
            <div class="container">
                <div class="row">
                    <div class="col-xl-5 col-lg-6 col-md-12 col-12 footer-item">
                        <div class="footer-title">
                            <h2><?php echo @$settingThemes['title1_footer'];?></h2>
                        </div>
                        <div class="footer-content-info">
                            <p><?php echo @$settingThemes['content1_footer'];?></p>
                            <div class="footer-social">
                                <ul>
                                    <li>
                                        <a href="<?php echo @$settingThemes['facebook'];?>"><i class="fa-brands fa-facebook-f"></i></a>
                                    </li>
                                    <li>
                                        <a href="<?php echo @$settingThemes['twitter'];?>"><i class="fa-brands fa-twitter"></i></a>
                                    </li>
                                    <li>
                                        <a href="<?php echo @$settingThemes['instagram'];?>"><i class="fa-brands fa-instagram"></i></a>
                                    </li>
                                    <li>
                                        <a href="<?php echo @$settingThemes['tiktok'];?>"><i class="fa-brands fa-tiktok"></i></a>
                                    </li>
                                    <li>
                                        <a href="<?php echo @$settingThemes['youtube'];?>"><i class="fa-brands fa-youtube"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-md-12 col-12 footer-item">
                        <div class="footer-title">
                            <h2>Thông tin liên hệ</h2>
                        </div>

                        <div class="footer-address">
                            <ul>
                                <li>
                                    <p><span>Địa chỉ: </span> <?php echo @$contactSite['address'];?></p>
                                </li>
                                <li>
                                    <p><span>Điện thoại: </span> <?php echo $contactSite['phone'];?></p>
                                </li>
                                <li>
                                    <p><span>Email: </span><?php echo $contactSite['email'];?></p>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-6 col-md-12 col-12 footer-item">
                        <div class="footer-title">
                            <h2><?php echo @$settingThemes['title2_footer'];?></h2>
                        </div>

                        <div class="footer-group-link">
                            <ul>
                                <?php 
                                if(!empty($settingThemes['menu2_footer'])){
                                    foreach ($settingThemes['menu2_footer'] as $key => $value) {
                                        echo '  <li>
                                                    <a href="'.$value->link.'">'.$value->name.'</a>
                                                </li>';
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
       

        <section id="footer-copyright">
            <div class="container">
                <p>Copyright © 2023 <?php echo @$settingThemes['name_web'];?></p>
            </div>
        </section>
    </footer>

    <!-- slick -->
    <script src="<?php echo $urlThemeActive;?>/asset/js/main.js"></script>
    <script src="<?php echo $urlThemeActive;?>/asset/js/slick.js"></script>
</body>
</html>