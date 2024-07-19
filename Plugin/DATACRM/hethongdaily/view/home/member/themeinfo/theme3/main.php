<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/plugins/hethongdaily/view/home/member/themeinfo/theme3/alicenguyen.css">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href= 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css' 
         rel= 'biểu định kiểu'> 
    <!-- font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&family=Oswald:wght@200..700&display=swap" rel="stylesheet">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <link rel="icon" type="image/x-icon" href="<?php echo $info->image_system;?>" />
    <?php 
    mantan_header();

    if(function_exists('showSeoHome')) showSeoHome();
    ?>
    <style type="text/css">
        .textarea{
            display: block;
            width: 90%;
            padding: .375rem .75rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            border-radius: .25rem;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
            margin: 0px;
        }
    </style>
</head>

<body>
    <div id="wrapper">
        <div class="tabs">
            <ul class="nav-tabs">
                <li class="active"><a href="#info">Thông tin</a></li>
                <li><a href="#products">Sản phẩm</a></li>
                <li><a href="#customer">Khách hàng</a></li>
            </ul>
        </div>
        <div class="tab-content">
            <div id="info" class="tab-content-item">
                <div class="container">
                    <div class="ladi-wraper">
                        <div id="body-background" class="ladi-section">
                            <img src="/plugins/hethongdaily/view/home/member/themeinfo/theme3/anh/5026621-20210708094515.jpg" alt="" style="height: 100%; width:100%; max-height: 100%;background-size: cover;">
                        </div>
                    </div>

                    <div class="container">
                        <div class="ladi-main">
                            <div class="ladi-bgr">
                                <img src="/plugins/hethongdaily/view/home/member/themeinfo/theme3/anh/1140-20230617124453-2cgtq.jpg" alt="" style="width: 380px;height: 264.518px;">
                                <div class="white-bgr">
                                    <div class="contact">
                                        <a class="hotline" href="#" onclick="copyText();">Hotline :  <span id="myPhone"><?php echo $info->phone;?></span></a>
                                        <div class="box182"><a href="" onclick="saveToPhonebook()">Lưu danh bạ</a></div>
                                    </div>
                                    <div class="list-58">
                                        <div class="container">
                                            <div class="img-58" style=" height: auto; padding: 20px 0px; ">
                                                <?php echo $info->description;?> 
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="box-img">
                                    <div class="box-33">
                                        <div class="container">
                                            <div class="box35">
                                                <img src="<?php echo @$info->avatar;?>" alt="">
                                            </div>
                                        </div>

                                        <div class="text-box">
                                            <div class="container">
                                                <div class="name"><?php echo $info->name;?><i class="fa-solid fa-circle-check" style="color: #74C0FC;"></i>
                                                </div>
                                            </div>
                                            <div class="container">
                                                <div class="text-NDC">
                                                    <?php echo $info->name_position.' '.$info->name_system;?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="achievements">
                                    <div class="container">
                                        <div class="achievements-wt">
                                            <div class="rectangle"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="social">
                                    <div class="container">
                                        <div class="social-img">
                                            <h4>KẾT NỐI VỚI MÌNH ĐỂ NHẬN THÊM NHIỀU KIẾN THỨC BỔ ÍCH</h4>
                                            <div class="line"></div>

                                            <div class="container">
                                                <div class="social-app">
                                                     <?php if(!empty($info->facebook)){ ?>
                                                    <div class="box84">
                                                        <div class="box-info box85">
                                                            <div class="box86">
                                                                <a class="" target="_blank" href="<?php echo $info->facebook;?>"><i class="fa-brands fa-facebook fa-2xl" style="color: #005eff;"></i></a>
                                                            </div>
                                                            <div class="text-app">
                                                                <a class="text87" target="_blank" href="<?php echo $info->facebook;?>">FaceBook Cá Nhân</a>
                                                                <h5>Kết bạn với tôi nhé</h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php }?>

                                                     <?php if(!empty($info->tiktok)){ ?>
                                                    <div class="box84">
                                                        <div class="box-info box85">
                                                            <div class="box86">
                                                                <a target="_blank" href="<?php echo $info->tiktok;?>"><i style="padding: 9px 12px;color: #005eff;" class="fa-brands fa-tiktok"></i></a>
                                                            </div>
                                                            <div class="text-app">
                                                                <a class="text87" target="_blank" href="<?php echo $info->tiktok;?>">TikTok Channel</a>
                                                                <h5>Theo dõi các video hữu ích</h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                     <?php }?>

                                                     <?php if(!empty($info->web)){ ?>
                                                    <div class="box84">
                                                        <div class="box-info box85">
                                                            <div class="box86">
                                                                <a target="_blank" href="<?php echo $info->web;?>"><i class="fa-solid fa-globe fa-2xl" style="color: #065df4;"></i></a>
                                                            </div>
                                                            <div class="text-app">
                                                                <a class="text87" target="_blank" href="<?php echo $info->web;?>">Website</a>
                                                                <h5>Giới thiệu công ty và các sản phẩm</h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                      <?php }?>
                                                     <?php if(!empty($info->youtube)){ ?>
                                                    <div class="box84">
                                                        <div class="box-info box85">
                                                            <div class="box86">
                                                                <a target="_blank" href="<?php echo $info->youtube;?>"><i class="fa-brands fa-youtube" style="color: #005eff;padding: 9px 12px;"></i></a>
                                                            </div>
                                                            <div class="text-app">
                                                                <a class="text87" target="_blank" href="<?php echo $info->youtube;?>">Youtube thương hiệu cá nhân</a>
                                                                <h5>Theo dõi các video hữu ích</h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php }?>
                                                    <?php if(!empty($dataLink)){
                                                        foreach($dataLink as $key => $item){
                                                            $icon = '';
                                                            if($item->type=='website'){
                                                                $icon = '<i class="fa-solid fa-globe fa-2xl" style="color: #005eff;"></i>';
                                                            }elseif($item->type=='facebook'){
                                                                $icon = '<i class="fa-brands fa-facebook fa-2xl" style="color: #005eff;"></i>';
                                                            }elseif($item->type=='instagram'){
                                                               $icon = '<i class="fa-brands fa-instagram" style="color: #005eff;"></i>';
                                                            }elseif($item->type=='tiktok'){
                                                               $icon = '<i class="fa-brands fa-tiktok" style="color: #005eff;"></i>';
                                                            }elseif($item->type=='youtube'){
                                                                $icon = '<i class="fa-brands fa-youtube" style="color: #005eff;"></i>';
                                                            }elseif($item->type=='zalo'){
                                                               $icon = '<i class="fa-brands fa-zalo" style="color: #005eff;"></i>';
                                                            }elseif($item->type=='linkedin'){
                                                                $icon = '<i class="fa-brands fa-linkedin" style="color: #005eff;"></i>';
                                                            }elseif($item->type=='twitter'){
                                                                $icon = '<i class="fa-brands fa-twitter" style="color: #005eff;"></i>';
                                                            }

                                                            echo '<div class="box84">
                                                        <div class="box-info box85">
                                                            <div class="box86">
                                                                <a target="_blank" href="'.$item->link.'">'.$icon.'</a>
                                                            </div>
                                                            <div class="text-app">
                                                                <a class="text87" target="_blank" href="'.$item->link.'">'.$item->namelink.'</a>
                                                                <h5>'.$item->description.'</h5>
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
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="tab-content">
            <div id="products" class="tab-content-item">
                <div class="ladi-wraper">
                    <div id="body-background" class="ladi-section">
                        <img src="/plugins/hethongdaily/view/home/member/themeinfo/theme3/anh/5026621-20210708094515.jpg" alt="" style="height: 100%; width:100%; max-height: 100%;background-size: cover;">
                    </div>
                </div>

                <div class="block-2">
                    <div class="bgr-sp">
                        <div id="menu2" class="tab-pane fade">

                            <section id="block-7">
                                <div class="table-produce">
                                 <?php 
                        if(!empty($listProduct)){
                            echo '<table class="table table-bordered mb-5"><tbody>';
                            foreach ($listProduct as $item) { 

                               echo    '<table class="table table-bordered caption-top" style=" width: 100%; ">

                                        <thead>
                                            <tr>
                                                <th class="table-caption" colspan="4">'.@$item['category']->name.'</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
                                        if(!empty($item['product'])){
                                    foreach ($item['product'] as $product) {
                                        echo '     
                                            <tr>
                                                <th scope="row" class="no-padding">
                                                    <div class="check-input">
                                                        <input  data-idProduct="'.$product->id.'" type="checkbox" name="id_product[]" id="checkbox'.$product->id.'">
                                                    </div>
                                                    <div class="qty-input">
                                                        <button class="qty-count qty-count--minus" onclick="minusProduct('.$product->id.');" type="button">-</button>
                                                        <input class="product-qty" type="number" id="numberProduct'.$product->id.'" name="numberProduct" min="0" max="999" value="1">
                                                        <button class="qty-count qty-count--add" onclick="plusProduct('.$product->id.');" type="button">+</button>
                                                    </div>
                                                </th>
                                                <td>
                                                    <img src="'.$product->image.'" alt="">
                                                </td>
                                                <td><a href="/product/'.$product->slug.'.html">'.$product->title.'</a><br/>
                                                    <span class="text-danger">'.number_format($product->price).'đ</span><br/>';
                                                        if(!empty($product->price_old)){
                                                            echo '<del class="small">'.number_format($product->price_old).'đ</del>';
                                                        }
                                                echo '</td>
                                            </tr>';
                                        }
                                    }
                                     echo   '</tbody>
                                    </table>';

                        } }
                            else{
                            echo '<p class="text-danger">Chưa có sản phẩm bán</p>';
                        }
                        ?>
                                    
                                    <div class="block-btn">
                                        <button type="button" class="buy-btn" onclick="checkSelectProduct();">ĐẶT MUA HÀNG</button>
                                    </div>
                                </div>
                            </section>

                          
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-content">
            <div class="tab-content-item" id="order">
                <div class="ladi-wraper">
                    <div id="body-background" class="ladi-section">
                        <img src="/plugins/hethongdaily/view/home/member/themeinfo/theme3/anh/5026621-20210708094515.jpg" alt="" style="height: 100%; width:100%; max-height: 100%;background-size: cover;">
                    </div>
                </div>
                <div class="block-2">
                    <div class="bgr-kh" style="height: auto; display: inline-table;">
                        <div class="contact-form-container">
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
                                  <input type="text" class="form-control datepicker" id="my_date_picker" name="birthday" value="" />
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
                              <textarea name="note_member" id="note_member" class="form-control textarea"></textarea>
                            </div>
                        </div>
                              <div class="mb-3" style="margin-top: 15px;">
                                <input type="hidden" id="money" value="0">
                                <input type="hidden" id="discount" value="0">
                                <input type="hidden" id="total" value="0">
                                <input type="hidden" id="codeDiscount" value="">
                                <input type="hidden" id="promotion" value="0">
                                <button type="button" class="btn-contact mb-3 mt-3" id="buttonCreateOrder" onclick="createOrder();" >TẠO ĐƠN HÀNG</button> 
                            </div>
                            <div id="list_cart" class="mb-3"></div>
                            <?php
                            if(!empty($info->bank_name) && !empty($info->bank_number) && !empty($info->bank_code)){ 
                                echo '<center><img src="https://img.vietqr.io/image/'.$info->bank_code.'-'.$info->bank_number.'-compact2.png?amount=&addInfo=&accountName='.$info->bank_name.'" width="80%" /></center>';
                            }
                            ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

        <div class="tab-content">
            <div id="customer" class="tab-content-item">
                <div class="ladi-wraper">
                    <div id="body-background" class="ladi-section">
                        <img src="/plugins/hethongdaily/view/home/member/themeinfo/theme3/anh/5026621-20210708094515.jpg" alt="" style="height: 100%; width:100%; max-height: 100%;background-size: cover;">
                    </div>
                </div>
                <div class="block-2">
                    <div class="bgr-kh">
                        <div class="contact-form-container">
                           <form id="uploadFormCustomer" enctype="multipart/form-data">
                            
                            <input type="hidden" name="token" value="<?php echo $info->token;?>">
                                <label for="name">Họ và tên(*)</label> <br>
                                <input type="text"class="form-control" id="name" name="name" required> <br>

                                <label for="phone">Số điện thoại(*)</label><br>
                                <input type="number" class="form-control" id="phone" name="phone" required><br>

                                <label for="file">Ảnh đại diện</label><br>
                                <input type="file"class="form-control" name="avatar" id="avatar"><br>
                                
                                <label for="adress">Địa chỉ</label><br>
                                <input type="text"class="form-control" name="address" id="address"><br>

                                <label for="adress">Ngày sinh(giảm giá khi đến sinh nhật)</label><br>
                                <input type="text" class="form-control datepicker" name="birthday" id="birthday"><br>

                                <button class="btn-contact" type="submit">Lưu thông tin khách hàng</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
</body>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script src="/plugins/hethongdaily/view/home/member/themeinfo/theme3/alicenguyen.js"></script>
<script src= "https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"> </script>
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

                    list_cart += '</tbody></table> <p style=" margin: 10px 0px; "><b>Thành tiền: </b><span id="money">'+formatNumberWithCommas(total_money)+'đ</span</p>';
                    list_cart += '</tbody></table> <p style=" margin: 10px 0px; "><b>giảm giá : </b><span id="discountmoney">0 đ</span</p>';
                    list_cart += '</tbody></table> <p style=" margin: 10px 0px; "><b>Tổng tiền: </b><span id="total_money">'+formatNumberWithCommas(total_money)+'đ</span</p>';

                    $('#list_cart').html(list_cart);
                    $('#money').val(total_money);
                    $('#discount').val(0);
                    $('#total').val(total_money);
                    console.log(total_money);

                   
                    document.getElementById('products').style.display = "none";
                    document.getElementById('order').style.display = "block";

                    // $('.tab-content a[href="#order"]').tab('show'); 
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
                    document.getElementById('products').style.display = "none";
                    document.getElementById('order').style.display = "block";
                }
            }

            function plusProduct(id)
            {
                var number = parseInt($('#numberProduct'+id).val());
                number ++;
                console.log(number);
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
                var birthday = $('#birthday').val();
                var money = $('#money').val();
                var discount = $('#discount').val();
                var total = $('#total').val();
                var codeDiscount = $('#codeDiscount').val();


                $('#buttonCreateOrder').html('ĐANG TẠO ĐƠN HÀNG ...');

                if(full_name != '' && phone != ''){
                    $.ajax({
                      method: "POST",
                      url: "/apis/paycreateOrderCustomerPAI",
                      data: { full_name: full_name, 
                          phone: phone, 
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
                    
                    // Sử dụng AJAX jQuery để gửi dữ liệu form lên server
                    $.ajax({
                        url: '/apis/saveInfoCustomerAPI', // URL của server nơi bạn muốn upload file
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            if(response.img_card_member != null && response.img_card_member.length > 0){
                                $('#uploadFormCustomer').remove();

                                var img_card_customer = "<div class='mb-3'><img id='imageToDownload' src='"+response.img_card_member+"' width='100%' /></div><div class='mb-3 text-center'><button onclick='downloadCardCustomer();' type='button' class='btn btn-danger' >TẢI ẢNH</button></div>";

                                $('#show_img_card_customer').html(img_card_customer);
                            }

                            $('.nav-tabs a[href="#info"]').tab('show');
                            
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

        $('.nav-tabs a[href="#'+tabShow+'"]').tab('show');
</script>

    <script>
    $(document).ready(function() {
      $('.datepicker').datepicker({
        format: 'dd/mm/yyyy',  // Định dạng ngày tháng
        todayHighlight: true, // Đánh dấu ngày hiện tại
        autoclose: true       // Tự động đóng Datepicker sau khi chọn ngày
      });

      $('.datetimepicker').datetimepicker({
        format:'H:i d/m/Y'
      });
    });
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