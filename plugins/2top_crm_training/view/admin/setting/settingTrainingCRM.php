<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Đào tạo</h4>

  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Cài đặt chung</h5>
          </div>
          <div class="card-body">
            <p><?php echo $mess;?></p>
            <?= $this->Form->create(); ?>
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Logo (*)</label>
                    <?php showUploadFile('logo','logo', @$data_value['logo'],0);?>
                  </div>

                  <div class="mb-3">
                    <label class="form-label">ID Block (smax.bot)</label>
                    <input type="text" class="form-control phone-mask" name="idBlock" id="idBlock" value="<?php echo @$data_value['idBlock'];?>" />
                  </div>

                </div>

                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">ID Bot (smax.bot)</label>
                    <input type="text" class="form-control phone-mask" name="idBot" id="idBot" value="<?php echo @$data_value['idBot'];?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Token Bot (smax.bot)</label>
                    <input type="text" class="form-control phone-mask" name="tokenBot" id="tokenBot" value="<?php echo @$data_value['tokenBot'];?>" />
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