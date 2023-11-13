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
															<a href="javascript:void(0);" onclick="addToCartBackStore('.$value->product_id.');">Trả hàng</a>
															<p class="text-danger text-center mt-2" id="mess-'.$value->product_id.'">'.number_format($value->price).'đ</p>
														</div>
													</li>
												</ul>
											</div>
										</div>';
							}

							echo '<div class="btn-main text-center"><a href="/userCartBackStore">XEM GIỎ HÀNG</a></div>';
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

<script type="text/javascript">
	function addToCartBackStore(product_id) {
		$.ajax({
		  	method: "POST",
		  	url: "/apis/addToCartBackStore",
		  	data: { product_id: product_id }
		})
		.done(function( msg ) {
			if(msg.code == 1){
				$('#mess-'+product_id).html('Đã thêm giỏ hàng');
			}
		});
	}
</script>

<?php include __DIR__.'/../footer.php';?>