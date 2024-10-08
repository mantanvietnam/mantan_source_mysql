<!-- <div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Danh sách số lượng đơn theo ngày và tháng</h4> 


  <form method="get" action="">
    <div class="card mb-4">
      <h5 class="card-header">Tìm kiếm dữ liệu</h5>
      <div class="card-body">
        <div class="row gx-3 gy-2 align-items-center">
          <div class="col-md-1">
            <label class="form-label">ID</label>
            <input type="text" class="form-control" name="id" value="<?php if(!empty($_GET['id'])) echo $_GET['id'];?>">
          </div>
          <div class="col-md-2">
            <label class="form-label">&nbsp;</label>
            <button type="submit" class="btn btn-primary d-block">Tìm kiếm</button>
          </div>
        </div>
      </div>
    </div>
  </form> -->
  <div class="container-xxl flex-grow-1 container-p-y">
    <div class="card row">
      <h1>Biểu đồ số lượng đơn hàng theo ngày</h1>
      <canvas id="myChart"></canvas>
    </div>
  </div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var chart;

    function updateChart(labels, data) {
        if (chart) {
            chart.destroy(); // Xóa biểu đồ cũ trước khi vẽ biểu đồ mới
        }
        chart = new Chart(ctx, {
            type: 'bar', // Loại biểu đồ (bar, line, pie, etc.)
            data: {
                labels: labels, // Nhãn (ngày)
                datasets: [{
                    label: 'Số lượng đơn hàng',
                    data: data, // Dữ liệu số lượng đơn
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }
    document.addEventListener('DOMContentLoaded', function () {
        var chartLabels = <?php echo json_encode($chartLabels); ?>;
        var chartData = <?php echo json_encode($chartData); ?>;
        updateChart(chartLabels, chartData);
    });
</script>
<div class="demo-inline-spacing">
  <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
            <li class="page-item <?php if ($page == 1) echo 'disabled'; ?>">
                <a class="page-link" href="<?php echo $urlPage . $back; ?>">Trước</a>
            </li>
            <?php for ($i = 1; $i <= $totalPage; $i++) : ?>
                <li class="page-item <?php if ($page == $i) echo 'active'; ?>">
                    <a class="page-link" href="<?php echo $urlPage . $i; ?>"><?php echo $i; ?></a>
                </li>
            <?php endfor; ?>
            <li class="page-item <?php if ($page == $totalPage) echo 'disabled'; ?>">
                <a class="page-link" href="<?php echo $urlPage . $next; ?>">Tiếp</a>
            </li>
        </ul>
    </nav>
</div>




  <!-- <div class="card row">
    <h5 class="card-header">Danh sách Đơn hàng thuê Zoom</h5>
    <div class="table-responsive">
    <table class="table table-bordered">
    <thead>
        <tr class="">
            <th>Ngày</th>

            <th width="200">Số lượng</th>
        </tr>
    </thead>
    <tbody>
      <?php if (!empty($groupedData)): ?>
        <?php foreach ($groupedData as $group): ?>
          <tr>
            <td><?php echo $group['date']; ?></td>
            <td><?php echo $group['totalQuantity']; ?></td>
          </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr>
          <td colspan="2">Không có dữ liệu</td>
        </tr>
      <?php endif; ?>
    </tbody> -->


<!-- </table>

    </div>


    <div class="demo-inline-spacing">
      <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
          <?php
            if($totalPage>0){
                if ($page > 5) {
                    $startPage = $page - 5;
                } else {
                    $startPage = 1;
                }

                if ($totalPage > $page + 5) {
                    $endPage = $page + 5;
                } else {
                    $endPage = $totalPage;
                }
                
                echo '<li class="page-item first">
                        <a class="page-link" href="'.$urlPage.'1"
                          ><i class="tf-icon bx bx-chevrons-left"></i
                        ></a>
                      </li>';
                
                for ($i = $startPage; $i <= $endPage; $i++) {
                    $active= ($page==$i)?'active':'';

                    echo '<li class="page-item '.$active.'">
                            <a class="page-link" href="'.$urlPage.$i.'">'.$i.'</a>
                          </li>';
                }

                echo '<li class="page-item last">
                        <a class="page-link" href="'.$urlPage.$totalPage.'"
                          ><i class="tf-icon bx bx-chevrons-right"></i
                        ></a>
                      </li>';
            }
          ?>
        </ul>
      </nav>
    </div>

  </div>

</div> -->



