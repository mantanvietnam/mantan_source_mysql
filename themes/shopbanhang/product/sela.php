<?php
getHeader();
global $urlThemeActive;

$setting = setting();

$slide_home= slide_home($setting['id_slide']);
?>

<main>
        <section id="section-breadcrumb">
            <div class="breadcrumb-center">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                    <li class="breadcrumb-item active">Khuyên mãi</li>
                </ul>
            </div>
        </section>
        <section id="sale99">
            <div class="container">
                <div class="banner-sale">
                    <img src="<?php echo @$setting['baner_sele'] ?>">
                </div>
                <div class="endow">
                    <h3><?php echo @$setting['sela_title1'] ?></h3>
                    <p><?php echo @$setting['sela_title2'] ?>
                        <span><?php echo @$setting['sela_title3'] ?></span>
                    </p>
                </div>
             <!-- <img src="<?php echo $urlThemeActive ?>asset/image/voucher.png"> -->
                    <!-- <div class="row combo-voucher">
                        <?php if(!empty($DiscountCode)){
                            foreach($DiscountCode as $item){ ?>
                        <div class="item-voucher col-md-4 col-sm-6">
                           
                            <div class="detail-voucher-sale">
                                <p><?php $item->code ?></p>
                                <span><?php $item->note ?></span>
                            </div>
                        </div>
                    <?php }} ?>
                        </div> -->
             
                <div class="top-deal" style="background-image: url(<?php echo @$setting['background_sele'] ?>)">
                    <!-- <img src=""> -->
                    <div class="group-deal">
                        <div class="list-product list-product-1">
                            <div class="row">
                                <?php if(!empty($list_product)){
                        foreach($list_product as $product){
                            $link = '/product/'.$product->slug.'.html';
                                     $giam = 0;
                                    if(!empty($product->price_old) && !empty($product->price)){
                                        $giam = 100 - 100*$product->price/$product->price_old;
                                    }

                                    $ban = 0;
                                    if(!empty($product->quantity) && !empty($product->sold)){
                                        $ban = 100 - 100*$product->sold/$product->quantity;
                                    }
                         ?>

                                <div class="col-lg-3 col-md-3 col-sm-3 col-12 product-item">
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
                                            <p><?php echo number_format($product->price) ?>đ</p>
                                        </div>
        
                                        <div class="product-discount">
                                            <del><?php echo number_format($product->price_old) ?>đ</del>
                                        </div>
                                    </div>
        
                                    <div class="progress-box">
                                        <div class="product-progress">
                                            <div class="text-progress">Sản phẩm <?php echo $product->sold ?> Đã bán</div>
                                            <div class="sale-progress-val" style="width: <?php echo $ban; ?>%"></div>
                                        </div>
                                    </div>
        
                                    <div class="product-rate">
                                        <div class="rate-best-item rate-star">
                                            <img src="<?php echo $urlThemeActive ?>asset/image/star.png" alt="">
                                            <p>4.8 <span>(34)</span></p>
                                        </div>
        
                                        <div class="rate-best-item rate-sold">
                                            <p><?php echo $product->sold ?>  Đã bán</p>
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
<?php
getFooter();?>