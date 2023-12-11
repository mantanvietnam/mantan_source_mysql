<?php
getHeader();
global $urlThemeActive;
?>
  <main>
       <!--  Phần Banner 360  -->
    <section id="banner360">
        <div class="iframe-360">
            <iframe src="<?php echo $setting['link_image360'] ?>" frameborder="0"></iframe>
        </div>

    </section>

    <!--  Phần Places  -->
    <section id="places">
        <div class="row">
            <div class="places-title">
                <h2>Điểm đến Văn hóa - Du lịch tiêu biểu</h2>
                <p>Khám phá Điểm đên Văn hóa - Du lịch tiêu biểu huyện Mai Châu</p>
            </div>
        </div>
        <div class="row">
            <div class="container-fluid">
                <div class="places-slide">
                    <?php if(!empty($listHistorie)){ 
                        foreach ($listHistorie as $key => $value){ ?>
                    <div class="item-slide">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="item-slide-img">
                                    <img src="<?php echo @$value->image ?>" alt="">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="item-slide-content">
                                    <h3><?php echo @$value->name ?></h3>
                                    <p><?php echo @$value->address ?></p>
                                    <span><?php echo @$value->introductory ?></span>
                                </div>
                                <div class="item-slide-btn">
                                    <a href="/chi_tiet_di_tich_lich_su/<?php echo @$value->urlSlug ?>.html">Xem chi tiết</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php }} ?>
                   

                </div>
            </div>
        </div>
    </section>

    <!--  Phần Event  -->
    <section id="events">
        <div class="row">
            <div class="events-title">
                <h2>Tin tức - sự kiện</h2>
                <p>Những Tin tức - Sự kiện Văn hoá, Du lịch tiêu biểu</p>
            </div>
        </div>

        <div class="container-fluid combo-slide-1">
            <div class="events-month-slide">
                <div class="item-month-slide">
                    <p>Tháng 1</p>
                </div>

                <div class="item-month-slide">
                    <p>Tháng 2</p>
                </div>

                <div class="item-month-slide">
                    <p>Tháng 3</p>
                </div>

                <div class="item-month-slide">
                    <p>Tháng 4</p>
                </div>

                <div class="item-month-slide">
                    <p>Tháng 5</p>
                </div>

                <div class="item-month-slide">
                    <p>Tháng 6</p>
                </div>

                <div class="item-month-slide">
                    <p>Tháng 7</p>
                </div>

                <div class="item-month-slide">
                    <p>Tháng 8</p>
                </div>

                <div class="item-month-slide">
                    <p>Tháng 9</p>
                </div>

                <div class="item-month-slide">
                    <p>Tháng 10</p>
                </div>

                <div class="item-month-slide">
                    <p>Tháng 11</p>
                </div>

                <div class="item-month-slide">
                    <p>Tháng 12</p>
                </div>
            </div>
        </div>

        <div class="container-fluid combo-slide-2">
            <div class="events-slide">
                <div class="item-events-slide">
                    <div class="events-slide-img">
                        <img src="../images/slide-event.png" alt="">
                    </div>
                    <div class="events-slide-content">
                        <div class="row">
                            <div class="col-lg-6 col-md-7 col-sm-12">
                                <div class="events-slide-content-box">
                                    <div class="events-slide-detail">
                                        <a href="">
                                            <h3>Chung khảo Hội thiếu nhi Mai Châu tuyên truyền giới thiệu sách</h3>
                                        </a>
                                        <p>Ngày 1/7/2023 - Ngày 12/7/2023</p>
                                    </div>
                                    <div class="events-slide-btn">
                                        <a href="">Xem chi tiết</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="item-events-slide">
                    <div class="events-slide-img">
                        <img src="../images/slide-event.png" alt="">
                    </div>
                    <div class="events-slide-content">
                        <div class="row">
                            <div class="col-lg-6 col-md-7 col-sm-12">
                                <div class="events-slide-content-box">
                                    <div class="events-slide-detail">
                                        <a href="">
                                            <h3>Chung khảo Hội thiếu nhi Mai Châu tuyên truyền giới thiệu sách</h3>
                                        </a>
                                        <p>Ngày 1/7/2023 - Ngày 12/7/2023</p>
                                    </div>
                                    <div class="events-slide-btn">
                                        <a href="">Xem chi tiết</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="item-events-slide">
                    <div class="events-slide-img">
                        <img src="../images/slide-event.png" alt="">
                    </div>
                    <div class="events-slide-content">
                        <div class="row">
                            <div class="col-lg-6 col-md-7 col-sm-12">
                                <div class="events-slide-content-box">
                                    <div class="events-slide-detail">
                                        <a href="">
                                            <h3>Chung khảo Hội thiếu nhi Mai Châu tuyên truyền giới thiệu sách</h3>
                                        </a>
                                        <p>Ngày 1/7/2023 - Ngày 12/7/2023</p>
                                    </div>
                                    <div class="events-slide-btn">
                                        <a href="">Xem chi tiết</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="item-events-slide">
                    <div class="events-slide-img">
                        <img src="../images/slide-event.png" alt="">
                    </div>
                    <div class="events-slide-content">
                        <div class="row">
                            <div class="col-lg-6 col-md-7 col-sm-12">
                                <div class="events-slide-content-box">
                                    <div class="events-slide-detail">
                                        <a href="">
                                            <h3>Chung khảo Hội thiếu nhi Mai Châu tuyên truyền giới thiệu sách</h3>
                                        </a>
                                        <p>Ngày 1/7/2023 - Ngày 12/7/2023</p>
                                    </div>
                                    <div class="events-slide-btn">
                                        <a href="">Xem chi tiết</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="item-events-slide">
                    <div class="events-slide-img">
                        <img src="../images/slide-event.png" alt="">
                    </div>
                    <div class="events-slide-content">
                        <div class="row">
                            <div class="col-lg-6 col-md-7 col-sm-12">
                                <div class="events-slide-content-box">
                                    <div class="events-slide-detail">
                                        <a href="">
                                            <h3>Chung khảo Hội thiếu nhi Mai Châu tuyên truyền giới thiệu sách</h3>
                                        </a>
                                        <p>Ngày 1/7/2023 - Ngày 12/7/2023</p>
                                    </div>
                                    <div class="events-slide-btn">
                                        <a href="">Xem chi tiết</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="item-events-slide">
                    <div class="events-slide-img">
                        <img src="../images/slide-event.png" alt="">
                    </div>
                    <div class="events-slide-content">
                        <div class="row">
                            <div class="col-lg-6 col-md-7 col-sm-12">
                                <div class="events-slide-content-box">
                                    <div class="events-slide-detail">
                                        <a href="">
                                            <h3>Chung khảo Hội thiếu nhi Mai Châu tuyên truyền giới thiệu sách</h3>
                                        </a>
                                        <p>Ngày 1/7/2023 - Ngày 12/7/2023</p>
                                    </div>
                                    <div class="events-slide-btn">
                                        <a href="">Xem chi tiết</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="item-events-slide">
                    <div class="events-slide-img">
                        <img src="../images/slide-event.png" alt="">
                    </div>
                    <div class="events-slide-content">
                        <div class="row">
                            <div class="col-lg-6 col-md-7 col-sm-12">
                                <div class="events-slide-content-box">
                                    <div class="events-slide-detail">
                                        <a href="">
                                            <h3>Chung khảo Hội thiếu nhi Mai Châu tuyên truyền giới thiệu sách</h3>
                                        </a>
                                        <p>Ngày 1/7/2023 - Ngày 12/7/2023</p>
                                    </div>
                                    <div class="events-slide-btn">
                                        <a href="">Xem chi tiết</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="item-events-slide">
                    <div class="events-slide-img">
                        <img src="../images/slide-event.png" alt="">
                    </div>
                    <div class="events-slide-content">
                        <div class="row">
                            <div class="col-lg-6 col-md-7 col-sm-12">
                                <div class="events-slide-content-box">
                                    <div class="events-slide-detail">
                                        <a href="">
                                            <h3>Chung khảo Hội thiếu nhi Mai Châu tuyên truyền giới thiệu sách</h3>
                                        </a>
                                        <p>Ngày 1/7/2023 - Ngày 12/7/2023</p>
                                    </div>
                                    <div class="events-slide-btn">
                                        <a href="">Xem chi tiết</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="item-events-slide">
                    <div class="events-slide-img">
                        <img src="../images/slide-event.png" alt="">
                    </div>
                    <div class="events-slide-content">
                        <div class="row">
                            <div class="col-lg-6 col-md-7 col-sm-12">
                                <div class="events-slide-content-box">
                                    <div class="events-slide-detail">
                                        <a href="">
                                            <h3>Chung khảo Hội thiếu nhi Mai Châu tuyên truyền giới thiệu sách</h3>
                                        </a>
                                        <p>Ngày 1/7/2023 - Ngày 12/7/2023</p>
                                    </div>
                                    <div class="events-slide-btn">
                                        <a href="">Xem chi tiết</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="item-events-slide">
                    <div class="events-slide-img">
                        <img src="../images/slide-event.png" alt="">
                    </div>
                    <div class="events-slide-content">
                        <div class="row">
                            <div class="col-lg-6 col-md-7 col-sm-12">
                                <div class="events-slide-content-box">
                                    <div class="events-slide-detail">
                                        <a href="">
                                            <h3>Chung khảo Hội thiếu nhi Mai Châu tuyên truyền giới thiệu sách</h3>
                                        </a>
                                        <p>Ngày 1/7/2023 - Ngày 12/7/2023</p>
                                    </div>
                                    <div class="events-slide-btn">
                                        <a href="">Xem chi tiết</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="item-events-slide">
                    <div class="events-slide-img">
                        <img src="../images/slide-event.png" alt="">
                    </div>
                    <div class="events-slide-content">
                        <div class="row">
                            <div class="col-lg-6 col-md-7 col-sm-12">
                                <div class="events-slide-content-box">
                                    <div class="events-slide-detail">
                                        <a href="">
                                            <h3>Chung khảo Hội thiếu nhi Mai Châu tuyên truyền giới thiệu sách</h3>
                                        </a>
                                        <p>Ngày 1/7/2023 - Ngày 12/7/2023</p>
                                    </div>
                                    <div class="events-slide-btn">
                                        <a href="">Xem chi tiết</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="item-events-slide">
                    <div class="events-slide-img">
                        <img src="../images/slide-event.png" alt="">
                    </div>
                    <div class="events-slide-content">
                        <div class="row">
                            <div class="col-lg-6 col-md-7 col-sm-12">
                                <div class="events-slide-content-box">
                                    <div class="events-slide-detail">
                                        <a href="">
                                            <h3>Chung khảo Hội thiếu nhi Mai Châu tuyên truyền giới thiệu sách</h3>
                                        </a>
                                        <p>Ngày 1/7/2023 - Ngày 12/7/2023</p>
                                    </div>
                                    <div class="events-slide-btn">
                                        <a href="">Xem chi tiết</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- <div class="event-bg">
            <img src="../images/bg3.png" alt="">
        </div> -->

    </section>

    <section id="map">
        <div class="row">
            <div class="map-title">
                <h2>Bản đồ Số</h2>
                <p>Trải nghiệm tham quan ảo thông minh và tiện ích qua Bản đồ số</p>
            </div>
        </div>
        <div class="row">
            <div class="map-iframe">
               <?php include("findnear_openstreet_map.php"); ?>
            </div>
        </div>

    </section>

    <section id="destinations">
        <div class="destinations-title">
            <h2>VIỆT NAM 360</h2>
            <p>Khám phá những điểm đến tuyệt vời không thể bỏ lỡ ở Việt Nam</p>
        </div>

        <div class="container">
            <div class="destinations-slide">
                <div class="item-destinations-slide">
                    <a href="">
                        <img src="../images/destination-slide.jpg" alt="">
                    </a>
                </div>

                <div class="item-destinations-slide">
                    <a href="">
                        <img src="../images/destination-slide.jpg" alt="">
                    </a>
                </div>

                <div class="item-destinations-slide">
                    <a href="">
                        <img src="../images/destination-slide.jpg" alt="">
                    </a>
                </div>

                <div class="item-destinations-slide">
                    <a href="">
                        <img src="../images/destination-slide.jpg" alt="">
                    </a>
                </div>

            </div>

        </div>
    </section>
  </main>
<?php
getFooter();?>
