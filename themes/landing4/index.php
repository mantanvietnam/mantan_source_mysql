<?php
getHeader();
global $urlThemeActive;
?>
    <main>
        <section id="section-banner">
            <div class="banner-home" style="background-image: url(<?php echo @$setting['background_top'];?>);">
                <div class="banner-overlay"></div>
                <div class="banner-content">
                    <div class="container">
                        <div class="content-box">
                            <div class="content-first">
                                <p><?php echo @$setting['title_top_nho'];?></p>
                            </div>
                            <div class="content-second">
                                <h1><?php echo @$setting['title_top_to'];?></h1>
                            </div>
                            <div class="content-third">
                                <span><?php echo @$setting['content_top'];?></span>
                            </div>

                            <div class="content-btn">
                                <a href="<?php echo @$setting['link_top'];?>">Đăng ký</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="section-introduce" class="section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-md-5 col-sm-6 col-xs-12">
                        <div class="introduce-avata" data-aos="fade-right">
                            <img src="./asset/img/tt1.jpg" alt="">
                        </div>
                    </div>

                    <div class="col-md-7 col-sm-6 col-xs-12" data-aos="fade-left">
                        <div class="section-title" data-aos="flip-up" data-aos-duration="4000">
                            <div class="block-title">
                                <p class="justify-content-start">
                                    <span></span>
                                    Giới thiệu về tôi
                                </p>
                            </div>
                        </div>
                        <div class="introduce-content">
                            <div class="introduce-title">
                                <h4>Tôi Là Người Dẫn Đường</h4>
                            </div>
                            <div class="introduce-detail">
                                <p>
                                    Nhà sáng lập & CEO của Phoenixcamp Academy.<br>
                                    Là chuyên gia Facebook Marketing Automation, xây dựng hệ thống Marketing tự động cho doanh nghiệp.<br>
                                    Giảng viên 3 năm kinh nghiệm đào tạo, giảng dạy, tư vấn cho các cá nhân, tổ chức, doanh nghiệp.<br>
                                </p>
                            </div>

                            <div class="introduce-info">
                                <div class="introduce-info-item">
                                    <div class="introduce-icon">
                                        <i class="fa-solid fa-medal"></i>
                                    </div>

                                    <div class="introduce-intro-text">
                                        <div class="introduce-intro-tiitle">
                                            Our Solutions​
                                        </div>

                                        <div class="introduce-intro-description">
                                            The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here,
                                        </div>
                                    </div>
                                </div>

                                <div class="introduce-info-item">
                                    <div class="introduce-icon">
                                        <i class="fa-regular fa-clock"></i>
                                    </div>

                                    <div class="introduce-intro-text">
                                        <div class="introduce-intro-tiitle">
                                            24/7 Support
                                        </div>

                                        <div class="introduce-intro-description">
                                            There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour.
                                        </div>
                                    </div>
                                </div>

                                <div class="introduce-info-item">
                                    <div class="introduce-icon">
                                        <i class="fa-solid fa-phone"></i>
                                    </div>

                                    <div class="introduce-intro-text">
                                        <div class="introduce-intro-tiitle">
                                            Call for Our Services
                                        </div>

                                        <div class="introduce-intro-description">
                                            1-012-344-687
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="section-service" class="section-padding">
            <div class="container">
                <div class="section-title text-center" data-aos="flip-up" data-aos-duration="4000">
                    <div class="block-title">
                        <p>
                            <span></span>
                            Dịch vụ
                        </p>
                    </div>
                    <h3 class="text-center">Dịch vụ của tôi</h3>
                    <div class="border-heading"></div>
                </div>

                <div class="service-list">
                    <div class="row">
                        <div class="col-lg-4 col-md-6">
                            <div class="service-item">
                                <div class="service-icon">
                                    <i class="fa-regular fa-font-awesome"></i>
                                </div>
    
                                <div class="service-name">
                                    <p>Home Cleaning</p>
                                </div>
    
                                <div class="service-description">
                                    <p>Lorem ipsum dolor sit ametaut odiut perspiciatis unde omnis iste quuntur alquam quaerat rsit amet</p>
                                </div>
    
                                <img  class="img-one" src="./asset/img/service-shape.png" alt="">
                                <img  class="img-two" src="./asset/img/service-shape1.png" alt="">
    
                            </div>
                        </div>
    
                        <div class="col-lg-4 col-md-6">
                            <div class="service-item">
                                <div class="service-icon">
                                    <i class="fa-regular fa-font-awesome"></i>
                                </div>
    
                                <div class="service-name">
                                    <p>Home Cleaning</p>
                                </div>
    
                                <div class="service-description">
                                    <p>Lorem ipsum dolor sit ametaut odiut perspiciatis unde omnis iste quuntur alquam quaerat rsit amet</p>
                                </div>
    
                                <img  class="img-one" src="./asset/img/service-shape.png" alt="">
                                <img  class="img-two" src="./asset/img/service-shape1.png" alt="">
    
                            </div>
                        </div>
    
                        <div class="col-lg-4 col-md-6">
                            <div class="service-item">
                                <div class="service-icon">
                                    <i class="fa-regular fa-font-awesome"></i>
                                </div>
    
                                <div class="service-name">
                                    <p>Home Cleaning</p>
                                </div>
    
                                <div class="service-description">
                                    <p>Lorem ipsum dolor sit ametaut odiut perspiciatis unde omnis iste quuntur alquam quaerat rsit amet</p>
                                </div>
    
                                <img  class="img-one" src="./asset/img/service-shape.png" alt="">
                                <img  class="img-two" src="./asset/img/service-shape1.png" alt="">
    
                            </div>
                        </div>
    
                        <div class="col-lg-4 col-md-6">
                            <div class="service-item">
                                <div class="service-icon">
                                    <i class="fa-regular fa-font-awesome"></i>
                                </div>
    
                                <div class="service-name">
                                    <p>Home Cleaning</p>
                                </div>
    
                                <div class="service-description">
                                    <p>Lorem ipsum dolor sit ametaut odiut perspiciatis unde omnis iste quuntur alquam quaerat rsit amet</p>
                                </div>
    
                                <img  class="img-one" src="./asset/img/service-shape.png" alt="">
                                <img  class="img-two" src="./asset/img/service-shape1.png" alt="">
    
                            </div>
                        </div>
    
                        <div class="col-lg-4 col-md-6">
                            <div class="service-item">
                                <div class="service-icon">
                                    <i class="fa-regular fa-font-awesome"></i>
                                </div>
    
                                <div class="service-name">
                                    <p>Home Cleaning</p>
                                </div>
    
                                <div class="service-description">
                                    <p>Lorem ipsum dolor sit ametaut odiut perspiciatis unde omnis iste quuntur alquam quaerat rsit amet</p>
                                </div>
    
                                <img  class="img-one" src="./asset/img/service-shape.png" alt="">
                                <img  class="img-two" src="./asset/img/service-shape1.png" alt="">
    
                            </div>
                        </div>
    
                        <div class="col-lg-4 col-md-6">
                            <div class="service-item">
                                <div class="service-icon">
                                    <i class="fa-regular fa-font-awesome"></i>
                                </div>
    
                                <div class="service-name">
                                    <p>Home Cleaning</p>
                                </div>
    
                                <div class="service-description">
                                    <p>Lorem ipsum dolor sit ametaut odiut perspiciatis unde omnis iste quuntur alquam quaerat rsit amet</p>
                                </div>
    
                                <img  class="img-one" src="./asset/img/service-shape.png" alt="">
                                <img  class="img-two" src="./asset/img/service-shape1.png" alt="">
    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="section-library" class="section-padding">
            <div class="container">
                <div class="section-title text-center" data-aos="flip-up" data-aos-duration="4000">
                    <div class="block-title">
                        <p>
                            <span></span>
                            Thư viện
                        </p>
                    </div>
                    <h3 class="text-center">Thư <span>viện</span></h3>
                    <div class="border-heading"></div>
                </div>

                <div class="library-list" data-aos="zoom-out-left">
                    <div class="row">
                        <div class="col-md-4 col-sm-6 col-xs-12 library-item">
                            <div class="library-image">
                                <a href="./asset/img/bachgroudbannerl.jpg">
                                    <img src="./asset/img/bachgroudbannerl.jpg" alt="">
                                </a>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-6 col-xs-12 library-item">
                            <div class="library-image">
                                <a href="./asset/img/bachgroudbannerl.jpg">
                                    <img src="./asset/img/bachgroudbannerl.jpg" alt="">
                                </a>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-6 col-xs-12 library-item">
                            <div class="library-image">
                                <a href="./asset/img/bachgroudbannerl.jpg">
                                    <img src="./asset/img/bachgroudbannerl.jpg" alt="">
                                </a>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-6 col-xs-12 library-item">
                            <div class="library-image">
                                <a href="./asset/img/bachgroudbannerl.jpg">
                                    <img src="./asset/img/bachgroudbannerl.jpg" alt="">
                                </a>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-6 col-xs-12 library-item">
                            <div class="library-image">
                                <a href="./asset/img/bachgroudbannerl.jpg">
                                    <img src="./asset/img/bachgroudbannerl.jpg" alt="">
                                </a>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-6 col-xs-12 library-item">
                            <div class="library-image">
                                <a href="./asset/img/bachgroudbannerl.jpg">
                                    <img src="./asset/img/bachgroudbannerl.jpg" alt="">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="section-ourteam" class="section-padding">
            <div class="container">
                <div class="section-title text-center" data-aos="flip-up" data-aos-duration="4000">
                    <div class="block-title">
                        <p>
                            <span></span>
                            Đội ngũ
                        </p>
                    </div>
                    <h3 class="text-center">Đội ngũ của Phoenix</h3>
                    <div class="border-heading"></div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="ourteam-item">
                            <div class="ourteam-img">
                                <img src="./asset/img/trantoan.jpg" alt="">
                                <ul class="social">
                                    <li>
                                        <a href="">
                                            <i class="fa-brands fa-facebook-f"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="">
                                            <i class="fa-brands fa-twitter"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="">
                                            <i class="fa-brands fa-instagram"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="ourteam-detail">
                                <p class="ourteam-name">Trần Toản</p>
                                <p class="ourteam-position">DIỄN GIẢ - NHÀ ĐÀO TẠO</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="ourteam-item">
                            <div class="ourteam-img">
                                <img src="./asset/img/trantoan.jpg" alt="">
                                <ul class="social">
                                    <li>
                                        <a href="">
                                            <i class="fa-brands fa-facebook-f"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="">
                                            <i class="fa-brands fa-twitter"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="">
                                            <i class="fa-brands fa-instagram"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="ourteam-detail">
                                <p class="ourteam-name">Trần Toản</p>
                                <p class="ourteam-position">DIỄN GIẢ - NHÀ ĐÀO TẠO</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="ourteam-item">
                            <div class="ourteam-img">
                                <img src="./asset/img/trantoan.jpg" alt="">
                                <ul class="social">
                                    <li>
                                        <a href="">
                                            <i class="fa-brands fa-facebook-f"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="">
                                            <i class="fa-brands fa-twitter"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="">
                                            <i class="fa-brands fa-instagram"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="ourteam-detail">
                                <p class="ourteam-name">Trần Toản</p>
                                <p class="ourteam-position">DIỄN GIẢ - NHÀ ĐÀO TẠO</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="ourteam-item">
                            <div class="ourteam-img">
                                <img src="./asset/img/trantoan.jpg" alt="">
                                <ul class="social">
                                    <li>
                                        <a href="">
                                            <i class="fa-brands fa-facebook-f"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="">
                                            <i class="fa-brands fa-twitter"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="">
                                            <i class="fa-brands fa-instagram"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="ourteam-detail">
                                <p class="ourteam-name">Trần Toản</p>
                                <p class="ourteam-position">DIỄN GIẢ - NHÀ ĐÀO TẠO</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="section-blog" class="section-padding">
            <div class="container">
                <div class="row">
                    <div class="section-title text-center" data-aos="flip-up" data-aos-duration="4000">
                        <div class="block-title">
                            <p>
                                <span></span>
                                Tin tức
                            </p>
                        </div>
                        <h3 class="text-center">Tin tức về chúng tôi</h3>
                        <div class="border-heading"></div>
                    </div>

                    <div class="col-lg-6 col-md-6">
                        <div class="blog-item">
                            <div class="blog-top">
                                <a href="">
                                    <img src="./asset/img/bachgroudbannerl.jpg" alt="">
                                </a>
                            </div>

                            <div class="blog-bottom">
                                <div class="blog-meta">
                                    <div class="blog-meta-item">
                                        <i class="fa-regular fa-user"></i>                                        
                                        <span>by Admin</span>
                                    </div>

                                    <div class="blog-meta-item">
                                        <i class="fa-regular fa-calendar"></i>
                                        <span>19 July, 2020</span>
                                    </div>
                                </div>

                                <div class="blog-title">
                                    <a href="">What is Lorem Ipsum?</a>
                                </div>

                                <div class="blog-description">
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry</p>
                                </div>

                                <div class="blog-link">
                                    <a href="">Read more</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6">
                        <div class="blog-item">
                            <div class="blog-top">
                                <a href="">
                                    <img src="./asset/img/bachgroudbannerl.jpg" alt="">
                                </a>
                            </div>

                            <div class="blog-bottom">
                                <div class="blog-meta">
                                    <div class="blog-meta-item">
                                        <i class="fa-regular fa-user"></i>                                        
                                        <span>by Admin</span>
                                    </div>

                                    <div class="blog-meta-item">
                                        <i class="fa-regular fa-calendar"></i>
                                        <span>19 July, 2020</span>
                                    </div>
                                </div>

                                <div class="blog-title">
                                    <a href="">What is Lorem Ipsum?</a>
                                </div>

                                <div class="blog-description">
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry</p>
                                </div>

                                <div class="blog-link">
                                    <a href="">Read more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="section-contact-info" class="section-padding">
            <div class="container">
                <div class="section-title text-center" data-aos="flip-up" data-aos-duration="4000">
                    <div class="block-title">
                        <p>
                            <span></span>
                            Liên hệ
                        </p>
                    </div>
                    <h3 class="text-center">Thông tin liên hệ</h3>
                </div>

                <div class="contact-info-box">
                    <div class="row">
                        <div class="col-lg-4 contact-info-item">
                            <div class="contact-info-inner">
                                <div class="contact-info-icon">
                                    <i class="fa-solid fa-map"></i>
                                </div>

                                <div class="contact-info-name">
                                    <h4>Office Location</h4>
                                </div>

                                <div class="contact-info-detail">
                                    <p>250 Main Road #600, Alexandra,
                                        VA 22314, USA</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 contact-info-item">
                            <div class="contact-info-inner">
                                <div class="contact-info-icon">
                                    <i class="fa-solid fa-map"></i>
                                </div>

                                <div class="contact-info-name">
                                    <h4>Office Location</h4>
                                </div>

                                <div class="contact-info-detail">
                                    <p>250 Main Road #600, Alexandra,
                                        VA 22314, USA</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 contact-info-item">
                            <div class="contact-info-inner">
                                <div class="contact-info-icon">
                                    <i class="fa-solid fa-map"></i>
                                </div>

                                <div class="contact-info-name">
                                    <h4>Office Location</h4>
                                </div>

                                <div class="contact-info-detail">
                                    <p>250 Main Road #600, Alexandra,
                                        VA 22314, USA</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="section-contact-form" class="section-padding" style="background-image: url(./asset/img/background.jpg);">
            <div class="banner-overlay"></div>
            <div class="contact-form-box">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-10 col-xl-6">
                            <div class="section-title text-center">
                                <h3 class="text-center">Gửi thông tin đăng ký</h3>
                            </div>
    
                            <div class="form-contact">
                                <form action="">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Họ và tên" required>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <input type="email" class="form-control" placeholder="Email" required>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Số điện thoại">
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <textarea name="message" id="message" class="form-control" cols="30" rows="5" required="" placeholder="Nội dung"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <button type="submit" class="default-btn">
                                                Gửi
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

<?php
getFooter();?>
 