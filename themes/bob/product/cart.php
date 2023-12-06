<?php getHeader();?>

    <main>
        <!-- title box cart  -->
        <section id="section-cart-title-box">
            <div class="container">
                <div class="section-cart-title">
                    <div class="title-cart-text">
                        <h1>Giỏ hàng</h1>
                    </div>
    
                    <div class="title-cart-back">
                        <!-- <a href="javascript:void(0);"><i class="fa-solid fa-arrow-left" onclick="history.back()"></i> Quay lại</a> -->
                    </div>  
                </div>
            </div>
         
        </section>

        <?php  
        $price_total = 0;

        if(empty($list_product)){ ?>
            <section id="section-cart-empty">
                <div class="container">
                    <div class="section-cart-empty-inner">
                        <div class="cart-empty-image">
                            <img src="<?php echo $urlThemeActive; ?>/asset/img/empty-cart.png" alt="">
                        </div>
                        <div class="cart-empty-text">
                            <h3>Giỏ hàng trống</h3>
                            <p>Chưa có sản phẩm nào trong giỏ hàng</p>
                            <a href="/products">Xem thêm sản phẩm</a>
                        </div>
                    </div>
                </div>
            </section>
        <?php }else{ ?>
            <section id="section-cart">
                <div class="container">
                    <div class="section-cart-inner">
                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-sm-8 col-12 cart-left">
                                <div class="cart-left-heading">
                                    <p>Sản phẩm</p>
                                    <p>Số lượng</p>
                                </div>

                               
                                    <?php
                                        foreach ($list_product as $key => $value) {
                                            $link = '/product/'.$value->slug.'.html';

                                            if($value->price_old){
                                                $price_old = '<del>'.number_format($value->price_old).'₫</del>';
                                            }else{
                                                $price_old = '';
                                            }

                                            $price_buy = $value->price * $value->numberOrder;
                                            $price_total += $price_buy;

                                            echo '  
                                            <div class="cart-table">
                                                    <div class="cart-table-image">
                                                        <img src="'.$value->image.'" alt="">
                                                    </div>
                                                    <div class="cart-table-info">
                                                        <div class="cart-name">
                                                            <p>'.$value->title.'</p>   
                                                        </div>

                                                        <div class="cart-code">
                                                            <p>Mã sản phẩm: <span class="code">'.$value->code.'</span></p>
                                                        </div>
                                                    </div>

                                                    <div class="cart-button">
                                                        <div class="cart-button-inner">
                                                            <button>-</button>
                                                            <input type="text" value="'.$value->numberOrder.'">
                                                            <button>+</button>
                                                        </div>
                                                    </div>

                                                    <div class="cart-delete">
                                                        <div class="cart-delete-inner">
                                                            <a href="/deleteProductCart/?id_product='.$value->id.'"><i class="fa-solid fa-trash-can"></i></a>
                                                        </div>
                                                    </div>
                                                    </div>';
                                        }
                                    ?>
                               
                            </div>
            
                            <div class="col-lg-4 col-md-4 col-sm-4 col-12 cart-right">
                                <div class="cart-right-inner">
                                    <div class="form-contact-title">
                                        <h3>Đặt mua sản phẩm</h3>
                                    </div>

                                    <form action="/createOrder" method="post">
                                        <input type="hidden" name="_csrfToken" value="<?php echo $csrfToken;?>">
                                        <div class="form-contact">
                                            <div class="input-contact">
                                                <input type="text" name="full_name" class="form-control" placeholder="Họ và tên *" required>
                                            </div>

                                            <div class="input-contact">
                                                <input type="text" name="phone" class="form-control" placeholder="Số điện thoại *" required>
                                            </div>

                                            <div class="input-contact">
                                                <input type="text" name="address" class="form-control" placeholder="Địa chỉ của bạn *" required>
                                            </div>

                                            <div class="input-contact">
                                                <textarea type="text" id="message" name="note_user" rows="4" class="form-control md-textarea" placeholder="Nội dung liên hệ"></textarea>
                                            </div>

                                            <div class="button-submit-contact text-center">
                                                <button type="submit" class="btn btn-dark">TẠO ĐƠN MUA HÀNG</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php }?>
    </main>
    
<?php getFooter();?>