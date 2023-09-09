<?php 
    global $settingThemes;
    global $infoSite ;

?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <?php 
        mantan_header(); 

        if(function_exists('showSeoHome')) showSeoHome();
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo $urlThemeActive; ?>/asset/css/main.css">
    <link rel="stylesheet" href="<?php echo $urlThemeActive; ?>/asset/css/long.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- boostrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- themify -->
    <link href="https://cdn.jsdelivr.net/npm/@icon/themify-icons@1.0.1-alpha.3/themify-icons.min.css" rel="stylesheet">
    <!-- slick -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <script
        type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
    ></script>
    <script
        type="text/javascript"
        src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"
    ></script>
    <script
        type="text/javascript"
        src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"
    ></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-element-bundle.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.19.1/TweenMax.min.js"></script>


</head>
<body>
    <header>
        <section id="header-menu">
            <nav class="navbar navbar-expand-lg">
                <div class="container">
                    <a class="navbar-brand" href="#">
                        <?php
                            if(!empty($infoSite['logo'])){
                                echo'
                                <img src="'.$infoSite['logo'].'" alt="">';
                            }
                        ?>
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarScroll">
                    <ul class="navbar-nav my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                        <?php
                            $menu = getMenusDefault();
                            if(!empty($menu)){
                                foreach($menu as $key => $value){
                                    if(!empty($value->sub)){
                                        echo'
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="'.$value->link.'" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                '.$value->name.'
                                            </a>
                                            <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">';
                                                foreach($value->sub as $sub){
                                                    echo'
                                                    <li><a class="dropdown-item" href="'.$sub->link.'">'.$sub->name.'</a></li>';
                                                }
                                            echo'
                                            </ul>
                                        </li>';
                                    }
                                    else{
                                        echo'
                                        <li class="nav-item">
                                            <a class="nav-link" href="'.$value->link.'">'.$value->name.'</a>
                                        </li>';
                                    }
                                }
                            };

                        ?>
                    </ul>
                    <div class="menu-header-right d-flex">
                        <button class="icon-header icon-glass" href=""><i class="fa-solid fa-magnifying-glass"></i></button>
                        <a class="icon-header" href=""><i class="fa-solid fa-cart-shopping"></i></a>
                    </div>

                  </div>
                </div>
            </nav>
        </section>

        <section id="section-search">
            <div class="container">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Tìm kiếm..." aria-label="Tìm kiếm..." aria-describedby="basic-addon1">
                    <button class="icon-header icon-glass" href=""><i class="fa-solid fa-magnifying-glass"></i></button>
                </div>
            </div>
        </section>
    </header>