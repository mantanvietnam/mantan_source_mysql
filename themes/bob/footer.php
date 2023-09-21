<?php 
    global $settingThemes;
    global $modelMenus;

    // Menu 
    if(!empty($settingThemes['id1_menu_footer'])){
        $menu_footer = $modelMenus->find()->where(['id_menu'=>(int) $settingThemes['id1_menu_footer']])->all()->toList();
    }

    if(!empty($settingThemes['id1_menu_footer'])){
        $menu_footer2 = $modelMenus->find()->where(['id_menu'=>(int) $settingThemes['id2_menu_footer']])->all()->toList();
    }
?>

<footer>
        <section id="section-footer">
            <div class="container">
                <div class="footer-box">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-12 ">
                            <div class="logo-footer">
                                <a href=""><img src="<?php echo $urlThemeActive; ?>/asset/img/logo.png" alt=""></a>
                            </div>
                        </div>

                        <div class="col-lg-9 col-md-9 col-12 menu-footer">
                            <div class="menu-footer-item">
                                <div class="menu-footer-title">
                                    <p>Sản phẩm</p>
                                </div>

                                <div class="menu-footer-box">
                                    <ul>
                                        <?php 
                                            if(!empty($menu_footer)){
                                                foreach($menu_footer as $key => $value){
                                                    echo'
                                                    <li><a href="'.$value->link.'">'.$value->name.'</a></li>';
                                                }
                                            }
                                        ?>
                                    </ul>
                                </div>
                            </div>

                            <div class="menu-footer-item">
                                <div class="menu-footer-title">
                                    <p>Doanh nghiệp</p>
                                </div>

                                <div class="menu-footer-box">
                                    <ul>
                                        <?php 
                                            if(!empty($menu_footer2)){
                                                foreach($menu_footer2 as $key => $value){
                                                    echo'
                                                    <li><a href="'.$value->link.'">'.$value->name.'</a></li>';
                                                }
                                            }
                                        ?>
                                    </ul>
                                </div>
                            </div>

                            <div class="menu-footer-item">
                                <div class="menu-footer-title">
                                    <p>Liên hệ</p>
                                </div>

                                <div class="menu-footer-box">
                                    <ul>
                                        <li><a href="<?php echo $settingThemes['link_hotline_footer']; ?>">Hotline: <?php echo $settingThemes['hotline_footer']; ?></a></li>
                                        <li><a href="<?php echo $settingThemes['link_address_footer']; ?>">Địa chỉ: <?php echo $settingThemes['address_footer']; ?></a></li>
                                        <li><a href="<?php echo $settingThemes['link_email_footer']; ?>">Email: <?php echo $settingThemes['email_footer']; ?></a></li>
                                        <li class="menu-footer-social">
                                            <?php
                                                if(!empty($settingThemes['facebook'])){
                                                    echo'
                                                        <a href="'.$settingThemes['facebook'].'"><i class="fa-brands fa-facebook"></i></a>
                                                    ';
                                                };

                                                if(!empty($settingThemes['youtube'])){
                                                    echo'
                                                        <a href="'.$settingThemes['youtube'].'"><i class="fa-brands fa-youtube"></i></a>
                                                    ';
                                                };

                                                if(!empty($settingThemes['instagram'])){
                                                    echo'
                                                        <a href="'.$settingThemes['instagram'].'"><i class="fa-brands fa-instagram"></i></a>
                                                    ';
                                                };

                                                if(!empty($settingThemes['tiktok'])){
                                                    echo'
                                                        <a href="'.$settingThemes['tiktok'].'"><i class="fa-brands fa-tiktok"></i></a>
                                                    ';
                                                };

                                                if(!empty($settingThemes['pinterest'])){
                                                    echo'
                                                        <a href="'.$settingThemes['pinterest'].'"><i class="fa-brands fa-pinterest"></i></a>
                                                    ';
                                                };

                                                if(!empty($settingThemes['twitter'])){
                                                    echo'
                                                        <a href="'.$settingThemes['twitter'].'"><i class="fa-brands fa-twitter"></i></a>
                                                    ';
                                                };
                                            
                                            ?>
                                        
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="footer-bottom">
            <div class="container">
                <p>© Copyright 2023 Yên Lâm. All Rights Reserved.</p>
            </div>
        </section>
        

        <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-element-bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
        <script src="<?php echo $urlThemeActive; ?>/asset/js/slick.js"></script>
        <script src="<?php echo $urlThemeActive; ?>/asset/js/main.js"></script>
    </footer>
</body>
</html>