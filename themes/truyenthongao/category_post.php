<?php 
    getHeader();
    global $settingThemes;
?>


<main>
        <section id="news">
            <div class="container">
                <div class="news__wrapper">
                    <p class="news__title d-flex align-items-center justify-content-center"><?php echo $category->name;?></p>
                    <div class="news__carousel">
                        <div class="news__list">
                            <?php foreach ($listPosts as $key => $value) { ?>
                                <a href="<?php echo $value->slug;?>.html" style="text-decoration: none;">
                                    <div class="news__item">
                                        <div class="news__item-image">
                                            <img src="<?php echo $value->image;?>" alt="Tin tức 1">
                                        </div>
                                        <div class="news__item-content">
                                            <h3 class="news__item-title" style="color:#212529"><?php echo $value->title;?></h3>
                                            <p class="news__item-desc"><?php echo $value->description;?></p>
                                            <div class="news__item-footer d-flex justify-content-between align-items-center">
                                                <span class="news__item-date"><?php echo date('d/m/Y', $value->time);?></span>
                                                <button class="news__item-btn">
                                                    <i class="fa-solid fa-arrow-right fa-xl"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            <?php } ?>
                        </div>
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
            <div class="container">
               
            </div>
        </section>
    </main>
<?php getFooter();?>