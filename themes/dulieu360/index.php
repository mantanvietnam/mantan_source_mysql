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


</head>
<body>

<!-- <header>
    <div class="top bg-primary-cus py-2">
        <div class="container">
            <div class="d-flex justify-content-end align-items-center">
                <form class="search-input d-none d-md-block" action="/search" method="get">
                    <img src="<?= $urlThemeActive ?>/assets/lou_icon/icon-search.svg" class="me-2" alt="">
                    <input type="text" name="key" placeholder="Tìm kiếm">
                </form>
                <li class="nav-item dropdown user-login">
                    
                </li>
                <a href="https://tayho360.vn/" class="lang d-block">
                    <img src="<?= $urlThemeActive ?>assets/lou_icon/lang-vn.svg" alt="">
                </a>
                <a href="https://en.tayho360.vn/" class="lang d-block">
                    <img src="<?= $urlThemeActive ?>assets/lou_icon/lang-en.svg" alt="">
                </a>
            </div>
        </div>
    </div>
    <div class="main-nav">
        <div class="container-xxl">
            <nav class="navbar navbar-expand-xl">
                <div class="container-fluid">
                    <a class="navbar-brand d-block" href="/">
                        <img src="" style=" width: 55px; " alt="">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            
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
                    </div>
                </div>
            </nav>
        </div>
    </div>
