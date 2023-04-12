<?php
global $urlThemeActive;

$setting = setting();


?>
<footer>
    <div class="main-footer px-0 py-5">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-4 col-lg-2">
                    <div class="logo-footer mb-4">
                        <img class="w-100" src="<?php echo @$setting['image_logo']; ?>" alt="">
                    </div>
                </div>
                <div class="col-12 col-md-8 col-lg-7">
                    <div class="list-info">
                        <h5><?php echo @$setting['title_footer']; ?></h5>
                        <div class="list-info">
                            <ul class="p-0 list-unstyled">
                                <li>Cơ quan chủ quản: <?php echo @$setting['agency']; ?></li>
                                <li>Địa chỉ: <?php echo @$setting['address']; ?></li>
                                <li>Điện thoại: <?php echo @$setting['phone']; ?></li>
                                <li>Email: <?php echo @$setting['email']; ?></li>
                                <li class="mt-3">Chịu trách nhiệm chính: <?php echo @$setting['responsibility']; ?></li>
                                <li>Điện thoại: <?php echo @$setting['responsibilityphone']; ?></li>
                                <li>Hòm thư công vụ: <?php echo @$setting['responsibilityemail']; ?>n</li>
                                <li class="mt-3">Theo dõi chúng tôi qua:<?php echo @$setting['follow']; ?></li>
                                <ul class="list-unstyled d-flex p-0 pt-2">
                                    <li class="me-2"><a href=""><img
                                                src="<?= $urlThemeActive ?>assets/lou_icon/facebook-foot.svg"
                                                alt=""></a></li>
                                    <li class="me-2"><a href=""><img
                                                src="<?= $urlThemeActive ?>assets/lou_icon/tiktok-foot.svg" alt=""></a>
                                    </li>
                                    <li class="me-2"><a href=""><img
                                                src="<?= $urlThemeActive ?>assets/lou_icon/zalo-foot.svg" alt=""></a>
                                    </li>
                                    <li class="me-2"><a href=""><img
                                                src="<?= $urlThemeActive ?>assets/lou_icon/youtube-foot.svg" alt=""></a>
                                    </li>
                                </ul>
                            </ul>
                        </div>

                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-3">
                    <div class="list-info thong-tin-chung">
                        <h5>Thông tin chung</h5>
                        <div class="list-info">
                            <ul class="p-0 list-unstyled">
                                <?php
                                if (!empty(getListLinkWeb(@$setting['idlink']))) {
                                    foreach (getListLinkWeb(@$setting['idlink']) as $key => $ListLink) { ?>
                                        <li>
                                            <a href="<?php echo $ListLink['link'] ?>"><?php echo $ListLink['name'] ?></a>
                                        </li>
                                    <?php }
                                } ?>
                            </ul>
                        </div>

                        <div class="mobile mt-4">
                            <p class="fs-6">Tải phiên bản dành cho di động</p>
                            <div class="d-flex mt-2">
                                <a href=""><img src="<?= $urlThemeActive ?>assets/lou_img/android.png" alt=""></a>
                                <a href=""><img src="<?= $urlThemeActive ?>assets/lou_img/IOS.png" alt=""></a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>s
    </div>
    <div class="bottom-footer">
        <div class="container">
            <div class="d-flex justify-content-between flex-column flex-md-row">
                <span>Copyright Tay Ho 360 © 2020. Developed & Managed by VinGG</span>
                <span>Lượt truy cập: 1.000.000</span>
            </div>
        </div>
    </div>


    <div class="scripts">
        <!-- ✅ load jQuery ✅ -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <!-- ✅ load Slick ✅ -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"
            integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="<?= $urlThemeActive ?>js/slick.js"></script>
        <script src="<?= $urlThemeActive ?>js/jquery.js"></script>
        <script src="<?= $urlThemeActive ?>js/bootstrap.bundle.js"></script>
        <script src="<?= $urlThemeActive ?>js/jshieu.js"></script>
        <script src="<?= $urlThemeActive ?>js/main.js"></script>
        <div id="fb-root"></div>
<script>(function(d, s, id) {
var js, fjs = d.getElementsByTagName(s)[0];
if (d.getElementById(id)) return;
js = d.createElement(s); js.id = id;
js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
    </div>
</footer>
</body>
</html>
