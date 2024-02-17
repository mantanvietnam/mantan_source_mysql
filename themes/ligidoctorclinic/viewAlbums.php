<?php getHeader()?>
<style>
	.wr-feedback {
		margin-top: 40px;
	}
</style>

<link rel="stylesheet" href="<?php echo $urlThemeActive;?>assets/lib/cube/unite-gallery.css">

<div class="container" >
	<h1 class="title-cate">Hình ảnh feedback của khách hàng</h1>
	<div class="container wr-feedback">
		<div id="gallery" style="display:none;">
			<?php
			$dem =0;
			if (isset($infoAlbum['Album']['img'])) {
				foreach ($infoAlbum['Album']['img'] as $img) {
					$dem ++;
					?>
					<a href="<?php echo $img['src']; ?>" >
						<img src="<?php echo $img['src']; ?>" alt="img"  style="display:none" >
					</a>
				<?php }
			}?>

		</div>
	</div>
</div>

<?php getFooter()?>
<script type='text/javascript' src="<?php echo $urlThemeActive;?>assets/lib/cube/unitegallery.min.js"></script>
<script type='text/javascript' src="<?php echo $urlThemeActive;?>assets/lib/cube/ug-theme-tiles.js"></script>
<script type="text/javascript">

	jQuery(document).ready(function(){

		jQuery("#gallery").unitegallery();

	});

</script>