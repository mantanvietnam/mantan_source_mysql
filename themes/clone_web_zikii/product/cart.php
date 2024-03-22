<?php
getHeader();

global $urlThemeActive;
global $session;

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
                <h3>GIỎ HÀNG</h3>

                <!-- Section khi giỏ hàng khi không có sản phẩm -->
                <?php if(empty($list_product)){ ?>
                <div class="no-produce">

                    <img src="<?php echo $urlThemeActive ?>\asset\image\emptycart.png" alt="">

                    <!-- <img src="<?php echo  $urlThemeActive ?>/asset/image/FAQs.gif" alt=""> -->

                    <p>Bạn chưa có sản phẩm nào trong cửa hàng !</p>
                    <a href="/">Quay lại trang sản phẩm</a>
                </div>

            <?php }else{ ?>

                <div class="row">
                    <div class="col-lg-8 col-12">
                        <div class="cart">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col"></th>
                                        <th scope="col">Sản phẩm</th>
                                        <th scope="col"></th>
                                        <th scope="col">Giá</th>
                                        <th scope="col">Số lượng</th>
                                        <th scope="col">Tạm tính</th>
                                    </tr>
                                </thead>
                                <tbody>
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
                                    <tr class="item-cart-produce">
                                        <th class="cart-delete" scope="row"><a href="/deleteProductCart/?id_product=<?php echo $value->id ?>"><i class="fa-regular fa-circle-xmark"></i></a></th>
                                        <td class="cart-produce-img"><img src="<?php echo $value->image ?>" alt=""></td>
                                        <td><?php echo $value->title ?></td>
                                        <td class="cart-cost"><?php echo number_format(@$value->price).'₫ ' ?> đ</td>
                                        <td class="cart-quantity">
                                            <div class="quantity-input" data-quantity="product1">
                                                <input type="hidden" name="price<?php echo $total ?>" id="price<?php echo $total ?>" value="<?php echo @$value->price ?>">
                                                <button class="quantity-btn" onclick="minusQuantity(<?php echo $total ?>, <?php echo $value->id; ?>)">-</button>
                                               <input id="quantity_buy<?php echo $total ?>" min="0" max="<?php echo $value->quantity ?>" onclick="addProductCart(<?php echo $total ?>, <?php echo $value->id; ?>)" class="product-qty" type="text" name="quantity_buy" value="<?php echo $value->numberOrder ?>" min="0">
                                                <input id="statuscart<?php echo $total ?>" min="0" max="<?php echo $value->quantity ?>" onclick="tinhtien()" class="product-qty" type="hidden" name="statuscart" value="<?php echo $value->statuscart ?>" min="0">
                                                <button class="quantity-btn" onclick="plusQuantity(<?php echo $total ?>, <?php echo $value->id; ?>)">+</button>
                                            </div>
                                        </td>
                                        <td class="cart-total-cost"><p id='price_buy<?php echo $total ?>'><?php echo number_format(@$price_buy); ?> đ</p> </td>
                                    </tr>

                                    
                                    <?php } ?>


                                </tbody>
                            </table>
                        </div>

                        <div class="produce-other">
                            <h4>Các sản phẩm khác</h4>
                            <div class="list-produce-other">
                                <?php if(!empty($new_product)){
                                                    foreach($new_product as $value){
                                                 ?>
                                <div class="item-produce-other">
                                    <div class="produce-other-img">
                                        <a href="/san-pham/<?php echo  $value->slug ?>.html"><img src="<?php echo $value->image ?>" alt="<?php echo  $value->title ?>"></a>
                                    </div>
                                    <div class="produce-other-detail">
                                        <div class="produce-other-name">
                                             <a href="/san-pham/<?php echo  $value->slug ?>.html"><?php echo  $value->title ?></a>
                                        </div>
                                        <p><?php echo number_format(@$value->price); ?> ₫</p>
                                        <button onclick="addProduct(<?php echo $value->id; ?>,'true')">Thêm vào giỏ hàng</button>
                                    </div>
                                </div>
                            <?php }} ?>
                                
                            </div>
                        </div>

                    </div>

                    <div class="col-lg-4 col-12">
                        <div class="money">
                            <h3>Tổng giá các sản phẩm</h3>
                            <div class="money-of-produce">
                                  <?php  
                                        $total = 0;
                                    if(!empty($list_product)){
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
                                           
                                        
                                echo '<div class="item-produce">
                                    <div class="produce-name">'.$value->title.'</div>
                                    <div class="produce-price" id="price_rigth'.$total.'">'.number_format(@$price_buy).'</div>
                                </div>';
                            }} ?>
                               


                                <div class="produce-total">
                                    <div class="total">
                                        <p>Tổng:</p><span id="pricetotal"><?php echo number_format($price_total) ?> đ</span>
                                         <!-- <div class="cart-price-total-price" id="totals">
                                           <?php echo number_format(@$price_total+ @$ship); ?>đ
                                        </div> -->
                                        <input type="hidden" name="totalPays" id="totalPays" value="<?php echo $price_total ?>">
                                         <input type="hidden" value="<?php echo $price_total+ @$ship; ?>" name="total" id=total>
                                    </div>
                                    <button type="submit">Tiến hành thanh toán</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            <?php } ?>
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
                $('#price_rigth'+i).html(money+'đ');

                if(statuscart=='true'){
                    price_total += price_buy;
                }

            }
        }
            var pricetotal = new Intl.NumberFormat().format(price_total);
            $('#pricetotal').html(pricetotal+'đ');

            document.getElementById("totalPays").value = price_total;

            // var discount1 = 0;
            // var discount2 = 0;
            // var discount3 = 0;
            // var discount4 = 0;

            // var maximum_price_reduction1 = 0;
            // var maximum_price_reduction2 = 0;
            // var maximum_price_reduction3 = 0;
            // var maximum_price_reduction4 = 0;
            // /*discount1= parseInt($('#discount_price1').val());
            // discount2= parseInt($('#discount_price2').val());
            // discount3= parseInt($('#discount_price3').val());*/

            // discount1= parseInt($('#discount1').val());
            // discount2= parseInt($('#discount2').val());
            // discount3= parseInt($('#discount3').val());
            // discount4= parseInt($('#discount4').val());

            // var code1 = $('#code1').val();
            // var code2 = $('#code2').val();
            // var code3 = $('#code3').val();
            // var code4 = $('#code4').val();

            // var applicable_price1 = parseInt($('#applicable_price1').val());
            // var applicable_price2 = parseInt($('#applicable_price2').val());
            // var applicable_price3 = parseInt($('#applicable_price3').val());
            // var applicable_price4 = parseInt($('#applicable_price4').val());
           
            // maximum_price_reduction1 = parseInt($('#maximum_price_reduction1').val());
            // maximum_price_reduction2 = parseInt($('#maximum_price_reduction2').val());
            // maximum_price_reduction3 = parseInt($('#maximum_price_reduction3').val());
            // maximum_price_reduction4 = parseInt($('#maximum_price_reduction4').val());
            
            // if(applicable_price1<=price_total){
            //     if(applicable_price1>0){
            //         if(discount1>100){
            //              var d1 = discount1;
            //         }else{
            //             var d1 =(discount1 / 100) * price_total;
            //         }

            //         if(maximum_price_reduction1>0){
            //             if(d1>maximum_price_reduction1 ){
            //                 d1 = maximum_price_reduction1;
            //             }
            //         }
            //     }else{
            //         var d1 = 0;
            //     }

            // }else{
            //     var d1 = 0;
            // }

            // if(applicable_price2<=price_total){
            //     if(applicable_price2>0){
            //         if(discount2>100){
            //              var d2 = discount2;
            //         }else{
            //             var d2 =(discount2 / 100) * price_total;
            //         }
            //         if(maximum_price_reduction2>0){
            //             if(d2>maximum_price_reduction2 ){
            //                 d2 = maximum_price_reduction2;
            //             }
            //         }
            //     }else{
            //         var d2 = 0;
            //     }
            // }else{
            //     var d2 = 0;
            // }   

            // if(applicable_price3<=price_total && applicable_price3>0){
            //     if(applicable_price3>0){
            //         if(discount3>100){
            //              var d3 = discount3;
            //         }else{
            //             var d3 =(discount3 / 100) * price_total;
            //         }
            //         if(maximum_price_reduction3>0){
            //             if(d3>maximum_price_reduction3 ){
            //                 d3 = maximum_price_reduction3;
            //             }
            //         }
            //     }else{
            //         var d3 = 0;
            //     }
            // }else{
            //     var d3 = 0;
            // } 

            //  if(applicable_price4<=price_total && applicable_price4>0){
            //     if(applicable_price4>0){
            //         if(discount4>100){
            //              var d4 = discount4;
            //         }else{
            //             var d4 =(discount4 / 100) * price_total;
            //         }
            //         if(maximum_price_reduction4>0){
            //             if(d4>maximum_price_reduction4 ){
            //                 d4 = maximum_price_reduction4;
            //             }
            //         }
            //     }else{
            //         var d4 = 0;
            //     }
            // }else{
            //     var d4 = 0;
            // }

            // var  html1 = '';
            // document.getElementById("code1").value = code1;
            // document.getElementById("discount_price1").value = d1;
            // document.getElementById("discount1").value = discount1;
            // var di1 = new Intl.NumberFormat().format(d1);
            // if(d1>0){
            //     html1 +='<div class="cart-price-sum-discount-title">'+code1+'</div>';
            //     html1 +='<div class="cart-price-sum-discount-price"> - '+di1+'</div>';
            // }else{
            //     html1 = '';
            // }
           
            // $('#discountPrice1').html(html1);

            // var  html2 = '';
            // document.getElementById("code2").value = code2;
            // document.getElementById("discount_price2").value = d2;
            // document.getElementById("discount2").value = discount2;
            // var di2 = new Intl.NumberFormat().format(d2);
            // if(d2>0){
            //     html2 +='<div class="cart-price-sum-discount-title">'+code2+'</div>';
            //     html2 +='<div class="cart-price-sum-discount-price"> - '+di2+'</div>';
            // }else{
            //     html2 = '';
            // }
            // $('#discountPrice2').html(html2);

            // var  html3  = '';
            // document.getElementById("code3").value = code3;
            // document.getElementById("discount_price3").value = d3;
            // document.getElementById("discount3").value = discount3;
            // var di3 = new Intl.NumberFormat().format(d3);
            // if(d3>0){
            //     html3 +='<div class="cart-price-sum-discount-title">'+code3+'</div>';
            //     html3 +='<div class="cart-price-sum-discount-price"> - '+di3+'</div>';
            // }else{
            //     html3 = '';
            // }
            // $('#discountPrice3').html(html3);

            //  var  html4  = '';
            // document.getElementById("code4").value = code4;
            // document.getElementById("discount_price4").value = d4;
            // document.getElementById("discount4").value = discount4;
            // var di4 = new Intl.NumberFormat().format(d4);
            // if(d4>0){
            //     html4 +='<div class="cart-price-sum-discount-title">'+code4+'</div>';
            //     html4 +='<div class="cart-price-sum-discount-price"> - '+di4+'</div>';
            // }else{
            //     html4 = '';
            // }
            // $('#discountPrice4').html(html4);
           

            // price_total = price_total +35000 - d1 - d2 - d3 -d4;


            /* var totalck = new Intl.NumberFormat().format(d1 + d2 + d3 + d4);
             $('#totalck').html(totalck+'đ');
             $('#totalck_1').html(totalck+'đ');*/
            var total = new Intl.NumberFormat().format(price_total);
            console.log(total);
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

 function searchDiscountCodeReservedAPI()
    {
        var code  = $('#discountCode').val();
        console.log(code);
      
            let totalPays = $('#totalPays').val();
            $.ajax({
                method: "GET",
                url: "/apis/searchDiscountCodeReservedAPI/?code="+code,
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
                            console.log(msg);
                           document.getElementById("code4").value = msg.data.code;
                           document.getElementById("discount_price4").value = discount;
                           document.getElementById("maximum_price_reduction4").value = msg.data.maximum_price_reduction;
                           document.getElementById("discount4").value = msg.data.discount;
                           document.getElementById("applicable_price4").value = msg.data.applicable_price;
                            var discount = new Intl.NumberFormat().format(discount);
                            html +='<div class="cart-price-sum-discount-title">'+msg.data.code+'</div>'
                            html +='<div class="cart-price-sum-discount-price"> - '+discount+'</div>'
                             $('#discountPrice4').html(html);

                             $('#addcode').html('Áp mã giảm giá thành công');

                            tinhtien();

                       }else{
                            document.getElementById("code4").value = 0;
                           document.getElementById("discount_price4").value = 0;
                           document.getElementById("maximum_price_reduction4").value = 0;
                           document.getElementById("discount4").value = 0;
                           document.getElementById("applicable_price4").value = 0;
                            var discount = new Intl.NumberFormat().format(discount);
                            html +='<div class="cart-price-sum-discount-title"> </div>'
                            html +='<div class="cart-price-sum-discount-price"> </div>'
                             $('#discountPrice4').html(html);
                            $('#addcode').html('');
                            tinhtien();
                       }
                    }else{
                            document.getElementById("code4").value = 0;
                           document.getElementById("discount_price4").value = 0;
                           document.getElementById("maximum_price_reduction4").value = 0;
                           document.getElementById("discount4").value = 0;
                           document.getElementById("applicable_price4").value = 0;
                            var discount = new Intl.NumberFormat().format(discount);
                            html +='<div class="cart-price-sum-discount-title"> </div>'
                            html +='<div class="cart-price-sum-discount-price"> </div>'
                             $('#discountPrice4').html(html);
                            $('#addcode').html('');
                            tinhtien();
                       }
                }else{
                            document.getElementById("code4").value = 0;
                           document.getElementById("discount_price4").value = 0;
                           document.getElementById("maximum_price_reduction4").value = 0;
                           document.getElementById("discount4").value = 0;
                           document.getElementById("applicable_price4").value = 0;
                            var discount = new Intl.NumberFormat().format(discount);
                            html +='<div class="cart-price-sum-discount-title"> </div>'
                            html +='<div class="cart-price-sum-discount-price"> </div>'
                             $('#discountPrice4').html(html);
                            $('#addcode').html('');
                            tinhtien();
                       } 
               
            });
        
        
        
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