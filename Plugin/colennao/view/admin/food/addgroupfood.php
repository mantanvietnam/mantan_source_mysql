
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/colennao-view-admin-food-listgroupfood">danh sách food</a> /</span>
    Thông tin food
  </h4>

  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin food</h5>
          </div>
          <div class="card-body">
            <p><?php echo $mess;?></p>
            <?= $this->Form->create(); ?>
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Tên food (*)</label>
                    <input required type="text" class="form-control phone-mask" name="name" id="name" value="<?php echo @$data->name;?>" />
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Tên food tiếng anh</label>
                    <input  type="text" class="form-control phone-mask" name="nameen" id="nameen" value="<?php echo @$data->nameen;?>" />
                  </div>
                  <div class="mb-3">
                      <label class="form-label">Số lượng ngày</label>
                      <input  type="text" class="form-control phone-mask" name="month" id="month" value="<?php echo @$data->month;?>" />
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Thời gian kết thúc</label>
                    <input type="datetime-local" class="form-control" name="timestart" id="timestart" value="<?php echo isset($data->timestart) ? date('Y-m-d\TH:i', $data->timestart) : ''; ?>" />
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Thời gian hiện tại</label>
                    <input type="datetime-local" class="form-control" name="timenow" id="timenow" value="<?php echo isset($data->timenow) ? date('Y-m-d\TH:i', $data->timenow) : ''; ?>" />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Ảnh minh họa</label>
                    <?php showUploadFile('image','image',@$data->image,0);?>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">icon</label>
                    <?php showUploadFile('icon','icon',@$data->icon,1);?>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Mô tả ngắn</label>
                    <textarea maxlength="160" rows="5" class="form-control" name="description" id="description"><?php echo @$data->description;?></textarea>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Mô tả ngắn tiếng anh</label>
                    <textarea maxlength="160" rows="5" class="form-control" name="contenten" id="contenten"><?php echo @$data->contenten;?></textarea>
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