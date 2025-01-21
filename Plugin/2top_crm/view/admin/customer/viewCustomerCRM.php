<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/2top_crm-view-admin-customer-listCustomerCRM">Khách hàng</a> /</span>
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
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Tên khách hàng (*)</label>
                    <input required type="text" class="form-control phone-mask" disabled name="full_name" id="full_name" value="<?php echo @$data->full_name;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Hình đại diện</label>
                    <?php showUploadFile('avatar','avatar',@$data->avatar,0);?>
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Số điện thoại (*)</label>
                    <input type="text" required  disabled class="form-control" placeholder="" name="phone" id="phone" value="<?php echo @$data->phone;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Email</label>
                    <input type="email" class="form-control" disabled placeholder="" name="email" id="email" value="<?php echo @$data->email;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-email">Trạng thái</label>
                    <div class="input-group input-group-merge">
                      <select class="form-select" name="status" id="status" disabled>
                        <option value="active" <?php if(!empty($data->status) && $data->status=='active') echo 'selected'; ?> >Kích hoạt</option>
                        <option value="lock" <?php if(!empty($data->status) && $data->status=='lock') echo 'selected'; ?> >Khóa</option>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Ngày sinh</label>
                    <input type="text" disabled class="form-control datepicker" placeholder="" name="birthday" id="birthday" value="<?php if(!empty($data->birthday_date) && !empty($data->birthday_month) && !empty($data->birthday_year)) echo $data->birthday_date.'/'.$data->birthday_month.'/'.$data->birthday_year;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Địa chỉ</label>
                    <input type="text" disabled class="form-control" placeholder="" name="address" id="address" value="<?php echo @$data->address;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-email">Thành phố</label>
                    <div class="input-group input-group-merge">
                      <select class="form-select" name="id_city" id="id_city" disabled>
                        <?php 
                          $listCity = getListCity();
                          foreach ($listCity as $key => $city) {
                            if(empty($data->id_city) || $data->id_city!=$city['id']){
                              echo '<option value="'.$city['id'].'">'.$city['name'].'</option>';
                            }else{
                              echo '<option selected value="'.$city['id'].'">'.$city['name'].'</option>';
                            }
                          }
                        ?>
                      </select>
                    </div>
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-email">Giới tính</label>
                    <div class="input-group input-group-merge">
                      <select class="form-select" name="sex" id="sex" disabled>
                        <option value="1" <?php if(!empty($data->sex) && $data->sex=='1') echo 'selected'; ?> >Nam</option>
                        <option value="0" <?php if(isset($data->sex) && $data->sex=='0') echo 'selected'; ?> >Nữ</option>
                      </select>
                    </div>
                  </div>
                  
                  <!--
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">ID messenger</label>
                    <input type="text" class="form-control" disabled placeholder="" name="id_messenger" id="id_messenger" value="<?php echo @$data->id_messenger;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Người quản lý</label>
                    <input type="text" class="form-control" disabled placeholder="" name="id_parent" id="id_parent" value="<?php echo @$data->id_parent;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Hạng thành viên</label>
                    <input type="text" class="form-control" placeholder="" name="id_level" id="id_level" value="<?php echo @$data->id_level;?>" />
                  </div>
                  -->
                </div>
              </div>
          </div>
        </div>
      </div>

    </div>
</div>