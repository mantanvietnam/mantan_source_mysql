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
                             <div class="title-viewed-product">
                                    <p>Sản phẩm đã thích</p>
                                </div>
                                <div class="group-viewed-product">
                                    <div class="row list-viewed-product">
                                        <?php if(!empty($listData)){
                                                foreach($listData as $key => $item){
                                                if(!empty($item->product)){ ?>
                                        `<div class="item-viewd-product">
                                            <a href="/product/<?php echo $item->product->slug ?>.html" class="btn-img-viewd-product">
                                                <div class="group-viewed-product-img">
                                                    <img src="<?php echo $item->product->image ?>" alt="">
                                                </div>
                                            </a>
                                            <a href="/product/<?php echo $item->product->slug ?>.html" class="btn-name-viewd-product">
                                                <div class="group-viewed-product-name">
                                                    <p><?php echo $item->product->title ?></p>
                                                </div>
                                            </a>
                                            <div class="group-viewed-product-cost">
                                                <h4><?php echo number_format($item->product->price) ?>đ</h4>
                                                <div>
                                                    <p><?php echo number_format($item->product->price_old) ?>đ</p>
                                                    
                                                </div>
                                            </div>
                                            <div class="group-viewed-product-rating">
                                                <div class="group-viewed-product-star">
                                                    <i class="fa-solid fa-star"></i>
                                                    <p>4.8 (34)</p>
                                                </div>
                                                <div class="group-viewed-product-heart">
                                                    <p><?php echo $item->product->sold ?> đã bán</p>
                                                    <i class="fa-solid fa-heart"></i>
                                                </div>
                                            </div>
                                        </div>
                                    <?php }}} ?>
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
?>s