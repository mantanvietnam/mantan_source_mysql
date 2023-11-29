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
		<div class="detail-page">
			<div class="content-detail-gallery">
				<!-- <div class="title text-center">
					<span>Thông tin ảnh</span>
					<svg width="1182" height="58" viewBox="0 0 1182 58" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M1181.45 57.9501H0.28125V46.8002C0.28125 21.1802 21.0513 0.410156 46.6713 0.410156H1135.05C1160.67 0.410156 1181.44 21.1802 1181.44 46.8002V57.9501H1181.45Z" fill="#1A3A89"/>
					</svg>
				</div> -->
				<div class="content-gallery-detail">
					<div class="row">
						<div class="col-md-9 detail-image-left">
							<div class="avar-detail">
								<div class="avr">
									<img src="<?php echo $infoImage->image;?>" class="img-fluid w-100" alt="">
									<div class="like-imageDetail">
										<?php 
										if(empty($checkLike)){
											echo '
											<div class="heart">
												<div class="icon">
													<a id="orderButton" href="/addLike/?id='.$infoImage->id.'"><img src="/themes/godraw/images/heart.svg" class="img-fluid" alt=""></a>
												</div>
											</div>
											';
										}
										?>
									</div>
								</div>
							</div>

							
							<!-- <div class="title-detail">
								<div class="content-head-title">
									<div class="price"><?php echo number_format($infoImage->vote);?> like</div>
								</div>
							</div> -->
						</div>
						<div class="col-md-3 detail-image-right">
							<div class="txt-detail-gallery">
								<div class="detail">
									<div class="box-top-detail">
										<h1><?php echo $infoImage->name;?></h1>


										<div class="top-detail">
											<?php echo nl2br($infoImage->description);?>
										</div>
									</div>
								

									<div class="social text-right">
										<div class="content-head-title">
											<div class="price"><?php echo number_format($infoImage->vote);?> like</div>
										</div>
										<div class="social row">
											<ul>
												
												<li>
													<a href="mailto:info@godraw.vn?subject=<?php echo $infoImage->name;?>&body=Link trang: <?php echo $urlHomes.$urlCurrent;?>" class="text-white">
														<i class="fa-regular fa-envelope"></i>
													</a>
												</li>

												<li>
													<a href="https://pinterest.com/pin/create/button/?url=<?php echo urlencode($urlHomes.$urlCurrent);?>" class="text-white">
														<i class="fa-brands fa-pinterest"></i>
													</a>
												</li>

												<li>
													<a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode($urlHomes.$urlCurrent);?>" class="text-white">
														<i class="fa-brands fa-linkedin"></i>
													</a>
												</li>
												
												
												<li>
													<a class="text-white" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode($urlHomes.$urlCurrent);?>" target="_blank" rel="noopener">
														<i class="fa-brands fa-facebook"></i>
													</a>
												</li>
												
												<li>
													<a class="text-white" href="http://twitter.com/share?url=<?php echo urlencode($urlHomes.$urlCurrent);?>" target="_blank">
														<i class="fa-brands fa-twitter"></i>
													</a>
												</li>
												
												<li>
													<a class="text-white" href="https://telegram.me/share/url?url=<?php echo urlencode($urlHomes.$urlCurrent);?>" target="_blank">
														<i class="fa-brands fa-telegram"></i>
													</a>
												</li>

												<li>
													<a class="text-white" href="https://tumblr.com/widgets/share/tool?canonicalUrl=<?php echo urlencode($urlHomes.$urlCurrent);?>" target="_blank">
														<i class="fa-brands fa-tumblr"></i>
													</a>
												</li>
											</ul>
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