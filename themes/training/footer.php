
    <!-- Footer------------------------------------------------------------------ -->
    <footer>
        <div class="container">
            <h5><?php echo @$setting_value['brand_name'];?></h5>
            <h2><?php echo @$setting_value['title_subscribe'];?></h2>
            <p><?php echo @$setting_value['description_subscribe'];?></p>
            <div class="footer-form-contain">
                <div class="footer-form-inline">
                    <form action="">
                        <div class="row g-1 align-items-center">
                            <div class="col-12 col-md-8 d-flex justify-content-center">
                                <input required type="email" name="email" class="form-control me-0 me-lg-auto"
                                    placeholder="Email của bạn">
                            </div>
                            <div class="col-12 col-md-4 d-flex justify-content-center justify-content-lg-end">
                                <button class="btn btn-yellow">Đăng kí ngay</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="footer-bottom-contain">
                <nav class="navbar navbar-expand-lg navbar-dark">
                    <div class="container-fluid">
                        <div class="collapse navbar-collapse d-none d-lg-block" id="navbarNav">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="#">Trang chủ</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Về chúng tôi</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Liên hệ</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Hỗ trợ</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Chính sách bảo mật</a>
                                </li>
                            </ul>
                        </div>
                        <div class="d-flex">
                            <div class="footer-follow d-flex">
                                <div>Theo dõi tại: </div>
                                <div class="d-flex align-items-center">
                                    <?php 
                                        if(!empty($setting_value['facebook'])){
                                            echo '  <a href="'.$setting_value['facebook'].'" target="_blank">
                                                        <span>
                                                            <i class="fa-brands fa-facebook"></i>
                                                        </span>
                                                    </a>';
                                        }

                                        if(!empty($setting_value['youtube'])){
                                            echo '  <a href="'.$setting_value['youtube'].'" target="_blank">
                                                        <span>
                                                            <i class="fa-brands fa-youtube"></i>
                                                        </span>
                                                    </a>';
                                        }

                                        if(!empty($setting_value['tiktok'])){
                                            echo '  <a href="'.$setting_value['tiktok'].'" target="_blank">
                                                        <span>
                                                            <i class="fa-brands fa-tiktok"></i>
                                                        </span>
                                                    </a>';
                                        }

                                        if(!empty($setting_value['instagram'])){
                                            echo '  <a href="'.$setting_value['instagram'].'" target="_blank">
                                                        <span>
                                                            <i class="fa-brands fa-instagram"></i>
                                                        </span>
                                                    </a>';
                                        }

                                        if(!empty($setting_value['linkedIn'])){
                                            echo '  <a href="'.$setting_value['linkedIn'].'" target="_blank">
                                                        <span>
                                                            <i class="fa-brands fa-linkedin"></i>
                                                        </span>
                                                    </a>';
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <!-- Bg-icon -->
        <img class="footer-bg-icon icon-1 d-none d-lg-block" src="<?php echo $urlThemeActive;?>/assets/img/footer-absolute-1.svg" alt="">
        <img class="footer-bg-icon icon-2 d-none d-lg-block" src="<?php echo $urlThemeActive;?>/assets/img/footer-absolute-2.svg" alt="">
    </footer>
    <!-- End footer------------------------------------------------------------------------------------ -->

    <div class="modal fade" id="xac-nhan-dang-ky" tabindex="-1" aria-labelledby="xac-nhan-dang-ky">
        <div class="modal-dialog">
            <div class="modal-content rounded-4">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h2 class="text-center text-primary-custom">Xác nhận đăng ký</h2>
                    <p class="text-center">Bạn sẽ nhận thông báo/tài liệu thi tại email bạn đã đăng ký</p>
                </div>
                <div class="modal-footer">
                    <a href="" class="w-100 d-block fill-link" >
                        <button type="button" class="btn btn-custom-primary" data-bs-dismiss="modal">Xác nhận</button>
                    </a>
                </div>
                <div class="modal-icon">
                    <img src="https://khoinghiepdtts.hoisinhvien.com.vn/public/frontend/assets/img/modal-success.svg" alt="">
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="email-gui-thanh-cong" tabindex="-1" aria-labelledby="email-gui-thanh-cong">
        <div class="modal-dialog">
            <div class="modal-content rounded-4">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h2 class="text-center text-primary-custom">Gửi thành công!</h2>
                    <p class="text-center">Cảm ơn bạn đã để lại liên hệ, chúng tôi sẽ liên hệ trong thời gian sớm nhất</p>
                </div>
                <div class="modal-icon">
                    <img src="https://khoinghiepdtts.hoisinhvien.com.vn/public/frontend/assets/img/modal-success.svg" alt="">
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="join-exam" tabindex="-1" aria-labelledby="join-exam">
        <div class="modal-dialog">
            <div class="modal-content rounded-4">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h2 class="text-center text-primary-custom">Tham gia kỳ thi</h2>
                    <p class="text-center">Chỉ với 50 phút và 100 câu hỏi, bạn có muốn thử sức tham gia kì thi không?</p>
                </div>
                <div class="modal-footer">
                    <a href="" class="w-100">
                        <button type="button" class="btn btn-custom-primary" data-bs-dismiss="modal">Tham gia ngay</button>
                    </a>
                </div>
                <div class="modal-icon">
                    <img src="https://khoinghiepdtts.hoisinhvien.com.vn/public/frontend/assets/img/modal-dang-ky-and-tham-gia.svg" alt="">
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="login-check" tabindex="-1" aria-labelledby="login-check">
        <div class="modal-dialog">
            <div class="modal-content rounded-4">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h2 class="text-center text-primary-custom">Đăng ký khóa học</h2>
                    <p class="text-center">Bạn hãy đăng nhập trước để có thể tham gia các khoá học của chúng tôi</p>
                </div>
                <div class="modal-footer">
                    <div class="row g-4 w-100">
                        <div class="col-12 col-md-6">
                            <a href="/register" class="w-100 d-block">
                                <button type="button" class="btn btn-custom-primary huy" data-bs-dismiss="modal">Đăng ký</button>
                            </a>
                        </div>
                        <div class="col-12 col-md-6">
                            <a href="/login" class="w-100 d-block">
                                <button type="button" class="btn btn-custom-primary" data-bs-dismiss="modal">Đăng nhập</button>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="modal-icon">
                    <img src="<?php echo $urlThemeActive;?>/assets/img/modal-dang-ky-and-tham-gia.svg" alt="">
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="dang-ky-thanh-cong" tabindex="-1" aria-labelledby="dang-ky-thanh-cong">
        <div class="modal-dialog">
            <div class="modal-content rounded-4">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body mb-4">
                    <h2 class="text-center text-primary-custom">Đăng ký thành công</h2>
                    <p class="text-center">Bạn đã hoàn tất đăng ký, hãy kiểm tra thông báo về email để cập nhật</p>
                </div>
                <div class="modal-footer d-none">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
                <div class="modal-icon">
                    <img src="https://khoinghiepdtts.hoisinhvien.com.vn/public/frontend/assets/img/modal-success.svg" alt="">
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="thanh-cong" tabindex="-1" aria-labelledby="thanh-cong">
        <div class="modal-dialog">
            <div class="modal-content rounded-4">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body mb-4">
                    <h2 class="text-center text-primary-custom">Cập nhật thành công</h2>
                </div>
                <div class="modal-footer d-none">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
                <div class="modal-icon">
                    <img src="https://khoinghiepdtts.hoisinhvien.com.vn/public/frontend/assets/img/modal-success.svg" alt="">
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="error" tabindex="-1" aria-labelledby="error">
        <div class="modal-dialog">
            <div class="modal-content rounded-4">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h2 class="text-center text-primary-custom">Vui lòng thử lại</h2>
                    <p class="text-center">Nội dung khoá học sẽ được cập nhật sớm</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-custom-primary" data-bs-dismiss="modal">Quay lại</button>
                </div>
                <div class="modal-icon">
                    <img src="https://khoinghiepdtts.hoisinhvien.com.vn/public/frontend/assets/img/modal-err.svg" alt="">
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="error-test" tabindex="-1" aria-labelledby="error-test">
        <div class="modal-dialog">
            <div class="modal-content rounded-4">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h2 class="text-center text-primary-custom">Vui lòng thử lại</h2>
                    <p class="text-center">Nội dung bài thi sẽ được cập nhật sớm</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-custom-primary" data-bs-dismiss="modal">Quay lại</button>
                </div>
                <div class="modal-icon">
                    <img src="https://khoinghiepdtts.hoisinhvien.com.vn/public/frontend/assets/img/modal-err.svg" alt="">
                </div>
            </div>
        </div>
    </div>


    <!-- Javascript -->
    <script>
        $(function(){
            var url = window.location.href; 

            $(".me-auto a").each(function() {
                if(url == (this.href)) { 
                    $(this).closest("a").addClass("active");
                }
            });
        });
    </script>
    <script>
        function showPopup(idPopup) {
            $('#'+idPopup).modal('show');
            return false;
        }
    </script>
    
    <script src="<?php echo $urlThemeActive;?>/assets/js/main.js"></script>
</body>

</html>