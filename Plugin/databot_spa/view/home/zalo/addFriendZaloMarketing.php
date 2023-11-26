<?php include(__DIR__.'/../header.php'); ?>

<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/settingZaloMarketing">Zalo </a> /</span>
    Kết bạn tự động 
  </h4>

  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Kết bạn tự động</h5>
          </div>
          <div class="card-body">
            <p><?php echo @$mess;?></p>
            <div class="row">
              <div class="col-md-12">
                <div class="mb-3">
                  <p>Tài khoản Zalo: <?php echo $infoZalo['name'];?></p>
                  <img src="<?php echo $infoZalo['picture']['data']['url'];?>">
                </div>
              </div>
              
            </div>
          </div>
        </div>
      </div>

    </div>
</div>

<?php include(__DIR__.'/../footer.php'); ?>