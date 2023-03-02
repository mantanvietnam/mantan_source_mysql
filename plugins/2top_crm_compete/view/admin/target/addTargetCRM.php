<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Mục tiêu thi đua</h4>

  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin mục tiêu</h5>
          </div>
          <div class="card-body">
            <p><?php echo $mess;?></p>
            <?= $this->Form->create(); ?>
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Chiến dịch thi đua (*)</label>
                    <div class="input-group input-group-merge">
                      <select required class="form-select" name="id_compete" id="id_compete">
                        <option value="">Chọn chiến dịch</option>
                        <?php 
                        if(!empty($listCompete)){
                          foreach ($listCompete as $key => $item) {
                            if(empty($data->id_compete) || $data->id_compete!=$item->id){
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
                    <label class="form-label">Tên mục tiêu (*)</label>
                    <input required type="text" class="form-control phone-mask" name="title" id="title" value="<?php echo @$data->title;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Kiểu mục tiêu</label>
                    <div class="input-group input-group-merge">
                      <select class="form-select" name="type" id="type">
                        <option value="one" <?php if(!empty($data->type) && $data->type=='one') echo 'selected'; ?> >Thực hiện 1 lần</option>
                        <option value="multiple" <?php if(!empty($data->type) && $data->type=='multiple') echo 'selected'; ?> >Thực hiện nhiều lần</option>
                      </select>
                    </div>
                  </div>

                  
                </div>

                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Số điểm thưởng khi hoàn thành mục tiêu (*)</label>
                    <input required type="text" class="form-control" placeholder="" name="point" id="point" value="<?php echo @$data->point;?>" />
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
                </div>
                <div class="col-md-12">
                  <div class="mb-3">
                    <label class="form-label">Mô tả mục tiêu cần hoàn thành</label>
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