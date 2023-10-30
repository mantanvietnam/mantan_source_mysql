<?php
global $session;
$info = $session->read('infoUser');
getHeader();
?>

<main>
    <div id="profile">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div id="profile-user">
                        <div class="title-profile">
                            <h3>Xin chào!</h3>
                            <h4>
                                <?= $info->full_name ?>
                            </h4>
                        </div>
                        <div class="my-account">
                            <nav class="navbar navbar-expand-lg">
                                <div class="container">
                                    <div class="collapse navbar-collapse show" id="navbarNav">
                                        <ul class="nav nav-tabs">
                                            <li class="nav-item sp-sale">
                                                <a class="nav-link active" data-bs-toggle="tab" href="#super-sale">Siêu
                                                    sale 9.9</a>
                                            </li>

                                            <li class="nav-item accordion" id="accordionExample">
                                                <a class="nav-link accordion-button" data-bs-toggle="collapse"
                                                    data-bs-target="#collapseOne" aria-expanded="true"
                                                    aria-controls="collapseOne" href="#" role="button">Tài khoản của
                                                    tôi</a>
                                                <div id="collapseOne" class="accordion-collapse collapse show"
                                                    data-bs-parent="#accordionExample">
                                                    <a class="dropdown-item" href="/infoUser">Hồ
                                                        sơ</a>
                                                    <a class="dropdown-item"  href="/editInfoUser">Chỉnh sửa thông tin</a>
                                                    <a class="dropdown-item"  href="">Địa
                                                        chỉ giao hàng</a>
                                                    <a class="dropdown-item" 
                                                        href="/changepassword">Đổi mật khẩu</a>
                                                </div>
                                            </li>

                                            <li class="nav-item">
                                                <a class="nav-link" data-bs-toggle="tab" href="#my-order">Đơn mua</a>
                                            </li>

                                            <li class="nav-item">
                                                <a class="nav-link" data-bs-toggle="tab" href="#my-product">Sản phẩm</a>
                                            </li>

                                            <li class="nav-item">
                                                <a class="nav-link" data-bs-toggle="tab" href="#my-voucher">Voucher</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8 col-md-8 col-sm-12">
                    <div class="tab-content" style="height:100%">
                        <div id="super-sale" class="tab-pane active" style="border:1px solid #ccc">
                            <div class="title-file">
                                <p>Sửa thông tin tài khoản</p>
                            </div>
                                <div class="detail-file">
                                <form action="" method="post" accept-charset="utf-8" enctype="multipart/form-data"
                                    onsubmit="functions.submitForgot(); return false;">
                                    <input type="hidden" value="<?php echo $csrfToken; ?>" name="_csrfToken">
                                    <div class="body mt-3">
                                        <div class="row g-3">
                                            <div class="col-12">
                                                <div class="form-group-user">
                                                    <label class="mb-2" for="">Họ và tên</label>
                                                    <input type="text" placeholder="" name="full_name"
                                                        value="<?php echo @$info['full_name'] ?>" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group-user">
                                                    <label class="mb-2" for="">Email</label>
                                                    <input type="email" value="<?php echo @$info['email'] ?>"
                                                        name="address" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-12">
                                                <div class="form-group-user">
                                                    <label class="mb-2" for="">Số điện thoại</label>
                                                    <input type="text" name="phone" value="<?php echo @$info['phone'] ?>"
                                                        class="form-control">
                                                </div>
                                            </div>

                                            <button type="submit" class="mt-3 btn btn-primary button-submit-custom" style="width: 100px;">Lưu</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div id="my-address" class="tab-pane">
                            <div class="title-addr">
                                <p>Địa chỉ của tôi</p>
                                <button class="add-adress">
                                    <i class="fa-solid fa-plus"></i>
                                    Thêm địa chỉ mới
                                </button>
                            </div>
                            <div class="address">
                                <div class="row">
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        <div class="content-addr">
                                            <div class="infor-addr">
                                                <span>Lê Viết Hiếu</span>
                                                <p>0912345678</p>
                                            </div>
                                            <div class="detail-addr">
                                                <p>
                                                    Thôn Bộ La
                                                    <br>Xã Vũ Vinh, Huyện Vũ Thư, Tỉnh Thái Bình
                                                </p>
                                            </div>
                                            <div class="btn-address">
                                                <button class="lay">Địa chỉ lấy hàng</button>
                                                <button class="tra">Địa chỉ trả hàng</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-12 up-address">
                                        <div class="btn-group">
                                            <button class="update-addr">Cập nhật</button>
                                            <button class="delete-addr">Xóa</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="address">
                                <div class="row">
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        <div class="content-addr">
                                            <div class="infor-addr">
                                                <span>Lê Viết Hiếu</span>
                                                <p>0912345678</p>
                                            </div>
                                            <div class="detail-addr">
                                                <p>
                                                    Thôn Bộ La
                                                    <br>Xã Vũ Vinh, Huyện Vũ Thư, Tỉnh Thái Bình
                                                </p>
                                            </div>
                                            <div class="btn-address">
                                                <button class="lay">Địa chỉ lấy hàng</button>
                                                <button class="tra">Địa chỉ trả hàng</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-12 up-address">
                                        <div class="btn-group">
                                            <button class="update-addr">Cập nhật</button>
                                            <button class="delete-addr">Xóa</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="address">
                                <div class="row">
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        <div class="content-addr">
                                            <div class="infor-addr">
                                                <span>Lê Viết Hiếu</span>
                                                <p>0912345678</p>
                                            </div>
                                            <div class="detail-addr">
                                                <p>
                                                    Thôn Bộ La
                                                    <br>Xã Vũ Vinh, Huyện Vũ Thư, Tỉnh Thái Bình
                                                </p>
                                            </div>
                                            <div class="btn-address">
                                                <button class="lay">Địa chỉ lấy hàng</button>
                                                <button class="tra">Địa chỉ trả hàng</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-12 up-address">
                                        <div class="btn-group">
                                            <button class="update-addr">Cập nhật</button>
                                            <button class="delete-addr">Xóa</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div id="change-my-pass" class="tab-pane"
                            style="border: 0.5px solid rgb(192, 192, 192);height:100%">
                            <div class="detail-file">
                                <div class="title-file" style="padding: 34px 0 0 0">
                                    <p>Thay đổi mật khẩu</p>
                                </div>
                                <div class="change-password-info">
                                    <form action="" method="post">
                                    <input type="hidden" value="<?php echo $csrfToken;?>" name="_csrfToken">
                                        <div class="item-detail">
                                            <label for="oldPassword" style="width: 200px;">Mật khẩu cũ</label>
                                            <input type="text" id="oldpass" name="oldpass"
                                                placeholder="Vui lòng nhập mật khẩu cũ" required>
                                        </div>
                                        <div class="item-detail">
                                            <label for="oldPassword" style="width: 200px;">Mật khẩu mới</label>
                                            <input type="text" id="pass" name="pass"
                                                placeholder="Vui lòng nhập mật khẩu mới" required>
                                        </div>
                                        <div class="item-detail">
                                            <label for="oldPassword" style="width: 200px;">Nhập lại mật khẩu mới</label>
                                            <input type="text" id="passAgain" name="passAgain"
                                                placeholder="Vui lòng nhập lại mật khẩu mới" required>
                                        </div>
                                        <div class="item-detail btn-submit">
                                            <input type="submit" value="Xác nhận">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div id="my-order" class="tab-pane">
                            <p>52651</p>
                        </div>
                        <div id="my-product" class="tab-pane">
                            <p>52651</p>
                        </div>
                        <div id="my-voucher" class="tab-pane">
                            <div class="tab-voucher">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link active" id="tab1-tab" data-bs-toggle="tab" href="#vouchers"
                                            role="tab" aria-controls="tab1" aria-selected="true">Mã giảm giá</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="tab2-tab" data-bs-toggle="tab" href="#for-you"
                                            role="tab" aria-controls="tab2" aria-selected="false">Dành cho bạn</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-content content-voucher" id="myTabContent">
                                <div class="tab-pane fade show active" id="vouchers" role="tabpanel"
                                    aria-labelledby="tab1-tab">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-12">

                                            <div class="voucher">
                                                <button class="btn-voucher">
                                                    <div class="bg-voucher">
                                                        <img
                                                            src="<?php echo $urlThemeActive ?>/asset/image/voucher.png">
                                                    </div>
                                                    <div class="detail-voucher">
                                                        <div class="logo-voucher">
                                                            <h3>Freeship</h3>
                                                        </div>
                                                        <div class="infor-voucher">
                                                            <h4>Giảm tối đa 30k</h4>
                                                            <p>Đơn tối thiểu 1 triệu</p>
                                                        </div>
                                                    </div>
                                                </button>
                                            </div>


                                            <div class="voucher">
                                                <button class="btn-voucher">
                                                    <div class="bg-voucher">
                                                        <img
                                                            src="<?php echo $urlThemeActive ?>/asset/image/voucher.png">
                                                    </div>
                                                    <div class="detail-voucher">
                                                        <div class="logo-voucher">
                                                            <h3>Freeship</h3>
                                                        </div>
                                                        <div class="infor-voucher">
                                                            <h4>Giảm tối đa 30k</h4>
                                                            <p>Đơn tối thiểu 1 triệu</p>
                                                        </div>
                                                    </div>
                                                </button>
                                            </div>

                                            <div class="voucher">
                                                <button class="btn-voucher">
                                                    <div class="bg-voucher">
                                                        <img
                                                            src="<?php echo $urlThemeActive ?>/asset/image/voucher.png">
                                                    </div>
                                                    <div class="detail-voucher">
                                                        <div class="logo-voucher">
                                                            <h3>Freeship</h3>
                                                        </div>
                                                        <div class="infor-voucher">
                                                            <h4>Giảm tối đa 30k</h4>
                                                            <p>Đơn tối thiểu 1 triệu</p>
                                                        </div>
                                                    </div>
                                                </button>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="voucher">
                                                <button class="btn-voucher">
                                                    <div class="bg-voucher">
                                                        <img
                                                            src="<?php echo $urlThemeActive ?>/asset/image/voucher.png">
                                                    </div>
                                                    <div class="detail-voucher">
                                                        <div class="logo-voucher">
                                                            <h3>Freeship</h3>
                                                        </div>
                                                        <div class="infor-voucher">
                                                            <h4>Giảm tối đa 30k</h4>
                                                            <p>Đơn tối thiểu 1 triệu</p>
                                                        </div>
                                                    </div>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="for-you" role="tabpanel" aria-labelledby="tab2-tab">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="voucher">
                                                <button class="btn-voucher">
                                                    <div class="bg-voucher">
                                                        <img src="<?php echo $urlThemeActive ?>/asset/image/voucher.png">
                                                    </div>
                                                    <div class="detail-voucher">
                                                        <div class="logo-voucher">
                                                            <h3>Freeship</h3>
                                                        </div>
                                                        <div class="infor-voucher">
                                                            <h4>Giảm tối đa 30k</h4>
                                                            <p>Đơn tối thiểu 1 triệu</p>
                                                        </div>
                                                    </div>
                                                </button>
                                            </div>


                                        </div>

                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="voucher">
                                                <button class="btn-voucher">
                                                    <div class="bg-voucher">
                                                        <img src="<?php echo $urlThemeActive ?>/asset/image/voucher.png">
                                                    </div>
                                                    <div class="detail-voucher">
                                                        <div class="logo-voucher">
                                                            <h3>Freeship</h3>
                                                        </div>
                                                        <div class="infor-voucher">
                                                            <h4>Giảm tối đa 30k</h4>
                                                            <p>Đơn tối thiểu 1 triệu</p>
                                                        </div>
                                                    </div>
                                                </button>
                                            </div>

                                            <div class="voucher">
                                                <button class="btn-voucher">
                                                    <div class="bg-voucher">
                                                        <img src="<?php echo $urlThemeActive ?>/asset/image/voucher.png">
                                                    </div>
                                                    <div class="detail-voucher">
                                                        <div class="logo-voucher">
                                                            <h3>Freeship</h3>
                                                        </div>
                                                        <div class="infor-voucher">
                                                            <h4>Giảm tối đa 30k</h4>
                                                            <p>Đơn tối thiểu 1 triệu</p>
                                                        </div>
                                                    </div>
                                                </button>
                                            </div>

                                            <div class="voucher">
                                                <button class="btn-voucher">
                                                    <div class="bg-voucher">
                                                        <img
                                                            src="<?php echo $urlThemeActive ?>/asset/image/voucher.png">
                                                    </div>
                                                    <div class="detail-voucher">
                                                        <div class="logo-voucher">
                                                            <h3>Freeship</h3>
                                                        </div>
                                                        <div class="infor-voucher">
                                                            <h4>Giảm tối đa 30k</h4>
                                                            <p>Đơn tối thiểu 1 triệu</p>
                                                        </div>
                                                    </div>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


<?php
getFooter();
?>