<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Từ thiện</h4>

  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Cài đặt chung</h5>
          </div>
          <div class="card-body">
            <p><?php echo $mess;?></p>
            <?= $this->Form->create(); ?>
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Logo (*)</label>
                    <?php showUploadFile('logo','logo', @$data_value['logo'],0);?>
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Ảnh nền</label>
                    <?php showUploadFile('background','background', @$data_value['background'],1);?>
                  </div>

                </div>

                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Mã màu chữ</label>
                    <input type="text" class="form-control phone-mask" name="textColor" id="textColor" value="<?php echo @$data_value['textColor'];?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Mã màu nền</label>
                    <input type="text" class="form-control phone-mask" name="backgroundColor" id="backgroundColor" value="<?php echo @$data_value['backgroundColor'];?>" />
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