<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo $urlThemeActive ?>asset/css/main.css">
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
</head>
<body>
    <header>
        <div class="header-inner">
            <div class="topbar">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-12 topbar-phone">
                            <img src="<?php echo $urlThemeActive ?>asset/image/headphone.png" alt="">&nbsp;
                            <span>0963.514.244</span>
                        </div>
            
                        <div class="col-lg-4 col-md-4 col-sm-4 col-12 topbar-logo">
                            <a href="/"><img src="<?php echo $urlThemeActive ?>asset/image/logo.png" alt=""></a>
                        </div>
            
                        <div class="col-lg-4 col-md-4 col-sm-4 col-12 topbar-group-button">
                            <div class="topbar-button">
                                <img src="<?php echo $urlThemeActive ?>asset/image/user.png" alt="">
                                <a href="">Tài khoản của tôi</a>
                            </div>

                            <div class="topbar-button">
                                <img src="<?php echo $urlThemeActive ?>asset/image/cartitem.png" alt="">
                                <a href="">Giỏ hàng</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mneu-desktop">
                <nav class="navbar-header navbar navbar-expand-lg ">
                    <div class="container-fluid">
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link" href="#">Sản phẩm</a>
                            </li>
    
                            <li class="nav-item">
                                <a class="nav-link" href="#">Sản phẩm</a>
                            </li>
    
                            <li class="nav-item">
                                <a class="nav-link" href="#">Sản phẩm</a>
                            </li>
    
                            <li class="nav-item">
                                <a class="nav-link" href="#">Sản phẩm</a>
                            </li>
    
                            <li class="nav-item">
                                <a class="nav-link" href="#">Sản phẩm</a>
                            </li>
    
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Combo quà tặng
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                </ul>
                            </li>
    
                            <li class="nav-item nav-item-image  dropdown ">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Combo quà tặng
                                </a>
                                <ul class="dropdown-menu dropdown-image">
                                    <div class="row">
                                        <div class="col-6 dropdown-image-item">
                                            <a href="">
                                                <div class="dropdown-image-item-inner">
                                                    <div class="dropdown-image-item-main">
                                                        <img src="<?php echo $urlThemeActive ?>asset/image/dropdownmenu.png" alt="">
                                                    </div>
            
                                                    <div class="dropdown-image-item-title">
                                                        <p>Quà tặng dành cho cha mẹ</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
    
                                        <div class="col-6 dropdown-image-item">
                                            <a href="">
                                                <div class="dropdown-image-item-inner">
                                                    <div class="dropdown-image-item-main">
                                                        <img src="<?php echo $urlThemeActive ?>asset/image/dropdownmenu.png" alt="">
                                                    </div>
            
                                                    <div class="dropdown-image-item-title">
                                                        <p>Quà tặng dành cho cha mẹ</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
    
                                        <div class="col-6 dropdown-image-item">
                                            <a href="">
                                                <div class="dropdown-image-item-inner">
                                                    <div class="dropdown-image-item-main">
                                                        <img src="<?php echo $urlThemeActive ?>asset/image/dropdownmenu.png" alt="">
                                                    </div>
            
                                                    <div class="dropdown-image-item-title">
                                                        <p>Quà tặng dành cho cha mẹ</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
    
                                        <div class="col-6 dropdown-image-item">
                                            <a href="">
                                                <div class="dropdown-image-item-inner">
                                                    <div class="dropdown-image-item-main">
                                                        <img src="<?php echo $urlThemeActive ?>asset/image/dropdownmenu.png" alt="">
                                                    </div>
            
                                                    <div class="dropdown-image-item-title">
                                                        <p>Quà tặng dành cho cha mẹ</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </ul>
                            </li>
    
                            <li class="nav-item nav-item-last">
                                <a class="nav-link" href="#">Sản phẩm</a>
                            </li>
                        </ul>
                        <form class="menu-form-search d-flex" role="search">
                            <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success button-search" type="submit"><img src="<?php echo $urlThemeActive ?>asset/image/iconsearch.png" alt=""></button>
                        </form>
                        </div>
                    </div>
                </nav>
            </div>

            <!-- mobile -->
            <!-- <div class="menu-mobile">
                <div class="menu-mobile-inner">
                    <div class="menu-mobile-box">
                        <ul>
                            <li>
                                <a href=""><img src="<?php echo $urlThemeActive ?>asset/image/cartitem.png" alt=""></a>
                            </li>
                            
                            <li>
                                <a href=""><img src="<?php echo $urlThemeActive ?>asset/image/cartitem.png" alt=""></a>
                            </li>

                            <li>
                                <a href=""><img src="<?php echo $urlThemeActive ?>asset/image/user.png" alt=""></a>
                            </li>

                            <li>
                                <a href=""><img src="<?php echo $urlThemeActive ?>asset/image/user.png" alt=""></a>
                            </li>

                            <li>
                                <a href=""><img src="<?php echo $urlThemeActive ?>asset/image/cartitem.png" alt=""></a>
                            </li>

                            <li>
                                <a href=""><img src="<?php echo $urlThemeActive ?>asset/image/cartitem.png" alt=""></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div> -->
        </div>
    </header>