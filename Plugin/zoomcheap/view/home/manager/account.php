<?php include(__DIR__.'/../header.php'); ?>

<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/account">Tài khoản</a> /</span>
    Đổi thông tin
  </h4>

  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Đổi thông tin</h5>
          </div>
          <div class="card-body">
            <p><?php echo $mess;?></p>
            <form enctype="multipart/form-data" method="post" action="">
              <input type="hidden" name="_csrfToken" value="<?php echo $csrfToken;?>" />
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Họ tên (*)</label>
                    <input required type="text" class="form-control phone-mask" name="fullname" id="fullname" value="<?php echo @$user->fullname;?>"/>
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Email (*)</label>
                    <input required type="text" class="form-control phone-mask" name="email" id="email" value="<?php echo @$user->email;?>"/>
                  </div>
                </div>
                
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Số điện thoại (*)</label>
                    <input disabled type="text" class="form-control phone-mask" name="phone" id="phone" value="<?php echo @$user->phone;?>"/>
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Số dư tài khoản</label>
                    <input disabled type="text" class="form-control" name="coin" id="coin" value="<?php echo number_format(@$user->coin);?>"/>
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