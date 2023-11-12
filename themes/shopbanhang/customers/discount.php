<?php
global $session;
$info = $session->read('infoUser');
getHeader();
?>
<link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
<main>
    <div id="profile">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12">
                   <?php include('menu.php'); ?>
                </div>

                <div class="col-lg-8 col-md-8 col-sm-12">
                    <div class="tab-content" style="height:100%">
                        <div id="super-sale" class="tab-pane active" style="border:1px solid #ccc">
                             <div class="title-viewed-product">
                                    <p>Voucher</p>
                                </div>
                                <div class="group-viewed-product">
                                    <div class="list-code-discount">
                                    <!-- Mã giảm giá -->
                                    <?php foreach($data as $key => $value){ ?>
                                    <div class="list-code-item">
                                        <div class="title-code-discount">
                                           <?php echo $value['name']; ?>
                                        </div>
    
                                        
                                            <?php if(!empty($value['discountCode'])){
                                                foreach($value['discountCode'] as $k => $item){
                                                     $voucher = "";
                                             ?>
                                             <div class="voucher">
                                            <div class="btn-voucher <?php echo $voucher ?>">
                                                <div class="bg-voucher">
                                                    <img src="<?php echo $urlThemeActive;?>asset/image/voucher.png">
                                                </div>
                                                <div class="detail-voucher">
                                                    <div class="logo-voucher">
                                                        <h3><?php echo $item->code; ?></h3>
                                                    </div>
                                                    <div class="infor-voucher">
                                                        <h4><?php echo $item->note; ?></h4>
                                                        <?php if($item->applicable_price){ ?>
                                                        <p>Đơn tối thiểu <?php echo number_format($item->applicable_price); ?> đ</p>
                                                    <?php } ?>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                            </div>
                                        <?php }}     ?>
                                        
                                    </div>
                                    <?php } ?>
                                    
                                </div>
                                </div>
                        </div>
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>



<?php
getFooter();
?>