<?php global $urlThemeActive;
$setting = setting();?>
	<div class="container-fluid set-pd-0 footer">
		<div class="container">
			<div class="row">
				<div class="offset-lg-1 col-12 col-sm-12 col-md-12 col-lg-10 wr-logo-foter">
					<img src="<?php echo @$setting['image_logo'] ?>" alt="">
				</div>
			</div>
			<div class="row text-footer row-mobile-reverse">
				<div class="offset-lg-1 col-sm-12 col-md-12 col-lg-7">
					
					<!-- <?php echo @$setting['contentFooterIndex'] ?> -->
					<p class="va_thongtin"><?php echo @$setting['company'] ?></p>
					<p class="va_dia_chi">Dịa chỉ <?php echo @$setting['address'] ?></p>
					<p>Hotline: <a class="so_dien_thoai" ><?php echo @$setting['hotline'] ?></a></p>
					<p class="va_facebook"><a class="so_dien_thoai" href="<?php echo @$setting['link_facebook']?>" > <?php echo @$setting['facebook']?> </p>
				</div>
				<div class="col-sm-12 col-md-12 col-lg-3">
					<?php 
					$linkweb = getListLinkWeb(@$setting['id_linkweb']);
					if(!empty($linkweb)) {
						foreach ($linkweb as $key => $value) {
							echo'<p><a href="<?php echo @$value->link ?>">'.@$value->name.'</a></p>';
						
						}
					} ?>
				</div>
			</div>
			<div class="row license">
				<div class="col-12">
					<center> <?php echo @$setting['textfooter'] ?></center>
				</div>
			</div>
		</div>
	</div>
	<div class="wr-fix-conact">
		<div class="box-hotline-fix">
			<a href="tel:<?php echo @$setting['hotline'] ?>">
				<img src="<?php echo $urlThemeActive ?>/assets/images/Hotline.png" alt="">
				<span><?php echo @$setting['hotline'] ?></span>
			</a>
		</div>
		<div class="box-chat-fix">
			<a href="<?php echo @$setting['chat'] ?>">
				<img src="<?php echo $urlThemeActive ?>/assets/images/Chat.png" alt="">
				<span>CHAT NGAY</span>
			</a>
		</div>
		<div class="box-set-order">
			<a href="javascript:void(0);" data-toggle="modal" data-target="#modalSetOrder">
				<img src="<?php echo $urlThemeActive ?>/assets/images/set1.png" alt="">
				<span>ĐẶT HẸN</span>
			</a>
		</div>
	</div>

</body>


<script src="<?php echo $urlThemeActive ?>assets/lib/jquery/jquery-3.2.1.js"></script>
<script src="<?php echo $urlThemeActive ?>assets/lib/flickity-docs/flickity.pkgd.min.js"></script>
<script src="<?php echo $urlThemeActive ?>assets/lib/bootstrap-4.3.1-dist/bootstrap-4.3.1-dist/js/bootstrap.js"></script>
<script src="<?php echo $urlThemeActive ?>assets/lib/fanciybox/package/dist/fancybox.umd.js"></script>
<script src="<?php echo $urlThemeActive ?>assets/lib/fanciybox/package/dist/carousel.umd.js"></script>
<script src="<?php echo $urlThemeActive ?>assets/lib/fontawesome-free-5.15.1-web/js/all.js"></script>
<script src="<?php echo $urlThemeActive ?>assets/lib/grid-gallery-master/js/grid-gallery.js"></script>
<script src="<?php echo $urlThemeActive ?>assets/lib/jQuery-Plugin-For-Responsive-Justified-Image-Gallery-Justified/imagesloaded.pkgd.min.js"></script>
<script src="<?php echo $urlThemeActive ?>assets/lib/jQuery-Plugin-For-Responsive-Justified-Image-Gallery-Justified/dist/js/justified.js"></script>

<script src="<?php echo $urlThemeActive ?>assets/js/js.js"></script>

</html>