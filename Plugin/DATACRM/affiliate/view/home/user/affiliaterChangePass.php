<?php include(__DIR__.'/../header.php'); ?>

<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/accountStaff">Tài khoản</a> /</span>
    Đổi mật khẩu
  </h4>

  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Đổi mật khẩu</h5>
          </div>
          <div class="card-body">
            <p><?php echo $mess;?></p>
            <form enctype="multipart/form-data" method="post" action="">
              <input type="hidden" name="_csrfToken" value="<?php echo $csrfToken;?>" />
              <div class="row">
                <div class="col-md-12">
                  <div class="mb-3">
                    <label class="form-label">Mật khẩu cũ (*)</label>
                    <input required type="password" class="form-control phone-mask" name="passOld" id="passOld" value="" autocomplete="off" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Mật khẩu mới (*)</label>
                    <input required type="password" class="form-control phone-mask" name="passNew" id="passNew" value="" autocomplete="off" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Nhập lại mật khẩu mới (*)</label>
                    <input required type="password" class="form-control phone-mask" name="passAgain" id="passAgain" value="" autocomplete="off" />
                  </div>
                </div>
                
              </div>

              <button type="submit" class="btn btn-primary">Lưu</button>
            </form>
          </div>
        </div>
      </div>

    </div>
</div>

<?php include(__DIR__.'/../footer.php'); ?>