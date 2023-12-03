<!DOCTYPE html>
<html lang="en">

<head>
 

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!--link css-->
    <link rel="stylesheet" type="text/css" title="" href="<?php echo $urlThemeActive;?>/css/lib/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" title="" href="<?php echo $urlThemeActive;?>/css/lib/slick.min.css">
    <link rel="stylesheet" type="text/css" title="" href="<?php echo $urlThemeActive;?>/css/lib/slick-theme.min.css"> 
    <link rel="stylesheet" type="text/css" title="" href="<?php echo $urlThemeActive;?>/css/jquery.mmenu.all.css">
    <link rel="stylesheet" type="text/css" title="" href="<?php echo $urlThemeActive;?>/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <!-- <link rel="stylesheet" type="text/css" title="" href="<?php echo $urlThemeActive;?>/css/update.css"> -->
    <script type='text/javascript' src='//cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js'></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <style>
        @keyframes pulse {
                    0% {
                        transform: scale(1);
                    }


                    50% {
                        transform: scale(0.9);
                    }

                    100% {
                        transform: scale(1)
                    }
         }
    </style>    
    <!-- <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,300;0,6..12,400;0,6..12,500;0,6..12,600;0,6..12,700;1,6..12,300;1,6..12,400;1,6..12,500;1,6..12,600;1,6..12,700&display=swap" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <?php 
        if(empty($isCssHome)){
            echo     
            '<link rel="stylesheet" type="text/css" title="" href="'.$urlThemeActive.'/css/update.css">';
        }
        else{
            echo 
            '
            <link rel="stylesheet" type="text/css" title="" href="'.$urlThemeActive.'/css/style2.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullPage.js/4.0.20/fullpage.css" integrity="sha512-wCVOuVtxsXqrQK7tj9j4BvyfITQmpp7UE7mVilD7aieGLYFEIAa5UKTP1RapOf6dxQ9JIKAneakcyykWG4r4Ow==" crossorigin="anonymous" referrerpolicy="no-referrer" />
            ';
        }
    ?> 

    <?php mantan_header();global $settingThemes;?>
</head>
<body>

<div class="header-mobile-height">
    
</div>

