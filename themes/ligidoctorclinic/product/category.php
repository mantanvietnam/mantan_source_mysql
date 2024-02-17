<?php getHeader();
global $urlHomes;
?>
	<div class="container-fluid set-pd-0 banner">
		<img src="images/banner.png" alt="">
	</div>
	<div class="container">
		<form action="" id="filterCateProduct">
			<select name="" id="">
				<option value="">Danh mục sản phẩm</option>
				<?php if(!empty($listCate = getListCategory())) {
					foreach ($listCate['Option']['value']['category'] as $key => $value) { ?>
						<option value="<?php echo $value['id'] ?>"><?php echo $value['name'] ?></option>
					<?php
					}
				} ?>
			</select>
			<select name="" id="">
				<option value="">Giá sản phẩm</option>
				<option value="">0 - 100.000</option>
				<option value="">100.000 - 500.000</option>
				<option value="">500.000 - 1.000.000</option>
			</select>
			<button type="submit">Lọc</button>
		</form>
	</div>

	<div class="container">
		<div class="row">
			<?php if(!empty($tmpVariable['listData'])) {
				foreach ($tmpVariable['listData'] as $key => $value) { ?>
					<div class="col-6 col-sm-6 col-md-4 col-lg-3 item-product">
						<a href="<?php echo $urlHomes.'product/'.@$value['Product']['slug'].'.html' ?>">
							<div class="box-bd-product">
								<img src="<?php echo @$value['Product']['images'][0] ?>" alt="">
							</div>
			  				<center><?php echo @$value['Product']['title'] ?></center>
			  				<center class="price"><?php echo @number_format($value['Product']['price']) ?> VNĐ</center>
						</a>
		  				<center class="add-cart"><button class="add-cart-button" onclick="addToCart('<?php echo @$value['Product']['id'] ?>')">Thêm vào giỏ hàng</button></center>
					</div>
				<?php
				}
			} ?>
		</div>
		<!-- post pagination -->

		<?php

		$page = $tmpVariable['page'];
		$totalPage = $tmpVariable['totalPage'];
		$startPage = $tmpVariable['headPage'];
		$endPage = $tmpVariable['endPage'];
		$back = $tmpVariable['back'];
		$next = $tmpVariable['next'];
		$urlPage = $tmpVariable['urlPage'];
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

	<div class="container">
		<div class="row">
			<div class="col-6 img-cate-bot">
				<img src="images/ImgCateBot1.png" alt="">
			</div>
			<div class="col-6 img-cate-bot">
				<img src="images/ImgCateBot2.png" alt="">
			</div>
		</div>
	</div>

<?php getFooter() ?>