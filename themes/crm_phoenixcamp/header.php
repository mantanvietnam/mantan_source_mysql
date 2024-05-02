<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" integrity="sha512-jnSuA4Ss2PkkikSOLtYs8BlYIeeIK1h99ty4YfvRPAlzr377vr3CXDb7sb7eEEBYjDtcYj+AjBH3FLv5uSJuXg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js" integrity="sha512-7Pi/otdlbbCR+LnW+F7PwFcSDJOuUJB3OxtEHbg4vSMvzvJjde4Po1v4BR9Gdc9aXNUNFVUY+SK51wWT8WF0Gg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="<?php echo $urlThemeActive;?>/assert/css/style.css">
    <link rel="stylesheet" href="<?php echo $urlThemeActive;?>/assert/css/stylePlus.css">

    <!-- slick -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.css" integrity="sha512-wR4oNhLBHf7smjy0K4oqzdWumd+r5/+6QO/vDda76MW5iug4PT7v86FoEkySIJft3XA0Ae6axhIvHrqwm793Nw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js" integrity="sha512-HGOnQO9+SP1V92SrtZfjqxxtLmVzqZpjFFekvzZVWoiASSQgSr4cw9Kqd2+l8Llp4Gm0G8GIFJ4ddwZilcdb8A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>



    
    <?php 
        global $setting_value;

        mantan_header(); 
    ?>

    <link rel="icon" type="image/x-icon" href="<?php echo @$setting_value['logo'];?>" />
</head>

<body>
    <style type="text/css">
        <?php 
            // if(!empty($setting_value['background_image_1'])){
            //     echo '.wrapper{
            //         background-image: url(\''.$setting_value['background_image_1'].'\');
            //         background-position: center center;
            //         background-repeat: no-repeat;
            //         background-size: cover;
            //         opacity: 1;
            //         transition: background .3s, border-radius .3s, opacity .3s;
            //     }';
            // }

            if(!empty($setting_value['background_image_2'])){
                echo '.register{
                    background-image: url(\''.$setting_value['background_image_2'].'\');
                }';
            }

            if(!empty($setting_value['background_image_3'])){
                echo '.footer{
                    background-image: url(\''.$setting_value['background_image_3'].'\');
                }';
            }
            

            if(!empty($setting_value['background_color'])){
                echo '.header{
                    background-color: '.$setting_value['background_color'].';
                }';
            }

            if(!empty($setting_value['background_color'])){
                echo'@media (max-width: 768px){
                    .header-navbar {
                        background-color: '.$setting_value['background_color'].';
                        position: relative;
                        z-index: 99;
                        padding: 21px;
                        text-align: center;
                    }
                }';
            }

        ?>
    </style>

    <div class="wrapper" >
        <header class="header">
            <nav class="header-top navbar navbar-expand-lg">
                <div class="container-fluid">
                        <div class="header-logo">
                            <a href="/">
                                <img class="header-logo-img" src="<?php echo @$setting_value['logo'];?>" alt="">
                            </a>
                        </div>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="header-navbar collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class=" navbar-nav me-auto mb-2 mb-lg-0">
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
                       
                            <button onclick="window.location = '/login';" class="btn-login"><span>ĐĂNG NHẬP </span><i class="fa-solid fa-arrow-right"></i></button>
                        </div>
                    </div>
            </nav>
        </header>