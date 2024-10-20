<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/phongtruyenthong-view-admin-student-listStudentAdmin">Học sinh</a> /</span>
    Thông tin học sinh
  </h4>

  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin học sinh tiêu biểu</h5>
          </div>
          <div class="card-body row">
            <p><?php echo $mess;?></p>
            <?= $this->Form->create(); ?>
            <div class="row">
              <div class="col-md-6">
                <div class="mb-3">
                  <label class="form-label">Tên học sinh (*)</label>
                  <input required type="text" class="form-control phone-mask" name="name" id="name" value="<?php echo @$data->name;?>" />
                </div>

                <div class="mb-3">
                  <label class="form-label">Ảnh đại diện</label>
                  <?php 
                    showUploadFile('image','image',@$data->image,1);

                    if(!empty($data->image)){
                      echo '<br/><img src="'.$data->image.'" width="150" />';
                    }
                  ?>
                </div>
              </div>

              <div class="col-md-6">
                <div class="mb-3">
                  <label class="form-label">Niên khóa (*)</label>
                  <select name="id_year" id="id_year" required class="form-select color-dropdown" onchange="getListClass();">
                    <option value="">Chọn niên khóa</option>
                    <?php 
                    if(!empty($listYear)){
                      foreach ($listYear as $key => $value) {
                        if(empty($data->id_year) || $data->id_year!=$value->id){
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
                  <label class="form-label">Lớp học (*)</label>
                  <select name="id_class" id="id_class" required class="form-select color-dropdown">
                    <option value="">Chọn lớp học</option>
                  </select>
                </div>

                <div class="mb-3">
                  <label class="form-label">Thành tích đạt được</label>
                  <textarea class="form-control phone-mask" name="achievement" id="achievement" rows="5"><?php echo @$data->achievement;?></textarea>
                </div>
              </div>

              <div class="col-md-12">
                <button type="submit" class="btn btn-primary">Lưu</button>
              </div>
            </div>
            <?= $this->Form->end() ?>
          </div>
        </div>
      </div>

    </div>
</div>

<script type="text/javascript">
  var id_class_select = '<?php echo @$data->id_class;?>';

  function getListClass()
  {
    var id_year = $('#id_year').val();
    var listClass = '<option value="">Chọn lớp học</option>';

    $('#id_class').html(listClass);

    if(id_year != ''){
      $.ajax({
        method: "POST",
        url: "/apis/getClassInYearAPI",
        data: { id_year: id_year }
      })
        .done(function( msg ) {
          if(msg.listData.length > 0){
            for (var i = 0; i < msg.listData.length; i++) {
              listClass += '<option value="'+msg.listData[i].id+'">'+msg.listData[i].name+'</option>';
            }

            $('#id_class').html(listClass);

            if(id_class_select != ''){
              $('#id_class').val(id_class_select);
            }
          }
        });
    }
  }

  if(id_class_select != ''){
    getListClass();
  }
</script>