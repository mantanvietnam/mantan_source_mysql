<?php
getHeader();
global $urlThemeActive;
?>
<main>
    <?php if (!empty($data->image360)) { ?>

        <section class="page-banner">
            <div class="iframe-banner">
                <iframe src="<?php echo $data->image360 ?>"
                        frameborder="0"></iframe>
            </div>
        </section>
    <?php } ?>

    <section class="section-background-index">
        <div class="container-fluid background-index">
            <img src="<?= $urlThemeActive ?>img/background-index.jpg" alt="">
        </div>
    </section>

    <section id="place-detail">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-4 place-content">
                    <div class="place-title">
                        <h1><?php echo $data->name ?></h1>
                    </div>
                    <div class="place-address">
                        <p><?= $data->address ?></p>
                    </div>
                    <div class="button-content">
                        <div class="button-like">
                            <button type="button"><i class="fa-regular fa-heart"></i>Yêu thích</button>
                        </div>
                        <div class="button-share">
                            <a href="">
                                <button type="button"><i class="fa-solid fa-share-nodes"></i>Chia
                                    sẻ
                                </button>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-9 col-md-8 col-sm-8 col-12 place-img-slide">
                        <?php if(!empty($data->image)){ ?>
                            <div class="img-slide-item">
                            <img src="<?php echo $data->image ?>" alt="">
                        </div>
                        <?php } ?>
                        <?php if(!empty($data->image2)){ ?>
                            <div class="img-slide-item">
                            <img src="<?php echo $data->image2 ?>" alt="">
                        </div>
                        <?php } ?>
                        <?php if(!empty($data->image3)){ ?>
                            <div class="img-slide-item">
                            <img src="<?php echo $data->image3 ?>" alt="">
                        </div>
                        <?php } ?>
                        <?php if(!empty($data->image4)){ ?>
                            <div class="img-slide-item">
                            <img src="<?php echo $data->image4 ?>" alt="">
                        </div>
                        <?php } ?>
                        <?php if(!empty($data->image5)){ ?>
                            <div class="img-slide-item">
                            <img src="<?php echo $data->image5 ?>" alt="">
                        </div>
                        <?php } ?>
                        <?php if(!empty($data->image6)){ ?>
                            <div class="img-slide-item">
                            <img src="<?php echo $data->image6 ?>" alt="">
                        </div>
                        <?php } ?>
                        <?php if(!empty($data->image7)){ ?>
                            <div class="img-slide-item">
                            <img src="<?php echo $data->image7 ?>" alt="">
                        </div>
                        <?php } ?>
                        <?php if(!empty($data->image8)){ ?>
                            <div class="img-slide-item">
                            <img src="<?php echo $data->image8 ?>" alt="">
                        </div>
                        <?php } ?>
                        <?php if(!empty($data->image9)){ ?>
                            <div class="img-slide-item">
                            <img src="<?php echo $data->image9 ?>" alt="">
                        </div>
                        <?php } ?>
                        <?php if(!empty($data->image10)){ ?>
                            <div class="img-slide-item">
                            <img src="<?php echo $data->image10 ?>" alt="">
                        </div>
                        <?php } ?>
                    </div>
            </div>
        </div>
    </section>

    <section id="place-information" class="mgt-80">
        <div class="container">
            <div class="title-h1 title-information mgb-32">
                <p>Chùa bà già</p>
            </div>
            <div class="icon-information mgb-32">
                <div class="icon-information-time">
                    <p><i class="fa-solid fa-clock"></i> 8:00 - 12:00</p>
                </div>
                <div class="icon-information-phone">
                    <p><i class="fa-solid fa-phone"></i> <?= $data->phone ?></p>
                </div>
                <div class="icon-information-price">
                    <p><i class="fa-solid fa-tag"></i> 100.000 vnđ</p>
                </div>
            </div>
            <div class="content-information mgb-32">
                <?= $data->content ?>
            </div>
        </div>
    </section>

    <!-- Đặt bàn -->
    <section id="order-table" style="background-image:url(<?=$urlThemeActive?>/img/background_Res.png)">
        <div class="container-order-table container">
            <div class="row-order-table row">
                <div class="col-lg-6 col-lg-6 col-md-6 col-sm-12">

                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-order-table">
                    <div class="title-order-table">
                        <p>Đặt bàn</p>
                    </div>
                    <form action="">
                        <div class="input-group group-order-table">
                            <label class="input-group-text">Tên</label>
                            <input type="text" class="form-control" placeholder="Nhập họ và tên" required>
                        </div>

                        <div class="input-group group-order-table">
                            <label class="input-group-text">Điện thoại</label>
                            <input type="tel" class="form-control" placeholder="Nhập số điện thoại"
                                   pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}" required>
                        </div>

                        <div class="input-group group-order-table">
                            <label class="input-group-text">Số người</label>
                            <input type="number" class="form-control" required>
                        </div>

                        <div class="input-group group-order-table">
                            <label class="input-group-text">Nhận phòng</label>
                            <input type="date" class="form-control" required>
                        </div>

                        <div class="input-group group-order-table">
                            <label class="input-group-text">Nhận phòng</label>
                            <input type="date" class="form-control" required>
                        </div>
                        <button type="submit">Đặt bàn ngay</button>

                    </form>
                </div>


            </div>
        </div>
    </section>

    <!-- Bản đồ -->
    <section id="map-section" class="mgt-80">
        <div class="container">
            <div class="title-section mgb-32">
                <p>Bản đồ</p>
            </div>
            <div class="map-iframe">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3722.5804123529997!2d<?= $data->latitude ?>!3d<?= $data->longitude ?>!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135aabfcddf68d1%3A0xc5f6bb39271c2a7b!2zQ2jDuWEgQsOgIEdpw6A!5e0!3m2!1svi!2s!4v1678994756041!5m2!1svi!2s"
                    width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </section>
    <!-- Địa điểm xung quanh -->
    <section id="place-around-section" class="mgt-80">
        <div class="container">
            <div class="title-section mgb-32">
                <p>Địa điểm xung quanh</p>
            </div>

            <div class="place-around-slide">
                <div class="place-around-slide-item">
                    <div class="place-around-img">
                        <a href=""><img src="../img/chua-ba-gia-1-1536x1051-0304.png" alt=""></a>
                    </div>


                    <div class="place-around-title">
                        <a href="">Làng cổ Nghi Tầm</a>
                    </div>

                    <div class="place-around-box-address">
                        <div class="place-around-address">
                            <p>Phường Quảng An, Tây Hồ</p>
                        </div>

                        <div class="place-around-size">
                            <p>12 km</p>
                        </div>
                    </div>
                </div>

                <div class="place-around-slide-item">
                    <div class="place-around-img">
                        <a href=""><img src="../img/chua-ba-gia-1-1536x1051-0304.png" alt=""></a>
                    </div>


                    <div class="place-around-title">
                        <a href="">Làng cổ Nghi Tầm</a>
                    </div>

                    <div class="place-around-box-address">
                        <div class="place-around-address">
                            <p>Phường Quảng An, Tây Hồ</p>
                        </div>

                        <div class="place-around-size">
                            <p>12 km</p>
                        </div>
                    </div>
                </div>

                <div class="place-around-slide-item">
                    <div class="place-around-img">
                        <a href=""><img src="../img/chua-ba-gia-1-1536x1051-0304.png" alt=""></a>
                    </div>


                    <div class="place-around-title">
                        <a href="">Làng cổ Nghi Tầm</a>
                    </div>

                    <div class="place-around-box-address">
                        <div class="place-around-address">
                            <p>Phường Quảng An, Tây Hồ</p>
                        </div>

                        <div class="place-around-size">
                            <p>12 km</p>
                        </div>
                    </div>
                </div>

                <div class="place-around-slide-item">
                    <div class="place-around-img">
                        <a href=""><img src="../img/chua-ba-gia-1-1536x1051-0304.png" alt=""></a>
                    </div>

                    <div class="place-around-title">
                        <a href="">Làng cổ Nghi Tầm</a>
                    </div>

                    <div class="place-around-box-address">
                        <div class="place-around-address">
                            <p>Phường Quảng An, Tây Hồ</p>
                        </div>
                        <div class="place-around-size">
                            <p>12 km</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Đánh gíá -->
    <section id="place-comment" class="mgt-80">
        <div class="container">
            <div class="title-section mgb-32">
                <p>Đánh giá</p>
            </div>
            <div class="row mgb-50">
                <div class="col-lg-7 col-md-7 col-sm-7 box-point-bar">
                    <div class="box-progress">
                        <div class="number-progess"><span>5</span></div>
                        <div class="progress point-progress">
                            <div class="point-progress-bar progress-bar" role="progressbar" style="width: 100%"
                                 aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="box-progress">
                        <div class="number-progess"><span>4</span></div>
                        <div class="progress point-progress">
                            <div class="point-progress-bar progress-bar" role="progressbar" style="width: 25%"
                                 aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="box-progress">
                        <div class="number-progess"><span>3</span></div>
                        <div class="progress point-progress">
                            <div class="progress-bar point-progress-bar" role="progressbar" style="width: 50%"
                                 aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="box-progress">
                        <div class="number-progess"><span>2</span></div>
                        <div class="progress point-progress">
                            <div class="progress-bar point-progress-bar" role="progressbar" style="width: 75%"
                                 aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="box-progress">
                        <div class="number-progess"><span>1</span></div>
                        <div class="progress point-progress">
                            <div class="progress-bar point-progress-bar" role="progressbar" aria-valuenow="0"
                                 aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5 col-lg-5 col-sm-5 box-point-right">
                    <div class="point-right-number">
                        <p>4.1</p>
                    </div>
                    <div class="point-right-star">
                        <i class="fa fa-star checked"></i>
                        <i class="fa fa-star checked"></i>
                        <i class="fa fa-star checked"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>

                    </div>

                    <div class="point-right-post">
                        <p>4.123 <span>bài viết</span></p>
                    </div>
                </div>
            </div>

            <div class="row box-write-comment">
                <div class="write-comment">
                    <button class="button-write-comment" type="button">
                        <div class="button-icon-comment">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                 class="bi bi-chat-right-dots" viewBox="0 0 16 16">
                                <path
                                    d="M2 1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h9.586a2 2 0 0 1 1.414.586l2 2V2a1 1 0 0 0-1-1H2zm12-1a2 2 0 0 1 2 2v12.793a.5.5 0 0 1-.854.353l-2.853-2.853a1 1 0 0 0-.707-.293H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12z"/>
                                <path
                                    d="M5 6a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                            </svg>
                        </div>
                        <p class="button-text-comment">Viết đánh giá</p>
                    </button>
                </div>

                <!-- viet content  -->
                <div class="write-comment-content">
                    <div class="information-people-write">
                        <img class="information-people-write-img"
                             src="../img/worried-man-avata-avatar-worried-man-vector-illustration-107469775.jpg"
                             alt="">
                        <p class="information-people-write-name">Nguyễn Quốc Việt</span>
                    </div>

                    <div class="rating-box">
                        <div class="stars">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                    </div>

                    <div class="form-comment">
                            <textarea class="content-post" name="content-post"
                                      placeholder="Viết suy nghĩ của bạn"></textarea>
                        <button type="submit" class="send-comment">Đăng bài</button>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!--Bài viết Đánh gíá -->
    <section id="place-post-comment">
        <div class="container">
            <div class="row">
                <div class="title-post-comment">
                    <p>Tất cả các bài đánh giá</p>
                </div>

                <div class="post-comment">
                    <div class="post-comment-content">
                        <div class="information-people">
                            <div class="information-people-img">
                                <img src="../img/worried-man-avata-avatar-worried-man-vector-illustration-107469775.jpg"
                                     alt="">
                            </div>
                            <div class="information-people-box">
                                <div class="information-people-name">
                                    <span>Nguyễn Quốc Việt</span>
                                </div>
                                <div class="information-people-hour">
                                    <span>3 giờ trước</span>
                                </div>
                            </div>
                        </div>

                        <div class="information-people-star">
                            <div class="point-right-star">
                                <i class="fa fa-star checked"></i>
                                <i class="fa fa-star checked"></i>
                                <i class="fa fa-star checked"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                        </div>
                    </div>

                    <div class="post-comment-content-text">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat
                    </div>
                </div>

                <div class="post-comment">
                    <div class="post-comment-content">
                        <div class="information-people">
                            <div class="information-people-img">
                                <img src="../img/worried-man-avata-avatar-worried-man-vector-illustration-107469775.jpg"
                                     alt="">
                            </div>
                            <div class="information-people-box">
                                <div class="information-people-name">
                                    <span>Nguyễn Quốc Việt</span>
                                </div>
                                <div class="information-people-hour">
                                    <span>3 giờ trước</span>
                                </div>
                            </div>
                        </div>

                        <div class="information-people-star">
                            <div class="point-right-star">
                                <i class="fa fa-star checked"></i>
                                <i class="fa fa-star checked"></i>
                                <i class="fa fa-star checked"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                        </div>
                    </div>

                    <div class="post-comment-content-text">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat
                    </div>
                </div>

                <div class="post-comment">
                    <div class="post-comment-content">
                        <div class="information-people">
                            <div class="information-people-img">
                                <img src="../img/worried-man-avata-avatar-worried-man-vector-illustration-107469775.jpg"
                                     alt="">
                            </div>
                            <div class="information-people-box">
                                <div class="information-people-name">
                                    <span>Nguyễn Quốc Việt</span>
                                </div>
                                <div class="information-people-hour">
                                    <span>3 giờ trước</span>
                                </div>
                            </div>
                        </div>

                        <div class="information-people-star">
                            <div class="point-right-star">
                                <i class="fa fa-star checked"></i>
                                <i class="fa fa-star checked"></i>
                                <i class="fa fa-star checked"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                        </div>
                    </div>

                    <div class="post-comment-content-text">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="pagination-page">
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item"><a class="page-link" href="#"><i class="fa-solid fa-chevron-left"></i></a>
                </li>
                <li class="page-item "><a class="page-link active" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#"><i class="fa-solid fa-chevron-right"></i></a>
                </li>
            </ul>
        </nav>
    </section>
</main>s
<?php
getFooter(); ?>
