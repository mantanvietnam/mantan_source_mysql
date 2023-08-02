<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/student-view-admin-student-listStudent.php">Sinh viên</a> /</span>
    Thông tin sinh viên
  </h4>
  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin sinh viên</h5>
          </div>
          <div class="card-body">
            <p><?php echo $mess;?></p>
            <?= $this->Form->create(); ?>
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Tên sinh viên (*)</label>
                    <input required type="text" class="form-control phone-mask" name="name_student" id="name_student" value="<?php echo @$data->name_student;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Danh mục (*)</label>
                    <div class="input-group input-group-merge">
                      <select class="form-select" name="category_id" id="category_id" required>
                        <option value="">Chọn danh mục</option>
                        <?php 
                          if(!empty($listCategory)){
                            foreach ($listCategory as $key => $item) {
                              if(empty($data->category_id) || $data->category_id!=$item->id){
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

                  
                </div>
              </div>
              <button type="submit" class="btn btn-primary">Lưu</button>
            <?= $this->Form->end() ?>
          </div>
        </div>
      </div>

    </div>
</div>