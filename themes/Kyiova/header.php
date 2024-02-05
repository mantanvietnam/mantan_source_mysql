<?php
global $urlThemeActive;
$setting = setting();?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php mantan_header(); ?>
    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer"
    />
    <!-- Boostrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="<?php echo $urlThemeActive ?>/asset/css/style.css">
    <link rel="stylesheet" href="<?php echo $urlThemeActive ?>/asset/css/emhieu.css">
    <!-- Magnific Popup core CSS file -->
    <link rel="stylesheet" href="asset/magnific-popup/magnific-popup.css">

    <!-- Aos -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

    <!-- slick -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>

    <script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
</head>

<body>
    <header>
        <div class="topbar">
            <div class="container">
                <div class="topbar-box">
                    <div class="topbar-left">
                        <p><?php echo @$setting['compan_name'] ?></p>
                    </div>

                    <div class="topbar-right">
                        <div class="topbar-item">
                            <a href="">
                                <div class="topbar-icon">
                                    <i class="fa-solid fa-location-dot"></i>
                                </div>

                                <div class="topbar-texticon">
                                    <span><?php echo @$setting['address'] ?></span>
                                </div>
                            </a>
                        </div>

                        <div class="topbar-item">
                            <a href="">
                                <div class="topbar-icon">
                                    <i class="fa-regular fa-envelope"></i>
                                </div>

                                <div class="topbar-texticon">
                                    <span><?php echo @$setting['email'] ?></span>
                                </div>
                            </a>
                        </div>

                        <div class="topbar-item">
                            <a href="">
                                <div class="topbar-icon">
                                    <i class="fa-solid fa-phone"></i>
                                </div>

                                <div class="topbar-texticon">
                                    <span><?php echo @$setting['phone'] ?></span>
                                </div>
                            </a>
                        </div>


                    </div>
                </div>
            </div>
        </div>

        <div class="navbar-header" id="menu-top">
            <nav class="navbar navbar-expand-lg">
                <div class="container">
                    <a class="navbar-brand" href="/">
                        <div class="image-header">
                            <img src="<?php echo @$setting['image_logo'] ?>" alt="">
                        </div>
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                        <ul class="navbar-nav">
                            <?php 
                                $menu = getMenusDefault();
                                                  
                                if(!empty($menu)){
                                foreach($menu as $key => $value){
                                  if(empty($value['sub'])){?>
                                    <li class="nav-item">
                                        <a class="nav-link active" aria-current="page" href="<?php echo $value['link']  ?>"><?php echo $value['name']  ?></a>
                                    </li>
                                    <?php   }else{  ?>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="<?php echo $value['link']  ?>" role="button" data-bs-toggle="dropdown"aria-expanded="false"><?php echo $value['name']  ?></a>
                                        <ul class="dropdown-menu">
                                            <?php  foreach($value['sub'] as $keys => $values) { ?>
                                            <li><a class="dropdown-item" href="<?php echo $values['link']  ?>"><?php echo $values['name']  ?></a></li>
                                             <?php } ?>
                                        </ul>
                                    </li>
                                    <?php }}} ?>
                        </ul>
                    </div>
                    <div class="menu-cart">
                        <a href="/gio-hang">
                            <i class="fa-solid fa-cart-shopping"></i>
                        </a>

                        <a href="#" class="search-btn">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </a>
                    </div>
                </div>
            </nav>
        </div>
        
    </header>