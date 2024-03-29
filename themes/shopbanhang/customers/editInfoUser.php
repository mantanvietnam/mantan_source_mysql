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
                    <?php include('menu.php'); ?>
                </div>

                <div class="col-lg-8 col-md-8 col-sm-12">
                    <div class="tab-content" style="height:100%">
                        <div id="super-sale" class="tab-pane active" style="border:1px solid #ccc">
                            <div class="title-file">
                                <p>Sửa thông tin tài khoản</p>
                            </div>
                                <div class="detail-file">
                                 <form action="" method="post" accept-charset="utf-8" enctype="multipart/form-data" onsubmit="functions.submitForgot(); return false;">
                                <input type="hidden" value="<?php echo $csrfToken; ?>" name="_csrfToken">
                                    <div class="top">
                                        <div class="d-flex">
                                            <div class="edit-user-photo me-3">
                                                <!-- <label for="" style="font-size: 23px; margin-bottom: 10px;">Ảnh đại
                                                    diện</label> -->

                                                <div class="m_bg_img">
                                                    <input type="file" onchange="readURL1(this);" name="avatar">

                                                    <img id="img1" src="<?php echo @$info['avatar'] ?>" class="img-responsive">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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

                                            <button type="submit" class="mt-3 btn btn-primary button-submit-custom" style="width: 100px">Lưu</button>
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

<script>
    function readURL1(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#img1')
                    .attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<style>
    .edit-user-photo{
        position: relative;
    }
    .thaydoi {
        padding: 0 20px;
    }

    .m_bg_img {
        width: 140px;
        height: 140px;
        overflow: hidden;
        display: flex;
        justify-content: center;
        align-items: center;
        border: 1px solid #ddd;
        max-width: 100%;
        border-radius: 50%;
        overflow: hidden;
        background: white;
    }

    input[type=file] {
        display: block;
        filter: alpha(opacity=0);
        height: 100%;
        width: 100%;
        opacity: 0;
        position: absolute;
        right: 0;
        text-align: right;
        top: 0;
        cursor: pointer;
        z-index: 5;
    }

    .m_bg_img img {
        max-width: 100% !important;
    }


    .button-submit-custom {
        width: 200px;
    }
</style>

<?php
getFooter();
?>