
<?php 
    getheader();
    global $settingThemes;

?>
    <main>
        <section id="banner-news-section">
            <div class="bn-block-1">
                <div class="bn-block-1-img">
                    <img src="<?= @$settingThemes['imagebannernews'];?>" alt="">
                </div>
                <div class="bn-block-1-title">
                    <div class="word-1 word">
                        <span>v</span>
                        <span>i</span>
                        <span>d</span>
                        <span>e</span>
                        <span>o</span>
                    </div>
                    <!-- <div class="word-2 word">
                        <span>p</span>
                        <span>h</span>
                        <span>ẩ</span>
                        <span>m</span>
                    </div> -->
                </div>
            </div>
            <div class="bn-block-2">
                <div id="mouse-scroll">
                    <div class="mouse">
                        <div class="mouse-in"></div>
                    </div>
                    <div>
                        <span class="down-arrow-1"></span>
                        <span class="down-arrow-2"></span>
                        <span class="down-arrow-3"></span>
                    </div>
                </div>
            </div>

        </section>
        <section class="section-video">
            <div class="video-title">
                <h1>Danh Sách Video</h1>
            </div>
            <div class="container">
                <div class="row">
                <?php foreach ($listVideos as $key => $value) { ?>
                    <div class="col-md-6">
                        <div class="cover-card-video">
                            <div class="detail-video">
                                <iframe width="100%" height="315" src="https://www.youtube.com/embed/<?= $value->youtube_code?>?si=WFmfX5Gm_Fh_T2Gk" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                    referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                            </div>
                            <p><?php echo $value->title;?></p>
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
        </section>
    </main>
<?php 
    getFooter();
?>