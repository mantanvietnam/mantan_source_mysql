<?php 
    global $urlThemeActive;
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <?php 
        mantan_header(); 

        if(function_exists('showSeoHome')) showSeoHome();
    ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?php echo $urlThemeActive; ?>">
    
    <!-- CSS -->
    <!-- Lib -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="<?php echo $urlThemeActive; ?>/assets/css/bootstrap.css">
    <!-- Main -->
    <link rel="stylesheet" href="<?php echo $urlThemeActive; ?>/assets/css/main.css">
</head>

<body>
    <!-- Header -->
  
    <header>
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light py-0">
                <div class="container-fluid">
                    <a class="navbar-brand" href="https://snaggolf.vn/">
                        <img src="<?php echo $urlThemeActive; ?>/assets/img/Logo.png" alt="">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fa-solid fa-bars"></i>
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
                        <div class="navbar-nav">
                            <?php 
                            $menu = getMenusDefault();
                            ?>
                            <?php if(!empty($menu)): ?>
                                <?php foreach($menu as $key => $value): ?>
                                    <?php if(!empty($value->sub)): ?>
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="javascript:void(0);" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <?php echo $value->name; ?>
                                            </a>
                                            <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                                                <?php foreach ($value->sub as $sub): ?>
                                                    <li><a class="dropdown-item" href="<?php echo $sub->link; ?>"><?php echo $sub->name; ?></a></li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </li>
                                    <?php else: ?>
                                        <li class="nav-item">
                                            <a class="nav-link" href="<?php echo $value->link; ?>"><?php echo $value->name; ?></a>
                                        </li>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            <span class="nav-link button-link d-none d-lg-block">
                                <button class="custom-button button-reg-sm" data-bs-toggle="modal" data-bs-target="#DangKyTuVan">Đăng kí tư vấn</button>
                            </span>
                            <span class="nav-link button-link d-flex d-lg-none justify-content-center">
                                <button class="custom-button button-reg" data-bs-toggle="modal" data-bs-target="#DangKyTuVan">Đăng kí tư vấn</button>
                            </span>
                            <a class="nav-link d-none d-lg-flex" href="#">
                                <button class="border-0 d-flex align-items-center" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                                    <i class="fa-solid fa-bars"></i>
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <div class="contain">
            <?php if(!empty($idmenu)): ?>
                <?php foreach($idmenu as $key => $value): ?>
                <a class="nav-link" href="<?=$value->link?>"><?=$value->name?></a>
                <?php endforeach; ?>
            <?php endif; ?>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
    </div>