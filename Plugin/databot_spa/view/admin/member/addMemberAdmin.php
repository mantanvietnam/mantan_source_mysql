<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/databot_spa-view-admin-member-listMemberAdmin.php">Người dùng</a> /</span>
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
                    <input type="text"  <?php if(!empty($_GET['id'])) echo 'disabled=""'; ?> class="form-control" placeholder="" name="phone" id="phone" value="<?php echo @$data->phone; ?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Email</label>
                    <input type="email" class="form-control" placeholder="" name="email" id="email" value="<?php echo @$data->email;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-email">Loại tài khoản</label>
                    <div class="input-group input-group-merge">
                      <select class="form-select" name="type" id="type" disabled>
                        <option value="1" <?php if(!empty($data->type) && $data->type=='1') echo 'selected'; ?> >Chủ Spa</option>
                        <option value="0" <?php if(isset($data->type) && $data->type=='0') echo 'selected'; ?> >Nhân viên</option>
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
                    <label class="form-label" for="basic-default-fullname">Ngày hết hạn</label>
                    <input  type="datetime-local" class="form-control" placeholder="" name="dateline_at" id="dateline_at" value="<?php echo date('Y-m-d H:i:s', strtotime(@$data->dateline_at));?>" />
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
                    <label for="" class="form-label">Số cơ sở</label>
                    <input type="number"  class="form-control" id="number_spa" name="number_spa" value="<?php echo @$data->number_spa;?>" placeholder=""  />
                  </div>
                </div>
                
                <label for="" class="form-label">Module chức năng được sử dụng</label>
                <div class="col-md-3 mb-3">
                  <input type="checkbox" name="module[]" value="customer" <?php if(!empty($data->module) && in_array('customer', $data->module)) echo 'checked';?> > Khách hàng
                </div>

                <div class="col-md-3 mb-3">
                  <input type="checkbox" name="module[]" value="calendar" <?php if(!empty($data->module) && in_array('calendar', $data->module)) echo 'checked';?> > Đặt lịch hẹn
                </div>

                <div class="col-md-3 mb-3">
                  <input type="checkbox" name="module[]" value="zalo" <?php if(!empty($data->module) && in_array('zalo', $data->module)) echo 'checked';?> > Kết nối Zalo
                </div>

                <div class="col-md-3 mb-3">
                  <input type="checkbox" name="module[]" value="room" <?php if(!empty($data->module) && in_array('room', $data->module)) echo 'checked';?> > Phòng - Giường
                </div>

                <div class="col-md-3 mb-3">
                  <input type="checkbox" name="module[]" value="product" <?php if(!empty($data->module) && in_array('product', $data->module)) echo 'checked';?> > Sản phẩm - Dịch vụ
                </div>

                <div class="col-md-3 mb-3">
                  <input type="checkbox" name="module[]" value="prepaid_cards" <?php if(!empty($data->module) && in_array('prepaid_cards', $data->module)) echo 'checked';?> > Thẻ trả trước
                </div>
                
                <div class="col-md-3 mb-3">
                  <input type="checkbox" name="module[]" value="combo" <?php if(!empty($data->module) && in_array('combo', $data->module)) echo 'checked';?> > Combo liệu trình
                </div>

                <div class="col-md-3 mb-3">
                  <input type="checkbox" name="module[]" value="static" <?php if(!empty($data->module) && in_array('static', $data->module)) echo 'checked';?> > Báo cáo - Thống kê
                </div>

              </div>



              <button type="submit" class="btn btn-primary">Lưu</button>
            <?= $this->Form->end() ?>
          </div>
        </div>
      </div>

    </div>
</div>