<?php
    global $urlThemeActive;
    global $settingThemes;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mộc Miên</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="<?= $urlThemeActive?>/styles/globle.css">
  <link rel="stylesheet" href="<?= $urlThemeActive?>/styles/index.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="starability-minified/starability-all.min.css"/>
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
  />
  <?php mantan_header()?>
</head>
<body>
  <div>
    <!-- contact -->
     <div class='content-center text-white bg-green contact'>
        <span class="">Hotline Mộc Miên: <?php echo @$settingThemes['title_main'];?></span>
     </div>
     <!-- responsive search -->
    <div class="container pt-4 d-sm-none d-flex input-group">
      <input type="text" class="form-control" placeholder="Tìm kiếm..." aria-label="Search input" aria-describedby="button-search">
      <button class="btn btn-primary bg-green search-btn" type="button" id="button-search">
        <i class="fas fa-search"></i> <!-- Icon kính lúp -->
      </button>
    </div>
     <!-- header -->
    <div class="container header-container">
      <!-- logo -->
      <div>
        <img src="<?php echo @$settingThemes['image_logo']; ?>" alt="logo">
      </div>
      <!-- Thanh tìm kiếm với icon kính lúp -->
      <div class="d-sm-flex d-none input-group header-search-container">
        <input type="text" class="form-control" placeholder="Tìm kiếm..." aria-label="Search input" aria-describedby="button-search">
        <button class="btn btn-primary bg-green search-btn" type="button" id="button-search">
          <i class="fas fa-search"></i> <!-- Icon kính lúp -->
        </button>
      </div>
      <!-- điều hướng -->
      <div class='d-lg-flex d-none header-nav'>
        <a class='nav-item'>
          <img src="<?= $urlThemeActive?>/assets/images/system-icon.png" alt="">
          <span>Hệ thống cửa hàng</span>
        </a>
        <a class='nav-item'>
          <img src="<?= $urlThemeActive?>/assets/images/card-icon.png" alt="">
          <span>Giỏ hàng</span>
        </a>
        <div class="dropdown nav-item">
          <button class="btn btn-secondary drop-menu-2" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="<?= $urlThemeActive?>/assets/images/user-icon.png" alt="">
            <span>Tài khoản</span>
            <img src="<?= $urlThemeActive?>/assets/images/a-down.png" alt="">
          </button>
          <ul class="dropdown-menu">
            <li>
              <a class="dropdown-item " href="#">
                <span>Thông tin tài khoản</span>
              </a>
            </li>
            <li>
              <a class="dropdown-item" href="#">
                <span>Đăng xuất</span>
              </a> 
        </div>
      </div>

      <!-- dropdowwn -->
      <div class="dropdown d-lg-none d-block">
        <button class="btn btn-secondary drop-menu" type="button" data-bs-toggle="dropdown" aria-expanded="false">
          <img src="<?= $urlThemeActive?>/assets/images/nav-menu.png" alt="">
          <span>Menu</span>
        </button>
        <ul class="dropdown-menu">
          <li>
            <a class="dropdown-item nav-item" href="#">
              <img src="<?= $urlThemeActive?>/assets/images/system-icon.png" alt="">
              <span>Hệ thống cửa hàng</span>
            </a>
          </li>
          <li>
            <a class="dropdown-item nav-item" href="#">
              <img src="<?= $urlThemeActive?>/assets/images/card-icon.png" alt="">
              <span>Giỏ hàng</span>
            </a>
          </li>
          <li>
            <a class="dropdown-item nav-item" href="#">
              <img src="<?= $urlThemeActive?>/assets/images/user-icon.png" alt="">
              <span>Tài khoản</span>
            </a> 
      </div>
    </div>

    <!-- điều hướng -->
    <div class='content-center bg-green navigation'>
      <div class='container nav-container'>
        <a class='sp-container-2'>
          <img src="<?php echo @$urlThemeActive; ?>/assets/images/nav-menu.png" alt="">
        </a>
        <?php 
          $menu = getMenusDefault();
        ?>
        <?php if(!empty($menu)): ?>
          <?php foreach($menu as $key => $value): ?>
            <?php if(!empty($value->sub)): ?>
              <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="javascript:void(0);" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <?php echo $value->name; ?>
                  </a>
                  <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                    <?php foreach ($value->sub as $sub): ?>
                    <li><a class="dropdown-item" href="<?php echo $sub->link; ?>"><?php echo $sub->name; ?></a></li>
                    <?php endforeach; ?>
                  </ul>
              </li>
              <?php else: ?>
                <li class="nav-item">
                  <a class="nav-link" href="<?php echo $value->link; ?>"><span><?php echo $value->name; ?></span></a>
                </li>
            <?php endif; ?>
          <?php endforeach; ?>
        <?php endif; ?>
      </div>
    </div>