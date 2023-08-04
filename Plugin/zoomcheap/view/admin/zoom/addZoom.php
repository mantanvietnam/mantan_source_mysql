<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/student-view-admin-student-listStudent.php">Tài khoản zoom</a> /</span>
    Thông tin tài khoản zoom
  </h4>
  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin tài khoản zoom</h5>
          </div>
          <div class="card-body">
            <p><?php echo $mess;?></p>
            <?= $this->Form->create(); ?>
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Trạng thái</label>
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
                    <label class="form-label" for="basic-default-phone">Tài khoản (*)</label>
                    <input required type="email" class="form-control phone-mask" name="user" id="user" value="<?php echo @$data->user;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Password (*)</label>
                    <input required type="text" class="form-control phone-mask" name="pass" id="pass" value="<?php echo @$data->pass;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Key host (*)</label>
                    <input required type="text" class="form-control phone-mask" name="key_host" id="key_host" value="<?php echo @$data->key_host;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Trạng thái</label>
                    <div class="input-group input-group-merge">
                      <select class="form-select" name="status" id="status">
                        <option value="active" <?php if(!empty($data->status) && $data->status=='active') echo 'selected'; ?> >Kích hoạt</option>
                        <option value="lock" <?php if(!empty($data->status) && $data->status=='lock') echo 'selected'; ?> >Khóa</option>
                      </select>
                    </div>
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Client id (*)</label>
                    <input required type="text" class="form-control phone-mask" name="client_id" id="client_id" value="<?php echo @$data->client_id;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Client secret (*)</label>
                    <input required type="text" class="form-control phone-mask" name="client_secret" id="client_secret" value="<?php echo @$data->client_secret;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Account id (*)</label>
                    <input required type="text" class="form-control phone-mask" name="account_id" id="account_id" value="<?php echo @$data->account_id;?>" />
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