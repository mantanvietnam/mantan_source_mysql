<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php mantan_header();
     global $settingThemes;
     ?>
    <link rel="stylesheet" href="<?php echo $urlThemeActive;?>/asset/css/toptop.css">
    <!-- boostrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <!-- slick -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />

    <body>
        <header>
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-light pos-ab pt-4">
                <div class="container d-flex justify-content-between">
                    <!-- Logo Section -->
                    <div class="col-lg-5 d-flex align-items-center">
                        <a class="navbar-brand" href="#">
                            <img src="<?= @$settingThemes['logo'];?>" alt="Logo" class="logo">
                        </a>
                    </div>

                    <!-- Nút toggle cho navbar -->
                    <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <!-- Dropdown Menu Section -->
                    <div class="collapse navbar-collapse justify-content-end" id="navbarNav" style="background-color: white; padding: 10px 20px; border-radius: 27px;">
                        <!-- Dropdowns in Navbar -->
                        <ul class="navbar-nav">
                            <!-- Dropdown Giới thiệu -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-white" href="#" id="gioi-thieu-dropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Giới thiệu
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="gioi-thieu-dropdown">
                                    <li><a class="dropdown-item" href="#">Thông tin công ty</a></li>
                                    <li><a class="dropdown-item" href="#">Sứ mệnh</a></li>
                                </ul>
                            </li>
                    
                            <!-- Dropdown Công nghệ -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-white" href="#" id="cong-nghe-dropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Công nghệ
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="cong-nghe-dropdown">
                                    <li><a class="dropdown-item" href="#">VR360</a></li>
                                    <li><a class="dropdown-item" href="#">3D Mapping</a></li>
                                </ul>
                            </li>
                    
                            <!-- Dropdown Bảng giá -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-white" href="#" id="bang-gia-dropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Bảng giá
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="bang-gia-dropdown">
                                    <li><a class="dropdown-item" href="#">Gói cơ bản</a></li>
                                    <li><a class="dropdown-item" href="#">Gói nâng cao</a></li>
                                </ul>
                            </li>
                    
                            <!-- Dropdown Khách hàng -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-white" href="#" id="khach-hang-dropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Khách hàng
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="khach-hang-dropdown">
                                    <li><a class="dropdown-item" href="#">Doanh nghiệp A</a></li>
                                    <li><a class="dropdown-item" href="#">Doanh nghiệp B</a></li>
                                </ul>
                            </li>
                    
                            <!-- Dropdown Tin tức -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-white" href="#" id="tin-tuc-dropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Tin tức
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="tin-tuc-dropdown">
                                    <li><a class="dropdown-item" href="#">Tin mới nhất</a></li>
                                    <li><a class="dropdown-item" href="#">Sự kiện sắp tới</a></li>
                                </ul>
                            </li>
                    
                            <!-- Liên hệ không phải dropdown -->
                            <li class="nav-item">
                                <a class="nav-link text-white" href="#">Liên hệ</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            
            <!-- Hero Section -->
            <section class="hero-section text-white">
                <div class="container">
                    <h1 class="display-4">PHÒNG TRUYỀN THÔNG ẢO</h1>
                    <p class="lead">Chúng tôi đem đến một giải pháp số hóa không gian bằng công nghệ VR360 nhằm lưu trữ <br> hình ảnh của nhà trường và tạo ra  không gian số của Phòng truyền thống để lưu trữ những khoảng khắc vô <br>  giá của tuổi học trò</p>
                </div>
            </section>
            
            <!-- Features Section -->
            <section class="features-section py-5">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 text-center mb-4">
                            <div class="feature d-flex ">
                                <img src="<?php echo $urlThemeActive;?>/asset/image/anhnen.jpg" alt="">
                                <h5>Số hóa không gian thực bằng công nghệ VR360</h5>
                            </div>
                        </div>
                        <div class="col-lg-3 text-center mb-4">
                            <div class="feature d-flex ">
                                <img src="<?php echo $urlThemeActive;?>/asset/image/anhnen.jpg" alt="">
                                <h5>Dựng không gian ảo 3D, Số hóa không gian</h5>
                            </div>
                        </div>
                        <div class="col-lg-3 text-center mb-4">
                            <div class="feature d-flex ">
                                <img src="<?php echo $urlThemeActive;?>/asset/image/anhnen.jpg" alt="">
                                <h5>Tra cứu thông tin giáo viên, học sinh</h5>
                            </div>
                        </div>
                        <div class="col-lg-3 text-center mb-4">
                            <div class="feature d-flex ">
                                <img src="<?php echo $urlThemeActive;?>/asset/image/anhnen.jpg" alt="">
                                <h5>Tích hợp trên máy tính, điện thoại, máy tính bảng</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </header>