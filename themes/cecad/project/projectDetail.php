

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
                            <p><a href="/">Trang chủ</a>/ <a href="/">Dự án</a>/<?= $project['name'] ?></p>
                            <span><i class="fa-solid fa-calendar-days"></i> <?php echo date('d/m/Y', $project->time);?></span>
                        </div>
                        <div class="news-detail">
                            <h4>Large, threatened mammals such as great apes and forest elephants and other wildlife are better conserved in FSC-certified forests compared to non-certified.</h4>
                            <p><?= $project['info'] ?>
                            </p>
                        </div>
                    </div>

                </div>
                <div class="col-lg-4">
                    <div><h2 class="title-news-other">Tin tức khác</h2></div>
                    <div class="news-right-site">
                    <?php if(!empty($listDataproduct_projects)){
                        foreach($listDataproduct_projects as $item){ ?>
                        <div class="news-right-site-img">
                          <a href="<?php echo @$item->slug ?>.html">
                            <div class="right-site-img">
                                <img src="<?= $item->image?>" />
                            </div>
                            <div class="right-site-name-img">
                                <p>
                                <?= $item->name?><br>
                                </p>
                            </div>
                          </a>
                        </div>
                        <?php }} ?>
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