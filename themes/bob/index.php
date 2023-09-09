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
                    <div class="col-lg-6 col-md-6 col-12">
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
                                            <a href="'.$value->slug.'">
                                                <img src="'.$value->image.'" alt="">
                                            </a>
                                        </div>
                                        <div class="category-product-info">
                                            <div class="category-product-info-title">
                                                <a href="'.$value->slug.'">'.$value->name.'</a>
                                            </div>
                                            <div class="category-product-info-description">
                                                <p>'.$value->description.'</p>
                                            </div>
                                            <div class="category-product-info-button">
                                                <a href="category/'.$value->slug.'.html">Xem tất cả</a>
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
                                if(!empty($listProductProjects)){
                                    foreach($listProductProjects as $key => $value){
                                        echo'
                                        <div class="col-lg-4 col-md-4 col-12 product-item">
                                            <div class="product-inner">
                                                <div class="product-overlay"></div>
                                                <div class="product-img">
                                                    <a href="'.$value->slug.'">
                                                        <img src="'.$value->image.'" alt="">
                                                    </a>
                                                </div>
                
                                                <div class="product-info">
                                                    <div class="product-info-category">
                                                        <span>'.$value->infoKind->name.'| '.$value->city.'</span>
                                                    </div>
                
                                                    <div class="product-info-title">
                                                        <a href="'.$value->slug.'">'.$value->name.'</a>
                                                    </div>
                
                                                    <div class="product-info-code">
                                                        <span>Mã sản phẩm ';
                                                        if(!empty($value->infoProduct)){
                                                            // $mang = explode(",", $chuoi);
                                                            foreach($value->infoProduct as $itemProduct){
                                                                echo'
                                                                <span class="code">'.$itemProduct->code.'</span>';
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
                                }
                            ?>

                        </div> 
                    </div>
                </div>
            </div>
        </section>

        <!-- Đăng dự án miễn phí -->
        <section style="background-image: url(<?php echo $urlThemeActive; ?>/asset/img/image-laptop.jpg);" id="section-home-contact">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 col-md-5 col-12 home-contact-left">
                        <div class="title-home-contact">
                            <p><?php echo @$settingThemes['title_section3'];?></p>
                        </div>

                        <div class="sub-home-contact">
                            <span><?php echo @$settingThemes['titlesub_section3']; ?></span>
                        </div>

                        <div class="button-home-contact">
                            <a href="">Đăng dự án miễn phí</a>
                        </div>
                    </div>
    
                    <div class="col-lg-7 col-md-7 col-12 home-contact-right">
                        <div class="home-contact-right-img">
                            <img src="<?php echo @$settingThemes['image_section3']; ?>" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

<?php getFooter();?>
