<?php getHeader();
	global $themecauchuyencuatoi;
?>

	<section class="" id="">
		<div class="title_bg text-center">
			<h1 class="rs">Câu chuyện của tôi</h3>
			<ul class="list-inline rs">
				<li class="list-inline-item"><a href="/">Trang chủ</a></li>
				<li class="list-inline-item"><i class="fa fa-angle-right" aria-hidden="true"></i></li>
				<li class="list-inline-item">Câu chuyện của tôi</li>
			</ul>
		</div>
		<div class="container">
			<div class="cart_main mt_20">
				<?php echo @$themecauchuyencuatoi['Option']['value']; ?>
			</div>
		</div>
	</section>
<?php getFooter(); ?>