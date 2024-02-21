<?php
getHeader();
global $urlThemeActive;

$setting = setting();

?>

	<div class="container-fluid set-pd-0 banner">
		<img src="<?php echo @$setting['banner1'] ?>" alt="">
	</div>
	<div class="container">
		<!-- <h1 class="title-cate">SẢN PHẨM CỦA LIGI DOCTOR CLINIC</h1> -->
		<form action="/search-product" id="filterCateProduct">
			<?php if(isset($_GET['key']) && !empty($_GET['key'])) { ?>
				<input style="display:none" type="text" name="key" <?php echo isset($_GET['key']) && !empty($_GET['key'])?'value="'.$_GET['key'].'"':''; ?> >
			<?php
			} ?>
			<select name="category" id="">
				<option value="">Tất cả sản phẩm</option>
				<?php if(!empty($listCate = getCategorieProduct())) {
					foreach ($listCate as $key => $value) { ?>
						<option <?php echo !empty($_GET['category']) && $_GET['category']==$value->id?'selected':''; ?> value="<?php echo $value->id ?>"><?php echo $value->name ?></option>
					<?php
					}
				} ?>
			</select>
			<select name="price" id="">
				<option value="">Giá sản phẩm</option>
				<option <?php echo !empty($_GET['price']) && $_GET['price']=='0;100000'?'selected':''; ?>  value="0;100000">0 VNĐ - 100.000 VNĐ</option>
				<option <?php echo !empty($_GET['price']) && $_GET['price']=='100001;500000'?'selected':''; ?> value="100001;500000">100.000 VNĐ - 500.000 VNĐ</option>
				<option <?php echo !empty($_GET['price']) && $_GET['price']=='500001;1000000'?'selected':''; ?> value="500001;1000000">500.000 VNĐ - 1.000.000 VNĐ</option>
				<option <?php echo !empty($_GET['price']) && $_GET['price']=='1000000'?'selected':''; ?> value="1000000">trên 1.000.000</option>
			</select>
			<button type="submit">Lọc</button>
		</form>
	</div>

	<div class="container">
		<div class="row">
			<?php  if(!empty($list_product)){
                    	foreach ($list_product as $product) {
                    	    $link = '/san-pham/'.$product->slug.'.html';
					echo'<div class="col-6 col-sm-6 col-md-4 col-lg-3 item-product">
						<a href="'.$link.'">
							<div class="box-bd-product">
								<img src="'.$product->image.'" alt="">
							</div>
			  				<center>'.$product->title.'</center>
			  				<center class="price">'.number_format($product->price).' VNĐ</center>
						</a>
		  				<center class="add-cart"><a class="add-cart-button"  href="'.$link.'">Thêm vào giỏ hàng <span class="messAdd">Đã thêm vào giỏ</span></a></center>
					</div>';
				
				}
			} ?>
		</div>
		<!-- post pagination -->
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