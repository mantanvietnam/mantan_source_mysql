<?php include(__DIR__.'/../header.php'); ?>
<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/listAffiliaterAgency">Tiếp thị liên kết</a> /</span>
    Thông tin người tiếp thị
  </h4>

  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin người tiếp thị</h5>
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
                        <option value="">Chọn hệ thống</option>
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
                    <label class="form-label" for="basic-default-phone">Họ tên (*)</label>
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
                    <label class="form-label" for="basic-default-fullname">Ảnh chân dung nhân hiệu</label>
                    <?php showUploadFile('portrait','portrait',@$data->portrait,1);?>
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Trang Linkedin</label>
                    <input type="text" class="form-control phone-mask" name="linkedin" id="linkedin" value="<?php echo @$data->linkedin;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Trang Website</label>
                    <input type="text" class="form-control phone-mask" name="web" id="web" value="<?php echo @$data->web;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Trang Instagram</label>
                    <input type="text" class="form-control phone-mask" name="instagram" id="instagram" value="<?php echo @$data->instagram;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Trang Zalo</label>
                    <input type="text" class="form-control phone-mask" name="zalo" id="zalo" value="<?php echo @$data->zalo;?>" />
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Mật khẩu tài khoản</label>
                    <input type="password" autocomplete="off" class="form-control" placeholder="" name="password" id="password" value="" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">điện thoại người giới thiệu</label>
                    <input type="text" class="form-control" placeholder="" name="phone_father" id="phone_father" value="<?php echo  @$data->phone_father;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Email</label>
                    <input type="email" class="form-control" placeholder="" name="email" id="email" value="<?php echo @$data->email;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Địa chỉ</label>
                    <input type="text" class="form-control phone-mask" name="address" id="name" value="<?php echo @$data->address;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Trang Facebook</label>
                    <input type="text" class="form-control phone-mask" name="facebook" id="facebook" value="<?php echo @$data->facebook;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Trang Twitter</label>
                    <input type="text" class="form-control phone-mask" name="twitter" id="twitter" value="<?php echo @$data->twitter;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Kênh Tiktok</label>
                    <input type="text" class="form-control phone-mask" name="tiktok" id="tiktok" value="<?php echo @$data->tiktok;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Kênh Youtube</label>
                    <input type="text" class="form-control phone-mask" name="youtube" id="youtube" value="<?php echo @$data->youtube;?>" />
                  </div>

                </div>

                <div class="col-md-12">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Giới thiệu bản thân</label>
                    <?php showEditorInput('description', 'description', @$data->description);?>
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
<?php include(__DIR__.'/../footer.php'); ?>