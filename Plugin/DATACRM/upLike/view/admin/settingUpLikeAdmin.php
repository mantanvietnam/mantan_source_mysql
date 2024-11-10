<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/upLike-view-admin-settingUpLikeAdmin">Tăng tương tác</a> /</span>
    Cài đặt
  </h4>

  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Cài đặt</h5>
          </div>
          <div class="card-body">
            <p><?php echo $mess;?></p>
            <?= $this->Form->create(); ?>
            
            <div class="row">
              <div class="col-md-12">
                
                <div class="mb-3">
                  <label class="form-label" for="basic-default-phone">Token Ông Trùm</label>
                  <input required type="text" class="form-control phone-mask" name="tokenOngTrum" id="tokenOngTrum" value="<?php echo @$data['tokenOngTrum'];?>" />
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-phone">Hệ số nhân giá bán</label>
                  <input required type="number" class="form-control phone-mask" name="multiplier" id="multiplier" value="<?php echo @$data['multiplier'];?>" />
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