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

    <div class="col-lg-5 col-md-5 order-1 mb-4">
      <div class="card">
        <div class="card-body">
          <span class="fw-semibold d-block mb-1">Thống kê hôm nay </span>
          <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
            <div class="me-2">
              <p class="mb-1">Số đơn sản phẩm: <strong><?php echo @$totalOrderproduct; ?></strong><span class="text-muted"> đơn</span></p>
            </div>

             <div class="me-2">
              <p class="mb-1">Số dịch vụ: <strong><?php echo @$totalOrderService; ?></strong><span class="text-muted"> đơn</span></p>
            </div>

            <div class="me-2">
              <p class="mb-1">Số Combo: <strong><?php echo @$totalOrderCombo; ?></strong><span class="text-muted"> đơn</span></p>
            </div>

            <div class="me-2">
              <p class="mb-1">Số khách đặt lịch hẹn: <strong><?php echo @$totalbook; ?></strong><span class="text-muted"> đơn</span></p>
            </div>
          </div>

        </div>
      </div>
    </div>
        
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

     <div class="col-lg-7 mb-4 order-0 mb-4">
      <div class="card h-100">
        <div class="card-header d-flex align-items-center justify-content-between">
          <h5 class="card-title m-0 me-2">Doanh thu theo tháng là: <span style="color: red;"><?php echo number_format($total); ?>đ</span></h5>
        </div>
        <div class="card-body">
           <div id="order_chart" style="width: 100%; height: 500px; background: white;"></div>
        </div>
      </div>
    </div> 

     <div class="col-md-5 col-lg-5 order-2 mb-4">
      <div class="card h-100">
        <div class="card-header d-flex align-items-center justify-content-between">
          <h5 class="card-title m-0 me-2">Khách đặt lịch hẹn</h5>
        </div>
        <div class="card-body">
          <table class="table table-bordered">
          <thead>
            <tr class="">
              <th>Thời gian</th>
              <th>Khách hàng</th>
              <th>Dịch vụ</th>
              <th>Trạng thái</th>
            </tr>
          </thead>
          <tbody>
            <?php 
              if(!empty($listBooking)){
                foreach ($listBooking as $item) {
                  $arr = explode(',', @$item->type);
                  $type = [];
                  if(!empty($item->type1)){
                    $type[] = 'Lịch tư vấn';
                  }

                  if(!empty($item->type2)){
                    $type[] = 'Lịch chăm sóc';
                  }

                  if(!empty($item->type3)){
                    $type[] = 'Lịch liệu trình';
                  }

                  if(!empty($item->type4)){
                    $type[] = 'Lịch điều trị';
                  }

                  if($item->status==0){
                    $status= 'Chưa xác nhận';
                  }elseif($item->status==1){
                    $status= 'Xác nhận';
                  }elseif($item->status==2){
                    $status= 'Không đến';
                  }elseif($item->status==3){
                    $status= 'Đã đến';
                  }elseif($item->status==4){
                    $status= 'Hủy lịch';
                  }

                  $repeat_book = [date("d/m/Y H:i", $item->time_book)];
                  if(!empty($item->repeat_book)){
                    $time_book = $item->time_book;
                    for($i=1;$i<$item->apt_times;$i++){
                      $time_book += $item->apt_step*24*60*60;
                      $repeat_book[] = date("d/m/Y H:i", $time_book);
                    }
                  }

                  echo '<tr>
                          <td>'.implode('<br/>', $repeat_book).'</td>
                          <td>'.$item->name.'<br/>
                              '.$item->phone.'
                            </td>
                          <td>'.$item->Services['name'].'</td>
                          <td>'.$status.'</td>
                        </tr>';
                }
              }else{
                echo '<tr>
                        <td colspan="10" align="center">Chưa có lịch hẹn</td>
                      </tr>';
              }
            ?>
          </tbody>
        </table>
        </div>
      </div>
    </div> 
    <!--/ Transactions -->
  </div>
</div>

<center>
<div class="taovien" >
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        var char3= google;

        char3.charts.load('current', {'packages':['corechart', 'line']});
        char3.charts.setOnLoadCallback(drawChartOrder);

        function drawChartOrder() {
            var data = google.visualization.arrayToDataTable([
              ['Ngày', ''],
              <?php 
                    if(!empty(@$dayDataBill) ){
                        foreach($dayDataBill as $date=>$number){
                                echo '["'.date('d',$number["time"]).'",'.$number["value"].'],';
                        }
                    }else{

                        echo '["0",0],';
                    }
              ?>
            ]);

            var options = {
                chart: {
                  title: 'Tổng doanh thu',
                },
              //  width: '100%',
                height: 500,  
            };


            // var chart = new google.visualization.LineChart(document.getElementById('order_chart'));
             var chart = new google.charts.Line(document.getElementById('order_chart'));

            chart.draw(data, options);
        }

        
    </script>

   
</div>
</center>
<!-- / Content -->
<?php include(__DIR__.'/footer.php'); ?>