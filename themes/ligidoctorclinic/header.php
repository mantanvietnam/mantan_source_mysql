<?php 
global $themeSetting;
?>
<!DOCTYPE html>
<html lang="vi">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="<?php echo @$themeSetting['Option']['value']['faviIcon'] ?>"/>
	<link rel="stylesheet" href="<?php echo $urlThemeActive ?>assets/lib/flickity-docs/flickity.css" media="screen">
	<link rel="stylesheet" href="<?php echo $urlThemeActive ?>assets/lib/bootstrap-4.3.1-dist/bootstrap-4.3.1-dist/css/bootstrap.css">
	<link rel="stylesheet" href="<?php echo $urlThemeActive ?>assets/lib/fanciybox/package/dist/fancybox.css">
	<link rel="stylesheet" href="<?php echo $urlThemeActive ?>assets/lib/fanciybox/package/dist/carousel.css">
	<link rel="stylesheet" href="<?php echo $urlThemeActive ?>assets/lib/fontawesome-free-5.15.1-web/css/all.css">
	<link rel="stylesheet" href="<?php echo $urlThemeActive ?>assets/lib/grid-gallery-master/css/grid-gallery.css">	
	<link rel="stylesheet" href="<?php echo $urlThemeActive ?>assets/lib/natural-gallery-js-master/css/grid-gallery.css">	

	<link rel="stylesheet" href="<?php echo $urlThemeActive ?>assets/css/reset.css">
	<link rel="stylesheet" href="<?php echo $urlThemeActive ?>assets/css/style.css">

	<?php 
    mantan_header();

    if (function_exists('showSeoHome')) {
        showSeoHome();
    }

    if (function_exists('showContentShareFacebook')) {
        showContentShareFacebook();
    }
    ?>
