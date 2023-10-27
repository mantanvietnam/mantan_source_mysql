<?php
getHeader();
global $urlThemeActive;

$setting = setting();

$slide_home= slide_home($setting['id_slide']);
// debug($product);
	
?>

        
<main>
        <section id="section-breadcrumb">
            <div class="breadcrumb-center">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item"><a href="/allProduct">sản phẩn </a></li>
                  <li class="breadcrumb-item active"><?php echo $product->title; ?></li>
               		</ul>
            </div>
        </section>

        <section id="section-product-detail">
            <div class="container">
                <div class="row">
                    <div class="col-1 product-detail-slide-small">
                        <div class="product-slide-left">
                            <div class="product-slide-left-item">
                                <div class="product-slide-left-img">
                                    <img src="<?php echo $product->image; ?>" alt="">
                                </div>
                            </div>
                             <?php if(!empty($product->images)){
                             	foreach($product->images as $item) {
                             	if(!empty($item)){
                            ?>
                            <div class="product-slide-left-item">
                                <div class="product-slide-left-img">
                                    <img src="<?php echo $item; ?>" alt="">
                                </div>
                            </div>
                            <?php }}}
                             ?>
                        </div>
                    </div>

                    <div class="col-6 product-detail-slide">
                        <div class="product-slide-right">
                            <div class="product-slide-right-item">
                                <div class="product-slide-right-img">
                                    <img src="<?php echo $product->image; ?>" alt="">
                                </div>
                            </div>
							<?php if(!empty($product->images)){
                             	foreach($product->images as $item) {
                             	if(!empty($item)){
                            ?>
                            <div class="product-slide-right-item">
                                <div class="product-slide-right-img">
                                    <img src="<?php echo $item; ?>" alt="">
                                </div>
                            </div>
                           <?php }}}
                             ?>
                        </div>
                    </div>

                    <div class="col-5 product-detail-info">
                        <div class="product-detail-info-category">
                            <span><?php $category->name; ?></span>
                        </div>

                        <div class="product-detail-info-name">
                            <span><?php echo $product->title; ?></span>
                        </div>

                        <div class="product-detail-info-rate">
                            <div class="detail-info-rate-left">
                                <div class="stars">
                                    <svg width="100" height="100" viewBox="0 0 940.688 940.688">
                                        <path d="M885.344,319.071l-258-3.8l-102.7-264.399c-19.8-48.801-88.899-48.801-108.6,0l-102.7,264.399l-258,3.8 c-53.4,3.101-75.1,70.2-33.7,103.9l209.2,181.4l-71.3,247.7c-14,50.899,41.1,92.899,86.5,65.899l224.3-122.7l224.3,122.601 c45.4,27,100.5-15,86.5-65.9l-71.3-247.7l209.2-181.399C960.443,389.172,938.744,322.071,885.344,319.071z" />
                                    </svg>
    
                                    <svg width="100" height="100" viewBox="0 0 940.688 940.688">
                                        <path d="M885.344,319.071l-258-3.8l-102.7-264.399c-19.8-48.801-88.899-48.801-108.6,0l-102.7,264.399l-258,3.8 c-53.4,3.101-75.1,70.2-33.7,103.9l209.2,181.4l-71.3,247.7c-14,50.899,41.1,92.899,86.5,65.899l224.3-122.7l224.3,122.601 c45.4,27,100.5-15,86.5-65.9l-71.3-247.7l209.2-181.399C960.443,389.172,938.744,322.071,885.344,319.071z" />
                                    </svg>
    
                                    <svg width="100" height="100" viewBox="0 0 940.688 940.688">
                                        <path d="M885.344,319.071l-258-3.8l-102.7-264.399c-19.8-48.801-88.899-48.801-108.6,0l-102.7,264.399l-258,3.8 c-53.4,3.101-75.1,70.2-33.7,103.9l209.2,181.4l-71.3,247.7c-14,50.899,41.1,92.899,86.5,65.899l224.3-122.7l224.3,122.601 c45.4,27,100.5-15,86.5-65.9l-71.3-247.7l209.2-181.399C960.443,389.172,938.744,322.071,885.344,319.071z" />
                                    </svg>
    
                                    <svg width="100" height="100" viewBox="0 0 940.688 940.688">
                                        <path d="M885.344,319.071l-258-3.8l-102.7-264.399c-19.8-48.801-88.899-48.801-108.6,0l-102.7,264.399l-258,3.8 c-53.4,3.101-75.1,70.2-33.7,103.9l209.2,181.4l-71.3,247.7c-14,50.899,41.1,92.899,86.5,65.899l224.3-122.7l224.3,122.601 c45.4,27,100.5-15,86.5-65.9l-71.3-247.7l209.2-181.399C960.443,389.172,938.744,322.071,885.344,319.071z" />
                                    </svg>
    
                                    <svg width="100" height="100" viewBox="0 0 940.688 940.688">
                                        <path d="M885.344,319.071l-258-3.8l-102.7-264.399c-19.8-48.801-88.899-48.801-108.6,0l-102.7,264.399l-258,3.8 c-53.4,3.101-75.1,70.2-33.7,103.9l209.2,181.4l-71.3,247.7c-14,50.899,41.1,92.899,86.5,65.899l224.3-122.7l224.3,122.601 c45.4,27,100.5-15,86.5-65.9l-71.3-247.7l209.2-181.399C960.443,389.172,938.744,322.071,885.344,319.071z" />
                                    </svg>
                                    <div class="overlay" style="width: 0%"></div>
                                </div>   

                                <div class="rate-left-text">
                                    <span>4.5 (23 đánh giá) | 560 đã bán</span>
                                </div>
                            </div>
                              
                            <div class="detail-info-rate-right">
                                <img src="<?php echo $urlThemeActive;?>asset/image/heart.png" alt="">
                                <span>4000 + loves</span>
                            </div>
                            
                        </div>

                        <div class="product-detail-info-flash">
                            <div class="product-info-flash-title">
                                Flash sale
                            </div>

                            <div class="product-detail-info-flash-number">
                                <p>Kết thúc trong</p>
                                <div class="time-flash-sale">
                                    <div class="time-flash-number">
                                        <p>0</p>
                                    </div>
                                
        
                                    <div class="time-flash-number">
                                        <p>0</p>
                                    </div>
                                
        
                                    <div class="time-flash-number">
                                        <p>0</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="product-detail-info-price">
                            <div class="product-detail-info-price-left">
                                <div class="price-left-real">
                                    <p><?php echo number_format($product->price); ?>đ</p>
                                </div>

                                <div class="price-left-sale">
                                    <del><?php echo number_format($product->price); ?>đ</del>
                                </div>
                            </div>

                            <div class="product-detail-info-price-right">
                                <span>(Bạn đã tích kiệm  300.000đ)</span>
                            </div>
                        </div>

                        <!-- Mã giảm giá -->
                        <div class="product-detail-code-discount">
                            <div class="product-info-detail-title">
                                <p>Mã giảm giá</p>
                            </div>

                            <div class="product-code-discount-list">
                                <div class="product-code-discount-item">
                                    Giảm 200K
                                </div>
    
                                <div class="product-code-discount-item">
                                    Giảm 100K
                                </div>
    
                                <div class="product-code-discount-item">
                                    Giảm 50K
                                </div>
                            </div>

                            
                        </div>

                        <!-- Quà tặng -->
                        <div class="product-detail-gift">
                            <div class="product-info-detail-title">
                                <p>Quà tặng</p>
                            </div>

                            <div class="product-detail-gift-list">
                                <div class="product-detail-gift-item">
                                    <a href="">
                                        <div class="gift-item-inner">
                                            <div class="gift-item-img">
                                                <img src="<?php echo $urlThemeActive;?>asset/image/baggift.png" alt="">
                                            </div>
                                            <div class="gift-item-name">
                                                <span>Túi vải canvas</span>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <div class="product-detail-gift-item">
                                    <a href="">
                                        <div class="gift-item-inner">
                                            <div class="gift-item-img">
                                                <img src="<?php echo $urlThemeActive;?>asset/image/baggift.png" alt="">
                                            </div>
                                            <div class="gift-item-name">
                                                <span>Túi vải canvas</span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>

                          <!-- F & A -->
                        <div class="product-detail-fa">
                            <div class="product-info-detail-title">
                                <p>F & A</p>
                            </div>

                            <div class="product-detail-fa-list">
                                <div class="accordion accordion-questionTop" id="accordionquestionTopExample">
                                    <?php if(!empty($product->question)){
                                        foreach($product->question as $key => $item){
                                     ?>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="questionTop-heading<?php echo $key; ?>">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#questionTop-collapseOne" aria-expanded="false" aria-controls="questionTop-collapseOne">
                                            <?php echo $item->question; ?>                                    
                                            </button>
                                        </h2>
                                        <div id="questionTop-collapseOne" class="accordion-collapse collapse" aria-labelledby="questionTop-heading<?php echo $key; ?>" data-bs-parent="#accordionquestionTopExample">
                                            <div class="accordion-body"><?php echo $item->answer; ?></div>
                                        </div>
                                    </div>
                                <?php }} ?>
                                   
                                </div>
                            </div>
                        </div>

                        <!-- Chính sách -->
                        <div class="product-detail-policy">
                            <div class="product-info-detail-title">
                                <p>Chính sách</p>
                            </div>

                            <div class="product-detail-policy-list">
                                <div class="roduct-detail-policy-item">
                                    <div class="policy-item-image">
                                        <img src="<?php echo $urlThemeActive;?>asset/image/policy1.png" alt="">
                                    </div>
                                    <div class="policy-item-text">
                                        <strong>Miễn phí </strong>giao hàng <br> đơn hàng từ 2 triệu 
                                    </div>
                                </div>

                                <div class="roduct-detail-policy-item">
                                    <div class="policy-item-image">
                                        <img src="<?php echo $urlThemeActive;?>asset/image/policy2.png" alt="">
                                    </div>
                                    <div class="policy-item-text">
                                        Chính sách <strong>bảo mật</strong> <br> thông tin khách hàng
                                    </div>
                                </div>

                                <div class="roduct-detail-policy-item">
                                    <div class="policy-item-image">
                                        <img src="<?php echo $urlThemeActive;?>asset/image/policy3.png" alt="">
                                    </div>
                                    <div class="policy-item-text">
                                        <strong>12 tháng bảo hành </strong>
                                        <br>
                                        <span>30 ngày 1 đổi 1 tại nhà</span>
                                    </div>
                                </div>

                                <div class="roduct-detail-policy-item">
                                    <div class="policy-item-image">
                                        <img src="<?php echo $urlThemeActive;?>asset/image/policy4.png" alt="">
                                    </div>
                                    <div class="policy-item-text">
                                        <strong>7 ngày dùng thử</strong> 
                                        <br>
                                        <span>
                                            Trả hàng hoàn tiền nếu <br> khách hàng không hài lòng
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Số lượng -->
                         <div class="product-detail-number">
                            <div class="product-info-detail-title">
                                <p>Số lượng</p>
                            </div>

                            <div class="product-detail-number-item">
                                <div class="qty-input">
                                    <button onclick="decreaseValue()" class="qty-count-minus" data-action="minus" type="button">-</button>
                                    <input id="valueInput" class="product-qty" type="text" name="product-qty" value="1" min="0">
                                    <button onclick="increaseValue()" class="qty-count-add" data-action="add" type="button">+</button>
                                </div>
                            </div>
                        </div>

                        <!-- Button cuối -->
                        <div class="product-detail-group-button">
                            <div class="product-detail-button-cart">
                                <a href=""><img src="<?php echo $urlThemeActive;?>asset/image/cartdetail.png" alt=""> Thêm vào giỏ hàng</a>
                            </div>

                            <div class="product-detail-button-buy">
                                <a href="">Mua ngay</a>
                            </div>

                            <div class="product-detail-button-like">
                                <button onclick="changeColor()"><img src="<?php echo $urlThemeActive;?>asset/image/heart.png" alt=""></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Xác nhận thêm giỏ hàng -->
            <div class="box-confirm-cart">
                <div class="box-confirm-cart-title">
                    <p>Đã thêm vào giỏ hàng</p>
                    <div class="close-button">
                        <i class="fa-solid fa-xmark"></i>
                    </div>
                </div>

                <div class="box-confirm-cart-detail">
                    <div class="box-confirm-cart-top">
                        <div class="box-confirm-cart-image">
                            <img src="<?php echo $urlThemeActive;?>asset/image/product-detail.png" alt="">
                        </div>

                        <div class="box-confirm-cart-detail-box">
                            <div class="box-confirm-cart-detail-name">
                                Máy massage khớp gối Bumas M6
                            </div>

                            <div class="box-confirm-cart-detail-price">
                                <div class="box-confirm-cart-price-real">
                                    <span>1.0000.000đ</span>
                                </div>

                                <div class="box-confirm-cart-price-discount">
                                    <del>500.000đ</del>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="box-confirm-cart-bottom">
                        <a href="">Xem giỏ hàng</a>
                    </div>
                </div>
            </div>
        </section>

        <section id="section-pro-review">
            <div class="container">
                <div class="section-pro-review-inner">
                    <div class="title-section">

                    </div>

                    <div class="pro-review-slide">
                        <div class="pro-review-item">
                            <div class="pro-review-img">
                                <img src="<?php echo @$product->image; ?>" alt="">
                            </div>
                        </div>
                         <?php if(!empty($product->images)){
                             	foreach($product->images as $item) {
                             	if(!empty($item)){
                            ?>
                        <div class="pro-review-item">
                            <div class="pro-review-img">
                                <img src="<?php echo $item ?>" alt="">
                            </div>
                        </div>
                    <?php }}} ?>
                    </div>
                </div>
            </div>
        </section>

        <section id="section-info-col">
            <div class="container">
                <div class="row">
                    <div class="info-col info-col-left col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="title-info-col">
                            <p>Đặc điểm nổi bật</p>
                        </div>
                        <div class="info-col-description">
                           <?php echo @$product->rule; ?>
                        </div>

                    </div>
        
                    <div class="info-col info-col-right col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="title-info-col">
                            <p>Thông số kỹ thuật</p>
                        </div>
                        <div class="info-col-description">
                             <?php echo @$product->specification; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="section-describe">
            <div class="container">
                <div class="describe-inner">
                    <div class="title-section">
                        <h2>Mô tả sản phẩm</h2>
                    </div>
                </div>

                <div class="describe-description">
                   <?php echo @$product->info; ?>
                </div>

                <div class="describe-more">
                    <button>Xem thêm</button>
                </div>
            </div>
        </section>

        <section id="section-product-detail-review">
            <div id="full-stars-example">
                
            </div>
        </section>

        <section id="section-product-question">
            <div class="product-question-inner">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-12 product-question-left">

                        </div>
            
                        <div class="col-lg-6 col-12 product-question-right">
                            <div class="title-question-right">
                                <p>Câu Hỏi Thường Gặp</p>
                            </div>

                            <div class="list-product-question">
                                <div class="accordion accordion-questionBottom" id="accordionquestionBottomExample">
                                     <?php if(!empty($product->question)){
                                        foreach($product->question as $key => $item){
                                     ?>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="questionBottom<?php echo $key ?>">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#questionBottom<?php echo $key ?>" aria-expanded="false" aria-controls="questionBottom<?php echo $key ?>">
                                            <?php echo $item->question ?>                                   
                                            </button>
                                        </h2>
                                        <div id="questionBottom<?php echo $key ?>" class="accordion-collapse collapse" aria-labelledby="questionBottom<?php echo $key ?>" data-bs-parent="#accordionquestionBottomExample">
                                            <div class="accordion-body"><?php echo $item->answer ?></div>
                                        </div>
                                    </div>
                                <?php }} ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="section-product-like">
            <div class="container"> 
                <div class="section-product-like-inner">
                    <div class="title-section">
                        <h2>Các sản phẩm bạn có thể thích</h2>
                    </div>
    
                    <div class="product-like-slide">
                       <?php if(!empty($other_product)) { 
                            foreach($other_product as $product) {
                                    $link = '/product/'.$product->slug.'.html';
                                     $giam = 0;
                                    if(!empty($product->price_old) && !empty($product->price)){
                                        $giam = 100 - 100*$product->price/$product->price_old;
                                    }

                                    $ban = 0;
                                    if(!empty($product->quantity) && !empty($product->sold)){
                                        $ban = 100 - 100*$product->sold/$product->quantity;
                                    }
                            ?>
                        <div class="product-item">
                            <div class="product-item-inner">
                                 <?php if($giam>0){ ?>
                                        <div class="ribbon ribbon-top-right"><span><?php echo number_format($giam) ?>%</span></div>
                                    <?php } ?>
                                <div class="product-img">
                                    <a href="<?php echo $link ?>"><img src="<?php echo $product->image ?>" alt=""></a>
                                </div>
    
                                <div class="product-info">
                                    <div class="product-name">
                                        <a href="<?php echo $link ?>"><?php echo $product->image ?></a>
                                    </div>
    
                                    <div class="product-price">
                                        <p><?php echo number_format($product->price) ?></p>
                                    </div>
    
                                    <div class="product-discount">
                                        <del><?php echo number_format($product->price_old) ?></del>
                                    </div>
                                </div>
    
                                <div class="progress-box">
                                    <div class="product-progress">
                                        <div class="text-progress">Sản phẩm <?php echo $product->sold; ?> Đã bán</div>
                                        <div class="sale-progress-val" style="width: <?php echo $ban; ?>%"></div>
                                    </div>
                                </div>
    
                                <div class="product-rate">
                                    <div class="rate-best-item rate-star">
                                        <img src="<?php echo $urlThemeActive;?>asset/image/star.png" alt="">
                                        <p>4.8 <span>(34)</span></p>
                                    </div>
    
                                    <div class="rate-best-item rate-sold">
                                        <p><?php echo $product->sold; ?> Đã bán</p>
                                        <img src="<?php echo $urlThemeActive;?>asset/image/heart.png" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php }} ?> 

                    </div>
                </div>  
            </div>
        </section>

        <!-- Đánh giá -->
        <div id="section-product-detail-rate">
            <div class="container">
                <div class="product-detail-rate-inner">
                    <div class="title-section">
                        <h2>Đánh giá</h2>
                    </div>
                    
                    <div class="row">
                        <div class="product-detail-rate-list col-6">
                            <div class="product-detail-rate-item">
                                <div class="product-detail-rate-avata">
                                    <img src="<?php echo $urlThemeActive;?>asset/image/cute-1-300x300.png" alt="">
                                </div>
            
                                <div class="product-detail-rate-right">
                                    <div class="product-detail-rate-heading">
                                        <div class="product-detail-rate-name">
                                            Nguyễn Thùy Trang
                                        </div>
            
                                        <div class="product-detail-rate-date">
                                            23/03/2023 lúc 19:01
                                        </div>
                                    </div>
            
                                    <div class="product-detail-rate-star">
                                        <div class="stars">
                                            <svg width="100" height="100" viewBox="0 0 940.688 940.688">
                                                <path d="M885.344,319.071l-258-3.8l-102.7-264.399c-19.8-48.801-88.899-48.801-108.6,0l-102.7,264.399l-258,3.8 c-53.4,3.101-75.1,70.2-33.7,103.9l209.2,181.4l-71.3,247.7c-14,50.899,41.1,92.899,86.5,65.899l224.3-122.7l224.3,122.601 c45.4,27,100.5-15,86.5-65.9l-71.3-247.7l209.2-181.399C960.443,389.172,938.744,322.071,885.344,319.071z" />
                                            </svg>
            
                                            <svg width="100" height="100" viewBox="0 0 940.688 940.688">
                                                <path d="M885.344,319.071l-258-3.8l-102.7-264.399c-19.8-48.801-88.899-48.801-108.6,0l-102.7,264.399l-258,3.8 c-53.4,3.101-75.1,70.2-33.7,103.9l209.2,181.4l-71.3,247.7c-14,50.899,41.1,92.899,86.5,65.899l224.3-122.7l224.3,122.601 c45.4,27,100.5-15,86.5-65.9l-71.3-247.7l209.2-181.399C960.443,389.172,938.744,322.071,885.344,319.071z" />
                                            </svg>
            
                                            <svg width="100" height="100" viewBox="0 0 940.688 940.688">
                                                <path d="M885.344,319.071l-258-3.8l-102.7-264.399c-19.8-48.801-88.899-48.801-108.6,0l-102.7,264.399l-258,3.8 c-53.4,3.101-75.1,70.2-33.7,103.9l209.2,181.4l-71.3,247.7c-14,50.899,41.1,92.899,86.5,65.899l224.3-122.7l224.3,122.601 c45.4,27,100.5-15,86.5-65.9l-71.3-247.7l209.2-181.399C960.443,389.172,938.744,322.071,885.344,319.071z" />
                                            </svg>
            
                                            <svg width="100" height="100" viewBox="0 0 940.688 940.688">
                                                <path d="M885.344,319.071l-258-3.8l-102.7-264.399c-19.8-48.801-88.899-48.801-108.6,0l-102.7,264.399l-258,3.8 c-53.4,3.101-75.1,70.2-33.7,103.9l209.2,181.4l-71.3,247.7c-14,50.899,41.1,92.899,86.5,65.899l224.3-122.7l224.3,122.601 c45.4,27,100.5-15,86.5-65.9l-71.3-247.7l209.2-181.399C960.443,389.172,938.744,322.071,885.344,319.071z" />
                                            </svg>
            
                                            <svg class="checked" width="100" height="100" viewBox="0 0 940.688 940.688">
                                                <path d="M885.344,319.071l-258-3.8l-102.7-264.399c-19.8-48.801-88.899-48.801-108.6,0l-102.7,264.399l-258,3.8 c-53.4,3.101-75.1,70.2-33.7,103.9l209.2,181.4l-71.3,247.7c-14,50.899,41.1,92.899,86.5,65.899l224.3-122.7l224.3,122.601 c45.4,27,100.5-15,86.5-65.9l-71.3-247.7l209.2-181.399C960.443,389.172,938.744,322.071,885.344,319.071z" />
                                            </svg>
                                        </div> 
                                    </div>  
            
                                    <div class="product-detail-rate-comment">
                                        Sản phẩm dùng ok, dáng đẹp nhé
                                    </div>  
            
                                    <div class="product-detail-rate-image">
                                        <img src="<?php echo $urlThemeActive;?>asset/image/quangcao3.png" alt="">
                                        <img src="<?php echo $urlThemeActive;?>asset/image/quangcao3.png" alt="">

                                    </div> 

                                    <div class="product-detail-rate-like" >
                                        <svg onclick="changeColorRate()" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M323.8 34.8c-38.2-10.9-78.1 11.2-89 49.4l-5.7 20c-3.7 13-10.4 25-19.5 35l-51.3 56.4c-8.9 9.8-8.2 25 1.6 33.9s25 8.2 33.9-1.6l51.3-56.4c14.1-15.5 24.4-34 30.1-54.1l5.7-20c3.6-12.7 16.9-20.1 29.7-16.5s20.1 16.9 16.5 29.7l-5.7 20c-5.7 19.9-14.7 38.7-26.6 55.5c-5.2 7.3-5.8 16.9-1.7 24.9s12.3 13 21.3 13L448 224c8.8 0 16 7.2 16 16c0 6.8-4.3 12.7-10.4 15c-7.4 2.8-13 9-14.9 16.7s.1 15.8 5.3 21.7c2.5 2.8 4 6.5 4 10.6c0 7.8-5.6 14.3-13 15.7c-8.2 1.6-15.1 7.3-18 15.1s-1.6 16.7 3.6 23.3c2.1 2.7 3.4 6.1 3.4 9.9c0 6.7-4.2 12.6-10.2 14.9c-11.5 4.5-17.7 16.9-14.4 28.8c.4 1.3 .6 2.8 .6 4.3c0 8.8-7.2 16-16 16H286.5c-12.6 0-25-3.7-35.5-10.7l-61.7-41.1c-11-7.4-25.9-4.4-33.3 6.7s-4.4 25.9 6.7 33.3l61.7 41.1c18.4 12.3 40 18.8 62.1 18.8H384c34.7 0 62.9-27.6 64-62c14.6-11.7 24-29.7 24-50c0-4.5-.5-8.8-1.3-13c15.4-11.7 25.3-30.2 25.3-51c0-6.5-1-12.8-2.8-18.7C504.8 273.7 512 257.7 512 240c0-35.3-28.6-64-64-64l-92.3 0c4.7-10.4 8.7-21.2 11.8-32.2l5.7-20c10.9-38.2-11.2-78.1-49.4-89zM32 192c-17.7 0-32 14.3-32 32V448c0 17.7 14.3 32 32 32H96c17.7 0 32-14.3 32-32V224c0-17.7-14.3-32-32-32H32z"/></svg>                                     
                                        <span>Hữu ích</span>
                                    </div> 

                                </div>
                            </div>

                            <div class="product-detail-rate-item">
                                <div class="product-detail-rate-avata">
                                    <img src="<?php echo $urlThemeActive;?>asset/image/cute-1-300x300.png" alt="">
                                </div>
            
                                <div class="product-detail-rate-right">
                                    <div class="product-detail-rate-heading">
                                        <div class="product-detail-rate-name">
                                            Nguyễn Thùy Trang
                                        </div>
            
                                        <div class="product-detail-rate-date">
                                            23/03/2023 lúc 19:01
                                        </div>
                                    </div>
            
                                    <div class="product-detail-rate-star">
                                        <div class="stars">
                                            <svg width="100" height="100" viewBox="0 0 940.688 940.688">
                                                <path d="M885.344,319.071l-258-3.8l-102.7-264.399c-19.8-48.801-88.899-48.801-108.6,0l-102.7,264.399l-258,3.8 c-53.4,3.101-75.1,70.2-33.7,103.9l209.2,181.4l-71.3,247.7c-14,50.899,41.1,92.899,86.5,65.899l224.3-122.7l224.3,122.601 c45.4,27,100.5-15,86.5-65.9l-71.3-247.7l209.2-181.399C960.443,389.172,938.744,322.071,885.344,319.071z" />
                                            </svg>
            
                                            <svg width="100" height="100" viewBox="0 0 940.688 940.688">
                                                <path d="M885.344,319.071l-258-3.8l-102.7-264.399c-19.8-48.801-88.899-48.801-108.6,0l-102.7,264.399l-258,3.8 c-53.4,3.101-75.1,70.2-33.7,103.9l209.2,181.4l-71.3,247.7c-14,50.899,41.1,92.899,86.5,65.899l224.3-122.7l224.3,122.601 c45.4,27,100.5-15,86.5-65.9l-71.3-247.7l209.2-181.399C960.443,389.172,938.744,322.071,885.344,319.071z" />
                                            </svg>
            
                                            <svg width="100" height="100" viewBox="0 0 940.688 940.688">
                                                <path d="M885.344,319.071l-258-3.8l-102.7-264.399c-19.8-48.801-88.899-48.801-108.6,0l-102.7,264.399l-258,3.8 c-53.4,3.101-75.1,70.2-33.7,103.9l209.2,181.4l-71.3,247.7c-14,50.899,41.1,92.899,86.5,65.899l224.3-122.7l224.3,122.601 c45.4,27,100.5-15,86.5-65.9l-71.3-247.7l209.2-181.399C960.443,389.172,938.744,322.071,885.344,319.071z" />
                                            </svg>
            
                                            <svg width="100" height="100" viewBox="0 0 940.688 940.688">
                                                <path d="M885.344,319.071l-258-3.8l-102.7-264.399c-19.8-48.801-88.899-48.801-108.6,0l-102.7,264.399l-258,3.8 c-53.4,3.101-75.1,70.2-33.7,103.9l209.2,181.4l-71.3,247.7c-14,50.899,41.1,92.899,86.5,65.899l224.3-122.7l224.3,122.601 c45.4,27,100.5-15,86.5-65.9l-71.3-247.7l209.2-181.399C960.443,389.172,938.744,322.071,885.344,319.071z" />
                                            </svg>
            
                                            <svg class="checked" width="100" height="100" viewBox="0 0 940.688 940.688">
                                                <path d="M885.344,319.071l-258-3.8l-102.7-264.399c-19.8-48.801-88.899-48.801-108.6,0l-102.7,264.399l-258,3.8 c-53.4,3.101-75.1,70.2-33.7,103.9l209.2,181.4l-71.3,247.7c-14,50.899,41.1,92.899,86.5,65.899l224.3-122.7l224.3,122.601 c45.4,27,100.5-15,86.5-65.9l-71.3-247.7l209.2-181.399C960.443,389.172,938.744,322.071,885.344,319.071z" />
                                            </svg>
                                        </div> 
                                    </div>  
            
                                    <div class="product-detail-rate-comment">
                                        Sản phẩm dùng ok, dáng đẹp nhé
                                    </div>  
            
                                    <div class="product-detail-rate-image">
                                        <img src="<?php echo $urlThemeActive;?>asset/image/quangcao3.png" alt="">
                                        <img src="<?php echo $urlThemeActive;?>asset/image/quangcao3.png" alt="">

                                    </div> 

                                    <div class="product-detail-rate-like" >
                                        <svg onclick="changeColorRate()" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M323.8 34.8c-38.2-10.9-78.1 11.2-89 49.4l-5.7 20c-3.7 13-10.4 25-19.5 35l-51.3 56.4c-8.9 9.8-8.2 25 1.6 33.9s25 8.2 33.9-1.6l51.3-56.4c14.1-15.5 24.4-34 30.1-54.1l5.7-20c3.6-12.7 16.9-20.1 29.7-16.5s20.1 16.9 16.5 29.7l-5.7 20c-5.7 19.9-14.7 38.7-26.6 55.5c-5.2 7.3-5.8 16.9-1.7 24.9s12.3 13 21.3 13L448 224c8.8 0 16 7.2 16 16c0 6.8-4.3 12.7-10.4 15c-7.4 2.8-13 9-14.9 16.7s.1 15.8 5.3 21.7c2.5 2.8 4 6.5 4 10.6c0 7.8-5.6 14.3-13 15.7c-8.2 1.6-15.1 7.3-18 15.1s-1.6 16.7 3.6 23.3c2.1 2.7 3.4 6.1 3.4 9.9c0 6.7-4.2 12.6-10.2 14.9c-11.5 4.5-17.7 16.9-14.4 28.8c.4 1.3 .6 2.8 .6 4.3c0 8.8-7.2 16-16 16H286.5c-12.6 0-25-3.7-35.5-10.7l-61.7-41.1c-11-7.4-25.9-4.4-33.3 6.7s-4.4 25.9 6.7 33.3l61.7 41.1c18.4 12.3 40 18.8 62.1 18.8H384c34.7 0 62.9-27.6 64-62c14.6-11.7 24-29.7 24-50c0-4.5-.5-8.8-1.3-13c15.4-11.7 25.3-30.2 25.3-51c0-6.5-1-12.8-2.8-18.7C504.8 273.7 512 257.7 512 240c0-35.3-28.6-64-64-64l-92.3 0c4.7-10.4 8.7-21.2 11.8-32.2l5.7-20c10.9-38.2-11.2-78.1-49.4-89zM32 192c-17.7 0-32 14.3-32 32V448c0 17.7 14.3 32 32 32H96c17.7 0 32-14.3 32-32V224c0-17.7-14.3-32-32-32H32z"/></svg>                                     
                                        <span>Hữu ích</span>
                                    </div> 

                                </div>
                            </div>
                        </div>

                        <div class="product-detail-rate-right col-6">
                            <div class="product-detail-rate-right-title">
                                Đánh giá sản phẩm
                            </div>

                            <div class="product-detail-rate-right-point">
                                <div class="product-detail-rate-right-number">
                                    4.7
                                </div>

                                <div class="product-detail-rate-right-star">
                                    <div class="stars">
                                        <svg width="100" height="100" viewBox="0 0 940.688 940.688">
                                            <path d="M885.344,319.071l-258-3.8l-102.7-264.399c-19.8-48.801-88.899-48.801-108.6,0l-102.7,264.399l-258,3.8 c-53.4,3.101-75.1,70.2-33.7,103.9l209.2,181.4l-71.3,247.7c-14,50.899,41.1,92.899,86.5,65.899l224.3-122.7l224.3,122.601 c45.4,27,100.5-15,86.5-65.9l-71.3-247.7l209.2-181.399C960.443,389.172,938.744,322.071,885.344,319.071z" />
                                        </svg>
        
                                        <svg width="100" height="100" viewBox="0 0 940.688 940.688">
                                            <path d="M885.344,319.071l-258-3.8l-102.7-264.399c-19.8-48.801-88.899-48.801-108.6,0l-102.7,264.399l-258,3.8 c-53.4,3.101-75.1,70.2-33.7,103.9l209.2,181.4l-71.3,247.7c-14,50.899,41.1,92.899,86.5,65.899l224.3-122.7l224.3,122.601 c45.4,27,100.5-15,86.5-65.9l-71.3-247.7l209.2-181.399C960.443,389.172,938.744,322.071,885.344,319.071z" />
                                        </svg>
        
                                        <svg width="100" height="100" viewBox="0 0 940.688 940.688">
                                            <path d="M885.344,319.071l-258-3.8l-102.7-264.399c-19.8-48.801-88.899-48.801-108.6,0l-102.7,264.399l-258,3.8 c-53.4,3.101-75.1,70.2-33.7,103.9l209.2,181.4l-71.3,247.7c-14,50.899,41.1,92.899,86.5,65.899l224.3-122.7l224.3,122.601 c45.4,27,100.5-15,86.5-65.9l-71.3-247.7l209.2-181.399C960.443,389.172,938.744,322.071,885.344,319.071z" />
                                        </svg>
        
                                        <svg width="100" height="100" viewBox="0 0 940.688 940.688">
                                            <path d="M885.344,319.071l-258-3.8l-102.7-264.399c-19.8-48.801-88.899-48.801-108.6,0l-102.7,264.399l-258,3.8 c-53.4,3.101-75.1,70.2-33.7,103.9l209.2,181.4l-71.3,247.7c-14,50.899,41.1,92.899,86.5,65.899l224.3-122.7l224.3,122.601 c45.4,27,100.5-15,86.5-65.9l-71.3-247.7l209.2-181.399C960.443,389.172,938.744,322.071,885.344,319.071z" />
                                        </svg>
        
                                        <svg width="100" height="100" viewBox="0 0 940.688 940.688">
                                            <path d="M885.344,319.071l-258-3.8l-102.7-264.399c-19.8-48.801-88.899-48.801-108.6,0l-102.7,264.399l-258,3.8 c-53.4,3.101-75.1,70.2-33.7,103.9l209.2,181.4l-71.3,247.7c-14,50.899,41.1,92.899,86.5,65.899l224.3-122.7l224.3,122.601 c45.4,27,100.5-15,86.5-65.9l-71.3-247.7l209.2-181.399C960.443,389.172,938.744,322.071,885.344,319.071z" />
                                        </svg>

                                        <div class="overlay" style="width: 35%"></div>

                                    </div> 

                                    <div class="product-detail-rate-count">
                                        6 Đánh giá
                                    </div>
                                </div>
                            </div>

                            <div class="list-filter-rate-list">
                                <div class="list-filter-rate-item">
                                    <a href="">Tất cả</a>
                                </div>

                                <div class="list-filter-rate-item">
                                    <a href="">5 sao</a>
                                </div>

                                <div class="list-filter-rate-item">
                                    <a href="">4 sao</a>
                                </div>

                                <div class="list-filter-rate-item">
                                    <a href="">3 sao</a>
                                </div>

                                <div class="list-filter-rate-item">
                                    <a href="">2 sao</a>
                                </div>

                                <div class="list-filter-rate-item">
                                    <a href="">1 sao</a>
                                </div>

                                <div class="list-filter-rate-item">
                                    <a href="">Có hình ảnh/video</a>
                                </div>
                            </div>

                            <div class="rate-image-right">
                                <div class="rate-image-title">
                                    Hình ảnh từ người dùng
                                </div>
                                <div class="list-rate-image">
                                    <div class="rate-image-item">
                                        <img src="<?php echo $urlThemeActive;?>asset/image/background-home.png" alt="">
                                    </div>
    
                                    <div class="rate-image-item">
                                        <img src="<?php echo $urlThemeActive;?>asset/image/background-home.png" alt="">
    
                                    </div>
    
                                    <div class="rate-image-item">
                                        <img src="<?php echo $urlThemeActive;?>asset/image/background-home.png" alt="">
                                    </div>
                                </div>
                            </div>

                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Thảo luận -->

        <div id="section-product-detail-comment">
            <div class="container">
                <div class="product-detail-rate-inner">
                    <div class="title-section">
                        <h2>Bình luận</h2>
                    </div>
                    
                    <div class="row">
                        <div class="product-detail-rate-list col-8">
                            <div class="product-detail-rate-inner">
                                <!-- comment chính -->
                                <div class="comment-main">
                                    <div class="product-detail-rate-item">
                                        <div class="product-detail-rate-avata">
                                            <img src="<?php echo $urlThemeActive;?>asset/image/cute-1-300x300.png" alt="">
                                        </div>
                    
                                        <div class="product-detail-rate-right">
                                            <div class="product-detail-rate-heading">
                                                <div class="product-detail-rate-name">
                                                    Nguyễn Thùy Trang
                                                </div>
                                            </div>

                                            <div class="product-detail-rate-comment">
                                                Sản phẩm dùng ok, dáng đẹp nhé
                                            </div>  

                                            <div class="product-detail-rate-like" >
                                                <div class="people-comment">
                                                    <span>Trả lời</span>
                                                </div>

                                                <div class="people-like">
                                                    <svg onclick="changeColorRate()" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M323.8 34.8c-38.2-10.9-78.1 11.2-89 49.4l-5.7 20c-3.7 13-10.4 25-19.5 35l-51.3 56.4c-8.9 9.8-8.2 25 1.6 33.9s25 8.2 33.9-1.6l51.3-56.4c14.1-15.5 24.4-34 30.1-54.1l5.7-20c3.6-12.7 16.9-20.1 29.7-16.5s20.1 16.9 16.5 29.7l-5.7 20c-5.7 19.9-14.7 38.7-26.6 55.5c-5.2 7.3-5.8 16.9-1.7 24.9s12.3 13 21.3 13L448 224c8.8 0 16 7.2 16 16c0 6.8-4.3 12.7-10.4 15c-7.4 2.8-13 9-14.9 16.7s.1 15.8 5.3 21.7c2.5 2.8 4 6.5 4 10.6c0 7.8-5.6 14.3-13 15.7c-8.2 1.6-15.1 7.3-18 15.1s-1.6 16.7 3.6 23.3c2.1 2.7 3.4 6.1 3.4 9.9c0 6.7-4.2 12.6-10.2 14.9c-11.5 4.5-17.7 16.9-14.4 28.8c.4 1.3 .6 2.8 .6 4.3c0 8.8-7.2 16-16 16H286.5c-12.6 0-25-3.7-35.5-10.7l-61.7-41.1c-11-7.4-25.9-4.4-33.3 6.7s-4.4 25.9 6.7 33.3l61.7 41.1c18.4 12.3 40 18.8 62.1 18.8H384c34.7 0 62.9-27.6 64-62c14.6-11.7 24-29.7 24-50c0-4.5-.5-8.8-1.3-13c15.4-11.7 25.3-30.2 25.3-51c0-6.5-1-12.8-2.8-18.7C504.8 273.7 512 257.7 512 240c0-35.3-28.6-64-64-64l-92.3 0c4.7-10.4 8.7-21.2 11.8-32.2l5.7-20c10.9-38.2-11.2-78.1-49.4-89zM32 192c-17.7 0-32 14.3-32 32V448c0 17.7 14.3 32 32 32H96c17.7 0 32-14.3 32-32V224c0-17.7-14.3-32-32-32H32z"/></svg>                                     
                                                    <span>Thích</span>
                                                </div>

                                                <div class="people-time">
                                                    10 phút trước
                                                </div>
                                            </div> 

                                        </div>
                                    </div>
                                </div>

                                <!-- Comment phụ -->
                                <div class="comment-extra">
                                    <div class="product-detail-rate-item">
                                        <div class="product-detail-rate-avata">
                                            <img src="<?php echo $urlThemeActive;?>asset/image/cute-1-300x300.png" alt="">
                                        </div>
                    
                                        <div class="product-detail-rate-right">
                                            <div class="product-detail-rate-heading">
                                                <div class="product-detail-rate-name">
                                                    Nguyễn Thùy Trang
                                                </div>
                                            </div>

                                            <div class="product-detail-rate-comment">
                                                Sản phẩm dùng ok, dáng đẹp nhé
                                            </div>  

                                            <div class="product-detail-rate-like" >
                                                <div class="people-comment">
                                                    <span>Trả lời</span>
                                                </div>

                                                <div class="people-like">
                                                    <svg onclick="changeColorRate()" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M323.8 34.8c-38.2-10.9-78.1 11.2-89 49.4l-5.7 20c-3.7 13-10.4 25-19.5 35l-51.3 56.4c-8.9 9.8-8.2 25 1.6 33.9s25 8.2 33.9-1.6l51.3-56.4c14.1-15.5 24.4-34 30.1-54.1l5.7-20c3.6-12.7 16.9-20.1 29.7-16.5s20.1 16.9 16.5 29.7l-5.7 20c-5.7 19.9-14.7 38.7-26.6 55.5c-5.2 7.3-5.8 16.9-1.7 24.9s12.3 13 21.3 13L448 224c8.8 0 16 7.2 16 16c0 6.8-4.3 12.7-10.4 15c-7.4 2.8-13 9-14.9 16.7s.1 15.8 5.3 21.7c2.5 2.8 4 6.5 4 10.6c0 7.8-5.6 14.3-13 15.7c-8.2 1.6-15.1 7.3-18 15.1s-1.6 16.7 3.6 23.3c2.1 2.7 3.4 6.1 3.4 9.9c0 6.7-4.2 12.6-10.2 14.9c-11.5 4.5-17.7 16.9-14.4 28.8c.4 1.3 .6 2.8 .6 4.3c0 8.8-7.2 16-16 16H286.5c-12.6 0-25-3.7-35.5-10.7l-61.7-41.1c-11-7.4-25.9-4.4-33.3 6.7s-4.4 25.9 6.7 33.3l61.7 41.1c18.4 12.3 40 18.8 62.1 18.8H384c34.7 0 62.9-27.6 64-62c14.6-11.7 24-29.7 24-50c0-4.5-.5-8.8-1.3-13c15.4-11.7 25.3-30.2 25.3-51c0-6.5-1-12.8-2.8-18.7C504.8 273.7 512 257.7 512 240c0-35.3-28.6-64-64-64l-92.3 0c4.7-10.4 8.7-21.2 11.8-32.2l5.7-20c10.9-38.2-11.2-78.1-49.4-89zM32 192c-17.7 0-32 14.3-32 32V448c0 17.7 14.3 32 32 32H96c17.7 0 32-14.3 32-32V224c0-17.7-14.3-32-32-32H32z"/></svg>                                     
                                                    <span>Thích</span>
                                                </div>
                                                
                                                <div class="people-time">
                                                    10 phút trước
                                                </div>
                                            </div> 
                                        </div>
                                    </div>
                                </div>

                                <!-- Khung bình luận -->
                                <div class="box-comment">
                                    <form action="">
                                        <textarea name="" id="" cols="30" rows="10"></textarea>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" placeholder="Họ và tên" required>
                                            <input type="text" class="form-control" placeholder="Số điện thoại" required>
                                            <button type="submit">Gửi</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="product-detail-rate-inner">
                                <!-- comment chính -->
                                <div class="comment-main">
                                    <div class="product-detail-rate-item">
                                        <div class="product-detail-rate-avata">
                                            <img src="<?php echo $urlThemeActive;?>asset/image/cute-1-300x300.png" alt="">
                                        </div>
                    
                                        <div class="product-detail-rate-right">
                                            <div class="product-detail-rate-heading">
                                                <div class="product-detail-rate-name">
                                                    Nguyễn Thùy Trang
                                                </div>
                                            </div>

                                            <div class="product-detail-rate-comment">
                                                Sản phẩm dùng ok, dáng đẹp nhé
                                            </div>  

                                            <div class="product-detail-rate-like" >
                                                <div class="people-comment">
                                                    <span>Trả lời</span>
                                                </div>

                                                <div class="people-like">
                                                    <svg onclick="changeColorRate()" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M323.8 34.8c-38.2-10.9-78.1 11.2-89 49.4l-5.7 20c-3.7 13-10.4 25-19.5 35l-51.3 56.4c-8.9 9.8-8.2 25 1.6 33.9s25 8.2 33.9-1.6l51.3-56.4c14.1-15.5 24.4-34 30.1-54.1l5.7-20c3.6-12.7 16.9-20.1 29.7-16.5s20.1 16.9 16.5 29.7l-5.7 20c-5.7 19.9-14.7 38.7-26.6 55.5c-5.2 7.3-5.8 16.9-1.7 24.9s12.3 13 21.3 13L448 224c8.8 0 16 7.2 16 16c0 6.8-4.3 12.7-10.4 15c-7.4 2.8-13 9-14.9 16.7s.1 15.8 5.3 21.7c2.5 2.8 4 6.5 4 10.6c0 7.8-5.6 14.3-13 15.7c-8.2 1.6-15.1 7.3-18 15.1s-1.6 16.7 3.6 23.3c2.1 2.7 3.4 6.1 3.4 9.9c0 6.7-4.2 12.6-10.2 14.9c-11.5 4.5-17.7 16.9-14.4 28.8c.4 1.3 .6 2.8 .6 4.3c0 8.8-7.2 16-16 16H286.5c-12.6 0-25-3.7-35.5-10.7l-61.7-41.1c-11-7.4-25.9-4.4-33.3 6.7s-4.4 25.9 6.7 33.3l61.7 41.1c18.4 12.3 40 18.8 62.1 18.8H384c34.7 0 62.9-27.6 64-62c14.6-11.7 24-29.7 24-50c0-4.5-.5-8.8-1.3-13c15.4-11.7 25.3-30.2 25.3-51c0-6.5-1-12.8-2.8-18.7C504.8 273.7 512 257.7 512 240c0-35.3-28.6-64-64-64l-92.3 0c4.7-10.4 8.7-21.2 11.8-32.2l5.7-20c10.9-38.2-11.2-78.1-49.4-89zM32 192c-17.7 0-32 14.3-32 32V448c0 17.7 14.3 32 32 32H96c17.7 0 32-14.3 32-32V224c0-17.7-14.3-32-32-32H32z"/></svg>                                     
                                                    <span>Thích</span>
                                                </div>

                                                <div class="people-time">
                                                    10 phút trước
                                                </div>
                                            </div> 

                                        </div>
                                    </div>
                                </div>

                                <!-- Comment phụ -->
                                <div class="comment-extra">
                                    <div class="product-detail-rate-item">
                                        <div class="product-detail-rate-avata">
                                            <img src="<?php echo $urlThemeActive;?>asset/image/cute-1-300x300.png" alt="">
                                        </div>
                    
                                        <div class="product-detail-rate-right">
                                            <div class="product-detail-rate-heading">
                                                <div class="product-detail-rate-name">
                                                    Nguyễn Thùy Trang
                                                </div>
                                            </div>

                                            <div class="product-detail-rate-comment">
                                                Sản phẩm dùng ok, dáng đẹp nhé
                                            </div>  

                                            <div class="product-detail-rate-like" >
                                                <div class="people-comment">
                                                    <span>Trả lời</span>
                                                </div>

                                                <div class="people-like">
                                                    <svg onclick="changeColorRate()" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M323.8 34.8c-38.2-10.9-78.1 11.2-89 49.4l-5.7 20c-3.7 13-10.4 25-19.5 35l-51.3 56.4c-8.9 9.8-8.2 25 1.6 33.9s25 8.2 33.9-1.6l51.3-56.4c14.1-15.5 24.4-34 30.1-54.1l5.7-20c3.6-12.7 16.9-20.1 29.7-16.5s20.1 16.9 16.5 29.7l-5.7 20c-5.7 19.9-14.7 38.7-26.6 55.5c-5.2 7.3-5.8 16.9-1.7 24.9s12.3 13 21.3 13L448 224c8.8 0 16 7.2 16 16c0 6.8-4.3 12.7-10.4 15c-7.4 2.8-13 9-14.9 16.7s.1 15.8 5.3 21.7c2.5 2.8 4 6.5 4 10.6c0 7.8-5.6 14.3-13 15.7c-8.2 1.6-15.1 7.3-18 15.1s-1.6 16.7 3.6 23.3c2.1 2.7 3.4 6.1 3.4 9.9c0 6.7-4.2 12.6-10.2 14.9c-11.5 4.5-17.7 16.9-14.4 28.8c.4 1.3 .6 2.8 .6 4.3c0 8.8-7.2 16-16 16H286.5c-12.6 0-25-3.7-35.5-10.7l-61.7-41.1c-11-7.4-25.9-4.4-33.3 6.7s-4.4 25.9 6.7 33.3l61.7 41.1c18.4 12.3 40 18.8 62.1 18.8H384c34.7 0 62.9-27.6 64-62c14.6-11.7 24-29.7 24-50c0-4.5-.5-8.8-1.3-13c15.4-11.7 25.3-30.2 25.3-51c0-6.5-1-12.8-2.8-18.7C504.8 273.7 512 257.7 512 240c0-35.3-28.6-64-64-64l-92.3 0c4.7-10.4 8.7-21.2 11.8-32.2l5.7-20c10.9-38.2-11.2-78.1-49.4-89zM32 192c-17.7 0-32 14.3-32 32V448c0 17.7 14.3 32 32 32H96c17.7 0 32-14.3 32-32V224c0-17.7-14.3-32-32-32H32z"/></svg>                                     
                                                    <span>Thích</span>
                                                </div>
                                                
                                                <div class="people-time">
                                                    10 phút trước
                                                </div>
                                            </div> 
                                        </div>
                                    </div>
                                </div>

                                <!-- Khung bình luận -->
                                <div class="box-comment">
                                    <form action="">
                                        <textarea name="" id="" cols="30" rows="10"></textarea>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" placeholder="Họ và tên" required>
                                            <input type="text" class="form-control" placeholder="Số điện thoại" required>
                                            <button type="submit">Gửi</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="product-detail-comment-right col-4">
                            <div class="product-detail-comment-right-title">
                                <p>Gửi thảo luận</p>
                            </div>

                            <div class="product-detail-comment-right-title">
                                <p>Nhanh tay chia sẻ với cộng đồng những cảm nhận của bạn về sản phẩm này</p>
                            </div>

                            <div class="product-detail-rate-comment">
                                <form action="">
                                    <div class="product-detail-rate-comment-avata">
                                        <img src="<?php echo $urlThemeActive;?>asset/image/cute-1-300x300.png" alt="">
                                        <input type="text" class="form-control" id="" aria-describedby="emailHelp" placeholder="Mời bạn nhập bình luận">
                                    </div>

                                    <div class="mb-3">
                                        <input type="text" class="form-control" id="" placeholder="Họ và tên">
                                    </div>
                                    <div class="mb-3">
                                        <input type="text" class="form-control" id="" placeholder="Số điện thoại">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Gửi</button>



                                    

                                </form>
                            </div>
                            

                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </main>

<?php
getFooter();?>