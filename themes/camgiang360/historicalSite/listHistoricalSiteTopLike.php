<?php
getHeader();
global $urlThemeActive;
?>

    <main>

        <section id="place-category" class="mt-5">
            <div class="category-title">
                <h1>DI TÍCH TIÊU BIỂU</h1>
            </div>

            <div class="container">
                <div class="row place-category-box">
                    <?php if(!empty(@$listTop)){
                        foreach($listTop as $key=>$itemTop){ 
                            if($itemTop > 0){
                            $item = $listTopValue[$key];
                            ?>
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
                <?php }}} ?>
                   

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