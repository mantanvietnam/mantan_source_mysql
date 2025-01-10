<?php
$currentMonth = getdate()['mon']; // Lấy tháng hiện tại
$months = [
    1 => "Tháng 1", 2 => "Tháng 2", 3 => "Tháng 3", 4 => "Tháng 4", 5 => "Tháng 5", 
    6 => "Tháng 6", 7 => "Tháng 7", 8 => "Tháng 8", 9 => "Tháng 9", 10 => "Tháng 10", 
    11 => "Tháng 11", 12 => "Tháng 12"
];

// Bắt đầu từ tháng hiện tại và quay vòng
for ($i = 0; $i < 12; $i++) {
    $monthIndex = ($currentMonth + $i - 1) % 12 + 1; // Đảm bảo tháng trong khoảng 1-12
    $class = ($monthIndex === $currentMonth) ? 'current-month' : ''; // Thêm class nếu là tháng hiện tại
    echo "<span class=\"$class\" data-month=\"$monthIndex\">{$months[$monthIndex]}</span>";
}
?>
