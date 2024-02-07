<?php 
    global $settingThemes;
    getHeader();
?>

<main>
    <section class="result-giaithich bg-resuft text-center container">
        <div class="giainghia-text">
            <p class="mt-5">Để được nhận miễn phí bản Thần Số Học của thầy Trần Toản hãy gửi link giới thiệu sau cho bạn bè của bạn, chỉ cần có 03 người được bạn giới thiệu mua thành công bạn sẽ được nhận MIỄN PHÍ. Link giới thiệu của bạn là:</p>
            <br/><br/>
            <p><a style="color: red;font-size: 18px;font-weight: bold;" target="_blank" href="<?php echo $urlHomes.'?aff='.$_POST['customer_phone'];?>"><?php echo $urlHomes.'?aff='.$_POST['customer_phone'];?></a></p>
            <br/><br/>
            <h3>Vui lòng quét mã QR để thanh toán phí mua bản giải mã Thần Số Học đầy đủ</h3>
            <img src="<?php echo $linkQR;?>" class='codeQT'>
        </div>
    </section> 
</main>

<?php getFooter();?>  