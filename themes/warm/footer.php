    <?php global $settingThemes;?>

    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
   

    <footer>
        <saection id="section-footer">
            <div class="container">
                <div class="footer-box">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-12 footer-box-left">
                            <div class="title-footer">
                                <p><?php echo @$settingThemes['title_1_section_footer'];?></p>
                            </div>

                            <div class="address-footer">
                                <p><?php echo @$settingThemes['address_section_footer'];?></p>
                            </div>

                            <div class="tel-footer">
                                <p><strong>Tel :</strong><?php echo @$settingThemes['tel_section_footer'];?></p>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-12 footer-box-center">
                            <div class="title-footer">
                                <p><?php echo @$settingThemes['title_2_section_footer'];?></p>
                            </div>

                            <div class="address-footer">
                                <p><?php echo @$settingThemes['address_2_section_footer'];?>
                                    <br>
                                    <?php echo @$settingThemes['address_2_2_section_footer'];?>
                                </p>
                                
                            </div>

                            <div class="tel-footer">
                                <p><strong>Tel :</strong><?php echo @$settingThemes['tel_2_section_footer'];?> </p>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-3 col-12 footer-box-right">
                            <p class="follow-us">
                                <span>Follow us:
                                <?php 
                                    if(!empty($settingThemes['youtube'])){
                                        echo '  <a href="'.$settingThemes['youtube'].'">
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
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </saection>

        <script>
            AOS.init();
        </script>
        <!-- <script src="<?php echo $urlThemeActive;?>/asset/js/odometer.js"></script> -->
        <script src="<?php echo $urlThemeActive;?>/asset/js/slick.js"></script>
        <script src="<?php echo $urlThemeActive;?>/asset/js/main.js"></script>
        
    </footer>
</body>


</html>