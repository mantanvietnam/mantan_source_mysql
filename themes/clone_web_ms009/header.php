<?php 
global $urlThemeActive;
$setting = setting();?>
<!DOCTYPE html>
<html lang="vi">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
         <?php 
        mantan_header(); 

        //if(function_exists('showSeoHome')) showSeoHome();
    ?>
        <!-- Fontawesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
         <!-- Boostrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script> 
        <link rel="stylesheet" href="<?php echo $urlThemeActive ?>/asset/css/style.css">    
        <link rel="stylesheet" href="<?php echo $urlThemeActive ?>/asset/css/stylePlus.css">    
        <link rel="stylesheet" href="<?php echo $urlThemeActive ?>/asset/css/style_product.css">    

        <!-- Magnific Popup core CSS file -->
        <link rel="stylesheet" href="<?php echo $urlThemeActive ?>/asset/magnific-popup/magnific-popup.css">
    
        <!-- Aos -->
        <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
       
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
    </head>
<body>
    <header>
        <div class="navbar-header" id="menu-top">
            <nav class="navbar navbar-expand-lg" >
                <div class="container">
                    <a class="navbar-brand" href="/">
                        <div class="image-header">
                            <img src="<?php echo @$setting['logo'];?>" alt="">
                        </div>
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fa-solid fa-bars"></i>                    
                    </button>
                    <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                        <ul class="navbar-nav">
                            <?php 
                                $menu = getMenusDefault();
                              
                                if(!empty($menu)){
                                    foreach($menu as $key => $value){
                                        if(empty($value['sub'])){
                                            echo '  <li class="nav-item">
                                                        <a class="nav-link " aria-current="page" href="'.$value['link'].'">'.$value['name'].'</a>
                                                    </li>';
                                        }else{  
                                            echo '  <li class="nav-item dropdown">
                                                        <a class="nav-link dropdown-toggle" href="'.$value['link'].'" role="button" data-bs-toggle="dropdown"
                                                           aria-expanded="false">'.$value['name'].'</a>
                                                        
                                                        <ul class="dropdown-menu">';
                                                            foreach($value['sub'] as $keys => $sub) { 
                                                                echo '<li><a class="dropdown-item" href="'.$sub['link'].'">'.$sub['name'].'</a></li>';
                                                            }
                                            echo        '</ul>
                                                    </li>';
                                        }
                                    }
                                } 
                            ?>
                        </ul>

                        <div class="cart-box">
                                <a href="/cart" class="cart-menu">
                                    <i class="fa-solid fa-cart-shopping"></i>
                                    <span class="cart-number">
                                        <?php 
                                        global $session;

                                        if(!empty($session->read('product_order'))){
                                            echo count($session->read('product_order'));
                                        }else{
                                            echo 0;
                                        }
                                        ?>
                                    </span>
                                </a>
                            </div>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    