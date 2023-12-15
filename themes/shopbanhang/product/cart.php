<?php
getHeader();
global $urlThemeActive;
global $session;
$infoUser = $session->read('infoUser'); 

$setting = setting();

$slide_home= slide_home($setting['id_slide']);
//debug($list_product);
$price_total = 0;


?>

<style>
    .menu-mobile{
        display: none
    }

    .icon-phone-bottom{
        display: block;
    }

    @media (max-width: 445px){
        .contact-fixed {
            bottom: 100px;
            right: 22px;
        }
    }
</style>

<main>

    <form action="/addDiscountCode"  method="get">
        <section id="section-cart">
            <div class="container">
                <div class="title-section-cart">
                    <h1>Giỏ hàng</h1>
                </div>

                <div class="cart-col">
                    <div class="row">
                        <!-- Bảng -->
                        <div class="col-lg-9 col-md-12 col-sm-12 col-12 table-cart-left">
                            <div id="desktop_view">
                           <?php if(!empty($list_product)){ ?>
                            <div class="table-top">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col col-check">
                                                 <input class="form-check-input" type="checkbox" onclick="checkproductAll()" value="1" id="allcheck" <?php if($checkproductAll=='true'){echo 'checked';} ?>> 
                                            </th>
                                            <th scope="col col-name">Tên sản phẩm</th>
                                            <th scope="col col-price">Đơn giá</th>
                                            <th scope="col col-number">Số lượng</th>
                                            <th scope="col col-total">Thành tiền</th>
                                            <th scope="col col-delete">
                                                 <a href="/clearCart"><i class="fa-regular fa-trash-can"></i></a>
                                            </th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>  
                            <div class="table-border">
                                <table class="table table-center">
                                    <tbody>
                                        <!-- Sản phẩm -->
                                        <?php  $price_total = 0;
                                        $total = 0;
                            
                                            foreach ($list_product as $key => $value) {
                                            $link = '/san-pham/'.$value->slug.'.html';
                                            $total += 1;
                                            if($value->price_old){
                                                $price_old = '<del>'.number_format($value->price_old).'₫</del>';
                                            }else{
                                                $price_old = '';
                                            }
                                            $price_buy  = 0;
                                            $price_buy = @$value->price * @$value->numberOrder;
                                            if($value->statuscart=="true"){
                                                
                                                $price_total += $price_buy;
                                            }?>
                                        <tr>
                                            <!-- check -->
                                            <td class="td-check">
                                                <input class="form-check-input" type="checkbox" onclick="checkupdatecart(<?php echo $value->id ?>)" value="1" id="checkproduct<?php echo $value->id ?>" <?php  if($value->statuscart=='true'){echo 'checked';} ?>>

                                            </td>
        
                                            <!-- Tên -->
                                            <td class="td-name">
                                                <div class="cart-product-name-box">
                                                    <a href="<?php echo $link ?>">
                                                    <div class="cart-product-image">
                                                        <img src="<?php echo $value->image ?>" width="100" alt="">
                                                    </div>
        
                                                    <div class="cart-product-name">
                                                        <p><?php echo $value->title ?></p>
                                                    </div>
                                                </a>
                                                </div>
                                            </td>
        
                                            <!-- Đơn giá -->
                                            <td class="td-price">
                                                <div class="cart-product-price">
                                                    <div class="cart-product-price-real">
                                                        <span><?php echo number_format(@$value->price).'₫ ' ?></span>
                                                        <input type="hidden" name="price<?php echo $total ?>" id="price<?php echo $total ?>" value="<?php echo @$value->price ?>">

                                                    </div>
                                                     <?php  if($value->price_old>$value->price){  ?>
                                                    <div class="cart-product-price-discount">
                                                        <del><?php echo number_format($value->price_old); ?>đ</del>
                                                    </div>
                                                <?php } else{ echo '<p class="none-price-discout">&nbsp;</p>';} ?>
                                                </div>
                                            </td>
        
                                            <!-- Số lượng -->
                                            <td class="td-number">
                                                <div class="cart-product-number">
                                                    <div class="product-detail-number-item">
                                                        <div class="qty-input">
                                                            <button onclick="minusQuantity(<?php echo $total ?>, <?php echo $value->id; ?>)" class="qty-count-minus" data-action="minus" type="button">-</button>
                                                            <input id="quantity_buy<?php echo $total ?>" min="0" max="<?php echo $value->quantity ?>" onchange="tinhtien()" class="product-qty" type="text" name="quantity_buy" value="<?php echo $value->numberOrder ?>" min="0">
                                                            <input id="statuscart<?php echo $total ?>" min="0" max="<?php echo $value->quantity ?>" onchange="tinhtien()" class="product-qty" type="hidden" name="statuscart" value="<?php echo $value->statuscart ?>" min="0">
                                                            <button onclick="plusQuantity(<?php echo $total ?>, <?php echo $value->id; ?>)" class="qty-count-add" data-action="add" type="button">+</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
        
                                            <!-- Thành tiền -->
                                            <td class="td-total">
                                                <div class="cart-product-total">
                                                    <p id='price_buy<?php echo $total ?>'><?php echo number_format(@$price_buy); ?>đ</p>
                                                </div>
                                            </td>
        
                                            <!-- Xóa -->
                                            <td class="td-delete">
                                                <a href="/deleteProductCart/?id_product=<?php echo $value->id ?>"><i class="fa-regular fa-trash-can"></i></a>
                                            </td>
                                        </tr>
        
                                       <?php } ?>
                                    </tbody>
                                </table>

                                <table class="table table-bottom">
                                    <!-- Sản phẩm quà tặng -->
                                    <?php   if(!empty($list_product)){
                                        foreach ($list_product as $key => $value) { 
                                     if(!empty($value->present)){
                                    foreach($value->present as $item){
                                 
                                    ?>
                                    <tr class="tr-gift">
                                        <td  class="td-name">
                                            <div class="cart-gift-image-inner">
                                                <div class="cart-gift-image">
                                                    <img src="<?php echo @$item->image ?>" alt="">
                                                </div>

                                                <div class="cart-product-name-box">
                                                    <div class="cart-product-gift-text">
                                                        <p>[Quà tặng]</p>
                                                    </div>

                                                    <div class="cart-product-name-gift">
                                                        <p><?php echo @$item->title ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>

                                        <td >
                                            <div class="cart-product-gift-number">
                                                <span><?php echo @$item->numberOrder ?></span>
                                            </div>
                                        </td>

                                    </tr>
                                <?php }}}} ?>
                                </table>
                            </div>
                            <?php }else{?>
                            <div class="table-empty">
                                <div class="img-empty">
                                    <img src="<?php echo $urlThemeActive ?>asset/image/emptyproduct.png" alt="">
                                </div>

                                <div class="text-empty">
                                     <p>Không có sản phẩm nào trong giỏ hàng</p>
                                </div>
                              
                                <div class="link-empty">
                                    <a href="/">Tiếp tục mua sắm</a>
                                </div>
                            </div>
                            <?php } ?>

                      

                            
                        </div>
                            


                              <!-- Cart -->
                            <section id="product-mobile">
                                <div class="container">
                                    

                                    <div class="product-mobile-group">
                                        <!-- Sản phẩm -->
                                        <?php if(!empty($list_product)){ ?>
                                            <div class="product-mobile-top-table">
                                        <div class="product-mobile-radio">
                                            <input class="form-check-input" type="checkbox"  onclick="checkproductAll()" value="1" id="allcheck" <?php if($checkproductAll=='true'){echo 'checked';} ?>>
                                            <label>Chọn tất cả</label>
                                        </div>

                                        <div class="product-delete-mobile">
                                            <a href="/clearCart"><i class="fa-regular fa-trash-can"></i></a>
                                        </div>
                                    </div>

                                            <?php $price_total = 0;
                                            $total = 0;
                                
                                                foreach ($list_product as $key => $value) {
                                                $link = '/san-pham/'.$value->slug.'.html';
                                                $total += 1;
                                                if($value->price_old){
                                                    $price_old = '<del>'.number_format($value->price_old).'₫</del>';
                                                }else{
                                                    $price_old = '';
                                                }
                                                $price_buy  = 0;
                                                $price_buy = @$value->price * @$value->numberOrder;
                                                if($value->statuscart=="true"){
                                                    
                                                    $price_total += $price_buy;
                                                }?>
                                        <div class="combo-product-mobile">
                                            <div class="product-mobile-radio">
                                                <input class="form-check-input" type="checkbox" onclick="checkupdatecart(<?php echo $value->id ?>)" value="1" id="checkproduct<?php echo $value->id ?>" <?php  if($value->statuscart=='true'){echo 'checked';} ?>>
                                            </div>
                                            <div class="product-mobile-img">
                                                <a href=""><img src="<?php echo $value->image ?>" alt=""></a>
                                            </div>
                                            <div class="product-mobile-detail">
                                                <div class="product-mobile-name">
                                                    <p><?php echo $value->title ?></p>

                                                </div>
                                                <div class="product-mobile-cost">
                                                    <p>Giá</p>
                                                    <p><?php echo number_format($value->price); ?>đ</p>
                                                </div>
                                                <div class="product-mobile-quantity cart-product-number">
                                                    <p>Số lượng</p>
                                                    <div class="product-mobile-quantity-btn product-detail-number-item">
                                                        <div class="qty-input">
                                                            <!-- <button onclick="decreaseValue()" class="qty-count-minus" data-action="minus" type="button">-</button>
                                                            <input id="valueInput" class="product-qty" type="text" name="product-qty" value="1" min="0">
                                                            <button onclick="increaseValue()" class="qty-count-add" data-action="add" type="button">+</button> -->
                                                            <input type="hidden" name="price<?php echo $total ?>" id="price<?php echo $total ?>" value="<?php echo @$value->price ?>">

                                                            <button onclick="minusQuantity(<?php echo $total ?>, <?php echo $value->id; ?>)" class="qty-count-minus" data-action="minus" type="button">-</button>
                                                                <input id="quantity_buy<?php echo $total ?>" min="0" max="<?php echo $value->quantity ?>" onclick="tinhtien()" class="product-qty" type="text" name="quantity_buy" value="<?php echo $value->numberOrder ?>" min="0">
                                                                <input id="statuscart<?php echo $total ?>" min="0" max="<?php echo $value->quantity ?>" onclick="tinhtien()" class="product-qty" type="hidden" name="statuscart" value="<?php echo $value->statuscart ?>" min="0">
                                                                <button onclick="plusQuantity(<?php echo $total ?>, <?php echo $value->id; ?>)" class="qty-count-add" data-action="add" type="button">+</button>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="product-delete-mobile">
                                                    <a href="/deleteProductCart/?id_product=<?php echo $value->id ?>"><i class="fa-regular fa-trash-can"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <?php } ?>
                                    
                                        <?php   if(!empty($list_product)){
                                            foreach ($list_product as $key => $value) { 
                                        if(!empty($value->present)){
                                        foreach($value->present as $item){
                                    
                                        ?>
                                        <!--  qua tang -->
                                        <div class="present-mobile">
                                            <div class="present-img">
                                                <img src="<?php echo @$item->image ?>" alt="">
                                            </div>
                                            <div class="present-content">
                                                <span>[  Quà tặng  ]</span>
                                                <div class="present-detail">
                                                    <p><?php echo @$item->title ?></p>
                                                    <p><?php echo @$item->numberOrder ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <?php }}}} ?>
                                        <?php }else{ ?>
                                            <div class="table-empty">
                                                <div class="img-empty">
                                                    <img src="<?php echo $urlThemeActive ?>asset/image/emptyproduct.png" alt="">
                                                </div>

                                                <div class="text-empty">
                                                    <p>Không có sản phẩm nào trong giỏ hàng</p>
                                                </div>
                                            
                                                <div class="link-empty">
                                                    <a href="/">Tiếp tục mua sắm</a>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </section>

                            <?php if(!empty($prodiscount)){ ?>
                            <div class="cart-left-bottom chek checkud">
                                <div class="title-cart-left-bottom">
                                        Ưu đãi dành cho bạn
                                </div>

                                <div class="row">

                                    <!-- Sản phẩm đi kèm -->
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 cart-product-gift-right">
                                        <div class="cart-product-gift-item-list">
                                            <div class="cart-product-gift-right-inner">
                                                 <?php   
                                                    foreach(@$prodiscount as $item){
                                                            $checkud = 1;
                                                            ?>
                                                <div class="cart-product-gift-item">
                                                    <div class="product-item-inner">
                                                        <div class="product-img">
                                                            <a href="/san-pham/<?php echo  $value->slug ?>.html"><img src="<?php echo $item->image ?>" alt="<?php echo  $item->title ?>"></a>
                                                        </div>
                            
                                                        <div class="product-info">
                                                            <div class="product-name">
                                                                <a href="/san-pham/<?php echo  $item->slug ?>.html"><?php echo  $item->title ?></a>
                                                            </div>
                                                            <div class="product-price">
                                                                <?php if(!empty($item->pricepro_discount)){ ?>
                                                                <p><?php echo number_format(@$item->pricepro_discount); ?>đ</p>
                                                            <?php }else{ echo '<p>0đ</p>'; } ?>
                                                            </div>

                                                            <div class="product-discount">
                                                                <del><?php echo number_format(@$item->price_old); ?>đ</del><span> 
                                                            </div>
                                                            
                                                            
                                                        </div>

                                                        <div class="product-button-cart product-button-cart-add">
                                                            <a onclick="addProductdiscountCart(<?php echo $item->id; ?>,'true')">Thêm vào giỏ hàng</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php } ?>
                                               
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                           
                            <?php } ?>

                            <div class="cart-left-bottom"  id="desktop_view1" >
                                <div class="title-cart-left-bottom">
                                  Sản phẩm khác
                                </div>

                                <div class="row">

                                    <!-- Sản phẩm đi kèm -->
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 cart-product-gift-right">
                                        <div class="cart-product-gift-item-list">
                                            <div class="cart-product-gift-right-inner">
                                                <?php if(!empty($new_product)){
                                                    foreach($new_product as $value){
                                                 ?>
                                                <div class="cart-product-gift-item">
                                                    <div class="product-item-inner">
                                                        <div class="product-img">
                                                            <a href="/san-pham/<?php echo  $value->slug ?>.html"><img src="<?php echo $value->image ?>" alt="<?php echo  $value->title ?>"></a>
                                                        </div>
                            
                                                        <div class="product-info">
                                                            <div class="product-name">
                                                                <a href="/san-pham/<?php echo  $value->slug ?>.html"><?php echo  $value->title ?></a>
                                                            </div>
                            
                                                            <div class="product-price">
                                                                <p><?php echo number_format(@$value->price); ?>đ</p>
                                                            </div>

                                                            <div class="product-discount">
                                                                <?php if(!empty($value->price_old)){ ?>
                                                                <del><?php echo number_format(@$value->price_old); ?>đ</del>
                                                            <?php } else{ echo '<p class="none-price-discout">&nbsp;</p>';}?>
                                                            </div>
                                                            
                                                            
                                                        </div>

                                                        <div class="product-button-cart product-button-cart-add">
                                                            <a onclick="addProduct(<?php echo $value->id; ?>,'true')">Thêm vào giỏ hàng</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php }} ?>
                                               
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Mã giảm giá và tổng tiền -->
                        <div class="col-lg-3 col-md-12 col-sm-12 col-12 table-cart-right">
                            
                                <input type="hidden" value="<?php echo $csrfToken;?>" name="_csrfToken">
                            <div class="cart-code-discount-right">
                                <div class="title-code-enter">
                                    Mã giảm giá
                                </div>

                                <div class="enter-code-discount">
                                    <input type="text" name="discountCode" id="discountCode" placeholder="Nhập mã giảm giá tại đây">
                                    <a onclick="searchDiscountCodeAPI()">Áp dụng</a>
                                </div>

                              

                                <div class="list-code-discount">
                                    <!-- Mã giảm giá -->
                                    <?php
                                     foreach($category as $key => $value){ ?>
                                    <div class="list-code-item">
                                        <div class="title-code-discount">
                                           <?php echo $value['name']; ?>
                                        </div>
    
                                        
                                            <?php if(!empty($value['discountCode'])){
                                                foreach($value['discountCode'] as $k => $item){
                                                     $voucher = "";
                                                    if(@$price_total < @$item->applicable_price){

                                                    $voucher= 'voucher-disabled';
                                                }
                                             ?>
                                            <label class="voucher" for="checkcode<?php echo @$key ?>-<?php echo @$k ?>">
                                                <div class="btn-voucher <?php echo $voucher ?>">
                                                    <div class="bg-voucher">
                                                        <img src="<?php echo $urlThemeActive;?>asset/image/voucher.png">
                                                    </div>
                                                    <div class="detail-voucher">
                                                        <div class="logo-voucher">
                                                            <h3><?php echo $item->code; ?></h3>
                                                        </div>
                                                        <div class="infor-voucher">
                                                            <h4><?php echo $item->note; ?></h4>
                                                            <?php if(!empty($item->applicable_price)){ ?>
                                                            <p>Đơn tối thiểu <?php echo number_format($item->applicable_price); ?> đ</p>
                                                        <?php } ?>
                                                        <?php if(!empty($item->maximum_price_reduction)){ ?>
                                                            <p>Giá giảm tối đa <?php echo number_format($item->maximum_price_reduction); ?> đ</p>
                                                        <?php } ?>
                                                        </div>
                                                        <div class="check-voucher" onclick="searchDiscountCodeAPI('<?php echo @$item->code ?>', <?php echo @$key ?>, <?php echo @$k ?>)">
                                                            <input class="form-check-input checkbox-<?php echo @$key ?> checkcode<?php echo @$key ?>-<?php echo @$k ?>"   type="checkbox" name="code<?php echo @$key ?>" value="<?php echo $item->code ?>" id="checkcode<?php echo @$key ?>-<?php echo @$k ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </label>
                                        <?php }}     ?>
                                        
                                    </div>
                                    <?php } ?>
                                    
                                </div>
                            </div>

                            <div class="cart-total-box">
                                <!-- Giá sản phẩm -->
                                <div class="cart-price-item">
                                    <div class="cart-price-item-title">
                                        Giá 
                                    </div>

                                    <div class="cart-price-item-price" id="pricetotal">
                                      <?php echo number_format(@$price_total); ?>đ
                                    </div>
                                    <input type="hidden" name="totalPays" id="totalPays" value="<?php echo $price_total; ?>">
                                </div>
                               <?php 
                               $ship = 0;
                               if(@$price_total>0){ 
                                $ship = 30000; 
                                 echo '<div class="cart-price-item">
                                    <div class="cart-price-item-title">
                                        Giá vận chuyển 
                                    </div>

                                    <div class="cart-price-item-price" id="pricetotal">
                                      30.000đ
                                    </div>
                                    <input type="hidden" name="totalPays" id="totalPays" value="<?php echo $price_total; ?>">
                                </div>';
                            } ?>
                            
                                <!-- Giá voucher-->
                                <div class="cart-price-code-discount">
                                    <div class="cart-price-item" id="discountPrice1">
                                        
                                    </div>
                                    <input type="hidden"  name="discount_price1" value="" id="discount_price1">
                                    <input type="hidden"  name="maximum_price_reduction1" value="" id="maximum_price_reduction1">
                                    <input type="hidden"  name="discount1" value="" id="discount1">
                                    <input type="hidden"  name="code1" value="" id="code1">
                                    <input type="hidden"  name="applicable_price1" value="" id="applicable_price1">
                                    
                                </div>

                                <div class="cart-price-code-discount">
                                    <div class="cart-price-item" id="discountPrice2">
                                        
                                    </div>
                                    <input type="hidden"  name="discount_price2" value="" id="discount_price2">
                                    <input type="hidden"  name="maximum_price_reduction2" value="" id="maximum_price_reduction2">
                                    <input type="hidden"  name="discount2" value="" id="discount2">
                                    <input type="hidden"  name="code2" value="" id="code2">
                                    <input type="hidden"  name="applicable_price2" value="" id="applicable_price2">
                                    
                                </div>

                                <div class="cart-price-code-discount">
                                    <div class="cart-price-item" id="discountPrice3">
                                        
                                    </div>
                                    <input type="hidden"  name="discount_price3" value="" id="discount_price3">
                                    <input type="hidden"  name="maximum_price_reduction3" value="" id="maximum_price_reduction3">
                                    <input type="hidden"  name="discount3" value="" id="discount3">
                                    <input type="hidden"  name="code3" value="" id="code3">
                                    <input type="hidden"  name="applicable_price3" value="" id="applicable_price3">
                                    
                                </div>

                                 <!-- Giá tổng chiết khẩu -->
                                <div class="cart-price-sum-discount">
                                    <div class="cart-price-sum-discount-item">
                                        <div class="cart-price-sum-discount-title">
                                            Tổng chiết khấu
                                        </div>
    
                                        <div class="cart-price-sum-discount-price" id="totalck">
                                            0đ
                                        </div>
                                    </div>
                                </div>

                                 <!-- Thành tiền -->
                                 <div class="cart-price-total">
                                    <div class="cart-price-total-item">
                                        <div class="cart-price-total-title">
                                            Thành tiền
                                        </div>
    
                                        <div class="cart-price-total-price" id="totals">
                                           <?php echo number_format(@$price_total+ @$ship); ?>đ
                                        </div>
                                         <input type="hidden" value="<?php echo $price_total+ @$ship; ?>" name="total" id=total>
                                    </div>
                                </div>
                            </div>

                            <div class="cart-button-buy">
                               
                                <input type="submit" value="Đặt hàng">
                           
                            </div>
                          
                        </div>
                        <div class="cart-left-bottom"  id="product-mobile1" >
                                <div class="title-cart-left-bottom">
                                  Sản phẩm khác
                                </div>

                                <div class="row">

                                    <!-- Sản phẩm đi kèm -->
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 cart-product-gift-right">
                                        <div class="cart-product-gift-item-list">
                                            <div class="cart-product-gift-right-inner">
                                                <?php if(!empty($new_product)){
                                                    foreach($new_product as $value){
                                                 ?>
                                                <div class="cart-product-gift-item">
                                                    <div class="product-item-inner">
                                                        <div class="product-img">
                                                            <a href="/san-pham/<?php echo  $value->slug ?>.html"><img src="<?php echo $value->image ?>" alt="<?php echo  $value->title ?>"></a>
                                                        </div>
                            
                                                        <div class="product-info">
                                                            <div class="product-name">
                                                                <a href="/san-pham/<?php echo  $value->slug ?>.html"><?php echo  $value->title ?></a>
                                                            </div>
                            
                                                            <div class="product-price">
                                                                <p><?php echo number_format(@$value->price); ?>đ</p>
                                                            </div>

                                                            <div class="product-discount">
                                                                <del><?php echo number_format(@$value->price_old); ?>đ</del><span> 
                                                            </div>
                                                            
                                                            
                                                        </div>

                                                        <div class="product-button-cart product-button-cart-add">
                                                            <a onclick="addProduct(<?php echo $value->id; ?>,'true')">Thêm vào giỏ hàng</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php }} ?>
                                               
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>

            </div>
        </section>

        <section id="section-modal-cart">
            <!-- Modal -->
            <!-- <div class="modal fade" id="modal-cart">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="modal-icon-discount">
                                <img src="<?php echo $urlThemeActive;?>asset/image/icondiscount.png" alt="">
                            </div>

                            <div class="modal-discount-text">
                                Đăng nhập để nhận <strong>VOUCHER 50K </strong>cho <strong>đơn hàng đầu tiên</strong>
                            </div>

                            <div class="modal-discount-group-button">
                                <div class="modal-discount-login">
                                    <button type="button"  data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        Đăng nhập ngay
                                    </button>
                                </div>

                                <div class="modal-discount-close">
                                    <button type="button"  data-bs-dismiss="modal">Để sau</button>
                                </div>
                             
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
        </section>

        <section id="product-cart-mobile-footer">
            <div class="container-fluid">
                <div class="cart-mobile-top">
                    <div class="cart-footer-mobile-left">
                        <p>Thành tiền</p>
                    </div>
        
                    <div class="cart-footer-mobile-right">
                        <div class="cart-footer-right-top">
                            <p id="totals-mobile"><?php echo number_format(@$price_total + @$ship); ?>đ</p>
                        </div>
    
                        <div class="cart-footer-right-bottom">
                            <p>Bạn đã tiết kiệm <span id="totalck_1">0</span></p>
                        </div>
                    </div>
                </div>
    
                <div class="cart-mobile-bottom">
                    <div class="cart-button-buy">
                        <input type="submit" value="Đặt hàng">
                    </div>
                </div>
            </div>
        
        </section>
          </form>
    </main> 

<script type="text/javascript">
$(document).ready(function() {
    if($(window).width()<1024){
        $('#desktop_view').remove();
        $('#product-mobile').show();
        $('#desktop_view1').remove();
        $('#product-mobile1').show();
    }else{
        $('#mobile_view').remove();
        $('#desktop_view').show();
        $('#mobile_view1').remove();
        $('#product-mobile1').remove();
        $('#desktop_view1').show();
    }
});
</script>

<script type="text/javascript">
    $(document).on('click', function (e) {

 <?php foreach($category as $key => $value){
     if(!empty($value['discountCode'])){
    foreach($value['discountCode'] as $k => $item){ ?>
  $(document).ready(function(){
    // Sử dụng sự kiện click cho tất cả các radio button có class 'radioOption'
    $(".check-voucher #checkcode<?php echo @$key ?>-<?php echo @$k ?>").click(function(){
        // Bỏ chọn tất cả các radio button trong nhóm có tên 'group1'
        $("input[name='code<?php echo @$key ?>-<?php echo @$k ?>']").prop('checked', !$(this).prop('checked'));
    });

<?php }}} ?>
  });
</script>

 <script>
        // Sự kiện xảy ra khi người dùng nhấn nút "Back"
        window.addEventListener('popstate', function(event) {
            // Tải lại trang
            location.reload();
        });
    </script>


<script type="text/javascript">
    function checkupdatecart(id){
         var checkBox = document.getElementById("checkproduct"+id);


        $.ajax({
            method: "GET",
            url: "/checkUpdateCart/?id_product="+id+"&status="+checkBox.checked
        })
        .done(function( msg ) {
            location.reload();
        });


    }

    function checkproductAll(id){
         var checkBox = document.getElementById("allcheck");


         

        $.ajax({
            method: "GET",
            url: "/apis/checkproductAll/?status="+checkBox.checked
        })
        .done(function( msg ) {
            location.reload();

            //console.log(msg);
        });


    }

    function plusQuantity(total, id)
    {
        let quantity = parseInt($('#quantity_buy'+total).val());
        quantity++;
        $('#quantity_buy'+total).val(quantity);
         addProductCart(total,id)
    }

    function minusQuantity(total, id)
    {
        let quantity = parseInt($('#quantity_buy'+total).val());
        quantity--;
        if(quantity<1) quantity=1;
        $('#quantity_buy'+total).val(quantity);
         addProductCart(total,id)
    }

  /*  function plusQuantityMobile(total, id)
    {
        let quantity = parseInt($('#quantity_mobile'+total).val());
        quantity++;
        $('#quantity_buy'+total).val(quantity);
        $('#quantity_mobile'+total).val(quantity);
        tinhtien();
        // addProductCart(total,id)
    }

    function minusQuantityMobile(total, id)
    {
        let quantity = parseInt($('#quantity_mobile'+total).val());
        quantity--;
        if(quantity<1) quantity=1;
        $('#quantity_buy'+total).val(quantity);
        $('#quantity_mobile'+total).val(quantity);
        tinhtien();
         // addProductCart(total,id)
    }*/

    function addProductCart(total, id)
    {
        let quantity = parseInt($('#quantity_buy'+total).val());

        $.ajax({
            method: "GET",
            url: "/updateProductToCart/?id_product="+id+"&quantity="+quantity
        })
        .done(function( msg ) {
            tinhtien();
        });
    }

   
    function tinhtien(){
        var total= <?php echo $total; ?>;
        var i;
        var price_total = 0;

        if(total>0){
            for(i=1;i<=total;i++){
                var quantity = parseInt($('#quantity_buy'+i).val());
                var price = parseInt($('#price'+i).val());
                var statuscart = $('#statuscart'+i).val();

             
               

                var price_buy  = quantity* price;
                var money = new Intl.NumberFormat().format(price_buy);
                $('#price_buy'+i).html(money+'đ');

                if(statuscart=='true'){
                    price_total += price_buy;
                }

            }
        }
            var pricetotal = new Intl.NumberFormat().format(price_total);
            $('#pricetotal').html(pricetotal+'đ');

            document.getElementById("totalPays").value = price_total;

            var discount1 = 0;
            var discount2 = 0;
            var discount3 = 0;

            var maximum_price_reduction1 = 0;
            var maximum_price_reduction2 = 0;
            var maximum_price_reduction3 = 0;
            /*discount1= parseInt($('#discount_price1').val());
            discount2= parseInt($('#discount_price2').val());
            discount3= parseInt($('#discount_price3').val());*/

            discount1= parseInt($('#discount1').val());
            discount2= parseInt($('#discount2').val());
            discount3= parseInt($('#discount3').val());

            var code1 = $('#code1').val();
            var code2 = $('#code2').val();
            var code3 = $('#code3').val();

            var applicable_price1 = parseInt($('#applicable_price1').val());
            var applicable_price2 = parseInt($('#applicable_price2').val());
            var applicable_price3 = parseInt($('#applicable_price3').val());
           
            maximum_price_reduction1 = parseInt($('#maximum_price_reduction1').val());
            maximum_price_reduction2 = parseInt($('#maximum_price_reduction2').val());
            maximum_price_reduction3 = parseInt($('#maximum_price_reduction3').val());
            
            if(applicable_price1<=price_total){
                if(applicable_price1>0){
                    if(discount1>100){
                         var d1 = discount1;
                    }else{
                        var d1 =(discount1 / 100) * price_total;
                    }

                    if(maximum_price_reduction1>0){
                        if(d1>maximum_price_reduction1 ){
                            d1 = maximum_price_reduction1;
                        }
                    }
                }else{
                    var d1 = 0;
                }

            }else{
                var d1 = 0;
            }

            if(applicable_price2<=price_total){
                if(applicable_price2>0){
                    if(discount2>100){
                         var d2 = discount2;
                    }else{
                        var d2 =(discount2 / 100) * price_total;
                    }
                    if(maximum_price_reduction2>0){
                        if(d2>maximum_price_reduction2 ){
                            d2 = maximum_price_reduction2;
                        }
                    }
                }else{
                    var d2 = 0;
                }
            }else{
                var d2 = 0;
            }   

            if(applicable_price3<=price_total && applicable_price3>0){
                if(applicable_price3>0){
                    if(discount3>100){
                         var d3 = discount3;
                    }else{
                        var d3 =(discount3 / 100) * price_total;
                    }
                    if(maximum_price_reduction3>0){
                        if(d3>maximum_price_reduction3 ){
                            d3 = maximum_price_reduction3;
                        }
                    }
                }else{
                    var d3 = 0;
                }
            }else{
                var d3 = 0;
            } 

            var  html1 = '';
            document.getElementById("code1").value = code1;
            document.getElementById("discount_price1").value = d1;
            document.getElementById("discount1").value = discount1;
            var di1 = new Intl.NumberFormat().format(d1);
            if(d1>0){
                html1 +='<div class="cart-price-sum-discount-title">'+code1+'</div>';
                html1 +='<div class="cart-price-sum-discount-price"> - '+di1+'</div>';
            }else{
                html1 = '';
            }
           
            $('#discountPrice1').html(html1);

            var  html2 = '';
            document.getElementById("code2").value = code2;
            document.getElementById("discount_price2").value = d2;
            document.getElementById("discount2").value = discount2;
            var di2 = new Intl.NumberFormat().format(d2);
            if(d2>0){
                html2 +='<div class="cart-price-sum-discount-title">'+code2+'</div>';
                html2 +='<div class="cart-price-sum-discount-price"> - '+di2+'</div>';
            }else{
                html2 = '';
            }
            $('#discountPrice2').html(html2);

            var  html3  = '';
            document.getElementById("code3").value = code3;
            document.getElementById("discount_price3").value = d3;
            document.getElementById("discount3").value = discount3;
            var di3 = new Intl.NumberFormat().format(d3);
            if(d3>0){
                html3 +='<div class="cart-price-sum-discount-title">'+code3+'</div>';
                html3 +='<div class="cart-price-sum-discount-price"> - '+di3+'</div>';
            }else{
                html3 = '';
            }
            $('#discountPrice3').html(html3);
           

            price_total = price_total +30000 - d1 - d2 - d3 ;


             var totalck = new Intl.NumberFormat().format(d1 + d2 + d3);
             $('#totalck').html(totalck+'đ');
             $('#totalck_1').html(totalck+'đ');
            var total = new Intl.NumberFormat().format(price_total);
             $('#totals').html(total+'đ');
             $('#totals-mobile').html(total+'đ');

            document.getElementById("total").value = price_total;



    }

   /* function addDiscountCodeAPI(code, key){
         document.getElementById("discountCode").value = code;
         searchDiscountCodeAPI(code, key);
    }*/

    function searchDiscountCodeAPI(code, key, k)
    {
        $( '.checkbox-'+key ).each(function() {
          if(!$( this ).hasClass( 'checkcode'+key+'-'+k )){
            $(this).prop('checked', false); 
          }
        });

        var w = $('#checkcode'+key+'-'+k).val();
        var s = document.getElementById('checkcode'+key+'-'+k).checked;
        console.log(w);
        if(s==true){
            let totalPays = $('#totalPays').val();
            $.ajax({
                method: "GET",
                url: "/apis/searchDiscountCodeAPI/?code="+code+"&category="+key,
            })
            .done(function(msg) {
                if(msg.code==1){
                    
                    if(msg.data.applicable_price<=totalPays){
                        const specifiedTime = new Date(msg.data.deadline_at);
                        const currentTime = new Date();
                        var html ='';
                      if(specifiedTime > currentTime) {
                         
                            if(msg.data.discount>100){
                                var discount = msg.data.discount;
                            }else{
                               var discount =(msg.data.discount / 100) * totalPays;
                            }
                            if(msg.data.maximum_price_reduction!=null){
                                if(discount>msg.data.maximum_price_reduction ){
                                    discount = msg.data.maximum_price_reduction;
                                }
                            }

                           document.getElementById("code"+key).value = msg.data.code;
                           document.getElementById("discount_price"+key).value = discount;
                           document.getElementById("maximum_price_reduction"+key).value = msg.data.maximum_price_reduction;
                           document.getElementById("discount"+key).value = msg.data.discount;
                           document.getElementById("applicable_price"+key).value = msg.data.applicable_price;
                            var discount = new Intl.NumberFormat().format(discount);
                            html +='<div class="cart-price-sum-discount-title">'+msg.data.code+'</div>'
                            html +='<div class="cart-price-sum-discount-price"> - '+discount+'</div>'
                             $('#discountPrice'+key).html(html);

                            tinhtien();

                       }
                    }
                } 
               
            });
        }else{

            document.getElementById("applicable_price"+key).value = 0;
            document.getElementById("discount_price"+key).value = 0;
            document.getElementById("maximum_price_reduction"+key).value = 0;
            tinhtien();
        }
        
        
    }

     function addProductdiscountCart(idProduct, status){

        $.ajax({
            method: "GET",
            url: "/addProductdiscountCart/?id_product="+idProduct+"&quantity=1&status="+status
        })
        .done(function( msg ) {
            window.location = '/gio-hang';
        });
    }
</script>
<script type="text/javascript">
    function addProduct(idProduct, status){
        $.ajax({
            method: "GET",
            url: "/addProductToCart/?id_product="+idProduct+"&quantity=1&status="+status
        })
        .done(function( msg ) {
           window.location = '/gio-hang';
            
        });

    }
</script>

<?php
getFooter();?>