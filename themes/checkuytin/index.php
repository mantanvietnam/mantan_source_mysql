<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tra cứu thông tin đại lý chính hãng</title>
    
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
    <?php mantan_header();?>
    <meta name="zalo-platform-site-verification" content="HStlBfNSVXblpAGlc-CLDKtbnmEXcnnKEJa" />

    <link rel="icon" type="image/x-icon" href="https://id.phoenixcamp.vn/upload/admin/images/logovuong.png" />
</head>

<body>
    <div class="wrapper">
        <header class="header">
            <nav class="header-top navbar navbar-expand-lg">
                <div class="container-fluid">
                        <div class="header-logo">
                            <a href="#">
                                <img class="header-logo-img" src="https://id.phoenixcamp.vn/upload/admin/images/logovuong.png" alt="">
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
                <div class="main-nav">
                    <a href="#">Trang chủ</a>   
                    <span> > </span>
                    <span>Tra cứu PHOENIX</span>
                </div>
                <div class="main-below">
                    <div class="row">
                        <div class="main-below-left col-lg-6 col-md-6">
                            <p class="main-below-search">TRA CỨU THÀNH VIÊN PHOENIX</p>
                            <h1 class="main-below-title">Thành viên chính thức của <br /> PHOENIX</h1>
                            <input type="text" class="main-below-input" name="" id="phone_member"
                                placeholder="Nhập số điện thoại viết liền không dấu, ví dụ 0816560000">
                            <br />
                            <button type="button" class="main-below-btn" onclick="seachAgency();">Tra cứu thông tin</button>
                            <p class="main-below-text-end">*HÃY CHỈ LÀM VIỆC VỚI CÁC PHOENIX CHÍNH THỨC CỦA CHÚNG TÔI ĐỂ ĐƯỢC ĐẢM BẢO CÁC QUYỀN LỢI CAM KẾT VÀ BẢO HÀNH</p>

                        </div>
                        <div class="main-below-right col-lg-6 col-md-6">
                            <div class="row flex">
                                <div class="col-6">
                                    <div class="main-below-right-image">
                                        <div class="main-below-right-image-slide" style="margin: 50px 0 20px 0;" >
                                            <img src="https://phoenixcamp.vn/wp-content/uploads/2021/03/Artboard-5.png" alt="">
                                        </div>
                                        <div class="main-below-right-image-slide">
                                            <img src="https://phoenixcamp.vn/wp-content/uploads/2021/03/Artboard-2.png" alt="">
                                        </div>                   
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="main-below-right-image1" >
                                        <div class="main-below-right-image-slide">
                                            <img src="https://phoenixcamp.vn/wp-content/uploads/2021/03/Artboard-3.png" alt="">
                                        </div>
                                        <div class="main-below-right-image-slide">
                                            <img src="https://phoenixcamp.vn/wp-content/uploads/2021/03/BANNER-MASTERCONTENT.png" alt="">
                                        </div>
                                        <div class="main-below-right-image-slide">
                                            <img src="https://phoenixcamp.vn/wp-content/uploads/2021/02/BANNER-MMA.png" alt="">
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
                    <h1>ĐĂNG KÝ TRỞ THÀNH THÀNH VIÊN CỦA PHOENIX</h1>
                    <p>Chúng tôi khao khát giúp đỡ được hàng triệu người có thể đột phá trong tư duy và lối sống để có một cuộc sống trở nên tốt đẹp, thịnh vượng hơn</p>
                    <div class="register-btn">
                        <button class="btn-logup" onclick="window.location= 'https://www.facebook.com/trantoanmkt';">
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
                                    <img class="header-logo-img" src="https://id.phoenixcamp.vn/upload/admin/images/logovuong.png" alt="">
                                </a>
                            </div>
                            <div class="footer-head-description">
                                <p>Phoenix Camp Academy là công ty đào tạo & tổ chức các chương trình sự kiện hàng đầu Việt Nam.Chúng tôi liên tục tổ chức các khóa đào tạo về Kinh Doanh, Internet Marketing, Facebook Marketing, về phát triển bản thân, đào tạo các nhà Lãnh Đạo giúp họ có những đội nhóm mạnh mẽ nhiệt huyết và hướng đến xây dựng hệ thống kinh doanh vững bền.</p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-12" style="margin-top: 40px;">
                            <p class="footer-address-title">CHÚNG TÔI LÀ AI ?</p>
                            <div class="footer-head-address">
                                <span class="footer-head-address-k">Địa chỉ</span>
                                <p>21 Lê Văn Lương, Thanh Xuân, Hà Nội</p>
                            </div>
                            <div class="footer-head-address">
                                <span class="footer-head-address-k">Hotline</span>
                                <p>0961 88 55 99</p>
                            </div>
                            <div class="footer-head-address">
                                <span class="footer-head-address-k">Email</span>
                                <p>info@phoenixcamp.vn</p>
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
                        <a href="#" class="footer-socical-link">
                            <i class="fa-brands fa-facebook"></i>
                        </a>
                    </span>
                    <span>
                        <a href="#" class="footer-socical-link">
                            <i class="fa-brands fa-youtube"></i>
                        </a>
                    </span>
                    <span>
                        <a href="#" class="footer-socical-link">
                            <img src="<?php echo $urlThemeActive;?>/assert/img/download.jpg" alt="">
                        </a>
                    </span>
                </div>
                
                <div class="footer-end">
                    PHOENIX 2023. All rights reserved.
                    <p></p>
                </div>
        </footer>
    </div>

    <!-- modal -->
    <div class="modal-info modal fade" id="popupInfoAgency" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Thông tin thành viên PHOENIX</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="modal-note">
                    LƯU Ý: CHỈ CÁC THÀNH VIÊN ĐƯỢC XÁC NHẬN TẠI ĐÂY MỚI LÀ THÀNH VIÊN CHÍNH THỨC CỦA CỘNG ĐỒNG PHOENIX, HÃY XÁC NHẬN ĐÚNG MẶT THÀNH VIÊN PHOENIX ĐỂ TRÁNH CÁC TRƯỜNG HỢP MẠO DANH.
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

                        infoAgency = '<div class="col-lg-5 col-12 modal-image"><div class="image-character"><img src="'+dataAgency.avatar+'" alt=""></div><div class="image-bottom"><img src="'+imageCheck+'" alt=""></div></div><div class="col-lg-7 col-12 modal-info"><div class="modal-name"><p>'+dataAgency.name+'</p></div><div class="modal-detail"><p><strong>Cấp bậc:</strong> '+dataAgency.name_position+'</p><p><strong>Điện thoại:</strong> '+dataAgency.phone+'</p><p><strong>Email:</strong> '+dataAgency.email+'</p></p><p><strong>Địa chỉ:</strong> '+dataAgency.address+'</p><p><button type="button" class="main-below-btn" onclick="window.open(\''+dataAgency.facebook+'\' , \'_blank\')">XEM FACEBOOK</button></p></div></div>';

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