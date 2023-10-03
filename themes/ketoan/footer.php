<?php global $settingThemes; ?>

<footer>
    <div class="container">
        <div class="row setting-footer">
            <div class="col-4">
                <a href="">
                    <img class="logo-footer" src="<?php echo $infoSite['logo'];?>">
                </a>

                <div class="icon-footer">
                    <?php 
                        if(!empty($settingThemes['youtube'])){
                            echo '  <a target=”_blank” href="'.$settingThemes['youtube'].'">
                                        <i class="fa-brands fa-youtube"></i>
                                    </a>';
                        }

                        if(!empty($settingThemes['facebook'])){
                            echo '  <a href="'.$settingThemes['facebook'].'">
                                        <i class="fa-brands fa-facebook-f"></i>
                                    </a>';
                        }

                        if(!empty($settingThemes['instagram'])){
                            echo '  <a href="'.$settingThemes['instagram'].'">
                                        <i class="fa-brands fa-instagram"></i>
                                    </a>';
                        }

                        if(!empty($settingThemes['tiktok'])){
                            echo '  <a href="'.$settingThemes['tiktok'].'">
                                        <i class="fa-brands fa-tiktok"></i>
                                    </a>';
                        }

                        if(!empty($settingThemes['twitter'])){
                            echo '  <a href="'.$settingThemes['twitter'].'">
                                        <i class="fa-brands fa-twitter"></i>
                                    </a>';
                        }

                        if(!empty($settingThemes['linkedIn'])){
                            echo '  <a href="'.$settingThemes['linkedIn'].'">
                                <i class="fa-brands fa-linkedin-in"></i>
                            </a>';
                        }
                    ?>
                </div>
            </div>
            <div class="col-4 intro-cong-ty">
                <h4><?php echo @$settingThemes['title1_footer']; ?></h4>
                <p><span>Địa chỉ: </span><?php echo $contactSite['address']?></p>
                <p><span>Tel: </span><?php echo $contactSite['phone']?></p>
                <p><span>Email: </span><?php echo $contactSite['email']?></p>
            </div>
            <div class="col-4 dich-vu-footer">
                <h4><?php echo @$settingThemes['title2_footer']; ?></h4>
                <?php 
                    if(!empty($settingThemes['menu_footer'])){
                        foreach ($settingThemes['menu_footer'] as $key => $value) {
                            echo 
                            '<p><a href="'.$value->link.'">'.$value->name.'</a></p>';
                             
                        }
                    }
                ?>
            </div>
        </div>
        <p style="text-align: center; color:#858488 ; font-family: SanText; "><?php echo @$settingThemes['copyright_footer']; ?></p>
        <script src="<?php echo $urlThemeActive;?>/asset/js/slick.js"></script>
    </div>
</footer>
</body>
</html>