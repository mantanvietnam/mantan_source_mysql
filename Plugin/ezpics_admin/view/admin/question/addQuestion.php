<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/ezpics_admin-view-admin-question-listQuestion.php">Câu hỏi</a> /</span>
    Thông tin câu hỏi
  </h4>

  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin  câu hỏi</h5>
          </div>
          <div class="card-body">
            <p><?php echo @$mess;?></p>
            <?= $this->Form->create(); ?>
              <div class="row">
                <div class="col-md-12">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Tên câu hỏi (*)</label>
                    <input required type="text" class="form-control phone-mask" name="name" id="name" value="<?php echo @$data->name;?>" />
                  </div>
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Danh mục</label>
                    <select name="category_id" required class="form-select color-dropdown">
                      <option value="">Tất cả</option>
                      <?php
                      if(!empty($listCategory)){
                        foreach ($listCategory as $key => $value) {
                          if(empty($data->category_id) || $data->category_id!=$value->id){
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
             
              </div>
              <button type="submit" class="btn btn-primary">Lưu</button>
            <?= $this->Form->end() ?>
          </div>
        </div>
      </div>

    </div>
</div>