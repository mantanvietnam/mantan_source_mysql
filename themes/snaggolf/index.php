<?php
    getHeader();
    global $urlThemeActive;
    global $settingThemes;
?>
<main>
    <section class="banner">
        <div class="container">
            <div class="row g-2 banner-layout">
                <div class="col-12 col-lg-6">
                    <div class="banner-content">
                        <div class="contain">
                            <h1>The sooner <span>you PLAY</span>
                                <span>the BETTER</span> you're
                            </h1>
                            <div class="d-flex justify-content-center d-lg-block">
                                <a href="" class="button-link">
                                    <button class="custom-button">
                                        <span>Get STARTED</span>
                                        <span><img src="<?php echo $urlThemeActive; ?>assets/img/right-arrow.png" alt=""></span>
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="banner-img">
                        <img class="w-100" src="<?php echo $urlThemeActive; ?>assets/img/banner-image.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="welcome">
        <div class="container">
            <div class="head">
                <h1>Welcome to </h1>
                <h1>SNAGGOLF Vietnam</h1>
                <p><?php echo @$settingThemes['welcome_title_main']; ?></p>
            </div>
            <div class="row g-3  midle">
                <div class="col-6 col-md-6 col-lg-3">
                    <div class="item shadow-red">
                        <img src="<?php echo $urlThemeActive; ?>assets/img/welcome-item.png" alt="">
                        <span class="text-custom-red"><?php echo @$settingThemes['welcome_title_1']; ?></span>
                        <!-- <div class="blur-red"></div> -->
                    </div>
                </div>
                <div class="col-6 col-md-6 col-lg-3">
                    <div class="item shadow-green">
                        <img src="<?php echo $urlThemeActive; ?>assets/img/award.png" alt="">
                        <span class="text-custom-green"><?php echo @$settingThemes['welcome_title_2']; ?></span>
                        <!-- <div class="blur-red"></div> -->
                    </div>
                </div>
                <div class="col-6 col-md-6 col-lg-3">
                    <div class="item shadow-blue">
                        <img src="<?php echo $urlThemeActive; ?>assets/img/cup.png" alt="">
                        <span class="text-custom-blue"><?php echo @$settingThemes['welcome_title_3']; ?></span>
                        <!-- <div class="blur-red"></div> -->
                    </div>
                </div>
                <div class="col-6 col-md-6 col-lg-3">
                    <div class="item shadow-yelow">
                        <img src="<?php echo $urlThemeActive; ?>assets/img/4. familier.png" alt="">
                        <span class="text-custom-yelow"><?php echo @$settingThemes['welcome_title_4']; ?></span>
                        <!-- <div class="blur-red"></div> -->
                    </div>
                </div>
            </div>
        </div>
        <div class="group-img">
            <img class="w-100" src="<?php echo $urlThemeActive; ?>assets/img/welcome-group-img.png" alt="">
        </div>
    </section>

    <section class="courses">
        <div class="container">
            <div class="head">
                <h1>Đăng ký khóa học</h1>
                <p><?php echo @$settingThemes['course_title']; ?></p>
            </div>
            <div class="midle">
                <div class="row g-4">
                <?php foreach ($listDatacourse as $key => $value) { ?>
                    <div class="col-12 col-md-4">
                        <div class="card-item">
                            <a href="/detailcourse/<?php echo $value->slug ?> ">
                                <div class="card">
                                    <div class="top-img">
                                        <img src="<?php echo $value->image ?>" class="card-img-top" alt="">
                                        <img src="<?php echo $urlThemeActive; ?>assets/img/card-cart.png" alt="">
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $value->name ?> </h5>
                                        <p class="card-text"><?php echo $value->description ?> </p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                <?php } ?>
                </div>
            </div>
            <div class="bottom d-flex justify-content-center">
                <a href="/course" class="button-link">
                    <button class="custom-button button-reg">ĐĂNG KÍ</button>
                </a>
            </div>
        </div>
    </section>
    <section class="trainer">
        <div class="container">
            <div class="trainer-contain">
                <div class="row g-0">
                    <div class="col-12 col-lg-6">
                        <div class="contain">
                            <h3>Đăng ký trở thành</h3>
                            <h3>HUẤN LUYỆN VIÊN</h3>
                            <p><?php echo @$settingThemes['trainer_name']; ?></p>
                            <a href="/trainer" class="button-link">
                                <button class="custom-button button-reg d-none d-lg-inline">ĐĂNG KÍ</button>
                            </a>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="contain-img">
                            <img src="<?php echo $urlThemeActive; ?>assets/img/trainer.png" alt="">
                            <div class="after"></div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center mt-5 d-block d-lg-none">
                    <a href="https://snaggolf.vn/dang-ki-huan-luyen-vien" class="button-link">
                        <button class="custom-button button-reg">ĐĂNG KÍ</button>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <section class="course-info">
        <div class="container">
            <div class="head">
                <h1>Thông tin các khóa học cho bạn</h1>
                <p><?php echo @$settingThemes['course_info_header']; ?></p>
            </div>
            <div class="contain">
                <div class="row g-4 g-lg-0">
                    <div class="col-12 col-lg-5">
                        <div class="image-contain d-flex justify-content-center d-lg-block">
                            <img src="<?php echo $urlThemeActive; ?>assets/img/course-info.png" alt="">
                        </div>
                    </div>
                    <div class="col-12 col-lg-7">
                        <div class="row g-0">
                            <div class="col-12 d-flex justify-content-center justify-content-lg-end">
                                <div class="course-info-card">
                                    <div class="card shadow-blue">
                                    <?php if (!empty($listDatacourse[0])): ?>
                                        <div class="card-body">
                                            <h5 class="card-title text-custom-blue"><?php echo  $listDatacourse[0]->name?></h5>
                                            <p class="card-text">
                                                <span>Thời gian:</span>
                                                <b><?php echo  $listDatacourse[0]->time_create?></b>
                                            </p>
                                            <p class="card-text">
                                                <span>Địa điểm:</span>
                                                <b><?php echo  $listDatacourse[0]->address?></b>
                                            </p>
                                        </div>
                                    <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 d-flex justify-content-center justify-content-lg-end">
                                <div class="course-info-card">
                                    <div class="card shadow-yelow">
                                    <?php if (!empty($listDatacourse[1])): ?>
                                        <div class="card-body">
                                            <h5 class="card-title text-custom-yelow"><?php echo  $listDatacourse[1]->name?></h5>
                                            <p class="card-text">
                                                <span>Thời gian:</span>
                                                <b><?php echo  $listDatacourse[1]->time_create?></b>
                                            </p>
                                            <p class="card-text">
                                                <span>Địa điểm:</span>
                                                <b><?php echo  $listDatacourse[1]->address?></b>
                                            </p>
                                        </div>
                                    <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 d-flex justify-content-center justify-content-lg-end">
                                <div class="course-info-card">
                                    <div class="card shadow-green">
                                    <?php if (!empty($listDatacourse[2])): ?>
                                        <div class="card-body">
                                            <h5 class="card-title text-custom-green"><?php echo  $listDatacourse[2]->name?></h5>
                                            <p class="card-text">
                                                <span>Thời gian:</span>
                                                <b><?php echo  $listDatacourse[2]->time_create?></b>
                                            </p>
                                            <p class="card-text">
                                                <span>Địa điểm:</span>
                                                <b><?php echo  $listDatacourse[2]->address?></b>
                                            </p>
                                        </div>
                                    <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="tool">
        <div class="tool-contain container">
            <div class="contain">
                <h2>Đặt dụng cụ</h2>
                <div class="d-flex justify-content-between">
                    <p>SNAG® tập trung vào một hệ thống kiến thức đơn giản dễ hiểu và một phương thức tập golf mọi
                        lúc mọi nơi.</p>
                    <a class="button-link" href="/tool"><button class="custom-button button-reg button-yellow d-none d-lg-flex">ĐĂNG KÍ</button></a>
                </div>
                <img class="back-ground d-none d-lg-block" src="<?php echo $urlThemeActive; ?>assets/img/tool.png" alt="">
                <img class="back-ground d-block d-lg-none" src="<?php echo $urlThemeActive; ?>assets/img/dat_dung_cu.png" alt="">
            </div>
            <a class="button-link mobile-custom" href="tool"><button class="custom-button button-reg button-yellow d-flex d-lg-none">ĐĂNG KÍ</button></a>
        </div>
    </section>
    
    <section class="news">
        <div class="container">
            <div class="head">
                <h2>Tin tức</h2>
                <h2>VỀ CHÚNG TÔI</h2>
                <p>SNAG® tập trung vào một hệ thống kiến thức đơn giản dễ hiểu và một phương thức tập golf mọi lúc
                    mọi nơi. Mục tiêu của SNAG® là loại bỏ các rào cản về địa lý, kinh tế, xã hội nhằm đưa golf tới
                    tất cả mọi nhà.</p>
            </div>
            <div class="middle">
                <div class="row g-4">
                <?php foreach ($listDatatop as $key => $value) { ?>
                        <div class="col-12 col-lg-4">
                            <div class="card-news">
                                <div class="card">
                                    <div class="head-card">
                                        <img src="<?=$value->image?>" class="card-img-top" alt="...">
                                        <div class="overlay">
                                            <!-- <span>
                                                2022-11-09</span> -->
                                            <a href="<?php echo $value->slug ?>.html"><button class="rounded-circle"><img src="<?=$urlThemeActive?>assets/img/greater-than.svg" alt=""></button></a>
                                        </div>
                                    </div>
                                    <a href="<?php echo $value->slug ?>.html">
                                        <div class="card-body">
                                            <h5 class=""><?=$value->title ?></h5>
                                            <p class=""><?=$value->description ?></p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                <?php } ?>
                </div>
            </div>
        </div>
    </section>
</main>


<?php getFooter();?>