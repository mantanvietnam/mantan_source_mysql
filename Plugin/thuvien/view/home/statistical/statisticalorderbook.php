<?php include(__DIR__.'/../header.php'); ?>

<div class="container-xxl flex-grow-1">
    <h4 class="fw-bold py-3 mb-4">
      <span class="text-muted fw-light"></span>
      Số lượng sách
    </h4>
    <div class="card mb-4">
        <h5 class="card-header">Sách được mượn nhiều nhất là <span style="color:blue"><?php echo ($maxBookName); ?></span> với số lần mượn là <span style="color:blue"><?php echo $maxQuantity;?></span></h5>
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

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Lấy dữ liệu từ PHP
    const labels = <?php echo json_encode(array_map(function($book) { return $book['book_name']; }, $listDataWithBookNames)); ?>;
    const data = <?php echo json_encode(array_map(function($book) { return $book['quantity']; }, $listDataWithBookNames)); ?>;

    // Khởi tạo biểu đồ
    const ctx = document.getElementById('bookChart').getContext('2d');
    const bookChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Số Lần mượn sách',
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
