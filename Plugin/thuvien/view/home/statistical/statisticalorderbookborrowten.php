<?php include(__DIR__.'/../header.php'); ?>

<div class="container-xxl flex-grow-1">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light"></span>
        Thống kê số lượng 10 quyển sách mượn nhiều nhất
    </h4>

    <div class="card">
        <div class="card-header text-center">
            <h5>Biểu đồ số lượng sách mượn nhiều nhất</h5>
        </div>
        <div class="card-body">
            <!-- Biểu đồ -->
            <canvas id="borrowChart" width="400" height="200"></canvas>
        </div>
    </div>
</div>

<?php include(__DIR__.'/../footer.php'); ?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>

var bookNames = <?php echo $chartBookNames; ?>; 
var borrowCounts = <?php echo $chartBorrowCounts; ?>; 

var ctx = document.getElementById('borrowChart').getContext('2d');
var borrowChart = new Chart(ctx, {
    type: 'bar',  
    data: {
        labels: bookNames,  
        datasets: [{
            label: 'Số lần mượn',
            data: borrowCounts,  
            backgroundColor: 'rgba(75, 192, 192, 0.2)',  
            borderColor: 'rgb(75, 192, 192)',  
            borderWidth: 1,  
        }]
    },
    options: {
        responsive: true,
        scales: {
            x: {
                title: {
                    display: true,
                    text: 'Tên Sách'  
                }
            },
            y: {
                title: {
                    display: true,
                    text: 'Số lần mượn'  
                },
                beginAtZero: true  
            }
        }
    }
});
</script>

