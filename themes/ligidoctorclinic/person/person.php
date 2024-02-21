<?php getHeader();

$setting = setting();
?>
	<div class="container-fluid set-pd-0 banner">
		<img src="<?php echo @$setting['banner1'] ?>" alt="">
	</div>

	<div class="container wr-list-system">
		<div class="path path-system">
			<a href="/">TRANG CHỦ</a> / <span>HỆ THỐNG ĐẠI LÝ</span>
		</div>
		<h1 class="title-cate title-system">
			CHUỖI HỆ THỐNG HỆ THỐNG ĐẠI LÝ
		</h1>
		<?php 

		if(!empty($listData)) {
		foreach($listData as $key => $value) { 
			if (!empty($value->person)) { ?>
			<div class="row mg">
				<div class="col-12 title-cate title-cate-system"><?php echo $value->name ?></div>
				<?php 
					foreach ($value->person as $item) { ?>
				<div class="col-6 col-sm-6 col-md-4 item-system">
					<div class="box-img-system">
						<img src="<?php echo $item->image ?>" alt="">
						<p>Hệ thống tại<br><span><?php echo @$value->name ?></span></p>
					</div>
					<div class="box-list-system">
						<p class="item-title-system"><img src="<?php echo $urlThemeActive ?>assets/images/SystemIconTitle.png" alt=""><?php echo @$item->name ?></p>
						<div class="item-info-system">
							<p><img src="<?php echo $urlThemeActive ?>assets/images/contactIconPing.png" alt=""><?php echo @$item->address ?></p>
							<p class="box-item-contact"><a class="btn-contact" href="<?php echo @$item->facebook ?>">FACEBOOK</a><a class="btn-contact" href="<?php echo @$item->zalo; ?>">ZALO</a></p>
							<p><a href="" title=""><i class="fa-solid fa-phone"></i> <?php echo $item->phone ?></a></p>
						</div>
					</div>
				</div>
			<?php } ?>
			</div>
			<?php
			} 
		} 
		} ?>
	</div>
<?php getFooter() ?>