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
                    <p>
                    <?= @$setting['contentdeepbanner1'];?>
                    </p>
                </div>
                <div class="as2-block-2">
                    <h3><?= @$setting['contentdeepbanner2'];?></h3>
                </div>
                <div class="as2-block-3">
                    <strong style="margin-bottom: 12px; display: block;"><?= @$setting['titlesmall'];?></strong>
                    <p><?= @$setting['contentshort1'];?></p>
                </div>
            </div>
        </section>

        <section id="majors-section">
            <div class="container">
                <div class="title-section">
                    <h3><?= @$settingThemes['titlesmall'];?></h3>
                    <h2><?= @$settingThemes['titlelarge'];?></h2>
                    <p><?= @$settingThemes['contenttitle4'];?></p>
                </div>
                <div class="majors">
                    <div class="majors-img">
                        <img src="<?= @$settingThemes['imageactionbeetween'];?>" alt="">
                    </div>

                    <div class="majors-list">
                        <?php if (!empty($listDatafield[5])): ?>
                            <a href="/detailfield/<?php echo  $listDatafield[5]->slug ?>.html">
                                <div class="majors-items majors-items-left majors-items-1">
                                    <p>
                                        <?= $listDatafield[5]->name;?>
                                    </p>
                                    <img class="fade-img" src="<?= $listDatafield[5]->icon;?>" alt="">
                                </div>
                            </a>
                        <?php endif; ?>
                        <?php if (!empty($listDatafield[4])): ?>
                            <a href="/detailfield/<?php echo  $listDatafield[4]->slug ?>.html">
                                <div class="majors-items majors-items-left majors-items-2">
                                    <p>
                                        <?= $listDatafield[4]->name;?>
                                    </p>
                                    <img class="fade-img" src="<?= $listDatafield[4]->icon;?>" alt="">
                                </div>
                            </a>
                        <?php endif; ?>
                        <?php if (!empty($listDatafield[0])): ?>
                            <a href="/detailfield/<?php echo  $listDatafield[0]->slug ?>.html">
                                <div class="majors-items majors-items-left majors-items-3">
                                    <p>
                                        <?= $listDatafield[0]->name;?>
                                    </p>
                                    <img class="fade-img" src="<?= $listDatafield[0]->icon;?>" alt="">
                                </div>
                            </a>
                        <?php endif; ?>
                        <?php if (!empty($listDatafield[2])): ?>
                            <a href="/detailfield/<?php echo  $listDatafield[2]->slug ?>.html">
                                <div class="majors-items majors-items-right majors-items-4">
                                    <p>
                                        <?= $listDatafield[2]->name;?>
                                    </p>
                                    <img class="fade-img" src="<?= $listDatafield[2]->icon;?>" alt="">
                                </div>
                            </a>
                        <?php endif; ?>
                        <?php if (!empty($listDatafield[1])): ?>
                        <a href="/detailfield/<?php echo  $listDatafield[1]->slug ?>.html">
                                <div class="majors-items majors-items-right majors-items-5">
                                    <p>
                                        <?= $listDatafield[1]->name;?>
                                    </p>
                                    <img class="fade-img" src="<?= $listDatafield[1]->icon;?>" alt="">
                                </div>
                        </a>
                        <?php endif; ?>
                        <?php if (!empty($listDatafield[3])): ?>
                        <a href="/detailfield/<?php echo  $listDatafield[3]->slug ?>.html">
                                <div class="majors-items majors-items-right majors-items-6">
                                    <p>
                                        <?= $listDatafield[3]->name;?>
                                    </p>
                                    <img class="fade-img" src="<?= $listDatafield[3]->icon;?>" alt="">
                                </div>
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>

        <section id="about-section-3">
            <div class="container">
                <div class="as3-block-1">
                    <h3><?= @$setting['titlelarge'];?></h3>
                    <p><?= @$setting['contentshort2'];?></p>
                </div>
                <div class="as3-block-2">
                    <div class="as3-block-2-item as3-block-2-item-1">
                        <div class="as3-block-2-img">
                            <img src="<?= @$setting['imagehome1'];?>" alt="">
                        </div>
                        <div class="as3-block-2-sub">
                            <strong><?= @$setting['titleimagehome1'];?></strong>
                        </div>
                    </div>
                    <div class="as3-block-2-item as3-block-2-item-2">
                        <div class="as3-block-2-img">
                            <img src="<?= @$setting['imagehome2'];?>" alt="">
                        </div>
                        <div class="as3-block-2-sub">
                            <strong><?= @$setting['titleimagehome2'];?></strong>
                        </div>
                    </div>
                    <div class="as3-block-2-item as3-block-2-item-3">
                        <div class="as3-block-2-img">
                            <img src="<?= @$setting['imagehome3'];?>" alt="">
                        </div>
                        <div class="as3-block-2-sub">
                            <strong><?= @$setting['titleimagehome3'];?></strong>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="about-section-4">
            <div class="container">

                <div class="as4-block-2">
                    <h3><?= @$setting['titleidside1'];?></h3>
                </div>
                <div class="as4-block-1">
                <?php if(!empty($slide_about1)){
                                        foreach($slide_about1 as $item){ ?>
                    <div class="as4-swiper-slide">
                        <div class="as4-swiper-img">
                            <img src="<?= $item->image?>" alt="">
                        </div>
                        <div class="as4-swiper-info">
                            <h4><?= $item->title?></h4>
                            <p><?= $item->description?></p>
                        </div>
                    </div>
                <?php }} ?>
                  

                </div>

            </div>

            </div>
        </section>

        <section id="about-section-4">
            <div class="container">

                <div class="as4-block-2">
                    <h3><?= @$setting['titleidside2'];?></h3>
                </div>

                <div class="as4-block-1">
                <?php if(!empty($slide_about2)){
                                        foreach($slide_about2 as $item){ ?>
                    <div class="as4-swiper-slide">
                        <div class="as4-swiper-img">
                            <img src="<?= $item->image?>" alt="">
                        </div>
                        <div class="as4-swiper-info">
                            <h4><?= $item->title?></h4>
                            <p><?= $item->description?></p>
                        </div>
                    </div>
                <?php }} ?>
                    <!-- <div class="as4-swiper-slide">
                        <div class="as4-swiper-img">
                            <img src="<?= $urlThemeActive?>asset/images/123.jpg" alt="">
                        </div>
                        <div class="as4-swiper-info">
                            <h4>Lê Thị Thủy </h4>
                            <p>Managing Partner of Lawlink Vietnam</p>
                        </div>
                    </div> -->

                </div>

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