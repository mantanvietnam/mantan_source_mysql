<?php 
global $urlThemeActive;
$setting = setting(); 
?>
    <footer>
        <div id="section-footer-main" style="background-image: url(<?php echo @$setting['background_6'];?>);">
            <div class="container">
                <div class="footer-main">
                    <div class="logo-footer">
                        <img src="<?php echo @$setting['logo'];?>" alt="">
                    </div>

                    <div class="list-social">
                        <ul class="d-flex justify-content-center">
                            <li>
                                <a href="<?php echo @$setting['facebook'];?>"><i class="fa-brands fa-facebook-f"></i></a>
                            </li>
                            <li>
                                <a href="<?php echo @$setting['instagram'];?>"><i class="fa-brands fa-square-instagram"></i></a>
                            </li>
                            <li>
                                <a href="<?php echo @$setting['tiktok'];?>"><i class="fa-brands fa-tiktok"></i></a>
                            </li>
                            <li>
                                <a href="<?php echo @$setting['youtube'];?>"><i class="fa-brands fa-youtube"></i></a>
                            </li>
    
                            <li>
                                <a href="<?php echo @$setting['linkedin'];?>"><i class="fa-brands fa-linkedin-in"></i></a>
                            </li>
    
                            <li>
                                <a href="<?php echo @$setting['twitter'];?>"><i class="fa-brands fa-twitter"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <section id="section-footer-bottom">
            <div class="container">
                <div class="footer-bottom text-center">
                    <p>CopyRight © 2021 Trần Toản | All Rights Reserved</p>
                </div>
            </div>
        </section>
       
        <a id="button"></a>
    </footer>

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

</body>
</html>