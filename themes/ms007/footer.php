<?php 
global $urlThemeActive;
$setting = setting(); 
?>
  <footer>
        <section id="section-footer" style="background-image:url(<?php echo @$setting['banner4']; ?>) ;">
            <div class="footer-overlay"></div>
            <div class="footer-box">
                <div class="container">
                    <div class="row text-center justify-content-center">
                        <div class="col-lg-9">
                            <div class="footer-icon">
                                <img src="<?php echo @$setting['logo']; ?>" alt="">
                            </div>
            
                            <div class="footer-content">
                                <p><?php echo @$setting['textfooter']; ?></p>
                            </div>

                            <hr>

                            <div class="social-list">
                                <div class="social-item">
                                    <a href="<?php echo @$setting['facebook']; ?>">
                                        <!-- <img src="<?php echo $urlThemeActive ?>asset/img/face.jpg" alt=""> -->
                                        <i class="fa-brands fa-facebook"></i>                                    </a>
                                </div>

                                <div class="social-item">
                                    <a href="<?php echo @$setting['messenger']; ?>">
                                        <!-- <img src="<?php echo $urlThemeActive ?>asset/img/messenger.jpg" alt=""> -->
                                        <i class="fa-brands fa-facebook-messenger"></i>
                                    </a>
                                </div>

                                <div class="social-item">
                                    <a href="<?php echo @$setting['tiktok']; ?>">
                                        <!-- <img src="<?php echo $urlThemeActive ?>asset/img/tiktok.jpg" alt=""> -->
                                        <i class="fa-brands fa-tiktok"></i>
                                    </a>
                                </div>

                                <div class="social-item">
                                    <a href="<?php echo @$setting['youtube']; ?>">
                                        <!-- <img src="<?php echo $urlThemeActive ?>asset/img/youtube.jpg" alt=""> -->
                                        <i class="fa-brands fa-youtube"></i>
                                    </a>
                                </div>

                                <div class="social-item">
                                    <a href="<?php echo @$setting['zalo']; ?>">
                                        <!-- <img src="<?php echo $urlThemeActive ?>asset/img/zalo.jpg" alt=""> -->
                                        <i class="fa-brands fa-square-instagram"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>  
               
        </section>
    </footer>

</body>
    <!-- Magnific Popup core JS file -->
    <script src="asset/magnific-popup/jquery.magnific-popup.min.js"></script>

    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>

    <script src="<?php echo $urlThemeActive ?>asset/js/slick.js"></script>
    <script src="<?php echo $urlThemeActive ?>asset/js/main.js"></script>


</html>