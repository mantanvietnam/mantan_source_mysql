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
                CAM KẾT
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
                <label class="form-label" for="basic-default-fullname">Ảnh đại diện</label>
                <?php showUploadFile('image_avatar','image_avatar', @$data['image_avatar'],3);?>
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <label class="form-label" for="basic-default-fullname">Tiêu đề </label>
                <input type="text" class="form-control" name="title_top" value="<?php echo @$data['title_top'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <label class="form-label" for="basic-default-fullname">Tiêu đề chữ to</label>
                <textarea class="form-control"  name="content_top"><?php echo @$data['content_top']; ?></textarea>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="navs-top-rule" role="tabpanel">
            <div class="card-body row ">
             <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">Tiêu đề </label>
                <input type="text" class="form-control" name="title_ck" value="<?php echo @$data['title_ck'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">Nội dung </label>
                <input type="text" class="form-control" name="content_ck" value="<?php echo @$data['content_ck'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">Ảnh nều khối đầu</label>
                <?php showUploadFile('background_2','background_2', @$data['background_2'],4);?>
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">Tiêu đề cam kết 1</label>
                <input type="text" class="form-control mb-3" name="title_ck_1" value="<?php echo @$data['title_ck_1'];?>" />
                <label class="form-label" for="basic-default-fullname">Tiêu đề cam kết 1</label>
                <input type="text" class="form-control mb-3" name="content_ck_1" value="<?php echo @$data['content_ck_1'];?>" />
                <label class="form-label" for="basic-default-fullname">ảnh cam kết 1</label>
                <?php showUploadFile('image_ck_1','image_ck_1', @$data['image_ck_1'],11);?>
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">Tiêu đề cam kết 2</label>
                <input type="text" class="form-control mb-3" name="title_ck_2" value="<?php echo @$data['title_ck_2'];?>" />
                <label class="form-label" for="basic-default-fullname">Tiêu đề cam kết 2</label>
                <input type="text" class="form-control mb-3" name="content_ck_2" value="<?php echo @$data['content_ck_2'];?>" />
                <label class="form-label" for="basic-default-fullname">ảnh cam kết 2</label>
                <?php showUploadFile('image_ck_2','image_ck_2', @$data['image_ck_2'],12);?>
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">Tiêu đề cam kết 3</label>
                <input type="text" class="form-control mb-3" name="title_ck_3" value="<?php echo @$data['title_ck_3'];?>" />
                <label class="form-label" for="basic-default-fullname">Tiêu đề cam kết 3</label>
                <input type="text" class="form-control mb-3" name="content_ck_3" value="<?php echo @$data['content_ck_3'];?>" />
                <label class="form-label" for="basic-default-fullname">ảnh cam kết 3</label>
                <?php showUploadFile('image_ck_3','image_ck_3', @$data['image_ck_3'],13);?>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="navs-top-info" role="tabpanel">
            <div class="card-body row ">
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <label class="form-label" for="basic-default-fullname">Ảnh Đại diện</label>
                <?php showUploadFile('image_avatar1','image_avatar1', @$data['image_avatar1'],5);?>
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <label class="form-label" for="basic-default-fullname">Tiêu đề </label>
                <input type="text" class="form-control" name="title_gt" value="<?php echo @$data['title_gt'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <label class="form-label" for="basic-default-fullname">Nội dung </label>
                 <?php showEditorInput('content_gt','content_gt',@$data['content_gt'],0); ?>
              </div>
              
            </div>
          </div>
          <div class="tab-pane fade" id="navs-top-image" role="tabpanel">
            <div class="card-body row ">
              
            </div>
          </div>    
          <div class="tab-pane fade" id="navs-top-specifications" role="tabpanel">
            <div class="card-body row ">
              
            </div>
          </div>
          
          <div class="tab-pane fade" id="navs-top-product" role="tabpanel">
            <div class="card-body row ">
              
            </div>
          </div>
          <div class="tab-pane fade" id="navs-top-feedback" role="tabpanel">
            <div class="card-body row ">
             
            </div>
          </div>
          <div class="tab-pane fade" id="navs-top-Post" role="tabpanel">
            <div class="card-body row ">
              
            </div>
          </div>
           <div class="tab-pane fade" id="navs-top-footer" role="tabpanel">
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
