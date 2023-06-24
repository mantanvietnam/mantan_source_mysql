<?php include(__DIR__.'/../headerPublic.php') ; ?>
    <main>
      
        <?php
            if(!empty($product)){
                if($product->sale_price==0){
                    $sale_price = 'Miễn phí';
                }else{
                    $sale_price = number_format($product->sale_price).'đ';
                }

                if($product->price>0){
                    $sale_price .= ' <del>'.number_format($product->price).'đ</del>';
                }

                $thumbnail = (!empty($product->thumbnail))?$product->thumbnail:$product->image;

                $description = (!empty($product->description))?nl2br($product->description):''?>
        <section id="product-details">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 col-md-7 col-12 product-img">
                        <div class="product-img-item">
                            <img src="<?php echo $thumbnail; ?>" alt="">
                        </div>
                    </div>

                    <div class="col-lg-5 col-md-5 col-12 product-information">
                        <h1 class="product-title"><?php echo $product->name ?></h1>
                        <div>
                            <p>Tác giả: <a class="product-name-user" href="<?php echo $user->link_open_app ; ?>"><?php echo $user->name ?></a></p>
                            <p>Lượt xem: <span><?php echo $product->views ?></span></p>
                            <p>Đã bán: <span> <?php echo $product->sold ?></span></p>
                            <div class="price-product">
                                <p>Giá bán: <span><?php echo $sale_price  ?></span></p>
                            </div>
                            <?php if(!empty($description)){ ?>
                            <br>
                            <span><?php echo nl2br($description); ?></span>
                            <?php } ?>
                        </div>
                        <br>
                        <br>
                        <div class="product-button">
                            <button><a href="<?php echo $link_open_app ?>"><i class="fa-solid fa-cart-shopping"></i> Mua mẫu ngay</a></button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
	<?php	} ?>
        <section id="product-other">
            <div class="product-other-title">
                <div class="container">
                    <h2>Sản phẩm khác</h2>
                </div>
            </div>

            <div class="product-other-list">
                <div class="container">
                    <div class="product-other-slide">
                    	<?php 
                        if (!empty($dataOther)){
                    		foreach($dataOther as $key => $item){
                    			if(@$item->id != $product->id){
                    				if($item->sale_price==0){
                						   $price = ' <p>Miễn phí</p>';
                                    }else{
                                        $price =  '<p>'.number_format($item->sale_price).'đ</p>';
                                    }

                                    if($item->price>0){
                                        $price .= '  <p><del>'.number_format($item->price).'đ</del</p>';
                                    }

                                    $thumbnail = (!empty($item->thumbnail))?$item->thumbnail:$item->image;
                    	?>
	                        <div class="product-item col-xl-3 col-lg-4 col-md-4">
	                            <a href="/detail/<?php echo @$item->name.'-'.@$item->id ?>.html">
	                                <div class="product-img">
	                                    <img src="<?php echo $thumbnail; ?>" alt="">
	                                </div>
	                                <div class="product-title">
	                                    <p><?php echo @$item->name ?></p>
	                                </div>
	                                <div class="product-sold">
	                                    <p>Đã bán: <span><?php echo @$item->sold ?></span></p>
	                                </div>
	                                <div class="product-price">
	                                    <?php echo $price ?>
	                                </div>
	                            </a>
	                        </div>
                        <?php }}} ?>
                    </div>
                </div>
            </div>
        </section>
        
    </main>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script type="text/javascript" src="/plugins/ezpics_designer/view/home/designer/assets/js/slick.js?time=<?php echo  getdate()[0]; ?>"></script>
    
    <?php include(__DIR__.'/../footerPublic.php') ; ?>