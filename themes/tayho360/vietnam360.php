<?php
getHeader();
?>

<main>
    <section id="page-banner-img">
        <div class="banner-img">
            <img src="<?= $urlThemeActive ?>img/hinh-anh-ho-tay.jpg" alt="">
        </div>
    </section>
    <section class="section-background-index">
        <div class="container-fluid background-index">
            <img src="<?= $urlThemeActive ?>img/background-index.jpg" alt="">
        </div>
    </section>

    <section id="title-categorty-360">
        <div class="category-title">
            <h1>Việt Nam 360</h1>
        </div>
    </section>

    <section id="section-img-360">
        <div class="container-img-360 container">
            <div class="row">
                <?php foreach ($listData as $data) : ?>
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12 item-img-360">
                        <div class="img-360">
                            <a href="<?= $data->image360 ?>"><img src="<?= $data->image ?>" alt=""></a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section id="pagination-page">
        <?php if ($totalPage == 1) : ?>
            <div id="pagination-page">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link disabled" href="?page=<?= $back ?>"><i class="fa-solid fa-chevron-left"></i></a>
                        </li>
                        <li class="page-item"><a class="page-link active" href="?page=<?= $page ?>"><?= $page ?></a></li>
                        <li class="page-item"><a class="page-link disabled" href="?page=<?= $next ?>"><i class="fa-solid fa-chevron-right"></i></a>
                        </li>
                    </ul>
                </nav>
            </div>
        <?php else : ?>
            <div id="pagination-page">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link" href="?page=<?= $back ?>"><i class="fa-solid fa-chevron-left"></i></a>
                        </li>
                        <?php if ($page != 1) : ?>
                            <li class="page-item "><a class="page-link" href="?page=<?= $back ?>"><?= $back ?></a></li>
                        <?php else : ?>
                            <li class="page-item"><a class="page-link active" href="?page=<?= $page ?>"><?= $page ?></a></li>
                            <li class="page-item"><a class="page-link" href="?page=<?= $next ?>"><?= $next ?></a></li>
                            <li class="page-item"><a class="page-link" href="?page=<?= $next ?>"><i class="fa-solid fa-chevron-right"></i></a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </nav>
            </div>
        <?php endif; ?>
    </section>
</main>

<?php
getFooter();
