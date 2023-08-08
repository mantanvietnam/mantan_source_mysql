<?php include(__DIR__.'/../header.php'); ?>

<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/listBook">Lịch hẹn</a> /</span>
    Thông tin lịch hẹn
  </h4>

  <p><a href="/addCustomer" target="_blank" class="btn btn-primary"><i class='bx bx-plus'></i> Thêm khách hàng mới</a></p>

  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin lịch hẹn</h5>
          </div>
          <div class="card-body">
            <p><?php echo @$mess;?></p>
            <?= $this->Form->create(); ?>
              <div class="row">
                <div class="col-md-12">
                  <div class="row">
                    <div class="mb-3 col-md-6">
                      <label class="form-label" for="basic-default-phone">Tên khách hàng (*)</label>
                      <input required type="text" class="form-control phone-mask" name="name" id="name" value="<?php echo @$data->name;?>" >
                    </div>
                    <div class="mb-3 form-group col-md-6">
                         <label class="form-label" for="basic-default-fullname">Ngày đặt:</label>
                        <input type="text" name="created_book" class="form-control datepicker datepickerorder" id="datestart" value="<?php echo (!empty($data['created_book']))?  date("d/m/Y H:i", @$data['created_book']) : " " ?>">
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
                      <label class="form-label" for="basic-default-fullname">Dịch vụ quan tâm</label>
                      <select class="form-select" name="id_service" id="id_service">
                        <?php foreach($dataService as $key => $item){ ?>
                          <option value="<?php echo $item->id ?>" <?php if(isset($data->id_service) && $data->id_service== $item->id) echo 'selected'; ?> ><?php echo $item->name ?></option>
                        <?php } ?>
                      </select>
                    </div>
                     <div class="mb-3 col-md-3">
                        <label class="form-label" for="basic-default-fullname">Cách ngày</label>
                        <input type="number" class="form-control" placeholder="" name="apt_step" id="apt_step" value="<?php echo @$data->apt_step;?>" />
                      </div>
                       <div class="mb-3 col-md-3">
                        <label class="form-label" for="basic-default-fullname">Lần</label>
                        <input type="number" class="form-control" placeholder="" name="apt_times" id="apt_times" value="<?php echo @$data->apt_times;?>" />
                      </div>
                    <div class="mb-3 col-md-12">
                       <label class="form-label" for="basic-default-fullname">Kiểu đặt</label>
                      <div class="form-group d-flex justify-content-around">
                        <?php 
                            $arr = explode(',', @$data['type']);
                             ?>
                                    <label class="i-checks i-checks-sm">
                                    <input type="checkbox" name="at_type[]" class="staffcheck"  <?php if(in_array(0, $arr)) echo 'checked ';  ?> value="0">
                                    <i></i>
                                    <span>&nbsp;&nbsp;&nbsp;&nbsp; Mặc định</span>
                                </label>
                                    <label class="i-checks i-checks-sm">

                                    <input type="checkbox" name="at_type[]" class="staffcheck"  <?php if(in_array(1, $arr)) echo 'checked ';  ?> value="1">
                                    <i></i>
                                    <span>&nbsp;&nbsp;&nbsp;&nbsp; Lịch chăm sóc</span>
                                </label>
                                    <label class="i-checks i-checks-sm">

                                    <input type="checkbox" name="at_type[]" class="staffcheck"  <?php if(in_array(2, $arr)) echo 'checked ';  ?> value="2">
                                    <i></i>
                                    <span>&nbsp;&nbsp;&nbsp;&nbsp; Lịch liệu trình</span>
                                </label>
                                    <label class="i-checks i-checks-sm">

                                    <input type="checkbox" name="at_type[]" class="staffcheck"  <?php if(in_array(3, $arr)) echo 'checked ';  ?> value="3">
                                    <i></i>
                                    <span>&nbsp;&nbsp;&nbsp;&nbsp; Lịch điều trị</span>
                                </label>
                                    
                      </div>
                    </div>
                    <div class="mb-3 col-md-12">
                      <label class="form-label" for="basic-default-fullname">Thông tin thêm</label>
                      <textarea class="form-control" rows="5" name="note"><?php echo @$data->note;?></textarea>
                    </div>
                    <div class="mb-3 col-md-12">
                      <div class="form-group d-flex justify-content-around">
                        <label class="i-checks i-checks-sm">
                            <input type="radio" name="status" checked="" value="0" style="background-color:#7266BA">
                            <i></i>
                            <span style="color:#7266BA">&nbsp; &nbsp; Chưa xác nhận</span>
                        </label>
                                                <label class="i-checks i-checks-sm">
                            <input type="radio" name="status" value="1" style="background-color:#9ACC51">
                            <i></i>
                            <span style="color:#9ACC51">&nbsp; &nbsp; Xác nhận</span>
                        </label>
                                                <label class="i-checks i-checks-sm">
                            <input type="radio" name="status" value="2" style="background-color:#F6973B">
                            <i></i>
                            <span style="color:#F6973B">&nbsp; &nbsp; Không đến</span>
                        </label>
                                                <label class="i-checks i-checks-sm">
                            <input type="radio" name="status" value="3" style="background-color:#F26C4F">
                            <i></i>
                            <span style="color:#F26C4F">&nbsp; &nbsp; Hủy</span>
                        </label>
                                                <label class="i-checks i-checks-sm">
                            <input type="radio" name="status" value="4" style="background-color:#FA91C8">
                            <i></i>
                            <span style="color:#FA91C8">&nbsp; &nbsp; Đã đến</span>
                        </label>
                                                <label class="i-checks i-checks-sm">
                            <input type="radio" name="status" value="5" style="background-color:#23B7E5">
                            <i></i>
                            <span style="color:#23B7E5">&nbsp; &nbsp; Đặt online</span>
                        </label>
                      </div>
                    </div>
                    <div class="mb-3 col-md-12">
                      <button type="submit" class="btn btn-primary">Lưu</button>
                    </div>
                  </div>
                </div>
              </div>

             
            <?= $this->Form->end() ?>
          
        </div>
      </div>

    </div>
</div>

<script type="text/javascript">
    jQuery('.datepickerorder').datetimepicker({
      format:'d/m/Y H:i'
    }).on('dp.change', function (e) { });
</script>
<?php include(__DIR__.'/../footer.php'); ?>