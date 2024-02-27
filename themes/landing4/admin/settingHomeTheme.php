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
              <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-info" aria-controls="navs-top-info" aria-selected="false">
                KHỐI THỨ 2
              </button>
            </li>
            <li class="nav-item">
              <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-rule" aria-controls="navs-top-info" aria-selected="false">
                KHỐI DỊCH VỤ
              </button>
            </li>
            <li class="nav-item">
              <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-specifications" aria-controls="navs-top-info" aria-selected="false">
                KHỐI THỨ 4
              </button>
            </li>
            <li class="nav-item">
              <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-image" aria-controls="navs-top-image" aria-selected="false">
                KHỐI THƯ VIỆN
              </button>
            </li>
            <li class="nav-item">
              <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-evaluate" aria-controls="navs-top-image" aria-selected="false">
               KHỐI THỐNG KÊ
             </button>
           </li>
           <li class="nav-item">
            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-contac" aria-controls="navs-top-image" aria-selected="false">
             KHỐI MẠNG XÃ HỘI
           </button>
         </li>
       </ul>
        <div class="card-body tab-content ">
          <div class="tab-pane fade active show" id="navs-top-home" role="tabpanel">
            <div class="card-body row ">
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">Logo</label>
                <?php showUploadFile('logo','logo', @$data['logo'],1);?>
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">Ảnh nều khối đầu</label>
                <?php showUploadFile('background_top','background_top', @$data['background_top'],2);?>
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">Tiêu đề </label>
                <input type="text" class="form-control" name="full_name" value="<?php echo @$data['full_name'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-8 col-lg-8 col-xl-8">
                <label class="form-label" for="basic-default-fullname">Nội dung top </label>
                <?php showEditorInput('content_top', 'content_top', @$data['content_top']);?>
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">Link đăng ký </label>
                <input type="text" class="form-control" name="link_top" value="<?php echo @$data['link_top'];?>" />
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="navs-top-info" role="tabpanel">
            <div class="card-body row ">
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">Ảnh chân dung</label>
                <?php showUploadFile('image_Portrait','image_Portrait', @$data['image_Portrait'],3);?>
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">Tôi Là Người </label>
                <input type="text" class="form-control" name="iamhuman" value="<?php echo @$data['iamhuman'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">Link đăng ký </label>
                <input type="text" class="form-control" name="link_2" value="<?php echo @$data['link_2'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-8 col-lg-8 col-xl-8">
                <label class="form-label" for="basic-default-fullname">Giới thiệu</label>
                <?php showEditorInput('content_2', 'content_2', @$data['content_2']);?>
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">Tên</label>
                <input type="text" class="form-control" name="fullname" value="<?php echo @$data['fullname'];?>" />
                <label class="form-label" for="basic-default-fullname">Số điện thoại</label>
                <input type="text" class="form-control" name="phone" value="<?php echo @$data['phone'];?>" />
                <label class="form-label" for="basic-default-fullname">Email</label>
                <input type="text" class="form-control" name="email" value="<?php echo @$data['email'];?>" />
                <label class="form-label" for="basic-default-fullname">Địa chỉ</label>
                <input type="text" class="form-control" name="address" value="<?php echo @$data['address'];?>" />
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="navs-top-rule" role="tabpanel">
            <div class="card-body row ">
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">icon dịch vụ 1</label>
                <input type="text" class="form-control" name="icon_service1" value="<?php echo @$data['icon_service1'];?>" />
                <label class="form-label" for="basic-default-fullname">dịch vụ 1</label>
                <input type="text" class="form-control" name="service1" value="<?php echo @$data['service1'];?>" />
                <label class="form-label" for="basic-default-fullname">Nội dung dịch vụ</label>
                <textarea class="form-control" name="content_service1"><?php echo @$data['content_service1'];?></textarea>
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">icon dịch vụ 2</label>
                <input type="text" class="form-control" name="icon_service2" value="<?php echo @$data['icon_service2'];?>" />
                <label class="form-label" for="basic-default-fullname">dịch vụ 2</label>
                <input type="text" class="form-control" name="service2" value="<?php echo @$data['service2'];?>" />
                <label class="form-label" for="basic-default-fullname">Nội dung dịch vụ 2</label>
                <textarea class="form-control" name="content_service2"><?php echo @$data['content_service2'];?></textarea>
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">icon dịch vụ 3</label>
                <input type="text" class="form-control" name="icon_service3" value="<?php echo @$data['icon_service3'];?>" />
                <label class="form-label" for="basic-default-fullname">dịch vụ 3</label>
                <input type="text" class="form-control" name="service3" value="<?php echo @$data['service3'];?>" />
                <label class="form-label" for="basic-default-fullname">Nội dung dịch vụ 3</label>
                <textarea class="form-control" name="content_service3"><?php echo @$data['content_service3'];?></textarea>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="navs-top-specifications" role="tabpanel">
            <div class="card-body row ">
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">ảnh nền </label>
                <?php showUploadFile('background_4','background_4', @$data['background_4'],4);?>
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">Nội dung</label>
                <textarea class="form-control" name="content_4"><?php echo @$data['content_4'];?></textarea>
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">Link đăng ký </label>
                <input type="text" class="form-control" name="link_4" value="<?php echo @$data['link_4'];?>" />
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="navs-top-image" role="tabpanel">
            <div class="card-body row ">
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">Id Album</label>
                <input type="text" class="form-control" name="id_album" value="<?php echo @$data['id_album'];?>" />
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="navs-top-evaluate" role="tabpanel">
            <div class="card-body row ">   
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">ảnh nền </label>
                <?php showUploadFile('background_5','background_5', @$data['background_5'],5);?>
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">Số thống kê 1</label>
                <input type="text" class="form-control" name="statistics1" value="<?php echo @$data['statistics1'];?>" />
                <label class="form-label" for="basic-default-fullname">Nôi dung thống kê 1</label>
                <input type="text" class="form-control" name="content_statistics1" value="<?php echo @$data['content_statistics1'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">Số thống kê 2</label>
                <input type="text" class="form-control" name="statistics2" value="<?php echo @$data['statistics2'];?>" />
                <label class="form-label" for="basic-default-fullname">Nôi dung thống kê 2</label>
                <input type="text" class="form-control" name="content_statistics2" value="<?php echo @$data['content_statistics2'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">Số thống kê 3</label>
                <input type="text" class="form-control" name="statistics3" value="<?php echo @$data['statistics3'];?>" />
                <label class="form-label" for="basic-default-fullname">Nôi dung thống kê 3</label>
                <input type="text" class="form-control" name="content_statistics3" value="<?php echo @$data['content_statistics3'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">Số thống kê 4</label>
                <input type="text" class="form-control" name="statistics4" value="<?php echo @$data['statistics4'];?>" />
                <label class="form-label" for="basic-default-fullname">Nôi dung thống kê 4</label>
                <input type="text" class="form-control" name="content_statistics4" value="<?php echo @$data['content_statistics4'];?>" />
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="navs-top-contac" role="tabpanel">
            <div class="card-body row ">
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">facebook</label>
                <input type="text" class="form-control" name="facebook" value="<?php echo @$data['facebook'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">instagram</label>
                <input type="text" class="form-control" name="instagram" value="<?php echo @$data['instagram'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">tiktok</label>
                <input type="text" class="form-control" name="tiktok" value="<?php echo @$data['tiktok'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">youtube</label>
                <input type="text" class="form-control" name="youtube" value="<?php echo @$data['youtube'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">linkedin</label>
                <input type="text" class="form-control" name="linkedin" value="<?php echo @$data['linkedin'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">twitter</label>
                <input type="text" class="form-control" name="twitter" value="<?php echo @$data['twitter'];?>" />
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">ảnh nền chân trang </label>
                <?php showUploadFile('background_6','background_6', @$data['background_6'],6);?>
              </div>
              <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                <label class="form-label" for="basic-default-fullname">ảnh ở bên phải tin tức </label>
                <?php showUploadFile('image_Port','image_Port', @$data['image_Port'],7);?>
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
