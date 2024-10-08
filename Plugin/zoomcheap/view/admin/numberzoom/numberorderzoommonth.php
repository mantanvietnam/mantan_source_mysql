<!-- <div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Danh sách số lượng đơn theo tháng</h4> 

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
  <!--/ Form Search -->
  <div class="container-xxl flex-grow-1 container-p-y">
    <div class="card row">
      <h1>Biểu đồ số lượng đơn hàng theo tháng</h1>
      <canvas id="monthlyOrdersChart" width="80" height="40"></canvas>
    </div>  
  </div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    var groupedData = <?php echo json_encode($groupedData); ?>; // Dữ liệu từ PHP
    
    var labels = [];
    var data = [];

    for (var month in groupedData) {
        labels.push(groupedData[month].monthYear);  // Tháng - Năm
        data.push(groupedData[month].totalQuantity);  // Số lượng đơn hàng
    }

    var ctx = document.getElementById('monthlyOrdersChart').getContext('2d');
    var monthlyOrdersChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Số lượng đơn hàng theo tháng',
                data: data,
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
            <td><?php echo $group['monthYear']; ?></td>
            <td><?php echo $group['totalQuantity']; ?></td>
          </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr>
          <td colspan="2">Không có dữ liệu</td>
        </tr>
      <?php endif; ?>
    </tbody>


</table>

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
  </div> -->

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<canvas id="monthlyOrdersChart" width="400" height="200"></canvas>
<script>
    var groupedData = <?php echo json_encode($groupedData); ?>;
    
    var labels = [];
    var data = [];

    for (var month in groupedData) {
        labels.push(groupedData[month].monthYear);
        data.push(groupedData[month].totalQuantity); 
    }

    var ctx = document.getElementById('monthlyOrdersChart').getContext('2d');
    var monthlyOrdersChart = new Chart(ctx, {
        type: 'bar', 
        data: {
            labels: labels, 
            datasets: [{
                label: 'Số lượng đơn hàng theo tháng',
                data: data, 
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
</script>
