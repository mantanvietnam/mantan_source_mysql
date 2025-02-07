<?php include(__DIR__.'/../header.php'); ?>
<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/listPrepayCard">Loại thẻ trả trước</a> /</span>
    Thông tin loại thẻ
  </h4>

  
  <!-- Basic Layout -->
    <?= $this->Form->create(); ?>
      <div class="row">
        <div class="col-xl">
          <div class="card mb-12">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Thông tin loại thẻ trả trước</h5>
            </div>
            <div class="card-body">
              <p><?php echo @$mess;?></p>
              
                <div class="row">
                  <div class="col-md-6">
                    <div class="mb-3">
                      <label class="form-label" for="basic-default-phone">Tên thẻ (*)</label>
                      <input required type="text" class="form-control phone-mask" name="name" id="name" value="<?php echo @$data->name;?>" />
                    </div>

                    <div class="mb-3">
                      <label class="form-label" for="basic-default-fullname">Mệnh giá sử dụng(*)</label>
                     <input type="number" required class="form-control" placeholder="Nhập giá" name="price_sell" id="price_sell" value="<?php echo @$data->price_sell;?>" />
                    </div>

                    <div class="mb-3">
                      <label class="form-label" for="basic-default-fullname">Giá bán (*)</label>
                      
                       <input type="number" required class="form-control" placeholder="" name="price" id="price" value="<?php echo @$data->price;?>" />
                    </div>
                    
                    <div class="mb-3">
                      <label class="form-label" for="basic-default-email">Trạng thái</label>
                      <div class="input-group input-group-merge">
                        <input type="radio" name="status" class="" id="status" value="active" <?php if(empty($data['status']) || $data['status']=='active') echo 'checked="checked"';   ?> >&nbsp; Kích hoạt &nbsp;
                        <input type="radio" name="status" class="" id="status" value="lock" <?php if(@ $data['status']=='lock') echo 'checked="checked"';   ?> >&nbsp; Khóa
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="mb-3">
                      <label class="form-label" for="basic-default-fullname">Thời gian sử dụng (ngày)</label>
                      <input type="number" autocomplete="off" class="form-control" placeholder="" name="use_time" id="use_time" value="<?php echo @$data->use_time;?>" />
                    </div>

                    <div class="mb-3">
                      <label class="form-label">Mô tả thẻ</label>
                      <textarea class="form-control phone-mask" rows="5" name="note"><?php echo @$data->note;?></textarea>
                    </div>
                  </div>
                </div>
            </div>

            <hr/>
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Hoa hồng cho nhân viên bán thẻ trả trước</h5>
            </div>

            <div class="card-body">
              <div class="row">
                <p class="text-danger">Hệ thống sẽ ưu tiên tính tiền cố định trước rồi mới đến tính theo hoa hồng</p>
                <div class="col-md-6">
                    <div class="mb-3">
                      <label class="form-label">Trả số tiền cố định</label>
                      <input type="number" min="0" class="form-control phone-mask" name="commission_staff_fix" id="commission_staff_fix" value="<?php echo @$data->commission_staff_fix;?>"/>
                      
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                      <label class="form-label">Trả theo %</label>
                      <input type="number" min="0" max="100" class="form-control phone-mask" name="commission_staff_percent" id="commission_staff_percent" value="<?php echo @$data->commission_staff_percent;?>"/>
                    </div>
                </div>
              </div>
              <button type="submit" class="btn btn-primary">Lưu</button> 
            </div>
          </div>
        </div>

      </div>

    <?= $this->Form->end() ?>
</div>

<?php include(__DIR__.'/../footer.php'); ?>