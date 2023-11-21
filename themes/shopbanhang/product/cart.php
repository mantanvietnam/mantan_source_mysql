<?php
getHeader();
global $urlThemeActive;
global $session;
$infoUser = $session->read('infoUser'); 

$setting = setting();

$slide_home= slide_home($setting['id_slide']);
//debug($list_product);
?>
<main>
        <section id="section-cart">
            <div class="container">
                <div class="title-section-cart">
                    <h1>Giỏ hàng</h1>
                </div>

                <div class="cart-col">
                    <div class="row">
                        <!-- Bảng -->
                        <div class="col-lg-9 col-md-9 col-sm-9 col-12 table-cart-left">
                            <div class="table-top">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col col-check">
                                                <input class="form-check-input" type="checkbox" value="" id="allcheck">
                                            </th>
                                            <th scope="col col-name">Tên sản phẩm</th>
                                            <th scope="col col-price">Đơn giá</th>
                                            <th scope="col col-number">Số lượng</th>
                                            <th scope="col col-total">Thành tiền</th>
                                            <th scope="col col-delete"><a href=""><i class="fa-regular fa-trash-can"></i></a></th>
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
                            if(!empty($list_product)){
                                foreach ($list_product as $key => $value) {
                                            $link = '/product/'.$value->slug.'.html';
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
                                            }
                             ?>
                                        <tr>
                                            <!-- check -->
                                            <td class="td-check">
                                                <input class="form-check-input" type="checkbox" onclick="checkupdatecart(<?php echo $value->id ?>)" value="1" id="checkproduct<?php echo $value->id ?>" <?php  if($value->statuscart=='true'){echo 'checked';} ?>>

                                            </td>
        
                                            <!-- Tên -->
                                            <td class="td-name">
                                                <div class="cart-product-name-box">
                                                    <div class="cart-product-image">
                                                        <img src="<?php echo $value->image ?>" width="100" alt="">
                                                    </div>
        
                                                    <div class="cart-product-name">
                                                        <p><?php echo $value->title ?></p>
                                                    </div>
                                                </div>
                                            </td>
        
                                            <!-- Đơn giá -->
                                            <td class="td-price">
                                                <div class="cart-product-price">
                                                    <div class="cart-product-price-real">
                                                        <span><?php echo number_format(@$value->price).'₫ ' ?></span>
                                                        <input type="hidden" name="price<?php echo $total ?>" id="price<?php echo $total ?>" value="<?php echo @$value->price ?>">

                                                    </div>
        
                                                    <div class="cart-product-price-discount">
                                                        <del><?php echo number_format($value->price_old); ?>đ</del>
                                                    </div>
                                                </div>
                                            </td>
        
                                            <!-- Số lượng -->
                                            <td class="td-number">
                                                <div class="cart-product-number">
                                                    <div class="product-detail-number-item">
                                                        <div class="qty-input">
                                                            <button onclick="minusQuantity(<?php echo $total ?>, <?php echo $value->id; ?>)" class="qty-count-minus" data-action="minus" type="button">-</button>
                                                            <input id="quantity_buy<?php echo $total ?>" min="0" max="<?php echo $value->quantity ?>" onclick="tinhtien()" class="product-qty" type="text" name="quantity_buy" value="<?php echo $value->numberOrder ?>" min="0">
                                                            <input id="statuscart<?php echo $total ?>" min="0" max="<?php echo $value->quantity ?>" onclick="tinhtien()" class="product-qty" type="hidden" name="statuscart" value="<?php echo $value->statuscart ?>" min="0">
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
        
                                       <?php }} ?>
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
                                                <span>1</span>
                                            </div>
                                        </td>

                                    </tr>
                                <?php }}}} ?>
                                </table>
                            </div>

                            <div class="cart-left-bottom">
                                <div class="title-cart-left-bottom">
                                        Ưu đãi dành cho bạn
                                </div>

                                <div class="row">

                                    <!-- Sản phẩm đi kèm -->
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 cart-product-gift-right">
                                        <div class="cart-product-gift-item-list">
                                            <div class="cart-product-gift-right-inner">
                                                 <?php   if(!empty($list_product)){
                                                    foreach ($list_product as $key => $value) { 
                                                         if(!empty($value->idprodiscount)){
                                                        foreach($value->idprodiscount as $item){?>
                                                <div class="cart-product-gift-item">
                                                    <div class="product-item-inner">
                                                        <div class="product-img">
                                                            <a href="/product/<?php echo  $value->slug ?>.html"><img src="<?php echo $item->image ?>" alt="/product/<?php echo  $item->slug ?>.html"></a>
                                                        </div>
                            
                                                        <div class="product-info">
                                                            <div class="product-name">
                                                                <a href="/product/<?php echo  $item->slug ?>.html"><?php echo  $item->title ?></a>
                                                            </div>
                            
                                                            <div class="product-price">
                                                                <p><?php echo number_format($item->pricepro_discount); ?>đ</p>
                                                            </div>

                                                            <div class="product-discount">
                                                                <del><?php echo number_format($item->price_old); ?>đ</del><span> 
                                                            </div>
                                                            
                                                            
                                                        </div>

                                                        <div class="product-button-cart product-button-cart-add">
                                                            <a onclick="addProductdiscountCart(<?php echo $item->id; ?>,'true')">Thêm vào giỏ hàng</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php }}}} ?>
                                               
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="cart-left-bottom">
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
                                                            <a href="/product/<?php echo  $value->slug ?>.html"><img src="<?php echo $value->image ?>" alt="/product/<?php echo  $value->slug ?>.html"></a>
                                                        </div>
                            
                                                        <div class="product-info">
                                                            <div class="product-name">
                                                                <a href="/product/<?php echo  $value->slug ?>.html"><?php echo  $value->title ?></a>
                                                            </div>
                            
                                                            <div class="product-price">
                                                                <p><?php echo number_format($value->price); ?>đ</p>
                                                            </div>

                                                            <div class="product-discount">
                                                                <del><?php echo number_format($value->price_old); ?>đ</del><span> 
                                                            </div>
                                                            
                                                            
                                                        </div>

                                                        <div class="product-button-cart product-button-cart-add">
                                                            <a href="/product/<?php echo  $value->slug ?>.html">Thêm vào giỏ hàng</a>
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
                        <div class="col-lg-3 col-lg-3 col-sm-3 col-12 table-cart-right">
                            <form action="/addDiscountCode"  method="get">
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
                                    <?php foreach($category as $key => $value){ ?>
                                    <div class="list-code-item">
                                        <div class="title-code-discount">
                                           <?php echo $value['name']; ?>
                                        </div>
    
                                        
                                            <?php if(!empty($value['discountCode'])){
                                                foreach($value['discountCode'] as $k => $item){
                                                     $voucher = "";
                                                    if($price_total < $item->applicable_price){

                                                    $voucher= 'voucher-disabled';
                                                }
                                             ?>
                                             <div class="voucher">
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
                                                        <?php if($item->applicable_price){ ?>
                                                        <p>Đơn tối thiểu <?php echo number_format($item->applicable_price); ?> đ</p>
                                                    <?php } ?>
                                                    </div>
                                                    <div class="check-voucher">
                                                        <input class="form-check-input" onclick="addDiscountCodeAPI('<?php echo @$item->code ?>', <?php echo @$key ?>)"  type="radio" name="code<?php echo @$key ?>" value="<?php echo $item->code ?>" id="checkcode<?php echo @$key ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
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
                                      <?php echo number_format($price_total); ?>đ
                                    </div>
                                    <input type="hidden" name="totalPays" id="totalPays" value="<?php echo $price_total; ?>">
                                </div>

                            
                                <!-- Giá voucher-->
                                <div class="cart-price-code-discount">
                                    <div class="cart-price-item" id="discountPrice1">
                                        
                                    </div>
                                    <input type="hidden"  name="discount_price1" value="0" id="discount_price1">
                                    
                                </div>

                                <div class="cart-price-code-discount">
                                    <div class="cart-price-item" id="discountPrice2">
                                        
                                    </div>
                                    <input type="hidden"  name="discount_price2" value="0" id="discount_price2">
                                    
                                </div>

                                <div class="cart-price-code-discount">
                                    <div class="cart-price-item" id="discountPrice3">
                                        
                                    </div>
                                    <input type="hidden"  name="discount_price3" value="0" id="discount_price3">
                                    
                                </div>

                                 <!-- Giá tổng chiết khẩu -->
                                <div class="cart-price-sum-discount">
                                    <div class="cart-price-sum-discount-item">
                                        <div class="cart-price-sum-discount-title">
                                            Tổng chiết khấu
                                        </div>
    
                                        <div class="cart-price-sum-discount-price" id=totalck>
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
                                           <?php echo number_format($price_total); ?>đ
                                        </div>
                                         <input type="hidden" value="<?php echo $price_total; ?>" name="total" id=total>
                                    </div>
                                </div>
                            </div>

                            <div class="cart-button-buy">
                                <?php if(!empty($infoUser)){ ?>
                                <input type="submit" value="Đặt hàng">
                            <?php }else{
                                echo '<a href="" data-bs-toggle="modal" data-bs-target="#exampleModal">Đặt hàng</a>';
                            } ?>
                            </div>
                            </form>
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
    </main>
<script type="text/javascript">
    function checkupdatecart(id){
         var checkBox = document.getElementById("checkproduct"+id);

        console.log(checkBox.checked);

        $.ajax({
            method: "GET",
            url: "/checkUpdateCart/?id_product="+id+"&status="+checkBox.checked
        })
        .done(function( msg ) {
            location.reload();
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
            discount1= parseInt($('#discount_price1').val());
            discount2= parseInt($('#discount_price2').val());
            discount3= parseInt($('#discount_price3').val());
            // console.log(discount);
             console.log(price_total);

            price_total = price_total - discount1 - discount2 - discount3;

             console.log(price_total);

             var totalck = new Intl.NumberFormat().format(discount1 + discount2 + discount3);
             $('#totalck').html(totalck+'đ');
            var total = new Intl.NumberFormat().format(price_total);
             $('#totals').html(total+'đ');

            document.getElementById("total").value = price_total;



    }

    function addDiscountCodeAPI(code, key){
         document.getElementById("discountCode").value = code;
         searchDiscountCodeAPI(code, key);
    }

    function searchDiscountCodeAPI(code, key)
    {
        let totalPays = $('#totalPays').val();
        $.ajax({
            method: "GET",
            url: "/apis/searchDiscountCodeAPI/?code="+code+"&category="+key,
        })
        .done(function(msg) {
            if(msg.code==1){
                if(msg.data.applicable_price<totalPays){
                    const specifiedTime = new Date(msg.data.deadline_at);
                    const currentTime = new Date();
                    var html ='';
                    console.log(msg.data);
                  if(specifiedTime > currentTime) {
                     
                        if(msg.data.discount>100){
                            var discount = msg.data.discount;
                        }else{
                           var discount =(msg.data.discount / 100) * totalPays;
                        }

                       document.getElementById("discount_price"+key).value = discount;
                        var discount = new Intl.NumberFormat().format(discount);
                        html +='<div class="cart-price-sum-discount-title">'+msg.data.code+'</div>'
                        html +='<div class="cart-price-sum-discount-price"> - '+discount+'</div>'
                         $('#discountPrice'+key).html(html);

                   }
                }
            } 
           
        });
        tinhtien();
    }

     function addProductdiscountCart(idProduct, status){
        console.log(status);

        $.ajax({
            method: "GET",
            url: "/addProductdiscountCart/?id_product="+idProduct+"&quantity=1&status="+status
        })
        .done(function( msg ) {
            window.location = '/cart';
        });
    }
</script>

<?php
getFooter();?>