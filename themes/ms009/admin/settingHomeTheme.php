<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">	 Theme - Home Setting</h4>

  <!-- Basic Layout -->
  <p><?php echo @$mess;?></p>
  <?= $this->Form->create(); ?>
  <div class="row">
    <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
      <div class=" mb-4">
        <div class="nav-align-top mb-4">
          <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
              <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-home" aria-controls="navs-top-home" aria-selected="true">
                KHỐI ĐẦU
              </button>
            </li>
            <li class="nav-item">
              <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-rule" aria-controls="navs-top-info" aria-selected="false">
                 DỊCH VỤ
              </button>
            </li>
            <li class="nav-item">
              <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-info" aria-controls="navs-top-info" aria-selected="false">
                 GIỚI THIỆU
              </button>
            </li>
            
             <li class="nav-item">
              <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-image" aria-controls="navs-top-image" aria-selected="false">
                 ĐẶC SẢN
              </button>
            </li>
            <li class="nav-item">
              <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-specifications" aria-controls="navs-top-info" aria-selected="false">
                 LIÊN HỆ
              </button>
            </li>
           <li class="nav-item">
            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-product" aria-controls="navs-top-image" aria-selected="false">
              SẢN PHẨM
           </button>
         </li>
          <li class="nav-item">
            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-feedback" aria-controls="navs-top-image" aria-selected="false">
              FEEDBACK
           </button>
         </li>
         <li class="nav-item">
            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-Post" aria-controls="navs-top-Post" aria-selected="false">
              TIN TỨC
           </button>
         </li>
          <li class="nav-item">
            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-footer" aria-controls="navs-top-Post" aria-selected="false">
              CHÂN TRANG
           </button>
         </li>
       </ul>
        <div class="card-body tab-content ">
          <div class="tab-pane fade active show" id="navs-top-home" role="tabpanel">
            <div class="card-body row ">
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <label class="form-label" for="basic-default-fullname">Logo</label>
                <?php showUploadFile('logo','logo', @$data['logo'],1);?>
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <label class="form-label" for="basic-default-fullname">Ảnh nều khối đầu</label>
                <?php showUploadFile('background_top','background_top', @$data['background_top'],2);?>
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <label class="form-label" for="basic-default-fullname">Tiêu đề chữ nhỏ</label>
                <input type="text" class="form-control" name="title_top_nho" value="<?php echo @$data['title_top_nho'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <label class="form-label" for="basic-default-fullname">Tiêu đề chữ to</label>
                <input type="text" class="form-control" name="title_top_to" value="<?php echo @$data['title_top_to'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <label class="form-label" for="basic-default-fullname">Nội dung chữ nhỏ</label>
                <input type="text" class="form-control" name="content_top" value="<?php echo @$data['content_top'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <label class="form-label" for="basic-default-fullname">ảnh bên phải</label>
                 <?php showUploadFile('image_top','image_top', @$data['image_top'],3);?>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="navs-top-rule" role="tabpanel">
            <div class="card-body row ">
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">Tiêu đề chữ nhỏ</label>
                <input type="text" class="form-control" name="title_dv_nho" value="<?php echo @$data['title_dv_nho'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">Tiêu đề chữ to</label>
                <input type="text" class="form-control" name="title_dv_to" value="<?php echo @$data['title_dv_to'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">Tiêu đề chữ to</label>
                <input type="text" class="form-control" name="content_dv" value="<?php echo @$data['content_dv'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">Tiêu đề dịch vụ 1</label>
                <input type="text" class="form-control mb-3" name="title_dv_1" value="<?php echo @$data['title_dv_1'];?>" />
                <label class="form-label" for="basic-default-fullname">nội dung dịch vụ 1</label>
                <input type="text" class="form-control mb-3" name="content_dv_1" value="<?php echo @$data['content_dv_1'];?>" />
                <label class="form-label" for="basic-default-fullname">Ảnh dịch vụ 1</label>
                 <?php showUploadFile('image_dv_1','image_dv_1', @$data['image_dv_1'],4);?>
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">Tiêu đề dịch vụ 2</label>
                <input type="text" class="form-control mb-3" name="title_dv_2" value="<?php echo @$data['title_dv_2'];?>" />
                <label class="form-label" for="basic-default-fullname">nội dung dịch vụ 2</label>
                <input type="text" class="form-control mb-3" name="content_dv_2" value="<?php echo @$data['content_dv_2'];?>" />
                <label class="form-label" for="basic-default-fullname">Ảnh dịch vụ 1</label>
                 <?php showUploadFile('image_dv_2','image_dv_2', @$data['image_dv_2'],5);?>
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">Tiêu đề dịch vụ 3</label>
                <input type="text" class="form-control mb-3" name="title_dv_3" value="<?php echo @$data['title_dv_3'];?>" />
                <label class="form-label" for="basic-default-fullname">nội dung dịch vụ 3</label>
                <input type="text" class="form-control mb-3" name="content_dv_3" value="<?php echo @$data['content_dv_3'];?>" />
                <label class="form-label" for="basic-default-fullname">Ảnh dịch vụ 3</label>
                 <?php showUploadFile('image_dv_3','image_dv_3', @$data['image_dv_3'],6);?>
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">Tiêu đề dịch vụ 4</label>
                <input type="text" class="form-control mb-3" name="title_dv_4" value="<?php echo @$data['title_dv_4'];?>" />
                <label class="form-label" for="basic-default-fullname">nội dung dịch vụ 4</label>
                <input type="text" class="form-control mb-3" name="content_dv_4" value="<?php echo @$data['content_dv_4'];?>" />
                <label class="form-label" for="basic-default-fullname">Ảnh dịch vụ 4</label>
                 <?php showUploadFile('image_dv_4','image_dv_4', @$data['image_dv_4'],7);?>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="navs-top-info" role="tabpanel">
            <div class="card-body row ">
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <label class="form-label" for="basic-default-fullname">ảnh bên trái</label>
                 <?php showUploadFile('image_gt','image_gt', @$data['image_gt'],8);?>
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <label class="form-label" for="basic-default-fullname">tiêu đề chữ nhỏ</label>
                <input type="text" class="form-control" name="title_gt_nho" value="<?php echo @$data['title_gt_nho'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <label class="form-label" for="basic-default-fullname">tiêu đề chữ to</label>
                <input type="text" class="form-control" name="title_gt_to" value="<?php echo @$data['title_gt_to'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <label class="form-label" for="basic-default-fullname">Nội dung chữ Đen</label>
                <input type="text" class="form-control" name="content_gt_den" value="<?php echo @$data['content_gt_den'];?>" />
              </div>
               <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <label class="form-label" for="basic-default-fullname">Nội dung chữ tím</label>
                <input type="text" class="form-control" name="content_gt_tim" value="<?php echo @$data['content_gt_tim'];?>" />
              </div>
               <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <label class="form-label" for="basic-default-fullname">Link đăng ký</label>
                <input type="text" class="form-control" name="link_gt" value="<?php echo @$data['link_gt'];?>" />
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="navs-top-image" role="tabpanel">
            <div class="card-body row ">
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">tiêu đề chữ nhỏ</label>
                <input type="text" class="form-control" name="title_ds_nho" value="<?php echo @$data['title_ds_nho'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">tiêu đề chữ to</label>
                <input type="text" class="form-control" name="title_ds_to" value="<?php echo @$data['title_ds_to'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">Nội dung</label>
                <input type="text" class="form-control" name="content_ds" value="<?php echo @$data['content_ds'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">ảnh trung tâm</label>
                 <?php showUploadFile('image_ds','image_ds', @$data['image_ds'],9);?>
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">tiêu đề đặc sản 1</label>
                <input type="text" class="form-control mb-3" name="title_ds_1" value="<?php echo @$data['title_ds_1'];?>" />
                <label class="form-label" for="basic-default-fullname">tiêu đề đặc sản 1</label>
                <input type="text" class="form-control" name="content_ds_1" value="<?php echo @$data['content_ds_1'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">tiêu đề đặc sản 2</label>
                <input type="text" class="form-control mb-3" name="title_ds_2" value="<?php echo @$data['title_ds_2'];?>" />
                <label class="form-label" for="basic-default-fullname">tiêu đề đặc sản 2</label>
                <input type="text" class="form-control" name="content_ds_2" value="<?php echo @$data['content_ds_2'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">tiêu đề đặc sản 3</label>
                <input type="text" class="form-control mb-3" name="title_ds_3" value="<?php echo @$data['title_ds_3'];?>" />
                <label class="form-label" for="basic-default-fullname">tiêu đề đặc sản 3</label>
                <input type="text" class="form-control" name="content_ds_3" value="<?php echo @$data['content_ds_3'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">tiêu đề đặc sản 4</label>
                <input type="text" class="form-control mb-3" name="title_ds_4" value="<?php echo @$data['title_ds_4'];?>" />
                <label class="form-label" for="basic-default-fullname">tiêu đề đặc sản 4</label>
                <input type="text" class="form-control" name="content_ds_4" value="<?php echo @$data['content_ds_4'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">tiêu đề đặc sản 5</label>
                <input type="text" class="form-control mb-3" name="title_ds_5" value="<?php echo @$data['title_ds_5'];?>" />
                <label class="form-label" for="basic-default-fullname">tiêu đề đặc sản 5</label>
                <input type="text" class="form-control" name="content_ds_5" value="<?php echo @$data['content_ds_5'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">tiêu đề đặc sản 6</label>
                <input type="text" class="form-control mb-3" name="title_ds_6" value="<?php echo @$data['title_ds_6'];?>" />
                <label class="form-label" for="basic-default-fullname">tiêu đề đặc sản 6</label>
                <input type="text" class="form-control" name="content_ds_6" value="<?php echo @$data['content_ds_6'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">tiêu đề đặc sản 7</label>
                <input type="text" class="form-control mb-3" name="title_ds_7" value="<?php echo @$data['title_ds_7'];?>" />
                <label class="form-label" for="basic-default-fullname">tiêu đề đặc sản 7</label>
                <input type="text" class="form-control" name="content_ds_7" value="<?php echo @$data['content_ds_7'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">tiêu đề đặc sản 8</label>
                <input type="text" class="form-control mb-3" name="title_ds_8" value="<?php echo @$data['title_ds_8'];?>" />
                <label class="form-label" for="basic-default-fullname">tiêu đề đặc sản 8</label>
                <input type="text" class="form-control" name="content_ds_8" value="<?php echo @$data['content_ds_8'];?>" />
              </div>
            </div>
          </div>    
          <div class="tab-pane fade" id="navs-top-specifications" role="tabpanel">
            <div class="card-body row ">
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <label class="form-label" for="basic-default-fullname">Tiêu đề chữ nhỏ</label>
                <input type="text" class="form-control" name="title_lh_nho" value="<?php echo @$data['title_lh_nho'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <label class="form-label" for="basic-default-fullname">Tiêu đề chữ to</label>
                <input type="text" class="form-control" name="title_lh_to" value="<?php echo @$data['title_lh_to'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <label class="form-label" for="basic-default-fullname">ảnh bên phải</label>
                 <?php showUploadFile('image_lh','image_lh', @$data['image_lh'],9);?>
              </div>
            </div>
          </div>
          
          <div class="tab-pane fade" id="navs-top-product" role="tabpanel">
            <div class="card-body row ">
               <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">Tiêu đề chữ nho</label>
                <input type="text" class="form-control" name="title_sp_nho" value="<?php echo @$data['title_sp_nho'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">Tiêu đề chữ to</label>
                <input type="text" class="form-control" name="title_sp_to" value="<?php echo @$data['title_sp_to'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">Nội dung</label>
                <input type="text" class="form-control" name="content_sp" value="<?php echo @$data['content_sp'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">Tiêu đê sản phẩm 1</label>
                <input type="text" class="form-control mb-3" name="title_sp_1" value="<?php echo @$data['title_sp_1'];?>" />
                <label class="form-label" for="basic-default-fullname">nội dung sản phẩm 1</label>
                <input type="text" class="form-control mb-3" name="content_sp_1" value="<?php echo @$data['content_sp_1'];?>" />
                <label class="form-label" for="basic-default-fullname">Giá 1</label>
                <input type="text" class="form-control mb-3" name="price_sp_1" value="<?php echo @$data['price_sp_1'];?>" />
                <label class="form-label" for="basic-default-fullname">Link dăng ký 1</label>
                <input type="text" class="form-control mb-3" name="link_sp_1" value="<?php echo @$data['link_sp_1'];?>" />
                <label class="form-label" for="basic-default-fullname">Ảnh sản phẩm 1</label>
                 <?php showUploadFile('image_sp_1','image_sp_1', @$data['image_sp_1'],41);?>
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">Tiêu đê sản phẩm 2</label>
                <input type="text" class="form-control mb-3" name="title_sp_2" value="<?php echo @$data['title_sp_2'];?>" />
                <label class="form-label" for="basic-default-fullname">nội dung sản phẩm 2</label>
                <input type="text" class="form-control mb-3" name="content_sp_2" value="<?php echo @$data['content_sp_2'];?>" />
                <label class="form-label" for="basic-default-fullname">Giá 2</label>
                <input type="text" class="form-control mb-3" name="price_sp_2" value="<?php echo @$data['price_sp_2'];?>" />
                <label class="form-label" for="basic-default-fullname">Link dăng ký 2</label>
                <input type="text" class="form-control mb-3" name="link_sp_2" value="<?php echo @$data['link_sp_2'];?>" />
                <label class="form-label" for="basic-default-fullname">Ảnh sản phẩm 2</label>
                 <?php showUploadFile('image_sp_2','image_sp_2', @$data['image_sp_2'],42);?>
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">Tiêu đê sản phẩm 3</label>
                <input type="text" class="form-control mb-3" name="title_sp_3" value="<?php echo @$data['title_sp_3'];?>" />
                <label class="form-label" for="basic-default-fullname">nội dung sản phẩm 3</label>
                <input type="text" class="form-control mb-3" name="content_sp_3" value="<?php echo @$data['content_sp_3'];?>" />
                <label class="form-label" for="basic-default-fullname">Giá 3</label>
                <input type="text" class="form-control mb-3" name="price_sp_3" value="<?php echo @$data['price_sp_3'];?>" />
                <label class="form-label" for="basic-default-fullname">Link dăng ký 3</label>
                <input type="text" class="form-control mb-3" name="link_sp_3" value="<?php echo @$data['link_sp_3'];?>" />
                <label class="form-label" for="basic-default-fullname">Ảnh sản phẩm 3</label>
                 <?php showUploadFile('image_sp_3','image_sp_3', @$data['image_sp_3'],43);?>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="navs-top-feedback" role="tabpanel">
            <div class="card-body row ">
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
              <label class="form-label" for="basic-default-fullname">Ảnh Nền</label>
                 <?php showUploadFile('background_feedback','background_feedback', @$data['background_feedback'],10);?>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="navs-top-Post" role="tabpanel">
            <div class="card-body row ">
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
              <label class="form-label" for="basic-default-fullname">tiêu đề chữ nhỏ</label>
                <input type="text" class="form-control mb-3" name="title_tt_nho" value="<?php echo @$data['title_tt_nho'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
              <label class="form-label" for="basic-default-fullname">tiêu đề chữ to</label>
                <input type="text" class="form-control mb-3" name="title_tt_to" value="<?php echo @$data['title_tt_to'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
              <label class="form-label" for="basic-default-fullname">Nội dung</label>
                <input type="text" class="form-control mb-3" name="content_tt" value="<?php echo @$data['content_tt'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
              <label class="form-label" for="basic-default-fullname">Ảnh Banner trang tin tức</label>
                 <?php showUploadFile('background_post','background_post', @$data['background_post'],11);?>
              </div>
            </div>
          </div>
           <div class="tab-pane fade" id="navs-top-footer" role="tabpanel">
            <div class="card-body row ">
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
              <label class="form-label" for="basic-default-fullname">Tên công ty</label>
                <input type="text" class="form-control mb-3" name="name_company" value="<?php echo @$data['name_company'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <label class="form-label" for="basic-default-fullname">Địa chỉ</label>
                <input type="text" class="form-control mb-3" name="address" value="<?php echo @$data['address'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <label class="form-label" for="basic-default-fullname">điện thoại</label>
                <input type="text" class="form-control mb-3" name="phone" value="<?php echo @$data['phone'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <label class="form-label" for="basic-default-fullname">Email</label>
                <input type="text" class="form-control mb-3" name="email" value="<?php echo @$data['email'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <label class="form-label" for="basic-default-fullname">Facebook</label>
                <input type="text" class="form-control mb-3" name="facebook" value="<?php echo @$data['facebook'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <label class="form-label" for="basic-default-fullname">twitter</label>
                <input type="text" class="form-control mb-3" name="twitter" value="<?php echo @$data['twitter'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <label class="form-label" for="basic-default-fullname">tiktok</label>
                <input type="text" class="form-control mb-3" name="tiktok" value="<?php echo @$data['tiktok'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <label class="form-label" for="basic-default-fullname">chữ trân trang</label>
                <input type="text" class="form-control mb-3" name="textfooter" value="<?php echo @$data['textfooter'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
              <label class="form-label" for="basic-default-fullname">Về chúng tôi</label>
                <textarea class="form-control" name="aboutus"><?php echo @$data['aboutus'];?></textarea>
              </div>
            </div>
          </div>

         
        <div class="mb-3 col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
          <button type="submit" class="btn btn-primary" style="width:75px; height: 35px;">Lưu</button>
        </div>
      </div>
    </div>
  </div>
  </div>
</div>

</div>
<?= $this->Form->end() ?>
</div>
