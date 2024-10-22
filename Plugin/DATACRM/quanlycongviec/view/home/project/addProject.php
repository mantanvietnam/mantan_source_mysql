<?php include(__DIR__.'/../../../../hethongdaily/view/home/header.php'); ?>
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/listGroupStaff">Nhóm nhân viên</a> /</span>
    Thông tin nhóm nhân viên 
  </h4>

  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin nhóm nhân viên</h5>
          </div>
          <div class="card-body">
            <p><?php echo @$mess;?></p>
            <?= $this->Form->create(); ?>
              <div class="row">
                  <div class="mb-3 col-md-6">
                    <label class="form-label" for="basic-default-phone">Tên nhóm dự án (*)</label>
                    <input required type="text" class="form-control phone-mask" name="name" id="name" value="<?php echo @$data->name;?>" />
                  </div>
                  <div class="mb-3 col-md-3">
                    <label class="form-label" for="basic-default-fullname">Ngày bắt đầu (*)</label>
                    <input type="text" required  class="form-control datepicker" placeholder="" name="start_date" id="start_date" value="<?php if(!empty($data->start_date)){  echo date('d/m/Y', @$data->start_date);}?>" />
                  </div>
                  <div class="mb-3 col-md-3">
                    <label class="form-label" for="basic-default-fullname">Ngày Kết thúc (*)</label>
                    <input type="text" required  class="form-control datepicker" placeholder="" name="end_date" id="end_date" value="<?php if(!empty($data->end_date)){  echo date('d/m/Y', @$data->end_date);}?>" />
                  </div>
                  <div class="mb-3 col-md-3">
                    <label class="form-label" for="basic-default-fullname">Hành động:</label>&
                    <select class="form-control" id="form-field-select-1" name="state">
                      <option value="new" <?php if(!empty($data->state) && $data->state=='new') echo 'selected'; ?> >Mới tạo</option>
                      <option value="process" <?php if(!empty($data->state) && $data->state=='process') echo 'selected'; ?> >Đang xử lý</option>
                      <option value="done" <?php if(!empty($data->state) && $data->state=='done') echo 'selected'; ?> >Hoàn thành</option>
                      <option value="bug" <?php if(!empty($data->state) && $data->state=='bug') echo 'selected'; ?> >Có lỗi</option>
                      <option value="cancel" <?php if(!empty($data->state) && $data->state=='cancel') echo 'selected'; ?> >Hủy bỏ</option>                  
                    </select>
                  </div>

                  <div class="mb-3 col-md-3">
                    <label class="form-label" for="basic-default-fullname">Trạng thái:</label>
                     <select class="form-control" id="form-field-select-1" name="status">
                      <option value="active" <?php if(!empty($data->status) && $data->status=='active') echo 'selected'; ?> >Kích hoạt</option>
                      <option value="lock" <?php if(!empty($data->status) && $data->status=='lock') echo 'selected'; ?> >Khóa</option>                  
                    </select>
                  </div>
                 

                  <div class="mb-3 col-md-6">
                    <label class="form-label" for="basic-default-fullname">Leader </label>
                    <select class="form-control" id="form-field-select-1" name="id_staff">
                      <option value="" >Chọn nhân viên</option>
                      <?php if(!empty($liststaff)){
                              foreach($liststaff as $key => $item){
                                $selected = '';
                                if($item->id== @$data->id_staff){
                                  $selected = 'selected';
                                }
                                echo '<option value="'.$item->id.'" '.$selected.'>'.$item->name.'</option>';
                              }
                      } ?>
                      
                                       
                    </select>
                  </div>
                   <div class="mb-3 col-md-6">
                    <label class="form-label" for="basic-default-fullname">Nội dung</label>
                     <textarea class="form-control" name="content"><?php echo @$data->content; ?></textarea>
                  </div>

                  <div class="mb-3 col-md-6">
                    <label class="form-label" for="basic-default-email">Nhân viên </label>

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

                                      function checkboxAll(source, className) {
                                          const checkboxes = document.getElementsByClassName(className);
                                          for(let i = 0; i < checkboxes.length; i++) {
                                              checkboxes[i].checked = source.checked;
                                          }
                                      }
                                  </script>
                                  <ul class="list-unstyled list_addPer">
                                      <?php 
                                      foreach ($dataGroupStaff as $key =>$item) { 
                                          $checkGroup= false;
                                          echo '<li class="has_sub_staff">
                                          <span><input type="checkbox" class="checkAll" id="check'.$key.'"> <label for="">'.$item->name.'</label></span>
                                          <ul class="list-unstyled sub_staff" style="margin-left: 20px;">';
                                          foreach ($item->staff as $k => $staff) { 
                                              $check= '';
                                              if (isset($data->list_staff) && in_array($staff->id, $data->list_staff)) {
                                                  $check= 'checked';
                                                  $checkGroup= true;
                                              }

                                              echo '<li><input '.$check.' class="checkAll" name="list_staff[]" value="'.$staff->id.'" type="checkbox" id="check'.$key.'_'.$k.'"> <label for="check'.$key.'_'.$k.'">'.$staff->name.'</label></li>';
                                          }
                                          echo '  </ul>
                                          </li>';

                                          if($checkGroup){
                                              echo '<script type="text/javascript">addCheck("check'.$key.'");</script>';
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
              <button type="submit" class="btn btn-primary">Lưu</button>
            <?= $this->Form->end() ?>
          </div>
        </div>
      </div>

    </div>
</div>

<?php include(__DIR__.'/../../../../hethongdaily/view/home/footer.php'); ?>