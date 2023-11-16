<?php include(__DIR__.'/../header.php'); ?>

<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/listCustomer">Khách hàng</a> /</span>
    Thông tin khách hàng
  </h4>

  <!-- Basic Layout -->
  <?= $this->Form->create(); ?>
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin khách hàng</h5>
          </div>
          <div class="card-body">
              <p><?php echo $mess;?></p>
            <button type="submit" style=" width: 70px; " class="btn btn-primary">Lưu</button>
              <div class="row">

                  <div class="mb-3 col-md-6">
                    <label class="form-label" for="basic-default-phone">Tên khách hàng (*)</label>
                    <input required type="text" class="form-control phone-mask" name="name" id="name" value="<?php echo @$data->name;?>" />
                  </div>
                  <div class="mb-3 col-md-6">
                    <label class="form-label" for="basic-default-fullname">Số điện thoại (*)</label>
                    <input type="text" required class="form-control" placeholder="" name="phone" id="phone" value="<?php echo @$data->phone;?>" />
                  </div>
                  <div class="mb-3 col-md-6">
                    <label class="form-label" for="basic-default-fullname">Email</label>
                    <input type="email" class="form-control" placeholder="" name="email" id="email" value="<?php echo @$data->email;?>" />
                  </div>

                  <div class="mb-3 col-md-6">
                    <label class="form-label" for="basic-default-fullname">Địa chỉ</label>
                    <input type="text" class="form-control" placeholder="" name="address" id="address" value="<?php echo @$data->address;?>" />
                  </div>
                  <div class="mb-3 col-md-6">
                    <label class="form-label" for="basic-default-fullname">Hình đại diện</label>
                    <?php showUploadFile('avatar','avatar',@$data->avatar,0);?>
                  </div>

                  <div class="mb-3 col-md-6">
                    <label class="form-label" for="basic-default-phone">Số CMT</label>
                    <input  type="number" class="form-control phone-mask" name="cmnd" id="cmnd" value="<?php echo @$data->cmnd;?>" />
                  </div>

                  

                  <div class="mb-3 col-md-6">
                    <label class="form-label" for="basic-default-email">Giới tính</label>
                    <div class="input-group input-group-merge">
                      <select class="form-select" name="sex" id="sex">                        
                        <option value="0" <?php if(isset($data->sex) && $data->sex=='0') echo 'selected'; ?> >Nữ</option>
                        <option value="1" <?php if(!empty($data->sex) && $data->sex=='1') echo 'selected'; ?> >Nam</option>                        
                      </select>
                    </div>
                  </div>
                  <div class="mb-3 col-md-6">
                    <label class="form-label" for="basic-default-fullname">Ngày sinh</label>
                    <input type="text"  class="form-control hasDatepicker datepicker" placeholder="" name="birthday" id="birthday" value="<?php echo @$data->birthday;?>" />
                  </div>
                  <div class="mb-3 col-md-6">
                    <label class="form-label" for="basic-default-email">Nhân viên phụ trách</label>
                    <div class="input-group input-group-merge">
                      <select class="form-select" name="id_staff" id="id_staff">
                        <?php foreach($dataMember as $key => $item){ ?>
                        <option value="<?php echo $item->id ?>" <?php if(isset($data->id_staff) && $data->id_staff==$item->id ) echo 'selected'; ?> ><?php echo $item->name ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="mb-3 col-md-6">
                    <label class="form-label" for="basic-default-email">Nhóm khách hàng </label>
                    <div class="input-group input-group-merge">
                      <select class="form-select" name="id_group" id="id_group">
                        <option value="0">Chọn nhóm khách hàng</option>
                        <?php foreach($dataGroup as $key => $item){ ?>
                          <option value="<?php echo $item->id ?>" <?php if(isset($data->id_group) && $data->id_group==$item->id ) echo 'selected'; ?> ><?php echo $item->name ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>

                  <div class="mb-3 col-md-6">
                    <label class="form-label" for="basic-default-fullname">Mã người giới thiệu</label>
                    <input type="text" <?php if(!empty($_GET['id']) && !empty($data->referral_code)) echo 'disabled';?>  class="form-control" placeholder="" name="referral_code" id="referral_code" value="<?php echo @$data->referral_code;?>" />
                  </div>

                  <div class="mb-3 col-md-6">
                    <label class="form-label" for="basic-default-fullname">Link facebook</label>
                    <input type="text" class="form-control" placeholder="" name="link_facebook" id="link_facebook" value="<?php echo @$data->link_facebook;?>" />
                  </div>

                  <div class="mb-3 col-md-6">
                    <label class="form-label" for="basic-default-fullname">Nghề nghiệp</label>
                    <input type="text" class="form-control" placeholder="" name="job" id="job" value="<?php echo @$data->job;?>" />
                  </div>

                  <div class="mb-3 col-md-6">
                    <label class="form-label" for="basic-default-email">Nguồn khách hàng </label>
                    <div class="input-group input-group-merge">
                      <select class="form-select" name="source" id="source">
                        <option value="0">Chọn nguồn khách hàng</option>
                        <?php foreach($dataSource as $key => $item){ ?>
                          <option value="<?php echo $item->id ?>" <?php if(isset($data->source) && $data->source==$item->id ) echo 'selected'; ?> ><?php echo $item->name ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="mb-3 col-md-6">
                    <label class="form-label" for="basic-default-email">Chi nhánh</label>
                    <div class="input-group input-group-merge">
                      <select class="form-select" name="id_spa" id="id_spa">
                        <?php foreach($dataSpa as $key => $item){ ?>
                        <option value="<?php echo $item->id ?>" <?php if(isset($data->id_spa) && $data->id_spa== $item->id) echo 'selected'; ?> ><?php echo $item->name ?></option>
                      <?php } ?>
                      </select>
                    </div>
                  </div>

                  <div class="mb-3 col-md-6">
                    <label class="form-label" for="basic-default-fullname">Ngày tạo tài khoản</label>
                    <input type="text" disabled  class="form-control" placeholder="" name="created_at" id="created_at" value="<?php echo @$data->created_at;?>" />
                  </div>
                </div>
          </div>

          <hr/>
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin bệnh lý</h5>
          </div>
          <div class="card-body">
            <div class="row">
                <div class="mb-3 col-md-6">
                  <label class="form-label" for="basic-default-fullname">Tiền sử bệnh lý đang mắc</label>
                  <input type="text" class="form-control" placeholder="" name="medical_history" id="medical_history" value="<?php echo @$data->medical_history;?>" />
                </div>
                <div class="mb-3 col-md-6">
                  <label class="form-label" for="basic-default-fullname">Nhu cầu hiện tại</label>
                  <input type="text" class="form-control" placeholder="" name="request_current" id="request_current" value="<?php echo @$data->request_current;?>" />
                </div>
                <div class="mb-3 col-md-6">
                  <label class="form-label" for="basic-default-fullname">Khả năng tư vấn hướng tới</label>
                  <input type="text" class="form-control" placeholder="" name="advise_towards" id="advise_towards" value="<?php echo @$data->advise_towards;?>" />
                </div>

                <div class="mb-3 col-md-6">
                  <label class="form-label" for="basic-default-fullname">Dịch vụ quan tâm</label>
                  <select class="form-select" name="id_service" id="id_service">
                    <option value="0">Chọn dịch vụ quan tâm</option>
                    <?php foreach($dataService as $key => $item){ ?>
                      <option value="<?php echo $item->id ?>" <?php if(isset($data->id_service) && $data->id_service== $item->id) echo 'selected'; ?> ><?php echo $item->name ?></option>
                    <?php } ?>
                  </select>
                </div>

                <div class="mb-3 col-md-6">
                  <label class="form-label" for="basic-default-fullname">Sản phẩm quan tâm</label>
                  <select class="form-select" name="id_product" id="id_product">
                    <option value="0">Chọn sản phẩm quan tâm</option>
                    <?php foreach($dataProduct as $key => $item){ ?>
                      <option value="<?php echo $item->id ?>" <?php if(isset($data->id_product) && $data->id_product== $item->id) echo 'selected'; ?> ><?php echo $item->name ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="mb-3 col-md-6">
                    <label class="form-label" for="basic-default-fullname">Tiền sử mang thai/ dị ứng thuốc</label>
                    <input type="text" class="form-control" placeholder="" name="drug_allergy_history" id="drug_allergy_history" value="<?php echo @$data->drug_allergy_history;?>" />
                </div>
                <div class="mb-3 col-md-6">
                  <label class="form-label" for="basic-default-fullname">Khả năng tư vấn hướng dẫn</label>
                  <input type="text" class="form-control" placeholder="" name="advisory" id="advisory" value="<?php echo @$data->advisory;?>" />
                </div>

                <div class="mb-3 col-md-6">
                  <label class="form-label" for="basic-default-fullname">Thông tin thêm</label>
                  <textarea placeholder="Sở thích, thói quen, yêu thích, ghét, mối quan hệ ...." class="form-control" rows="5" name="note"><?php echo @$data->note;?></textarea>
                </div>
                
              <button type="submit" style=" width: 70px; " class="btn btn-primary">Lưu</button>
            </div>
          </div>
        </div>
      </div>

    </div>
  <?= $this->Form->end() ?>
</div>

<?php include(__DIR__.'/../footer.php'); ?>