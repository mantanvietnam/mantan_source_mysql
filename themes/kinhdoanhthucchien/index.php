<!DOCTYPE html>
<html lang="vi">
<head>
    <?php 
        mantan_header(); 

        if(function_exists('showSeoHome')) showSeoHome();
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo $urlThemeActive;?>/asset/css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- boostrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- slick -->
    <script
        type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
    ></script>
    <script
        type="text/javascript"
        src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"
    ></script>
</head>
<body>
    
    <header>
        <section id="header-menu">
            <nav class="header-menu-navbar navbar navbar-expand-lg bg-body-tertiary">
                <div class="container-fluid">
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="header-menu-collapse collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                      <li class="nav-item header-menu-item">
                        <i class="fa-solid fa-house"></i>
                        <a class="nav-link"  href="/">Trang chủ</a>
                      </li>
                      <li class="nav-item header-menu-item">
                        <i class="fa-solid fa-user"></i>
                        <a class="nav-link" href="#section-present">Quà tặng</a>
                      </li>
                      <li class="nav-item header-menu-item">
                        <i class="fa-regular fa-file-lines"></i>
                        <a class="nav-link" href="#section-content">Nội dung</a>
                      </li>
                      <li class="nav-item header-menu-item">
                        <i class="fa-solid fa-book"></i>
                        <a class="nav-link" target="_blank" href="<?php echo @$settingThemes['link_reg'];?>">Đăng ký khóa học</a>
                      </li>
                      <li class="nav-item header-menu-item">
                        <i class="fa-solid fa-comment"></i>
                        <a class="nav-link" href="#section-learn">Kết quả</a>
                      </li>
                    </ul>
                  </div>
                </div>
            </nav>
        </section>
    </header>
    
    <main>
        <?php if(!empty($settingThemes['name_project'])){ ?>
        <section id="banner" >
            <div class="banner-image" style="background-image: url(<?php echo @$settingThemes['image_bg_1'];?>);"></div>
            <div class="banner-overlay"></div>
            <div class="banner-content">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5 col-md-5">
                            <div class="banner-content-image">
                                <img src="<?php echo @$settingThemes['image_speaker'];?>" alt="">
                                <div class="banner-content-calendar">
                                    <div class="title-calendar">
                                        <p>LỊCH SỰ KIỆN</p>
                                    </div>
                                    <div class="detail-calendar">
                                        <p><?php echo @$settingThemes['time_learning'];?></p>
                                    </div>
                                    <div class="sub-calendar">
                                        <p><?php echo @$settingThemes['commit'];?></p>
                                    </div>
                                </div>
                               
                            </div>
                        </div>

                        <div class="col-lg-7 col-md-7" style="padding-left: 37px;">
                            <div class="banner-content-text">

                                <div class="content-text-title content-text-title2">
                                    <h1><?php echo @$settingThemes['name_project'];?></h1>
                                </div>

                                <div class="content-text-details">
                                    <ul>
                                        <?php 
                                            if(!empty($settingThemes['content_training'])){
                                                $content = nl2br(@$settingThemes['content_training']);
                                                $content = explode('<br />', $content);
                                                foreach ($content as $value) {
                                                    echo '<li>'.$value.'</li>';
                                                }
                                            }
                                        ?>
                                    </ul>
                                </div>

                                <div class="content-text-button">
                                    <a href="<?php echo @$settingThemes['link_reg'];?>">Đăng ký ngay</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    
                </div>
            </div>
        </section>
        <?php }?>

        <!-- Video -->
        <?php if(!empty($settingThemes['call_registration'])){ ?>
        <section id="section-video">
            <div class="container">
                <div class="title-video">
                    <h2><?php echo @$settingThemes['call_registration'];?></h2>   
                </div>

                <div class="video-content">
                    <span><?php echo @$settingThemes['introduce'];?></span>
                </div>
    
                <div class="iframe-video">
                    <?php echo @$settingThemes['video_introduce'];?>
                </div>
            </div> 
        </section>
        <?php }?>

        <!-- NẾU BẠN ĐANG MONG MUỐN -->
        <?php if(!empty($settingThemes['title_demand'])){ ?>
        <section id="section-hope">
            <div class="hope-box">
                <div class="hope-title">
                    <h2><?php echo @$settingThemes['title_demand'];?></h2>
                </div>

                <div class="hope-content">
                    <div class="container">
                        <div class="hope-content-list">
                            <div class="hope-list-description">
                                <h3><?php echo @$settingThemes['des_demand'];?></h3>
                            </div>

                            <div class="hope-list-content">
                                <p class="text-center">
                                    <img width="150" src="<?php echo @$infoSite['logo'];?>" />
                                </p>
                                <ul>
                                    <?php 
                                        if(!empty($settingThemes['content_demand'])){
                                            $content = nl2br(@$settingThemes['content_demand']);
                                            $content = explode('<br />', $content);
                                            foreach ($content as $value) {
                                                echo '<li>'.$value.'</li>';
                                            }
                                        }
                                    ?>
                                </ul>
                            </div>
                            </div>
                            
                    </div>
                    
                </div>
            </div>
        </section>
        <?php }?>

        <!-- NỘI DUNG KHÓA HỌC -->
        <?php if(!empty($settingThemes['content_training'])){ ?>
        <section id="section-content">
            <div class="content-background" style="background-image: url(<?php echo @$settingThemes['image_bg_1'];?>)"></div>
            <div class="content-box">
                <div class="container">
                    <div class="content-description">
                        <span><?php echo @$settingThemes['commit'];?></span>
                    </div>
        
                    <div class="title-content">
                        <h2>CÁC VẤN ĐỀ SẼ ĐƯỢC GIẢI QUYẾT</h2>   
                    </div>
    
                    <div class="content-list">
                        <ul>
                            <?php 
                                if(!empty($settingThemes['content_training'])){
                                    $content = nl2br(@$settingThemes['content_training']);
                                    $content = explode('<br />', $content);
                                    foreach ($content as $value) {
                                        echo '<li>'.$value.'</li>';
                                    }
                                }
                            ?>
                            
                        </ul>
                    </div>

                    <div class="content-text-button">
                        <a href="<?php echo @$settingThemes['link_reg'];?>">Đăng ký ngay</a>
                    </div>
                </div>
            </div>  
        </section>
        <?php }?>

        <!-- NHỮNG ĐIỀU BẠN SẼ HỌC -->
        <?php if(!empty($settingThemes['learn1'])){ ?>
        <section id="section-learn">
            <div class="learn-box">
                <div class="container">
                    <div class="learn-title">
                        <p>NHỮNG ĐIỀU BẠN SẼ CÓ ĐƯỢC</p>
                    </div>

                    <div class="row">
                        <div class="col-lg-4 col-md-4 learn-left">
                            <div class="learn-left-item" style="background-color:url(<?php echo $urlThemeActive;?>/asset/image/learn-orange.svg) ;">
                                <img src="<?php echo $urlThemeActive;?>/asset/image/learn-orange.svg" alt="">
                                <div class="learn-text"><?php echo @$settingThemes['learn2'];?></div>
                            </div>

                            <div class="learn-left-item">
                                <img src="<?php echo $urlThemeActive;?>/asset/image/learn-4.svg" alt="">
                                <div class="learn-text"><?php echo @$settingThemes['learn4'];?></div>
                            </div>

                            <div class="learn-left-item">
                                <img src="<?php echo $urlThemeActive;?>/asset/image/learn6.svg" alt="">
                                <div class="learn-text"><?php echo @$settingThemes['learn6'];?></div>
                            </div>

                            <div class="learn-left-item">
                                <img src="<?php echo $urlThemeActive;?>/asset/image/learn9.svg" alt="">
                                <div class="learn-text"><?php echo @$settingThemes['learn8'];?></div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 learn-center">
                            <img src="<?php echo $urlThemeActive;?>/asset/image/map-success.png" alt="">
                        </div>

                        <div class="col-lg-4 col-md-4 learn-right">
                            <div class="learn-right-item">
                                <img src="<?php echo $urlThemeActive;?>/asset/image/learn-red.svg" alt="">
                                <div class="learn-text"><?php echo @$settingThemes['learn1'];?></div>
                            </div>

                            <div class="learn-right-item">
                                <img src="<?php echo $urlThemeActive;?>/asset/image/learn-orange.svg" alt="">
                                <div class="learn-text"><?php echo @$settingThemes['learn3'];?></div>
                            </div>

                            <div class="learn-right-item">
                                <img src="<?php echo $urlThemeActive;?>/asset/image/learn8.svg" alt="">
                                <div class="learn-text"><?php echo @$settingThemes['learn5'];?></div>
                            </div>

                            <div class="learn-right-item">
                                <img src="<?php echo $urlThemeActive;?>/asset/image/learn5.svg" alt="">
                                <div class="learn-text"><?php echo @$settingThemes['learn7'];?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php }?>

        <!-- Bí quetes -->
        <?php if(!empty($settingThemes['title_return'])){ ?>
        <section id="section-secret">
            <div class="secret-box">
                <div class="container">  
                    <div class="secret-title">
                        <p class="secret-title1"><?php echo @$settingThemes['title_return'];?></p>
                        
                        <div class="secret-title-image">
                            <img src="<?php echo $urlThemeActive;?>/asset/image/light-dividercpng.png" alt="">
                        </div>

                        <div class="secret-title-note">
                            <p><?php echo @$settingThemes['note_return'];?></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-12 secret-item-box">
                            <div class="secret-item">
                                <div class="secret-item-img">
                                    <img src="<?php echo $urlThemeActive;?>/asset/image/icon-secret.svg" alt="">
                                </div>
    
                                <div class="secret-item-text">
                                    <div class="secret-item-detail">
                                        <p><?php echo @$settingThemes['return_1'];?></p>
                                    </div>
                                </div>
                            </div> 
                            <div class="secret-item">
                                <div class="secret-item-img">
                                    <img src="<?php echo $urlThemeActive;?>/asset/image/icon-secret.svg" alt="">
                                </div>
    
                                <div class="secret-item-text">
                                    <div class="secret-item-detail">
                                        <p><?php echo @$settingThemes['return_2'];?></p>
                                    </div>
                                </div>
                            </div> 
                            <div class="secret-item">
                                <div class="secret-item-img">
                                    <img src="<?php echo $urlThemeActive;?>/asset/image/icon-secret.svg" alt="">
                                </div>
    
                                <div class="secret-item-text">
                                    <div class="secret-item-detail">
                                        <p><?php echo @$settingThemes['return_3'];?></p>
                                    </div>
                                </div>
                            </div>     
                        </div>
    
                        <div class="col-lg-6 col-md-6 col-12 secret-item-right secret-item-box">
                            <div class="secret-item">
                                <div class="secret-item-img">
                                    <img src="<?php echo $urlThemeActive;?>/asset/image/icon-secret.svg" alt="">
                                </div>
    
                                <div class="secret-item-text">
                                    <div class="secret-item-detail">
                                        <p><?php echo @$settingThemes['return_4'];?></p>
                                    </div>
                                </div>
                            </div> 
                            <div class="secret-item">
                                <div class="secret-item-img">
                                    <img src="<?php echo $urlThemeActive;?>/asset/image/icon-secret.svg" alt="">
                                </div>
    
                                <div class="secret-item-text">
                                    <div class="secret-item-detail">
                                        <p><?php echo @$settingThemes['return_5'];?></p>
                                    </div>
                                </div>
                            </div> 
                            <div class="secret-item">
                                <div class="secret-item-img">
                                    <img src="<?php echo $urlThemeActive;?>/asset/image/icon-secret.svg" alt="">
                                </div>
    
                                <div class="secret-item-text">
                                    <div class="secret-item-detail">
                                        <p><?php echo @$settingThemes['return_6'];?></p>
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div>

                    <div class="secret-bottom">
                        <div class="secret-bottom-text">VÀ CÒN NHIỀU ĐIỀU KHÁC CHỜ BẠN KHÁM PHÁ</div>
                        <img src="<?php echo $urlThemeActive;?>/asset/image/secretbot.svg" alt="">
                    </div>
                </div>
            </div>
        </section>
        <?php }?>

        <!-- Ai là người chia sẻ -->
        <?php if(!empty($settingThemes['name_speaker'])){ ?>
        <section id="section-who" >
            <div style="background-image: url(<?php echo @$settingThemes['image_bg_2'];?>);" class="who-background"></div>
            <div class="who-overlay"></div>
            <div class="who-content">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-12 who-left">
                            <div class="who-image">
                                <img src="<?php echo @$settingThemes['image_speaker2'];?>" alt="">
                                <div class="who-image-name">
                                    <div class="who-image-name-left">
                                        <img src="<?php echo $urlThemeActive;?>/asset/image/svgwho1-28.svg" alt="">
                                        
                                    </div>
                                    <div class="who-image-name-right">
                                        <img src="<?php echo $urlThemeActive;?>/asset/image/svgwho2.svg" alt="">
                                    </div>
                                    <div class="who-image-name-text">
                                        <span><?php echo @$settingThemes['name_speaker'];?></span>
                                    </div>
                                </div>
                            </div>
                            

                        </div>

                        <div class="col-lg-8 col-md-8 col-12 who-right">
                            <div class="who-title">
                                <h2><?php echo @$settingThemes['title_info_speaker'];?></h2>
                            </div>

                            <div class="who-content-right">
                                <?php echo nl2br(@$settingThemes['info_speaker_introduce']);?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php }?>

        <!-- LÝ DO BẠN NÊN THAM GIA CHƯƠNG TRÌNH-->
        <?php if(!empty($settingThemes['title_reason_join'])){ ?>
        <section id="section-reason" style="background-image: url(<?php echo $urlThemeActive;?>/asset/image/reasonbackground.svg)">
            <div class="reason-box">
                <div class="container">
                    <div class="reason-title">
                        <h2><?php echo @$settingThemes['title_reason_join'];?></h2>
                        <div class="reason-divide"></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-7 col-md-7 col-12">
                            <div class="reason-content">
                                <?php echo nl2br(@$settingThemes['info_reason_join']);?>
                            </div>
                        </div>
    
                        <div class="col-lg-5 col-md-5 col-12">
                            <img src="<?php echo @$settingThemes['image_speaker3'];?>">
                        </div>
                    </div>
                 
                </div>
            </div>
        </section>
        <?php }?>

        <!-- Chương trình phù hợp với ai -->
        <?php if(!empty($settingThemes['should_join'])){ ?>
        <section id="section-should">
            <div class="should-background" style="background-image: url(<?php echo @$settingThemes['image_bg_3'];?>);" ></div>
            <div class="should-overlay"></div>
            <div class="should-content">
                <div class="container">
                    <div class="should-title">
                        <h2>AI NÊN THAM GIA KHÓA HỌC NÀY</h2>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="should-item">
                                <div class="should-title-item">
                                    <button>Phù hợp với</button>
                                </div>

                                <div class="should-list">
                                    <ul>
                                        <?php 
                                            if(!empty($settingThemes['should_join'])){
                                                $content = nl2br(@$settingThemes['should_join']);
                                                $content = explode('<br />', $content);
                                                foreach ($content as $value) {
                                                    echo '<li>'.$value.'</li>';
                                                }
                                            }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-12 shouldnot-box">
                            <div class="shouldnot-item">
                                <div class="shouldnot-title-item">
                                    <button>Không phù hợp với</button>
                                </div>

                                <div class="shouldnot-list">
                                    <ul>
                                        <?php 
                                            if(!empty($settingThemes['not_should_join'])){
                                                $content = nl2br(@$settingThemes['not_should_join']);
                                                $content = explode('<br />', $content);
                                                foreach ($content as $value) {
                                                    echo '<li>'.$value.'</li>';
                                                }
                                            }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php }?>

        <!-- Một số hình ảnh -->
        <?php if(!empty($albums)){ ?>
        <section id="section-photo">
            <div class="photo-content">
                <div class="photo-content-detail">
                    <div class="container">
                        <div class="photo-title">
                            <h2>MỘT SỐ HÌNH ẢNH KHÓA HỌC ĐÃ DIỄN RA</h2>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-12 photo-content-item">
                                <div class="photo-image-item">
                                    <?php
                                    if(!empty($albums)){
                                        foreach ($albums as $key => $value) {
                                            echo '<div class="photo-image-item-box">
                                                    <img src="'.$value->image.'" alt="">
                                                </div>';
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>

            </div>
        </section>
        <?php }?>

        <!-- Quà tặng -->
        <?php if(!empty($settingThemes['title_gift'])){ ?>
        <section id="section-present">
            <div class="present-background" style="background-image: url(<?php echo @$settingThemes['image_bg_4'];?>);" ></div>
            <div class="present-overlay"></div>
            <div class="present-content">
                <div class="container">
                    <div class="present-title">
                        <p><?php echo @$settingThemes['title_gift'];?></p>
                    </div>
                    <div class="present-title2">
                        <p><?php echo @$settingThemes['name_project'];?></p>
                    </div>
                    <div class="present-list">
                        <ul>
                            <?php 
                                if(!empty($settingThemes['list_gift'])){
                                    $content = nl2br(@$settingThemes['list_gift']);
                                    $content = explode('<br />', $content);
                                    foreach ($content as $value) {
                                        echo '<li>'.$value.'</li>';
                                    }
                                }
                            ?>
                        </ul>
                    </div>
    
                    <div class="present-total">
                        <p>TỔNG GIÁ TRỊ QUÀ TẶNG LÊN ĐẾN <span class="present-price"><?php echo @$settingThemes['price_gift'];?></span></p>
                    </div>
                </div>
              
            </div>
        </section>
        <?php }?>

        <!-- Mua vé -->
        <?php if(!empty($settingThemes['title_price_1'])){ ?>
        <section id="section-register">
            <div class="register-background" style="background-image: url(<?php echo $urlThemeActive;?>/asset/image/register-background.jpg);" ></div>
            <div class="register-overlay"></div>
            <div class="register-content">
                <div class="container">
                    <div class="register-title-box">
                        <div class="register-title1">
                            <h2><?php echo @$settingThemes['title_keep_place'];?></h2>
                        </div>
                        <div class="register-title2">
                            <h2><?php echo @$settingThemes['des_keep_place'];?></h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-12 register-item">
                            <div class="register-item-box" style="background-image:url(<?php echo $urlThemeActive;?>/asset/image/gold.png) ;">
                                <div class="register-name">
                                    <?php echo @$settingThemes['title_price_1'];?>
                                </div>

                                <div class="register-price-sale">
                                    <p><?php echo @$settingThemes['price_sell_1'];?></p>     
                                </div>

                                <div class="register-price">
                                    <del><?php echo @$settingThemes['price_old_1'];?></del>
                                </div>

                                

                                <div class="register-item-content text-center">
                                    <ul>
                                        <?php 
                                            if(!empty($settingThemes['benefit_1'])){
                                                $content = nl2br(@$settingThemes['benefit_1']);
                                                $content = explode('<br />', $content);
                                                foreach ($content as $value) {
                                                    echo '<li>'.$value.'</li>';
                                                }
                                            }
                                        ?>
                                    </ul>
                                </div>      
                                
                                <div class="register-item-button">
                                    <a href="<?php echo @$settingThemes['link_reg_1'];?>">Đăng ký ngay</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-12 register-item">
                            <div class="register-item-box" style="background-image:url(<?php echo $urlThemeActive;?>/asset/image/vip.png) ;">
                                <div class="register-name">
                                    <?php echo @$settingThemes['title_price_2'];?>
                                </div>
                                

                                <div class="register-price-sale">
                                    <p class="title-vip"><?php echo @$settingThemes['price_sell_2'];?></p>     
                                </div>

                                <div class="register-price">
                                    <del><?php echo @$settingThemes['price_old_2'];?></del>
                                </div>

                                <div class="register-item-content-sale text-center">
                                    <ul>
                                        <?php 
                                            if(!empty($settingThemes['benefit_2'])){
                                                $content = nl2br(@$settingThemes['benefit_2']);
                                                $content = explode('<br />', $content);
                                                foreach ($content as $value) {
                                                    echo '<li>'.$value.'</li>';
                                                }
                                            }
                                        ?>
                                    </ul>
                                </div>      
                                
                                <div class="register-item-button">
                                    <a class="vip" href="<?php echo @$settingThemes['link_reg_2'];?>">Đăng ký ngay</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <?php }?>

    </main>

    

    <footer>
        <section id="section-footer" style="background-image: url(<?php echo $urlThemeActive;?>/asset/image/background-footer.jpg)">
            <div class="footer-overlay"></div>
            <div class="container">
                <div class="footer-box">
                    <div class="footer-top">
                        <div class="row">
                            <div class="col-lg-3 col-md-3 footer-logo">
                                <img src="<?php echo $infoSite['logo'];?>" alt="">
                            </div>

                            <div class="col-lg-6 col-md-6 footer-details">
                                <div class="footer-title">
                                    <p><?php echo @$settingThemes['company'];?></p>
                                </div>

                                <div class="footer-content">
                                    <div class="footer-info footer-address">
                                        <p><span><i class="fa-solid fa-house"></i></span> Địa chỉ: <?php echo $contactSite['address'];?></p> 
                                    </div>
                                    <div class="footer-info footer-hotline">
                                        <p><span><i class="fa-solid fa-phone"></i></span> Điện thoại: <?php echo $contactSite['phone'];?></p> 
                                    </div>
                                    <div class="footer-info footer-email">
                                        <p><span><i class="fa-solid fa-envelope"></i></span> Email: <?php echo $contactSite['email'];?></p> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
    
                    <div class="footer-bottom">
                        <div class="footer-copyright">
                            <p>©2020 Allrights reserved <?php echo $_SERVER['HTTP_HOST'];?></p>
                        </div>

                        <div class="footer-bank">
                            <div class="footer-bank-group">
                                <img src="<?php echo $urlThemeActive;?>/asset/image/visa.svg" alt="">
                                <img src="<?php echo $urlThemeActive;?>/asset/image/mastercard.svg" alt="">
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            
        </section>
    </footer>
    
</body>
</html>