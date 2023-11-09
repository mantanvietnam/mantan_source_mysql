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
				<div class="title text-center">
					<span>Đơn hàng của khách</span>
					<svg width="1182" height="58" viewBox="0 0 1182 58" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M1181.45 57.9501H0.28125V46.8002C0.28125 21.1802 21.0513 0.410156 46.6713 0.410156H1135.05C1160.67 0.410156 1181.44 21.1802 1181.44 46.8002V57.9501H1181.45Z" fill="#1A3A89"/>
					</svg>
				</div>
				<div class="content-cart">
					<div class="table-cart">
						<?php
							echo $mess;
							if(!empty($infoCart)){
								foreach ($infoCart as $key => $value) {
									
									echo '	<div class="item-cart">
												<div class="prd-cart">
													<div class="avarta">
														<div class="avr"><a href="/viewOrderCombo/?id='.$value->id.'"><img src="'.$value->image.'" class="img-fluid w-100" alt=""></a></div>
													</div>
													<div class="info">
														<h3><a class="text-danger" href="/viewOrderCombo/?id='.$value->id.'">'.$value->name.'</a></h3>';
														if(!empty($value->list_product)){
															echo '<ul>';
															foreach ($value->list_product as $product) {
																echo '<li>'.$product->name.' ('.$product->amount_combo.')</li>';
															}
															echo '</ul>';
														}
									echo			'</div>
												</div>
												<div class="price text-center">'.number_format($value->price).'đ</div>
												<div class="checkbox-cart text-center">
													x '.$value->amount.'
												</div>
											</div>';

								}
							}
						?>
					</div>

					<?php if(!empty($infoCart)) echo '<div class="btn-main text-center"><a href="/createOrderComboUser">TẠO ĐƠN</a></div>';?>
					
				</div>
			</div>
		</div>
	</section>
</main>

<?php include __DIR__.'/../footer.php';?>