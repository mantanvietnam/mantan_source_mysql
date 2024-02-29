<?php 
global $urlThemeActive;
$setting = setting(); 
?>


   <footer>
        <div id="section-footer-main">
            <div class="container">
                <div class="footer-main">
                    <div class="logo-footer">
                        <img src="<?php echo @$setting['logo'];?>" alt="">
                    </div>

                    <div class="list-social">
                        <ul class="d-flex justify-content-center">
                            <li><a href="<?php echo @$setting['facebook'] ?>"><i class="fa-brands fa-facebook-f"></i></a></li>
                            <li><a href="<?php echo @$setting['twitter'] ?>"><i class="fa-brands fa-twitter"></i></a></li>
                            <li><a href="<?php echo @$setting['instagram'] ?>"><i class="fa-brands fa-instagram"></i></a></li>
                            <li><a href="<?php echo @$setting['tiktok'] ?>"><i class="fa-brands fa-tiktok"></i></a></li>
                            <li><a href="<?php echo @$setting['youtube'] ?>"><i class="fa-brands fa-youtube"></i></a></li>
                            <li><a href="<?php echo @$setting['linkedin'] ?>"><i class="fa-brands fa-linkedin"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <section id="section-footer-bottom">
            <div class="container">
                <div class="footer-bottom text-center">
                    <p><?php echo @$setting['textfooter'];?></p>
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

    <script src="<?php echo $urlThemeActive ?>/asset/js/slick.js"></script>
    <script src="<?php echo $urlThemeActive ?>/asset/js/main.js"></script>

    <script>
        $(document).ready(function() {
            $('.library-image').magnificPopup({
                delegate: 'a',
                type: 'image',
                tLoading: 'Loading image #%curr%...',
                mainClass: 'mfp-img-mobile',
                gallery: {
                    enabled: true,
                    navigateByImgClick: true,
                    preload: [0,1] // Will preload 0 - before current, and 1 after the current image
                },
                image: {
                    tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
                    titleSrc: function(item) {
                    }
                }
            });
        });
    </script>
    
</body>
</html>