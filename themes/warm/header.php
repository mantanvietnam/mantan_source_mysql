<?php global $settingThemes;?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <?php 
        mantan_header(); 

        if(function_exists('showSeoHome')) showSeoHome();
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="
https://cdn.jsdelivr.net/npm/odometer@0.4.8/odometer.min.js
"></script>
<link href="
https://cdn.jsdelivr.net/npm/odometer@0.4.8/themes/odometer-theme-default.min.css
" rel="stylesheet">    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo $urlThemeActive;?>/asset/css/main.css">
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
    <!-- Cuộn trang -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

    <!-- chay so -->    
</head>
<body>
    <header>
        <section id="section-topbar">
            <div class="topbar">
                <div class="container">
                    <div class="row row-topbar">
                        <div class="col-lg-6 col-3 topbar-left">
                            <div class="change-language">
                                <span>English  <i class="fa-solid fa-arrow-down"></i></span>
                                <div class="language-box">
                                    <a href=""><span>Vietnamese</span></a>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-9 topbar-right">
                            <div class="topbar-follow">
                                <span>Follow us: </span>
                                <?php 
                                    if(!empty($settingThemes['youtube'])){
                                        echo '  <a target=”_blank” href="'.$settingThemes['youtube'].'">
                                                    <i class="fa-brands fa-youtube"></i>
                                                </a>';
                                    }

                                    if(!empty($settingThemes['facebook'])){
                                        echo '  <a href="'.$settingThemes['facebook'].'">
                                                    <i class="fa-brands fa-facebook-f"></i>
                                                </a>';
                                    }

                                    if(!empty($settingThemes['instagram'])){
                                        echo '  <a href="'.$settingThemes['instagram'].'">
                                                    <i class="fa-brands fa-instagram"></i>
                                                </a>';
                                    }

                                    if(!empty($settingThemes['tiktok'])){
                                        echo '  <a href="'.$settingThemes['tiktok'].'">
                                                    <i class="fa-brands fa-tiktok"></i>
                                                </a>';
                                    }

                                    if(!empty($settingThemes['twitter'])){
                                        echo '  <a href="'.$settingThemes['twitter'].'">
                                                    <i class="fa-brands fa-twitter"></i>
                                                </a>';
                                    }

                                    if(!empty($settingThemes['linkedIn'])){
                                        echo '  <a href="'.$settingThemes['linkedIn'].'">
                                            <i class="fa-brands fa-linkedin-in"></i>
                                        </a>';
                                    }
                                ?>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="section-menu">
            <div class="container">
                <nav class="navbar navbar-expand-lg">
                    <div class="container-fluid">
                      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                      </button>
                      <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav navbar-header-menu mb-2 mb-lg-0 me-auto">
                            <?php 
                            $menu = getMenusDefault();
                            if(!empty($menu)){
                                foreach($menu as $key => $value){
                                    if(!empty($value->sub)){
                                    echo
                                    '<li class="btn-group dropdown">
                                        <button class="nav-link nav-link-button">
                                            <a class="" href="'.$value->link.'">
                                                '.$value->name.'
                                            </a>
                                        </button>
                                        <span class="dropdown-toggle dropdown-toggle-split button-down-menu" data-bs-toggle="dropdown" aria-expanded="false">
                                            <span class="visually-hidden">Toggle Dropdown</span>
                                        </span>
                                        <ul class="dropdown-menu">';
                                            foreach($value->sub as $sub){
                                                echo'<li><a class="dropdown-item" href="'.$sub->link.'">'.$sub->name.'</a></li>';
                                            }; 
                                    echo'
                                        </ul>
                                    </li>';
                                    }
                                    else{
                                    echo'  
                                    <li class="nav-item">
                                        <a class="nav-link active" aria-current="page" href="'.$value->link.'">'.$value->name.'</a>
                                    </li>';       
                                    }
                                }
                            }
                            ?>

                        </ul>
                        <form class="search-menu d-flex" role="search">
                            <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </form>
                      </div>
                    </div>
                </nav>
            </div>
        </section>
    </header>