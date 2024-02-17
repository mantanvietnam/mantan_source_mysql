<?php 
    getHeader();
?>
    <!-- ::::::  Start  Breadcrumb Section  ::::::  -->
    <div class="page-breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 class="rs clsH3Blog">Đăng ký tài khoản</h1>
                    <ul class="list-inline rs">
                        <li class="list-inline-item">Nếu đã có tài khoản hãy <a style="color:red;font-weight:bold" href="/login">ĐĂNG NHẬP</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div> <!-- ::::::  End  Breadcrumb Section  ::::::  -->

    <!-- :::::: Start Main Container Wrapper :::::: -->
    <main id="main-container" class="main-container">
        <div class="container">
            <div class="row flex-column-reverse flex-lg-row">
                <!-- Start Leftside - Sidebar Widget -->
                <?php getSidebar();?>
                <!-- End Left Sidebar Widget -->

                <!-- Start Rightside - Product Type View -->
                <div class="col-lg-9">
                    <!-- ::::::  Start Sort Box Section  ::::::  -->

                    <div class="product-tab-area">
                        <div class="tab-content tab-animate-zoom">
                            <div class="tab-pane show active shop-list" id="sort-list">
                                <div class="row">
                                    <!-- form login -->
                                    <form action="" method="post" class="col-lg-12 col-md-12">
                                        <div class="sidebar__widget">
                                            <div class="sidebar__box">
                                                <div class="sidebar__title">Thông tin đăng ký</div>
                                            </div>
                                            <div class="form-box__single-group">
                                                <label for="cus_name">Họ tên</label>
                                                <input id="cus_name" type="text" required="" name="cus_name" value="">
                                            </div>
                                            <div class="form-box__single-group">
                                                <label for="phone">Số điện thoại</label>
                                                <input id="phone" type="text" required="" name="phone" value="">
                                            </div>
                                            <div class="form-box__single-group">
                                                <label for="email">Email <i style="font-weight: 100">(Không bắt buộc)</i></label>
                                                <input id="email" type="text" name="email" value="">
                                            </div>
                                            <div class="form-box__single-group">
                                                <label for="pass">Mật khẩu</label>
                                                <input id="pass" type="password" name="pass" required="" value="" >
                                            </div>
                                            <div class="form-box__single-group">
                                                <label for="passAgain">Nhập lại mật khẩu</label>
                                                <input id="passAgain" type="password" name="passAgain" required="" value="" >
                                            </div>
                                            <div class="form-box__single-group">
                                                <label for="affiliate">Số điện thoại người giới thiệu <i style="font-weight: 100">(Không bắt buộc)</i></label>
                                                <input id="affiliate" type="text" name="affiliate" value="" autocomplete="off">
                                            </div>

                                            <button style="margin-top: 20px" class="btn btn--box btn--small btn--radius btn--green btn--green-hover-black btn--uppercase font--semi-bold" type="submit">Đăng ký</button> 
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>  <!-- Start Rightside - Product Type View -->
            </div>
        </div>
    </main>  <!-- :::::: End MainContainer Wrapper :::::: -->




<?php getFooter() ?>
<?php if(!empty($tmpVariable['mess'])) { ?>
    <div id="messModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Thông báo</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <?php
                        echo $tmpVariable['mess'];  
                    ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('#messModal').modal('show');
    </script>
<?php } ?>
