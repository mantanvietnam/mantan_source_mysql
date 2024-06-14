<?php
    getHeader();
    
    global $urlThemeActive;
    global $settingAdultCourse;

    $mess = '';
?>

<main>
    <section class="post-head">
        <img src="<?php echo $urlThemeActive; ?>assets/img/adult_course.png" alt="">
    </section>
    <section class="detail-course">
        <div class="container">
            <h1 class="heading-custom adult">SNAG GOLF ADULT</h1>
            <div class="row row-custom">
                <div class="col-12 col-lg-4 d-none d-lg-block">
                    <div>
                        <div class="info">
                            <span>Thời gian:</span>
                            <b><?php echo @$settingAdultCourse['time_adult_course']; ?></b>
                        </div>
                        <div class="info">
                            <span>Địa điểm:</span>
                            <b><?php echo @$settingAdultCourse['place_adult_course']; ?></b>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-8">
                    <div class="content-info">
                        <h5>Thông tin chung</h5>
                        <p>
                            <?php echo @$settingAdultCourse['content_info_adult_course']; ?>
                        </p>
                    </div>
                </div>
            </div>
            <section class="attr-custom adult">
                <div class="row g-4 g-xl-5">
                    <div class="col-12 col-lg-4">
                        <div class="card-custom">
                            <div class="image-attr">
                                <div class="d-flex align-items-center justify-content-center">
                                    <img src="<?php echo $urlThemeActive; ?>assets/img/course-attr.png" alt="">
                                    <h5 class="mb-0"><?php echo @$settingAdultCourse['title_adult_course_1']; ?></h5>
                                </div>
                            </div>
                            <p>
                                <?php echo @$settingAdultCourse['content_adult_course_1']; ?>
                            </p>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="card-custom">
                            <div class="image-attr">
                                <div class="d-flex align-items-center justify-content-center">
                                    <img src="<?php echo $urlThemeActive; ?>assets/img/tap-trung.svg" alt="">
                                    <h5 class="mb-0"><?php echo @$settingAdultCourse['title_adult_course_2']; ?></h5>
                                </div>
                            </div>
                            <p>
                                <?php echo @$settingAdultCourse['content_adult_course_2']; ?>
                            </p>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="card-custom">
                            <div class="image-attr">
                                <div class="d-flex align-items-center justify-content-center">
                                    <img src="<?php echo $urlThemeActive; ?>assets/img/relax.svg" alt="">
                                    <h5 class="mb-0"><?php echo @$settingAdultCourse['title_adult_course_3']; ?></h5>
                                </div>
                            </div>
                            <p>
                                <?php echo @$settingAdultCourse['content_adult_course_3']; ?>
                            </p>
                        </div>
                    </div>
                </div>

            </section>
            <div class="d-flex justify-content-center">
                <a href=""><button class="custom-button button-reg">Liên Hệ Ngay</button></a>
            </div>
        </div>
    </section>
    <section class="course-images">
        <div class="container contain-img">
            <img class="d-none d-lg-block" src="<?php echo $urlThemeActive; ?>assets/img/adult_course.png" alt="">
            <img class="w-100 d-lg-none" src="<?php echo $urlThemeActive; ?>assets/img/course-adult-detail.png" alt="">
        </div>
    </section>
    <section class="form-custom">
        <div class="container">
            <h3>ĐĂNG KÝ NHẬN ƯU ĐÃI</h3>
            <?php echo @$mess; ?>
            <div class="form-contain">
                <form action="" method="post">
                    <div class="row g-3">
                        <input type="hidden" name="idProductShow" value="6373b94b2ac5db71478b4567">
                        <input type="hidden" name="numberOrder" value="1">
                        <input type="hidden" name="_csrfToken" value="<?php echo $csrfToken; ?>">
                        <div class="col-12 col-lg-6 mt-0 mb-2">
                            <div class="form-field">
                                <label for="">Họ và tên<sup>*</sup></label>
                                <input required type="text" class="form-control" placeholder="" name="name">
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 mt-0 mb-2">
                            <div class="form-field">
                                <label for="">Email<sup>*</sup></label>
                                <input required type="email" class="form-control" placeholder="" name="email">
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 mt-0 mb-2">
                            <div class="form-field">
                                <label for="">Số điện thoại<sup>*</sup></label>
                                <input required type="text" class="form-control" placeholder="" name="phone_number">
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 mt-0 mb-2">
                            <div class="form-field">
                                <label for="">Khóa học<sup>*</sup></label>
                                <input required type="text" class="form-control" value="" name="course" >
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 mt-0 mb-2">
                            <div class="form-field">
                                <label for="">Địa chỉ<sup>*</sup></label>
                                <input required type="text" class="form-control" placeholder="" name="address">
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 mt-0 mb-2">
                            <div class="form-field">
                                <label for="">Chọn trung tâm<sup>*</sup></label>
                                <input required type="text" class="form-control" placeholder="" name="centre">
                            </div>
                        </div>
                    </div>
                    <div class="submit d-flex justify-content-center">
                        <button type="submit" class="custom-button button-reg">ĐĂNG KÝ NGAY</button>
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