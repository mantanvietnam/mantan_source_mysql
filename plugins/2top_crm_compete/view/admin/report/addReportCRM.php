<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Báo cáo thi đua</h4>

  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin báo cáo</h5>
          </div>
          <div class="card-body">
            <p><?php echo $mess;?></p>
            <?= $this->Form->create(); ?>
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Thời gian báo cáo (*)</label>
                    <input required type="text" class="form-control datepicker" placeholder="" name="time_report" id="time_report" value="<?php if(!empty($data->time_report)) echo date('H:i d/m/Y', $data->time_report);?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Người báo cáo (*)</label>
                    <input type="text" class="form-control" placeholder="" name="id_customer" id="id_customer" value="<?php echo @$data->id_customer;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Mục tiêu báo cáo (*)</label>
                    <input type="text" class="form-control" placeholder="" name="id_target" id="id_target" value="<?php echo @$data->id_target;?>" />
                  </div>

                  
                </div>

                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Điểm thưởng (*)</label>
                    <input type="text" class="form-control" placeholder="" name="point" id="point" value="<?php echo @$data->point;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Hình ảnh báo cáo (*)</label>
                    <?php showUploadFile('image','image',@$data->image,0);?>
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Ghi chú</label>
                    <textarea class="form-control" placeholder="" name="note" id="note"><?php echo @$data->note;?></textarea>
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