<?php if(empty($_GET['id'])){ ?>
    <?php include(__DIR__.'/../headerPublic.php') ; ?>
	<main>
    		<p class="text-center text-create-img">
				<a href="data:image/png;base64,<?php echo $dataImage;?>" class="btn btn-warning mb-2 mt-3" download="<?php echo $slug.'-'.time().'.png';?>">
					  Tải ảnh
				</a>
			</p>
			<img id="imageId" src="data:image/png;base64,<?php echo $dataImage;?>" width="100%" />
	</main>
    <?php include(__DIR__.'/../footerPublic.php') ; ?>



<?php }
?>