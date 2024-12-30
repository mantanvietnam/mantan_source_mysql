<?php 
    global $settingThemes;
    global $modelAlbums;
?>

<?php getHeader();?>

    <main> 
        <?php
            if(!empty($slide_home)){
                echo'
                <section id="section-banner-home">
                    <div class="banner-home-slide">';
                    foreach($slide_home as $key => $value){
                        echo'
                        <div class="banner-slide-img">
                            <img src="'.$value->image.'" alt="">
                        </div>';
                    }

                    echo'
                    </div>
            </section>';
            };

        ?>
        <section id="section-home-introduce">
            <div class="container">
                <div class="row row-home-introduce">
                    <div class="col-lg-12 col-md-12 col-12">
                        <div class="home-inrtroduce-box">
                            <div class="title-main-section">
                                <h1><?php echo @$settingThemes['title_section1']; ?></h1>
                            </div>
                            <div class="title-sub-section">
                                <p><?php echo @$settingThemes['titlesub_section1'];?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="section-category-product">
            <div class="container">
                <div class="row">
                    <?php
                        if(!empty($new_category_product)){
                            foreach($new_category_product as $key => $value){
                                echo '
                                <div class="col-md-4 col-lg-4 col-12 category-product-item">
                                    <div class="category-product-box">
                                        <div class="category-product-overlay"></div>
                                        <div class="category-product-img">
                                            <a href="/category/'.$value->slug.'">
                                                <img src="'.$value->image.'" alt="">
                                            </a>
                                        </div>
                                        <div class="category-product-info">
                                            <div class="category-product-info-title">
                                                <a href="/category/'.$value->slug.'">'.$value->name.'</a>
                                            </div>
                                            <div class="category-product-info-description">
                                                <p>'.$value->description.'</p>
                                            </div>
                                            <div class="category-product-info-button">
                                                <a href="/category/'.$value->slug.'.html">Xem tất cả</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>';
                            }
                        }
                    ?>
                   
                </div>
            </div>
        </section>

        <?php if(!empty($listProductProjects)){ ?>
        <section id="section-product">
            <div class="container">
                <div class="title-box-section">
                    <div class="title-main-section">
                        <h1><?php echo @$settingThemes['title_section2'];?></h1>
                    </div>
                    <div class="title-sub-section">
                        <p><?php echo @$settingThemes['titlesub_section2'];?></p>
                    </div>
                </div>
                    <div class="list-product">
                        <div class="row">
                            <?php 
                                
                                    foreach($listProductProjects as $key => $value){
                                        echo'
                                        <div class="col-lg-4 col-md-4 col-12 product-item">
                                            <div class="product-inner">
                                            <a href="project/'.$value->slug.'.html"><div class="product-overlay"></div></a>
                                                <div class="product-img">
                                                    <a href="project/'.$value->slug.'.html">
                                                        <img src="'.$value->image.'" alt="">
                                                    </a>
                                                </div>
                
                                                <div class="product-info">
                                                    <div class="product-info-category">
                                                        <span>'.$value->infoKind->name.'| '.$value->city.'</span>
                                                    </div>
                
                                                    <div class="product-info-title">
                                                        <a href="project/'.$value->slug.'.html">'.$value->name.'</a>
                                                    </div>
                
                                                    <div class="product-info-code">
                                                        <span>Mã sản phẩm ';
                                                        
                                                        if(!empty($value->infoProduct)){
                                                            foreach($value->infoProduct as $itemProduct){
                                                                if(!empty($itemProduct)){
                                                                    echo'<span class="code">'.$itemProduct->code.', </span>';
                                                                }
                                                            }
                                                        }
                                                            
                                                            echo'
                                                        </span>
                                                    </div>
                
                                                    <a class="product-info-button" href="project/'.$value->slug.'.html">Xem chi tiết</a>
                                                </div>
                                            </div>
                                        </div>';
                                    }
                                
                            ?>

                        </div> 
                    </div>
                </div>
            </div>
        </section>
        <?php }?>

        <?php if(!empty($listProduct)){ ?>
        <section id="section-product">
            <div class="container">
                <div class="title-box-section">
                    <div class="title-main-section">
                        <h1><?php echo @$settingThemes['title_section4'];?></h1>
                    </div>
                    <div class="title-sub-section">
                        <p><?php echo @$settingThemes['titlesub_section4'];?></p>
                    </div>
                </div>
                    <div class="list-product">
                        <div class="row">
                            <div class="col-span-9 list-product-all mb-5">
                                <div class="list-san-pham">
                                    <?php
                                        foreach ($listProduct as $product) {
                                            $link = '/product/' . $product->slug . '.html';
                                            echo '
                                                    <div class="group-product">
                                                        <div class="img-product relative">
                                                            <img src="' . $product->image . '" alt="">
                                                            <div class="opacity-0 group-hover-opacity-50 bg-gray-800 duration-500 absolute h-full w-full top-0"></div>
                                                            <div class="click-product absolute group-hover-opacity-100 opacity-0 duration-500 w-100 top-0 setting-click ">
                                                                <a href="' . $link . '" class="duration-500 w-full text-white border border-white setting-button-click button-click-hover hover-border-gray-800 hover-text-gray-800 hover-bg-white">Xem chi tiết</a>
                                                                
                                                                <a onclick="addProductToCart(' . $product->id . ')" href="javascript:void(0);"  class="duration-500 w-full text-black setting-button-click border-black bg-white hover-border-white hover-text-white hover-bg-black">Thêm vào giỏ hàng</a>
                                                            </div>
                                                        </div>
                                                        <div class="content-product">
                                                            <p>' . $product->code . '</p>
                                                            <h5>' . $product->title . '</h5>
                                                        </div>
                                                    </div>';
                                        }
                                    ?>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
        </section>
        <?php }?>

        <!-- Đăng dự án miễn phí -->
        <section style="background-image: url(<?php echo $urlThemeActive; ?>/asset/img/image-laptop.jpg);" id="section-home-contact">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 col-md-5 col-12 home-contact-left">
                        <div class="title-home-contact">
                            <p><?php echo @$settingThemes['title_section3'];?></p>
                        </div>

                        <div class="sub-home-contact">
                            <span><?php echo nl2br(@$settingThemes['titlesub_section3']); ?></span>
                        </div>

                        <div class="button-home-contact">
                            <a href="/contact">Liên hệ tư vấn nội thất</a>
                        </div>
                    </div>
    
                    <div class="col-lg-5 col-md-7 col-12 home-contact-right">
                        <div class="home-contact-right-img">
                            <img src="<?php echo @$settingThemes['image_section3']; ?>" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

<?php getFooter();?>
