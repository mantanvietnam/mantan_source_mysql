<?php
getHeader();
global $urlThemeActive;
?>

    <main>
        <section id="page-banner-img">
            <div class="banner-img">
                <img src="<?= $urlThemeActive ?>images/asdf.png" alt="">
            </div>
        </section>

        <section id="section-background-index">
            <form action="" method="GET">
                <div class="container-fluid background-index">
                    <img src="<?= $urlThemeActive ?>images/background-index.jpg" alt="">
                </div>

                <!-- Bộ lọc -->
                <div class="container container-box-filter-search">
                    

                    <div class="box-search">
                        <div class="input-search">
                            <label for="search-place" class="col-form-label"><i
                                    class="fa-solid fa-magnifying-glass"></i></label>
                                <input type="text" name="name" id="search-place" value="<?php echo @$_GET['name']; ?>" placeholder="Tìm kiếm">
                                <button class="mt-3 btn button-submit-custom" style="display: none;" >Lưu</button>
                        </div>
                    </div>
                </div>
            </form>
        </section>

        <section id="place-category">
            <div class="category-title">
                <h1>DANH MỤC DI TÍCH</h1>
                <p>Hãy khám phá những điểm đến di tích lịch sử ở Cẩm Giàng</p>
            </div>

            <div class="container">
                <div class="row place-category-box">
                    <?php if(!empty(@$listData)){
                        foreach($listData as $item){ ?>
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12 place-category-item">
                        <div class="place-category-item-img">
                        <a href="/chi_tiet_di_tich_lich_su/<?php echo $item->urlSlug ?>.html">
                                <div class="background-opacity">
                                </div>
                            </a>
                            <a href="/chi_tiet_di_tich_lich_su/<?php echo $item->urlSlug ?>.html"><img src="<?php echo $item->image ?>" alt=""></a>
                            <div class="place-category-item-title">
                                <a href="/chi_tiet_di_tich_lich_su/<?php echo $item->urlSlug ?>.html"><?php echo $item->name ?></a>
                            </div>
                        </div>
                    </div>
                <?php }} ?>
                   

                </div>
            </div>
        </section>

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

    </main>
<?php
getFooter();?>