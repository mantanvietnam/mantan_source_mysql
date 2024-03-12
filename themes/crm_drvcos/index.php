<?php 
    global $setting_value;
    getHeader();
?>

    <div class="main">
        <div class="container">
            <div class="overlay"></div>
            <div class="main-below mt-3">
                <div class="row">
                    <div class="main-below-left col-lg-6 col-md-6">
                        <p class="main-below-search">TRA CỨU THÀNH VIÊN <?php echo @$setting_value['name_web'];?></p>
                        <h1 class="main-below-title">Thành viên chính thức của <?php echo @$setting_value['name_web'];?></h1>
                        <input type="text" class="main-below-input" name="" id="phone_member"
                            placeholder="Nhập số điện thoại viết liền không dấu, ví dụ 0816560000">
                        <br />
                        <button type="button" class="main-below-btn" onclick="seachAgency();">Tra cứu thông tin</button>
                        <p class="main-below-text-end">*HÃY CHỈ LÀM VIỆC VỚI CÁC THÀNH VIÊN CHÍNH THỨC CỦA <?php echo @$setting_value['name_web'];?> ĐỂ ĐƯỢC ĐẢM BẢO CÁC QUYỀN LỢI CAM KẾT VÀ BẢO HÀNH</p>

                    </div>
                    <div class="main-below-right col-lg-6 col-md-6">
                        <div class="row flex">
                            <div class="col-6">
                                <div class="main-below-right-image">
                                    <div class="main-below-right-image-slide" style="margin: 50px 0 20px 0;" >
                                        <img src="<?php echo @$setting_value['image_product_1'];?>" alt="">
                                    </div>
                                    <div class="main-below-right-image-slide">
                                        <img src="<?php echo @$setting_value['image_product_2'];?>" alt="">
                                    </div>                   
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="main-below-right-image1" >
                                    <div class="main-below-right-image-slide">
                                        <img src="<?php echo @$setting_value['image_product_3'];?>" alt="">
                                    </div>
                                    <div class="main-below-right-image-slide">
                                        <img src="<?php echo @$setting_value['image_product_4'];?>" alt="">
                                    </div>
                                    <div class="main-below-right-image-slide">
                                        <img src="<?php echo @$setting_value['image_product_5'];?>" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- <div class="main-right">
            <div class="main-group-button">
                <div class="main-button-item">
                    <a href=""><img src="<?php echo $urlThemeActive;?>/assert/img/youtube.png" alt=""></a>
                </div>

                <div class="main-button-item">
                    <a href=""><img src="<?php echo $urlThemeActive;?>/assert/img/facebook-1.png" alt=""></a>
                </div>

                <div class="main-button-item">
                    <a href=""><img src="<?php echo $urlThemeActive;?>/assert/img/linkedin.png" alt=""></a>
                </div>
            </div>
        </div>

        <div class="main-left">

        </div> -->
    </div>

    <div class="register">
        <div class="container">
            <div class="register-main">
                <h1>ĐĂNG KÝ TRỞ THÀNH THÀNH VIÊN CỦA <?php echo @$setting_value['name_web'];?></h1>
                <p>Chúng tôi khao khát giúp đỡ được hàng triệu người có thể đột phá trong tư duy và lối sống để có một cuộc sống trở nên tốt đẹp, thịnh vượng hơn</p>
                <div class="register-btn">
                    <button class="btn-logup" onclick="window.open('<?php echo @$setting_value['facebook'];?>', '_blank');">
                        <span>ĐĂNG KÝ NGAY </span>
                        <i class="fa-solid fa-arrow-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- modal -->
    <div class="modal-info modal fade" id="popupInfoAgency" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Thông tin thành viên <?php echo @$setting_value['name_web'];?></h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="modal-note">
                    LƯU Ý: CHỈ CÁC THÀNH VIÊN ĐƯỢC XÁC NHẬN TẠI ĐÂY MỚI LÀ THÀNH VIÊN CHÍNH THỨC CỦA <?php echo @$setting_value['name_web'];?>, HÃY XÁC NHẬN ĐÚNG THÀNH VIÊN <?php echo @$setting_value['name_web'];?> ĐỂ TRÁNH CÁC TRƯỜNG HỢP MẠO DANH.
                </div>

                <div class="row" id="infoAgency"></div>
            </div>
        </div>
        </div>
    </div>

    <script type="text/javascript">
        function seachAgency()
        {
            var phone = $('#phone_member').val();
            var infoAgency;
            var imageCheck = "<?php echo $urlThemeActive;?>/assert/img/check.png";

            if(phone!=''){
                $.ajax({
                    method: "POST",
                    url: "/apis/getInfoMemberAPI",
                    data: { phone: phone }
                })
                .done(function( msg ) {
                    if(msg.hasOwnProperty('data')){
                        dataAgency = msg.data;

                        infoAgency = '<div class="col-lg-5 col-12 modal-image"><div class="image-character"><img src="'+dataAgency.avatar+'" alt=""></div><div class="image-bottom"><img src="'+imageCheck+'" alt=""></div></div><div class="col-lg-7 col-12 modal-info"><div class="modal-name"><p>'+dataAgency.name+'</p></div><div class="modal-detail"><p><strong>Cấp bậc:</strong> '+dataAgency.name_position+'</p><p><strong>Điện thoại:</strong> '+dataAgency.phone+'</p><p><strong>Email:</strong> '+dataAgency.email+'</p><p><strong>Địa chỉ:</strong> '+dataAgency.address+'</p><p><button type="button" class="main-below-btn" onclick="window.open(\''+dataAgency.facebook+'\' , \'_blank\')">XEM FACEBOOK</button></p></div></div>';

                    }else{
                        infoAgency = '<p class="text-danger">Không tìm thấy thông tin thành viên trong hệ thống</p>';
                    }

                    $('#infoAgency').html(infoAgency);

                    $('#popupInfoAgency').modal('show');
                });
            }
        }
    </script>

<?php getFooter();?>