<?php
getHeader();
global $themeSetting;
?>
	<div class="container-fluid set-pd-0 banner">
		<img src="<?php echo @$themeSetting['Option']['value']['bannerGT'] ?>" alt="">
	</div>

	<div class="container">
		<div class="path path-detail-notice">
			<a href="/">Trang chủ</a>  / <span><?php echo $post->title; ?></span>
		</div>
		<div class="row">
			<h1 class="col-12 title-cate title-detail-notice"><?php echo $post->title; ?></h1>
			<div class="col-12 wr-content-notice">
				<div class="desNotice">
					<?php echo @$post->description ?>
				</div>
				<?php echo @$post->content;?>
			</div>
		</div>
		<div class="title-cate title-cate-notice-related">
			bái viết liên quan
		</div>
		<div class="main-carousel my-main-carousel-notice-related" data-flickity='{"imagesLoaded": true,"groupCells": "80%","draggable": true,"contain": true,"cellAlign": "left","pageDots":true, "autoPlay": true, "autoPlay": 4000, "pauseAutoPlayOnHover": false, "prevNextButtons": false}'>
			<?php
			if (!empty($otherPosts)) {
				foreach ($otherPosts as $key => $value) { 
				echo'<div class="carousel-cell my-carousel-cell-notice-related">
	  				<a href="/'.@$item->slug.'.html">
	  					<img src="'.@$item->image.'" alt="">
		  				<p class="title-notice-related">'.@$item->title.'</p>
	  				</a>
	  				<p><a href="/'.@$item->slug.'.html" class="notice-show-more notice-show-more-related" href="">Xem thêm <i class="fas fa-long-arrow-alt-right"></i></a></p>
	  			</div>';
				
				}
			}
			?>
		</div>
	</div>


<?php
getFooter();
?>