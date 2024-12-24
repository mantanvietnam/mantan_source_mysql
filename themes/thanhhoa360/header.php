<?php

global $urlThemeActive;
global $isHome;
$setting = setting();
?>

<style>
  .header-container{
    background-color: brown;
  }
  
</style>
<!DOCTYPE html>
<html lang="vn">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php 
        mantan_header(); 

        if(function_exists('showSeoHome')) showSeoHome();
    ?>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="<?= $urlThemeActive ?>thanhhoa/css/style.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
  <!-- Mapbox CSS (nếu muốn tùy biến thêm) -->
  <link rel="stylesheet" href="https://unpkg.com/mapbox-gl/dist/mapbox-gl.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
  <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

</head>
<body>
  <div>
    <!-- header -->
    <div class='header-container'>
      <!-- Thanh navigation -->
      <div class='nav-container d-lg-flex d-none'>
        <!-- logo -->
        <div class='d-flex align-items-center gap-3'>
          <img src="<?php echo $setting['image_logo'] ?>" alt="logo">
          <span class='city-name'>Thanh Hóa 360°</span>
        </div>

        <!-- navigation -->
        <!-- <div class='nav-items'>
          <div class="btn-group nav-item-header">
            <button type="button" class="btn dropdown-toggle dropdown-list-location" data-bs-toggle="dropdown" aria-expanded="false">
              Danh mục điểm đến
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
              <li><button class="dropdown-item" type="button">Bắc Kan</button></li>
              <li><button class="dropdown-item" type="button">Phu Thọ</button></li>
              <li><button class="dropdown-item" type="button">Tây Ninh</button></li>
            </ul>
          </div>
          <div class="nav-link">
            <a href="#news"><span>Tin tức - Sự kiện</span></a>
          </div>
          <div class="nav-link">
            <a href="#map-page"><span>Bản đồ số</span></a>
          </div>
          <div class="nav-link">
            <a href=""><span>Liên hệ</span></a>
          </div>
        </div> -->
        <div class="nav-items">
        <?php
        $menu = getMenusDefault();
        
        if (!empty($menu)) {
            foreach ($menu as $key => $value) {
                if (empty($value['sub'])) {
                    echo '<div class="nav-link">
                            <a href="'.$value['link'].'"><span>'.$value['name'].'</span></a>
                            </div>';
                } else {
                    echo '<div class="btn-group nav-item-header">
                            <button type="button" class="btn dropdown-toggle dropdown-list-location" data-bs-toggle="dropdown" aria-expanded="false">
                                '.$value['name'].'
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">';
                    foreach ($value['sub'] as $keys => $values) {
                        echo '<li><a class="dropdown-item" href="'.$values['link'].'">'.$values['name'].'</a></li>';
                    }
                    echo '</ul>
                            </div>';
                }
            }
        }
        ?>
        </div>
      </div>

      <!-- thanh nav responsive mobile -->
      <nav class="navbar navbar-expand-lg navbar-light bg-light nav-res d-lg-none">
        <div class="container-fluid">
          <!-- <a class="navbar-brand" href="#">Navbar</a> -->
          <div class='d-flex align-items-center gap-3'>
            <img src="<?php echo $setting['image_logo'] ?>" alt="logo">
            <span class='city-name city-name-res'>Thanh Hóa 360°</span>
            <!-- Ngôn ngữ -->
          </div>
            
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <?php
            $menu = getMenusDefault();
            if (!empty($menu)) {
                foreach ($menu as $key => $value) {
                    if (empty($value['sub'])) {
                        echo '<li class="nav-item">
                                <a class="nav-link active text-header" aria-current="page" href="'.$value['link'].'">'.$value['name'].'</a>
                                </li>';
                    } else {
                        echo '<li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-header" href="#" id="navbarDropdown-'.$key.'" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    '.$value['name'].'
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown-'.$key.'">';
                        foreach ($value['sub'] as $keys => $values) {
                            echo '<li><a class="dropdown-item text-header" href="'.$values['link'].'">'.$values['name'].'</a></li>';
                        }
                        echo '</ul>
                                </li>';
                    }
                }
            }
            ?>
            </ul>
          </div>
        </div>
      </nav>