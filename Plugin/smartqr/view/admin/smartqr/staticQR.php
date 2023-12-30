<script type="text/javascript" src="https://www.google.com/jsapi"></script>
    
<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/smartqr-view-admin-smartqr-listQR">Mã QR</a> /</span>
    <?php echo $infoQR->title;?>
  </h4>

  <!-- Basic Layout -->
  <div class="row">
    <div class="col-xl">
      <div class="card mb-12">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h5 class="mb-0">Thống kê quét mã QR</h5>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-12">
              <div class="nav-align-top mb-4">
                <ul class="nav nav-tabs" role="tablist">
                  <li class="nav-item">
                    <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-home" aria-controls="navs-top-home" aria-selected="true">
                      Thống kê biểu đồ
                    </button>
                  </li>
                  <li class="nav-item">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-info" aria-controls="navs-top-info" aria-selected="false">
                      Danh sách chi tiết
                    </button>
                  </li>
                </ul>

                <div class="tab-content">
                  <div class="tab-pane fade active show" id="navs-top-home" role="tabpanel">
                    <div class="row">
                      <div class="col-12 col-xs-12 col-sm-12 col-md-12" style="overflow-x: scroll;">
                        <div class="mb-3">
                          <div id="chart_time_scan"></div>
                        </div>
                      </div>

                      <div class="col-12 col-xs-12 col-sm-12 col-md-6">
                        <div class="mb-3">
                          <div id="chart_device_type"></div>
                        </div>
                      </div>

                      <div class="col-12 col-xs-12 col-sm-12 col-md-6">
                        <div class="mb-3">
                          <div id="chart_device_name"></div>
                        </div>
                      </div>

                      <div class="col-12 col-xs-12 col-sm-12 col-md-6">
                        <div class="mb-3">
                          <div id="chart_system"></div>
                        </div>
                      </div>

                      <div class="col-12 col-xs-12 col-sm-12 col-md-6">
                        <div class="mb-3">
                          <div id="chart_browser"></div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="tab-pane fade" id="navs-top-info" role="tabpanel">
                    <div class="table-responsive">
                      <table class="table table-bordered">
                        <thead>
                          <tr class="">
                            <th>ID</th>
                            <th>Thời gian quét</th>
                            <th>Loại thiết bị</th>
                            <th>Tên thiết bị</th>
                            <th>Hệ điều hành</th>
                            <th>Trình duyệt</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php 
                            $time_scan = [];
                            $device_type = [];
                            $device_name = [];
                            $system = [];
                            $browser = [];
                            $today = getdate();

                            if(!empty($listData)){
                              foreach ($listData as $item) {
                                $time = getdate($item->time_scan);
                                if(empty($time_scan[$time['year']][$time['mon']])){
                                  $time_scan[$time['year']][$time['mon']] = 0;
                                }
                                $time_scan[$time['year']][$time['mon']]++;

                                if(empty($device_type[$item->device_type])){
                                  $device_type[$item->device_type] = 0;
                                }
                                $device_type[$item->device_type]++;

                                if(empty($device_name[$item->device_name])){
                                  $device_name[$item->device_name] = 0;
                                }
                                $device_name[$item->device_name]++;

                                if(empty($system[$item->system])){
                                  $system[$item->system] = 0;
                                }
                                $system[$item->system]++;

                                if(empty($browser[$item->browser])){
                                  $browser[$item->browser] = 0;
                                }
                                $browser[$item->browser]++;

                                echo '<tr>
                                        <td>'.$item->id.'</td>
                                        <td>'.date('H:i d/m/Y', $item->time_scan).'</td>
                                        <td>'.$item->device_type.'</td>
                                        <td>'.$item->device_name.'</td>
                                        <td>'.$item->system.'</td>
                                        <td>'.$item->browser.'</td>
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
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  // Load the Visualization API and the piechart package.
  google.load('visualization', '1.0', {'packages':['corechart']});
  google.setOnLoadCallback(drawChartDeviceType);
  google.setOnLoadCallback(drawChartDeviceName);
  google.setOnLoadCallback(drawChartSystem);
  google.setOnLoadCallback(drawChartBrowser);
  google.setOnLoadCallback(drawChartTimeScan);

  function drawChartTimeScan() {
      var data = google.visualization.arrayToDataTable([
        ["Element", "Density", { role: "style" } ],
        ["Tháng 1", <?php echo (int) @$time_scan[$today['year']][1];?>, "blueviolet"],
        ["Tháng 2", <?php echo (int) @$time_scan[$today['year']][2];?>, "brown"],
        ["Tháng 3", <?php echo (int) @$time_scan[$today['year']][3];?>, "gold"],
        ["Tháng 4", <?php echo (int) @$time_scan[$today['year']][4];?>, "cadetblue"],
        ["Tháng 5", <?php echo (int) @$time_scan[$today['year']][5];?>, "darkgreen"],
        ["Tháng 6", <?php echo (int) @$time_scan[$today['year']][6];?>, "yellowgreen"],
        ["Tháng 7", <?php echo (int) @$time_scan[$today['year']][7];?>, "violet"],
        ["Tháng 8", <?php echo (int) @$time_scan[$today['year']][8];?>, "turquoise"],
        ["Tháng 9", <?php echo (int) @$time_scan[$today['year']][9];?>, "tomato"],
        ["Tháng 10", <?php echo (int) @$time_scan[$today['year']][10];?>, "slategrey"],
        ["Tháng 11", <?php echo (int) @$time_scan[$today['year']][11];?>, "springgreen"],
        ["Tháng 12", <?php echo (int) @$time_scan[$today['year']][11];?>, "slateblue"],
      ]);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options = {
        title: "Thời gian quét mã QR",
        width: 1500,
        height: 400,
        bar: {groupWidth: "9%"},
        legend: { position: "none" },
        responsive: true,
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("chart_time_scan"));
      chart.draw(view, options);
  }

  function drawChartDeviceType() {
    // Create the data table.
    var data = new google.visualization.DataTable();
    // Create columns for the DataTable
    data.addColumn('string');
    data.addColumn('number', 'Devices');
    // Create Rows with data
    data.addRows([
      <?php 
      if(!empty($device_type)){
        foreach ($device_type as $key => $value) {
          echo "['$key', $value],";
        }
      }
      ?>
    ]);
    //Create option for chart
    var options = {
      title: 'Loại thiết bị',
      'width': 400,
      'height': 400
    };

    // Instantiate and draw our chart, passing in some options.
    var chart = new google.visualization.PieChart(document.getElementById('chart_device_type'));
    chart.draw(data, options);
  }

  function drawChartDeviceName() {
    // Create the data table.
    var data = new google.visualization.DataTable();
    // Create columns for the DataTable
    data.addColumn('string');
    data.addColumn('number', 'Devices');
    // Create Rows with data
    data.addRows([
      <?php 
      if(!empty($device_name)){
        foreach ($device_name as $key => $value) {
          echo "['$key', $value],";
        }
      }
      ?>
    ]);
    //Create option for chart
    var options = {
      title: 'Tên thiết bị',
      'width': 400,
      'height': 400
    };

    // Instantiate and draw our chart, passing in some options.
    var chart = new google.visualization.PieChart(document.getElementById('chart_device_name'));
    chart.draw(data, options);
  }

  function drawChartSystem() {
    // Create the data table.
    var data = new google.visualization.DataTable();
    // Create columns for the DataTable
    data.addColumn('string');
    data.addColumn('number', 'System');
    // Create Rows with data
    data.addRows([
      <?php 
      if(!empty($system)){
        foreach ($system as $key => $value) {
          echo "['$key', $value],";
        }
      }
      ?>
    ]);
    //Create option for chart
    var options = {
      title: 'Hệ điều hành',
      'width': 400,
      'height': 400
    };

    // Instantiate and draw our chart, passing in some options.
    var chart = new google.visualization.PieChart(document.getElementById('chart_system'));
    chart.draw(data, options);
  }

  function drawChartBrowser() {
    // Create the data table.
    var data = new google.visualization.DataTable();
    // Create columns for the DataTable
    data.addColumn('string');
    data.addColumn('number', 'Browser');
    // Create Rows with data
    data.addRows([
      <?php 
      if(!empty($browser)){
        foreach ($browser as $key => $value) {
          echo "['$key', $value],";
        }
      }
      ?>
    ]);
    //Create option for chart
    var options = {
      title: 'Trình duyệt',
      'width': 400,
      'height': 400
    };

    // Instantiate and draw our chart, passing in some options.
    var chart = new google.visualization.PieChart(document.getElementById('chart_browser'));
    chart.draw(data, options);
  }
</script>