<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đếm Số Lượng Người Dùng Ezpics</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 10px;
        }

        header img {
            max-width: 100%;
            height: auto;
        }

        #user-count {
            font-size: 36px;
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <header>
        <img src="https://ezpics.vn/wp-content/uploads/2023/02/avatar.png" alt="Công Ty Ezpics">
    </header>
    <div id="user-count"></div>

    <script>
        function numberWithCommas(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }

        function updateUserCount() {
            // Gọi AJAX để kiểm tra số lượng người dùng từ server
            // Trong ví dụ này, ta sẽ sử dụng setTimeout để giả lập dữ liệu
            setTimeout(function () {
                $.ajax({
                  method: "GET",
                  url: "https://apis.ezpics.vn/apis/staticNumberUserAPI",
                  data: {}
                })
                .done(function( msg ) {
                    const userCount = msg.number;

                    // Hiển thị số lượng người dùng lên trang web
                    document.getElementById('user-count').textContent = numberWithCommas(userCount) + ' người dùng Ezpics';
                    
                    // Lặp lại hàm này sau 5 phút
                    setTimeout(updateUserCount, 300000);
                });
            }, 1000);
        }

        // Bắt đầu cập nhật số lượng người dùng
        updateUserCount();
    </script>
</body>
</html>
