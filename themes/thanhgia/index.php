<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo $urlThemeActive;?>/asset/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- boostrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- slick -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <script
        type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
    ></script>
    <script
        type="text/javascript"
        src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"
    ></script>
    <script
        type="text/javascript"
        src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"
    ></script>

    <?php mantan_header(); ?>
</head>
<body>
    <header>
        <section id="topbar">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-12 topbar-item-left d-flex">
                        <div class="header-hotline">
                            <p>Hotline: <a href="tel:1900.636.000">1900.636.000 </a>(8h - 12h, 13h30 - 17h) </p>
                        </div>
                        <div class="link-hotline">
                            <a href="">Liên hệ</a>
                        </div>
                    </div>
        
                    <div class="col-lg-6 col-md-6 col-12 topbar-item-right">
                        <div class="notify-box">
                            <div class="icon-notificaiton">
                                <span>0</span>
                                <i class="fa-solid fa-bell"></i>
                            </div>
                            <p>Thông báo</p>   
                            <div class="notify-content">
                                <div class="notify-content-list">
                                    <div class="notify-content-item">
                                        <p>Hiện không có thông báo nào</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="section-overlay"></section>

        <section id="header-menu">
            <nav class="navbar navbar-expand-lg">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">Power Drink</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarScroll">
                    <ul class="navbar-nav my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Trang chủ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Tin tức</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Sản phẩm
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                                <li><a class="dropdown-item" href="#">Sản phẩm mới</a></li>
                                <li><a class="dropdown-item" href="#">Sản phẩm nổi bật</a></li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#">Giới thiệu</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#">Hệ thống cửa hàng</a>
                        </li>
                    </ul>
                    <div class="menu-header-right d-flex">
                        <button class="icon-header icon-glass" href=""><i class="fa-solid fa-magnifying-glass"></i></button>
                        <a class="icon-header" href=""><i class="fa-solid fa-user"></i></a>
                        <a class="icon-header" href=""><i class="fa-solid fa-cart-shopping"></i></a>
                    </div>
                  </div>
                </div>
            </nav>

            <div class="search-box-fixed">
                <div class="search-box">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-3 logo">
                                <a href="" class="logo-name">Power Drink</a>
                            </div>
    
                            <div class="col-lg-6 search-form">
                                <div class="search-form-box">
                                    <input class="search-input" type="text" placeholder="Tìm kiếm sản phẩm">
                                    <button class="search-button" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                                </div>
    
                                <div class="search-text">
                                    <p>Gợi ý cho bạn: <a href="">Sản phẩm mới</a></p>
                                </div>
                            </div>
    
                            <div class="col-lg-3 action-close">
                                <i class="fa-solid fa-x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </section>
    </header>

    <main>
        <section id="section-slide-home" class="mgb-80">
            <div class="home-background">
                <div class="home-background-img">
                    <img src="<?php echo $urlThemeActive;?>/asset/img/slide_1_img.jpg" alt="">
                </div>

                <div class="home-background-img">
                    <img src="<?php echo $urlThemeActive;?>/asset/img/slide_2_img.jpg" alt="">
                </div>

                <div class="home-background-img">
                    <img src="<?php echo $urlThemeActive;?>/asset/img/slide_1_img.jpg" alt="">
                </div>

                <div class="home-background-img">
                    <img src="<?php echo $urlThemeActive;?>/asset/img/slide_2_img.jpg" alt="">
                </div>
            </div>
        </section>

        <!-- ly do -->
        <section id="section-reason" class="mgb-80">  
            <div class="container content-reason">
                <div class="section-title">
                    <p class="title-sub">Lý do</p>
                    <h2>Chọn power drink</h2>
                </div>
                <div class="reason-content">
                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-3 item-reason-content">
                            <div class="reason-content-img">
                                <img src="<?php echo $urlThemeActive;?>/asset/img/home_feature_1_img.jpg" alt="">
                            </div>

                            <div class="reason-content-title">
                                <h3>Năng lượng thuần khiết</h3>
                            </div>

                            <div class="reason-content-sub">
                                <p>Nước tăng lực Power Drink mang đến sự tăng cường vượt trội về thể chất và tinh thần, nhờ hương vị và chất lượng hoàn hảo.</p>
                            </div>
                        </div>

                        <div class="col-12 col-md-6 col-lg-3 item-reason-content">
                            <div class="reason-content-img">
                                <img src="<?php echo $urlThemeActive;?>/asset/img/home_feature_1_img.jpg" alt="">
                            </div>

                            <div class="reason-content-title">
                                <h3>Năng lượng thuần khiết</h3>
                            </div>

                            <div class="reason-content-sub">
                                <p>Nước tăng lực Power Drink mang đến sự tăng cường vượt trội về thể chất và tinh thần, nhờ hương vị và chất lượng hoàn hảo.</p>
                            </div>
                        </div>

                        <div class="col-12 col-md-6 col-lg-3 item-reason-content">
                            <div class="reason-content-img">
                                <img src="<?php echo $urlThemeActive;?>/asset/img/home_feature_1_img.jpg" alt="">
                            </div>

                            <div class="reason-content-title">
                                <h3>Năng lượng thuần khiết</h3>
                            </div>

                            <div class="reason-content-sub">
                                <p>Nước tăng lực Power Drink mang đến sự tăng cường vượt trội về thể chất và tinh thần, nhờ hương vị và chất lượng hoàn hảo.</p>
                            </div>
                        </div>

                        <div class="col-12 col-md-6 col-lg-3 item-reason-content">
                            <div class="reason-content-img">
                                <img src="<?php echo $urlThemeActive;?>/asset/img/home_feature_1_img.jpg" alt="">
                            </div>

                            <div class="reason-content-title">
                                <h3>Năng lượng thuần khiết</h3>
                            </div>

                            <div class="reason-content-sub">
                                <p>Nước tăng lực Power Drink mang đến sự tăng cường vượt trội về thể chất và tinh thần, nhờ hương vị và chất lượng hoàn hảo.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Thành phần -->
        <section id="section-element" class="mgb-80">
            <div class="container">
                <div class="section-title">
                    <p class="title-sub">Lý do</p>
                    <h2>Chọn power drink</h2>
                </div>
                <div class="element-content">
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-4 info-element info-element-left">
                            <div class="info-element-item">
                                <div class="element-title">
                                    <h4>L-Carnitine</h4>
                                    <p>Mỗi lon Năng lượng chứa L-Carnitine, một loại axit amin tự nhiên có đặc tính chống oxy hóa hữu ích.</p>
                                </div>

                                <div class="element-image">
                                    <img src="<?php echo $urlThemeActive;?>/asset/img/home_info_1_img.jpg" alt="">
                                </div>
                            </div>

                            <div class="info-element-item">
                                <div class="element-title">
                                    <h4>L-Carnitine</h4>
                                    <p>Mỗi lon Năng lượng chứa L-Carnitine, một loại axit amin tự nhiên có đặc tính chống oxy hóa hữu ích.</p>
                                </div>

                                <div class="element-image">
                                    <img src="<?php echo $urlThemeActive;?>/asset/img/home_info_1_img.jpg" alt="">
                                </div>
                            </div>

                            <div class="info-element-item">
                                <div class="element-title">
                                    <h4>L-Carnitine</h4>
                                    <p>Mỗi lon Năng lượng chứa L-Carnitine, một loại axit amin tự nhiên có đặc tính chống oxy hóa hữu ích.</p>
                                </div>

                                <div class="element-image">
                                    <img src="<?php echo $urlThemeActive;?>/asset/img/home_info_1_img.jpg" alt="">
                                </div>
                            </div>

                            <div class="info-element-item">
                                <div class="element-title">
                                    <h4>L-Carnitine</h4>
                                    <p>Mỗi lon Năng lượng chứa L-Carnitine, một loại axit amin tự nhiên có đặc tính chống oxy hóa hữu ích.</p>
                                </div>

                                <div class="element-image">
                                    <img src="<?php echo $urlThemeActive;?>/asset/img/home_info_1_img.jpg" alt="">
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-12 col-lg-4 info-element info-element-center">
                            <img src="<?php echo $urlThemeActive;?>/asset/img/home_info_img_center.jpg" alt="">
                        </div>

                        <div class="col-12 col-md-12 col-lg-4 info-element info-element-right">
                            <div class="info-element-item">
                                <div class="element-title">
                                    <h4>L-Carnitine</h4>
                                    <p>Mỗi lon Năng lượng chứa L-Carnitine, một loại axit amin tự nhiên có đặc tính chống oxy hóa hữu ích.</p>
                                </div>

                                <div class="element-image">
                                    <img src="<?php echo $urlThemeActive;?>/asset/img/home_info_1_img.jpg" alt="">
                                </div>
                            </div>

                            <div class="info-element-item">
                                <div class="element-title">
                                    <h4>L-Carnitine</h4>
                                    <p>Mỗi lon Năng lượng chứa L-Carnitine, một loại axit amin tự nhiên có đặc tính chống oxy hóa hữu ích.</p>
                                </div>

                                <div class="element-image">
                                    <img src="<?php echo $urlThemeActive;?>/asset/img/home_info_1_img.jpg" alt="">
                                </div>
                            </div>

                            <div class="info-element-item">
                                <div class="element-title">
                                    <h4>L-Carnitine</h4>
                                    <p>Mỗi lon Năng lượng chứa L-Carnitine, một loại axit amin tự nhiên có đặc tính chống oxy hóa hữu ích.</p>
                                </div>

                                <div class="element-image">
                                    <img src="<?php echo $urlThemeActive;?>/asset/img/home_info_1_img.jpg" alt="">
                                </div>
                            </div>

                            <div class="info-element-item">
                                <div class="element-title">
                                    <h4>L-Carnitine</h4>
                                    <p>Mỗi lon Năng lượng chứa L-Carnitine, một loại axit amin tự nhiên có đặc tính chống oxy hóa hữu ích.</p>
                                </div>

                                <div class="element-image">
                                    <img src="<?php echo $urlThemeActive;?>/asset/img/home_info_1_img.jpg" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- giới thiệu trang chủ -->
        <section id="section-home-intro" class="mgb-80">
            <div class="container">
                <div class="row home-intro-left">
                    <div class="col-12 col-md-6 col-lg-6 home-intro-img">
                        <a href="">
                            <img src="<?php echo $urlThemeActive;?>/asset/img/home_banner_1_img.jpg" alt="">
                        </a>
                    </div>
                    
                    <div class="col-12 col-md-6 col-lg-6 home-intro-content">
                        <div class="home-intro-title">
                            <h3>Phong cách năng động</h3>
                        </div>
                        <div class="home-intro-sub">
                            <p>Dành cho những người có lối sống năng động - từ vận động viên đến người vận động Dành cho những người có lối sống năng động - từ vận động viên đến người vận động Dành cho những người có lối sống năng động - từ vận động viên đến người vận động</p>
                        </div>
                        <div class="home-intro-view">
                            <a href="">Xem ngay</a>
                        </div>
                    </div>
                </div>

                <div class="row home-intro-right">
                    <div class="col-12 col-md-6 col-lg-6 home-intro-content">
                        <div class="home-intro-title">
                            <h3>Phong cách năng động</h3>
                        </div>
                        <div class="home-intro-sub">
                            <p>Dành cho những người có lối sống năng động - từ vận động viên đến người vận động Dành cho những người có lối sống năng động - từ vận động viên đến người vận động Dành cho những người có lối sống năng động - từ vận động viên đến người vận động</p>
                        </div>
                        <div class="home-intro-view">
                            <a href="">Xem ngay</a>
                        </div>
                    </div>
                    
                    <div class="col-12 col-md-6 col-lg-6 home-intro-img">
                        <a href="">
                            <img src="<?php echo $urlThemeActive;?>/asset/img/home_banner_1_img.jpg" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Cấc sản phẩm -->
        <section id="section-product-tab" class="mgb-80">
            <div class="container">  
                <div class="section-title">
                    <p class="title-sub">Lý do</p>
                    <h2>Chọn power drink</h2>
                </div>
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                      <button class="nav-link active" id="pill-drink-one-tab" data-bs-toggle="pill" data-bs-target="#pill-drink-one" type="button" role="tab" aria-controls="pill-drink-one" aria-selected="true">Nước tăng lực</button>
                    </li>
                    <li class="nav-item" role="presentation">
                      <button class="nav-link" id="pill-drink-two-tab" data-bs-toggle="pill" data-bs-target="#pill-drink-two" type="button" role="tab" aria-controls="pill-drink-two" aria-selected="false">Nước ngọt, có ga</button>
                    </li>
                    <li class="nav-item" role="presentation">
                      <button class="nav-link" id="pill-drink-three-tab" data-bs-toggle="pill" data-bs-target="#pill-drink-three" type="button" role="tab" aria-controls="pill-drink-three" aria-selected="false">Nước bù khoáng</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pill-drink-four-tab" data-bs-toggle="pill" data-bs-target="#pill-drink-four" type="button" role="tab" aria-controls="pill-drink-four" aria-selected="false">Nước trái cây, nước trà</button>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pill-drink-one" role="tabpanel" aria-labelledby="pill-drink-one-tab" tabindex="0">
                        <div class="row">
                            <!-- san pham -->
                            <div class="col-lg-4 col-md-6 col-6 product-featured-item product-list-item">
                                <div class="product-featured-inner">
                                    <div class="product-featured-img">
                                        <a href=""><img src="<?php echo $urlThemeActive;?>/asset/img/prod-1-1_4163197fc0be49fc93e5487ec6ac9a44_large.jpg" alt=""></a>
                                        <img src="<?php echo $urlThemeActive;?>/asset/img/frame1_5f151d3f2bce42b99a356c60c1cf7864.jpg" alt="">
                                        <div class="item-sale">
                                            <span><i class="fa-solid fa-bolt"></i> -12%</span>
                                        </div>
                                    </div>
            
                                    <div class="product-featured-details">
                                        <div class="product-featured-title">
                                            <a href="">Drink De Energy Health & Strength</a>
                                        </div>
                                        <div class="product-featured-price">
                                            <span class="price">35.000đ</span>
                                            <span class="price-del">25.000đ</span>
                                        </div> 
                                        <div class="product-button-action">
                                            <div class="product-button-cart">
                                                <a href="" class="button-cart">
                                                    <i class="fa-solid fa-cart-shopping"></i><span>Thêm vào giỏ</span>    
                                                </a>
                                            </div>
                                        </div>
                                    </div> 
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-6 product-featured-item product-list-item">
                                <div class="product-featured-inner">
                                    <div class="product-featured-img">
                                        <a href=""><img src="<?php echo $urlThemeActive;?>/asset/img/prod-1-1_4163197fc0be49fc93e5487ec6ac9a44_large.jpg" alt=""></a>
                                        <img src="<?php echo $urlThemeActive;?>/asset/img/frame1_5f151d3f2bce42b99a356c60c1cf7864.jpg" alt="">
                                        <div class="item-sale">
                                            <span><i class="fa-solid fa-bolt"></i> -12%</span>
                                        </div>
                                    </div>
            
                                    <div class="product-featured-details">
                                        <div class="product-featured-title">
                                            <a href="">Drink De Energy Health & Strength</a>
                                        </div>
                                        <div class="product-featured-price">
                                            <span class="price">35.000đ</span>
                                            <span class="price-del">25.000đ</span>
                                        </div> 
                                        <div class="product-button-action">
                                            <div class="product-button-cart">
                                                <a href="" class="button-cart">
                                                    <i class="fa-solid fa-cart-shopping"></i><span>Thêm vào giỏ</span>    
                                                </a>
                                            </div>
                                        </div>
                                    </div> 
                                </div>
                            </div>
                            
                            <div class="col-lg-4 col-md-6 col-6 product-featured-item product-list-item">
                                <div class="product-featured-inner">
                                    <div class="product-featured-img">
                                        <a href=""><img src="<?php echo $urlThemeActive;?>/asset/img/prod-1-1_4163197fc0be49fc93e5487ec6ac9a44_large.jpg" alt=""></a>
                                        <img src="<?php echo $urlThemeActive;?>/asset/img/frame1_5f151d3f2bce42b99a356c60c1cf7864.jpg" alt="">
                                        <div class="item-sale">
                                            <span><i class="fa-solid fa-bolt"></i> -12%</span>
                                        </div>
                                    </div>
            
                                    <div class="product-featured-details">
                                        <div class="product-featured-title">
                                            <a href="">Drink De Energy Health & Strength</a>
                                        </div>
                                        <div class="product-featured-price">
                                            <span class="price">35.000đ</span>
                                            <span class="price-del">25.000đ</span>
                                        </div> 
                                        <div class="product-button-action">
                                            <div class="product-button-cart">
                                                <a href="" class="button-cart">
                                                    <i class="fa-solid fa-cart-shopping"></i><span>Thêm vào giỏ</span>    
                                                </a>
                                            </div>
                                        </div>
                                    </div> 
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-6 product-featured-item product-list-item">
                                <div class="product-featured-inner">
                                    <div class="product-featured-img">
                                        <a href=""><img src="<?php echo $urlThemeActive;?>/asset/img/prod-1-1_4163197fc0be49fc93e5487ec6ac9a44_large.jpg" alt=""></a>
                                        <img src="<?php echo $urlThemeActive;?>/asset/img/frame1_5f151d3f2bce42b99a356c60c1cf7864.jpg" alt="">
                                        <div class="item-sale">
                                            <span><i class="fa-solid fa-bolt"></i> -12%</span>
                                        </div>
                                    </div>
            
                                    <div class="product-featured-details">
                                        <div class="product-featured-title">
                                            <a href="">Drink De Energy Health & Strength</a>
                                        </div>
                                        <div class="product-featured-price">
                                            <span class="price">35.000đ</span>
                                            <span class="price-del">25.000đ</span>
                                        </div> 
                                        <div class="product-button-action">
                                            <div class="product-button-cart">
                                                <a href="" class="button-cart">
                                                    <i class="fa-solid fa-cart-shopping"></i><span>Thêm vào giỏ</span>    
                                                </a>
                                            </div>
                                        </div>
                                    </div> 
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-6 product-featured-item product-list-item">
                                <div class="product-featured-inner">
                                    <div class="product-featured-img">
                                        <a href=""><img src="<?php echo $urlThemeActive;?>/asset/img/prod-1-1_4163197fc0be49fc93e5487ec6ac9a44_large.jpg" alt=""></a>
                                        <img src="<?php echo $urlThemeActive;?>/asset/img/frame1_5f151d3f2bce42b99a356c60c1cf7864.jpg" alt="">
                                        <div class="item-sale">
                                            <span><i class="fa-solid fa-bolt"></i> -12%</span>
                                        </div>
                                    </div>
            
                                    <div class="product-featured-details">
                                        <div class="product-featured-title">
                                            <a href="">Drink De Energy Health & Strength</a>
                                        </div>
                                        <div class="product-featured-price">
                                            <span class="price">35.000đ</span>
                                            <span class="price-del">25.000đ</span>
                                        </div> 
                                        <div class="product-button-action">
                                            <div class="product-button-cart">
                                                <a href="" class="button-cart">
                                                    <i class="fa-solid fa-cart-shopping"></i><span>Thêm vào giỏ</span>    
                                                </a>
                                            </div>
                                        </div>
                                    </div> 
                                </div>
                            </div>
                            <!--  -->
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pill-drink-two" role="tabpanel" aria-labelledby="pill-drink-two-tab" tabindex="0">.1.</div>
                    <div class="tab-pane fade" id="pill-drink-three" role="tabpanel" aria-labelledby="pill-drink-three-tab" tabindex="0">.2..</div>
                    <div class="tab-pane fade" id="pill-drink-four" role="tabpanel" aria-labelledby="pill-drink-four-tab" tabindex="0">.2..</div>

                </div>
            </div>
        </section>
        

        <!-- chi tiết và đóng gói -->
        <section id="section-detailPack" class="mgb-80" >
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-6 home-detailPack-img">
                        <img src="<?php echo $urlThemeActive;?>/asset/img/home_introduce_img.jpg" alt="">
                    </div>

                    <div class="col-12 col-md-6 col-lg-6 home-detailPack-content">
                        <div class="section-title">
                            <p class="title-sub">CHI TIẾT VÀ ĐÓNG GÓI</p>
                            <h2>Nước tăng lực Power Drink</h2>
                        </div>

                        <div class="home-detailPack-content-item">
                            <div class="detailPack-img">
                                <img src="<?php echo $urlThemeActive;?>/asset/img/zyro-image.png" alt="">
                            </div>

                            <div class="detailPack-content">
                                <div class="detailPack-content-title">
                                    <h4>Đóng gói</h4>
                                </div>

                                <div class="detailPack-content-sub">
                                    <p>Không có ga chỉ với 10 calo mỗi khẩu phần. 240MG Caffein mỗi lon không ga chỉ với 10 calo mỗi khẩu phần.</p>
                                </div>
                            </div>
                        </div>

                        <div class="home-detailPack-content-item">
                            <div class="detailPack-img">
                                <img src="<?php echo $urlThemeActive;?>/asset/img/zyro-image.png" alt="">
                            </div>

                            <div class="detailPack-content">
                                <div class="detailPack-content-title">
                                    <h4>Đóng gói</h4>
                                </div>

                                <div class="detailPack-content-sub">
                                    <p>Không có ga chỉ với 10 calo mỗi khẩu phần. 240MG Caffein mỗi lon không ga chỉ với 10 calo mỗi khẩu phần.</p>
                                </div>
                            </div>
                        </div>

                        <div class="home-detailPack-content-item">
                            <div class="detailPack-img">
                                <img src="<?php echo $urlThemeActive;?>/asset/img/zyro-image.png" alt="">
                            </div>

                            <div class="detailPack-content">
                                <div class="detailPack-content-title">
                                    <h4>Đóng gói</h4>
                                </div>

                                <div class="detailPack-content-sub">
                                    <p>Không có ga chỉ với 10 calo mỗi khẩu phần. 240MG Caffein mỗi lon không ga chỉ với 10 calo mỗi khẩu phần.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- sản phẩm chính hãng -->
        <section id="section-product-featured" class="mgb-80">
            <div class="container">
                <div class="section-title">
                    <p class="title-sub">Sản phẩm nổi bật</p>
                    <h2>NHÃN HÀNG RIÊNG CỦA CHÚNG TÔI</h2>
                </div>

                <div class="product-featured-slide">
                    <div class="product-featured-item">
                        <div class="product-featured-inner">
                            <div class="product-featured-img">
                                <a href=""><img src="<?php echo $urlThemeActive;?>/asset/img/prod-1-1_4163197fc0be49fc93e5487ec6ac9a44_large.jpg" alt=""></a>
                                <img src="<?php echo $urlThemeActive;?>/asset/img/frame1_5f151d3f2bce42b99a356c60c1cf7864.jpg" alt="">
                                <div class="item-sale">
                                    <span><i class="fa-solid fa-bolt"></i> -12%</span>
                                </div>
                            </div>

                            <div class="product-featured-details">
                                <div class="product-featured-title">
                                    <a href="">Drink De Energy Health & Strength</a>
                                </div>
                                <div class="product-featured-price">
                                    <span class="price">35.000đ</span>
                                    <span class="price-del">25.000đ</span>
                                </div> 
                                <div class="product-button-action">
                                    <div class="product-button-cart">
                                        <a href="" class="button-cart">
                                            <i class="fa-solid fa-cart-shopping"></i><span>Thêm vào giỏ</span>    
                                        </a>
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div>

                    <div class="product-featured-item">
                        <div class="product-featured-inner">
                            <div class="product-featured-img">
                                <a href=""><img src="<?php echo $urlThemeActive;?>/asset/img/prod-1-1_4163197fc0be49fc93e5487ec6ac9a44_large.jpg" alt=""></a>
                                <img src="<?php echo $urlThemeActive;?>/asset/img/frame1_5f151d3f2bce42b99a356c60c1cf7864.jpg" alt="">
                                <div class="item-sale">
                                    <span><i class="fa-solid fa-bolt"></i> -12%</span>
                                </div>
                            </div>

                            <div class="product-featured-details">
                                <div class="product-featured-title">
                                    <a href="">Drink De Energy Health & Strength</a>
                                </div>
                                <div class="product-featured-price">
                                    <span class="price">35.000đ</span>
                                    <span class="price-del">25.000đ</span>
                                </div> 
                                <div class="product-button-action">
                                    <div class="product-button-cart">
                                        <a href="" class="button-cart">
                                            <i class="fa-solid fa-cart-shopping"></i><span>Thêm vào giỏ</span>    
                                        </a>
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div>

                    <div class="product-featured-item">
                        <div class="product-featured-inner">
                            <div class="product-featured-img">
                                <a href=""><img src="<?php echo $urlThemeActive;?>/asset/img/prod-1-1_4163197fc0be49fc93e5487ec6ac9a44_large.jpg" alt=""></a>
                                <img src="<?php echo $urlThemeActive;?>/asset/img/frame1_5f151d3f2bce42b99a356c60c1cf7864.jpg" alt="">
                                <div class="item-sale">
                                    <span><i class="fa-solid fa-bolt"></i> -12%</span>
                                </div>
                            </div>

                            <div class="product-featured-details">
                                <div class="product-featured-title">
                                    <a href="">Drink De Energy Health & Strength</a>
                                </div>
                                <div class="product-featured-price">
                                    <span class="price">35.000đ</span>
                                    <span class="price-del">25.000đ</span>
                                </div> 
                                <div class="product-button-action">
                                    <div class="product-button-cart">
                                        <a href="" class="button-cart">
                                            <i class="fa-solid fa-cart-shopping"></i><span>Thêm vào giỏ</span>    
                                        </a>
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div>

                    <div class="product-featured-item">
                        <div class="product-featured-inner">
                            <div class="product-featured-img">
                                <a href=""><img src="<?php echo $urlThemeActive;?>/asset/img/prod-1-1_4163197fc0be49fc93e5487ec6ac9a44_large.jpg" alt=""></a>
                                <img src="<?php echo $urlThemeActive;?>/asset/img/frame1_5f151d3f2bce42b99a356c60c1cf7864.jpg" alt="">
                                <div class="item-sale">
                                    <span><i class="fa-solid fa-bolt"></i> -12%</span>
                                </div>
                            </div>

                            <div class="product-featured-details">
                                <div class="product-featured-title">
                                    <a href="">Drink De Energy Health & Strength</a>
                                </div>
                                <div class="product-featured-price">
                                    <span class="price">35.000đ</span>
                                    <span class="price-del">25.000đ</span>
                                </div> 
                                <div class="product-button-action">
                                    <div class="product-button-cart">
                                        <a href="" class="button-cart">
                                            <i class="fa-solid fa-cart-shopping"></i><span>Thêm vào giỏ</span>    
                                        </a>
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div>

                    <div class="product-featured-item">
                        <div class="product-featured-inner">
                            <div class="product-featured-img">
                                <a href=""><img src="<?php echo $urlThemeActive;?>/asset/img/prod-1-1_4163197fc0be49fc93e5487ec6ac9a44_large.jpg" alt=""></a>
                                <img src="<?php echo $urlThemeActive;?>/asset/img/frame1_5f151d3f2bce42b99a356c60c1cf7864.jpg" alt="">
                                <div class="item-sale">
                                    <span><i class="fa-solid fa-bolt"></i> -12%</span>
                                </div>
                            </div>

                            <div class="product-featured-details">
                                <div class="product-featured-title">
                                    <a href="">Drink De Energy Health & Strength</a>
                                </div>
                                <div class="product-featured-price">
                                    <span class="price">35.000đ</span>
                                    <span class="price-del">25.000đ</span>
                                </div> 
                                <div class="product-button-action">
                                    <div class="product-button-cart">
                                        <a href="" class="button-cart">
                                            <i class="fa-solid fa-cart-shopping"></i><span>Thêm vào giỏ</span>    
                                        </a>
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div>

                   
                </div>
            </div>
        </section>

        <!-- Bài viết mới nhất -->
        <section id="section-news-post" class="mgb-80">
            <div class="container">
                <div class="section-title">
                    <h2><a href="">Bài viết mới nhất</a></h2>
                </div>

                <div class="slide-home-news" class="mgb-80">
                    <div class="home-news-item">
                        <div class="news-item-img">
                            <a href="#"><img src="<?php echo $urlThemeActive;?>/asset/img/blog-03_aa8f0852fe834a8993c0ea1013943516_large.jpg" alt=""></a>
                        </div>

                        <div class="news-item-details">
                            <div class="news-item-title">
                                <h3><a href="">3 quy tắc dinh dưỡng hàng đầu sẽ thúc đẩy quá trình tập luyện của bạn</a></h3>
                            </div>

                            <div class="news-item-sub">
                               Đây là trang blog của cửa hàng. Bạn có thể dùng blog để quảng bá sản phẩm mới, chia sẻ trải nghiệm của khách hàng,...</p>
                            </div>

                            <div class="news-item-meta">
                                <div class="news-item-date">
                                    <p>14 Tháng 02, 2023</p>
                                </div>
                                <a href="">Xem thêm</a>
                            </div>
                        </div>
                    </div>

                    <div class="home-news-item">
                        <div class="news-item-img">
                            <a href="#"><img src="<?php echo $urlThemeActive;?>/asset/img/blog-03_aa8f0852fe834a8993c0ea1013943516_large.jpg" alt=""></a>
                        </div>

                        <div class="news-item-details">
                            <div class="news-item-title">
                                <h3><a href="">3 quy tắc dinh dưỡng hàng đầu sẽ thúc đẩy quá trình tập luyện của bạn</a></h3>
                            </div>

                            <div class="news-item-sub">
                                <p>Đây là trang blog của cửa hàng. Bạn có thể dùng blog để quảng bá sản phẩm mới, chia sẻ trải nghiệm của khách hàng,...</p>
                            </div>

                            <div class="news-item-meta">
                                <div class="news-item-date">
                                    <p>14 Tháng 02, 2023</p>
                                </div>
                                <a href="">Xem thêm</a>
                            </div>
                        </div>
                    </div>

                    <div class="home-news-item">
                        <div class="news-item-img">
                            <a href="#"><img src="<?php echo $urlThemeActive;?>/asset/img/blog-03_aa8f0852fe834a8993c0ea1013943516_large.jpg" alt=""></a>
                        </div>

                        <div class="news-item-details">
                            <div class="news-item-title">
                                <h3><a href="">3 quy tắc dinh dưỡng hàng đầu sẽ thúc đẩy quá trình tập luyện của bạn</a></h3>
                            </div>

                            <div class="news-item-sub">
                                <p>Đây là trang blog của cửa hàng. Bạn có thể dùng blog để quảng bá sản phẩm mới, chia sẻ trải nghiệm của khách hàng,...</p>
                            </div>

                            <div class="news-item-meta">
                                <div class="news-item-date">
                                    <p>14 Tháng 02, 2023</p>
                                </div>
                                <a href="">Xem thêm</a>
                            </div>
                        </div>
                    </div>

                    <div class="home-news-item">
                        <div class="news-item-img">
                            <a href="#"><img src="<?php echo $urlThemeActive;?>/asset/img/blog-03_aa8f0852fe834a8993c0ea1013943516_large.jpg" alt=""></a>
                        </div>

                        <div class="news-item-details">
                            <div class="news-item-title">
                                <h3><a href="">3 quy tắc dinh dưỡng hàng đầu sẽ thúc đẩy quá trình tập luyện của bạn</a></h3>
                            </div>

                            <div class="news-item-sub">
                                <p>Đây là trang blog của cửa hàng. Bạn có thể dùng blog để quảng bá sản phẩm mới, chia sẻ trải nghiệm của khách hàng,...</p>
                            </div>

                            <div class="news-item-meta">
                                <div class="news-item-date">
                                    <p>14 Tháng 02, 2023</p>
                                </div>
                                <a href="">Xem thêm</a>
                            </div>
                        </div>
                    </div>

                    <div class="home-news-item">
                        <div class="news-item-img">
                            <a href="#"><img src="<?php echo $urlThemeActive;?>/asset/img/Anime-Nature-4K-Wallpapers.jpg" alt=""></a>
                        </div>

                        <div class="news-item-details">
                            <div class="news-item-title">
                                <h3><a href="">3 quy tắc dinh dưỡng hàng đầu sẽ thúc đẩy quá trình tập luyện của bạn</a></h3>
                            </div>

                            <div class="news-item-sub">
                                <p>Đây là trang blog của cửa hàng. Bạn có thể dùng blog để quảng bá sản phẩm mới, chia sẻ trải nghiệm của khách hàng,...</p>
                            </div>

                            <div class="news-item-meta">
                                <div class="news-item-date">
                                    <p>14 Tháng 02, 2023</p>
                                </div>
                                <a href="">Xem thêm</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Gửi thư thông báo -->
        <section id="section-newsletter">
            <div class="container">
                <div class="section-title">
                    <p class="title-sub">Lý do</p>
                    <h2>Chọn power drink</h2>
                </div>
                <form action="">
                    <div class="form-group">
                        <span class="icon-email"><i class="fa-regular fa-envelope"></i></span>
                        <input type="gmail" placeholder="Nhập email của bạn">
                        <span class="newsletter-box">
                            <button type="submit" class="newsletter-button">
                                Đăng ký
                            </button>
                        </span>
                    </div>
                </form>
            </div>
        </section>
    </main>

    <!-- footer -->
    <footer>
        <section id="main-footer">
            <div class="container">
                <div class="row">
                    <div class="col-xl-3 col-lg-6 col-md-12 col-12 footer-item">
                        <div class="footer-title">
                            <h2>Về Mode Fashion</h2>
                        </div>
                        <div class="footer-content-info">
                            <p>Với các giải pháp công nghệ tốt nhất, Haravan là tất cả những gì bạn cần để xây dựng thương hiệu online, thành công trong bán lẻ và marketing đột phá.</p>
                            <div class="footer-social">
                                <ul>
                                    <li>
                                        <a href=""><i class="fa-brands fa-facebook-f"></i></a>
                                    </li>
                                    <li>
                                        <a href=""><i class="fa-brands fa-twitter"></i></a>
                                    </li>
                                    <li>
                                        <a href=""><i class="fa-brands fa-instagram"></i></a>
                                    </li>
                                    <li>
                                        <a href=""><i class="fa-brands fa-tiktok"></i></a>
                                    </li>
                                    <li>
                                        <a href=""><i class="fa-brands fa-youtube"></i></a>
                                    </li>
                                </ul>
                            </div>

                            <div class="footer-payment">
                                <div class="payment-title">
                                    <p>Phương thức thanh toán</p>
                                </div>
                                <ul class="payment-icon">
                                    <li><img src="<?php echo $urlThemeActive;?>/asset/img/payment_1_img.jpg" alt=""></li>
                                    <li><img src="<?php echo $urlThemeActive;?>/asset/img/payment_2_img.jpg" alt=""></li>
                                    <li><img src="<?php echo $urlThemeActive;?>/asset/img/payment_3_img.jpg" alt=""></li>
                                    <li><img src="<?php echo $urlThemeActive;?>/asset/img/payment_4_img.jpg" alt=""></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-12 col-12 footer-item">
                        <div class="footer-title">
                            <h2>Thông tin liên hệ</h2>
                        </div>

                        <div class="footer-address">
                            <ul>
                                <li>
                                    <p><span>Địa chỉ: </span> Tầng 4, tòa nhà Flemington, số 182, đường Lê Đại Hành, phường 15, quận 11, Tp. Hồ Chí Minh.</p>
                                </li>
                                <li>
                                    <p><span>Điện thoại: </span> 0367977132</p>
                                </li>
                                <li>
                                    <p><span>Fax: </span>1900.636.000</p>
                                </li>
                                <li>
                                    <p><span>Email: </span>hi@powerdrink.com</p>
                                </li>
                            </ul>
                            
                            <div class="footer-payment">
                                <div class="payment-title">
                                    <p>Phương thức thanh toán</p>
                                </div>
                                <ul class="payment-icon">
                                    <li><img src="<?php echo $urlThemeActive;?>/asset/img/shipment_1_img.jpg" alt=""></li>
                                    <li><img src="<?php echo $urlThemeActive;?>/asset/img/shipment_2_img.jpg" alt=""></li>
                                    <li><img src="<?php echo $urlThemeActive;?>/asset/img/shipment_3_img.jpg" alt=""></li>
                                    <li><img src="<?php echo $urlThemeActive;?>/asset/img/shipment_4_img.jpg" alt=""></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-6 col-md-12 col-12 footer-item">
                        <div class="footer-title">
                            <h2>Thông tin liên hệ</h2>
                        </div>

                        <div class="footer-group-link">
                            <ul>
                                <li>
                                    <a href="">Sản phẩm khuyến mãi</a>
                                </li>
                                <li>
                                    <a href="">Sản phẩm nổi bật</a>
                                </li>
                                <li>
                                    <a href="">Tất cả sản phẩm</a>
                                </li>
                                <li>
                                    <a href="">FAQs - Câu hỏi thường gặp</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-6 col-md-12 col-12 footer-item">
                        <div class="footer-title">
                            <h2>Thông tin liên hệ</h2>
                        </div>

                        <div class="footer-group-link">
                            <ul>
                                <li>
                                    <a href="">Tìm kiếm</a>
                                </li>
                                <li>
                                    <a href="">Giới thiệu</a>
                                </li>
                                <li>
                                    <a href="">Chính sách đổi trả</a>
                                </li>
                                <li>
                                    <a href="">Chính sách bảo mật</a>
                                </li>
                                <li>
                                    <a href="">Điều khoản dịch vụ</a>
                                </li>
                                <li>
                                    <a href="">Liên hệ</a>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
       

        <section id="footer-copyright">
            <div class="container">
                <p>Copyright © 2023 Power Drink. Powered by Haravan</p>
            </div>
        </section>
    </footer>

    <!-- slick -->
    <script src="<?php echo $urlThemeActive;?>/asset/js/main.js"></script>
    <script src="<?php echo $urlThemeActive;?>/asset/js/slick.js"></script>
</body>
</html>