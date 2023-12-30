<?php
global $urlThemeActive;
$setting = setting();
global $session;
$infoUser = $session->read('infoUser');
 $cart = 0;
 if(!empty($session->read('product_order'))){
    $cart = count($session->read('product_order')); 

global $urlCurrent;


 }
    
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name='dmca-site-verification' content='THIwRVVGTzh6UGRwMTltV3paVmlZUT090' />
    <!-- <title>Document</title> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo $urlThemeActive ?>asset/css/main.css">
    <link rel="stylesheet" href="<?php echo $urlThemeActive ?>asset/css/cssplus.css">
    <link rel="stylesheet" href="<?php echo $urlThemeActive ?>asset/css/mainplus.css">
    <link rel="stylesheet" href="<?php echo $urlThemeActive ?>asset/css/review.css">
    <link rel="stylesheet" href="<?php echo $urlThemeActive ?>asset/css/editcss.css">

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
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-P444V4P');</script>
<!-- End Google Tag Manager -->

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-P444V4P"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
</head>
<body>
    <header>
         <?php 
         if(!empty(checkFlasl()) && $setting['targetTime']>time()){ 
        echo '<div class="promotion-header">
            <p>'.@$setting['text_mobile'].'</p>
            <a href="'.@$setting['link_mobile'].'">Mua ngay</a>
            <i class="fa-solid fa-arrow-right"></i>
        </div>';
        }else{ 
        echo '<div class="promotion-header">
            <p>'.@$setting['text_mobile_ofsale'].'</p>
            <a href="'.@$setting['link_mobile_ofsale'].'">Mua ngay</a>
            <i class="fa-solid fa-arrow-right"></i>
        </div>';

        } ?>
        <div class="header-inner">
            <div class="topbar-mobile">
                <div class="container-fluid">
                    <div class="topbar-mobile-inner">
                        <div class="topbar-logo">
                            <a href="/"><img src="<?php echo @$setting['image_logo'] ?>" alt=""></a>
                        </div>

                        <form class="menu-form-search d-flex" role="search" action="/search-product" method="get" id="myForm">
                            <input class="form-control" type="text" name="key" placeholder="Tìm kiếm nhanh" aria-label="Search">
                            <button class="btn btn-outline-success button-search" type="submit"><img src="<?php echo $urlThemeActive ?>asset/image/iconsearch.png" alt=""></button>
                        </form>

                        <div class="topbar-button">
                            <a href="/gio-hang">
                                <img src="<?php echo $urlThemeActive ?>asset/image/cartitem.png" alt="">
                                <span id="count"><?php echo @$cart; ?></span>

                            </a>   
                        </div>
                    </div>
                </div>
            </div>

            <div class="topbar">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-12 topbar-logo">
                            <a href="/"><img src="<?php echo @$setting['image_logo'] ?>" alt=""></a>
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-3 col-12 topbar-phone">
                       
                        </div>
            
                      
            
                        <div class="col-lg-5 col-md-5 col-sm-5 col-12 topbar-group-button">
                            <div class="phone-header topbar-phone">
                                    <img src="<?php echo $urlThemeActive ?>asset/image/headphone.png" alt="">&nbsp;
                                    <span><?php echo @$setting['phone'] ?></span>
                            </div>

                            <div class="topbar-button topbar-button-myacc">
                                <img src="<?php echo $urlThemeActive ?>asset/image/account.png" alt="">
                                <?php if(!empty($infoUser)){ ?>
                                        <a href="/infoUser">Tài khoản của tôi</a>
                                        <div class="myacc-child">
                                            <div class="myacc-child-item">
                                                <img src="<?php echo $urlThemeActive ?>/asset/image/thong-tin-san-pham.png" alt="">
                                                <a href="/infoUser" >Thông tin tài khoản</a>
                                            </div>

                                            <div class="myacc-child-item">
                                                <img src="<?php echo $urlThemeActive ?>/asset/image/san-pham.png" alt="">
                                                <a href="/likeProduct">Sản phẩm yêu thích</a>
                                            </div>

                                            <div class="myacc-child-item">
                                                <img src="<?php echo $urlThemeActive ?>/asset/image/voucher.svg" alt="">
                                                <a href="/discount">Voucher</a>
                                            </div>

                                            <div class="myacc-child-item">
                                                <img src="<?php echo $urlThemeActive ?>/asset/image/dang-xuat.png" alt="">
                                                <a href="/logout" >Đăng xuất</a>
                                            </div>
                                        </div>
                                    
                                    <!-- <a href="/logout" >Đăng xuất</a> -->
                                <?php }else{ ?>
                                <a href=""  data-bs-toggle="modal" data-bs-target="#exampleModal">Đăng nhập</a>
                            <?php } ?>
                            </div>
                            
                            <div class="topbar-button">
                                <a href="/gio-hang"><img src="<?php echo $urlThemeActive ?>asset/image/cartitem.png" alt=""></a>
                                <a href="/gio-hang">Giỏ hàng</a>
                                <span id="count"><?php echo @$cart; ?></span>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mneu-desktop">
                <nav class="navbar-header navbar navbar-expand-lg ">
                    <div class="container-fluid">
                        <!-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button> -->
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                    <!-- Menu mặc định -->
                                <!-- <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="/allProduct" role="button" aria-expanded="false">
                                        Sản phẩm
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="/allProduct">Tất cả sản phẩm</a></li>
                                        <li><a class="dropdown-item" href="#">Bumas Beauty</a></li>
                                        <li><a class="dropdown-item" href="#">Bumas Home</a></li>
                                        <li><a class="dropdown-item" href="#">Bumas Care</a></li>
                                        <li><a class="dropdown-item" href="#">Quà tặng</a></li>

                                    </ul>
                                </li>
                            
                                <li class="nav-item nav-item-image  dropdown ">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Combo quà tặng
                                </a>
                                <ul class="dropdown-menu dropdown-image">
                                    <div class="row">
                                        <div class="col-6 dropdown-image-item">
                                            <a href="<?php echo @$setting['menu_link1'] ?>">
                                                <div class="dropdown-image-item-inner">
                                                    <div class="dropdown-image-item-main">
                                                        <img src="<?php echo @$setting['menu_image1'] ?>" alt="">
                                                    </div>
            
                                                    <div class="dropdown-image-item-title">
                                                        <p><?php echo @$setting['menu_title1']?></p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
    
                                        <div class="col-6 dropdown-image-item">
                                            <a href="<?php echo @$setting['menu_link2'] ?>">
                                                <div class="dropdown-image-item-inner">
                                                    <div class="dropdown-image-item-main">
                                                        <img src="<?php echo @$setting['menu_image2'] ?>" alt="">
                                                    </div>
            
                                                    <div class="dropdown-image-item-title">
                                                        <p><?php echo @$setting['menu_title2'] ?></p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
    
                                        <div class="col-6 dropdown-image-item">
                                            <a href="<?php echo @$setting['menu_link3'] ?>">
                                                <div class="dropdown-image-item-inner">
                                                    <div class="dropdown-image-item-main">
                                                        <img src="<?php echo @$setting['menu_image3'] ?>" alt="">
                                                    </div>
            
                                                    <div class="dropdown-image-item-title">
                                                        <p><?php echo @$setting['menu_title3'] ?></p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
    
                                        <div class="col-6 dropdown-image-item">
                                           <a href="<?php echo @$setting['menu_link4'] ?>">
                                                <div class="dropdown-image-item-inner">
                                                    <div class="dropdown-image-item-main">
                                                        <img src="<?php echo @$setting['menu_image4'] ?>" alt="">
                                                    </div>
            
                                                    <div class="dropdown-image-item-title">
                                                        <p><?php echo @$setting['menu_title4'] ?></p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </ul>
                            </li> -->
                            <?php 
                            $menu = getMenusDefault();
                          
                            if(!empty($menu)){
                            foreach($menu as $key => $value){
                              if(empty($value['sub'])){
                         ?>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="<?php echo $value['link']  ?>"><?php echo $value['name']  ?></a>
                            </li>
                        <?php   }else{  ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="<?php echo $value['link']  ?>" role="" 
                                   aria-expanded="false">
                                    <?php echo $value['name']  ?>
                                </a>
                                <ul class="dropdown-menu">
                                    <?php  foreach($value['sub'] as $keys => $values) { ?>
                                    <li><a class="dropdown-item" href="<?php echo $values['link']  ?>"><?php echo $values['name']  ?></a></li>
                                    <?php } ?>
                                </ul>
                            </li>
                            <?php }}} ?>
    
                        
                            <?php if(!empty(checkFlasl()) && $setting['targetTime']>time()){ ?>
                            <li class="nav-item nav-item-last">
                                <a class="nav-link" href="/sale"><?php echo @$setting['menu']?></a>
                            </li>
                        <?php } ?>
                        </ul>
                        <form class="menu-form-search d-flex" role="search"  action="/search-product" method="get" id="myForm">
                            <input class="form-control" type="text" name="key" placeholder="" aria-label="Search">
                            <button class="btn btn-outline-success button-search" type="submit"><img src="<?php echo $urlThemeActive ?>asset/image/iconsearch.png" alt=""></button>
                        </form>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </header>
    <section id="section-menu-bottom">
                 <!-- mobile -->
                 <div class="menu-mobile">
                <div class="menu-mobile-inner">
                    <div class="menu-mobile-box">
                        <ul>
                            <li <?php if(@$urlCurrent=='/') echo 'class="active"' ?>>
                                <a href="/">
                                    <!-- <img src="<?php echo $urlThemeActive ?>/asset/image/trang-chu.svg" alt=""> -->
                                    <svg class="home-svg" id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 19.16 21.16"><defs>
                                        <style>.cls-1{fill:#2bace2;}</style>
                                        </defs><path class="cls-1" d="M6.5,21.16V16.65a.78.78,0,0,1,.88-.88h4.4a.79.79,0,0,1,.89.89v4.49H17.3V10.4a.76.76,0,0,1,.8-.8h1.1L9.6,0,0,9.6H.94c.65,0,.93.28.93.94V21.16Z"/>
                                    </svg>

                                    <p>Trang chủ</p>
                                </a>
                            </li>
                            
                            <li <?php if(@$urlCurrent=='/sale') echo 'class="active"' ?>>
                                <?php if(!empty(checkFlasl()) && $setting['targetTime']>time()){ 
                                  echo'  <a href="/sale">
                                    <svg class="sale-svg" id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 26.53 27.66"><defs><style>.cls-1{fill:#2bace2;}.cls-2{fill:#fff;}</style></defs><path class="cls-1" d="M26.22,16.15a2.44,2.44,0,0,1-1.11,3.43c-.6.31-1.19.64-1.79.94a1,1,0,0,0-.6.84c-.11.69-.22,1.38-.36,2.07a2.42,2.42,0,0,1-2.92,2l-2.06-.3a.94.94,0,0,0-.81.27c-.51.51-1,1-1.55,1.51a2.43,2.43,0,0,1-3.51,0c-.5-.48-1-1-1.49-1.45a1,1,0,0,0-1-.31c-.68.11-1.37.21-2.06.29a2.42,2.42,0,0,1-2.84-2.17c-.11-.66-.23-1.32-.34-2a1,1,0,0,0-.56-.78c-.62-.31-1.23-.64-1.84-1A2.43,2.43,0,0,1,0,17.4a2.88,2.88,0,0,1,.3-1.23c.29-.6.58-1.2.89-1.79a1.09,1.09,0,0,0,0-1.08c-.32-.6-.61-1.22-.9-1.84A2.78,2.78,0,0,1,0,10.27,2.43,2.43,0,0,1,1.37,8.13c.61-.33,1.22-.66,1.84-1a1.06,1.06,0,0,0,.6-.86c.11-.68.22-1.37.36-2a2.42,2.42,0,0,1,2.94-2c.68.11,1.36.2,2,.29A.92.92,0,0,0,10,2.27c.41-.41.85-.81,1.25-1.23A3.24,3.24,0,0,1,13,0h.54a3.25,3.25,0,0,1,1.78,1c.39.41.82.79,1.22,1.19a1,1,0,0,0,.93.29c.69-.11,1.37-.21,2.06-.29a2.42,2.42,0,0,1,2.86,2.13c.12.66.23,1.33.34,2a1,1,0,0,0,.57.8c.63.31,1.25.64,1.86,1a2.41,2.41,0,0,1,1.09,3.33c-.3.63-.6,1.25-.92,1.87a1,1,0,0,0,0,1C25.64,15,25.93,15.55,26.22,16.15Z"/><path class="cls-4" d="M25.34,14.36a1,1,0,0,1,0-1c.32-.62.62-1.24.92-1.87a2.41,2.41,0,0,0-1.09-3.33c-.61-.34-1.23-.67-1.86-1a1,1,0,0,1-.57-.8c-.11-.66-.22-1.33-.34-2a2.42,2.42,0,0,0-2.86-2.13c-.69.08-1.37.18-2.06.29a1,1,0,0,1-.93-.29c-.4-.4-.83-.78-1.22-1.19a3.25,3.25,0,0,0-1.78-1H13a3.24,3.24,0,0,0-1.79,1c-.4.42-.84.82-1.25,1.23a.92.92,0,0,1-.82.26c-.67-.09-1.35-.18-2-.29a2.42,2.42,0,0,0-2.94,2C4,4.93,3.92,5.62,3.81,6.3a1.06,1.06,0,0,1-.6.86c-.62.31-1.23.64-1.84,1A2.43,2.43,0,0,0,0,10.27a2.78,2.78,0,0,0,.29,1.19c.29.62.58,1.24.9,1.84a1.09,1.09,0,0,1,0,1.08C.88,15,.59,15.57.3,16.17A2.88,2.88,0,0,0,0,17.4a2.43,2.43,0,0,0,1.4,2.16c.61.33,1.22.66,1.84,1a1,1,0,0,1,.56.78c.11.65.23,1.31.34,2A2.42,2.42,0,0,0,7,25.45c.69-.08,1.38-.18,2.06-.29a1,1,0,0,1,1,.31c.49.49,1,1,1.49,1.45a2.43,2.43,0,0,0,3.51,0c.52-.5,1-1,1.55-1.51a.94.94,0,0,1,.81-.27l2.06.3a2.42,2.42,0,0,0,2.92-2c.14-.69.25-1.38.36-2.07a1,1,0,0,1,.6-.84c.6-.3,1.19-.63,1.79-.94a2.44,2.44,0,0,0,1.11-3.43C25.93,15.55,25.64,15,25.34,14.36ZM23.88,15c.3.58.58,1.18.87,1.77s.24,1.06-.46,1.42c-.49.26-1,.55-1.48.78a2.75,2.75,0,0,0-1.71,2.39c-.07.6-.2,1.19-.31,1.78a.83.83,0,0,1-1,.72l-2.25-.31a2.34,2.34,0,0,0-2,.71l-1.55,1.5a.82.82,0,0,1-1.28,0l-1.5-1.44a2.58,2.58,0,0,0-2.37-.75c-.72.12-1.45.21-2.11.31a.82.82,0,0,1-.89-.68c-.14-.71-.27-1.43-.38-2.15A2.5,2.5,0,0,0,4,19.14l-1.86-1a.83.83,0,0,1-.41-1.27c.3-.63.6-1.25.91-1.87a2.48,2.48,0,0,0,0-2.35c-.31-.61-.6-1.21-.89-1.82a.85.85,0,0,1,.42-1.33c.52-.28,1-.58,1.55-.82a2.76,2.76,0,0,0,1.7-2.38c.07-.59.2-1.18.31-1.78A.83.83,0,0,1,6.8,3.81L9,4.12a2.41,2.41,0,0,0,2.06-.72l1.53-1.48a.83.83,0,0,1,1.31,0c.49.48,1,1,1.47,1.43a2.56,2.56,0,0,0,2.34.76c.68-.11,1.37-.2,2.05-.3a.81.81,0,0,1,1,.7c.14.7.26,1.4.38,2.1a2.46,2.46,0,0,0,1.38,1.94l1.83,1a.84.84,0,0,1,.42,1.29c-.3.62-.6,1.25-.91,1.87A2.47,2.47,0,0,0,23.88,15Z"/><path class="cls-2" d="M8,19.9a.78.78,0,0,1-.69-.44.76.76,0,0,1,.07-.82,1.65,1.65,0,0,1,.22-.24L17.83,8.15a1,1,0,0,1,.69-.37.75.75,0,0,1,.72.44.74.74,0,0,1-.08.84l-.2.21L8.7,19.53A1,1,0,0,1,8,19.9"/><path class="cls-2" d="M10.07,12.5A2.92,2.92,0,1,1,13,9.59a2.91,2.91,0,0,1-2.93,2.91m0-4.24A1.32,1.32,0,0,0,8.75,9.57a1.33,1.33,0,1,0,1.34-1.31"/><path class="cls-2" d="M16.47,15.18a2.9,2.9,0,0,1,2.91,2.94,2.92,2.92,0,1,1-2.91-2.94m0,4.23a1.32,1.32,0,0,0,1.34-1.3,1.33,1.33,0,1,0-2.66,0,1.32,1.32,0,0,0,1.32,1.32"/></svg>                                        
                                        <p>Khuyến mãi</p>
                                    </a>';
                                 }else{
                                    echo'  <a href="javascript();" data-bs-toggle="modal" data-bs-target="#exampleModalsale">
                                    <svg class="sale-svg" id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 26.53 27.66"><defs><style>.cls-1{fill:#2bace2;}.cls-2{fill:#fff;}</style></defs><path class="cls-1" d="M26.22,16.15a2.44,2.44,0,0,1-1.11,3.43c-.6.31-1.19.64-1.79.94a1,1,0,0,0-.6.84c-.11.69-.22,1.38-.36,2.07a2.42,2.42,0,0,1-2.92,2l-2.06-.3a.94.94,0,0,0-.81.27c-.51.51-1,1-1.55,1.51a2.43,2.43,0,0,1-3.51,0c-.5-.48-1-1-1.49-1.45a1,1,0,0,0-1-.31c-.68.11-1.37.21-2.06.29a2.42,2.42,0,0,1-2.84-2.17c-.11-.66-.23-1.32-.34-2a1,1,0,0,0-.56-.78c-.62-.31-1.23-.64-1.84-1A2.43,2.43,0,0,1,0,17.4a2.88,2.88,0,0,1,.3-1.23c.29-.6.58-1.2.89-1.79a1.09,1.09,0,0,0,0-1.08c-.32-.6-.61-1.22-.9-1.84A2.78,2.78,0,0,1,0,10.27,2.43,2.43,0,0,1,1.37,8.13c.61-.33,1.22-.66,1.84-1a1.06,1.06,0,0,0,.6-.86c.11-.68.22-1.37.36-2a2.42,2.42,0,0,1,2.94-2c.68.11,1.36.2,2,.29A.92.92,0,0,0,10,2.27c.41-.41.85-.81,1.25-1.23A3.24,3.24,0,0,1,13,0h.54a3.25,3.25,0,0,1,1.78,1c.39.41.82.79,1.22,1.19a1,1,0,0,0,.93.29c.69-.11,1.37-.21,2.06-.29a2.42,2.42,0,0,1,2.86,2.13c.12.66.23,1.33.34,2a1,1,0,0,0,.57.8c.63.31,1.25.64,1.86,1a2.41,2.41,0,0,1,1.09,3.33c-.3.63-.6,1.25-.92,1.87a1,1,0,0,0,0,1C25.64,15,25.93,15.55,26.22,16.15Z"/><path class="cls-4" d="M25.34,14.36a1,1,0,0,1,0-1c.32-.62.62-1.24.92-1.87a2.41,2.41,0,0,0-1.09-3.33c-.61-.34-1.23-.67-1.86-1a1,1,0,0,1-.57-.8c-.11-.66-.22-1.33-.34-2a2.42,2.42,0,0,0-2.86-2.13c-.69.08-1.37.18-2.06.29a1,1,0,0,1-.93-.29c-.4-.4-.83-.78-1.22-1.19a3.25,3.25,0,0,0-1.78-1H13a3.24,3.24,0,0,0-1.79,1c-.4.42-.84.82-1.25,1.23a.92.92,0,0,1-.82.26c-.67-.09-1.35-.18-2-.29a2.42,2.42,0,0,0-2.94,2C4,4.93,3.92,5.62,3.81,6.3a1.06,1.06,0,0,1-.6.86c-.62.31-1.23.64-1.84,1A2.43,2.43,0,0,0,0,10.27a2.78,2.78,0,0,0,.29,1.19c.29.62.58,1.24.9,1.84a1.09,1.09,0,0,1,0,1.08C.88,15,.59,15.57.3,16.17A2.88,2.88,0,0,0,0,17.4a2.43,2.43,0,0,0,1.4,2.16c.61.33,1.22.66,1.84,1a1,1,0,0,1,.56.78c.11.65.23,1.31.34,2A2.42,2.42,0,0,0,7,25.45c.69-.08,1.38-.18,2.06-.29a1,1,0,0,1,1,.31c.49.49,1,1,1.49,1.45a2.43,2.43,0,0,0,3.51,0c.52-.5,1-1,1.55-1.51a.94.94,0,0,1,.81-.27l2.06.3a2.42,2.42,0,0,0,2.92-2c.14-.69.25-1.38.36-2.07a1,1,0,0,1,.6-.84c.6-.3,1.19-.63,1.79-.94a2.44,2.44,0,0,0,1.11-3.43C25.93,15.55,25.64,15,25.34,14.36ZM23.88,15c.3.58.58,1.18.87,1.77s.24,1.06-.46,1.42c-.49.26-1,.55-1.48.78a2.75,2.75,0,0,0-1.71,2.39c-.07.6-.2,1.19-.31,1.78a.83.83,0,0,1-1,.72l-2.25-.31a2.34,2.34,0,0,0-2,.71l-1.55,1.5a.82.82,0,0,1-1.28,0l-1.5-1.44a2.58,2.58,0,0,0-2.37-.75c-.72.12-1.45.21-2.11.31a.82.82,0,0,1-.89-.68c-.14-.71-.27-1.43-.38-2.15A2.5,2.5,0,0,0,4,19.14l-1.86-1a.83.83,0,0,1-.41-1.27c.3-.63.6-1.25.91-1.87a2.48,2.48,0,0,0,0-2.35c-.31-.61-.6-1.21-.89-1.82a.85.85,0,0,1,.42-1.33c.52-.28,1-.58,1.55-.82a2.76,2.76,0,0,0,1.7-2.38c.07-.59.2-1.18.31-1.78A.83.83,0,0,1,6.8,3.81L9,4.12a2.41,2.41,0,0,0,2.06-.72l1.53-1.48a.83.83,0,0,1,1.31,0c.49.48,1,1,1.47,1.43a2.56,2.56,0,0,0,2.34.76c.68-.11,1.37-.2,2.05-.3a.81.81,0,0,1,1,.7c.14.7.26,1.4.38,2.1a2.46,2.46,0,0,0,1.38,1.94l1.83,1a.84.84,0,0,1,.42,1.29c-.3.62-.6,1.25-.91,1.87A2.47,2.47,0,0,0,23.88,15Z"/><path class="cls-2" d="M8,19.9a.78.78,0,0,1-.69-.44.76.76,0,0,1,.07-.82,1.65,1.65,0,0,1,.22-.24L17.83,8.15a1,1,0,0,1,.69-.37.75.75,0,0,1,.72.44.74.74,0,0,1-.08.84l-.2.21L8.7,19.53A1,1,0,0,1,8,19.9"/><path class="cls-2" d="M10.07,12.5A2.92,2.92,0,1,1,13,9.59a2.91,2.91,0,0,1-2.93,2.91m0-4.24A1.32,1.32,0,0,0,8.75,9.57a1.33,1.33,0,1,0,1.34-1.31"/><path class="cls-2" d="M16.47,15.18a2.9,2.9,0,0,1,2.91,2.94,2.92,2.92,0,1,1-2.91-2.94m0,4.23a1.32,1.32,0,0,0,1.34-1.3,1.33,1.33,0,1,0-2.66,0,1.32,1.32,0,0,0,1.32,1.32"/></svg>                                        
                                        <p>Khuyến mãi</p>
                                    </a>';
                                 } ?>
                            </li>
                            
                            <li class="list-contact">
                                <a id="button-contact">
                                    <svg class="contact-svg" id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 28.74 28.75"><defs><style>.cls-1{fill:#2bace2;}</style></defs><path class="cls-1" d="M23.45,20.63a7.57,7.57,0,0,1,.79,2.44,8.84,8.84,0,0,1,0,3.12,3.28,3.28,0,0,1-3.08,2.55H3.55A3.27,3.27,0,0,1,.3,26.67,4.68,4.68,0,0,1,0,25.33a8.22,8.22,0,0,1,.82-4.58A7,7,0,0,1,5,17.43c.37-.12.75-.22,1.12-.33s.57,0,.73.37a34.92,34.92,0,0,0,2.53,5l.3.45c.1-.42.19-.78.27-1.15s.17-.76.26-1.14.16-.47-.08-.69c-.06-.05-.06-.18-.06-.27V17.54c0-.38.15-.54.53-.54,1,0,2.09,0,3.13,0,.37,0,.53.15.53.51,0,.73,0,1.46,0,2.2a.48.48,0,0,1-.07.3c-.2.18-.14.37-.09.58.19.79.37,1.59.57,2.48.38-.63.75-1.17,1-1.75.62-1.25,1.22-2.53,1.81-3.8.21-.45.33-.53.81-.41l1,.27v-.33c0-.68,0-1.37,0-2.05a1.07,1.07,0,0,1,1.2-1.19h7.09A1.05,1.05,0,0,1,28.74,15c0,1.45,0,2.91,0,4.36a1.07,1.07,0,0,1-1.22,1.22H23.88a2.07,2.07,0,0,0-.43.09ZM18.3,18c-.05.11-.08.2-.12.28-.73,1.44-1.41,2.9-2.18,4.31a9.21,9.21,0,0,1-2.32,2.84,2.21,2.21,0,0,1-2.88.09,1.69,1.69,0,0,1-.41-.34,23.22,23.22,0,0,1-1.47-1.81,28.74,28.74,0,0,1-2.69-5.12c-.09-.22-.19-.26-.39-.18-.45.17-.91.31-1.34.5a5.6,5.6,0,0,0-3.3,3.7,10.33,10.33,0,0,0-.28,3,2.56,2.56,0,0,0,2.66,2.52c5.73,0,11.45,0,17.17,0h.33a2.43,2.43,0,0,0,2.31-2.16A9.12,9.12,0,0,0,23.32,23a5.55,5.55,0,0,0-.58-1.78c-.42.33-.81.66-1.23.95a.59.59,0,0,1-.5.06c-.12-.05-.19-.26-.24-.42s0-.19,0-.28c0-.34.06-.67.09-1H20.6c-.91,0-1.28-.38-1.28-1.3s0-1-1-1.19Zm9.54-3.33H20.57c-.26,0-.38.07-.35.35s0,.62,0,.93c0,.7.05,1.4.05,2.11,0,.42,0,.85-.05,1.28,0,.19.07.26.26.26s.52,0,.79,0c.43,0,.58.16.55.59,0,.19,0,.38-.05.63.44-.34.84-.64,1.23-1a1.07,1.07,0,0,1,.74-.26h3.75c.27,0,.36-.08.36-.35,0-1.45,0-2.89,0-4.33ZM13.11,20.24c-.59,0-1.16,0-1.74,0-.06,0-.15.1-.16.18-.26,1.1-.52,2.2-.76,3.3a.35.35,0,0,0,.05.29,9.39,9.39,0,0,0,1.12,1,1,1,0,0,0,1.21,0,12.65,12.65,0,0,0,1-.9.28.28,0,0,0,.06-.2c-.27-1.2-.54-2.39-.82-3.61Zm.24-2.32H11v1.39h2.36Z"/><path class="cls-1" d="M16.86,12.67H18.3c.19,0,.3-.07.29-.27v-.57l-.06-.05c-.69,0-.72-.25-.72-.79,0-1.11,0-2.22,0-3.34,0-.7,0-.7.67-.84A6.23,6.23,0,0,0,12.42.92,6.33,6.33,0,0,0,5.8,6.8s0,0,0,0c.63.07.68.12.68.76v3.57c0,.48-.13.61-.62.61a2.31,2.31,0,0,1-2.48-1.71A2.47,2.47,0,0,1,4.74,7a.41.41,0,0,0,.13-.28,7.35,7.35,0,0,1,5-6.35,7.27,7.27,0,0,1,9.53,6.08.71.71,0,0,0,.45.67A2.09,2.09,0,0,1,21,9a2.74,2.74,0,0,1-.33,1.7,2.24,2.24,0,0,1-1,.87.29.29,0,0,0-.2.33,4.28,4.28,0,0,1,0,.62,1.1,1.1,0,0,1-1.15,1.08c-.55,0-1.1,0-1.64,0a.52.52,0,0,0-.52.28A4.64,4.64,0,0,1,12,16,4.9,4.9,0,0,1,7.33,11.3c0-2.15,0-4.3,0-6.44A1.71,1.71,0,0,1,8.68,3.11a13.13,13.13,0,0,1,7.17.07A1.57,1.57,0,0,1,17,4.55a2.59,2.59,0,0,1,0,.56c0,1.84,0,3.69,0,5.53,0,.67-.11,1.34-.17,2Zm-1.61.9c-.55,0-1.06,0-1.56,0a.39.39,0,0,0-.39.23,1.31,1.31,0,0,1-1.72.55,1.34,1.34,0,0,1,.31-2.54,1.32,1.32,0,0,1,1.43.68.33.33,0,0,0,.34.2c.62,0,1.25,0,1.87,0,.23,0,.33-.07.37-.28A9.09,9.09,0,0,0,16.12,11c0-1.07,0-2.13,0-3.2,0-.07,0-.15,0-.22-1.75-.16-1.75-.16-2.54-.82A11.42,11.42,0,0,1,8.21,8.28v2.8a4,4,0,0,0,2.69,3.81,3.76,3.76,0,0,0,4.35-1.32Zm.87-6.89c0-.68,0-1.33,0-2A.69.69,0,0,0,15.6,4,12.13,12.13,0,0,0,8.87,4a.82.82,0,0,0-.66.86V7.11a1.5,1.5,0,0,0,0,.22A11.37,11.37,0,0,0,12,6.58,5.07,5.07,0,0,0,14,5.25c.11-.13.2-.27.32-.39a.51.51,0,0,1,.69,0,.44.44,0,0,1,0,.67l-.63.74a2.07,2.07,0,0,0,1.81.45Zm2.6,4.18a1.47,1.47,0,0,0,1.39-1.71c-.05-.83-.44-1.25-1.39-1.37ZM5.62,7.77c-1.17.05-1.46.89-1.36,1.86a1.32,1.32,0,0,0,1.36,1.2Zm7,5.36a.45.45,0,0,0-.89,0,.45.45,0,0,0,.43.46.45.45,0,0,0,.46-.44Z"/></svg>                                    <p>Tư vấn</p> 
                                    <div class="content-contact">
                                        <div class="content-group">
                                            <div class="content-contact-item">
                                                <a href="<?php echo @$setting['contact-zalo-link'] ?>"><img src="<?php echo $urlThemeActive ?>/asset/image/zalo.svg" alt=""></a>
                                            </div>
                                            <div class="content-contact-item content-contact-item-phone">
                                                <a href="<?php echo @$setting['contact-phone-link'] ?>"><img src="<?php echo $urlThemeActive ?>/asset/image/9b837a317017d8498106.jpg" alt=""></a>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </li>

                            <li <?php if(@$urlCurrent=='/gio-hang"') echo 'class="active"' ?>>
                                <a href="/gio-hang">
                                    <!-- <img src="<?php echo $urlThemeActive ?>/asset/image/gio-hang.svg" alt=""> -->
                                    <svg class="svg-cart" id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 23.45 26.38"><defs><style>.cls-1{fill:#2bace2;}</style></defs><path class="cls-1" d="M6.52,6.49c.05-.76,0-1.47.13-2.17a5.21,5.21,0,0,1,10.26,0C17,5,17,5.72,17,6.47l.41,0h2.84c.57,0,.77.16.84.72.32,2.31.62,4.62.93,6.93q.6,4.63,1.22,9.28c.06.44.15.88.17,1.33a.89.89,0,0,1-.15.58,6.59,6.59,0,0,1-.92.91.83.83,0,0,1-.52.14q-10.08,0-20.15,0A1.23,1.23,0,0,1,1,26C-.19,25,.05,25.26.22,23.93c.42-3.29.86-6.58,1.29-9.87l.9-6.81c.08-.61.27-.76.89-.76H6.52ZM19.93,7.77l-.22,0H4c-.31,0-.35.15-.38.4L2.49,16.32c-.35,2.67-.71,5.33-1.05,8-.07.55.16.81.71.81H21.42c.52,0,.77-.27.71-.78-.16-1.25-.33-2.51-.5-3.76q-.69-5.31-1.4-10.61c-.09-.73-.2-1.45-.3-2.2M15.74,6.46c0-.51,0-1,0-1.43a3.93,3.93,0,0,0-5.18-3.56c-2.12.74-3,2.59-2.68,5Z"/></svg>
                                    <p>Giỏ hàng</p>
                                </a>
                            </li>

                             <?php if(!empty($infoUser)){ ?>

                            <li <?php if(@$urlCurrent=='/infoUser') echo 'class="active"' ?>>

                                <a href="/infoUser">
                                    <!-- <img src="<?php echo $urlThemeActive ?>/asset/image/tai-khoan.svg" alt=""> -->
                                    <svg class="acc-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 25 25" style="enable-background:new 0 0 25 25;" xml:space="preserve">
                                        <style type="text/css">
                                            .st0{fill:#FFFFFF;}
                                            .st1{fill:#BE1E2D;}
                                            .st2{fill:none;stroke:#231F20;stroke-width:0.25;stroke-miterlimit:10;}
                                            .st3{fill:#EDEDED;}
                                            .st4{fill:#808285;}
                                            .st5{fill:none;stroke:#000000;stroke-miterlimit:10;}
                                            .st6{fill:none;stroke:#000000;stroke-width:0.25;stroke-miterlimit:10;}
                                            .st7{fill:none;stroke:#939598;stroke-width:0.5;stroke-miterlimit:10;}
                                            .st8{fill:#F1F2F2;}
                                            .st9{fill:#F1F2F2;stroke:#A7A9AC;stroke-miterlimit:10;}
                                            .st10{opacity:0.5;}
                                            .st11{fill:none;stroke:#000000;stroke-width:0.5;stroke-miterlimit:10;}
                                            .st12{fill:none;stroke:#000000;stroke-width:0.5;stroke-miterlimit:10;stroke-dasharray:3.8107,3.8107;}
                                            .st13{opacity:0.7;}
                                            .st14{fill:#008BCF;}
                                            .st15{fill:#F9F4EF;}
                                            .st16{fill:none;stroke:#000000;stroke-width:0.25;stroke-miterlimit:10;stroke-dasharray:5.0533,5.0533;}
                                            .st17{fill:none;stroke:#231F20;stroke-width:0.5;stroke-miterlimit:10;}
                                            .st18{fill:none;stroke:#033673;stroke-miterlimit:10;}
                                            .st19{fill:#939598;}
                                            .st20{fill:none;stroke:#00325F;stroke-miterlimit:10;}
                                            .st21{opacity:0.5;fill:none;stroke:#000000;stroke-width:0.5;stroke-miterlimit:10;}
                                            .st22{fill:#011436;}
                                            .st23{fill:none;stroke:#FFFFFF;stroke-width:3;stroke-miterlimit:10;}
                                            .st24{fill:none;stroke:#6D6E71;stroke-width:0.5;stroke-miterlimit:10;}
                                            .st25{fill:url(#SVGID_1_);}
                                            .st26{fill:#020202;}
                                            .st27{fill:#CECECE;}
                                            .st28{fill:#EF5B36;}
                                            .st29{fill:none;stroke:#808285;stroke-width:0.5;stroke-miterlimit:10;}
                                            .st30{fill:#00A9DC;}
                                            .st31{fill:none;stroke:#7AD1F1;stroke-width:0.3728;stroke-miterlimit:10;}
                                            .st32{fill:url(#SVGID_18_);}
                                            .st33{fill:url(#SVGID_23_);}
                                            .st34{fill:url(#SVGID_40_);}
                                            .st35{fill:none;stroke:#414042;stroke-width:0.1;stroke-miterlimit:10;}
                                            .st36{fill:none;stroke:#008BCF;stroke-width:0.25;stroke-miterlimit:10;}
                                            .st37{clip-path:url(#SVGID_46_);}
                                            .st38{clip-path:url(#SVGID_52_);}
                                            .st39{opacity:0.5;fill:#B8DAE9;}
                                            .st40{fill:#BE1E2D;stroke:#F48989;stroke-miterlimit:10;}
                                            .st41{fill:#B8DAE9;}
                                            .st42{fill:#E6E7E8;}
                                            .st43{fill:none;stroke:#58595B;stroke-width:0.5;stroke-miterlimit:10;}
                                            .st44{opacity:0.4;}
                                            .st45{fill:#00325F;}
                                            .st46{fill:none;stroke:#011436;stroke-miterlimit:10;}
                                            .st47{clip-path:url(#SVGID_78_);}
                                            .st48{clip-path:url(#SVGID_84_);}
                                            .st49{fill:#58595B;stroke:#000000;stroke-width:0.25;stroke-miterlimit:10;}
                                            .st50{fill:none;stroke:#58595B;stroke-width:0.25;stroke-miterlimit:10;}
                                            .st51{fill:#EF4136;}
                                            .st52{fill:#E6E6E6;}
                                            .st53{fill:#808080;}
                                            .st54{fill:#ED1C24;}
                                            .st55{opacity:0.5;fill:none;stroke:#000000;stroke-width:0.1;stroke-miterlimit:10;}
                                            .st56{fill:none;stroke:#000000;stroke-width:0.1;stroke-miterlimit:10;}
                                            .st57{filter:url(#Adobe_OpacityMaskFilter);}
                                            .st58{fill:url(#SVGID_102_);}
                                            .st59{mask:url(#SVGID_101_);}
                                            .st60{fill:none;stroke:#00A9DC;stroke-miterlimit:10;}
                                            .st61{fill:url(#SVGID_105_);}
                                            .st62{fill:url(#SVGID_106_);}
                                            .st63{fill:url(#SVGID_107_);}
                                            .st64{fill:url(#SVGID_108_);}
                                            .st65{fill:#FEFEFE;}
                                            .st66{clip-path:url(#SVGID_110_);}
                                            .st67{fill:#235FD5;}
                                            .st68{fill:#6D6E71;}
                                            .st69{fill:#58595B;}
                                            .st70{fill:#F5F6F6;}
                                            .st71{clip-path:url(#SVGID_114_);}
                                            .st72{clip-path:url(#SVGID_120_);}
                                            .st73{fill:none;stroke:#000000;stroke-width:0.2616;stroke-miterlimit:10;}
                                            .st74{fill:none;stroke:#939598;stroke-width:0.3874;stroke-miterlimit:10;}
                                            .st75{fill:none;stroke:#939598;stroke-width:0.5232;stroke-miterlimit:10;}
                                            .st76{fill:none;stroke:#000000;stroke-width:1.0463;stroke-miterlimit:10;}
                                            .st77{fill:none;stroke:#808285;stroke-width:0.5232;stroke-miterlimit:10;}
                                            .st78{fill:none;stroke:#58595B;stroke-width:0.5232;stroke-miterlimit:10;}
                                            .st79{clip-path:url(#SVGID_138_);}
                                            .st80{clip-path:url(#SVGID_144_);}
                                            .st81{fill:none;stroke:#F0F1F1;stroke-width:0.75;stroke-miterlimit:10;}
                                            .st82{clip-path:url(#SVGID_154_);}
                                            .st83{fill:none;stroke:#231F20;stroke-width:0.75;stroke-miterlimit:10;}
                                            .st84{opacity:0.25;}
                                            .st85{fill:none;stroke:#F1F2F2;stroke-width:0.5;stroke-miterlimit:10;}
                                            .st86{fill:#FFFFFF;stroke:#6D6E71;stroke-width:0.25;stroke-miterlimit:10;}
                                            .st87{fill:#011436;stroke:#6D6E71;stroke-width:0.25;stroke-miterlimit:10;}
                                            .st88{fill:none;stroke:#011436;stroke-width:0.25;stroke-miterlimit:10;}
                                            .st89{clip-path:url(#SVGID_156_);fill:url(#SVGID_157_);}
                                            .st90{opacity:0.1;clip-path:url(#SVGID_159_);}
                                            .st91{clip-path:url(#SVGID_161_);}
                                            .st92{fill:none;stroke:#414042;stroke-width:0.5;stroke-miterlimit:10;}
                                            .st93{fill:none;stroke:#000000;stroke-width:0.25;stroke-miterlimit:10;stroke-dasharray:5.005,5.005;}
                                            .st94{fill:none;stroke:#000000;stroke-width:0.25;stroke-miterlimit:10;stroke-dasharray:5.028,5.028;}
                                            .st95{clip-path:url(#SVGID_165_);}
                                            .st96{clip-path:url(#SVGID_169_);}
                                            .st97{fill:#008BD0;}
                                            .st98{clip-path:url(#SVGID_175_);fill:none;stroke:#000000;stroke-width:0.5;stroke-miterlimit:10;}
                                            .st99{clip-path:url(#SVGID_175_);fill:none;stroke:#000000;stroke-width:0.5;stroke-miterlimit:10;stroke-dasharray:3.838,3.838;}
                                            .st100{fill:none;}
                                            .st101{clip-path:url(#SVGID_177_);fill:none;stroke:#000000;stroke-width:0.5;stroke-miterlimit:10;}
                                            .st102{clip-path:url(#SVGID_177_);fill:none;stroke:#000000;stroke-width:0.5;stroke-miterlimit:10;stroke-dasharray:3.838,3.838;}
                                            .st103{fill:#ffffff;}
                                            .st104{clip-path:url(#SVGID_179_);fill:none;stroke:#000000;stroke-miterlimit:10;}
                                            .st105{clip-path:url(#SVGID_181_);fill:#F1F2F2;}
                                            .st106{clip-path:url(#SVGID_183_);}
                                            .st107{clip-path:url(#SVGID_187_);}
                                            .st108{clip-path:url(#SVGID_191_);fill:none;stroke:#939598;stroke-width:0.5;stroke-miterlimit:10;}
                                            .st109{clip-path:url(#SVGID_193_);fill:none;stroke:#000000;stroke-miterlimit:10;}
                                            .st110{clip-path:url(#SVGID_195_);}
                                            .st111{clip-path:url(#SVGID_199_);}
                                            .st112{fill:url(#SVGID_202_);}
                                            .st113{clip-path:url(#SVGID_204_);}
                                            .st114{clip-path:url(#SVGID_208_);}
                                            .st115{clip-path:url(#SVGID_212_);fill:#B8DAE9;}
                                            .st116{clip-path:url(#SVGID_214_);fill:#B8DAE9;}
                                            .st117{clip-path:url(#SVGID_216_);fill:none;stroke:#58595B;stroke-width:0.25;stroke-miterlimit:10;}
                                            .st118{clip-path:url(#SVGID_220_);}
                                            .st119{fill:#001E38;}
                                            .st120{fill:none;stroke:#FFFFFF;stroke-width:0.5848;stroke-miterlimit:10;}
                                            .st121{fill:none;stroke:#FFFFFF;stroke-width:0.499;stroke-miterlimit:10;}
                                            .st122{fill:#03A9DB;}
                                            .st123{fill:none;stroke:#808285;stroke-width:0.499;stroke-miterlimit:10;}
                                            .st124{opacity:0.99;fill:#FFFFFF;stroke:#231F20;stroke-miterlimit:10;}
                                            .st125{fill:#231F20;}
                                            .st126{fill:none;stroke:#FFFFFF;stroke-width:0.5;stroke-miterlimit:10;}
                                        </style>
                                        <g id="Layer_1">
                                        </g>
                                        <g id="Layer_2">
                                            <circle class="st103" cx="12.5" cy="12.5" r="12.3" stroke="#000" stroke-width="1"/>
                                            <circle class="st126" cx="12.6" cy="11.1" r="4.5" stroke="#000" stroke-width="1"/>
                                            <path class="st126" d="M21,21.4c-1.3-3.4-4.6-5.8-8.4-5.8c-3.9,0-7.1,2.4-8.4,5.9"/>
                                        </g>
                                    </svg>
                                    <p>Tài khoản</p>
                                </a>
                            </li>
                                <?php }else{ ?>
                            <li>

                                <a href="" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 25 25" style="enable-background:new 0 0 25 25;" xml:space="preserve">
                                        <style type="text/css">
                                            .st0{fill:#FFFFFF;}
                                            .st1{fill:#BE1E2D;}
                                            .st2{fill:none;stroke:#231F20;stroke-width:0.25;stroke-miterlimit:10;}
                                            .st3{fill:#EDEDED;}
                                            .st4{fill:#808285;}
                                            .st5{fill:none;stroke:#000000;stroke-miterlimit:10;}
                                            .st6{fill:none;stroke:#000000;stroke-width:0.25;stroke-miterlimit:10;}
                                            .st7{fill:none;stroke:#939598;stroke-width:0.5;stroke-miterlimit:10;}
                                            .st8{fill:#F1F2F2;}
                                            .st9{fill:#F1F2F2;stroke:#A7A9AC;stroke-miterlimit:10;}
                                            .st10{opacity:0.5;}
                                            .st11{fill:none;stroke:#000000;stroke-width:0.5;stroke-miterlimit:10;}
                                            .st12{fill:none;stroke:#000000;stroke-width:0.5;stroke-miterlimit:10;stroke-dasharray:3.8107,3.8107;}
                                            .st13{opacity:0.7;}
                                            .st14{fill:#008BCF;}
                                            .st15{fill:#F9F4EF;}
                                            .st16{fill:none;stroke:#000000;stroke-width:0.25;stroke-miterlimit:10;stroke-dasharray:5.0533,5.0533;}
                                            .st17{fill:none;stroke:#231F20;stroke-width:0.5;stroke-miterlimit:10;}
                                            .st18{fill:none;stroke:#033673;stroke-miterlimit:10;}
                                            .st19{fill:#939598;}
                                            .st20{fill:none;stroke:#00325F;stroke-miterlimit:10;}
                                            .st21{opacity:0.5;fill:none;stroke:#000000;stroke-width:0.5;stroke-miterlimit:10;}
                                            .st22{fill:#011436;}
                                            .st23{fill:none;stroke:#FFFFFF;stroke-width:3;stroke-miterlimit:10;}
                                            .st24{fill:none;stroke:#6D6E71;stroke-width:0.5;stroke-miterlimit:10;}
                                            .st25{fill:url(#SVGID_1_);}
                                            .st26{fill:#020202;}
                                            .st27{fill:#CECECE;}
                                            .st28{fill:#EF5B36;}
                                            .st29{fill:none;stroke:#808285;stroke-width:0.5;stroke-miterlimit:10;}
                                            .st30{fill:#00A9DC;}
                                            .st31{fill:none;stroke:#7AD1F1;stroke-width:0.3728;stroke-miterlimit:10;}
                                            .st32{fill:url(#SVGID_18_);}
                                            .st33{fill:url(#SVGID_23_);}
                                            .st34{fill:url(#SVGID_40_);}
                                            .st35{fill:none;stroke:#414042;stroke-width:0.1;stroke-miterlimit:10;}
                                            .st36{fill:none;stroke:#008BCF;stroke-width:0.25;stroke-miterlimit:10;}
                                            .st37{clip-path:url(#SVGID_46_);}
                                            .st38{clip-path:url(#SVGID_52_);}
                                            .st39{opacity:0.5;fill:#B8DAE9;}
                                            .st40{fill:#BE1E2D;stroke:#F48989;stroke-miterlimit:10;}
                                            .st41{fill:#B8DAE9;}
                                            .st42{fill:#E6E7E8;}
                                            .st43{fill:none;stroke:#58595B;stroke-width:0.5;stroke-miterlimit:10;}
                                            .st44{opacity:0.4;}
                                            .st45{fill:#00325F;}
                                            .st46{fill:none;stroke:#011436;stroke-miterlimit:10;}
                                            .st47{clip-path:url(#SVGID_78_);}
                                            .st48{clip-path:url(#SVGID_84_);}
                                            .st49{fill:#58595B;stroke:#000000;stroke-width:0.25;stroke-miterlimit:10;}
                                            .st50{fill:none;stroke:#58595B;stroke-width:0.25;stroke-miterlimit:10;}
                                            .st51{fill:#EF4136;}
                                            .st52{fill:#E6E6E6;}
                                            .st53{fill:#808080;}
                                            .st54{fill:#ED1C24;}
                                            .st55{opacity:0.5;fill:none;stroke:#000000;stroke-width:0.1;stroke-miterlimit:10;}
                                            .st56{fill:none;stroke:#000000;stroke-width:0.1;stroke-miterlimit:10;}
                                            .st57{filter:url(#Adobe_OpacityMaskFilter);}
                                            .st58{fill:url(#SVGID_102_);}
                                            .st59{mask:url(#SVGID_101_);}
                                            .st60{fill:none;stroke:#00A9DC;stroke-miterlimit:10;}
                                            .st61{fill:url(#SVGID_105_);}
                                            .st62{fill:url(#SVGID_106_);}
                                            .st63{fill:url(#SVGID_107_);}
                                            .st64{fill:url(#SVGID_108_);}
                                            .st65{fill:#FEFEFE;}
                                            .st66{clip-path:url(#SVGID_110_);}
                                            .st67{fill:#235FD5;}
                                            .st68{fill:#6D6E71;}
                                            .st69{fill:#58595B;}
                                            .st70{fill:#F5F6F6;}
                                            .st71{clip-path:url(#SVGID_114_);}
                                            .st72{clip-path:url(#SVGID_120_);}
                                            .st73{fill:none;stroke:#000000;stroke-width:0.2616;stroke-miterlimit:10;}
                                            .st74{fill:none;stroke:#939598;stroke-width:0.3874;stroke-miterlimit:10;}
                                            .st75{fill:none;stroke:#939598;stroke-width:0.5232;stroke-miterlimit:10;}
                                            .st76{fill:none;stroke:#000000;stroke-width:1.0463;stroke-miterlimit:10;}
                                            .st77{fill:none;stroke:#808285;stroke-width:0.5232;stroke-miterlimit:10;}
                                            .st78{fill:none;stroke:#58595B;stroke-width:0.5232;stroke-miterlimit:10;}
                                            .st79{clip-path:url(#SVGID_138_);}
                                            .st80{clip-path:url(#SVGID_144_);}
                                            .st81{fill:none;stroke:#F0F1F1;stroke-width:0.75;stroke-miterlimit:10;}
                                            .st82{clip-path:url(#SVGID_154_);}
                                            .st83{fill:none;stroke:#231F20;stroke-width:0.75;stroke-miterlimit:10;}
                                            .st84{opacity:0.25;}
                                            .st85{fill:none;stroke:#F1F2F2;stroke-width:0.5;stroke-miterlimit:10;}
                                            .st86{fill:#FFFFFF;stroke:#6D6E71;stroke-width:0.25;stroke-miterlimit:10;}
                                            .st87{fill:#011436;stroke:#6D6E71;stroke-width:0.25;stroke-miterlimit:10;}
                                            .st88{fill:none;stroke:#011436;stroke-width:0.25;stroke-miterlimit:10;}
                                            .st89{clip-path:url(#SVGID_156_);fill:url(#SVGID_157_);}
                                            .st90{opacity:0.1;clip-path:url(#SVGID_159_);}
                                            .st91{clip-path:url(#SVGID_161_);}
                                            .st92{fill:none;stroke:#414042;stroke-width:0.5;stroke-miterlimit:10;}
                                            .st93{fill:none;stroke:#000000;stroke-width:0.25;stroke-miterlimit:10;stroke-dasharray:5.005,5.005;}
                                            .st94{fill:none;stroke:#000000;stroke-width:0.25;stroke-miterlimit:10;stroke-dasharray:5.028,5.028;}
                                            .st95{clip-path:url(#SVGID_165_);}
                                            .st96{clip-path:url(#SVGID_169_);}
                                            .st97{fill:#008BD0;}
                                            .st98{clip-path:url(#SVGID_175_);fill:none;stroke:#000000;stroke-width:0.5;stroke-miterlimit:10;}
                                            .st99{clip-path:url(#SVGID_175_);fill:none;stroke:#000000;stroke-width:0.5;stroke-miterlimit:10;stroke-dasharray:3.838,3.838;}
                                            .st100{fill:none;}
                                            .st101{clip-path:url(#SVGID_177_);fill:none;stroke:#000000;stroke-width:0.5;stroke-miterlimit:10;}
                                            .st102{clip-path:url(#SVGID_177_);fill:none;stroke:#000000;stroke-width:0.5;stroke-miterlimit:10;stroke-dasharray:3.838,3.838;}
                                            .st103{fill:#ffffff;}
                                            .st104{clip-path:url(#SVGID_179_);fill:none;stroke:#000000;stroke-miterlimit:10;}
                                            .st105{clip-path:url(#SVGID_181_);fill:#F1F2F2;}
                                            .st106{clip-path:url(#SVGID_183_);}
                                            .st107{clip-path:url(#SVGID_187_);}
                                            .st108{clip-path:url(#SVGID_191_);fill:none;stroke:#939598;stroke-width:0.5;stroke-miterlimit:10;}
                                            .st109{clip-path:url(#SVGID_193_);fill:none;stroke:#000000;stroke-miterlimit:10;}
                                            .st110{clip-path:url(#SVGID_195_);}
                                            .st111{clip-path:url(#SVGID_199_);}
                                            .st112{fill:url(#SVGID_202_);}
                                            .st113{clip-path:url(#SVGID_204_);}
                                            .st114{clip-path:url(#SVGID_208_);}
                                            .st115{clip-path:url(#SVGID_212_);fill:#B8DAE9;}
                                            .st116{clip-path:url(#SVGID_214_);fill:#B8DAE9;}
                                            .st117{clip-path:url(#SVGID_216_);fill:none;stroke:#58595B;stroke-width:0.25;stroke-miterlimit:10;}
                                            .st118{clip-path:url(#SVGID_220_);}
                                            .st119{fill:#001E38;}
                                            .st120{fill:none;stroke:#FFFFFF;stroke-width:0.5848;stroke-miterlimit:10;}
                                            .st121{fill:none;stroke:#FFFFFF;stroke-width:0.499;stroke-miterlimit:10;}
                                            .st122{fill:#03A9DB;}
                                            .st123{fill:none;stroke:#808285;stroke-width:0.499;stroke-miterlimit:10;}
                                            .st124{opacity:0.99;fill:#FFFFFF;stroke:#231F20;stroke-miterlimit:10;}
                                            .st125{fill:#231F20;}
                                            .st126{fill:none;stroke:#FFFFFF;stroke-width:0.5;stroke-miterlimit:10;}
                                        </style>
                                        <g id="Layer_1">
                                        </g>
                                        <g id="Layer_2">
                                            <circle class="st103" cx="12.5" cy="12.5" r="12.3" stroke="#000" stroke-width="1"/>
                                            <circle class="st126" cx="12.6" cy="11.1" r="4.5" stroke="#000" stroke-width="1"/>
                                            <path class="st126" d="M21,21.4c-1.3-3.4-4.6-5.8-8.4-5.8c-3.9,0-7.1,2.4-8.4,5.9"/>
                                        </g>
                                    </svg>
                                    <p>Tài khoản</p>
                                </a>
                            </li>
                        <?php } ?>
                            <li>
                                <nav class="nav-mobile">
                                    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
                                        <img src="<?php echo $urlThemeActive ?>/asset/image/linemobile.png" alt="">
                                        <p>Danh mục</p>
                                    </button>
                                    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
                                        <div class="offcanvas-header">
                                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"><i class="fa-solid fa-x"></i></button>
                                        </div>
                                        <div class="offcanvas-body">
                                            <ul class="navbar-nav justify-content-end flex-grow-1">
                                    
                                                 <?php 
                                                    $menu = getMenusDefault();
                                                  
                                                    if(!empty($menu)){
                                                    foreach($menu as $key => $value){
                                                      if(empty($value['sub'])){
                                                 ?>
                                                    <li class="nav-item">
                                                        <a class="nav-link active" aria-current="page" href="<?php echo $value['link']  ?>"><?php echo $value['name']  ?></a>
                                                    </li>
                                                <?php   }else{  ?>
                                                    <li class="nav-item dropdown">
                                                        <a class="nav-link dropdown-toggle" href="<?php echo $value['link']  ?>" role="button" data-bs-toggle="dropdown"
                                                           aria-expanded="false">
                                                            <?php echo $value['name']  ?>
                                                        </a>
                                                        <ul class="dropdown-menu">
                                                            <?php  foreach($value['sub'] as $keys => $values) { ?>
                                                            <li><a class="dropdown-item" href="<?php echo $values['link']  ?>"><?php echo $values['name']  ?></a></li>
                                                            <?php } ?>
                                                        </ul>
                                                    </li>
                                                    <?php }}} ?>

                                                   
                                            </ul>

                                            <div class="number-phone-mobile">
                                                <p>Điện thoại tư vấn :<a href="tel: <?php echo @$setting['phone'] ?>"> <?php echo @$setting['phone'] ?></a></p>
                                            </div>
                                           
                                             <?php if(!empty($infoUser)){ ?>

                                                  <div class="number-phone-mobile number-phone-logout">
                                                        <a href="/logout" class="nav-link ">Đăng xuất</a>
                                                   </div>
                                                        <?php }?>
                                             
                                        </div>
                                    </div>
                                </nav>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

    </section>

 <!-- mã xác nhân  -->
        <div class="modal-login modal-forgotpass">  
            <!-- Modal -->
            <div class="modal fade" id="exampleModalsale" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12 modal-right">
                                    <div class="or-login">
                                        <div class="forgot-text-title">
                                             Chưa có khuyến mãi 
                                        </div>
                                        <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button> -->

                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
  
    <a id="button-scrolltop"></a>

    <div class="contact-fixed">
        <div class="list-contact">
            <a id="button-contact-2">
                <div class="con-phone-bottom-box">
                    <img class="icon-phone-bottom" src="<?php echo $urlThemeActive ?>/asset/image/icon-me.png" alt=""> 
                </div>
                <div class="icon-close">
                    <i class="fa-solid fa-xmark"></i>
                </div>
                <div class="content-contact-2">
                    <div class="content-group">
                        <div class="content-contact-item">
                            <a href="<?php echo @$setting['contact-zalo-link'] ?>"><img class="icon-zalo" src="<?php echo $urlThemeActive ?>/asset/image/zalo.svg" alt=""></a>
                        </div>
                        <div class="content-contact-item content-contact-item-phone content-contact-margin">
                            <a href="<?php echo @$setting['contact-phone-link'] ?>"><img src="<?php echo $urlThemeActive ?>/asset/image/fileiconme.png" alt=""></a>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
    
    