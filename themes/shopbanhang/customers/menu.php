<?php
global $session;
$info = $session->read('infoUser');


?>
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
                                            <!-- <li class="nav-item sp-sale">
                                                <a class="nav-link active" data-bs-toggle="tab" href="#super-sale">Siêu
                                                    sale 9.9</a>
                                            </li> -->

                                            <li class="nav-item accordion" id="accordionExample">
                                                <a class="nav-link accordion-button" data-bs-toggle="collapse"
                                                    data-bs-target="#collapseOne" aria-expanded="true"
                                                    aria-controls="collapseOne" href="#" role="button">Tài khoản của
                                                    tôi</a>
                                                <div id="collapseOne" class="accordion-collapse collapse show"
                                                    data-bs-parent="#accordionExample">
                                                    <a class="dropdown-item" href="/infoUser">Hồ
                                                        sơ</a>
                                                    <a class="dropdown-item" href="/editInfoUser">Chỉnh sửa thông
                                                        tin</a>
                                                    <a class="dropdown-item" href="/deliveryAddress">Địa
                                                        chỉ giao hàng</a>
                                                    <a class="dropdown-item" href="/changepassword">Đổi mật khẩu</a>
                                                </div>
                                            </li>

                                            <li class="nav-item">
                                                <a class="nav-link" data-bs-toggle="tab" href="/listOrder">Đơn mua</a>
                                            </li>

                                            <li class="nav-item accordion" id="accordionExample2">
                                                <a class="nav-link accordion-button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo" href="#" role="button">Sản phẩm</a>
                                                <div id="collapseTwo" class="accordion-collapse collapse show" data-bs-parent="#accordionExample2">
                                                    <a class="dropdown-item" href="/viewProduct">Sản phẩm đã xem</a>
                                                    <a class="dropdown-item" href="/likeProduct">Sản phẩm đã yêu thích</a>
                                                </div>
                                            </li>

                                            <li class="nav-item">
                                                <a class="nav-link" href="/discount">Voucher</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </nav>
                        </div>
                    </div>