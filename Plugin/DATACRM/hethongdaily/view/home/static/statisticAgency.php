<?php include(__DIR__.'/../header.php'); ?>
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="row">
    <div class="col-lg-7 mb-4 order-0">
      <div class="card">
        <div class="d-flex align-items-end row">
          <div class="col-sm-10">
            <div class="card-body">
              <h5 class="card-title text-primary">Xin chào <?php echo $user->name;?> 🎉</h5>
              <p class="mb-4">
                Chào mừng bạn quay trở lại với phần mềm quản lý ICHAM CRM.
              </p>

              <!-- <a href="/addProduct" class="btn btn-sm btn-outline-primary">Tạo mẫu thiết kế mới</a> -->
            </div>
          </div>
          <!-- <div class="col-sm-5 text-center text-sm-left">
            <div class="card-body pb-0 px-0 px-md-4">
              <img src="<?php echo $session->read('infoUser')->avatar ?>" height="140" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png" />
            </div>
          </div> -->
        </div>
      </div>
    </div>

    <div class="col-lg-5 col-md-5 order-1 mb-4">
      <div class="card">
        <div class="card-body">
          <span class="fw-semibold d-block mb-1">Thống kê hôm nay </span>
          <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
            <div class="me-2">
              <p class="mb-1">Đơn đại lý : <strong><?php echo @$totalDataOrderMembers; ?></strong><span class="text-muted"> đơn</span></p>
            </div>

            <div class="me-2">
              <p class="mb-1">Đơn khách lẻ: <strong><?php echo @$totalDataOrder; ?></strong><span class="text-muted"> đơn</span></p>
            </div>

            <div class="me-2">
              <p class="mb-1">Khách mới : <strong><?php echo @$totalDataCustomer; ?></strong><span class="text-muted"> khách</span></p>
            </div>

            <!-- <div class="me-2">
              <p class="mb-1">Số khách đặt lịch hẹn: <strong><?php echo @$totalbook; ?></strong><span class="text-muted"> đơn</span></p>
            </div> -->
          </div>

        </div>
      </div>
    </div>

  </div>
  <div class="row">
    <!-- Transactions -->


    <div class="col-lg-7 mb-4 order-0 mb-4">
      <div class="card h-100">
        <div class="card-header d-flex align-items-center justify-content-between">
          <h5 class="card-title m-0 me-2">Doanh thu theo ngày </h5>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="nav-align-top mb-4">
              <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                  <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-1" aria-controls="navs-top-1" aria-selected="true">
                    Doanh thu khách lẻ
                  </button>
                </li>
                <li class="nav-item">
                  <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-2" aria-controls="navs-top-2" aria-selected="false">
                    Doanh thu đại lý
                  </button>
                </li>
                <li class="nav-item">
                  <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-3" aria-controls="navs-top-3" aria-selected="false">
                    Nhập hàng hệ thống
                  </button>
                </li>
                <li class="nav-item">
                  <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-4" aria-controls="navs-top-4" aria-selected="false">
                    Khách hàng mới
                  </button>
                </li>
              </ul>
              <div class="tab-content" style=" padding: 0; ">
                <div class="tab-pane fade active show" id="navs-top-1" role="tabpanel" style="min-height: 450px;">
                  <div id="columnchart_staticOrder" style="width: 98%; height: 300px;"></div>
                </div>
                <div class="tab-pane fade" id="navs-top-2" role="tabpanel" style="min-height: 450px;">
                  <div id="columnchart_staticOrderMemberSell" style="width: 98%; height: 300px;"></div>
                </div>
                <div class="tab-pane fade" id="navs-top-3" role="tabpanel" style="min-height: 450px;">
                  <div id="columnchart_staticOrderMemberBuy" style="width: 98%; height: 300px;"></div>
                </div>
                <div class="tab-pane fade" id="navs-top-4" role="tabpanel" style="min-height: 450px;">
                  <div id="columnchart_staticCustomer" style="width: 98%; height: 300px;"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> 

    <div class="col-md-5 col-lg-5 order-2 mb-4">
      <div class="card h-100">
        <div class="card-header d-flex align-items-center justify-content-between">
          <h5 class="card-title m-0 me-2">Khách đơn Khách lẻ hôm nay </h5>
        </div>
        <div class="card-body">
          <table class="table table-bordered">
            <thead>
              <tr class="">
                <th>Khách hàng</th>
                <th>Sản phẩm</th>
                <th>Số tiền</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              if(!empty($listDataOrder)){
                foreach ($listDataOrder as $item) {
                  $product = [];
                  if($item->detail_order){
                    foreach($item->detail_order as $key => $value){
                          $product[] = $value->product;
                        
                      }
                  }

                  echo '<tr>
                  <td>'.$item->customer->full_name.'<br/>
                  '.$item->customer->phone.'
                  </td>
                  <td>'.implode(', ', $product).'</td>              
                  <td>'.$item->total.'</td>              
                  </tr>';
                }
              }else{
                echo '<tr>
                <td colspan="10" align="center">Chưa có dữ liệu</td>
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
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <div class="taovien" >
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart', 'line']});

      google.charts.setOnLoadCallback(drawChartOrder);
      google.charts.setOnLoadCallback(drawChartOrderMemberSell);
      google.charts.setOnLoadCallback(drawChartOrderMemberBuy);
      google.charts.setOnLoadCallback(drawChartCustomer);

      function drawChartOrder() {
        var data = google.visualization.arrayToDataTable([
          ["Ngày", "Doanh thu", { role: "style" } ],
          <?php if(!empty(@$staticOrder) ){
            foreach($staticOrder as $date => $number){
              echo '["'.@$date.'",'.$number.', "#696cff"],';
            }
          }else{

            echo '["0",0],';
          }?>
          ]);

        var options = {

          width: '100%',
          height: 400,  
        };


            // var chart = new google.visualization.LineChart(document.getElementById('order_chart'));
            var chart = new google.charts.Line(document.getElementById('columnchart_staticOrder'));

            chart.draw(data, options);


          }

          function drawChartOrderMemberSell() {
            var data = google.visualization.arrayToDataTable([
              ["ngày", "Doanh thu", { role: "style" } ],
              <?php if(!empty(@$staticOrderMemberSell) ){
                foreach($staticOrderMemberSell as $date => $number){
                  echo '["'.@$date.'",'.$number.', "#696cff"],';
                }
              }else{

                echo '["0",0],';
              }?>
              ]);

            var options = {

              width: '100%',
              height: 400,  
            };


            // var chart = new google.visualization.LineChart(document.getElementById('order_chart'));
            var chart = new google.charts.Line(document.getElementById('columnchart_staticOrderMemberSell'));

            chart.draw(data, options);
          }

          function drawChartOrderMemberBuy() {
            var data = google.visualization.arrayToDataTable([
              ["ngày", "Doanh thu", { role: "style" } ],
              <?php if(!empty(@$staticOrderMemberBuy) ){
                foreach($staticOrderMemberBuy as $date => $number){
                  echo '["'.@$date.'",'.$number.', "#696cff"],';
                }
              }else{

                echo '["0",0],';
              }?>
              ]);

            var options = {

              width: '100%',
              height: 400,  
            };


            // var chart = new google.visualization.LineChart(document.getElementById('order_chart'));
            var chart = new google.charts.Line(document.getElementById('columnchart_staticOrderMemberBuy'));

            chart.draw(data, options);
          }

          function drawChartCustomer() {
            var data = google.visualization.arrayToDataTable([
              ["ngày", "Doanh thu", { role: "style" } ],
              <?php if(!empty(@$staticCustomer) ){
                foreach($staticCustomer as $date => $number){
                  echo '["'.@$date.'",'.$number.', "#696cff"],';
                }
              }else{

                echo '["0",0],';
              }?>
              ]);

            var options = {

              width: '100%',
              height: 400,  
              padding: 34
            };


            // var chart = new google.visualization.LineChart(document.getElementById('order_chart'));
            var chart = new google.charts.Line(document.getElementById('columnchart_staticCustomer'));

            chart.draw(data, options);
          }
        </script>

        <script type="text/javascript">
          $(document).ready(function(){
            $('.nav-link').on( "click", function() {
              var target = $( this ).data('bs-target');

              if (target === "#navs-top-1") {
                drawChartOrder();
              } else if (target === "#navs-top-2") {
                drawChartOrderMemberSell();
              } else if (target === "#navs-top-3") {
                drawChartOrderMemberBuy();
              } else if (target === "#navs-top-4") {
                drawChartCustomer();
              }
            } );
          });
        </script>

      </div>
    </center>
    <!-- / Content -->
    <?php include(__DIR__.'/../footer.php'); ?>