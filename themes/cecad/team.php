<?php getHeader();?>
<main>
        <section id="about-section-1">
            <div class="as1-block-1">
                <div class="as1-banner">
                    <div class="as1-block-1">
                        <img src="<?= @$setting['bannerteam'];?>" alt="">
                    </div>
                    <div class="as1-block-2">
                        <div class="as1-block-2-title">
                            <h1><?= @$setting['titleteam'];?></h1>
                            <p>
                            <?= @$setting['contenteam'];?>
                            </p>
                        </div>
                        <div class="as1-block-2-btn">
                            <a href="#team-section-2"><i class="fa-solid fa-users"></i><?= @$setting['namebuttonteam'];?></a>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <section id="team-section-2" class="team-block-1">
            <div class="container">

                <div class="as4-block-2">
                    <h3><?= $modeltitlealbum1['title'];?></h3>
                </div>

                <div class="as4-block-1">
                <?php if(!empty($slide_dau)){
                                        foreach($slide_dau as $item){ ?>
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

        <section id="about-section-4" style="background: transparent; padding-top: 0;">
            <div class="container">

                <div class="as4-block-2">
                    <h3><?= $modeltitlealbum2['title'];?></h3>
                </div>

                <div class="as4-block-1">
                <?php if(!empty($slide_hai)){
                                        foreach($slide_hai as $item){ ?>
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

        <section id="team-section-1" style="padding: 80px 0;">
            <div class="container">
                <div class="as4-block-2">
                    <h3><?= $modeltitlealbum3['title'];?></h3>
                </div>

                <div class="ts-block-1">
                <?php if(!empty($slide_ba)){
                                        foreach($slide_ba as $item){ ?>
                    <div class="ts-item">
                        <div class="ts-item-img">
                            <img src="<?= $item->image?>" alt="">
                        </div>
                        <div class="ts-item-text">
                            <h4><?= $item->title?></h4>
                            <p><?= $item->description?></p>
                        </div>
                    </div>
                <?php }} ?>
                   

                </div>
            </div>
        </section>




    </main>
<?php 
    getFooter();
?>