<?php
global $session;
$info = $session->read('infoUser');
getHeader();
?>

<main>
    <div id="profile">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <?php include('menu.php'); ?>
                </div>

                <div class="col-lg-8 col-md-8 col-sm-12">
                    <div class="tab-content" style="height:100%">
                        <div id="super-sale" class="view-product tab-pane active" style="border:1px solid #ccc">
                             <div class="title-viewed-product">
                                    <p>Sản phẩm đã xem</p>
                                </div>
                                <div class="group-viewed-product">
                                    <div class="row list-viewed-product">
                                        <?php if(!empty($listData)){
                                                foreach($listData as $key => $item){
                                                if(!empty($item->product)){ ?>
                                        <div class="item-viewd-product">
                                            <a href="/product/<?php echo $item->product->slug ?>.html" class="btn-img-viewd-product">
                                                <div class="group-viewed-product-img">
                                                    <img src="<?php echo $item->product->image ?>" alt="">
                                                </div>
                                            </a>
                                            <a href="/product/<?php echo $item->product->slug ?>.html" class="btn-name-viewd-product">
                                                <div class="group-viewed-product-name">
                                                    <p><?php echo $item->product->title ?></p>
                                                </div>
                                            </a>
                                            <div class="group-viewed-product-cost">
                                                <h4><?php echo number_format($item->product->price) ?>đ</h4>
                                                <div>
                                                    <p><?php echo number_format($item->product->price_old) ?>đ</p>
                                                    
                                                </div>
                                            </div>
                                            <div class="group-viewed-product-rating">
                                                <div class="group-viewed-product-star">
                                                    <i class="fa-solid fa-star"></i>
                                                    <p>4.8 (34)</p>
                                                </div>
                                                <div class="group-viewed-product-heart">
                                                    <p><?php echo $item->product->sold ?> đã bán</p>
                                                    <i class="fa-solid fa-heart"></i>
                                                </div>
                                            </div>
                                        </div>
                                    <?php }}} ?>
                                    </div>

                                </div>
                        </div>
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>



<?php
getFooter();
?>s