<?php include(__DIR__.'/../header.php'); ?>

<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/listMember">Hệ thống tuyến dưới</a> /</span>
    Thông tin tuyến dưới
  </h4>
  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin tuyến dưới</h5>
          </div>
          <div class="card-body">
            <p><?php echo $mess;?></p>
            <form enctype="multipart/form-data" method="post" action="">
              <input type="hidden" name="_csrfToken" value="<?php echo $csrfToken;?>" />
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Họ tên (*)</label>
                    <input required type="text" class="form-control phone-mask" name="name" id="name" value="<?php echo @$data->name;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Số điện thoại (*)</label>
                    <input type="text" required  class="form-control" placeholder="" name="phone" id="phone" value="<?php echo @$data->phone;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Chức danh (*)</label>
                    <select name="id_position" class="form-select color-dropdown" required>
                      <option value="">Chọn chức danh</option>
                      <?php 
                      if(!empty($listPositions)){
                        foreach ($listPositions as $key => $value) {
                          if(empty($data->id_position) || $data->id_position!=$value->id){
                            echo '<option value="'.$value->id.'" >'.$value->name.'</option>';
                          }else{
                            echo '<option selected value="'.$value->id.'" >'.$value->name.'</option>';
                          }
                        }
                      }
                      ?>
                    </select>
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Hình đại diện</label>
                    <input type="file" class="form-control phone-mask" name="avatar" id="avatar" value=""/>
                    <?php
                    if(!empty($data->avatar)){
                      echo '<br/><img src="'.$data->avatar.'" width="80" />';
                    }
                    ?>
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Ngày sinh</label>
                    <input autocomplete="off" type="text" class="form-control datepicker" name="birthday" id="name" value="<?php echo @$data->birthday;?>" />
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
                  <!--
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Mật khẩu tài khoản</label>
                    <input type="password" autocomplete="off" class="form-control" placeholder="" name="password" id="password" value="" />
                  </div>
                  -->

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Email</label>
                    <input autocomplete="off" type="text" class="form-control" placeholder="" name="email" id="email" value="<?php echo @$data->email;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Địa chỉ</label>
                    <input type="text" class="form-control phone-mask" name="address" id="name" value="<?php echo @$data->address;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Ảnh chân dung xóa nền</label>
                    <input type="file" class="form-control phone-mask" name="portrait" id="portrait" value=""/>
                    <?php
                    if(!empty($data->portrait)){
                      echo '<br/><img src="'.$data->portrait.'" width="80" />';
                    }
                    ?>
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Quyền tạo dữ liệu đại lý cấp dưới</label>
                    <select name="create_agency" class="form-select color-dropdown">
                      <option value="active">Được tạo</option>
                      <option value="lock" <?php if(!empty($data->create_agency) && $data->create_agency=='lock') echo 'selected';?> >Không được tạo</option>
                    </select>
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
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Số điện thoại của Đạt lý gới thiệu </label>
                    <input type="text" class="form-control phone-mask" name="phone_agency" id="phone_agency" value="<?php echo @$data->phone_agency;?>" />
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
            </form>
          </div>
        </div>
      </div>

    </div>
</div>

<?php include(__DIR__.'/../footer.php'); ?>