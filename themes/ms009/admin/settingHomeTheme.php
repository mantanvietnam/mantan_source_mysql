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
                 ĐỘI NGŨ
              </button>
            </li>
           <li class="nav-item">
            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-contac" aria-controls="navs-top-image" aria-selected="false">
              MẠNG XÃ HỘI
           </button>
         </li>
         <li class="nav-item">
            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-Post" aria-controls="navs-top-Post" aria-selected="false">
              TRANG TIN TỨC
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
             
            </div>
          </div>
          
          <div class="tab-pane fade" id="navs-top-contac" role="tabpanel">
            <div class="card-body row ">
              
            </div>
          </div>
          <div class="tab-pane fade" id="navs-top-Post" role="tabpanel">
            <div class="card-body row ">
              
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
