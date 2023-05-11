<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/ezpics_admin-view-admin-notification-addNotificationAdmin.php">Thông báo sản phẩm mới</a> /</span>
    Tạo thông báo
  </h4>

  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Tạo thông báo sản phẩm mới</h5>
          </div>
          <div class="card-body">
            <p><?php echo @$mess;?></p>
            <?= $this->Form->create(); ?>
              <div class="row">
                <div class="col-md-12">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Tiêu đề (*)</label>
                    <input required type="text" class="form-control phone-mask" name="title" id="title" value="" />
                  </div>
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Id sản phẩm (*)</label>
                    <input required type="text" class="form-control phone-mask" name="id" id="id" value="" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Nội dung thông báo (*)</label>
                    <textarea required class="form-control phone-mask" name="mess" id="mess"></textarea>
                  </div>
                </div>
              </div>
              <button type="submit" class="btn btn-primary">Gửi thông báo</button>
            <?= $this->Form->end() ?>
          </div>
        </div>
      </div>

    </div>
</div>