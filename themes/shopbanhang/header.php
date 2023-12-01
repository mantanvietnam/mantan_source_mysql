<?php
global $urlThemeActive;
$setting = setting();
global $session;
$infoUser = $session->read('infoUser');
 $cart = 0;
 if(!empty($session->read('product_order'))){
    $cart = count($session->read('product_order')); 
 }
    
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
     <script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window, document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '1428203714597073');
fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=1428203714597073&ev=PageView&noscript=1"
/></noscript>
</head>
<body>
    <header>
        <div class="promotion-header">
            <p><?php echo $setting['text_mobile']; ?></p>
            <a href="/sela">Mua ngay</a>
            <i class="fa-solid fa-arrow-right"></i>
        </div>

        <div class="header-inner">
            <div class="topbar-mobile">
                <div class="container-fluid">
                    <div class="topbar-mobile-inner">
                        <div class="topbar-logo">
                            <a href="/"><img src="<?php echo $urlThemeActive ?>asset/image/logo_mobile.png" alt=""></a>
                        </div>

                        <form class="menu-form-search d-flex" role="search">
                            <input class="form-control" type="text" name="key" placeholder="Tìm kiếm nhanh" aria-label="Search">
                            <button class="btn btn-outline-success button-search" type="submit"><img src="<?php echo $urlThemeActive ?>asset/image/iconsearch.png" alt=""></button>
                        </form>

                        <div class="topbar-button">
                            <a href="/cart">
                                <img src="<?php echo $urlThemeActive ?>asset/image/cartitem.png" alt="">
                            </a>   
                        </div>
                    </div>
                </div>
            </div>

            <div class="topbar">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-12 topbar-logo">
                            <a href="/"><img src="<?php echo $urlThemeActive ?>asset/image/logophong.png" alt=""></a>
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-3 col-12 topbar-phone">
                       
                        </div>
            
                      
            
                        <div class="col-lg-5 col-md-5 col-sm-5 col-12 topbar-group-button">
                            <div class="phone-header topbar-phone">
                                    <img src="<?php echo $urlThemeActive ?>asset/image/headphone.png" alt="">&nbsp;
                                    <span><?php echo @$setting['phone'] ?></span>
                            </div>

                            <div class="topbar-button">
                                <img src="<?php echo $urlThemeActive ?>asset/image/account.png" alt="">
                                <?php if(!empty($infoUser)){ ?>
                                    <a href="/infoUser" >Tài khoản của tôi</a>
                                    <a href="/logout" >Đăng xuất</a>
                                <?php }else{ ?>
                                <a href=""  data-bs-toggle="modal" data-bs-target="#exampleModal">Đăng nhập</a>
                            <?php } ?>
                            </div>
                             
                            <div class="topbar-button">
                                <a href="/cart"><img src="<?php echo $urlThemeActive ?>asset/image/cartitem.png" alt=""></a>
                                <a href="/cart">Giỏ hàng</a>
                                <span><?php echo @$cart; ?></span>

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
    
                        
    
                            <li class="nav-item nav-item-last">
                                <a class="nav-link" href="/sela">Khuyến mãi</a>
                            </li>
                        </ul>
                        <form class="menu-form-search d-flex" role="search"  action="/search-product" method="get" id="myForm">
                            <input class="form-control" type="text" name="key" placeholder="" aria-label="Search">
                            <button class="btn btn-outline-success button-search" type="submit"><img src="<?php echo $urlThemeActive ?>asset/image/iconsearch.png" alt=""></button>
                        </form>
                        </div>
                    </div>
                </nav>
            </div>

            <!-- mobile -->
            <div class="menu-mobile">
                <div class="menu-mobile-inner">
                    <div class="menu-mobile-box">
                        <ul>
                            <li>
                                <a href="/">
                                    <img src="<?php echo $urlThemeActive ?>/asset/image/homebluemobile.png" alt="">
                                    <p>Trang chủ</p>
                                </a>
                            </li>

                            <li>
                                <a href="/sela">
                                    <img src="<?php echo $urlThemeActive ?>/asset/image/percentmobile.png" alt="">
                                    <p>Khuyến mãi</p>
                                </a>
                            </li>

                            <li>
                                <a href="/contact">
                                    <img src="<?php echo $urlThemeActive ?>/asset/image/peoplemobile.png" alt="">
                                    <p>Tư vấn</p> 
                                </a>
                            </li>

                            <li>
                                <a href="/cart">
                                    <img src="<?php echo $urlThemeActive ?>/asset/image/cartmobile.png" alt="">
                                    <p>Giỏ hàng</p>
                                </a>
                            </li>

                             <?php if(!empty($infoUser)){ ?>

                            <li>

                                <a href="/infoUser">
                                    <img src="<?php echo $urlThemeActive ?>/asset/image/infomobile.png" alt="">
                                    <p>Tài khoản</p>
                                </a>
                            </li>
                                <?php }else{ ?>
                            <li>

                                <a href="" data-bs-toggle="modal" data-bs-target="#exampleModal"><img src="<?php echo $urlThemeActive ?>/asset/image/infomobile.png" alt="">
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
                                    <div class="offcanvas" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
                                        <div class="offcanvas-header">
                                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"><i class="fa-solid fa-x"></i></button>
                                        </div>
                                        <div class="offcanvas-body">
                                            <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                                    
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
                                           
                                             <?php if(!empty($infoUser)){ ?>

                                                  <div class="number-phone-mobile">

                                                        <a href="/logout" class="nav-link ">Đăng xuất</a>
                                                   </div>
                                                        <?php }?>
                                             <div class="number-phone-mobile">
                                                <p>Điện thoại tư vấn : <?php echo @$setting['phone'] ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </nav>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
        

    </header>