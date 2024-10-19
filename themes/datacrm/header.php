<?php 
    global $settingThemes;
    global $urlThemeActive; 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php 
        mantan_header(); 

        if(function_exists('showSeoHome')) showSeoHome();
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo @$urlThemeActive; ?>asset/css/main.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />

    <!-- aos -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

    <!-- Boostrap -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">


    <!-- Fonawesome -->
    <script src="https://kit.fontawesome.com/9163bded0f.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>

    <!-- Swiper -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />


    <!-- Fancyapp -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>

    <!-- Animate CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />


</head>

<body>
    <!--
    <div class="overflow dark" id="preload">
        <div class="circle-line">
            <div class="circle-red">&nbsp;</div>
            <div class="circle-blue">&nbsp;</div>
            <div class="circle-green">&nbsp;</div>
            <div class="circle-yellow">&nbsp;</div>
        </div>
    </div>
    -->

    <header>
        <section id="menu">
            <nav class="navbar navbar-expand-lg bg-body-tertiary">
                <div class="container-fluid">
                    <a class="navbar-brand" href="/"><img src="<?php echo @$settingThemes['logo'];?>" alt=""></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavDropdown">
                        <ul class="navbar-nav">
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

                            <li class="nav-item">
                                <div class="header-btn d-none">
                                    <button class="advise-button" >Đăng kí tư vấn</button>

                                    <!--
                                    <a href=""><img src="<?php echo $urlThemeActive;?>/asset/image/coVN.png" alt=""></a>
                                    <a href=""><img src="<?php echo $urlThemeActive;?>/asset/image/coUK.png" alt=""></a>
                                    -->
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="header-btn">
                        <button class="advise-button" >Đăng kí tư vấn</button>

                        <!--
                        <a href=""><img src="<?php echo $urlThemeActive;?>/asset/image/coVN.png" alt=""></a>
                        <a href=""><img src="<?php echo $urlThemeActive;?>/asset/image/coUK.png" alt=""></a>
                        -->
                    </div>


                </div>
            </nav>
        </section>
    </header>