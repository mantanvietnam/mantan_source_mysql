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
                    <h3><?=$modeltitlealbum1['title']?></h3>
                </div>
                <div class="tms-block-1">
                    <div class="row" style="justify-content: center;">
                    <?php foreach ($slide_dau as $key =>$value){?>
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <div class="tms-item" style="grid-template-columns: auto auto; display: grid;">
                                <div class="tms-img" style="aspect-ratio: 1 !important; width: 280px;">
                                    <img src="<?=$value->image?>" alt="">
                                </div>
                                <div class="tms-text" style="padding: 20px;">
                                    <div class="tms-name" style="margin-bottom: 20px;">
                                        <h4><strong><?= $value->title?></strong></h4>
                                        <p style="font-weight: 500; font-size: 18px;"><?=$value->link?></p>
                                    </div>
                                    <div class="tms-sub">
                                        <p><?=$value->description?></p>
                                    </div>
                                    <div class="tms-btn">
                                        <a style="display:inline-block ;" href="#" data-bs-toggle="modal" data-bs-target="#modalTmsSub<?= $key ?>">
                                            <i class="fa-solid fa-arrow-right-long"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal -->
                            <div class="modal fade" id="modalTmsSub<?= $key ?>" tabindex="-1" aria-labelledby="modalTmsSubLabel<?= $key ?>" aria-hidden="true">
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

            </div>
        </section>

        <section class="team-block-2" style="margin-bottom: 80px;">
            <div class="container">
                <div class="as4-block-2">
                    <h3><?=$modeltitlealbum2['title']?></h3>
                </div>
                <div class="tms-block-1">
                    <div class="row" style="justify-content: center;">
                    <?php foreach($slide_hai as $key => $value) {?>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="tms-item" style="padding: 16px; display:grid;">
                                <div class="tms-img" style="height: 220px; margin-bottom: 20px;">
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
                                        <a style="display:inline-block ;" href="#" data-bs-toggle="modal" data-bs-target="#tts-block-1<?=$key?>">
                                            <i class="fa-solid fa-arrow-right-long"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal -->
                            <div class="modal fade" id="tts-block-1<?=$key?>" tabindex="-1" aria-labelledby="modalTmsSubLabel<?=$key?>" aria-hidden="true">
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

            </div>
        </section>


        <section class="team-block-2" style="margin-bottom: 80px;">
            <div class="container">
                <div class="as4-block-2">
                    <h3><?=$modeltitlealbum3['title']?></h3>
                </div>
                <div class="tms-block-1">
                    <div class="row" style="justify-content: center;">

                    <?php foreach($slide_ba as $key => $value) {?>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="tms-item d-grid" style="padding: 16px;">
                                <div class="tms-img" style="height: 220px; margin-bottom: 20px;">
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
                                        <a style="display:inline-block ;" href="#" data-bs-toggle="modal" data-bs-target="#tts-block-8<?=$key?>">
                                            <i class="fa-solid fa-arrow-right-long"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal -->
                            <div class="modal fade" id="tts-block-8<?=$key?>" tabindex="-1" aria-labelledby="modalTmsSubLabel<?=$key?>" aria-hidden="true">
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

        <section class="team-block-2" style="margin-bottom: 80px;">
            <div class="container">
                <div class="as4-block-2">
                    <h3><?=$modeltitlealbum4['title']?></h3>
                </div>
                <div class="tms-block-1">
                    <div class="row" style="justify-content: center;">

                    <?php foreach($slide_bon as $key => $value) {?>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="tms-item d-grid" style="padding: 16px;">
                                <div class="tms-img" style="height: 220px; margin-bottom: 20px;">
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
                                        <a style="display:inline-block ;" href="#" data-bs-toggle="modal" data-bs-target="#tts-block-3<?=$key?>">
                                            <i class="fa-solid fa-arrow-right-long"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal -->
                            <div class="modal fade" id="tts-block-3<?=$key?>" tabindex="-1" aria-labelledby="modalTmsSubLabel<?=$key?>" aria-hidden="true">
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

        <section class="team-block-2" style="margin-bottom: 80px;">
            <div class="container">
                <div class="as4-block-2">
                    <h3><?=$modeltitlealbum5['title']?></h3>
                </div>
                <div class="tms-block-1">
                    <div class="row" style="justify-content: center;">
                    <?php foreach($slide_nam as $key => $value) {?>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="tms-item d-grid" style="padding: 16px;">
                                <div class="tms-img" style="height: 220px; margin-bottom: 20px;">
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
                                        <a style="display:inline-block ;" href="#" data-bs-toggle="modal" data-bs-target="#tts-block-2<?=$key?>">
                                            <i class="fa-solid fa-arrow-right-long"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal -->
                            <div class="modal fade" id="tts-block-2<?=$key?>" tabindex="-1" aria-labelledby="modalTmsSubLabel<?=$key?>" aria-hidden="true">
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

        <section class="team-block-2" style="margin-bottom: 80px;">
            <div class="container">
                <div class="as4-block-2">
                    <h3><?=$modeltitlealbum5['title']?></h3>
                </div>
                <div class="tms-block-1">
                    <div class="row" style="justify-content: center;">
                    <?php foreach($slide_nam as $key => $value) {?>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="tms-item d-grid" style="padding: 16px;">
                                <div class="tms-img" style="height: 220px; margin-bottom: 20px;">
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
                                        <a style="display:inline-block ;" href="#" data-bs-toggle="modal" data-bs-target="#tts-block-2<?=$key?>">
                                            <i class="fa-solid fa-arrow-right-long"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal -->
                            <div class="modal fade" id="tts-block-2<?=$key?>" tabindex="-1" aria-labelledby="modalTmsSubLabel<?=$key?>" aria-hidden="true">
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