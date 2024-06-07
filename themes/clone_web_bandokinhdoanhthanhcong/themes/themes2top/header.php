
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial
    -scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?= $urlThemeActive?>/asset/css/main.css">
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

    <?php 
        mantan_header();
     
    ?>
</head>

<body>
    <div class="intro">
        <h1 class="logo-header">
            <div class="loader">
                <div class="dot"></div>
                <div class="dot"></div>
                <div class="dot"></div>
                <div class="dot"></div>
                <div class="dot"></div>
                <div class="dot"></div>
                <div class="dot"></div>
                <div class="dot"></div>
                <div class="dot"></div>
            </div>
        </h1>
    </div>
    <header>
        
        <section id="menu">
            <nav class="navbar navbar-expand-lg bg-body-tertiary">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">
                        <div class="image-header">
                            <img src="<?php echo @$setting['logo'];?>" alt="">
                        </div>
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavDropdown">
                        <ul class="navbar-nav">
                        <?php  
                            $menus = getMenusDefault();  
                            if (!empty($menus)):  
                                foreach ($menus as $categoryMenu):  
                                    if (!empty($categoryMenu['sub'])):  
                        ?>
                                        <li class="nav-link">  
                                            <a href="javascript:void(0);" title="">
                                                <?php echo $categoryMenu['name']; ?>
                                                <span class="caret"></span>
                                            </a>  

                                            <ul class="dropdown-menu">
                                                <?php foreach ($categoryMenu['sub'] as $subMenu): ?>
                                                    <li><a class="dropdown-item" href="<?php echo $subMenu['link']; ?>"><?php echo $subMenu['name']; ?></a></li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </li>
                        <?php 
                                    else:  
                        ?>
                                        <li class="nav-item ">  
                                            <a class="nav-link" href="<?php echo $categoryMenu['link']; ?>"><?php echo $categoryMenu['name']; ?></a>  
                                        </li> 
                        <?php 
                                    endif;  
                                endforeach;  
                            endif;  
                        ?>
                            <li class="nav-item">
                                <div class="header-btn d-none">
                                    <button class="advise-button">Đăng kí tư vấn</button>
                                    <a href=""><img src="<?=$urlThemeActive?>asset/image/coVN.png" alt=""></a>
                                    <a href=""><img src="<?=$urlThemeActive?>asset/image/coUK.png" alt=""></a>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="header-btn">
                        <button class="advise-button">Đăng kí tư vấn</button>
                        <a href=""><img src="<?=$urlThemeActive?>asset/image/coVN.png" alt=""></a>
                        <a href=""><img src="<?=$urlThemeActive?>asset/image/coUK.png" alt=""></a>
                    </div>
                </div>
            </nav>
        </section>
    </header>
  
    <!-- <div>
        Facebook:
        <a href="<?php echo !empty(@$setting['facebook']) ? htmlspecialchars(@$setting['facebook']) : ''; ?>">facebook ne</a>
    </div> -->
