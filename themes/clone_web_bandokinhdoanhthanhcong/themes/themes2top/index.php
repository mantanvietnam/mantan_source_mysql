<?php 
    getheader();

?>
    <main>
      
        <section id="banner">
            <div class="container">

                <div class="list-banner row">
                    <div class="banner-sub col-lg-6 col-md-6 col">
                        <div class="item-banner-sub">
                            <h4>TOP TOP</h4>
                            <h5>Đưa ra giải pháp số toàn diện cho bạn</h5>
                            <p>Thấu hiểu bối cảnh doanh nghiệp, đưa ra giải pháp tối ưu, TOP TOP sẵn sàng đồng hành cùng thương hiệu cất cánh.</p>
                            <button class="advise-button">Tư vấn ngay <i class="fa-solid fa-arrow-right-long"></i></button>
                        </div>
                        <div class="item-banner-sub">
                            <h4>TOP TOP</h4>
                            <h5>Đưa ra giải pháp số toàn diện cho bạn</h5>
                            <p>Thấu hiểu bối cảnh doanh nghiệp, cất cánh.</p>
                            <button class="advise-button">Tư vấn ngay <i class="fa-solid fa-arrow-right-long"></i></button>
                        </div>
                        <div class="item-banner-sub">
                            <h4>TOP TOP</h4>
                            <h5>Đưa ra giải pháp số toàn diện cho bạn</h5>
                            <p>Thấu hiểu bối cảnh doanh nghiệp, đưa ra giải pháp tối ưu, TOP TOP sẵn sàng đồng hành cùng thương hiệu cất cánh.</p>
                            <button class="advise-button">Tư vấn ngay <i class="fa-solid fa-arrow-right-long"></i></button>
                        </div>
                    </div>
                 
                    <div class="banner-img col-lg-6 col-md-6 col">
                        <?php foreach ($slide_home as $key => $value) { ?>
                        <div class="item-banner-img">
                            <img src="<?php echo $value->image; ?>" alt="">
                        </div>
                        <?php } ?>
                    </div>
                 
                </div>

            </div>  
            </div>
        </section>

        <section id="section-introduction">
            <div class="container">
                <div class="introduction-bg" data-aos="zoom-in-left">
                    <img src="<?=$urlThemeActive?>asset/image/Asset1.png" alt="">
                </div>
                <div class="section-title" data-aos="zoom-in-up">
                    <h3><?php echo $setting['titleselft']; ?></h3>
                </div>
                <div class="introduction-content" data-aos="zoom-in-up">
                    <h3 data-aos="zoom-in-up"><?php echo $setting['title1']; ?></h3>
                    <p data-aos="zoom-in-up"><?php echo $setting['title2']; ?></p>
                </div>
                <div class="introduction-btn">
                    <a href="" data-aos="zoom-out"><?php echo $setting['button1']; ?></a>
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
                                    <img src="<?=$urlThemeActive?>asset/image/arrow.png" alt="">
                                </div>
                                <div class="top-info">
                                    <h3>Kết nối ngay với TOP TOP</h3>
                                    <p>Chúng tôi luôn sẵn sàng lắng nghe và đưa ra giải pháp phù hợp nhất cho vấn đề của bạn.</p>
                                </div>
                                <div class="top-img">
                                    <img src="<?=$urlThemeActive?>asset/image/banner2.png" alt="">
                                </div>
                                <div class="top-contact-btn">
                                    <a href="#">
                                        <div><i class="fa-solid fa-phone fa-beat"></i></div>
                                        <p><span>Hotline</span>0968-951-277</p>
                                    </a>
                                    <a href="#">
                                        <div><i class="fa-solid fa-envelope-open-text fa-beat"></i></div>
                                        <p><span>Email</span>info@toptop.com.vn</p>
                                    </a>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col top-form">
                                <form>
                                    <label for="">
                                        <input type="text" placeholder="Họ và tên *" required>
                                    </label>
                                    <label for="">
                                        <input type="text" placeholder="Địa chỉ e-mail *" required>
                                    </label>
                                    <label for="">
                                        <input type="text" placeholder="Số điện thoại *" required>
                                    </label>
                                    <label for="">
                                        <input type="text" placeholder="Địa chỉ *" required>
                                    </label>
                                    <label for="">
                                        <input type="text" placeholder="Yêu cầu dịch vụ *" required>
                                    </label>
                                    <label for="">
                                        <textarea cols="30" rows="10" placeholder="Nội dung yêu cầu ..."></textarea>
                                    </label>

                                    <button>Gửi yêu cầu <i class="fa-solid fa-play"></i></button>
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
                    <p><?php echo $setting['dichvu']; ?></p>
                    <h3 class="animate__animated animate__bounce"><?php echo $setting['moredichvu']; ?></h3>
                </div>
                <div class="list-services row">
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="item-services" data-aos="zoom-in-up">
                            <div class="services-img">
                                <a href=""><img src="<?php echo @$setting['logodichvu'];?>" alt=""></a>
                            </div>
                            <div class="services-name">
                                <a href=""><?php echo $setting['titledichvu']; ?></a>
                                <p><?php echo $setting['paragrapdichvu']; ?></p>
                            </div>
                            <div class="services-btn">
                                <a href="#"><?php echo $setting['buttonxem']; ?></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="item-services" data-aos="zoom-in-up">
                             <div class="services-img">
                                <a href=""><img src="<?php echo @$setting['logodichvu'];?>" alt=""></a>
                            </div>
                            <div class="services-name">
                                <a href=""><?php echo $setting['titledichvu']; ?></a>
                                <p><?php echo $setting['paragrapdichvu']; ?></p>
                            </div>
                            <div class="services-btn">
                                <a href="#"><?php echo $setting['buttonxem']; ?></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="item-services" data-aos="zoom-in-up">
                             <div class="services-img">
                                <a href=""><img src="<?php echo @$setting['logodichvu'];?>" alt=""></a>
                            </div>
                            <div class="services-name">
                                <a href=""><?php echo $setting['titledichvu']; ?></a>
                                <p><?php echo $setting['paragrapdichvu']; ?></p>
                            </div>
                            <div class="services-btn">
                                <a href="#"><?php echo $setting['buttonxem']; ?></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="item-services" data-aos="zoom-in-up">
                             <div class="services-img">
                                <a href=""><img src="<?php echo @$setting['logodichvu'];?>" alt=""></a>
                            </div>
                            <div class="services-name">
                                <a href=""><?php echo $setting['titledichvu']; ?></a>
                                <p><?php echo $setting['paragrapdichvu']; ?></p>
                            </div>
                            <div class="services-btn">
                                <a href="#"><?php echo $setting['buttonxem']; ?></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="item-services" data-aos="zoom-in-up">
                             <div class="services-img">
                                <a href=""><img src="<?php echo @$setting['logodichvu'];?>" alt=""></a>
                            </div>
                            <div class="services-name">
                                <a href=""><?php echo $setting['titledichvu']; ?></a>
                                <p><?php echo $setting['paragrapdichvu']; ?></p>
                            </div>
                            <div class="services-btn">
                                <a href="#"><?php echo $setting['buttonxem']; ?></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="item-services" data-aos="zoom-in-up">
                             <div class="services-img">
                                <a href=""><img src="<?php echo @$setting['logodichvu'];?>" alt=""></a>
                            </div>
                            <div class="services-name">
                                <a href=""><?php echo $setting['titledichvu']; ?></a>
                                <p><?php echo $setting['paragrapdichvu']; ?></p>
                            </div>
                            <div class="services-btn">
                                <a href="#"><?php echo $setting['buttonxem']; ?></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="item-services" data-aos="zoom-in-up">
                             <div class="services-img">
                                <a href=""><img src="<?php echo @$setting['logodichvu'];?>" alt=""></a>
                            </div>
                            <div class="services-name">
                                <a href=""><?php echo $setting['titledichvu']; ?></a>
                                <p><?php echo $setting['paragrapdichvu']; ?></p>
                            </div>
                            <div class="services-btn">
                                <a href="#"><?php echo $setting['buttonxem']; ?></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="item-services" data-aos="zoom-in-up">
                             <div class="services-img">
                                <a href=""><img src="<?php echo @$setting['logodichvu'];?>" alt=""></a>
                            </div>
                            <div class="services-name">
                                <a href="">Thiết kế Website, App</a>
                                <p>TOP TOP </p>
                            </div>
                            <div class="services-btn">
                                <a href="#"><?php echo $setting['buttonxem']; ?></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="item-services" data-aos="zoom-in-up">
                             <div class="services-img">
                                <a href=""><img src="<?php echo @$setting['logodichvu'];?>" alt=""></a>
                            </div>
                            <div class="services-name">
                                <a href=""><?php echo $setting['titledichvu']; ?></a>
                                <p><?php echo $setting['paragrapdichvu']; ?></p>
                            </div>
                            <div class="services-btn">
                                <a href="#"><?php echo $setting['buttonxem']; ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="section-personnel">
            <div class="container no-padding">
                <div class="baround/image-overlay"></div>
                <div class="section-title aos-init aos-animate" data-aos="zoom-in-up">
                    <p><?php echo $setting['nhansu']; ?></p>
                    <h3><?php echo $setting['questionnhansu']; ?></h3>
                </div>
                <div class="personnel-content" data-aos="zoom-in-up" id="scrollableDiv">
                    <div class="person-grid">
                        <div class="person">
                            <div class="person__background person-animation-1">
                                <img src="<?php echo @$setting['imagenhansu'];?>" alt="">
                            </div>
                            <div class="person__content">
                                <p class="person__category"><?php echo $setting['chucvu']; ?></p>
                                <h3 class="person__heading"><?php echo $setting['namenhansu']; ?></h3>
                            </div>
                        </div>

                        <div class="person">
                            <div class="person__background person-animation-2">
                                <img src="<?php echo @$setting['imagenhansu'];?>" alt="">
                            </div>
                            <div class="person__content">
                                <p class="person__category"><?php echo $setting['chucvu']; ?></p>
                                <h3 class="person__heading"><?php echo $setting['namenhansu']; ?></h3>
                            </div>
                        </div>

                        <div class="person">
                            <div class="person__background person-animation-1">
                                <img src="<?php echo @$setting['imagenhansu'];?>" alt="">
                            </div>
                            <div class="person__content">
                                <p class="person__category"><?php echo $setting['chucvu']; ?></p>
                                <h3 class="person__heading"><?php echo $setting['namenhansu']; ?></h3>
                            </div>
                        </div>

                        <div class="person">
                            <div class="person__background person-animation-2">
                                <img src="<?php echo @$setting['imagenhansu'];?>" alt="">
                            </div>
                            <div class="person__content">
                                <p class="person__category"><?php echo $setting['chucvu']; ?></p>
                                <h3 class="person__heading"><?php echo $setting['namenhansu']; ?></h3>
                            </div>
                        </div>
                    </div>
                </div>
        </section>

        <section id="section-worth">
            <div class="container">
                <div class="row">
                    <div class="worth-content col-lg-4 col-md-12 col-sm-12">
                        <h4 data-aos="flip-up" class="aos-init aos-animate"><span><?php echo $setting['giatrikhacbiet']; ?></h4>
                        <p data-aos="fade-down-right" class="aos-init aos-animate">
                            <?php echo $setting['parag1']; ?>
                        </p>
                        <p data-aos="fade-right" class="aos-init aos-animate">
                            <?php echo $setting['parag2']; ?>
                        </p>
                        <p data-aos="fade-up-right" class="aos-init">
                            <?php echo $setting['parag3']; ?>
                        </p>
                    </div>
                    <div class="worth-detail col-lg-8 col-md-12 col-sm-12">
                        <div class="row">
                            <div class="item-worth col-lg-4 col-md-6 col-sm-12">
                                <div class="worth-card card-1 aos-init aos-animate" data-aos="fade-right">
                                    <div class="imageBox">
                                        <img src="<?=$urlThemeActive?>asset/image/worth1.png">
                                    </div>
                                    <div class="contentBox">
                                        <h2><?php echo $setting['uytin']; ?></h2>
                                        <div class="description">
                                            <p><?php echo $setting['paragrap1']; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item-worth col-lg-4 col-md-6 col-sm-12">
                                <div class="worth-card card-2 aos-init aos-animate" data-aos="fade-up">
                                    <div class="imageBox">
                                        <img src="<?=$urlThemeActive?>asset/image/worth2.png">
                                    </div>
                                    <div class="contentBox">
                                    <h2><?php echo $setting['chuyennghiep']; ?></h2>
                                        <div class="description">
                                            <p><?php echo $setting['paragrap1']; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item-worth col-lg-4 col-md-6 col-sm-12">
                                <div class="worth-card card-3 aos-init aos-animate" data-aos="fade-left">
                                    <div class="imageBox">
                                        <img src="<?=$urlThemeActive?>asset/image/worth3.png">
                                    </div>
                                    <div class="contentBox">
                                        <h2><?php echo $setting['sangtao']; ?></h2>
                                        <div class="description">
                                            <p><?php echo $setting['paragrap1']; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item-worth col-lg-4 col-md-6 col-sm-12">
                                <div class="worth-card card-4 aos-init" data-aos="fade-right">
                                    <div class="imageBox">
                                        <img src="<?=$urlThemeActive?>asset/image/worth4.png">
                                    </div>
                                    <div class="contentBox">
                                        <h2><?php echo $setting['sangtao']; ?></h2>
                                        <div class="description">
                                            <p><?php echo $setting['paragrap1']; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item-worth col-lg-4 col-md-6 col-sm-12">
                                <div class="worth-card card-5 aos-init" data-aos="fade-up">
                                    <div class="imageBox">
                                        <img src="<?=$urlThemeActive?>asset/image/worth5.png">
                                    </div>
                                    <div class="contentBox">
                                        <h2><?php echo $setting['tienphong']; ?></h2>
                                        <div class="description">
                                            <p><?php echo $setting['paragrap1']; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item-worth col-lg-4 col-md-6 col-sm-12">
                                <div class="worth-card card-6 aos-init" data-aos="fade-left">
                                    <div class="imageBox">
                                        <img src="<?=$urlThemeActive?>asset/image/worth6.png">
                                    </div>
                                    <div class="contentBox">
                                        <h2><?php echo $setting['baomat']; ?></h2>
                                        <div class="description">
                                            <p><?php echo $setting['paragrap1']; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>

        <section id="partner">
            <div class="container">
                <div class="section-title" data-aos="zoom-in-up">
                    <p>Đối tác</p>
                    <h3>Khách hàng đã <span>tin tưởng và hợp tác</span> cùng TOP TOP</h3>
                </div>
                <div class="list-partner" data-aos="zoom-in-up">
                    <div class="partner-logo">
                        <div class="partner-dot dot1">
                            <i class="fa-solid fa-circle"></i>
                        </div>
                        <img src="<?=$urlThemeActive?>asset/image/partner1.png" alt="">
                    </div>
                    <div class="partner-logo">
                        <div class="partner-dot dot1">
                            <i class="fa-solid fa-circle"></i>
                        </div>
                        <img src="<?=$urlThemeActive?>asset/image/partner1.png" alt="">
                    </div>
                    <div class="partner-logo">
                        <div class="partner-dot dot1">
                            <i class="fa-solid fa-circle"></i>
                        </div>
                        <img src="<?=$urlThemeActive?>asset/image/partner2.png" alt="">
                    </div>
                    <div class="partner-logo">
                        <div class="partner-dot dot1">
                            <i class="fa-solid fa-circle"></i>
                        </div>
                        <img src="<?=$urlThemeActive?>asset/image/partner2.png" alt="">
                    </div>
                    <div class="partner-logo">
                        <div class="partner-dot dot1">
                            <i class="fa-solid fa-circle"></i>
                        </div>
                        <img src="<?=$urlThemeActive?>asset/image/partner1.png" alt="">
                    </div>
                    <div class="partner-logo">
                        <div class="partner-dot dot1">
                            <i class="fa-solid fa-circle"></i>
                        </div>
                        <img src="<?=$urlThemeActive?>asset/image/partner2.png" alt="">
                    </div>
                    <div class="partner-logo">
                        <div class="partner-dot dot1">
                            <i class="fa-solid fa-circle"></i>
                        </div>
                        <img src="<?=$urlThemeActive?>asset/image/partner1.png" alt="">
                    </div>
                    <div class="partner-logo">
                        <div class="partner-dot dot1">
                            <i class="fa-solid fa-circle"></i>
                        </div>
                        <img src="<?=$urlThemeActive?>asset/image/partner1.png" alt="">
                    </div>
                    <div class="partner-logo">
                        <div class="partner-dot dot1">
                            <i class="fa-solid fa-circle"></i>
                        </div>
                        <img src="<?=$urlThemeActive?>asset/image/partner2.png" alt="">
                    </div>
                    <div class="partner-logo">
                        <div class="partner-dot dot1">
                            <i class="fa-solid fa-circle"></i>
                        </div>
                        <img src="<?=$urlThemeActive?>asset/image/partner2.png" alt="">
                    </div>
                    <div class="partner-logo">
                        <div class="partner-dot dot1">
                            <i class="fa-solid fa-circle"></i>
                        </div>
                        <img src="<?=$urlThemeActive?>asset/image/partner1.png" alt="">
                    </div>
                    <div class="partner-logo">
                        <div class="partner-dot dot1">
                            <i class="fa-solid fa-circle"></i>
                        </div>
                        <img src="<?=$urlThemeActive?>asset/image/partner2.png" alt="">
                    </div>
                    <div class="partner-logo">
                        <div class="partner-dot dot1">
                            <i class="fa-solid fa-circle"></i>
                        </div>
                        <img src="<?=$urlThemeActive?>asset/image/partner2.png" alt="">
                    </div>
                    <div class="partner-logo">
                        <div class="partner-dot dot1">
                            <i class="fa-solid fa-circle"></i>
                        </div>
                        <img src="<?=$urlThemeActive?>asset/image/partner1.png" alt="">
                    </div>
                    <div class="partner-logo">
                        <div class="partner-dot dot1">
                            <i class="fa-solid fa-circle"></i>
                        </div>
                        <img src="<?=$urlThemeActive?>asset/image/partner1.png" alt="">
                    </div>
                    <div class="partner-logo">
                        <div class="partner-dot dot1">
                            <i class="fa-solid fa-circle"></i>
                        </div>
                        <img src="<?=$urlThemeActive?>asset/image/partner2.png" alt="">
                    </div>
                    <div class="partner-logo">
                        <div class="partner-dot dot1">
                            <i class="fa-solid fa-circle"></i>
                        </div>
                        <img src="<?=$urlThemeActive?>asset/image/partner2.png" alt="">
                    </div>
                    <div class="partner-logo">
                        <div class="partner-dot dot1">
                            <i class="fa-solid fa-circle"></i>
                        </div>
                        <img src="<?=$urlThemeActive?>asset/image/partner1.png" alt="">
                    </div>
                    <div class="partner-logo">
                        <div class="partner-dot dot1">
                            <i class="fa-solid fa-circle"></i>
                        </div>
                        <img src="<?=$urlThemeActive?>asset/image/partner2.png" alt="">
                    </div>
                    <div class="partner-logo">
                        <div class="partner-dot dot1">
                            <i class="fa-solid fa-circle"></i>
                        </div>
                        <img src="<?=$urlThemeActive?>asset/image/partner1.png" alt="">
                    </div>
                    <div class="partner-logo">
                        <div class="partner-dot dot1">
                            <i class="fa-solid fa-circle"></i>
                        </div>
                        <img src="<?=$urlThemeActive?>asset/image/partner2.png" alt="">
                    </div>

                </div>
            </div>
        </section>

        <section id="section-feedback">
            <div class="container">
                <div class="feedback-content">
                    <div class="row">
                        <div class="col-lg-5 col-12 no-padding-right">
                            <div class="section-title" data-aos="zoom-in-up">
                                <h3>Khách hàng <br> <span>nói gì</span> về TOP TOP</h3>
                            </div>

                            <div class="fb-slide-1">
                                <div class="item-slide-1">
                                    <div class="customer-info">
                                        <div class="customer-img">
                                            <img src="<?=$urlThemeActive?>asset/image/bg-btn.jpg" alt="">
                                        </div>
                                        <div class="customer-company">
                                            <p><?php echo $setting['namekhachhang']; ?></p>
                                        </div>
                                    </div>
                                    <div class="fedback-text">
                                        <p><?php echo $setting['whatabout']; ?></p>
                                    </div>
                                </div>

                                <div class="item-slide-1">
                                    <div class="customer-info">
                                        <div class="customer-img">
                                            <img src="<?=$urlThemeActive?>asset/image/bg-btn.jpg" alt="">
                                        </div>
                                        <div class="customer-company">
                                            <p><?php echo $setting['namekhachhang']; ?></p>
                                        </div>
                                    </div>
                                    <div class="fedback-text">
                                        <p><?php echo $setting['whatabout']; ?></p>
                                    </div>
                                </div>

                                <div class="item-slide-1">
                                    <div class="customer-info">
                                        <div class="customer-img">
                                            <img src="<?=$urlThemeActive?>asset/image/bg-btn.jpg" alt="">
                                        </div>
                                        <div class="customer-company">
                                            <p><?php echo $setting['namekhachhang']; ?></p>
                                        </div>
                                    </div>
                                    <div class="fedback-text">
                                        <p><?php echo $setting['whatabout']; ?></p>
                                    </div>
                                </div>
                            </div>


                        </div>
                        
                        <div class="col-lg-7 col-12 no-padding">
                            <div class="fb-slide-2">
                         <?php foreach ($slideyourself as $key => $value) { ?>
                                <div class="item-slide-2">
                                    <img src="<?php echo $value->image; ?>" alt="">
                                </div>
                        <?php } ?>
                            </div>
                        </div>

                    </div>

                    <div class="sldie-feedback-center">
                        <div class="sldie-feedback-center-content">
                            <div class="macbook-img">
                                <img src="<?=$urlThemeActive?>asset/image/macbook.webp" alt="">
                            </div>
                            <div class="list-slide-feedback-center">
                                <div class="fb-slide-3">
                                <?php foreach ($slideyourself as $key => $value) { ?>
                                    <div class="item-slide-3">
                                        <div class="item-slide-3-img">
                                            <img src="<?php echo $value->image; ?>" alt="">
                                        </div>
                                    </div>
                                <?php } ?>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>



        </section>

        <section id="news">
            <div class="container">
                <div class="section-title" data-aos="zoom-in-up">
                    <p><?php echo $setting['news']; ?></p>
                    <h3><?php echo $setting['newsnoibat']; ?></h3>
                    <h5>Cập nhật liên tục các thông tin, kiến thức và xu hướng mới nhất về công nghệ</h5>
                </div>

                <div class="news-content" data-aos="zoom-in-up">
                    <div class="slide-news">
                    <?php foreach ($slidenews as $key => $value) { ?>
                        <div class="item-slide-news">
                            <div class="card-news">
                                <div class="news-img">
                                    <img src="<?php echo $value->image; ?>" alt="">
                                </div>
                                <div class="news-detail">
                                    <div class="news-timepost">
                                        <i class="fa-regular fa-calendar-days"></i>
                                        <p><?php echo $setting['time']; ?></p>
                                    </div>
                                    <div class="news-title">
                                        <a href=""><?php echo $setting['titletintuc']; ?></a>
                                    </div>
                                    <div class="news-text">
                                        <p><?php echo $setting['contenttintuc']; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                      



                    </div>
                </div>


            </div>
        </section>
    </main>
<?php 
    getFooter();
?>

