<!DOCTYPE html>
<html lang="vi">

<head>
    <?php mantan_header();?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $metaTitleMantan;?></title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="<?php echo $urlThemeActive;?>/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.1/font/bootstrap-icons.css">
    <!-- Lib -->
    <!-- Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Barlow:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Slick Slider -->
    <link rel="stylesheet" type="text/css" href="<?php echo $urlThemeActive;?>/css/slick.css" />
    <link rel="stylesheet" href="<?php echo $urlThemeActive;?>/css/slick-theme.css">


    <!-- Fa6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Main CSS -->
    <link rel="stylesheet" href="<?php echo $urlThemeActive;?>/css/main.css">

    <script src="<?php echo $urlThemeActive;?>/assets/js/jquery.js"></script>
    <script src="<?php echo $urlThemeActive;?>/assets/js/bootstrap.bundle.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="<?php echo $urlThemeActive;?>/assets/js/slick.min.js"></script>
    <script src="<?php echo $urlThemeActive;?>/assets/js/forLib.js"></script>
</head>

<body>
    <!-- Header (Navbar) ------------------------------------------------------------------------->
    <header class="dark">
        <nav class="navbar navbar-expand-lg navbar-light container">
            <div class="container-fluid">
                <a class="navbar-brand py-0" href="/">
                    <div class="brand-contain d-flex flex-column align-items-center">
                        <div class="brand-logo">
                            <img src="<?php echo $setting_value['logo'];?>" alt="">
                        </div>
                    </div>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
                    aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="bi bi-list"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarText">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 mx-auto">
                        <li class="nav-item active">
                            <a class="nav-link active" aria-current="page" href="#">Trang chủ</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="#">Khóa học</a>
                            <ul class="lv-1">
                                <li>
                                    <a href="nav-link" href="#">Menu lv2</a>
                                </li>
                                <li>
                                    <a href="nav-link" href="#">Menu lv2</a>
                                </li>
                                <li>
                                    <a href="nav-link" href="#">Menu lv2</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="#">Tin tức - Sự kiện</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="#">Cơ hội hợp tác</a>
                        </li>
                    </ul>
                    <div class="d-flex align-items-center form-active-btn user-login-success">
                        <?php 
                        if(empty($session->read('infoUser'))){
                            echo '  <a href="/login" class="">
                                        <button class="btn">Đăng nhập</button>
                                    </a>
                                    <a href="/register" class="">
                                        <button class="btn">Đăng ký</button>
                                    </a>';
                        }else{
                            $infoUser = $session->read('infoUser');
                            echo '<div class="position-relative ta-opacity-1 d-flex align-items-center">
                                    <p class="mb-0">
                                        <a class="d-flex align-items-center">
                                            <span class="me-2">'.$infoUser->full_name.'</span>
                                            <img src="'.$infoUser->avatar.'" alt="'.$infoUser->full_name.'">
                                        </a>
                                    </p>
                                    <div class="position-absolute end-0 top-100 mt-3 login-nav" style="width: 210px;">
                                        <div class="card card-body ta-opacity-0">
                                            <a href="/courses-favourite">Khóa học yêu thích</a>
                                            <a href="/history-test">Lịch sử thi</a>
                                            <a href="/profile">Thông tin cá nhân</a>
                                            <a class="text-danger" href="/logout">Đăng xuất</a>
                                        </div>
                                    </div>
                                </div>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <!-- End Header---------------------------------------------------------------------------- -->
