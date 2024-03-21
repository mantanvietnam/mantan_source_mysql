<?php
getHeader();
global $urlThemeActive;

?>
<main>
        <section id="about-us-banner">
            <div class="container">
                <div class="banner">
                    <p><a href="">Trang chủ</a> / Về Kyiova</p>
                    <div class="banner-img">
                        <img src="<?php echo @$data['image_banner'] ?>" alt="">
                    </div>
                </div>
            </div>
        </section>

        <section id="about-us-content">
            <div class="container-padding container">
                <div class="about-start">
                    <h3><?php echo @$data['titel'] ?></h3>
                    <p><?php echo @$data['content'] ?></p>

                </div>

                <div class="row section-detail section-detail-1">
                    <div class="col-lg-6 col-12 col-padding-right">
                        <div class="detail-img">
                            <img src="<?php echo @$data['image1'] ?>" alt="">

                        </div>
                    </div>
                    <div class="col-lg-6 col-12">
                        <p><?php echo @$data['content1'] ?></p>
                    </div>
                </div>

                <div class="row section-detail section-detail-2">
                    <div class="col-lg-6 col-12">
                        <p><?php echo @$data['content2'] ?></p>
                    </div>
                    <div class="col-lg-6 col-12 col-padding-left">
                        <div class="detail-img">
                            <img src="<?php echo @$data['image2'] ?>" alt="">

                        </div>
                    </div>
                </div>
                <div class="about-misstion">
                    <img src="<?php echo @$data['image3'] ?>" alt="">
                </div>
            </div>
        </section>
    </main>
<?php
getFooter();?>