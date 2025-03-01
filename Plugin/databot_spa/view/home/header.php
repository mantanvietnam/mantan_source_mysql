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
    <link rel="icon" type="image/x-icon" href="/plugins/databot_spa/view/home/assets/img/avatar-default.png" />

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
    <link rel="stylesheet" href="/plugins/databot_spa/view/home/assets/css/demo.css?time=<?php echo time(); ?>" />

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
    <style type="text/css">
      .closemenu{
            display: none;
      }
      .logoutpage{
         padding: 0px !important;
      }

      .showmenu{
            display: block;
            width: 1px;
      }

      .showmenufix{
        display: none;
      }

    </style>
  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="/dashboard" class="app-brand-link">
              <span class="app-brand-text demo menu-text fw-bolder ms-2">DATA SPA</span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block" onclick="closemenu()">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            <!-- Dashboard -->
            <li class="menu-item active">
              <a href="/dashboard" class="menu-link <?php if(@$page_view =='dashboard') echo 'menu-active';?>">
                <i class='bx bx-bar-chart-alt'></i> 
                <div data-i18n="Analytics">Thống kê</div>
              </a>
            </li>

            <!-- Template -->
            <li class="menu-header small text-uppercase"><span class="menu-header-text">Quản lý dịch vụ</span></li>
            <!-- Cards -->

            <li class="menu-item"  id="listRoomBed">
              <a href="/listRoomBed/#listRoomBed" class="menu-link <?php if(!in_array('room', $session->read('infoUser')->module)) echo 'btn disabled';?>" >
                <i class="menu-icon tf-icons bx bx-sitemap"></i>
                <div>Sơ đồ cơ sở</div>
              </a>
            </li>   
            <li class="menu-item <?php if(!empty(@$page_view) && in_array(@$page_view, ['listCustomer','addCustomer','listCategoryCustomer','listSourceCustomer','addDataCustomer','listMedicalHistories','addMedicalHistories'])) echo 'open';?>"  id="listCustomer">
              <a href="javascript:void(0);" class="menu-link menu-toggle <?php if(!in_array('customer', $session->read('infoUser')->module)) echo 'btn disabled';?>">
                <i class="menu-icon tf-icons bx bxs-user-detail"></i>
                <div>Khách hàng</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item ">
                  <a href="/listCustomer/#listCustomer" class="menu-link <?php if(@$page_view =='listCustomer') echo 'menu-active';?>">
                    <div>Khách hàng</div> 
                  </a>
                </li>
                <li class="menu-item">
                  <a href="/listCategoryCustomer" class="menu-link <?php if(@$page_view =='listCategoryCustomer') echo 'menu-active';?>">
                    <div>Nhóm khách hàng</div> 
                  </a>
                </li>
                <li class="menu-item">
                  <a href="/listSourceCustomer" class="menu-link <?php if(@$page_view =='listSourceCustomer') echo 'menu-active';?>">
                    <div>Nguồn khách hàng</div> 
                  </a>
                </li>
              </ul>
            </li>  

            <li class="menu-item"  id="listBookCalendar">
              <a href="/listBookCalendar/#listBookCalendar" class="menu-link <?php if(!in_array('calendar', $session->read('infoUser')->module)) echo 'btn disabled';?> <?php if(@$page_view =='listBookCalendar') echo 'menu-active';?>">
                <i class="menu-icon tf-icons bx bx-calendar"></i>
                <div>Đặt hẹn</div>
              </a>
            </li>

            
            <li class="menu-item  <?php if(!empty(@$page_view) && in_array(@$page_view, ['orderProduct','orderCombo','orderService','buyPrepayCard'])) echo 'open';?>"  id="orderProduct">
              <a href="javascript:void(0);" class="menu-link menu-toggle <?php if(!in_array('product', $session->read('infoUser')->module)) echo 'btn disabled';?>">
                <i class="menu-icon tf-icons bx bxs-shopping-bag"></i>
                <div>Bán hàng</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="/orderProduct/#orderProduct" class="menu-link <?php if(@$page_view =='orderProduct') echo 'menu-active';?>">
                    <div>Bán sản phẩm </div> 
                  </a>
                </li>
                
                <li class="menu-item">
                  <a href="/orderCombo/#orderProduct" class="menu-link <?php if(@$page_view =='orderCombo') echo 'menu-active';  if(!in_array('combo', $session->read('infoUser')->module)) echo 'btn disabled';?>">
                    <div>Bán combo liệu trình </div> 
                  </a>
                </li>
                
                <li class="menu-item">
                  <a href="/orderService/#orderProduct" class="menu-link <?php if(@$page_view =='orderService') echo 'menu-active';?>">
                    <div>Bán dịch vụ  </div> 
                  </a>
                </li>
                
                <li class="menu-item">
                  <a href="/buyPrepayCard/#orderProduct" class="menu-link <?php if(!in_array('prepaid_cards', $session->read('infoUser')->module)) echo 'btn disabled';?>  <?php if(@$page_view =='buyPrepayCard') echo 'menu-active';?>">
                    <div>Bán thẻ trả trước</div> 
                  </a>
                </li>
                
              </ul>
            </li>

            <li class="menu-item <?php if(!empty(@$page_view) && in_array(@$page_view, ['listOrderProduct','listOrderCombo','listOrderService','listCustomerPrepayCard'])) echo 'open';?>"  id="listOrderProduct">
              <a href="javascript:void(0);" class="menu-link menu-toggle <?php if(!in_array('product', $session->read('infoUser')->module)) echo 'btn disabled';?>">
                <i class="menu-icon tf-icons bx bx-list-ul"></i>
                <div>Đơn hàng</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="/listOrderProduct/#listOrderProduct" class="menu-link <?php if(@$page_view =='listOrderProduct') echo 'menu-active';?>">
                    <div>Đơn sản phẩm </div> 
                  </a>
                </li>
                
                <li class="menu-item">
                  <a href="/listOrderCombo/#listOrderProduct" class="menu-link <?php if(!in_array('combo', $session->read('infoUser')->module)) echo 'btn disabled';?> <?php if(@$page_view =='listOrderCombo') echo 'menu-active';?>">
                    <div>Đơn combo liệu trình</div> 
                  </a>
                </li>
                
                <li class="menu-item">
                  <a href="/listOrderService/#listOrderProduct" class="menu-link <?php if(@$page_view =='listOrderService') echo 'menu-active';?>">
                    <div>Đơn dịch vụ</div> 
                  </a>
                </li>
                
                <li class="menu-item">
                  <a href="/listCustomerPrepayCard/#listOrderProduct" class="menu-link <?php if(!in_array('prepaid_cards', $session->read('infoUser')->module)) echo 'btn disabled';?> <?php if(@$page_view =='listCustomerPrepayCard') echo 'menu-active';?>">
                    <div>Đơn thẻ trả trước</div> 
                  </a>
                </li>
              </ul>
            </li>

            <li class="menu-item <?php if(!empty(@$page_view) && in_array(@$page_view, ['listCollectionBill','listBill','addBill','addCollectionBilladdCollectionBill'])) echo 'open';?>"  id="listCollectionBill">
              <a href="javascript:void(0);" class="menu-link menu-toggle <?php if(!in_array('bill', $session->read('infoUser')->module)) echo 'btn disabled';?>">
                <i class="menu-icon tf-icons bx bxs-bar-chart-square"></i>
                <div>Quản lý thu chi</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="/listCollectionBill/#listCollectionBill" class="menu-link <?php if(@$page_view =='listCollectionBill') echo 'menu-active';?>">
                    <div>Phiếu thu</div> 
                  </a>
                </li>
                <li class="menu-item">
                  <a href="/listBill/#listCollectionBill" class="menu-link <?php if(@$page_view =='listBill') echo 'menu-active';?>">
                    <div>Phiếu chi</div> 
                  </a>
                </li>
              </ul>
            </li>

            <li class="menu-item <?php if(!empty(@$page_view) && in_array(@$page_view, ['listCollectionDebt','listPayableDebt','addPayableDebt','addCollectionDebt'])) echo 'open';?>"  id="listCollectionDebt">
              <a href="javascript:void(0);" class="menu-link menu-toggle <?php if(!in_array('bill', $session->read('infoUser')->module)) echo 'btn disabled';?>">
                <i class="menu-icon tf-icons bx bx-book-content"></i>
                <div>Quản lý công nợ</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="/listCollectionDebt/#listCollectionDebt" class="menu-link <?php if(@$page_view =='listCollectionDebt') echo 'menu-active';?>">
                    <div>Công nợ phải thu</div> 
                  </a>
                </li>
                <li class="menu-item">
                  <a href="/listPayableDebt/#listCollectionDebt" class="menu-link <?php if(@$page_view =='listPayableDebt') echo 'menu-active';?>">
                    <div>Công nợ phải trả</div> 
                  </a>
                </li>
              </ul>
            </li>

            <li class="menu-item <?php if(!empty(@$page_view) && in_array(@$page_view, ['revenueStatistical','listAgency','userServicestatistical','listUserserviceHistories'])) echo 'open';?>"  id="revenueStatistical">
              <a href="javascript:void(0);" class="menu-link menu-toggle <?php if(!in_array('static', $session->read('infoUser')->module)) echo 'btn disabled';?>">
                <i class="menu-icon tf-icons bx bxs-bar-chart-square"></i>
                <div>Thống kê</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="/revenueStatistical/#revenueStatistical" class="menu-link <?php if(@$page_view =='revenueStatistical') echo 'menu-active';?>">
                    <div>Thống kê doanh thu</div> 
                  </a>
                </li>
                <li class="menu-item">
                  <a href="/userServicestatistical/#revenueStatistical" class="menu-link <?php if(@$page_view =='userServicestatistical') echo 'menu-active';?>">
                    <div>Thống kê sử dụng dịch vụ </div> 
                  </a>
                </li>

                <li class="menu-item">
                  <a href="/listAgency/#revenueStatistical" class="menu-link <?php if(@$page_view =='listAgency') echo 'menu-active';?>">
                    <div>Hoa hồng nhân viên</div>
                  </a>
                </li>

                <li class="menu-item">
                  <a href="/listUserserviceHistories/#revenueStatistical" class="menu-link <?php if(@$page_view =='listUserserviceHistories') echo 'menu-active';?>">
                    <div>Khách trong ngày</div> 
                  </a>
                </li>
              </ul>
            </li>

            <!--
            
                <li class="menu-header small text-uppercase"><span class="menu-header-text">Marketing Automation</span></li>
                

                <li class="menu-item">
                  <a href="/listCampain" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-line-chart"></i>
                    <div>Chiến dịch</div>
                  </a>
                </li> 

                <li class="menu-item">
                  <a href="/listSMSMarketing" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-mail-send"></i>
                    <div>Gửi SMS</div>
                  </a>
                </li>  

                <li class="menu-item">
                  <a href="/listEmailMarketing" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-mail-send"></i>
                    <div>Gửi Email</div>
                  </a>
                </li> 

                <li class="menu-item">
                  <a href="javascript:void(0);" class="menu-link menu-toggle ">
                    <i class="menu-icon tf-icons bx bx-alarm-snooze"></i>
                    <div>Zalo</div>
                  </a>
                  <ul class="menu-sub">
                    <li class="menu-item">
                      <a href="/sendMessZaloOA" class="menu-link ">
                        <div>Gửi tin nhắn Zalo</div> 
                      </a>
                    </li>
                    <li class="menu-item">
                      <a href="/listTemplateZNSZalo" class="menu-link">
                        <div>Mẫu tin nhắn Zalo ZNS</div> 
                      </a>
                    </li>
                    <li class="menu-item">
                      <a href="/settingZaloMarketing" class="menu-link">
                        <div>Cài đặt Zalo</div> 
                      </a>
                    </li>
                  </ul>
                </li>

                <li class="menu-item">
                  <a href="/transactionHistories" class="menu-link ">
                    <i class="menu-icon tf-icons bx bx-credit-card"></i>
                    <div>Nạp tiền</div>
                  </a>
                </li>

                <li class="menu-item">
                  <a href="/guideAddCustomerCampainApi" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-support"></i>
                    <div>Tích hợp Chatbot</div>
                  </a>
                </li>   
            -->

            <!-- Template -->
            <li class="menu-header small text-uppercase"><span class="menu-header-text">Cài đặt hệ thống</span></li>
            <!-- Cards -->

            <li class="menu-item" id="listPrepayCard">
              <a href="/listPrepayCard/#listPrepayCard" class="menu-link <?php if(!in_array('prepaid_cards', $session->read('infoUser')->module)) echo 'btn disabled';?>">
                <i class="menu-icon tf-icons bx bxs-credit-card"></i>
                <div>Loại thẻ trả trước</div>
              </a>
            </li>   
            
            <li class="menu-item <?php if(!empty(@$page_view) && in_array(@$page_view, ['listProduct','listCategoryProduct','listTrademarkProduct','listPartner','addProduct','addProductWarehouse','addPartner'])) echo 'open';?>" id="listProduct">
              <a href="javascript:void(0);" class="menu-link menu-toggle <?php if(!in_array('product', $session->read('infoUser')->module)) echo 'btn disabled';?>">
                <i class="menu-icon tf-icons bx bx-news"></i>
                <div>Sản phẩm</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="/listProduct/#listProduct" class="menu-link <?php if(@$page_view =='listProduct') echo 'menu-active';?>">
                    <div>Sản phẩm</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="/listCategoryProduct/#listProduct" class="menu-link <?php if(@$page_view =='listCategoryProduct') echo 'menu-active';?>">
                    <div>Danh mục sản phẩm</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="/listTrademarkProduct/#listProduct" class="menu-link <?php if(@$page_view =='listTrademarkProduct') echo 'menu-active';?>">
                    <div>Nhãn hiệu</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="/listPartner/#listProduct" class="menu-link <?php if(@$page_view =='listPartner') echo 'menu-active';?>">
                    <div>Đối tác</div>
                  </a>
                </li>
              </ul>
            </li>
            
            <li class="menu-item <?php if(!empty(@$page_view) && in_array(@$page_view, ['listService','listCategoryService','addService'])) echo 'open';?>" id="listService">
              <a href="javascript:void(0);" class="menu-link menu-toggle <?php if(!in_array('product', $session->read('infoUser')->module)) echo 'btn disabled';?>">
                <i class="menu-icon tf-icons bx bx-basket"></i>
                <div>Dịch vụ</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="/listService/#listService" class="menu-link <?php if(@$page_view =='listService') echo 'menu-active';?>">
                    <div>Dịch vụ</div> 
                  </a>
                </li>
                <li class="menu-item">
                  <a href="/listCategoryService/#listService" class="menu-link <?php if(@$page_view =='listCategoryService') echo 'menu-active';?>">
                    <div>Nhóm dịch vụ</div> 
                  </a>
                </li>
               
              </ul>
            </li>

            <li class="menu-item " id="listCombo">
              <a href="/listCombo/#listCombo" class="menu-link <?php if(!in_array('combo', $session->read('infoUser')->module)) echo 'btn disabled';?>">
                <i class='menu-icon tf-icons bx bx-gift'></i>
                <div>Combo liệu trình</div>
              </a>
            </li>

            <li class="menu-item <?php if(!empty(@$page_view) && in_array(@$page_view, ['listWarehouse','importHistorytWarehouse','addWarehouse'])) echo 'open';?>" id="listWarehouse">
              <a href="javascript:void(0);" class="menu-link menu-toggle <?php if(!in_array('product', $session->read('infoUser')->module)) echo 'btn disabled';?>">
                <i class="menu-icon tf-icons bx bx-home"></i>
                <div>Kho hàng</div>
              </a>
              <ul class="menu-sub">
                
                <li class="menu-item">
                  <a href="/listWarehouse/#listWarehouse" class="menu-link <?php if(@$page_view =='listWarehouse') echo 'menu-active';?>">
                    <div>Danh sách kho</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="/importHistorytWarehouse/#listWarehouse" class="menu-link <?php if(@$page_view =='importHistorytWarehouse') echo 'menu-active';?>">
                    <div>Lịch sử nhập kho</div>
                  </a>
                </li>
              </ul>
            </li>

            <li class="menu-item <?php if(!empty(@$page_view) && in_array(@$page_view, ['listBed','listRoom'])) echo 'open';?>" id="listBed">
              <a href="javascript:void(0);" class="menu-link menu-toggle <?php if(!in_array('room', $session->read('infoUser')->module)) echo 'btn disabled';?>">
                <i class="menu-icon tf-icons bx bx-bed"></i>
                <div>Phòng - Giường</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="/listBed/#listBed" class="menu-link <?php if(@$page_view =='listBed') echo 'menu-active';?>">
                    <div>Giường</div> 
                  </a>
                </li>
                <li class="menu-item">
                  <a href="/listRoom/#listBed" class="menu-link <?php if(@$page_view =='listRoom') echo 'menu-active';?>">
                    <div>Phòng</div> 
                  </a>
                </li>
              </ul>
            </li>
            
            <li class="menu-item  <?php if(!empty(@$page_view) && in_array(@$page_view, ['listStaff','listGroupStaff','addStaff','addGroupStaff'])) echo 'open';?>" id="listStaff">
              <a href="javascript:void(0);" class="menu-link menu-toggle <?php if(!in_array('staff', $session->read('infoUser')->module)) echo 'btn disabled';?>">
                <i class="menu-icon tf-icons bx bx-group"></i>
                <div>Đội ngũ</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="/listStaff/#listStaff" class="menu-link <?php if(@$page_view =='listStaff') echo 'menu-active';?>">
                    <div>Nhân viên</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="/listGroupStaff/#listStaff" class="menu-link <?php if(@$page_view =='listGroupStaff') echo 'menu-active';?>">
                    <div>Nhóm nhân viên</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="/listStaffBonus/#listStaff" class="menu-link <?php if(@$page_view =='listStaffBonus') echo 'menu-active';?>">
                    <div>Thưởng phạt nhân viên</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="/listStaffPunish/#listStaff" class="menu-link <?php if(@$page_view =='listStaffPunish') echo 'menu-active';?>">
                    <div>Thưởng phạt nhân viên</div>
                  </a>
                </li>
              </ul>
            </li>
            
            

            <li class="menu-item" id="listSpa">
              <a href="/listSpa/#listSpa" class="menu-link <?php if(@$page_view =='listSpa') echo 'menu-active';?>">
                <i class="menu-icon tf-icons bx bx-news"></i>
                <div>Cơ sở Spa</div>
              </a>
            </li>
          </ul>
        </aside>

        <aside id="layout-menu-close" class="layout-menu menu-vertical menu bg-menu-theme showmenufix">
          <div class="app-brand demo">
            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block" onclick="showemenu()" style="left: 10px;">
              <i class="bx bx-chevron-right bx-sm align-middle"></i>
            </a>
          </div>

          
        </aside>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page" id="logoutpage">
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