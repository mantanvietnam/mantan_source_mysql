<!doctype html>
<html>
    <head>
        <meta charset='utf-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        
        <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css' rel='stylesheet'>
        <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet'>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <link rel="icon" type="image/x-icon" href="<?php echo $info->image_system;?>" />
        <?php 
            mantan_header();

            if(function_exists('showSeoHome')) showSeoHome();
        ?>

        <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
        <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
    
        <style>
            ::-webkit-scrollbar {
                      width: 8px;
                    }
                    /* Track */
                    ::-webkit-scrollbar-track {
                      background: #f1f1f1; 
                    }
                     
                    /* Handle */
                    ::-webkit-scrollbar-thumb {
                      background: #888; 
                    }
                    
                    /* Handle on hover */
                    ::-webkit-scrollbar-thumb:hover {
                      background: #555; 
                    } * {
                margin: 0;
                padding: 0
            }

            body {
                background-color: #000
            }

            a {
                color: #fff;
                text-decoration: none;
            }

            .card {
                width: 350px;
                background-color: #efefef;
                border: none;
                cursor: pointer;
                transition: all 0.5s;
            }

            .image img {
                transition: all 0.5s
            }

            .card:hover .image img {
                transform: scale(1.5)
            }

            .name {
                font-size: 22px;
                font-weight: bold
            }

            .idd {
                font-size: 14px;
                font-weight: 600
            }

            .idd1 {
                font-size: 12px
            }

            .number {
                font-size: 22px;
                font-weight: bold
            }

            .follow {
                font-size: 12px;
                font-weight: 500;
                color: #444444
            }

            .btn1 {
                height: 40px;
                width: 150px;
                border: none;
                background-color: #000;
                color: #fff;
                font-size: 15px
            }

            .text span {
                font-size: 13px;
                color: #545454;
                font-weight: 500
            }

            .icons i {
                font-size: 19px
            }

            hr .new1 {
                border: 1px solid
            }

            .join {
                font-size: 14px;
                color: #a0a0a0;
                font-weight: bold
            }

            .date {
                background-color: #ccc
            }

            .nav-tabs{
                border-bottom: none !important;
            }

            .tab-pane{
                overflow-y: auto;
            }

            .avatar{
                border-radius: 100px;
            }

            .social{
                border: 1px solid #bcbcbc;
                border-radius: 40px;
                padding: 10px;
                background-color: #000;
            }

            .social .title{
                font-size: 19px;
                font-weight: bold;
                color: rgb(253, 171, 21);
                text-align: center;
            }

            .social .des{
                color: #fff;
                font-size: 12px;
            }

            .numberProduct {
              width: 20px;
              height: 20px;
              font-size: 10px;
              text-align: center;
            }
        </style>                            
    </head>
    
    <body className='snippet-body'>
        
        <!-- Tabs content -->
        <div class="tab-content">
            <!-- Tab Sản phẩm -->
            <div class="tab-pane fade show active" id="products">
                <div class="container p-3 d-flex justify-content-center">
                    <div class="card p-4"> 
                        <?php 
                        if(!empty($listProduct)){
                            echo '<table class="table table-bordered mb-5"><tbody>';
                            foreach ($listProduct as $item) {
                                echo '  <tr>
                                          <th colspan="4">'.$item['category']->name.'</th>
                                        </tr>';

                                if(!empty($item['product'])){
                                    foreach ($item['product'] as $product) {
                                        echo '  <tr>
                                                    <td align="center">
                                                        <input data-idProduct="'.$product->id.'" type="checkbox" name="id_product[]" id="checkbox'.$product->id.'"><br/><br/>
                                                        <span onclick="plusProduct('.$product->id.');">+</span><br/>
                                                        <input class="numberProduct" readonly type="text" id="numberProduct'.$product->id.'" value="1" min="1" name="" />
                                                        <span onclick="minusProduct('.$product->id.');">-</span>
                                                    </td>
                                                    <td width="80" align="center">
                                                        <img data-toggle="modal" data-target="#slideProduct'.$product->id.'Modal" src="'.$product->image.'" class="img-thumbnail"><br/>
                                                        <span class="text-danger">'.number_format($product->price).'đ</span><br/>';
                                                        if(!empty($product->price_old)){
                                                            echo '<del class="small">'.number_format($product->price_old).'đ</del>';
                                                        }
                                        echo        '</td>
                                                    <td onclick="checkbox('.$product->id.');">'.$product->title.'</td>
                                                </tr>';

                                        echo '  <div class="modal fade" id="slideProduct'.$product->id.'Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                  <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                      <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">'.$product->title.'</h5>
                                                      </div>
                                                      <div class="modal-body">
                                                        <div class="slider">
                                                            <div><img width="100%" src="'.$product->image.'" alt="'.$product->title.'"></div>';

                                                            $images = json_decode($product->images, true);

                                                            if(!empty($images)){
                                                                foreach ($images as $image) {
                                                                    if(!empty($image)){
                                                                        echo '<div><img width="100%" src="'.$image.'" alt=""></div>';
                                                                    }
                                                                }
                                                            }
                                        echo            '</div>
                                                      </div>
                                                      <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>';
                                    }
                                }
                            }
                            echo '</tbody></table>';
                        }else{
                            echo '<p class="text-danger">Chưa có sản phẩm bán</p>';
                        }
                        ?>

                        <button style="position: sticky ; bottom: 10px;" type="button" class="btn btn-danger" onclick="checkSelectProduct();">ĐẶT MUA HÀNG</button>
                    </div>
                </div>
            </div>

            <!-- Tab đặt hàng -->
            <div class="tab-pane fade" id="order">
                <div class="container p-3 d-flex justify-content-center">
                    <div class="card p-4"> 
                        <div class="mb-3">
                          <label for="full_name" class="form-label">Họ tên (*)</label>
                          <input type="text" class="form-control" id="full_name" name="full_name" value="" required />
                        </div>
                        <div class="mb-3">
                          <label for="phone" class="form-label">Số điện thoại (*)</label>
                          <input type="text" class="form-control" id="phone" name="phone" value="" required />
                        </div>
                        <div class="mb-3">
                          <label for="phone" class="form-label">Địa chỉ nhận hàng</label>
                          <input type="text" class="form-control" id="address" name="address" value="" />
                        </div>
                        <div class="mb-3">
                            <button type="button" class="btn btn-danger" id="buttonCreateOrder" onclick="createOrder();" >TẠO ĐƠN HÀNG</button>
                        </div>
                        <div id="list_cart"></div>
                        
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabs navigation -->
        <ul class="nav nav-tabs justify-content-center mt-3" id="myTabs">
            
            <li class="nav-item">
                <a class="nav-link active" id="product-tab" data-toggle="tab" href="#products">Sản phẩm</a>
            </li>
            
            
            <li class="nav-item">
                <a class="nav-link" id="order-tab" data-toggle="tab" href="#order">Đặt hàng</a>
            </li>
        </ul>

        <!-- Bootstrap JS, Popper.js, and jQuery -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
            
        <script type="text/javascript">
            function checkbox(id)
            {
                $('#checkbox'+id).trigger('click'); 
            }
        </script>    

        <script type="text/javascript" defer>
            var heightContent = window.innerHeight - $('#myTabs').height() - 20;

            $('.tab-pane').height(heightContent);
        </script>    

        <script>
            $(document).ready(function(){
                // Ẩn tab "Mua hàng"
                $('#order-tab').hide();
            });
        </script>
 

        <script>
            function saveToPhonebook() {
                var nameFile = '<?php echo createSlugMantan($info->name);?>';

                var contact = {
                    name: "<?php echo $info->name;?>",
                    phone: "<?php echo $info->phone;?>",
                    address: "<?php echo $info->address;?>",
                    email: "<?php echo $info->email;?>",
                    title: "<?php echo $info->name_position;?>",
                    system: "<?php echo $info->name_system;?>",
                    web: "<?php if(!empty($info->web)){echo $info->web;}else{echo $urlHomes.$urlCurrent;}?>",
                    facebook: "<?php echo $info->facebook;?>",
                    tiktok: "<?php echo $info->tiktok;?>",
                    youtube: "<?php echo $info->youtube;?>",
                    instagram: "<?php echo $info->instagram;?>",
                    linkedin: "<?php echo $info->linkedin;?>",
                    twitter: "<?php echo $info->twitter;?>",
                    avatar: "<?php if(!empty($info->avatar)) echo base64_encode(file_get_contents($info->avatar));?>"
                };

                var vcard = "BEGIN:VCARD\nVERSION:4.0\nN;CHARSET=utf-8:;"+contact.name+"\nFN;CHARSET=utf-8:" + contact.name + "\nTEL;TYPE=work,voice:" + contact.phone + "\nTITLE;CHARSET=utf-8:"+contact.title+"\nORG;CHARSET=utf-8:"+contact.system+"\nEMAIL;TYPE=EMAIL:"+contact.email+"\nURL;TYPE=WEBSITE:"+contact.web+"\nsocialProfile;TYPE=FACEBOOK:"+contact.facebook+"\nsocialProfile;TYPE=TWITTER:"+contact.twitter+"\nsocialProfile;TYPE=LINKEDIN:"+contact.linkedin+"\nsocialProfile;TYPE=TIKTOK:"+contact.tiktok+"\nsocialProfile;TYPE=INSTAGRAM:"+contact.instagram+"\nsocialProfile;TYPE=YOUTUBE:"+contact.youtube+"\nPHOTO;ENCODING=BASE64;TYPE=JPEG:"+contact.avatar+"\nADR;TYPE=Work;CHARSET=utf-8:"+contact.address+"\nEND:VCARD";
                
                var blob = new Blob([vcard], { type: "text/vcard" });
                var url = URL.createObjectURL(blob);
                  
                const newLink = document.createElement('a');
                
                newLink.download = nameFile + ".vcf";
                newLink.textContent = contact.name;
                newLink.href = url;
                
                newLink.click();
            }
        </script>
        
        <script type="text/javascript">
            var list_product =  {};
            var crf = '<?php echo $csrfToken;?>';
            var id_agency = '<?php echo $info->id;?>';
            var name_agency = '<?php echo $info->name;?>';
            var name_system = '<?php echo $info->name_system;?>';

            <?php 
                if(!empty($listProduct)){
                    foreach ($listProduct as $item) {
                        if(!empty($item['product'])){
                            foreach ($item['product'] as $product) {
                                echo '  list_product["p'.$product->id.'"] = {};
                                        list_product["p'.$product->id.'"]["id"] = '.(int) $product->id.';
                                        list_product["p'.$product->id.'"]["title"] = "'.$product->title.'";
                                        list_product["p'.$product->id.'"]["price"] = '.(int) $product->price.';
                                        list_product["p'.$product->id.'"]["number"] = 0;
                                        list_product["p'.$product->id.'"]["buy"] = 0;
                                ';
                            }
                        }
                    }
                }
            ?>

            function copyText() {
                // Lấy phần tử cần copy
                var textElement = document.getElementById("myPhone");

                // Tạo một range để chọn nội dung trong phần tử
                var range = document.createRange();
                range.selectNode(textElement);

                // Lựa chọn nội dung trong range
                window.getSelection().removeAllRanges(); // Xóa các lựa chọn trước đó (nếu có)
                window.getSelection().addRange(range);

                // Thử copy nội dung vào clipboard
                try {
                    document.execCommand('copy');
                    alert('Đã copy thành công số điện thoại ');
                } catch (err) {
                    console.error('Không thể copy: ', err);
                    alert('Lỗi khi copy.');
                }

                // Xóa lựa chọn
                window.getSelection().removeAllRanges();
            }

            function checkSelectProduct()
            {
                var checkboxes = document.getElementsByName('id_product[]');
                var checkTick = false;
                var id_product_check, list_cart;
                var total_money = 0;

                for (var i = 0; i < checkboxes.length; i++) {
                    // Kiểm tra xem checkbox có được chọn không
                    if (checkboxes[i].checked) {
                        checkTick = true;

                        id_product_check = checkboxes[i].getAttribute("data-idProduct");

                        list_product['p'+id_product_check].buy = 1;
                        list_product['p'+id_product_check].number = parseInt($('#numberProduct'+id_product_check).val());
                    }
                }

                if(!checkTick){
                    alert('Bạn cần chọn sản phẩm muốn mua thì mới có thể đặt hàng');
                }else{
                    $.ajax({
                      method: "GET",
                      url: "/clearCart",
                      data: {}
                    })
                    .done(function( msg ) {
                       $('#list_cart').html('');
                        $('#full_name').val('');
                        $('#phone').val('');
                        $('#address').val('');

                        list_cart = '<table class="table table-bordered"><thead><tr><th>Sản phẩm</th><th>SL</th><th>Giá</th></tr></thead><tbody>';
                        for (var key in list_product) {
                            if (list_product.hasOwnProperty(key)) {
                                if(list_product[key].buy == 1){
                                    list_cart += '<tr><td>'+list_product[key].title+'</td><td align="center">'+list_product[key].number+'</td><td>'+formatNumberWithCommas(list_product[key].price)+'đ</td></tr>';

                                    total_money += list_product[key].price*list_product[key].number;

                                    addProducToCart(list_product[key].id, list_product[key].number);
                                }
                            }
                        }
                        
                        list_cart += '</tbody></table> <p><b>Tổng tiền: </b>'+formatNumberWithCommas(total_money)+'đ</p>';

                        $('#list_cart').html(list_cart);

                        $('.nav-tabs a[href="#order"]').tab('show'); 
                    });
                }
            }

            function plusProduct(id)
            {
                var number = parseInt($('#numberProduct'+id).val());
                number ++;
                $('#numberProduct'+id).val(number);
            }

            function minusProduct(id)
            {
                var number = parseInt($('#numberProduct'+id).val());
                number --;
                if(number<1) number = 1;
                $('#numberProduct'+id).val(number);
            }

            function formatNumberWithCommas(number) {
                // Sử dụng toLocaleString để thực hiện định dạng số với dấu phẩy
                return number.toLocaleString('en-US');
            }

            function createOrder()
            {
                var full_name = $('#full_name').val();
                var phone = $('#phone').val();
                var address = $('#address').val();

                $('#buttonCreateOrder').html('ĐANG TẠO ĐƠN HÀNG ...');

                if(full_name != '' && phone != ''){
                    $.ajax({
                      method: "POST",
                      url: "/pay",
                      data: { full_name: full_name, phone: phone, address: address, _csrfToken: crf, id_aff:id_agency, name_agency:name_agency, name_system:name_system }
                    })
                    .done(function( msg ) {
                        $('#buttonCreateOrder').html('TẠO ĐƠN HÀNG');

                        $('.nav-tabs a[href="#products"]').tab('show');

                        alert('Tạo đơn hàng thành công');
                    });
                }else{
                    alert('Bạn không được để trống trường Họ tên và Số điện thoại');
                }
            }

            function addProducToCart(idProduct, number)
            {
                $.ajax({
                  method: "POST",
                  url: "/apis/addProductToCart",
                  data: { id_product: idProduct, quantity: number, status: true, _csrfToken: crf }
                })
                .done(function( msg ) {
                    
                });
            }
        </script>

        <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
        
        <script>
            $(document).ready(function(){
              $('.slider').slick({
                autoplay: true,
                autoplaySpeed: 2000, // Adjust the speed as needed
                dots: true,
                arrows: false,
                slidesToShow: 1, // Show one slide at a time
                slidesToScroll: 1 // Scroll one slide at a time
              });
            });
        </script>
    </body>
</html>