<?php include(__DIR__.'/../header.php'); ?>

<div class="container-xxl flex-grow-1">

  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"></span>
    Số lượng sách
  </h4>


  <!-- Form Search -->
  <!-- <form method="get" action="">
    <div class="card mb-4">
      <h5 class="card-header">Tìm kiếm sách</h5>
      <div class="card-body">
        <div class="row gx-3 gy-2 align-items-center">
          <div class="col-md-1">
            <label class="form-label">ID</label>
            <input type="text" class="form-control" name="id" value="<?php if(!empty($_GET['id'])) echo $_GET['id']; ?>">
          </div>

          <div class="col-md-3">
            <label class="form-label">Tên sách</label>
            <input type="text" class="form-control" name="name" value="<?php if(!empty($_GET['name'])) echo $_GET['name']; ?>">
          </div>

          <div class="col-md-2">
            <label class="form-label">Loại</label>
            <input type="text" class="form-control" name="type" value="<?php if(!empty($_GET['type'])) echo $_GET['type']; ?>">
          </div>

          <div class="col-md-2">
            <label class="form-label">Trạng thái</label>
            <select name="status" class="form-select color-dropdown">
              <option value="">Tất cả</option>
              <option value="active" <?php if(!empty($_GET['status']) && $_GET['status'] == 'active') echo 'selected'; ?>>Kích hoạt</option>
              <option value="lock" <?php if(!empty($_GET['status']) && $_GET['status'] == 'lock') echo 'selected'; ?>>Khóa</option>
            </select>
          </div>

          <div class="col-md-2">
            <label class="form-label">&nbsp;</label>
            <button type="submit" class="btn btn-primary d-block">Tìm kiếm</button>
          </div>
        </div>
      </div>
    </div>
  </form> -->
  <div class="card mb-4">
    <h5 class="card-header">Thống kê số lượng sách tòa nhà <?php echo $building->name;?></h5>
    <div class="card-body">
      <canvas id="bookChart" width="500" height="200"></canvas>
    </div>
    <div class="demo-inline-spacing">
        <nav aria-label="Page navigation">
          <ul class="pagination justify-content-center">
            <?php
            if ($totalPage > 0) {
                $startPage = ($page > 5) ? $page - 5 : 1;
                $endPage = ($totalPage > $page + 5) ? $page + 5 : $totalPage;

                echo '<li class="page-item first">
                        <a class="page-link" href="' . $urlPage . '1">
                          <i class="tf-icon bx bx-chevrons-left"></i>
                        </a>
                      </li>';

                for ($i = $startPage; $i <= $endPage; $i++) {
                    $active = ($page == $i) ? 'active' : '';
                    echo '<li class="page-item ' . $active . '">
                            <a class="page-link" href="' . $urlPage . $i . '">' . $i . '</a>
                          </li>';
                }

                echo '<li class="page-item last">
                        <a class="page-link" href="' . $urlPage . $totalPage . '">
                          <i class="tf-icon bx bx-chevrons-right"></i>
                        </a>
                      </li>';
            }
            ?>
          </ul>
        </nav>
      </div>
  </div>

</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const labels = <?php echo json_encode(array_map(function($warehouse) { return $warehouse->book_name; }, $listData)); ?>;
const data = <?php echo json_encode(array_map(function($warehouse) { return $warehouse->quantity; }, $listData)); ?>;

const ctx = document.getElementById('bookChart').getContext('2d');
const bookChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [{
            label: 'Số lượng sách',
            data: data,
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'top',
            },
            title: {
                display: true,
                text: 'Thống kê số lượng sách'
            }
        },
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

</script>

<?php include(__DIR__.'/../footer.php'); ?>