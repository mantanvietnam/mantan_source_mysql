<?php
getHeader();

global $themeSetting;
global $urlHomes;
// debug($tmpVariable);
// debug($themeSetting['Option']['value']['idSp1']);
?>
	<div class="container-fluid set-pd-0 banner">
		<a href="<?php echo @$themeSetting['Option']['value']['linkBannerIndex'] ?>"><img src="<?php echo @$themeSetting['Option']['value']['bannerIndex'] ?>" alt=""></a>
	</div>
	<div class="container introduce">
		<div class="row">
			<div class="col-12 col-sm-12 col-md-8 col-lg-7 wr-introduce">
				<div class="text-introduce">
					<div class="title-introduce">
						GIỚI THIỆU
						<p><?php echo $themeSetting['Option']['value']['titleIntroduceIndex'] ?></p>
					</div>
					<p><?php echo $themeSetting['Option']['value']['contentIntroIndex'] ?></p>
				</div>
				<p><a class="introduce-show-more" href="<?php echo $themeSetting['Option']['value']['linkIntroduceNotice'] ?>">Xem thêm <i class="fas fa-long-arrow-alt-right"></i></a></p>
			</div>
			<div class="col-12 col-sm-12 col-md-4 col-lg-5 clsFlexBetweenMid">
				<div class="wr-img-introduce">
					<img src="<?php echo $themeSetting['Option']['value']['imgIntroduceNotice'] ?>" alt="">
				</div>
			</div>
		</div>
	</div>

	<div class="container">
		<div id="myCarousel" class="carousel my-carousel-1">
			<?php 
			if(!empty($themeSetting['Option']['value']['sevice'])) {
				foreach ($themeSetting['Option']['value']['sevice'] as $key => $value) { 
					if(!empty($value['imgSevice'])) { ?>
					<div class="carousel__slide my-carousel__slide">
						<a href="<?php echo @$value['linkSevice'] ?>">
							<img data-lazy-src="<?php echo @$value['imgSevice'] ?>" />
						</a>
						<center><?php echo @$value['titleSevice'] ?></center>
					</div>
					<?php
					}
				}
			}
			?>
		</div>
	</div>

	<div class="container">
		<div class="title-cate"><?php echo $themeSetting['Option']['value']['titleSeviceNewIndex'] ?></div>
		<div class="text-sevice">
			<?php echo $themeSetting['Option']['value']['contentSeviceNewIndex'] ?>
		</div>
		<div class="main-carousel my-main-carousel" data-flickity='{"imagesLoaded": true,"groupCells": "100%","draggable": true,"contain": true,"cellAlign": "left","pageDots":true, "autoPlay": true, "autoPlay": 4000, "pauseAutoPlayOnHover": false}'>
  			
  				<?php
  				if(!empty($themeSetting['Option']['value']['SlideSeviceNew'])) {
  					foreach ($themeSetting['Option']['value']['SlideSeviceNew'] as $key => $value) { ?>
  						<div class="carousel-cell my-carousel-cell">
							<a href="<?php echo $value['linkItemIndexSeviceNew'] ?>">
								<img src="<?php echo $value['imgSlideSeviceNew'] ?>" alt="">
			  				<center><?php echo $value['titleItemIndexSeviceNew'] ?></center>
							</a>
						</div>
  					<?php
  					}
  				}
  				?>
		</div>
	</div>

	<div class="container-fluid set-pd-0 banner">
		<a href="<?php echo !empty($themeSetting['Option']['value']['linkbannerIndex1'])?@$themeSetting['Option']['value']['linkbannerIndex1']:'javascript:void(0);' ?>">
			<img src="<?php echo @$themeSetting['Option']['value']['bannerIndex1'] ?>" alt="">
		</a>
	</div>

	<div class="container">
		<div class="title-cate"><?php echo @$themeSetting['Option']['value']['titleIndexProduct1'] ?></div>
		<div class="nav nav-tabs wr-cate-tap" role="tablist">
			<span id="tab1" href="#productTab1" class="cate-tap active" data-toggle="tab" role="tab"><?php echo @$themeSetting['Option']['value']['cateTitleIndexProduct1'] ?></span>
			<span id="tab2" href="#productTab2" class="cate-tap" data-toggle="tab" role="tab"><?php echo @$themeSetting['Option']['value']['cateTitleIndexProduct2'] ?></span>
		</div>
		<div class="tab-content" role="tablist">
			<div id="productTab1" class="tab-pane fade show active" role="tabpanel" aria-labelledby="tab1">
				<div id="myCarousel1" class="carousel my-main-carousel-product">
				<?php 
					if(!empty($tmpVariable['listCategory'])){
						foreach ($tmpVariable['listCategory'] as $key => $value) {
							// debug($value['MerchandiseGroup']['id']);
							if($value['MerchandiseGroup']['id'] == $themeSetting['Option']['value']['idSp1']){
								foreach ($value['MerchandiseGroup']['listMerchandise'] as $key => $value1) {
									// debug($value1);
									?>
									<div class="carousel__slide my-carousel-cell-product">
										<a href="<?php echo $urlHomes ?>product/<?php echo @$value1['Merchandise']['urlSlug'] ?>.html">
											<div class="box-bd-Merchandise">
												<img src="<?php echo $value1['Merchandise']['image']?>" alt="" style="width: 100%;">
											</div>
											<center><?php echo @$value1['Merchandise']['name'] ?></center>
											<center class="price"><?php echo @number_format($value1['Merchandise']['price']); ?> VNĐ</center>
										</a>
										<center class="add-cart"><button class="add-cart-button" data-sku="<?php echo @$value1['Merchandise']['code'] ?>" onclick="addToCart(this,'<?php echo @$value1['Merchandise']['id'] ?>');">Thêm vào giỏ hàng <span class="messAdd">Đã thêm vào giỏ</span></button></center>
									</div>
						<?php }
							}
						}
					}
					?>
				</div>
			</div>
			<div id="productTab2" class="tab-pane fade" role="tabpanel" aria-labelledby="tab2">
				<div id="myCarousel2" class="carousel my-main-carousel-product">
				<?php 
					if(!empty($tmpVariable['listCategory'])){
						foreach ($tmpVariable['listCategory'] as $key => $value) {
							// debug($value['MerchandiseGroup']['id']);
							if($value['MerchandiseGroup']['id'] == $themeSetting['Option']['value']['idSp2']){
								foreach ($value['MerchandiseGroup']['listMerchandise'] as $key => $value1) {

									?>
									<div class="carousel__slide my-carousel-cell-product">
										<a href="/product/<?php echo @$value1['Merchandise']['urlSlug'] ?>.html">
											<div class="box-bd-Merchandise">
												<img src="<?php echo $value1['Merchandise']['image']?>" alt="" style="width: 100%;">
											</div>
											<center><?php echo @$value1['Merchandise']['name'] ?></center>
											<center class="price"><?php echo @number_format($value1['Merchandise']['price']); ?> VNĐ</center>
										</a>
										<center class="add-cart"><button class="add-cart-button" data-sku="<?php echo @$value1['Merchandise']['id'] ?>" onclick="addToCart(this,'<?php echo @$value1['Merchandise']['id'] ?>');">Thêm vào giỏ hàng <span class="messAdd">Đã thêm vào giỏ</span></button></center>
									</div>
						<?php }
							}
						}
					}
					?>
				</div>
			</div>
		</div>
	</div>

	<div class="container-fluid set-pd-0 banner">
		<a href="<?php echo !empty($themeSetting['Option']['value']['linkbannerIndex2'])?@$themeSetting['Option']['value']['linkbannerIndex2']:'javascript:void(0);' ?>">
			<img src="<?php echo @$themeSetting['Option']['value']['bannerIndex2'] ?>" alt="">
		</a>
	</div>

	<?php if(!empty($tmpVariable['listNoticeNew'])) { ?>
	<div class="container">
		<div class="title-cate"><?php echo @$themeSetting['Option']['value']['titleNoticeIndex'] ?></div>
		<div class="main-carousel my-main-carousel-notice" data-flickity='{"imagesLoaded": true,"groupCells": "80%","draggable": true,"contain": true,"cellAlign": "left","pageDots":true, "autoPlay": true, "autoPlay": 4000, "pauseAutoPlayOnHover": false}'>
			<?php foreach ($tmpVariable['listNoticeNew'] as $key => $value) { ?>
				<div class="carousel-cell my-carousel-cell-notice">
	  				<a href="<?php echo @getUrlNotice($value['Notice']['id']) ?>">
	  					<img src="<?php echo @$value['Notice']['image']; ?>" alt="">
		  				<div class="time-notice"><?php echo date('d/m/Y',$value['Notice']['time']); ?></div>
		  				<p class="title-notice"><?php echo $value['Notice']['title'] ?></p>
	  				</a>
	  				<p><a class="notice-show-more" href="<?php echo @getUrlNotice($value['Notice']['id']) ?>">Xem thêm <i class="fas fa-long-arrow-alt-right"></i></a></p>
	  			</div>
			<?php
			} ?>
		</div>
	</div>
	<?php
	} ?>
	<?php if(!empty($themeSetting['Option']['value']['h1Index'])) { ?>
		<div class="container">
			<div class="col-12">
				<h1 class="indexH1"><?php echo @$themeSetting['Option']['value']['h1Index'] ?></h1>
			</div>
		</div>
	<?php	
	} ?>
<?php
getFooter();
?>
<script>
	const myCarousel = new Carousel(document.querySelector("#myCarousel"), {
  		Dots: false,
  		infinite: false,
  		center: false,
  		fill: true,
  		slidesPerPage: 1
	});

	const myCarousel1 = new Carousel(document.querySelector("#myCarousel1"), {
  		Dots: false,
  		infinite: false,
  		center: false,
  		fill: true,
  		slidesPerPage: 1
	});

	const myCarousel2 = new Carousel(document.querySelector("#myCarousel2"), {
  		Dots: false,
  		infinite: false,
  		center: false,
  		fill: true,
  		slidesPerPage: 1
	});
</script>	