<header>
    <div class="header-pc">
        <div class="content-header">
            <div class="logo"><a href="/"><img src="<?php echo $urlThemeActive;?>/images/logo-godraw.png" class="img-fluid btn-effect" alt=""></a></div>
            <div class="h-menu-right">
                <div class="h-menu">
                    <ul>
                        <?php 
                            $menu = getMenusDefault();

                            if(!empty($menu)){
                                foreach($menu as $key => $value){
                                    if(!empty($value->sub)){
                                        echo '  <li>
                                                    <a href="javascript:void(0);">
                                                        '.$value->name.'
                                                    </a>
                                                    <div class="submenu">
                                                        <ul>';

                                                        foreach ($value->sub as $sub) {
                                                            $active = '';
                                                            if(strpos($urlCurrent, $sub->link) !== false){
                                                                $active = 'active';
                                                            }

                                                            echo '<li><a class="'.$active.'" href="'.$sub->link.'">'.$sub->name.'</a></li>';
                                                        }
                                        echo        '
                                                        </ul>
                                                    </div>
                                                </li>';
                                    }else{
                                        $active = '';
                                        if(strpos($urlCurrent, $value->link) !== false){
                                            $active = 'active';
                                        }

                                        echo '  <li>
                                                    <a class="'.$active.'" href="'.$value->link.'">'.$value->name.'</a>
                                                </li>';
                                    }
                                }
                            }
                        ?>


                    </ul>
                </div>
                <div class="h-user text-uppercase">
                    <?php if(empty($session->read('infoMember'))){ ?>
                    <ul>
                        <li><a href="javascript:void(0)" class="dangky" data-toggle="modal" data-target="#modal-register">Đăng ký</a></li>
                        <li><a href="javascript:void(0)" class="login" data-toggle="modal" data-target="#modal-login">Đăng nhập</a></li>
                    </ul>
                    <?php }else{ ?>
                    <div class="icon-user-head">
                        <a href="javascript:void(0)"><img src="<?php echo $urlThemeActive;?>/images/user_head.svg" class="img-fluid" alt=""></a>
                        <div class="sub-user">
                            <p><a href="/myGallery">Phòng tranh của bạn</a></p>
                            <p><a href="/myOrder">Đơn hàng của bạn</a></p>
                            <p><a href="/changeProfile">Thông tin tài khoản</a></p>
                            <p><a href="/changePassUser">Đổi mật khẩu</a></p>
                            <p><a href="/logoutUser">Đăng xuất</a></p>
                        </div>
                    </div>
                    <?php }?>
                </div> 

                <!--
                <div class="h-translate">
                    <div class="lang-main">
                        <a href="javascript:void(0)">
                            <span><img src="<?php echo $urlThemeActive;?>/images/lang1.svg" class="img-fluid" alt=""></span>
                            <span class="icon">
                                <svg width="14" height="11" viewBox="0 0 14 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.84814 10.0701L0.257812 0.77002H13.4482L6.84814 10.0701Z" fill="white"/>
                                </svg>
                            </span>
                        </a>
                    </div>
                    <div class="sub-lang">
                        <ul>
                            <li><a href=""><img src="<?php echo $urlThemeActive;?>/images/lang1.svg" class="img-fluid" alt=""></a></li></li>
                            <li><a href=""><img src="<?php echo $urlThemeActive;?>/images/lang1.svg" class="img-fluid" alt=""></a></li></li>
                        </ul>
                    </div>
                </div>
                -->

                <!-- Doi ngon ngu -->
                <div class="h-translate">
                    <div class="lang-main">
                        <a href="javascript:void(0)">
                            <span><img src="/themes/godraw/images/lang1.svg" class="img-fluid" alt=""></span>
                            <span class="icon">
                                <svg width="14" height="11" viewBox="0 0 14 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.84814 10.0701L0.257812 0.77002H13.4482L6.84814 10.0701Z" fill="white"></path>
                                </svg>
                            </span>
                        </a>
                    </div>
                    <div class="sub-lang">
                        <ul>
                            <!-- <li><a href=""><img src="/themes/godraw/images/lang1.svg" class="img-fluid" alt=""></a></li> -->
                            <li><a href=""><img src="/themes/godraw/images/comy.png" class="img-fluid" alt=""></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-mobile">
        <div class="container">
            <div class="content-mm-mobile">
                <div class="logo"><a href="/"><img src="<?php echo $urlThemeActive;?>/images/logo-godraw.png" class="img-fluid" alt=""></a></div>

                <div class="h-translate">
                    <div class="lang-main">
                        <a href="javascript:void(0)">
                            <span><img src="/themes/godraw/images/lang1.svg" class="img-fluid" alt=""></span>
                            <span class="icon">
                                <svg width="14" height="11" viewBox="0 0 14 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.84814 10.0701L0.257812 0.77002H13.4482L6.84814 10.0701Z" fill="white"></path>
                                </svg>
                            </span>
                        </a>
                    </div>
                    <div class="sub-lang">
                        <ul>
                            <!-- <li><a href=""><img src="/themes/godraw/images/lang1.svg" class="img-fluid" alt=""></a></li> -->
                            <li><a href=""><img src="/themes/godraw/images/comy.png" class="img-fluid" alt=""></a></li>
                        </ul>
                    </div>
                </div>
                
                <div class="header-new-icon">        
                    <a href="https://godraw.vn/tin-moi-nhat.html"><img style="animation: 0.5s infinite pulse;" src="/themes/godraw/images/new-icon.png" class="img-fluid" alt="" width="37px;" ></a>    
                </div>
                <div class="right-mb">
                    <ul>
                        <?php if(!empty($session->read('infoMember'))){ ?>
                        <li>
                            <div class="icon-user-head">
                                <a href="javascript:void(0)"><img src="<?php echo $urlThemeActive;?>/images/user_head.svg" class="img-fluid" alt=""></a>
                                <div class="sub-user">
                                    <p><a href="/myGallery">Phòng tranh của bạn</a></p>
                                    <p><a href="/myOrder">Đơn hàng của bạn</a></p>
                                    <p><a href="/changeProfile">Thông tin tài khoản</a></p>
                                    <p><a href="/changePassUser">Đổi mật khẩu</a></p>
                                    <p><a href="/logoutUser">Đăng xuất</a></p>
                                </div>
                            </div>
                        </li>
                        <?php }?>
                        <li><a href="javascript:void(0)" class="mm-bar"><img src="<?php echo $urlThemeActive;?>/images/bar.svg" class="img-fluid" alt=""></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="nav-mobile text-center">
            <div class="close-mm"><a href="javascript:void(0)"><img src="<?php echo $urlThemeActive;?>/images/close.svg" class="img-fluid" alt=""></a></div>
            <div class="logo-mm"><img src="<?php echo $urlThemeActive;?>/images/logo-menu.svg" class="img-fluid" alt=""></div>
            <div class="menu-mm-mobie">
                <ul>
                    <?php 
                        if(!empty($menu)){
                            foreach($menu as $key => $value){
                                if(!empty($value->sub)){
                                    echo '  <li>
                                                <a href="javascript:void(0);">
                                                    '.$value->name.'
                                                </a>
                                                <div class="submenu">
                                                    <ul>';

                                                    foreach ($value->sub as $sub) {
                                                        echo '<li><a href="'.$sub->link.'">'.$sub->name.'</a></li>';
                                                    }
                                    echo        '
                                                    </ul>
                                                </div>
                                            </li>';
                                }else{
                                    echo '  <li>
                                                <a href="'.$value->link.'">'.$value->name.'</a>
                                            </li>';
                                }
                            }
                        }
                    ?>
                </ul>
            </div>
            <div class="btn-mm-mobile">
                <?php if(empty($session->read('infoMember'))){ ?>
                <ul>
                    <li><a href="javascript:void(0)" data-toggle="modal" data-target="#modal-register">ĐĂNG KÝ</a></li>
                    <li><a href="javascript:void(0)" class="login" data-toggle="modal" data-target="#modal-login">ĐĂNG NHẬP</a></li>
                </ul>
                <?php }?>
            </div>
        </div>
    </div>


    <!-- modal user -->

    <div class="modal fade" id="modal-login">
        <div class="modal-dialog dialog-form">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="content-form-modal">
                        <button type="button" class="close" data-dismiss="modal"><img src="<?php echo $urlThemeActive;?>/images/close.svg" class="img-fluid" alt=""></button>
                        <div class="modal-form">
                            <div class="head-form">
                                <h3>ĐĂNG NHẬP</h3>

                                <p class="button-login-red">
                                    <a href="/login" class="">*ĐẠI LÝ ĐĂNG NHẬP</a>
                                </p>
                            </div>
                            <div class="list-form-item">
                                <form action="/loginUser" method="POST">
                                    <input type="hidden" name="_csrfToken" value="<?php echo $csrfToken;?>">

                                    <div class="item">
                                        <div class="icon"><img src="<?php echo $urlThemeActive;?>/images/login-1.svg" class="img-fluid" alt=""></div>
                                        <div class="txt_field"><input type="text" name="username" required class="txt_inp" placeholder="Tài khoản người dùng"></div>
                                    </div>
                                    
                                    <div class="item mb-0">
                                        <div class="icon"><img src="<?php echo $urlThemeActive;?>/images/login-2.svg" class="img-fluid" alt=""></div>
                                        <div class="txt_field"><input type="password" name="password" required class="txt_inp" placeholder="Mật khẩu"></div>
                                    </div>
                                    
                                    <div class="item item-forgot text-right">
                                        <a href="">Quên mật khẩu?</a>
                                    </div>
                                    
                                    <div class="item item-submit">
                                        <input type="submit" class="btn_field" value="ĐĂNG NHẬP">
                                      
                                        
                                    </div>

                                   
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-register">
        <div class="modal-dialog dialog-form">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="content-form-modal">
                        <button type="button" class="close" data-dismiss="modal"><img src="<?php echo $urlThemeActive;?>/images/close.svg" class="img-fluid" alt=""></button>
                        <div class="modal-form">
                            <div class="head-form">
                                <h3>ĐĂNG KÝ <span>Tạo tài khoản miễn phí</span></h3>
                            </div>
                            <div class="list-form-item">
                                <form action="/register" method="POST">
                                    <input type="hidden" name="_csrfToken" value="<?php echo $csrfToken;?>">

                                    <div class="item">
                                        <div class="icon"><img src="<?php echo $urlThemeActive;?>/images/reg-1.svg" class="img-fluid" alt=""></div>
                                        <div class="txt_field"><input type="text" name="name" required class="txt_inp" placeholder="Họ tên"></div>
                                    </div>
                                    <div class="item">
                                        <div class="icon"><img src="<?php echo $urlThemeActive;?>/images/reg-1.svg" class="img-fluid" alt=""></div>
                                        <div class="txt_field"><input type="text" name="nickname" required class="txt_inp" placeholder="Bút danh"></div>
                                    </div>
                                    <div class="item">
                                        <div class="icon"><img src="<?php echo $urlThemeActive;?>/images/reg-2.svg" class="img-fluid" alt=""></div>
                                        <div class="txt_field"><input type="text" name="email" required class="txt_inp" placeholder="Email"></div>
                                    </div>
                                    <div class="item">
                                        <div class="icon"><img src="<?php echo $urlThemeActive;?>/images/reg-3.svg" class="img-fluid" alt=""></div>
                                        <div class="txt_field"><input type="text" name="phone" required class="txt_inp" placeholder="Số điện thoại"></div>
                                    </div>
                                    <div class="item">
                                        <div class="icon"><img src="<?php echo $urlThemeActive;?>/images/reg-4.svg" class="img-fluid" alt=""></div>
                                        <div class="txt_field"><input type="password" name="password" required class="txt_inp" placeholder="Mật khẩu"></div>
                                    </div>
                                    <div class="item">
                                        <div class="icon"><img src="<?php echo $urlThemeActive;?>/images/reg-5.svg" class="img-fluid" alt=""></div>
                                        <div class="txt_field"><input type="password" name="password_again" required class="txt_inp" placeholder="Nhập lại mật khẩu"></div>
                                    </div>
                                    <div class="item item-policy">
                                        <div class="check-policy">
                                            <input type="checkbox" class="inp_check" id="1001" required value="1">
                                            <label for="1001">Chấp nhận Điều khoản sử dụng và Chính sách quyền riêng tư</label>
                                        </div>
                                    </div>
                                    <div class="item item-submit text-center">
                                        <input type="submit" class="btn_field" value="ĐĂNG KÝ">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>