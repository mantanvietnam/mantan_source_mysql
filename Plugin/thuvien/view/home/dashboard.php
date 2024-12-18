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
    <div class="col-lg-5 mb-4 order-0">
      <div class="card">
        <div class="card-body">
          <p class="mb-4">danh sách mượn sách hôm này </p>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Tên khách hàng</th>
                <th>Ngày mượn</th>
                <th>Ngày trả</th>
                <th>Trạng thái</th>
              </tr>
            </thead>
            <tbody>
              <tbody>
                <?php 
                if (!empty($dataCreated)) {
                  foreach ($dataCreated as $order) {
                    $status = 'đang mượn';
                    if($order->status==2){
                      $status = 'đã trả';
                    }
                    echo '<tr>
                    <td>' . ($order->customer->name ?? 'N/A') . '</br>
                    ' . ($order->customer->phone ?? 'N/A') . '</td>
                    <td>' . date('d-m-Y H:i:s', $order->created_at) . '</td>
                    <td>' . date('d-m-Y H:i:s', $order->return_deadline) . '</td>
                    <td>' .$status. '</td>


                    </tr>';
                  }
                } else {
                  echo '<tr>
                  <td colspan="4" align="center">Chưa có dữ liệu</td>
                  </tr>';
                }
                ?>
              </tbody>
            </table>
          </div>
          <div class="card-body">
          <p class="mb-4">danh sách đến hạn trả sách</p>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Tên khách hàng</th>
                <th>Ngày mượn</th>
                <th>Ngày trả</th>
                <th>Trạng thái</th>
              </tr>
            </thead>
            <tbody>
              <tbody>
                <?php 
                if (!empty($dataDeadline)) {
                  foreach ($dataDeadline as $order) {
                    $status = 'đang mượn';
                    if($order->status==2){
                      $status = 'đã trả';
                    }
                    echo '<tr>
                    <td>' . ($order->customer->name ?? 'N/A') . '</br>
                    ' . ($order->customer->phone ?? 'N/A') . '</td>
                    <td>' . date('d-m-Y H:i:s', $order->created_at) . '</td>
                    <td>' . date('d-m-Y H:i:s', $order->return_deadline) . '</td>
                    <td>' .$status. '</td>


                    </tr>';
                  }
                } else {
                  echo '<tr>
                  <td colspan="4" align="center">Chưa có dữ liệu</td>
                  </tr>';
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- / Content -->

<?php include(__DIR__.'/footer.php'); ?>