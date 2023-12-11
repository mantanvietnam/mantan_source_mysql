<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/admins/profile">Tài khoản</a> /</span>
    Thông tin tài khoản
  </h4>

  <!-- Basic Layout -->
  <div class="row">
    <div class="col-xl">
      <div class="card mb-4">
        <div class="card-body">
          <p><?php echo @$mess;?></p>
          <?= $this->Form->create(); ?>
            <div class="row">
              <div class="col-12 col-sm-12 col-md-12">
                <div class="mb-3">
                  <label class="form-label">Tài khoản</label>
                  <input type="text" class="form-control" name="user" value="<?php echo $infoAdmin->user;?>" disabled />
                </div>

                <div class="mb-3">
                  <label class="form-label">Họ tên *</label>
                  <input type="text" class="form-control" name="fullName" value="<?php echo $infoAdmin->fullName;?>" required />
                </div>

                <div class="mb-3">
                  <label class="form-label">Email</label>
                  <input type="email" class="form-control" name="email" value="<?php echo $infoAdmin->email;?>" />
                </div>
              </div>
            </div>
            <button type="submit" class="btn btn-primary">Đổi thông tin</button>
          <?= $this->Form->end() ?>
        </div>
      </div>
    </div>
  </div>
</div>