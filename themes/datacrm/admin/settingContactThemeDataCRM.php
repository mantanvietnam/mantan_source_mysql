<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Data CRM Theme - Cài đặt trang Liên Hệ</h4>

    <!-- Basic Layout -->
    <p><?php echo @$mess;?></p>
    <?= $this->Form->create(); ?>
      <div class="row">
        <div class="col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Khối Liên Hệ</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Email</label>
                  <input type="text" class="form-control" name="contact_email" value="<?php echo @$setting['contact_email'];?>" />
                </div>
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Hotline</label>
                  <input type="text" class="form-control" name="contact_phone" value="<?php echo @$setting['contact_phone'];?>" />
                </div>
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Địa chỉ</label>
                  <input type="text" class="form-control" name="contact_address" value="<?php echo @$setting['contact_address'];?>" />
                </div>
                <button type="submit" class="btn btn-primary">Lưu</button>
            </div>
          </div>
        </div>
      </div>
</div>