<?php
getHeader();
global $urlThemeActive;
?>
	<div class="container-fluid set-pd-0 banner">
		<a href="#"><img src="<?php echo @$setting['banner1'] ?>" alt=""></a>
	</div>
	<div class="container introduce">
		<div class="row">
			<div class="col-12 col-sm-12 col-md-8 col-lg-7 wr-introduce">
				<div class="text-introduce">
					<div class="title-introduce">
						GIỚI THIỆU
						<p><?php echo @$setting['title1'] ?></p>
					</div>
					<p><?php echo @$setting['content1'] ?></p>
				</div>
				<p><a class="introduce-show-more" href="<?php echo @$setting['link1'] ?>">Xem thêm <i class="fas fa-long-arrow-alt-right"></i></a></p>
			</div>
			<div class="col-12 col-sm-12 col-md-4 col-lg-5 clsFlexBetweenMid">
				<div class="wr-img-introduce">
					<img src="<?php echo @$setting['image1'] ?>" alt="">
				</div>
			</div>
		</div>
	</div>

	<div class="container">
		<div id="myCarousel" class="carousel my-carousel-1">
				<?php if(!empty($album->data)){
						foreach($album->data as $item){
							echo '<div class="carousel__slide my-carousel__slide">
								<a href="'.@$item->link.'">
									<img src="'.@$item->image.'" />
								</a>
								<center>'.@$item->title.'</center>
							</div>';
						}
					}
				?>
					
		</div>
	</div>

	<div class="container">
		<div class="title-cate"><?php echo @$setting['title2'] ?></div>
		<div class="text-sevice">
			<?php echo @$setting['content2'] ?>
		</div>
		<div class="main-carousel my-main-carousel" data-flickity='{"imagesLoaded": true,"groupCells": "100%","draggable": true,"contain": true,"cellAlign": "left","pageDots":true, "autoPlay": true, "autoPlay": 4000, "pauseAutoPlayOnHover": false}'>
  			
  				<?php
  				if(!empty($listService)) {
  					foreach ($listService as $key => $value) { ?>
  						<div class="carousel-cell my-carousel-cell">
							<a href="/<?php echo $value->slug ?>.html">
								<img src="<?php echo $value->image ?>" alt="">
			  				<center><?php echo $value->title ?></center>
							</a>
						</div>
  					<?php
  					}
  				}
  				?>
		</div>
	</div>

	<div class="container-fluid set-pd-0 banner">
		<a href="#">
			<img src="<?php echo @$setting['banner2'] ?>" alt="">
		</a>
	</div>

	<div class="container">
		<div class="title-cate">SẢN PHẨM NỔI BẬT</div>
		<div class="nav nav-tabs wr-cate-tap" role="tablist">
			<?php if(!empty($categorieProduct)){
				foreach($categorieProduct as $key => $item){
					$active = '';
					if($key==0){
						$active = 'active';
					}

					echo '<span id="tab'.$key.'" href="#productTab'.$key.'" class="cate-tap '.$active.'" data-toggle="tab" role="tab">'.$item->name.'</span>';
				}
			} ?>
			
		</div>
		<div class="tab-content" role="tablist">
			<?php if(!empty($categorieProduct)){
				foreach($categorieProduct as $key => $item){
					$active = '';
					if($key==0){
						$active = 'show active';
					}
					

			echo '<div id="productTab'.$key.'" class="tab-pane fade '.$active.'" role="tabpanel" aria-labelledby="tab'.$key.'">
				<div id="myCarousel'.$key.'" class="carousel my-main-carousel-product">';
					
							if(!empty($item->product)){
								foreach ($item->product as $k => $value) {
									// debug($value1);
								echo '<div class="carousel__slide my-carousel-cell-product">
										<a href="/product/'.@$value->slug.'.html">
											<div class="box-bd-Merchandise">
												<img src="'. $value->image.'" alt="" style="width: 100%;">
											</div>
											<center>'.@$value->title.'</center>
											<center class="price">'.number_format($value->price).' VNĐ</center>
										</a>
										<center class="add-cart"><a class="add-cart-button" href="/product/'.@$value->slug.'.html">Thêm vào giỏ hàng <span class="messAdd">Đã thêm vào giỏ</span></a></center>
									</div>';
								}
							}
						
					
					
				echo'</div>
			</div>';
			 }
			} ?>
		</div>
	</div>

	<div class="container-fluid set-pd-0 banner">
		<a href="#">
			<img src="<?php echo @$setting['banner3'] ?>" alt="">
		</a>
	</div>

	<?php if(!empty($listpost)) { 
		?>
	<div class="container">
		<div class="title-cate"><?php echo @$setting['title3'] ?></div>
		<div class="main-carousel my-main-carousel-notice" data-flickity='{"imagesLoaded": true,"groupCells": "80%","draggable": true,"contain": true,"cellAlign": "left","pageDots":true, "autoPlay": true, "autoPlay": 4000, "pauseAutoPlayOnHover": false}'>
			<?php foreach ($listpost as $key => $item) { 
				echo '<div class="carousel-cell my-carousel-cell-notice">
	  				<a href="/'.@$item->slug.'.html">
	  					<img src="'.@$item->image.'" alt="">
		  				<div class="time-notice">'.date('d/m/Y',@$item->time).'</div>
		  				<p class="title-notice">'.@$item->title.'</p>
	  				</a>
	  				<p><a class="notice-show-more" href="/'.@$item->slug.'.html">Xem thêm <i class="fas fa-long-arrow-alt-right"></i></a></p>
	  			</div>';
			
			} ?>
		</div>
	</div>
	<?php
	} ?>
	<?php if(!empty($setting['content3'])) { ?>
		<div class="container">
			<div class="col-12">
				<h1 class="indexH1"><?php echo @$setting['content3'] ?></h1>
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
	
	<?php if(!empty($categorieProduct)){
				foreach($categorieProduct as $key => $item){

	echo 'const myCarousel'.$key.' = new Carousel(document.querySelector("#myCarousel'.$key.'"), {
  		Dots: false,
  		infinite: false,
  		center: false,
  		fill: true,
  		slidesPerPage: 1
	});';
}}?>

	
</script>