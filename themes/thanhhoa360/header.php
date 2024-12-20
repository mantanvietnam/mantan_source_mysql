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
    <link rel="stylesheet" href="<?= $urlThemeActive ?>thanhhoa/css/style.css">

    <?php if (@$isHome == false): ?>
        <!-- FONTAWESOME 6 -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
        <!-- Bootstrap and Custom CSS -->
        <link rel="stylesheet" href="<?= $urlThemeActive ?>tayho/assets/css/bootstrap.css">
        <link rel="stylesheet" href="<?= $urlThemeActive ?>tayho/css/header.css">
        <link rel="stylesheet" href="<?= $urlThemeActive ?>tayho/css/footer.css">
        <link rel="stylesheet" href="<?= $urlThemeActive ?>tayho/css/main.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <?php else: ?>
        <link rel="stylesheet" href="<?= $urlThemeActive ?>maichau/css/main.css?time=100021">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/css/bootstrap.min.css" crossorigin="anonymous" referrerpolicy="no-referrer"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="./style.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
  <!-- Mapbox CSS (nếu muốn tùy biến thêm) -->
  <link rel="stylesheet" href="https://unpkg.com/mapbox-gl/dist/mapbox-gl.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <?php endif; ?>

    <?php mantan_header(); ?>
</head>
<body>

<header>
    <section id="header">
        <div class='header-container'>
            <!-- Desktop Navigation -->
            <div class='nav-container d-lg-flex d-none'>
                <!-- Logo -->
                <div class='d-flex align-items-center gap-3'>
                    <img src="<?php echo $setting['image_logo'] ?>" alt="logo">
                    <span class='city-name'>Thanh Hóa</span>
                </div>

                <!-- Navigation Menu -->
                <div class='nav-items'>
                    <?php
                    $menu = getMenusDefault();
                    if (!empty($menu)):
                        foreach ($menu as $value):
                            if (empty($value['sub'])):
                                echo '<div class="nav-link">
                                        <a href="' . $value['link'] . '"><span>' . $value['name'] . '</span></a>
                                      </div>';
                            else:
                                echo '<div class="btn-group nav-item-header">
                                        <button 
                                            type="button" 
                                            class="btn dropdown-toggle dropdown-list-location" 
                                            data-bs-toggle="dropdown" 
                                            aria-expanded="false">
                                            ' . $value['name'] . '
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">';
                                foreach ($value['sub'] as $subValue):
                                    echo '<li><a class="dropdown-item" href="' . $subValue['link'] . '">' . $subValue['name'] . '</a></li>';
                                endforeach;
                                echo '</ul>
                                      </div>';
                            endif;
                        endforeach;
                    endif;
                    ?>
                </div>
            </div>

            <!-- Mobile Navigation -->
            <nav class="navbar navbar-expand-lg navbar-light bg-light nav-res d-lg-none">
                <div class="container-fluid">
                    <!-- Logo -->
                    <div class='d-flex align-items-center gap-3'>
                        <img src="<?= $setting['image_logo'] ?>" alt="logo">
                        <span class='city-name city-name-res'>Thanh Hóa</span>
                    </div>
                    <!-- Toggler -->
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMobile" aria-controls="navbarMobile" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <!-- Mobile Menu -->
                    <div class="collapse navbar-collapse" id="navbarMobile">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <?php
                            if (!empty($menu)):
                                foreach ($menu as $value):
                                    if (empty($value['sub'])):
                                        echo '<li class="nav-item">
                                                <a class="nav-link text-header" href="' . $value['link'] . '">' . $value['name'] . '</a>
                                              </li>';
                                    else:
                                        echo '<li class="nav-item dropdown">
                                                <a class="nav-link dropdown-toggle text-header" href="#" id="navbarDropdown' . $value['name'] . '" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    ' . $value['name'] . '
                                                </a>
                                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown' . $value['name'] . '">';
                                        foreach ($value['sub'] as $subValue):
                                            echo '<li><a class="dropdown-item text-header" href="' . $subValue['link'] . '">' . $subValue['name'] . '</a></li>';
                                        endforeach;
                                        echo '</ul>
                                              </li>';
                                    endif;
                                endforeach;
                            endif;
                            ?>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </section>

</body>
</html>
