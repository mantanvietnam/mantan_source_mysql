<?php 
global $urlThemeActive;
$setting = setting();?>
<!DOCTYPE html>
<html lang="en">

<head>
      <?php 
        mantan_header(); 

        if(function_exists('showSeoHome')) showSeoHome();
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <title>Document</title> -->
    <link rel="stylesheet" href="<?php echo $urlThemeActive ?>/css/main.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />

    <!-- SLick -->

    <!-- Boostrap -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">


    <!-- Fonawesome -->
    <script src="https://kit.fontawesome.com/9163bded0f.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</head>

<body>
    <section id="header">

        <!-- Menu -->
        <div class="main-header" id="menu-top">
            <nav class="navbar navbar-expand-lg menu-nav">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">
                        <img src="<?php echo @$setting['logo'];?>">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fa-solid fa-bars" style="color: #ffffff;"></i>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                               <!--  <?php 
                                                    $menu = getMenusDefault();
                                                  
                                                    if(!empty($menu)){
                                                    foreach($menu as $key => $value){
                                                      if(empty($value['sub'])){
                                                 ?>
                                                    <li class="nav-item">
                                                        <a class="nav-link " aria-current="page" href="<?php echo $value['link']  ?>"><?php echo $value['name']  ?></a>
                                                    </li>
                                                <?php   }else{  ?>
                                                    <li class="nav-item dropdown">
                                                        <a class="nav-link dropdown-toggle" href="<?php echo $value['link']  ?>" role="button" data-bs-toggle="dropdown"
                                                           aria-expanded="false">
                                                            <?php echo $value['name']  ?>
                                                        </a>
                                                        <ul class="dropdown-menu">
                                                            <?php  foreach($value['sub'] as $keys => $values) { ?>
                                                            <li><a class="dropdown-item" href="<?php echo $values['link']  ?>"><?php echo $values['name']  ?></a></li>
                                                            <?php } ?>
                                                        </ul>
                                                    </li>
                                                    <?php }}} ?> -->
                            <li class="nav-item">
                                <a class="nav-link active" href="#">Trang chủ</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#about">Giới thiệu</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#services">Dịch vụ</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#related-images">Hình ảnh cá nhân</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#testimonial">Phản hồi</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#blog">Khóa học</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#contact">Liên hệ</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>

    
    