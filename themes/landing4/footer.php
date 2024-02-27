<?php 
global $urlThemeActive;
$setting = setting(); 
?>


   <footer>
        <div id="section-footer-main">
            <div class="container">
                <div class="footer-main">
                    <div class="logo-footer">
                        <img src="./asset/img/logo-phoenix.png" alt="">
                    </div>

                    <div class="list-social">
                        <ul class="d-flex justify-content-center">
                            <li>
                                <a href=""><i class="fa-brands fa-facebook-f"></i></a>
                            </li>
                            <li>
                                <a href=""><i class="fa-brands fa-square-instagram"></i></a>
                            </li>
                            <li>
                                <a href=""><i class="fa-brands fa-tiktok"></i></a>
                            </li>
                            <li>
                                <a href=""><i class="fa-brands fa-youtube"></i></a>
                            </li>
    
                            <li>
                                <a href=""><i class="fa-brands fa-linkedin-in"></i></a>
                            </li>
    
                            <li>
                                <a href=""><i class="fa-brands fa-twitter"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <section id="section-footer-bottom">
            <div class="container">
                <div class="footer-bottom text-center">
                    <p>CopyRight © 2021 Trần Toản | All Rights Reserved</p>
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