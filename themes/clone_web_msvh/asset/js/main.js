function initializeClocks() {
    // Tìm tất cả các container có class "clock-container"
    var clockContainers = document.querySelectorAll('.clock-container');

    // Lặp qua từng container
    clockContainers.forEach(function(container) {
        // Lấy ra các phần tử span chứa giờ, phút và giây
        
        var hoursSpan = container.querySelector('.hours');
        var minutesSpan = container.querySelector('.minutes');
        var secondsSpan = container.querySelector('.seconds');

        // Thiết lập thời gian ban đầu từ dữ liệu initial-value
        var hours = parseInt(hoursSpan.getAttribute('data-initial-value'));
        var minutes = parseInt(minutesSpan.getAttribute('data-initial-value'));
        var seconds = parseInt(secondsSpan.getAttribute('data-initial-value'));

        // Cập nhật hiển thị thời gian mỗi giây
        var interval = setInterval(function() {
            seconds--;
            if (seconds < 0) {
                minutes--;
                seconds = 59;
            }
            if (minutes < 0) {
                hours--;
                minutes = 59;
            }
            // Định dạng thời gian để hiển thị với hai chữ số
            hoursSpan.textContent = ('0' + hours).slice(-2);
            minutesSpan.textContent = ('0' + minutes).slice(-2);
            secondsSpan.textContent = ('0' + seconds).slice(-2);

            // Kiểm tra xem thời gian có kết thúc không
            if (hours === 0 && minutes === 0 && seconds === 0) {
                clearInterval(interval);
                // Thêm các hành động sau khi thời gian kết thúc (nếu cần)
            }
        }, 1000); // Mỗi giây
    });
}

// Gọi hàm để áp dụng mã JavaScript cho tất cả các đồng hồ khi trang được tải
window.onload = function() {
    initializeClocks();
};