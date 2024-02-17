<?php getHeader();
global $themeSetting;
?>
	<div class="container-fluid set-pd-0 banner">
		<img src="<?php echo @$themeSetting['Option']['value']['bannerSystem'] ?>" alt="">
	</div>

	<div class="container wr-list-system">
		<div class="path path-system">
			<a href="/">TRANG CHỦ</a> / <span>HỆ THỐNG ĐẠI LÝ</span>
		</div>
		<h1 class="title-cate title-system">
			CHUỖI HỆ THỐNG THẨM MỸ VIỆN DOCTOR LIGI CLINIC
		</h1>
		<?php 
		if(!empty($tmpVariable['data'])) {
		foreach ($tmpVariable['data'] as $key => $value) { 
			if (!empty($value['listData'])) { ?>
			<div class="row mg">
				<div class="col-12 title-cate title-cate-system"><?php echo $value['name'] ?></div>
				<?php 
				if (!empty($value['listData'])) {
					foreach ($value['listData'] as $key2 => $value2) { ?>
				<div class="col-6 col-sm-6 col-md-4 item-system">
					<div class="box-img-system">
						<img src="<?php echo $value2['localBusinessSystem']['image'] ?>" alt="">
						<p>Hệ thống tại<br><span><?php echo $value['name'] ?></span></p>
					</div>
					<div class="box-list-system">
						<p class="item-title-system"><img src="<?php echo $urlThemeActive ?>assets/images/SystemIconTitle.png" alt=""><?php echo $value2['localBusinessSystem']['name'] ?></p>
						<div class="item-info-system">
							<p><img src="<?php echo $urlThemeActive ?>assets/images/contactIconPing.png" alt=""><?php echo $value2['localBusinessSystem']['name'] ?></p>
							<p class="box-item-contact"><a class="btn-contact" href="<?php echo $value2['localBusinessSystem']['facebook'] ?>">FACEBOOK</a><a class="btn-contact" href="<?php echo $value2['localBusinessSystem']['zalo'] ?>">ZALO</a></p>
							<p><a href="" title="">HOTLINE: <?php echo $value2['localBusinessSystem']['phone'] ?></a></p>
						</div>
					</div>
				</div>
			<?php } } ?>
			</div>
			<?php
			} 
		} 
		} ?>
	</div>
<?php getFooter() ?>