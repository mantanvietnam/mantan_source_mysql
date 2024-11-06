<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php mantan_header();?>
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
                            <img src="<?php echo $urlThemeActive;?>/asset/image/Logo.png" alt="Logo" class="logo">
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

        <main>
            <section>
                <div class="container">
                    <div class="client-member ">
                        <p class="d-flex align-items-center justify-content-center">Khách hàng của chúng tôi</p>
                        <div class="brand ">
                            <img src="<?php echo $urlThemeActive;?>/asset/image/strike.png" alt="">
                            <img src="<?php echo $urlThemeActive;?>/asset/image/gog.png" alt="">
                            <img src="<?php echo $urlThemeActive;?>/asset/image/visa.png" alt="">
                            <img src="<?php echo $urlThemeActive;?>/asset/image/linker.png" alt="">
                            <img src="<?php echo $urlThemeActive;?>/asset/image/samsung.png" alt="">
                            <img src="<?php echo $urlThemeActive;?>/asset/image/zoom.png" alt="">
                            <img src="<?php echo $urlThemeActive;?>/asset/image/spo.png" alt="">
                        </div>
                    </div>
                </div>
            </section>

            <section class="education-section">
                <div class="container-fluid">
                    <div class="content-wrapper">
                        <!-- Left Column with Heading and Video -->
                        <div class="left-column">
                            <h2>Giải pháp chuyển đổi số trong ngành giáo dục ứng dụng công nghệ thực tế ảo VR360</h2>

                            <div class="video-container">
                                <img src="<?php echo $urlThemeActive;?>/asset/image/anhnen.jpg" alt="Video Thumbnail">
                                <a href="https://www.youtube.com/watch?v=k-d7EPaa8kY&ab_channel=Deven" class="play-button">
                                    <i class="play-icon">&#9658;</i>
                                </a>
                            </div>
                        </div>

                        <!-- Right Column with Information -->
                        <div class="right-column">
                            <p>Trong mỗi chúng ta ai cũng có những hoài niệm của tuổi học trò. Hình ảnh mái trường, thầy cô, bạn bè luôn khắc sâu trong tâm trí. Sau bao năm tháng, mái trường ngày xưa đã có nhiều đổi thay, bạn bè thầy cô cũng đã khác rất
                                nhiều. Và để lưu trữ lại những mảnh ký ức tuyệt đẹp đó, dự án Phòng truyền thống ảo đã được ra đời với sứ mệnh thực hiện số hóa không gian, lưu trữ thời gian.</p>

                            <div class="info-item">
                                <i class="fa-solid fa-circle-check fa-2xl" style="color: #74C0FC;"></i>
                                <div class="info-item-text">
                                    <h3>TẦM NHÌN</h3>
                                    <p>Xây dựng một sản phẩm giàu tính nhân văn cho các thế hệ giáo viên, học sinh 10 năm, 20 năm và mãi mãi về sau.</p>
                                </div>
                            </div>
                            <div class="info-item">
                                <i class="fa-solid fa-circle-check fa-2xl" style="color: #74C0FC;"></i>
                                <div class="info-item-text">
                                    <h3>SỨ MỆNH</h3>
                                    <p>Số hóa không gian, lưu trữ thời gian để tất cả các thế hệ giáo viên, học sinh nhà trường có thể chìm đắm trong những cảm xúc của tuổi học trò.</p>
                                </div>
                            </div>
                            <div class="info-item">
                                <i class="fa-solid fa-circle-check fa-2xl" style="color: #74C0FC;"></i>
                                <div class="info-item-text">
                                    <h3>MỤC TIÊU</h3>
                                    <p>Triển khai xây dựng 1.000.000 phòng truyền thống ảo trên khắp cả nước.</p>
                                </div>
                            </div>
                            <div class="info-item">
                                <i class="fa-solid fa-circle-check fa-2xl" style="color: #74C0FC;"></i>
                                <div class="info-item-text">
                                    <h3>TRIẾT LÝ KINH DOANH</h3>
                                    <p>Lấy khách hàng làm trọng tâm, sự hài lòng của khách hàng là thành công của doanh nghiệp. Sản phẩm chất lượng sẽ có giá trị khi đem lại kết quả cho khách hàng.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="schools">
                <div class="container">
                    <!-- Stats Counter -->
                    <div class="schools__stats row text-center mb-5">
                        <h2 class="schools__title col-lg-3">Kết quả hoạt động</h2>
                        <div class="parameter col-lg-9">
                            <div class="schools__stat">
                                <h3 class="schools__stat-number">3+</h3>
                                <p class="schools__stat-label">Năm hoạt động</p>
                            </div>
                            <div class="schools__stat">
                                <h3 class="schools__stat-number">100+</h3>
                                <p class="schools__stat-label">Khách hàng</p>
                            </div>
                            <div class="schools__stat">
                                <h3 class="schools__stat-number">500+</h3>
                                <p class="schools__stat-label">Sự kiện</p>
                            </div>
                        </div>
                    </div>

                    <!-- Schools Grid -->
                    <div class="schools__grid row g-4">
                        <div class="col-md-4">
                            <div class="schools__card">
                                <img src="<?php echo $urlThemeActive;?>/asset/image/anhnen.jpg" alt="Trường THPT chuyên Lào Cai" class="schools__card-img">
                                <div class="schools__card-content">
                                    <h4 class="schools__card-title">Trường THPT chuyên Lào Cai</h4>
                                    <p class="schools__card-address">Địa chỉ: Đường M9, Bắc Cường, Lào Cai</p>
                                    <a href="#" class="schools__card-link">Tìm hiểu thêm</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="schools__card">
                                <img src="<?php echo $urlThemeActive;?>/asset/image/anhnen.jpg" alt="Trường TH Lê Văn Tám" class="schools__card-img">
                                <div class="schools__card-content">
                                    <h4 class="schools__card-title">Trường TH Lê Văn Tám</h4>
                                    <p class="schools__card-address">Địa chỉ: 1 Bà Triệu, Kim Tân, Lào Cai</p>
                                    <a href="#" class="schools__card-link">Tìm hiểu thêm</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="schools__card">
                                <img src="<?php echo $urlThemeActive;?>/asset/image/anhnen.jpg" alt="Trường THCS Lê Quý Đôn" class="schools__card-img">
                                <div class="schools__card-content">
                                    <h4 class="schools__card-title">Trường THCS Lê Quý Đôn</h4>
                                    <p class="schools__card-address">Địa chỉ: Kim Hoa, Kim Tân, Lào Cai</p>
                                    <a href="#" class="schools__card-link">Tìm hiểu thêm</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="schools__card">
                                <img src="<?php echo $urlThemeActive;?>/asset/image/anhnen.jpg" alt="Trường TH Bắc Lệnh" class="schools__card-img">
                                <div class="schools__card-content">
                                    <h4 class="schools__card-title">Trường TH Bắc Lệnh</h4>
                                    <p class="schools__card-address">Địa chỉ: 397Đ. Hoàng Quốc Việt, P. Bắc Lệnh, Lào Cai</p>
                                    <a href="#" class="schools__card-link">Tìm hiểu thêm</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="schools__card">
                                <img src="<?php echo $urlThemeActive;?>/asset/image/anhnen.jpg" alt="Trường TH Kim Đồng" class="schools__card-img">
                                <div class="schools__card-content">
                                    <h4 class="schools__card-title">Trường TH Kim Đồng</h4>
                                    <p class="schools__card-address">Địa chỉ: đường Thanh Niên, Duyên Hải, Lào Cai</p>
                                    <a href="#" class="schools__card-link">Tìm hiểu thêm</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="schools__card">
                                <img src="<?php echo $urlThemeActive;?>/asset/image/anhnen.jpg" alt="Trường TH Hoàng Văn Thụ" class="schools__card-img">
                                <div class="schools__card-content">
                                    <h4 class="schools__card-title">Trường TH Hoàng Văn Thụ</h4>
                                    <p class="schools__card-address">Địa chỉ: đường Đặng Trần Côn, Cốc Lếu, Lào Cai</p>
                                    <a href="#" class="schools__card-link">Tìm hiểu thêm</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="button__schools text-center mt-4">
                        <a href="#" class="schools__view-all btn btn-primary">Xem toàn bộ</a>
                    </div>
                </div>
            </section>

            <section class="pricing">
                <div class="container">
                    <div class="pricing__header">
                        <h2 class="pricing__title">Bảng giá dịch vụ</h2>
                        <p class="pricing__description">
                            We're a community dedicated to empowering lives through fitness. Our experienced trainers, state-of-the-art facilities, and diverse range of classes create an environment
                        </p>
                    </div>

                    <div class="row g-4">
                        <!-- Gói cơ bản -->
                        <div class="col-md-4">
                            <div class="pricing__card">
                                <div class="pricing__card-header">
                                    <h3 class="pricing__card-title">Gói cơ bản</h3>
                                    <p class="pricing__card-subtitle">Dành cho các đơn vị mới thành lập</p>
                                </div>
                                <div class="pricing__card-price">
                                    <h4 class="price">30,000,000đ</h4>
                                    <p class="original-price">30,000,000đ</p>
                                    <p class="price-note">Chưa bao gồm VAT</p>
                                </div>
                                <a href="#" class="pricing__card-button">Đăng ký ngay</a>
                                <div class="pricing__card-features">
                                    <div class="feature-item">
                                        <i class="fas fa-check"></i>
                                        <span>Số hóa không gian thực VR360</span>
                                    </div>
                                    <div class="feature-item">
                                        <i class="fas fa-check"></i>
                                        <span>Giải pháp số hóa 1 cảnh trên cao, 5 cảnh dưới đất</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Gói đầy đủ -->
                        <div class="col-md-4">
                            <div class="pricing__card">
                                <div class="pricing__card-header">
                                    <h3 class="pricing__card-title">Gói đầy đủ</h3>
                                    <p class="pricing__card-subtitle">Dành cho các đơn vị có bề dày thành tích</p>
                                </div>
                                <div class="pricing__card-price">
                                    <h4 class="price">50,000,000đ</h4>
                                    <p class="original-price">70,000,000đ</p>
                                    <p class="price-note">Chưa bao gồm VAT</p>
                                </div>
                                <a href="#" class="pricing__card-button">Đăng ký ngay</a>
                                <div class="pricing__card-features">
                                    <div class="feature-item">
                                        <i class="fas fa-check"></i>
                                        <span>Số hóa không gian thực VR360</span>
                                    </div>
                                    <div class="feature-item">
                                        <i class="fas fa-check"></i>
                                        <span>Giải pháp số hóa 1 cảnh trên cao, 10 cảnh dưới đất</span>
                                    </div>
                                    <div class="feature-item">
                                        <i class="fas fa-check"></i>
                                        <span>Dựng không gian 3D</span>
                                    </div>
                                    <div class="feature-item">
                                        <i class="fas fa-check"></i>
                                        <span>Tư cả các chức năng trình xem, tương tác, trình chiếu các điểm đến trong tour</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Gói nâng cao -->
                        <div class="col-md-4">
                            <div class="pricing__card pricing__card--premium">
                                <div class="pricing__card-header">
                                    <h3 class="pricing__card-title">Gói nâng cao</h3>
                                    <p class="pricing__card-subtitle">Không giới hạn tài nguyên</p>
                                </div>
                                <div class="pricing__card-price">
                                    <h4 class="price">100,000,000đ</h4>
                                    <p class="original-price">150,000,000đ</p>
                                    <p class="price-note">Chưa bao gồm VAT</p>
                                </div>
                                <a href="#" class="pricing__card-button">Đăng ký ngay</a>
                                <div class="pricing__card-features">
                                    <div class="feature-item">
                                        <i class="fas fa-check"></i>
                                        <span>Số hóa không gian thực VR360</span>
                                    </div>
                                    <div class="feature-item">
                                        <i class="fas fa-check"></i>
                                        <span>Không giới hạn số lượng cảnh chụp</span>
                                    </div>
                                    <div class="feature-item">
                                        <i class="fas fa-check"></i>
                                        <span>Dựng không gian 3D</span>
                                    </div>
                                    <div class="feature-item">
                                        <i class="fas fa-check"></i>
                                        <span>Tất cả chức năng giáo viên, học sinh, thành tích nhà trường. Đủ liệu tất cả các năm khóa từ khi thành lập trường cho đến hiện tại</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="pricing__note">
                        <i class="fas fa-info-circle"></i>
                        <span>Chi phí số hóa không gian thực VR360 dưới đất: 2.000.000đ/cảnh</span>
                    </div>
                </div>
            </section>

            <section class="testimonial-section">
                <div class="container"> 
                    <h2 class="text-center section-title">Khách hàng nói gì về chúng tôi</h2>

                    <div class="slick-center-mode">
                        <div class="testimonial-item" style="padding: 20px; margin: 0 20px; border: solid 1px; transition: all linear 0.2s;">
                            <div class="testimonial-info" style="display: grid; grid-template-columns: auto auto; gap: 15px;">
                                <div style="border-radius: 1000px; aspect-ratio: 1; overflow: hidden;">
                                    <img src="<?php echo $urlThemeActive;?>/asset/image/anhnen.jpg" alt="">
                                </div>
                                <div>
                                    <h4 style="text-transform: capitalize;">Nguyen Minh Thanh</h4>
                                    <p>Customer</p>
                                </div>
                            </div>
                            <div class="testimonial-sub">
                                <p>Hơn nữa, quản lý tài nguyên thiên nhiên ảnh hưởng trực tiếp đến sức khỏe cộng đồng, phát triển kinh tế và an ninh lương thực. Nó giúp giảm thiểu các tác động tiêu cực từ việc khai thác quá mức và ô nhiễm, đồng thời hỗ trợ
                                    phát triển kinh tế một cách bền vững. Ngoài ra, việc quản lý tài nguyên cũng góp phần bảo vệ quyền lợi của các cộng đồng địa phương, đặc biệt là những cộng đồng phụ thuộc vào tài nguyên thiên nhiên để sinh sống. Vì
                                    vậy, quản lý tài nguyên thiên nhiên hiệu quả đóng vai trò vô cùng quan trọng để bảo vệ môi trường, nâng cao chất lượng cuộc sống, và đảm bảo sự phát triển bền vững.</p>
                            </div>
                        </div>

                        <div class="testimonial-item" style="padding: 20px; margin: 0 20px; border: solid 1px; transition: all linear 0.2s;">
                            <div class="testimonial-info" style="display: grid; grid-template-columns: auto auto; gap: 15px;">
                                <div style="border-radius: 1000px; aspect-ratio: 1; overflow: hidden;">
                                    <img src="<?php echo $urlThemeActive;?>/asset/image/anhnen.jpg" alt="">
                                </div>
                                <div>
                                    <h4 style="text-transform: capitalize;">Nguyen Minh Thanh</h4>
                                    <p>Customer</p>
                                </div>
                            </div>
                            <div class="testimonial-sub">
                                <p>Hơn nữa, quản lý tài nguyên thiên nhiên ảnh hưởng trực tiếp đến sức khỏe cộng đồng, phát triển kinh tế và an ninh lương thực. Nó giúp giảm thiểu các tác động tiêu cực từ việc khai thác quá mức và ô nhiễm, đồng thời hỗ trợ
                                    phát triển kinh tế một cách bền vững. Ngoài ra, việc quản lý tài nguyên cũng góp phần bảo vệ quyền lợi của các cộng đồng địa phương, đặc biệt là những cộng đồng phụ thuộc vào tài nguyên thiên nhiên để sinh sống. Vì
                                    vậy, quản lý tài nguyên thiên nhiên hiệu quả đóng vai trò vô cùng quan trọng để bảo vệ môi trường, nâng cao chất lượng cuộc sống, và đảm bảo sự phát triển bền vững.</p>
                            </div>
                        </div>
                        <div class="testimonial-item" style="padding: 20px; margin: 0 20px; border: solid 1px; transition: all linear 0.2s;">
                            <div class="testimonial-info" style="display: grid; grid-template-columns: auto auto; gap: 15px;">
                                <div style="border-radius: 1000px; aspect-ratio: 1; overflow: hidden;">
                                    <img src="<?php echo $urlThemeActive;?>/asset/image/anhnen.jpg" alt="">
                                </div>
                                <div>
                                    <h4 style="text-transform: capitalize;">Nguyen Minh Thanh</h4>
                                    <p>Customer</p>
                                </div>
                            </div>
                            <div class="testimonial-sub">
                                <p>Hơn nữa, quản lý tài nguyên thiên nhiên ảnh hưởng trực tiếp đến sức khỏe cộng đồng, phát triển kinh tế và an ninh lương thực. Nó giúp giảm thiểu các tác động tiêu cực từ việc khai thác quá mức và ô nhiễm, đồng thời hỗ trợ
                                    phát triển kinh tế một cách bền vững. Ngoài ra, việc quản lý tài nguyên cũng góp phần bảo vệ quyền lợi của các cộng đồng địa phương, đặc biệt là những cộng đồng phụ thuộc vào tài nguyên thiên nhiên để sinh sống. Vì
                                    vậy, quản lý tài nguyên thiên nhiên hiệu quả đóng vai trò vô cùng quan trọng để bảo vệ môi trường, nâng cao chất lượng cuộc sống, và đảm bảo sự phát triển bền vững.</p>
                            </div>
                        </div>
                        <div class="testimonial-item" style="padding: 20px; margin: 0 20px; border: solid 1px; transition: all linear 0.2s;">
                            <div class="testimonial-info" style="display: grid; grid-template-columns: auto auto; gap: 15px;">
                                <div style="border-radius: 1000px; aspect-ratio: 1; overflow: hidden;">
                                    <img src="<?php echo $urlThemeActive;?>/asset/image/anhnen.jpg" alt="">
                                </div>
                                <div>
                                    <h4 style="text-transform: capitalize;">Nguyen Minh Thanh</h4>
                                    <p>Customer</p>
                                </div>
                            </div>
                            <div class="testimonial-sub">
                                <p>Hơn nữa, quản lý tài nguyên thiên nhiên ảnh hưởng trực tiếp đến sức khỏe cộng đồng, phát triển kinh tế và an ninh lương thực. Nó giúp giảm thiểu các tác động tiêu cực từ việc khai thác quá mức và ô nhiễm, đồng thời hỗ trợ
                                    phát triển kinh tế một cách bền vững. Ngoài ra, việc quản lý tài nguyên cũng góp phần bảo vệ quyền lợi của các cộng đồng địa phương, đặc biệt là những cộng đồng phụ thuộc vào tài nguyên thiên nhiên để sinh sống. Vì
                                    vậy, quản lý tài nguyên thiên nhiên hiệu quả đóng vai trò vô cùng quan trọng để bảo vệ môi trường, nâng cao chất lượng cuộc sống, và đảm bảo sự phát triển bền vững.</p>
                            </div>
                        </div>
                        <div class="testimonial-item" style="padding: 20px; margin: 0 20px; border: solid 1px; transition: all linear 0.2s;">
                            <div class="testimonial-info" style="display: grid; grid-template-columns: auto auto; gap: 15px;">
                                <div style="border-radius: 1000px; aspect-ratio: 1; overflow: hidden;">
                                    <img src="<?php echo $urlThemeActive;?>/asset/image/anhnen.jpg" alt="">
                                </div>
                                <div>
                                    <h4 style="text-transform: capitalize;">Nguyen Minh Thanh</h4>
                                    <p>Customer</p>
                                </div>
                            </div>
                            <div class="testimonial-sub">
                                <p>Hơn nữa, quản lý tài nguyên thiên nhiên ảnh hưởng trực tiếp đến sức khỏe cộng đồng, phát triển kinh tế và an ninh lương thực. Nó giúp giảm thiểu các tác động tiêu cực từ việc khai thác quá mức và ô nhiễm, đồng thời hỗ trợ
                                    phát triển kinh tế một cách bền vững. Ngoài ra, việc quản lý tài nguyên cũng góp phần bảo vệ quyền lợi của các cộng đồng địa phương, đặc biệt là những cộng đồng phụ thuộc vào tài nguyên thiên nhiên để sinh sống. Vì
                                    vậy, quản lý tài nguyên thiên nhiên hiệu quả đóng vai trò vô cùng quan trọng để bảo vệ môi trường, nâng cao chất lượng cuộc sống, và đảm bảo sự phát triển bền vững.</p>
                            </div>
                        </div>



                    </div>

                </div>
            </section>

            <section class="news">
                <div class="container">
                    <div class="news__wrapper">
                        <p class="news__title d-flex align-items-center justify-content-center">Tin tức - Sự kiện</p>
                        <div class="news__carousel">
                            <div class="news__list">
                                <!-- News Item 1 -->
                                <div class="news__item">
                                    <div class="news__item-image">
                                        <img src="<?php echo $urlThemeActive;?>/asset/image/hop.png" alt="Tin tức 1">
                                    </div>
                                    <div class="news__item-content">
                                        <h3 class="news__item-title">Tọa đàm: Huy động sự tham gia có ý nghĩa trong thực hiện kinh doanh</h3>
                                        <p class="news__item-desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                        <div class="news__item-footer d-flex justify-content-between align-items-center">
                                            <span class="news__item-date">Ngày 28/07/2024</span>
                                            <button class="news__item-btn">
                                            <i class="fa-solid fa-arrow-right fa-xl"></i>
                                        </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- News Item 2 -->
                                <div class="news__item">
                                    <div class="news__item-image">
                                        <img src="<?php echo $urlThemeActive;?>/asset/image/hop.png" alt="Tin tức 2">
                                    </div>
                                    <div class="news__item-content">
                                        <h3 class="news__item-title">Tọa đàm: Huy động sự tham gia có ý nghĩa trong thực hiện kinh doanh</h3>
                                        <p class="news__item-desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                        <div class="news__item-footer d-flex justify-content-between align-items-center">
                                            <span class="news__item-date">Ngày 28/07/2024</span>
                                            <button class="news__item-btn">
                                            <i class="fa-solid fa-arrow-right fa-xl"></i>
                                        </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- News Item 3 -->
                                <div class="news__item">
                                    <div class="news__item-image">
                                        <img src="<?php echo $urlThemeActive;?>/asset/image/hop.png" alt="Tin tức 3">
                                    </div>
                                    <div class="news__item-content">
                                        <h3 class="news__item-title">Tọa đàm: Huy động sự tham gia có ý nghĩa trong thực hiện kinh doanh</h3>
                                        <p class="news__item-desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                        <div class="news__item-footer d-flex justify-content-between align-items-center">
                                            <span class="news__item-date">Ngày 28/07/2024</span>
                                            <button class="news__item-btn">
                                            <i class="fa-solid fa-arrow-right fa-xl"></i>
                                        </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- View All Button -->
                        <div class="text-center">
                            <button class="news__btn-all">Xem toàn bộ</button>
                        </div>
                    </div>
                </div>
            </section>

        </main>

        <footer class="footer">
            <div class="container">
                <div class="footer__main">
                    <div class="row">
                        <!-- Company Info -->
                        <div class="col-md-4">
                            <div class="footer__brand">
                                <img src="<?php echo $urlThemeActive;?>/asset/image/logo.png" alt="PHONGTRUYEN" class="footer__logo">
                                <p class="footer__name">PHONGTRUYENTHONG.COM</p>
                            </div>
                            <div class="footer__contact">
                                <p class="footer__address">
                                    <i class="fas fa-map-marker-alt"></i> 64 Bà Triệu, Hoàn Kiếm, Hà Nội
                                </p>
                                <p class="footer__phone">
                                    <i class="fas fa-phone"></i> 024.6263.1832 hoặc 024.6263.1760
                                </p>
                                <p class="footer__email">
                                    <i class="fas fa-envelope"></i> vanphong@vsds.vn
                                </p>
                            </div>
                        </div>

                        <!-- Company Links -->
                        <div class="col-lg -2">
                            <h3 class="footer__title">Company</h3>
                            <ul class="footer__list">
                                <li><a href="#" class="footer__link">About Us</a></li>
                                <li><a href="#" class="footer__link">Membership</a></li>
                                <li><a href="#" class="footer__link">Careers</a></li>
                            </ul>
                        </div>

                        <!-- Support Links -->
                        <div class="col-lg -2">
                            <h3 class="footer__title">Support</h3>
                            <ul class="footer__list">
                                <li><a href="#" class="footer__link">Contact Us</a></li>
                                <li><a href="#" class="footer__link">Online Chat</a></li>
                                <li><a href="#" class="footer__link">Help Center</a></li>
                            </ul>
                        </div>

                        <!-- Newsletter -->
                        <div class="col-lg -4">
                            <h3 class="footer__newsletter-title">
                                Nhận ngay tư vấn về chuyển đổi số ứng dụng công nghệ
                            </h3>
                            <div class="footer__form">
                                <input type="email" class="footer__input" placeholder="Enter your email">
                                <button class="footer__button">Đăng ký</button>
                            </div>
                            <div class="footer__social">
                                <a href="#" class="footer__social-link"><i class="fab fa-linkedin"></i></a>
                                <a href="#" class="footer__social-link"><i class="fab fa-twitter"></i></a>
                                <a href="#" class="footer__social-link"><i class="fab fa-facebook-f"></i></a>
                                <a href="#" class="footer__social-link"><i class="fab fa-youtube"></i></a>
                                <a href="#" class="footer__social-link"><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer Bottom -->
                <div class="footer__bottom">
                    <div class="row align-items-center">
                        <div class="col-md-8 d-flex align-items-center">
                            <div class="footer__certificate mx-4">
                                <img src="<?php echo $urlThemeActive;?>/asset/image/logoSaleNoti 1.png" style="width: 170px; height: auto;" alt="Chứng nhận Bộ Công Thương">
                            </div>
                            <div class="footer__logo">
                                <p class="footer__copyright">
                                    Copyright © 2021 VSDS. All rights reserved
                                </p>
                                <p class="footer__registration">
                                    Mã số DN: 0123456789, đăng ký lần đầu ngày 01/01/2021, thay đổi lần thứ 5 ngày 21/8/2022
                                </p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="footer__links">
                                <a href="#" class="footer__bottom-link">FAQ</a>
                                <a href="#" class="footer__bottom-link">Terms of Condition</a>
                                <a href="#" class="footer__bottom-link">Privacy Policy</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

        <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
        <script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="<?php echo $urlThemeActive;?>/asset/js/toptop.js"></script>
    </body>

</html>