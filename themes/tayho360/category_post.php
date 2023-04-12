<?php
//Func helper
//End Func helper
getHeader();
if (!isset($category)) $category = [];
if (!isset($listPosts)) $listPosts = [];
$topPost = $listPosts[0];
?>
<main>
    <section id="su-kien-banner">
        <div class="backgound-slider-contain">
            <div class="su-kien-slider">
                <div class="">
                    <img src="<?= $topPost->image ?>" class="w-100" alt="">
                </div>
            </div>
            <div class="banner-content-overlay p-4">
                <div class="content p-3">
                    <h1 class="mb-2"><?= limit_words($topPost->title); ?></h1>
                    <p class="">
                        <?= limit_words($topPost->content, 15); ?>
                    </p>
                    <a href="/<?= $topPost->slug ?>.html" class="btn button-outline-primary-custom mt-3">Xem
                        thêm</a>
                </div>
            </div>
        </div>
    </section>
    <section id="su-kien-list-event">
        <div class="background-pt"
             style="background-image: url('<?= $urlThemeActive ?>assets/lou_img/su-kien-list-event.png')">
            <section class="section-heading mt-4">
                <h3 class="text-uppercase text-center mb-2"><?= $category->name ?></h3>
                <p class="text-center mb-5"><?= $category->description ?></p>
            </section>
            <div class="container">
                <div class="row gx-3 gy-5">
                    <?php
                    $index = 0;
                    foreach ($listPosts as $post) :
                        if (++$index >= 8) break;
                        if ($index == 1) continue;
                        ?>
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="card card-event">
                                <img class="card-img-top"
                                     src="<?= $post->image ?>"
                                     alt="<?= $post->title ?>">
                                <div class="card-body px-0">
                                    <h5 class="card-title mb-3">
                                        <?= limit_words($post->title, 15) ?>
                                    </h5>
                                    <p class="card-time mb-3">
                                        <?= distance_from_now($post->time) ?>
                                    </p>
                                    <a href="/<?= $post->slug ?>.html" class="btn button-outline-primary-custom">Xem
                                        thêm</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <?php if ($totalPage == 1): ?>
                    <div id="pagination-page">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <li class="page-item"><a class="page-link disabled" href="?page=<?= $back ?>"><i
                                            class="fa-solid fa-chevron-left"></i></a>
                                </li>
                                <li class="page-item"><a class="page-link active"
                                                         href="?page=<?= $page ?>"><?= $page ?></a></li>
                                <li class="page-item"><a class="page-link disabled" href="?page=<?= $next ?>"><i
                                            class="fa-solid fa-chevron-right"></i></a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                <?php else: ?>
                    <div id="pagination-page">
                    <nav aria-label="Page navigation example">
                    <ul class="pagination">
                    <li class="page-item"><a class="page-link" href="?page=<?= $back ?>"><i
                                class="fa-solid fa-chevron-left"></i></a>
                    </li>
                    <?php if ($page != 1) : ?>
                        <li class="page-item "><a class="page-link"
                                                  href="?page=<?= $back ?>"><?= $back ?></a></li>
                    <?php else: ?>
                        <li class="page-item"><a class="page-link active"
                                                 href="?page=<?= $page ?>"><?= $page ?></a></li>
                        <li class="page-item"><a class="page-link"
                                                 href="?page=<?= $next ?>"><?= $next ?></a></li>
                        <li class="page-item"><a class="page-link" href="?page=<?= $next ?>"><i
                                    class="fa-solid fa-chevron-right"></i></a>
                        </li>
                        </ul>
                        </nav>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>
</main>
<?php getFooter(); ?>
