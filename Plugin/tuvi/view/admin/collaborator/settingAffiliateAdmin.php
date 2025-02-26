<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/affiliate-view-admin-affiliater-listAffiliaterAdmin">Tiếp thị liên kết</a> /</span>
    Cài đặt hoa hồng
  </h4>

  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Cài đặt hoa hồng</h5>
          </div>
          <div class="card-body">
            <p><?php echo $mess;?></p>
            <?= $this->Form->create(); ?>
              <div class="row">

                <div class="col-md-12">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Hoa hồng cấp 1 - Người giới thiệu (Tính theo %)</label>
                    <input type="text" autocomplete="off" class="form-control" placeholder="" name="percent1" id="percent1" value="<?php echo (double) @$setting['percent1'];?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Hoa hồng cấp 2 (Tính theo %)</label>
                    <input type="text" autocomplete="off" class="form-control" placeholder="" name="percent2" id="percent2" value="<?php echo (double) @$setting['percent2'];?>" />
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