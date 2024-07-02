<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Cài đặt thông số</h4>

    <!-- Basic Layout -->
    <p><?php echo @$mess;?></p>
    <?= $this->Form->create(); ?>
          <div class="card mb-4">
            <div class="card-body row">
                <div class="mb-3 col-md-6">
                  <label class="form-label" for="basic-default-fullname">Phần trăm cọc</label>
                  <input type="number" class="form-control" name="pilePercentage" value="<?php echo @$setting['pilePercentage'];?>" />
                </div>
                <div class="mb-3 col-md-6">
                  <label class="form-label" for="basic-default-fullname">chuyến tối đa</label>
                  <input type="number" class="form-control" name="maximumTrip" value="<?php echo @$setting['maximumTrip'];?>" />
                </div>
                <div class="mb-3 col-md-6">
                  <label class="form-label" for="basic-default-fullname">Số tiền nâng cấp lên tài xế</label>
                  <input type="number" class="form-control" name="moneyUpgradeToDriver" value="<?php echo @$setting['moneyUpgradeToDriver'];?>" />
                </div> 
                <div class="mb-3 col-md-6">
                  <label class="form-label" for="basic-default-fullname">Nội dung thanh toán nâng cấp lên tài xế</label>
                  <input type="number" class="form-control" name="contentUpgradeToDriver" value="<?php echo @$setting['contentUpgradeToDriver'];?>" />
                </div>
                <button type="submit" class="btn btn-primary" style="width: 80px;">Lưu</button>
            </div>


       
      </div>
    <?= $this->Form->end() ?>
  </div>
