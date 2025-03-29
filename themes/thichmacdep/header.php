
<?php
    global $urlThemeActive;
    global $settingThemes;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php 
      mantan_header(); 

      if(function_exists('showSeoHome')) showSeoHome();
          global $settingThemes;
  ?>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mộc Miên</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="<?php echo @$urlThemeActive; ?>styles/globle.css">
  <link rel="stylesheet" href="<?php echo @$urlThemeActive; ?>styles/index.css">
  <link rel="stylesheet" href="<?php echo @$urlThemeActive; ?>/styles/dathang.css" />
  <link rel="stylesheet" href="<?php echo @$urlThemeActive; ?>/styles/chitietSP.css" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="starability-minified/starability-all.min.css"/>
  <script src="https://cdn.tailwindcss.com"></script>
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
  />
  <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      type="text/css"
      href="starability-minified/starability-all.min.css"
    />

</head>
<style>
  /* Container chính */
  .header-search-container {
    width: 100%; /* Chiều rộng full */
    max-width: 500px; /* Giới hạn chiều rộng tối đa */
    margin: 0 auto; /* Căn giữa container */
    display: flex;
    align-items: center;
    position: relative;
  }

  /* Input tìm kiếm */
  .header-search-container input.form-control {
    flex: 1; /* Input chiếm tối đa không gian */
    height: 40px; /* Chiều cao input */
    padding: 0 12px; /* Khoảng cách nội dung trong input */
    border: 1px solid #ccc; /* Viền màu xám nhạt */
    border-radius: 20px 0 0 20px; /* Bo góc bên trái */
    outline: none;
    font-size: 14px; /* Kích thước chữ */
    transition: border-color 0.3s ease; /* Hiệu ứng khi hover */
  }

  .header-search-container input.form-control:focus {
    border-color: #4CAF50; /* Màu viền khi focus */
  }

  /* Nút tìm kiếm */
  .header-search-container button.search-btn {
    height: 40px; /* Chiều cao khớp với input */
    padding: 0 16px; /* Khoảng cách nội dung nút */
    border: none; /* Xóa viền */
    background-color: #7AC5E4; /* Màu nền xanh lá */
    color: #fff; /* Màu chữ */
    border-radius: 0 20px 20px 0; /* Bo góc bên phải */
    font-size: 16px; /* Kích thước chữ */
    cursor: pointer; /* Thay đổi con trỏ khi hover */
    transition: background-color 0.3s ease; /* Hiệu ứng màu khi hover */
  }

  .header-search-container button.search-btn:hover {
    background-color: #45A049; /* Màu nền khi hover */
  }

  /* Icon kính lúp */
  .header-search-container button.search-btn i {
    margin: 0;
    font-size: 18px; /* Kích thước icon */
  }

</style>
<body>
  <div>
    <!-- contact -->
     <div class='content-center text-white bg-green contact'>
        <span class="">Hotline Thích Mặc Đẹp: <?php echo @$settingThemes['title_main'];?></span>
     </div>
     <!-- responsive search -->
     <div class="mx-mobilemobile md:mx-6 lg:mx-16 xl:mx-20 pt-4 d-sm-none d-flex input-group">
        <form action="/search-product" method="get" class="d-flex w-100">
          <input 
            type="text" 
            class="form-control" 
            name="key" 
            placeholder="Tìm kiếm..." 
            aria-label="Search input" 
            aria-describedby="button-search">
          <button 
            class="btn btn-primary bg-green search-btn" 
            type="submit" 
            id="button-search">
            <i class="fas fa-search"></i> <!-- Icon kính lúp -->
          </button>
        </form>
      </div>
     <!-- header -->
    <div class="mx-mobile md:mx-6 lg:mx-16 xl:mx-20 header-container">
      <!-- logo -->
      <a href="/">
  <img src="<?php echo @$settingThemes['image_logo']; ?>" alt="logo" style="max-width: 150px; height: auto; margin: 10px 0;">
</a>
      <!-- Thanh tìm kiếm với icon kính lúp -->
      <div class="d-sm-flex d-none input-group header-search-container">
        <form action="/search-product" method="get" style= "display:flex">
          <input 
            type="text" 
            class="form-control" 
            name="key"
            value="<?php echo @$_GET['key']; ?>" 
            placeholder="Tìm kiếm..." 
            aria-label="Search input" 
            aria-describedby="button-search">
            
          <button class="btn btn-primary bg-green search-btn" type="submit" id="button-search">
            <i class="fas fa-search"></i> <!-- Icon kính lúp -->
          </button>
        </form>
      </div>
      <!-- điều hướng -->
      <div class='d-lg-flex d-none header-nav'>
        <a class='nav-item'>
          <img src="<?= $urlThemeActive?>/assets/images/system-icon.png" alt="">
          <span>Hệ thống cửa hàng</span>
        </a>
        <a href="/cart" class='nav-item'>
          <img src="<?= $urlThemeActive?>/assets/images/card-icon.png" alt="">
          <span>Giỏ hàng</span>
        </a>
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
            <a class="dropdown-item nav-item" href="/cart">
              <img src="<?= $urlThemeActive?>/assets/images/card-icon.png" alt="">
              <span>Giỏ hàng</span>
            </a>
          </li>
      </div>
    </div>

    <!-- điều hướng -->
    <div class='content-center bg-green navigation'>
      <div class='mx-mobile md:mx-6 lg:mx-16 xl:mx-20 nav-container'>
            <?php 
                $menu = getMenusDefault();
            ?>
            <?php if(!empty($menu)): ?>
              <?php foreach($menu as $key => $value): ?>
                <?php if(!empty($value->sub)): ?>
                      <li class="nav-item dropdown">
                          <a class="nav-link dropdown-toggle" href="javascript:void(0);" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                              <span><?php echo $value->name; ?></span>
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
