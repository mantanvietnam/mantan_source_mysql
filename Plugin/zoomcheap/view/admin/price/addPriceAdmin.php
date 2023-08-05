<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/zoomcheap-view-admin-price-listPriceAdmin.php">Cài đặt giá</a> /</span>
    Thông tin Cài đặt giá
  </h4>
  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin Cài đặt giá</h5>
          </div>
          <div class="card-body">
            <p><?php echo $mess;?></p>
            <?= $this->Form->create(); ?>
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Loại</label>
                    <div class="input-group input-group-merge">
                      <select class="form-select" name="type" id="type">
                        <option value="100" <?php if(!empty($data->type) && $data->type=='100') echo 'selected'; ?> >100 người dùng</option>
                        <option value="300" <?php if(!empty($data->type) && $data->type=='300') echo 'selected'; ?> >300 người dùng</option>
                        <option value="500" <?php if(!empty($data->type) && $data->type=='500') echo 'selected'; ?> >500 người dùng</option>
                        <option value="1000" <?php if(!empty($data->type) && $data->type=='1000') echo 'selected'; ?> >1000 người dùng</option>
                      </select>
                    </div>
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Giờ (*)</label>
                    <input required type="text" class="form-control phone-mask" name="hour" id="hour" value="<?php echo @$data->hour;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Giá (*)</label>
                    <input required type="text" class="form-control phone-mask" name="price" id="price" value="<?php echo @$data->price;?>" />
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