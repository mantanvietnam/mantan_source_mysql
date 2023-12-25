<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/zalo_zns-view-admin-listZaloOAAdmin">Quản lý Zalo OA</a> /</span>
    Thông tin Zalo OA
  </h4>

  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin Zalo OA</h5>
          </div>
          <div class="card-body">
            <p><?php echo $mess;?></p>
            <?= $this->Form->create(); ?>
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">ID OA (*)</label>
                    <input required type="text" class="form-control phone-mask" name="id_oa" id="id_oa" value="<?php echo @$data->id_oa;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">ID APP (*)</label>
                    <input required type="text" class="form-control phone-mask" name="id_app" id="id_app" value="<?php echo @$data->id_app;?>" />
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Mã bảo mật ứng dụng</label>
                    <textarea rows="5" name="secret_key" class="form-control phone-mask"><?php echo @$data->secret_key;?></textarea>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Access token</label>
                    <textarea disabled rows="5" name="access_token" class="form-control phone-mask"><?php echo @$data->access_token;?></textarea>
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