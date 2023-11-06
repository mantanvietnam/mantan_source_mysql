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
                                                    <a class="dropdown-item" data-bs-toggle="tab" href="#super-sale">Hồ
                                                        sơ</a>
                                                    <a class="dropdown-item" href="/editInfoUser">Chỉnh sửa thông
                                                        tin</a>
                                                    <a class="dropdown-item" href="deliveryAddress">Địa
                                                        chỉ giao hàng</a>
                                                    <a class="dropdown-item" href="/changepassword">Đổi mật khẩu</a>
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
                                <p>địa chỉ giao hàng </p>
                            </div>
                            <div class="detail-file">
                                <form>
                                    <input type="hidden" value="<?php echo $csrfToken; ?>" name="_csrfToken">
                                   <!--  <div class="top mt-4">
                                        <div class="d-flex">
                                            <div class="edit-user-photo me-3">
                                                <label for="" style="font-size: 23px; margin-bottom: 10px;">Ảnh đại
                                                    diện</label>
                                                    <img id="img1" src="<?php echo @$info->avatar ?>"
                                                        style="width: 110px" class="img-responsive">
                                             
                                            </div>
                                        </div>
                                    </div> -->
                                    <?php if(!empty($data)){
                                        foreach($data as $key => $item){
                                     ?>
                                    <div class="item-detail">
                                        <label for="hoTen">Địa chỉ <?php echo $key+1 ?>:</label>
                                        <label for="soDienThoai"></label>
                                    </div>
                                     <div class="address">
                                    <div class="row">
                                        <div class="col-lg-9 col-md-9 col-sm-12">
                                            <div class="content-addr">
                                                <!-- <div class="infor-addr">
                                                    <span>Lê Viết Hiếu</span>
                                                    <p>0912345678</p>
                                                </div> -->
                                                <div class="detail-addr">
                                                    <p><?php echo $item->address_name ?></p>
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
                                    
                                    <?php }} ?>
                                </form>
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