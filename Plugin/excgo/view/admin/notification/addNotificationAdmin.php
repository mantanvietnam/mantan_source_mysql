<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/ezpics_admin-view-admin-notification-addNotificationAdmin">Thông báo</a> /</span>
    Tạo thông báo
  </h4>

  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Tạo thông báo</h5>
          </div>
          <div class="card-body">
            <p><?php echo @$mess;?></p>
            <?= $this->Form->create(); ?>
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Loại tài khoản</label>
                    <select name="type" class="form-select color-dropdown">
                      <option value="">Tất cả</option>
                      <option value="0" <?php if(!empty($_GET['type']) && $_GET['type']=='0') echo 'selected';?> >Người dùng</option>
                      <option value="1" <?php if(!empty($_GET['type']) && $_GET['type']=='1') echo 'selected';?> >Tài xế</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Id người dùng</label>
                    <input  type="text" class="form-control phone-mask" name="idUser" placeholder="mỗi id cách nhau dấu phẩy (,)" id="idUser" value="" />
                  </div>
                 </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Tiêu đề (*)</label>
                    <input required type="text" class="form-control phone-mask" name="title" id="title" value="" />
                  </div>
                </div>
                <div class="col-md-6">
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