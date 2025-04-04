<?php include __DIR__.'/../header.php';?>

<style>
	footer {
		display: none;
	}
	main {
		overflow: hidden;
	}
</style>
<main>
	<section class="box-gallery">
		<div class="container">
			<div class="content-detail-gallery detail-cart">
				<div class="title text-center" style="display: flex;">
					<span>Kho hàng</span>
					<svg width="1182" height="58" viewBox="0 0 1182 58" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M1181.45 57.9501H0.28125V46.8002C0.28125 21.1802 21.0513 0.410156 46.6713 0.410156H1135.05C1160.67 0.410156 1181.44 21.1802 1181.44 46.8002V57.9501H1181.45Z" fill="#1A3A89"/>
					</svg>
				</div>
				<div class="content-cart" style="background: #00345E">
					<div class="table-cart">
						<?php
						if(!empty($listData)){
							foreach ($listData as $key => $value) { 	
								echo '	<div class="item-cart item-cart-sale order-manager">
											<div class="prd-cart">
												<div class="avarta">
													<div class="avr"><a href="javascript:void(0);"><img src="'.$listProduct[$value->product_id]->image.'" class="img-fluid w-100" alt=""></a></div>
												</div>
												<div class="info">
													<h3><a href="javascript:void(0);" class="name-sale">'.$listProduct[$value->product_id]->name.'</a></h3>
													<ul>
														<li><a href="javascript:void(0);">Tồn kho: '.number_format($value->amount).'</a></li>
													</ul>
												</div>
											</div>
											<div class="btn-order">
												<ul>
													<li>
														<div class="btn-order">
															<form action="/addToCartUser" method="post">
																<input type="hidden" name="_csrfToken" value="'.$csrfToken.'" />
																<input type="hidden" value="'.$value->product_id.'" name="product_id" />
																<input class="mb-3" style="width: 70px;" type="number" value="1" min="1" max="" name="amount" />
																<button type="submit" class="btn btn-primary">Thêm giỏ hàng</button>
															</form>

															<p class="text-danger text-center mt-2" id="mess-'.$value->product_id.'">'.number_format($value->price).'đ</p>
														</div>
													</li>
												</ul>
											</div>
										</div>';
							}

							//echo '<div class="btn-main text-center"><a href="/userCart">XEM GIỎ HÀNG</a></div>';
						}else{
							echo '<p class="text-danger">Trong kho đã hết hàng</p>';
						}
						?>
					</div>
				</div>
			</div>
		</div>
	</section>
</main>


<?php include __DIR__.'/../footer.php';?>