
<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/project-view-admin-library-listLibraryAdmin">Library</a> /</span>
    Thông tin Library
  </h4>
  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin Library</h5>
          </div>
          <div class="card-body">
            <p><?php echo $mess;?></p>
            <?= $this->Form->create(); ?>
              <div class="row">
                  <div class="mb-3 col-md-6">
                    <label class="form-label" for="basic-default-phone">Today (*)</label>
                    <input style="width: 300px;" type="text"   class="form-control"value="<?php echo @$data['mday'];?>" name="mday" id="mday" />
                  </div>  
                  <div class="mb-3 col-md-6">
                    <label class="form-label" for="basic-default-phone">Current month (*)</label>
                    <input style="width: 300px;" type="text"  class="form-control" value="<?php echo @$data['mon'];?>" name="mon" id="mon" />
                  </div>
                  <div class="mb-3 col-md-6">
                    <label class="form-label" for="basic-default-phone">Total hits (*)</label>
                    <input style="width: 300px;" type="text"  class="form-control" value="<?php echo @$data['total'];?>" name="total" id="total" />
                  </div>
                 

                </div>
              <button type="submit" class="btn btn-primary">Lưu</button>
            <?= $this->Form->end() ?>
          </div>
        </div>
      </div>

    </div>
</div>