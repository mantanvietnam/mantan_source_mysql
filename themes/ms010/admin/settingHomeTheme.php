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
                 ALBUM
              </button>
            </li>
            <li class="nav-item">
              <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-specifications" aria-controls="navs-top-info" aria-selected="false">
                DỊCH VỤ
              </button>
            </li>
            <li class="nav-item">
              <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-product" aria-controls="navs-top-image" aria-selected="false">
                LIÊN HỆ 
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
                <label class="form-label" for="basic-default-fullname">Ảnh nều</label>
                <?php showUploadFile('background_2','background_2', @$data['background_2'],4);?>
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">Tiêu đề cam kết 1</label>
                <input type="text" class="form-control mb-3" name="title_ck_1" value="<?php echo @$data['title_ck_1'];?>" />
                <label class="form-label" for="basic-default-fullname">Nội dung cam kết 1</label>
                <input type="text" class="form-control mb-3" name="content_ck_1" value="<?php echo @$data['content_ck_1'];?>" />
                <label class="form-label" for="basic-default-fullname">ảnh cam kết 1</label>
                <?php showUploadFile('image_ck_1','image_ck_1', @$data['image_ck_1'],11);?>
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">Tiêu đề cam kết 2</label>
                <input type="text" class="form-control mb-3" name="title_ck_2" value="<?php echo @$data['title_ck_2'];?>" />
                <label class="form-label" for="basic-default-fullname">Nội dung cam kết 2</label>
                <input type="text" class="form-control mb-3" name="content_ck_2" value="<?php echo @$data['content_ck_2'];?>" />
                <label class="form-label" for="basic-default-fullname">ảnh cam kết 2</label>
                <?php showUploadFile('image_ck_2','image_ck_2', @$data['image_ck_2'],12);?>
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">Tiêu đề cam kết 3</label>
                <input type="text" class="form-control mb-3" name="title_ck_3" value="<?php echo @$data['title_ck_3'];?>" />
                <label class="form-label" for="basic-default-fullname">Nội dung cam kết 3</label>
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
               <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <label class="form-label" for="basic-default-fullname">Tiêu đề</label>
                <input type="text" class="form-control" name="title_al" value="<?php echo @$data['title_al'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <label class="form-label" for="basic-default-fullname">Nội dung</label>
                <input type="text" class="form-control" name="content_al" value="<?php echo @$data['content_al'];?>" />
              </div>
               <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <label class="form-label" for="basic-default-fullname">Id Album</label>
                <input type="text" class="form-control" name="id_album" value="<?php echo @$data['id_album'];?>" />
              </div>
            </div>
          </div>    
          <div class="tab-pane fade" id="navs-top-specifications" role="tabpanel">
            <div class="card-body row ">
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">Ảnh bên trái</label>
                <?php showUploadFile('image_3','image_3', @$data['image_3'],5);?>
              </div>
               <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">Nội dung ảnh</label>
                <input type="text" class="form-control" name="content_dv_image" value="<?php echo @$data['content_dv_image'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">Tiêu đề </label>
                <input type="text" class="form-control" name="title_dv" value="<?php echo @$data['title_dv'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">Nội dung </label>
                <input type="text" class="form-control" name="content_dv" value="<?php echo @$data['content_dv'];?>" />
              </div>
                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-8 col-lg-8 col-xl-8"></div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">Tiêu đề dịch vụ 1</label>
                <input type="text" class="form-control mb-3" name="title_dv_1" value="<?php echo @$data['title_dv_1'];?>" />
                <label class="form-label" for="basic-default-fullname">nội dung dịch vụ 1</label>
                <input type="text" class="form-control mb-3" name="content_dv_1" value="<?php echo @$data['content_dv_1'];?>" />
                <label class="form-label" for="basic-default-fullname">ảnh dịch vụ 1</label>
                <?php showUploadFile('image_dv_1','image_dv_1', @$data['image_dv_1'],21);?>
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">Tiêu đề dịch vụ 2</label>
                <input type="text" class="form-control mb-3" name="title_dv_2" value="<?php echo @$data['title_dv_2'];?>" />
                <label class="form-label" for="basic-default-fullname">nội dung dịch vụ 2</label>
                <input type="text" class="form-control mb-3" name="content_dv_2" value="<?php echo @$data['content_dv_2'];?>" />
                <label class="form-label" for="basic-default-fullname">ảnh dịch vụ 2</label>
                <?php showUploadFile('image_dv_2','image_dv_2', @$data['image_dv_2'],22);?>
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">Tiêu đề dịch vụ 3</label>
                <input type="text" class="form-control mb-3" name="title_dv_3" value="<?php echo @$data['title_dv_3'];?>" />
                <label class="form-label" for="basic-default-fullname">nội dung dịch vụ 3</label>
                <input type="text" class="form-control mb-3" name="content_dv_3" value="<?php echo @$data['content_dv_3'];?>" />
                <label class="form-label" for="basic-default-fullname">ảnh dịch vụ 3</label>
                <?php showUploadFile('image_dv_3','image_dv_3', @$data['image_dv_3'],23);?>
              </div>
            </div>
          </div>
          
          <div class="tab-pane fade" id="navs-top-product" role="tabpanel">
            <div class="card-body row ">
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <label class="form-label" for="basic-default-fullname">Tiêu đề </label>
                <input type="text" class="form-control" name="title_lh" value="<?php echo @$data['title_lh'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <label class="form-label" for="basic-default-fullname">Nội dung 1</label>
                <input type="text" class="form-control" name="content_lh" value="<?php echo @$data['content_lh'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <label class="form-label" for="basic-default-fullname">Số điện thoại </label>
                <input type="text" class="form-control" name="phone" value="<?php echo @$data['phone'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <label class="form-label" for="basic-default-fullname">Nội dung 2 </label>
                <input type="text" class="form-control" name="content_lh2" value="<?php echo @$data['content_lh2'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <label class="form-label" for="basic-default-fullname">chữ vàng ở fom </label>
                <input type="text" class="form-control" name="title_gtf" value="<?php echo @$data['title_gtf'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <label class="form-label" for="basic-default-fullname">chữ vàng trắng form </label>
                <textarea class="form-control" name="content_lht"><?php echo @$data['content_lht'] ?></textarea>
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <label class="form-label" for="basic-default-fullname">Ảnh bên phải </label>
                <?php showUploadFile('image4','image4', @$data['image4'],6);?>
              </div>
             
            </div>
          </div>
          <div class="tab-pane fade" id="navs-top-Post" role="tabpanel">
            <div class="card-body row ">
               <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <label class="form-label" for="basic-default-fullname">Tiêu đề</label>
                <input type="text" class="form-control" name="title_tt" value="<?php echo @$data['title_tt'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <label class="form-label" for="basic-default-fullname">Nội dung</label>
                <input type="text" class="form-control" name="content_tt" value="<?php echo @$data['content_tt'];?>" />
              </div>
            </div>
          </div>
           <div class="tab-pane fade" id="navs-top-footer" role="tabpanel">
            <div class="card-body row ">
               <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <label class="form-label" for="basic-default-fullname">Ảnh nều</label>
                <?php showUploadFile('background_4','background_4', @$data['background_4'],9);?>
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <label class="form-label" for="basic-default-fullname">Địa chỉ</label>
                <input type="text" class="form-control" name="address" value="<?php echo @$data['address'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <label class="form-label" for="basic-default-fullname">Hotline</label>
                <input type="text" class="form-control" name="hotline" value="<?php echo @$data['hotline'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <label class="form-label" for="basic-default-fullname">Email</label>
                <input type="text" class="form-control" name="email" value="<?php echo @$data['email'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <label class="form-label" for="basic-default-fullname">Giới thiệu </label>
                <textarea class="form-control" name="content_footer"><?php echo @$data['content_footer'] ?></textarea>
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <label class="form-label" for="basic-default-fullname">chữ chân trang</label>
                <input type="text" class="form-control" name="textfooter" value="<?php echo @$data['textfooter'];?>" />
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
