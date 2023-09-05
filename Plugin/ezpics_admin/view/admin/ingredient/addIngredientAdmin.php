<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/ezpics_admin-view-admin-ingredient-listIngredientAdmin.php">Thư viện ảnh</a> /</span>
    Thông tin thư viện ảnh
  </h4>

  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin thư viện ảnh</h5>
          </div>
          <div class="card-body">
            <p><?php echo @$mess;?></p>
            <?= $this->Form->create(); ?>
              <div class="row">
                <div class="col-md-6">
                  
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Từ khóa (*)</label>
                    <input type="text" required class="form-control" placeholder="" name="keyword" id="keyword" value="<?php echo @$data->keyword;?>" />
                  </div> 
                  <div class="mb-3">
                     <label class="form-label" for="basic-default-fullname">Trạng thái:</label>&ensp;
                                <input type="radio" name="status" class="" id="status" value="1" <?php if(@ $data['status']==1) echo 'checked="checked"';   ?> > Hiển thị&ensp;
                                <input type="radio" name="status" class="" id="status" value="0" <?php if(@ $data['status']==0) echo 'checked="checked"';   ?> > Ẩn        
                  </div>   
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Ảnh (*)</label>
                    <?php showUploadFile('image','image',@$data->image,0);?>
                  
                  </div>
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">thể loại</label>
                    <select class="form-select" name="type" id="type">
                        <option value="">Chọn thể loại</option>
                        <?php 
                          global $type_ingredient;
                            foreach($type_ingredient as $key => $value){
                               if($key == $data->type){
                                echo '<option selected  value="'.$key.'">'.$value.'</option>';
                              }else{
                                echo '<option  value="'.$key.'">'.$value.'</option>';
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