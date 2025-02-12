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
    <style type="text/css">
      .border-book{
      padding: 20px 10px;
      border: 1px solid #c5c9c9;
      height: 450px;
    }
    .border-book img{
      height: 250px;
    }

    .border-book h5{
      color: #5f93e5;
      width: 100%;
      overflow: hidden;
      white-space: nowrap;
      text-overflow: ellipsis;
    }
    </style>
  </head>

  <body>
    <!-- Content -->
<?php if(empty($listData)){ ?>
    <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
          <!-- Register -->
          <div class="card">
            <div class="card-body">
              <!-- Logo -->
              <div class="app-brand justify-content-center">
                <a href="/" class="app-brand-link gap-2">
                  <span class="app-brand-logo demo">
                    <img src="/plugins/thuvien/view/home/assets/img/logo-phoenix.png" width="50">
                  </span>
                  <span class="app-brand-text demo text-body fw-bolder">Tra cứu sách</span>
                </a>
              </div>
              <!-- /Logo -->
              
              <form id="" class="mb-3" action="" method="GET">
                <div class="mb-3">
                  <label for="phone" class="form-label">Tên sách cần tra cứu</label>
                  <input type="text" class="form-control" id="name" name="name" value="<?php echo @$_GET['name']; ?>" />
                </div>
                
                <div class="mb-3">
                  <button class="btn btn-primary d-grid w-100" type="submit">Tìm kiếm</button>
                </div>
              </form>
           
            </div>
              <p class="text-center">
                <a href="/login">
                  <span>Đăng nhập</span>
                </a>
              </p>

          </div>
          <!-- /Register -->
        </div>
      </div>
    </div>
<?php }else{ ?>
        <div class="layout-page mb-5">
          <!-- Navbar -->
          <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
           

            <div style="width: 100%;">
              <!-- Search -->
              <div >
                <div >
                  
                  <form id="" class="" action="" method="GET">
                    <div class="row">
                      <div class="col-md-1">
                          <img src="/plugins/thuvien/view/home/assets/img/logo-phoenix.png" width="50">
                      </div>
                      <div class="col-md-8 mt-1">
                        <input type="text" class="form-control" placeholder="tra cứu sách" id="name" name="name" value="<?php echo @$_GET['name']; ?>" />
                      </div>
                      <div class="col-md-2 mt-1">
                        <button class="btn btn-primary d-grid w-100" type="submit">Tìm kiếm</button>

                      </div>
                       <div class="col-md-1 mt-3">
                          <a href="/login">
                        <span>Đăng nhập</span>
                         </a>
                       </div>
                    </div>
                  </form>
                </div>
              </div>
            
              <!-- /Search -->


            </div>
            
          </nav>
        </div>
         <div class="container-xxl mt-5">
            <div class="row">

                <?php
                if(!empty($listData)){
                 foreach($listData as $key => $item){
                  $thuvien = '<div style="color: #000;">';
                  if(!empty($item->warehouse)){
                    foreach($item->warehouse as $k => $value){
                      if($k==0){
                        $thuvien .= '<span>Thư viên: '.@$value->building->name.'<br/> Địa chỉ: '.@$value->building->address.'<br/>
                                  Số lượng: '.@$value->quantity_warehous.'</span> <br/>
                                 
                        ';
                      }
                    }
                    
                  }
                  $thuvien .=' <span style="color: #000;">Số lượng xem online: '.@$item->view.'<span> </div>';
                  $image= '/plugins/thuvien/view/image/default-image.jpg';
                  if(!empty($item->image)){
                    $image = $item->image;
                  }
                  echo '<div class="col-sm-3 mt-4 ">
                    <div class="border-book">
                    <a  data-bs-toggle="modal" data-bs-target="#basicModal'.$item->id.'" >
                    <div class="row ">
                        <h5 style="color: #5f93e5;">'.@$item->name.'</h5>
                        <img src="'.$image.'" style="width: 100%  ">
                          <p>'.$thuvien.'</p>
                    </div>
                    </a>
                    </div>
                  </div>';
                }
              }else{
                echo '<div class="col-sm-12 mt-4">
                    <a href="/">
                    <div class="row">
                      <div class="col-sm-10">
                         <h5 style="color: #262626;text-align: center;font-size: 20px;">Không tìm thấy dữ liệu</h5>
                      </div>
                    </div>
                    </a>
                  </div>';
              }
                 ?>
            </div>
          </div>

          <div class="demo-inline-spacing">
            <nav aria-label="Page navigation">
              <ul class="pagination justify-content-center">
                <?php
                if ($totalPage > 0) {
                  if ($page > 5) {
                    $startPage = $page - 5;
                  } else {
                    $startPage = 1;
                  }

                  if ($totalPage > $page + 5) {
                    $endPage = $page + 5;
                  } else {
                    $endPage = $totalPage;
                  }

                  echo '<li class="page-item first">
                  <a class="page-link" href="'.$urlPage.'1">
                  <i class="tf-icon bx bx-chevrons-left"></i>
                  </a>
                  </li>';

                  for ($i = $startPage; $i <= $endPage; $i++) {
                    $active = ($page == $i) ? 'active' : '';

                    echo '<li class="page-item '.$active.'">
                    <a class="page-link" href="'.$urlPage.$i.'">'.$i.'</a>
                    </li>';
                  }

                  echo '<li class="page-item last">
                  <a class="page-link" href="'.$urlPage.$totalPage.'">
                  <i class="tf-icon bx bx-chevrons-right"></i>
                  </a>
                  </li>';
                }
                ?>
              </ul>
            </nav>
          </div>
<?php } 
  if(!empty($listData)){
              foreach ($listData as $item) {
                 $thuvien = '<div style="color: #768798;">';
                  if(!empty($item->warehouse)){
                    foreach($item->warehouse as $k => $value){
                        $thuvien .= '<span><label class="form-label">Thư viên:</label> '.@$value->building->name.'<br/> <label class="form-label">Địa chỉ:</label> '.@$value->building->address.'<br/>
                                  <label class="form-label">Số lượng:</label> '.@$value->quantity_warehous.'</span> <br/>';
                    }
                    
                  }
                  $thuvien .='  <label class="form-label">Số lượng xem online:</label> '.@$item->view.'<span> </div>';
                  $image= '/plugins/thuvien/view/image/default-image.jpg';
                  if(!empty($item->image)){
                    $image = $item->image;
                  }

                  $link= '<span style="color: red">Không có bản online</span>';
                  if(!empty($item->file_pdf)){
                    $link =  '<a href="/detailBook/'.@$item->slug.'-'.$item->id.'.html" class="btn btn-primary">Đọc bản online</a>';
                  }
               ?>
                        <div class="modal fade" id="basicModal<?php echo $item->id; ?>"  name="id">
                                
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header form-label border-bottom">
                                <h5 class="modal-title " id="exampleModalLabel1">Thông tin sách</h5>
                                <button type="button" class="btn-close"data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="card-body">
                              <div class="row ">
                                  <h5 style="color: #5f93e5;" class="form-label"><?php echo @$item->name ?></h5>
                                  <img src="<?php echo $image ?>" style="width: 100%  ">
                                    <p><?php echo $thuvien ?></p>
                                    <p style="text-align: center;"><?php echo $link ?></p>
                              </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      <?php }} ?>

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


