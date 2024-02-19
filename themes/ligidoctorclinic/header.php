<?php global $urlThemeActive;
$setting = setting();
$cart = 0;
 if(!empty($session->read('product_order'))){
    $cart = count($session->read('product_order')); 

global $urlCurrent;


 }
?>
<!DOCTYPE html>
<html lang="vi">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="<?php echo $urlThemeActive ?>assets/lib/flickity-docs/flickity.css" media="screen">
	<link rel="stylesheet" href="<?php echo $urlThemeActive ?>assets/lib/bootstrap-4.3.1-dist/bootstrap-4.3.1-dist/css/bootstrap.css">
	<link rel="stylesheet" href="<?php echo $urlThemeActive ?>assets/lib/fanciybox/package/dist/fancybox.css">
	<link rel="stylesheet" href="<?php echo $urlThemeActive ?>assets/lib/fanciybox/package/dist/carousel.css">
	<link rel="stylesheet" href="<?php echo $urlThemeActive ?>assets/lib/fontawesome-free-5.15.1-web/css/all.css">
	<link rel="stylesheet" href="<?php echo $urlThemeActive ?>assets/lib/grid-gallery-master/css/grid-gallery.css">	
	<link rel="stylesheet" href="<?php echo $urlThemeActive ?>assets/lib/natural-gallery-js-master/css/grid-gallery.css">	
	<link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">

	<link rel="stylesheet" href="<?php echo $urlThemeActive ?>assets/css/reset.css">
	<link rel="stylesheet" href="<?php echo $urlThemeActive ?>assets/css/style.css">

	<?php mantan_header(); ?>
