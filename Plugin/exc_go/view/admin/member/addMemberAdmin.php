<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/zoomcheap-view-admin-zoom-listAccountZoomAdmin.php">Thành viên</a> /</span>
    Thông tin thành viên
  </h4>
  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin thành viên</h5>
          </div>
          <div class="card-body">
            <p><?php echo $mess;?></p>
            <?= $this->Form->create(); ?>
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Tài khoản (*)</label>
                    <input required type="text" class="form-control phone-mask" name="name" id="name" value="<?php echo @$data->name;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Password (*)</label>
                    <input required type="text" class="form-control phone-mask" name="password" id="password" value="<?php echo @$data->password;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Số điện thoại (*)</label>
                    <input required type="text" class="form-control phone-mask" name="phone" id="phone" value="<?php echo @$data->phone;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Email (*)</label>
                    <input required type="text" class="form-control phone-mask" name="email" id="email" value="<?php echo @$data->email;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Địa chỉ</label>
                    <input type="text" class="form-control datepicker" name="address" id="address" value="<?php echo @$data->address;?>" />
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Trạng thái</label>
                    <div class="input-group input-group-merge">
                      <select class="form-select" name="status" id="status">
                        <option value="1" <?php if(!empty($data->status) && $data->status=='1') echo 'selected'; ?> >Kích hoạt</option>
                        <option value="0" <?php if(!empty($data->status) && $data->status=='0') echo 'selected'; ?> >Khóa</option>
                      </select>
                    </div>
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Hình ảnh (*)</label>
                    <?php showUploadFile('avatar','avatar',@$data->avatar,0);?>
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Loại tài khoản</label>
                    <div class="input-group input-group-merge">
                      <select class="form-select" name="type" id="type">
                        <option value="0" <?php if(!empty($data->type) && $data->type=='0') echo 'selected'; ?> >Người dùng</option>
                        <option value="1" <?php if(!empty($data->type) && $data->type=='1') echo 'selected'; ?> >Tài xế</option>
                      </select>
                    </div>
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