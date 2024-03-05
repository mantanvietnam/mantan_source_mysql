<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Thống kê số nguồn khách vào </h4>
     <form method="get" action="">
    <div class="card mb-4">
      <h5 class="card-header">Tìm kiếm dữ liệu</h5>
      <div class="card-body">
        <div class="row gx-3 gy-2 align-items-center">
          

          <div class="col-md-2">
            <label class="form-label">Từ ngày</label>
            <input type="text" class="form-control datepicker" name="date_start" value="<?php if(!empty($_GET['date_start'])) echo $_GET['date_start'];?>">
          </div>

          <div class="col-md-2">
            <label class="form-label">Đến ngày</label>
            <input type="text" class="form-control datepicker" name="date_end" value="<?php if(!empty($_GET['date_end'])) echo $_GET['date_end'];?>">
          </div>

         
          <div class="col-md-1">
            <label class="form-label">&nbsp;</label>
            <button type="submit" class="btn btn-primary d-block">Lọc</button>
          </div>

          
        </div>
      </div>
    </div>
  </form>
  <div class="card row">
    <div class="mb-5">
      <h5 class="card-header">Thống kê UTM Source</h5>
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr class="">
              <th width="50%">utm_source</th>
              <th width="50%">Số lượng truy cập</th>
              <!-- <th width="50%">utm_campaign</th>
              <th width="50%">utm_id</th>
              <th width="50%">utm_term</th>
              <th width="50%">utm_content</th>
              <th width="50%">ngày</th> -->
              <!-- <th width="50%">Sửa</th> -->
              <!-- <th width="50%">Xóa</th>  -->
            </tr>
          </thead>
          <tbody>
            <?php 
              if(!empty($utm_source)){
                foreach ($utm_source as $item) {
                    if(!empty($item->utm_source)){
                  echo '<tr>
                          <td>'.$item->utm_source.'</td>
                          <td>'.$item->count.'</td>
                          
                          
                        </tr>';
                      }
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

    <div class="mb-5">
      <h5 class="card-header">Thống kê UTM Medium</h5>
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr class="">
              <th width="50%">utm_medium</th>
              <th width="50%">Số lượng truy cập</th>
              <!-- <th width="50%">utm_campaign</th>
              <th width="50%">utm_id</th>
              <th width="50%">utm_term</th>
              <th width="50%">utm_content</th>
              <th width="50%">ngày</th> -->
              <!-- <th width="50%">Sửa</th> -->
              <!-- <th width="50%">Xóa</th>  -->
            </tr>
          </thead>
          <tbody>
            <?php 
              if(!empty($utm_medium)){
                foreach ($utm_medium as $item) {
                  if(!empty($item->utm_medium)){
                    echo '<tr>
                            <td>'.$item->utm_medium.'</td>
                            <td>'.$item->count.'</td>
                            
                            
                          </tr>';
                  }
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

    <div class="mb-5">
      <h5 class="card-header">Thống kê UTM Campaign</h5>
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr class="">
              <th width="50%">utm_campaign</th>
              <th width="50%">Số lượng truy cập</th>
              <!-- <th width="50%">utm_campaign</th>
              <th width="50%">utm_id</th>
              <th width="50%">utm_term</th>
              <th width="50%">utm_content</th>
              <th width="50%">ngày</th> -->
              <!-- <th width="50%">Sửa</th> -->
              <!-- <th width="50%">Xóa</th>  -->
            </tr>
          </thead>
          <tbody>
            <?php 
              if(!empty($utm_campaign)){
                foreach ($utm_campaign as $item) {
                  if(!empty($item->utm_medium)){
                      echo '<tr>
                              <td>'.$item->utm_campaign.'</td>
                              <td>'.$item->count.'</td>
                              
                              
                            </tr>';
                  }
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

     <div class="mb-5">
      <h5 class="card-header">Thống kê UTM Id</h5>
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr class="">
              <th width="50%">utm_id</th>
              <th width="50%">Số lượng truy Cập</th>
              <!-- <th width="50%">utm_campaign</th>
              <th width="50%">utm_id</th>
              <th width="50%">utm_term</th>
              <th width="50%">utm_content</th>
              <th width="50%">ngày</th> -->
              <!-- <th width="50%">Sửa</th> -->
              <!-- <th width="50%">Xóa</th>  -->
            </tr>
          </thead>
          <tbody>
            <?php 
              if(!empty($utm_id)){
                foreach ($utm_id as $item) {
                  if(!empty($item->utm_id)){
                  echo '<tr>
                          <td>'.$item->utm_id.'</td>
                          <td>'.$item->count.'</td>
                          
                          
                        </tr>';
                      }
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


    <div class="mb-5">
      <h5 class="card-header">Thống kê UTM Term</h5>
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr class="">
              <th width="50%">utm_term</th>
              <th width="50%">Số lượng truy cập</th>
              <!-- <th width="50%">utm_campaign</th>
              <th width="50%">utm_id</th>
              <th width="50%">utm_term</th>
              <th width="50%">utm_content</th>
              <th width="50%">ngày</th> -->
              <!-- <th width="50%">Sửa</th> -->
              <!-- <th width="50%">Xóa</th>  -->
            </tr>
          </thead>
          <tbody>
            <?php 
              if(!empty($utm_term)){
                foreach ($utm_term as $item) {
                  if(!empty($item->utm_term)){
                  echo '<tr>
                          <td>'.$item->utm_term.'</td>
                          <td>'.$item->count.'</td>
                          
                          
                        </tr>';
                      }
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

     <div class="mb-5">
      <h5 class="card-header">Thống kê UTM Content</h5>
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr class="">
              <th width="50%">utm_content</th>
              <th width="50%">Số lượng truy cập</th>
              <!-- <th width="50%">utm_campaign</th>
              <th width="50%">utm_id</th>
              <th width="50%">utm_term</th>
              <th width="50%">utm_content</th>
              <th width="50%">ngày</th> -->
              <!-- <th width="50%">Sửa</th> -->
              <!-- <th width="50%">Xóa</th>  -->
            </tr>
          </thead>
          <tbody>
            <?php 
              if(!empty($utm_content)){
                foreach ($utm_content as $item) {
                  if(!empty($item->utm_content)){
                  echo '<tr>
                          <td>'.$item->utm_content.'</td>
                          <td>'.$item->count.'</td>
                          
                          
                        </tr>';
                      }
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
<center>
<div class="taovien" >
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <!-- <script type="text/javascript">
       google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Số lượng truy ca truy cập', 'Nguồn FacebookAds', 'Nguồn Facebook', 'Nguồn Zalo'],
          ['', <?php echo @$facebookAds ?>, <?php echo @$Facebook ?>, <?php echo @$zalo ?>],
        ]);

        var options = {
          chart: {
            title: ' Nguồn khách vào ',
            subtitle: 'Thống kê số nguồn khách vào theo tháng',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('myPieChart'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
        
    </script> -->

    <!-- /<div id="myPieChart" style="width: 100%; height: 500px; background: white;"></div> -->
</div>
</center> 


</div>