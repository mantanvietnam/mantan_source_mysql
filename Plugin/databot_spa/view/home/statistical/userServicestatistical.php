<?php include(__DIR__.'/../header.php'); ?>
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Thống kê lượng dịch vụ sử dụng</h4>
    <form method="get" action="">
        <div class="card mb-4">
            <h5 class="card-header">Tìm kiếm dữ liệu</h5>
            <div class="card-body">
                <div class="row gx-3 gy-2 align-items-center">
                    <!-- <div class="col-md-2">
                        <label class="form-label">Tháng</label>
                        <select class="form-select color-dropdown" name="timeView">
                            <?php 
                                $today= getdate();
                                $yearBack= $today['year']-1;
                                if(empty($_GET['timeView'])){
                                    $_GET['timeView']= $today['mon'].'/'.$today['year'];
                                }

                                $timeView= explode('-', @$_GET['timeView']);
                                
                                for($i=$today['mon'];$i>=1;$i--){
                                    if($i==@$timeView[1] && $today['year']==@$timeView[0]){
                                        if($i<10){
                                             echo '<option selected value="'.$today['year'].'-0'.$i.'">Tháng '.$i.'/'.$today['year'].'</option>';
                                        }else{
                                             echo '<option selected value="'.$today['year'].'-'.$i.'">Tháng '.$i.'/'.$today['year'].'</option>';
                                        }
                                       
                                    }else{
                                       if($i<10){
                                             echo '<option  value="'.$today['year'].'-0'.$i.'">Tháng '.$i.'/'.$today['year'].'</option>';
                                        }else{
                                             echo '<option  value="'.$today['year'].'-'.$i.'">Tháng '.$i.'/'.$today['year'].'</option>';
                                        }
                                    }
                                }

                                for($i=12;$i>=1;$i--){
                                    if($i==@$timeView[1] && $yearBack==@$timeView[0]){
                                       if($i<10){
                                           echo '<option selected value="'.$yearBack.'-0'.$i.'">Tháng '.$i.'/'.$yearBack.'</option>';
                                        }else{
                                           echo '<option selected value="'.$yearBack.'-'.$i.'">Tháng '.$i.'/'.$yearBack.'</option>';
                                        }
                                        
                                    }else{
                                        if($i<10){
                                           echo '<option  value="'.$yearBack.'-0'.$i.'">Tháng '.$i.'/'.$yearBack.'</option>';
                                        }else{
                                           echo '<option  value="'.$yearBack.'-'.$i.'">Tháng '.$i.'/'.$yearBack.'</option>';
                                        }
                                    }
                                }
                            ?>
                        </select> 
                    </div> -->
                    <div class="col-md-2">
                        <label class="form-label">Từ ngày</label>
                        <input type="text" class="form-control datepicker" name="date_start" value="<?php if(!empty($_GET['date_start'])) echo $_GET['date_start'];?>">
                      </div>

                      <div class="col-md-2">
                        <label class="form-label">Đến ngày</label>
                        <input type="text" class="form-control datepicker" name="date_end" value="<?php if(!empty($_GET['date_end'])) echo $_GET['date_end'];?>">
                      </div>
                    <div class="col-md-2">
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
        var char3= google;

        char3.charts.load('current', {'packages':['corechart', 'line']});
        char3.charts.setOnLoadCallback(drawChartOrder);

        function drawChartOrder() {
            var data = google.visualization.arrayToDataTable([
              ['Ngày', 'Số lượng'],
              <?php 
              // for($i=1;$i<32;$i++){
                    if(!empty(@$dayDataBill) ){
                        foreach($dayDataBill as $date=>$number){
                          //  if ($i==date('d',$number["time"])) {
                                echo '["'.date('d',$number["time"]).'",'.$number["value"].'],';
                            // }else{
                            //      echo '['.$i.',0],';
                            // }
                            
                        }
                    }else{

                        echo '["0",0],';
                    }
                // }
              ?>
            ]);

            // var options = {
            //   title: '',
            //   curveType: 'function',
            //   legend: { position: 'bottom' }
            // };

             var options = {
                chart: {
                  title: 'Thống kê lượng dịch vụ sử dụng',
                 // subtitle: 'in millions of dollars (USD)'
                },
                width: 900,
                height: 500,
                
              };


            // var chart = new google.visualization.LineChart(document.getElementById('order_chart'));
             var chart = new google.charts.Line(document.getElementById('order_chart'));

            chart.draw(data, options);
        }

        
    </script>

    <div id="order_chart" style="width: 100%; height: 500px; background: white;"></div>
</div>
</center> 


</div>

<?php include(__DIR__.'/../footer.php'); ?>