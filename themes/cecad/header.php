<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CECAD</title>
    <link rel="stylesheet" href="<?= $urlThemeActive?>/asset/css/footer.css?time=00000">
    <link rel="stylesheet" href="<?= $urlThemeActive?>/asset/css/header.css?time=326041">
    <link rel="stylesheet" href="<?= $urlThemeActive?>/asset/css/main-plus.css?time=326161012">
    <link rel="stylesheet" href="<?= $urlThemeActive?>/asset/css/main-hoang.css?time=654006">
    <!-- Slick Carousel CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <!--  fancybox css-->
    <link rel="icon" sizes="16x16" href="<?= $urlThemeActive?>/asset/images/logo.png" type="image/png">
    <link rel="icon" sizes="32x32" href="<?= $urlThemeActive?>/asset/images/logo.png" type="image/png">
    <link rel="icon" sizes="48x48" href="<?= $urlThemeActive?>/asset/images/logo.png" type="image/png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/9163bded0f.js" crossorigin="anonymous"></script>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <?php 
        mantan_header();
        global $settingThemes;
    ?>
</head>

<body>
    <header>
        <div class="container">
            <nav class="navbar navbar-expand-lg bg-body-tertiary menu">
                <div class="container-fluid">
                    <a class="navbar-brand" href="/">
                        <img src="<?= @$settingThemes['logo'];?>" alt="">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>
                    <div class="collapse navbar-collapse" id="navbarNavDropdown">
                        <ul class="navbar-nav">
                        <?php  
                            $menus = getMenusDefault();  
                            if (!empty($menus)):  
                                foreach ($menus as $categoryMenu):  
                                    if (!empty($categoryMenu['sub'])):  
                        ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link" aria-current="page" role="button" data-bs-toggle="dropdown" aria-expanded="false" href="#">
                                    <?php echo $categoryMenu['name']; ?><i class="fa-solid fa-angle-down"></i>
                                </a>
                                <div class="abs-dropdown dropdown-menu-1">
                                    <ul class="dropdown-menu ">
                                    <?php foreach ($categoryMenu['sub'] as $subMenu): ?>
                                        <li><a class="dropdown-item" href="<?php echo $subMenu['link']; ?>"><?php echo $subMenu['name']; ?></a></li>
                                    <?php endforeach; ?>
                                    </ul>
                                </div>
                            </li>
                        <?php 
                            else:  
                        ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo $categoryMenu['link']; ?>"><?php echo $categoryMenu['name']; ?></a>
                            </li>
                            <?php 
                                    endif;  
                                endforeach;  
                            endif;  
                        ?>  
                            <li class="nav-item dropdown ">
                                <a class="nav-link language" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="<?=$urlThemeActive?>asset/images/vn.png" alt="">
                                    <p>Tiếng Việt <i class="fa-solid fa-angle-down"></i></p>
                                </a>
                                <div class="abs-dropdown dropdown-menu-4">
                                    <ul class="dropdown-menu ">
                                        <li>
                                            <a class="dropdown-item" href="#">
                                                <img src="<?=$urlThemeActive?>asset/images/vn.png" alt="">
                                                <p>Tiếng Việt</p>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#">
                                                <img src="<?=$urlThemeActive?>asset/images/en.jpg" alt="">
                                                <p>English</p>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>