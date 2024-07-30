<?php 
    global $settingThemes;
?>
<footer>
        <div class="container">
            <div class="ftbg-section">
                <div class="footer-section">
                    <div class="row r-relative">
                        <div class="col-lg-6 col-md-12">
                            <div class="col-left">
                                <div class="ft-company">
                                    <div class="ft-logo">
                                        <img src="<?= @$settingThemes['logofooter'];?>" alt="">
                                    </div>
                                    <div class="ft-name">
                                        <p><?= @$settingThemes['titlelogofooter'];?></p>
                                    </div>
                                </div>
                                <div class="ft-info">
                                    <ul>
                                        <li>
                                            <i class="fa-solid fa-location-dot"></i>
                                            <span>
                                            <?= @$settingThemes['address'];?>
                                            </span>
                                        </li>
                                        <li>
                                            <i class="fa-solid fa-envelope"></i>
                                            <span>
                                            <?= @$settingThemes['email'];?>
                                            </span>
                                        </li>
                                        <li>
                                            <i class="fa-solid fa-phone"></i>
                                            <span>
                                            <?= @$settingThemes['phone'];?>
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="ft-contact-form">
                                <h3>Kết nối với chúng tôi</h3>
                                <form action="/contact" method="POST">
                                    <input type="hidden" value="<?php echo $csrfToken; ?>" name="_csrfToken">

                                    <div>
                                        <input type="text" placeholder="Họ và tên" name="name" id="name" required>
                                        <input type="text" placeholder="Số điện thoại" name="phone"  id="phone" required>
                                    </div>
                                    <input type="email" placeholder="Địa chỉ Email" name="email"  id="email" required>
                                    <input type="hidden" placeholder="subject" required name="subject" value=" ">
                                    <input type="hidden"  id="" cols="30" rows="5" placeholder="Nội dung tin nhắn *" name="content" value=" " required></input>
                                    <button type="submit" value="Liên hệ" class="submit-btn">Liên Hệ</button>
                                </form>

                                <ul>
                                    <li><a href="<?php echo !empty(@$settingThemes['facebook']) ? htmlspecialchars(@$settingThemes['facebook']) : ''; ?>"><i class="fa-brands fa-facebook-f"></i></a></li>
                                    <li><a href="<?php echo !empty(@$settingThemes['youtube']) ? htmlspecialchars(@$settingThemes['youtube']) : ''; ?>"><i class="fa-brands fa-youtube"></i></a></li>
                                    <li style="display: none;" ><a href="<?php echo !empty(@$settingThemes['instagram']) ? htmlspecialchars(@$settingThemes['instagram']) : ''; ?>"><i class="fa-brands fa-instagram"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="end-section">
                    <span>© Copyright CECAD 2024</span>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

    <!-- Slick Carousel JS -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>


    <!-- fancybox -->
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
    <!-- AOS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    <!-- Custom Scripts -->
    <script src="<?=$urlThemeActive?>asset/js/main-plus.js"></script>
    <script src="<?=$urlThemeActive?>asset/js/swiper.js"></script>
    <script src="<?=$urlThemeActive?>asset/js/slick.js"></script>
</body>

</html>