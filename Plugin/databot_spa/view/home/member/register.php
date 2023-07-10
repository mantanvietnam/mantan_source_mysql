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
  class="light-style customizer-hide"
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

    <title>Đăng ký công cụphần mền quản lý SPA</title>

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

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="/plugins/databot_spa/view/home/assets/vendor/css/pages/page-auth.css" />
    <!-- Helpers -->
    <script src="/plugins/databot_spa/view/home/assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="/plugins/databot_spa/view/home/assets/js/config.js"></script>
  </head>

  <body>
    <!-- Content -->

    <div class="container-xxl">
      <div class="authentication-wrapper  container-p-y">
        <div class="authentication-inner">
          <!-- Register -->
          <div class="card">
            <div class="card-body">
              <!-- Logo -->
              <!-- <div class="app-brand justify-content-center">
                <a href="index.html" class="app-brand-link gap-2">
                  <span class="app-brand-logo demo">
                    <img src="/plugins/databot_spa/view/home/assets/img/avatar-ezpics.png" width="50">
                  </span>
                  <span class="app-brand-text demo text-body fw-bolder">SPA</span>
                </a>
              </div> -->
              <!-- /Logo -->
              <h4 class="mb-2 " style=" text-align: center; ">Phần mền quản lý SPA! 👋</h4>
              <p class="mb-4 " style=" text-align: center; ">Mời bạn đăng ký công cụphần mền quản lý SPA</p>
             <p class="mb-4" style="color: red"> <?php echo @$mess;?></p>
              <form id="formAuthentication" class="mb-3" action="" method="POST" enctype="multipart/form-data" onsubmit="functions.submitForgot(); return false;">
                <input type="hidden" name="_csrfToken" value="<?php echo $csrfToken;?>">
                <div class="row">
                  <div class=" col-12 col-sm-12 col-md-6 mb-3">
                    <label for="" class="form-label">Tên Spa  (*)</label>
                    <input type="text" required class="form-control" id="name_spa" name="name_spa" placeholder="" autofocus />
                  </div>
                  <!-- <div class=" col-12 col-sm-12 col-md-6 mb-3">
                    <label for="" class="form-label">Họ và tên (*)</label>
                    <input type="text" required class="form-control" id="name" name="name" placeholder="" autofocus />
                  </div> -->
                  <div class=" col-12 col-sm-12 col-md-6 mb-3">
                    <label for="" class="form-label">Số điện thoại (*)</label>
                    <input type="text" required class="form-control" id="phone" name="phone" placeholder="" autofocus />
                  </div>
                  <div class=" col-12 col-sm-12 col-md-6 mb-3">
                    <label for="" class="form-label">Email (*)</label>
                    <input type="text" required class="form-control" id="email" name="email" placeholder="" autofocus />
                  </div>
                  
                  <div class=" col-12 col-sm-12 col-md-6 mb-3 form-password-toggle">
                    <div class="d-flex justify-content-between">
                      <label class="form-label" for="password">Mật khẩu (*)</label>
                    </div>
                    <div class="input-group input-group-merge">
                      <input type="password" required id="password" class="form-control" name="password" placeholder="" aria-describedby="password" />
                      <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                    </div>
                  </div>
                  <div class=" col-12 col-sm-12 col-md-6 mb-3">
                    <label for="" class="form-label">Địa chỉ</label>
                    <input type="text" required class="form-control" id="address" name="address" placeholder="" autofocus />
                  </div>
                  <div class=" col-12 col-sm-12 col-md-6 mb-3 form-password-toggle">
                    <div class="d-flex justify-content-between">
                      <label class="form-label" for="password">Nhập lại mật khẩu (*)</label>
                    </div>
                    <div class="input-group input-group-merge">
                      <input type="password" required id="password_again" class="form-control" name="password_again" placeholder="" aria-describedby="password_again" />
                      <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                    </div>
                  </div>
                </div>
                
                <div class="text-center" style=" width: 10%; margin: 0 45%;  ">
                  <button class="btn btn-primary d-grid w-100" type="submit">Đăng ký</button>
                </div>
              </form>

              <p class="text-center">
                <span>Bạn đã có tài khoản?</span>
                <a href="/login">
                  <span>Đăng nhập</span>
                </a>
              </p>
            </div>
          </div>
          <!-- /Register -->
        </div>
      </div>
    </div>

    <!-- / Content -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="/plugins/databot_spa/view/home/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="/plugins/databot_spa/view/home/assets/vendor/libs/popper/popper.js"></script>
    <script src="/plugins/databot_spa/view/home/assets/vendor/js/bootstrap.js"></script>
    <script src="/plugins/databot_spa/view/home/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="/plugins/databot_spa/view/home/assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="/plugins/databot_spa/view/home/assets/js/main.js"></script>

    <!-- Page JS -->

  
    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>
