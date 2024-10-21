<?php 
    getHeader();
?>

    <main>
        <section id="banner-section" class="main">
            <div class="banner">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 my-5">
                            <p class="text-uppercase ">GIẢI PHÁP TRỌN GÓI <span>CHO TỔ CHỨC SỰ KIỆN </span></p>
                            <h4>Chúng tôi cung cấp giải pháp cho khách hàng có nhu cầu tổ chức sự kiện với hình thức trọn gói, uy tín và đem lại sự hài lòng tuyệt đối.</h4>
                            <div id="tabfill">
                                <div class="container justify-content-center align-items-center" style="padding: 0;">
                                    <ul class="nav nav-tabs text-md-center d-flex" style="margin-left: 10px;">
                                        <li class="nav-item border-0">
                                            <a class="nav-link border-0 py-2  " data-bs-toggle="tab" href="#home">Sự Kiện</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link py-2 border-0 mx-2" data-bs-toggle="tab" href="#menu1">Dịch Vụ</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link py-2 border-0" data-bs-toggle="tab" href="#menu2">Tin Tức</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="row">
                                    <div class="tab-content">
                                        <div id="home" class="tab-pane fade show active input-container">
                                            <input type="text" class="rounded-input" placeholder="Nhập tên sự kiện mà bạn đang tìm tại đây...">
                                            <button class="round-btn">
                                                <a href=""><i class="fas fa-arrow-right"></i></a>
                                            </button>
                                        </div>
                                        <div id="menu1" class="tab-pane fade">
                                            <div id="home" class="tab-pane fade show active input-container">
                                                <input type="text" class="rounded-input" placeholder="Nhập tên dịch vụ mà bạn đang tìm tại đây...">
                                                <button class="round-btn">
                                                    <a href=""><i class="fas fa-arrow-right"></i></a>
                                                </button>
                                            </div>
                                        </div>
                                        <div id="menu2" class="tab-pane fade">
                                            <div id="home" class="tab-pane fade show active input-container">
                                                <input type="text" class="rounded-input" placeholder="Nhập tên tin tức mà bạn đang tìm tại đây...">
                                                <button class="round-btn">
                                                    <a href=""><i class="fas fa-arrow-right"></i></a>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div id="carouselExampleIndicators" class="carousel slide" data-bs-interval="1000" data-bs-pause="hover">
                                <div class="carousel-indicators">
                                  <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                  <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                  <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                </div>
                                <div class="carousel-inner">
                                  <div class="carousel-item active">
                                    <img src="<?php echo $urlThemeActive;?>/asset/image/anhdep.jpg" class="d-block w-100" alt="...">
                                    <div class="on-img">
                                        <a href="">Kinh Doanh</a>
                                        <div class="text-slick">
                                            <p>Chủ nhật, ngày 28 tháng 8 năm 2024</p>
                                            <h3>VŨ KHÍ MARKETING</h3>
                                            <p>Hồ Tây, Hà Nội</p>
                                        </div>
                                    </div>
                                  </div>
                                  <div class="carousel-item">
                                    <img src="<?php echo $urlThemeActive;?>/asset/image/anhdep.jpg" class="d-block w-100" alt="...">
                                    <div class="on-img">
                                        <a href="">Kinh Doanh</a>
                                        <div class="text-slick">
                                            <p>Chủ nhật, ngày 28 tháng 8 năm 2024</p>
                                            <h3>VŨ KHÍ MARKETING</h3>
                                            <p>Hồ Tây, Hà Nội</p>
                                        </div>
                                    </div>
                                  </div>
                                  <div class="carousel-item">
                                    <img src="<?php echo $urlThemeActive;?>/asset/image/anhdep.jpg" class="d-block w-100" alt="...">
                                    <div class="on-img">
                                        <a href="">Kinh Doanh</a>
                                        <div class="text-slick">
                                            <p>Chủ nhật, ngày 28 tháng 8 năm 2024</p>
                                            <h3>VŨ KHÍ MARKETING</h3>
                                            <p>Hồ Tây, Hà Nội</p>
                                        </div>
                                    </div>
                                  </div>
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                  <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                  <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="banner-img">
                <div class="container-fluid pl-0 d-flex">
                    <img class="col-lg-6" src="<?php echo $urlThemeActive;?>/asset/image/regular.jpg" alt="">
                    <img class="col-lg-6" src="<?php echo $urlThemeActive;?>/asset/image/viettel.jpg" alt="">
                </div>
            </div>
            
        </section>
    
        <section>
            <div class="event pt-5 ">
                <div class="container">
                    <div class="row">
                        <p>Sự Kiện Nổi Bật<span class="red-dot">•</span></p>
                        <div class="news">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="card-news">
                                        <img src="<?php echo $urlThemeActive;?>/asset/image/thu-do-nuoc-anh-la-gi-1.jpg" alt="">
                                            <div class="text top-text">
                                                <a class="name" href="#">Khởi nghiệp</a>
                                                <a class="logo" href=""><i class="fas fa-arrow-right"></i></a>
                                            </div>
                                            <div class="text under-text">
                                                <p class="date-time">Chủ nhật, ngày 28 tháng 8 năm 2024</p>
                                                <h4>Finance Fusion: Igniting Financial Future</h4>
                                                <p class="date-time">Hạ Long, Quảng Ninh</p>
                                            </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="card-news">
                                        <img src="<?php echo $urlThemeActive;?>/asset/image/thu-do-nuoc-anh-la-gi-1.jpg" alt="">
                                            <div class="text top-text">
                                                <a class="name" href="#">Khởi nghiệp</a>
                                                <a class="logo" href=""><i class="fas fa-arrow-right"></i></a>
                                            </div>
                                            <div class="text under-text">
                                                <p class="date-time">Chủ nhật, ngày 28 tháng 8 năm 2024</p>
                                                <h4>Finance Fusion: Igniting Financial Future</h4>
                                                <p class="date-time">Hạ Long, Quảng Ninh</p>
                                            </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="card-news">
                                        <img src="<?php echo $urlThemeActive;?>/asset/image/thu-do-nuoc-anh-la-gi-1.jpg" alt="">
                                            <div class="text top-text">
                                                <a class="name" href="#">Khởi nghiệp</a>
                                                <a class="logo" href=""><i class="fas fa-arrow-right"></i></a>
                                            </div>
                                            <div class="text under-text">
                                                <p class="date-time">Chủ nhật, ngày 28 tháng 8 năm 2024</p>
                                                <h4>Finance Fusion: Igniting Financial Future</h4>
                                                <p class="date-time">Hạ Long, Quảng Ninh</p>
                                            </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="card-news">
                                        <img src="<?php echo $urlThemeActive;?>/asset/image/thu-do-nuoc-anh-la-gi-1.jpg" alt="">
                                            <div class="text top-text">
                                                <a class="name" href="#">Khởi nghiệp</a>
                                                <a class="logo" href=""><i class="fas fa-arrow-right"></i></a>
                                            </div>
                                            <div class="text under-text">
                                                <p class="date-time">Chủ nhật, ngày 28 tháng 8 năm 2024</p>
                                                <h4>Finance Fusion: Igniting Financial Future</h4>
                                                <p class="date-time">Hạ Long, Quảng Ninh</p>
                                            </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="card-news">
                                        <img src="<?php echo $urlThemeActive;?>/asset/image/thu-do-nuoc-anh-la-gi-1.jpg" alt="">
                                            <div class="text top-text">
                                                <a class="name" href="#">Khởi nghiệp</a>
                                                <a class="logo" href=""><i class="fas fa-arrow-right"></i></a>
                                            </div>
                                            <div class="text under-text">
                                                <p class="date-time">Chủ nhật, ngày 28 tháng 8 năm 2024</p>
                                                <h4>Finance Fusion: Igniting Financial Future</h4>
                                                <p class="date-time">Hạ Long, Quảng Ninh</p>
                                            </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="card-news">
                                        <img src="<?php echo $urlThemeActive;?>/asset/image/thu-do-nuoc-anh-la-gi-1.jpg" alt="">
                                            <div class="text top-text">
                                                <a class="name" href="#">Khởi nghiệp</a>
                                                <a class="logo" href=""><i class="fas fa-arrow-right"></i></a>
                                            </div>
                                            <div class="text under-text">
                                                <p class="date-time">Chủ nhật, ngày 28 tháng 8 năm 2024</p>
                                                <h4>Finance Fusion: Igniting Financial Future</h4>
                                                <p class="date-time">Hạ Long, Quảng Ninh</p>
                                            </div>
                                    </div>
                                </div>
                                
                               
                            </div>
                        </div>
                        <div class="takeall">
                            <a href="#">Xem tất cả</a>
                        </div>

                    </div>
                </div>
            </div>
        </section>

        <section class="gr-team">
            <div class="team">
                <div class="container">
                    <h1 class="team-title">Đội Ngũ Vemoi.Net Cùng Các Nhà Tài Trợ <span class="red-dot">•</span></h1>
                    <p class="subtitle">Embark on a journey through the seamless process of our conference</p>
                
                    <!-- Team Section -->
                    <div class="team-members">
                        <div class="team-member">
                            <img class="odd" src="<?php echo $urlThemeActive;?>/asset/image/yl.jpg" alt="Team Member 1">
                        </div>
                        <div class="team-member">
                            <img src="<?php echo $urlThemeActive;?>/asset/image/red.jpg" alt="Team Member 2">
                        </div>
                        <div class="team-member">
                            <img class="odd" src="<?php echo $urlThemeActive;?>/asset/image/tt.jpg" alt="Team Member 3">
                        </div>
                        <div class="team-member">
                            <img src="<?php echo $urlThemeActive;?>/asset/image/sep.jpg" alt="Team Member 4">
                        </div>
                        <div class="team-member">
                            <img class="odd" src="<?php echo $urlThemeActive;?>/asset/image/bl.jpg" alt="Team Member 5">
                        </div>
                    </div>
                
                    <!-- Sponsors Section -->
                    <div class="sponsors">
                        <div class="sponsor-logo mx-3">
                            <img src="<?php echo $urlThemeActive;?>/asset/image/logoipsum.jpg" alt="Sponsor Logo 1">
                        </div>
                        <div class="sponsor-logo mx-3">
                            <img src="<?php echo $urlThemeActive;?>/asset/image/logoipsum.jpg" alt="Sponsor Logo 2">
                        </div>
                        <div class="sponsor-logo mx-3">
                            <img src="<?php echo $urlThemeActive;?>/asset/image/logoipsum.jpg" alt="Sponsor Logo 3">
                        </div>
                        <div class="sponsor-logo mx-3">
                            <img src="<?php echo $urlThemeActive;?>/asset/image/logoipsum.jpg" alt="Sponsor Logo 4">
                        </div>
                        <div class="sponsor-logo mx-3">
                            <img src="<?php echo $urlThemeActive;?>/asset/image/logoipsum.jpg" alt="Sponsor Logo 5">
                        </div>
                    </div>

                    <div class="sponsors">
                        <div class="sponsor-logo mx-3">
                            <img src="<?php echo $urlThemeActive;?>/asset/image/logoipsum.jpg" alt="Sponsor Logo 1">
                        </div>
                        <div class="sponsor-logo mx-3">
                            <img src="<?php echo $urlThemeActive;?>/asset/image/logoipsum.jpg" alt="Sponsor Logo 2">
                        </div>
                        <div class="sponsor-logo mx-3">
                            <img src="<?php echo $urlThemeActive;?>/asset/image/logoipsum.jpg" alt="Sponsor Logo 3">
                        </div>
                        <div class="sponsor-logo mx-3">
                            <img src="<?php echo $urlThemeActive;?>/asset/image/logoipsum.jpg" alt="Sponsor Logo 4">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div class="number-star">
                <h2 class="section-title">Những Con Số Ấn Tượng<span class="white-dot">•</span></h2>
        
                <div class="statistics-cards">
                    <!-- Card 1 -->
                    <div class="card">
                        <img src="<?php echo $urlThemeActive;?>/asset/image/Icon Container.jpg" alt="Icon 1">
                        <div class="card-number">+3400</div>
                        <div class="card-text">Số sự kiện được tổ chức</div>
                    </div>
        
                    <!-- Card 2 -->
                    <div class="card">
                        <img src="<?php echo $urlThemeActive;?>/asset/image/Icon Container.jpg" alt="Icon 2">
                        <div class="card-number">+2400</div>
                        <div class="card-text">Số vé mời đã được tạo</div>
                    </div>
        
                    <!-- Card 3 -->
                    <div class="card">
                        <img src="<?php echo $urlThemeActive;?>/asset/image/Icon Container.jpg" alt="Icon 3">
                        <div class="card-number">+8000</div>
                        <div class="card-text">Khách hàng tham gia</div>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div class="news-section">
                <h2 class="news-title">Tin Tức Mới</h2>
        
                <div class="news-cards">
                    <!-- News Card 1 -->
                    <div class="news-card">
                        <img src="<?php echo $urlThemeActive;?>/asset/image/hop.jpg" alt="News 1">
                        <div class="news-content">
                            <h3 class="news-title-text">Tọa đàm: Huy động sự tham gia có ý nghĩa trong thực hiện kinh...</h3>
                            <p class="news-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                            <div class="news-footer">
                                <div class="news-read-more">→</div>
                                <div class="news-date">Ngày 28/07/2024</div>
                            </div>
                        </div>
                    </div>
        
                    <!-- News Card 2 -->
                    <div class="news-card">
                        <img src="<?php echo $urlThemeActive;?>/asset/image/hop.jpg" alt="News 2">
                        <div class="news-content">
                            <h3 class="news-title-text">Tọa đàm: Huy động sự tham gia có ý nghĩa trong thực hiện kinh...</h3>
                            <p class="news-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                            <div class="news-footer">
                                <div class="news-read-more">→</div>
                                <div class="news-date">Ngày 28/07/2024</div>
                            </div>
                        </div>
                    </div>
        
                    <!-- News Card 3 -->
                    <div class="news-card">
                        <img src="<?php echo $urlThemeActive;?>/asset/image/hop.jpg" alt="News 3">
                        <div class="news-content">
                            <h3 class="news-title-text">Tọa đàm: Huy động sự tham gia có ý nghĩa trong thực hiện kinh...</h3>
                            <p class="news-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                            <div class="news-footer">
                                <div class="news-read-more">→</div>
                                <div class="news-date">Ngày 28/07/2024</div>
                            </div>
                        </div>
                    </div>
                </div>
        
                <button class="btn-view-more">Xem tất cả</button>
            </div>
        </section>

        <section>
            <div class="create-events">
                <div class="container-fluid">
                    <img src="<?php echo $urlThemeActive;?>/asset/image/anhdep.jpg" alt="">
                    <div class="under-items">
                        <div class="text-event">
                            <h3 class="text-uppercase">Bắt đầu tạo sự kiện của bạn và quảng bá đến mọi người</h3>
                            <h5>Nâng cao trải nghiệm của bạn bằng cách tìm sự kiện tiếp theo hoặc khám phá danh mục đa dạng của chúng tôi.</h5>
                        </div>
                        <div class="btn-event">
                            <a href=""><i class="fa-solid fa-plus"></i>Tạo sự kiện mới</a>
                            <a href=""><i class="fa-solid fa-magnifying-glass"></i>Tìm sự kiện</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    
<?php getFooter();?>