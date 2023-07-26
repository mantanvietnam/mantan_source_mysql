<?php getHeader();?>
    <main>
        <section id="section-breadcrumb">
            <div class="container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Giỏ hàng</li>
                    </ol>
                </nav>
            </div>
        </section>
    
        <section id="section-cart">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-12 col-12 cart-content-left">
                        <div class="cart-content-left-box">
                            <div class="cart-content">
                                <div class="cart-heading">
                                    <h1>Giỏ hàng của bạn</h1>
                                    <p>Bạn đang có <strong><?php echo count($list_product);?> sản phẩm</strong> trong giỏ hàng</p>
                                </div>
                            </div>
        
                            <!-- danh sách sản phẩm đặt -->
                            <?php  
                            $price_total = 0;

                            if(!empty($list_product)){
                                echo '<div class="list-cart-product">
                                        <div class="table-product">';

                                        foreach ($list_product as $key => $value) {
                                            $link = '/product/'.$value->slug.'.html';

                                            if($value->price_old){
                                                $price_old = '<del>'.number_format($value->price_old).'₫</del>';
                                            }else{
                                                $price_old = '';
                                            }

                                            $price_buy = $value->price * $value->numberOrder;
                                            $price_total += $price_buy;

                                            echo '  <div class="table-product-item">
                                                        <div class="table-product-item-img">
                                                            <img src="'.$value->image.'" alt="">
                                                            <a href="/deleteProductCart/?id_product='.$value->id.'">Xóa</a>
                                                        </div>

                                                        <div class="table-product-item-detail">
                                                            <h3>
                                                                <a href="'.$link.'">'.$value->title.'</a>
                                                            </h3>
                                                            
                                                            <p>'.number_format($value->price).'₫ '.$price_old.'</p>
                                                        </div>

                                                        <div class="table-product-item-price">
                                                            <span>'.number_format($price_buy).'₫</span>
                                                            <div class="cart-button-group">
                                                                <button>+</button>
                                                                <input type="text" value="'.$value->numberOrder.'">
                                                                <button>-</button>
                                                            </div>
                                                        </div>
                                                    </div>';
                                        }

                                echo    '</div>
                                    </div>

                                    <!-- Ghi chú -->
                                    <div class="cart-note">
                                        <div class="cart-note-title">
                                            <p>Ghi chú đơn hàng</p>
                                        </div>
                
                                        <div class="cart-note-box">
                                            <textarea placeholder="" rows="5"></textarea>
                                        </div>
                                    </div> 
                
                                    ';
                            }else{
                                echo '<p>Giỏ hàng trống</p>';
                            }
                            ?>
                            
        
                            <!-- Có thể bạn sẽ thích -->
                            <div id="section-product-featured" class="cart-product-like">
                                <div class="cart-product-like-title">
                                    <h2>Có thể bạn sẽ thích</h2>
                                </div>
                                <!-- Slide sản phẩm -->
                                <div class="product-like-slide">
                                    <?php 
                                    if(!empty($new_product)){
                                        foreach ($new_product as $key => $product) {
                                            $link = '/product/'.$product->slug.'.html';

                                            $giam = 0;
                                            if(!empty($product->price_old) && !empty($product->price)){
                                                $giam = 100 - 100*$product->price/$product->price_old;
                                            }

                                            if($giam>0){
                                                $giam = '<img src="'.$urlThemeActive.'/asset/img/frame1_5f151d3f2bce42b99a356c60c1cf7864.jpg" alt="">
                                                            <div class="item-sale">
                                                                <span><i class="fa-solid fa-bolt"></i> -'.$giam.'%</span>
                                                            </div>';
                                            }else{
                                                $giam = '';
                                            }

                                            if(!empty($product->price)){
                                                $price = number_format($product->price).'đ';
                                            }else{
                                                $price = 'Giá liên hệ';
                                            }

                                            if(!empty($product->price_old)){
                                                $price_old = number_format($product->price_old).'đ';
                                            }else{
                                                $price_old = '';
                                            }

                                            echo '<div class="product-featured-item">
                                                    <div class="product-featured-inner">
                                                        <div class="product-featured-img">
                                                            <a href="'.$link.'"><img src="'.$product->image.'" alt=""></a>
                                                            '.$giam.'
                                                        </div>
                            
                                                        <div class="product-featured-details">
                                                            <div class="product-featured-title">
                                                                <a href="'.$link.'">'.$product->title.'</a>
                                                            </div>
                                                            <div class="product-featured-price">
                                                                <span class="price">'.$price.'</span>
                                                                <span class="price-del">'.$price_old.'</span>
                                                            </div> 
                                                            <div class="product-button-action">
                                                                <div class="product-button-cart">
                                                                    <a onclick="addProductToCart('.$product->id.')" href="javascript:void(0);" class="button-cart">
                                                                        <i class="fa-solid fa-cart-shopping"></i><span>Thêm vào giỏ</span>    
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div> 
                                                    </div>
                                                </div>';
                                        }
                                    }
                                    ?>
                                    
                                </div>    
                            </div>
                        </div>
                    </div>
    

                    <div class="col-lg-4 col-md-12 col-12 cart-right">
                        <div class="order-box">
                            <h2 class="bill-title">Thông tin đơn hàng</h2>
                            
                            <div class="total-price">
                                <p>Tổng tiền : </p> 
                                <span><?php echo number_format($price_total);?>đ</span>
                            </div>

                            <?php 
                                if($price_total > 0){
                                    echo '  <div class="pay-button">  
                                                <button class="checkout-btn btnred disabled">Thanh toán</button>
                                            </div>';
                                }else{
                                    echo '<div class="policy-delivery">
                                            <div class="summary-alert">
                                                Giỏ hàng của bạn hiện chưa đạt mức tối thiểu để thanh toán.
                                            </div>
                                        </div>';
                                }
                            ?>
                        </div>  

                        <div class="policy-purchase">
                            <div class="summary-warning alert-order">						
                                <p><strong>Chính sách mua hàng</strong>:</p>
                                <p>Hiện chúng tôi chỉ áp dụng thanh toán với đơn hàng có giá trị tối thiểu <strong>100.000₫ </strong> trở lên.</p>
                            </div>
                        </div>
                        
                        
                    </div>
                </div>
            </div>
        </section>
    </main>

<?php getFooter();?>






