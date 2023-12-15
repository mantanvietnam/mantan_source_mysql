<?php
getHeader();
global $urlThemeActive;
global $session;
$setting = setting();

$slide_home= slide_home($setting['id_slide']);
global $session;
$infoUser = $session->read('infoUser');
   	
?>
 <main>
        <section id="section-order">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-12 order-left">
                        <div class="order-left-inner">
                            <div class="title-order-left">
                                Thông tin đơn hàng
                            </div>

                            <div class="product-order-list">
                                <?php foreach($list_product as $item){
                                    if(@$item->statuscart=='true'){
                                 ?>
                                <div class="product-order-item">
                                    <div class="product-order-image">
                                        <div class="product-order-image-inner">
                                            <img src="<?php echo $item->image ?>" alt="">
                                        </div>
                                    </div>

                                    <div class="product-order-detail">
                                        <div class="product-order-name">
                                            <?php echo $item->title ?>
                                        </div>

                                        <div class="product-order-price product-order-flex">
                                            <div class="product-order-left-text">
                                                Giá
                                            </div>

                                            <div class="product-order-left-number">
                                                <?php echo number_format($item->price); ?>đ
                                            </div>
                                        </div>

                                        <div class="product-order-number product-order-flex">
                                            <div class="product-order-left-text">
                                                Số lượng
                                            </div>

                                            <div class="product-order-left-number">
                                                <?php echo $item->numberOrder ?>
                                            </div>
                                        </div>

                                        <!-- <div class="product-order-delete">
                                            <div class="product-order-left-text">
                                                <a href=""><i class="fa-regular fa-trash-can"></i> Xóa</a>
                                            </div>
                                        </div> -->
                                    </div>
                                </div>
                            <?php }} ?>
                                
                            </div>

                            <!-- Danh sách quà tặng  -->
                            <div class="product-order-gift-list">
                                <div class="product-order-gift-item">
                                    
                                    <?php   if(!empty($list_product)){
                                foreach ($list_product as $key => $value) { 
                                     if(!empty($value->present)){
                                    foreach($value->present as $item){ ?>
                                    <div class="product-order-gift-img">
                                        <div class="product-order-gift-img-inner">
                                            <img src="<?php echo @$item->image ?>" alt="">
                                        </div>
                                        <!-- <div class="cart-product-gift-number">
                                                <span><?php echo @$item->numberOrder ?></span>
                                            </div> -->
                                    </div>
                                    <?php }}}} ?>
                                    
                                </div>  
                            </div>

                            <!-- Giá tiền  -->
                            <div class="cart-total-box">
                                <!-- Giá sản phẩm -->
                                <div class="cart-price-item">
                                    <div class="cart-price-item-title">
                                        Giá 
                                    </div>

                                    <div class="cart-price-item-price">
                                        <?php echo number_format($pay['totalPays']); ?>đ
                                    </div>
                                </div>
                                <div class="cart-price-item">
                                    <div class="cart-price-item-title">
                                        Giá vận chuyển
                                    </div>

                                    <div class="cart-price-item-price">
                                        30.000đ
                                    </div>
                                </div>

                            
                                <!-- Giá voucher-->
                                <?php if(!empty($pay['code1']) && !empty($pay['discount_price1'])){ ?>
                                <div class="cart-price-code-discount">
                                    <div class="cart-price-item">
                                        <div class="cart-price-item-title">
                                            <?php echo $pay['code1']; ?>	
                                        </div>
    
                                        <div class="cart-price-item-price">
                                            -<?php echo number_format($pay['discount_price1']); ?>đ
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                             <!-- Giá voucher-->
                                <?php if(!empty($pay['code2']) && !empty($pay['discount_price2'])){ ?>
                                <div class="cart-price-code-discount">
                                    <div class="cart-price-item">
                                        <div class="cart-price-item-title">
                                            <?php echo $pay['code2']; ?>    
                                        </div>
    
                                        <div class="cart-price-item-price">
                                            -<?php echo number_format($pay['discount_price2']); ?>đ
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                             <!-- Giá voucher-->
                                <?php if(!empty($pay['code3']) && !empty($pay['discount_price3'])){ ?>
                                <div class="cart-price-code-discount">
                                    <div class="cart-price-item">
                                        <div class="cart-price-item-title">
                                            <?php echo $pay['code3']; ?>    
                                        </div>
    
                                        <div class="cart-price-item-price">
                                            -<?php echo number_format($pay['discount_price3']); ?>đ
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                                <!-- Giá tổng chiết khẩu -->
                                 <div class="cart-price-total">
                                    <div class="cart-price-item">
                                        <div class="cart-price-item-title">
                                           Tổng chiết khấu   
                                        </div>
    
                                        <div class="cart-price-item-price">
                                            <?php echo number_format( (int) @$pay['discount_price3']+ (int) @$pay['discount_price1']+ (int) @$pay['discount_price2']); ?>đ
                                        </div>
                                    </div>
                                </div>
                                 <!-- Thành tiền -->
                                 <div class="cart-price-total">
                                    <div class="cart-price-total-item">
                                        <div class="cart-price-total-title">
                                            Thành tiền
                                        </div>
    
                                        <div class="cart-price-total-price">
                                            <?php echo number_format($pay['total']); ?>đ
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-8 co-md-8 col-sm-8 col-12 order-right">
                        <form action="" method="post">
                            <input type="hidden" value="<?php echo $csrfToken;?>" name="_csrfToken">
                            <div class="order-right-info">
                                <div class="order-right-title-input">
                                    <div class="number-form-input">1</div>
                                    <div class="title-form-input">
                                        Thông tin người nhận
                                    </div>
                                </div>

                                <div class="order-right-group-input">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control input-required" required="" name="full_name" value="<?php echo @$infoUser->full_name ?>" placeholder="Họ và tên (*)" aria-label="Username">
                                        <input type="text" class="form-control input-required" required="" name="phone" value="<?php echo @$infoUser->phone ?>" placeholder="Điện thoại (*)" aria-label="Server">
                                    </div>

                                    <div class="input-group mb-3">
                                        <input type="email" class="form-control" name="email" value="<?php echo @$infoUser->email ?>" placeholder="Email">
                                    </div>
                                </div>
                            </div>

                            <div class="order-right-info">
                                <div class="order-right-title-input">
                                    <div class="number-form-input">2</div>
                                    <div class="title-form-input">
                                        Địa chỉ nhận hàng
                                    </div>
                                </div>
                                
                                <div class="order-right-group-input">
                                    <div class="input-group mb-3">
                                        <input type="text" id="address" name="address"  required="" class="form-control" placeholder="Nhập địa chỉ (*)" aria-label="Amount (to the nearest dollar)">
                                         <input type="hidden" id="id_customer" name="id_address" class="form-control" placeholder="Username" aria-label="Username">
                                    </div>

                                    
                                </div>
                            </div>

                            <div class="order-right-info">
                                <div class="order-right-title-input">
                                    <div class="number-form-input">3</div>
                                    <div class="title-form-input">
                                        Phương thức thanh toán
                                    </div>
                                </div>
                                
                                <div class="order-right-group-input">
                                   
                                    <div class="input-group mb-3">
                                        <!-- <input type="radio" name="payment" value="1"  required="" placeholder="Username" aria-label="Username">
                                        <label>Thanh toán chuyển khoản</label> -->
                                        <input type="radio" name="payment" value="2"  required="" placeholder="Server" aria-label="Server">
                                        <label>Nhận hàng rồi thanh toán </label>
                                    </div>
                                </div>
                            </div>
                            <div class="order-right-info">
                                <div class="order-right-title-input">
                                    <div class="number-form-input">4</div>
                                    <div class="title-form-input">
                                        Nội dung chú ý
                                    </div>
                                </div>
                                
                                <div class="order-right-group-input">
                                   
                                    <div class="input-group mb-3">
                                        <textarea class="form-control" name="note_user"></textarea>
                                    </div>
                                </div>
                            </div>
                           
                            <div class="order-right-group-button">
                                <a href="/gio-hang" > <button type="button" class="btn btn-primary">Quay lại</button></a>
                                <button type="submit" class="btn btn-primary">Đặt hàng</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>

     <script>
        // Sự kiện xảy ra khi người dùng nhấn nút "Back"
        window.addEventListener('popstate', function(event) {
            // Tải lại trang
            location.reload();
        });
    </script>


 <script>
        // Use the replaceState method to replace the current history entry
        history.replaceState(null, document.title, location.href);

        // Add a popstate event listener
        window.addEventListener('popstate', function(event) {
            // Restore the current state by pushing a new state
            history.pushState(null, document.title, location.href);
        });
    </script>
<script type="text/javascript">
    // tìm khách hàng 
    $(function() {
        function split( val ) {
          return val.split( /,\s*/ );
        }

        function extractLast( term ) {
          return split( term ).pop();
        }

        $( "#address" )
        // don't navigate away from the field on tab when selecting an item
        .bind( "keydown", function( event ) {
            if ( event.keyCode === $.ui.keyCode.TAB && $( this ).autocomplete( "instance" ).menu.active ) {
                event.preventDefault();
            }

            $('#id_customer').val(0);
        })
        .autocomplete({
            source: function( request, response ) {
                $.getJSON( "/apis/searchAddress", {
                    key: extractLast( request.term )
                }, response );
            },
            search: function() {
                // custom minLength
                var term = extractLast( this.value );
                if ( term.length < 2 ) {
                    return false;
                }
               
            },
            focus: function() {
                // prevent value inserted on focus
                return false;
            },
            select: function( event, ui ) {
                var terms = split( this.value );
                // remove the current input
                terms.pop();
                // add the selected item
                terms.push( ui.item.label );

                console.log(ui.item);
               
                $('#address').val(ui.item.label);
                $('#id_customer').val(ui.item.id);
          
                return false;

                tinhtien();

            }
        });
    });
</script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>  
<?php
getFooter();?>