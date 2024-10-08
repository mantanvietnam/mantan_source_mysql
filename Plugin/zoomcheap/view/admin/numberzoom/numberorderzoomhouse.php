<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card row">
        <h1>Biểu đồ số lượng đơn hàng theo giờ</h1>
        <canvas id="ordersChart" width="400" height="200"></canvas>
    </div>
</div>
<script>
    var hourLabels = <?php echo $hourLabels; ?>;
    var totalQuantities = <?php echo $totalQuantities; ?>;

    // Tạo biểu đồ
    var ctx = document.getElementById('ordersChart').getContext('2d');
    var ordersChart = new Chart(ctx, {
        type: 'bar', // Loại biểu đồ (có thể thay đổi thành 'line', 'pie', v.v.)
        data: {
            labels: hourLabels,
            datasets: [{
                label: 'Số lượng đơn hàng theo giờ (Trang <?php echo $page; ?>)',
                data: totalQuantities,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
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
            
            <?php
            $show_pages = 3; // số trang cần hiển thị bên trái và bên phải của trang hiện tại
            $start_page = max(1, $page - $show_pages);
            $end_page = min($totalPage, $page + $show_pages);

            // Hiển thị trang đầu tiên
            if ($start_page > 1) {
                echo '<li class="page-item"><a class="page-link" href="' . $urlPage . '1">1</a></li>';
                if ($start_page > 2) {
                    echo '<li class="page-item disabled"><span class="page-link">...</span></li>'; // hiển thị dấu "..."
                }
            }

            // Hiển thị các trang giữa
            for ($i = $start_page; $i <= $end_page; $i++) {
                if ($i == $page) {
                    echo '<li class="page-item active"><span class="page-link">' . $i . '</span></li>';
                } else {
                    echo '<li class="page-item"><a class="page-link" href="' . $urlPage . $i . '">' . $i . '</a></li>';
                }
            }

            // Hiển thị trang cuối cùng
            if ($end_page < $totalPage) {
                if ($end_page < $totalPage - 1) {
                    echo '<li class="page-item disabled"><span class="page-link">...</span></li>'; // hiển thị dấu "..."
                }
                echo '<li class="page-item"><a class="page-link" href="' . $urlPage . $totalPage . '">' . $totalPage . '</a></li>';
            }
            ?>
            
            <li class="page-item <?php if ($page == $totalPage) echo 'disabled'; ?>">
                <a class="page-link" href="<?php echo $urlPage . $next; ?>">Tiếp</a>
            </li>
        </ul>
    </nav>
</div>

