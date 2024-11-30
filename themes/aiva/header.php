<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Side Navigation Menu</title>
    <link rel="stylesheet" href="<?= $urlThemeActive?>/asset/css/all.min.css">
    <link rel="stylesheet" href="<?= $urlThemeActive?>/asset/css/style.css">
    <link rel="stylesheet" href="<?= $urlThemeActive?>/asset/css/mainvu.css">
    <link rel="stylesheet" href="<?= $urlThemeActive?>/asset/css/mainhoang.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.0/css/all.min.css" integrity="sha512-9xKTRVabjVeZmc+GUW8GgSmcREDunMM+Dt/GrzchfN8tkwHizc5RP4Ok/MXFFy5rIjJjzhndFScTceq5e6GvVQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="/webroot/assets_admin/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <link rel="stylesheet" href="/webroot/assets_admin/vendor/libs/apex-charts/apex-charts.css" />
    <link rel="stylesheet" href="/webroot/css/jquery.datetimepicker.min.css" />

    <!-- Page CSS -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="/webroot/assets_admin/vendor/libs/jquery/jquery.js"></script>
    <script src="/webroot/assets_admin/vendor/libs/popper/popper.js"></script>
    <script src="/webroot/assets_admin/vendor/js/bootstrap.js"></script>
    <script src="/webroot/assets_admin/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script src="/webroot/assets_admin/vendor/js/menu.js"></script>
    <script type="text/javascript" src="/webroot/ckfinder/ckfinder.js"></script>
    <script language="javascript" src="/webroot/ckeditor/ckeditor.js" type="text/javascript"></script>
    <script language="javascript" src="/webroot/js/jquery.datetimepicker.full.min.js" type="text/javascript"></script>
</head>
<body>
    <main class="main-wrap">
        <header class="main-head">
            <div class="main-nav">
                <nav class="navbar-a">
                    <div class="navbar-nav">
                        <div class="title">
                            <div class="title-padding">
                                <h3>
                                    <i class="fa-brands fa-app-store-ios"></i>
                                    <span class="title-text">AIVA</span>
                                </h3>
                            </div>
                            <div class="head">
                                <button class="toggler">
                                    <i class="fa-solid fa-bars-staggered"></i>
                                </button> 
                            </div>
                        </div>
                        <ul class="nav-list">
                            <li class="nav-list-item">
                                <a href="#" class="nav-link">
                                    <i class="fa-solid fa-house"></i>
                                    <span class="link-text">Trang chủ</span>
                                </a>
                            </li>
                            <li class="nav-list-item">
                                <a href="<?= $urlThemeActive?>/asset/aiva-chat.html" class="nav-link">
                                    <i class="fa-solid fa-qrcode"></i>
                                    <span class="link-text">Chat với Aiva</span>
                                </a>
                            </li>
                            <li class="nav-list-item">
                                <a href="<?= $urlThemeActive?>/asset/aiva-chat.html" class="nav-link">
                                    <i class="fa-solid fa-user"></i>
                                    <span class="link-text">Trợ lý Aiva</span>
                                </a>
                            </li>
                            <li class="nav-list-item">
                                <a href="#" class="nav-link">
                                    <i class="fa-solid fa-link"></i>
                                    <span class="link-text">Aiva Hình ảnh</span>
                                </a>
                            </li>
                            <li class="nav-list-item">
                                <a href="#" class="nav-link">
                                    <i class="fa-brands fa-steam"></i>
                                    <span class="link-text">Text to speech</span>
                                </a>
                            </li>
                            <li class="nav-list-item">
                                <a href="#" class="nav-link">
                                    <i class="fa-solid fa-calendar-days"></i>
                                    <span class="link-text">Hướng dẫn</span>
                                </a>
                            </li>
                            <li class="nav-list-item">
                                <a href="#" class="nav-link">
                                    <i class="fa-solid fa-circle-info"></i>
                                    <span class="link-text">Cộng tác viên Aiva</span>
                                </a>
                            </li>
                            <li class="nav-list-item">
                                <a href="#" class="nav-link">
                                    <i class="fa-brands fa-servicestack"></i>
                                    <span class="link-text">Cài đặt</span>
                                </a>
                            </li>
                            <li class="nav-list-item">
                                <a href="#" class="nav-link">
                                    <i class="fa-solid fa-envelope-circle-check"></i>
                                    <span class="link-text">Dữ liệu mẫu</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
       
            </div>
        </header>
        <section class="showcase ">
            <div class="overlay">
                <div class="head container d-flex">
                    <div class="dropdown mx-4">
                        <button class="btn btn-custom dropdown-toggle " type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                            Trợ lý
                        </button>
                        <ul class="dropdown-menu dropmenu" aria-labelledby="dropdownMenuButton">
                            <li><a class="dropdown-item" href="#">Trợ lý</a></li>
                            <li><a class="dropdown-item" href="#">Tài liệu</a></li>
                        </ul>
                    </div>
                    <!-- Thanh tìm kiếm -->
                    <div class="search-box d-flex align-items-center">
                            <input type="text" class="form-control search-input" placeholder="Tìm kiếm trợ lý Aiva">
                            <button class="btn search-btn">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                    </div>
            
                    <!-- Nút nâng cấp -->
                    <button class="btn btn-upgrade d-flex align-items-center">
                        <i class="fa-solid fa-crown mx-1"></i>
                            Nâng cấp
                    </button>
            
                    <!-- Biểu tượng thông báo -->
                    <div class="notification-icon position-relative">
                        <i class="fa-regular fa-bell"></i>
                        <span class="badge position-absolute top-0 start-100 translate-middle bg-danger text-white">1</span>
                    </div>
            
                    <!-- Biểu tượng người dùng -->
                    <div class="user-icon">
                        <div class="dropdown">
                            <img src="<?= $urlThemeActive?>/asset/img/avatar.jpg" alt="Avatar" class="rounded-circle dropdown-toggle" 
                                 id="avatarDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="cursor: pointer;">
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="avatarDropdown">
                                <div class="user-info d-flex">
                                    <img src="<?= $urlThemeActive?>/asset/img/avatar.jpg" alt="Avatar">
                                    <div class="contact-info mx-2">
                                        <div class="name">Nguyễn Văn A</div>
                                        <div class="email">email@example.com</div>
                                        <div class="credit">0 <span>Credit</span></div>
                                        <a href="#">Chỉnh sửa hồ sơ</a>
                                    </div>
                                </div>
                              <li><a class="dropdown-item contact-info-icon mt-3" href="<?= $urlThemeActive?>/asset/aiva-setting.html"><img src="<?= $urlThemeActive?>/asset/img/caiddat.svg" alt=""> Cài đặt</a></li>
                              <li><a class="dropdown-item contact-info-icon" href="#"><img src="<?= $urlThemeActive?>/asset/img/dangxuat.svg" alt=""> Đăng xuất</a></li>
                            </ul>
                          </div>
                    </div>
                </div>