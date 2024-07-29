<?php 
    getheader();
    
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
                    <a href=""><i class="fa-solid fa-users"></i> GẶP GỠ ĐỘI NGŨ CECAD</a>
                </div>
            </div>
        </section>


    </main>
<?php 
    getFooter();
?>