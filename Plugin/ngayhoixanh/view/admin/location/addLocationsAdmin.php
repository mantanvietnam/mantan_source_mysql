<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/ngayhoixanh-view-admin-location-listLocationAdmin">Địa điểm</a> /</span>
    Thông tin địa điểm
  </h4>

  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin địa điểm</h5>
          </div>
          <div class="card-body">
            <p><?php echo $mess;?></p>
            <?= $this->Form->create(); ?>
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Tên địa điểm (*)</label>
                    <input required type="text" class="form-control phone-mask" name="name" id="name" value="<?php echo @$data->name;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Tỉnh thành (*)</label>
                    <div class="input-group input-group-merge">
                      <select class="form-select" name="id_city" id="id_city" required>
                        <option value="">Chọn tỉnh thành</option>
                        <?php 
                        if(!empty($listCity)){
                          foreach ($listCity as $key => $item) {
                            if(empty($data->id_city) || $data->id_city!=$key){
                              echo '<option value="'.$key.'">'.$item.'</option>';
                            }else{
                              echo '<option selected value="'.$key.'">'.$item.'</option>';
                            }
                          }
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                  
                </div>

                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Hình minh họa</label>
                    <?php 
                      showUploadFile('image','image',@$data->image,1000);

                      if(!empty($data->image)){
                        echo '<br/><img src="'.$data->image.'" width="150" />';
                      }
                    ?>
                  </div>

                  
                </div>

                <div class="col-md-12">
                  <div class="mb-3">
                    <label class="form-label">Mô tả địa điểm</label>
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