<?php
global $urlThemeActive;
include_once("helper.php");
$setting = setting();
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= $urlThemeActive ?>assets/js/slick.min.js"></script>
    <script src="<?= $urlThemeActive ?>js/jshieu.js"></script>
    <script src="/themes/tayho360/js/slick.js"></script>
    <script src="<?= $urlThemeActive ?>js/slickslide.js"></script>
    <script src="<?= $urlThemeActive ?>assets/js/main.js"></script>
    <script src="/themes/tayho360/js/slick.js"></script>
    <!-- FILE INCLUDE JS END -->
    <?php mantan_header(); ?>
    <!-- Meta Pixel Code -->
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
<!-- End Meta Pixel Code -->

 <link rel="stylesheet" href="<?= $urlThemeActive ?>assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
    <script src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="https://kit.fontawesome.com/9163bded0f.js" crossorigin="anonymous"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> -->

<style type="text/css">
    #foot_bar{
        background-color: rgb(1, 150, 128);
    }
    #header {
    position: relative;
    height: 125px;
    background: rgb(1, 150, 128);
    overflow: hidden;
}
</style>
</head>
<body>
<div id="header">
        <div id="top-bar">
            <div class="container-fluid">
                <ul class="nav nav-pills">
                    <div class="date">Thứ Ba, 03/10/2023</div>
                    <div class="box-search">
                        <button class="nav-link" onclick="showSearchModal()">
                            <i class="fa-solid fa-magnifying-glass" style="color: #fcfcfc;"></i>
                            Tìm kiếm
                        </button>
                    </div>
                    <div class="items">
                         <?php if (!empty($infoUser)) { ?>
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button"
                           data-bs-toggle="dropdown">
                            <img src="<?php echo @$infoUser['avatar']; ?>" style=" width: 25px; border-radius: 20px;"
                                 alt="">
                            <span class="username ms-3">Xin chào <?php echo $infoUser['full_name']; ?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/bookingonline">Đặt phòng</a></li>
                            <li><a class="dropdown-item" href="/diem_den_yeu_thich">Yêu thích</a></li>
                            <li><a class="dropdown-item" href="/infoUser">Tài khoản</a></li>
                            <li><a class="dropdown-item " href="/logout">Đăng xuất</a></li>
                        </ul>
                    <?php } else { ?>
                        <a class="nav-link d-flex align-items-center" style=" color: white; "
                           href="/login">Đăng nhập</a>
                    <?php } ?>
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-earth-asia"></i>
                                <span class="lang-text">Language:</span> Tiếng Việt
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <li><a class="dropdown-item" href="#">Tiếng Việt</a></li>
                                <li><a class="dropdown-item" href="#">English</a></li>
                            </ul>
                        </li>
                    </div>
                </ul>
            </div>
        </div>
         <div id="foot_bar">
            <div class="container-fluid">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="navbar-brand" href="/">
                        <img src="<?php echo @$setting['image_logo']; ?>" style="max-width: 100%;" alt="">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                      <span><i class="fa-solid fa-bars" style="color: #f7f7f7;"></i></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                              <?php 
                            $menu = getMenusDefault();
                         
                            if(!empty($menu)){
                            foreach($menu as $key => $value){
                              if(empty($value->sub)){
                         ?>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="<?php echo $value->links ?>"><?php echo $value->name; ?></a>
                            </li>
                        <?php   }else{  ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="<?php echo $value->link;  ?>" role="button" data-bs-toggle="dropdown"
                                   aria-expanded="false">
                                    <?php echo $value->name  ?>
                                </a>
                                <ul class="dropdown-menu">
                                    <?php  foreach($value['sub'] as $keys => $values) { ?>
                                    <li><a class="dropdown-item" href="<?php echo $values->link; ?>"><?php echo $values->name;  ?></a></li>
                                    <?php } ?>
                                </ul>
                            </li>
                            <?php }}} ?>
                            <li class="nav-item item-search">
                                <button class="nav-link" onclick="showSearchModal()">
                                    <i class="fa-solid fa-magnifying-glass" style="color: #fcfcfc;"></i>
                                </button>
                            </li>
                            <li class="nav-item">
                                <div class="line-nav"></div>
                            </li>

                        </ul>


                    </div>
                </nav>
            </div>
        </div>
        <div id="screen-search">
            <button class="btn-close-search" onclick="closeSearchModal()">
                <i class="fa-solid fa-xmark"></i>
            </button>
            <div class="form-group">
                <label>Nhập từ khóa: </label>
                <form action="/search" method="get">
                    <label>Nhập từ khóa: </label>
                    <div class="input-form">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <input type="text" class="input-keyword" name="key" placeholder="Nhập từ khóa và ấn enter">
                    </div>
                </form>
            </div>
        </div>
        
    </div>







