<?php
getHeader();
global $themeSetting;
?>
	<div class="container-fluid set-pd-0 banner">
		<img src="<?php echo @$themeSetting['Option']['value']['bannerGT'] ?>" alt="">
	</div>

	<div class="container">
		<div class="path path-detail-notice">
			<a href="/">Trang chủ</a> / <a href="">Tin tức</a> / <span><?php echo @$infoNotice['Notice']['title'];?></span>
		</div>
		<div class="row">
			<h1 class="col-12 title-cate title-detail-notice"><?php echo @$infoNotice['Notice']['title'];?></h1>
			<div class="col-12 wr-content-notice">
				<div class="desNotice">
					<?php echo @$infoNotice['Notice']['introductory'] ?>
				</div>
				<?php echo @$infoNotice['Notice']['content'];?>
			</div>
		</div>
		<div class="title-cate title-cate-notice-related">
			Dịch vụ liên quan
		</div>
		<div class="main-carousel my-main-carousel-notice-related" data-flickity='{"imagesLoaded": true,"groupCells": "80%","draggable": true,"contain": true,"cellAlign": "left","pageDots":true, "autoPlay": true, "autoPlay": 4000, "pauseAutoPlayOnHover": false, "prevNextButtons": false}'>
			<?php
			if (!empty($otherNotices)) {
				foreach ($otherNotices as $key => $value) { ?>
				<div class="carousel-cell my-carousel-cell-notice-related">
	  				<a href="<?php echo @getUrlNotice($value['Notice']['id']) ?>">
	  					<img src="<?php echo @$value['Notice']['image'] ?>" alt="">
		  				<p class="title-notice-related"><?php echo @$value['Notice']['title'] ?></p>
	  				</a>
	  				<p><a href="<?php echo @getUrlNotice($value['Notice']['id']) ?>" class="notice-show-more notice-show-more-related" href="">Xem thêm <i class="fas fa-long-arrow-alt-right"></i></a></p>
	  			</div>
				<?php
				}
			}
			?>
		</div>
	</div>


<?php
getFooter();
?>