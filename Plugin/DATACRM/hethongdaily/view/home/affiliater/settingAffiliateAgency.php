<?php include(__DIR__.'/../header.php'); ?>
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

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Hoa hồng cấp 3 (Tính theo %)</label>
                    <input type="text" autocomplete="off" class="form-control" placeholder="" name="percent3" id="percent3" value="<?php echo (double) @$setting['percent3'];?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Hoa hồng cấp 4 (Tính theo %)</label>
                    <input type="text" autocomplete="off" class="form-control" placeholder="" name="percent4" id="percent4" value="<?php echo (double) @$setting['percent4'];?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Hoa hồng cấp 5 (Tính theo %)</label>
                    <input type="text" autocomplete="off" class="form-control" placeholder="" name="percent5" id="percent5" value="<?php echo (double) @$setting['percent5'];?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Hoa hồng cấp 6 (Tính theo %)</label>
                    <input type="text" autocomplete="off" class="form-control" placeholder="" name="percent6" id="percent6" value="<?php echo (double) @$setting['percent6'];?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Hoa hồng cấp 7 (Tính theo %)</label>
                    <input type="text" autocomplete="off" class="form-control" placeholder="" name="percent7" id="percent7" value="<?php echo (double) @$setting['percent7'];?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Hoa hồng cấp 8 (Tính theo %)</label>
                    <input type="text" autocomplete="off" class="form-control" placeholder="" name="percent8" id="percent8" value="<?php echo (double) @$setting['percent8'];?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Hoa hồng cấp 9 (Tính theo %)</label>
                    <input type="text" autocomplete="off" class="form-control" placeholder="" name="percent9" id="percent9" value="<?php echo (double) @$setting['percent9'];?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Hoa hồng cấp 10 (Tính theo %)</label>
                    <input type="text" autocomplete="off" class="form-control" placeholder="" name="percent10" id="percent10" value="<?php echo (double) @$setting['percent10'];?>" />
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
<?php include(__DIR__.'/../footer.php'); ?>