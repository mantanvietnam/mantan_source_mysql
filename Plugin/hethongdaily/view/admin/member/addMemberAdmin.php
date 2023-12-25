<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/hethongdaily-view-admin-member-listMemberAdmin">Hệ thống</a> /</span>
    Thông tin đại lý hệ thống
  </h4>

  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin đại lý</h5>
          </div>
          <div class="card-body">
            <p><?php echo $mess;?></p>
            <?= $this->Form->create(); ?>
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-email">Hệ thống (*)</label>
                    <div class="input-group input-group-merge">
                      <select name="id_system" class="form-select" required>
                        <option value="">Tất cả</option>
                        <?php 
                        if(!empty($listSystem)){
                          foreach ($listSystem as $key => $value) {
                            if(empty($data->id_system) || $data->id_system!=$value->id){
                              echo '<option value="'.$value->id.'" >'.$value->name.'</option>';
                            }else{
                              echo '<option selected value="'.$value->id.'" >'.$value->name.'</option>';
                            }
                          }
                        }
                        ?>
                      </select>
                    </div>
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Tên đại lý (*)</label>
                    <input required type="text" class="form-control phone-mask" name="name" id="name" value="<?php echo @$data->name;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Số điện thoại (*)</label>
                    <input type="text" required  class="form-control" placeholder="" name="phone" id="phone" value="<?php echo @$data->phone;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Hình đại diện</label>
                    <?php showUploadFile('avatar','avatar',@$data->avatar,0);?>
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Địa chỉ</label>
                    <input type="text" class="form-control phone-mask" name="address" id="name" value="<?php echo @$data->address;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Trang Facebook</label>
                    <input type="text" class="form-control phone-mask" name="facebook" id="facebook" value="<?php echo @$data->facebook;?>" />
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Mật khẩu tài khoản</label>
                    <input type="password" autocomplete="off" class="form-control" placeholder="" name="password" id="password" value="" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">ID đại lý tuyến trên</label>
                    <input type="text" class="form-control" placeholder="" name="id_father" id="id_father" value="<?php echo (int) @$data->id_father;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Email</label>
                    <input type="email" class="form-control" placeholder="" name="email" id="email" value="<?php echo @$data->email;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Ngày sinh</label>
                    <input autocomplete="off" type="text" class="form-control datepicker" name="birthday" id="name" value="<?php echo @$data->birthday;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-email">Trạng thái</label>
                    <div class="input-group input-group-merge">
                      <select class="form-select" name="status" id="status">
                        <option value="active" <?php if(!empty($data->status) && $data->status=='active') echo 'selected'; ?> >Kích hoạt</option>
                        <option value="lock" <?php if(isset($data->status) && $data->status=='lock') echo 'selected'; ?> >Khóa</option>
                      </select>
                    </div>
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-email">Xác thực OTP</label>
                    <div class="input-group input-group-merge">
                      <select class="form-select" name="verify" id="verify">
                        <option value="lock" <?php if(isset($data->verify) && $data->verify=='lock') echo 'selected'; ?> >Chưa xác thực</option>
                        <option value="active" <?php if(!empty($data->verify) && $data->verify=='active') echo 'selected'; ?> >Đã xác thực</option>
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