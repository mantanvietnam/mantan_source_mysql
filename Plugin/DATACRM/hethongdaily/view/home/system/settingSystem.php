<?php include(__DIR__.'/../header.php'); ?>

<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/settingSystem">Hệ thống</a> /</span>
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
                    <label class="form-label">Tên hệ thống (*)</label>
                    <input required type="text" class="form-control phone-mask" name="name" id="name" value="<?php echo @$data->name;?>"/>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Logo (*)</label>
                    <?php showUploadFile('image','image',@$data->image,0);?>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Yêu cầu xác thực OTP</label>
                    <select class="form-select color-dropdown" name="keyword" id="keyword">
                      <option value="">Cần xác thực</option>
                      <option value="1" <?php if(!empty($data->keyword)) echo 'selected';?> >Không xác thực</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Đổi điểm hạng thành viên </label>
                    <input  type="text" class="form-control phone-mask" name="convertPoint" id="convertPoint" value="<?php echo @$data->convertPoint;?>"/>
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