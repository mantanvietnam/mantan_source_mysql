<?php 
    getHeader();
    global $settingThemes; 
?>
    <main>
        <section id="banner">
            <div class="container">

                <div class="list-banner row">
                    <div class="banner-sub col-lg-6 col-md-6 col">
                        <?php 
                        if(!empty($slide_home)){
                            foreach ($slide_home as $key => $value) {
                                echo '  <div class="item-banner-sub">
                                            <!-- <h4>'.@$settingThemes['name_brand'].'</h4> -->
                                            <h5>'.$value->title.'</h5>
                                            <p>'.$value->description.'</p>
                                            <button class="advise-button">Tư vấn ngay <i class="fa-solid fa-arrow-right-long"></i></button>
                                        </div>';
                            }
                        }
                        ?>
                    </div>

                    <div class="banner-img col-lg-6 col-md-6 col">
                        <?php 
                        if(!empty($slide_home)){
                            foreach ($slide_home as $key => $value) {
                                echo '  <div class="item-banner-img">
                                            <img src="'.$value->image.'" alt="">
                                        </div>';
                            }
                        }
                        ?>
                    </div>
                </div>

            </div>
            </div>
        </section>

        <section id="section-introduction">
            <div class="container">
                <div class="introduction-bg" data-aos="zoom-in-left">
                    <img src="<?php echo $urlThemeActive;?>/asset/image/Asset1.png" alt="">
                </div>
                <div class="section-title" data-aos="zoom-in-up">
                    <h3><span><?php echo @$settingThemes['name_brand'];?></span> </h3>
                </div>
                <div class="introduction-content" data-aos="zoom-in-up">
                    <h3 data-aos="zoom-in-up"><?php echo @$settingThemes['title_about'];?></h3>
                    <p data-aos="zoom-in-up"><?php echo @$settingThemes['content_about'];?></p>
                </div>
                <div class="introduction-btn">
                    <a href="javascript:void(0);" class="advise-button" data-aos="zoom-out">ĐĂNG KÝ TƯ VẤN</a>
                </div>

            </div>
        </section>

        <section id="advise">

            <!-- Popup Container -->
            <div class="popup-overlay" id="popupOverlay">
                <div class="popup">
                    <button class="close-button" id="closeButton"><i class="fa-solid fa-xmark"></i></button>
                    <div class="advise-content">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col top-contact">
                                <div class="absolute-arrow">
                                    <img src="<?php echo $urlThemeActive;?>/asset/image/arrow.png" alt="">
                                </div>
                                <div class="top-info">
                                    <h3>Kết nối ngay với <?php echo @$settingThemes['name_brand'];?></h3>
                                    <p>Chúng tôi luôn sẵn sàng lắng nghe và đưa ra giải pháp phù hợp nhất cho vấn đề của bạn.</p>
                                </div>
                                <div class="top-img">
                                    <img src="<?php echo $urlThemeActive;?>/asset/image/banner2.png" alt="">
                                </div>
                                <div class="top-contact-btn">
                                    <a href="#">
                                        <div><i class="fa-solid fa-phone fa-beat"></i></div>
                                        <p><span>Hotline</span><?php echo $contactSite['phone'];?></p>
                                    </a>
                                    <a href="#">
                                        <div><i class="fa-solid fa-envelope-open-text fa-beat"></i></div>
                                        <p><span>Email</span><?php echo $contactSite['email'];?></p>
                                    </a>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col top-form">
                                <form method="POST" action="/contact">
                                    <input type="hidden" name="_csrfToken" value="<?php echo $csrfToken;?>">
                                    <label for="">
                                        <input type="text" placeholder="Họ và tên *" required name="name" value="">
                                    </label>
                                    <label for="">
                                        <input type="text" placeholder="Địa chỉ email *" required name="email" value="">
                                    </label>
                                    <label for="">
                                        <input type="text" placeholder="Số điện thoại *" required name="phone_number" value="">
                                    </label>
                                    <label for="">
                                        <input type="text" placeholder="Tiêu đề *" required name="subject" value="">
                                    </label>
                                    <label for="">
                                        <textarea name="content" cols="30" rows="10" placeholder="Nội dung yêu cầu ..."></textarea>
                                    </label>

                                    <button type="submit">Gửi yêu cầu <i class="fa-solid fa-play"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <section id="services">
            <div class="container">
                <div class="section-title" data-aos="zoom-in-up">
                    <p>Phân hệ chức năng</p>
                    <h3 class="animate__animated animate__bounce">Những <span>chức năng</span> mà <?php echo @$settingThemes['name_brand'];?> cung cấp</h3>
                </div>
                <div class="list-services row">
                    <?php 
                    foreach ($blog_service as $key => $value) {
                        $link = '/'.$value->slug.'.html';

                        echo '  <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="item-services" data-aos="zoom-in-up">
                                        <div class="services-img">
                                            <a href="'.$link.'"><img src="'.$value->image.'" alt=""></a>
                                        </div>
                                        <div class="services-name">
                                            <a href="">'.$value->title.'</a>
                                            <p>'.$value->description.'</p>
                                        </div>
                                        <div class="services-btn">
                                            <a href="'.$link.'">Xem chi tiết</a>
                                        </div>
                                    </div>
                                </div>';
                    }
                    ?>
                </div>
            </div>
        </section>

        <section id="section-personnel">
            <div class="container no-padding">
                <div class="background-image-overlay"></div>
                <div class="section-title aos-init aos-animate" data-aos="zoom-in-up">
                    <p>Nhân sự</p>
                    <h3><span>Nhân sự</span> của <span><?php echo @$settingThemes['name_brand'];?></span> bao gồm những ai ?</h3>
                </div>
                <div class="personnel-content" data-aos="zoom-in-up" id="scrollableDiv">
                    <div class="person-grid">
                        <?php 
                        if(!empty($staff)){
                            foreach ($staff as $key => $value) {
                                echo '  <div class="person">
                                            <div class="person__background person-animation-1">
                                                <img src="'.$value->image.'" alt="">
                                            </div>
                                            <div class="person__content">
                                                <p class="person__category">'.$value->name_location.'</p>
                                                <h3 class="person__heading">'.$value->name.'</h3>
                                            </div>
                                        </div>';
                            }
                        }
                        ?>
                    </div>
                </div>
        </section>

        <section id="section-worth">
            <div class="container">
                <div class="row">
                    <div class="worth-content col-lg-4 col-md-12 col-sm-12">
                        <h4 data-aos="flip-up" class="aos-init aos-animate"><?php echo @$settingThemes['title_product_best'];?></h4>
                        <p data-aos="fade-down-right" class="aos-init aos-animate"><?php echo nl2br(@$settingThemes['des_product_best']);?></p>
                    </div>
                    <div class="worth-detail col-lg-8 col-md-12 col-sm-12">
                        <div class="row">
                            <?php
                            for ($i=1; $i <= 6 ; $i++) { 
                                echo '  <div class="item-worth col-lg-4 col-md-6 col-sm-12">
                                            <div class="worth-card card-1 aos-init aos-animate" data-aos="fade-right">
                                                <div class="imageBox">
                                                    <img src="'.@$settingThemes['image'.$i.'_product_best'].'">
                                                </div>
                                                <div class="contentBox">
                                                    <h2>'.@$settingThemes['title'.$i.'_product_best'].'</h2>
                                                    <div class="description">
                                                        <p>'.@$settingThemes['content'.$i.'_product_best'].'</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>

        </section>

        <section id="partner">
            <div class="container">
                <div class="section-title" data-aos="zoom-in-up">
                    <p>Đối tác</p>
                    <h3>Khách hàng đã <span>tin tưởng và hợp tác</span> cùng <?php echo @$settingThemes['name_brand'];?></h3>
                </div>
                <div class="list-partner" data-aos="zoom-in-up">
                    <?php 
                    if(!empty($slide_partner)){
                        foreach ($slide_partner as $key => $value) {
                            echo '  <div class="partner-logo">
                                        <div class="partner-dot dot1">
                                            <i class="fa-solid fa-circle"></i>
                                        </div>
                                        <img src="'.$value->image.'" alt="">
                                    </div>';
                        }
                    }
                    ?>
                </div>
            </div>
        </section>

        <section id="section-feedback">
            <div class="container">
                <div class="feedback-content">
                    <div class="row">
                        <div class="col-lg-5 col-12 no-padding-right">
                            <div class="section-title" data-aos="zoom-in-up">
                                <h3>Khách hàng <br> <span>nói gì</span> về <?php echo @$settingThemes['name_brand'];?></h3>
                            </div>

                            <div class="fb-slide-1">
                                <?php
                                if(!empty($listFeed)){
                                    foreach ($listFeed as $key => $value) {
                                        echo '  <div class="item-slide-1">
                                                    <div class="customer-info">
                                                        <div class="customer-img">
                                                            <img src="'.$value->avatar.'" alt="">
                                                        </div>
                                                        <div class="customer-company">
                                                            <p>'.$value->full_name.' - '.$value->position.'</p>
                                                        </div>
                                                    </div>
                                                    <div class="fedback-text">
                                                        <p>'.$value->content.'</p>
                                                    </div>
                                                </div>';
                                    }
                                }
                                ?>
                            </div>
                        </div>
                        <div class="col-lg-7 col-12 no-padding">
                            <div class="fb-slide-2">
                                <?php
                                if(!empty($listFeed)){
                                    foreach ($listFeed as $key => $value) {
                                        echo '  <div class="item-slide-2">
                                                    <img src="'.$value->avatar.'" alt="">
                                                </div>';
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
<?php getFooter(); ?>