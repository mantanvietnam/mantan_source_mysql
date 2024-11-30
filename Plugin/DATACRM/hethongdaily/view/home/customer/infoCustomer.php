<!doctype html>
<html>
    <head>
        <meta charset='utf-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        
        <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css' rel='stylesheet'>
        <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet'>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <link rel="icon" type="image/x-icon" href="<?php echo @$info->image_system;?>" />
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

            .wallPost{
                background: white;
                padding: 12px;
                border-radius: 29px;
                margin-top: 15px;
            }

            .wallPost .text_full_name{
                font-size: 16px;
                font-family: fangsong;
                font-weight: 700;
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
                            
                            <img onclick="showQRCode();" src="https://api.qrserver.com/v1/create-qr-code/?size=500x500&data=<?php echo $urlHomes.'infoCustomer?id='.$info->id;?>" id="QRCode" width="30" />

                            <i class="fa fa-cloud-download add-home-button" aria-hidden="true"></i>
                                
                             
                            <img class="avatar" src="<?php echo @$info->avatar;?>" height="150" width="150" />
                            

                            <span class="name mt-3"><?php echo @$info->full_name;?></span> 
                            <span class="idd"><?php echo @$info->name_position.' '.@$info->name_system;?></span> 

                            <div class="d-flex flex-row justify-content-center align-items-center gap-2"> 
                                <span class="idd1" id="myPhone"><?php echo @$info->phone;?></span> 
                                <span><i class="fa fa-copy" onclick="copyText();"></i></span> 
                            </div> 

                            <div class="d-flex flex-row justify-content-center align-items-center mt-3"> 
                                <span class="number"><?php echo number_format(@$info->view);?><span class="follow"> lượt xem</span></span> 
                            </div> 

                            <div class=" d-flex mt-2"> 
                                <button class="btn1 btn-dark" onclick="saveToPhonebook()">LƯU DANH BẠ</button> 
                            </div> 

                            <div class="text mt-3"> 
                                <?php echo @$info->description;?> 
                            </div> 

                            <?php if(!empty(@$info->facebook)){ ?>
                            <a target="_blank" href="<?php echo @$info->facebook;?>">
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

                            <?php if(!empty(@$info->phone)){ ?>
                            <a target="_blank" href="https://chat.zalo.me/?phone=<?php echo @$info->phone;?>">
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

                            <?php if(!empty(@$info->tiktok)){ ?>
                            <a target="_blank" href="<?php echo @$info->tiktok;?>">
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

                            <?php if(!empty(@$info->youtube)){ ?>
                            <a target="_blank" href="<?php echo @$info->youtube;?>">
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

                            <a target="_blank" href="<?php echo @$info->web;?>">
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

                            <?php if(!empty(@$info->instagram)){ ?>
                            <a target="_blank" href="<?php echo @$info->instagram;?>">
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

                            <?php if(!empty(@$info->linkedin)){ ?>
                            <a target="_blank" href="<?php echo @$info->linkedin;?>">
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

                            <?php if(!empty(@$info->twitter)){ ?>
                            <a target="_blank" href="<?php echo @$info->twitter;?>">
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
                            <a target="_blank" href="<?php echo @$info->twitter;?>">
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

                            <div class=" px-2 rounded mt-4 date "> 
                                <span class="join"><?php echo @$info->email;?></span> 
                            </div>
                            <?php if(!empty($listData)){ ?>
                                <div class="" style="width: 100%;">
                                    <?php foreach($listData as $key => $item){
                                        $image = '';
                                          if(!empty($item->listImage)){
                                             $image = '<div class="row" style="padding: 10px;">';
                                            foreach ($item->listImage as $img) {
                                              $image .= '<div class="col-md-6" style="padding: 0;"><img src="'.$img->image.'"  style="width: 100%; height: auto; padding:2px" /></div>';
                                            }
                                            $image .= '</div>'; 
                                          }
                                           
                                     ?>
                                        <div class="wallPost">
                                            <p class="text_full_name"> <img class="avatar" src="<?php echo @$info->avatar;?>" height="40" width="40" />&ensp;<?php echo $info->full_name ?></p>
                                            <p><?php echo $item->connent ?></p>
                                            <?php echo $image; ?>
                                            <div class="row">
                                                <span class="col-md-6" style="text-align: center;  margin: 0px;"><a target="_blank" style="color: #001bfd; font-family: sans-serif;" href="https://1link.click/r/O5024RPmXi"><?php echo $item->like ?> Like</a></span>
                                                <span class="col-md-6" style="text-align: center;  margin: 0px;"><a target="_blank" style="color: #001bfd; font-family: sans-serif;" href="https://1link.click/r/O5024RPmXi"><?php echo $item->comment ?> Comment</a></span>
                                            </div>
                                        </div>

                                    <?php } ?>
                                </div>

                            <?php } ?> 
                        </div> 
                    </div>
                </div>
            </div>

           

            <!-- Tab khách hàng -->
           

            <!-- Tab trang cá nhân -->
            <?php 
            /*
            if(!empty(@$info->web)){
                echo '  <div class="tab-pane fade" id="about">
                            <iframe allowfullscreen="" width="100%" height="100%" title="main360" src="'.@$info->web.'"></iframe>
                        </div>';
            }
            */
            ?>
        </div>

        <!-- Tabs navigation -->
       <!--  <ul class="nav nav-tabs justify-content-center mt-3" id="myTabs">
            <li class="nav-item">
                <a class="nav-link active" id="info-tab" data-toggle="tab" href="#info">Thông tin</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="product-tab" data-toggle="tab" href="#products">Sản phẩm</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="customer-tab" data-toggle="tab" href="#customer">Khách hàng</a>
            </li>
            
            <?php 
            /*
            if(!empty(@$info->web)){
                echo '  <li class="nav-item">
                            <a class="nav-link" id="about-tab" data-toggle="tab" href="#about">Thêm</a>
                        </li>';
            }
            */
            ?>
            
            <li class="nav-item">
                <a class="nav-link" id="order-tab" data-toggle="tab" href="#order">Đặt hàng</a>
            </li>
        </ul> -->

        <div class="modal fade" id="QRCodeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Scan QR Code</h5>
                    </div>
                    <div class="modal-body">
                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=500x500&data=<?php echo $urlHomes.'infoCustomer?id='.$info->id;?>" width="100%" />
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
                var nameFile = '<?php echo createSlugMantan(@$info->full_name);?>';

                var contact = {
                    name: "<?php echo @$info->full_name;?>",
                    phone: "<?php echo @$info->phone;?>",
                    address: "<?php echo @$info->address;?>",
                    email: "<?php echo @$info->email;?>",
                    title: "<?php echo @$info->name_position;?>",
                    system: "<?php echo @$info->name_system;?>",
                    web: "<?php if(!empty(@$info->web)){echo @$info->web;}else{echo $urlHomes.'infoCustomer?id='.$info->id;}?>",
                    facebook: "<?php echo @$info->facebook;?>",
                    tiktok: "<?php echo @$info->tiktok;?>",
                    youtube: "<?php echo @$info->youtube;?>",
                    instagram: "<?php echo @$info->instagram;?>",
                    linkedin: "<?php echo @$info->linkedin;?>",
                    twitter: "<?php echo @$info->twitter;?>",
                    avatar: "<?php if(!empty(@$info->avatar)) echo base64_encode(file_get_contents(@$info->avatar));?>"
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
            var crf = '<?php echo $csrfToken;?>';
            var id_agency = '<?php echo (int) @$_GET['id'];?>';
            var name_agency = '<?php echo @$info->name;?>';
            var name_system = '<?php echo @$info->name_system;?>';
            var data_order = {};
            var listPositions = {}

           

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

            function formatNumberWithCommas(number) {
                // Sử dụng toLocaleString để thực hiện định dạng số với dấu phẩy
                return number.toLocaleString('en-US');
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

    

      
    </body>
</html>