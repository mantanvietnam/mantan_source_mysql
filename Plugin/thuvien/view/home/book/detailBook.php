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

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="/plugins/thuvien/view/home/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="/plugins/thuvien/view/home/assets/vendor/css/pages/page-auth.css" />
    <!-- Helpers -->
    <script src="/plugins/thuvien/view/home/assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="/plugins/thuvien/view/home/assets/js/config.js"></script>
  </head>

  <body>
    <?php if(empty($data->file_pdf)){ ?>
    <!-- Content -->
    <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
          <!-- Register -->
          <div class="card">
            <div class="card-body">
              <!-- Logo -->
              <div class="app-brand justify-content-center">
                <div class="app-brand-link gap-2">
                  <span class="app-brand-logo demo">
                    <img src="/plugins/thuvien/view/home/assets/img/logo-phoenix.png" width="50">
                  </span>
                  <span class="app-brand-text demo text-body fw-bolder" style="font-size:20px">Sách này không có bản online</span>
                 
                </div>

              </div>
              <!-- /Logo -->
              <p class="text-center">
                 <a href="/serchBook" style="font-size:20px">
                      <small>Quay lại</small>
                    </a>  
                  </p>  
            
           
            </div>


          </div>
          <!-- /Register -->
        </div>
      </div>
    </div>
    <?php }else{
      echo '<div class=""> <embed src="'.$data->file_pdf.'"  style="width:100%; height: 800px;" type="application/pdf"></div>';
    } ?>



    <!-- / Content -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="/plugins/thuvien/view/home/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="/plugins/thuvien/view/home/assets/vendor/libs/popper/popper.js"></script>
    <script src="/plugins/thuvien/view/home/assets/vendor/js/bootstrap.js"></script>
    <script src="/plugins/thuvien/view/home/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="/plugins/thuvien/view/home/assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="/plugins/thuvien/view/home/assets/js/main.js"></script>

    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>


