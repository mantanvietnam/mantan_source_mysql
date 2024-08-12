<?php
    getHeader();
   
?>
<main>
    <section class="post-head">
        <img src="<?= $urlThemeActive?>assets/img/tool-header.png" alt="">
    </section>
    <section class="head-component">
        <div class="container">
            <h1 class="tool_page">Đặt dụng cụ</h1>
            <h5 class="tool_page">Thông tin chung</h5>
            <p class="tool_page">
                Kích thích tình yêu golf trong trẻ nhỏ ngay hôm nay với bộ gậy sắc màu từ SNAG USA            </p>
        </div>
    </section>
    <section class="page-all-tool">
        <div class="container">
            <div class="row g-4 g-xl-5">
            <?php foreach ($listDatatool as $key => $value) { ?>
                <div class="col-12 col-lg-4">
                    <div class="card-tool-custom">
                        <div class="head">
                            <img class="" src="<?=$value->image?>" alt="">
                            <div class="content d-flex">
                                <div>
                                    <h6>SET 1</h6>
                                </div>
                                <div>
                                    <ul class="d-flex flex-column">
                                        <li><?= $value->title?></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="button-contain">
                                <a href="">
                                    <button class="custom-button button-reg">Chọn</button>
                                </a>
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
                <form action="/contact" method="POST">
                    <div class="row g-3">
                        <div class="col-12 col-lg-6 mt-0 mb-2">
                            <div class="form-field">
                                <label for="">Họ và tên<sup>*</sup></label>
                                <input required type="text" class="form-control" name="name" placeholder="Example: Nguyen Vu Minh Long">
                                <input type="hidden" value="<?php echo $csrfToken; ?>" name="_csrfToken">
                                <input type="hidden" class="form-control" name="content" value=" "></input> 
                                <input type="hidden" placeholder="" name="email" value=" " required class="form-control">
                                <input type="hidden" placeholder="" name="address" value=" " required class="form-control">
                                <input type="hidden" placeholder="" name="phone" value=" " required class="form-control">
                                <input type="hidden" placeholder="" name="subject" value="ĐĂNG KÝ NHẬN ƯU ĐÃI" class="form-control">   
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
    <section class="news d-block d-lg-none">
        <div class="container">
            <div class="head">
                <h2>Tin tức</h2>
                <h2>VỀ CHÚNG TÔI</h2>
                <p>SNAG® tập trung vào một hệ thống kiến thức đơn giản dễ hiểu và một phương thức tập golf mọi lúc
                    mọi nơi. Mục tiêu của SNAG® là loại bỏ các rào cản về địa lý, kinh tế, xã hội nhằm đưa golf tới
                    tất cả mọi nhà.</p>
            </div>
            <div class="middle">
                <div class="row g-4" loop="3">
                    <div class="col-12 col-lg-4">
                        <div class="card-news">
                            <div class="card">
                                <div class="head-card">
                                    <img src="http://snaggolftour.com/app/Theme/snagGolf/assets/img/card-news.png" class="card-img-top" alt="...">
                                    <div class="overlay">
                                        <span>20/08/2022</span>
                                        <a href=""><button class="rounded-circle"><img src="http://snaggolftour.com/app/Theme/snagGolf/assets/img/greater-than.svg" alt=""></button></a>
                                    </div>
                                </div>
                                <a href="">
                                    <div class="card-body">
                                        <h5 class="">Trẻ nên bắt đầu học và chơi golf
                                            ở độ tuổi nào?</h5>
                                        <p class="">
                                            SNAG® tập trung vào một hệ thống kiến thức đơn giản dễ hiểu và một
                                            phương
                                            thức tập golf mọi lúc mọi nơi. SNAG® tập trung vào một hệ thống kiến
                                            thức
                                            đơn giản dễ hiểu và một phương thức tập golf mọi lúc mọi nơi.
                                        </p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<?php getFooter();?>