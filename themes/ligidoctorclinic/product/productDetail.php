<?php getHeader();
global $urlHomes;
?>
	<div class="container content-detail-product">
		<div class="path path-detail-product">
			<a href="/">Trang chủ</a> / <a href="<?php echo $urlHomes ?>allProduct">Cửa hàng</a> / <span><?php echo @$tmpVariable['data']['Product']['title'] ?></span>
		</div>
		<div class="row row-mobile-reverse">
			<div class="col-12 col-sm-12 col-md-12 col-lg-6">
				<h1 class="title-product-detail"><?php echo @$tmpVariable['data']['Product']['title'] ?></h1>
				<div class="star-product">
					<img src="<?php echo $urlThemeActive ?>assets/images/StarProduct.png" alt="">
					<img src="<?php echo $urlThemeActive ?>assets/images/StarProduct.png" alt="">
					<img src="<?php echo $urlThemeActive ?>assets/images/StarProduct.png" alt="">
					<img src="<?php echo $urlThemeActive ?>assets/images/StarProduct.png" alt="">
					<img src="<?php echo $urlThemeActive ?>assets/images/StarProduct.png" alt="">
				</div>
				<div class="price-product-detail">
					<?php echo @number_format($tmpVariable['data']['Product']['price'],0,',','.'); ?><span> VNĐ</span>
				</div>
				<div class="quanlity">
					<div class="box-quanlyti">
						<span onclick="decreaseCount(event,this)">-</span>
						<input type="number" min="1" value="1" id="numberOrder">
						<span onclick="increaseCount(event,this)">+</span>
					</div>
					<button type="button" onclick="addToCart(this,'<?php echo @$tmpVariable['data']['Product']['id'] ?>','numberOrder')">Thêm vào giỏ hàng <span class="messAdd">Đã thêm vào giỏ</span></button>
				</div>
				<div class="wr-info-product">
					<div class="nav nav-tabs " role="tablist">
						<a id="tab-description1" href="#tab-description" class="active"  data-toggle="tab" role="tab" >Mô tả</a>
						<a id="tab-info1" href="#tab-info" class="" data-toggle="tab" role="tab" >Thông tin</a>
						<a id="tab-uses1" href="#tab-uses" class="" data-toggle="tab" role="tab" >Công dụng</a>
					</div>
					<div class="tab-content" role="tablist">
						<div id="tab-description" class="tab-pane fade show active" role="tabpanel" aria-labelledby="tab-description1">
							<?php echo @$tmpVariable['data']['Product']['description'] ?>
						</div>
						<div id="tab-info" class="tab-pane fade" role="tabpanel" aria-labelledby="tab-info1">
							<?php echo @$tmpVariable['data']['Product']['info'] ?>
						</div>
						<div id="tab-uses" class="tab-pane fade" role="tabpanel" aria-labelledby="tab-uses1">Lorem ipsum dolor sit amet consectetur adipisicing elit. Error ducimus laboriosam, fuga, repellendus quo voluptatum saepe adipisci! Esse excepturi aspernatur qui, at, vero deserunt, molestiae, ad magnam non ipsa expedita.
						</div>
					</div>
				</div>
			</div>
			<div class="col-12 col-sm-12 col-md-12 col-lg-6">
				<div class="main-carousel main-carousel-detail" data-flickity='{"imagesLoaded": true, "cellAlign": "left", "contain": true, "pageDots": false, "prevNextButtons": false }'>
					<?php foreach ($tmpVariable['data']['Product']['images'] as $key => $value) { ?>
					<div class="carousel-cell carousel-cell-detail" data-fancybox="gallery" data-src="<?php echo @$value ?>">
					  	<div class="box-bd-product">
							<img src="<?php echo @$value ?>" alt="">
						</div>
					 </div>
					<?php
					} ?>
				</div>
				<div class="carousel carousel-nav nav-main-carousel-detail"
				  data-flickity='{ "asNavFor": ".main-carousel-detail", "contain": true, "pageDots": false, "prevNextButtons": false }'>
				  	<?php foreach ($tmpVariable['data']['Product']['images'] as $key => $value) { ?>
				  	<div class="carousel-cell">
						<img src="<?php echo @$value ?>" alt="">
				  	</div>
				  	<?php
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
			<?php if(!empty($tmpVariable['otherData'])){
				foreach ($tmpVariable['otherData'] as $key => $value) { ?>
				<div class="carousel-cell carousel-cell-related">
					<a href="<?php echo @$urlHomes.'product/'.$value['Product']['slug'].'.html' ?>">
						<div class="box-bd-product">
							<img src="<?php echo @$value['Product']['images'][0] ?>" alt="">
						</div>
		  				<center><?php echo @$value['Product']['title'] ?></center>
		  				<center class="price"><?php echo @number_format($value['Product']['price'],0,',','.'); ?> VNĐ</center>
					</a>
	  				<center class="add-cart" ><button data-sku = 'MÃ SP' class="add-cart-button" onclick="addToCart(this, '<?php echo @$value['Product']['id'] ?>')">Thêm vào giỏ hàng <span class="messAdd">Đã thêm vào giỏ</span></button></center>
				</div>
				<?php
				}
			}
			?>
		</div>
	</div>

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