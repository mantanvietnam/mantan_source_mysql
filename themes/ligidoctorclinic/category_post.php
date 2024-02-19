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
		<div  class="page-pagination">
			<ul class="page-pagination__list">

				<?php
				if (@$totalPage > 0) {
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

					echo '<li class="page-pagination__item">
					<a class="page-pagination__link" href="' . $urlPage . '1"><i class="fa fa-arrow-left"></i></a>
					</li>';

					for ($i = $startPage; $i <= $endPage; $i++) {
						$active = ($page == $i) ? 'active' : '';

						echo '<li class="page-pagination__item ">
						<a class="page-pagination__link ' . $active . '" href="' . $urlPage . $i . '">' . $i . '</a>
						</li>';
					}

					echo '<li class="page-pagination__item last">
					<a class="page-pagination__link" href="' . $urlPage . $totalPage . '"
					><i class="fa fa-arrow-right"></i
					></a>
					</li>';
				}
				?>
			</ul>
		</div>
	</div>
<?php getFooter(); ?>