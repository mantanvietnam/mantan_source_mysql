<?php 
getHeader();
$settingThemes = setting();
?>
    <main>
        
        <section id="blog">
            <div id="section-product-detail">
                
                <div class="product-detail-main">
                   
                    <div class="container container-white">
                        <div class="row">
                            <div class="zoomed-image"></div>
                            <div class="col-lg-5 col-md-12 col-12 product-gallery">
                                <div class="product-gallery-inner">
                                    <div class="productDetail-main-slide">
                                        <?php 
                                        if(!empty($product->image)){
                                            echo '<div class="productDetail-main-img">
                                                                <img src="'.$product->image.'" alt="">
                                                            </div>';
                                        }

                                        if(!empty($product->images)){
                                            foreach ($product->images as $images) {
                                                if(!empty($images)){
                                                    echo '<div class="productDetail-main-img">
                                                                <img src="'.$images.'" alt="">
                                                            </div>';
                                                }
                                            }
                                        }
                                        ?>
                                    </div>
        
                                    <div class="productDetail-sub-slide">
                                        <?php 
                                        if(!empty($product->image)){
                                            echo '<div class="productDetail-sub-img">
                                                        <img src="'.$product->image.'" alt="">
                                                    </div>';
                                        }

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
                                                        <button class="button-number-change" type="button" onclick="plusQuantity();">+</button>
                                                        <input class="value-number" id="quantity_buy" type="text" value="1">
                                                        <button class="button-number-change" type="button" onclick="minusQuantity();">-</button>
                                                    </div>

                                                    <div class="product-info-active">
                                                        <div class="product-button-group">
                                                            <button type="button" onclick="addProductCart(<?php echo $product->id;?>)" class="product-button-addcart">
                                                                <span>Thêm vào giỏ</span>
                                                            </button>

                                                            <button type="button" class="product-button-buynow">
                                                                <a href="tel:<?php echo show_text_clone(@$settingThemes['phone']); ?>" >
                                                                    <span>Gọi Hotline</span>
                                                                </a>
                                                            </button>
                                                        </div>
                                                        <div class="product-button-single">
                                                            <a href="<?php echo show_text_clone(@$settingThemes['facebook']);?>" class="button-single">Click vào đây để nhận ưu đãi</a>
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
                            </ul>
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-content1" role="tabpanel" aria-labelledby="pills-content1-tab" tabindex="0">
                                    <div class="intro-content">
                                        <?php echo $product->info;?>
                                    </div>

                                    <div class="button-show">
                                        <button id="toggleButton">Xem thêm</button>
                                    </div>
                                </div>
                                
                                <div class="tab-pane fade" id="pills-content2" role="tabpanel" aria-labelledby="pills-content2-tab" tabindex="0">
                                    <div class="intro-content">
                                        <?php echo $product->rule;?>
                                    </div>

                                    <div class="button-show">
                                        <button id="toggleButton">Xem thêm</button>
                                    </div>
                                </div>
                            </div>
                        </div>
    
                        <div id="section-product-featured" class="product-info-viewed">
                            <div class="productDetail-viewed">
                                <div class="productDetail-viewed-title">
                                    <h2>Sản phẩm đã xem</h2>
                                </div>
                                <div class="product-featured-slide product-viewed-slide">
                                    <?php
                                    if(!empty($list_product_view)){
                                        foreach ($list_product_view as $key => $value) {
                                            $link = '/product/'.$value->slug.'.html';

                                            $giam = 0;
                                            if(!empty($value->price_old) && !empty($value->price)){
                                                $giam = 100 - 100*$value->price/$value->price_old;
                                            }

                                            if($giam>0){
                                                $giam = '<img src="'.$urlThemeActive.'/asset/img/frame1_5f151d3f2bce42b99a356c60c1cf7864.jpg" alt="">
                                                            <div class="item-sale">
                                                                <span><i class="fa-solid fa-bolt"></i> -'.$giam.'%</span>
                                                            </div>';
                                            }else{
                                                $giam = '';
                                            }

                                            if(!empty($value->price)){
                                                $price = number_format($value->price).'đ';
                                            }else{
                                                $price = 'Giá liên hệ';
                                            }

                                            if(!empty($value->price_old)){
                                                $price_old = number_format($value->price_old).'đ';
                                            }else{
                                                $price_old = '';
                                            }

                                            echo '<div class="product-featured-item">
                                                    <div class="product-featured-inner">
                                                        <div class="product-featured-img">
                                                            <a href="'.$link.'"><img src="'.$value->image.'" alt=""></a>
                                                            '.$giam.'
                                                        </div>
                            
                                                        <div class="product-featured-details">
                                                            <div class="product-featured-title">
                                                                <a href="'.$link.'">'.$value->title.'</a>
                                                            </div>
                                                            <div class="product-featured-price">
                                                                <span class="price">'.$price.'</span>
                                                                <span class="price-del">'.$price_old.'</span>
                                                            </div> 
                                                            <div class="product-button-action">
                                                                <div class="product-button-cart">
                                                                    <a onclick="addProductToCart('.$value->id.')" href="javascript:void(0);" class="button-cart">
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
                        </div>
                    </div>
                </div>
            </div>
           
        </section>
    </main>

<script type="text/javascript">
    function plusQuantity()
    {
        let quantity = parseInt($('#quantity_buy').val());
        quantity++;
        $('#quantity_buy').val(quantity);
    }

    function minusQuantity()
    {
        let quantity = parseInt($('#quantity_buy').val());
        quantity--;
        if(quantity<1) quantity=1;
        $('#quantity_buy').val(quantity);
    }

    function addProductCart(idProduct)
    {
        let quantity = parseInt($('#quantity_buy').val());

        $.ajax({
            method: "GET",
            url: "/addProductToCart/?id_product="+idProduct+"&quantity="+quantity
        })
        .done(function( msg ) {
            window.location = '/cart';
        });
    }
</script>
<?php getFooter();?>