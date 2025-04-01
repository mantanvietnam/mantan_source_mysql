<?php include(__DIR__.'/../header.php'); ?>
<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/listStaff">Nhân viên</a> /</span>
    Thông tin Nhân viên 
  </h4>

  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin nhân viên</h5>
          </div>
          <div class="card-body">
            <p><?php echo @$mess; ?></p>
            <?= $this->Form->create(); ?>
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Tên nhân viên (*)</label>
                    <input required type="text" class="form-control phone-mask" name="name" id="name" value="<?php echo @$data->name;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Hình đại diện</label>
                    <?php showUploadFile('avatar','avatar',@$data->avatar,0);?>
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Email</label>
                    <input type="email" class="form-control" placeholder="" name="email" id="email" value="<?php echo @$data->email;?>" />
                  </div>
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Ngày sinh</label>
                    <input type="text" class="form-control hasDatepicker datepicker" placeholder="" name="birthday" id="birthday" value="<?php echo @$data->birthday;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Nhóm nhân viên (*)</label>
                    <select name="id_group" class="form-select color-dropdown" required>
                      <option value="">Chọn nhóm nhân viên</option>
                      <?php
                      if(!empty($listCategory)){
                        foreach ($listCategory as $key => $value) {
                          if(empty(@$data->id_group) || @$data->id_group!=$value->id){
                            echo '<option value="'.$value->id.'">'.$value->name.'</option>';
                          }else{
                            echo '<option selected value="'.$value->id.'">'.$value->name.'</option>';
                          }
                        }
                      }
                      ?>
                    </select>
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Địa chỉ</label>
                    <input type="text" class="form-control" placeholder="" name="address" id="address" value="<?php echo @$data->address;?>" />
                  </div>
                   <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Số căn cước công dân</label>
                    <input type="text" class="form-control" placeholder="" name="id_card" id="id_card" value="<?php echo @$data->id_card;?>" />
                  </div>
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-email">Trạng thái</label>
                    <div class="input-group input-group-merge">
                      <select class="form-select" name="status" id="status">
                        <option value="1">Kích hoạt</option>
                        <option value="0" <?php if(isset($data->status) && $data->status=='0') echo 'selected'; ?> >Khóa</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Số điện thoại (*)</label>
                    <input type="text"  <?php if(!empty($_GET['id'])){ echo 'readonly=""';}else{ echo 'required';} ?> class="form-control" placeholder="" name="phone" id="phone" value="<?php echo @$data->phone; ?>" />
                  </div>
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Lương cứng (*)</label>
                    <input type="text" class="form-control" placeholder="" name="fixed_salary" id="" required value="<?php echo (int) @$data->fixed_salary; ?>" />
                  </div>
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Tiền đóng bảo hiểm (*)</label>
                    <input type="text" class="form-control" placeholder="" name="insurance" id="" required value="<?php echo (int) @$data->insurance; ?>" />
                  </div>
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Phụ cấp  (*)</label>
                    <input type="text" class="form-control" placeholder="" name="allowance" id="" required value="<?php echo (int) @$data->allowance; ?>" />
                  </div>
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Số tài khoản ngân hàng</label>
                    <input type="text" class="form-control" placeholder="" name="account_bank" id="phone" value="<?php echo @$data->account_bank; ?>" />
                  </div>
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Ngân hàng</label>
                    <select class="form-select" name="code_bank" id="code_bank">
                      <option value="">Chọn ngân hàng</option>
                      <?php
                      foreach($listBank as $key => $item){
                        $selected = '';
                        if(@$data->code_bank==$item['code']){ 
                          $selected = 'selected';
                        }
                        echo'<option value="'.$item['code'].'" '.$selected.' >'.$item['name'].' ('.$item['code'].')</option>';
                      } ?>
                    </select>
                  </div>
                  <?php 
                    if(empty($_GET['id'])){
                      echo '<div class="mb-3">
                              <label class="form-label" for="basic-default-fullname">Mật khẩu tài khoản</label>
                              <input type="text" autocomplete="off" required class="form-control" placeholder="" name="password" id="password" value=""  />
                            </div>';
                    }
                  ?>

                  
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-email">Phân quyền chức năng</label>

                    <label class="col-sm-12 control-label">

                      <input type="checkbox" id="selectAll" onclick="checkboxAll(this,'checkAll');"> <label for="selectAll">Tất cả</label>

                    </label>
                      
                      <div class="col-sm-12" style="margin-left: 20px;">
                          <div class="form-group" id="checkAll">
                              <div class="col-sm-12">
                                  <script type="text/javascript">
                                      function addCheck(idCheckbox)
                                      {
                                          $('#'+idCheckbox).attr( 'checked', true );
                                      }
                                  </script>
                                  <ul class="list-unstyled list_addPer">
                                      <?php 
                                      foreach ($listPermissionMenu as $keyGroup=>$permissionMenu) { 
                                          $checkGroup= false;
                                          echo '<li class="has_sub_staff">
                                          <span><input type="checkbox" id="check'.$keyGroup.'"> <label for="">'.$permissionMenu['name'].'</label></span>
                                          <ul class="list-unstyled sub_staff" style="margin-left: 20px;">';
                                          foreach ($permissionMenu['sub'] as $key=>$menu2) { 
                                              $check= '';
                                              if (isset($data->permission) && in_array($menu2['permission'], $data->permission)) {
                                                  $check= 'checked';
                                                  $checkGroup= true;
                                              }
                                              if($menu2['permission']=='managerLogout'){
                                                  $check= 'checked';
                                                  $checkGroup= true;
                                              }
                                              echo '<li><input '.$check.' name="check_list_permission[]" value="'.$menu2['permission'].'" type="checkbox" id="check'.$keyGroup.'_'.$key.'"> <label for="check'.$keyGroup.'_'.$key.'">'.$menu2['name'].'</label></li>';
                                          }
                                          echo '  </ul>
                                          </li>';

                                          if($checkGroup){
                                              echo '<script type="text/javascript">addCheck("check'.$keyGroup.'");</script>';
                                          }
                                      }
                                      ?>
                                  </ul>
                                  <script>
                                      $(document).ready(function() {
                                          $('.list_addPer ul').hide();
                                          $('.has_sub_staff span label').click(function(){
                                              if($(this).parent().next('.sub_staff').hasClass('show')){
                                                  $(this).parent().next('.sub_staff').slideUp();
                                                  $(this).parent().next('.sub_staff').removeClass('show');
                                              } else{
                                                  $(this).parent().next('.sub_staff').slideDown();
                                                  $(this).parent().next('.sub_staff').addClass('show');
                                              }
                                          });
                                          $(".has_sub_staff span input").click(function(){
                                              $(this).parent().parent().find('input').prop('checked', this.checked);    
                                          });
                                      });
                                  </script>
                              </div>
                          </div> 
                      </div>
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
<script type="text/javascript">
  function checkboxAll(source,idLoad) {
    var checkboxes = document.querySelectorAll('#'+idLoad+' input[type="checkbox"]');
    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i] != source)
            checkboxes[i].checked = source.checked;
    }
}


  $('#birthday').datetimepicker({
    timepicker : false,
    format : 'd/m/Y',
    maxDate  : '<?php echo date('d/m/Y'); ?>'
});
  </script>
<?php include(__DIR__.'/../footer.php'); ?>