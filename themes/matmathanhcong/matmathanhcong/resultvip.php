<?php 
    global $settingThemes;
    getHeader();
?>

<main>
    <section class="result-giaithich bg-resuft text-center container" style="min-height: 300px;">
        <div class="giainghia-text">
            
            <?php 
            if(!empty($settingMMTCAPI['price'])){
                echo '  <p class="mt-5">Để được nhận miễn phí bản Thần Số Học của thầy Trần Toản hãy gửi link giới thiệu sau cho bạn bè của bạn, chỉ cần có 03 người được bạn giới thiệu mua thành công bạn sẽ được nhận MIỄN PHÍ. Link giới thiệu của bạn là:</p>
                        <br/><br/>
                        <p><a style="color: red;font-size: 18px;font-weight: bold;" target="_blank" href="'.$urlHomes.'?aff='.$_POST['customer_phone'].'">'.$urlHomes.'?aff='.$_POST['customer_phone'].'</a></p>
                        <br/><br/>
                        <p>'.@$settingMMTCAPI['note_pay'].'</p>
                        <h3>Vui lòng quét mã QR để thanh toán phí mua bản giải mã Thần Số Học đầy đủ</h3>
                        <img src="'.$linkQR.'" class="codeQT">';
            }else{
                if(empty($infoFull)){
                    echo '  <h3 class="mt-5">Link tải bản giải mã Thần Số Học đầy đủ của bạn</h3>
                        <a style="color: red;font-size: 22px;font-weight: bold;" target="_blank" href="'.$infoFull.'">'.$infoFull.'</a><br/><br/>';
                }else{
                    echo '<h3 class="mt-5">Chúng tôi sẽ gửi link tải bản đầy đủ Thần Số Học về email của bạn ngay khi hệ thống xử lý xong yêu cầu</h3>';
                }
            }
            ?>
            
        </div>
    </section> 
</main>

<?php getFooter();?>  