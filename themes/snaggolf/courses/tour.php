<?php
    getHeader();

    global $urlThemeActive;
    global $settingTourCourse;

    $mess = '';
?>

<main>
    <section class="post-head">
        <img src="<?php echo @$urlThemeActive; ?>assets/img/tour_course.png" alt="">
    </section>
    <section class="detail-course">
        <div class="container">
            <h1 class="heading-custom adult text-custom-green">SNAG GOLF TOUR</h1>
            <div class="row row-custom">
                <div class="col-12 col-lg-4 d-none d-lg-block">
                    <div>
                        <div class="info">
                            <span>Thời gian:</span>
                            <b><?php echo @$settingTourCourse['time_tour_course']; ?></b>
                        </div>
                        <div class="info">
                            <span>Địa điểm:</span>
                            <b><?php echo @$settingTourCourse['place_tour_course']; ?></b>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-8">
                    <div class="content-info">
                        <h5>Thông tin chung</h5>
                        <p>
                            <?php echo @$settingTourCourse['content_info_tour_course']; ?>
                        </p>
                    </div>
                </div>
            </div>
            <section class="attr-custom adult">
                <div class="row g-4 g-xl-5">
                    <div class="col-12 col-lg-4">
                        <div class="card-custom shadow-green">
                            <div class="image-attr">
                                <div class="d-flex align-items-center justify-content-center">
                                    <img src="<?php echo $urlThemeActive; ?>assets/img/chuyen-nghiep-green.svg" alt="">
                                    <h5 class="mb-0 text-custom-green"><?php echo @$settingTourCourse['title_tour_course_1']; ?></h5>
                                </div>
                            </div>
                            <p>
                                <?php echo @$settingTourCourse['content_tour_course_1']; ?>
                            </p>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="card-custom shadow-green">
                            <div class="image-attr">
                                <div class="d-flex align-items-center justify-content-center">
                                    <img src="<?php echo $urlThemeActive; ?>assets/img/tap-trung-green.svg" alt="">
                                    <h5 class="mb-0 text-custom-green"><?php echo @$settingTourCourse['title_tour_course_2']; ?></h5>
                                </div>
                            </div>
                            <p>
                                <?php echo @$settingTourCourse['content_tour_course_2']; ?>
                            </p>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="card-custom shadow-green">
                            <div class="image-attr">
                                <div class="d-flex align-items-center justify-content-center">
                                    <img src="<?php echo $urlThemeActive; ?>assets/img/ket-noi.svg" alt="">
                                    <h5 class="mb-0 text-custom-green"><?php echo @$settingTourCourse['title_tour_course_3']; ?></h5>
                                </div>
                            </div>
                            <p>
                                <?php echo @$settingTourCourse['content_tour_course_3']; ?>
                            </p>
                        </div>
                    </div>
                </div>

            </section>
            <div class="d-flex justify-content-center">
                <a href=""><button class="custom-button button-reg bg-green-custom">Liên Hệ Ngay</button></a>
            </div>
        </div>
    </section>
    <section class="course-images">
        <div class="container contain-img">
            <img class="d-none d-lg-block" src="<?php echo $urlThemeActive; ?>assets/img/tour_course.png" alt="">
            <img class="w-100 d-lg-none" src="<?php echo $urlThemeActive; ?>assets/img/course-tour-detail.png" alt="">
        </div>
    </section>
    <section class="form-custom">
        <div class="container">
            <h3 class="text-custom-green">ĐĂNG KÝ NHẬN ƯU ĐÃI</h3>
            <?php echo @$mess; ?>
            <div class="form-contain">
                <form action="">
                    <div class="row g-3">
                        <input type="hidden" name="_csrfToken" value="<?php echo $csrfToken; ?>">
                        <div class="col-12 col-lg-6 mt-0 mb-2">
                            <div class="form-field">
                                <label class="textForm-green-custom" for="">Họ và tên<sup style="color: red!important;">*</sup></label>
                                <input required type="text" class="form-control" placeholder="" name="name">
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 mt-0 mb-2">
                            <div class="form-field">
                                <label class="textForm-green-custom" for="">Email<sup style="color: red!important;">*</sup></label>
                                <input required type="email" class="form-control" placeholder="" name="email">
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 mt-0 mb-2">
                            <div class="form-field">
                                <label class="textForm-green-custom" for="">Số điện thoại<sup style="color: red!important;">*</sup></label>
                                <input required type="number" class="form-control" placeholder="" name="phone_number">
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 mt-0 mb-2">
                            <div class="form-field">
                                <label class="textForm-green-custom" for="">Khóa học<sup style="color: red!important;">*</sup></label>
                                <input required type="text" class="form-control" placeholder="" name="course">
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 mt-0 mb-2">
                            <div class="form-field">
                                <label class="textForm-green-custom" for="">Địa chỉ<sup style="color: red!important;">*</sup></label>
                                <input required type="text" class="form-control" placeholder="" name="address">
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 mt-0 mb-2">
                            <div class="form-field">
                                <label class="textForm-green-custom" for="">Chọn trung tâm<sup style="color: red!important;">*</sup></label>
                                <input required type="text" class="form-control" placeholder="" name="centre">
                            </div>
                        </div>
                    </div>
                    <div class="submit d-flex justify-content-center">
                        <button type="submit" class="custom-button button-reg bg-green-custom">ĐĂNG KÝ NGAY</button>
                    </div>
                </form>
            </div>
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
                    <?php 
                    if(!empty($listPosts)){
                        foreach ($listPosts as $key => $value) {
                            $link = '/'.$value->slug.'.html';

                            echo '<div class="col-12 col-lg-4">
                                    <div class="card-news">
                                        <div class="card">
                                            <div class="head-card">
                                                <a href="'.$link.'"><img src="'.$value->image.'" alt=""></a>
                                                <div class="overlay">
                                                    <span class="post-author">'.date('d/m/Y', $value->time).'</span>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="">
                                                    <a href="'.$link.'">'.$value->title.'</a>
                                                </h5>
                                                <p>'.$value->description.'</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>';
                            }
                        }
                    ?> 
                </div>
            </div>
        </div>
    </section>
</main>
<?php getFooter(); ?>