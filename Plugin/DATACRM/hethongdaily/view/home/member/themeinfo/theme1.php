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
        
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/ui/1.13.3/jquery-ui.js"></script>

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

            .avatar{
                object-fit: cover;
            }
            
            #myPhone{
                color: #000 !important;
            }

            #QRCode{
                position: relative;
                top: -19px;
                left: -155px;
            }

            a[href^="tel"] {
                color: black !important; /* Đặt màu văn bản thành màu đen */
                text-decoration: none; /* Bỏ gạch chân nếu cần */
                pointer-events: none; /* Ngăn chặn hành vi liên kết */
                cursor: default; /* Đổi con trỏ chuột */
            }

            .add-home-button{
                position: relative;
                top: -46px;
                right: -150px;
                font-size: 25px;
            }
        </style>                            
    </head>
    
    <body className='snippet-body'>
        
        <!-- Tabs content -->
        <div class="tab-content">
            <!-- Tab Thông tin -->
            <div class="tab-pane fade show active" id="info">
                <div class="container p-3 d-flex justify-content-center"> 
                    <div class="card p-4"> 
                        <div class=" d-flex flex-column justify-content-center align-items-center"> 
                            
                            <img onclick="showQRCode();" src="https://api.qrserver.com/v1/create-qr-code/?size=500x500&data=<?php echo $urlHomes.$urlCurrent;?>" id="QRCode" width="30" />

                            <i class="fa fa-cloud-download add-home-button" aria-hidden="true"></i>
                                
                             
                            <img class="avatar" src="<?php echo $info->avatar;?>" height="150" width="150" />
                            

                            <span class="name mt-3"><?php echo $info->name;?></span> 
                            <span class="idd"><?php echo $info->name_position.' '.$info->name_system;?></span> 

                            <div class="d-flex flex-row justify-content-center align-items-center gap-2"> 
                                <span class="idd1" id="myPhone"><?php echo $info->phone;?></span> 
                                <span><i class="fa fa-copy" onclick="copyText();"></i></span> 
                            </div> 

                            <div class="d-flex flex-row justify-content-center align-items-center mt-3"> 
                                <span class="number"><?php echo number_format($info->view);?><span class="follow"> lượt xem</span></span> 
                            </div> 

                            <div class=" d-flex mt-2"> 
                                <button class="btn1 btn-dark" onclick="saveToPhonebook()">LƯU DANH BẠ</button> 
                                 <!-- <a class="btn1 btn-dark" id="affiliate-tab" data-toggle="tab" href="#affiliate">ĐK CTV</a> -->
                            </div> 

                            <div class="text mt-3"> 
                                <?php echo $info->description;?> 
                            </div> 

                            <a id="customer-tab" data-toggle="tab" onclick="buttonAffiliate();" href="#affiliate">
                                <div class="row social mb-3">
                                    <div class="col-12 text-center">
                                        <span class="title">Đăng ký cộng tác viên</span><br/>
                                        <!-- <span class="des">Kết bạn với tôi nhé</span> -->
                                    </div>
                                </div>
                            </a>

                            <?php if(!empty($info->facebook)){ ?>
                            <a target="_blank" href="<?php echo $info->facebook;?>">
                                <div class="row social mb-3">
                                    <div class="col-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" preserveAspectRatio="none" viewBox="0 0 32 32" class="" fill="#000"><image href="/plugins/hethongdaily/view/home/assets/img/icons/facebook.svg" height="32" width="32"></image></svg>
                                    </div>

                                    <div class="col-9 text-center">
                                        <span class="title">Trang Facebook</span><br/>
                                        <span class="des">Kết bạn với tôi nhé</span>
                                    </div>
                                </div>
                            </a>
                            <?php }?>

                            <?php if(!empty($info->zalo)){ ?>
                            <a target="_blank" href="<?php echo $info->zalo;?>">
                                <div class="row social mb-3">
                                    <div class="col-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" preserveAspectRatio="none" viewBox="0 0 32 32" class="" fill="#000"><image href="/plugins/hethongdaily/view/home/assets/img/icons/zalo.svg" height="32" width="32"></image></svg>
                                    </div>

                                    <div class="col-9 text-center">
                                        <span class="title">Trang Zalo</span><br/>
                                        <span class="des">Thông tin cá nhân</span>
                                    </div>
                                </div>
                            </a>
                            <?php }?>

                            <?php if(!empty($info->tiktok)){ ?>
                            <a target="_blank" href="<?php echo $info->tiktok;?>">
                                <div class="row social mb-3">
                                    <div class="col-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" preserveAspectRatio="none" viewBox="0 0 32 32" class="" fill="#000"><image href="/plugins/hethongdaily/view/home/assets/img/icons/tiktok.svg" height="32" width="32"></image></svg>
                                    </div>

                                    <div class="col-9 text-center">
                                        <span class="title">Kênh TikTok</span><br/>
                                        <span class="des">Bạn đã bấm theo dõi tôi chưa?</span>
                                    </div>
                                </div>
                            </a>
                            <?php }?>

                            <?php if(!empty($info->youtube)){ ?>
                            <a target="_blank" href="<?php echo $info->youtube;?>">
                                <div class="row social mb-3">
                                    <div class="col-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" preserveAspectRatio="none" viewBox="0 0 32 32" class="" fill="#000"><image href="/plugins/hethongdaily/view/home/assets/img/icons/youtube.svg" height="32" width="32"></image></svg>
                                    </div>

                                    <div class="col-9 text-center">
                                        <span class="title">Kênh Youtube</span><br/>
                                        <span class="des">Kênh chia sẻ kiến thức chuyên sâu</span>
                                    </div>
                                </div>
                            </a>
                            <?php }?>

                            <a target="_blank" href="<?php echo $info->web;?>">
                                <div class="row social mb-3">
                                    <div class="col-3">
                                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/73/Circle-icons-global.svg/1024px-Circle-icons-global.svg.png" width="100%">
                                    </div>

                                    <div class="col-9 text-center">
                                        <span class="title">Trang website</span><br/>
                                        <span class="des">Tư vấn, chăm sóc khách hàng</span>
                                    </div>
                                </div>
                            </a>

                            <?php if(!empty($info->instagram)){ ?>
                            <a target="_blank" href="<?php echo $info->instagram;?>">
                                <div class="row social mb-3">
                                    <div class="col-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" preserveAspectRatio="none" viewBox="0 0 32 32" class="" fill="#000"><image href="/plugins/hethongdaily/view/home/assets/img/icons/instagram.svg" height="32" width="32"></image></svg>
                                    </div>

                                    <div class="col-9 text-center">
                                        <span class="title">Trang Instagram</span><br/>
                                        <span class="des">Hãy xem những bức ảnh của tôi</span>
                                    </div>
                                </div>
                            </a>
                            <?php }?>

                            <?php if(!empty($info->linkedin)){ ?>
                            <a target="_blank" href="<?php echo $info->linkedin;?>">
                                <div class="row social mb-3">
                                    <div class="col-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" preserveAspectRatio="none" viewBox="0 0 32 32" class="" fill="#000"><image href="/plugins/hethongdaily/view/home/assets/img/icons/linkedin.svg" height="32" width="32"></image></svg>
                                    </div>

                                    <div class="col-9 text-center">
                                        <span class="title">Trang Linkedin</span><br/>
                                        <span class="des">Kết nối công việc</span>
                                    </div>
                                </div>
                            </a>
                            <?php }?>

                            <?php if(!empty($info->twitter)){ ?>
                            <a target="_blank" href="<?php echo $info->twitter;?>">
                                <div class="row social mb-3">
                                    <div class="col-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" preserveAspectRatio="none" viewBox="0 0 32 32" class="" fill="#000"><image href="/plugins/hethongdaily/view/home/assets/img/icons/twitter.svg" height="32" width="32"></image></svg>
                                    </div>

                                    <div class="col-9 text-center">
                                        <span class="title">Trang Twitter</span><br/>
                                        <span class="des">Chia sẻ quan điểm cá nhân</span>
                                    </div>
                                </div>
                            </a>
                            <?php }?> 

                            <?php if(!empty($dataLink)){
                                foreach($dataLink as $key => $item){
                                    $icon = '';
                                    if($item->type=='website'){
                                        $icon = '<img src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/73/Circle-icons-global.svg/1024px-Circle-icons-global.svg.png" width="100%">';
                                    }elseif($item->type=='facebook'){
                                        $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" preserveAspectRatio="none" viewBox="0 0 32 32" class="" fill="#000"><image href="/plugins/hethongdaily/view/home/assets/img/icons/facebook.svg" height="32" width="32"></image></svg>';
                                    }elseif($item->type=='instagram'){
                                        $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" preserveAspectRatio="none" viewBox="0 0 32 32" class="" fill="#000"><image href="/plugins/hethongdaily/view/home/assets/img/icons/instagram.svg" height="32" width="32"></image></svg>';
                                    }elseif($item->type=='tiktok'){
                                        $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" preserveAspectRatio="none" viewBox="0 0 32 32" class="" fill="#000"><image href="/plugins/hethongdaily/view/home/assets/img/icons/tiktok.svg" height="32" width="32"></image></svg>';
                                    }elseif($item->type=='youtube'){
                                        $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" preserveAspectRatio="none" viewBox="0 0 32 32" class="" fill="#000"><image href="/plugins/hethongdaily/view/home/assets/img/icons/youtube.svg" height="32" width="32"></image></svg>';
                                    }elseif($item->type=='zalo'){
                                        $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" preserveAspectRatio="none" viewBox="0 0 32 32" class="" fill="#000"><image href="/plugins/hethongdaily/view/home/assets/img/icons/zalo.svg" height="32" width="32"></image></svg>';
                                    }elseif($item->type=='linkedin'){
                                        $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" preserveAspectRatio="none" viewBox="0 0 32 32" class="" fill="#000"><image href="/plugins/hethongdaily/view/home/assets/img/icons/linkedin.svg" height="32" width="32"></image></svg>';
                                    }elseif($item->type=='twitter'){
                                        $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" preserveAspectRatio="none" viewBox="0 0 32 32" class="" fill="#000"><image href="/plugins/hethongdaily/view/home/assets/img/icons/twitter.svg" height="32" width="32"></image></svg>';
                                    }

                                    echo '<a target="_blank" href="'.$item->link.'">
                                <div class="row social mb-3">
                                    <div class="col-3">'.$icon.'</div>

                                    <div class="col-9 text-center">
                                        <span class="title">'.$item->namelink.'</span><br/>
                                        <span class="des">'.$item->description.'</span>
                                    </div>
                                </div>
                            </a>';
                                }
                            } 

                             ?>

                            <?php 
                                if(!empty($info->bank_name) && !empty($info->bank_number) && !empty($info->bank_code)){ 
                                    echo '<center class="mb-3"><img src="https://img.vietqr.io/image/'.$info->bank_code.'-'.$info->bank_number.'-compact2.png?amount=&addInfo=&accountName='.$info->bank_name.'" width="80%" /></center>';
                                }
                            ?>

                            <!--
                            <div class="gap-3 mt-3 icons d-flex flex-row justify-content-center align-items-center"> 
                                <span><i class="fa fa-twitter"></i></span> 
                                <span><i class="fa fa-facebook-f"></i></span> 
                                <span><i class="fa fa-instagram"></i></span> 
                                <span><i class="fa fa-linkedin"></i></span> 
                            </div> 
                            -->

                            <div class=" px-2 rounded mt-4 date "> 
                                <span class="join"><?php echo $info->email;?></span> 
                            </div> 
                        </div> 
                    </div>
                </div>
            </div>

            <!-- Tab Sản phẩm khách lẻ -->
            <div class="tab-pane fade" id="products">
                <div class="container p-3 d-flex justify-content-center">
                    <div class="card p-4"> 
                        <?php 
                        if(!empty($listProduct)){
                            echo '<table class="table table-bordered mb-5"><tbody>';
                            foreach ($listProduct as $item) {
                                
                                echo '  <tr>
                                          <th colspan="4">'.@$item['category']->name.'</th>
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
                                                    <td onclick="checkbox('.$product->id.');"><a style="color: #000;" href="/product/'.$product->slug.'.html" target="_blank">'.$product->title.'</a></td>
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

            <!-- Tab đặt hàng khách lẻ -->
            <div class="tab-pane fade" id="order">
                <div class="container p-3 d-flex justify-content-center">
                    <div class="card p-4"> 
                        <div class="mb-3">
                          <label for="full_name" class="form-label">Đối tượng đặt hàng (*)</label><br/>
                          <input type="radio" id="typeUser" name="typeUser" value="customer" checked /> Khách lẻ 
                          &nbsp;&nbsp;&nbsp;
                          <input type="radio" id="typeUser" name="typeUser" value="member" /> Đại lý 
                        </div>

                        <div id="info_customer">
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
                              <input type="text" class="form-control datepicker" id="birthday" name="birthday" value="" />
                            </div>
                            <div class="mb-3">
                              <label for="codeDiscount" class="form-label">Mã giảm giá</label><span id="messdiscount"></span>
                              <input type="text" class="form-control" id="discountCode" onchange="searchDiscountCodeAgencyAPI()" name="discountCode" value="" />
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
                        <?php
                            if(!empty($info->bank_name) && !empty($info->bank_number) && !empty($info->bank_code)){ 
                                echo '<center><img src="https://img.vietqr.io/image/'.$info->bank_code.'-'.$info->bank_number.'-compact2.png?amount=&addInfo=&accountName='.$info->bank_name.'" width="80%" /></center>';
                            }
                        ?>
                        
                    </div>
                </div>
            </div>

            <!-- Tab khách hàng -->
            <div class="tab-pane fade" id="customer">
                <div class="container p-3 d-flex justify-content-center">
                    <div class="card p-4"> 
                        <form id="uploadFormCustomer" enctype="multipart/form-data">
                            <input type="hidden" name="token" value="<?php echo $info->token;?>">
                            <div class="mb-3">
                              <label for="full_name" class="form-label">Họ tên (*)</label>
                              <input type="text" class="form-control" id="" name="full_name" value="" required />
                            </div>
                            <div class="mb-3">
                              <label for="phone" class="form-label">Số điện thoại (*)</label>
                              <input type="text" class="form-control" id="" name="phone" value="" required />
                            </div>
                            <div class="mb-3">
                              <label for="avatar" class="form-label">Ảnh đại diện</label>
                              <input type="file" class="form-control" id="" name="avatar" value="" accept="image/*" />
                            </div>
                            <div class="mb-3">
                              <label for="address" class="form-label">Địa chỉ</label>
                              <input type="text" class="form-control" id="" name="address" value="" />
                            </div>
                            <div class="mb-3">
                              <label for="birthday" class="form-label">Ngày sinh (giảm giá khi đến sinh nhật)</label>
                              <input type="text" class="form-control datepicker" id="" name="birthday" value="" />
                            </div>

                            <?php 
                            if(!empty($listGroupCustomer)){
                                echo '  <div class="mb-3">
                                          <label for="phone" class="form-label">Nhóm khách hàng</label>
                                          <select name="id_group" class="form-select" >
                                            <option value="">Chọn nhóm khách hàng</option>';
                                            foreach ($listGroupCustomer as $key => $value) {
                                                echo '<option value="'.$value->id.'">'.$value->name.'</option>';
                                            }
                                echo      '</select>
                                        </div>';
                            }
                            ?>
                            
                            <div class="mb-3 text-center">
                                <button type="submit" class="btn btn-danger" id="" >LƯU THÔNG TIN KHÁCH HÀNG</button> 
                            </div>
                        </form>

                        <div id="show_img_card_customer"></div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="affiliate">
                <div class="container p-3 d-flex justify-content-center">
                    <div class="card p-4"> 
                        <form id="uploadFormAffiliate" enctype="multipart/form-data">
                           <h5 style="text-align: center;" for="full_name" class="form-label">ĐĂNG KÝ CỘNG TÁC VIÊN</h5>
                            <input type="hidden" name="token" value="<?php echo $info->token;?>">
                            <div class="mb-3">
                              <label for="full_name" class="form-label">Họ tên (*)</label>
                              <input type="text" class="form-control" id="" name="full_name" value="" required />
                            </div>
                            <div class="mb-3">
                              <label for="phone" class="form-label">Số điện thoại (*)</label>
                              <input type="text" class="form-control" id="" name="phone" value="" required />
                            </div>
                            <div class="mb-3">
                              <label for="avatar" class="form-label">Ảnh đại diện</label>
                              <input type="file" class="form-control" id="" name="avatar" value="" accept="image/*" />
                            </div>
                            <div class="mb-3">
                              <label for="address" class="form-label">Địa chỉ</label>
                              <input type="text" class="form-control" id="" name="address" value="" />
                            </div>
                            <div class="mb-3">
                              <label for="phone" class="form-label">Email</label>
                              <input type="text" class="form-control" id="" name="email" value="" />
                            </div>
                            <div class="mb-3">
                              <label for="phone" class="form-label">Mật khẩu </label>
                              <input type="password" class="form-control" id="" name="password" value="" />
                            </div>
                            <div class="mb-3">
                              <label for="phone" class="form-label">Mật khẩu </label>
                              <input type="password" class="form-control" id="" name="password_confirmation" value="" />
                              <input type="hidden" class="form-control" id="" name="id_member" value="<?php echo @$_GET['id'] ?>" />
                            </div>
                            
                            <div class="mb-3 text-center">
                                <div id="messAffiliater"></div>
                                <button type="submit" class="btn btn-danger" id="" >Đăng ký</button> 
                            </div>
                        </form>

                        <div id="show_img_card_customer"></div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="QRCodeAffiliater">
                <div class="container p-3 d-flex justify-content-center">
                    <div class="card p-4"> 
                        <h5 style="text-align: center;" for="full_name" class="form-label">Bạn đăng ký cộng tác viên thành công</h5>
                           <div class="modal-body" id="QRAffiliater"></div>
                        <div class="mb-3 text-center">
                                <div id="messAffiliater"></div>
                                <a class="btn btn-danger" href="<?php echo $urlHomes;?>affiliaterLogin" id="" >Đăng nhập</a> 
                            </div>
                    </div>
                </div>
            </div>
            <!-- Tab trang cá nhân -->
            <?php 
            /*
            if(!empty($info->web)){
                echo '  <div class="tab-pane fade" id="about">
                            <iframe allowfullscreen="" width="100%" height="100%" title="main360" src="'.$info->web.'"></iframe>
                        </div>';
            }
            */
            ?>
        </div>

        <!-- Tabs navigation -->
        <ul class="nav nav-tabs justify-content-center mt-3" id="myTabs">
            <li class="nav-item">
                <a class="nav-link active" id="info-tab" data-toggle="tab" href="#info">Thông tin</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="product-tab" data-toggle="tab" href="#products">Sản phẩm</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="customer-tab" data-toggle="tab" href="#customer">Khách hàng</a>
            </li>
          <!--   <li class="nav-item">
                <a class="nav-link" id="customer-tab" data-toggle="tab" href="#affiliate">ĐK CTV</a>
            </li> -->
            <?php 
            /*
            if(!empty($info->web)){
                echo '  <li class="nav-item">
                            <a class="nav-link" id="about-tab" data-toggle="tab" href="#about">Thêm</a>
                        </li>';
            }
            */
            ?>
            
            <li class="nav-item">
                <a class="nav-link" id="order-tab" data-toggle="tab" href="#order">Đặt hàng</a>
            </li>
        </ul>

        <div class="modal fade" id="QRCodeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Scan QR Code</h5>
                    </div>
                    <div class="modal-body">
                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=500x500&data=<?php echo $urlHomes.$urlCurrent;?>" width="100%" />
                    </div>
                </div>
            </div>
        </div>

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

                    $('.nav-tabs a[href="#order"]').tab('show'); 
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
                    echo "tabShow = '".$_GET['tabShow']."';";
                }
            ?>

            $('.nav-tabs a[href="#'+tabShow+'"]').tab('show');
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

            function buttonAffiliate(){

                const info = document.getElementById("info");
                const affiliate = document.getElementById("affiliate");
                const infotab = document.getElementById("info-tab");

                info.classList.remove("active");
                info.classList.remove("show");

                infotab.classList.remove("active");
                infotab.classList.remove("show");

                affiliate.classList.add("active");
                affiliate.classList.add("show");
            }


        </script>


        <script type="text/javascript">
            $(document).ready(function() {
                // Khi form được submit
                $('#uploadFormAffiliate').on('submit', function(event) {
                    // Ngăn chặn hành động mặc định của form (làm mới trang)
                    event.preventDefault();
                    
                    // Tạo đối tượng FormData để chứa dữ liệu form
                    var formData = new FormData(this);

                  
                    
                    // Sử dụng AJAX jQuery để gửi dữ liệu form lên server
                    $.ajax({
                        url: '/apis/saveInfoAffiliaterAPI', // URL của server nơi bạn muốn upload file
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(msg) {
                              console.log(msg);
                              if(msg.code==1){
                                var html = '<label for="full_name" class="form-label">QR code</label>\
                                <img src="https://api.qrserver.com/v1/create-qr-code/?size=500x500&data=<?php echo $urlHomes;?>book-online/?aff='+msg.data.phone+'" width="100%" />\
                                <label for="full_name" class="form-label"> link chia sẽ mua hàng của bạn </label>\
                                   <a style="color: #0d6efd;" href="<?php echo $urlHomes;?>book-online/?aff='+msg.data.phone+'"><?php echo $urlHomes;?>book-online/?aff='+msg.data.phone+'</a>';

                                   $('#QRAffiliater').html(html); 

                                const codeAffiliater = document.getElementById("QRCodeAffiliater");
                                const affiliate = document.getElementById("affiliate");
                                affiliate.classList.remove("active");
                                affiliate.classList.remove("show");

                                codeAffiliater.classList.add("active");
                                codeAffiliater.classList.add("show");


                              }else{
                                 $('#messAffiliater').html('<span class="text-danger">'+msg.mess+'</span>');  
                              }
                           
                        },
                        
                    });
                });
            });

        </script>

  
    </body>
</html>