<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/matmathanhcong-view-admin-settingMMTCAPI">Mật mã thành công</a> /</span>
    Cài đặt
  </h4>

  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Cài đặt API</h5>
          </div>
          <div class="card-body">
            <p><?php echo $mess;?></p>
            <?= $this->Form->create(); ?>
              <div class="row">
                <div class="col-md-6">
                  
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Tài khoản API (*)</label>
                    <input required type="text" class="form-control phone-mask" name="userAPI" id="userAPI" value="<?php echo @$data['userAPI'];?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Mật khẩu API (*)</label>
                    <input required type="text" class="form-control phone-mask" name="passAPI" id="passAPI" value="<?php echo @$data['passAPI'];?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Giá mua bản đầy đủ</label>
                    <input type="text" class="form-control phone-mask" name="price" id="price" value="<?php echo @$data['price'];?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Ghi chú khi thanh toán</label>
                    <input type="text" class="form-control phone-mask" name="note_pay" id="note_pay" value="<?php echo @$data['note_pay'];?>" />
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