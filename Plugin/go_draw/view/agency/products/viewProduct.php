<?php include __DIR__.'/../header.php';?>

<style>
	footer {
		display: none;
	}
	@media (max-width: 767px) {
		.view-all {
			display: none;
		}
	}
</style>
<main>
	<section class="box-gallery">
		<div class="container">
			<div class="content-detail-gallery">
				<div class="title text-center">
					<span>Thông tin sản phẩm</span>
					<svg width="1182" height="58" viewBox="0 0 1182 58" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M1181.45 57.9501H0.28125V46.8002C0.28125 21.1802 21.0513 0.410156 46.6713 0.410156H1135.05C1160.67 0.410156 1181.44 21.1802 1181.44 46.8002V57.9501H1181.45Z" fill="#1A3A89"/>
					</svg>
				</div>
				<div class="content-gallery-detail">
					<div class="row">
						<div class="col-md-6">
							<div class="avar-detail">
								<div class="avr"><img src="<?php echo $infoProduct->image;?>" class="img-fluid w-100" alt=""></div>
							</div>
							<div class="title-detail">
								<div class="content-head-title">
									<h1><?php echo $infoProduct->name;?></h1>
									<div class="price"><?php echo number_format($infoProduct->price);?>đ</div>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="txt-detail-gallery">
								<div class="detail">
									<div class="top-detail">
										<h2>Thông tin sản phẩm</h2>
										<div class="desc">
											<div class="row">
												<div class="col-md-12">
													<?php echo $infoProduct->description;?>
												</div>
												<div class="col-md-12">
													<label>Số lượng</label>
													<input onchange="updateAmount();" class="text-center" type="number" name="amount" id="amount" value="1" style="width: 50px;" />
												</div>
											</div>
										</div>
									</div>
									<div class="social text-right">
										<div class="btn-main">
											<a id="orderButton" href="/addToCartProduct/?id=<?php echo $infoProduct->id;?>&amount=1">ĐẶT MUA</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</main>

<script type="text/javascript">
	function updateAmount()
	{
		var amount = parseInt($('#amount').val());
		var idCombo = '<?php echo $infoProduct->id;?>';

		$('#orderButton').attr('href', '/addToCartProduct/?id='+idCombo+'&amount='+amount)
	}
</script>

<?php include __DIR__.'/../footer.php';?>