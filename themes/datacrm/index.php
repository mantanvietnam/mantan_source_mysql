<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <?php 
        mantan_header(); 
        global $settingThemes;
        if(function_exists('showSeoHome')) showSeoHome();
    ?>
    
    <link rel="stylesheet" href="<?php echo $urlThemeActive;?>/asset/css/main.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />

    <!-- aos -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

    <!-- Boostrap -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">


    <!-- Fonawesome -->
    <script src="https://kit.fontawesome.com/9163bded0f.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>

    <!-- Swiper -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />


    <!-- Fancyapp -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>

    <!-- Animate CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />


</head>

<body>
    <div class="intro">
        <h1 class="logo-header">
            <div class="loader">
                <div class="dot"></div>
                <div class="dot"></div>
                <div class="dot"></div>
                <div class="dot"></div>
                <div class="dot"></div>
                <div class="dot"></div>
                <div class="dot"></div>
                <div class="dot"></div>
                <div class="dot"></div>
            </div>
        </h1>
    </div>

    <header>
        <section id="menu">
            <nav class="navbar navbar-expand-lg bg-body-tertiary">
                <div class="container-fluid">
                    <a class="navbar-brand" href="/"><img src="<?php echo @$settingThemes['logo'];?>" alt=""></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavDropdown">
                        <ul class="navbar-nav">
                            <?php 
                                $menu = getMenusDefault();

                                if(!empty($menu)){
                                    foreach($menu as $key => $value){
                                        if(!empty($value->sub)){
                                            echo '  <li class="nav-item dropdown">
                                                        <a class="nav-link dropdown-toggle" href="javascript:void(0);" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                            '.$value->name.'
                                                        </a>
                                                        <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">';

                                                            foreach ($value->sub as $sub) {
                                                                echo '<li><a class="dropdown-item" href="'.$sub->link.'">'.$sub->name.'</a></li>';
                                                            }
                                            echo        '</ul>
                                                    </li>';
                                        }else{
                                            echo '  <li class="nav-item">
                                                        <a class="nav-link" href="'.$value->link.'">'.$value->name.'</a>
                                                    </li>';
                                        }
                                    }
                                }
                            ?>

                            <li class="nav-item">
                                <div class="header-btn d-none">
                                    <button class="advise-button" >Đăng kí tư vấn</button>

                                    <!--
                                    <a href=""><img src="<?php echo $urlThemeActive;?>/asset/image/coVN.png" alt=""></a>
                                    <a href=""><img src="<?php echo $urlThemeActive;?>/asset/image/coUK.png" alt=""></a>
                                    -->
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="header-btn">
                        <button class="advise-button" >Đăng kí tư vấn</button>

                        <!--
                        <a href=""><img src="<?php echo $urlThemeActive;?>/asset/image/coVN.png" alt=""></a>
                        <a href=""><img src="<?php echo $urlThemeActive;?>/asset/image/coUK.png" alt=""></a>
                        -->
                    </div>


                </div>
            </nav>
        </section>
    </header>

    <main>
        <section id="banner">
            <div class="container">

                <div class="list-banner row">
                    <div class="banner-sub col-lg-6 col-md-6 col">
                        <?php 
                        if(!empty($slide_home)){
                            foreach ($slide_home as $key => $value) {
                                echo '  <div class="item-banner-sub">
                                            <h4>'.@$settingThemes['name_brand'].'</h4>
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
                    <a href="<?php echo @$settingThemes['link_about'];?>" data-aos="zoom-out">Về chúng tôi</a>
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

    <footer>
        <section id="footer">
            <div class="container">

                <div class="footer-contact-absolute">
                    <div class="footer-contact">
                        <div class="footer-contact-text">
                            <p>Ngay bây giờ chính là thời điểm sớm nhất<br> Bước gần hơn đến thành công của bạn bằng cách trò chuyện với chúng tôi</p>
                        </div>

                        <div class="footer-contact-btn">
                            <button class="advise-button" data-aos="zoom-in">Liên hệ ngay</button>
                        </div>

                    </div>
                </div>

                <div class="footer-contact-wave">
                    <img src="<?php echo $urlThemeActive;?>/asset/image/wave.webp" alt="">
                </div>


                <div class="row">
                    <div class="col-lg-4 col-12" data-aos="fade-right">
                        <div class="footer-company-info">
                            <div class="footer-company-intro">
                                <div class="footer-company-logo">
                                    <img src="<?php echo @$settingThemes['logo'];?>" alt="">
                                </div>
                                <p><?php echo @$settingThemes['content1_footer'];?></p>
                            </div>

                            <div class="footer-company-address">
                                <h4>Trụ sở chính</h4>
                                <ul>
                                    <li><span>Địa chỉ:</span> <?php echo $contactSite['address'];?></li>
                                    <li><span>Số điện thoại:</span> <?php echo $contactSite['phone'];?></li>
                                    <li><span>Email</span> <?php echo $contactSite['email'];?></li>
                                </ul>

                            </div>

                            <div class="footer-company-icons-contact">
                                <h4>Kết nối với chúng tôi</h4>
                                <ul>
                                    <li><a href="<?php echo @$settingThemes['facebook'];?>"><i class="fa-brands fa-facebook-f"></i></a></li>
                                    <li><a href="<?php echo @$settingThemes['youtube'];?>"><i class="fa-brands fa-youtube"></i></a></li>
                                    <li><a href="<?php echo @$settingThemes['instagram'];?>"><i class="fa-brands fa-instagram"></i></a></li>
                                    <li><a href="<?php echo @$settingThemes['linkedIn'];?>"><i class="fa-brands fa-linkedin-in"></i></a></li>
                                    <li><a href="<?php echo @$settingThemes['tiktok'];?>"><i class="fa-brands fa-tiktok"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-12" data-aos="fade-up">
                        <div class="footer-company-services">
                            <h4>LIÊN KẾT</h4>
                            <ul>
                                <?php 
                                if(!empty($menuFooter)){
                                    foreach ($menuFooter as $key => $value) {
                                        echo '<li><a target="_blank" href="'.$value->link.'">'.$value->name.'</a></li>';
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                        <div class="footer-company-recruitment">
                            <h4>TUYỂN DỤNG</h4>
                            <ul>
                                <li>Gửi thông tin ứng tuyển tại</li>
                                <li><span>Email:</span> <?php echo $contactSite['email'];?></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-5 col-12" data-aos="fade-up-left">
                        <div class="footer-advise">
                            <div class="footer-advise-title">
                                <h4>GỬI YÊU CẦU BÁO GIÁ DỊCH VỤ</h4>
                                <p><?php echo @$settingThemes['name_brand'];?> luôn tư vấn dịch vụ miễn phí. Chúng tôi sẽ liên hệ báo giá theo thông tin mà bạn để lại.</p>
                            </div>
                            <div class="footer-advise-form">
                                <form action="/contact" method="POST">
                                    <input type="hidden" name="_csrfToken" value="<?php echo $csrfToken;?>">
                                    <div class="flex-input">
                                        <input type="text" placeholder="Họ và tên *" required value="" name="name">
                                        <input type="text" placeholder="Email *" required value="" name="email">
                                    </div>
                                    <input type="text" placeholder="Số điện thoại *" required value="" name="phone_number">
                                    <input type="text" placeholder="Tiêu đề *" required value="" name="subject">
                                    <textarea name="content" id="" rows="6" placeholder="Nội dung tin nhắn"></textarea>

                                    <div class="footer-advise-form-btn">
                                        <button type="submit">Gửi</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>

        <section id="copy-right">
            <p>© 2024 <?php echo @$settingThemes['name_brand'];?>. All rights reserved.</p>
        </section>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="<?php echo $urlThemeActive;?>/asset/js/main.js"></script>
</body>

</html>