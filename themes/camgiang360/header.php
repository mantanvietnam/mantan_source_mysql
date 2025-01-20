<?php
global $urlThemeActive;
global $isHome;
global $session;

$setting = setting();
$infoUser = $session->read('infoUser');
?>

<!doctype html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= $urlThemeActive ?>tayho/css/thaianh.css">

    <?php  if(@$isHome==false){ ?>
     <!-- FONTAWESOME 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
          integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>

    <!-- FILE INCLUDE CSS -->
    <link rel="stylesheet" href="<?= $urlThemeActive ?>tayho/assets/css/bootstrap.css">
    <link rel="stylesheet" href="<?= $urlThemeActive ?>tayho/assets/css/slick.css">
    <link rel="stylesheet" href="<?= $urlThemeActive ?>tayho/assets/css/slick-theme.css">

    <link rel="stylesheet" href="<?= $urlThemeActive ?>tayho/css/header.css">
    <link rel="stylesheet" href="<?= $urlThemeActive ?>tayho/css/footer.css">
    <link rel="stylesheet" href="<?= $urlThemeActive ?>tayho/css/particle.css">
    <link rel="stylesheet" href="<?= $urlThemeActive ?>tayho/css/style.css">
    <link rel="stylesheet" href="<?= $urlThemeActive ?>tayho/css/main.css">
    <link rel="stylesheet" href="<?= $urlThemeActive ?>tayho/css/font.css">
    <!-- FILE INCLUDE CSS END -->
    <!-- FILE INCLUDE JS -->
    <!-- MAP JS API -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
          integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
            integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>
    <script src="<?= $urlThemeActive ?>tayho/assets/js/jquery.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= $urlThemeActive ?>tayho/assets/js/slick.min.js"></script>
    <script src="<?= $urlThemeActive ?>tayho/js/jshieu.js"></script>
    <script src="<?= $urlThemeActive ?>tayho/js/slick.js"></script>
    <script src="<?= $urlThemeActive ?>tayho/js/slickslide.js"></script>
    <script src="<?= $urlThemeActive ?>tayho/assets/js/main.js"></script>
    <script src="<?= $urlThemeActive ?>tayho/js/slick.js"></script>

<?php }else{ ?>
    <link rel="stylesheet" href="<?= $urlThemeActive ?>maichau/css/main.css?time=100021">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css"/>
    <link rel="shortcut icon" type="image/png" href="../images/logo.png" />
    <!-- SLick -->

    <!-- Boostrap -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/css/bootstrap.min.css" integrity="sha512-SbiR/eusphKoMVVXysTKG/7VseWii+Y3FdHrt0EpKgpToZeemhqHeZeLWLhJutz/2ut2Vw1uQEj2MbRF+TVBUA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Fonawesome -->
    <script src="https://kit.fontawesome.com/9163bded0f.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>

<?php } ?>
   
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


</head>
<body>

<header>
    <section id="header">
        <div class="container">

            <!--  Phần Tìm Kiếm  -->
            <div class="row">
                <form class="search-input d-none d-md-block" action="/search" method="get">
                <div class="search-area">
                    <div class="search-input">
                        <input type="text"  name="key" placeholder="Tìm kiếm tại đây...">
                    </div>
                    <div class="search-btn">
                        <a href="/">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </a>
                    </div>
                </div>
            </form>
            </div>

            <!--  Phần Menu  -->
            <div class="row">
                <div class="top-menu" id="fixedNav">
                    <nav class="navbar navbar-expand-lg bg-body-tertiary">
                        <div class="container-fluid">
                            <a class="navbar-brand" href="/">
                                <img src="<?php echo $setting['image_logo'] ?>" alt="">
                            </a>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarNav">
                               <!--  <ul class="navbar-nav">
                                    <li class="nav-item">
                                        <a class="nav-link active" aria-current="page" href="#">Trang chủ</a>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            Danh mục điểm đến
                                            
                                        </a>
                                        <ul class="dropdown-menu relics-drop ">
                                            <li><a class="dropdown-item" href="#">Danh lam thắng cảnh</a></li>
                                            <li><a class="dropdown-item" href="#">Điểm du lịch cộng đồng</a></li>
                                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                                        </ul>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Tin tức - Sự kiện</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Bản đồ số</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Liên hệ</a>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-chevron-down dropdown-icon"></i>

                                        </a>
                                        <ul class="dropdown-menu language-drop">
                                            <li><a class="dropdown-item" href="#">Tiếng Việt</a></li>
                                            <li><a class="dropdown-item" href="#">Tiếng Anh</a></li>
                                        </ul>
                                    </li>
                                </ul> -->
                                <ul class="navbar-nav">
                                    <?php
                                    $menu = getMenusDefault();
                                    if(!empty($menu)){
                                        foreach($menu as $key => $value){
                                            if(empty($value['sub'])){
                                                echo '   <li class="nav-item">
                                                <a class="nav-link active" aria-current="page" href="'.$value['link'].'">'.$value['name'].'</a>
                                                </li>';
                                            }else{ 
                                                echo '   <li class="nav-item dropdown">
                                                <a class="nav-link dropdown-toggle" href="'.$value['link'].'" role="button" data-bs-toggle="dropdown" aria-expanded="false"> '.$value['name'].'
                                                <i class="fa-solid fa-chevron-down dropdown-icon"></i>
                                                </a>
                                                <ul class="dropdown-menu relics-drop">';
                                                foreach($value['sub'] as $keys => $values){  
                                                    echo '<li><a class="dropdown-item" href="'.$values['link'].'">'.$values['name'].'</a></li>';
                                                }

                                                echo'</ul>
                                                </li>';
                                            }
                                        }
                                    } 
                                    ?>

                                    <li class="nav-item dropdown user-login">
                                        <?php if (!empty($infoUser)) { ?>
                                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button"
                                               data-bs-toggle="dropdown">
                                                <img src="<?php echo @$infoUser['avatar']; ?>" style=" width: 25px; border-radius: 20px;"
                                                     alt="">
                                                <span class="username ms-3">Xin chào <?php echo $infoUser['full_name']; ?></span>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="/diem_den_yeu_thich">Yêu thích</a></li>
                                                <li><a class="dropdown-item" href="/editInfoUser">Tài khoản</a></li>
                                                <li><a class="dropdown-item" href="/changepassword">Đổi mật khẩu</a></li>
                                                <li><a class="dropdown-item " href="/logout">Đăng xuất</a></li>
                                            </ul>
                                        <?php } else { ?>
                                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="/login">Đăng nhập</a>
                                        <?php } ?>
                                    </li>

                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-chevron-down dropdown-icon"></i>

                                        </a>
                                        <ul class="dropdown-menu language-drop">
                                            <li><a class="dropdown-item" href="#">Tiếng Việt</a></li>
                                            <li><a class="dropdown-item" href="#">Tiếng Anh</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </section>

</header>










