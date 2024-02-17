<?php getHeader();
global $urlHomes;
global $themeSetting;
$listCate = getListCategory();
?>
	<div class="container-fluid set-pd-0 banner">
		<img src="<?php echo @$themeSetting['Option']['value']['bannerProduct'] ?>" alt="">
	</div>
	<div class="container">
		<h1 class="title-cate">SẢN PHẨM CỦA LIGI DOCTOR CLINIC</h1>
		<form action="/search" id="filterCateProduct">
			<?php if(isset($_GET['key']) && !empty($_GET['key'])) { ?>
				<input style="display:none" type="text" name="key" <?php echo isset($_GET['key']) && !empty($_GET['key'])?'value="'.$_GET['key'].'"':''; ?> >
			<?php
			} ?>
			<select name="category" id=""  onchange="loadCate(this)">
				<option value="tat-ca-san-pham">Danh mục sản phẩm</option>
				<?php if(!empty($listCate)) {
					foreach ($listCate as $key => $value) { ?>
						<option <?php echo !empty($_GET['category']) && $_GET['category']==$value['MerchandiseGroup']['id']?'selected':''; ?> value="<?php echo @$value['MerchandiseGroup']['urlSlug'] ?>"><?php echo $value['MerchandiseGroup']['name'] ?></option>
					<?php
					}
				} ?>
			</select>
			<!-- <button type="submit">Lọc</button> -->
		</form>
	</div>

	<div class="container">
		<div class="row">
			<?php if(!empty($tmpVariable['listData'])) {
				foreach ($tmpVariable['listData'] as $key => $value) { ?>
					<div class="col-6 col-sm-6 col-md-4 col-lg-3 item-product">
						<a href="<?php echo $urlHomes.'product/'.@$value['Merchandise']['urlSlug'].'.html' ?>">
							<div class="box-bd-product">
								<img src="<?php echo @$value['Merchandise']['image'] ?>" alt="">
							</div>
			  				<center><?php echo @$value['Merchandise']['name'] ?></center>
			  				<center class="price"><?php echo @number_format($value['Merchandise']['price']) ?> VNĐ</center>
						</a>
		  				<center class="add-cart"><button class="add-cart-button" data-sku="<?php echo @$value['Merchandise']['code'] ?>" onclick="addToCart(this, '<?php echo @$value['Merchandise']['id'] ?>')">Thêm vào giỏ hàng <span class="messAdd">Đã thêm vào giỏ</span></button></center>
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


<?php getFooter();
?>
<script type="text/javascript">
  function loadCate(e) {
    var slugCate = $(e).val();
    if(slugCate=='tat-ca-san-pham'){
      window.location="<?php echo $urlHomes ?>allProduct/";
    }else {
      window.location="<?php echo $urlHomes ?>cat/"+slugCate+".html";
    }
  }
</script>