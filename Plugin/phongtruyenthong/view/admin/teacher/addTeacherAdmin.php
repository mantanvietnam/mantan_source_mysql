<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/phongtruyenthong-view-admin-teacher-listTeacherAdmin.php">Giáo viên</a> /</span>
    Thông tin giáo viên
  </h4>

  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin giáo viên</h5>
          </div>
          <div class="card-body row">
            <p><?php echo $mess;?></p>
            <?= $this->Form->create(); ?>
            <div class="row">
              <div class="col-md-6">
                <div class="mb-3">
                  <label class="form-label">Tên giáo viên (*)</label>
                  <input required type="text" class="form-control phone-mask" name="name" id="name" value="<?php echo @$data->name;?>" />
                </div>
              </div>

              <div class="col-md-6">
                <div class="mb-3">
                  <label class="form-label">Chức danh (*)</label>
                  <select name="position" required class="form-control">
                    <option value="">Chọn chức danh</option>
                    <?php 
                    if(!empty($listPositionTeacher)){
                      foreach ($listPositionTeacher as $key => $value) {
                        if(empty($data->position) || $data->position!=$value->id){
                          echo '<option value="'.$value->id.'">'.$value->name.'</option>';
                        }else{
                          echo '<option selected value="'.$value->id.'">'.$value->name.'</option>';
                        }
                      }
                    }
                    ?>
                  </select>
                </div>
              </div>

              <div class="col-md-12">
                <div class="mb-3">
                  <label class="form-label">Thông tin giáo viên</label>
                  <textarea name="introduce" rows="10" class="form-control"><?php echo @$data->introduce;?></textarea>
                </div>
              </div>

              <div class="col-md-12">
                <div class="mb-3">
                  <label class="form-label">Ảnh đại diện</label>
                  <?php 
                    showUploadFile('avatar','avatar',@$data->avatar,1);

                    if(!empty($data->avatar)){
                      echo '<br/><img src="'.$data->avatar.'" width="150" />';
                    }
                  ?>
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