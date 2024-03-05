<?php 
global $urlThemeActive;
$setting = setting(); 
?>

    <footer>
        <section id="section-footer-main">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 ">
                        <div class="logo-footer">
                            <img src="<?php echo $urlThemeActive ?>/asset/image/thiet-ke-lo-go-spa-01-1024x482.png" alt="">
                        </div>
                    </div>

                    <div class="col-lg-5">
                        <div class="footer-center">
                            <p class="footer-company">CÔNG TY CỔ PHẦN DỊCH VỤ CHĂM SÓC SỨC KHỎE YOGA</p>
                            <p class="footer-address">Địa chỉ Số 144 Đội Cấn, Ba Đình Hà Nội</p>
                            <p class="footer-phone">Hotline: 0969.733.180</p>
                            <p class="footer-email">Email: admin@demo.vn</p>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="footer-right">
                            <div class="footer-right-title">
                                Về Chúng Tôi
                            </div>

                            <div class="footer-right-description">
                                Chúng tôi đã làm việc chăm chỉ trong nhiều năm qua để trở thành một phần quan trọng của cộng đồng, chúng tôi đã được công nhận là một trong những câu lạc bộ YOGA hàng đầu
                            </div>

                            <div class="footer-list-social">
                                <ul>
                                    <li>
                                        <a href=""><i class="fa-brands fa-facebook-f"></i></a>
                                    </li>
                                    <li>
                                        <a href=""><i class="fa-brands fa-twitter"></i></a>
                                    </li>
                                    <li>
                                        <a href=""><i class="fa-brands fa-tiktok"></i></a>
                                    </li>
                                    <li></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="section-footer-bottom">
            <div class="container">
                <div class="footer-bottom text-center">
                    <p>© Bản quyền thuộc về Yoga</p>
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

    <script src="<?php echo $urlThemeActive ?>/asset/js/main.js"></script>
    <script src="<?php echo $urlThemeActive ?>/asset/js/slick.js"></script>
    <!-- // Ẩn phần tử -->
</body>
</html>


