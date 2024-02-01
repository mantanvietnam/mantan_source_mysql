<?php $setting = setting(); ?>
<!DOCTYPE html> 
<html lang="vi">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<?php 
			mantan_header();
			if (function_exists('showSeoHome')) { 
				showSeoHome(); 
			}
			if (function_exists('showContentShareFacebook')) { 
				showContentShareFacebook(); 
			} 
		?>

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="<?php echo $urlThemeActive; ?>css/bootstrap.min.css">
		<!-- fontawesome -->
		<link rel="stylesheet" href="<?php echo $urlThemeActive; ?>css/all.min.css">
		<!-- owl-carousel -->
		<link rel="stylesheet" href="<?php echo $urlThemeActive; ?>css/owl.carousel.min.css">
		<link rel="stylesheet" href="<?php echo $urlThemeActive; ?>css/owl.theme.default.min.css">
		<!-- css web page -->
		<link rel="stylesheet" href="<?php echo $urlThemeActive; ?>css/style.css">
		<!-- font family -->
		<link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Barlow:wght@500&family=Lobster&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Viga&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Asap+Condensed&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Barlow+Semi+Condensed:ital,wght@0,100;0,400;1,400&display=swap" rel="stylesheet">
		<!-- animation -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css"/>
	</head>
	<body>
		<!----------------- start header ---------------->
		<header>
			<nav class="navbar navbar-expand-lg navbar-light bg-light">
			  	<div class="container">
			  		<a class="navbar-brand slogan_page" href="/"><p><?php echo @$setting['titleNav']; ?></p><small><?php echo @$setting['sloganNav']; ?></small></a>
				  	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				    	<span class="navbar-toggler-icon"></span>
				  	</button>
				  	<div class="collapse navbar-collapse" id="navbarSupportedContent">
				    	<ul class="navbar-nav mr-auto nav_main">
				    		<?php  
								$menus = getMenusDefault();  
								if (!empty($menus)) {  
									foreach ($menus as $categoryMenu) {  
										if (!empty($categoryMenu['sub'])) {  
											echo '<li class="list-inline-item hassub">  
											<a href="javascript:void(0);" title="">' . $categoryMenu['name'] . '<span class="caret"></span></a>  

											<ul class="rs list-unstyled menusub">';  
											foreach ($categoryMenu['sub'] as $subMenu) {  
												echo '<li><a href="' . $subMenu['link'] . '">' . $subMenu['name'] . '</a></li>';  
											}  
											echo '</ul>  


											</li>  ';  
										} else {  
											echo '<li class="nav-item ">  
													<a class="nav-link"  href="' . $categoryMenu['link'] . '">' . $categoryMenu['name'] . '</a>  
											</li> ';  
										}  
									}  
								}  
							?> 
							
				    	</ul>
				  	</div>
			  	</div>
			</nav>
		</header>
		<!------------------ end header ----------------->