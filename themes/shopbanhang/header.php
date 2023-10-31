<?php
global $urlThemeActive;
$setting = setting();
global $session;
$infoUser = $session->read('infoUser');       
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo $urlThemeActive ?>asset/css/main.css">
    <link rel="stylesheet" href="<?php echo $urlThemeActive ?>asset/css/cssplus.css">
    <link rel="stylesheet" href="<?php echo $urlThemeActive ?>asset/css/mainplus.css">
    <link rel="stylesheet" href="<?php echo $urlThemeActive ?>asset/css/review.css">
    <link rel="stylesheet" href="<?php echo $urlThemeActive ?>asset/css/editcss.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- boostrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- slick -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <script
        type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
    ></script>
    <script
        type="text/javascript"
        src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"
    ></script>
    <script
        type="text/javascript"
        src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"
    ></script>
     <?php mantan_header(); ?>
</head>
<body>
    <header>
        <div class="header-inner">
            <div class="topbar">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-12 topbar-phone">
                            <img src="<?php echo $urlThemeActive ?>asset/image/headphone.png" alt="">&nbsp;
                            <span><?php echo @$setting['phone'] ?></span>
                        </div>
            
                        <div class="col-lg-4 col-md-4 col-sm-4 col-12 topbar-logo">
                            <a href="/"><img src="<?php echo $urlThemeActive ?>asset/image/logo.png" alt=""></a>
                        </div>
            
                        <div class="col-lg-4 col-md-4 col-sm-4 col-12 topbar-group-button">
                            <div class="topbar-button">
                                <img src="<?php echo $urlThemeActive ?>asset/image/user.png" alt="">
                                <?php if(!empty($infoUser)){ ?>
                                    <a href="/infoUser" >Tài khoản của tôi</a>
                                    <a href="/logout" >Đăng xuất</a>
                                <?php }else{ ?>
                                <a href=""  data-bs-toggle="modal" data-bs-target="#exampleModal">Dăng nhập</a>
                            <?php } ?>
                            </div>

                            <div class="topbar-button">
                                <img src="<?php echo $urlThemeActive ?>asset/image/cartitem.png" alt="">
                                <a href="">Giỏ hàng</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mneu-desktop">
                <nav class="navbar-header navbar navbar-expand-lg ">
                    <div class="container-fluid">
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <?php 
                            $menu = getMenusDefault();
                          
                            if(!empty($menu)){
                            foreach($menu as $key => $value){
                              if(empty($value['sub'])){
                         ?>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="<?php echo $value['link']  ?>"><?php echo $value['name']  ?></a>
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
                            <?php }}} ?>
    
                            <li class="nav-item nav-item-image  dropdown ">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Combo quà tặng
                                </a>
                                <ul class="dropdown-menu dropdown-image">
                                    <div class="row">
                                        <div class="col-6 dropdown-image-item">
                                            <a href="<?php echo @$setting['menu_link1'] ?>">
                                                <div class="dropdown-image-item-inner">
                                                    <div class="dropdown-image-item-main">
                                                        <img src="<?php echo @$setting['menu_image1'] ?>" alt="">
                                                    </div>
            
                                                    <div class="dropdown-image-item-title">
                                                        <p><?php echo @$setting['menu_title1']?></p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
    
                                        <div class="col-6 dropdown-image-item">
                                            <a href="<?php echo @$setting['menu_link2'] ?>">
                                                <div class="dropdown-image-item-inner">
                                                    <div class="dropdown-image-item-main">
                                                        <img src="<?php echo @$setting['menu_image2'] ?>" alt="">
                                                    </div>
            
                                                    <div class="dropdown-image-item-title">
                                                        <p><?php echo @$setting['menu_title2'] ?></p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
    
                                        <div class="col-6 dropdown-image-item">
                                            <a href="<?php echo @$setting['menu_link3'] ?>">
                                                <div class="dropdown-image-item-inner">
                                                    <div class="dropdown-image-item-main">
                                                        <img src="<?php echo @$setting['menu_image3'] ?>" alt="">
                                                    </div>
            
                                                    <div class="dropdown-image-item-title">
                                                        <p><?php echo @$setting['menu_title3'] ?></p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
    
                                        <div class="col-6 dropdown-image-item">
                                           <a href="<?php echo @$setting['menu_link4'] ?>">
                                                <div class="dropdown-image-item-inner">
                                                    <div class="dropdown-image-item-main">
                                                        <img src="<?php echo @$setting['menu_image4'] ?>" alt="">
                                                    </div>
            
                                                    <div class="dropdown-image-item-title">
                                                        <p><?php echo @$setting['menu_title4'] ?></p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </ul>
                            </li>
    
                            <li class="nav-item nav-item-last">
                                <a class="nav-link" href="#">Sản phẩm</a>
                            </li>
                        </ul>
                        <form class="menu-form-search d-flex" role="search">
                            <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success button-search" type="submit"><img src="<?php echo $urlThemeActive ?>asset/image/iconsearch.png" alt=""></button>
                        </form>
                        </div>
                    </div>
                </nav>
            </div>

            <!-- mobile -->
            <!-- <div class="menu-mobile">
                <div class="menu-mobile-inner">
                    <div class="menu-mobile-box">
                        <ul>
                            <li>
                                <a href=""><img src="<?php echo $urlThemeActive ?>asset/image/cartitem.png" alt=""></a>
                            </li>
                            
                            <li>
                                <a href=""><img src="<?php echo $urlThemeActive ?>asset/image/cartitem.png" alt=""></a>
                            </li>

                            <li>
                                <a href=""><img src="<?php echo $urlThemeActive ?>asset/image/user.png" alt=""></a>
                            </li>

                            <li>
                                <a href=""><img src="<?php echo $urlThemeActive ?>asset/image/user.png" alt=""></a>
                            </li>

                            <li>
                                <a href=""><img src="<?php echo $urlThemeActive ?>asset/image/cartitem.png" alt=""></a>
                            </li>

                            <li>
                                <a href=""><img src="<?php echo $urlThemeActive ?>asset/image/cartitem.png" alt=""></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div> -->


        </div>
        <!-- Đăng nhập -->
        <div class="modal-login">
           <!-- Button trigger modal -->
            <!-- <button type="button" class="btn btn-primary">
                Launch static backdrop modal
            </button> -->
            
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-6 col-12 modal-left">
                                    <div class="modal-left-heading">
                                        <p>Xin chào!</p>
                                    </div>

                                    <div class="modal-left-sub">
                                        <p>Đăng nhập hoặc Tạo tài khoản</p>
                                    </div>

                                    <div class="modal-left-login-social">
                                        <div class="login-social-item">
                                            <i class="fa-brands fa-facebook" style="color: #0D6EFD"></i><a href="">Tiếp tục với Facebook</a>
                                        </div>
                                        <div class="login-social-item">
                                            <i class="fa-brands fa-google" style="color: red"></i><a href="">Tiếp tục với Google</a>
                                        </div>
                                        <div class="login-social-item">
                                            <i class="fa-brands fa-apple"></i><a href="">Tiếp tục với Apple</a>
                                        </div>
                                         <div class="row">
              <div class="col-sm-12 text-center mb-2">
                  <div class="login_f gg">
                      <?php
                      global $google_clientId;
                      global $google_clientSecret;
                      global $google_redirectURL;

                      $client = new Google_Client();
                      $client->setClientId($google_clientId);
                      $client->setClientSecret($google_clientSecret);
                      $client->setRedirectUri($google_redirectURL);
                      $client->setApplicationName('Đăng nhập Ezpics');
                      //$client->setApprovalPrompt('force');

                      $client->addScope('https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/plus.me');

                      $authUrl = $client->createAuthUrl();
                   
                      echo '<a class="btn btn-danger" href="'.filter_var($authUrl, FILTER_SANITIZE_URL).'"><i class="bx bxl-google"></i> Đăng nhập với Google</a>';
                      ?>
                  </div>
              </div> 
            </div>
                                    </div>

                                    <div class="modal-left-bottom">
                                        <p>Chưa có tài khoản ? <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal1">Tạo tài khoản</button></p>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12 modal-right">
                                    <div class="or-login">
                                        <span>Hoặc tiếp tục bằng</span>
                                    </div>

                                    <form  action="/login" method="post">
                                        <input type="hidden" value="<?php echo $csrfToken;?>" name="_csrfToken">
                                        <div class="mb-3">
                                            <input type="text" class="form-control" name="email" id="" placeholder="Số điện thoại">
                                        </div>

                                        <div class="mb-3">
                                            <input type="password" class="form-control" name="pass" id="" placeholder="Mật khẩu">
                                        </div>
                                        <button type="submit" class="btn btn-primary">Tiếp tục</button>
                                        <a href="" data-bs-toggle="modal" data-bs-target="#exampleModal3">quên mật khẩu </a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Đăng ký -->
        <div class="modal-login">
          <!--   <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal1">
                Launch static backdrop modal
            </button> -->
            
            <!-- Modal -->
            <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6 col-12 modal-left">
                                <div class="modal-left-heading">
                                    <p>Xin chào!</p>
                                </div>

                                <div class="modal-left-sub">
                                    <p>Đăng nhập hoặc Tạo tài khoản</p>
                                </div>

                                <div class="modal-left-login-social">
                                    <div class="login-social-item">
                                        <i class="fa-brands fa-facebook" style="color: #0D6EFD"></i><a href="">Tiếp tục với Facebook</a>
                                    </div>
                                    <div class="login-social-item">
                                        <i class="fa-brands fa-google" style="color: red"></i><a href="">Tiếp tục với Google</a>
                                    </div>
                                    <div class="login-social-item">
                                        <i class="fa-brands fa-apple"></i><a href="">Tiếp tục với Apple</a>
                                    </div>
                                </div>

                                <div class="modal-left-bottom">
                                    <p>Đã có tài khoản ? <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">Đăng nhập</button></p>
                                </div>
                            </div>

                            <div class="col-lg-6 col-12 modal-right">
                                <div class="or-login">
                                    <span>Đăng ký tài khoản</span>
                                </div>

                                <form action="/register" method="post">
                                    <input type="hidden" value="<?php echo $csrfToken;?>" name="_csrfToken">
                                    <div class="mb-3">
                                        <input type="text" class="form-control" name="full_name" id="exampleCheck1" placeholder="Họ và tên">
                                    </div>

                                    <div class="mb-3">
                                        <input type="text" class="form-control" name="phone" id="exampleCheck1" placeholder="Số điện thoại">
                                    </div>

                                    <div class="mb-3">
                                        <input type="text" class="form-control" name="email" id="email" placeholder="email">
                                    </div>

                                    <div class="mb-3">
                                        <input type="password" class="form-control" name="pass" id="pass" placeholder="Mật khẩu">
                                    </div>


                                    <div class="mb-3">
                                        <input type="password" class="form-control" name="passAgain" id="passAgain" placeholder="Mật khẩu xác thực">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Tiếp tục</button>
                                </form>
                                

                                <!-- <div class="email-login">
                                    <span>Đăng nhập bằng email?</span>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>

        <!-- quên mật khẩu -->
        <!-- Quên mật khẩu -->
        <div class="modal-login">
 
            
            <!-- Modal -->
            <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 modal-right">
                                <div class="or-login">
                                    <span>Quên mật khẩu</span>
                                </div>

                                <form action="">
                                    <div class="mb-3">
                                        <input type="email" class="form-control" id="exampleCheck1" placeholder="Nhập email">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Tiếp tục</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>

    </header>