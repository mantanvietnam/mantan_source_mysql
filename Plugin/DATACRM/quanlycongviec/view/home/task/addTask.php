<?php include(__DIR__.'/../../../../hethongdaily/view/home/header.php'); ?>
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/listTask">Nhiệm vụ</a> /</span>
    Thông tin nhiệm vụ 
  </h4>

  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin nhiệm vụ </h5>
          </div>
          <div class="card-body">
            <p><?php echo @$mess;?></p>
            <?= $this->Form->create(); ?>
              <div class="row">
                  <div class="mb-3 col-md-6">
                    <label class="form-label" for="basic-default-phone">Tên nhiệm vụ  (*)</label>
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
                    <label class="form-label" for="basic-default-fullname">Hành động:</label>
                    <select class="form-control" id="form-field-select-1" name="status">
                      <option value="new" <?php if(!empty($data->status) && $data->status=='new') echo 'selected'; ?> >Mới tạo</option>
                      <option value="process" <?php if(!empty($data->status) && $data->status=='process') echo 'selected'; ?> >Đang xử lý</option>
                      <option value="done" <?php if(!empty($data->status) && $data->status=='done') echo 'selected'; ?> >Hoàn thành</option>
                      <option value="bug" <?php if(!empty($data->status) && $data->status=='bug') echo 'selected'; ?> >Có lỗi</option>
                      <option value="cancel" <?php if(!empty($data->status) && $data->status=='cancel') echo 'selected'; ?> >Hủy bỏ</option>                  
                    </select>
                  </div>

                  <div class="mb-3 col-md-3">
                    <label class="form-label" for="basic-default-fullname">Mức độ ưu tiên:</label>
                     <select class="form-control" id="form-field-select-1" name="level">
                      <option value="1" <?php if(!empty($data->level) && $data->level==1) echo 'selected'; ?> >Bình thường</option>
                      <option value="2" <?php if(!empty($data->level) && $data->level==2) echo 'selected'; ?> >Quan trọng</option>
                      <option value="3" <?php if(!empty($data->level) && $data->level==3) echo 'selected'; ?> >Khẩn cấp</option>
                    </select>
                  </div>
                 

                  <div class="mb-3 col-md-3">
                    <label class="form-label" for="basic-default-fullname">Dự án </label>
                    <select class="form-control" id="id_project" name="id_project" onchange="getstaff()">
                      <option value="" >Chọn dự án</option>
                      <?php if(!empty($listProject)){
                              foreach($listProject as $key => $item){
                                $selected = '';
                                if($item->id== @$data->id_project){
                                  $selected = 'selected';
                                }
                                echo '<option value="'.$item->id.'" '.$selected.'>'.$item->name.'</option>';
                              }
                      } ?>
                      
                                       
                    </select>
                  </div>
                  <div class="mb-3 col-md-3">
                    <label class="form-label" for="basic-default-fullname">Nhân viên </label>
                    <select class="form-control" id="id_staff" name="id_staff">
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
                  
                </div>
              <button type="submit" class="btn btn-primary">Lưu</button>
            <?= $this->Form->end() ?>
          </div>
        </div>
      </div>

    </div>
</div>

<script type="text/javascript">
  function getstaff(){
     var id_project = $('#id_project').val();

     $.ajax({
            type: "POST",
            url: "/apis/getStaffProjectAPI",
            data: {id_project: id_project}
        }).done(function (msg) {
          var users = msg.data;

            let htmlContent = ''; 

    for (let i = 0; i < users.length; i++) {
        let user = users[i];

       htmlContent += '<option value="'+user.id+'">'+user.name+'</option>'; 
    }

    $('#id_staff').html(htmlContent);
        }) 
  }
</script>

<?php include(__DIR__.'/../../../../hethongdaily/view/home/footer.php'); ?>