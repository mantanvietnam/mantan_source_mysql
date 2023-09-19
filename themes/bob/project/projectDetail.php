<?php 
    global $settingThemes;
    global $modelAlbums;
    // debug($project);
    // debug($listKind);
?>

<?php getHeader();?>

    <main>
        <section id="product" class="">
            <div class="banner-du-an max-h-70vh max-h-80vh maxheight-810 overflow-hiden">
                <img src="../asset/img/banner-du-an.jpg" alt="">
                <div class="absolute bottom-0 w-100 linear-background--banner-duan" >
                    <div class="container">
                        <div class="title-banner-du-an font-Hotel-Colline">
                            <h1 class="font-Hotel-Colline"><?php echo $project->name ?></h1>
                        </div>                    
                    </div>
                </div>
            </div>
        </section>
        <section id="intro-du-an" class="mg-top-88 mg-bottom-56">
            <div class="container">
                <div class="grid setting-intro-du-an grid-colum-3 gap-32">
                    <div class="intro-du-an">
                        <div class="name-du-an">
                            <h5 class="text-gray-600">Tên dự án</h5>
                            <p class="mg-top-8"><?php echo $project->name ?></p>
                        </div>
                        <div class="cong-ty-thiet-ke mg-top-24">
                            <h5 class="text-gray-600">Công ty thiết kế</h5>
                            <p class="mg-top-8"><?php echo $project->company_design ?></p>    
                        </div>
                        <div class="dia-diem mg-top-24">
                            <h5 class="text-gray-600">Địa điểm</h5>
                            <p class="mg-top-8"><?php echo $project->address ?></p>
                        </div>
                    </div>
                    <div class="intro-du-an">   
                        <div class="cong-thi-cong">
                            <h5 class="text-gray-600">Công ty thi công</h5>
                            <p class="mg-top-8"><?php echo $project->company_build ?></p>
                        </div>
                        <div class="nha-thiet-ke mg-top-24">
                            <h5 class="text-gray-600">Nhà thiết kế</h5>
                            <p class="mg-top-8"><?php echo $project->designer ?></p>    
                        </div>
                        <div class="noi-that mg-top-24">
                            <h5 class="text-gray-600">Loại</h5>
                            <p class="mg-top-8"><?php echo $project->company_build ?></p>
                        </div>                   
                    </div>
                    <div class="intro-du-an">
                        <div class="ma-san-pham">
                            <h5 class="text-gray-600">Mã sản phẩm</h5>
                            <?php 
                            foreach($project->infoProduct as $key => $value){
                                echo'
                                    <div class="hinh-anh-masp">
                                        <a href="" class="w-56 h-56 block img-du-an mg-top-24">
                                            <img src="'.$value->image.'" alt="">
                                        </a>
                                        <h5 class="text-gray-600 mg-top-8">'.$value->code.'</h5>
                                    </div>';   
                                } 
                            ?>
                        </div>
                    </div>
                </div>

                <div class="border-gap mg-topbottom-56 "></div>

                <div class="text-intro-du-an">
                    <p><?php echo $project->info ?></p>
                </div>
            </div>
        </section>
       
        <div class="swiper swiper-du-an-details">
            <div class="swiper-wrapper duration-500">
                <?php 
                foreach($project->images as $key => $value){
                    if(!empty($value)){
                    echo'
                    <div class="swiper-slide transition-0-3">
                        <div class="overflow-hidden setting-list-img aspect-h-2 aspect-w-3 ">
                            <img src="'.$value.'" alt="" class="">
                        </div>
                    </div>';
                    }
                }
                ?>
            </div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
    </main>

<?php getFooter();?>



