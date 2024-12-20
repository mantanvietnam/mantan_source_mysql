<?php include(__DIR__.'/../header.php'); ?>

<div class="container-xxl flex-grow-1">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light"></span>
        Thống kê số lượng sách mượn theo tháng
    </h4>

    <div class="card">
        <div class="card-header text-center">
            <h5>Biểu đồ tăng trưởng số lượng sách mượn theo tháng</h5>
        </div>
        <div class="card-body">
          <form method="GET" action="">
            <div class="row">
                <div class="col-md-4">
                    <label for="year" class="form-label">Chọn năm</label>
                    <select id="year" name="year" class="form-select">
                        <?php
                        for ($i = 2020; $i <= date('Y'); $i++) {
                            echo "<option value='$i'" . ($i == $year ? " selected" : "") . ">$i</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="month" class="form-label">Chọn tháng</label>
                    <select id="month" name="month" class="form-select">
                        <?php
                        for ($i = 1; $i <= 12; $i++) {
                            $month = str_pad($i, 2, '0', STR_PAD_LEFT);
                            echo "<option value='$month'" . ($month == $month ? " selected" : "") . ">$month</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-4 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary">Lọc</button>
                </div>
            </div>
          </form>
        </div>
        <div class="card-body">
            <!-- Biểu đồ -->
            <canvas id="growthChart" width="400" height="200"></canvas>
        </div>
    </div>
</div>

<?php include(__DIR__.'/../footer.php'); ?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>

var months = <?php echo json_encode($chartDates); ?>;

// Chỉ lấy phần ngày (giả sử định dạng là "YYYY-MM-DD")
months = months.map(function(date) {
    return date.split('-')[2]; // Lấy ngày (phần thứ 3 trong định dạng YYYY-MM-DD)
});

var bookCounts = <?php echo json_encode($chartCounts); ?>;

bookCounts = bookCounts.map(function(count) {
    return count < 0 ? 0 : count; 
});

var ctx = document.getElementById('growthChart').getContext('2d');
var growthChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: months, 
        datasets: [{
            label: 'Số lượng sách mượn',
            data: bookCounts,
            borderColor: 'rgb(75, 192, 192)',
            backgroundColor: 'rgba(75, 192, 192, 0)',
            fill: false,
            borderWidth: 2,
        }]
    },
    options: {
        responsive: true,
        scales: {
            x: {
                title: {
                    display: true,
                    text: 'Ngày'
                }
            },
            y: {
                title: {
                    display: true,
                    text: 'Số lượng sách mượn'
                },
                min: 0  
            }
        }
    }
});

</script>

