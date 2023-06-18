<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/x-icon" href="https://designer.ezpics.vn/plugins/ezpics_designer/view/home/assets/img/avatar-ezpics.png" />

	<title>
		<?php echo (!empty($product->name))?$product->name:'Hình ảnh mẫu thiết kế'; ?>
	</title>

	<link rel="stylesheet" href="https://apis.ezpics.vn/plugins/ezpics_api/view/css/style.css?time=<?php echo time();?>" />
	<link rel="stylesheet" href="https://apis.ezpics.vn/plugins/ezpics_api/view/css/style-long.css?time=<?php echo time();?>" />

	<!-- chặn Google tìm kiếm -->
	<meta name="robots" content="noindex">
	<meta name="googlebot" content="noindex">

	<!-- thêm thư viện jquery -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

	<!-- thêm thư viện bootstrap -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.min.js" integrity="sha512-1/RvZTcCDEUjY/CypiMz+iqqtaoQfAITmNSJY17Myp4Ms5mdxPS5UV7iOfdZoxcGhzFbOm6sntTKJppjvuhg4g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/css/bootstrap.min.css" integrity="sha512-SbiR/eusphKoMVVXysTKG/7VseWii+Y3FdHrt0EpKgpToZeemhqHeZeLWLhJutz/2ut2Vw1uQEj2MbRF+TVBUA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

	<!-- thêm thư viện font-awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js" integrity="sha512-fD9DI5bZwQxOi7MhYWnnNPlvXdp/2Pj3XSTRrFs5FQa4mizyGLnJcN6tuvUS6LbmgN1ut+XGSABKvjN0H6Aoow==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

	<!-- thêm thư viện html2canvas để chụp ảnh màn hình -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js" integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

	<script src="/plugins/ezpics_api/view/js/jqueryUI-custom.js"></script>

	<!-- thêm thư viện zoom 
	<script src="/plugins/ezpics_api/view/js/content-zoom-slider.js"></script>
	-->
	<!-- thêm font chữ cài từ admin -->
	<style type="text/css">
		<?php 
		if(!empty($fonts)){
			foreach ($fonts as $key => $value) {
				$src = [];
				if(!empty($value->font_woff2)){
					$src[] = 'url("'.$value->font_woff2.'") format("woff2")';
				}

				if(!empty($value->font)){
					$src[] = 'url("'.$value->font.'") format("woff")';
				}

				if(!empty($value->font_ttf)){
					$src[] = 'url("'.$value->font_ttf.'") format("truetype")';
				}

				if(!empty($value->font_otf)){
					$src[] = 'url("'.$value->font_otf.'") format("opentype")';
				}

				echo '	@font-face {
							font-family: "'.$value->name.'";
							src: '.implode(',', $src).';
				         	font-weight: '.$value->weight.';
						    font-style: '.$value->style.';
						    font-display: swap;
						}';
			}
		}
		?>
	</style>
</head>
<body>
<?php if(!empty($product) && !empty($layers)){ ?>
		<section class="box-detail-edit box-detail-edit-user-create active" style="padding: 0px !important;">
		    <div class="teop">
		        <div class="">
		        	<div class="showView">
			            <div class="thumb-checklayer list-layout-move-create" id="widgetCapEdit">
			            	<?php echo $infoLayer['movelayer'];?>
			            </div>
			        </div>
		        </div>
		    </div>

		</section>

		<script type="text/javascript">
			

			//setTimeout(capEdit, 5000, <?php echo $product->id;?>);

			// capEdit(<?php echo $product->id;?>);
		</script>
	<?php }else{
		echo '<center>Bạn không có quyền chỉnh sửa mẫu thiết kế này</center>';
	}
?>

<!-- thêm thư viện local -->
<script src="/plugins/ezpics_api/view/js/private.js"></script>

</body>
</html>

