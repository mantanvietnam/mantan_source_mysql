<?php getHeader()?>
<style>
	.wr-feedback {
		margin-top: 40px;
	}
</style>

<link rel="stylesheet" href="<?php echo $urlThemeActive;?>assets/lib/cube/unite-gallery.css">
<div class="container" >
	<h1 class="title-cate"><?php echo $album->title; ?></h1>
	<div class="container wr-feedback">
		<div id="gallery">
			<?php
			$dem =0;
			if (!empty($album->listImages)) {
				foreach($album->listImages as $img) {
					$dem ++;
					?>
					<a href="<?php echo $img->image; ?>" >
						<img src="<?php echo $img->image; ?>" alt="img">
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

		jQuery("#gallery").unitegallery({
			gallery_padding: 10,
			gallery_space_between_cols: 20,
    		gallery_space_between_rows: 20,
		});

	});

</script>