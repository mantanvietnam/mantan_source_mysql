<!DOCTYPE html>

<!-- =========================================================
* Sneat - Bootstrap 5 HTML Admin Template - Pro | v1.0.0
==============================================================

* Product Page: https://themeselection.com/products/sneat-bootstrap-html-admin-template/
* Created by: ThemeSelection
* License: You must have a valid license purchased in order to legally use the theme for your project.
* Copyright ThemeSelection (https://themeselection.com)

=========================================================
 -->
<!-- beautify ignore:start -->
<html
  lang="vi"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="/plugins/thuvien/view/home/assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title><?php echo $metaTitleMantan;?></title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/plugins/thuvien/view/home/assets/img/logo-phoenix.png" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="/plugins/thuvien/view/home/assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="/plugins/thuvien/view/home/assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="/plugins/thuvien/view/home/assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="/plugins/thuvien/view/home/assets/css/demo.css" />
    <link rel="stylesheet" href="/plugins/thuvien/view/home/assets/css/training.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="/plugins/thuvien/view/home/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <link rel="stylesheet" href="/plugins/thuvien/view/home/assets/vendor/libs/apex-charts/apex-charts.css" />

    <!-- Page CSS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.8/umd/popper.min.js" integrity="sha512-TPh2Oxlg1zp+kz3nFA0C5vVC6leG/6mm1z9+mA81MI5eaUVqasPLO8Cuk4gMF4gUfP5etR73rgU/8PNMsSesoQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.min.js" integrity="sha512-ykZ1QQr0Jy/4ZkvKuqWn4iF3lqPZyij9iRv6sGqLRdTPkY69YX6+7wvVGmsdBbiIfN/8OdsI7HABjvEok6ZopQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.5.3/js/bootstrap.bundle.min.js" integrity="sha512-iceXjjbmB2rwoX93Ka6HAHP+B76IY1z0o3h+N1PeDtRSsyeetU3/0QKJqGyPJcX63zysNehggFwMC/bi7dvMig==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <!-- Helpers -->
    <script src="/plugins/thuvien/view/home/assets/vendor/js/helpers.js"></script>
    

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="/plugins/thuvien/view/home/assets/js/config.js"></script>
    
    <script type="text/javascript" src="/ckfinder/ckfinder.js"></script>
    <script language="javascript" src="/ckeditor/ckeditor.js" type="text/javascript"></script>

    <!-- Core JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js" integrity="sha512-HGOnQO9+SP1V92SrtZfjqxxtLmVzqZpjFFekvzZVWoiASSQgSr4cw9Kqd2+l8Llp4Gm0G8GIFJ4ddwZilcdb8A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="/plugins/thuvien/view/home/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.css" integrity="sha512-wR4oNhLBHf7smjy0K4oqzdWumd+r5/+6QO/vDda76MW5iug4PT7v86FoEkySIJft3XA0Ae6axhIvHrqwm793Nw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.css" integrity="sha512-6lLUdeQ5uheMFbWm3CP271l14RsX1xtx+J5x2yeIDkkiBpeVTNhTqijME7GgRKKi6hCqovwCoBTlRBEC20M8Mg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js" integrity="sha512-AIOTidJAcHBH2G/oZv9viEGXRqDNmfdPVPYOYKGy3fti0xIplnlgMHUGfuNRzC6FkzIo0iIxgFnr9RikFxK+sw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css" integrity="sha512-bYPO5jmStZ9WI2602V2zaivdAnbAhtfzmxnEGh9RwtlI00I9s8ulGe4oBa5XxiC6tCITJH/QG70jswBhbLkxPw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  </head>

  <body>
    <?php $user = checklogin() ?>
    <section id="header-menu" class="container-xxl">
      <nav class="navbar navbar-expand-lg">
        <a title="PHOENIX AI" class="navbar-brand" href="/login"><img src="/plugins/thuvien/view/home/assets/img/logo-phoenix.png" width="50"></a>
        
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"><i class="bx bx-menu bx-sm"></i></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            
           <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="javascript:void(0);" id="member" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                 Nhân viên
              </a>
              <div class="dropdown-menu" aria-labelledby="member">
                <a class="dropdown-item" href="/listMember">Quản lý nhân viên</a>
                <a class="dropdown-item" href="/listPermission">Quản lý phân quyền</a>
                <a class="dropdown-item" href="/listCategory">Quản lý chức vụ</a>
                <a class="dropdown-item" href="/listActivityHistory">lịch sử hàng động</a>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="javascript:void(0);" id="member" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                 Khách hàng
              </a>
              <div class="dropdown-menu" aria-labelledby="category">
                <a class="dropdown-item" href="/listCustomer">Quản lý khách hàng</a>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="javascript:void(0);" id="member" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                 Quản lý sách
              </a>
              <div class="dropdown-menu" aria-labelledby="member">
                <a class="dropdown-item" href="/listbook">Quản lý sách</a>
                <a class="dropdown-item" href="/categorybook">Danh mục sách</a>
                <!-- <a class="dropdown-item" href="/changequanlitybook">Nhập sách</a>
                <a class="dropdown-item" href="/historybook">Lịch sử nhập sách</a> -->
                <a class="dropdown-item" href="/listPublisher">Quản lý nhà xuất bản</a>
              </div>
            </li>

            <li class="nav-item dropdown">
              <a class="nav-link " href="/listOrder" >
                  Quản lý cho mượn - trả
              </a>
              <!-- <div class="dropdown-menu" aria-labelledby="order">
                <a class="dropdown-item" href="/listOrder">Danh sách cho mượn sách</a>
              </div> -->
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="javascript:void(0);" id="member" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Quản lý kho
              </a>
              <div class="dropdown-menu" aria-labelledby="member">
                <a class="dropdown-item" href="/listBuilding">Tòa nhà</a>
                <a class="dropdown-item" href="/listFloor">Quản lý tầng</a>
                <a class="dropdown-item" href="/listWarehouse">Quản lý kho sách</a>               
                <a class="dropdown-item" href="/listWarehouseHistory">Lịch sử nhập và hủy kho</a>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="javascript:void(0);" id="member" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Thống kê
              </a>
              <div class="dropdown-menu" aria-labelledby="order">
                <a class="dropdown-item" href="/statisticalnumberbook">Số lượng sách</a>
                <a class="dropdown-item" href="/statisticalorderbookborrow">Số lượng mượn sách theo ngày</a>
                <a class="dropdown-item" href="/statisticalorderbookpay">Số lượng trả sách theo ngày</a>
                <a class="dropdown-item" href="/statisticalorderbookborrowten">10 quyển sách được mượn nhiều nhất</a>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="javascript:void(0);" id="navbarScrollingDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                 Tài khoản
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                <a class="dropdown-item" href="/changePass">Đổi mật khẩu</a>
                <a class="dropdown-item" href="/account">Đổi thông tin</a>
                <a class="dropdown-item" href="/selectBuilding">Đổi tòa nhà</a>
                <a class="dropdown-item" href="/logout">Đăng xuất</a>
              </div>
            </li>
          </ul>
        </div>
      </nav>
    </section>

    <script type="text/javascript">
      $('.dropdown-submenu a.dropdown-toggle').on('click', function(e) {
        /*
        var submenu = $(this).children('.dropdown-menu');

        submenu.addClass('show');

        var submenuOffset = submenu.offset();
        var windowWidth = $(window).width();

        
        // Kiểm tra nếu menu cấp 3 có bị ra ngoài bên phải màn hình
        if (submenuOffset.left + submenu.outerWidth() > windowWidth) {
          submenu.css({
            left: 'auto',
            right: '100%'  // Hiển thị menu cấp 3 bên trái
          });
        } else {
          submenu.css({
            left: '100%',   // Hiển thị menu cấp 3 bên phải
            right: 'auto'
          });
        }

        */

        $('.menuSub3').removeClass('show');

        if (!$(this).next('.dropdown-menu').hasClass('show')) {
          $(this).next('.dropdown-menu').toggleClass('show');
        }
        e.stopPropagation();
      });

    </script>

    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar layout-without-menu">
      <div class="layout-container">
         <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

          

          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">