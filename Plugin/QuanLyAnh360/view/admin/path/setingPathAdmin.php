<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Cài đặt đường đẫn</h4>

    <!-- Basic Layout -->
    <p><?php echo @$mess;?></p>
    <?= $this->Form->create(); ?>
      <div class="row">
        <div class="col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
          <div class="card mb-4">
            <div class="card-body">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">tên thư mục</label>
                  <input type="text" class="form-control" name="path" value="<?php echo @$setting['path'];?>" />
                </div>
                <button type="submit" class="btn btn-primary" style="width: 80px;">Lưu</button>
            </div>

          </div>
        </div>

       
      </div>
    <?= $this->Form->end() ?>
  </div>
