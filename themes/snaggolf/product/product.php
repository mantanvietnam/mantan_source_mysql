<?php
    getHeader();
   global $settingThemes;
?>
 <main>
        <section class="section-product-detail">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 col-md-12 col-12 product-gallery">
                        <div class="product-gallery-inner">
                            <div class="productDetail-main-slide">
                                <?php foreach($product->images as $images ):?>
                                <div class="product-image-main">
                                    <img src="<?= $images?>" alt="">
                                </div>
                                <?php endforeach; ?>
                              
                            </div>
                            <div class="productDetail-sub-slide pt-3">
                            <?php foreach($product->images as $images ):?>
                                <div class="product-image-sub">
                                    <img src="<?= $images?>" alt="">
                                </div>
                            <?php endforeach; ?>
                            </div>     
                        </div>
                    </div>
                    <div class="col-lg-7 product-info">
                        <div class="product-info-inner">
                            <div class="product-info-main">
                                <div class="row">
                                    <div class="col-xl-7 col-lg-12 col-md-12 col-12 product-info-box">
                                        <div class="product-info-title">
                                            <h1><?= $product->title?></h1>
                                        </div>
                                        <div class="product-info-sku">
                                            <span class="product-info-id">Mã sản phẩm: <strong><?= $product->code?></strong></span>
                                            <span class="product-info-state">Tình trạng: <strong><?= ($product->quantity > 0)?'Còn hàng':'Hết hàng';?></strong></span>
                                            <span class="product-info-trademark">Nhà sản xuất: <strong><?= !empty($manufacturer) ? $manufacturer->name : ''; ?></strong></span>
                                        </div>
                                        <div class="product-info-detail">
                                            <div class="product-price">
                                                <div class="product-price-number">
                                                    <span><?php echo ($product->price > 0)?number_format($product->price).'đ':'Liên hệ';?>  </span><del><?php echo ($product->price_old > 0)?number_format($product->price_old).'đ':'';?></del>
                                                </div>

                                                <?php if (!empty($product->price) && !empty($product->price_old)):
                                                        $giam = 100 - 100 * $product->price / $product->price_old;?>
                                                        <div class="product-price-promotion">
                                                            <div class="item-sale">
                                                                <span>
                                                                    <i class="fa-solid fa-bolt"></i> -<?= $giam ?>%
                                                                </span>
                                                            </div>
                                                        </div>
                                                <?php endif;?>                                                  
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
                                                        <a href="tel:<?php echo $contactSite['phone'];?>">
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
                                    <?php if (!empty($other_product)): ?>
                                        <?php foreach ($other_product as $key => $value): ?>
                                            <?php 
                                            if (!empty($product->price)) {
                                                $price = number_format($product->price) . 'đ';
                                            } else {
                                                $price = 'Giá liên hệ';
                                            }
                                            ?>
                                            <div class="promotion-item">
                                                <div class="promotion-left">
                                                    <div class="promotion-img">
                                                        <a href="<?=$value->slug?>"><img src="<?= $value->image?>" alt=""></a>
                                                    </div>
                                                </div>
                                                <div class="promotion-right">
                                                    <div class="promotion-top">
                                                        <div class="promotion-info">
                                                            <h3><?= $value->title?></h3>
                                                            <p><?= $value->price?></p>
                                                        </div>
                                                    </div>
                                                    <div class="promotion-bottom">
                                                        <div class="promotion-code">
                                                            <p>Mã: <strong><?= $value->code?></strong></p>
                                                        </div>
                                                        <div class="promotion-copy">
                                                            <button onclick="addProductToCart(<?= $value->id?>)">Thêm giỏ hàng</button>
                                                        </div> 
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>

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
                                  <button class="nav-link" id="pills-content2-tab" data-bs-toggle="pill" data-bs-target="#pills-content2" type="button" role="tab" aria-controls="pills-content2" aria-selected="false" tabindex="-1">Chính sách đổi trả</button>
                                </li>
                            </ul>
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade active show" id="pills-content1" role="tabpanel" aria-labelledby="pills-content1-tab" tabindex="0">
                                    <div class="intro-content" style="max-height: 240px;">
                                        <p> <?php echo $product->rule;?></p>
                                    </div>

                                    <div class="button-show">
                                        <button id="toggleButton">Xem thêm</button>
                                    </div>
                                </div>
                                
                                <div class="tab-pane fade" id="pills-content2" role="tabpanel" aria-labelledby="pills-content2-tab" tabindex="0">
                                    <div class="intro-content" style="max-height: 240px;">
                                    </div>

                                    <div class="button-show">
                                        <button id="toggleButton">Xem thêm</button>
                                    </div>
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