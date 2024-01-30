<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/2top_crm_training-view-admin-test-listTestCRM.php">Bài thi</a> /</span>
    Thông tin bài thi
  </h4>

  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin bài thi</h5>
          </div>
          <div class="card-body">
            <p><?php echo $mess;?></p>
            <?= $this->Form->create(); ?>
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Khóa học</label>
                    <div class="input-group input-group-merge">
                      <select class="form-select" name="id_course" id="id_course" onchange="selectCourse();">
                        <option value="0">Chọn khóa học</option>
                        <?php 
                        if(!empty($listCourse)){
                          foreach ($listCourse as $key => $item) {
                            if(empty($data->id_course) || $data->id_course!=$item->id){
                              echo '<option value="'.$item->id.'">'.$item->title.'</option>';
                            }else{
                              echo '<option selected value="'.$item->id.'">'.$item->title.'</option>';
                            }
                          }
                        }
                        ?>
                      </select>
                    </div>
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Bài học</label>
                    <div class="input-group input-group-merge">
                      <select class="form-select" name="id_lesson" id="id_lesson">
                        <option value="0">Chọn bài học</option>
                      </select>
                    </div>
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Tên bài thi (*)</label>
                    <input required type="text" class="form-control phone-mask" name="title" id="title" value="<?php echo @$data->title;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Thời gian bắt đầu thi (*)</label>
                    <input required type="text" class="form-control datetimepicker" placeholder="" name="time_start" id="time_start" value="<?php if(!empty($data->time_start)) echo date('H:i d/m/Y', $data->time_start);?>" />
                  </div>

                </div>

                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Thời gian thi (phút)</label>
                    <input required type="text" class="form-control" placeholder="" name="time_test" id="time_test" value="<?php echo @$data->time_test;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Trạng thái</label>
                    <div class="input-group input-group-merge">
                      <select class="form-select" name="status" id="status">
                        <option value="active" <?php if(!empty($data->status) && $data->status=='active') echo 'selected'; ?> >Kích hoạt</option>
                        <option value="lock" <?php if(!empty($data->status) && $data->status=='lock') echo 'selected'; ?> >Khóa</option>
                      </select>
                    </div>
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Số điểm tối thiểu để đạt (*)</label>
                    <input required type="text" class="form-control" placeholder="" name="point_min" id="point_min" value="<?php echo @$data->point_min;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Thời gian kết thúc thi (*)</label>
                    <input required type="text" class="form-control datetimepicker" placeholder="" name="time_end" id="time_end" value="<?php if(!empty($data->time_end)) echo date('H:i d/m/Y', $data->time_end);?>" />
                  </div>

                </div>
                <div class="col-md-12">
                  <div class="mb-3">
                    <label class="form-label">Ghi chú bài thi</label>
                    <?php showEditorInput('description', 'description', @$data->description);?>
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
  var id_lesson_default = '<?php echo @$data->id_lesson;?>';

  function selectCourse()
  {
    var id_course = $('#id_course').val();
    var lessonSelect = '<option value="0">Chọn bài học</option>';
    var selectStyle;

    if(id_course!='0'){
      $.ajax({
        method: "POST",
        url: "/apis/getLessonsAPI",
        data: { id_course: id_course }
      })
      .done(function( msg ) {
        Object.keys(msg).forEach(function(key) {
          selectStyle = '';
          if(msg[key].id == id_lesson_default) selectStyle = 'selected';

          lessonSelect += '<option '+selectStyle+' value="'+msg[key].id+'">'+msg[key].title+'</option>';
        });

        $('#id_lesson').html(lessonSelect);
      }); 
    }else{
      $('#id_lesson').html(lessonSelect);
    }
  }

  selectCourse();
</script>