</head>
<body>
	<div class=" header-fix">
		<div class="container clsFlexBetweenMid">
			<button class="icon-menu-mobile">
				<i class="fas fa-bars"></i>
			</button>
			<div class="wr-search">
				<form class="formSearch" action="/search" method="GET">
					<input type="text" name="key" placeholder="Tìm kiếm sản phẩm">
					<i class="fas fa-search"></i>
				</form>
			</div>
			<div class="wr-logo">
				<div class="box-logo">
					<a href="/"><img src="<?php echo @$themeSetting['Option']['value']['logo'] ?>" alt=""></a>
					<center><?php echo @$themeSetting['Option']['value']['textLogo'] ?></center>
				</div>
			</div>
			<div class="clsFlexBetweenMid wr-icon-cart-hotline">
				<div class="box-hotline">
					<span>Hotline: <strong class="so_dien_thoai"><?php echo @$themeSetting['Option']['value']['hotline'] ?></strong></span>
				</div>
				<div class="box-icon-cart box-posi">
					<span class="clsFlexCenterMid count-number-order count-number-order-pc"><?php echo  @count($_SESSION['orderProducts']) ?></span>
					<img src="<?php echo $urlThemeActive ?>assets/images/iconCart.png" alt="">
					<div class="wr-alert-add">
						<div class="box-alert-add">
							
						</div>
					</div>
					
				</div>
				<div class="languageFlag">
					<div class="vietnamese">
						<a href="https://ligidoctorclinic.com/"><img src="<?php echo $urlThemeActive ?>/assets/images/coVN.png" alt=""></a>
					</div>
					<div class="english">
						<a href="https://en.ligidoctorclinic.com/"><img src="<?php echo $urlThemeActive ?>/assets/images/coUK.png" alt=""></a>
					</div>
				</div>
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
					<form class="formSearch" action="/search" method="GET">
						<input type="text" name="key" placeholder="Tìm kiếm sản phẩm">
						<i class="fas fa-search"></i>
					</form>
				</div>
				<div class="wr-logo">
					<div class="box-logo">
						<a href="/"><img src="<?php echo @$themeSetting['Option']['value']['logo'] ?>" alt=""></a>
						<center><?php echo @$themeSetting['Option']['value']['textLogo'] ?></center>
					</div>
				</div>
				<div class="clsFlexBetweenMid wr-icon-cart-hotline">
					<div class="box-hotline">
						<span>Hotline: <strong class="so_dien_thoai"><?php echo @$themeSetting['Option']['value']['hotline'] ?></strong></span>
					</div>
					<div class="box-icon-cart">
						<span class="clsFlexCenterMid count-number-order count-number-order-pc"><?php echo  @count($_SESSION['orderProducts']) ?></span>
						<img src="<?php echo $urlThemeActive ?>/assets/images/iconCart.png" alt="">
					</div>
					<div class="languageFlag">
						<div class="vietnamese">
							<a href="https://ligidoctorclinic.com/"><img src="<?php echo $urlThemeActive ?>/assets/images/coVN.png" alt=""></a>
						</div>
						<div class="english">
							<a href="https://en.ligidoctorclinic.com/"><img src="<?php echo $urlThemeActive ?>/assets/images/coUK.png" alt=""></a>
						</div>
					</div>
				</div>
			</div>
			<div class="col-12 col-sm-12 col-md-12 set-pd-0 menu">
				<div class="wr-menu">
					<div class="clsFlexBetweenMid box-menu">
						<?php $menuLigi = getMenusDefault();
						if(!empty($menuLigi)) {
							foreach ($menuLigi as $key => $value) { ?>
							<div class="item-menu <?php echo !empty($value['sub'])?'item-active':''; ?>"><a href="<?php echo !empty($value['sub'])?'javascript:void(0);':@$value['url']; ?>"><?php echo @$value['name'] ?></a><?php echo !empty($value['sub'])?'<i class="fas fa-chevron-down"></i>':''; ?>
							</div>
							<?php
							if(!empty($value['sub'])) { ?>
								<div class="sub-menu-item clsFlexBetween">
								<?php foreach ($value['sub'] as $key2 => $value2) { ?>
									<ul>
										<li><a href="javascript:void(0);"><?php echo @$value2['name'] ?></a></li>
										<?php if(!empty($value2['sub'])) { 
											foreach ($value2['sub'] as $key3 => $value3) { ?>
											<li><a href="<?php echo @$value3['url'] ?>"><?php echo @$value3['name'] ?><i class="fa fa-angle-double-right" aria-hidden="true"></i></a></li>
											<?php
											}
										?>
										<?php
										} ?>
									</ul>
								<?php
								} ?>
								</div>
							<?php
							}
							?>
							<?php
							}
						} ?>
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
					if(!empty($menuLigi)) {
						foreach ($menuLigi as $key => $value) { ?>
						<li class="clsFlexBetweenMid" <?php echo !empty($value['sub'])?'data-toggle="collapse" data-target="#c'.$value['id'].'"':''; ?>><a href="<?php echo !empty($value['sub'])?'javascript:void(0);':@$value['url'] ?>"><?php echo @$value['name'] ?></a><?php echo !empty($value['sub'])?'<i class="fas fa-angle-down"></i>':''; ?></li>
						<?php if(!empty($value['sub'])) { ?>
							<ul id="c<?php echo @$value['id'] ?>" class="collapse">
								<?php foreach ($value['sub'] as $key2 => $value2) { ?>
								<li class="clsFlexBetweenMid" <?php echo !empty($value2['sub'])?'data-toggle="collapse" data-target="#c'.$value2['id'].'"':'' ?>><a href="<?php echo !empty($value2['sub'])?'javascript:void(0);':@$value2['url'] ?>"><?php echo @$value2['name'] ?></a><?php echo !empty($value2['sub'])?'<i class="fas fa-angle-down"></i>':''; ?></li>
								<?php if(!empty($value['sub'])) { ?>
									<ul id="c<?php echo @$value2['id'] ?>" class="collapse">
										<?php foreach ($value2['sub'] as $key3 => $value3) { ?>
										<li class="clsFlexBetweenMid" <?php echo !empty($value3['sub'])?'data-toggle="collapse" data-target="#c'.$value3['id'].'"':'' ?>><a href="<?php echo !empty($value3['sub'])?'javascript:void(0);':@$value3['url'] ?>"><?php echo @$value3['name'] ?></a><?php echo !empty($value3['sub'])?'<i class="fas fa-angle-down"></i>':''; ?></li>
										<?php
										} ?>
									</ul>
								<?php	
								} ?>
								<?php
								} ?>
							</ul>
						<?php
						}
						?>
						<?php
						}	
					}
					?>
				</ul>
			</div>
			<form id="formSerchMobile" action="/search" method="GET">
				<input type="text" placeholder="Tìm kiếm" name="key"><button type="submit"><i class="fas fa-search"></i></button>
			</form>
			<div class="wr-info-menu-mobile">
				<p><img src="<?php echo $urlThemeActive ?>/assets/images/contactIconPing.png" alt="">Tòa Nhà Parkview Đồng Phát, Vĩnh Hưng, Hoàng Mai, HN</p>
				<p><img src="<?php echo $urlThemeActive ?>/assets/images/contactIconPhone.png" alt="">0981567000</p>
				<p><img src="<?php echo $urlThemeActive ?>/assets/images/contactIconEmail.png" alt="">ligidoctorclinic@gmail.com</p>
				<p><img src="<?php echo $urlThemeActive ?>/assets/images/contactIconFB.png" alt="">https://www.facebook.com/daotaoligi</p>
			</div>
		</div>
		<div class="colse-menu-mobile mask-mobile">
			
		</div>
	</div>