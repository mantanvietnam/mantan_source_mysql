<?php
global $infoSite;
?>
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="row">
    <div class="col-lg-12 mb-4 order-0">
      <div class="card">
        <div class="d-flex align-items-end row">
          <div class="col-sm-7">
            <div class="card-body">
              <h5 class="card-title text-primary">Xin chào <b><?php echo $infoAdmin->fullName;?></b> 🎉</h5>
              <p class="mb-4">
                Chào mừng bạn đến với hệ thống quản trị của website <?php echo $infoSite['title'];?>
              </p>

              <a target="_blank" href="/" class="btn btn-sm btn-outline-primary">Xem trang web</a>
            </div>
          </div>
          <div class="col-sm-5 text-center text-sm-left">
            <div class="card-body pb-0 px-0 px-md-4">
              <img
                src="/webroot/assets_admin/img/illustrations/man-with-laptop-light.png"
                height="140"
                alt="View Badge User"
                data-app-dark-img="illustrations/man-with-laptop-dark.png"
                data-app-light-img="illustrations/man-with-laptop-light.png"
              />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>