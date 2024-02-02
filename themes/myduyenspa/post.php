<?php getHeader();?>

	<section class="" id="">
		<div class="title_bg text-center">
			<h1 class="rs"><?php echo $post->title; ?></h3>
			<ul class="list-inline rs">
				<li class="list-inline-item"><a href="/">Trang chủ</a></li>
				<li class="list-inline-item"><i class="fa fa-angle-right" aria-hidden="true"></i></li>
				<li class="list-inline-item"><a href="/tin-tuc.html">Tin tức</a></li>
				<!-- <li class="list-inline-item"><i class="fa fa-angle-right" aria-hidden="true"></i></li> -->
				<!-- s<li class="list-inline-item"><?php echo $post->title; ?></li> -->
			</ul>
		</div>
		<div class="container">
			<div class="cart_main mt_20">
				<?php echo $post->content; ?>
			</div>
		</div>
	</section>
<?php getFooter(); ?>