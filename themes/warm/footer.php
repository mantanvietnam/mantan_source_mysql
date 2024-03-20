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

                            <div class="web-footer">
                                <p><i class="fa-solid fa-earth-americas"></i>  <a href="https://www.afd.fr/fr">https://www.afd.fr</a></p>
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

                            <div class="web-footer">
                                <p><i class="fa-solid fa-earth-americas"></i> <a href="https://www.eeas.europa.eu/delegations/vietnam_en">https://www.eeas.europa.eu/delegations/vietnam_en</a></p>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-3 col-12 footer-box-right">
                            <div class="footer-logo">
                                <div class="logo-home-img logo-home-1">
                                    <img src="<?php echo $urlThemeActive; ?>/asset/img/logofooter1.png" alt="">
                                </div>

                                <div class="logo-home-img logo-home-2">
                                    <img src="<?php echo $urlThemeActive; ?>/asset/img/logo-afd.png" alt="">
                                </div>
                            </div>
                            <div class="follow-box">
                                <div class="follow-us">
                                    <span>Follow us:</span>
                                </div>

                                <div class="footer-list-social">
                                    <div class="footer-social-item">
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

                                    <div class="img-social-footer">  
                                        <a target=”_blank” href="https://www.facebook.com/EUandVietnam?gidzl=QuXw4B5-BZriatuUic0cE6wKS1MlPoWu9C5uIgXdA3jobtqThcmiCNZCVHVpFtfXACWfH33lms4KjdegC0">
                                            <img src="<?php echo $urlThemeActive;?>/asset/img/france3.png" alt="">
                                        </a>
                                  
                                        <a target=”_blank” href="https://www.facebook.com/AFDOfficiel">
                                            <img src="<?php echo $urlThemeActive;?>/asset/img/afd3.png" alt="">
                                        </a>

                                        <a target=”_blank” href="https://www.facebook.com/AmbassadeFranceVietnam">
                                            <img src="<?php echo $urlThemeActive;?>/asset/img/eu3.png" alt="">
                                        </a>

                                     
                                    </div>
                                </div>
                            </div>
                  
                        </div>

                        <div class="col-lg-9 footer-bottom">
                            <p>Disclaimer: This website was developed with the financial support of the European Union. Its contents are the sole responsibility of the WARM Facility and do not necessarily reflect the views of the European Union.</p>
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
        <script src="<?php echo $urlThemeActive;?>/asset/js/swiper.js"></script>

    </footer>
</body>


</html>