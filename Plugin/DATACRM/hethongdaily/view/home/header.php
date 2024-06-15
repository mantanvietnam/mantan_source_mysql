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
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="/plugins/hethongdaily/view/home/assets/"
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
    <link rel="icon" type="image/x-icon" href="/plugins/hethongdaily/view/home/assets/img/logo-phoenix.png" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="/plugins/hethongdaily/view/home/assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="/plugins/hethongdaily/view/home/assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="/plugins/hethongdaily/view/home/assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="/plugins/hethongdaily/view/home/assets/css/demo.css" />
    <link rel="stylesheet" href="/plugins/hethongdaily/view/home/assets/css/training.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="/plugins/hethongdaily/view/home/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <link rel="stylesheet" href="/plugins/hethongdaily/view/home/assets/vendor/libs/apex-charts/apex-charts.css" />

    <!-- Page CSS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.8/umd/popper.min.js" integrity="sha512-TPh2Oxlg1zp+kz3nFA0C5vVC6leG/6mm1z9+mA81MI5eaUVqasPLO8Cuk4gMF4gUfP5etR73rgU/8PNMsSesoQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.min.js" integrity="sha512-ykZ1QQr0Jy/4ZkvKuqWn4iF3lqPZyij9iRv6sGqLRdTPkY69YX6+7wvVGmsdBbiIfN/8OdsI7HABjvEok6ZopQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.5.3/js/bootstrap.bundle.min.js" integrity="sha512-iceXjjbmB2rwoX93Ka6HAHP+B76IY1z0o3h+N1PeDtRSsyeetU3/0QKJqGyPJcX63zysNehggFwMC/bi7dvMig==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <!-- Helpers -->
    <script src="/plugins/hethongdaily/view/home/assets/vendor/js/helpers.js"></script>
    

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="/plugins/hethongdaily/view/home/assets/js/config.js"></script>
    
    <script type="text/javascript" src="/ckfinder/ckfinder.js"></script>
    <script language="javascript" src="/ckeditor/ckeditor.js" type="text/javascript"></script>

    <!-- Core JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js" integrity="sha512-HGOnQO9+SP1V92SrtZfjqxxtLmVzqZpjFFekvzZVWoiASSQgSr4cw9Kqd2+l8Llp4Gm0G8GIFJ4ddwZilcdb8A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="/plugins/hethongdaily/view/home/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.css" integrity="sha512-wR4oNhLBHf7smjy0K4oqzdWumd+r5/+6QO/vDda76MW5iug4PT7v86FoEkySIJft3XA0Ae6axhIvHrqwm793Nw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.css" integrity="sha512-6lLUdeQ5uheMFbWm3CP271l14RsX1xtx+J5x2yeIDkkiBpeVTNhTqijME7GgRKKi6hCqovwCoBTlRBEC20M8Mg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js" integrity="sha512-AIOTidJAcHBH2G/oZv9viEGXRqDNmfdPVPYOYKGy3fti0xIplnlgMHUGfuNRzC6FkzIo0iIxgFnr9RikFxK+sw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css" integrity="sha512-bYPO5jmStZ9WI2602V2zaivdAnbAhtfzmxnEGh9RwtlI00I9s8ulGe4oBa5XxiC6tCITJH/QG70jswBhbLkxPw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    
  </head>

  <body>

    <section id="header-menu" class="container-xxl">
      <nav class="navbar navbar-expand-lg">
        <a title="<?php echo $session->read('infoUser')->info_system->name;?>" class="navbar-brand" href="/listMember"><img src="<?php echo @$session->read('infoUser')->info_system->image;?>" width="50"></a>
        
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"><i class="bx bx-menu bx-sm"></i></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <?php
              global $modelOptions;
              /* 
              hethongdaily
              order_system
              order_customer
              zalo_zns
              training
              */
              $conditions = array('key_word' => 'crm_module');
              $plugins_site = $modelOptions->find()->where($conditions)->first();
              $plugins_site_value = array();
              if(!empty($plugins_site->value)){
                  $plugins_site_value = json_decode($plugins_site->value, true);
              }

              if(in_array('hethongdaily', $plugins_site_value)){
                /*
                echo '<li class="nav-item">
                        <a class="nav-link" href="/listMember">Tuyến dưới</a>
                      </li>';
                */
                
                echo '  <li class="nav-item dropdown">
                          <a class="nav-link dropdown-toggle" href="javascript:void(0);" id="navbarScrollingDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Hệ thống
                          </a>

                          <div class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                            <a class="dropdown-item" href="/listMember">Tuyến dưới</a>';
                            if(empty($session->read('infoUser')->id_father)){
                              echo '<a class="dropdown-item" href="/listPosition">Chức danh</a>';
                              echo '<a class="dropdown-item" href="/settingSystem">Hệ thống</a>';
                            }
                echo      '</div>
                        </li>';
                
              }

              if(empty($session->read('infoUser')->id_father) && in_array('zalo_zns', $plugins_site_value)){
                echo '  <li class="nav-item dropdown">
                          <a class="nav-link dropdown-toggle" href="javascript:void(0);" id="navbarScrollingDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Gửi tin nhắn
                          </a>

                          <div class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                            <a class="dropdown-item" href="/sendSMS">Gửi tin SMS</a>
                            <a class="dropdown-item" href="/sendMessZaloFollow">Gửi tin Zalo Follow</a>
                            <a class="dropdown-item" href="/sendMessZaloZNS">Gửi tin Zalo ZNS</a>
                            <a class="dropdown-item" href="/sendNotificationMobile">Gửi thông báo APP Mobile</a>
                            <hr/>
                            <a class="dropdown-item" href="/templateZaloZNS">Mẫu tin Zalo ZNS</a>
                            <a class="dropdown-item" href="/setttingZaloOA">Cài đặt Zalo OA</a>
                            <hr/>
                            <a class="dropdown-item" href="/listTransactionHistories">Nạp tiền tài khoản</a>
                          </div>
                        </li>';
              }

              if(in_array('training', $plugins_site_value)){
                echo '<li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="javascript:void(0);" id="navbarScrollingDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Đào tạo
                        </a>

                        <div class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                          <a class="dropdown-item" href="/courses">Khóa học</a>
                          <a class="dropdown-item" href="/history-test">Lịch sử thi</a>
                        </div>
                      </li>';
              }

              if(in_array('order_customer', $plugins_site_value) || in_array('order_system', $plugins_site_value) ){
                echo '<li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="javascript:void(0);" id="navbarScrollingDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Đơn hàng
                        </a>

                        <div class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">';
                        if(in_array('order_customer', $plugins_site_value)){
                          echo '<a class="dropdown-item" href="/orderCustomerAgency">Đơn khách lẻ</a>';
                        }

                        if(in_array('order_system', $plugins_site_value)){
                          echo '<a class="dropdown-item" href="/orderMemberAgency">Đơn đại lý</a>';
                        }
                          
                echo    '</div>
                      </li>';
              }

              if(in_array('customer', $plugins_site_value)){
                echo '<li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="javascript:void(0);" id="navbarScrollingDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Khách hàng
                        </a>

                        <div class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                          <a class="dropdown-item" href="/listCustomerAgency">Khách hàng</a>
                          <a class="dropdown-item" href="/calendarCustomerHistoriesAgency">Đặt hẹn</a>
                          <a class="dropdown-item" href="/groupCustomerAgency">Nhóm khách hàng</a>
                          <a class="dropdown-item" href="/guideAddCustomerAPIAgency">Tích hợp API</a>
                        </div>
                      </li>';
              }

              if(empty($session->read('infoUser')->id_father) && (in_array('order_customer', $plugins_site_value) || in_array('order_system', $plugins_site_value))){
                echo '<li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="javascript:void(0);" id="navbarScrollingDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Sản phẩm
                        </a>

                        <div class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                          <a class="dropdown-item" href="/listProductAgency">Sản phẩm</a>
                          <a class="dropdown-item" href="/listCategoryProductAgency">Danh mục sản phẩm</a>
                        </div>
                      </li>';
              }

              if(in_array('cashBook', $plugins_site_value)){
                echo '<li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="javascript:void(0);" id="navbarScrollingDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Sổ quỹ
                        </a>

                        <div class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                          <a class="dropdown-item" href="/listCollectionBill">Phiếu thu</a>
                          <a class="dropdown-item" href="/listBill">Phiếu chi</a>
                          <a class="dropdown-item" href="/listCollectionDebt">Công nợ thu</a>
                          <a class="dropdown-item" href="/listPayableDebt">Công nợ chi</a>
                        </div>
                      </li>';
              }

              if(in_array('order_system', $plugins_site_value)){
                echo '<li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="javascript:void(0);" id="navbarScrollingDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Kho hàng
                        </a>

                        <div class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                          <a class="dropdown-item" href="/warehouseProductAgency">Tồn kho</a>
                          <a class="dropdown-item" href="/requestProductAgency">Yêu cầu nhập hàng</a>
                          <a class="dropdown-item" href="/historyWarehouseProductAgency">Lịch sử xuất nhập hàng</a>
                        </div>
                      </li>';
              }

              if(in_array('document', $plugins_site_value)){
                echo '<li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="javascript:void(0);" id="navbarScrollingDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Thư viện
                        </a>

                        <div class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                          <a class="dropdown-item" href="/listAlbum">Hình ảnh</a>
                          <a class="dropdown-item" href="/listVideo">Video</a>
                          <a class="dropdown-item" href="/listDocument">Tài liệu</a>
                        </div>
                      </li>';
              }

              if(in_array('campaign', $plugins_site_value)){
                echo '<li class="nav-item">
                        <a class="nav-link" href="/listCampaign">Chiến dịch</a>
                      </li>';
              }
            ?>

            <li class="nav-item">
              <a class="nav-link" href="/businessReport">Báo cáo</a>
            </li>

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="javascript:void(0);" id="navbarScrollingDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Tài khoản
              </a>

              <div class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                <a class="dropdown-item" href="/changePass">Đổi mật khẩu</a>
                <a class="dropdown-item" href="/account">Đổi thông tin</a>
                <a class="dropdown-item" href="/logout">Đăng xuất</a>
              </div>
            </li>
          </ul>
        </div>
      </nav>
    </section>

    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar layout-without-menu">
      <div class="layout-container">
         <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

          

          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">