</head>
<body>
	<div class=" header-fix">
		<div class="container clsFlexBetweenMid">
			<button class="icon-menu-mobile">
				<i class="fas fa-bars"></i>
			</button>
			<div class="wr-search">
				<form class="formSearch" action="/search-product" method="GET">
					<input type="text" name="key" placeholder="Tìm kiếm sản phẩm">
					<i class="fas fa-search"></i>
					<input type="submit" style="display:none" name="">
				</form>
			</div>
			<div class="wr-logo">
				<div class="box-logo">
					<a href="/"><img src="<?php echo @$setting['image_logo'] ?>" alt=""></a>
					<!-- <center><?php echo @$themeSetting['Option']['value']['textLogo'] ?></center> -->
				</div>
			</div>
			<div class="clsFlexBetweenMid wr-icon-cart-hotline">
				<div class="box-hotline">
					<span>Hotline: <strong class="so_dien_thoai"><?php echo @$setting['hotline'] ?></strong></span>
				</div>
				<div class="box-icon-cart box-posi">
					<a href="/gio-hang">
					<span class="clsFlexCenterMid count-number-order count-number-order-pc"><?php echo $cart ?></span>
					<img src="<?php echo $urlThemeActive ?>assets/images/iconCart.png" alt="">
					<div class="wr-alert-add">
						<div class="box-alert-add">
							
						</div>
					</div>
					</a>
				</div>
				<!-- <div class="languageFlag">
					<div class="vietnamese">
						<a href="https://ligidoctorclinic.com/"><img src="<?php echo $urlThemeActive ?>/assets/images/coVN.png" alt=""></a>
					</div>
					<div class="english">
						<a href="https://en.ligidoctorclinic.com/"><img src="<?php echo $urlThemeActive ?>/assets/images/coUK.png" alt=""></a>
					</div>
				</div> -->
			</div>
		</div>
	</div>
	<div class="container header">
		<div class="row">
			<div class="col-12 col-sm-12 col-md-12 set-pd-0 clsFlexBetweenMid">
				<button class="icon-menu-mobile">
					<i class="fas fa-bars"></i>
				</button>
				<div class="wr-search">
					<form class="formSearch" action="/search-product" method="GET">
						<input type="text" name="key" placeholder="Tìm kiếm sản phẩm">
						<i class="fas fa-search"></i>
						<input type="submit" style="display:none" name="">
					</form>
				</div>
				<div class="wr-logo">
					<div class="box-logo">
						<a href="/"><img src="<?php echo @$setting['image_logo'] ?>" alt=""></a>
						<!-- <center><?php echo @$themeSetting['Option']['value']['textLogo'] ?></center> -->
					</div>
				</div>
				<div class="clsFlexBetweenMid wr-icon-cart-hotline">
					<div class="box-hotline">
						<span>Hotline: <strong class="so_dien_thoai"><?php echo @$setting['hotline'] ?></strong></span>
					</div>
					<div class="box-icon-cart">
						<a href="/gio-hang"><span class="clsFlexCenterMid count-number-order count-number-order-pc"><?php echo @$cart ?></span>
						<img src="<?php echo $urlThemeActive ?>/assets/images/iconCart.png" alt=""></a>
					</div>
					<!-- <div class="languageFlag">
						<div class="vietnamese">
							<a href="https://ligidoctorclinic.com/"><img src="<?php echo $urlThemeActive ?>/assets/images/coVN.png" alt=""></a>
						</div>
						<div class="english">
							<a href="https://en.ligidoctorclinic.com/"><img src="<?php echo $urlThemeActive ?>/assets/images/coUK.png" alt=""></a>
						</div>
					</div> -->
				</div>
			</div>
			<div class="col-12 col-sm-12 col-md-12 set-pd-0 menu">
				<div class="wr-menu">
					<div class="clsFlexBetweenMid box-menu">
						<ul class="navbar-nav">
						  <?php 
                                $menu = getMenusDefault();
                                                  
                                if(!empty($menu)){
                                foreach($menu as $key => $value){
                                  if(empty($value['sub'])){?>
                                    <li class="nav-item">
                                        <a class="nav-link active" aria-current="page" href="<?php echo $value['link']  ?>"><?php echo $value['name']  ?></a>
                                    </li>
                                    <?php   }else{  ?>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="<?php echo $value['link']  ?>" role="button" data-bs-toggle="dropdown"aria-expanded="false"><?php echo $value['name']  ?></a>
                                        <ul class="dropdown-menu">
                                            <?php  foreach($value['sub'] as $keys => $values) { ?>
                                            <li><a class="dropdown-item" href="<?php echo $values['link']  ?>"><?php echo $values['name']  ?></a></li>
                                             <?php } ?>
                                        </ul>
                                    </li>
                                    
                                    <?php }}} ?>
                                </ul>
					</div>
				</div>
			</div>
		</div>
		<div class="menu-mobile">
			<div class="clsFlexBetweenMid menu-mobile-tool">
				<i class="fas fa-bars"></i>
				<button class="colse-menu-mobile" type="button"><i class="fas fa-times"></i></button>
			</div>
			<div class="mist">
				<ul class="wr-menu-mobile">
					  <?php 
                                $menu = getMenusDefault();
                                                  
                                if(!empty($menu)){
                                foreach($menu as $key => $value){
                                  if(empty($value['sub'])){?>
                                    <li class="nav-item">
                                        <a class="nav-link active" aria-current="page" href="<?php echo $value['link']  ?>"><?php echo $value['name']  ?></a>
                                    </li>
                                    <?php   }else{  ?>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="<?php echo $value['link']  ?>" role="button" data-bs-toggle="dropdown"aria-expanded="false"><?php echo $value['name']  ?></a>
                                        <ul class="dropdown-menu">
                                            <?php  foreach($value['sub'] as $keys => $values) { ?>
                                            <li><a class="dropdown-item" href="<?php echo $values['link']  ?>"><?php echo $values['name']  ?></a></li>
                                             <?php } ?>
                                        </ul>
                                    </li>
                                    
                                    <?php }}} ?>
				</ul>
			</div>
			<form id="formSerchMobile" action="/search-product" method="GET">
				<input type="text" placeholder="Tìm kiếm" name="key"><button type="submit"><i class="fas fa-search"></i></button>
			</form>
			<div class="wr-info-menu-mobile">
				<p><img src="<?php echo $urlThemeActive ?>/assets/images/contactIconPing.png" alt=""><?php echo @$setting['address'] ?></p>
				<p><img src="<?php echo $urlThemeActive ?>/assets/images/contactIconPhone.png" alt=""><?php echo @$setting['hotline'] ?></p>
				<p><img src="<?php echo $urlThemeActive ?>/assets/images/contactIconEmail.png" alt=""><?php echo @$setting['email'] ?></p>
				<p><img src="<?php echo $urlThemeActive ?>/assets/images/contactIconFB.png" alt=""><?php echo @$setting['link_facebook'] ?></p>
			</div>
		</div>
		<div class="colse-menu-mobile mask-mobile">
			
		</div>
	</div>