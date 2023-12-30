
<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/larksuite-settingLarkSuite">Lark Suite</a> /</span>
    Thông tin Lark Suite
  </h4>
  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin Lark Suite</h5>
          </div>
          <div class="card-body">
            <p><?php echo $mess;?></p>
            <?= $this->Form->create(); ?>
              <div class="row">
                  <div class="mb-3 col-md-6">
                    <label class="form-label" for="basic-default-phone">link get access token (*)</label>
                    <input type="text"   class="form-control"value="<?php echo @$data['get_access_token'];?>" name="get_access_token" id="get_access_token" />
                  </div>  
                  <div class="mb-3 col-md-6">
                    <label class="form-label" for="basic-default-phone">app id (*)</label>
                    <input type="text"  class="form-control" value="<?php echo @$data['app_id'];?>" name="app_id" id="app_id" />
                  </div>
                  <div class="mb-3 col-md-6">
                    <label class="form-label" for="basic-default-phone">Secret (*)</label>
                    <input type="text"  class="form-control" value="<?php echo @$data['secret'];?>" name="secret" id="secret" />
                  </div>
                   <div class="mb-3 col-md-6">
                    <label class="form-label" for="basic-default-phone">table id</label>
                    <input type="text"  class="form-control" value="<?php echo @$data['table_id'];?>" name="table_id" id="table_id" />
                  </div>
                   <div class="mb-3 col-md-6">
                    <label class="form-label" for="basic-default-phone">base id</label>
                    <input type="text"  class="form-control" value="<?php echo @$data['base_id'];?>" name="base_id" id="base_id" />
                  </div>
                 

                </div>
              <button type="submit" class="btn btn-primary">Lưu</button>
            <?= $this->Form->end() ?>
          </div>
        </div>
      </div>

    </div>
</div>