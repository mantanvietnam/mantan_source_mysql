<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/student-view-admin-student-listStudent.php">Sinh viên</a> /</span>
    Thông tin sinh viên
  </h4>
  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin sinh viên</h5>
          </div>
          <div class="card-body">
            <p><?php echo $mess;?></p>
            <?= $this->Form->create(); ?>
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Loại tài khoản (*)</label>
                    <input required type="text" class="form-control phone-mask" name="type" id="type" value="<?php echo @$data->type;?>" />
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
                    <label class="form-label" for="basic-default-phone">Modified (*)</label>
                    <input required type="text" class="form-control phone-mask" name="modified" id="modified" value="<?php echo @$data->modified;?>" />
                  </div>
                  
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Created (*)</label>
                    <input required type="text" class="form-control phone-mask" name="created" id="created" value="<?php echo @$data->created;?>" />
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