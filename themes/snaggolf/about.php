<?php
    getHeader();
?>
<main>
    <section class="post-head">
        <img src="<?= $setting['bannerabout']?>" alt="">
    </section>
    <section class="post-content">
        <div class="container">
            <h1><?= $setting['titleabout']?></h1>
            <div class="post-content-main">
                <h5 dir="ltr"><strong><?= $setting['title1']?></strong></h5>
                <p dir="ltr"><span style="background-color:transparent; color:#000000; font-family:Arial; font-size:11pt"><?= $setting['contentabout1']?></span></p>
                <h5 dir="ltr"><strong><?= $setting['title2']?></strong></h5>
                <p dir="ltr"><span style="background-color:transparent; color:#000000; font-family:Arial; font-size:11pt"><?= $setting['contentabout2']?></span></p>
                <h5 dir="ltr"><strong><?= $setting['title3']?></strong></h5>
                <p dir="ltr"><span style="background-color:transparent; color:#000000; font-family:Arial; font-size:11pt"><?= $setting['contentabout3']?></span></p>
            </div>
    </section>



    <div class="post-more-header container">
        <h3>Tin tức khác</h3>
    </div>

    

    <section class="more">
        <div class="container">
            <div class="row g-4">
            <?php foreach ($listDatatop as $key => $value) { ?>
                <div class="col-12 col-lg-6">
                    <div class="contain">
                        <div class="post-card card">
                            <div class="d-flex">
                                <div class="card-img-custom">
                                    <img src="<?=$value->image?>" alt="">
                                </div>
                                <div class="card-content-custom">
                                    <div class="content-contain">
                                        <h5 class=""><?=$value->title ?></h5>
                                        <p class=""><?=$value->description ?></p>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <!-- <span>2022-04-26</span> -->
                                            <a href="<?php echo $value->slug ?>.html">
                                                <button>
                                                    <img src="<?=$urlThemeActive?>assets/img/news.right-arrow.png" alt="">
                                                </button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
            </div>
        </div>
    </section>
    <section class="form-custom">
        <div class="container">
            <h3>ĐĂNG KÝ NHẬN ƯU ĐÃI</h3>
            <div class="form-contain">
                <form action="/contact" method="post">
                    <div class="row g-3">
                        <div class="col-12 col-lg-6 mt-0 mb-2">
                            <div class="form-field">
                                <label for="">Họ và tên<sup>*</sup></label>
                                <input type="hidden" value="<?php echo $csrfToken; ?>" name="_csrfToken">
                                <input required type="text" class="form-control" placeholder="" name="name">
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 mt-0 mb-2">
                            <div class="form-field">
                                <label for="">Email<sup>*</sup></label>
                                <input required type="email" class="form-control" placeholder="" email="email" name="email">
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 mt-0 mb-2">
                            <div class="form-field">
                                <label for="">Số điện thoại<sup>*</sup></label>
                                <input required type="phone" class="form-control" placeholder="" phone="phone" name="phone">
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
                                <input required type="text" class="form-control" placeholder="" name="address">
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 mt-0 mb-2">
                            <div class="form-field">
                                <label for="">Chọn trung tâm<sup>*</sup></label>
                                <input required type="text" class="form-control" placeholder="" name="content">
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
</main>
<?php
getFooter();
?>