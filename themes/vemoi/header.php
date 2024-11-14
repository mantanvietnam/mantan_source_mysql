<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo $urlThemeActive;?>/asset/css/create.css?time=1191"> 
    <link rel="stylesheet" href="<?php echo $urlThemeActive;?>/asset/css/cssplus.css?time=1209">
    <link rel="stylesheet" href="<?php echo $urlThemeActive;?>/asset/css/home.css?time=1189">
    <link rel="stylesheet" href="<?php echo $urlThemeActive;?>/asset/css/register.css?time=1191">
    <link rel="stylesheet" href="<?php echo $urlThemeActive;?>/asset/css/create-event.css?time=1193">
    <link rel="stylesheet" href="<?php echo $urlThemeActive;?>/asset/css/successfully.css?time=1192">
    <link rel="stylesheet" href="<?php echo $urlThemeActive;?>/asset/css/detail.css?time=1191">
    <link rel="stylesheet" href="<?php echo $urlThemeActive;?>/asset/css/edit.css?time=1191">
    <link rel="stylesheet" href="<?php echo $urlThemeActive;?>/asset/css/event.css?time=1191">
    <link rel="stylesheet" href="<?php echo $urlThemeActive;?>/asset/css/manage-event-mobile.css?time=1191">
    <link rel="stylesheet" href="<?php echo $urlThemeActive;?>/asset/css/manage-event.css?time=1191">
    <link rel="stylesheet" href="<?php echo $urlThemeActive;?>/asset/css/my-event.css?time=1191">
    <link rel="stylesheet" href="<?php echo $urlThemeActive;?>/asset/css/my-ticket.css?time=1191">
    <link rel="stylesheet" href="<?php echo $urlThemeActive;?>/asset/css/no-event.css?time=1191">
    <link rel="stylesheet" href="<?php echo $urlThemeActive;?>/asset/css/registerto.css?time=1191">
    <link rel="stylesheet" href="<?php echo $urlThemeActive;?>/asset/js/vemoi.js">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Slick Carousel CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
     <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/9163bded0f.js" crossorigin="anonymous"></script>

    <link rel="icon" sizes="16x16" href="<?= $urlThemeActive?>/asset/image/Logo.png" type="image/png">
    <link rel="icon" sizes="32x32" href="<?= $urlThemeActive?>/asset/image/Logo.png" type="image/png">
    <link rel="icon" sizes="48x48" href="<?= $urlThemeActive?>/asset/image/Logo.png" type="image/png">
    <!-- Google Fonts -->   
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <?php mantan_header();
    global $settingThemes;
    global $session;
$infoUser = $session->read('infoUser');
    ?>
</head>
<body>
<header>

        <nav class="navbar navbar-expand-lg navbar-light bg-white border-0">
            <div class="container-fluid">

                <div class="logo">
                    <a class="navbar-brand d-flex align-items-center" href="/">
                        <img src="<?= @$settingThemes['logo'];?>" alt="">
                    </a>
                </div>
                <div class="btn-login">
                    <div class="d-flex align-items-center">
                        <a href="/createevent" class="btn btn-danger mx-4">+ Tạo sự kiện</a>
                    </div>
                </div>
                <button style="margin-right: 20px;" class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse nv-menu" id="navbarNav">
                    <ul class="navbar-nav">
                        <?php  
                        $menus = getMenusDefault();  
                        if (!empty($menus)):  
                            foreach ($menus as $categoryMenu):  
                                if (!empty($categoryMenu['sub'])):  
                        ?>
                            <li class="nav-item dropdown mx2">
                                <a class="nav-link dropdown-toggle text-dark" href="" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <?php echo $categoryMenu['name']; ?>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <?php foreach ($categoryMenu['sub'] as $subMenu): ?>
                                    <li><a class="dropdown-item" href="<?php echo $subMenu['link']; ?>"><?php echo $subMenu['name']; ?></a></li>
                                <?php endforeach; ?>
                                </ul>
                            </li>
                        <?php 
                                else:  
                        ?>       
                            <li class="nav-item mx2">
                                <a class="nav-link text-dark" href="<?php echo $categoryMenu['link']; ?>"><?php echo $categoryMenu['name']; ?></a>
                            </li>   
                        <?php 
                                    endif;  
                                endforeach;  
                            endif;  
                        ?>   
                        </ul>
                        <?php if (empty($infoUser)): ?>
                            <div class="btn-login__login">
                                <div class="d-flex colum">
                                    <a href="/login"><button class="btn btn-outline-dark me-2">Đăng nhập</button></a>
                                    <a href="/register"><button class="btn btn-danger px-4">Đăng ký</button></a>
                                </div>
                            </div>
                        <?php else: ?>
                            <li class="nav-item dropdown mx2">
                                <a class="nav-link dropdown-toggle text-dark" href="#" id="navbarDropdown4" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Thông tin cá nhân
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown4">
                                    <li><a class="dropdown-item" href="/myevent">Sự kiện của tôi</a></li>
                                    <li><a class="dropdown-item" href="/account">Đổi thông tin</a></li>
                                    <li><a class="dropdown-item" href="/changePass">Đổi mật khẩu</a></li>
                                    <li><a class="dropdown-item" href="/logout">Đăng xuất</a></li>
                                </ul>
                            </li>
                        <?php endif; ?>
                    </div>
                    <div class="btn-add-event">
                        <div class="d-flex align-items-center">
                            <?php if (!empty($infoUser)): ?>
                                <a href="/createevent" class="btn btn-danger">+ Tạo sự kiện</a>

                                <div class="nav-item dropdown mx-5">
                                    <a href="#" class="nav-link p-0 dropdown-toggle" id="navbarDropdown-4" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <img src="<?=$urlThemeActive?>/asset/image/red.jpg" style="border: 1px solid black; height: 37px; width: 37px; border-radius: 10px; object-fit: unset;" alt="User image">
                                    </a>
                                    <ul class="dropdown-menu custom-dropdown-menu" aria-labelledby="navbarDropdown-4">
                                        <li><a class="dropdown-item" href="/myevent">Sự kiện của tôi</a></li>
                                        <li><a class="dropdown-item" href="/account">Đổi thông tin</a></li>
                                        <li><a class="dropdown-item" href="/changePass">Đổi mật khẩu</a></li>
                                        <li><a class="dropdown-item" href="/logout">Đăng xuất</a></li>
                                    </ul>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>