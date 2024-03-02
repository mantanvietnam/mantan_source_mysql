<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="<?php echo $urlThemeActive;?>/assert/css/style.css">
    
    <?php 
        global $setting_value;

        mantan_header(); 

        if(function_exists('showSeoHome')) showSeoHome();
    ?>

    <link rel="icon" type="image/x-icon" href="<?php echo @$setting_value['logo'];?>" />
</head>

<body>
    <style type="text/css">
        <?php 
            if(!empty($setting_value['background_image_1'])){
                echo '.wrapper{
                    background-image: url(\''.$setting_value['background_image_1'].'\');
                }';
            }

            if(!empty($setting_value['background_image_2'])){
                echo '.register{
                    background-image: url(\''.$setting_value['background_image_2'].'\');
                }';
            }

            if(!empty($setting_value['background_image_3'])){
                echo '.footer{
                    background-image: url(\''.$setting_value['background_image_3'].'\');
                }';
            }
            

            if(!empty($setting_value['background_color'])){
                echo '.header{
                    background-color: '.$setting_value['background_color'].';
                }';
            }
        ?>
    </style>

    <div class="wrapper" >
        <header class="header">
            <nav class="header-top navbar navbar-expand-lg">
                <div class="container-fluid">
                        <div class="header-logo">
                            <a href="#">
                                <img class="header-logo-img" src="<?php echo @$setting_value['logo'];?>" alt="">
                            </a>
                        </div>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="header-navbar collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class=" navbar-nav me-auto mb-2 mb-lg-0">
                                <li class="nav-item">
                                    <a class="nav-link" href="https://phoenixcamp.vn/">PHOENIX CAMP</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="https://laptrinhthanhcong.com/">LẬP TRÌNH THÀNH CÔNG</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="https://kinhdoanhthucchien.com/">KINH DOANH THỰC CHIẾN</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="https://www.facebook.com/trantoanmkt">LIÊN HỆ</a>
                                </li>
                            </ul>
                            <button onclick="window.location = '/login';" class="btn-login"><span>ĐĂNG NHẬP </span><i class="fa-solid fa-arrow-right"></i></button>
                        </div>
                    </div>
            </nav>
        </header>



        <div class="main">
            <div class="container">
                <div class="main-below mt-3">
                    <div class="row">
                        <div class="main-below-left col-lg-6 col-md-6">
                            <p class="main-below-search">TRA CỨU ĐẠI LÝ <?php echo @$setting_value['name_web'];?></p>
                            <h1 class="main-below-title">Đại lý chính thức của <?php echo @$setting_value['name_web'];?></h1>
                            <input type="text" class="main-below-input" name="" id="phone_member"
                                placeholder="Nhập số điện thoại viết liền không dấu, ví dụ 0816560000">
                            <br />
                            <button type="button" class="main-below-btn" onclick="seachAgency();">Tra cứu thông tin</button>
                            <p class="main-below-text-end">*HÃY CHỈ LÀM VIỆC VỚI CÁC ĐẠI LÝ CHÍNH THỨC CỦA <?php echo @$setting_value['name_web'];?> ĐỂ ĐƯỢC ĐẢM BẢO CÁC QUYỀN LỢI CAM KẾT VÀ BẢO HÀNH</p>

                        </div>
                        <div class="main-below-right col-lg-6 col-md-6">
                            <div class="row flex">
                                <div class="col-6">
                                    <div class="main-below-right-image">
                                        <div class="main-below-right-image-slide" style="margin: 50px 0 20px 0;" >
                                            <img src="<?php echo @$setting_value['image_product_1'];?>" alt="">
                                        </div>
                                        <div class="main-below-right-image-slide">
                                            <img src="<?php echo @$setting_value['image_product_2'];?>" alt="">
                                        </div>                   
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="main-below-right-image1" >
                                        <div class="main-below-right-image-slide">
                                            <img src="<?php echo @$setting_value['image_product_3'];?>" alt="">
                                        </div>
                                        <div class="main-below-right-image-slide">
                                            <img src="<?php echo @$setting_value['image_product_4'];?>" alt="">
                                        </div>
                                        <div class="main-below-right-image-slide">
                                            <img src="<?php echo @$setting_value['image_product_5'];?>" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- <div class="main-right">
                <div class="main-group-button">
                    <div class="main-button-item">
                        <a href=""><img src="<?php echo $urlThemeActive;?>/assert/img/youtube.png" alt=""></a>
                    </div>

                    <div class="main-button-item">
                        <a href=""><img src="<?php echo $urlThemeActive;?>/assert/img/facebook-1.png" alt=""></a>
                    </div>

                    <div class="main-button-item">
                        <a href=""><img src="<?php echo $urlThemeActive;?>/assert/img/linkedin.png" alt=""></a>
                    </div>
                </div>
            </div>

            <div class="main-left">

            </div> -->
        </div>

        <div class="register">
            <div class="container">
                <div class="register-main">
                    <h1>ĐĂNG KÝ TRỞ THÀNH ĐẠI LÝ CỦA <?php echo @$setting_value['name_web'];?></h1>
                    <p>Chúng tôi khao khát giúp đỡ được hàng triệu người có thể đột phá trong tư duy và lối sống để có một cuộc sống trở nên tốt đẹp, thịnh vượng hơn</p>
                    <div class="register-btn">
                        <button class="btn-logup" onclick="window.open('<?php echo @$setting_value['facebook'];?>', '_blank');">
                            <span>ĐĂNG KÝ NGAY </span>
                            <i class="fa-solid fa-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- <div class="policy">
            <div class="container ">
                <div class="policy-main">
                    <h1>Chính sách đại lý</h1>
                    <div class="policy-btn">
                        <button class="btn-news"><span>XEM TẤT CẢ BẢN TIN</span><i
                                class="fa-solid fa-arrow-right"></i></button>
                    </div>
                </div>
            </div>
        </div> -->


        <footer class="footer">
            <div class="container">
                <div class="footer-head">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                            <div class="header-logo">
                                <a href="#">
                                    <img class="header-logo-img" src="<?php echo @$setting_value['logo'];?>" alt="">
                                </a>
                            </div>
                            <div class="footer-head-description">
                                <p><?php echo @$setting_value['content_footer'];?></p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-12" style="margin-top: 40px;">
                            <p class="footer-address-title">CHÚNG TÔI LÀ AI ?</p>
                            <div class="footer-head-address">
                                <span class="footer-head-address-k">Địa chỉ</span>
                                <p><?php echo @$contactSite['address'];?></p>
                            </div>
                            <div class="footer-head-address">
                                <span class="footer-head-address-k">Hotline</span>
                                <p><?php echo @$contactSite['phone'];?></p>
                            </div>
                            <div class="footer-head-address">
                                <span class="footer-head-address-k">Email</span>
                                <p><?php echo @$contactSite['email'];?></p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-12 menu-about-us" style="margin-top: 40px;">
                            <p class="footer-address-title">Về chúng tôi</p>
                            <div class="footer-head-address">
                                <a class="footer-head-address-key2">GIỚI THIỆU</a>
                            </div>
                            <div class="footer-head-address">
                                <a class="footer-head-address-key2">CƠ HỘI KINH DOANH</a>
                             
                            </div>
                            <div class="footer-head-address">
                                <a class="footer-head-address-key2">CƠ HỘI VIỆC LÀM</a>
                            </div>
                            <div class="footer-head-address">
                                <a class="footer-head-address-key2">SỰ KIỆN-ĐÀO TẠO</a>
                            </div>
                        </div>
                    </div>


                </div>

                <div class="footer-social">
                    <span>
                        <a href="<?php echo @$setting_value['facebook'];?>" class="footer-socical-link">
                            <i class="fa-brands fa-facebook"></i>
                        </a>
                    </span>
                    <span>
                        <a href="<?php echo @$setting_value['youtube'];?>" class="footer-socical-link">
                            <i class="fa-brands fa-youtube"></i>
                        </a>
                    </span>
                    <span>
                        <a href="https://zalo.me/<?php echo @$contactSite['phone'];?>" class="footer-socical-link">
                            <img src="<?php echo $urlThemeActive;?>/assert/img/download.jpg" alt="">
                        </a>
                    </span>
                </div>
                
                <div class="footer-end">
                    CRM <?php echo @$setting_value['name_web'];?> 2024 - Thiết kế bởi Phoenix Tech
                    <p></p>
                </div>
        </footer>
    </div>

    <!-- modal -->
    <div class="modal-info modal fade" id="popupInfoAgency" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Thông tin đại lý <?php echo @$setting_value['name_web'];?></h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="modal-note">
                    LƯU Ý: CHỈ CÁC ĐẠI LÝ ĐƯỢC XÁC NHẬN TẠI ĐÂY MỚI LÀ ĐẠI LÝ CHÍNH THỨC CỦA <?php echo @$setting_value['name_web'];?>, HÃY XÁC NHẬN ĐÚNG ĐẠI LÝ <?php echo @$setting_value['name_web'];?> ĐỂ TRÁNH CÁC TRƯỜNG HỢP MẠO DANH.
                </div>

                <div class="row" id="infoAgency"></div>
            </div>
        </div>
        </div>
    </div>

    <script type="text/javascript">
        function seachAgency()
        {
            var phone = $('#phone_member').val();
            var infoAgency;
            var imageCheck = "<?php echo $urlThemeActive;?>/assert/img/check.png";

            if(phone!=''){
                $.ajax({
                    method: "POST",
                    url: "/apis/getInfoMemberAPI",
                    data: { phone: phone }
                })
                .done(function( msg ) {
                    if(msg.hasOwnProperty('data')){
                        dataAgency = msg.data;

                        infoAgency = '<div class="col-lg-5 col-12 modal-image"><div class="image-character"><img src="'+dataAgency.avatar+'" alt=""></div><div class="image-bottom"><img src="'+imageCheck+'" alt=""></div></div><div class="col-lg-7 col-12 modal-info"><div class="modal-name"><p>'+dataAgency.name+'</p></div><div class="modal-detail"><p><strong>Cấp bậc:</strong> '+dataAgency.name_position+'</p><p><strong>Điện thoại:</strong> '+dataAgency.phone+'</p><p><strong>Email:</strong> '+dataAgency.email+'</p><p><strong>Địa chỉ:</strong> '+dataAgency.address+'</p><p><button type="button" class="main-below-btn" onclick="window.open(\''+dataAgency.facebook+'\' , \'_blank\')">XEM FACEBOOK</button></p></div></div>';

                    }else{
                        infoAgency = '<p class="text-danger">Không tìm thấy thông tin đại lý trong hệ thống</p>';
                    }

                    $('#infoAgency').html(infoAgency);

                    $('#popupInfoAgency').modal('show');
                });
            }
        }
    </script>
</body>

</html>