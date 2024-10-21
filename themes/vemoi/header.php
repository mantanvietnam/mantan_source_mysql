<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="<?php echo $urlThemeActive;?>/asset/css/home.css">
    <link rel="stylesheet" href="<?php echo $urlThemeActive;?>/asset/css/cssplus.css">
    <link rel="stylesheet" href="<?php echo $urlThemeActive;?>/asset/js/vemoi.js">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Slick Carousel CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
     <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/9163bded0f.js" crossorigin="anonymous"></script>

    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <?php mantan_header();?>
</head>
<body>
    <header>
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-white border-0">
            <div class="container-fluid">
                <!-- Logo -->
                <div class="logo">
                    <a class="navbar-brand d-flex align-items-center" href="#">
                        <img src="<?php echo $urlThemeActive;?>/asset/image/Logo.png">
                    </a>
                </div>

                <!-- Toggle button for mobile view -->
                <button style="margin-right: 20px;" class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Navbar Menu -->
                    <div class="collapse navbar-collapse nv-menu" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item mx2">
                                <a class="nav-link active" href="#">Trang chủ</a>
                            </li>
                            <li class="nav-item mx2">
                                <a class="nav-link text-dark" href="#">Giới thiệu</a>
                            </li>
                            <li class="nav-item dropdown mx2">
                                <a class="nav-link dropdown-toggle text-dark" href="./event.html" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Sự kiện
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="./event.html">Sự kiện của tôi</a></li>
                                    <li><a class="dropdown-item" href="#">Sự kiện 2</a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown mx2">
                                <a class="nav-link dropdown-toggle text-dark" href="#" id="navbarDropdown2" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Dịch vụ
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown2">
                                    <li><a class="dropdown-item" href="#">Dịch vụ 1</a></li>
                                    <li><a class="dropdown-item" href="#">Dịch vụ 2</a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown mx2">
                                <a class="nav-link dropdown-toggle text-dark" href="#" id="navbarDropdown3" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Tin tức
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown3">
                                    <li><a class="dropdown-item" href="#">Tin tức 1</a></li>
                                    <li><a class="dropdown-item" href="#">Tin tức 2</a></li>
                                </ul>
                            </li>
                            <li class="nav-item mx2">
                                <a class="nav-link text-dark" href="#">Liên hệ</a>
                            </li>
                        </ul>
                        <div class="btn-login">
                            <div class="d-flex colum">
                                <a href="/login"><button class="btn btn-outline-dark me-2">Đăng nhập</button></a>
                                <a href="/register"><button class="btn btn-danger px-4">Đăng ký</button></a>
                            </div>
                       </div>
                    </div>

                <!-- Login and Register Buttons -->
               
            </div>
        </nav>
        
    </header>