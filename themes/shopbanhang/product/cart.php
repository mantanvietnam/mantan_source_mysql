<?php
getHeader();
global $urlThemeActive;

$setting = setting();

$slide_home= slide_home($setting['id_slide']);
debug($list_product);
?>
<main>
        <section id="section-cart">
            <div class="container">
                <div class="title-section-cart">
                    <h1>Giỏ hàng</h1>
                </div>

                <div class="cart-col">
                    <div class="row">
                        <!-- Bảng -->
                        <div class="col-lg-9 col-md-9 col-sm-9 col-12 table-cart-left">
                            <table class="table table-top">
                                <thead>
                                    <tr>
                                        <th scope="col col-check">
                                            <input class="form-check-input" type="checkbox" value="" id="allcheck">
                                        </th>
                                        <th scope="col col-name">Tên sản phẩm</th>
                                        <th scope="col col-price">Đơn giá</th>
                                        <th scope="col col-number">Số lượng</th>
                                        <th scope="col col-total">Thành tiền</th>
                                        <th scope="col col-delete"><a href=""><i class="fa-regular fa-trash-can"></i></a></th>
                                    </tr>
                                </thead>
                            </table>

                            <div class="table-border">
                                <table class="table table-center">
                                    <tbody>
                                        <!-- Sản phẩm -->
                                        <?php  $price_total = 0;

                            if(!empty($list_product)){
                                foreach ($list_product as $key => $value) {
                                            $link = '/product/'.$value->slug.'.html';

                                            if($value->price_old){
                                                $price_old = '<del>'.number_format($value->price_old).'₫</del>';
                                            }else{
                                                $price_old = '';
                                            }

                                            $price_buy = $value->price * $value->numberOrder;
                                            $price_total += $price_buy;

                             ?>
                                        <tr>
                                            <!-- check -->
                                            <td class="td-check">
                                                <input class="form-check-input" type="checkbox" value="" id="checkproduct">
                                            </td>
        
                                            <!-- Tên -->
                                            <td class="td-name">
                                                <div class="cart-product-name-box">
                                                    <div class="cart-product-image">
                                                        <img src="<?php echo $value->image ?>" width="100" alt="">
                                                    </div>
        
                                                    <div class="cart-product-name">
                                                        <p><?php echo $value->name ?></p>
                                                    </div>
                                                </div>
                                            </td>
        
                                            <!-- Đơn giá -->
                                            <td class="td-price">
                                                <div class="cart-product-price">
                                                    <div class="cart-product-price-real">
                                                        <span><?php echo number_format($value->price).'₫ ' ?></span>
                                                    </div>
        
                                                    <div class="cart-product-price-discount">
                                                        <del><?php echo number_format($value->price_old); ?>đ</del>
                                                    </div>
                                                </div>
                                            </td>
        
                                            <!-- Số lượng -->
                                            <td class="td-number">
                                                <div class="cart-product-number">
                                                    <div class="product-detail-number-item">
                                                        <div class="qty-input">
                                                            <button onclick="decreaseValue()" class="qty-count-minus" data-action="minus" type="button">-</button>
                                                            <input id="valueInput" class="product-qty" type="text" name="product-qty" value="1" min="0">
                                                            <button onclick="increaseValue()" class="qty-count-add" data-action="add" type="button">+</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
        
                                            <!-- Thành tiền -->
                                            <td class="td-total">
                                                <div class="cart-product-total">
                                                    <p>1.680.000đ</p>
                                                </div>
                                            </td>
        
                                            <!-- Xóa -->
                                            <td class="td-delete">
                                                <a href=""><i class="fa-regular fa-trash-can"></i></a>
                                            </td>
                                        </tr>
        
                                       <?php }} ?>
                                    </tbody>
                                </table>

                                <table class="table table-bottom">
                                    <!-- Sản phẩm quà tặng -->
                                    <tr class="tr-gift">
                                        <td  class="td-name">
                                            <div class="cart-gift-image-inner">
                                                <div class="cart-gift-image">
                                                    <img src="../asset/image/giftproduct.png" alt="">
                                                </div>

                                                <div class="cart-product-name-box">
                                                    <div class="cart-product-gift-text">
                                                        <p>[Quà tặng]</p>
                                                    </div>

                                                    <div class="cart-product-name-gift">
                                                        <p>Máy massage khớp gối Bumas M6</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>

                                        <td >
                                            <div class="cart-product-gift-number">
                                                <span>1</span>
                                            </div>
                                        </td>

                                    </tr>
                                </table>
                            </div>

                            <div class="cart-left-bottom">
                                <div class="title-cart-left-bottom">
                                    Ưu đãi dành cho bạn
                                </div>

                                <div class="row">
                                    <!-- Quà tặng -->
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-12 cart-product-gift">
                                        <div class="cart-product-gift-inner">
                                            <div class="title-cart-product-gift">
                                                <img src="../asset/image/gift.png" alt="">
                                                <p>Quà tặng</p>
                                            </div>

                                            <div class="cart-product-gift-item-list">
                                                <div class="cart-product-gift-item">
                                                    <div class="product-item-inner">
                                                        <div class="product-img">
                                                            <a href=""><img src="../asset/image/topsearch.png" alt=""></a>
                                                        </div>
                            
                                                        <div class="product-info">
                                                            <div class="product-name">
                                                                <a href="">Đai Chườm Nóng Massage Giảm Đau Bụng Kinh BUMAS BU01</a>
                                                            </div>
                            
                                                            <div class="product-price">
                                                                <p>0đ</p>
                                                            </div>
                                                        </div>

                                                        <div class="product-button-cart product-button-cart-delete">
                                                            <a href="">Bỏ khỏi giỏ hàng</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="product-gift-text-or">
                                                    hoặc
                                                </div>
    
                                                <div class="cart-product-gift-item">
                                                    <div class="product-item-inner">
                                                        <div class="product-img">
                                                            <a href=""><img src="../asset/image/topsearch.png" alt=""></a>
                                                        </div>
                            
                                                        <div class="product-info">
                                                            <div class="product-name">
                                                                <a href="">Đai Chườm Nóng Massage Giảm Đau Bụng Kinh BUMAS BU01</a>
                                                            </div>
                            
                                                            <div class="product-price">
                                                                <p>0đ</p>
                                                            </div>
                                                        </div>

                                                        <div class="product-button-cart product-button-cart-add">
                                                            <a href="">Thêm vào giỏ hàng</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Sản phẩm đi kèm -->
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-12 cart-product-gift-right">
                                        <div class="cart-product-gift-item-list">
                                            <div class="cart-product-gift-right-inner">
                                                <div class="cart-product-gift-item">
                                                    <div class="product-item-inner">
                                                        <div class="product-img">
                                                            <a href=""><img src="../asset/image/topsearch.png" alt=""></a>
                                                        </div>
                            
                                                        <div class="product-info">
                                                            <div class="product-name">
                                                                <a href="">Đai Chườm Nóng Massage Giảm Đau Bụng Kinh BUMAS BU01</a>
                                                            </div>
                            
                                                            <div class="product-price">
                                                                <p>650.000đ</p>
                                                            </div>

                                                            <div class="product-discount">
                                                                <del>500.000</del><span> (50%)</span>
                                                            </div>
                                                            
                                                            <div class="product-cart-bonus">
                                                                Khi mua kèm Lược điện ion âm
                                                            </div>
                                                        </div>

                                                        <div class="product-button-cart product-button-cart-add">
                                                            <a href="">Thêm vào giỏ hàng</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="cart-product-gift-item">
                                                    <div class="product-item-inner">
                                                        <div class="product-img">
                                                            <a href=""><img src="../asset/image/topsearch.png" alt=""></a>
                                                        </div>
                            
                                                        <div class="product-info">
                                                            <div class="product-name">
                                                                <a href="">Đai Chườm Nóng Massage Giảm Đau Bụng Kinh BUMAS BU01</a>
                                                            </div>
                            
                                                            <div class="product-price">
                                                                <p>650.000đ</p>
                                                            </div>

                                                            <div class="product-discount">
                                                                <del>500.000</del><span> (50%)</span>
                                                            </div>

                                                            <div class="product-cart-bonus">
                                                                Khi mua kèm Lược điện ion âm
                                                            </div>
                                                        </div>

                                                        <div class="product-button-cart product-button-cart-add">
                                                            <a href="">Thêm vào giỏ hàng</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Mã giảm giá và tổng tiền -->
                        <div class="col-lg-3 col-lg-3 col-sm-3 col-12 table-cart-right">
                            <div class="cart-code-discount-right">
                                <div class="title-code-enter">
                                    Mã giảm giá
                                </div>

                                <div class="enter-code-discount">
                                    <input type="text" placeholder="Nhập mã giảm giá tại đây">
                                    <button>Áp dụng</button>
                                </div>

                              

                                <div class="list-code-discount">
                                    <!-- Mã giảm giá -->
                                    <div class="list-code-item">
                                        <div class="title-code-discount">
                                            Miễn phí vẫn chuyển
                                        </div>
    
                                        <div class="voucher">
                                            <div class="btn-voucher">
                                                <div class="bg-voucher">
                                                    <img src="../asset/image/voucher.png">
                                                </div>
                                                <div class="detail-voucher">
                                                    <div class="logo-voucher">
                                                        <h3>Freeship</h3>
                                                    </div>
                                                    <div class="infor-voucher">
                                                        <h4>Giảm tối đa 30k</h4>
                                                        <p>Đơn tối thiểu 1 triệu</p>
                                                    </div>
                                                    <div class="check-voucher">
                                                        <input class="form-check-input" type="checkbox" value="" id="checkcode1">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                           

                            
                                    <div class="list-code-item">
                                        <div class="title-code-discount">
                                            Mã giảm giá
                                        </div>
                                        
                                        <!-- Mã giảm giá không tích được -->
                                        <div class="voucher voucher-disabled">
                                            <div class="btn-voucher">
                                                <div class="bg-voucher">
                                                    <img src="../asset/image/voucher.png">
                                                </div>
                                                <div class="detail-voucher">
                                                    <div class="logo-voucher">
                                                        <h3>Freeship</h3>
                                                    </div>
                                                    <div class="infor-voucher">
                                                        <h4>Giảm tối đa 30k</h4>
                                                        <p>Đơn tối thiểu 1 triệu</p>
                                                    </div>
                                                    <div class="check-voucher">
                                                        <input class="form-check-input" type="checkbox" value="" id="checkcode2" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Mã giảm giá tích sẵn -->
                                        <div class="voucher">
                                            <div class="btn-voucher">
                                                <div class="bg-voucher">
                                                    <img src="../asset/image/voucher.png">
                                                </div>
                                                <div class="detail-voucher">
                                                    <div class="logo-voucher">
                                                        <h3>Freeship</h3>
                                                    </div>
                                                    <div class="infor-voucher">
                                                        <h4>Giảm tối đa 30k</h4>
                                                        <p>Đơn tối thiểu 1 triệu</p>
                                                    </div>
                                                    <div class="check-voucher">
                                                        <input class="form-check-input" type="checkbox" value="" id="checkcode2" checked>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="voucher">
                                            <div class="btn-voucher">
                                                <div class="bg-voucher">
                                                    <img src="../asset/image/voucher.png">
                                                </div>
                                                <div class="detail-voucher">
                                                    <div class="logo-voucher">
                                                        <h3>Freeship</h3>
                                                    </div>
                                                    <div class="infor-voucher">
                                                        <h4>Giảm tối đa 30k</h4>
                                                        <p>Đơn tối thiểu 1 triệu</p>
                                                    </div>
                                                    <div class="check-voucher">
                                                        <input class="form-check-input" type="checkbox" value="" id="checkcode2" checked>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="cart-total-box">
                                <!-- Giá sản phẩm -->
                                <div class="cart-price-item">
                                    <div class="cart-price-item-title">
                                        Giá 
                                    </div>

                                    <div class="cart-price-item-price">
                                        1.680.000đ
                                    </div>
                                </div>

                            
                                <!-- Giá voucher-->
                                <div class="cart-price-code-discount">
                                    <div class="cart-price-item">
                                        <div class="cart-price-item-title">
                                            Giảm voucher “BANMOI”	
                                        </div>
    
                                        <div class="cart-price-item-price">
                                            -30.000đ
                                        </div>
                                    </div>

                                    <div class="cart-price-item">
                                        <div class="cart-price-item-title">
                                            Miễn phí vận chuyển 		
                                        </div>
    
                                        <div class="cart-price-item-price">
                                            -100.000đ
                                        </div>
                                    </div>

                                    <div class="cart-price-item">
                                        <div class="cart-price-item-title">
                                            Giảm voucher “U50”                                        </div>
    
                                        <div class="cart-price-item-price">
                                            -50.000đ
                                        </div>
                                    </div>
                                </div>

                                <!-- Giá tổng chiết khẩu -->
                                <div class="cart-price-sum-discount">
                                    <div class="cart-price-sum-discount-item">
                                        <div class="cart-price-sum-discount-title">
                                            Tổng chiết khấu
                                        </div>
    
                                        <div class="cart-price-sum-discount-price">
                                            -130.000đ
                                        </div>
                                    </div>
                                </div>

                                 <!-- Thành tiền -->
                                 <div class="cart-price-total">
                                    <div class="cart-price-total-item">
                                        <div class="cart-price-total-title">
                                            Thành tiền
                                        </div>
    
                                        <div class="cart-price-total-price">
                                            1.550.000đ
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="cart-button-buy">
                                <a href="">Đặt hàng</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <section id="section-modal-cart">
            <!-- Modal -->
            <div class="modal fade" id="modal-cart">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="modal-icon-discount">
                                <img src="../asset/image/icondiscount.png" alt="">
                            </div>

                            <div class="modal-discount-text">
                                Đăng nhập để nhận <strong>VOUCHER 50K </strong>cho <strong>đơn hàng đầu tiên</strong>
                            </div>

                            <div class="modal-discount-group-button">
                                <div class="modal-discount-login">
                                    <button type="button"  data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        Đăng nhập ngay
                                    </button>
                                </div>

                                <div class="modal-discount-close">
                                    <button type="button"  data-bs-dismiss="modal">Để sau</button>
                                </div>
                             
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
<?php
getFooter();?>