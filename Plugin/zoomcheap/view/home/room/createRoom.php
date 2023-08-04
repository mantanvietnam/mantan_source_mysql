<?php include(__DIR__.'/../header.php'); ?>

<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/listOrder">Thuê Zoom</a> /</span>
    Tạo phòng họp
  </h4>
  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Tạo phòng họp mới</h5>
          </div>
          <div class="card-body">
            <p><?php echo $mess;?></p>
            <form enctype="multipart/form-data" method="post" action="">
              <input type="hidden" name="_csrfToken" value="<?php echo $csrfToken;?>" />
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Tên phòng họp</label>
                    <input type="text" class="form-control" required name="topic" value="<?php echo 'Phòng họp của '.$session->read('infoUser')->fullname;?>">
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Mật khẩu</label>
                    <input type="text" class="form-control" required name="pass" value="<?php echo rand(100000,999999);?>">
                  </div>
                  
                </div>

                <div class="col-md-6">
                  
                  <div class="mb-3">
                    <label class="form-label">Thời gian mở phòng</label>
                    <input type="text" class="form-control" required name="start_time" value="<?php echo date('H:i d/m/Y');?>">
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Yêu cầu nhập mật khẩu vào phòng</label><br/>
                    <input type="radio" name="input_pass" value="1" checked /> Bắt buộc &nbsp;&nbsp;&nbsp;
                    <input type="radio" name="input_pass" value="0" /> Không cần 
                  </div>
                  
                </div>
              </div>

              <button type="submit" class="btn btn-primary">Tạo đơn</button>
            </form>
          </div>
        </div>
      </div>

    </div>
</div>

<?php include(__DIR__.'/../footer.php'); ?>