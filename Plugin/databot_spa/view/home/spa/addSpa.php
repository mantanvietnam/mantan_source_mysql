<?php include(__DIR__.'/../header.php'); ?>

<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/listSpa">Cơ sở Spa </a> /</span>
    Thông tin cơ sở Spa
  </h4>
  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin cơ sở Spa</h5>
          </div>
          <div class="card-body">
            <p><?php echo @$mess;?></p>
            <form enctype="multipart/form-data" method="post" action="">
              <input type="hidden" name="_csrfToken" value="<?php echo $csrfToken;?>" />
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Tên cơ sở (*)</label>
                    <input required type="text" class="form-control phone-mask" name="name" id="name" value="<?php echo @$data->name; ?>" />
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Email (*)</label>
                     <input required type="text" class="form-control phone-mask" name="email" id="email" value="<?php echo @$data->email; ?>" />
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Địa chỉ  (*)</label>
                     <input required type="text" class="form-control phone-mask" name="address" id="address" value="<?php echo @$data->address; ?>" />
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Facebook</label>
                    <input type="text" class="form-control phone-mask" name="facebook" id="facebook" value="<?php echo @$data->facebook; ?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Zalo</label>
                    <input type="text" class="form-control phone-mask" name="zalo" id="zalo" value="<?php echo @$data->zalo; ?>" />
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Số điện thoại (*)</label>
                    <input required type="text" class="form-control phone-mask" name="phone" id="phone" value="<?php echo @$data->phone; ?>" />
                  </div>
                  
                  <div class="mb-3">
                    <label class="form-label">Hình đại diện cơ sỏ</label>
                    <?php showUploadFile('image','image',@$data->image,0);?>
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Website</label>
                    <input type="text" class="form-control phone-mask" name="website" id="website" value="<?php echo @$data->website; ?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Mô tả</label>
                    <textarea class="form-control" rows="3" name="note"><?php echo @$data->note; ?></textarea>
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