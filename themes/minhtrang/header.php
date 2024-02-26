<?php $setting = setting(); ?>
<!doctype html>
<html lang="vi">
<head>
    <?php 
        global $themeSettings;
        mantan_header();
        if (function_exists('showSeoHome')) { 
            showSeoHome(); 
        }
        if (function_exists('showContentShareFacebook')) { 
            showContentShareFacebook(); 
        } 
    ?>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- --CSS-- -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css">
    <link rel="stylesheet" href="<?php echo$urlThemeActive;?>/index.css">
    <link rel="stylesheet" href="<?php echo$urlThemeActive;?>/owlcarousel/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="<?php echo$urlThemeActive;?>/owlcarousel/assets/owl.theme.default.min.css">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="<?php echo$urlThemeActive;?>/owlcarousel/owl.carousel.min.js"></script>
    <?php mantan_header();?>
</head>

<body>
    <script>
        $(document).ready(function() {
            // var top = $("#header").offset().top;
            var top = 300;
            $(window).scroll(function() {
                var y = $(this).scrollTop();
                if (y > top) {
                    $(".r-425 img").addClass('animate__rotateIn');
                    $("a.backtop").css({
                        'opacity': '1',
                        'visibility': 'visible'
                    });
                } else {
                    $("a.backtop").css({
                        'opacity': '0',
                        'visibility': 'hidden'
                    });
                }
            });
            $('a.backtop').click(function() {
                $('body, html').animate({
                    scrollTop: '0'
                }, 700);
                return false
            });
            $('a.btn-search').click(function() {
                $('input.search').toggleClass('d-un');
            })
        });
    </script>
    <!-- ====MENU==== -->
    <header>
        <nav class="navbar navbar-expand-md navbar-dark" style="background-color: #111;">
            <div class="container">
                <div class="mr-auto order-0">
                    <a class="navbar-brand mx-auto" href="/"><img src="<?php echo @$setting['logo']; ?>" alt=""></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-collapse2">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
                <div class="navbar-collapse collapse w-100 order-1 dual-collapse2">
                    <ul class="navbar-nav ml-auto">
                       <?php  
                                $menus = getMenusDefault();  
                                if (!empty($menus)) {  
                                    foreach ($menus as $categoryMenu) {  
                                        if (!empty($categoryMenu['sub'])) {  
                                            echo '<li class="list-inline-item hassub">  
                                            <a href="javascript:void(0);" title="">' . $categoryMenu['name'] . '<span class="caret"></span></a>  

                                            <ul class="rs list-unstyled menusub">';  
                                            foreach ($categoryMenu['sub'] as $subMenu) {  
                                                echo '<li><a href="' . $subMenu['link'] . '">' . $subMenu['name'] . '</a></li>';  
                                            }  
                                            echo '</ul>  


                                            </li>  ';  
                                        } else {  
                                            echo '<li class="nav-item ">  
                                                    <a class="nav-link"  href="' . $categoryMenu['link'] . '">' . $categoryMenu['name'] . '</a>  
                                            </li> ';  
                                        }  
                                    }  
                                }  
                            ?> 
                    </ul>
                </div>
            </div>
        </nav>
    </header>