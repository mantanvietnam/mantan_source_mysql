<?php include(__DIR__.'/../header.php'); ?>

<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/listCustomer">Khách hàng</a> /</span>
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
            <p><?php echo $mess;?></p>
            <?= $this->Form->create(); ?>
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Tên khách hàng (*)</label>
                    <input required type="text" class="form-control phone-mask" name="name" id="name" value="<?php echo @$data->name;?>" />
                  </div>
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Số CMT</label>
                    <input  type="number" class="form-control phone-mask" name="cmnd" id="cmnd" value="<?php echo @$data->cmnd;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Hình đại diện</label>
                    <?php showUploadFile('avatar','avatar',@$data->avatar,0);?>
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-email">Giới tính</label>
                    <div class="input-group input-group-merge">
                      <select class="form-select" name="sex" id="sex">                        
                        <option value="0" <?php if(isset($data->sex) && $data->sex=='0') echo 'selected'; ?> >Nữ</option>
                        <option value="1" <?php if(!empty($data->sex) && $data->sex=='1') echo 'selected'; ?> >Nam</option>                        
                      </select>
                    </div>
                  </div>
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Ngày sinh (*)</label>
                    <input type="text"  class="form-control hasDatepicker datepicker" placeholder="" name="birthday" id="birthday" value="<?php echo @$data->birthday;?>" />
                  </div>
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-email">Nhân viên phụ trách</label>
                    <div class="input-group input-group-merge">
                      <select class="form-select" name="id_staff" id="id_staff">
                        <?php foreach($dataMember as $key => $item){ ?>
                        <option value="<?php echo $item->id ?>" <?php if(isset($data->id_staff) && $data->id_staff==$item->id ) echo 'selected'; ?> ><?php echo $item->name ?></option>
                      <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-email">Nhóm khách hàng </label>
                    <div class="input-group input-group-merge">
                      <select class="form-select" name="id_group" id="id_group">
                        <?php foreach($dataGroup as $key => $item){ ?>
                        <option value="<?php echo $item->id ?>" <?php if(isset($data->id_group) && $data->id_group==$item->id ) echo 'selected'; ?> ><?php echo $item->name ?></option>
                      <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Mã khách hàng (*)</label>
                    <input type="text"  class="form-control" placeholder="" name="code" id="code" value="<?php echo @$data->code;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Số điện thoại (*)</label>
                    <input type="text" required class="form-control" placeholder="" name="phone" id="phone" value="<?php echo @$data->phone;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Email</label>
                    <input type="email" class="form-control" placeholder="" name="email" id="email" value="<?php echo @$data->email;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Địa chỉ</label>
                    <input type="text" class="form-control" placeholder="" name="address" id="address" value="<?php echo @$data->address;?>" />
                  </div>
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Link facebook</label>
                    <input type="text" class="form-control" placeholder="" name="link_facebook" id="link_facebook" value="<?php echo @$data->link_facebook;?>" />
                  </div>
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-email">Nguồn khách hàng </label>
                    <div class="input-group input-group-merge">
                      <select class="form-select" name="source" id="source">
                       <?php foreach($dataSource as $key => $item){ ?>
                        <option value="<?php echo $item->id ?>" <?php if(isset($data->source) && $data->source==$item->id ) echo 'selected'; ?> ><?php echo $item->name ?></option>
                      <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-email">Chi nhánh</label>
                    <div class="input-group input-group-merge">
                      <select class="form-select" name="id_spa" id="id_spa">
                        <?php foreach($dataSpa as $key => $item){ ?>
                        <option value="<?php echo $item->id ?>" <?php if(isset($data->id_spa) && $data->id_spa== $item->id) echo 'selected'; ?> ><?php echo $item->name ?></option>
                      <?php } ?>
                      </select>
                    </div>
                  </div>
              </div>
              <h5 class="mb-0" style="padding-top: 30px;">Thông tin bệnh lý</h5>
              <div class="col-md-6">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Tiền sử bệnh lý đang mắc</label>
                  <input type="text" class="form-control" placeholder="" name="medical_history" id="medical_history" value="<?php echo @$data->medical_history;?>" />
                </div>
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Nhu cầu hiện tại</label>
                  <input type="text" class="form-control" placeholder="" name="request_current" id="request_current" value="<?php echo @$data->request_current;?>" />
                </div>
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Khả năng tư vấn hướng tới</label>
                  <input type="text" class="form-control" placeholder="" name="advise_towards" id="advise_towards" value="<?php echo @$data->advise_towards;?>" />
                </div>
              </div>
              <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Tiền sử mang thai/ dị ứng thuốc</label>
                    <input type="text" class="form-control" placeholder="" name="drug_allergy_history" id="drug_allergy_history" value="<?php echo @$data->drug_allergy_history;?>" />
                </div>
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Khả năng tư vấn hướng dẫn</label>
                  <input type="text" class="form-control" placeholder="" name="advisory" id="advisory" value="<?php echo @$data->advisory;?>" />
                </div>
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Dịch vụ quan tâm</label>
                  <select class="form-select" name="id_service" id="id_service">
                    <?php foreach($dataService as $key => $item){ ?>
                      <option value="<?php echo $item->id ?>" <?php if(isset($data->id_service) && $data->id_service== $item->id) echo 'selected'; ?> ><?php echo $item->name ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="col-md-12">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Thông tin thêm</label>
                  <textarea class="form-control" name="note"><?php echo @$data->note;?></textarea>
                </div>
              </div>
              <button type="submit" style=" width: 70px; " class="btn btn-primary">Lưu</button>
            <?= $this->Form->end() ?>
          </div>
        </div>
      </div>

    </div>
</div>
<style type="text/css">
  .datepicker-dropdown .table-condensed{
    width: 100%; 
    text-align: center;
  }
</style>
<script>
    $( function() {
      $( ".datepicker" ).datepicker({
        dateFormat: "dd/mm/yy"
      });
    } );
    </script>

<?php include(__DIR__.'/../footer.php'); ?>