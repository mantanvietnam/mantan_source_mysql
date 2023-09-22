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
                        <!-- <h1 class="font-Hotel-Colline text-uppcase">Đồng Hành Tạo Không Gian Hoàn Mĩ</h1>
                        <p>Cùng Yên Lâm khám phá những kiến trúc đã sử dụng sản phẩm của chúng tôi.</p> -->
                        <div class="button-dang-ki">
                            <a href="http://bobdecor.com.vn/contact" class="pd-16-20 ds-in-block text-button-dang-ki">Đăng kí án miễn phí</a>
                        </div>
                    </div>                    
                </div>
            </div>
            <!-- <div class="absolute center-text right-6rem setting-text-banner-rotate">
                    <div class="opaciti-80 text-stroke banner-text-responsive">YEN LAM</div>
            </div> -->

        </div>

    </section>
    <section >
        <div class="navbar-project bg-gray-50">
            <div class="contaier-fluid">
                    <div class="container">
                        <ul class="nav nav-tabs mg-bottom-55 " id="myTab" role="tablist">
                            <?php 
                                echo'
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="all-tab" data-bs-toggle="tab" data-bs-target="#all" type="button" role="tab" aria-controls="all" aria-selected="false">Tất cả<span></span><span></span><span></span><span></span></button>
                                </li>';

                                if(!empty($listKind)){
                                    foreach($listKind as $key => $value){
                                        echo'
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="'.$value->id.'-tab" data-bs-toggle="tab" data-bs-target="#kind'.$value->id.'" type="button" role="tab" aria-controls="'.$value->name.'" aria-selected="false">'.$value->name.'<span></span><span></span><span></span><span></span></button>
                                        </li>';
                                    }
                                }
                            ?>

                        </ul>                            
                    </div>
            </div>

            <div class="container">                      
                    <div class="tab-content list-product" id="nav-tab-project">
                        <?php
                       
                    //  Tất cả
                            echo'
                            <div class="tab-pane active" id="all" role="tabpanel" aria-labelledby="all-tab">
                                <div class="grid grid-col-3 gap-32">';
                                if(!empty($listData)){
                                    foreach($listData as $keyProject => $valueProject){
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
                                                        <span>'.$valueProject->infoKind->name.'</span>
                                                        <span>| '.$valueProject->city.'</span>
                                                    </div>
                
                                                    <div class="product-info-title">
                                                        <a href="'.$link.'">'.$valueProject->name.'</a>
                                                    </div>
                
                                                    <div class="product-info-code">
                                                        <span>Mã sản phẩm: ';
                                                        foreach($valueProject->infoProduct as $item){
                                                            echo '<span class="code">'.$item->code.' </span>';
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
                        
                          

                            if(!empty($listKind)){
                                foreach($listKind as $key => $value){
                                    echo'
                                    <div class="tab-pane" id="kind'.$value->id.'" role="tabpanel" aria-labelledby="'.$value->name.'-tab">
                                        <div class="grid grid-col-3 gap-32">';
                                        if(!empty($listData)){
                                            foreach($listData as $keyProject => $valueProject){
                                                if($valueProject->infoKind->name == $value->name){
                                                echo'
                                                    <div class="project-item">
                                                        <div class="product-inner">
                                                            <div class="product-overlay"></div>
                                                            <div class="product-img">
                                                                <a href="">
                                                                    <img src="'.$valueProject->image.'" alt="">
                                                                </a>
                                                            </div>
                            
                                                            <div class="product-info">
                                                                <div class="product-info-category">
                                                                    <span>'.$valueProject->infoKind->name.'</span>
                                                                    <span>| Hồ Chí Minh</span>
                                                                </div>
                            
                                                                <div class="product-info-title">
                                                                    <a href="">'.$valueProject->name.'</a>
                                                                </div>
                            
                                                                <div class="product-info-code">
                                                                    <span>Mã sản phẩm: ';
                                                                    foreach($valueProject->infoProduct as $item){
                                                                        echo '<span class="code">'.@$item->code.' </span>';
                                                                    }
                                                                    echo'
                                                                    </span>
                                                                </div>
                            
                                                                <a class="product-info-button" href="">Xem chi tiết</a>
                                                            </div>
                                                        </div>
                                                    </div>';
                                                }
                                            }
                                        }
                                        echo'
                                        </div>
                                    </div>';
                                }
                            }
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
                    
                    <script>
                
                    </script>
            </div>                
        </div>
    </section>
</main>

<?php getFooter();?>