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
    <script type='text/javascript' src='//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    <?php mantan_header();?>
</head>
<body>

<header>
    <div class="header-pc">
        <div class="content-header">
            <div class="logo"><a href=""><img src="<?php echo $urlThemeActive;?>/images/logo.svg" class="img-fluid" alt=""></a></div>
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
                <div class="h-user text-uppercase">
                    <?php if(empty($session->read('infoMember'))){ ?>
                    <ul>
                        <li><a href="javascript:void(0)" data-toggle="modal" data-target="#modal-register">Đăng ký</a></li>
                        <li><a href="javascript:void(0)" class="login" data-toggle="modal" data-target="#modal-login">Đăng nhập</a></li>
                    </ul>
                    <?php }else{ ?>
                    <div class="icon-user-head">
                        <a href="javascript:void(0)"><img src="<?php echo $urlThemeActive;?>/images/user_head.svg" class="img-fluid" alt=""></a>
                        <div class="sub-user">
                            <p><a href="">My Gallery</a></p>
                            <p><a href="">My Account</a></p>
                            <p><a href="">Đăng xuất</a></p>
                        </div>
                    </div>
                    <?php }?>
                </div> 
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
            </div>
        </div>
    </div>
    <div class="header-mobile">
        <div class="container">
            <div class="content-mm-mobile">
                <div class="logo"><a href=""><img src="<?php echo $urlThemeActive;?>/images/logo.svg" class="img-fluid" alt=""></a></div>
                <div class="right-mb">
                    <ul>
<!--                        <li><a href=""><img src="<?php echo $urlThemeActive;?>/images/new.svg" class="img-fluid" alt=""></a></li>-->
                        <li>
                            <div class="icon-user-head">
                                <a href="javascript:void(0)"><img src="<?php echo $urlThemeActive;?>/images/user_head.svg" class="img-fluid" alt=""></a>
                                <div class="sub-user">
                                    <p><a href="">My Gallery</a></p>
                                    <p><a href="">My Account</a></p>
                                    <p><a href="">Log out</a></p>
                                </div>
                            </div>
                        </li>
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
                    <li><a href="">Home</a></li>
                    <li><a href="">About us</a></li>
                    <li><a href="">Gallery</a></li>
                    <li><a href="">Products</a></li>
                    <li><a href="">List of Distributors</a></li>
                </ul>
            </div>
            <div class="btn-mm-mobile">
                <ul>
                    <li><a href="">REGISTER</a></li>
                    <li><a href="" class="login">LOGIN</a></li>
                </ul>
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
                                <h3>LOGIN <span>Sign in to your account</span></h3>
                            </div>
                            <div class="list-form-item">
                                <div class="item">
                                    <div class="icon"><img src="<?php echo $urlThemeActive;?>/images/login-1.svg" class="img-fluid" alt=""></div>
                                    <div class="txt_field"><input type="text" class="txt_inp" placeholder="Username"></div>
                                </div>
                                <div class="item mb-0">
                                    <div class="icon"><img src="<?php echo $urlThemeActive;?>/images/login-2.svg" class="img-fluid" alt=""></div>
                                    <div class="txt_field"><input type="password" class="txt_inp" placeholder="Password"></div>
                                </div>
                                <div class="item item-forgot text-right"><a href="">forgot password?</a></div>
                                <div class="item item-submit text-center"><input type="submit" class="btn_field" value="SIGN IN"></div>
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
                                <h3>REGISTER <span>Create your account. It’s free and only takes a minute</span></h3>
                            </div>
                            <div class="list-form-item">
                                <div class="item">
                                    <div class="icon"><img src="<?php echo $urlThemeActive;?>/images/reg-1.svg" class="img-fluid" alt=""></div>
                                    <div class="txt_field"><input type="text" class="txt_inp" placeholder="First and Last Name"></div>
                                </div>
                                <div class="item">
                                    <div class="icon"><img src="<?php echo $urlThemeActive;?>/images/reg-2.svg" class="img-fluid" alt=""></div>
                                    <div class="txt_field"><input type="text" class="txt_inp" placeholder="Email"></div>
                                </div>
                                <div class="item">
                                    <div class="icon"><img src="<?php echo $urlThemeActive;?>/images/reg-3.svg" class="img-fluid" alt=""></div>
                                    <div class="txt_field"><input type="text" class="txt_inp" placeholder="Phone number (Used to receive points messages)"></div>
                                </div>
                                <div class="item">
                                    <div class="icon"><img src="<?php echo $urlThemeActive;?>/images/reg-4.svg" class="img-fluid" alt=""></div>
                                    <div class="txt_field"><input type="password" class="txt_inp" placeholder="Password"></div>
                                </div>
                                <div class="item">
                                    <div class="icon"><img src="<?php echo $urlThemeActive;?>/images/reg-5.svg" class="img-fluid" alt=""></div>
                                    <div class="txt_field"><input type="password" class="txt_inp" placeholder="Confirm Password"></div>
                                </div>
                                <div class="item item-policy">
                                    <div class="check-policy">
                                        <input type="checkbox" class="inp_check" id="1001">
                                        <label for="1001">accept the Terms of Use and Privacy Policy</label>
                                    </div>
                                </div>
                                <div class="item item-submit text-center"><input type="submit" class="btn_field" value="SIGN UP"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>