

<?php 
    getheader();

?>
<main>
<section id="news-details-section">
    <div class="container">
        <div class="news-title">
            <h1><?= $project['name'] ?></h1>
        </div>
        <div class="news-main">
            <div class="row">
                <div class="col-lg-7">
                    <div class="news-left-site">
                        <div class="news-date">
                            <p><a href="/">Trang chủ</a>/ <a href="">Dự án</a>/<?= $project['name'] ?></p>
                            <span><i class="fa-solid fa-calendar-days"></i> <?php echo date('d/m/Y', $project->time);?></span>
                        </div>
                        <div class="news-detail">
                            <h4>Large, threatened mammals such as great apes and forest elephants and other wildlife are better conserved in FSC-certified forests compared to non-certified.</h4>
                            <p><?= $project['info'] ?>
                            </p>
                        </div>
                    </div>

                </div>
<?php $listKind ?>
                <div class="col-lg-4">
                    <div class="news-right-site">
                    <?php if(!empty($listDataproduct_projects)){
                                        foreach($listDataproduct_projects as $item){ ?>
                        <div class="news-right-site-img">
                            <div class="right-site-img">
                                <a href="<?=$item->slug?>" >
                                    <img src="<?=$item->image?>" />
                                </a>
                            </div>
                            <div class="right-site-name-img">
                                <p>
                                <?=$item->name?><br>
                                    <span></span>
                                </p>
                            </div>
                        </div>
                    <?php }} ?>
                        <!-- <div class="news-right-site-img">
                            <div class="right-site-img">
                                <a href="../Asset/images/banner.jpg" data-fancybox="group" data-caption="Camera trap image of a chimpanzee, Gabon">
                                    <img src="../Asset/images/banner.jpg" />
                                </a>
                            </div>
                            <div class="right-site-name-img">
                                <p>
                                    Camera trap image of a chimpanzee, Gabon<br>
                                    <span>© Joeri Zwerts, University of Utrecht</span>
                                </p>
                            </div>
                        </div>

                        <div class="news-right-site-img">
                            <div class="right-site-img">
                                <a href="../Asset/images/avt.jpg" data-fancybox="group" data-caption="Elephant caught in a camera trap image as part of a study in the Congo Basin to study the impacts of FSC-certified forests on large mammals.">
                                    <img src="../Asset/images/avt.jpg" />
                                </a>
                            </div>
                            <div class="right-site-name-img">
                                <p>
                                    Elephant caught in a camera trap image as part of a study in the Congo Basin to study the impacts of FSC-certified forests on large mammals.<br>
                                    <span>© Joeri Zwerts, University of Utrecht</span>
                                </p>
                            </div>
                        </div> -->


                    </div>

                </div>
            </div>
        </div>
    </div>

</section>

</main>

<?php 
    getFooter();
?>