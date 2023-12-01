<?php 
    global $settingThemes;
    global $modelAlbums;
?>

<?php getHeader();?>

<main>
    <section id="banner-project" class="">
        <div class="banner-du-an max-h-70vh h-100 max-h-80vh maxheight-810 overflow-hiden">
            <img src="<?php echo $urlThemeActive ;?>/asset/img/banner-library.png" alt="">
            <div class="absolute bottom-0 w-100 linear-background--banner-duan" >
                <div class="container">
                    <div class="title-banner-du-an font-Hotel-Colline">
                        <h1 class="font-Hotel-Colline text-uppcase"><?php echo $category->name;?></h1>
                        <!-- 
                        <p>Cùng Yên Lâm khám phá những kiến trúc đã sử dụng sản phẩm của chúng tôi.</p> -->
                        <div class="button-dang-ki">
                            <a href="/contact" class="pd-16-20 ds-in-block text-button-dang-ki">Đăng kí án miễn phí</a>
                        </div>
                    </div>                    
                </div>
            </div>

        </div>

    </section>
    <section >
        <div class="navbar-project bg-gray-50">
            <div class="container">                      
                <div class="tab-content list-product" id="nav-tab-project">
                    <?php
                        echo'
                        <div class="tab-pane active" id="all" role="tabpanel" aria-labelledby="all-tab">
                            <div class="grid grid-col-3 gap-32">';
                            if(!empty($list_project)){
                                foreach($list_project as $keyProject => $valueProject){
                                    $link = '/project/'.$valueProject->slug.'.html';
                                    echo'
                                    <div class="project-item">
                                        <div class="product-inner">
                                            <div class="product-overlay"></div>
                                            <div class="product-img">
                                                <a href="'.$link.'.html">
                                                    <img src="'.$valueProject->image.'" alt="">
                                                </a>
                                            </div>
            
                                            <div class="product-info">
                                                <div class="product-info-category">
                                                    <span>'.$category->name.'</span>
                                                    <span>| '.$valueProject->city.'</span>
                                                </div>
            
                                                <div class="product-info-title">
                                                    <a href="'.$link.'">'.$valueProject->name.'</a>
                                                </div>
            
                                                <div class="product-info-code">
                                                    <span>Mã sản phẩm: ';
                                                    foreach($valueProject->infoProduct as $item){
                                                        if(!empty($item)){
                                                            echo '<span class="code">'.$item->code.' </span>';
                                                        }
                                                    }
                                                    echo'
                                                    </span>
                                                </div>
            
                                                <a class="product-info-button" href="'.$link.'.html">Xem chi tiết</a>
                                            </div>
                                        </div>
                                    </div>';
                                }
                            }
                            echo'
                            </div>
                        </div>';
                    ?>
                </div>

                <nav aria-label="Page navigation" class="mg-top-64">
                    <ul class="pagination justify-center gap-10">
                      <?php
                        if($totalPage>0){
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
                                      ><i class="fa-solid fa-chevron-left"></i></a>
                                  </li>';
                            
                            for ($i = $startPage; $i <= $endPage; $i++) {
                                $active= ($page==$i)?'active':'';

                                echo '<li class="page-item '.$active.'">
                                        <a class="page-link" href="'.$urlPage.$i.'">'.$i.'</a>
                                      </li>';
                            }

                            echo '<li class="page-item last">
                                    <a class="page-link" href="'.$urlPage.$totalPage.'"
                                      ><i class="fa-solid fa-chevron-right"></i></a>
                                  </li>';
                        }
                      ?>
                    </ul>
                </nav>
            </div>                
        </div>
    </section>
</main>

<?php getFooter();?>