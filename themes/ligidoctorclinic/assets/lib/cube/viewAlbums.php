<?php getHeader()?>
 
<script type='text/javascript' src="<?php echo $urlThemeActive;?>assets/js/unitegallery.min.js"></script>
 <link rel="stylesheet" href="<?php echo $urlThemeActive;?>assets/css/unite-gallery.css">
  <script type='text/javascript' src="<?php echo $urlThemeActive;?>assets/js/ug-theme-tiles.js"></script>

		<section class="page-header">
            <div class="container">
                <ul class="thm-breadcrumb list-unstyled">
                    <li><a href="/">Trang chủ</a></li>
                    <li>/</li>
                    <li><span>Album</span></li>
                </ul><!-- /.thm-breadcrumb list-unstyled -->
                <h2><?php echo $infoAlbum['Album']['title'];?></h2>
            </div><!-- /.container -->
        </section><!-- /.page-header -->
    	<section class="pt-60 pb-60">
			<div class="container">
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
		</section> 



	
	<script type="text/javascript">

		jQuery(document).ready(function(){

			jQuery("#gallery").unitegallery();

		});
		
	</script>
<?php getFooter()?>