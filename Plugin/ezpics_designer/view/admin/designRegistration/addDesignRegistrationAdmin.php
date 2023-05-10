<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/ezpics_designer-view-admin-designRegistration-listDesignRegistrationAdmin.php">Đăng ký design</a> /</span>
    Thông tin đăng ký design
  </h4>

  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin đăng ký design</h5>
          </div>
          <div class="card-body">
            <p><?php echo $mess;?></p>
            <?= $this->Form->create(); ?>
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Tên khách hàng (*)</label>
                    <input required type="text" class="form-control phone-mask" name="name" id="name" value="<?php echo @$data->name;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Hình đại diện</label>
                    <?php showUploadFile('avatar','avatar',@$data->avatar,0);?>
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Số điện thoại (*)</label>
                    <input type="text" required class="form-control" placeholder="" name="phone" <?php if(!empty($_GET['id'])){ echo "disabled"; } ?> id="phone" value="<?php echo @$data->phone;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Email</label>
                    <input type="email" class="form-control" placeholder="" name="email" id="email" value="<?php echo @$data->email;?>" />
                  </div>

                   <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Mật khuẩn</label>
                    <input type="password" class="form-control" placeholder="" name="pass" id="pass" value="" />
                  </div>

                  
                </div>

                <div class="col-md-6">

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-email">Trạng thái</label>
                    <div class="input-group input-group-merge">
                      <select class="form-select" name="status" id="status">
                        <option value="1" <?php if(@$data->status==1){ echo 'selected'; } ?> >Kích hoạt</option>
                        <option value="0" <?php if(@$data->status==0){ echo 'selected'; } ?> >Khóa</option>
                      </select>
                    </div>
                  </div>
                  

                  

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">ID messenger</label>
                    <input type="text" class="form-control" placeholder="" name="id_facebook" id="id_facebook" value="<?php echo @$data->id_facebook;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">ID google</label>
                    <input type="text" class="form-control" placeholder="" name="id_google" id="id_parent" value="<?php echo @$data->id_google;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">ID apple</label>
                    <input type="text" class="form-control" placeholder="" name="id_apple" id="id_apple" value="<?php echo @$data->id_apple;?>" />
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