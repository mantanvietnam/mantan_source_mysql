<?php include(__DIR__.'/../header.php'); ?>

<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/listBook">Lịch hẹn</a> /</span>
    Thông tin lịch hẹn
  </h4>

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
                    <ul class="nav nav-tabs" role="tablist">
                              <li class="nav-item">
                                <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#tab1" aria-controls="navs-top-home" aria-selected="true">
                                  Đặt lịch hẹn
                                </button>
                              </li>
                              <li class="nav-item">
                                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#tab2" aria-controls="navs-top-image" aria-selected="false">
                                 Đăng kí khách hàng mới
                                </button>
                              </li>                       
                    </ul>
                    <div id="tabs">
                      <div class="tab-content">
                        <div class="tab-pane fade active show" id="tab1" role="tabpanel">
                          <div class="row">
                            <div class="mb-3 col-md-6">
                              <label class="form-label" for="basic-default-phone">Tên khách hàng (*)</label>
                              <input required type="text" class="form-control phone-mask" name="name" id="name" value="<?php echo @$data->name;?>" >
                            </div>
                            <div class="mb-3 form-group col-md-6">
                                 <label class="form-label" for="basic-default-fullname">Ngày đặt:</label>
                                <input type="text" name="created_book" class="form-control hasDatepicker datepickerorder" id="datestart" value="<?php echo (!empty($data['created_book']))?  date("d/m/Y H:i", @$data['created_book']) : " " ?>">
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
                               <label class="form-label" for="basic-default-fullname">Khiểu đặt</label>
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
                             
                                <!-- <script>
                                    $(document).ready(function() {
                                                    $('[name="types[]"]:first').prop('checked', true);
                                             });
                                </script>   -->                  
                              </div>
                            </div>
                            <div class="mb-3 col-md-12">
                              <label class="form-label" for="basic-default-fullname">Thông tin thêm</label>
                              <textarea class="form-control" rows="5" name="note"><?php echo @$data->note;?></textarea>
                            </div>
                            <div>
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
                          </div>
                        </div>
                        <div class="tab-pane fade" id="tab2" role="tabpanel">
                          <div class="row">
                            <div class="col-md-6">
                             
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
                              </div>

                              <div class="col-md-6">
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
                                
                              </div>
                              
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
              </div>

             <button type="submit" style=" width: 70px; " class="btn btn-primary">Lưu</button>
            <?= $this->Form->end() ?>
          
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

 
<script type="text/javascript">
    jQuery('.datepickerorder').datetimepicker({
      format:'d/m/Y H:i'
    }).on('dp.change', function (e) { });
</script>

<?php include(__DIR__.'/../footer.php'); ?>