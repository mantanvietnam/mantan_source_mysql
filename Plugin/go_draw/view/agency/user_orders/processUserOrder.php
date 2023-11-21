<?php include __DIR__.'/../header.php';?>
<style>
    footer {
        display: none;
    }
    main {
        overflow: hidden;
    }
</style>
<main>
    <section class="box-gallery">
        <div class="container">
            <div class="content-detail-gallery detail-cart">
                <div class="title text-center" style="display: flex;">
                    <span>Thanh toán đơn hàng <?php echo $infoOrder->id;?> (<a style="color: #fff;" href="/checkBoos/?redirect=<?php echo urlencode($urlCurrent);?>">Sửa đơn</a>)</span>
                    <svg width="1182" height="58" viewBox="0 0 1182 58" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1181.45 57.9501H0.28125V46.8002C0.28125 21.1802 21.0513 0.410156 46.6713 0.410156H1135.05C1160.67 0.410156 1181.44 21.1802 1181.44 46.8002V57.9501H1181.45Z" fill="#1A3A89"/>
                    </svg>
                </div>
                <div class="content-cart">
                    <form method="post" action="/checkoutOrderUser">
                        <input type="hidden" name="_csrfToken" value="<?php echo $csrfToken;?>" />
                        <input type="hidden" name="id" value="<?php echo $infoOrder->id;?>" />

                        <div class="table-cart">
                            <?php
                            if(!empty($infoOrder->product)){
                                foreach ($infoOrder->product as $key => $value) {
                                    echo '  <div class="item-cart item-cart-sale">
                                                <div class="prd-cart">
                                                    <div class="avarta">
                                                        <div class="avr"><a href="javascript:void(0);"><img src="'.$value->image.'" class="img-fluid w-100" alt=""></a></div>
                                                    </div>
                                                    <div class="info">
                                                        <h3><a href="javascript:void(0);" class="name-sale">'.$value->name.'</a></h3>
                                                        <ul>';
                                                        
                                                        if($value->type == 1){
                                                            if($session->read('isAgencyBoss')){
                                                                echo '  <li>
                                                                            <a href="javascript:void(0);">Sử dụng </a>
                                                                            <input min="0" max="'.$value->amount.'" style="width: 50px;" type="number" value="0" name="used['.$value->product_id.']" class="" />
                                                                        </li>
                                                                        
                                                                        <li>
                                                                            <a href="javascript:void(0);">Trả lại <span>'.$value->amount.' x '.number_format($value->unit_price).'đ</span></a>
                                                                        </li>
                                                                        
                                                                        <li>
                                                                            <a href="javascript:void(0);">Tái sử dụng</a>
                                                                        </li>';
                                                            }else{
                                                                echo '  <li>
                                                                            <a href="javascript:void(0);">Sử dụng <span>0</span></a>
                                                                        </li>
                                                                    
                                                                        <li>
                                                                            <a href="javascript:void(0);">Trả lại <span>'.$value->amount.' x '.number_format($value->unit_price).'đ</span></a>
                                                                        </li>

                                                                        <li>
                                                                            <a href="javascript:void(0);">Tái sử dụng</a>
                                                                        </li>';
                                                            }
                                                        }else{
                                                            echo '  <li><a href="javascript:void(0);">Sử dụng <span>'.$value->amount.' x '.number_format($value->unit_price).'đ</span></a></li>
                                                                    <li><a href="javascript:void(0);">Trả lại <span>0</span></a></li>
                                                                    <li><a href="javascript:void(0);">Hàng tiêu hao</a></li>';
                                                        }   

                                    echo                '</ul>
                                                    </div>
                                                </div>
                                            </div>';
                                }
                            }
                            ?>
                        </div>

                        <div class="btn-main text-center">
                            <button type="submit" class="btn btn-danger">THANH TOÁN</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>

<?php include __DIR__.'/../footer.php';?>