<?php include(__DIR__.'/../header.php'); ?>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/account">Tài khoản</a> /</span>
    Báo cáo kinh doanh
  </h4>

  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thống kê kết quả kinh doanh năm <?php echo $today['year'];?></h5>
          </div>
          <div class="card-body">
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
                  <div class="tab-content">
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
      </div>

    </div>
</div>

<script type="text/javascript">
  google.charts.load("current", {packages:['corechart']});

  google.charts.setOnLoadCallback(drawChartOrder);
  google.charts.setOnLoadCallback(drawChartOrderMemberSell);
  google.charts.setOnLoadCallback(drawChartOrderMemberBuy);
  google.charts.setOnLoadCallback(drawChartCustomer);

  function drawChartOrder() {
    var data = google.visualization.arrayToDataTable([
      ["Thánh", "Doanh thu", { role: "style" } ],
      ["Tháng 1", <?php echo $staticOrder[1];?>, "#696cff"],
      ["Tháng 2", <?php echo $staticOrder[2];?>, "#696cff"],
      ["Tháng 3", <?php echo $staticOrder[3];?>, "#696cff"],
      ["Tháng 4", <?php echo $staticOrder[4];?>, "#696cff"],
      ["Tháng 5", <?php echo $staticOrder[5];?>, "#696cff"],
      ["Tháng 6", <?php echo $staticOrder[6];?>, "#696cff"],
      ["Tháng 7", <?php echo $staticOrder[7];?>, "#696cff"],
      ["Tháng 8", <?php echo $staticOrder[8];?>, "#696cff"],
      ["Tháng 9", <?php echo $staticOrder[9];?>, "#696cff"],
      ["Tháng 10", <?php echo $staticOrder[10];?>, "#696cff"],
      ["Tháng 11", <?php echo $staticOrder[11];?>, "#696cff"],
      ["Tháng 12", <?php echo $staticOrder[12];?>, "#696cff"]
    ]);

    var view = new google.visualization.DataView(data);
    view.setColumns([0, 1,
                     { calc: "stringify",
                       sourceColumn: 1,
                       type: "string",
                       role: "annotation" },
                     2]);

    var options = {
      title: "",
      width: '100%',
      height: 400,
      bar: {groupWidth: "95%"},
      legend: { position: "none" },
    };
    var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_staticOrder"));
    chart.draw(view, options);

    window.addEventListener('resize', function() {
        chart.draw(view, options);
    });
  }

  function drawChartOrderMemberSell() {
    var data = google.visualization.arrayToDataTable([
      ["Thánh", "Doanh thu", { role: "style" } ],
      ["Tháng 1", <?php echo $staticOrderMemberSell[1];?>, "#696cff"],
      ["Tháng 2", <?php echo $staticOrderMemberSell[2];?>, "#696cff"],
      ["Tháng 3", <?php echo $staticOrderMemberSell[3];?>, "#696cff"],
      ["Tháng 4", <?php echo $staticOrderMemberSell[4];?>, "#696cff"],
      ["Tháng 5", <?php echo $staticOrderMemberSell[5];?>, "#696cff"],
      ["Tháng 6", <?php echo $staticOrderMemberSell[6];?>, "#696cff"],
      ["Tháng 7", <?php echo $staticOrderMemberSell[7];?>, "#696cff"],
      ["Tháng 8", <?php echo $staticOrderMemberSell[8];?>, "#696cff"],
      ["Tháng 9", <?php echo $staticOrderMemberSell[9];?>, "#696cff"],
      ["Tháng 10", <?php echo $staticOrderMemberSell[10];?>, "#696cff"],
      ["Tháng 11", <?php echo $staticOrderMemberSell[11];?>, "#696cff"],
      ["Tháng 12", <?php echo $staticOrderMemberSell[12];?>, "#696cff"]
    ]);

    var view = new google.visualization.DataView(data);
    view.setColumns([0, 1,
                     { calc: "stringify",
                       sourceColumn: 1,
                       type: "string",
                       role: "annotation" },
                     2]);

    var options = {
      title: "",
      width: '100%',
      height: 400,
      bar: {groupWidth: "95%"},
      legend: { position: "none" },
    };
    var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_staticOrderMemberSell"));
    chart.draw(view, options);

    window.addEventListener('resize', function() {
        chart.draw(view, options);
    });
  }

  function drawChartOrderMemberBuy() {
    var data = google.visualization.arrayToDataTable([
      ["Thánh", "Doanh thu", { role: "style" } ],
      ["Tháng 1", <?php echo $staticOrderMemberBuy[1];?>, "#696cff"],
      ["Tháng 2", <?php echo $staticOrderMemberBuy[2];?>, "#696cff"],
      ["Tháng 3", <?php echo $staticOrderMemberBuy[3];?>, "#696cff"],
      ["Tháng 4", <?php echo $staticOrderMemberBuy[4];?>, "#696cff"],
      ["Tháng 5", <?php echo $staticOrderMemberBuy[5];?>, "#696cff"],
      ["Tháng 6", <?php echo $staticOrderMemberBuy[6];?>, "#696cff"],
      ["Tháng 7", <?php echo $staticOrderMemberBuy[7];?>, "#696cff"],
      ["Tháng 8", <?php echo $staticOrderMemberBuy[8];?>, "#696cff"],
      ["Tháng 9", <?php echo $staticOrderMemberBuy[9];?>, "#696cff"],
      ["Tháng 10", <?php echo $staticOrderMemberBuy[10];?>, "#696cff"],
      ["Tháng 11", <?php echo $staticOrderMemberBuy[11];?>, "#696cff"],
      ["Tháng 12", <?php echo $staticOrderMemberBuy[12];?>, "#696cff"]
    ]);

    var view = new google.visualization.DataView(data);
    view.setColumns([0, 1,
                     { calc: "stringify",
                       sourceColumn: 1,
                       type: "string",
                       role: "annotation" },
                     2]);

    var options = {
      title: "",
      width: '100%',
      height: 400,
      bar: {groupWidth: "95%"},
      legend: { position: "none" },
    };
    var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_staticOrderMemberBuy"));
    chart.draw(view, options);

    window.addEventListener('resize', function() {
        chart.draw(view, options);
    });
  }

  function drawChartCustomer() {
    var data = google.visualization.arrayToDataTable([
      ["Thánh", "Doanh thu", { role: "style" } ],
      ["Tháng 1", <?php echo $staticCustomer[1];?>, "#696cff"],
      ["Tháng 2", <?php echo $staticCustomer[2];?>, "#696cff"],
      ["Tháng 3", <?php echo $staticCustomer[3];?>, "#696cff"],
      ["Tháng 4", <?php echo $staticCustomer[4];?>, "#696cff"],
      ["Tháng 5", <?php echo $staticCustomer[5];?>, "#696cff"],
      ["Tháng 6", <?php echo $staticCustomer[6];?>, "#696cff"],
      ["Tháng 7", <?php echo $staticCustomer[7];?>, "#696cff"],
      ["Tháng 8", <?php echo $staticCustomer[8];?>, "#696cff"],
      ["Tháng 9", <?php echo $staticCustomer[9];?>, "#696cff"],
      ["Tháng 10", <?php echo $staticCustomer[10];?>, "#696cff"],
      ["Tháng 11", <?php echo $staticCustomer[11];?>, "#696cff"],
      ["Tháng 12", <?php echo $staticCustomer[12];?>, "#696cff"]
    ]);

    var view = new google.visualization.DataView(data);
    view.setColumns([0, 1,
                     { calc: "stringify",
                       sourceColumn: 1,
                       type: "string",
                       role: "annotation" },
                     2]);

    var options = {
      title: "",
      width: '100%',
      height: 400,
      bar: {groupWidth: "95%"},
      legend: { position: "none" },
    };
    var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_staticCustomer"));
    chart.draw(view, options);

    window.addEventListener('resize', function() {
        chart.draw(view, options);
    });
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

<?php include(__DIR__.'/../footer.php'); ?>