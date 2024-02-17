<?php getHeader();
?>
<div class="container">
		<div class="path path-cateNotice">
			<a href="/">TRANG CHỦ</a> / <span ><?php echo $category['name'] ?></span>
		</div>
		<h1 class="title-cate title-cate-notice">
			<?php echo $category['name'] ?>
		</h1>
		<div class="row">
			 <?php if (!empty($listPosts)) {
                        foreach ($listPosts as $item) { ?>
				<div class="col-6 col-sm-6 col-md-4 item-notice">
					<a href="/<?php echo @$item->slug ?>.html">
	  					<img src="<?php echo @$item->image ?>" alt="">
		  				<p class="title-item-notice"><?php echo @$item->title; ?></p>
	  				</a>
	  				<p><a class="item-notice-show-more" href="/<?php echo @$item->slug ?>.html">Xem thêm <i class="fas fa-long-arrow-alt-right"></i></a></p>
				</div>
				<?php
				}
			} ?>
		</div>
		<?php
			if ($page > 5) {
			$startPage = $page - 5;
			} else {
				$startPage = 1;
			}

			if ($totalPage > $page + 5) {
				$endPage = $page + 5;
			} else {
				$endPage = $totalPage;
			}

			if($totalPage>1){
				?>
				<div class="page-pagination">
					<ul class="page-pagination__list">
						<li class="page-pagination__item"><a class="page-pagination__link"  href="<?php echo $urlPage . $back ?>"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
						</li>
						<?php
						if(($page - 5)>1) { ?>
							<li class="page-pagination__item"><a class="page-pagination__link"  href="javascript:void(0);">...</a>
							</li>
						<?php	
						} ?>
						<?php for ($i = $startPage; $i <= $endPage; $i++) { ?>
							<li class="page-pagination__item"><a class="page-pagination__link <?php echo $i==$page?'active" ':'" href="'.$urlPage.$i.'"' ?>"><?php echo $i; ?></a></li>
							<?php 
						} ?>
						<?php
						if(($page + 5)<$totalPage) { ?>
							<li class="page-pagination__item"><a class="page-pagination__link"  href="javascript:void(0);">...</a>
							</li>
						<?php	
						} ?>
						<li class="page-pagination__item"><a class="page-pagination__link"  href="<?php echo $urlPage . $next ?>"><i class="fa fa-arrow-right" aria-hidden="true"></i></a>
						</li>
					</ul>
				</div>
			<?php } ?>
	</div>
<?php getFooter(); ?>