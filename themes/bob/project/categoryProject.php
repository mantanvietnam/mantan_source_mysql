<?php 
    global $settingThemes;
    global $modelAlbums;
    debug($listData);
    debug($listKind);

?>

<?php getHeader();?>

<main>
    <section id="banner-project" class="">
        <div class="banner-du-an max-h-70vh h-100 max-h-80vh maxheight-810 overflow-hiden">
            <img src="../asset/img/banner-project.png" alt="">
            <div class="absolute bottom-0 w-100 linear-background--banner-duan" >
                <div class="container">
                    <div class="title-banner-du-an font-Hotel-Colline">
                        <h1 class="font-Hotel-Colline text-uppcase">Đồng Hành Tạo Không Gian Hoàn Mĩ</h1>
                        <p>Cùng Yên Lâm khám phá những kiến trúc đã sử dụng sản phẩm của chúng tôi.</p>
                        <div class="button-dang-ki">
                            <a href="" class="pd-16-20 ds-in-block text-button-dang-ki">Đăng kí án miễn phí</a>
                        </div>
                    </div>                    
                </div>
            </div>
            <div class="absolute center-text right-6rem setting-text-banner-rotate">
                    <div class="opaciti-80 text-stroke banner-text-responsive">YEN LAM</div>
            </div>

        </div>

    </section>
    <section >
        <div class="navbar-project bg-gray-50">
            <div class="contaier-fluid">
                    <div class="container">
                        <ul class="nav nav-tabs mg-bottom-55 " id="myTab" role="tablist">
                            <?php 
                                if(!empty($listKind)){
                                    foreach($listKind as $key => $value){
                                        if($key == 0){
                                            $active = 'active';
                                        } 
                                        else{
                                            $active = '';
                                        }
                                        echo'
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link '.$active.'" id="'.$value->id.'-tab" data-bs-toggle="tab" data-bs-target="#kind'.$value->id.'" type="button" role="tab" aria-controls="'.$value->name.'" aria-selected="false">'.$value->name.'<span></span><span></span><span></span><span></span></button>
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
                            if(!empty($listKind)){
                                foreach($listKind as $key => $value){
                                    if($key == 0){
                                        $active = 'active';
                                    } 
                                    else{
                                        $active = '';
                                    }
                                    echo'
                                    <div class="tab-pane '.$active.'" id="kind'.$value->id.'" role="tabpanel" aria-labelledby="'.$value->name.'-tab">
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

                    <nav aria-label="Page navigation example" class="mg-top-64">
                        <ul class="pagination justify-center gap-10">
                            <li class="page-item">
                            <a class="page-link" href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                            <a class="page-link" href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                            </li>
                        </ul>
                    </nav>
                    
                    <script>
                
                    </script>
            </div>                
        </div>
    </section>
</main>

<?php getFooter();?>