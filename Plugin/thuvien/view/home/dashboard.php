<?php include(__DIR__.'/header.php'); ?>
<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="row">
    <div class="col-lg-7 mb-4 order-0">
      <div class="card">
        <div class="d-flex align-items-end row">
          <div class="col-sm-7">
            <div class="card-body">
              <h5 class="card-title text-primary">Xin chào <?php echo $session->read('infoUser')->name;?> 🎉</h5>
              <p class="mb-4">
                Chào mừng bạn quay trở lại với phần mềm quản lý thư viện.
              </p>

              <!-- <a href="/addProduct" class="btn btn-sm btn-outline-primary">Tạo mẫu thiết kế mới</a> -->
            </div>
          </div>
          <div class="col-sm-5 text-center text-sm-left">
            <div class="card-body pb-0 px-0 px-md-4">
              <img src="/plugins/thuvien/view/home/assets/img/illustrations/man-with-laptop-light.png" height="140" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
</div>

<!-- / Content -->

<?php include(__DIR__.'/footer.php'); ?>