<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/ezpics_admin-view-admin-member-listMemberAdmin.php">Người dùng</a> /</span>
    Thông tin người dùng
  </h4>

  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin người dùng</h5>
          </div>
          <div class="card-body">
            <p><?php echo $mess;?></p>
            <?= $this->Form->create(); ?>
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Tên người dùng (*)</label>
                    <input required type="text" class="form-control phone-mask" name="name" id="name" value="<?php echo @$data->name;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Hình đại diện</label>
                    <?php showUploadFile('avatar','avatar',@$data->avatar,0);?>
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Số điện thoại (*)</label>
                    <input type="text" disabled class="form-control" placeholder="" name="phone" id="phone" value="<?php echo @$data->phone;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Email</label>
                    <input type="email" class="form-control" placeholder="" name="email" id="email" value="<?php echo @$data->email;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-email">Loại tài khoản</label>
                    <div class="input-group input-group-merge">
                      <select class="form-select" name="type" id="type">
                        <option value="0" <?php if(isset($data->type) && $data->type=='0') echo 'selected'; ?> >Người dùng thường</option>
                        <option value="1" <?php if(!empty($data->type) && $data->type=='1') echo 'selected'; ?> >Designer</option>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Mật khẩu tài khoản</label>
                    <input type="password" autocomplete="off" class="form-control" placeholder="" name="password" id="password" value="" />
                  </div>

                  <div class="mb-3">
                    <div class="row">
                      <div class="col-md-6">
                        <label class="form-label" for="basic-default-fullname">Số dư tài khoản</label>
                        <input disabled type="text" class="form-control" placeholder="" name="account_balance" id="account_balance" value="<?php echo number_format((int) @$data->account_balance);?>" />
                      </div>
                      <div class="col-md-6">
                        <label class="form-label" for="basic-default-fullname">Hoa hồng designer </label>
                        <input type="number" class="form-control" placeholder="" name="commission" id="commission" value="<?php echo (int) @$data->commission;?>" />
                      </div>
                    </div>
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">ID người giới thiệu</label>
                    <input type="text" class="form-control" placeholder="" name="affsource" id="affsource" value="<?php echo @$data->affsource;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-email">Trạng thái</label>
                    <div class="input-group input-group-merge">
                      <select class="form-select" name="status" id="status">
                        <option value="1" <?php if(!empty($data->status) && $data->status=='1') echo 'selected'; ?> >Kích hoạt</option>
                        <option value="0" <?php if(isset($data->status) && $data->status=='0') echo 'selected'; ?> >Khóa</option>
                      </select>
                    </div>
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-email">Chính sách huy hiệu</label>
                    <div class="input-group input-group-merge">
                      <select class="form-select" name="level" id="level">
                        <option value="">Chọn huy hiệu</option>
                        <?php
                                    foreach (levelmembers() as $level) {
                                        if( @$data['level']!=$level['id']){
                                            echo '<option value="' . $level['id'] . '">' . $level['name'] . '</option>';
                                        }else{
                                            echo '<option selected value="' . $level['id'] . '">' . $level['name'] . '</option>';
                                        }
                                        
                                    } ?>
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