<?php
global $urlThemeActive;

$setting = setting();

?>
  <div id="footer">
        <div class="bg-footer">
            <img src="<?= $urlThemeActive ?>/assets/img/bg-footer.png">
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-2 col-md-12 col-sm-12">
                    <div class="logo">
                        <img src="<?php echo @$setting['image_logo']; ?>">
                    </div>
                </div>

                <div class="col-lg-4 col-md-12 col-sm-12 about">
                    <div class="name-footer">
                        <p>Trang thông tin điện tử đống đa 360°</p>
                    </div>
                    <div class="infor-footer">
                        <p>
                            Cơ quan chủ quản: <?php echo $setting['agency']; ?>
                            <br> Chỉ đạo thực hiện: <?php echo $setting['title_footer']; ?>
                            <br> Chịu trách nhiệm thực hiện: <?php echo $setting['responsibility']; ?>
                            <br> Địa chỉ: <?php echo $setting['address']; ?>
                            <br> Điện thoại: <?php echo $setting['phone']; ?>
                            <br> Email: <?php echo $setting['email']; ?>
                        </p>
                    </div>
                    <div class="link-footer">
                        <a href="">Điều khoản sử dụng</a>
                        <a href="">Chính sách bảo mật</a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 download">
                    <div class="title-download">
                        <p>Tải ứng dụng đống đa 360°</p>
                    </div>
                    <div>
                        <a href="">
                            <img src="<?= $urlThemeActive ?>assets/img/chplay.png" alt="">
                        </a>
                        <a href="">
                            <img src="<?= $urlThemeActive ?>assets/img/appstore.png" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="license">
            <div class="row">
                <div class="copyright col-md-12 col-lg-6">
                    Copyright Dong Da 360 © 2020. Developed & Managed by Vingg.vn
                </div>

                <div class="col-lg-6 col-md-12 count-view">
                    Lượt truy cập: 2.985.340.615
                </div>
            </div>
        </div>
        <div id="scrollTop">
            <i class="fa-solid fa-chevron-up"></i>
        </div>
    </div>




    <!-- <script src="./asset/js/script.js"></script> -->




    <div class="scripts">
        <!-- ✅ load jQuery ✅ -->
        <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
         ✅ load Slick ✅ -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js" integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v16.0&appId=148758212437688&autoLogAppEvents=1" nonce="WKsjsJLh"></script>

         <script src="<?= $urlThemeActive ?>assets/js/script.js"></script>
    </div>
</body>

</html>

