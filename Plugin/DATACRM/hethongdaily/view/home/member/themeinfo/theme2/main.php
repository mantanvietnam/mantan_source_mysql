<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="<?php echo $info->image_system;?>" />

    <?php 
        mantan_header();
    ?>
    <link rel="stylesheet" href="/plugins/hethongdaily/view/home/member/themeinfo/theme2/Asset/css/main.css?time=<?php echo time();?>">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <!-- Fonawesome -->
    <script src="https://kit.fontawesome.com/9163bded0f.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
      <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" />

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.13.3/jquery-ui.js"></script>
</head>


</div>
<?php 
  $themeinfo = $modelSetingThemeInfo->find()->where(['id_theme'=>2,'id_member'=>$info->id])->first();
      
      $data_value = array();
    if(!empty($themeinfo->config)){
        $data_value = json_decode($themeinfo->config, true);
    }

 ?>
<body>
    <div class="area"  <?php if(!empty($data_value['background_color1']) && !empty($data_value['background_color2'])) echo 'style="background: radial-gradient(circle, '.$data_value['background_color1'].' 0%, '.$data_value['background_color2'].' 100%);"';?>>
        <ul class="circles">
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>
    </div>
    <main>
        <div class="container">

            


            <div id="crm-card" style="position: relative;">
                <div class="tab-content">
                    <div id="info" class="tab-pane fade in active">

                        <section id="block-1">
                            <div class="qr-code">
                                <a href="#" id="imageLink">
                                    <i class="fa-solid fa-qrcode"></i>
                                </a>
                            </div>
                            <div class="home-btn">
                                <?php 
                                if(!empty($info->web)){
                                    echo '  <a target="_blank" href="'.$info->web.'">
                                                <i class="fa-solid fa-globe"></i>
                                            </a>';
                                }?>
                                
                            </div>
                        </section>

                        <section id="block-2">
                            <div class="block-2-img">
                                <img  src="<?php echo $info->avatar;?>" alt="">
                            </div>
                            <div class="block-2-title">
                                <h1  style=" color: <?php echo (!empty($data_value['text_color_name']))? $data_value['text_color_name']: 'rgb(42 50 127)' ;?>"><?php echo $info->name;?></h1>
                            </div>
                            <div class="block-2-detail">
                                <h4 style=" color: <?php echo (!empty($data_value['text_color_Jobtitle']))? $data_value['text_color_Jobtitle']: 'rgb(42 50 127)' ;?>"><?php echo $info->name_position;?> <?php echo $info->name_system;?></h4>

                                <p style=" color: <?php echo (!empty($data_value['text_color_address']))? $data_value['text_color_address']: 'rgb(42 50 127)' ;?>"><i style=" color: <?php echo (!empty($data_value['text_color_address']))? $data_value['text_color_address']: 'rgb(42 50 127)' ;?>" class="fa-solid fa-location-dot"></i><?php echo $info->address;?></p>
                            </div>
                        </section>

                        <section id="block-3">
                            <div class="block-3-btn">
                                <a href="tel:<?php echo $info->phone;?>" class=" block-3-btn-1">
                                    <i class="fa-solid fa-phone"></i>Call
                                </a>
                            </div>
                            <div class="block-3-btn">
                                <a href="mailto:<?php echo $info->email ;?>" class=" block-3-btn-2">
                                    <i class="fa-solid fa-envelope"></i>Mail
                                </a>
                            </div>
                            <div class="block-3-btn">
                                <a href="javascript:void(0);" onclick="saveToPhonebook()" class=" block-3-btn-3">
                                    <i class="fa-solid fa-user"></i>Lưu
                                </a>
                            </div>
                        </section>

                        <section id="block-4" style="gap: 24px;">
                            <?php if(!empty($info->facebook)){ ?>
                            <div class="block-4-icon icon-fb">
                                <a target="_blank" href="<?php echo $info->facebook;?>">
                                    <i class="fa-brands fa-facebook"></i>
                                </a>
                            </div>
                            <?php }?>

                            <?php if(!empty($info->tiktok)){ ?>
                            <div class="block-4-icon icon-tiktok">
                                <a target="_blank" href="<?php echo $info->tiktok;?>">
                                    <i class="fa-brands fa-tiktok"></i>
                                </a>
                            </div>
                            <?php }?>

                            <?php if(!empty($info->youtube)){ ?>
                            <div class="block-4-icon">
                                <a target="_blank" href="<?php echo $info->youtube;?>">
                                    <i class="fa-brands fa-youtube"></i>
                                </a>
                            </div>
                            <?php }?>

                            <?php if(!empty($info->zalo)){ ?>
                            <div class="block-4-icon">
                                <a target="_blank" href="<?php echo $info->zalo;?>">
                                    <img src="/plugins/hethongdaily/view/home/member/themeinfo\theme2\Asset/images/zalo-white-d96e.png" alt="">
                                </a>
                            </div>
                            <?php }?>

                            <?php if(!empty($info->instagram)){ ?>
                            <div class="block-4-icon">
                                <a target="_blank" href="<?php echo $info->instagram;?>">
                                    <i class="fa-brands fa-s"></i>
                                </a>
                            </div>
                            <?php }?>

                            <?php if(!empty($dataLink)){
                                foreach($dataLink as $key => $item){
                                    $icon = '';
                                    if($item->type=='website'){
                                        $icon = '<i class="fa-solid fa-globe"></i>';
                                    }elseif($item->type=='facebook'){
                                        $icon = '<i class="fa-brands fa-facebook"></i>';
                                    }elseif($item->type=='instagram'){
                                        $icon = '<i class="fa-brands fa-instagram"></i>';
                                    }elseif($item->type=='tiktok'){
                                        $icon = ' <i class="fa-brands fa-tiktok"></i>';
                                    }elseif($item->type=='youtube'){
                                        $icon = '<i class="fa-brands fa-youtube"></i>';
                                    }elseif($item->type=='zalo'){
                                        $icon = '<img src="/plugins/hethongdaily/view/home/member/themeinfo\theme2\Asset/images/zalo-white-d96e.png" alt="">';
                                    }elseif($item->type=='linkedin'){
                                        $icon = '<i class="fa-brands fa-linkedin"></i>';
                                    }

                                    echo '<div class="block-4-icon">
                                <a target="_blank" href="'.$item->link.'">
                                    '.$icon.'
                                </a>
                            </div>';
                                }
                            } 

                             ?>
                        </section>

                        <section id="block-6">
                            <?php echo @$info->description; ?>
                        </section>

                        <section id="block-5">
                            <div class="accordion accordion-flush" id="accordionFlushExample">
                                <?php if(!empty($image_qr_pay)){ ?>
                                    <center><img width="80%" src="<?php echo @$info->image_qr_pay; ?>"><center>
                                <?php } ?>
                            </div>
                        </section>

                    </div>

                    <div id="products" class="tab-pane fade">

                        <section id="block-7">
                            <div class="table-produce">
                                 <?php 
                        if(!empty($listProduct)){
                            echo '<table class="table table-bordered caption-top">';
                            foreach ($listProduct as $item) {
                                
                                echo '  <thead>
                                            <tr>
                                              <th colspan="4"><b>'.@$item['category']->name.'</b></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        ';

                                if(!empty($item['product'])){
                                    foreach ($item['product'] as $product) {
                                        echo '<tr>
                                            <th scope="row" class="no-padding" style="width: 45px;">
                                                <div class="check-input">
                                                    <input type="checkbox" data-idProduct="'.$product->id.'" name="id_product[]" id="checkbox'.$product->id.'" >
                                                </div>
                                                <div class="qty-input">
                                                    <button style="width: 44px;" class="qty-count qty-count--minus" data-action="minus" type="button">-</button>
                                                    <input style="width: 44px;" class="product-qty" type="number" id="numberProduct'.$product->id.'" name="product-qty" min="0" value="1">
                                                    <button style="width: 44px;" class="qty-count qty-count--add" data-action="add" type="button">+</button>
                                                </div>
                                            </th>
                                            <td class="table-img" style="width: 120px;">
                                                <img data-toggle="modal" data-target="#slideProduct'.$product->id.'Modal" src="'.$product->image.'">
                                            </td>
                                            <td><a href="/product/'.$product->slug.'.html" target="_blank">'.$product->title.'</a><br/>
                                                <span class="text-danger">'.number_format($product->price).'đ</span><br/>';
                                                        if(!empty($product->price_old)){
                                                            echo '<del class="small">'.number_format($product->price_old).'đ</del>';
                                                        }
                                            echo ' </td>
                                        </tr>';
                                    }
                                }
                            }
                            echo '</tbody></table>';
                        }else{
                            echo '<p class="text-danger">Chưa có sản phẩm bán</p>';
                        }
                        ?>                               
                                 <button style="position: sticky; width: 100%;bottom: 68px;" type="button" class="btn btn-danger buy-btn" onclick="checkSelectProduct();">ĐẶT MUA HÀNG</button>
                            </div>
                        </section>

                    </div>

                    <div id="customer" class="tab-pane fade">
                        <section id="block-8">
                            <div class="card p-4"> 
                                <form id="uploadFormCustomer" class="form-customer" enctype="multipart/form-data">
                                    <input type="hidden" name="token" value="<?php echo $info->token;?>">
                                    <label for="">Họ tên (<span>*</span>)</label>
                                    <input type="text" required  id="" name="full_name" value="">

                                    <label for="">Số điện thoại (<span>*</span>)</label>
                                    <input type="text" required  id="" name="phone" value="" >

                                    <label for="">Ảnh đại diện</label>
                                    <input type="file" id="" name="avatar" value="" accept="image/*" >

                                    <label for="">Địa chỉ</label>
                                    <input type="text" id="" name="address" value="">

                                    <label for="">Ngày sinh (giảm giá khi đến sinh nhật)</label>
                                    <input type="date" id="" name="birthday" value="" class="datepicker">

                                    <?php 
                                    if(!empty($listGroupCustomer)){
                                        echo '  <label for="">Nhóm khách hàng</label>
                                                <select name="id_group" class="form-select" >
                                                    <option value="">Chọn nhóm khách hàng</option>';
                                                    foreach ($listGroupCustomer as $key => $value) {
                                                        echo '<option value="'.$value->id.'">'.$value->name.'</option>';
                                                    }
                                        echo    '</select>';
                                    }
                                    ?>

                                    <input class="submit-btn" type="submit" value="LƯU THÔNG TIN KHÁCH HÀNG">
                                </form>
                                 <div id="show_img_card_customer"></div>
                             </div>
                        </section>
                    </div>

                     <!-- Tab đặt hàng -->
                    <div class="tab-pane fade" id="order">
                        <div class=" p-3 d-flex justify-content-center">
                            <div class="mb-3">
                                <label for="full_name" class="form-label">Đối tượng đặt hàng (*)</label><br/>
                                <input type="radio" id="typeUser" name="typeUser" value="customer" checked /> Khách lẻ 
                                &nbsp;&nbsp;&nbsp;
                                <input type="radio" id="typeUser" name="typeUser" value="member" /> Đại lý 
                            </div>

                        <div id="info_customer">
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
                                  <label for="address" class="form-label">Địa chỉ nhận hàng</label>
                                  <input type="text" class="form-control" id="address" name="address" value="" />
                                </div>
                                <div class="mb-3">
                                  <label for="birthday" class="form-label">Ngày sinh (giảm giá khi đến sinh nhật)</label>
                                  <input type="date" class="form-control datepicker" id="birthday" name="birthday" value="" />
                                </div>
                                <div class="mb-3">
                                  <label for="codeDiscount" class="form-label">Mã giảm giá</label><span id="messdiscount"></span>
                                  <input type="text" class="form-control" id="discountCode" onchange="searchDiscountCodeAgencyAPI()" name="discountCode" value="" />
                                </div>
                            </div>
                        </div>
                        <div id="info_member" style="display: none;">
                            <div class="mb-3">
                              <label for="phone" class="form-label">Số điện thoại đại lý (*)</label>
                              <input type="text" class="form-control" id="phone_member" name="phone_member" value="" onchange="checkMember();" required />
                            </div>

                            <div class="mb-3">
                              <label for="phone" class="form-label">Ghi chú mua hàng</label>
                              <textarea name="note_member" id="note_member" class="form-control"></textarea>
                            </div>
                        </div>
                                <div class="mb-3">
                                    <input type="hidden" id="money" value="0">
                                    <input type="hidden" id="discount" value="0">
                                    <input type="hidden" id="total" value="0">
                                    <input type="hidden" id="codeDiscount" value="">
                                    <input type="hidden" id="promotion" value="0">
                                    <button type="button" class="btn btn-danger" id="buttonCreateOrder" onclick="createOrder();" >TẠO ĐƠN HÀNG</button> 
                                </div>
                                <div id="list_cart" class="mb-3"></div>
                                <?php if(!empty($image_qr_pay)){ ?>
                                    <center><img width="80%" src="<?php echo @$info->image_qr_pay; ?>"><center>
                                <?php } ?>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="tabs-menu">
                    <ul class="nav nav-pills">
                        <li class="active"><a data-toggle="pill" href="#info"><i class="fa-solid fa-circle-user"></i> <p>Thông tin</p></a></li>
                        <li><a data-toggle="pill" href="#products"><i class="fa-solid fa-wallet"></i> <p>Sản phẩm</p></a></li>
                        <li><a data-toggle="pill" href="#customer"><i class="fa-solid fa-circle-user"></i> <p>Khách hàng</p></a></li>
                    </ul>
                </div>

                <div id="popupContainer">
                    <span class="closeButton" onclick="closePopup()">&times;</span>
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=500x500&data=<?php echo $urlHomes.$urlCurrent;?>" width="100%" />
                </div>

            </div>
        </div>


    </main>


    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="/plugins/hethongdaily/view/home/member/themeinfo/theme2/Asset/js/main.js"></script>

    <!-- sj -->
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
            var id_agency = '<?php echo (int) @$_GET['id'];?>';
            var name_agency = '<?php echo $info->name;?>';
            var name_system = '<?php echo $info->name_system;?>';
            var data_order = {};
            var listPositions = {}

            <?php
            if(!empty($listPositions)){
                foreach ($listPositions as $key => $value) {
                    echo '  listPositions['.$key.'] = {};
                            listPositions['.$key.']["minMoney"] = '.(int) $value->keyword.';
                            listPositions['.$key.']["discount"] = '.(int) $value->description.';
                        ';
                }
            }
            ?>

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

            /*function checkSelectProduct()
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
                      url: "/clearCart/?callAPI=1",
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
                        
                        list_cart += '</tbody></table> <p><b>Thành tiền: </b><span id="money">'+formatNumberWithCommas(total_money)+'đ</span</p>';
                        list_cart += '</tbody></table> <p><b>giảm giá : </b><span id="discountmoney">0 đ</span</p>';
                        list_cart += '</tbody></table> <p><b>Tổng tiền: </b><span id="total_money">'+formatNumberWithCommas(total_money)+'đ</span</p>';

                        $('#list_cart').html(list_cart);
                        $('#money').val(total_money);
                        $('#discount').val(0);
                        $('#total').val(total_money);

                        document.getElementById("products").classList.remove("active");
                        document.getElementById("products").classList.remove("in");

                        document.getElementById("order").classList.add("active");
                        document.getElementById("order").classList.add("in");
                    });
                }
            }*/

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
                    $('#list_cart').html('');
                    $('#full_name').val('');
                    $('#phone').val('');
                    $('#address').val('');

                    data_order = {};

                    list_cart = '<table class="table table-bordered"><thead><tr><th>Sản phẩm</th><th>SL</th><th>Giá</th></tr></thead><tbody>';
                    for (var key in list_product) {
                        if (list_product.hasOwnProperty(key)) {
                            if(list_product[key].buy == 1){
                                list_cart += '<tr><td>'+list_product[key].title+'</td><td align="center">'+list_product[key].number+'</td><td>'+formatNumberWithCommas(list_product[key].price)+'đ</td></tr>';

                                total_money += list_product[key].price*list_product[key].number;

                                data_order['p'+list_product[key].id] = {};
                                data_order['p'+list_product[key].id]['id_product'] = list_product[key].id;
                                data_order['p'+list_product[key].id]['quantity'] = list_product[key].number;
                                data_order['p'+list_product[key].id]['price'] = list_product[key].price;
                                data_order['p'+list_product[key].id]['discount'] = 0;
                            }
                        }
                    }

                    // kiểm tra chiết khấu đại lý
                    var discountAgency = 0;

                    Object.keys(listPositions).forEach(function(key) {
                        if(total_money >= listPositions[key]['minMoney']){
                            discountAgency = listPositions[key]['discount'];
                        }
                    });

                    $('#promotion').val(discountAgency);
                    
                    list_cart += '</tbody></table> <p><b>Thành tiền: </b><span id="money">'+formatNumberWithCommas(total_money)+'đ</span</p>';
                    list_cart += '</tbody></table> <p><b>Giảm giá : </b><span id="discountmoney">0%</span</p>';
                    list_cart += '</tbody></table> <p><b>Tổng tiền: </b><span id="total_money">'+formatNumberWithCommas(total_money)+'đ</span</p>';

                    $('#list_cart').html(list_cart);
                    $('#money').val(total_money);
                    $('#discount').val(0);
                    $('#total').val(total_money);

                    // $('.nav-tabs a[href="#order"]').tab('show'); 
                    document.getElementById("products").classList.remove("active");
                    document.getElementById("products").classList.remove("in");

                    document.getElementById("order").classList.add("active");
                    document.getElementById("order").classList.add("in");
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
                var typeUser = $('input[name="typeUser"]:checked').val();

                if(typeUser == 'customer'){
                    var full_name = $('#full_name').val();
                    var phone = $('#phone').val();
                    var address = $('#address').val();
                    var birthday = $('#birthday').val();
                    var money = $('#money').val();
                    var discount = $('#discount').val();
                    var total = $('#total').val();
                    var codeDiscount = $('#codeDiscount').val();


                    $('#buttonCreateOrder').html('ĐANG TẠO ĐƠN HÀNG ...');

                    if(full_name != '' && phone != ''){
                        $.ajax({
                          method: "POST",
                          url: "/apis/createOrderProductAPI",
                          data: { full_name: full_name, 
                                  phone: phone, 
                                  data_order: JSON.stringify(data_order),
                                  address: address, 
                                  _csrfToken: crf, 
                                  id_agency:id_agency, 
                                  name_agency:name_agency, 
                                  name_system:name_system, 
                                  birthday:birthday,
                                  money:money,
                                  discount:discount,
                                  total:total,
                                  codeDiscount:codeDiscount,
                                  data_order: JSON.stringify(data_order)
                              }

                        }).done(function( msg ) {
                            console.log(msg);
                            $('#buttonCreateOrder').html('TẠO ĐƠN HÀNG');

                            $('.nav-tabs a[href="#info"]').tab('show');

                            alert('Tạo đơn hàng thành công');
                        });
                    }else{
                        alert('Bạn không được để trống trường Họ tên và Số điện thoại');
                    }
                }else if(typeUser == 'member'){
                    var phone = $('#phone_member').val();
                    var note = $('#note_member').val();

                    var money = $('#money').val();
                    var total = $('#total').val();
                    var promotion = $('#promotion').val();
                    
                    if(promotion > 0 && promotion < 100){
                        total = money * (100-promotion)/100;
                    }else if(promotion > 100){
                        total = money - promotion;
                    }

                    $('#buttonCreateOrder').html('ĐANG TẠO ĐƠN HÀNG ...');

                    if(phone != ''){
                        $.ajax({
                          method: "POST",
                          url: "/apis/createOrderMemberAPI",
                          data: { 
                                  phone: phone, 
                                  note: note, 
                                  _csrfToken: crf, 
                                  total: money,
                                  totalPays: total,
                                  promotion: promotion,
                                  data_order: JSON.stringify(data_order)
                              }

                        }).done(function( msg ) {
                            console.log(msg);
                            $('#buttonCreateOrder').html('TẠO ĐƠN HÀNG');

                            $('.nav-tabs a[href="#info"]').tab('show');

                            alert('Tạo đơn hàng thành công');
                        });
                    }else{
                        alert('Bạn không được để trống trường Số điện thoại');
                    }
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

        <script type="text/javascript">
            $(document).ready(function() {
                // Khi form được submit
                $('#uploadFormCustomer').on('submit', function(event) {
                    // Ngăn chặn hành động mặc định của form (làm mới trang)
                    event.preventDefault();
                    
                    // Tạo đối tượng FormData để chứa dữ liệu form
                    var formData = new FormData(this);

                    console.log(formData);
                    
                    // Sử dụng AJAX jQuery để gửi dữ liệu form lên server
                    $.ajax({
                        url: '/apis/saveInfoCustomerAPI', // URL của server nơi bạn muốn upload file
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            if(response.img_card_member != '' && response.img_card_member != null){
                                $('#uploadFormCustomer').remove();

                                var img_card_customer = "<div class='mb-3'><img id='imageToDownload' src='"+response.img_card_member+"' width='100%' /></div><br/><br/><div class='mb-3 text-center'><button onclick='downloadCardCustomer();' type='button' class='btn btn-danger' >TẢI ẢNH</button></div>";

                                $('#show_img_card_customer').html(img_card_customer);
                            }

                            alert('Lưu dữ liệu khách hàng thành công');
                            
                            // Xử lý kết quả thành công
                            console.log('Upload thành công:', response);
                        },
                        error: function(xhr, status, error) {
                            // Xử lý kết quả lỗi
                            console.error('Upload thất bại:', status, error);
                        }
                    });
                });
            });

        </script>

        <script>
        function downloadCardCustomer(){
            var image = document.getElementById('imageToDownload');
            var imageUrl = image.getAttribute('src');
            var imageName = imageUrl.substring(imageUrl.lastIndexOf('/') + 1);
            
            // Tạo một đối tượng XMLHttpRequest
            var xhr = new XMLHttpRequest();
            xhr.open('GET', imageUrl, true);
            xhr.responseType = 'blob'; // Đảm bảo dữ liệu trả về là dạng blob (binary large object)
            
            xhr.onload = function() {
                if (xhr.status === 200) {
                    // Tạo một URL dữ liệu từ dữ liệu nhận được
                    var url = window.URL.createObjectURL(xhr.response);
                    
                    // Tạo một liên kết để tải xuống
                    var a = document.createElement('a');
                    a.href = url;
                    a.download = imageName;
                    
                    // Simulate click để tải ảnh về
                    document.body.appendChild(a);
                    a.click();
                    document.body.removeChild(a);
                }
            };
            
            xhr.send();
        };

        function searchDiscountCodeAgencyAPI()
        {
            var code  = $('#discountCode').val();
            var money  = parseInt($('#money').val());
            var id_member  = <?php echo $info->id ;?>;

            $.ajax({
                method: "GET",
                url: "/apis/searchDiscountCodeAgencyAPI/?code="+code+'&id_member='+id_member,
            }).done(function(msg) {
                if(msg.code==0){
                    if(msg.data.applicable_price <= money){

                        const specifiedTime = new Date(msg.data.deadline_at);
                        const currentTime = new Date();
                        var html ='';
                        if(specifiedTime > currentTime) {

                            if(msg.data.discount>100){
                                var discount = msg.data.discount;
                            }else{
                             var discount =(msg.data.discount / 100) * money;
                         }
                         if(msg.data.maximum_price_reduction!=null){
                            if(discount>msg.data.maximum_price_reduction ){
                                discount = msg.data.maximum_price_reduction;
                            }
                        }
                        $('#discount').val(discount);
                        $('#codeDiscount').val(msg.data.code);
                        $('#total').val(money-discount);

                        $('#discountmoney').html(formatNumberWithCommas(discount)+ 'đ');
                        $('#total_money').html(formatNumberWithCommas(money-discount)+ 'đ');
                    }
                }

                }else{
                    $('#codeDiscount').val('');
                    $('#discount').val(0);
                    $('#total').val(money);
                    $('#discountmoney').html('0đ');
                    $('#total_money').html(formatNumberWithCommas(money) + 'đ');

                }
                $('#messdiscount').html('<p class="text-danger">'+msg.mess+'</p>');   


            });

        }
        </script>

        <script type="text/javascript">
            function showQRCode()
            {
                $('#QRCodeModal').modal('show');
            }
        </script>
        
        <script type="text/javascript">
            var tabShow = 'info';
            <?php
                if(!empty($_GET['tabShow'])){
                    echo "var tabShow = '".$_GET['tabShow']."';";
                }
            ?>

            document.getElementById("info").classList.remove("active");
            document.getElementById("info").classList.remove("in");

            document.getElementById(tabShow).classList.add("active");
            document.getElementById(tabShow).classList.add("in");
        </script>

        <script>
        
        $( function() {
            $( ".datepicker" ).datepicker({
              dateFormat: "dd/mm/yy"
            });
        } );
        
        </script>

        <script>
            document.querySelectorAll('input[name="typeUser"]').forEach((elem) => {
                elem.addEventListener("change", (event) => {
                    var typeUser = $('input[name="typeUser"]:checked').val();
                    var promotion = $('#promotion').val();
                    var discount = $('#discount').val();
                    var money  = parseInt($('#money').val());
                    var total = money;

                    $('#info_customer').hide();
                    $('#info_member').hide();

                    if(typeUser == 'member'){
                        $('#info_member').show();
                        $('#discountmoney').html(promotion+'%');
                        
                        total = money * (100 - promotion)/100;
                        $('#total_money').html(formatNumberWithCommas(total)+'đ');
                        
                    }else{
                        $('#info_customer').show();
                        $('#discountmoney').html(discount+'%');

                        total = money * (100 - discount)/100;
                        $('#total_money').html(formatNumberWithCommas(total)+'đ');
                    }
                });
            });
        </script>

        <script type="text/javascript">
            function checkMember()
            {
                var phone_member = $('#phone_member').val();

                $.ajax({
                  method: "POST",
                  url: "/apis/searchMemberAPI",
                  data: { phone: phone_member }

                }).done(function( msg ) {
                    if(msg[0].id == 0){
                        $('#phone_member').val('');
                        alert('Không tìm thấy đại lý có số điện thoại là '+phone_member);
                    }
                });
            }
        </script>
</body>

</html>