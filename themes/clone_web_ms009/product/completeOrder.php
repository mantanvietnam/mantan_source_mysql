<?php 
getHeader();
global $infoUser;
$setting = setting(); 
?>
    <main>
        <section id="blog">
            <div id="section-cart">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-md-12 col-12 cart-content-left">
                            <div class="cart-content-left-box">
                                <div class="cart-content">
                                    <div class="cart-heading">
                                        <h1>Thông báo</h1>
                                    </div>
                                </div>
            
                                <p>Tạo đơn hàng thành công. Chúng tôi sẽ sớm liên hệ lại với bạn. Mã đơn hàng của bạn là OC<?php echo @$_GET['id'];?></p>
                            </div>
                        </div>
        

                        <div class="col-lg-4 col-md-12 col-12 cart-right">

                            <div class="policy-purchase">
                                <div class="summary-warning alert-order">                       
                                    <p><strong>Hỗ trợ</strong>:</p>
                                    <p>Mọi vấn đề cần hỗ trợ hãy liên hệ ngay số điện thoại <strong><?php echo show_text_clone(@$setting['phone']); ?></strong></p>
                                </div>
                            </div>
                            
                            
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>


<?php getFooter();?>