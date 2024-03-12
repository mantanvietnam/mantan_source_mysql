<?php global $setting_value;?>

        <footer class="footer">
            <div class="container">
                <div class="footer-head">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                            <div class="header-logo">
                                <a href="#">
                                    <img class="header-logo-img" src="<?php echo @$setting_value['logo'];?>" alt="">
                                </a>
                            </div>
                            <div class="footer-head-description">
                                <p><?php echo @nl2br($setting_value['content_footer']);?></p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-12" style="margin-top: 40px;">
                            <p class="footer-address-title">CHÚNG TÔI LÀ AI ?</p>
                            <div class="footer-head-address">
                                <span class="footer-head-address-k">Địa chỉ</span>
                                <p><?php echo @$contactSite['address'];?></p>
                            </div>
                            <div class="footer-head-address">
                                <span class="footer-head-address-k">Hotline</span>
                                <p><?php echo @$contactSite['phone'];?></p>
                            </div>
                            <div class="footer-head-address">
                                <span class="footer-head-address-k">Email</span>
                                <p><?php echo @$contactSite['email'];?></p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-12 menu-about-us" style="margin-top: 40px;">
                            <p class="footer-address-title">Về chúng tôi</p>
                            <div class="footer-head-address">
                                <a class="footer-head-address-key2">GIỚI THIỆU</a>
                            </div>
                            <div class="footer-head-address">
                                <a class="footer-head-address-key2">CƠ HỘI KINH DOANH</a>
                             
                            </div>
                            <div class="footer-head-address">
                                <a class="footer-head-address-key2">CƠ HỘI VIỆC LÀM</a>
                            </div>
                            <div class="footer-head-address">
                                <a class="footer-head-address-key2">SỰ KIỆN-ĐÀO TẠO</a>
                            </div>
                        </div>
                    </div>


                </div>

                <div class="footer-social">
                    <span>
                        <a href="<?php echo @$setting_value['facebook'];?>" class="footer-socical-link">
                            <i class="fa-brands fa-facebook"></i>
                        </a>
                    </span>
                    <span>
                        <a href="<?php echo @$setting_value['youtube'];?>" class="footer-socical-link">
                            <i class="fa-brands fa-youtube"></i>
                        </a>
                    </span>
                    <span>
                        <a href="https://zalo.me/<?php echo @$contactSite['phone'];?>" class="footer-socical-link">
                            <img src="<?php echo $urlThemeActive;?>/assert/img/download.jpg" alt="">
                        </a>
                    </span>
                </div>
                
                <div class="footer-end">
                    CRM <?php echo @$setting_value['name_web'];?> 2024 - Thiết kế bởi Phoenix Tech
                    <p></p>
                </div>
        </footer>
    </div>
</body>

</html>