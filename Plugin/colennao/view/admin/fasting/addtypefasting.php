<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/colennao-view-admin-fasting-listfastingadmin">kế hoạch giảm cân</a> /</span>
    Thông tin kế hoạch giảm cân
  </h4>

  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin kế hoạch giảm cân</h5>
          </div>
          <div class="card-body">
            <p><?php echo $mess;?></p>
            <?= $this->Form->create(); ?>
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Tên kế hoạch giảm cân (*)</label>
                    <input required type="text" class="form-control phone-mask" name="name" id="name" value="<?php echo @$data->name;?>" />
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Thời gian bắt đầu</label>
                    <input type="datetime-local" class="form-control" name="time_start" id="time_start" value="<?php echo date('Y-m-d\TH:i', @$data->time_start); ?>" />
                </div>
                <div class="mb-3">
                    <label class="form-label">Thời gian kết thúc</label>
                    <input type="datetime-local" class="form-control" name="time_end" id="time_end" value="<?php echo date('Y-m-d\TH:i', @$data->time_end); ?>" />
                </div>
                  <div class="mb-3">
                    <label class="form-label">complete</label>
                    <input type="text" class="form-control phone-mask" name="complete" id="complete" value="<?php echo @$data->complete;?>" />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Ảnh minh họa</label>
                    <?php showUploadFile('image','image',@$data->image,0);?>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Mô tả ngắn</label>
                    <textarea maxlength="160" rows="5" class="form-control" name="description" id="description"><?php echo @$data->description;?></textarea>
                  </div>

                  <div class="mb-3">
                    <label class="form-label">method</label>
                    <input  type="text" class="form-control phone-mask" name="method" id="method" value="<?php echo @$data->method;?>" />
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