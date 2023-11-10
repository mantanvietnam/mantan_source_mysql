<?php
global $session;
$info = $session->read('infoUser');
getHeader();

?>
<link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
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
                                    <p>Chi tiết đơn hàng</p>
                                </div>
                                <div class="group-viewed-product">
                                    <div class="row list-viewed-product">
                                        <table class="table table-bordered">
                                            <thead>
                                              <tr class="">
                                                <th>Hình ảnh</th>
                                                <th>Sản phẩm</th>
                                                <th>Số lượng</th>
                                                <th>Đơn giá</th>
                                                <th>Thành tiền</th>
                                              </tr>
                                            </thead>
                                            <tbody>
                                              <?php 
                                                if(!empty($detail_order)){
                                                  $total = 0;
                                                // debug($order);
                                                  $pay = json_decode($order->discount, true);
                                                 // debug($pay);

                                                  foreach ($detail_order as $item) {
                                                    $price_buy = $item->price * $item->quantity;
                                                    $total += $price_buy;

                                                    echo '<tr>
                                                            <td><img src="'.$item->product->image.'" width="80" /></td>
                                                            <td>'.$item->product->title.'</td>
                                                            <td>'.$item->quantity.'</td>
                                                            <td>'.number_format($item->price).'đ</td>
                                                            <td>'.number_format($price_buy).'đ</td>
                                                          </tr>';
                                                  }

                                                  echo '<tr>
                                                   <tr><td colspan="10">Quà tặng</td><tr>
                                                   <tr>';
                                                    foreach ($detail_order as $item) {
                                                    if(!empty($item->product->present)){
                                                      foreach ($item->product->present as $present) {
                                                    echo '<tr>
                                                            <td><img src="'.$present->image.'" width="80" /></td>
                                                            <td>'.$present->title.'</td>
                                                            <td>1</td>
                                                            <td>0đ</td>
                                                            <td>0đ</td>
                                                          </tr>';
                                                  }}}

                                                echo '   <tr>
                                                  <td colspan="10">
                                                            Tổng tiền: '.number_format($total).'đ<br/>';
                                                  if(!empty($pay['code1']) && !empty($pay['discount_price1'])){
                                                    echo '            <div class="cart-price-code-discount">
                                                                        <div class="cart-price-item">
                                                                            <div class="cart-price-item-title"> '. $pay['code1'] .': -'.number_format($pay['discount_price1']).'đ
                                                                            </div>
                                                                        </div>
                                                                    </div>';
                                                    }  
                                                     if(!empty($pay['code2']) && !empty($pay['discount_price2'])){
                                                echo '            <div class="cart-price-code-discount">
                                                                        <div class="cart-price-item">
                                                                            <div class="cart-price-item-title"> '. $pay['code2'] .': -'.number_format($pay['discount_price2']).'đ
                                                                            </div>
                                                                        </div>
                                                                    </div>';
                                                   }  
                                                   if(!empty($pay['code3']) && !empty($pay['discount_price3'])){
                                                      echo '              <div class="cart-price-code-discount">
                                                                        <div class="cart-price-item">
                                                                            <div class="cart-price-item-title"> '. $pay['code3'] .': -'.number_format($pay['discount_price3']).'đ
                                                                        </div>
                                                                    </div>';  
                                                   }
                                                 echo '   
                                                  Thành tiền: '.number_format($order->total).'đ<br/>
                                                  </td>


                                                  </tr>';
                                                }else{
                                                  echo '<tr>
                                                          <td colspan="10" align="center">Chưa có dữ liệu</td>
                                                        </tr>';
                                                }
                                              ?>
                                            </tbody>
                                          </table>
                                          
                                          <div class="row m-5 ">
                                              <?php if($order->status=='new'){ ?>
                                              
                                              <div class="col-md-3"><a href="/cancelOrder?status=cancel&id=<?php echo $order->id ?>" onclick="return confirm('Bạn có chắc chắn muốn hủy đơn hàng này không?');" class="btn btn-danger">hủy</a></div>
                                            <?php } ?>
                                            
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