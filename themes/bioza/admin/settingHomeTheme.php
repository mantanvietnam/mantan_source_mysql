<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">	 Theme - Home Setting</h4>

    <!-- Basic Layout -->
    <p><?php echo @$mess;?></p>
    <?= $this->Form->create(); ?>
      <div class="row">
        <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0 form-label">Khối đầu</h5>
            </div>
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
                <!-- <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-8 col-lg-8 col-xl-8">
                  <label class="form-label" for="basic-default-fullname">Nội dung top </label>
                  <?php showEditorInput('content_top', 'content_top', @$data['content_top']);?>
                </div> -->
                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                  <label class="form-label" for="basic-default-fullname">Nội dung 1 </label>
                   <input type="text" class="form-control" name="content_top1" value="<?php echo @$data['content_top1'];?>" />
                </div>
                 <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                  <label class="form-label" for="basic-default-fullname">Nội dung 2 </label>
                   <input type="text" class="form-control" name="content_top2" value="<?php echo @$data['content_top2'];?>" />
                </div>
                 <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                  <label class="form-label" for="basic-default-fullname">Ảnh chân dung</label>
                   <?php showUploadFile('image_Portrait','image_Portrait', @$data['image_Portrait'],3);?>
                </div>
                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                  <label class="form-label" for="basic-default-fullname">Mã video youtube</label>
                   <input type="text" class="form-control" name="code_videoyoutube" value="<?php echo @$data['code_videoyoutube'];?>" />
                </div>
                <div class="mb-3 col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                  <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 form-label">Khối thứ 2</h5>
                  </div>
                </div>
                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                  <label class="form-label" for="basic-default-fullname">Tên diễn giả</label>
                  <input type="text" class="form-control" name="speaker_name" value="<?php echo @$data['speaker_name'];?>" />
                </div>
                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                  <label class="form-label" for="basic-default-fullname">Ảnh chân dung</label>
                  <?php showUploadFile('image_Portrait2','image_Portrait2', @$data['image_Portrait2'],4);?>
                </div>
                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                  <label class="form-label" for="basic-default-fullname">Ảnh nền</label>
                  <?php showUploadFile('background_2','background_2', @$data['background_2'],5);?>
                </div>
                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                  <label class="form-label" for="basic-default-fullname">Giới thiệu</label>
                  <textarea class="form-control" name="content_2"><?php echo @$data['content_2'];?></textarea>
                </div>
                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                  <label class="form-label" for="basic-default-fullname">Emall</label>
                  <input type="text" class="form-control" name="email" value="<?php echo @$data['email'];?>" />
                </div>
                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                  <label class="form-label" for="basic-default-fullname">Số điện thoại</label>
                  <input type="text" class="form-control" name="phone" value="<?php echo @$data['phone'];?>" />
                </div>
                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                  <label class="form-label" for="basic-default-fullname">Địa chỉ</label>
                  <input type="text" class="form-control" name="address" value="<?php echo @$data['address'];?>" />
                </div>
                <div class="mb-3 col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <button type="submit" class="btn btn-primary" style="width:75px; height: 35px;">Lưu</button>
              </div>
            </div>
          </div>
        </div>

        
      </div>
    <?= $this->Form->end() ?>
</div>

  text-welcome