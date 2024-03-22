<?php
getHeader();

global $urlThemeActive;
global $settingThemes;
?>

    <main>
        <section id="section-breadcrumb">
            <div class="breadcrumb-center">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                    <li class="breadcrumb-item active">Khuyến mãi</li>
                </ul>
            </div>
        </section>
        <section id="sale99">
            <div class="container">
                <div class="banner-sale">
                    <img src="<?php echo @$settingThemes['baner_sele'] ?>">
                </div>
                <div class="endow">
                    <h3><?php echo @$settingThemes['sela_title1'] ?></h3>
                    <p><?php echo @$settingThemes['sela_title2'] ?>
                        <span><?php echo @$settingThemes['sela_title3'] ?></span>
                    </p>
                </div>
             <!-- <img src="<?php echo $urlThemeActive ?>asset/image/voucher.png"> --> 
                     <div class="row combo-voucher">
                        <?php if(!empty($DiscountCode)){
                            foreach($DiscountCode as $item){ ?>
                        <div class="item-voucher col-md-4 col-sm-6">
                           
                            <div class="detail-voucher-sale">
                                <p><?php echo $item->code ?></p>
                                <span><?php echo $item->note ?></span>
                            </div>
                        </div>
                    <?php }} ?>
                        </div>
             
                <div class="top-deal" style="background-image: url(<?php echo @$settingThemes['background_sele'] ?>)">
                    <!-- <img src=""> -->
                    <div class="group-deal">
                        <div class="list-product list-product-1">
                            <div class="row">
                                <?php if(!empty($list_product)){
                        foreach($list_product as $product){
                            $link = '/san-pham/'.$product->slug.'.html';
                            $giam = 0;
                            $price = $product->price;
                            if($settingThemes['targetTime']>time() && @$product->flash_sale==1){
                                if(!empty($product->price_old) && !empty($product->price_flash)){
                                    $giam = 100 - 100*$product->price_flash/$product->price_old;
                                    $price = @$product->price_flash;
                                }
                            }else{
                                if(!empty($product->price_old) && !empty($product->price)){
                                    $giam = 100 - (100*($product->price/$product->price_old));
                                            
                                }
                            }


                                    $ban = random_int(1, 50);
                                    /*if(!empty($product->quantity) && !empty($product->number_like)){
                                        $ban = 100 - 100*$product->quantity/$product->number_like;
                                    }*/
                         ?>

                                <div class="col-lg-3 col-md-3 col-sm-3 col-6 product-item">
                                <div class="product-item-inner">
                                    <?php if($giam>0){ ?>
                                        <div class="ribbon ribbon-top-right"><span><?php echo number_format($giam) ?>%</span></div>
                                    <?php } ?>
                                    
                                    <div class="product-img">
                                        <a href="<?php echo $link ?>"><img src="<?php echo $product->image ?>" alt=""></a>
                                    </div>
        
                                    <div class="product-info">
                                        <div class="product-name">
                                            <a href="<?php echo $link ?>"><?php echo $product->title ?></a>
                                        </div>
        
                                        <div class="product-price">
                                            <p><?php echo number_format($price) ?>đ</p>
                                        </div>
        
                                        <div class="product-discount">
                                            <del><?php echo number_format($product->price_old) ?>đ</del>
                                        </div>
                                    </div>
        
                                    <div class="progress-box">
                                        <div class="product-progress">
                                            <!-- <div class="text-progress"> <?php echo $product->sold ?> Sản phẩm đã bán</div> -->
                                            <div class="text-progress"> <?php echo $ban  ?> Sản phẩm đã bán</div>
                                            <div class="sale-progress-val" style="width: <?php echo $ban; ?>%"></div>
                                        </div>
                                    </div>
        
                                    <div class="product-rate">
                                        <div class="rate-best-item rate-star">
                                            <img src="<?php echo $urlThemeActive ?>asset/image/star.png" alt="">
                                            <?php if(!empty($product->point) && !empty($product->evaluatecount)){ ?>
                                            <p><?php echo number_format(@$product->point,1); ?> <span>(<?php echo @$product->evaluatecount ?>)</span></p>
                                        <?php } ?>
                                        </div>
        
                                        <div class="rate-best-item rate-sold">
                                            <p><?php echo @$product->sold_virtual ?>  Đã bán</p> 
                                            <!-- <p><?php echo $ban ?>  Đã bán</p> -->
                                            <img src="<?php echo $urlThemeActive ?>asset/image/heart.png" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                                <?php }} ?>
                               
                            </div>
                        </div>
                        
                    </div>

                </div>
            </div>
        </section>
    </main>
    
<?php getFooter();?>