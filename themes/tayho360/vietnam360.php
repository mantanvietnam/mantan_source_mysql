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
                <?php foreach ($listData as $data) { ?>
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12 item-img-360">
                        <div class="img-360">
                            <a href="<?= $data->image360 ?>"><img src="<?= $data->image ?>" alt=""></a>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>

    <section id="pagination-page">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">

                            <?php
                            if (@$totalPage > 0) {
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

                                echo '<li class="page-item first">
                        <a class="page-link" href="' . $urlPage . '1"
                          ><i class="tf-icon bx bx-chevrons-left"></i
                        ></a>
                      </li>';

                                for ($i = $startPage; $i <= $endPage; $i++) {
                                    $active = ($page == $i) ? 'active' : '';

                                    echo '<li class="page-item ' . $active . '">
                            <a class="page-link" href="' . $urlPage . $i . '">' . $i . '</a>
                          </li>';
                                }

                                echo '<li class="page-item last">
                        <a class="page-link" href="' . $urlPage . $totalPage . '"
                          ><i class="tf-icon bx bx-chevrons-right"></i
                        ></a>
                      </li>';
                            }
                            ?>
                        </ul>
                    </nav>
                </section>
</main>

<?php
getFooter();
