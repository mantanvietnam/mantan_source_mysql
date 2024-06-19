<?php 
    getheader();
    global $settingThemes;
?>
<main>
        <section class="section-albums-parent">
            <div class="container">
                <div class="header-title-albums">
                    <h1>Album Ảnh</h1>
                </div>
          
            </div>
        </section>    
        <section class="section-card-albums">
            <div class="container">
                <div class="row set-padding-top">
                <?php foreach ($listAlbums as $key => $value) { ?> 
                    <div class="col-md-6 col-lg-4 col-lg-4 col-12 card-albums-all-information">
                        <div class="image-albums-card">
                            <a href="/<?= $value->slug?>.html"><img src="<?php echo $value->image; ?>" alt=""></a>
                        </div>
                        <div class="information-card-albums">
                            <div class="main-information-card-albums">
                                <h3 class="date-content-slide-albums">Post on -<span><?php echo date('d/m/Y', $value->time_create);?></span></h3>
                                <a class="h2-title-above-slide" href="/<?= $value->slug?>.html"><?php echo $value->title; ?></a>
                                <p class="paragrap-titleabove-slide"><?php echo $value->description; ?></p>
                            </div>
                        </div>
                    </div>
                    <?php } ?>

                </div>
                <div class="pagination">
                    <nav aria-label="Page navigation">
                    <?php
                    if ($totalPage > 0) {
                        if ($page > 5) {
                            $startPage = $page - 5;
                        } else {
                            $startPage = 1;
                        }

                        if ($totalPage > $page + 5) {
                            $endPage = $page + 5;
                        } else {
                            $endPage = $totalPage;
                        }
                    ?>
                        <ul class="pagination">
                            <li class="page-item">
                                <a class="page-link" href="<?php echo $urlPage; ?>1" aria-label="Previous">
                                    <span aria-hidden="true">«</span>
                                </a>
                            </li>
                        <?php for ($i = $startPage; $i <= $endPage; $i++): ?>
                            <li class="page-item <?php echo ($page == $i) ? 'active' : ''; ?>"><a class="page-link" href="<?php echo $urlPage . $i; ?>"><?php echo $i; ?></a></li>
                        <?php endfor; ?>
                            <li class="page-item">
                                <a class="page-link" href="<?php echo $urlPage . $totalPage; ?>" aria-label="Next">
                                    <span aria-hidden="true">»</span>
                                </a>
                            </li>
                        </ul>
                    <?php
                    }
                    ?>
                    </nav>
                </div>
            </div>

        </section>

</main>
<?php 
    getFooter();
?>
