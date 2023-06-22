<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <?php mantan_header();?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="icon" type="image/x-icon" href="https://designer.ezpics.vn/plugins/ezpics_designer/view/home/assets/img/avatar-ezpics.png" />

    <link rel="stylesheet" href="/plugins/ezpics_designer/view/home/designer/assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css"  href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
      <script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'G-PCQ02R5K9G');
	</script>
</head>
<body>
    <main>
        <div id="product-line">
        </div>
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

					$description = (!empty($product->description))?nl2br($product->description):''?>
        <section id="product-details">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 col-md-7 col-12 product-img">
                        <div class="product-img-item">
                            <img src="<?php echo $product->image ?>" alt="">
                        </div>
                    </div>

                    <div class="col-lg-5 col-md-5 col-12 product-information">
                        <h1 class="product-title"><?php echo $product->name ?></h1>
                        <div>
                            <p>Tác giả: <span><?php echo $user->name ?></span></p>
                            <p>Lượt xem: <span><?php echo $product->views ?></span></p>
                            <p>Đã bán: <span><?php echo $product->sold ?></span></p>
                            <div class="price-product">
                                <p>Giá bán: <span><?php echo $sale_price  ?></span></p>
                            </div>
                            <?php if(!empty($description)){ ?>
                            <p>Mô tả: <span><?php echo $description ?></span></p>
                            <?php } ?>
                        </div>
                        <br>
                        <br>
                        <div class="product-button">
                            <button><a href="<?php echo $link_open_app ?>">Mua mẫu ngay</a></button>
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
                    	<?php if (!empty($dataOther)){
                    		foreach($dataOther as $key => $item){
                    			if(@$item->id != $product->id){
                    				if($item->sale_price==0){
						$price = 'Miễn phí';
					}else{
						$price = number_format($item->sale_price).'đ';
					}

					if($item->price>0){
						$price .= ' <del>'.number_format($item->price).'đ</del>';
					}
                    	?>
	                        <div class="product-item col-xl-3 col-lg-4 col-md-4">
	                            <a href="/detail/<?php echo @$item->name.'-'.@$item->id ?>.html">
	                                <div class="product-img">
	                                    <img src="<?php echo @$item->thumbnail ?>" alt="">
	                                </div>
	                                <div class="product-title">
	                                    <p><?php echo @$item->name ?></p>
	                                </div>
	                                <div class="product-sold">
	                                    <p>Đã bán :<span><?php echo @$item->sold ?></span></p>
	                                </div>
	                                <div class="product-price">
	                                    <p><?php echo $price ?>	</p>
	                                </div>
	                            </a>
	                        </div>
                        <?php }}} ?>
                    </div>
                </div>
            </div>
        </section>
        
    </main>

    
</body>

<footer>
   <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script type="text/javascript" src="/plugins/ezpics_designer/view/home/designer/assets/js/slick.js"></script>

</footer>

</html>