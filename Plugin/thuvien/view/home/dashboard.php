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
      <div class="card mt-3">
          <div class="card-header text-center">
              <h5>10 quyển sách mượn nhiều nhất</h5>
          </div>
          <div class="card-body">
              <!-- Biểu đồ -->
              <canvas id="borrowChart" width="400" height="200"></canvas>
          </div>
      </div>
    </div>
    <div class="col-lg-5 mb-4 order-0">
      <div class="card">
        <div class="card-body">
          <h5 class="mb-4">Danh sách mượn sách hôm nay </h5>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Tên khách hàng</th>
                <th>sach</th>
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
                    $book = '';
                    if(!empty($order->orderDetail)){ 
                        foreach($order->orderDetail as $k => $value){
                              $book .= $value->book->name.'('.number_format($value->quantity).'), &nbsp';
                        }
                      } 
                    echo '<tr>
                    <td>' . ($order->customer->name ?? 'N/A') . '</br>
                    ' . ($order->customer->phone ?? 'N/A') . '</td>
                    <td>' . $book. '</td>
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
          <h5 class="mb-4">Danh sách khách quá hẹn trả sách</h5>
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

<!-- / Content -->

<?php include(__DIR__.'/footer.php'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>

var bookNames = <?php echo $chartBookNames; ?>; 
var borrowCounts = <?php echo $chartBorrowCounts; ?>; 

var ctx = document.getElementById('borrowChart').getContext('2d');
var borrowChart = new Chart(ctx, {
    type: 'bar',  
    data: {
        labels: bookNames,  
        datasets: [{
            label: 'Số lần mượn',
            data: borrowCounts,  
            backgroundColor: 'rgba(75, 192, 192, 0.2)',  
            borderColor: 'rgb(75, 192, 192)',  
            borderWidth: 1,  
        }]
    },
    options: {
        responsive: true,
        scales: {
            x: {
                title: {
                    display: true,
                    text: 'Tên Sách'  
                }
            },
            y: {
                title: {
                    display: true,
                    text: 'Số lần mượn'  
                },
                beginAtZero: true  
            }
        }
    }
});
</script>