<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php mantan_header();
     global $settingThemes;
     ?>
    <link rel="stylesheet" href="<?php echo $urlThemeActive;?>/asset/css/toptop.css?index=1234358">
    <!-- boostrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- icon -->
    <link rel="icon" sizes="16x16" href="<?= $urlThemeActive?>/asset/image/Logo.png" type="image/png">
    <link rel="icon" sizes="32x32" href="<?= $urlThemeActive?>/asset/image/Logo.png" type="image/png">
    <link rel="icon" sizes="48x48" href="<?= $urlThemeActive?>/asset/image/Logo.png" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <!-- slick -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />

    <body>
        <header style="background-image: url('<?=@$settingThemes['banner']?>');">
            <nav class="navbar navbar-expand-lg navbar-light pos-ab pt-4">
                <div class="container d-flex justify-content-between">
                    
                    <div class="col-lg-5 d-flex align-items-center">
                        <a class="navbar-brand" href="#">
                            <img src="<?= @$settingThemes['logo'];?>" alt="Logo" class="logo">
                        </a>
                    </div>
                    <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navbarNav" style="background-color: white; padding: 10px 20px; border-radius: 27px;">
                        <ul class="navbar-nav">
                        <?php  
                            $menus = getMenusDefault();  
                            if (!empty($menus)):  
                                foreach ($menus as $categoryMenu):  
                                    if (!empty($categoryMenu['sub'])):  
                        ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-white" href="#" id="gioi-thieu-dropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <?php echo $categoryMenu['name']; ?>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="gioi-thieu-dropdown">
                                <?php foreach ($categoryMenu['sub'] as $subMenu): ?>
                                    <li><a class="dropdown-item" href="<?php echo $subMenu['link']; ?>"><?php echo $subMenu['name']; ?></a></li>
                                <?php endforeach; ?>
                                </ul>
                            </li>
                        <?php 
                            else:  
                        ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo $categoryMenu['link']; ?>"><?php echo $categoryMenu['name']; ?></a>
                            </li>
                            <?php 
                            endif;  
                                endforeach;  
                                    endif;  
                        ?>  
                        </ul>
                    </div>
                </div>
            </nav>
         
        </header>