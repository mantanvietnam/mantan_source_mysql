<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js">
  <!--Sử dụng boostrap 5-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&family=Playwrite+IT+Moderna:wght@100..400&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/plugins/hethongdaily/view/home/member/themeinfo/theme4/main.css">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Pacifico&display=swap');
  </style>
  <link rel="icon" type="image/x-icon" href="<?php echo $info->image_system;?>" />
        <?php 
            mantan_header();

            if(function_exists('showSeoHome')) showSeoHome();
        ?>
</head>
<body>
  <div class="container">
    <!--Home tab-->
    <div id="info" class="tab-content active">
      <div class="home">
        <!--Header-->
        <div class="home-header">
          <button type="button" class="btn-save" onclick="saveToPhonebook()">Lưu danh bạ</button>
          <div class="avt-container">
            <img src="<?php echo $info->avatar;?>" alt="">
          </div>
          <div class="">
            <div class="home-name fs-4"><?php echo $info->name;?></div>
            <div class="home-cty"><?php echo $info->name_position;?></div>
          </div>
          <div>
            <div class="home-title"><?php echo $info->name_system;?></div>
          </div>
        </div>
        <!--Home body-->
        <div class="home-body-wrapper">
          <div class="home-body">
             <?php 
             if(!empty($info->facebook)){ ?>
            <a href="<?php echo $info->facebook;?>" target="_blank"  class="body-action">
              <div class="logo-container"><img src="/plugins/hethongdaily/view/home/member/themeinfo/theme4/assets/images/fb1.svg" alt=""></div>
              <div class="action-text">
                <h5>Facebook</h5>
                <div class="text">Kết nối với tôi qua facebook</div>
              </div>
            </a>
             <?php }
             if(!empty($info->zalo)){ ?>
            <a href="<?php echo $info->zalo;?>" target="_blank"  class="body-action">
              <div class="logo-container"><img src="/plugins/hethongdaily/view/home/member/themeinfo/theme4/assets/images/zalo.webp" alt=""></div>
              <div class="action-text">
                <h5>Zalo</h5>
                <div class="text">Liên hệ với tôi qua zalo</div>
              </div>
            </a>
             <?php }
             if(!empty($info->tiktok)){ ?>
            <a href="<?php echo $info->tiktok;?>" target="_blank" class="body-action">
              <div class="logo-container"><img src="/plugins/hethongdaily/view/home/member/themeinfo/theme4/assets/images/tiktok.png" alt=""></div>
              <div class="action-text">
                <h5>Tiktok</h5>
                <div class="text">Bạn đã theo dõi tôi chưa</div>
              </div>
            </a>
             <?php }
             if(!empty($info->youtube)){ ?>
            <a href="<?php echo $info->youtube;?>" target="_blank" class="body-action">
              <div class="logo-container"><img src="/plugins/hethongdaily/view/home/member/themeinfo/theme4/assets/images/youtube.webp" alt=""></div>
              <div class="action-text">
                <h5>Youtube</h5>
                <div class="text">Kênh chia sẻ chuyên sâu của tôi</div>
              </div>
            </a>
             <?php }
             if(!empty($info->web)){ ?>
            <a href="<?php echo $info->web;?>" target="_blank" class="body-action">
              <div class="logo-container"><img src="/plugins/hethongdaily/view/home/member/themeinfo/theme4/assets/images/internet.jpg" alt=""></div>
              <div class="action-text">
                <h5>Website</h5>
                <div class="text">Khám phá website của chúng tôi</div>
              </div>
            </a>
             <?php }
             if(!empty($info->instagram)){ ?>
            <a href="<?php echo $info->web;?>" target="_blank" class="body-action">
              <div class="logo-container"><img src="/plugins/hethongdaily/view/home/member/themeinfo/theme4/assets/images/instagram.png" alt=""></div>
              <div class="action-text">
                <h5>Instagram</h5>
                <div class="text">Khám phá instagram của chúng tôi</div>
              </div>
            </a>
             <?php }
             if(!empty($info->linkedin)){ ?>
            <a href="<?php echo $info->web;?>" target="_blank"  class="body-action">
              <div class="logo-container"><img src="/plugins/hethongdaily/view/home/member/themeinfo/theme4/assets/images/linkedin.webp" alt=""></div>
              <div class="action-text">
                <h5>Linkedin</h5>
                <div class="text">Khám phá linkedin của chúng tôi</div>
              </div>
            </a>
             <?php } ?>

             <?php if(!empty($dataLink)){
              foreach($dataLink as $key => $item){
                $icon = '';
                if($item->type=='website'){
                  $icon = '<img src="/plugins/hethongdaily/view/home/member/themeinfo/theme4/assets/images/internet.jpg">';
                }elseif($item->type=='facebook'){
                  $icon = '<img src="/plugins/hethongdaily/view/home/member/themeinfo/theme4/assets/images/fb1.svg">';
                }elseif($item->type=='instagram'){
                  $icon = '<img src="/plugins/hethongdaily/view/home/member/themeinfo/theme4/assets/images/instagram.png">';
                }elseif($item->type=='tiktok'){
                  $icon = '<img src="/plugins/hethongdaily/view/home/member/themeinfo/theme4/assets/images/internet.jpg">';
                }elseif($item->type=='youtube'){
                  $icon = '<img src="/plugins/hethongdaily/view/home/member/themeinfo/theme4/assets/images/youtube.webp">';
                }elseif($item->type=='zalo'){
                  $icon = '<img src="/plugins/hethongdaily/view/home/member/themeinfo/theme4/assets/images/zalo.webp">';
                }elseif($item->type=='linkedin'){
                  $icon = '<img src="/plugins/hethongdaily/view/home/member/themeinfo/theme4/assets/images/linkedin.webp">';
                }elseif($item->type=='twitter'){
                  $icon = '<img src="/plugins/hethongdaily/view/home/member/themeinfo/theme4/assets/images/internet.jpg">';
                }

                echo '<a target="_blank" href="'.$item->link.'" class="body-action">
                <div class="logo-container">'.$icon.'</div>

                <div class="action-text">
                <h5>'.$item->namelink.'</h5>
                <div class="text">'.$item->description.'</div>
                </div>
                </a>';
              }
            } 

            ?>
          </div>
        </div>
      </div>
    </div>

     <!-- Sản phẩm -->
     <div id="products" class="tab-content ">
       <?php 
       if(!empty($listProduct)){
        foreach ($listProduct as $item) {
          echo '<div class="products-body">
          <h4>'.@$item['category']->name.'</h4>';
          if(!empty($item['product'])){
            foreach ($item['product'] as $product) {
              $price_old = '';
              if($product->price_old>$product->price){
              $price_old = number_format($product->price_old).'đ';
              }
              echo ' <div class="product">
              <div class="check-input">
              <input type="checkbox" data-idProduct="'.$product->id.'" type="checkbox" name="id_product[]" id="checkbox'.$product->id.'">
              </div>
              <div class="product-image-container">
              <img src="'.$product->image.'" alt="">
              </div>
              <div class="d-flex flex-column align-items-start gap-1">
              <div class="product-des">'.$product->title.'</div>
              <div class="product-prices">
              <div class="product-old-price">'.$price_old.'</div>
              <div class="product-new-price">'.number_format($product->price).'đ</div>
              </div>
              <div class="qty-input">
              <button class="qty-count" onclick="minusProduct('.$product->id.');" type="button">-</button>
              <input class="product-qty" type="number" name="product-qty"readonly type="text" id="numberProduct'.$product->id.'" value="1" min="1">
              <button class="qty-count" onclick="plusProduct('.$product->id.');" type="button">+</button>
              </div>
              </div>
              </div>';
            }
          }
        echo '</div>';
    }
  }
  ?>

  <button class='btn-buy' onclick="checkSelectProduct();">Đặt mua hàng</button>
