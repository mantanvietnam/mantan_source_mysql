<!doctype html>
<html>
    <head>
        <meta charset='utf-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <title><?php echo $info->name;?></title>
        <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css' rel='stylesheet'>
        <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet'>
        <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
        <link rel="icon" type="image/x-icon" href="<?php echo $info->image_system;?>" />
        <?php mantan_header();?>
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

            .btn {
                height: 140px;
                width: 140px;
                border-radius: 50%
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
                             
                            <img class="avatar" src="<?php echo $info->avatar;?>" height="150" width="150" />
                            

                            <span class="name mt-3"><?php echo $info->name;?></span> 
                            <span class="idd"><?php echo $info->name_position.' '.$info->name_system;?></span> 

                            <div class="d-flex flex-row justify-content-center align-items-center gap-2"> 
                                <span class="idd1" id="myPhone"><?php echo $info->phone;?></span> 
                                <span><i class="fa fa-copy" onclick="copyText();"></i></span> 
                            </div> 

                            <div class="d-flex flex-row justify-content-center align-items-center mt-3"> 
                                <span class="number"><?php echo number_format(rand(1000,99999));?><span class="follow"> người theo dõi</span></span> 
                            </div> 

                            <div class=" d-flex mt-2"> 
                                <button class="btn1 btn-dark" onclick="saveToPhonebook()">LƯU DANH BẠ</button> 
                            </div> 

                            <div class="text mt-3"> 
                                <?php echo $info->description;?> 
                            </div> 

                            <?php if(!empty($info->facebook)){ ?>
                            <div class="row social mb-3">
                                <div class="col-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" preserveAspectRatio="none" viewBox="0 0 32 32" class="" fill="#000"><image href="/plugins/hethongdaily/view/home/assets/img/icons/facebook.svg" height="32" width="32"></image></svg>
                                </div>

                                <div class="col-9 text-center">
                                    <span class="title">Trang Facebook</span><br/>
                                    <span class="des">Kết bạn với tôi nhé</span>
                                </div>
                            </div>
                            <?php }?>

                            <?php if(!empty($info->zalo)){ ?>
                            <div class="row social mb-3">
                                <div class="col-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" preserveAspectRatio="none" viewBox="0 0 32 32" class="" fill="#000"><image href="/plugins/hethongdaily/view/home/assets/img/icons/zalo.svg" height="32" width="32"></image></svg>
                                </div>

                                <div class="col-9 text-center">
                                    <span class="title">Trang Zalo</span><br/>
                                    <span class="des">Thông tin cá nhân</span>
                                </div>
                            </div>
                            <?php }?>

                            <?php if(!empty($info->tiktok)){ ?>
                            <div class="row social mb-3">
                                <div class="col-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" preserveAspectRatio="none" viewBox="0 0 32 32" class="" fill="#000"><image href="/plugins/hethongdaily/view/home/assets/img/icons/tiktok.svg" height="32" width="32"></image></svg>
                                </div>

                                <div class="col-9 text-center">
                                    <span class="title">Kênh TikTok</span><br/>
                                    <span class="des">Bạn đã bấm theo dõi tôi chưa?</span>
                                </div>
                            </div>
                            <?php }?>

                            <?php if(!empty($info->youtube)){ ?>
                            <div class="row social mb-3">
                                <div class="col-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" preserveAspectRatio="none" viewBox="0 0 32 32" class="" fill="#000"><image href="/plugins/hethongdaily/view/home/assets/img/icons/youtube.svg" height="32" width="32"></image></svg>
                                </div>

                                <div class="col-9 text-center">
                                    <span class="title">Kênh Youtube</span><br/>
                                    <span class="des">Kênh chia sẻ kiến thức chuyên sâu</span>
                                </div>
                            </div>
                            <?php }?>

                            <?php if(!empty($info->web)){ ?>
                            <div class="row social mb-3">
                                <div class="col-3">
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/73/Circle-icons-global.svg/1024px-Circle-icons-global.svg.png" width="100%">
                                </div>

                                <div class="col-9 text-center">
                                    <span class="title">Trang website</span><br/>
                                    <span class="des">Tư vấn, chăm sóc khách hàng</span>
                                </div>
                            </div>
                            <?php }?>

                            <?php if(!empty($info->instagram)){ ?>
                            <div class="row social mb-3">
                                <div class="col-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" preserveAspectRatio="none" viewBox="0 0 32 32" class="" fill="#000"><image href="/plugins/hethongdaily/view/home/assets/img/icons/instagram.svg" height="32" width="32"></image></svg>
                                </div>

                                <div class="col-9 text-center">
                                    <span class="title">Trang Instagram</span><br/>
                                    <span class="des">Hãy xem những bức ảnh của tôi</span>
                                </div>
                            </div>
                            <?php }?>

                            <?php if(!empty($info->linkedin)){ ?>
                            <div class="row social mb-3">
                                <div class="col-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" preserveAspectRatio="none" viewBox="0 0 32 32" class="" fill="#000"><image href="/plugins/hethongdaily/view/home/assets/img/icons/linkedin.svg" height="32" width="32"></image></svg>
                                </div>

                                <div class="col-9 text-center">
                                    <span class="title">Trang Linkedin</span><br/>
                                    <span class="des">Kết nối công việc</span>
                                </div>
                            </div>
                            <?php }?>

                            <?php if(!empty($info->twitter)){ ?>
                            <div class="row social mb-3">
                                <div class="col-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" preserveAspectRatio="none" viewBox="0 0 32 32" class="" fill="#000"><image href="/plugins/hethongdaily/view/home/assets/img/icons/twitter.svg" height="32" width="32"></image></svg>
                                </div>

                                <div class="col-9 text-center">
                                    <span class="title">Trang Twitter</span><br/>
                                    <span class="des">Chia sẻ quan điểm cá nhân</span>
                                </div>
                            </div>
                            <?php }?>

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

            <!-- Tab Sản phẩm -->
            <div class="tab-pane fade" id="products">
                <div class="container p-3 d-flex justify-content-center">
                    <div class="card p-4"> 
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                  <th colspan="4">Sức khỏe</th>
                                </tr>
                                <tr onclick="checkbox(1);">
                                    <th>
                                        <input type="checkbox" name="" id="checkbox1">
                                    </th>
                                    <td width="80">
                                        <img src="https://apis.ezpics.vn/upload/admin/images/686/thumb_product_25877.png" class="img-thumbnail">
                                    </td>
                                    <td>Trà thảo dược</td>
                                    <td>
                                        100.000đ<br/>
                                        <del class="small">150.000đ</del>
                                    </td>
                                </tr>
                                <tr onclick="checkbox(2);">
                                    <th>
                                        <input type="checkbox" name="" id="checkbox2">
                                    </th>
                                    <td width="80">
                                        <img src="https://apis.ezpics.vn/upload/admin/images/686/thumb_product_25877.png" class="img-thumbnail">
                                    </td>
                                    <td>Trà thảo dược</td>
                                    <td>
                                        100.000đ<br/>
                                        <del class="small">150.000đ</del>
                                    </td>
                                </tr><tr onclick="checkbox(3);">
                                    <th>
                                        <input type="checkbox" name="" id="checkbox3">
                                    </th>
                                    <td width="80">
                                        <img src="https://apis.ezpics.vn/upload/admin/images/686/thumb_product_25877.png" class="img-thumbnail">
                                    </td>
                                    <td>Trà thảo dược</td>
                                    <td>
                                        100.000đ<br/>
                                        <del class="small">150.000đ</del>
                                    </td>
                                </tr><tr onclick="checkbox(1);">
                                    <th>
                                        <input type="checkbox" name="" id="checkbox1">
                                    </th>
                                    <td width="80">
                                        <img src="https://apis.ezpics.vn/upload/admin/images/686/thumb_product_25877.png" class="img-thumbnail">
                                    </td>
                                    <td>Trà thảo dược</td>
                                    <td>
                                        100.000đ<br/>
                                        <del class="small">150.000đ</del>
                                    </td>
                                </tr><tr onclick="checkbox(1);">
                                    <th>
                                        <input type="checkbox" name="" id="checkbox1">
                                    </th>
                                    <td width="80">
                                        <img src="https://apis.ezpics.vn/upload/admin/images/686/thumb_product_25877.png" class="img-thumbnail">
                                    </td>
                                    <td>Trà thảo dược</td>
                                    <td>
                                        100.000đ<br/>
                                        <del class="small">150.000đ</del>
                                    </td>
                                </tr><tr onclick="checkbox(1);">
                                    <th>
                                        <input type="checkbox" name="" id="checkbox1">
                                    </th>
                                    <td width="80">
                                        <img src="https://apis.ezpics.vn/upload/admin/images/686/thumb_product_25877.png" class="img-thumbnail">
                                    </td>
                                    <td>Trà thảo dược</td>
                                    <td>
                                        100.000đ<br/>
                                        <del class="small">150.000đ</del>
                                    </td>
                                </tr><tr onclick="checkbox(1);">
                                    <th>
                                        <input type="checkbox" name="" id="checkbox1">
                                    </th>
                                    <td width="80">
                                        <img src="https://apis.ezpics.vn/upload/admin/images/686/thumb_product_25877.png" class="img-thumbnail">
                                    </td>
                                    <td>Trà thảo dược</td>
                                    <td>
                                        100.000đ<br/>
                                        <del class="small">150.000đ</del>
                                    </td>
                                </tr><tr onclick="checkbox(1);">
                                    <th>
                                        <input type="checkbox" name="" id="checkbox1">
                                    </th>
                                    <td width="80">
                                        <img src="https://apis.ezpics.vn/upload/admin/images/686/thumb_product_25877.png" class="img-thumbnail">
                                    </td>
                                    <td>Trà thảo dược</td>
                                    <td>
                                        100.000đ<br/>
                                        <del class="small">150.000đ</del>
                                    </td>
                                </tr>
                                
                            </tbody>
                        </table>
                            
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabs navigation -->
        <ul class="nav nav-tabs justify-content-center mt-3" id="myTabs">
            <li class="nav-item">
                <a class="nav-link active" id="info-tab" data-toggle="tab" href="#info">Thông tin</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="product-tab" data-toggle="tab" href="#products">Sản phẩm</a>
            </li>
        </ul>

        <!-- Bootstrap JS, Popper.js, and jQuery -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
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
        </script>
    </body>
</html>