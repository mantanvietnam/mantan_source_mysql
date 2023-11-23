<?php getHeader();global $settingThemes;?>

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
					<span>Thông tin ảnh</span>
					<svg width="1182" height="58" viewBox="0 0 1182 58" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M1181.45 57.9501H0.28125V46.8002C0.28125 21.1802 21.0513 0.410156 46.6713 0.410156H1135.05C1160.67 0.410156 1181.44 21.1802 1181.44 46.8002V57.9501H1181.45Z" fill="#1A3A89"/>
					</svg>
				</div>
				<div class="content-gallery-detail">
					<div class="row">
						<div class="col-md-6">
							<div class="avar-detail">
								<div class="avr"><img src="<?php echo $infoImage->image;?>" class="img-fluid w-100" alt=""></div>
							</div>
							<div class="title-detail">
								<div class="content-head-title">
									<h1><?php echo $infoImage->name;?></h1>
									<div class="price"><?php echo number_format($infoImage->vote);?> like</div>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="txt-detail-gallery">
								<div class="detail">
									<div class="top-detail">
										<?php echo nl2br($infoImage->description);?>
									</div>

									<div class="social text-right">
										<div class="btn-main">
											<?php 
											if(empty($checkLike)){
												echo '<a id="orderButton" href="/addLike/?id='.$infoImage->id.'">THÍCH ẢNH NÀY</a>';
											}
											?>
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

<?php getFooter();?>