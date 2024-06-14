<?php
    getHeader();
    global $urlThemeActive;
    global $settingAdultCourse;
    global $settingKidCourse;
    global $settingTourCourse;
?>

<main>
    <section class="page-course adult">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="contain">
                        <h1 class="heading-custom adult">SNAG GOLF ADULT</h1>
                        <p>
                            <?php echo @$settingAdultCourse['introduction_adult_course']; ?>
                        </p>
                        <a href="/khoa-hoc-nguoi-lon" class="d-none d-lg-block">
                            <button class="custom-button button-reg">CHI TIẾT</button>
                        </a>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="img-contain d-flex justify-content-end ">
                        <img src="<?php echo @$urlThemeActive; ?>/assets/img/adult_course.png" alt="">
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <a href="" class="d-block d-lg-none btn-mobile">
                        <button class="custom-button button-reg">CHI TIẾT</button>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <section class="page-course kid">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="contain">
                        <h1 class="heading-custom kid">SNAG GOLF KID</h1>
                        <p>
                            <?php echo @$settingKidCourse['introduction_kid_course']; ?>
                        </p>
                        <a href="/khoa-hoc-tre-em" class="d-none d-lg-block">
                            <button class="custom-button button-reg kid">CHI TIẾT</button>
                        </a>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="img-contain d-flex justify-content-end ">
                        <img src="<?php echo @$urlThemeActive; ?>/assets/img/kid_course.png" alt="">
                    </div>
                    <div class="d-flex justify-content-center">
                        <a href="" class="d-block d-lg-none btn-mobile">
                            <button class="custom-button button-reg kid">CHI TIẾT</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="page-course tour">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="contain">
                        <h1 class="heading-custom tour">SNAG GOLF TOUR</h1>
                        <p>
                            <?php echo @$settingTourCourse['introduction_tour_course']; ?>
                        </p>
                        <a href="/khoa-hoc-giai-dau" class="d-none d-lg-block">
                            <button class="custom-button button-reg tour">CHI TIẾT</button>
                        </a>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="img-contain d-flex justify-content-end ">
                        <img src="<?php echo @$urlThemeActive; ?>/assets/img/tour_course.png" alt="">
                    </div>
                    <div class="d-flex justify-content-center">
                        <a href="" class="d-block d-lg-none btn-mobile">
                            <button class="custom-button button-reg tour">CHI TIẾT</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php getFooter(); ?>