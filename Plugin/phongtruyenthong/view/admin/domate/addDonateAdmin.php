<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/phongtruyenthong-view-admin-domate-listDonateAdmin.php">Quyên góp</a> /</span>
    Thông tin quyên góp
  </h4>
  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin quyên góp</h5>
          </div>
          <div class="card-body">
            <?php echo $mess;?>
            <?= $this->Form->create(); ?>
              <div class="row">
                <div class="col-md-6 col-12">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Tên người quyên góp (*)</label>
                    <input required type="text" class="form-control phone-mask" name="name" id="name" value="<?php echo @$data->name;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Điện thoại</label>
                    <input type="text" class="form-control phone-mask" name="phone" id="phone" value="<?php echo @$data->phone;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control phone-mask" name="email" id="email" value="<?php echo @$data->email;?>" />
                  </div>

                  

                  <div class="mb-3">
                    <label class="form-label">Niên khóa</label>
                    <select class="form-select" name="id_year" id="id_year" onchange="selectYear();">
                      <option value="">Chọn niên khóa</option>
                      <?php 
                      if(!empty($years)){
                        foreach ($years as $key => $item) {
                          if(empty($data->id_year) || $data->id_year!=$item->id){
                            echo '<option value="'.$item->id.'">'.$item->name.'</option>';
                          }else{
                            echo '<option selected value="'.$item->id.'">'.$item->name.'</option>';
                          }
                        }
                      }
                      ?>
                    </select>
                  </div>

                </div>

                <div class="col-md-6 col-12">
                  <div class="mb-3">
                    <label class="form-label">Số tiền quyên góp (*)</label>
                    <input type="number" class="form-control phone-mask" name="donate" id="donate" value="<?php echo @$data->donate;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Chức danh (công việc hiện tại)</label>
                    <input type="text" class="form-control phone-mask" name="job" id="job" value="<?php echo @$data->job;?>" />
                  </div>

                  
                  <div class="mb-3">
                    <label class="form-label">Ảnh đại diện</label>
                    <?php showUploadFile('avatar','avatar',@$data->avatar,0);?>
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Lớp học</label>
                    <select class="form-select" name="id_class" id="id_class">
                      <option value="">Chọn lớp học</option>
                    </select>
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
  var year_class = [];

  var year_select = '<?php echo @$data->id_year?>';
  var class_select = '<?php echo @$data->id_class?>';

  <?php 
  if(!empty($year_class)){
    foreach ($year_class as $year => $clases) {
      echo 'year_class['.$year.'] = {};';

      if(!empty($clases)){
        foreach($clases as $class){
          echo 'year_class['.$year.']['.$class['id'].'] = "'.$class['name'].'";';
        }
      }
    }
  }
  ?>

  function selectYear()
  {
    var year = $('#id_year').val();
    var choose_class = '<option value="">Chọn lớp học</option>';

    if(year!=''){
      if(Object.keys(year_class[year]).length > 0){
        Object.keys(year_class[year]).forEach(key => {
          if(class_select!='' && class_select==key){
            choose_class += '<option selected value="'+key+'">'+year_class[year][key]+'</option>';
          }else{
            choose_class += '<option value="'+key+'">'+year_class[year][key]+'</option>';
          }
        });
      }
    }

    $('#id_class').html(choose_class);
  }

  selectYear();
</script>