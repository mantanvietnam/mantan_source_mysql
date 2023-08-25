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
  data-assets-path="/plugins/databot_spa/view/home/assets/"
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
    <link rel="icon" type="image/x-icon" href="https://designer.ezpics.vn/plugins/databot_spa/view/home/assets/img/avatar-ezpics.png" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="/plugins/databot_spa/view/home/assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="/plugins/databot_spa/view/home/assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="/plugins/databot_spa/view/home/assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="/plugins/databot_spa/view/home/assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="/plugins/databot_spa/view/home/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <link rel="stylesheet" href="/plugins/databot_spa/view/home/assets/vendor/libs/apex-charts/apex-charts.css" />
    <link rel="stylesheet" href="/plugins/databot_spa/view/home/assets/css/datetimepicker.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="/plugins/databot_spa/view/home/assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="/plugins/databot_spa/view/home/assets/js/config.js"></script>
    
    <script type="text/javascript" src="/ckfinder/ckfinder.js"></script>
    <script language="javascript" src="/ckeditor/ckeditor.js" type="text/javascript"></script>

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="/plugins/databot_spa/view/home/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="/plugins/databot_spa/view/home/assets/vendor/libs/popper/popper.js"></script>
    <script src="/plugins/databot_spa/view/home/assets/vendor/js/bootstrap.js"></script>
    <script src="/plugins/databot_spa/view/home/assets/vendor/js/bootstrap-datepicker.js"></script>
    <script src="/plugins/databot_spa/view/home/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="/plugins/databot_spa/view/home/assets/js/datetimepicker.full.js"></script>
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="/dashboard" class="app-brand-link">
              <span class="app-brand-text demo menu-text fw-bolder ms-2">MY SPA</span>
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
            <li class="menu-header small text-uppercase"><span class="menu-header-text">Quản lý SPA</span></li>
            <!-- Cards -->

            <li class="menu-item">
              <a href="/listRoomBed" class="menu-link">
                <i class="menu-icon tf-icons bx bx-sitemap"></i>
                <div>Sơ đồ SPA</div>
              </a>
            </li>   
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bxs-user-detail"></i>
                <div>Khách hàng</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="/listCustomer" class="menu-link">
                    <div>Khách hàng</div> 
                  </a>
                </li>
                <li class="menu-item">
                  <a href="/listCategoryCustomer" class="menu-link">
                    <div>Nhóm khách hàng</div> 
                  </a>
                </li>
                <li class="menu-item">
                  <a href="/listSourceCustomer" class="menu-link">
                    <div>Nguồn khách hàng</div> 
                  </a>
                </li>
              </ul>
            </li>  
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-calendar"></i>
                <div>Đặt hẹn</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="/listBook" class="menu-link">
                    <div>Lịch hẹn</div> 
                  </a>
                </li>
                
              </ul>
            </li>
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bxs-shopping-bag"></i>
                <div>Bán hàng</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="/buyProduct" class="menu-link">
                    <div>Bán sản phẩm</div> 
                  </a>
                </li>
                <li class="menu-item">
                  <a href="/buyCombo" class="menu-link">
                    <div>Bán thẻ liệu trình</div> 
                  </a>
                </li>
                <li class="menu-item">
                  <a href="/buyPrepayCard" class="menu-link">
                    <div>Bán thẻ trả trước</div> 
                  </a>
                </li>
              </ul>
            </li>
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bxs-bar-chart-square"></i>
                <div>Quản lý thu chi</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="/listCollectionBill" class="menu-link">
                    <div>Phiếu thu</div> 
                  </a>
                </li>
                <li class="menu-item">
                  <a href="/listBill" class="menu-link">
                    <div>Phiếu chi</div> 
                  </a>
                </li>
              </ul>
            </li>

            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-book-content"></i>
                <div>Quản lý công nợ</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="/listCollectionDebt" class="menu-link">
                    <div>Công nợ phải thu</div> 
                  </a>
                </li>
                <li class="menu-item">
                  <a href="/listPayableDebt" class="menu-link">
                    <div>Công nợ phải trả</div> 
                  </a>
                </li>
              </ul>
            </li>

            <!-- Template -->
            <li class="menu-header small text-uppercase"><span class="menu-header-text">Cài đặt hệ thống</span></li>
            <!-- Cards -->

            <li class="menu-item">
              <a href="/listPrepayCard" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-credit-card"></i>
                <div>Loại thẻ trả trước</div>
              </a>
            </li>   
            
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-news"></i>
                <div>Sản phẩm</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="/listProduct" class="menu-link">
                    <div>Sản phẩm</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="/listCategoryProduct" class="menu-link">
                    <div>Danh mục sản phẩm</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="/listTrademarkProduct" class="menu-link">
                    <div>Nhãn hiệu</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="/listPartner" class="menu-link">
                    <div>Đối tác</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="/listWarehouse" class="menu-link">
                    <div>Kho</div>
                  </a>
                </li>
              </ul>
            </li>
            
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-basket"></i>
                <div>Dịch vụ</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="/listService" class="menu-link">
                    <div>Dịch vụ</div> 
                  </a>
                </li>
                <li class="menu-item">
                  <a href="/listCategoryService" class="menu-link">
                    <div>Nhóm dịch vụ</div> 
                  </a>
                </li>
              </ul>
            </li>

            <li class="menu-item">
              <a href="/listCombo" class="menu-link">
                <i class='menu-icon tf-icons bx bx-gift'></i>
                <div>Combo liệu trình</div>
              </a>
            </li>

            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-bed"></i>
                <div>Phòng - Giường</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="/listBed" class="menu-link">
                    <div>Giường</div> 
                  </a>
                </li>
                <li class="menu-item">
                  <a href="/listRoom" class="menu-link">
                    <div>Phòng</div> 
                  </a>
                </li>
              </ul>
            </li>
            
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-group"></i>
                <div>Đội ngũ</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="/listStaff" class="menu-link">
                    <div>Nhân viên</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="/listGroupStaff" class="menu-link">
                    <div>Nhóm nhân viên</div>
                  </a>
                </li>
              </ul>
            </li>
            
            <li class="menu-item">
              <a href="/listSpa" class="menu-link">
                <i class="menu-icon tf-icons bx bx-news"></i>
                <div>Thông tin spa</div>
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
                  <a class="nav-item nav-link px-0 me-xl-4" href="/managerSelectSpa">
                <i class='bx bx-rotate-left'></i>
              </a>
                  <input type="text" class="form-control border-0 shadow-none" disabled style="background: white;" value="<?php echo getSpa(@$session->read('infoUser')->id_spa)->name; ?>" placeholder="Search..." aria-label="Search..."  />
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
                      <a target="_blank" class="dropdown-item" href="/designer/<?php echo createSlugMantan($session->read('infoUser')->name).'-'.$session->read('infoUser')->id;?>.html">
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
                        <span class="align-middle">Log Out</span>
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