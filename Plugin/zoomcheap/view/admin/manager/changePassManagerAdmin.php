<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/zoomcheap-view-admin-manager-listManagerAdmin">Khách hàng</a> /</span>
    Đổi mật khẩu
  </h4>

  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <!-- <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">
            </h5>
          </div> -->
          <div class="card-body">
            <p><?php echo @$mess;?></p>
            <?= $this->Form->create(); ?>
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Mật khẩu mới (*)</label>
                    <input required type="text" class="form-control phone-mask" name="pass" id="pass" value="" />
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