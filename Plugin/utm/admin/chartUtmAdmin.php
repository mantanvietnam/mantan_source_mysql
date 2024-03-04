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
<center>
<div class="taovien" >
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
       google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Số lượng truy cập', 'Nguồn FacebookAds', 'Nguồn Facebook', 'Nguồn Zalo'],
          ['', <?php echo @$facebookAds ?>, <?php echo @$Facebook ?>, <?php echo @$zalo ?>],
        ]);

        var options = {
          chart: {
            title: ' nguồn khách vào ',
            subtitle: 'Thống kê số nguồn khách vào theo tháng',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('myPieChart'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
        
    </script>

    <div id="myPieChart" style="width: 100%; height: 500px; background: white;"></div>
</div>
</center> 


</div>