<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/hethongdaily-view-admin-customer-listCustomerAdmin">Khách hàng</a> /</span>
    Thông tin khách hàng
  </h4>
  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin khách hàng</h5>
          </div>
          <div class="card-body">
            <p><?php echo $mess; ?></p>
            <form enctype="multipart/form-data" method="post" action="">
              <input type="hidden" name="_csrfToken" value="<?php echo $csrfToken;?>" />
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Họ tên (*)</label>
                    <input required type="text" class="form-control phone-mask" name="full_name" id="full_name" value="<?php echo @$data->full_name;?>" />
                  </div>
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Email</label>
                    <input type="email" class="form-control" placeholder="" name="email" id="email" value="<?php echo @$data->email;?>" />
                  </div>
                   <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Giới tính</label>
                    <select name="sex" class="form-select color-dropdown">
                      <option value="0">Nữ</option>
                      <option value="1" <?php if(!empty($data->sex) && $data->sex==1) echo 'selected';?> >Nam</option>
                    </select>
                  </div>
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Ngày sinh</label>
                    
                    <div class="row">
                      <div class="col-md-4">
                        <select name="birthday_date" class="form-select color-dropdown">
                          <option value="0">Ngày</option>
                          <?php
                          for ($i=1; $i <= 31 ; $i++) { 
                            if(!empty($data->birthday_date) && $data->birthday_date==$i){
                              echo '<option value="'.$i.'" selected>'.$i.'</option>';
                            }else{
                              echo '<option value="'.$i.'">'.$i.'</option>';
                            }
                          }
                          ?>
                        </select>
                      </div>

                      <div class="col-md-4">
                        <select name="birthday_month" class="form-select color-dropdown">
                          <option value="0">Tháng</option>
                          <?php
                          for ($i=1; $i <= 12 ; $i++) { 
                            if(!empty($data->birthday_month) && $data->birthday_month==$i){
                              echo '<option value="'.$i.'" selected>'.$i.'</option>';
                            }else{
                              echo '<option value="'.$i.'">'.$i.'</option>';
                            }
                          }
                          ?>
                        </select>
                      </div>

                      <div class="col-md-4">
                        <select name="birthday_year" class="form-select color-dropdown">
                          <option value="0">Năm</option>
                          <?php
                          for ($i=1950; $i <= 2024 ; $i++) { 
                            if(!empty($data->birthday_year) && $data->birthday_year==$i){
                              echo '<option value="'.$i.'" selected>'.$i.'</option>';
                            }else{
                              echo '<option value="'.$i.'">'.$i.'</option>';
                            }
                          }
                          ?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Số lượng bản xuất tối đa</label>
                    <input type="number" class="form-control phone-mask" name="max_export_mmtc" id="max_export_mmtc" value="<?php echo @$data->max_export_mmtc;?>" />
                  </div>
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Mật khẩu</label>
                    <input type="text" class="form-control" placeholder="" name="password" id="password" value="" />
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Số điện thoại (*)</label>
                    <input type="text" <?php if(!empty($data->phone)){ echo 'disabled'; }else{ echo 'required'; }?> class="form-control" placeholder="" name="phone" id="phone" value="<?php echo @$data->phone;?>" />
                  </div>
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Địa chỉ</label>
                    <input type="text" class="form-control phone-mask" name="address" id="name" value="<?php echo @$data->address;?>" />
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Trạng thái</label>
                    <div class="input-group input-group-merge">
                      <select class="form-select" name="status" id="status">
                        <option value="active" <?php if(!empty($data->status) && $data->status=='active') echo 'selected'; ?> >Kích hoạt</option>
                        <option value="lock" <?php if(!empty($data->status) && $data->status=='lock') echo 'selected'; ?> >Khóa</option>
                      </select>
                    </div>
                  </div>
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Facebook</label>
                    <input type="text" class="form-control phone-mask" name="facebook" id="facebook" value="<?php echo @$data->facebook;?>" />
                  </div>
                   <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Hình đại diện</label>
                    <?php
                     showUploadFile('avatar','avatar',@$data->avatar,2);
                    if(!empty($data->avatar)){
                      echo '<br/><img src="'.$data->avatar.'" width="80" />';
                    }
                    ?>
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