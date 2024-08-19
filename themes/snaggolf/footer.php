<?php 
    global $urlThemeActive;
    global $settingThemes;
?>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-lg-5 pt-lg-2">
                <h2 class="text-center mb-4">
                    FORM ĐĂNG KÝ
                    HUẤN LUYỆN VIÊN
                </h2>
                <form action="/contact" method="post">
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <div class="form-component">
                                <label for="" class="mb-1">Họ và tên <sup class="text-custom-red">*</sup></label>
                                <input type="hidden" value="<?php echo $csrfToken; ?>" name="_csrfToken">
                                <input type="text" name="name" required placeholder="" class="form-control">
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="form-component">
                                <label for="" class="mb-1">Điện thoại <sup class="text-custom-red">*</sup></label>
                                <input type="text" name="phone" required placeholder="" class="form-control">
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="form-component">
                                <label for="" class="mb-1">Email <sup class="text-custom-red">*</sup></label>
                                <input type="text" placeholder="" name="email" required class="form-control">
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="form-component">
                                <label for="" class="mb-1">Địa chỉ <sup class="text-custom-red">*</sup></label>
                                <input type="text" placeholder="" name="address" required class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-component">
                        <label for="" class="mb-1">Giới thiệu bản thân</label>
                        <textarea name="content" class="form-control"></textarea>
                        <input type="hidden" placeholder="" name="subject" value="ĐĂNG KÝ LÀM HUẤN LUYỆN VIÊN" class="form-control">  
                    </div>
                    <div class="d-flex justify-content-center mt-5 mb-4">
                        <button class="btn custom-button button-reg">
                            Đăng kí ngay
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="DangKyTuVan" tabindex="-1" aria-labelledby="DangKyTuVan" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-lg-5 pt-lg-2">
                <h2 class="text-center mb-4">
                    FORM ĐĂNG KÝ TƯ VẤN NGAY
                </h2>
                <form action="/contact" method="POST">
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <div class="form-component">
                                <label for="" class="mb-1">Họ và tên <sup class="text-custom-red">*</sup></label>
                                <input type="hidden" value="<?php echo $csrfToken; ?>" name="_csrfToken">
                                <input type="text" placeholder="" name="name" required class="form-control">
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="form-component">
                                <label for="" class="mb-1">Email <sup class="text-custom-red">*</sup></label>
                                <input type="text" placeholder="" name="email" required class="form-control">
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="form-component">
                                <label for="" class="mb-1">Địa chỉ <sup class="text-custom-red">*</sup></label>
                                <input type="text" placeholder="" name="address" required class="form-control">
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="form-component">
                                <label for="" class="mb-1">Số điện thoại <sup class="text-custom-red">*</sup></label>
                                <input type="text" placeholder="" name="phone" required class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-component">
                        <label for="" class="mb-1">Ghi chú</label>
                        <textarea class="form-control" name="content"></textarea> 
                        <input type="hidden" placeholder="" name="subject" value=" " class="form-control">                            
                    </div>
                    <div class="d-flex justify-content-center mt-5 mb-4">
                        <button class="btn custom-button button-reg">
                            Đăng kí ngay
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<footer>
    <div class="container">
        <div class="row g-3">
            <div class="col-12 col-lg-5">
                <div class="col-1-contain d-flex d-lg-block">
                    <div class="logo">
                        <img src="<?php echo $urlThemeActive ?>assets/img/Logo.png" alt="">
                    </div>
                    <div class="content d-none d-lg-block">
                        <?php echo @$settingThemes['footer_content']; ?>
                    </div>
                    <div class="social">
                        <div class="d-flex">
                            <a href="">
                                <img src="<?php echo $urlThemeActive; ?>assets/img/Instagram.png" alt="">
                            </a>
                            <a href="">
                                <img src="<?php echo $urlThemeActive; ?>assets/img/Youtube.png" alt="">
                            </a>
                            <a href="">
                                <img src="<?php echo $urlThemeActive; ?>assets/img/facebook.png" alt="">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-3 d-none d-lg-block">
                <h5>Liên kết</h5>
                <div class="link-list">
                    <?php 
                        $menus = getMenusDefault();  
                        if (!empty($menus)) {  
                            foreach ($menus as $categoryMenu) {  
                                echo '<a href="'.$categoryMenu['url'].'">'.$categoryMenu['name'].'</a>';
                            }
                        }
                    ?>
                </div>
            </div>
            <div class="col-12 col-lg-4 d-none d-lg-block">
                <h5 class="form-head">GỬI TIN NHẮN</h5>
                <div class="form">
                    <form action="/contact" method="POST">
                        <input required type="text" name="name" class="form-control" placeholder="Your name">
                        <input type="hidden" value="<?php echo $csrfToken; ?>" name="_csrfToken">
                        <textarea required name="content" class="form-control" placeholder="Content"></textarea>
                        <input type="hidden" placeholder="" name="email" value=" " required class="form-control">
                        <input type="hidden" placeholder="" name="address" value=" " required class="form-control">
                        <input type="hidden" placeholder="" name="phone" value=" " required class="form-control">
                        <input type="hidden" placeholder="" name="subject" value=" " class="form-control">  
                        <button class="custom-button button-reg">GỬI TIN NHẮN</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- ================================================== -->



<!-- Javascript -->
<script
    type="text/javascript"
    src="https://code.jquery.com/jquery-1.11.0.min.js"
  ></script>
  <script
    type="text/javascript"
    src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"
  ></script>
  <script
    type="text/javascript"
    src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"
  ></script>
<!-- <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script> -->
<script src="<?php echo $urlThemeActive; ?>assets/js/bootstrap.bundle.js"></script>
<script src="<?php echo $urlThemeActive; ?>assets/js/forLib.js"></script>
<script src="<?php echo $urlThemeActive; ?>assets/js/main.js"></script>
</body>

</html>