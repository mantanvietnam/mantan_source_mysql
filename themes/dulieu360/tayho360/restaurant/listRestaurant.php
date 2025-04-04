<?php
getHeader();
global $urlThemeActive;
?>

    <main>
        <section id="page-banner-img">
            <div class="banner-img">
                <img src="<?= $urlThemeActive ?>img/hinh-anh-ho-tay.jpg" alt="">
            </div>
        </section>

        <section id="section-background-index">
            <form action="" method="GET">
                <input type="hidden" value="<?php echo $csrfToken;?>" name="_csrfToken">
            <div class="container-fluid background-index">
                <img src="<?= $urlThemeActive ?>img/background-index.jpg" alt="">
            </div>

            <!-- Bộ lọc -->
            <div class="container container-box-filter-search">
                <div class="filter-option-box">
                    <div class="filter-option-title">
                        <p>Danh mục</p>
                    </div>

                    <!-- <div class="filter-option">
                        <select class="form-select-filter">
                            <option selected>Di tích văn hoá, lịch sử</option>
                        
                        </select>
                    </div> -->
                     <?php include __DIR__.'/../select.php' ;?>
                </div>

                <div class="box-search">
                    <div class="input-search">
                        <label for="search-place" class="col-form-label"><i
                                class="fa-solid fa-magnifying-glass"></i></label>
                        <input type="text" name="name" id="search-place" placeholder="Tìm kiếm">
                    </div>
                </div>
            </div>
        </form>
        </section>

        <section id="place-category">
            <div class="category-title">
                <h1>NHÀ HÀNG</h1>
                <p>Hãy khám phá những điểm đến nhà hàng ở Tây Hồ</p>
            </div>

            <div class="container">
                <div class="row place-category-box">
                	<?php if(!empty(@$listData)){
                		foreach($listData as $item){ ?>
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12 place-category-item">
                        <div class="place-category-item-img">
                            <div class="background-opacity">
                            </div>
                            <a href="/chi_tiet_nha_hang/<?php echo $item->urlSlug ?>.html"><img src="<?php echo $item->image ?>" alt=""></a>
                            <div class="place-category-item-title">
                                <a href="/chi_tiet_nha_hang/<?php echo $item->urlSlug ?>.html"><?php echo $item->name ?></a>
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
                          ><i class="tf-icon bx bx-chevrons-left"></i
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
getFooter();?>