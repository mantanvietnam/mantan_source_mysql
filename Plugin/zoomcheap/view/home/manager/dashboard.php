<?php include(__DIR__.'/../header.php'); ?>
<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="row">
    <div class="col-lg-7 mb-4 order-0">
      <div class="card">
        <div class="d-flex align-items-end row">
          <div class="col-sm-7">
            <div class="card-body">
              <h5 class="card-title text-primary">Xin chào <?php echo $session->read('infoUser')->name;?>! 🎉</h5>
              <p class="mb-4">
                Chào mừng bạn quay trở lại với hệ thống Zoom Cheap.
              </p>

              <a href="/addOrder" class="btn btn-sm btn-outline-primary">Tạo đơn thuê Zoom mới</a>
            </div>
          </div>
          <div class="col-sm-5 text-center text-sm-left">
            <div class="card-body pb-0 px-0 px-md-4">
              <img
                src="/plugins/zoomcheap/view/home/assets/img/illustrations/man-with-laptop-light.png"
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
    <div class="col-lg-5 col-md-5 order-1">
      <div class="row">
        <div class="col-lg-6 col-md-12 col-6 mb-4">
          <div class="card">
            <div class="card-body">
              <div class="card-title d-flex align-items-start justify-content-between">
                <div class="avatar flex-shrink-0">
                  <img
                    src="/plugins/zoomcheap/view/home/assets/img/icons/unicons/chart-success.png"
                    alt="chart success"
                    class="rounded"
                  />
                </div>
              </div>
              <span class="fw-semibold d-block mb-1">Số dư tài khoản</span>
              <h3 class="card-title mb-2"><?php echo number_format($session->read('infoUser')->coin);?>đ</h3>
              <?php 
                /*
                $hieu = $countProductOld - $countProductNew;

                if($hieu > 0){
                  echo '<small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +'.$hieu.' mẫu</small>';
                }elseif($hieu < 0){
                  echo '<small class="text-danger fw-semibold"><i class="bx bx-down-arrow-alt"></i> -'.$hieu.' mẫu</small>';
                }
                */
              ?>
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-md-12 col-6 mb-4">
          <div class="card">
            <div class="card-body">
              <div class="card-title d-flex align-items-start justify-content-between">
                <div class="avatar flex-shrink-0">
                  <img
                    src="/plugins/zoomcheap/view/home/assets/img/icons/unicons/wallet-info.png"
                    alt="Credit Card"
                    class="rounded"
                  />
                </div>
              </div>
              <span>Tổng tiền đã nạp</span>
              <h3 class="card-title text-nowrap mb-1"><?php echo number_format($allMoneyPlus);?>đ</h3>
              <?php 
                /*
                $hieu = $countOrderOld - $countOrderNew;

                if($hieu > 0){
                  echo '<small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +'.$hieu.'đ</small>';
                }elseif($hieu < 0){
                  echo '<small class="text-danger fw-semibold"><i class="bx bx-down-arrow-alt"></i> -'.$hieu.'đ</small>';
                }
                */
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
</div>
<!-- / Content -->
<?php include(__DIR__.'/../footer.php'); ?>