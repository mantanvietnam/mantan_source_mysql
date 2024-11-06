<?php 
    getHeader();
    global $settingThemes;
?>

    <main>
        <section id="banner-section" class="main">
            <div class="banner">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 my-5">
                            <p class="text-uppercase "><?= @$settingThemes['titleredbanner'];?><span><?= @$settingThemes['titleblackbanner'];?></span></p>
                            <h4><?= @$settingThemes['descriptionbanner'];?></h4>
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
                                <?php $isActive = true; ?>
                                <?php foreach ($slide_banner as $value) : ?>
                                    <div class="carousel-item <?php echo $isActive ? 'active' : ''; ?>">
                                        <img src="<?php echo $value['image']; ?>" class="d-block w-100" alt="...">
                                        <div class="on-img">
                                            <a href="<?php echo $value['link']; ?>">Kinh Doanh</a>
                                            <div class="text-slick">
                                                <p><?php echo $value['description']; ?></p>
                                                <h3><?php echo $value['title']; ?></h3>
                                                <!-- <p>Hồ Tây, Hà Nội</p> -->
                                            </div>
                                        </div>
                                    </div>
                                    <?php $isActive = false; ?>
                                <?php endforeach; ?>
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
                <div class="container-fluid pl-0 d-flex justify-content-center">
                    <img class="col-lg-6" src="<?= @$settingThemes['image1'];?>" alt="">
                    <img class="col-lg-6" src="<?= @$settingThemes['image2'];?>" alt="">
                </div>
            </div>
            
        </section>
    
        <section class="home__event">
            <div class="event pt-5 ">
                <div class="container">
                    <div class="row">
                        <p>Sự Kiện Nổi Bật<span class="red-dot">•</span></p>
                        <div class="news">
                            <div class="row">
                                <?php foreach($listDataevent as $event):?>
                                <div class="col-lg-4">
                                    <a href="/detailevent/<?php echo @$event->slug ?>.html">
                                        <div class="card-news">
                                            <img src="<?=$event->banner?>" alt="">
                                            <div class="text top-text">
                                                <p class="name">Khởi nghiệp</p>
                                                <p class="logo"><i class="fas fa-arrow-right"></i></p>
                                            </div>
                                            <div class="text under-text">
                                                <p class="date-time"><?php echo date('d/m/Y', $event->time_start);?></p>
                                                <h4><?=$event->name?></h4>
                                                <p class="date-time"><?=$event->address?></p>
                                            </div>
                                        </div>
                                    </a>
                                </div>   
                                <?php endforeach;?>                    
                            </div>
                        </div>
                        <div class="takeall">
                            <a href="/allevent">Xem tất cả</a>
                        </div>

                    </div>
                </div>
            </div>
        </section>

        <section class="gr-team">
            <div class="team">
                <div class="container">
                    <h1 class="team-title"><?php echo $settingThemes['titleNTT'];?><span class="red-dot">•</span></h1>
                    <p class="subtitle"><?php echo $settingThemes['titleNTTsmall'];?></p>
                
                    <!-- Team Section -->
                    <div class="team-members">
                        <?php foreach ($slidealbumNTT as $value):?>
                            <div class="team-member">
                                <img class="odd" src="<?php echo $value['image'];?>" alt="Team Member 1">
                            </div>
                        <?php endforeach;?>
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

                    <!-- <div class="sponsors">
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
                    </div> -->
                </div>
            </div>
        </section>

        <section class="number__home">
            <div class="number-star">
                <h2 class="section-title">Những Con Số Ấn Tượng<span class="white-dot">•</span></h2>
        
                <div class="statistics-cards">
                    <!-- Card 1 -->
                    <div class="card">
                        <img src="<?= @$settingThemes['icon1'];?>" alt="Icon 1">
                        <div class="card-number">+<?= @$settingThemes['number1'];?></div>
                        <div class="card-text"><?= @$settingThemes['titleicon1'];?></div>
                    </div>
        
                    <!-- Card 2 -->
                    <div class="card">
                        <img src="<?= @$settingThemes['icon2'];?>" alt="Icon 2">
                        <div class="card-number">+<?= @$settingThemes['number2'];?></div>
                        <div class="card-text"><?= @$settingThemes['titleicon2'];?></div>
                    </div>
        
                    <!-- Card 3 -->
                    <div class="card">
                        <img src="<?= @$settingThemes['icon3'];?>" alt="Icon 3">
                        <div class="card-number">+<?= @$settingThemes['number3'];?></div>
                        <div class="card-text"><?= @$settingThemes['titleicon3'];?></div>
                    </div>
                </div>
            </div>
        </section>

        <section class="news__home">
            <div class="news-section">
                <h2 class="news-title">Tin Tức Mới</h2>
        
                <div class="news-cards">
                    <!-- News Card 1 -->
                     <?php foreach($listDatatop as $value) :?>
                    <a href="<?php echo @$value->slug ?>.html">
                        <div class="news-card">
                            <img src="<?php echo $value['image'];?>" alt="News 1">
                            <div class="news-content">
                                <h3 class="news-title-text"><?php echo $value['title'];?></h3>
                                <p class="news-description"><?php echo $value['description'];?></p>
                                <div class="news-footer">
                                    <div class="news-read-more">→</div>
                                    <div class="news-date">Ngày <?php echo date('d/m/Y', $value->time);?></div>
                                </div>
                            </div>
                        </div>
                    </a>
                    <?php endforeach;?>
                </div>
        
                <a class="btn-view-more" href="/posts">Xem tất cả</a>
            </div>
        </section>

        <section class="create__home">
            <div class="create-events">
                <div class="container-fluid">
                    <img src="<?= @$settingThemes['imagefull'];?>" alt="">
                    <div class="under-items">
                        <div class="text-event">
                            <h3 class="text-uppercase"><?= @$settingThemes['titlesukien'];?></h3>
                            <h5><?= @$settingThemes['titlesmallsukien'];?></h5>
                        </div>
                        <div class="btn-event">
                            <?php if(!empty( $info)):?>
                                <a href="/createevent"><i class="fa-solid fa-plus"></i>Tạo sự kiện mới</a>
                            <?php else:?>
                                <a href="/login"><i class="fa-solid fa-plus"></i>Hãy Đăng nhập để tạo sự kiện</a>
                            <?php endif;?>
                            <a href=""><i class="fa-solid fa-magnifying-glass"></i>Tìm sự kiện</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    
<?php getFooter();?>