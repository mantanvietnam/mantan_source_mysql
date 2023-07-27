<?php getHeader();global $settingThemes;?>
    <main>
        <section id="section-breadcrumb">
            <div class="container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                      <li class="breadcrumb-item"><a href="/category/<?php echo $category->slug;?>.html"><?php echo $category->name;?></a></li>
                      <li class="breadcrumb-item active" aria-current="page"><?php echo $product->title;?></li>
                    </ol>
                </nav>
            </div>
        </section>

        <section id="section-product-detail">
            
            <div class="product-detail-main">
               
                <div class="container container-white">
                    <div class="row">
                        <div class="zoomed-image"></div>
                        <div class="col-lg-5 col-md-12 col-12 product-gallery">
                            <div class="product-gallery-inner">
                                <div class="productDetail-main-slide">
                                    <?php 
                                    if(!empty($product->images)){
                                        foreach ($product->images as $images) {
                                            echo '<div class="productDetail-main-img">
                                                    <img src="'.$images.'" alt="">
                                                </div>';
                                        }
                                    }
                                    ?>
                                </div>
    
                                <div class="productDetail-sub-slide">
                                    <?php 
                                    if(!empty($product->images)){
                                        foreach ($product->images as $images) {
                                            echo '<div class="productDetail-sub-img">
                                                    <img src="'.$images.'" alt="">
                                                </div>';
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-7 col-md-12 col-12 product-info">
                            <div class="product-info-inner">
                                <div class="product-info-main">
                                    <div class="row">
                                        <div class="col-xl-7 col-lg-12 col-md-12 col-12 product-info-box">
                                            <div class="product-info-title">
                                                <h1><?php echo $product->title;?></h1>
                                            </div>

                                            <div class="product-info-sku">
                                                <span class="product-info-id">Mã sản phẩm: <strong><?php echo $product->code;?></strong></span>
                                                <span class="product-info-state">Tình trạng: <strong><?php echo ($product->quantity > 0)?'Còn hàng':'Hết hàng';?></strong></span>
                                                <span class="product-info-trademark">Nhà sản xuất: <strong><?php echo $manufacturer->name;?></strong></span>
                                            </div>

                                            <div class="product-info-detail">
                                                <div class="product-price">
                                                    <div class="product-price-number">
                                                        <span><?php echo ($product->price > 0)?number_format($product->price).'đ':'Liên hệ';?> </span><del><?php echo ($product->price_old > 0)?number_format($product->price_old).'đ':'';?></del>
                                                    </div>

                                                    <?php 
                                                    if(!empty($product->price) && !empty($product->price_old)){
                                                        $giam = 100 - 100*$product->price/$product->price_old;
                                                    
                                                        echo '  <div class="product-price-promotion">
                                                                    <div class="item-sale">
                                                                        <span>
                                                                            <i class="fa-solid fa-bolt"></i> -'.$giam.'%
                                                                        </span>
                                                                    </div>
                                                                </div>';
                                                    }
                                                    ?>
                                                    
                                                </div>

                                                <div class="product-info-number">
                                                    <div class="product-detail-title">
                                                        <span>Số lượng</span>
                                                    </div>
                                                    <button class="button-number-change" type="button">+</button>
                                                    <input class="value-number" type="text" value="1">
                                                    <button class="button-number-change" type="button">-</button>
                                                </div>

                                                <div class="product-info-active">
                                                    <div class="product-button-group">
                                                        <button type="button" onclick="addProductToCart(<?php echo $product->id;?>)" class="product-button-addcart">
                                                            <span>Thêm vào giỏ</span>
                                                        </button>

                                                        <button type="button" class="product-button-buynow">
                                                            <a href="tel:<?php echo $contactSite['phone'];?>" >
                                                                <span>Gọi Hotline</span>
                                                            </a>
                                                        </button>
                                                    </div>
                                                    <div class="product-button-single">
                                                        <a href="<?php echo @$settingThemes['facebook'];?>" class="button-single">Click vào đây để nhận ưu đãi</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        

                                        <div class="col-xl-5 col-lg-12 col-md-12 col-12 product-promotion">
                                            <?php
                                            if(!empty($other_product)){
                                                foreach ($other_product as $key => $value) {
                                                    if(!empty($product->price)){
                                                        $price = number_format($product->price).'đ';
                                                    }else{
                                                        $price = 'Giá liên hệ';
                                                    }

                                                    echo '<div class="promotion-item">
                                                            <div class="promotion-left">
                                                                <div class="promotion-img">
                                                                    <img src="'.$value->image.'" alt="">
                                                                </div>
                                                            </div>
                            
                                                            <div class="promotion-right">
                                                                <div class="promotion-top">
                                                                    <div class="promotion-info">
                                                                        <h3>'.$value->title.'</h3>
                                                                        <p>'.$price.'</p>
                                                                    </div>
                                                                </div>
                        
                                                                <div class="promotion-bottom">
                                                                    <div class="promotion-code">
                                                                        <p>Mã: <strong>'.$value->code.'</strong></p>
                                                                    </div>
                        
                                                                    <div class="promotion-copy">
                                                                        <button onclick="addProductToCart('.$value->id.')">Thêm giỏ hàng</button>
                                                                    </div>
                                                                   
                                                                </div>
                                                            </div>
                                                        </div>';
                                                }
                                            }
                                            ?>
                                            
                                        </div>
                                    </div>

                                    <div class="product-footer">

                                    </div>
                                </div>
                 
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </section>

        <section id="section-product-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-12 product-content-left">
                        <div class="product-info-tab">
                            <ul class="nav nav-pills" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                  <button class="nav-link active" id="pills-content1-tab" data-bs-toggle="pill" data-bs-target="#pills-content1" type="button" role="tab" aria-controls="pills-content1" aria-selected="true">Mô tả sản phẩm</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                  <button class="nav-link" id="pills-content2-tab" data-bs-toggle="pill" data-bs-target="#pills-content2" type="button" role="tab" aria-controls="pills-content2" aria-selected="false">Chính sách đổi trả</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                  <button class="nav-link" id="pills-content3-tab" data-bs-toggle="pill" data-bs-target="#pills-content3" type="button" role="tab" aria-controls="pills-content3" aria-selected="false">Điều khoản dịch vụ</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-content4-tab" data-bs-toggle="pill" data-bs-target="#pills-content4" type="button" role="tab" aria-controls="pills-content4" aria-selected="false">Điều khoản dịch vụ</button>
                                </li>
                            </ul>
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-content1" role="tabpanel" aria-labelledby="pills-content1-tab" tabindex="0">
                                    <div class="intro-content">
                                        Giải khát và bù năng lượng
                                        <br>
                                        Vị cafe thơm ngon
                                        <br>
                                        Thiết kế chai nhỏ tiện dụng
                                        <br>
                                        Sản xuất tại Việt Nam
                                        <br>
                                        Vinacafe là thương hiệu của Việt Nam
                                        <br>
                                        Dung tích 330ml
                                        <br>
                                        Thành phần và công dụng:
                                        <br>
                                        Sản phẩm có thành phần tự nhiên từ nước, đường, C02 thực phẩm, màu tổng hợp caramen, hương vani, hương cà phê, caffeine, taurine, inositol, vitamin B3, vitamin B6, chất điều chỉnh độ axit, muối, mùi vị thơm ngon, sảng khoái.
                                        <br>
                                        Nước tăng lực vị cà phê 247 Wake-up có thành phần nguyên liệu được lựa chọn kỹ lưỡng, không chứa hóa chất độc hại, an toàn cho người dùng.
                                        <br>
                                        Được sản xuất trên quy trình công nghệ hiện đại, được kiểm duyệt chặt chẽ đảm bảo chất lượng an toàn, không có đường hóa học, không chứa hóa chất độc hại, mang đến sự an tâm cho bạn.<br>Hướng dẫn sử dụng:
                                        <br>
                                        Uống trực tiếp, để lạnh uống ngon hơn.
                                        <br
                                        >Bảo quản:
                                        <br>
                                        Để nơi khô sạch, thoáng mát.
                                    </div>

                                    <div class="button-show">
                                        <button id="toggleButton">Xem thêm</button>
                                    </div>
                                </div>
                                
                                <div class="tab-pane fade" id="pills-content2" role="tabpanel" aria-labelledby="pills-content2-tab" tabindex="0">...</div>
                                <div class="tab-pane fade" id="pills-content3" role="tabpanel" aria-labelledby="pills-content3-tab" tabindex="0">...</div>
                                <div class="tab-pane fade" id="pills-content4" role="tabpanel" aria-labelledby="pills-content4-tab" tabindex="0">...</div>
                            </div>
                        </div>
    
                        <div id="section-product-featured" class="product-info-viewed">
                            <div class="productDetail-viewed">
                                <div class="productDetail-viewed-title">
                                    <h2>Sản phẩm đã xem</h2>
                                </div>
                                <div class="product-featured-slide product-viewed-slide">
                                    <div class="product-featured-item">
                                        <div class="product-featured-inner">
                                            <div class="product-featured-img">
                                                <a href=""><img src="../asset/img/prod-1-1_4163197fc0be49fc93e5487ec6ac9a44_large.jpg" alt=""></a>
                                                <img src="../asset/img/frame1_5f151d3f2bce42b99a356c60c1cf7864.jpg" alt="">
                                                <div class="item-sale">
                                                    <span><i class="fa-solid fa-bolt"></i> -12%</span>
                                                </div>
                                            </div>
                
                                            <div class="product-featured-details">
                                                <div class="product-featured-title">
                                                    <a href="">Drink De Energy Health & Strength</a>
                                                </div>
                                                <div class="product-featured-price">
                                                    <span class="price">35.000đ</span>
                                                    <span class="price-del">25.000đ</span>
                                                </div> 
                                                <div class="product-button-action">
                                                    <div class="product-button-cart">
                                                        <a href="" class="button-cart">
                                                            <i class="fa-solid fa-cart-shopping"></i><span>Thêm vào giỏ</span>    
                                                        </a>
                                                    </div>
                                                </div>
                                            </div> 
                                        </div>
                                    </div>
                
                                    <div class="product-featured-item">
                                        <div class="product-featured-inner">
                                            <div class="product-featured-img">
                                                <a href=""><img src="../asset/img/prod-1-1_4163197fc0be49fc93e5487ec6ac9a44_large.jpg" alt=""></a>
                                                <img src="../asset/img/frame1_5f151d3f2bce42b99a356c60c1cf7864.jpg" alt="">
                                                <div class="item-sale">
                                                    <span><i class="fa-solid fa-bolt"></i> -12%</span>
                                                </div>
                                            </div>
                
                                            <div class="product-featured-details">
                                                <div class="product-featured-title">
                                                    <a href="">Drink De Energy Health & Strength</a>
                                                </div>
                                                <div class="product-featured-price">
                                                    <span class="price">35.000đ</span>
                                                    <span class="price-del">25.000đ</span>
                                                </div> 
                                                <div class="product-button-action">
                                                    <div class="product-button-cart">
                                                        <a href="" class="button-cart">
                                                            <i class="fa-solid fa-cart-shopping"></i><span>Thêm vào giỏ</span>    
                                                        </a>
                                                    </div>
                                                </div>
                                            </div> 
                                        </div>
                                    </div>
                
                                    <div class="product-featured-item">
                                        <div class="product-featured-inner">
                                            <div class="product-featured-img">
                                                <a href=""><img src="../asset/img/prod-1-1_4163197fc0be49fc93e5487ec6ac9a44_large.jpg" alt=""></a>
                                                <img src="../asset/img/frame1_5f151d3f2bce42b99a356c60c1cf7864.jpg" alt="">
                                                <div class="item-sale">
                                                    <span><i class="fa-solid fa-bolt"></i> -12%</span>
                                                </div>
                                            </div>
                
                                            <div class="product-featured-details">
                                                <div class="product-featured-title">
                                                    <a href="">Drink De Energy Health & Strength</a>
                                                </div>
                                                <div class="product-featured-price">
                                                    <span class="price">35.000đ</span>
                                                    <span class="price-del">25.000đ</span>
                                                </div> 
                                                <div class="product-button-action">
                                                    <div class="product-button-cart">
                                                        <a href="" class="button-cart">
                                                            <i class="fa-solid fa-cart-shopping"></i><span>Thêm vào giỏ</span>    
                                                        </a>
                                                    </div>
                                                </div>
                                            </div> 
                                        </div>
                                    </div>
                
                                    <div class="product-featured-item">
                                        <div class="product-featured-inner">
                                            <div class="product-featured-img">
                                                <a href=""><img src="../asset/img/prod-1-1_4163197fc0be49fc93e5487ec6ac9a44_large.jpg" alt=""></a>
                                                <img src="../asset/img/frame1_5f151d3f2bce42b99a356c60c1cf7864.jpg" alt="">
                                                <div class="item-sale">
                                                    <span><i class="fa-solid fa-bolt"></i> -12%</span>
                                                </div>
                                            </div>
                
                                            <div class="product-featured-details">
                                                <div class="product-featured-title">
                                                    <a href="">Drink De Energy Health & Strength</a>
                                                </div>
                                                <div class="product-featured-price">
                                                    <span class="price">35.000đ</span>
                                                    <span class="price-del">25.000đ</span>
                                                </div> 
                                                <div class="product-button-action">
                                                    <div class="product-button-cart">
                                                        <a href="" class="button-cart">
                                                            <i class="fa-solid fa-cart-shopping"></i><span>Thêm vào giỏ</span>    
                                                        </a>
                                                    </div>
                                                </div>
                                            </div> 
                                        </div>
                                    </div>
                
                                    <div class="product-featured-item">
                                        <div class="product-featured-inner">
                                            <div class="product-featured-img">
                                                <a href=""><img src="../asset/img/prod-1-1_4163197fc0be49fc93e5487ec6ac9a44_large.jpg" alt=""></a>
                                                <img src="../asset/img/frame1_5f151d3f2bce42b99a356c60c1cf7864.jpg" alt="">
                                                <div class="item-sale">
                                                    <span><i class="fa-solid fa-bolt"></i> -12%</span>
                                                </div>
                                            </div>
                
                                            <div class="product-featured-details">
                                                <div class="product-featured-title">
                                                    <a href="">Drink De Energy Health & Strength</a>
                                                </div>
                                                <div class="product-featured-price">
                                                    <span class="price">35.000đ</span>
                                                    <span class="price-del">25.000đ</span>
                                                </div> 
                                                <div class="product-button-action">
                                                    <div class="product-button-cart">
                                                        <a href="" class="button-cart">
                                                            <i class="fa-solid fa-cart-shopping"></i><span>Thêm vào giỏ</span>    
                                                        </a>
                                                    </div>
                                                </div>
                                            </div> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           
        </section>
    </main>

<?php getFooter();?>