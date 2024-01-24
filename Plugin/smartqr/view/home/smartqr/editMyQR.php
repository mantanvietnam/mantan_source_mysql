<?php include(__DIR__.'/../header.php'); ?>

<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/mySmartQR">Mã QR</a> /</span>
    Thông tin mã QR
  </h4>

  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin mã QR</h5>
          </div>
          <div class="card-body">
            <p><?php echo $mess;?></p>
            <?= $this->Form->create(); ?>
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Tên mã QR (*)</label>
                    <input required type="text" class="form-control phone-mask" name="title" id="title" value="<?php echo @$data->title;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Mã định danh QR (*)</label>
                    <input disabled type="text" class="form-control phone-mask" name="code" id="code" value="<?php echo @$data->code;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-email">Kiểu liên kết (*)</label>
                    <div class="input-group input-group-merge">
                      <select class="form-select" name="type" id="type" required>
                        <option value="website" <?php if(!empty($data->type) && $data->type=='website') echo 'selected'; ?> >Website</option>
                        <option value="facebook" <?php if(!empty($data->type) && $data->type=='facebook') echo 'selected'; ?> >Facebook</option>
                      </select>
                    </div>
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-email">Trạng thái</label>
                    <div class="input-group input-group-merge">
                      <select class="form-select" name="status" id="status">
                        <option value="active" <?php if(!empty($data->status) && $data->status=='active') echo 'selected'; ?> >Kích hoạt</option>
                        <option value="lock" <?php if(!empty($data->status) && $data->status=='lock') echo 'selected'; ?> >Khóa</option>
                      </select>
                    </div>
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Mã màu QR</label>
                    <input type="text" class="form-control phone-mask" name="color_foreground" id="color_foreground" value="<?php if(!empty($data->color_foreground)){ echo $data->color_foreground;}else{ echo '0,0,0';}?>" />
                  </div> 
                </div>

                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Link website (*)</label>
                    <input required type="text" class="form-control phone-mask" name="link_web" id="link_web" value="<?php echo @$data->link_web;?>" />
                  </div> 

                  <div class="mb-3">
                    <label class="form-label">Link ios (*)</label>
                    <input required type="text" class="form-control phone-mask" name="link_ios" id="link_ios" value="<?php echo @$data->link_ios;?>" />
                  </div> 

                  <div class="mb-3">
                    <label class="form-label">Link android (*)</label>
                    <input required type="text" class="form-control phone-mask" name="link_android" id="link_android" value="<?php echo @$data->link_android;?>" />
                  </div> 

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Logo</label>
                    <?php showUploadFile('logo','logo',@$data->logo,0);?>
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Mã màu nền</label>
                    <input type="text" class="form-control phone-mask" name="color_background" id="color_background" value="<?php if(!empty($data->color_background)){ echo $data->color_background;}else{ echo '255,255,255';}?>" />
                  </div> 
                </div>
                
              </div>

              <button type="submit" class="btn btn-primary">Lưu</button>
            <?= $this->Form->end() ?>
          </div>
        </div>
      </div>

    </div>
</div>

<?php include(__DIR__.'/../footer.php'); ?>