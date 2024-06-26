<?php 
    global $settingThemes;
    getHeader();
?>

<main>
    <?php 
        if(!empty($slide_home)){
            echo '<section id="section-slide-home" class="mgb-80">
                    <div class="home-background">';
                    foreach ($slide_home as $key => $value) {
                        echo '<div class="home-background-img">
                                <a href="'.$value->link.'"><img src="'.$value->image.'" alt=""></a>
                            </div>';
                    }
            echo    '</div>
                </section>';
        }
    ?>
    
    <!-- Khối lý do chọn -->
    <section id="section-reason" class="mgb-80">  
        <div class="container content-reason">
            <div class="section-title">
                <h2><?php echo @$settingThemes['title_why_choose'];?></h2>
            </div>
            <div class="reason-content">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-3 item-reason-content">
                        <div class="reason-content-img">
                            <img src="<?php echo @$settingThemes['image1_why_choose'];?>" alt="">
                        </div>

                        <div class="reason-content-title">
                            <h3><?php echo @$settingThemes['title1_why_choose'];?></h3>
                        </div>

                        <div class="reason-content-sub">
                            <p><?php echo @$settingThemes['content1_why_choose'];?></p>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-3 item-reason-content">
                        <div class="reason-content-img">
                            <img src="<?php echo @$settingThemes['image2_why_choose'];?>" alt="">
                        </div>

                        <div class="reason-content-title">
                            <h3><?php echo @$settingThemes['title2_why_choose'];?></h3>
                        </div>

                        <div class="reason-content-sub">
                            <p><?php echo @$settingThemes['content2_why_choose'];?></p>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-3 item-reason-content">
                        <div class="reason-content-img">
                            <img src="<?php echo @$settingThemes['image3_why_choose'];?>" alt="">
                        </div>

                        <div class="reason-content-title">
                            <h3><?php echo @$settingThemes['title3_why_choose'];?></h3>
                        </div>

                        <div class="reason-content-sub">
                            <p><?php echo @$settingThemes['content3_why_choose'];?></p>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-3 item-reason-content">
                        <div class="reason-content-img">
                            <img src="<?php echo @$settingThemes['image4_why_choose'];?>" alt="">
                        </div>

                        <div class="reason-content-title">
                            <h3><?php echo @$settingThemes['title4_why_choose'];?></h3>
                        </div>

                        <div class="reason-content-sub">
                            <p><?php echo @$settingThemes['content4_why_choose'];?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Khối sản phẩm tiêu biểu -->
    <section id="section-element" class="mgb-80">
        <div class="container">
            <div class="section-title">
                <h2><?php echo @$settingThemes['title_product_best'];?></h2>
            </div>
            <div class="element-content">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-4 info-element info-element-left">
                        <div class="info-element-item">
                            <div class="element-title">
                                <h4><?php echo @$settingThemes['title1_product_best'];?></h4>
                                <p><?php echo @$settingThemes['content1_product_best'];?></p>
                            </div>

                            <div class="element-image">
                                <img src="<?php echo @$settingThemes['image1_product_best'];?>" alt="">
                            </div>
                        </div>

                        <div class="info-element-item">
                            <div class="element-title">
                                <h4><?php echo @$settingThemes['title3_product_best'];?></h4>
                                <p><?php echo @$settingThemes['content3_product_best'];?></p>
                            </div>

                            <div class="element-image">
                                <img src="<?php echo @$settingThemes['image3_product_best'];?>" alt="">
                            </div>
                        </div>

                        <div class="info-element-item">
                            <div class="element-title">
                                <h4><?php echo @$settingThemes['title5_product_best'];?></h4>
                                <p><?php echo @$settingThemes['content5_product_best'];?></p>
                            </div>

                            <div class="element-image">
                                <img src="<?php echo @$settingThemes['image5_product_best'];?>" alt="">
                            </div>
                        </div>

                        <div class="info-element-item">
                            <div class="element-title">
                                <h4><?php echo @$settingThemes['title7_product_best'];?></h4>
                                <p><?php echo @$settingThemes['content7_product_best'];?></p>
                            </div>

                            <div class="element-image">
                                <img src="<?php echo @$settingThemes['image7_product_best'];?>" alt="">
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-12 col-lg-4 info-element info-element-center">
                        <img src="<?php echo @$settingThemes['image_product_best'];?>" alt="">
                    </div>

                    <div class="col-12 col-md-12 col-lg-4 info-element info-element-right">
                        <div class="info-element-item">
                            <div class="element-title">
                                <h4><?php echo @$settingThemes['title2_product_best'];?></h4>
                                <p><?php echo @$settingThemes['content2_product_best'];?></p>
                            </div>

                            <div class="element-image">
                                <img src="<?php echo @$settingThemes['image2_product_best'];?>" alt="">
                            </div>
                        </div>

                        <div class="info-element-item">
                            <div class="element-title">
                                <h4><?php echo @$settingThemes['title4_product_best'];?></h4>
                                <p><?php echo @$settingThemes['content4_product_best'];?></p>
                            </div>

                            <div class="element-image">
                                <img src="<?php echo @$settingThemes['image4_product_best'];?>" alt="">
                            </div>
                        </div>

                        <div class="info-element-item">
                            <div class="element-title">
                                <h4><?php echo @$settingThemes['title6_product_best'];?></h4>
                                <p><?php echo @$settingThemes['content6_product_best'];?></p>
                            </div>

                            <div class="element-image">
                                <img src="<?php echo @$settingThemes['image6_product_best'];?>" alt="">
                            </div>
                        </div>

                        <div class="info-element-item">
                            <div class="element-title">
                                <h4><?php echo @$settingThemes['title8_product_best'];?></h4>
                                <p><?php echo @$settingThemes['content8_product_best'];?></p>
                            </div>

                            <div class="element-image">
                                <img src="<?php echo @$settingThemes['image8_product_best'];?>" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Khối tin khuyến mại -->
    <section id="section-home-intro" class="mgb-80">
        <div class="container">
            <div class="section-title">
                <h2><?php echo @$settingThemes['title_news_hot'];?></h2>
            </div>
            <div class="row home-intro-left">
                <div class="col-12 col-md-6 col-lg-6 home-intro-img">
                    <a href="<?php echo @$settingThemes['link1_news_hot'];?>">
                        <img src="<?php echo @$settingThemes['image1_news_hot'];?>" alt="">
                    </a>
                </div>
                
                <div class="col-12 col-md-6 col-lg-6 home-intro-content">
                    <div class="home-intro-title">
                        <h3><?php echo @$settingThemes['title1_news_hot'];?></h3>
                    </div>
                    <div class="home-intro-sub">
                        <p><?php echo @$settingThemes['content1_news_hot'];?></p>
                    </div>
                    <div class="home-intro-view">
                        <a href="<?php echo @$settingThemes['link1_news_hot'];?>">Xem ngay</a>
                    </div>
                </div>
            </div>

            <div class="row home-intro-right">
                <div class="col-12 col-md-6 col-lg-6 home-intro-content">
                    <div class="home-intro-title">
                        <h3><?php echo @$settingThemes['title2_news_hot'];?></h3>
                    </div>
                    <div class="home-intro-sub">
                        <p><?php echo @$settingThemes['content2_news_hot'];?></p>
                    </div>
                    <div class="home-intro-view">
                        <a href="<?php echo @$settingThemes['link2_news_hot'];?>">Xem ngay</a>
                    </div>
                </div>
                
                <div class="col-12 col-md-6 col-lg-6 home-intro-img">
                    <a href="<?php echo @$settingThemes['link2_news_hot'];?>">
                        <img src="<?php echo @$settingThemes['image2_news_hot'];?>" alt="">
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Sản phẩm -->
    <section id="section-product-tab" class="mgb-80">
        <div class="container">  
            <div class="section-title">
                <h2>SẢN PHẨM MỚI</h2>
            </div>
            <!--
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                  <button class="nav-link active" id="pill-drink-one-tab" data-bs-toggle="pill" data-bs-target="#pill-drink-one" type="button" role="tab" aria-controls="pill-drink-one" aria-selected="true">Nước tăng lực</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="pill-drink-two-tab" data-bs-toggle="pill" data-bs-target="#pill-drink-two" type="button" role="tab" aria-controls="pill-drink-two" aria-selected="false">Nước ngọt, có ga</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="pill-drink-three-tab" data-bs-toggle="pill" data-bs-target="#pill-drink-three" type="button" role="tab" aria-controls="pill-drink-three" aria-selected="false">Nước bù khoáng</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pill-drink-four-tab" data-bs-toggle="pill" data-bs-target="#pill-drink-four" type="button" role="tab" aria-controls="pill-drink-four" aria-selected="false">Nước trái cây, nước trà</button>
                </li>
            </ul>
            -->
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pill-drink-one" role="tabpanel" aria-labelledby="pill-drink-one-tab" tabindex="0">
                    <div class="row">
                        <?php 
                        if(!empty($new_product)){
                            foreach ($new_product as $product) {
                                $link = '/product/'.$product->slug.'.html';

                                $giam = 0;
                                if(!empty($product->price_old) && !empty($product->price)){
                                    $giam = 100 - 100*$product->price/$product->price_old;
                                }

                                if($giam>0){
                                    $giam = '
                                                <div class="item-sale">
                                                    <span><i class="fa-solid fa-bolt"></i> -'.round($giam).'%</span>
                                                </div>';
                                }else{
                                    $giam = '';
                                }

                                if(!empty($product->price)){
                                    $price = number_format($product->price).'đ';
                                }else{
                                    $price = 'Giá liên hệ';
                                }

                                if(!empty($product->price_old)){
                                    $price_old = number_format($product->price_old).'đ';
                                }else{
                                    $price_old = '';
                                }

                                echo '<div class="col-lg-4 col-md-6 col-6 product-featured-item product-list-item">
                                        <div class="product-featured-inner">
                                            <div class="product-featured-img">
                                                <a href="'.$link.'"><img src="'.$product->image.'" alt=""></a>
                                                '.$giam.'
                                            </div>
                    
                                            <div class="product-featured-details">
                                                <div class="product-featured-title">
                                                    <a href="'.$link.'">'.$product->title.'</a>
                                                </div>
                                                <div class="product-featured-price">
                                                    <span class="price">'.$price.'</span>
                                                    <span class="price-del">'.$price_old.'</span>
                                                </div> 
                                                <div class="product-button-action">
                                                    <div class="product-button-cart">
                                                        <a onclick="addProductToCart('.$product->id.')" href="javascript:void(0);" class="button-cart">
                                                            <i class="fa-solid fa-cart-shopping"></i><span>Thêm vào giỏ</span>    
                                                        </a>
                                                    </div>
                                                </div>
                                            </div> 
                                        </div>
                                    </div>';
                            }
                        }
                        ?>
                    </div>
                </div>

                <!--
                <div class="tab-pane fade" id="pill-drink-two" role="tabpanel" aria-labelledby="pill-drink-two-tab" tabindex="0">.1.</div>
                <div class="tab-pane fade" id="pill-drink-three" role="tabpanel" aria-labelledby="pill-drink-three-tab" tabindex="0">.2..</div>
                <div class="tab-pane fade" id="pill-drink-four" role="tabpanel" aria-labelledby="pill-drink-four-tab" tabindex="0">.2..</div>
                -->
            </div>
        </div>
    </section>
    
    <!-- Khối tiêu chí làm việc -->
    <section id="section-detailPack" class="mgb-80" >
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-6 home-detailPack-img">
                    <img src="<?php echo @$settingThemes['image_working'];?>" alt="">
                </div>

                <div class="col-12 col-md-6 col-lg-6 home-detailPack-content">
                    <div class="section-title">
                        <h2><?php echo @$settingThemes['title_working'];?></h2>
                    </div>

                    <div class="home-detailPack-content-item">
                        <div class="detailPack-img">
                            <img src="<?php echo @$settingThemes['image1_working'];?>" alt="">
                        </div>

                        <div class="detailPack-content">
                            <div class="detailPack-content-title">
                                <h4><?php echo @$settingThemes['title1_working'];?></h4>
                            </div>

                            <div class="detailPack-content-sub">
                                <p><?php echo @$settingThemes['content1_working'];?></p>
                            </div>
                        </div>
                    </div>

                    <div class="home-detailPack-content-item">
                        <div class="detailPack-img">
                            <img src="<?php echo @$settingThemes['image2_working'];?>" alt="">
                        </div>

                        <div class="detailPack-content">
                            <div class="detailPack-content-title">
                                <h4><?php echo @$settingThemes['title2_working'];?></h4>
                            </div>

                            <div class="detailPack-content-sub">
                                <p><?php echo @$settingThemes['content2_working'];?></p>
                            </div>
                        </div>
                    </div>

                    <div class="home-detailPack-content-item">
                        <div class="detailPack-img">
                            <img src="<?php echo @$settingThemes['image3_working'];?>" alt="">
                        </div>

                        <div class="detailPack-content">
                            <div class="detailPack-content-title">
                                <h4><?php echo @$settingThemes['title3_working'];?></h4>
                            </div>

                            <div class="detailPack-content-sub">
                                <p><?php echo @$settingThemes['content3_working'];?></p>
                            </div>
                        </div>
                    </div>

                    <div class="home-detailPack-content-item">
                        <div class="detailPack-img">
                            <img src="<?php echo @$settingThemes['image4_working'];?>" alt="">
                        </div>

                        <div class="detailPack-content">
                            <div class="detailPack-content-title">
                                <h4><?php echo @$settingThemes['title4_working'];?></h4>
                            </div>

                            <div class="detailPack-content-sub">
                                <p><?php echo @$settingThemes['content4_working'];?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- sản phẩm chính hãng -->
    <section id="section-product-featured" class="mgb-80">
        <div class="container">
            <div class="section-title">
                <h2>SẢN PHẨM NỔI BẬT</h2>
            </div>

            <div class="product-featured-slide">
                <?php 
                if(!empty($hot_product)){
                    foreach ($hot_product as $product) {
                        $link = '/product/'.$product->slug.'.html';

                        $giam = 0;
                        if(!empty($product->price_old) && !empty($product->price)){
                            $giam = 100 - 100*$product->price/$product->price_old;
                        }

                        if($giam>0){
                            $giam = '
                                        <div class="item-sale">
                                            <span><i class="fa-solid fa-bolt"></i> -'.round($giam).'%</span>
                                        </div>';
                        }else{
                            $giam = '';
                        }

                        if(!empty($product->price)){
                            $price = number_format($product->price).'đ';
                        }else{
                            $price = 'Giá liên hệ';
                        }

                        if(!empty($product->price_old)){
                            $price_old = number_format($product->price_old).'đ';
                        }else{
                            $price_old = '';
                        }

                        echo '<div class="product-featured-item">
                                <div class="product-featured-inner">
                                    <div class="product-featured-img">
                                        <a href="'.$link.'"><img src="'.$product->image.'" alt=""></a>
                                        '.$giam.'
                                    </div>

                                    <div class="product-featured-details">
                                        <div class="product-featured-title">
                                            <a href="'.$link.'">'.$product->title.'</a>
                                        </div>
                                        <div class="product-featured-price">
                                            <span class="price">'.$price.'</span>
                                            <span class="price-del">'.$price_old.'</span>
                                        </div> 
                                        <div class="product-button-action">
                                            <div class="product-button-cart">
                                                <a href="'.$link.'" class="button-cart">
                                                    <i class="fa-solid fa-cart-shopping"></i><span>Thêm vào giỏ</span>    
                                                </a>
                                            </div>
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

    <!-- Bài viết mới nhất -->
    <section id="section-news-post" class="mgb-80">
        <div class="container">
            <div class="section-title">
                <h2><a href="">Bài viết mới nhất</a></h2>
            </div>

            <div class="slide-home-news" class="mgb-80">
                <?php 
                if(!empty($news)){
                    foreach ($news as $key => $value) {
                        $link = '/'.$value->slug.'.html';

                        echo '<div class="home-news-item">
                                <div class="news-item-img">
                                    <a href="'.$link.'"><img src="'.$value->image.'" alt=""></a>
                                </div>

                                <div class="news-item-details">
                                    <div class="news-item-title">
                                        <h3><a href="'.$link.'">'.$value->title.'</a></h3>
                                    </div>

                                    <div class="news-item-sub">
                                       <p>'.$value->description.'</p>
                                    </div>

                                    <div class="news-item-meta">
                                        <div class="news-item-date">
                                            <p>'.date('d/m/Y', $value->time).'</p>
                                        </div>
                                        <a href="'.$link.'">Xem thêm</a>
                                    </div>
                                </div>
                            </div>';
                    }
                }
                ?>
            </div>
        </div>
    </section>

    <!-- Gửi thư thông báo -->
    <section id="section-newsletter">
        <div class="container">
            <div class="section-title">
                <h2>ĐĂNG KÝ NHẬN THÔNG BÁO MỚI NHẤT</h2>
                <p>Để cập nhật những sản phẩm mới, nhận thông tin ưu đãi đặc biệt và thông tin giảm giá khác</p>
            </div>
            <form action="/addSubscribe" method="post">
                <input type="hidden" name="_csrfToken" value="<?php echo $csrfToken;?>">
                <div class="form-group">
                    <span class="icon-email"><i class="fa-regular fa-envelope"></i></span>
                    <input type="email" placeholder="Nhập email của bạn" value="" name="email" required>
                    <span class="newsletter-box">
                        <button type="submit" class="newsletter-button">
                            Đăng ký
                        </button>
                    </span>
                </div>
            </form>
        </div>
    </section>
</main>

<?php getFooter();?>