</div>
    <!-- Tab đặt hàng -->
    <div class="tab-content" id="order">
      <div class=" p-3 justify-content-center">
        <div class="mb-3">
          <label for="full_name" class="form-label">Đối tượng đặt hàng (*)</label><br/>
          <input type="radio" id="typeUser" name="typeUser" value="customer" checked /> Khách lẻ 
          &nbsp;&nbsp;&nbsp;
          <input type="radio" id="typeUser" name="typeUser" value="member" /> Đại lý 
        </div>

        <div id="info_customer">
          <div class=" p-4"> 
             <div class="input-group input-group-sm mb-3">
              <span class="input-group-text" >Họ tên (*)</span>
              <input type="text" class="form-control" aria-label="Sizing example input" id="full_name" name="full_name" value="" required />
            </div>
             <div class="input-group input-group-sm mb-3">
              <span class="input-group-text" >Số điện thoại (*)</span>
              <input type="text" class="form-control" aria-label="Sizing example input" id="phone" name="phone" value="" required />
            </div>
             <div class="input-group input-group-sm mb-3">
              <span class="input-group-text" >Địa chỉ nhận hàng</span>
              <input type="text" class="form-control" aria-label="Sizing example input" id="address" name="address" value="" />
            </div>
             <div class="input-group input-group-sm mb-3">
              <span class="input-group-text" >Ngày sinh</span>
              <!-- <input type="text" class="form-control datepicker" id="birthday" name="birthday" value="" /> -->
               <input type="text" class="form-control datepicker"  name="birthday" id="birthday" />
            </div>
             <div class="input-group input-group-sm mb-3">
              <span class="input-group-text" >Mã giảm giá</span>
              <input type="text" class="form-control" aria-label="Sizing example input" id="discountCode" onchange="searchDiscountCodeAgencyAPI()" name="discountCode" value="" />
              <span id="messdiscount"></span>
            </div>
          </div>
        </div>
        <div id="info_member" style="display: none;">
           <div class="input-group input-group-sm mb-3">
             <span class="input-group-text" >Số điện thoại đại lý (*)</span>
            <input type="text" class="form-control" id="phone_member" name="phone_member" value="" onchange="checkMember();" required />
          </div>

           <div class="input-group input-group-sm mb-3">
             <span class="input-group-text" >Ghi chú mua hàng</span>  
            <textarea name="note_member" id="note_member" class="form-control"></textarea>
          </div>
        </div>
        <div class="mb-3 ">
          <input type="hidden" id="money" value="0">
          <input type="hidden" id="discount" value="0">
          <input type="hidden" id="total" value="0">
          <input type="hidden" id="codeDiscount" value="">
          <input type="hidden" id="promotion" value="0">
          <button type="button" class="btn btn-danger" id="buttonCreateOrder" onclick="createOrder();" >TẠO ĐƠN HÀNG</button> 
        </div>
        <div id="list_cart" class="mb-3"></div>
        <?php
        if(!empty($info->bank_name) && !empty($info->bank_number) && !empty($info->bank_code)){ 
          echo '<center><img src="https://img.vietqr.io/image/'.$info->bank_code.'-'.$info->bank_number.'-compact2.png?amount=&addInfo=&accountName='.$info->bank_name.'" width="80%" /></center>';
        }
        ?>
        </div>
      </div>

    <!--Costomer field-->
    <div id="customer" class="tab-content">
      <h4>Thông tin khách hàng</h4>
      <form class='form-info' id="uploadFormCustomer" enctype="multipart/form-data">
        <div class="input-group input-group-sm mb-3">
          <span class="input-group-text">Họ và tên</span>
          <input type="text" class="form-control"  name="full_name" aria-label="Sizing example input" aria-describedby="name" required>
        </div>
        <div class="input-group input-group-sm mb-3">
          <span class="input-group-text" >Số điện thoại</span>
          <input type="text" class="form-control"  name="phone" aria-label="Sizing example input" aria-describedby="phone" required>
        </div>
        <div class="input-group input-group-sm mb-3">
          <label class="input-group-text" for="inputGroupFile01">Ảnh đại diện</label>
          <input type="file" class="form-control" name="avatar" id="inputGroupFile01">
        </div>
        <div class="input-group input-group-sm mb-3">
          <span class="input-group-text" >Địa chỉ</span>
          <input type="text" class="form-control" name="address" aria-label="Sizing example input" aria-describedby="address" required>
        </div>
        <div class="input-group input-group-sm mb-3">
          <span class="input-group-text" >Ngày sinh</span>
          <input type="text" class="form-control datepicker"  name="birthday" id="datepicker"><br>
        </div>

        <?php 
        if(!empty($listGroupCustomer)){
          echo '  <div class="input-group input-group-sm mb-3">
          <span class="input-group-text" >Nhóm khách hàng</span>
          <select name="id_group" class="form-select" >
          <option value="">Chọn nhóm khách hàng</option>';
          foreach ($listGroupCustomer as $key => $value) {
            echo '<option value="'.$value->id.'">'.$value->name.'</option>';
          }
          echo      '</select>
          </div>';
        }
        ?>
    
        <button class='btn-submit' type='submit'>Lưu thông tin</button>
      </form>
    </div>

    <!--Tabs bar-->
    <div class="tabs">
      <ul class="nav-tabs">
          <li class="active"><a href="#info">Thông tin</a></li>
          <li><a href="#products">Sản phẩm</a></li>
          <li><a href="#customer">Khách hàng</a></li>
      </ul>
    </div>
  </div>
</body>
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
  <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script src="/plugins/hethongdaily/view/home/member/themeinfo/theme4/profile.js"></script>

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
                    document.getElementById("products").style.display = 'none';

                    document.getElementById("order").classList.add("active");
                    document.getElementById("order").style.display = 'block';
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

</html>