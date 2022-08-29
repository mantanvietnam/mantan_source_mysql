<?php 
global $urlThemeActive;

include_once('header.php');
include_once('layout/menu-top.php');
?>
<main>
	<section class="box-banner">
		<div class="slide-banner">
			<div class="item-slide">
				<div class="item-banner"><img src="<?php echo $urlThemeActive;?>images/banner.jpg" class="img-fluid w-100" alt=""></div>
			</div>
			<div class="item-slide">
				<div class="item-banner"><img src="<?php echo $urlThemeActive;?>images/banner.jpg" class="img-fluid w-100" alt=""></div>
			</div>
			<div class="item-slide">
				<div class="item-banner"><img src="<?php echo $urlThemeActive;?>images/banner.jpg" class="img-fluid w-100" alt=""></div>
			</div>
		</div>
	</section>
	<section class="box-card-top">
		<div class="container">
			<ul>
				<li onclick="loadDataUrl('/createTemplate','.box-create-template');">
					<a href="javascript:void(0)"><img src="<?php echo $urlThemeActive;?>images/card-1.png" class="img-fluid" alt=""><span>Tạo mẫu mới</span></a>
				</li>

				<li><a href="javascript:void(0)"><img src="<?php echo $urlThemeActive;?>images/card-2.png" class="img-fluid" alt=""><span>Lấy mã <br>giới thiệu</span></a></li>

				<li><a href="javascript:void(0)" class="clc-checkout"><img src="<?php echo $urlThemeActive;?>images/card-3.png" class="img-fluid" alt=""><span>Nạp tiền <br>vào ví</span></a></li>

				<li><a href="javascript:void(0)" class="clc-data-list"><img src="<?php echo $urlThemeActive;?>images/card-4.png" class="img-fluid" alt=""><span>Kho tư liệu</span></a></li>
			</ul>
		</div>
	</section>
	<section class="box-product"> 
		<div class="container">
			<div class="title">
				<h2><span>Ảnh đại diện</span><img src="<?php echo $urlThemeActive;?>images/arrow-right.png" class="img-fluid" alt=""></h2>
			</div>
			<div class="list-avarta-top">
				<div class="slide-avarta">
					<?php
						for ($x = 0; $x <= 4; $x++) { ?>
						  <div class="item-slide">
							<div class="item-avarta-top">
								<div class="avarta"><a href="javascript:void(0)"><img src="<?php echo $urlThemeActive;?>images/av-1.png" class="img-fluid w-100" alt=""></a></div>
								<div class="info">
									<h3 class="text-uppercase text-center"><a href="javascript:void(0)">AVATAR ẤN TƯỢNG ĐEN GOLD (A001)</a></h3>
									<div class="price">
										<del>đ159.000</del>
										<span>đ35.000</span> 
									</div>
									<div class="bot-avr">
										<div class="left">
											<div class="heart"><img src="<?php echo $urlThemeActive;?>images/heart.png" class="img-fluid" alt=""></div>
										</div>
										<div class="right">
											<div class="star">
												<ul>
													<li><img src="<?php echo $urlThemeActive;?>images/star.png" class="img-fluid" alt=""></li>
													<li><img src="<?php echo $urlThemeActive;?>images/star.png" class="img-fluid" alt=""></li>
													<li><img src="<?php echo $urlThemeActive;?>images/star.png" class="img-fluid" alt=""></li>
													<li><img src="<?php echo $urlThemeActive;?>images/star.png" class="img-fluid" alt=""></li>
													<li><img src="<?php echo $urlThemeActive;?>images/star-o.png" class="img-fluid" alt=""></li>
													<li><span>Đã bán 20 mẫu</span></li>
												</ul>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php }
					?>
				</div>
			</div>
		</div>
	</section>
	<section class="box-product">
		<div class="container">
			<div class="title">
				<h2><span>Ảnh bìa trang cá nhân</span><img src="<?php echo $urlThemeActive;?>images/arrow-right.png" class="img-fluid" alt=""></h2>
			</div>
			<div class="list-avarta-top">
				<div class="slide-product">
					<?php
						for ($x = 0; $x <= 4; $x++) { ?>
						  <div class="item-slide">
							<div class="item-avarta-top">
								<div class="avarta"><a href="javascript:void(0)"><img src="<?php echo $urlThemeActive;?>images/prd-2.png" class="img-fluid w-100" alt=""></a></div>
								<div class="info">
									<h3 class="text-uppercase text-center"><a href="javascript:void(0)">AVATAR ẤN TƯỢNG ĐEN GOLD (A001)</a></h3>
									<div class="price">
										<del>đ159.000</del>
										<span>đ35.000</span> 
									</div>
									<div class="bot-avr">
										<div class="left">
											<div class="heart"><img src="<?php echo $urlThemeActive;?>images/heart.png" class="img-fluid" alt=""></div>
										</div>
										<div class="right">
											<div class="star">
												<ul>
													<li><img src="<?php echo $urlThemeActive;?>images/star.png" class="img-fluid" alt=""></li>
													<li><img src="<?php echo $urlThemeActive;?>images/star.png" class="img-fluid" alt=""></li>
													<li><img src="<?php echo $urlThemeActive;?>images/star.png" class="img-fluid" alt=""></li>
													<li><img src="<?php echo $urlThemeActive;?>images/star.png" class="img-fluid" alt=""></li>
													<li><img src="<?php echo $urlThemeActive;?>images/star-o.png" class="img-fluid" alt=""></li>
													<li><span>Đã bán 20 mẫu</span></li>
												</ul>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php }
					?>
				</div>
			</div>
		</div>
	</section>
	<section class="box-product">
		<div class="container">
			<div class="title">
				<h2><span>Banner Livestream</span><img src="<?php echo $urlThemeActive;?>images/arrow-right.png" class="img-fluid" alt=""></h2>
			</div>
			<div class="list-avarta-top">
				<div class="slide-product">
					<?php
						for ($x = 0; $x <= 4; $x++) { ?>
						  <div class="item-slide">
							<div class="item-avarta-top">
								<div class="avarta"><a href="javascript:void(0)"><img src="<?php echo $urlThemeActive;?>images/prd-1.png" class="img-fluid w-100" alt=""></a></div>
								<div class="info">
									<h3 class="text-uppercase text-center"><a href="javascript:void(0)">AVATAR ẤN TƯỢNG ĐEN GOLD (A001)</a></h3>
									<div class="price">
										<del>đ159.000</del>
										<span>đ35.000</span> 
									</div>
									<div class="bot-avr">
										<div class="left">
											<div class="heart"><img src="<?php echo $urlThemeActive;?>images/heart.png" class="img-fluid" alt=""></div>
										</div>
										<div class="right">
											<div class="star">
												<ul>
													<li><img src="<?php echo $urlThemeActive;?>images/star.png" class="img-fluid" alt=""></li>
													<li><img src="<?php echo $urlThemeActive;?>images/star.png" class="img-fluid" alt=""></li>
													<li><img src="<?php echo $urlThemeActive;?>images/star.png" class="img-fluid" alt=""></li>
													<li><img src="<?php echo $urlThemeActive;?>images/star.png" class="img-fluid" alt=""></li>
													<li><img src="<?php echo $urlThemeActive;?>images/star-o.png" class="img-fluid" alt=""></li>
													<li><span>Đã bán 20 mẫu</span></li>
												</ul>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php }
					?>
				</div>
			</div>
		</div>
	</section>
	<section class="box-product">
		<div class="container">
			<div class="title">
				<h2><span>Thư mời</span><img src="<?php echo $urlThemeActive;?>images/arrow-right.png" class="img-fluid" alt=""></h2>
			</div>
			<div class="list-avarta-top">
				<div class="slide-product">
					<?php
						for ($x = 0; $x <= 4; $x++) { ?>
						  <div class="item-slide">
							<div class="item-avarta-top">
								<div class="avarta"><a href="javascript:void(0)"><img src="<?php echo $urlThemeActive;?>images/prd-2.png" class="img-fluid w-100" alt=""></a></div>
								<div class="info">
									<h3 class="text-uppercase text-center"><a href="javascript:void(0)">AVATAR ẤN TƯỢNG ĐEN GOLD (A001)</a></h3>
									<div class="price">
										<del>đ159.000</del>
										<span>đ35.000</span> 
									</div>
									<div class="bot-avr">
										<div class="left">
											<div class="heart"><img src="<?php echo $urlThemeActive;?>images/heart.png" class="img-fluid" alt=""></div>
										</div>
										<div class="right">
											<div class="star">
												<ul>
													<li><img src="<?php echo $urlThemeActive;?>images/star.png" class="img-fluid" alt=""></li>
													<li><img src="<?php echo $urlThemeActive;?>images/star.png" class="img-fluid" alt=""></li>
													<li><img src="<?php echo $urlThemeActive;?>images/star.png" class="img-fluid" alt=""></li>
													<li><img src="<?php echo $urlThemeActive;?>images/star.png" class="img-fluid" alt=""></li>
													<li><img src="<?php echo $urlThemeActive;?>images/star-o.png" class="img-fluid" alt=""></li>
													<li><span>Đã bán 20 mẫu</span></li>
												</ul>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php }
					?>
				</div>
			</div>
		</div>
	</section>
	<section class="box-product">
		<div class="container">
			<div class="title">
				<h2><span>Banner chào đón</span><img src="<?php echo $urlThemeActive;?>images/arrow-right.png" class="img-fluid" alt=""></h2>
			</div>
			<div class="list-avarta-top">
				<div class="slide-product">
					<?php
						for ($x = 0; $x <= 4; $x++) { ?>
						  <div class="item-slide">
							<div class="item-avarta-top">
								<div class="avarta"><a href="javascript:void(0)"><img src="<?php echo $urlThemeActive;?>images/prd-1.png" class="img-fluid w-100" alt=""></a></div>
								<div class="info">
									<h3 class="text-uppercase text-center"><a href="javascript:void(0)">AVATAR ẤN TƯỢNG ĐEN GOLD (A001)</a></h3>
									<div class="price">
										<del>đ159.000</del>
										<span>đ35.000</span> 
									</div>
									<div class="bot-avr">
										<div class="left">
											<div class="heart"><img src="<?php echo $urlThemeActive;?>images/heart.png" class="img-fluid" alt=""></div>
										</div>
										<div class="right">
											<div class="star">
												<ul>
													<li><img src="<?php echo $urlThemeActive;?>images/star.png" class="img-fluid" alt=""></li>
													<li><img src="<?php echo $urlThemeActive;?>images/star.png" class="img-fluid" alt=""></li>
													<li><img src="<?php echo $urlThemeActive;?>images/star.png" class="img-fluid" alt=""></li>
													<li><img src="<?php echo $urlThemeActive;?>images/star.png" class="img-fluid" alt=""></li>
													<li><img src="<?php echo $urlThemeActive;?>images/star-o.png" class="img-fluid" alt=""></li>
													<li><span>Đã bán 20 mẫu</span></li>
												</ul>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php }
					?>
				</div>
			</div>
		</div>
	</section>
	<section class="box-product">
		<div class="container">
			<div class="title">
				<h2><span>Banner vinh danh</span><img src="<?php echo $urlThemeActive;?>images/arrow-right.png" class="img-fluid" alt=""></h2>
			</div>
			<div class="list-avarta-top">
				<div class="slide-product">
					<?php
						for ($x = 0; $x <= 4; $x++) { ?>
						  <div class="item-slide">
							<div class="item-avarta-top">
								<div class="avarta"><a href="javascript:void(0)"><img src="<?php echo $urlThemeActive;?>images/prd-2.png" class="img-fluid w-100" alt=""></a></div>
								<div class="info">
									<h3 class="text-uppercase text-center"><a href="javascript:void(0)">AVATAR ẤN TƯỢNG ĐEN GOLD (A001)</a></h3>
									<div class="price">
										<del>đ159.000</del>
										<span>đ35.000</span> 
									</div>
									<div class="bot-avr">
										<div class="left">
											<div class="heart"><img src="<?php echo $urlThemeActive;?>images/heart.png" class="img-fluid" alt=""></div>
										</div>
										<div class="right">
											<div class="star">
												<ul>
													<li><img src="<?php echo $urlThemeActive;?>images/star.png" class="img-fluid" alt=""></li>
													<li><img src="<?php echo $urlThemeActive;?>images/star.png" class="img-fluid" alt=""></li>
													<li><img src="<?php echo $urlThemeActive;?>images/star.png" class="img-fluid" alt=""></li>
													<li><img src="<?php echo $urlThemeActive;?>images/star.png" class="img-fluid" alt=""></li>
													<li><img src="<?php echo $urlThemeActive;?>images/star-o.png" class="img-fluid" alt=""></li>
													<li><span>Đã bán 20 mẫu</span></li>
												</ul>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php }
					?>
				</div>
			</div>
		</div>
	</section>

	<section class="boxShow box-data-pol">
		<?php include_once('layout/list_store.php');?>
	</section>

	<section class="boxShow box-detail-product">
		<?php include_once('layout/detail_template.php');?>
	</section>

	<section class="boxShow box-money">
		<?php include_once('layout/account.php');?>
	</section>

	<section class="boxShow box-account"></section>
	<section class="boxShow box-create-template"></section>
	
</main>

<script type="text/javascript">
	<?php 
		global $csrfToken;
		echo 'var csrfToken= \''.$csrfToken.'\';';
	?>
</script>

<?php include 'layout/menu.php';?>
<?php include 'footer.php';?>