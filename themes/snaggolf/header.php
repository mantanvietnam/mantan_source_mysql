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
                            
                            <span class="nav-link button-link d-none d-lg-block">
                                <button class="custom-button button-reg-sm" data-bs-toggle="modal" data-bs-target="#DangKyTuVan">Đăng kí tư vấn</button>
                            </span>
                            <span class="nav-link button-link d-flex d-lg-none justify-content-center">
                                <button class="custom-button button-reg" data-bs-toggle="modal" data-bs-target="#DangKyTuVan">Đăng kí tư vấn</button>
                            </span>
                            <a class="nav-link d-none d-lg-flex" href="#">
                                <!-- <button class="border-0 d-flex align-items-center">
                                    <img src="<?= $urlThemeActive ?>assets/img/nav-icon.png" alt="">
                                </button> -->
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
                <?php 
                    // global $modelOption;
                    // $listData= $modelOption->getOption('defaultMenuMantan');
                    // $menus= $modelOption->getOptionById('65c204f10cbee1587e8b4567');
                    // if(!empty($menus['Option']['value']['category'])){
                    //     foreach ($menus['Option']['value']['category'] as $categoryMenu) {  
                    //         echo '<a class="nav-link" href="'.$categoryMenu['url'].'">'.$categoryMenu['name'].'</a>';
                    //     }
                    // }
                ?>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
    </div>