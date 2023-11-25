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
                Chào mừng bạn quay trở lại với phần mềm quản lý DATA SPA.
              </p>

              <!-- <a href="/addProduct" class="btn btn-sm btn-outline-primary">Tạo mẫu thiết kế mới</a> -->
            </div>
          </div>
          <div class="col-sm-5 text-center text-sm-left">
            <div class="card-body pb-0 px-0 px-md-4">
              <img src="/plugins/databot_spa/view/home/assets/img/illustrations/man-with-laptop-light.png" height="140" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png" />
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- <div class="col-lg-5 col-md-5 order-1">
      <div class="row">
        <div class="col-lg-6 col-md-12 col-6 mb-4">
          <div class="card">
            <div class="card-body">
              <div class="card-title d-flex align-items-start justify-content-between">
                <div class="avatar flex-shrink-0">
                  <img
                    src="/plugins/ezpics_designer/view/home/assets/img/icons/unicons/chart-success.png"
                    alt="chart success"
                    class="rounded"
                  />
                </div>
              </div>
              <span class="fw-semibold d-block mb-1">Mẫu mới 7 ngày</span>
              <h3 class="card-title mb-2"><?php echo number_format($countProductNew);?> mẫu</h3>
              <?php 
                // $hieu = $countProductOld - $countProductNew;

                // if($hieu > 0){
                //   echo '<small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +'.$hieu.' mẫu</small>';
                // }elseif($hieu < 0){
                //   echo '<small class="text-danger fw-semibold"><i class="bx bx-down-arrow-alt"></i> -'.$hieu.' mẫu</small>';
                // }
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
                    src="/plugins/ezpics_designer/view/home/assets/img/icons/unicons/wallet-info.png"
                    alt="Credit Card"
                    class="rounded"
                  />
                </div>
              </div>
              <span>Doanh thu 7 ngày</span>
              <h3 class="card-title text-nowrap mb-1"><?php echo number_format($countOrderNew);?>đ</h3>
              <?php 
                $hieu = $countOrderOld - $countOrderNew;

                if($hieu > 0){
                  echo '<small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +'.$hieu.'đ</small>';
                }elseif($hieu < 0){
                  echo '<small class="text-danger fw-semibold"><i class="bx bx-down-arrow-alt"></i> -'.$hieu.'đ</small>';
                }
              ?>
            </div>
          </div>
        </div>
      </div>
    </div> -->
  </div>
  <div class="row">
    <!-- Transactions -->
   <!--  <div class="col-md-4 col-lg-4 order-2 mb-4">
      <div class="card h-100">
        <div class="card-header d-flex align-items-center justify-content-between">
          <h5 class="card-title m-0 me-2">Mẫu được xem nhiều nhất</h5>
        </div>
        <div class="card-body">
          <ul class="p-0 m-0">
            <?php 
            if(!empty($listTopView)){
              foreach ($listTopView as $key => $value) {
                echo '<li class="d-flex mb-4 pb-1">
                        <div class="avatar flex-shrink-0 me-3">
                          <img src="'.$value->image.'" class="rounded" />
                        </div>
                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                          <div class="me-2">
                            <h6 class="mb-1">'.$value->name.'</h6>
                          </div>
                          <div class="user-progress d-flex align-items-center gap-1">
                            <h6 class="mb-0">'.number_format($value->views).'</h6>
                            <span class="text-muted">view</span>
                          </div>
                        </div>
                      </li>';
              }
            }else{
              echo 'Chưa có mẫu thiết kế được đăng bán';
            }
            ?>
          </ul>
        </div>
      </div>
    </div> -->

   <!--  <div class="col-md-4 col-lg-4 order-2 mb-4">
      <div class="card h-100">
        <div class="card-header d-flex align-items-center justify-content-between">
          <h5 class="card-title m-0 me-2">Mẫu được yêu thích nhất</h5>
        </div>
        <div class="card-body">
          <ul class="p-0 m-0">
            <?php 
            // if(!empty($listTopFavorite)){
            //   foreach ($listTopFavorite as $key => $value) {
            //     echo '<li class="d-flex mb-4 pb-1">
            //             <div class="avatar flex-shrink-0 me-3">
            //               <img src="'.$value->image.'" class="rounded" />
            //             </div>
            //             <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
            //               <div class="me-2">
            //                 <h6 class="mb-1">'.$value->name.'</h6>
            //               </div>
            //               <div class="user-progress d-flex align-items-center gap-1">
            //                 <h6 class="mb-0">'.number_format($value->favorites).'</h6>
            //                 <span class="text-muted">like</span>
            //               </div>
            //             </div>
            //           </li>';
            //   }
            // }else{
            //   echo 'Chưa có mẫu thiết kế được đăng bán';
            // }
            ?> 
          </ul>
        </div>
      </div>
    </div> -->

   <!--  <div class="col-md-4 col-lg-4 order-2 mb-4">
      <div class="card h-100">
        <div class="card-header d-flex align-items-center justify-content-between">
          <h5 class="card-title m-0 me-2">Mẫu bán nhiều nhất</h5>
        </div>
        <div class="card-body">
          <ul class="p-0 m-0">
            <?php 
            if(!empty($listTopSell)){
              foreach ($listTopSell as $key => $value) {
                echo '<li class="d-flex mb-4 pb-1">
                        <div class="avatar flex-shrink-0 me-3">
                          <img src="'.$value->image.'" class="rounded" />
                        </div>
                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                          <div class="me-2">
                            <h6 class="mb-1">'.$value->name.'</h6>
                          </div>
                          <div class="user-progress d-flex align-items-center gap-1">
                            <h6 class="mb-0">'.number_format($value->sold).'</h6>
                            <span class="text-muted">lần</span>
                          </div>
                        </div>
                      </li>';
              }
            }else{
              echo 'Chưa có mẫu thiết kế được đăng bán';
            }
            ?>
          </ul>
        </div>
      </div>
    </div> -->
    <!--/ Transactions -->
  </div>
</div>
<!-- / Content -->
<?php include(__DIR__.'/footer.php'); ?>