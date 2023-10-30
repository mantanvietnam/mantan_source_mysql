<?php
getHeader();
global $urlThemeActive;
global $session;
$setting = setting();

$slide_home= slide_home($setting['id_slide']);
  // debug($list_product);
     // debug($pay);
     // debug($discountCode);

   	
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
                                <?php foreach($list_product as $item){ ?>
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
                            <?php } ?>
                                
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
                                        <?php echo number_format($pay['totalPays']); ?>
                                    </div>
                                </div>

                            
                                <!-- Giá voucher-->
                                <?php if($pay['discountCode']){ ?>
                                <div class="cart-price-code-discount">
                                    <div class="cart-price-item">
                                        <div class="cart-price-item-title">
                                            <?php echo $pay['discountCode']; ?>	
                                        </div>
    
                                        <div class="cart-price-item-price">
                                            -<?php echo number_format($pay['discount_price']); ?>đ
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                                <!-- Giá tổng chiết khẩu -->
                                
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
                        <form action="">
                            <div class="order-right-info">
                                <div class="order-right-title-input">
                                    <div class="number-form-input">1</div>
                                    <div class="title-form-input">
                                        Thông tin người nhận
                                    </div>
                                </div>

                                <div class="order-right-group-input">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Username" aria-label="Username">
                                        <input type="text" class="form-control" placeholder="Server" aria-label="Server">
                                    </div>

                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
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
                                        <input type="text" id="address" name="address" class="form-control" placeholder="Nhập địa chỉ" aria-label="Amount (to the nearest dollar)">
                                         <input type="hidden" id="id_customer" name="id_customer" class="form-control" placeholder="Username" aria-label="Username">
                                    </div>

                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Username" aria-label="Username">
                                        <input type="text" class="form-control" placeholder="Server" aria-label="Server">
                                        <input type="text" class="form-control" placeholder="Server" aria-label="Server">
                                    </div>

                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
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
                                        <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                                    </div>

                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Username" aria-label="Username">
                                        <input type="text" class="form-control" placeholder="Server" aria-label="Server">
                                        <input type="text" class="form-control" placeholder="Server" aria-label="Server">
                                    </div>

                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                                    </div>
                                </div>
                            </div>

                            <div class="order-right-group-button">
                                <button type="submit" class="btn btn-primary">Đặt hàng</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
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