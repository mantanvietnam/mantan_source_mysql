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
  <link href="<?php echo $urlThemeActive;?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo $urlThemeActive;?>assets/vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
  <link href="<?php echo $urlThemeActive;?>assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="<?php echo $urlThemeActive;?>assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="<?php echo $urlThemeActive;?>assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="<?php echo $urlThemeActive;?>assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="<?php echo $urlThemeActive;?>assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="<?php echo $urlThemeActive;?>assets/css/style.css" rel="stylesheet">
  <link href="<?php echo $urlThemeActive;?>assets/css/my_style.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" title="" href="https://viwacon.vn/app/Theme/ms30/accets/css/style.css">
  <link href="<?php echo $urlThemeActive;?>assets/css/booking.css" rel="stylesheet">
  <link href="<?php echo $urlThemeActive;?>assets/css/plugins.css" rel="stylesheet">
  <link href="<?php echo $urlThemeActive;?>assets/css/owl.carousel.min.css" rel="stylesheet">
  <link href="<?php echo $urlThemeActive;?>assets/css/owl.theme.default.min.css" rel="stylesheet">
  <link href="<?php echo $urlThemeActive;?>assets/css/swiper.min.css" rel="stylesheet">

  <?php 
      mantan_header(); 

      if(function_exists('showSeoHome')) showSeoHome();
  ?>
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top ">
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
                        <a href="" class="btn-get-started scrollto d-inline-flex align-items-center justify-content-center align-self-center" data-bs-toggle="modal" data-bs-target="#exampleModal">
                          <span style="font-size: 11px;"><?php echo @$themeSettings['submit1']; ?></span>
                         
                        </a>
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