<?php 
    getheader();
    global $settingThemes;
?>

<main>


        <!--
        <section id="latest-news-section">
            <div class="container">
                <h2>Latest</h2>
                <div class="latest-news-list">
                    <div class="latest-news-item">
                        <a href="">
                            <div class="latest-news-img">
                                <img src="../Asset/images/news-1.jpg" alt="">
                            </div>
                            <div class="latest-news-content">
                                <div class="latest-news-date">
                                    <p>Posted on <span> 17 Apr 2024</span></p>
                                </div>
                                <div class="latest-news-detail">
                                    <h3>Central banks must unlock investment in nature</h3>
                                    <p>The world needs a nature-positive global economy that delivers lasting prosperity, says WWF’s finance lead Aaron Vermeulen.</p>
                                </div>
                                <div class="latest-news-btn">
                                    <i class="fa-solid fa-arrow-right-long"></i>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="latest-news-item">
                        <a href="">
                            <div class="latest-news-img">
                                <img src="../Asset/images/news-1.jpg" alt="">
                            </div>
                            <div class="latest-news-content">
                                <div class="latest-news-date">
                                    <p>Posted on <span> 17 Apr 2024</span></p>
                                </div>
                                <div class="latest-news-detail">
                                    <h3>Central banks must unlock investment in nature</h3>
                                    <p>The world needs a nature-positive global economy that delivers lasting prosperity, says WWF’s finance lead Aaron Vermeulen.</p>
                                </div>
                                <div class="latest-news-btn">
                                    <i class="fa-solid fa-arrow-right-long"></i>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="latest-news-item">
                        <a href="">
                            <div class="latest-news-img">
                                <img src="../Asset/images/news-1.jpg" alt="">
                            </div>
                            <div class="latest-news-content">
                                <div class="latest-news-date">
                                    <p>Posted on <span> 17 Apr 2024</span></p>
                                </div>
                                <div class="latest-news-detail">
                                    <h3>Central banks must unlock investment in nature</h3>
                                    <p>The world needs a nature-positive global economy that delivers lasting prosperity, says WWF’s finance lead Aaron Vermeulen.</p>
                                </div>
                                <div class="latest-news-btn">
                                    <i class="fa-solid fa-arrow-right-long"></i>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="latest-news-item">
                        <a href="">
                            <div class="latest-news-img">
                                <img src="../Asset/images/news-1.jpg" alt="">
                            </div>
                            <div class="latest-news-content">
                                <div class="latest-news-date">
                                    <p>Posted on <span> 17 Apr 2024</span></p>
                                </div>
                                <div class="latest-news-detail">
                                    <h3>Central banks must unlock investment in nature</h3>
                                    <p>The world needs a nature-positive global economy that delivers lasting prosperity, says WWF’s finance lead Aaron Vermeulen.</p>
                                </div>
                                <div class="latest-news-btn">
                                    <i class="fa-solid fa-arrow-right-long"></i>
                                </div>
                            </div>
                        </a>
                    </div>

                </div>
            </div>
        </section>
        -->

        <section id="all-news-section">
            <div class="container">
                <h2>Tất cả dự án</h2>

                <div class="all-news-list">
                    <div class="row">
                    <?php foreach ($listDataproject as $key => $value) { ?>
                        <div class="col-lg-4 col-md-6">
                            <div class="all-news-item">
                                <a href="/project/<?= $value->slug;?>">
                                    <div class="all-news-img">
                                        <img src="<?=$value->image?>" alt="">
                                    </div>
                                    <div class="all-news-content">
                                        <div class="home-news-thum">
                                            <p><?php echo $value->address; ?></p>
                                            <span><?php echo $value->year; ?></span>
                                        </div>
                                        <div class="all-news-detail">
                                            <h3><?php echo $value->name; ?></h3>
                                            <p><?php echo $value->donor; ?></p>
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

    <?php 
    getFooter();
?>