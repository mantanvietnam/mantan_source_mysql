<!DOCTYPE html>
<html>
<head>
	<?php mantan_header();?>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.min.js" integrity="sha512-1/RvZTcCDEUjY/CypiMz+iqqtaoQfAITmNSJY17Myp4Ms5mdxPS5UV7iOfdZoxcGhzFbOm6sntTKJppjvuhg4g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/css/bootstrap.min.css" integrity="sha512-SbiR/eusphKoMVVXysTKG/7VseWii+Y3FdHrt0EpKgpToZeemhqHeZeLWLhJutz/2ut2Vw1uQEj2MbRF+TVBUA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

	<link rel="icon" type="image/x-icon" href="https://designer.ezpics.vn/plugins/ezpics_designer/view/home/assets/img/avatar-ezpics.png" />

	<!-- Google tag (gtag.js) -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-PCQ02R5K9G"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'G-PCQ02R5K9G');
	</script>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-12 text-center">
				<a href="https://smartqr.vn/r/gjib5dhkl79y">
					<img src="https://designer.ezpics.vn/plugins/ezpics_designer/view/home/assets/img/avatar-ezpics.png">
				</a>
			</div>
			<?php
				if(!empty($product)){
					$description = (!empty($product->description))?nl2br($product->description):'';

					echo '	<div class="col-12 col-xs-12 col-sm-12 col-md-2 col-lg-2">
							</div>
							<div class="col-12 col-xs-12 col-sm-12 col-md-4 col-lg-4 mb-3">
								<img src="'.$product->image.'" class="img-fluid">
							</div>
							<div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6">
								<h1 style="font-size: 20px;">'.$product->name.'</h1>
								<p>Tác giả: '.$user->name.'</p>
								<p>Lượt xem: '.number_format($product->views).'</p>
								<p>Đã tạo: '.number_format($product->export_image).' ảnh</p>
								'.$description.'
								<br/>
								<button type="button" class="btn btn-warning mt-3" onclick="showPopup();">
								  Nhập thông tin
								</button>
							</div>';
				}else{

				}
			?>
			
		</div>
	</div>

	<!-- Modal -->
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	  	<form action="/create-image-series" method="post" enctype="multipart/form-data">
	  		<input type="hidden" name="_csrfToken" value="<?php echo $csrfToken;?>" />
	  		<input type="hidden" name="id" value="<?php echo $product->id;?>">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Nhập thông tin</h5>
		      </div>
		      <div class="modal-body">
		        <?php 
		        	if(!empty($listLayer)){
		        		foreach ($listLayer as $layer) {
		        			$content = json_decode($layer->content, true);

		        			if(!empty($content['variable']) && !empty($content['variableLabel'])){
		        				echo '<p>'.$content['variableLabel'].'</p>';

		        				if($content['type'] == 'text'){
		        					echo '<input required type="text" name="'.$content['variable'].'" value="" class="form-control" />';
		        				}else if($content['type'] == 'image'){
		        					echo '<input required type="file" name="'.$content['variable'].'" value="" class="form-control" />';
		        				}


		        			}
		        		}
		        	}
		        ?>

		      </div>
		      <div class="modal-footer">
		        <button type="submit" class="btn btn-warning">Tạo file</button>
		      </div>
		    </div>
		</form>
	  </div>
	</div>

	<script type="text/javascript">
		function showPopup()
		{
			$('#exampleModal').modal('show');
		}
	</script>
</body>
</html>