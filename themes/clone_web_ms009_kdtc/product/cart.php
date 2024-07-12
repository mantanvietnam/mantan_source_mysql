<?php 
getHeader();
global $infoUser;
$setting = setting(); 
?>
    <main>
        <section id="blog">
            <div id="section-cart">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-md-12 col-12 cart-content-left">
                            <div class="cart-content-left-box">
                                <div class="cart-content">
                                    <div class="cart-heading">
                                        <h1>Giỏ hàng của bạn</h1>
                                        <p>Bạn đang có <strong><?php echo count($list_product);?> sản phẩm</strong> trong giỏ hàng</p>
                                    </div>
                                </div>
            
                                <!-- danh sách sản phẩm đặt -->
                                <?php  
                                $price_total = 0;

                                if(!empty($list_product)){
                                    echo '<div class="list-cart-product">
                                            <div class="table-product">';

                                            foreach ($list_product as $key => $value) {
                                                $link = '/product/'.$value->slug.'.html';

                                                if($value->price_old){
                                                    $price_old = '<del>'.number_format($value->price_old).'₫</del>';
                                                }else{
                                                    $price_old = '';
                                                }

                                                $price_buy = $value->price * $value->numberOrder;
                                                $price_total += $price_buy;

                                                echo '  <div class="table-product-item">
                                                            <div class="table-product-item-img">
                                                                <img src="'.$value->image.'" alt="">
                                                                <a href="/deleteProductCart/?id_product='.$value->id.'">Xóa</a>
                                                            </div>

                                                            <div class="table-product-item-detail">
                                                                <h3>
                                                                    <a href="'.$link.'">'.$value->title.'</a>
                                                                </h3>
                                                                
                                                                <p>'.number_format($value->price).'₫ '.$price_old.'</p>
                                                            </div>

                                                            <div class="table-product-item-price">
                                                                <span>'.number_format($price_buy).'₫</span>
                                                                <div class="cart-button-group">
                                                                    <button>+</button>
                                                                    <input type="text" value="'.$value->numberOrder.'">
                                                                    <button>-</button>
                                                                </div>
                                                            </div>
                                                        </div>';
                                            }

                                    echo    '</div>
                                        </div>
                    
                                        ';
                                }else{
                                    echo '<p>Giỏ hàng trống</p>';
                                }
                                ?>
                                
            
                                <!-- Có thể bạn sẽ thích -->
                                <div id="section-product-featured" class="cart-product-like">
                                    <div class="cart-product-like-title">
                                        <h2>Có thể bạn sẽ thích</h2>
                                    </div>
                                    <!-- Slide sản phẩm -->
                                    <div class="product-like-slide">
                                        <?php 
                                        if(!empty($new_product)){
                                            foreach ($new_product as $key => $product) {
                                                $link = '/product/'.$product->slug.'.html';

                                                $giam = 0;
                                                if(!empty($product->price_old) && !empty($product->price)){
                                                    $giam = round(100 - 100*$product->price/$product->price_old);
                                                }

                                                if($giam>0){
                                                    $giam = '<img src="'.$urlThemeActive.'/asset/img/frame1_5f151d3f2bce42b99a356c60c1cf7864.jpg" alt="">
                                                                <div class="item-sale">
                                                                    <span><i class="fa-solid fa-bolt"></i> -'.$giam.'%</span>
                                                                </div>';
                                                }else{
                                                    $giam = '';
                                                }

                                                if(!empty($product->price)){
                                                    $price = number_format($product->price).'đ';
                                                }else{
                                                    $price = 'Giá liên hệ';
                                                }

                                                if(!empty($product->price_old)){
                                                    $price_old = number_format($product->price_old).'đ';
                                                }else{
                                                    $price_old = '';
                                                }

                                                echo '<div class="product-featured-item">
                                                        <div class="product-featured-inner">
                                                            <div class="product-featured-img">
                                                                <a href="'.$link.'"><img src="'.$product->image.'" alt=""></a>
                                                                '.$giam.'
                                                            </div>
                                
                                                            <div class="product-featured-details">
                                                                <div class="product-featured-title">
                                                                    <a href="'.$link.'">'.$product->title.'</a>
                                                                </div>
                                                                <div class="product-featured-price">
                                                                    <span class="price">'.$price.'</span>
                                                                    <span class="price-del">'.$price_old.'</span>
                                                                </div> 
                                                                <div class="product-button-action">
                                                                    <div class="product-button-cart">
                                                                        <a onclick="addProductToCart('.$product->id.')" href="javascript:void(0);" class="button-cart">
                                                                            <i class="fa-solid fa-cart-shopping"></i><span>Thêm vào giỏ</span>    
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div> 
                                                        </div>
                                                    </div>';
                                            }
                                        }
                                        ?>
                                        
                                    </div>    
                                </div>
                            </div>
                        </div>
        

                        <div class="col-lg-4 col-md-12 col-12 cart-right">
                            <div class="order-box">
                                <h2 class="bill-title">Thông tin đơn hàng</h2>
                                
                                <div class="total-price">
                                    <p>Tổng tiền : </p> 
                                    <span><?php echo number_format($price_total);?>đ</span>
                                </div>

                                <?php 
                                    if($price_total > 0){
                                        echo '  <div class="pay-button">  
                                                    <button onclick="showPopupOrder();" class="checkout-btn btnred disabled">Thanh toán</button>
                                                </div>';
                                    }else{
                                        echo '<div class="policy-delivery">
                                                <div class="summary-alert">
                                                    Giỏ hàng của bạn hiện chưa đạt mức tối thiểu để thanh toán.
                                                </div>
                                            </div>';
                                    }
                                ?>
                            </div>  

                            <div class="policy-purchase">
                                <div class="summary-warning alert-order">						
                                    <p><strong>Hỗ trợ</strong>:</p>
                                    <p>Mọi vấn đề cần hỗ trợ hãy liên hệ ngay số điện thoại <strong><?php echo show_text_clone(@$setting['phone']); ?></strong></p>
                                </div>
                            </div>
                            
                            
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

