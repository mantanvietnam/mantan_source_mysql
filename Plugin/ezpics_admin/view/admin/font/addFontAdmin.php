<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/ezpics_admin-view-admin-member-listMemberAdmin">Font chữ</a> /</span>
    Thông tin font chữ
  </h4>

  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin  font chữ</h5>
          </div>
          <div class="card-body">
            <p><?php echo @$mess;?></p>
            <?= $this->Form->create(); ?>
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Tên font (*)</label>
                    <input required type="text" class="form-control phone-mask" name="name" id="name" value="<?php echo @$data->name;?>" />
                  </div>
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">display</label>
                    <input type="text" required class="form-control" placeholder="" name="display" id="display" value="<?php echo @$data->display;?>" />
                  </div> 
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">font</label>
                    <?php showUploadFile('font','font',@$data->font,0);?>
                  </div>             
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">weight</label>
                    <input type="text" autocomplete="off" class="form-control" placeholder="" name="weight" id="weight" value="<?php echo @$data->weight;?>" />
                  </div>
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">style</label>
                    <input type="text" class="form-control" placeholder="" name="style" id="style" value="<?php echo @$data->style;?>" />
                  </div>
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">font woff</label>
                    <?php showUploadFile('font_woff2','font_woff2',@$data->font_woff2,1);?>
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