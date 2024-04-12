<?php 
    global $settingThemes;
    getHeader();
    $setting = setting(); 
?>
    <main>
        <section id="blog">
            <div id="section-contact-content">
                <div class="container">
                    
                    <div class="row">
                        <?php if(empty($infoCustomer)){ ?>
                        <div class="col-lg-6 col-md-12 col-12 contact-box-left">
                            <h2>Đăng ký tham gia sự kiện</h2>
                            <?php echo $mess;?>
                            <p class="mb-3">Nếu bạn có thắc mắc gì, hãy liên hệ ngay hotline số <?php echo show_text_clone(@$setting['phone']); ?></p>
                            <form action="" id="myForm" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="_csrfToken" value="<?php echo $csrfToken;?>">
                                <input type="hidden" name="id_group" value="<?php echo @$setting['id_group_customer'];?>">
                                <div class="row">
                                    <div class="col-lg-6 input-contact mb-3">
                                        <label>Họ và tên *</label>
                                        <input type="text" class="form-control" name="name" required="" placeholder="">
                                    </div>

                                    <div class="col-lg-6 input-contact mb-3">
                                        <label>Số điện thoại *</label>
                                        <input type="text" class="form-control" name="phone" required="" placeholder="">
                                    </div>

                                    <div class="col-lg-6 input-contact mb-3">
                                        <label>Email</label>
                                        <input type="text" class="form-control" name="email" placeholder="">
                                    </div>

                                    <div class="col-lg-6 input-contact mb-3">
                                        <label>Ảnh đại diện của bạn *</label>
                                        <input type="file" class="form-control" name="avatar" required="" placeholder="">
                                    </div>

                                    <div class="button-link">
                                        <button type="submit">Đăng ký</button>
                                    </div>
                                </div>
                            </form>
                           
                        </div>
                      
        
                        <div class="col-lg-6 col-md-12 col-12 contact-box-right">
                            <h2>Thông tin liên hệ</h2>
                            <div class="contact-info">
                                <div class="contact-info-item">
                                    <div class="contact-info-img">
                                        <span><img src="<?php echo $urlThemeActive;?>/asset/image/place.png" alt=""></span>
                                    </div>
                                    <div class="contact-info-detail">
                                        <strong>Địa chỉ</strong>
                                        <br>
                                        <p><?php echo show_text_clone(@$setting['address']); ?></p>
                                    </div>
                                </div>


                                <div class="contact-info-item">
                                    <div class="contact-info-img">
                                        <span><img src="<?php echo $urlThemeActive;?>/asset/image/telephone.png" alt=""></span>
                                    </div>
                                    <div class="contact-info-detail">
                                        <strong>Số điện thoại</strong>
                                        <br>
                                        <p><?php echo show_text_clone(@$setting['phone']); ?></p>
                                    </div>
                                </div>

                                <div class="contact-info-item">
                                    <div class="contact-info-img">
                                        <span><img src="<?php echo $urlThemeActive;?>/asset/image/nine-oclock-on-circular-clock.png" alt=""></span>
                                    </div>
                                    <div class="contact-info-detail">
                                        <strong>Thời gian làm việc</strong>
                                        <br>
                                        <p>24/7</p>
                                    </div>
                                </div>

                                <div class="contact-info-item">
                                    <div class="contact-info-img">
                                        <span><img src="<?php echo $urlThemeActive;?>/asset/image/email.png" alt=""></span>
                                    </div>
                                    <div class="contact-info-detail">
                                        <strong>Email</strong>
                                        <br>
                                        <p><?php echo show_text_clone(@$setting['email']); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php }else{ ?>
                        <div class="col-lg-12 col-md-12 col-12 contact-box-left">
                            <h2>Đăng ký tham gia sự kiện</h2>
                            <p class="mb-3">
                                Đăng ký thành công, mã đăng ký của bạn là: 
                                <b>
                                <?php 
                                if($infoCustomer->id<10){
                                    echo '000'.$infoCustomer->id;
                                }elseif($infoCustomer->id<100){
                                    echo '00'.$infoCustomer->id;
                                }elseif($infoCustomer->id<1000){
                                    echo '0'.$infoCustomer->id;
                                }else{
                                    echo $infoCustomer->id;
                                }
                                ?>
                                </b> 
                            </p>

                            <p class="text-center text-create-img">
                                <a href="javascript:void(0);" id="downloadButton" class="btn btn-warning mb-2 mt-3">
                                    <i class="fa-solid fa-cloud-arrow-down"></i> Tải ảnh
                                </a>

                                 <a style="width: auto" href="/registerEvent" class="btn btn-warning mb-2 mt-3" >
                                    <i class="fa-solid fa-pen-to-square"></i> Nhập lại thông tin
                                </a> 
                            </p>

                            <p class="mb-5">
                                <img id="imageToDownload" src="<?php echo $linkImage;?>" width="100%" />
                            </p>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </section>
    </main>

<script>
document.getElementById('downloadButton').addEventListener('click', function() {
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
});
</script>


<?php getFooter();?>