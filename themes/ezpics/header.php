<?php global $settingThemes;?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo $urlThemeActive;?>asset/css/main.css?time=<?php echo  getdate()[0]; ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- boostrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

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
      <?php 
        mantan_header(); 

        if(function_exists('showSeoHome')) showSeoHome();
    ?>
    
</head>

<body>
    <header>
        <section class="section-header">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid header-menu-mobile">
                    <button class="button-header">
                        <i class="fa-solid fa-bars"></i>
                    </button>

                    <div class="logo-header">
                        <a href="https://ezpics.vn/"><img src="https://designer.ezpics.vn/plugins/ezpics_designer/view/home/assets/img/avatar-ezpics.png" alt=""></a>
                    </div>
                    
                    <div class="menu-mobile">
                        <ul class="navbar-nav mb-2 mb-lg-0">
                            <?php 
                            $menu = getMenusDefault();

                            if(!empty($menu)){
                                foreach($menu as $key => $value){
                                    if(!empty($value->sub)){
                                        echo '  <li class="nav-item dropdown">
                                                    <a class="nav-link dropdown-toggle" href="javascript:void(0);" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        '.$value->name.'
                                                    </a>
                                                    <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">';

                                                        foreach ($value->sub as $sub) {
                                                            echo '<li><a class="dropdown-item" href="'.$sub->link.'">'.$sub->name.'</a></li>';
                                                        }
                                        echo        '</ul>
                                                </li>';
                                    }else{
                                        echo '  <li class="nav-item">
                                                    <a class="nav-link" href="'.$value->link.'">'.$value->name.'</a>
                                                </li>';
                                    }
                                }
                            }
                        ?>
                        </ul>
                    </div>
                </div>

                <div class="container-fluid">
                    <div class="navbar-header collapse navbar-collapse" id="navbarTogglerDemo01">
                    <div class="col-5 header-menu">
                        <ul class="navbar-nav mb-2 mb-lg-0">

                        <?php 
                            $menu = getMenusDefault();

                            if(!empty($menu)){
                                foreach($menu as $key => $value){
                                    if(!empty($value->sub)){
                                        echo '  <li class="nav-item dropdown">
                                                    <a class="nav-link dropdown-toggle" href="javascript:void(0);" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        '.$value->name.'
                                                    </a>
                                                    <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">';

                                                        foreach ($value->sub as $sub) {
                                                            echo '<li><a class="dropdown-item" href="'.$sub->link.'">'.$sub->name.'</a></li>';
                                                        }
                                        echo        '</ul>
                                                </li>';
                                    }else{
                                        echo '  <li class="nav-item">
                                                    <a class="nav-link" href="'.$value->link.'">'.$value->name.'</a>
                                                </li>';
                                    }
                                }
                            }
                        ?>
                        </ul>
                    </div>

                    <div class="col-2">
                        <div class="logo-header">
                            <a href="https://ezpics.vn/"><img src="https://designer.ezpics.vn/plugins/ezpics_designer/view/home/assets/img/avatar-ezpics.png" alt=""></a>
                        </div>
                    </div>
                    

                    <div class="col-5 header-search">
                        <form class="d-flex">
                            <a class="download-button-header" href="https://smartqr.vn/r/gjib5dhkl79y"><i class="fa-solid fa-cloud-arrow-down"></i> TẢI EZPICS MIỄN PHÍ</a>
                        </form>
                    </div>
                    </div>
                </div>
            </nav>
        </section>
    </header>