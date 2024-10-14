<?php 
    getheader();
    global $settingThemes;
?>
 <main>
        <section id="about-section-1">
            <div class="as1-block-1">
                <div class="as1-banner">
                    <div class="as1-block-1">
                        <img src="<?= @$setting['bannerhome'];?>" alt="">
                    </div>
                    <div class="as1-block-2">
                        <div class="as1-block-2-title">
                            <h2><?= @$setting['titlebanner1'];?></h2>
                            <h1><?= @$setting['titlebanner2'];?></h1>
                            <p><?= @$setting['contentbanner'];?></p>
                        </div>
                        <div class="as1-block-2-btn">
                            <a href="#about-section-2"><i class="fa-solid fa-leaf"></i> <?= @$setting['buttonbanner'];?></a>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <section id="about-section-2">
            <div class="container">
                <div class="as2-block-1">
                    <h1>Về CECAD</h1>
                    <p>
                    <?= @$setting['contentdeepbanner1'];?>
                    </p>
                </div>
            </div>
        </section> 
        <section id="about-section-3">
            <div class="container">
                <div class="as3-block-1">
                    <h3>Con đường chúng tôi đi</h3>
                    <p>Kể từ khi thành lập, chúng tôi đã truyền cảm hứng, trao quyền, kết nối nhiều cộng đồng để cùng nhau lên tiếng và giải quyết các vấn đề môi trường ở Việt Nam thông qua 03 cách tiếp cận:</p>
                </div>
                <div class="as3-block-2">
                    <div class="as3-block-2-item as3-block-2-item-1">
                        <div class="as3-block-2-img">
                            <img src="<?= $urlThemeActive?>/asset/images/ic-media.png" alt="">
                        </div>
                        <div class="as3-block-2-sub">
                            <strong>Truyền thông sáng tạo</strong>
                        </div>
                    </div>
                    <div class="as3-block-2-item as3-block-2-item-2">
                        <div class="as3-block-2-img">
                            <img src="<?= $urlThemeActive?>/asset/images/ic-grow-2.png" alt="">
                        </div>
                        <div class="as3-block-2-sub">
                            <strong>Nâng cao năng lực
                                cộng đồng</strong>
                        </div>
                    </div>
                    <div class="as3-block-2-item as3-block-2-item-3">
                        <div class="as3-block-2-img">
                            <img src="<?= $urlThemeActive?>/asset/images/ic-eco-1.png" alt="">
                        </div>
                        <div class="as3-block-2-sub">
                            <strong>Hợp tác đa phương</strong>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="about-section-6">
            <div class="container">
                <div class="row" style="align-items: center;">
                    <div class="col-lg-7 col-md-12">
                        <div class="abs6-block-1">
                            <img src="<?= @$setting['imageleftabout'];?>" alt="">
                        </div>
                    </div>

                    <div class="col-lg-5 col-md-12">
                        <div class="as6-block-2">
                            <h1>Tầm nhìn</h1>
                            <p><?= @$setting['Vision'];?></p>
                        </div>

                    </div>
                </div>
            </div>
        </section>

        <section id="about-section-6">
            <div class="container">
                <div class="row" style="align-items: center;">
                    <div class="col-lg-5 col-md-12">
                        <div class="as6-block-2">
                            <h1>sứ mệnh</h1>
                            <p><?= @$setting['mission'];?></p>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-12">
                        <div class="abs6-block-1">
                            <img src="<?= @$setting['imageleftaboutmission'];?>" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="about-section-7" style="background-image: url(<?=@$setting['bannerfull']?>);"></section>

        <section id="about-section-8">
            <div class="container" style="max-width: 1500px;">

                <h1 class="text-center text-uppercase" style="font-size: 46px; margin-bottom: 50px !important; font-weight: 800;">Giá trị cốt lõi </h1>

                <div class="row">
                    <div class="col-md-6 col-lg-3 col-sm-6" style="margin-bottom: 30px">
                        <div class="as8-block-1">
                            <div class="as8-block-1-img">
                                <img src="<?= @$setting['imagettd'];?>" alt="">
                            </div>
                            <div class="as8-block-1-sub">
                                <h4>Tính toàn diện</h4>
                                <p><?= @$setting['ttd'];?></p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-3 col-sm-6" style="margin-bottom: 30px">
                        <div class="as8-block-1">
                            <div class="as8-block-1-img">
                                <img src="<?= @$setting['imagedm'];?>" alt="">
                            </div>
                            <div class="as8-block-1-sub">
                                <h4>Đổi mới</h4>
                                <p><?= @$setting['doimoi'];?></p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-3 col-sm-6" style="margin-bottom: 30px">
                        <div class="as8-block-1">
                            <div class="as8-block-1-img">
                                <img src="<?= @$setting['imageppln'];?>" alt="">
                            </div>
                            <div class="as8-block-1-sub">
                                <h4>Phương pháp tiếp cận liên ngành</h4>
                                <p><?= @$setting['ppln'];?></p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-3 col-sm-6" style="margin-bottom: 30px">
                        <div class="as8-block-1">
                            <div class="as8-block-1-img">
                                <img src="<?= @$setting['imagehq'];?>" alt="">
                            </div>
                            <div class="as8-block-1-sub">
                                <h4>Hiệu quả</h4>
                                <p><?= @$setting['hieuqua'];?></p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <section id="partner-section">
            <div class="container">
                <div class="title-section">
                    <h3>
                        <?= @$settingThemes['titlenlock7'];?>
                    </h3>
                </div>
                <div class="partner-list">
                <?php foreach ($slide_partner as $key => $value) { ?> 
                    <div class="partner-items">
                        <a href="<?php echo $value->link?>"><img src="<?php echo $value->image;?>" alt=""></a>
                    </div>
                <?php } ?>
                </div>
            </div>

        </section>
        <section id="about-section-5">
            <div class="container">
                <div class="as5-block-1">
                    <a href="/team"><i class="fa-solid fa-users"></i> GẶP GỠ ĐỘI NGŨ CECAD</a>
                </div>
            </div>
        </section>


    </main>
<?php 
    getFooter();
?>