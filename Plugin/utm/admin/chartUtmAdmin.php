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
  <div class=" row">
    <div class="nav-align-top mb-4">
      <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
          <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-Source" aria-controls="navs-top-home" aria-selected="true">
            UTM Source
          </button>
        </li>
        <li class="nav-item">
          <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-Medium" aria-controls="navs-top-info" aria-selected="false">
            UTM Medium
          </button>
        </li>
        <li class="nav-item">
          <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-Campaign" aria-controls="navs-top-info" aria-selected="false">
            UTM Campaign
          </button>
        </li>
        <li class="nav-item">
          <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-id" aria-controls="navs-top-info" aria-selected="false">
           UTM Id
         </button>
       </li>
       <li class="nav-item">
        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-Term" aria-controls="navs-top-image" aria-selected="false">
         UTM Term
       </button>
     </li>
     <li class="nav-item">
      <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-Content" aria-controls="navs-top-image" aria-selected="false">
       UTM Content
     </button>
   </li>
 </ul>

 <div class="card-body tab-content ">
  <div class="tab-pane fade active show" id="navs-top-Source" role="tabpanel">
    <div class="mb-5">
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr class="">
              <th width="50%">utm_source</th>
              <th width="40%">Số lượng truy cập</th>
              <th width="10%">Chi tiết</th>
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
                if(!empty($item['utm_source'])){
                  echo '<tr>
                  <td>'.$item['utm_source'].'</td>
                  <td>'.$item['count'].'</td>
                  <td><a class="dropdown-item" href="/plugins/admin/utm-admin-listUtmAdmin/?utm_source='.$item['utm_source'].'&date_start='.@$_GET['date_start'].'&date_end='.@$_GET['date_end'].'" >
                  <i class="bx bxs-show me-1"></i></td>


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
  <div class="tab-pane fade" id="navs-top-Medium" role="tabpanel">
    <div class="mb-5">
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr class="">
              <th width="50%">utm_medium</th>
              <th width="40%">Số lượng truy cập</th>
              <th width="10%">Chi tiết</th>
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
                  if(!empty($item['utm_medium'])){
                    echo '<tr>
                    <td>'.$item['utm_medium'].'</td>
                    <td>'.$item['count'].'</td>
                    <td><a class="dropdown-item" href="/plugins/admin/utm-admin-listUtmAdmin/?utm_medium='.$item['utm_medium'].'&date_start='.@$_GET['date_start'].'&date_end='.@$_GET['date_end'].'" >
                    <i class="bx bxs-show me-1"></i></td>


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
    <div class="tab-pane fade" id="navs-top-Campaign" role="tabpanel">
      <div class="mb-5">
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
              <tr class="">
                <th width="50%">utm_campaign</th>
                <th width="40%">Số lượng truy cập</th>
                <th width="10%">Chi tiết</th>
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
                  if(!empty($item['utm_campaign'])){
                    echo '<tr>
                    <td>'.$item['utm_campaign'].'</td>
                    <td>'.$item['count'].'</td>
                    <td><a class="dropdown-item" href="/plugins/admin/utm-admin-listUtmAdmin/?utm_campaign='.$item['utm_campaign'].'&date_start='.@$_GET['date_start'].'&date_end='.@$_GET['date_end'].'" >
                    <i class="bx bxs-show me-1"></i></td>


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
    <div class="tab-pane fade" id="navs-top-id" role="tabpanel">
      <div class="mb-5">
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
              <tr class="">
                <th width="50%">utm_id</th>
                <th width="40%">Số lượng truy cập</th>
                <th width="10%">Chi tiết</th>
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
                  if(!empty($item['utm_id'])){
                    echo '<tr>
                    <td>'.$item['utm_id'].'</td>
                    <td>'.$item['count'].'</td>
                    <td><a class="dropdown-item" href="/plugins/admin/utm-admin-listUtmAdmin/?utm_id='.$item['utm_id'].'&date_start='.@$_GET['date_start'].'&date_end='.@$_GET['date_end'].'" >
                    <i class="bx bxs-show me-1"></i></td>


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
    <div class="tab-pane fade" id="navs-top-Term" role="tabpanel">
      <div class="mb-5">
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
              <tr class="">
                <th width="50%">utm_term</th>
                <th width="40%">Số lượng truy cập</th>
                <th width="10%">Chi tiết</th>
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
                  if(!empty($item['utm_term'])){
                    echo '<tr>
                    <td>'.$item['utm_term'].'</td>
                    <td>'.$item['count'].'</td>
                    <td><a class="dropdown-item" href="/plugins/admin/utm-admin-listUtmAdmin/?utm_term='.$item['utm_term'].'&date_start='.@$_GET['date_start'].'&date_end='.@$_GET['date_end'].'" >
                    <i class="bx bxs-show me-1"></i></td>


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
    <div class="tab-pane fade" id="navs-top-Content" role="tabpanel">
      <div class="mb-5">
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
              <tr class="">
                <th width="50%">utm_content</th>
                <th width="40%">Số lượng truy cập</th>
                <th width="10%">Chi tiết</th>
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
                  if(!empty($item['utm_content'])){
                    echo '<tr>
                    <td>'.$item['utm_content'].'</td>
                    <td>'.$item['count'].'</td>
                    <td><a class="dropdown-item" href="/plugins/admin/utm-admin-listUtmAdmin/?utm_content='.$item['utm_content'].'&date_start='.@$_GET['date_start'].'&date_end='.@$_GET['date_end'].'" >
                    <i class="bx bxs-show me-1"></i></td>


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