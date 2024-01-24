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
    <link rel="icon" type="image/x-icon" href="https://designer.ezpics.vn/plugins/hethongdaily/view/home/assets/img/avatar-ezpics.png" />

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

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="/plugins/hethongdaily/view/home/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <link rel="stylesheet" href="/plugins/hethongdaily/view/home/assets/vendor/libs/apex-charts/apex-charts.css" />

    <!-- Page CSS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>



    <!-- Helpers -->
    <script src="/plugins/hethongdaily/view/home/assets/vendor/js/helpers.js"></script>
    

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="/plugins/hethongdaily/view/home/assets/js/config.js"></script>
    
    <script type="text/javascript" src="/ckfinder/ckfinder.js"></script>
    <script language="javascript" src="/ckeditor/ckeditor.js" type="text/javascript"></script>

    <!-- Core JS -->

    <script src="/plugins/hethongdaily/view/home/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="/" class="app-brand-link">
              <span class="app-brand-logo demo">
                <img src="<?php echo $session->read('infoUser')->info_system->image;?>" width="50">
              </span>
              <span class="app-brand-text demo menu-text fw-bolder ms-2"><?php echo strtoupper($session->read('infoUser')->info_system->name);?></span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            
            <?php if($session->read('infoUser')->create_agency == 'active'){ ?>
            <!-- Dashboard -->
            <li class="menu-header small text-uppercase"><span class="menu-header-text">Đại lý tuyến dưới</span></li>
            <li class="menu-item active">
              <a href="/listMember" class="menu-link">
                <i class='menu-icon tf-icons bx bx-bar-chart-alt'></i> 
                <div data-i18n="Analytics">Hệ thống <?php echo strtoupper($session->read('infoUser')->info_system->name);?></div>
              </a>
            </li>
            <?php }?>

            <?php if(empty($session->read('infoUser')->id_father)){ ?>
            <!-- Template -->
            <li class="menu-header small text-uppercase"><span class="menu-header-text">Cài đặt</span></li>
            <!-- Cards -->
            <li class="menu-item">
              <a href="/sendMessZaloOA" class="menu-link">
                <i class='menu-icon tf-icons bx bx-send' ></i> 
                <div data-i18n="Tempaltes">Gửi tin Zalo OA</div>
              </a>
            </li>

            <li class="menu-item">
              <a href="/setttingZaloOA" class="menu-link">
                <i class='menu-icon tf-icons bx bx-cog' ></i> 
                <div data-i18n="Tempaltes">Cài đặt Zalo OA</div>
              </a>
            </li>

            <li class="menu-item">
              <a href="/listPosition" class="menu-link">
                <i class='menu-icon tf-icons bx bx-crown' ></i> 
                <div data-i18n="Tempaltes">Cài đặt chức danh</div>
              </a>
            </li>

            <!-- Template -->
            <li class="menu-header small text-uppercase"><span class="menu-header-text">Đào tạo</span></li>
            <!-- Cards -->
            <li class="menu-item">
              <a href="/sendMessZaloOA" class="menu-link">
                <i class='menu-icon tf-icons bx bx-send' ></i> 
                <div data-i18n="Tempaltes">Cài đặt bài học</div>
              </a>
            </li>

            <li class="menu-item">
              <a href="/setttingZaloOA" class="menu-link">
                <i class='menu-icon tf-icons bx bx-cog' ></i> 
                <div data-i18n="Tempaltes">Cài đặt bài thi</div>
              </a>
            </li>

            <li class="menu-item">
              <a href="/listPosition" class="menu-link">
                <i class='menu-icon tf-icons bx bx-crown' ></i> 
                <div data-i18n="Tempaltes">Kết quả thi hệ thống</div>
              </a>
            </li>

            <?php }?>

            <!-- Template -->
            <li class="menu-header small text-uppercase"><span class="menu-header-text">Đào tạo</span></li>
            <!-- Cards -->
            <li class="menu-item">
              <a href="/sendMessZaloOA" class="menu-link">
                <i class='menu-icon tf-icons bx bx-send' ></i> 
                <div data-i18n="Tempaltes">Video bài học</div>
              </a>
            </li>

            <li class="menu-item">
              <a href="/setttingZaloOA" class="menu-link">
                <i class='menu-icon tf-icons bx bx-cog' ></i> 
                <div data-i18n="Tempaltes">Làm bài thi</div>
              </a>
            </li>

            <li class="menu-item">
              <a href="/listPosition" class="menu-link">
                <i class='menu-icon tf-icons bx bx-crown' ></i> 
                <div data-i18n="Tempaltes">Kết quả thi</div>
              </a>
            </li>

            <!-- Template -->
            <li class="menu-header small text-uppercase"><span class="menu-header-text">Tài khoản</span></li>
            <!-- Cards -->
            <li class="menu-item">
              <a href="/changePass" class="menu-link">
                <i class='menu-icon tf-icons bx bx-lock-alt' ></i> 
                <div data-i18n="Tempaltes">Đổi mật khẩu</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="/account" class="menu-link">
                <i class='menu-icon tf-icons bx bx-info-circle' ></i> 
                <div data-i18n="Tempaltes">Đổi thông tin</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="/logout" class="menu-link">
                <i class='menu-icon tf-icons bx bx-log-out' ></i> 
                <div data-i18n="Tempaltes">Đăng xuất</div>
              </a>
            </li>
            
            
          </ul>
        </aside>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

          <nav
            class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
            id="layout-navbar"
          >
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
              </a>
            </div>

            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
              <!-- Search -->
              <div class="navbar-nav align-items-center">
                <div class="nav-item d-flex align-items-center">
                  <i class="bx bx-search fs-4 lh-0"></i>
                  <input
                    type="text"
                    class="form-control border-0 shadow-none"
                    placeholder="Search..."
                    aria-label="Search..."
                  />
                </div>
              </div>
              <!-- /Search -->

              <ul class="navbar-nav flex-row align-items-center ms-auto">

                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                      <img src="<?php echo $session->read('infoUser')->avatar;?>" alt class="rounded-circle" />
                    </div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                      <a target="_blank" class="dropdown-item" href="javascript:void(0);">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar avatar-online">
                              <img src="<?php echo $session->read('infoUser')->avatar;?>" alt class="rounded-circle" />
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <span class="fw-semibold d-block"><?php echo $session->read('infoUser')->name;?></span>
                            <small class="text-muted"><?php echo $session->read('infoUser')->phone;?></small>
                          </div>
                        </div>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="/account">
                        <i class="bx bx-user me-2"></i>
                        <span class="align-middle">Tài khoản</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="/changePass">
                        <i class="bx bx-cog me-2"></i>
                        <span class="align-middle">Đổi mật khẩu</span>
                      </a>
                    </li>
                    
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="/logout">
                        <i class="bx bx-power-off me-2"></i>
                        <span class="align-middle">Đăng xuất</span>
                      </a>
                    </li>
                  </ul>
                </li>
                <!--/ User -->
              </ul>
            </div>
          </nav>

          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">