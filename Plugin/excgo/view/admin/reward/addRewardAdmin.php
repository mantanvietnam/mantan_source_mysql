<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/excgo-view-admin-reward-listRewardAdmin">Phần thưởng</a> /</span>
    Thông tin phần thưởng
  </h4>
  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin  mã phần thưởng</h5>
          </div>
          <div class="card-body">
            <p><?php echo @$mess;?></p>

            <?= $this->Form->create(); ?>
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Tên phần thưởng (*)</label>
                    <input required type="text" class="form-control phone-mask" name="name" id="name" value="<?php echo @$data->name;?>" />
                  </div>
                  
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Ngày bắt đầu </label>
                    <input type="text"  class="form-control datepicker" placeholder="" name="start_day" id="start_date" value="<?php if(!empty($data->start_date)){  echo @$data->start_date->format('d/m/Y');}?>" />
                  </div>
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Tiền thưởng (*)</label>
                    <input type="number"  class="form-control" placeholder="" name="money" id="money" value="<?php echo @$data->money;?>" />
                  </div>
                  <div class="mb-3">
                      <label class="form-label" for="basic-default-fullname">Trạng thái:</label>&ensp;
                      <input type="radio" name="status" class="" id="status" value="1" <?php if(@ $data['status']==1) echo 'checked="checked"';   ?> > Kích hoạt &ensp;
                      <input type="radio" name="status" class="" id="status" value="0" <?php if(@ $data['status']==0) echo 'checked="checked"';   ?> > khóa
                  </div>         
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Số lượng cuốc thành công (*)</label>
                    <input type="number"  class="form-control" placeholder="" name="quantity_booking" id="quantity_booking" value="<?php echo @$data->quantity_booking;?>" />
                  </div>
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Ngày Kết túc</label>
                    <input type="text"  class="form-control datepicker" placeholder="" name="end_date" id="end_date" value="<?php if(!empty($data->end_date)){  echo @$data->end_date->format('d/m/Y');}?>" />
                  </div>
                   
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">nội dung</label>
                    <input type="text" class="form-control" placeholder="" name="note" id="note" value="<?php echo @$data->note;?>" />
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