<!-- Modal -->
<div class="modal fade" id="orderModal" tabindex="-1" role="dialog" aria-labelledby="orderModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="orderModalLabel">Thông tin đặt mua hàng</h5>
      </div>
      <form action="/pay" method="post">
          <input type="hidden" name="id_agency" value="<?php echo @$session->read('infoMemberWeb')->id;?>">
          <input type="hidden" name="name_agency" value="<?php echo @$session->read('infoMemberWeb')->name;?>">
          <input type="hidden" name="name_system" value="<?php echo @$session->read('infoMemberWeb')->name_system;?>">

          <div class="modal-body">
            <input type="hidden" name="id_user" value="<?php echo @$infoUser->id;?>">
            <input type="hidden" name="_csrfToken" value="<?php echo $csrfToken;?>">

            <p>Họ tên (*)</p>
            <input type="text" name="full_name" value="<?php echo @$infoUser->full_name;?>" class="form-control" required>

            <p>Số điện thoại (*)</p>
            <input type="text" name="phone" value="<?php echo @$infoUser->phone;?>" class="form-control" required>

            <p>Địa chỉ nhận hàng (*)</p>
            <input type="text" name="address" value="<?php echo @$infoUser->address;?>" class="form-control" required>

            <p>Email</p>
            <input type="email" name="email" value="<?php echo @$infoUser->email;?>" class="form-control">

            <p>Ghi chú đơn hàng</p>
            <textarea placeholder="" rows="5" class="form-control" name="note_user"></textarea>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Tạo đơn đặt</button>
          </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="notificationModal" tabindex="-1" role="dialog" aria-labelledby="notificationModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="notificationModalLabel">Thông báo</h5>
        </div>
      
        <div class="modal-body" id="notificationMess"></div>
    </div>
  </div>
</div>

<script type="text/javascript">
    function showPopupOrder()
    {
        $('#orderModal').modal('show');
    }

    function showPopupMess(mess)
    {
        $('#notificationMess').html(mess);
        $('#notificationModal').modal('show');
    }
</script>

<script type="text/javascript">
$( document ).ready(function() {
    var messError = '<?php echo @$_GET['error']?>';

    if(messError=='create_order_done'){
        showPopupMess('Tạo đơn hàng thành công, bộ phận CSKH sẽ sớm liên hệ với anh/chị.');
    }else if(messError=='empty_cart'){
        showPopupMess('Tạo đơn thất bại do giỏ hàng trống');
    }else if(messError=='empty_data'){
        showPopupMess('Tạo đơn thất bại do gửi thiếu dữ liệu');
    }
});
</script>

<?php getFooter();?>