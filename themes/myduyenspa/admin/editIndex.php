<?php global $themeSettings;?>
<!DOCTYPE html>
<html lang="vi">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<?php 
			global $themeSettings;
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
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css"/>
		 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

	</head>
	<body>
		<!-- --------------- start header -------------- -->
		<header>
			<nav class="navbar navbar-expand-lg navbar-light nav_style">
			  	<div class="container">
			  		<a title="Thay đổi logo" class="navbar-brand slogan_page" href="javascript:void(0);" onclick="editThemeMedia('<?php echo @$themeSettings['Option']['value']['logo']; ?>', 'logo');"><img src="<?php echo @$themeSettings['Option']['value']['logo']; ?>" alt="" width="64%" style="margin-top: 10px;"></a>

				  	<button class="navbar-toggler navbar-button" style="background:gray;" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				    	<span class="navbar-toggler-icon"></span>
				  	</button>

				  	<div class="collapse navbar-collapse nav-menu-bar" id="navbarSupportedContent">
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
												echo '<li><a href="javascript:void(0);">' . $subMenu['name'] . '</a></li>';  
											}  
											echo '</ul>  


											</li>  ';  
										} else {  
											echo '<li class="nav-item ">  
													<a class="nav-link"  href="javascript:void(0);">' . $categoryMenu['name'] . '</a>  
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
		<section class="banner_main" id="sumenh">
			<video autoplay loop muted>
				<source type="video/mp4" src="<?php echo @$themeSettings['Option']['value']['video']; ?>">
			</video>

			<div class="container">
				<div class="text-center text width100" onclick="editThemeEditer(this.innerHTML, 'textSlide');">
					<?php echo @$themeSettings['Option']['value']['textSlide']; ?>
				</div>
			</div>
		</section>
		<div class="elementor-shape elementor-shape-bottom song1" data-negative="false" style="margin-top: -48px">
			<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 283.5 27.8" preserveAspectRatio="none">
				<path class="elementor-shape-fill" d="M283.5,9.7c0,0-7.3,4.3-14,4.6c-6.8,0.3-12.6,0-20.9-1.5c-11.3-2-33.1-10.1-44.7-5.7	s-12.1,4.6-18,7.4c-6.6,3.2-20,9.6-36.6,9.3C131.6,23.5,99.5,7.2,86.3,8c-1.4,0.1-6.6,0.8-10.5,2c-3.8,1.2-9.4,3.8-17,4.7	c-3.2,0.4-8.3,1.1-14.2,0.9c-1.5-0.1-6.3-0.4-12-1.6c-5.7-1.2-11-3.1-15.8-3.7C6.5,9.2,0,10.8,0,10.8V0h283.5V9.7z M260.8,11.3	c-0.7-1-2-0.4-4.3-0.4c-2.3,0-6.1-1.2-5.8-1.1c0.3,0.1,3.1,1.5,6,1.9C259.7,12.2,261.4,12.3,260.8,11.3z M242.4,8.6	c0,0-2.4-0.2-5.6-0.9c-3.2-0.8-10.3-2.8-15.1-3.5c-8.2-1.1-15.8,0-15.1,0.1c0.8,0.1,9.6-0.6,17.6,1.1c3.3,0.7,9.3,2.2,12.4,2.7	C239.9,8.7,242.4,8.6,242.4,8.6z M185.2,8.5c1.7-0.7-13.3,4.7-18.5,6.1c-2.1,0.6-6.2,1.6-10,2c-3.9,0.4-8.9,0.4-8.8,0.5	c0,0.2,5.8,0.8,11.2,0c5.4-0.8,5.2-1.1,7.6-1.6C170.5,14.7,183.5,9.2,185.2,8.5z M199.1,6.9c0.2,0-0.8-0.4-4.8,1.1	c-4,1.5-6.7,3.5-6.9,3.7c-0.2,0.1,3.5-1.8,6.6-3C197,7.5,199,6.9,199.1,6.9z M283,6c-0.1,0.1-1.9,1.1-4.8,2.5s-6.9,2.8-6.7,2.7	c0.2,0,3.5-0.6,7.4-2.5C282.8,6.8,283.1,5.9,283,6z M31.3,11.6c0.1-0.2-1.9-0.2-4.5-1.2s-5.4-1.6-7.8-2C15,7.6,7.3,8.5,7.7,8.6	C8,8.7,15.9,8.3,20.2,9.3c2.2,0.5,2.4,0.5,5.7,1.6S31.2,11.9,31.3,11.6z M73,9.2c0.4-0.1,3.5-1.6,8.4-2.6c4.9-1.1,8.9-0.5,8.9-0.8	c0-0.3-1-0.9-6.2-0.3S72.6,9.3,73,9.2z M71.6,6.7C71.8,6.8,75,5.4,77.3,5c2.3-0.3,1.9-0.5,1.9-0.6c0-0.1-1.1-0.2-2.7,0.2	C74.8,5.1,71.4,6.6,71.6,6.7z M93.6,4.4c0.1,0.2,3.5,0.8,5.6,1.8c2.1,1,1.8,0.6,1.9,0.5c0.1-0.1-0.8-0.8-2.4-1.3	C97.1,4.8,93.5,4.2,93.6,4.4z M65.4,11.1c-0.1,0.3,0.3,0.5,1.9-0.2s2.6-1.3,2.2-1.2s-0.9,0.4-2.5,0.8C65.3,10.9,65.5,10.8,65.4,11.1	z M34.5,12.4c-0.2,0,2.1,0.8,3.3,0.9c1.2,0.1,2,0.1,2-0.2c0-0.3-0.1-0.5-1.6-0.4C36.6,12.8,34.7,12.4,34.5,12.4z M152.2,21.1	c-0.1,0.1-2.4-0.3-7.5-0.3c-5,0-13.6-2.4-17.2-3.5c-3.6-1.1,10,3.9,16.5,4.1C150.5,21.6,152.3,21,152.2,21.1z"></path>
				<path class="elementor-shape-fill" d="M269.6,18c-0.1-0.1-4.6,0.3-7.2,0c-7.3-0.7-17-3.2-16.6-2.9c0.4,0.3,13.7,3.1,17,3.3	C267.7,18.8,269.7,18,269.6,18z"></path>
				<path class="elementor-shape-fill" d="M227.4,9.8c-0.2-0.1-4.5-1-9.5-1.2c-5-0.2-12.7,0.6-12.3,0.5c0.3-0.1,5.9-1.8,13.3-1.2	S227.6,9.9,227.4,9.8z"></path>
				<path class="elementor-shape-fill" d="M204.5,13.4c-0.1-0.1,2-1,3.2-1.1c1.2-0.1,2,0,2,0.3c0,0.3-0.1,0.5-1.6,0.4	C206.4,12.9,204.6,13.5,204.5,13.4z"></path>
				<path class="elementor-shape-fill" d="M201,10.6c0-0.1-4.4,1.2-6.3,2.2c-1.9,0.9-6.2,3.1-6.1,3.1c0.1,0.1,4.2-1.6,6.3-2.6	S201,10.7,201,10.6z"></path>
				<path class="elementor-shape-fill" d="M154.5,26.7c-0.1-0.1-4.6,0.3-7.2,0c-7.3-0.7-17-3.2-16.6-2.9c0.4,0.3,13.7,3.1,17,3.3	C152.6,27.5,154.6,26.8,154.5,26.7z"></path>
				<path class="elementor-shape-fill" d="M41.9,19.3c0,0,1.2-0.3,2.9-0.1c1.7,0.2,5.8,0.9,8.2,0.7c4.2-0.4,7.4-2.7,7-2.6	c-0.4,0-4.3,2.2-8.6,1.9c-1.8-0.1-5.1-0.5-6.7-0.4S41.9,19.3,41.9,19.3z"></path>
				<path class="elementor-shape-fill" d="M75.5,12.6c0.2,0.1,2-0.8,4.3-1.1c2.3-0.2,2.1-0.3,2.1-0.5c0-0.1-1.8-0.4-3.4,0	C76.9,11.5,75.3,12.5,75.5,12.6z"></path>
				<path class="elementor-shape-fill" d="M15.6,13.2c0-0.1,4.3,0,6.7,0.5c2.4,0.5,5,1.9,5,2c0,0.1-2.7-0.8-5.1-1.4	C19.9,13.7,15.7,13.3,15.6,13.2z"></path>
			</svg>		
		</div>
		<br>
		<section class="section" id="gioithieu">
				<div class="container">
					<div class="row">
						<div class="col-md-6 col-sm-12 col-12 img_myduyen">
							<a href="javascript:void(0);" class="" title="Thay đổi ảnh chân dung">
								<img onclick="editThemeMedia('<?php echo @$themeSettings['Option']['value']['avatar']; ?>', 'avatar');" src="<?php echo @$themeSettings['Option']['value']['avatar']; ?>" alt="" style="width:85%;height: 650px">
							</a>


							<div class="iconstyle">
								<a title="Thay đổi link Facebook" class="elementor-icon elementor-social-icon elementor-social-icon-facebook elementor-repeater-item-6523dd4" href="javascript:void(0);" onclick="editThemeText('<?php echo @$themeSettings['Option']['value']['facebook']; ?>', 'facebook');"><i class="fab fa-facebook-square" style="font-size: 50px; color: #3b5998"></i></a>

								<a title="Thay đổi link Instagram" class="elementor-icon elementor-social-icon elementor-social-icon-twitter elementor-repeater-item-3e1d47d" href="javascript:void(0);" onclick="editThemeText('<?php echo @$themeSettings['Option']['value']['instagram']; ?>', 'instagram');" ><i class="fab fa-instagram-square" style="font-size:50px; color: #993300"></i></a>

								<a title="Thay đổi link Youtube" class="elementor-icon elementor-social-icon elementor-social-icon-youtube elementor-repeater-item-ab3a1de" href="javascript:void(0);" onclick="editThemeText('<?php echo @$themeSettings['Option']['value']['youtube']; ?>', 'youtube');"><i class="fab fa-youtube-square" style="font-size: 50px;color: #cd201f;"></i></a>
							</div>
						</div>

						<div class="col-md-6 col-sm-12 col-12 content_myduyen" >
							<div class="myduyenh1">
									<h1 title="Thay đổi tên" onclick="editThemeText('<?php echo @$themeSettings['Option']['value']['fullName']; ?>', 'fullName');"><?php echo @$themeSettings['Option']['value']['fullName']; ?></h1>

									<h3 title="Thay đổi slogan" onclick="editThemeText('<?php echo @$themeSettings['Option']['value']['slogan']; ?>', 'slogan');" style="color: #6d0202"><i><?php echo @$themeSettings['Option']['value']['slogan']; ?></i></h3>
							</div>
							<div class="content" onclick="editThemeEditer(this.innerHTML, 'personIntroduction');">
								<?php echo @$themeSettings['Option']['value']['personIntroduction']; ?>
							</div>
						</div>
					</div>
				</div>	
		</section>
		<br>

	
	
		<div class="elementor-shape elementor-shape-bottom colorGreen" data-negative="false">
			<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 283.5 27.8" preserveAspectRatio="none">
				<path class="elementor-shape-fill" d="M283.5,9.7c0,0-7.3,4.3-14,4.6c-6.8,0.3-12.6,0-20.9-1.5c-11.3-2-33.1-10.1-44.7-5.7	s-12.1,4.6-18,7.4c-6.6,3.2-20,9.6-36.6,9.3C131.6,23.5,99.5,7.2,86.3,8c-1.4,0.1-6.6,0.8-10.5,2c-3.8,1.2-9.4,3.8-17,4.7	c-3.2,0.4-8.3,1.1-14.2,0.9c-1.5-0.1-6.3-0.4-12-1.6c-5.7-1.2-11-3.1-15.8-3.7C6.5,9.2,0,10.8,0,10.8V0h283.5V9.7z M260.8,11.3	c-0.7-1-2-0.4-4.3-0.4c-2.3,0-6.1-1.2-5.8-1.1c0.3,0.1,3.1,1.5,6,1.9C259.7,12.2,261.4,12.3,260.8,11.3z M242.4,8.6	c0,0-2.4-0.2-5.6-0.9c-3.2-0.8-10.3-2.8-15.1-3.5c-8.2-1.1-15.8,0-15.1,0.1c0.8,0.1,9.6-0.6,17.6,1.1c3.3,0.7,9.3,2.2,12.4,2.7	C239.9,8.7,242.4,8.6,242.4,8.6z M185.2,8.5c1.7-0.7-13.3,4.7-18.5,6.1c-2.1,0.6-6.2,1.6-10,2c-3.9,0.4-8.9,0.4-8.8,0.5	c0,0.2,5.8,0.8,11.2,0c5.4-0.8,5.2-1.1,7.6-1.6C170.5,14.7,183.5,9.2,185.2,8.5z M199.1,6.9c0.2,0-0.8-0.4-4.8,1.1	c-4,1.5-6.7,3.5-6.9,3.7c-0.2,0.1,3.5-1.8,6.6-3C197,7.5,199,6.9,199.1,6.9z M283,6c-0.1,0.1-1.9,1.1-4.8,2.5s-6.9,2.8-6.7,2.7	c0.2,0,3.5-0.6,7.4-2.5C282.8,6.8,283.1,5.9,283,6z M31.3,11.6c0.1-0.2-1.9-0.2-4.5-1.2s-5.4-1.6-7.8-2C15,7.6,7.3,8.5,7.7,8.6	C8,8.7,15.9,8.3,20.2,9.3c2.2,0.5,2.4,0.5,5.7,1.6S31.2,11.9,31.3,11.6z M73,9.2c0.4-0.1,3.5-1.6,8.4-2.6c4.9-1.1,8.9-0.5,8.9-0.8	c0-0.3-1-0.9-6.2-0.3S72.6,9.3,73,9.2z M71.6,6.7C71.8,6.8,75,5.4,77.3,5c2.3-0.3,1.9-0.5,1.9-0.6c0-0.1-1.1-0.2-2.7,0.2	C74.8,5.1,71.4,6.6,71.6,6.7z M93.6,4.4c0.1,0.2,3.5,0.8,5.6,1.8c2.1,1,1.8,0.6,1.9,0.5c0.1-0.1-0.8-0.8-2.4-1.3	C97.1,4.8,93.5,4.2,93.6,4.4z M65.4,11.1c-0.1,0.3,0.3,0.5,1.9-0.2s2.6-1.3,2.2-1.2s-0.9,0.4-2.5,0.8C65.3,10.9,65.5,10.8,65.4,11.1	z M34.5,12.4c-0.2,0,2.1,0.8,3.3,0.9c1.2,0.1,2,0.1,2-0.2c0-0.3-0.1-0.5-1.6-0.4C36.6,12.8,34.7,12.4,34.5,12.4z M152.2,21.1	c-0.1,0.1-2.4-0.3-7.5-0.3c-5,0-13.6-2.4-17.2-3.5c-3.6-1.1,10,3.9,16.5,4.1C150.5,21.6,152.3,21,152.2,21.1z"/>
				<path class="elementor-shape-fill" d="M269.6,18c-0.1-0.1-4.6,0.3-7.2,0c-7.3-0.7-17-3.2-16.6-2.9c0.4,0.3,13.7,3.1,17,3.3	C267.7,18.8,269.7,18,269.6,18z"/>
				<path class="elementor-shape-fill" d="M227.4,9.8c-0.2-0.1-4.5-1-9.5-1.2c-5-0.2-12.7,0.6-12.3,0.5c0.3-0.1,5.9-1.8,13.3-1.2	S227.6,9.9,227.4,9.8z"/>
				<path class="elementor-shape-fill" d="M204.5,13.4c-0.1-0.1,2-1,3.2-1.1c1.2-0.1,2,0,2,0.3c0,0.3-0.1,0.5-1.6,0.4	C206.4,12.9,204.6,13.5,204.5,13.4z"/>
				<path class="elementor-shape-fill" d="M201,10.6c0-0.1-4.4,1.2-6.3,2.2c-1.9,0.9-6.2,3.1-6.1,3.1c0.1,0.1,4.2-1.6,6.3-2.6	S201,10.7,201,10.6z"/>
				<path class="elementor-shape-fill" d="M154.5,26.7c-0.1-0.1-4.6,0.3-7.2,0c-7.3-0.7-17-3.2-16.6-2.9c0.4,0.3,13.7,3.1,17,3.3	C152.6,27.5,154.6,26.8,154.5,26.7z"/>
				<path class="elementor-shape-fill" d="M41.9,19.3c0,0,1.2-0.3,2.9-0.1c1.7,0.2,5.8,0.9,8.2,0.7c4.2-0.4,7.4-2.7,7-2.6	c-0.4,0-4.3,2.2-8.6,1.9c-1.8-0.1-5.1-0.5-6.7-0.4S41.9,19.3,41.9,19.3z"/>
				<path class="elementor-shape-fill" d="M75.5,12.6c0.2,0.1,2-0.8,4.3-1.1c2.3-0.2,2.1-0.3,2.1-0.5c0-0.1-1.8-0.4-3.4,0	C76.9,11.5,75.3,12.5,75.5,12.6z"/>
				<path class="elementor-shape-fill" d="M15.6,13.2c0-0.1,4.3,0,6.7,0.5c2.4,0.5,5,1.9,5,2c0,0.1-2.7-0.8-5.1-1.4	C19.9,13.7,15.7,13.3,15.6,13.2z"/>
			</svg>		
		</div>

		<section class="section1" id="daotao">
				<div class="container">
					<div class="texttillte">
						<h1 class="">CÁC KHÓA ĐÀO TẠO</h1>
					</div>
					<div class="row ">
						<div class="col-md-4">
							<div class="thumbnail daotao">
								<img class="img-thumbnail" src="<?php echo @$themeSettings['Option']['value']['imageLearn1']; ?>" alt="" onclick="editThemeMedia('<?php echo @$themeSettings['Option']['value']['imageLearn1']; ?>', 'imageLearn1');">
								<div class="texttilltecon" onclick="editThemeText('<?php echo @$themeSettings['Option']['value']['titleLearn1']; ?>', 'titleLearn1');">
									<h3><?php echo @$themeSettings['Option']['value']['titleLearn1']; ?></h3>
								</div>
								<div class="overlay" onclick="editThemeText('<?php echo @$themeSettings['Option']['value']['decsLearn1']; ?>', 'decsLearn1');">
									<div class="text"> <span><?php echo @$themeSettings['Option']['value']['decsLearn1']; ?></span> </div>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="thumbnail daotao1 ">
								<img class="img-thumbnail" src="<?php echo @$themeSettings['Option']['value']['imageLearn2']; ?>" alt="" onclick="editThemeMedia('<?php echo @$themeSettings['Option']['value']['imageLearn2']; ?>', 'imageLearn2');">
								<div class="texttilltecon" onclick="editThemeText('<?php echo @$themeSettings['Option']['value']['titleLearn2']; ?>', 'titleLearn2');">
									<h3><?php echo @$themeSettings['Option']['value']['titleLearn2']; ?></h3>
								</div>
								<div class="overlay" onclick="editThemeText('<?php echo @$themeSettings['Option']['value']['decsLearn2']; ?>', 'decsLearn2');">
									<div class="text"> <span><?php echo @$themeSettings['Option']['value']['decsLearn2']; ?></span> </div>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="thumbnail">
								<img class="img-thumbnail" src="<?php echo @$themeSettings['Option']['value']['imageLearn3']; ?>" alt="" onclick="editThemeMedia('<?php echo @$themeSettings['Option']['value']['imageLearn3']; ?>', 'imageLearn3');">
								<div class="texttilltecon" onclick="editThemeText('<?php echo @$themeSettings['Option']['value']['titleLearn3']; ?>', 'titleLearn3');">
									<h3><?php echo @$themeSettings['Option']['value']['titleLearn3']; ?></h3>
								</div>
								<div class="overlay" onclick="editThemeText('<?php echo @$themeSettings['Option']['value']['decsLearn3']; ?>', 'decsLearn3');">
									<div class="text"> <span><?php echo @$themeSettings['Option']['value']['decsLearn3']; ?></span> </div>
								</div>
							</div>
						</div>
					</div>
				</div>
		</section>
		<div class="elementor-shape elementor-shape-bottom colorBlue" data-negative="false">
			<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" preserveAspectRatio="none">
				<path class="elementor-shape-fill" opacity="0.33" d="M473,67.3c-203.9,88.3-263.1-34-320.3,0C66,119.1,0,59.7,0,59.7V0h1000v59.7 c0,0-62.1,26.1-94.9,29.3c-32.8,3.3-62.8-12.3-75.8-22.1C806,49.6,745.3,8.7,694.9,4.7S492.4,59,473,67.3z"/>
				<path class="elementor-shape-fill" opacity="0.66" d="M734,67.3c-45.5,0-77.2-23.2-129.1-39.1c-28.6-8.7-150.3-10.1-254,39.1 s-91.7-34.4-149.2,0C115.7,118.3,0,39.8,0,39.8V0h1000v36.5c0,0-28.2-18.5-92.1-18.5C810.2,18.1,775.7,67.3,734,67.3z"/>
				<path class="elementor-shape-fill" d="M766.1,28.9c-200-57.5-266,65.5-395.1,19.5C242,1.8,242,5.4,184.8,20.6C128,35.8,132.3,44.9,89.9,52.5C28.6,63.7,0,0,0,0 h1000c0,0-9.9,40.9-83.6,48.1S829.6,47,766.1,28.9z"/>
			</svg>		
		</div>

		<section class="section2">
			<div class="container">
				<div class="chuongtrinh">
					<h1>CHƯƠNG TRÌNH ĐÃ TỔ CHỨC</h1>
				</div>
				<div class = "row">
					<div class = "col-md-4 chuongtrinhcon">
						<div class = "thumbnail" onclick="editThemeMedia('<?php echo @$themeSettings['Option']['value']['imageProgram1']; ?>', 'imageProgram1');">
							<img src = "<?php echo @$themeSettings['Option']['value']['imageProgram1']; ?>" alt = "" style="width:100%;">
						</div>

						<div class ="caption">
							<p onclick="editThemeText('<?php echo @$themeSettings['Option']['value']['titleProgram1']; ?>', 'titleProgram1');"><span><?php echo @$themeSettings['Option']['value']['titleProgram1']; ?></span></p>

							<p onclick="editThemeText('<?php echo @$themeSettings['Option']['value']['timeProgram1']; ?>', 'timeProgram1');"><b><?php echo @$themeSettings['Option']['value']['timeProgram1']; ?></b></p>

							<p onclick="editThemeText('<?php echo @$themeSettings['Option']['value']['decsProgram1']; ?>', 'decsProgram1');"><?php echo @$themeSettings['Option']['value']['decsProgram1']; ?></p>
						</div>
					</div>

					<div class = "col-md-4 chuongtrinhcon">

						<div class = "thumbnail" onclick="editThemeMedia('<?php echo @$themeSettings['Option']['value']['imageProgram2']; ?>', 'imageProgram2');">
							<img src = "<?php echo @$themeSettings['Option']['value']['imageProgram2']; ?>" alt = "" style="width:100%;">
						</div>

						<div class ="caption">
							<p onclick="editThemeText('<?php echo @$themeSettings['Option']['value']['titleProgram2']; ?>', 'titleProgram2');"><span><?php echo @$themeSettings['Option']['value']['titleProgram2']; ?></span></p>

							<p onclick="editThemeText('<?php echo @$themeSettings['Option']['value']['timeProgram2']; ?>', 'timeProgram2');"><b><?php echo @$themeSettings['Option']['value']['timeProgram2']; ?></b></p>

							<p onclick="editThemeText('<?php echo @$themeSettings['Option']['value']['decsProgram2']; ?>', 'decsProgram2');"><?php echo @$themeSettings['Option']['value']['decsProgram2']; ?></p>
						</div>
					</div>

					<div class = "col-md-4 chuongtrinhcon">

						<div class = "thumbnail" onclick="editThemeMedia('<?php echo @$themeSettings['Option']['value']['imageProgram3']; ?>', 'imageProgram3');">
							<img src = "<?php echo @$themeSettings['Option']['value']['imageProgram3']; ?>" alt = "" style="width:100%;">
						</div>

						<div class ="caption">
							<p onclick="editThemeText('<?php echo @$themeSettings['Option']['value']['titleProgram3']; ?>', 'titleProgram3');"><span><?php echo @$themeSettings['Option']['value']['titleProgram3']; ?></span></p>

							<p onclick="editThemeText('<?php echo @$themeSettings['Option']['value']['timeProgram3']; ?>', 'timeProgram3');"><b><?php echo @$themeSettings['Option']['value']['timeProgram3']; ?></b></p>

							<p onclick="editThemeText('<?php echo @$themeSettings['Option']['value']['decsProgram3']; ?>', 'decsProgram3');"><?php echo @$themeSettings['Option']['value']['decsProgram3']; ?></p>
						</div>
					</div>			
				</div>	
			</div>
		</section>

		<section class="section3">
			<div class="container">
				<div class="vemyduyen">
					<h1>MỌI NGƯỜI NÓI GÌ VỀ <span style="color: #B43600" onclick="editThemeText('<?php echo @$themeSettings['Option']['value']['fullName']; ?>', 'fullName');"><?php echo @$themeSettings['Option']['value']['fullName']; ?></span></h1>
				</div>
				<div class="row nhanxet">
					<?php
						$feedBack= getListFeedback();
						if(!empty($feedBack)){
							foreach($feedBack as $item){
								echo '
									<div class="col-md-6">
										<div class="row">
											
											<div class="col-md-4 text-center feedBack">
												<img src="'.$item['Feedback']['avatar'].'" style="width:100%;" alt="">
											</div>
											<div class="col-md-8 textnhanxet">
												<a href="/plugins/admin/feedback-addFeedback.php/'.$item['Feedback']['id'].'" target="_blank"><h3>'.$item['Feedback']['fullName'].' - '.$item['Feedback']['positions'].'</h3></a>
												'.$item['Feedback']['content'].'
											</div>

										</div>
									</div>';
							}
						}
					?>
					
				</div>

				
			</div>	
		</section>


		<section class="section4" id="hethong">
			<div class="container">
				<div class="row" id="counter">
					<div class="col-md-3 text-center">
						<div onclick="editThemeText('<?php echo @$themeSettings['Option']['value']['numberStatic1']; ?>', 'numberStatic1');" class="textspan counter-value"  data-count="<?php echo @$themeSettings['Option']['value']['numberStatic1']; ?>">
							<span><?php echo @$themeSettings['Option']['value']['numberStatic1']; ?></span>
							<span>+</span>
						</div>
						<div onclick="editThemeText('<?php echo @$themeSettings['Option']['value']['nameStatic1']; ?>', 'nameStatic1');" class="textspan1"><h3><?php echo @$themeSettings['Option']['value']['nameStatic1']; ?></h3></div>
					</div>
					<div class="col-md-3 text-center">
						<div onclick="editThemeText('<?php echo @$themeSettings['Option']['value']['numberStatic2']; ?>', 'numberStatic2');"  class="textspan counter-value"  data-count="<?php echo @$themeSettings['Option']['value']['numberStatic2']; ?>">
							<span><?php echo @$themeSettings['Option']['value']['numberStatic2']; ?></span>
							<span>+</span>
						</div>
						<div onclick="editThemeText('<?php echo @$themeSettings['Option']['value']['nameStatic2']; ?>', 'nameStatic2');" class="textspan1"><h3><?php echo @$themeSettings['Option']['value']['nameStatic2']; ?></h3></div>
					</div>
					<div class="col-md-3 text-center">
						<div onclick="editThemeText('<?php echo @$themeSettings['Option']['value']['numberStatic3']; ?>', 'numberStatic3');"  class="textspan counter-value" data-count="<?php echo @$themeSettings['Option']['value']['numberStatic3']; ?>">
							<span><?php echo @$themeSettings['Option']['value']['numberStatic3']; ?></span>
							<span>%</span>
						</div>
						<div onclick="editThemeText('<?php echo @$themeSettings['Option']['value']['nameStatic3']; ?>', 'nameStatic3');" class="textspan1"><h3><?php echo @$themeSettings['Option']['value']['nameStatic3']; ?></h3></div>
					</div>
					<div class="col-md-3 text-center">
						<div onclick="editThemeText('<?php echo @$themeSettings['Option']['value']['numberStatic4']; ?>', 'numberStatic4');"  class="textspan counter-value" data-count="<?php echo @$themeSettings['Option']['value']['numberStatic4']; ?>">
							<span><?php echo @$themeSettings['Option']['value']['numberStatic4']; ?></span>
							<span>%</span>
						</div>
						<div onclick="editThemeText('<?php echo @$themeSettings['Option']['value']['nameStatic4']; ?>', 'nameStatic4');" class="textspan1"><h3><?php echo @$themeSettings['Option']['value']['nameStatic4']; ?></h3></div>
					</div>
				</div>
			</div>	
		</section>

		<section class="section5">
			<div class="container">
				<div class="baiviet">
					<h1>BÀI VIẾT GẦN NHẤT</h1>
				</div>
				<div class="row">
					<?php
						global $modelNotice;
						$news= $modelNotice->getNewNotice(3);

						if(!empty($news)){
							foreach($news as $item){
								$urlNotice = getUrlNotice($item['Notice']['id']);
								echo '<div class="col-md-4">
										<div class = "thumbnail">
											<img src = "'.$item['Notice']['image'].'" alt ="" style="width:100%;">
										</div>

										<div class ="item">
											<p><a target="_blank" href="/notices/addNotices/'.$item['Notice']['id'].'" title=""><h5>'.$item['Notice']['title'].'</h5></a></p>
											<p>'.$item['Notice']['introductory'].'</p>
											<p><a target="_blank" href="/notices/addNotices/'.$item['Notice']['id'].'" title="">Xem tiếp >></a></p>
										</div>	
									</div>';
							}
						}
					?>
				</div>	
			</div>
		</section>
		<div class="text-center" style="width:50%; margin-left: 25%;">
			<hr style="border :1px solid #770000">
		</div>

		<section class="section6" id="lienhe">
			<div class="textfooter">
				<h1>KẾT NỐI VỚI TÔI</h1>
				<p>
					<a title="Thay đổi link Facebook" class="elementor-icon elementor-social-icon elementor-social-icon-facebook elementor-repeater-item-6523dd4" href="javascript:void(0);" onclick="editThemeText('<?php echo @$themeSettings['Option']['value']['facebook']; ?>', 'facebook');"><i class="fab fa-facebook-square" style="font-size: 50px; color: #3b5998"></i></a>

					<a title="Thay đổi link Instagram" class="elementor-icon elementor-social-icon elementor-social-icon-twitter elementor-repeater-item-3e1d47d" href="javascript:void(0);" onclick="editThemeText('<?php echo @$themeSettings['Option']['value']['instagram']; ?>', 'instagram');" ><i class="fab fa-instagram-square" style="font-size:50px; color: #993300"></i></a>

					<a title="Thay đổi link Youtube" class="elementor-icon elementor-social-icon elementor-social-icon-youtube elementor-repeater-item-ab3a1de" href="javascript:void(0);" onclick="editThemeText('<?php echo @$themeSettings['Option']['value']['youtube']; ?>', 'youtube');"><i class="fab fa-youtube-square" style="font-size: 50px;color: #cd201f;"></i></a>
				</p>
			</div>
			<script type="text/javascript">
				var map= '<?php echo @htmlspecialchars_decode($themeSettings['Option']['value']['map']); ?>';
			</script>
			<div class="row" onclick="editThemeTextarea(map, 'map');">
				<div class="container">
					<div class="bando">
						<?php echo @$themeSettings['Option']['value']['map'];?>
					</div>
				</div>
			</div>
			<br/>
			<p><center>Website được xây dựng bởi <a href="http://manmoweb.com/" title="Công cụ tạo web tự động">ManMo Web</a></center></p>
			
		</section>






		<!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="<?php echo $urlThemeActive; ?>js/jquery-slim.min.js"></script>
		<script src="<?php echo $urlThemeActive; ?>js/popper.min.js"></script>
		<script src="<?php echo $urlThemeActive; ?>js/bootstrap.min.js"></script>
		<!-- fontawesome -->
		<script src="<?php echo $urlThemeActive; ?>js/all.min.js"></script>
		<!-- owl-carousel -->
		<script src="<?php echo $urlThemeActive; ?>js/owl.carousel.min.js"></script>
		<!-- js web page -->
		<script src="<?php echo $urlThemeActive; ?>js/main.js"></script>
		

		<script type="text/javascript">

			var a = 0;
			$(window).scroll(function() {

				var oTop = $('#counter').offset().top - window.innerHeight;
				if (a == 0 && $(window).scrollTop() > oTop) {
					$('.counter-value').each(function() {
						var $this = $(this),
						countTo = $this.attr('data-count');
						$({
							countNum: $this.text()
						}).animate({
							countNum: countTo
						},

						{

							duration: 2000,
							easing: 'swing',
							step: function() {
								$this.text(Math.floor(this.countNum));
							},
							complete: function() {
								$this.text(this.countNum);
            //alert('finished');
        }

    });
					});
					a = 1;
				}

			});
		</script>



		<script type="text/javascript" >
			//animate service
			$(document).ready(function(){
				$(window).scroll(function(event){
					var pos_body = $('html,body').scrollTop();
					var pos_event = $('.img_myduyen').offset().top;

					if (pos_body>pos_event-300){
						$('.img_myduyen').addClass('animate__animated animate__rollIn');
					}
				});
			});

			$(document).ready(function(){
				$(window).scroll(function(event){
					var pos_body = $('html,body').scrollTop();
					var pos_event = $('.content').offset().top;

					if (pos_body>pos_event-300){
						$('.content').addClass('animate__animated animate__backInRight');
					}
				});
			});
				$(document).ready(function(){
				$(window).scroll(function(event){
					var pos_body = $('html,body').scrollTop();
					var pos_event = $('.myduyenh1').offset().top;

					if (pos_body>pos_event-300){
						$('.myduyenh1').addClass('animate__animated animate__backInDown');
					}
				});
			});
				$(document).ready(function(){
				$(window).scroll(function(event){
					var pos_body = $('html,body').scrollTop();
					var pos_event = $('.daotao').offset().top;

					if (pos_body>pos_event-700){
						$('.daotao').addClass('animate__animated animate__fadeInDownBig');
					}
				});
			});

				$(document).ready(function(){
				$(window).scroll(function(event){
					var pos_body = $('html,body').scrollTop();
					var pos_event = $('.daotao1').offset().top;

					if (pos_body>pos_event-700){
						$('.daotao1').addClass('animate__animated animate__fadeInUp');
					}
				});
			});
		</script>


		<a id="myBtn" title="Go to admin" href="/admins">Back</a>

		
		<style type="text/css">
			#myBtn {
				position: fixed; /* Fixed/sticky position */
				bottom: 20px; /* Place the button at the bottom of the page */
				right: 30px; /* Place the button 30px from the right */
				z-index: 99; /* Make sure it does not overlap */
				border: none; /* Remove borders */
				outline: none; /* Remove outline */
				background-color: red; /* Set a background color */
				color: white; /* Text color */
				cursor: pointer; /* Add a mouse pointer on hover */
				padding: 15px; /* Some padding */
				border-radius: 10px; /* Rounded corners */
				font-size: 18px; /* Increase font size */
			}

			#myBtn:hover {
				background-color: #555; /* Add a dark-grey background on hover */
			}




		</style>
		<?php include('codeEdit.php');?>
	</body>
</html>