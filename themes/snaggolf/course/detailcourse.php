<?php
    getHeader();
?>
<main>
    <section class="post-head">
        <img src="<?=$course['image']?>" alt="">
    </section>
    <section class="detail-course">
        <div class="container">
            <h1 class="heading-custom adult"><?=$course['name']?></h1>
            <div class="row row-custom">
                <div class="col-12 col-lg-4 d-none d-lg-block">
                    <div>
                        <div class="info">
                            <span>Thời gian:</span>
                            <b><?=$course['time_create']?></b>
                        </div>
                        <div class="info">
                            <span>Địa điểm:</span>
                            <b><?=$course['address']?></b>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-8">
                    <div class="content-info">
                        <h5>Thông tin chung</h5>
                        <p><?=$course['generalim']?></p>
                    </div>
                </div>
            </div>
            <section class="attr-custom adult">
                <div class="row g-4 g-xl-5">
                
                    <div class="col-12 col-lg-4">
                        <div class="card-custom">
                            <div class="image-attr">
                                <div class="d-flex align-items-center justify-content-center">
                                    <img src="<?= $urlThemeActive?>assets/img/course-attr.png" alt="">
                                    <h5 class="mb-0"><?=$course['title1']?></h5>
                                </div>
                            </div>
                            <p><?=$course['contenttiele1']?></p>
                        </div>
                    </div>
               
                    <div class="col-12 col-lg-4">
                        <div class="card-custom">
                            <div class="image-attr">
                                <div class="d-flex align-items-center justify-content-center">
                                    <img src="<?= $urlThemeActive?>assets/img/tap-trung.svg" alt="">
                                    <h5 class="mb-0"><?=$course['title2']?></h5>
                                </div>
                            </div>
                            <p><?=$course['contenttiele2']?></p>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="card-custom">
                            <div class="image-attr">
                                <div class="d-flex align-items-center justify-content-center">
                                    <img src="<?= $urlThemeActive?>assets/img/relax.svg" alt="">
                                    <h5 class="mb-0"><?=$course['title3']?></h5>
                                </div>
                            </div>
                            <p><?=$course['contenttiele3']?></p>
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
            <img class="d-none d-lg-block" src="http://snaggolftour.com/app/Theme/snagGolf/assets/img/adult_course.png" alt="">
            <img class="w-100 d-lg-none" src="http://snaggolftour.com/app/Theme/snagGolf/assets/img/course-adult-detail.png" alt="">
        </div>
    </section>
    <section class="form-custom">
        <div class="container">
            <h3>ĐĂNG KÝ NHẬN ƯU ĐÃI</h3>
            <div class="form-contain">
                <form action="/contact" method="post">
                    <div class="row g-3">
                        <input type="hidden" name="idProductShow" value="6373b94b2ac5db71478b4567">
                        <input type="hidden" name="numberOrder" value="1">
                        <div class="col-12 col-lg-6 mt-0 mb-2">
                            <div class="form-field">
                                <label for="">Họ và tên<sup>*</sup></label>
                                <input type="hidden" value="<?php echo $csrfToken; ?>" name="_csrfToken">
                                <input required type="text" class="form-control" placeholder="Example: Nguyen Vu Minh Long" name="name">
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 mt-0 mb-2">
                            <div class="form-field">
                                <label for="">Email<sup>*</sup></label>
                                <input required type="email" class="form-control" placeholder="Example: deocomate@gmail.com" name="email">
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 mt-0 mb-2">
                            <div class="form-field">
                                <label for="">Số điện thoại<sup>*</sup></label>
                                <input required type="number" class="form-control" placeholder="Example: 0565651189" name="phone">
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 mt-0 mb-2">
                            <div class="form-field">
                                <label for="subject">Khóa học<sup>*</sup></label>
                                <select required class="form-control" name="subject" id="subject">
                                    <option selected>chọn khóa học của bạn</option>
                                    <option value="golf_nguoi_lon">Khóa học golf người lớn</option>
                                    <option value="golf_thieu_nhi">Khóa học golf thiếu nhi</option>
                                    <option value="SNAG GOLF TOUR">SNAG GOLF TOUR</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 mt-0 mb-2">
                            <div class="form-field">
                                <label for="">Địa chỉ<sup>*</sup></label>
                                <input required type="text" class="form-control" placeholder="Example: 19 Hàng Thiếc" name="address">
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 mt-0 mb-2">
                            <div class="form-field">
                                <label for="">Chọn trung tâm<sup>*</sup></label>
                                <input required type="text" class="form-control" placeholder="Example: 191 Bà Triệu" name="content">
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
                <?php foreach ($listDatatop as $key => $value) { ?>
                        <div class="col-12 col-lg-4">
                            <div class="card-news">
                                <div class="card">
                                    <div class="head-card">
                                        <img src="<?=$value->image?>" class="card-img-top" alt="...">
                                        <div class="overlay">
                                            <!-- <span>
                                                2022-11-09</span> -->
                                            <a href="<?=$value->slug ?>"><button class="rounded-circle"><img src="http://snaggolftour.com/app/Theme/snagGolf/assets/img/greater-than.svg" alt=""></button></a>
                                        </div>
                                    </div>
                                    <a href="http://snaggolftour.com/3-me-con-hh-jennifer-pham-thang-dam-tai-snag-golf-tour-shining-summer-2023.html">
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
<?php
getFooter();
?>