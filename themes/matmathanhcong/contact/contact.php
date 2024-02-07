<?php 
    global $settingThemes;
    getHeader();
?>
<main>
    <section class="box-contact">
        <div class="container">
            <div class="title text-center">
                <h2>Liên Hệ</h2>
            </div>
            <div class="content-contact">
                <div class="row">
                    <?php echo $mess;?>
                    <div class="col-md-6">
                        <div class="title-contact">Chúng tôi có thể giúp gì cho bạn?</div>
                        <div class="frm-contact">
                            <form action="" method="post" class="sendContact">
                                <input type="hidden" name="_csrfToken" value="<?php echo $csrfToken;?>">
                                <div class="item-ctn"><input type="text" name="name" placeholder="Họ và tên" class="txt_field"></div>
                                <div class="item-ctn"><input type="text" name="phone_number" placeholder="Điện thoại" class="txt_field"></div>
                                <div class="item-ctn"><input type="text" name="email" placeholder="Email" class="txt_field"></div>
                                <div class="item-ctn"><input type="text" name="subject" placeholder="Tiêu đề" class="txt_field"></div>
                                <div class="item-ctn"><textarea name="content" placeholder="Nội dung"></textarea></div>
                                <div class="item-ctn"><input type="submit" value="Gửi yêu cầu" class="btn_field submitfield"></div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="txt-form">
                            <div class="title-contact">Thông Tin Liên Hệ</div>
                            <div class="info-contact">
                                <ul>
                                    <li><img src="<?php echo $urlThemeActive;?>/images/pl-1.png" class="img-fluid" alt=""><span><strong>Địa chỉ:</strong> <?php echo $contactSite['address'];?> </span></li>

                                    <li><img src="<?php echo $urlThemeActive;?>/images/pl-2.png" class="img-fluid" alt=""><span><strong>Hotline:</strong> <?php echo $contactSite['phone'];?></span></li>
                                    
                                    <li><img src="<?php echo $urlThemeActive;?>/images/pl-3.png" class="img-fluid" alt=""><span><strong>Email:</strong> <?php echo $contactSite['email'];?></span></li>
                                    
                                    <li><img src="<?php echo $urlThemeActive;?>/images/pl-4.png" class="img-fluid" alt=""><span><strong>Website:</strong> <?php echo $urlHomes;?></span></li>
                                    
                                    <li><img src="<?php echo $urlThemeActive;?>/images/pl-5.png" class="img-fluid" alt=""><span><strong>Fanpage:</strong> <?php echo @$settingThemes['facebook'];?></span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>


<?php getFooter();?>