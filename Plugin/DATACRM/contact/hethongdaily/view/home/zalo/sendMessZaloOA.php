<?php include(__DIR__.'/../header.php'); ?>

<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/setttingZaloOA">Zalo </a> /</span>
    Gửi tin nhắn Zalo OA 
  </h4>

  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Gửi tin nhắn Zalo OA </h5>
          </div>
          <div class="card-body">
            <p><?php echo @$mess;?></p>
            <form enctype="multipart/form-data" method="post" action="">
              <input type="hidden" name="_csrfToken" value="<?php echo $csrfToken;?>" />
              <div class="row">
                <div class="col-md-12">
                  <div class="mb-3">
                    <label class="form-label">Đối tượng nhận tin nhắn</label><br/>
                    <input type="checkbox" checked value="follower" name="typeUser[]"> Đã theo dõi OA 
                    <input type="checkbox" checked value="48h" name="typeUser[]"> Mới tương tác trong 48h
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Nội dung tin nhắn (*)</label>
                    <textarea class="form-control phone-mask" name="mess" rows="5"></textarea>
                  </div>
                </div>
                
              </div>

              <button type="submit" class="btn btn-primary">Gửi tin Zalo</button> 
            </form>
          </div>
        </div>
      </div>

    </div>
</div>

<?php include(__DIR__.'/../footer.php'); ?>