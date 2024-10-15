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
  data-assets-path="/plugins/zoomcheap/view/home/assets/"
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
    <link rel="icon" type="image/x-icon" href="https://designer.ezpics.vn/plugins/zoomcheap/view/home/assets/img/avatar-ezpics.png" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="/plugins/zoomcheap/view/home/assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="/plugins/zoomcheap/view/home/assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="/plugins/zoomcheap/view/home/assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="/plugins/zoomcheap/view/home/assets/css/demo.css" />
    <link rel="stylesheet" href="/plugins/zoomcheap/view/home/assets/css/ezpics_admin.css?time=<?php echo  getdate()[0]; ?>" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="/plugins/zoomcheap/view/home/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <link rel="stylesheet" href="/plugins/zoomcheap/view/home/assets/vendor/libs/apex-charts/apex-charts.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="/plugins/zoomcheap/view/home/assets/vendor/js/helpers.js"></script>
    

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="/plugins/zoomcheap/view/home/assets/js/config.js"></script>
    
    <script type="text/javascript" src="/ckfinder/ckfinder.js"></script>
    <script language="javascript" src="/ckeditor/ckeditor.js" type="text/javascript"></script>

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="/plugins/zoomcheap/view/home/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="/plugins/zoomcheap/view/home/assets/vendor/js/bootstrap.js"></script>
    <script src="/plugins/zoomcheap/view/home/assets/vendor/js/bootstrap.js"></script>
    <script src="/plugins/zoomcheap/view/home/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="/plugins/zoomcheap/view/home/assets/js/ezpics_admin.js?time=<?php echo  getdate()[0]; ?>"></script>
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="/dashboard" class="app-brand-link">
              <span class="app-brand-text demo menu-text fw-bolder ms-2">Zoom Cheap</span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            <!-- Dashboard -->
            <li class="menu-item active">
              <a href="/dashboard" class="menu-link">
                <i class='bx bx-bar-chart-alt'></i> 
                <div data-i18n="Analytics">Thống kê</div>
              </a>
            </li>

            <!-- Template -->
            <li class="menu-header small text-uppercase"><span class="menu-header-text">Thuê Zoom</span></li>
            <!-- Cards -->
            <li class="menu-item">
              <a href="/listOrder" class="menu-link">
                <i class='bx bx-list-ul' ></i> 
                <div data-i18n="Tempaltes">Lịch sử thuê</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="/addOrder" class="menu-link">
                <i class='bx bxl-play-store'></i>  
                <div data-i18n="Tempaltes">Tạo đơn mới</div>
              </a>
            </li>
            
            <li class="menu-header small text-uppercase"><span class="menu-header-text">Link cố định</span></li>
            <li class="menu-item">
              <a href="/listLink" class="menu-link">
                <i class='bx bx-link' ></i> 
                <div data-i18n="Add">Danh sách link</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="/addLink" class="menu-link">
                <i class='bx bx-message-alt-add' ></i> 
                <div data-i18n="Add">Mua link mới</div>
              </a>
            </li>
            
            <li class="menu-header small text-uppercase"><span class="menu-header-text">Giao dịch</span></li>
            <li class="menu-item">
              <a href="/addMoney" class="menu-link">
                <i class='bx bx-credit-card' ></i>  
                <div data-i18n="Add">Nạp tiền</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="/listHistories" class="menu-link">
                <i class='bx bx-history'></i> 
                <div data-i18n="Add">Lịch sử giao dịch</div>
              </a>
            </li>
            <li class="menu-header small text-uppercase"><span class="menu-header-text">Đăng ký nhận thông báo khi phòng zoom hết</span></li>
            <li class="menu-item">
              <a href="/addNotification" class="menu-link">
                <i class='bx bxs-meh-alt'></i>  
                <div data-i18n="Add">Đăng ký</div>
              </a>
            </li>

            <!--
            <li class="menu-header small text-uppercase"><span class="menu-header-text">Mua tài khoản</span></li>
            <li class="menu-item">
              <a href="/addMoney" class="menu-link">
                <i class='bx bx-cart' ></i> 
                <div data-i18n="Add">Chat GPT Plus</div>
              </a>
            </li>
            
            <li class="menu-item">
              <a href="/sellWarehouse" class="menu-link">
                <i class='bx bx-cart' ></i> 
                <div data-i18n="Add">Canva Pro</div>
              </a>
            </li>
            -->
            
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
                            <span class="fw-semibold d-block"><?php echo $session->read('infoUser')->fullname;?></span>
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