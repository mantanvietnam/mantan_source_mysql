<?php 
    getheader();
    
?>

<main class="major-main">
        <section class="screen-banner-project" id="banner-projects-section">
            <div class="bp-block-1">
                <div class="bp-block-1-title">
                    <p>
                        Cecad
                    </p>
                    <h1>
                        <span>Lĩnh</span>
                        <span>Vực</span>
                    </h1>
                </div>
            </div>

            <div class="bp-block-2">
                <img src="https://cecad.phoenixtech.asia/upload/admin/files/oei_company_news.png" alt="">
            </div>
        </section>
        <section id="major-section-1">
            <div class="container">
                <div class="ms-1-block-1">
                    <div class="ms-1-block-1-img">
                        <img src="<?= $urlThemeActive?>asset/images/Artboard 3 2.png" alt="">
                    </div>
                    <div class="ms-1-block-1-sub">
                        <p>Hãy đồng hành cùng chúng tôi qua những câu chuyện trên con đường bảo vệ và gìn giữ thế giới tự nhiên của Việt Nam, vì một tương lai nơi con người và muôn loài hoang dã cùng nhau phát triển.</p>
                    </div>
                </div>
                <div class="ms-1-block-2">
                    <a href="/">HOME</a>
                </div>
            </div>
        </section>

        <section id="major-section-2">
            <div class="container">
                <div class="ms-2-block-1">
                    <div class="row">
                    <?php if (!empty($listDatafield[0])): ?>
                        <div class="col-lg-4 col-md-6 col-12" style="padding: 8px;">
                            <a href="/detailfield/<?php echo  $listDatafield[0]->slug ?>.html">
                                <div class="ms-2-block-1-item">
                                    <div class="ms-2-block-1-img">
                                        <img src="<?php echo $listDatafield[0]->imagebanner;?>" alt="">
                                    </div>
                                    <div class="ms-2-block-1-text">
                                        <p><?= $listDatafield[0]->name;?></p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($listDatafield[1])): ?>
                        <div class="col-lg-4 col-md-6 col-12" style="padding: 8px;">
                            <a href="/detailfield/<?php echo  $listDatafield[1]->slug ?>.html">
                                <div class="ms-2-block-1-item">
                                    <div class="ms-2-block-1-img">
                                        <img src="<?php echo $listDatafield[1]->imagebanner;?>" alt="">
                                    </div>
                                    <div class="ms-2-block-1-text">
                                        <p><?= $listDatafield[1]->name;?></p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($listDatafield[5])): ?>
                        <div class="col-lg-4 col-md-6 col-12" style="padding: 8px;">
                            <a href="/detailfield/<?php echo  $listDatafield[5]->slug ?>.html">
                                <div class="ms-2-block-1-item">
                                    <div class="ms-2-block-1-img">
                                        <img src="<?php echo $listDatafield[5]->imagebanner;?>" alt="">
                                    </div>
                                    <div class="ms-2-block-1-text">
                                        <p><?= $listDatafield[5]->name;?></p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($listDatafield[3])): ?>
                        <div class="col-lg-4 col-md-6 col-12" style="padding: 8px;">
                            <a href="/detailfield/<?php echo  $listDatafield[3]->slug ?>.html">
                                <div class="ms-2-block-1-item">
                                    <div class="ms-2-block-1-img">
                                        <img src="<?php echo $listDatafield[3]->imagebanner;?>" alt="">
                                    </div>
                                    <div class="ms-2-block-1-text">
                                        <p><?= $listDatafield[3]->name;?></p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($listDatafield[4])): ?>
                        <div class="col-lg-4 col-md-6 col-12" style="padding: 8px;">
                            <a href="/detailfield/<?php echo  $listDatafield[4]->slug ?>.html">
                                <div class="ms-2-block-1-item">
                                    <div class="ms-2-block-1-img">
                                        <img src="<?php echo $listDatafield[4]->imagebanner;?>" alt="">
                                    </div>
                                    <div class="ms-2-block-1-text">
                                        <p><?= $listDatafield[4]->name;?></p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($listDatafield[2])): ?>
                        <div class="col-lg-4 col-md-6 col-12" style="padding: 8px;">
                            <a href="/detailfield/<?php echo  $listDatafield[2]->slug ?>.html">
                                <div class="ms-2-block-1-item">
                                    <div class="ms-2-block-1-img">
                                        <img src="<?php echo $listDatafield[2]->imagebanner;?>" alt="">
                                    </div>
                                    <div class="ms-2-block-1-text">
                                        <p><?= $listDatafield[2]->name;?></p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endif; ?>
                        <!-- <div class="col-lg-4 col-md-6 col-12" style="padding: 8px;">
                            <a href="">
                                <div class="ms-2-block-1-item">
                                    <div class="ms-2-block-1-img">
                                        <img src="<?= $urlThemeActive?>asset/images/cover-1685678708.webp" alt="">
                                    </div>
                                    <div class="ms-2-block-1-text">
                                        <p>Bảo tồn đa dạng sinh học </p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4 col-md-6 col-12" style="padding: 8px;">
                            <a href="">
                                <div class="ms-2-block-1-item">
                                    <div class="ms-2-block-1-img">
                                        <img src="<?= $urlThemeActive?>asset/images/cover-1685677942.webp" alt="">
                                    </div>
                                    <div class="ms-2-block-1-text">
                                        <p>Bảo tồn đa dạng sinh học </p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4 col-md-6 col-12" style="padding: 8px;">
                            <a href="">
                                <div class="ms-2-block-1-item">
                                    <div class="ms-2-block-1-img">
                                        <img src="<?= $urlThemeActive?>asset/images/cover-1685678708.webp" alt="">
                                    </div>
                                    <div class="ms-2-block-1-text">
                                        <p>Bảo tồn đa dạng sinh học </p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4 col-md-6 col-12" style="padding: 8px;">
                            <a href="">
                                <div class="ms-2-block-1-item">
                                    <div class="ms-2-block-1-img">
                                        <img src="<?= $urlThemeActive?>asset/images/cover-1685677942.webp" alt="">
                                    </div>
                                    <div class="ms-2-block-1-text">
                                        <p>Bảo tồn đa dạng sinh học </p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4 col-md-6 col-12" style="padding: 8px;">
                            <a href="">
                                <div class="ms-2-block-1-item">
                                    <div class="ms-2-block-1-img">
                                        <img src="<?= $urlThemeActive?>asset/images/cover-1685678708.webp" alt="">
                                    </div>
                                    <div class="ms-2-block-1-text">
                                        <p>Bảo tồn đa dạng sinh học </p>
                                    </div>
                                </div>
                            </a>
                        </div> -->

                    </div>
                </div>
            </div>
        </section>
    </main>
<?php 
    getFooter();
?>