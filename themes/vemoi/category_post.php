<?php 
    getHeader();
    global $settingThemes;
?>


<main>

        <section id="all-news-section">
            <div class="container">
                <h2><?php echo $category->name;?></h2>
                <div class="all-news-list">
                    <div class="row">
                    <?php foreach ($listPosts as $key => $value) { ?>
                        <div class="col-lg-4 col-md-6">
                            <div class="all-news-item">
                                <a href="<?php echo @$value->slug ?>.html">
                                    <div class="all-news-img">
                                        <img src="<?php echo $value->image;?>" alt="">
                                    </div>
                                    <div class="all-news-content">
                                        <div class="home-news-thum">
                                            <p><?php echo $value->keyword;?></p>
                                            <span><?php echo date('d/m/Y', $value->time);?></span>
                                        </div>
                                        <div class="all-news-detail">
                                            <h3><?php echo $value->title;?></h3>
                                            <p><?php echo $value->description;?></p>
                                        </div>
                                        <div class="all-news-btn">
                                            <i class="fa-solid fa-arrow-right-long"></i>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    <?php } ?>
                    </div>
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
<?php getFooter();?>