<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
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

    <?php 
        mantan_header(); 

        if(function_exists('showSeoHome')) showSeoHome();
    ?>
</head>
<body>
    <header>
        <section id="topbar">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-12 topbar-item-left d-flex">
                        <div class="header-hotline">
                            <p>Hotline: <a href="tel:<?php echo $contactSite['phone'];?>"><?php echo $contactSite['phone'];?> </a>(<?php echo $settingThemes['time_open'];?>) </p>
                        </div>
                        <div class="link-hotline">
                            <a href="/contact">Liên hệ</a>
                        </div>
                    </div>
        
                    <div class="col-lg-6 col-md-6 col-12 topbar-item-right">
                        <div class="notify-box">
                            <div class="icon-notificaiton">
                                <span>0</span>
                                <i class="fa-solid fa-bell"></i>
                            </div>
                            <p>Giỏ hàng</p> 
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="section-overlay"></section>

        <section id="header-menu">
            <nav class="navbar navbar-expand-lg">
                <div class="container-fluid">
                    <a class="navbar-brand" href="/"><?php echo $settingThemes['name_web'];?></a>
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