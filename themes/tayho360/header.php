<?php
global $urlThemeActive;
include_once("helper.php");
$setting= setting();
 global $session;
    $infoUser = $session->read('infoUser');
?>

<!doctype html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- FONTAWESOME 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
          integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>

    <!-- FILE INCLUDE CSS -->
    <link rel="stylesheet" href="<?= $urlThemeActive ?>assets/css/bootstrap.css">
    <link rel="stylesheet" href="<?= $urlThemeActive ?>assets/css/slick.css">
    <link rel="stylesheet" href="<?= $urlThemeActive ?>assets/css/slick-theme.css">

    <link rel="stylesheet" href="<?= $urlThemeActive ?>css/header.css">
    <link rel="stylesheet" href="<?= $urlThemeActive ?>css/footer.css">
    <link rel="stylesheet" href="<?= $urlThemeActive ?>css/particle.css">
    <link rel="stylesheet" href="<?= $urlThemeActive ?>css/style.css">
    <link rel="stylesheet" href="<?= $urlThemeActive ?>css/thaianh.css">
    <link rel="stylesheet" href="<?= $urlThemeActive ?>css/main.css">
    <link rel="stylesheet" href="<?= $urlThemeActive ?>css/font.css">
    <!-- FILE INCLUDE CSS END -->


    <!-- FILE INCLUDE JS -->

    <!-- MAP JS API -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
          integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
            integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>

    <script src="<?= $urlThemeActive ?>assets/js/jquery.js"></script>
    <script src="<?= $urlThemeActive ?>assets/js/bootstrap.bundle.js"></script>
    <script src="<?= $urlThemeActive ?>assets/js/slick.min.js"></script>

    <script src="<?= $urlThemeActive ?>js/jshieu.js"></script>
    <script src="<?= $urlThemeActive ?>js/slickslide.js"></script>
    <script src="<?= $urlThemeActive ?>assets/js/main.js"></script>
    <!-- FILE INCLUDE JS END -->
 <?php mantan_header();?>


</head>
<body>

<header>
    <div class="top bg-primary-cus py-2">
        <div class="container">
            <div class="d-flex justify-content-end align-items-center">
                <form class="search-input d-none d-md-block">
                    <img src="<?= $urlThemeActive ?>/assets/lou_icon/icon-search.svg" class="me-2" alt="">
                    <input type="text" placeholder="Tìm kiếm">
                </form>
                <li class="nav-item dropdown user-login">
                     <?php if(!empty($infoUser)){ ?>
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button"
                       data-bs-toggle="dropdown">
                        <img src="<?php echo @$infoUser['avatar']; ?>" style=" width: 25px; border-radius: 20px;" alt="">
                        <span class="username">Xin chào <?php echo $infoUser['full_name']; ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Hành trình</a></li>
                        <li><a class="dropdown-item" href="#">Đặt phòng</a></li>
                        <li><a class="dropdown-item" href="#">Yêu thích</a></li>
                        <li><a class="dropdown-item" href="#">Thông báo</a></li>
                        <li><a class="dropdown-item" href="#">Tài khoản</a></li>
                        <li><a class="dropdown-item " href="/logout">Đăng xuất</a></li>
                    </ul>
                    <?php }else{ ?>
                       <a class="nav-link dropdown-toggle d-flex align-items-center" style=" color: white; " href="/login">Đăng Nhập</a>
                    <?php } ?>
                </li>
                <!-- <a href="" class="sign btn">Đăng ký / Đăng nhập</a> -->
                <a href="" class="lang d-block">
                    <img src="<?= $urlThemeActive ?>assets/lou_icon/lang-vn.svg" alt="">
                </a>
                <a href="" class="lang d-block">
                    <img src="<?= $urlThemeActive ?>assets/lou_icon/lang-en.svg" alt="">
                </a>
            </div>
        </div>
    </div>
    <div class="main-nav">
        <div class="container-xxl">
            <nav class="navbar navbar-expand-xxl">
                <div class="container-fluid">
                    <a class="navbar-brand d-block" href="/">
                        <img src="<?php echo @$setting['image_logo'];?>" style=" width: 55px; " alt="">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="/">TRANG CHỦ</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                   aria-expanded="false">
                                    ĐIỂM ĐẾN
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Di tích văn hóa</a></li>
                                    <li><a class="dropdown-item" href="#">Danh lam</a></li>
                                    <li><a class="dropdown-item" href="#">Làng nghề</a></li>
                                    <li><a class="dropdown-item" href="#">Lễ hội</a></li>
                                    <li><a class="dropdown-item" href="#">Trụ sở cơ quan chính</a></li>
                                    <li><a class="dropdown-item" href="#">Trung tâm hội nghị, sự kiện</a></li>
                                    <li><a class="dropdown-item" href="#">Khách sạn</a></li>
                                    <li><a class="dropdown-item" href="#">Nhà hàng quán ăn</a></li>
                                    <li><a class="dropdown-item" href="#">Dịch vụ hỗ trợ du lịch</a></li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">SỰ KIỆN</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                   aria-expanded="false">
                                    CẨM NANG DU LỊCH
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Cẩm nang 1</a></li>
                                    <li><a class="dropdown-item" href="#">Cẩm nang 2</a></li>
                                    <li><a class="dropdown-item" href="#">Cẩm nang khác</a></li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">TIN TỨC</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">TOUR DU LỊCH</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">BẢN ĐỒ</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">VIỆT NAM 360</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</header>










