<?php getHeader();
global $urlHomes;
?>
<div class="container content-detail-product">
	<div class="path path-detail-product">
		<a href="/">Trang chủ</a> / <a href="/allProduct">Cửa hàng</a> / <span><?php echo @$product->title; ?></span>
	</div>
	<div class="row row-mobile-reverse">
		<div class="col-12 col-sm-12 col-md-12 col-lg-6">
			<h1 class="title-product-detail"><?php echo @$product->title; ?></h1>
			
			<div class="price-product-detail">
				<?php echo @number_format(@$product->price); ?><span> VNĐ</span>
			</div>
			<div class="quanlity">
				<div class="box-quanlyti">
					<span onclick="minusQuantity()">-</span>
					<input type="quantity_buy" min="1" value="1" id="quantity_buy">
					<span onclick="plusQuantity()">+</span>
				</div>
				<button type="button" onclick="addProductCart(<?php echo $product->id;?>,'true')">Thêm vào giỏ hàng <span class="messAdd">Đã thêm vào giỏ</span></button>
			</div>
			<div class="wr-info-product">
				<div class="nav nav-tabs " role="tablist">
					<a id="tab-description1" href="#tab-description" class="active"  data-toggle="tab" role="tab" >Mô tả</a>
					<a id="tab-info1" href="#tab-info" class="" data-toggle="tab" role="tab" >Thông tin</a>
					<a id="tab-uses1" href="#tab-uses" class="" data-toggle="tab" role="tab" >Công dụng</a>
				</div>
				<div class="tab-content" role="tablist">
					<div id="tab-description" class="tab-pane fade show active" role="tabpanel" aria-labelledby="tab-description1">
						<?php echo @$product->description; ?>
					</div>
					<div id="tab-info" class="tab-pane fade" role="tabpanel" aria-labelledby="tab-info1">
						<?php echo @$product->info; ?>
					</div>
					<div id="tab-uses" class="tab-pane fade" role="tabpanel" aria-labelledby="tab-uses1"><?php echo @$product->specification; ?>
				</div>
			</div>
		</div>
	</div>
	<div class="col-12 col-sm-12 col-md-12 col-lg-6">
		<div class="main-carousel main-carousel-detail" data-flickity='{"imagesLoaded": true, "cellAlign": "left", "contain": true, "pageDots": false, "prevNextButtons": false }'>
			<div class="carousel-cell carousel-cell-detail" data-fancybox="gallery" data-src="<?php echo @$product->image ?>">
				<div class="box-bd-product">
					<img src="<?php echo @$product->image ?>" alt="">
				</div>
			</div>
			
			<?php if(!empty($product->images)){
				foreach($product->images as $item) {
					if(!empty($item)){
						echo '<div class="carousel-cell carousel-cell-detail" data-fancybox="gallery" data-src="'.@$item.'">
						<div class="box-bd-product">
						<img src="'.@$item.'" alt="">
						</div>
						</div>';
					}}}
					?>


					
				</div>
				<div class="carousel carousel-nav nav-main-carousel-detail"
				data-flickity='{ "asNavFor": ".main-carousel-detail", "contain": true, "pageDots": false, "prevNextButtons": false }'>
				<div class="carousel-cell">
					<img src="<?php echo @$product->image ?>" alt="">
				</div>

				<?php if(!empty($product->images)){
					foreach($product->images as $item) {
						if(!empty($item)){
							echo '<div class="carousel-cell">
							<img src="'.$item.'" alt="">
							</div>';
						}}
					} ?>
				</div>
			</div>
		</div>
	</div>
	<div class="container content-related-product">
		<div class="title-cate">
			Sản phẩm liên quan
		</div>
		<div class="main-carousel main-carousel-related" data-flickity='{"imagesLoaded": true, "cellAlign": "left", "contain": true, "pageDots": false, "prevNextButtons": false }'>
			<?php if(!empty($other_product)) { 
				foreach($other_product as $item) {
					$link = '/san-pham/'.$item->slug.'.html';
					?>
					<div class="carousel-cell carousel-cell-related">
						<a href="<?php echo @$link ?>">
							<div class="box-bd-product">
								<img src="<?php echo $item->image ?>" alt="">
							</div>
							<center><?php echo $item->title ?></center>
							<center class="price"><?php echo @number_format($item->price); ?> VNĐ</center>
						</a>
						<center class="add-cart" ><a data-sku = 'MÃ SP' class="add-cart-button" href="<?php echo @$link ?>">Thêm vào giỏ hàng <span class="messAdd">Đã thêm vào giỏ</span></a></center>
					</div>
					<?php
				}
			}
			?>
		</div>
	</div>
	<script type="text/javascript">
		function addProductCart(idProduct, status){
			let quantity = parseInt($('#quantity_buy').val());
        // console.log(quantity);
        // console.log(idProduct);
        // console.log(status);

        $.ajax({
        	method: "GET",
        	url: "/apis/addProductToCart/?id_product="+idProduct+"&quantity="+quantity+"&status=true"
        })
        .done(function( msg ) {
        	console.log(msg);

            // document.getElementById("count").innerHTML = msg.count;
            if(status=='true'){
            	window.location = '/gio-hang';
            }else{
               /* document.getElementById("myElement").style.display = 'block';

                var myElement = document.getElementById('myElement');

                // Hàm thay đổi CSS
                function changeCSS() {
                    myElement.style.display = 'none';
                }

                // Đặt hẹn giờ để thực hiện thay đổi sau 10 giây
                setTimeout(changeCSS, 3000);*/
            }
        });
    }
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
</script>

<?php getFooter();
?>
<script>
	Fancybox.bind('[data-fancybox="gallery"]', {
		closeButton: "top",
		Thumbs: false,
		Toolbar: {
			display: [
			{ id: "prev", position: "center" },
			{ id: "counter", position: "center" },
			{ id: "next", position: "center" },
			"close",
			],
		},
	});
</script>