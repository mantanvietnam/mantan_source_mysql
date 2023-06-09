<!DOCTYPE html>
<html>
<head>
	<?php mantan_header();?>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.min.js" integrity="sha512-1/RvZTcCDEUjY/CypiMz+iqqtaoQfAITmNSJY17Myp4Ms5mdxPS5UV7iOfdZoxcGhzFbOm6sntTKJppjvuhg4g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/css/bootstrap.min.css" integrity="sha512-SbiR/eusphKoMVVXysTKG/7VseWii+Y3FdHrt0EpKgpToZeemhqHeZeLWLhJutz/2ut2Vw1uQEj2MbRF+TVBUA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-12 text-center">
				<img src="https://designer.ezpics.vn/plugins/ezpics_designer/view/home/assets/img/avatar-ezpics.png">
			</div>
			<?php
				if(!empty($product)){

					echo '	<div class="col-12 col-xs-12 col-sm-12 col-md-2 col-lg-2">
							</div>
							<div class="col-12 col-xs-12 col-sm-12 col-md-4 col-lg-4">
								<img src="'.$product->image.'" class="img-fluid">
							</div>
							<div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6">
								<h1>'.$product->name.'</h1>
								<p>Tác giả: '.$user->name.'</p>
								<p>Lượt xem: '.number_format($product->views).'</p>
								<p>Đã bán: '.number_format($product->sold).'</p>
								
								<a class="btn btn-danger" href="">Nhập thông tin</a>
							</div>';
				}else{

				}
			?>
			
		</div>
	</div>
</body>
</html>