<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/admins/changePass">Tài khoản</a> /</span>
    Đổi mật khẩu
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
                  <label class="form-label">Mật khẩu cũ *</label>
                  <input type="password" class="form-control" name="passOld" value="" autocomplete="no" required />
                </div>

                <div class="mb-3">
                  <label class="form-label">Mật khẩu mới *</label>
                  <input type="password" class="form-control" name="passNew" value="" autocomplete="no" required />
                </div>

                <div class="mb-3">
                  <label class="form-label">Nhập lại mật khẩu mới *</label>
                  <input type="password" class="form-control" name="passAgain" value="" autocomplete="no" required />
                </div>
              </div>
            </div>
            <button type="submit" class="btn btn-primary">Đổi mật khẩu</button>
          <?= $this->Form->end() ?>
        </div>
      </div>
    </div>
  </div>
</div>