</header> -->
<div id="header">
        <div id="top-bar">
            <div class="container-fluid">
                <ul class="nav nav-pills">
                    <div class="date"><?php echo sw_get_current_weekday() ?></div>
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
                        <li class="nav-item register">
                        <!--     <a href="">Đăng ký</a>
                        </li>
                        <li class="nav-item log-in">
                            <a href="">Đăng nhập</a>
                        </li> -->
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
                    <a class="navbar-brand" href="#">
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
        <div id="banner-360">
            <div class="videoWrapper">
                <iframe src="<?php echo @$setting['link_image360']; ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
            <div id="hide-1" class="fake-banner"></div>

            <div id="hide-2" class="container-fluid">
                <div class="content-title">
                    <h1><?php echo @$setting['welcome1']; ?>
                    </h1>
                </div>
                <div id="btn-360" class="btn-play-360">
                    <button onClick="hideDiv()">
                        <i class="fa-solid fa-circle-play"></i>
                        <p>Khám phá</p>
                    </button>
                </div>

            </div>

            <div class="icon-scroll-down bar-1">
                <div class="chevron"></div>
            </div>
            <div class="icon-scroll-down bar-2">
                <div class="chevron"></div>
            </div>
            <div class="icon-scroll-down bar-3">
                <div class="chevron"></div>
            </div>
        </div>
    </div>
    <main>
        <div id="about">
            <div class="container-fluid">
                <div class="title-about">
                    <h2>Giới thiệu</h2>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-12">

                    </div>

                    <div class="col-lg-6 col-md-12 col-12 wrsap-content">
                        <div class="content-about">
                            <div class="list-content">
                                <?php echo @$setting['content']; ?>
                            </div>
                            <!-- <button class="btn_about_1">Xem thêm</button>
                            <button class="btn_about_2">Ẩn bớt</button> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="profile">
            <img class="bg-profile" src="<?php echo $urlThemeActive ?>assets/img/bg-dot.png">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 text-center">
                        <div class="infor-profile">
                            <div class="title-profile">
                                <h2>
                                    Tìm hiểu quận đống đa<br> qua profile hình ảnh
                                </h2>
                            </div>
                            <div>
                                <button class="btn_profile">Xem profile</button>
                            </div>
                        </div>
                        <div id="pdf">
                            <button class="close_pdf">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                            <iframe src="<?php echo @$setting['profile']; ?>" frameborder="0"></iframe>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 img-profile">
                        <img src="<?php echo @$setting['imge_profile']; ?>">
                    </div>
                </div>
            </div>
        </div>

        <div id="destination">
            <div class="bg-des">
                <div class="container">
                    <div class="title-des">Điểm đến</div>
                    <div class="list-des">
                        <div class="items-des">
                            <a href="/danh_lam">
                                <img src="<?php echo $urlThemeActive ?>assets/img/danhlam.svg" alt="">
                                <p>Di tích & danh lam</p>
                            </a>
                        </div>
                        <div class="items-des">
                            <a href="/le_hoi">
                                <img src="<?php echo $urlThemeActive ?>assets/img/lehoi.svg" alt="">
                                <p>Lễ hội</p>
                            </a>
                        </div>
                        <div class="items-des">
                            <a href="/co_quan_hanh_chinh">
                                <img src="<?php echo $urlThemeActive ?>assets/img/coquan.svg" alt="">
                                <p>Cơ Quan Hành Chính</p>
                            </a>
                        </div>
                        <div class="items-des">
                            <a href="/khach_san">
                                <img src="<?php echo $urlThemeActive ?>assets/img/khachsan.svg" alt="">
                                <p>Khách sạn</p>
                            </a>
                        </div>
                        <div class="items-des">
                            <a href="/nha_hang">
                                <img src="<?php echo $urlThemeActive ?>assets/img/nhahang.svg" alt="">
                                <p>Nhà hàng quán ăn</p>
                            </a>
                        </div>
                        <div class="items-des">
                            <a href="/trung_tam_hoi_nghi_su_kien">
                                <img src="<?php echo $urlThemeActive ?>assets/img/tttm.svg" alt="">
                                <p>Trung tâm thương mại</p>
                            </a>
                        </div>
                        <div class="items-des">
                            <a href="/thu_gian_giai_tri">
                                <img src="<?php echo $urlThemeActive ?>assets/img/giaitri.svg" alt="">
                                <p>Thư giãn giải trí</p>
                            </a>
                        </div>
                        <div class="items-des">
                            <a href="/dich_vu_ho_tro_du_lich">
                                <img src="<?php echo $urlThemeActive ?>assets/img/dv.svg" alt="">
                                <p>Dịch vụ hỗ trợ</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="places">
            <img class="bg-places" src="<?php echo $urlThemeActive ?>assets/img/bg-dot.png">
            <div class="container-fluid">
                <div class="title-places">Cảm hứng du lịch</div>
                <div class="slider">
                    <div class="list-places">
                        <?php 
                    
                        foreach($tmpVariable['listDataPost'] as $key => $item){ ?>
                        <div class="item-places">
                            <div class="box-place">
                                <div class="img-place">
                                    <img src="https://dongda360.vn/storage/posts/comga.jpg">
                                </div>
                                <div class="infor-places">
                                    <a href="/<?php echo @$item['slug'];?>.html"><?php echo @$item['title'];?></a>
                                    <div class="address">
                                        <i class="fa-solid fa-location-dot"></i>
                                        <p>Quận đống đa - Hà nội</p>
                                    </div>
                                    <p><?php echo @$item['description'];?></p>
                                    <a href="/<?php echo @$item['slug'];?>.html" class="btn-place">Xem thêm</a>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>

        </div>

        <div id="event">
            <div class="container-fluid">
                <div class="title-event">Sự kiện</div>

                <div class="change-month">
                    <select id="event-selector" onchange="showEvent()">
                        <?php foreach($tmpVariable['listDataEvent'] as $key => $item){ ?>
                        <option value="event-m<?php echo $key ?>"><?php echo $item['name'] ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="event-12-month">
                    
                    <?php foreach($tmpVariable['listDataEvent'] as $key => $item){

                        if(!empty($item['event'])){
                            if($key%2 != 0){
                    ?>
                    <div id="event-m<?php echo $key ?>" class="slide-event row">
                        <?php foreach($item['event'] as $k => $value){ ?>
                        <div class="item-event col">
                            <div class="item-event-5">
                                <div class="content-event">
                                    <div class="name">
                                        <a href="/chi_tiet_su_kien/<?php echo $value->name ?>.html"></a><?php echo $value->name ?></div>
                                    <div class="cerlender-event">
                                        <i class="fa-solid fa-calendar-days"></i><?php echo date('d-m-Y',$value->datestart); ?>
                                    </div>
                                    <div class="addr-event">
                                        <i class="fa-solid fa-location-dot"></i> <?php echo $value->address ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    </div>
                    <?php }else{ ?>
                    <div id="event-m<?php echo $key ?>" class="slide-event row">
                        <?php foreach($item['event'] as $k => $value){ ?>
                        <div class="item-event col">
                            <div class="item-event-6-1">
                                <div class="content-event">
                                    <div class="name">
                                        <a href="/chi_tiet_su_kien/<?php echo $value->name ?>.html"></a><?php echo $value->name ?></div>
                                    <div class="cerlender-event">
                                        <i class="fa-solid fa-calendar-days"></i><?php echo date('d-m-Y',$value->datestart); ?>
                                    </div>
                                    <div class="addr-event">
                                        <i class="fa-solid fa-location-dot"></i><?php echo $value->address ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    </div>


                <?php }}else{ ?>
                    
                    <div id="event-m<?php echo $key ?>" class="slide-event row">
                        <h4>Không có sự kiện nào trong tháng này</h4>
                    </div>

                    <?php }} ?>
                </div>

                <div class="line-event"></div>
                <div class="month">
                    <?php foreach($tmpVariable['listDataEvent'] as $key => $item){ ?>
                    <button class="btn-event" onclick="openEvent('event-m<?php echo $key ?>')"><?php echo $item['name']; ?>
                    </button>
                    <?php if($key!=12){ ?>
                    <div class="dot"></div>
                    <?php }} ?>
                </div>
            </div>
        </div>

        <div id="tour">
            <div class="title-tour">Tour nổi bật</div>
            <div class="container-fluid">
                <div class="card-tour card-tour-1">
                    <div class="row">
                        
                    <?php foreach($tmpVariable['listDataTour'] as $key => $item){ ?>
                        <div class="col col-lg-4 col-sm-12">
                            <div class="box-tour">
                                <div class="icon-360">
                                    <img src="https://dongda360.vn/img/home/360.svg" alt="">
                                </div>
                                <div class="img-tour">
                                    <img src="<?php echo $item->image; ?>">
                                </div>
                                <div class="infor-tour">
                                    <div class="name-tour">
                                        <a href="/chi_tiet_tour/<?php echo $item->urlSlug; ?>.html"><?php echo $item->name; ?></a>
                                    </div>
                                    <div class="icon-tour">
                                        <div class="star-tour">
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                        </div>
                                        <div class="view-tour">
                                            <div class="number-view">2230
                                                <i class="fa-solid fa-eye"></i>
                                            </div>
                                            <div class="number-tym">315
                                                <i class="fa-solid fa-heart"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    </div>
                </div>

                <!-- <div class="card-tour card-tour-2">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="box-tour">
                                <div class="icon-360">
                                    <img src="https://dongda360.vn/img/home/360.svg" alt="">
                                </div>
                                <div class="img-tour">
                                    <img src="<?php echo $urlThemeActive ?>assets/img/vanmieu.jpg">
                                </div>
                                <div class="infor-tour">
                                    <div class="name-tour">
                                        <a href="">Tour du lịch văn miếu</a>
                                    </div>
                                    <div class="icon-tour">
                                        <div class="star-tour">
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                        </div>
                                        <div class="view-tour">
                                            <div class="number-view">2452
                                                <i class="fa-solid fa-eye"></i>
                                            </div>
                                            <div class="number-tym">3
                                                <i class="fa-solid fa-heart"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->

            
            </div>
        </div>

        <div id="map">
            <div class="title-map">
                <p>Bản đồ</p>
            </div>
            <div class="ifr-map">
            <!--  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d29795.593359825012!2d105.79992337910909!3d21.014706260363894!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab82178be9eb%3A0x429104feae49bd75!2zxJDhu5FuZyDEkGEsIEjDoCBO4buZaSwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1696844162998!5m2!1svi!2s"
                    width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe> -->
                    <?php 
                    //include("findnear_google_map.php"); 
                    include("findnear_openstreet_map.php"); 
                ?>
            </div>
        </div>


    </main>
    <style type="text/css">
        #mapid {
            width: 100%;
            height: 500px;
        }
    </style>
    <script src="<?php echo $urlThemeActive ?>js/js.js"></script>
    <script src="<?php echo $urlThemeActive ?>js/particles.min.js"></script>
    <script src="<?php echo $urlThemeActive ?>js/particle.js"></script>
 <script type="text/javascript">
    // load event
function loadEvent(e) {
  var month = $(e).attr('data-month');
  console.log(month);
  //var url = 'su_kien?month='+month;
  $.ajax({
      type: "GET",
      url: '/apis/ajax_event',
      data:{ month:month }
    }).done(function( msg ) {
        console.log(msg);
      /*var msg = JSON.parse(msg);
      console.log(msg);*/
      $('.in-box-event-home').html(msg.text);
    });
     eventhome();
    
}

function eventhome(){
  $('.in-box-event-home').slick({

    dots: false,

    infinite: true,

    arrows: true,

    speed: 500,

    fade: true,

    cssEase: 'linear',

    prevArrow: `<button type='button' class='slick-prev pull-left'><i class="fa-solid fa-angle-left"></i></button>`,

    nextArrow: `<button type='button' class='slick-next pull-right'><i class="fa-solid fa-angle-right"></i></button>`

  });
}

function loadEventNextPrev(e) {
  var month = $('.slick-active').attr('data-month');

  if(e = 1){
    month = Number(month) + 1;
  }else{
     month = Number(month) - 1;
  }
  console.log(month);   
  $.ajax({
      type: "GET",
      url: '/apis/ajax_event',
      data:{ month:month }
    }).done(function( msg ) {
     //document.getElementById("event-month-s").remove();
      $('.in-box-event-home').html(msg.text);
    });
     eventhome();

}

// menu scroll 
// $(document).ready(function() {
//     const button = document.querySelector(".mon-pull-right");
//     button.setAttribute("onclick", "loadEventNextPrev(1)");

//    const butt = document.querySelector(".mon-pull-left");
//    butt.setAttribute("onclick", "loadEventNextPrev(2)");
// });

</script> 

<?php
getFooter();?>
