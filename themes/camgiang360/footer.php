<?php
global $urlThemeActive;

$setting = setting();
?>
<footer>
    <section id="contact">
        <div class="container">
            <div class="contact-content row">
                <div class="col-lg-1 col-md-12">
                    <div class="contact-logo ">
                    <img src="<?php echo $setting['image_logo'] ?>" alt="">
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="contact-detail">
                        <h4><?php echo @$setting['title_footer']; ?></h4>
                        <p>Cơ quan chủ quản: <span><?php echo @$setting['agency']; ?>.</span></p>
                        <p>Chịu trách nhiệm chính: <span><?php echo @$setting['responsibility']; ?></span></p>
                        <ul>
                            <li><i class="fa-solid fa-house"></i><?php echo @$setting['address']; ?></li>
                            <li><i class="fa-solid fa-phone"></i><?php echo @$setting['phone']; ?></li>
                            <li><i class="fa-regular fa-envelope"></i><?php echo @$setting['responsibilityemail']; ?></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="contact-text">
                        <h4>Về chúng tôi</h4>
                         <?php
                                if (!empty(getListLinkWeb(@$setting['idlink']))) {
                                    foreach (getListLinkWeb(@$setting['idlink']) as $key => $ListLink) { ?>
                                        <li>
                                            <a href="<?php echo $ListLink['link'] ?>"><?php echo $ListLink['name'] ?></a>
                                        </li>
                                <?php }
                                } ?>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-12">
                    <div class="contact-icon">
                        <h4>Theo dõi tại:</h4>
                        <div class="combo-icon">
                            <a href="<?php echo @$setting['facebook']; ?>"><i class="fa-brands fa-facebook"></i></a>

                            <a href="<?php echo @$setting['tiktok']; ?>"><i class="fa-brands fa-tiktok"></i></a>
                            <a href="<?php echo @$setting['youtube']; ?>"><i class="fa-brands fa-youtube"></i></a>
                        </div>
                       <div class="static"> <?php 
                            if(function_exists('showStatic')){
                                showStatic();
                            }
                            ?></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="footer">
        <p>Copyright © 2023 Mai Chau District. All rights reserved</p>
    </section>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js" integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="<?= $urlThemeActive ?>maichau/js/main.js"></script>


    <div class="scripts">
        <!-- ✅ load jQuery ✅ -->
        <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <!-- ✅ load Slick ✅ -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js" integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v16.0&appId=148758212437688&autoLogAppEvents=1" nonce="WKsjsJLh"></script>
    </div>
</footer>
</body>

</html>

