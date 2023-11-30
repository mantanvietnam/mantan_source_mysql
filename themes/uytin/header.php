<?php global $themeSettings;?>
<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <!-- Favicons -->
  <link href="<?php echo $urlThemeActive;?>assets/img/favicon.png" rel="icon">
  <link href="<?php echo $urlThemeActive;?>assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" integrity="sha512-b2QcS5SsA8tZodcDtGRELiGv5SaKSk1vDHDaQRda0htPYWZ6046lr3kJ5bAAQdpV2mmA/4v0wQF9MyU6/pDIAg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <link href="<?php echo $urlThemeActive;?>assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="<?php echo $urlThemeActive;?>assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="<?php echo $urlThemeActive;?>assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="<?php echo $urlThemeActive;?>assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="<?php echo $urlThemeActive;?>assets/css/style.css" rel="stylesheet">
  <link href="<?php echo $urlThemeActive;?>assets/css/my_style.css" rel="stylesheet">
  
  <link href="<?php echo $urlThemeActive;?>assets/css/booking.css" rel="stylesheet">
  <link href="<?php echo $urlThemeActive;?>assets/css/plugins.css" rel="stylesheet">
  <link href="<?php echo $urlThemeActive;?>assets/css/owl.carousel.min.css" rel="stylesheet">
  <link href="<?php echo $urlThemeActive;?>assets/css/owl.theme.default.min.css" rel="stylesheet">
  <link href="<?php echo $urlThemeActive;?>assets/css/swiper.min.css" rel="stylesheet">

  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.min.js" integrity="sha512-WW8/jxkELe2CAiE4LvQfwm1rajOS8PHasCCx+knHG0gBHt8EXxS6T6tJRTGuDQVnluuAvMxWF4j8SNFDKceLFg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <?php 
      mantan_header(); 

      if(function_exists('showSeoHome')) showSeoHome();
  ?>
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header">
    <div class="container">
      <div class="row">
        <div class="col-md-2 col-3">
          <a href="/" class="logo d-flex align-items-center">
              <img src="<?php echo @$themeSettings['logo']; ?>" alt="">
              <!-- <span>FlexStart</span> -->
            </a>
        </div>
        <div class="col-md-10 col-9">
          <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
            <div  data-aos-delay="600">
              <div class="text-center">
                
              </div>
            </div>

            <nav id="navbar" class="navbar">
              <ul>
                <?php 
                  $menu = getMenusDefault();

                  if(!empty($menu)){
                      foreach($menu as $key => $value){
                          if(!empty($value->sub)){
                              echo '  <li class="dropdown">
                                          <a href="javascript:void(0);">
                                              <span>'.$value->name.'</span> <i class="bi bi-chevron-down"></i>
                                          </a>
                                          <ul>';

                                              foreach ($value->sub as $sub) {
                                                  echo '<li><a href="'.$sub->link.'">'.$sub->name.'</a></li>';
                                              }
                              echo        '</ul>
                                      </li>';
                          }else{
                              echo '  <li>
                                          <a class="nav-link scrollto" href="'.$value->link.'">'.$value->name.'</a>
                                      </li>';
                          }
                      }
                  }
                ?>
              </ul>
              <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

          </div>
        </div>
      </div>
    </div>
  </header><!-- End Header -->