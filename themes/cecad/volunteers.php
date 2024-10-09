<?php getHeader();

?>
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
                            <a href="#vlt-section-9"><i class="fa-solid fa-users"></i> <?= @$setting['namebuttonvolunteer'];?></a>
                        </div>
                    </div>

                </div>
            </div>
        </section>


        <!-- <section id="vlt-section-1" style="padding-bottom: 80px;">
            <div class="container">
                <div class="as4-block-2">
                    <h3><?= $modeltitlealbum1['title'];?></h3>
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
        </section> -->
        <section id="vlt-section-9" class="team-block-2 mt-5" style="margin-bottom: 80px;">
            <div class="container">
                <div class="as4-block-2">
                    <h3><?=$modeltitlealbum1['title']?></h3>
                </div>
                <div class="tms-block-1">
                    <div class="row" style="justify-content: center;">
                    <?php foreach($slide_volunteers as $key => $value) {?>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="tms-item d-grid" style="padding: 16px;">
                                <div class="tms-img" style="height: 250px; margin-bottom: 20px;">
                                    <img src="<?=$value->image?>" alt="">
                                </div>
                                <div class="tms-text">
                                    <div class="tms-name" style="margin-bottom: 20px;">
                                        <h4><strong><?= $value->title?></strong></h4>
                                        <p style="font-weight: 500; font-size: 18px;"><?=$value->link?></p>
                                    </div>
                                    <div class="tms-sub">
                                        <p><?=$value->description?></p>
                                    </div>
                                    <div class="tms-btn">
                                        <a style="display:inline-block ;" href="#" data-bs-toggle="modal" data-bs-target="#tts-block-9<?=$key?>">
                                            <i class="fa-solid fa-arrow-right-long"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal -->
                            <div class="modal fade" id="tts-block-9<?=$key?>" tabindex="-1" aria-labelledby="modalTmsSubLabel<?=$key?>" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-body" style="line-height: 1.75;">
                                        <?=$value->description?>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php }?>

                    </div>
                </div>
            </div>
        </section>



    </main>
<?php 
    getFooter();
?>