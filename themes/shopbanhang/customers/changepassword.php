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
                                                    <a class="dropdown-item"  href="/deliveryAddress">Địa
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
                                <p>Đổi mật khẩu</p>
                            </div>
                                <div class="detail-file detail-change-password">
                                <form action="" method="post">
                                        <input type="hidden" value="<?php echo $csrfToken; ?>" name="_csrfToken">
                                        <div class="col-12">
                                            <div class="form-group-user mb-4">
                                                <label class="mb-2 mt-3"  for="" >Mật khẩu hiện tại</label>
                                                <div class="d-flex align-items-center input-password">
                                                    <input type="password" placeholder="Vui lòng nhập mật khẩu hiện tại"
                                                        name="oldpass" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group-user mb-4">
                                                <label class="mb-2" for="">Mật khẩu mới</label>
                                                <div class="d-flex align-items-center input-password">
                                                    <input type="password" placeholder="Vui lòng nhập mật khẩu mới" name="pass"
                                                        class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group-user mb-4">
                                                    <label class="mb-2" for="">Nhập lại mật khẩu</label>
                                                    <div class="d-flex align-items-center input-password">
                                                        <input type="password" placeholder="Vui lòng nhập lại mật khẩu mới"
                                                            name="passAgain" class="form-control" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <button type="submit"
                                                class="mt-3 btn btn-primary button-submit-custom" style="width:100px">Lưu</button>
                                    </form>
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