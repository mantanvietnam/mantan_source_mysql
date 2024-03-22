<?php 
global $urlThemeActive;
$setting = setting(); 
?>
    <footer>
        <section id="section-footer" style="background-image: url(<?php echo @$setting['background_4'] ?>);">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="footer-left">
                            <img src="<?php echo @$setting['logo'];?>" alt="">
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="footer-center">
                            <p>THÔNG TIN LIÊN HỆ</p>
                            <ul>
                                <li>Địa chỉ: <?php echo @$setting['address'] ?></li>
                                <li>Hotline: <?php echo @$setting['hotline'] ?></li>
                                <li>Email: <?php echo @$setting['email'] ?></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="footer-right"><?php echo @$setting['content_footer'] ?></div>
                    </div>
                </div>
            </div>
        </section>

        <section id="section-copyright">
            <p class="text-center"><?php echo @$setting['textfooter'] ?></p>
        </section>
    </footer>


    <script>
        // Khai báo một biến để lưu trữ trạng thái của AOS (có animation hay không)
        var aosEnabled = true;
    
        // Khởi tạo AOS với các cài đặt mặc định
        function initAOS() {
            AOS.init({
                // Các tùy chọn AOS ở đây...
            });
        }
    
        // Kiểm tra kích thước màn hình và tắt animation nếu cần
        function handleAnimation() {
            if (window.innerWidth < 768) { // Nếu là màn hình nhỏ hơn 768px (ví dụ: điện thoại)
                if (aosEnabled) { // Kiểm tra xem AOS đã được kích hoạt hay chưa
                    AOS.init({
                        disable: true // Tắt animation
                    });
                    aosEnabled = false; // Ghi nhớ rằng AOS đã được tắt
                }
            } else { // Nếu là màn hình lớn hơn hoặc bằng 768px
                if (!aosEnabled) { // Kiểm tra xem AOS đã bị tắt hay chưa
                    initAOS(); // Khởi tạo AOS lại để kích hoạt animation
                    aosEnabled = true; // Ghi nhớ rằng AOS đã được kích hoạt lại
                }
            }
        }
    
        // Gọi hàm khi trang được tải và khi cửa sổ được resize
        window.addEventListener('load', function() {
            initAOS(); // Khởi tạo AOS khi trang được tải
            handleAnimation(); // Kiểm tra và tắt animation khi trang được tải
        });
        window.addEventListener('resize', handleAnimation); // Kiểm tra và tắt animation khi cửa sổ được resize
    </script>

    <!-- Magnific Popup core JS file -->
    <script src="<?php echo $urlThemeActive ?>/asset/magnific-popup/jquery.magnific-popup.min.js"></script>

    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
         AOS.init();
    </script>

    <script src="<?php echo $urlThemeActive ?>/asset/js/main.js"></script>
    <script src="<?php echo $urlThemeActive ?>/asset/js/slick.js"></script>
    <!-- // Ẩn phần tử -->
    <script>
        var listContainer = document.querySelector('.library-list .row');
        var items = listContainer.querySelectorAll('.library-item');
        var isExpanded = false;

        // Ẩn tất cả phần tử trừ 3 phần tử đầu tiên
        for (var i = 6; i < items.length; i++) {
            items[i].classList.add('hidden');
        }

        function loadMore() {
            if (!isExpanded) {
                // Loại bỏ lớp 'hidden' từ tất cả các phần tử nếu chúng đã được ẩn
                items.forEach(function (item) {
                item.classList.remove('hidden');
                });
                isExpanded = true;
                // document.getElementById('loadMoreBtn').textContent = 'Rút gọn';
            } else {
                // Ẩn bớt các phần tử sau 3 phần tử đầu tiên
                for (var i = 3; i < items.length; i++) {
                items[i].classList.add('hidden');
                }
                isExpanded = false;
                // document.getElementById('loadMoreBtn').textContent = 'Xem thêm';
            }
        }
    </script>

    <script>
        $(document).ready(function() {
            $('.collection-list').magnificPopup({
                delegate: 'a',
                type: 'image',
                tLoading: 'Loading image #%curr%...',
                mainClass: 'mfp-img-mobile',
                gallery: {
                    enabled: true,
                    navigateByImgClick: true,
                    preload: [0,1] // Will preload 0 - before current, and 1 after the current image
                },
                image: {
                    tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
                    titleSrc: function(item) {
                    }
                }
            });
        });
    </script>
</body>
</html>