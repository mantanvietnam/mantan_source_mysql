<?php getHeader();?>
<main>
        <section id="about-section-1">
            <div class="as1-block-1">
                <div class="as1-banner">
                    <div class="as1-block-1">
                        <img src="<?= @$setting['bannervolunteers'];?>" alt="">
                    </div>
                    <div class="as1-block-2">
                        <div class="as1-block-2-title">
                            <h1><?= @$setting['titlevolunteers'];?></h1>
                            <p>
                                <?= @$setting['contenvolunteer'];?>
                            </p>
                        </div>
                        <div class="as1-block-2-btn">
                            <a href="#vlt-section-1"><i class="fa-solid fa-users"></i> <?= @$setting['namebuttonvolunteer'];?></a>
                        </div>
                    </div>

                </div>
            </div>
        </section>


        <section id="vlt-section-1" style="padding-bottom: 80px;">
            <div class="container">
                <div class="as4-block-2">
                    <h3><?= @$setting['titleslidevolunteers'];?></h3>
                </div>

                <div class="ts-block-1">
                <?php if(!empty($slide_volunteers)){
                                        foreach($slide_volunteers as $item){ ?>
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