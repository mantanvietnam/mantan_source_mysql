<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/ezpics_admin-view-admin-notification-addNotificationAdmin">Thông báo sản phẩm mới</a> /</span>
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
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Loại tài khoản</label>
                    <select name="type" class="form-select color-dropdown">
                      <option value="">Tất cả</option>
                      <option value="0" <?php if(!empty($_GET['type']) && $_GET['type']=='0') echo 'selected';?> >Người dùng</option>
                      <option value="1" <?php if(!empty($_GET['type']) && $_GET['type']=='1') echo 'selected';?> >Designer</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">phiên bản</label>
                    <select name="pro" class="form-select color-dropdown">
                      <option value="">Tất cả</option>
                      <option value="0" >bản Pro</option>
                      <option value="1" >bản thường</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-12">
                   <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Id người dùng</label>
                    <input  type="text" class="form-control phone-mask" name="idUser" id="idUser" value="" />
                  </div>
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