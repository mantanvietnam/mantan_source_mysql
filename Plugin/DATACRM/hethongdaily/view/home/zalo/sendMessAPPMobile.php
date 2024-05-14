<?php include(__DIR__.'/../header.php'); ?>

<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/listSendMessAPPMobile">Thông báo APP Mobile </a> /</span>
    Gửi thông báo
  </h4>

  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Gửi thông báo trên app mobile </h5>
          </div>
          <div class="card-body">
            <p><?php echo @$mess;?></p>
            <form enctype="multipart/form-data" method="post" action="">
              <input type="hidden" name="_csrfToken" value="<?php echo $csrfToken;?>" />
              <div class="row">
                <div class="col-md-12">
                  <div class="mb-3">
                    <label class="form-label">Nội dung thông báo (*)</label>
                    <textarea class="form-control phone-mask" name="mess" rows="5"></textarea>
                  </div>
                </div>
                
              </div>

              <button type="submit" class="btn btn-primary">Gửi thông báo</button> 
            </form>
          </div>
        </div>
      </div>

    </div>
</div>

<?php include(__DIR__.'/../footer.php'); ?>