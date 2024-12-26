<?php
global $urlThemeActive;
global $isHome;
$setting = setting();
?>

<!doctype html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= $urlThemeActive ?>tayho/css/thaianh.css">

    <?php  //if(@$isHome==false){ ?>
     <!-- FONTAWESOME 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
          integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>

    <!-- FILE INCLUDE CSS -->
    <link rel="stylesheet" href="<?= $urlThemeActive ?>tayho/assets/css/bootstrap.css">
    <link rel="stylesheet" href="<?= $urlThemeActive ?>tayho/assets/css/slick.css">
    <link rel="stylesheet" href="<?= $urlThemeActive ?>tayho/assets/css/slick-theme.css">

    <link rel="stylesheet" href="<?= $urlThemeActive ?>tayho/css/header.css">
    <link rel="stylesheet" href="<?= $urlThemeActive ?>tayho/css/footer.css">
    <link rel="stylesheet" href="<?= $urlThemeActive ?>tayho/css/particle.css">
    <link rel="stylesheet" href="<?= $urlThemeActive ?>tayho/css/style.css">
    <link rel="stylesheet" href="<?= $urlThemeActive ?>tayho/css/main.css">
    <link rel="stylesheet" href="<?= $urlThemeActive ?>tayho/css/font.css">
    <!-- FILE INCLUDE CSS END -->
    <!-- FILE INCLUDE JS -->
    <!-- MAP JS API -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
          integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
            integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>
    <script src="<?= $urlThemeActive ?>tayho/assets/js/jquery.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= $urlThemeActive ?>tayho/assets/js/slick.min.js"></script>
    <script src="<?= $urlThemeActive ?>tayho/js/jshieu.js"></script>
    <script src="<?= $urlThemeActive ?>tayho/js/slick.js"></script>
    <script src="<?= $urlThemeActive ?>tayho/js/slickslide.js"></script>
    <script src="<?= $urlThemeActive ?>tayho/assets/js/main.js"></script>
    <script src="<?= $urlThemeActive ?>tayho/js/slick.js"></script>

<?php //}else{ ?>
    <link rel="stylesheet" href="<?= $urlThemeActive ?>assets_new/css/page.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css"/>
    <!-- font -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oxygen:wght@300;400;700&family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&family=Roboto:wght@100;300;400;500;700&display=swap" rel="stylesheet">

    <link href="<?= $urlThemeActive ?>assets_new/slider/thumbs2.css" rel="stylesheet" />
    <link href="<?= $urlThemeActive ?>assets_new/slider/thumbnail-slider.css" rel="stylesheet" />
    <script src="<?= $urlThemeActive ?>assets_new/slider/thumbnail-slider.js" type="text/javascript"></script>

<?php //} ?>
   
    <!-- FILE INCLUDE JS END -->
    <?php mantan_header(); ?>


</head>
<body>
    <header class="header">
      <div class="container-fluid">
          <div class="row align-items-center">
              <!-- Logo -->
              <div class="col-md-3 col-6">
                  <div class="header-logo d-flex align-items-center">
                      <img src="<?php echo $setting['image_logo'] ?>" alt="Lào Cai 360" class="img-fluid" style="margin-right: 10px;">
                      <p class="m-0 ml-3"> LÀO CAI 360°</p>
                  </div>
              </div>
  
              <!-- Toggle Button for Mobile -->
              <div class="col-6 d-md-none text-end">
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                      <span class="navbar-toggler-icon"></span>
                  </button>
              </div>
  
              <!-- Navigation Menu -->
              <div class="col-md-7 d-none d-md-block">
                  <nav class="header-nav">
                      <ul class="nav justify-content-center">
                        <?php
                            $menu = getMenusDefault();

                            if(!empty($menu)){
                                foreach($menu as $key => $value){
                                    if(empty($value['sub'])){
                                        echo '<li class="nav-item"><a class="nav-link" href="'.$value['link'].'">'.$value['name'].'</a></li>';
                                    }else{ 
                                        echo '   <li class="nav-item dropdown">
                                                    <a class="nav-link dropdown-toggle" href="'.$value['link'].'" id="destinationDropdown" data-bs-toggle="dropdown" aria-expanded="false"> '.$value['name'].'</a>
                                                    <ul class="dropdown-menu" aria-labelledby="destinationDropdown">';
                                                    foreach($value['sub'] as $keys => $values){  
                                                        echo '<li><a class="dropdown-item my-2" href="'.$values['link'].'">'.$values['name'].'</a></li>';
                                                    }

                                                    echo'</ul>
                                                </li>';
                                    }
                                }
                            } 
                        ?>
                      </ul>
                  </nav>
              </div>
  
              <!-- Responsive Menu for Mobile -->
              <div class="col-12 d-md-none">
                  <div class="collapse" id="navbarContent">
                      <nav class="header-nav">
                          <ul class="nav flex-column text-center">
                            <?php
                                if(!empty($menu)){
                                    foreach($menu as $key => $value){
                                        if(empty($value['sub'])){
                                            echo '<li class="nav-item"><a class="nav-link" href="'.$value['link'].'">'.$value['name'].'</a></li>';
                                        }else{ 
                                            echo '   <li class="nav-item dropdown">
                                                        <a class="nav-link dropdown-toggle" href="'.$value['link'].'" id="destinationDropdownMobile" data-bs-toggle="dropdown" aria-expanded="false"> '.$value['name'].'</a>
                                                        <ul class="dropdown-menu" aria-labelledby="destinationDropdownMobile">';
                                                        foreach($value['sub'] as $keys => $values){  
                                                            echo '<li><a class="dropdown-item my-2" href="'.$values['link'].'">'.$values['name'].'</a></li>';
                                                        }

                                                        echo'</ul>
                                                    </li>';
                                        }
                                    }
                                } 
                            ?>
                          </ul>
                      </nav>
                  </div>
              </div>
          </div>
      </div>
    </header>




