<?php
getHeader();
global $urlThemeActive;
?>
<main class="">
    <section id="su-kien-banner">
         <?php
                if (!empty($listDataEvent)) {
                    foreach ($listDataEvent as $items) { ?>
        <div class="backgound-slider-contain">
            <div class="su-kien-slider">
               
                        <div class="">
                            <img src="<?php echo $items->image ?>" class="w-100" alt="">
                        </div>
               

            </div>
            <div class="banner-content-overlay p-4">
                <div class="content p-3">
                    <h1> <?php echo @$items->name ?></h1>
                    <p>
                       <?php echo @$items->introductory ?>
                    </p>
                    <a href="/chi_tiet_su_kien/<?php echo @$items->urlSlug ?>.html" class="btn button-outline-primary-custom">Xem thêm</a>
                </div>
            </div>
        </div>
         <?php }
                } ?>
    </section>

    <section id="news-banner" style="background-image: url('<?= $urlThemeActive ?>/assets/lou_img/backgroundmaichau.jpg')">
        <div class="news-overlay"></div>
        <div class="news-banner-content">
            <div class="news-title">
                <h1>Tin tức - Sự kiện</h1>
            </div>
            <div class="news-search">
                <div class="news-search-input">
                    <form>
                        <input type="text" name="name" value="<?php echo @$_GET['name'] ?>" placeholder="Tìm kiếm tin tức và sự kiện">
                    <div class="news-search-btn">
                        <button type="submit">
                             <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                           
                        </a>
                    </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </section>


    <section id="su-kien-list-event">
        <!-- <div class="background" style="background-image: url('<?= $urlThemeActive ?>/assets/lou_img/su-kien-list-event.png')"> -->
            <section class="section-heading section-heading-event">
                <h3 class="text-uppercase text-center" >Tin tức và sự kiện</h3>
                <p class="text-center" style="margin-top: 10px">Những Tin tức - Sự kiện Văn hoá, Du lịch huyện Cẩm Giàng</p>
            </section>
            <div class="container">
                <div class="row g-3">
                    <?php
                    if (!empty($listData)) {
                        foreach ($listData as $item) { ?>
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="card card-event">
                                    <a href="/chi_tiet_su_kien/<?php echo $item->urlSlug ?>.html">
                                        <img class="card-img-top" src="<?php echo $item->image ?>" alt="Card image cap">
                                    </a>
                                    <div class="card-body">
                                        <h5  class="card-title mb-3">
                                            <a href="/chi_tiet_su_kien/<?php echo $item->urlSlug ?>.html"><?php echo $item->name ?></a>
                                        </h5>
                                        <p class="card-time">
                                            <?php echo date("d/m/Y", @$item->datestart) . ' - ' . date("d/m/Y", @$item->dateend); ?>
                                        </p>
                                        <a href="/chi_tiet_su_kien/<?php echo $item->urlSlug ?>.html" class="btn button-outline-primary-custom btn-seemmore">Xem thêm</a>
                                    </div>
                                </div>
                            </div>
                    <?php }
                    } ?>
                </div>

                <section id="pagination-page">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                      <?php
            if(@$totalPage>0){
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
                        <a class="page-link" href="'.$urlPage.'1"
                          ><i class="fa-solid fa-chevron-left"></i
                        ></a>
                      </li>';
                
                for ($i = $startPage; $i <= $endPage; $i++) {
                    $active= ($page==$i)?'active':'';

                    echo '<li class="page-item '.$active.'">
                            <a class="page-link" href="'.$urlPage.$i.'">'.$i.'</a>
                          </li>';
                }

                echo '<li class="page-item last">
                        <a class="page-link" href="'.$urlPage.$totalPage.'"
                          ><i class="fa-solid fa-chevron-right"></i
                        ></a>
                      </li>';
            }
          ?>
                </ul>
            </nav>
        </section>
            </div>
        </div>
    </section>
</main>

<?php
getFooter(); ?>