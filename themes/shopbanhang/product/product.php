    <?php
getHeader();
global $urlThemeActive;
global $session;
$infoUser = $session->read('infoUser');     
$setting = setting();

$list_product = (!empty($session->read('product_order')))?$session->read('product_order'):[];

$slide_home= slide_home($setting['id_slide']);

?>

<style>
    .menu-mobile{
        display: none
    }
</style>

<link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
        
<main>
        <section id="section-breadcrumb">
            <div class="breadcrumb-center">
                <ul class="breadcrumb breadcrumb-none">
                  <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                  <li class="breadcrumb-item"><a href="/allProduct">Sản phẩm </a></li>
                  <li class="breadcrumb-item active"><?php echo $product->title; ?></li>
               		</ul>
            </div>
        </section>

        <section id="section-product-detail">
            <div class="container">
                <div class="row">
                    <div class="col-lg-1 col-3 product-detail-slide-small">
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

                    <div class="col-lg-6 col-9 product-detail-slide">
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

                    <div class="col-lg-5 col-md-5 col-sm-5 col-12 product-detail-info">
                        <div class="product-detail-info-category">
                            <?php  $category_name = '';
                if(!empty($product->category)){
                  foreach($product->category as $value){
                     if(!empty($value->name_category)){
                      $category_name .= $value->name_category.', ';
                     }
                  }
                } ?>
                            <span><?php echo @$category_name; ?></span>
                        </div>
                        <div class="product-detail-info-name">
                            <span><?php echo $product->title; ?></span>
                        </div>

                        <div class="product-detail-info-rate">
                            <div class="detail-info-rate-left">
                                <?php $point = 100 - ($product->point/5) / 1 * 100 ?>
                                <div class="stars" style="color: gold;">
                                        <i class='bx bxs-star'></i>
                                        <i class='bx bxs-star'></i>
                                        <i class='bx bxs-star'></i>
                                        <i class='bx bxs-star'></i>
                                        <i class='bx bxs-star'></i>
                                        <div class="overlay" style="width: <?php echo $point ?>%"></div>

                                    </div>   

                                <div class="rate-left-text">
                                    <?php if(!empty($product->point) && !empty($product->evaluatecount)){ ?>
                                    <span><?php echo  number_format(@$product->point, 1) ?> (<?php echo $product->evaluatecount ?> đánh giá) | <?php echo $product->sold ?> đã bán</span>
                                <?php }else{ echo '<p><span>(0)</span></p>'; } ?>
                                </div>
                            </div>
                              
                            <div class="detail-info-rate-right">
                                <img src="<?php echo $urlThemeActive;?>asset/image/heart.png" alt="">
                                <span><span id="number_like"><?php echo $product->number_like ?></span> + yêu thích</span>
                            </div>
                            
                        </div>
                        <?php if($product->flash_sale==1){ ?>
                        <div class="product-detail-info-flash" id="info_flash">
                            <div class="product-info-flash-title">
                                Flash sale
                            </div>

                            <div class="product-detail-info-flash-number">
                                <p>Kết thúc trong</p>
                                <div class="time-flash-sale" id="countdown">
                                    
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                        <div class="product-detail-info-price">
                            <div class="product-detail-info-price-left">
                                <div class="price-left-real">
                                    <p><?php echo number_format($product->price); ?>đ</p>
                                </div>

                                <div class="price-left-sale">
                                    <del><?php if($product->price_old>$product->price){  echo number_format($product->price_old); ?>đ
                                     <?php } ?></del>
                                </div>
                            </div>

                            <div class="product-detail-info-price-right">
                                <?php if($product->price_old>$product->price){ ?>
                                <span>(Bạn đã tích kiệm  <?php echo number_format($product->price_old-$product->price); ?>đ)</span>
                            <?php } ?>
                            </div>
                        </div>

                        <!-- Mã giảm giá -->
                        <div class="product-detail-code-discount">
                            <div class="product-info-detail-title">
                                <p>Mã giảm giá</p>
                            </div>

                            <div class="product-code-discount-list">
                                <?php if(!empty($product->discountCode)){
                                   foreach($product->discountCode as $key => $item){
                                 ?>
                                <div class="product-code-discount-item">
                                    <?php echo $item->code; ?>
                                </div>
                                <?php }} ?>
                               
                            </div>

                            
                        </div>

                        <!-- Quà tặng -->
                        <div class="product-detail-gift">
                            <div class="product-info-detail-title">
                                <p>Quà tặng</p>
                            </div>

                            <div class="product-detail-gift-list">
                                <?php if(!empty($product->present)){
                                    foreach($product->present as $item){
                                 ?>
                                <div class="product-detail-gift-item">
                                    <a href="product/<?php echo $item->slug ?>.html">
                                        <div class="gift-item-inner">
                                            <div class="gift-item-img">
                                                <img src="<?php echo $item->image ?>" alt="">
                                            </div>
                                            <div class="gift-item-name">
                                                <span><?php echo $item->title ?></span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            <?php }} ?>
                            </div>
                        </div>

                          <!-- F & A -->
                        <div class="product-detail-fa">
                            <div class="product-info-detail-title">
                                <p>FAQ</p>
                            </div>

                            <div class="product-detail-fa-list">
                                <div class="accordion accordion-questionTop" id="accordionquestionTopExample">
                                    <?php if(!empty($product->question)){
                                        foreach($product->question as $key => $item){
                                     ?>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="questionTop-heading<?php echo $key; ?>">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#questionTop-collapse<?php echo $key; ?>" aria-expanded="false" aria-controls="questionTop-collapse<?php echo $key; ?>">
                                            <?php echo $item->question; ?>                                    
                                            </button>
                                        </h2>
                                        <div id="questionTop-collapse<?php echo $key; ?>" class="accordion-collapse collapse" aria-labelledby="questionTop-heading<?php echo $key; ?>" data-bs-parent="#accordionquestionTopExample">
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
                                        <strong>Miễn phí </strong>giao hàng <br> đơn hàng từ 1 triệu 
                                    </div>
                                </div>

                                <div class="roduct-detail-policy-item">
                                    <div class="policy-item-image">
                                        <img src="<?php echo $urlThemeActive;?>asset/image/fastclock.jpg" alt="">
                                    </div>
                                    <div class="policy-item-text">
                                        <strong>Giao hàng nhanh chóng</strong> <br> toàn quốc
                                    </div>
                                </div>

                                <div class="roduct-detail-policy-item">
                                    <div class="policy-item-image">
                                        <img src="<?php echo $urlThemeActive;?>asset/image/policy3.png" alt="">
                                    </div>
                                    <div class="policy-item-text">
                                        <strong>Bảo hành 6 tháng </strong>
                                        <br>
                                        <!-- <span>30 ngày 1 đổi 1 tại nhà</span> -->
                                    </div>
                                </div>

                                <div class="roduct-detail-policy-item">
                                    <div class="policy-item-image">
                                        <img src="<?php echo $urlThemeActive;?>asset/image/policy4.png" alt="">
                                    </div>
                                    <div class="policy-item-text">
                                        <strong>Hỗ trợ đổi mới</strong> 
                                        <br>
                                        <span>
                                            Hỗ trợ 1 đổi 1 trong vòng <br> 7 ngày nếu có lỗi NSX
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
                                    <button onclick="minusQuantity()" class="qty-count-minus" data-action="minus" type="button">-</button>
                                    <input id="quantity_buy" class="product-qty" type="text" name="quantity_buy" value="1" min="0">
                                    <button onclick="plusQuantity()" class="qty-count-add" data-action="add" type="button">+</button>
                                </div>
                            </div>
                        </div>

                        <!-- Button cuối -->
                        <div class="product-detail-group-button">
                            
                                 <?php
                                 if(@$product->quantity>0){

                                        ?>
                            <div class="product-detail-button-cart">
                                <a onclick="addProductCart(<?php echo $product->id;?>,'false')"><img src="<?php echo $urlThemeActive;?>asset/image/cartdetail.png" alt=""> Thêm vào giỏ hàng</a>
                            </div>

                            <div class="product-detail-button-buy">
                                <a onclick="addProductCart(<?php echo $product->id;?>,'true')">Mua ngay</a>
                            </div>
                        <?php }else{?>
                             <div class="product-detail-button-cart">
                                <a data-bs-toggle="modal" data-bs-target="#">Hết hàng</a>
                            </div>
                      <?php  } ?>
                            <div class="product-detail-button-like" id="place-detail" >
                                  <?php  
                                     global $session;
                                 $infoUser = $session->read('infoUser');
                                    if(!empty($infoUser)){
                                ?>
                            <div class="button-like" id="addlike">
                                <button type="button" onclick="addlike()"><img src="<?php echo $urlThemeActive;?>asset/image/iconempty.png" alt=""></button>
                            </div>
                                
                            <div class="button-like" id="delelelike">
                                <button type="button" onclick="delelelike()"><img src="<?php echo $urlThemeActive;?>asset/image/heart.png" alt=""></button>
                            </div>
                           
                                <?php   }else{ ?>
                                     <div class="button-like">
                                        <a  class="like" data-bs-toggle="modal" data-bs-target="#exampleModal" ><button type="button" ><img src="<?php echo $urlThemeActive;?>asset/image/iconempty.png" alt=""></button></a>
                                        </div>
                                <?php   } ?>
                            </div>
                        </div>



                        <!-- Đặt hàng mobile -->
                        <section class="product-detail-group-mobile" id="product-cart-mobile-footer">
                            <div class="product-detail-like-mobile"  id="place-mobile">
                                  <?php  
                                     global $session;
                                 $infoUser = $session->read('infoUser');
                                    if(!empty($infoUser)){
                                ?>
                                <div class="button-like" id="addlikemobile">
                                    
                                    <button type="button" onclick="addlike()"><img src="<?php echo $urlThemeActive;?>asset/image/iconempty.png" alt=""></button>
                                    <p >Yêu thích</p>
                                </div>
                                <div class="button-like" id="delelelikemobile">
                                    <button type="button" onclick="delelelike()"><img src="<?php echo $urlThemeActive;?>asset/image/heart.png" alt=""><p >Yêu thích</p></button>
                                </div>
                                 <?php   }else{ ?>
                                     <div class="button-like">
                                        <a  class="like like-notlogin" data-bs-toggle="modal" data-bs-target="#exampleModal" ><button class="button-not-login" type="button" ><img src="<?php echo $urlThemeActive;?>asset/image/iconempty.png" alt=""></button>Yêu thích</a>
                                        </div>
                                <?php   } ?>
                            </div>

                            <div class="product-add-cart-mobile">
                                <a onclick="addProductCart(<?php echo $product->id;?>,'false')"><img src="<?php echo $urlThemeActive;?>asset/image/cartdetail.png" alt=""></a>
                                <p onclick="addProductCart(<?php echo $product->id;?>,'false')">Thêm giỏ hàng</p>
                            </div>

                            <div class="product-buy-mobile">
                                <a onclick="addProductCart(<?php echo $product->id;?>,'true')">Mua ngay</a>
                            </div>
                        </section>


                        <!--  -->
                    </div>
                </div>
            </div>
         
            <!-- Xác nhận thêm giỏ hàng -->

            

            <div class="box-confirm-cart" id="myElement" style=" display: none; ">
                <div class="box-confirm-cart-title">
                    <p>Đã thêm vào giỏ hàng</p>
                    <div class="close-button">
                        <i class="fa-solid fa-xmark"></i>
                    </div>
                </div>

                <div class="box-confirm-cart-detail">
                    <div class="box-confirm-cart-top">
                        <div class="box-confirm-cart-image">
                            <img src="<?php echo $product->image;?>" alt="">
                        </div>

                        <div class="box-confirm-cart-detail-box">
                            <div class="box-confirm-cart-detail-name">
                                <?php echo $product->title; ?>
                            </div>

                            <div class="box-confirm-cart-detail-price">
                                <div class="box-confirm-cart-price-real">
                                    <span><?php echo number_format($product->price); ?>đ</span>
                                </div>

                                <div class="box-confirm-cart-price-discount">
                                   <?php if(!empty($product->price_old)){ ?>
                                            <del><?php  echo number_format($product->price_old); ?>đ</del><!-- <span> (50%)</span> -->
                                            <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="box-confirm-cart-bottom">
                        <a href="/gio-hang">Xem giỏ hàng</a>
                    </div>
                </div>
            </div>
      
        
            <div class="box-confirm-cart box-confirm-like" id="myLikeNoti"  style=" display: none; ">
                <div class="box-confirm-cart-title confirm-like">
                    <p>Đã thêm danh sách yêu thích</p>
                    <div class="close-button">
                        <i class="fa-solid fa-xmark"></i>
                    </div>
                </div>
            </div>

            <div class="box-confirm-cart box-confirm-like" id="myLike"  style=" display: none; ">
                <div class="box-confirm-cart-title confirm-like">
                    <p>Đã bỏ danh sách yêu thích</p>
                    <div class="close-button">
                        <i class="fa-solid fa-xmark"></i>
                    </div>
                </div>
            </div>

            <div class="box-confirm-cart box-confirm-like" id="myComment"  style=" display: none; ">
                <div class="box-confirm-cart-title confirm-like">
                    <p>Cảm ơn bạn đã gửi bình luận, bình luận của bạn đang chờ duyệt</p>
                    <div class="close-button">
                        <i class="fa-solid fa-xmark"></i>
                    </div>
                </div>
            </div>
        </section>

        <section id="section-pro-review">
            <div class="container">
                <div class="section-pro-review-inner">
                    <div class="title-section mt-5">
                        <p>Chuyên gia đánh giá sản phẩm</p>
                    </div>

                    <div class="pro-review-slide">
                        
                         <?php if(!empty($product->evaluate)){
                             	foreach($product->evaluate as $item) {
                             	if(!empty($item['image'])){
                            ?>
                        <div class="pro-review-item">
                            <div class="pro-review-img">
                               <a href="<?php echo $item['link'] ?>"><img src="<?php echo $item['image'] ?>" alt=""></a>
                                <div class="pro-review-link">
                                    <a href="<?php echo $item['link'] ?>"><img src="<?php echo $urlThemeActive ?>/asset/image/play.png" alt=""></a>
                                </div>
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
                    <div class="describe-description-filter">
                        <?php echo @$product->info; ?>
                    </div>
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
                            <div class="product-question-img">
                                <img src="<?php echo $urlThemeActive ?>asset/image/detailproductfaq.png" alt="">
                            </div>
                        </div>
            
                        <div class="col-lg-6 col-12 product-question-right">
                            <div class="title-question-right">
                                <p>Câu Hỏi Thường Gặp</p>
                            </div>

                            <div class="list-product-question">
                                <div class="accordion accordion-questionBottom" id="accordionquestionBottomExample">
                                     <?php if(!empty($product->question0)){
                                        foreach($product->question0 as $key => $item){
                                     ?>  
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="questionBottom-heading<?php echo $key ?>">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#questionBottom-collapse<?php echo $key ?>" aria-expanded="false" aria-controls="questionBottom-collapse<?php echo $key ?>">
                                            <?php echo $item->question ?>                              
                                            </button>
                                        </h2>
                                        <div id="questionBottom-collapse<?php echo $key ?>" class="accordion-collapse collapse" aria-labelledby="questionBottom-heading<?php echo $key ?>" data-bs-parent="#accordionquestionBottomExample">
                                            <div class="accordion-body"><?php echo nl2br($item->answer) ?></div>
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
                            foreach($other_product as $item) {
                                    $link = '/san-pham/'.$item->slug.'.html';
                                     $giam = 0;
                                    if(!empty($item->price_old) && !empty($item->price)){
                                        $giam = 100 - 100* @$item->price/@$item->price_old;
                                    }

                                    $ban = 0;
                                    if(!empty($item->quantity) && !empty($item->sold)){
                                        if($item->quantity>$item->sold){
                                            $ban = 100*$item->sold/$item->quantity;
                                        }
                                    }
                            ?>
                        <div class="product-item">
                            <div class="product-item-inner">
                                 <?php if($giam>0){ ?>
                                        <div class="ribbon ribbon-top-right"><span><?php echo number_format($giam) ?>%</span></div>
                                    <?php } ?>
                                <div class="product-img">
                                    <a href="<?php echo $link ?>"><img src="<?php echo $item->image ?>" alt=""></a>
                                </div>
    
                                <div class="product-info">
                                    <div class="product-name">
                                        <a href="<?php echo $link ?>"><?php echo $item->title ?></a>
                                    </div>
    
                                    <div class="product-price">
                                        <p><?php echo number_format($item->price) ?></p>
                                    </div>
    
                                    <div class="product-discount">
                                        <?php if(!empty($item->price_old)){ ?>
                                            <del><?php  echo number_format($item->price_old); ?>đ</del><!-- <span> (50%)</span> -->
                                            <?php }else{ echo '&nbsp;';} ?>
                                    </div>
                                </div>
    
                                <div class="progress-box">
                                    <div class="product-progress">
                                        <div class="text-progress">Sản phẩm <?php echo $item->sold; ?> Đã bán</div>
                                        <div class="sale-progress-val" style="width: <?php echo $ban; ?>%"></div>
                                    </div>
                                </div>
    
                                <div class="product-rate">
                                    <div class="rate-best-item rate-star">
                                        <img src="<?php echo $urlThemeActive;?>asset/image/star.png" alt="">
                                         <p><?php echo @$item->point ?><span>(<?php echo @$item->evaluatecount ?>)</span></p>
                                    </div>
    
                                    <div class="rate-best-item rate-sold">
                                        <p><?php echo $item->sold; ?> Đã bán</p>
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
                        <div class="product-detail-rate-list col-lg-7 col-md-7 col-sm-7 col-12" id="evaluate">
                           <?php 
                           $images = array();
                           if(!empty($product->evaluates)){

                                foreach($product->evaluates as $key => $item){ 
                                     $item->image = json_decode($item->image, true);
                                    ?>
                            <div class="product-detail-rate-item">
                                <div class="product-detail-rate-avata">
                                    <img src="<?php echo @$item->avatar ?>" alt="">
                                </div>
            
                                <div class="product-detail-rate-right">
                                    <div class="product-detail-rate-heading">
                                        <div class="product-detail-rate-name">
                                           <?php echo @$item->full_name ?>
                                        </div>
            
                                        <div class="product-detail-rate-date">
                                            <?php if(!empty(@$item->created_at)){ echo date('H:i d/m/Y', strtotime(@$item->created_at));} ?>
                                        </div>
                                    </div>
            
                                    <div class="product-detail-rate-star">
                                        <?php $itempoint =100- ($item->point/5) / 1 * 100 ?>
                                        <div class="stars" style="color: gold; width: 95px;">
                                            <i class='bx bxs-star'></i>
                                            <i class='bx bxs-star'></i>
                                            <i class='bx bxs-star'></i>
                                            <i class='bx bxs-star'></i>
                                            <i class='bx bxs-star'></i>
                                            <div class="overlay" style="width: <?php echo $itempoint ?>%"></div>
                                        </div>  
                                    </div>  
            
                                    <div class="product-detail-rate-comment">
                                        <?php echo @$item->content ?>
                                    </div>  
            
                                    <div class="product-detail-rate-image">
                                        <?php if(!empty($item->image)){
                                            foreach($item->image as $k => $image) {
                                            if(!empty($image)){
                                                $images[] = $image;
                                        ?>
                                        <a href="" data-bs-toggle="modal" data-bs-target="#exampleModal<?php  echo $key.'-'.$k; ?>"><img src="<?php echo $image;?>" alt=""></a>

                                         <div class="modal-login">
                                             <div class="modal fade" id="exampleModal<?php  echo $key.'-'.$k; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                   
                                                       <img src="<?php echo $image;?>" alt="" style="width: 100%; height: auto;">
                                                    
                                                </div>
                                            </div>
                                         </div>
                                    <?php }}} ?>
                                    </div> 

                                    
                                </div>
                            </div>
                        <?php }}else{ ?>
                           <div class="no_evaluate"><h5>Sản phẩm chưa có đánh giá nào </h5></div>
                           <?php } ?>
                        </div>
                        <?php  if(!empty($product->evaluates)){ ?>
                        <div class="product-detail-rate-right col-lg-5 col-md-5 col-sm-5 col-12">
                            <div class="flex-rate">
                                <div class="product-detail-rate-right-title">
                                    Đánh giá sản phẩm
                                </div>

                                <div class="product-detail-rate-right-point">
                                    <div class="product-detail-rate-right-number">
                                    <?php if(!empty($product->point)){ echo  number_format(@$product->point, 1);} ?>
                                    </div>

                                    <div class="product-detail-rate-right-star">
                                        <div class="stars" style="color: gold;">
                                            <i class='bx bxs-star'></i>
                                            <i class='bx bxs-star'></i>
                                            <i class='bx bxs-star'></i>
                                            <i class='bx bxs-star'></i>
                                            <i class='bx bxs-star'></i>
                                            <div class="overlay" style="width: <?php echo $point ?>%"></div>

                                        </div> 

                                        <div class="product-detail-rate-count">
                                        <?php echo $product->evaluatecount ?> Đánh giá
                                        </div>
                                    </div>
                                </div>

                                <div class="list-filter-rate-list">
                                    <div class="list-filter-rate-item">
                                        <a onclick="searchEvaluates()">Tất cả</a>
                                    </div>

                                    <div class="list-filter-rate-item">
                                        <a onclick=" searchEvaluates(5)">5 sao</a>
                                    </div>

                                    <div class="list-filter-rate-item">
                                        <a onclick=" searchEvaluates(4)">4 sao</a>
                                    </div>

                                    <div class="list-filter-rate-item">
                                        <a onclick=" searchEvaluates(3)">3 sao</a>
                                    </div>

                                    <div class="list-filter-rate-item">
                                        <a onclick=" searchEvaluates(2)">2 sao</a>
                                    </div>

                                    <div class="list-filter-rate-item">
                                        <a onclick=" searchEvaluates(1)">1 sao</a>
                                    </div>

                                    <div class="list-filter-rate-item">
                                        <a onclick=" searchEvaluates()">Có hình ảnh/video</a>
                                    </div>
                                </div>

                                <div class="rate-image-right">
                                    <div class="rate-image-title">
                                        Hình ảnh từ người dùng
                                    </div>
                                    <div class="list-rate-image">
                                        <?php if(!empty($images)){

                                        foreach($images as $k => $item) { ?>
                                        <div class="rate-image-item">
                                            <a href="" data-bs-toggle="modal" data-bs-target="#example<?php  echo $k; ?>">
                                            <img src="<?php echo $item ?>" alt="">
                                            </a>

                                            <div class="modal-login">
                                             <div class="modal fade" id="example<?php  echo $k; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                   
                                                       <img src="<?php echo $item ?>" alt="" style="width: 100%; height: auto;">
                                                    
                                                </div>
                                            </div>
                                         </div>
                                        </div>
                                        <?php }} ?>
                                       
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <?php } ?>
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
                        <div class="product-detail-rate-list col-lg-8 col-12">
                            <div class="product-detail-rate-inner">
                                <!-- comment chính -->
                                <?php  $comment= getComment($product->id,'product'); 
        if(!empty($comment)){ 
                    foreach($comment as $key => $value){
                   //     debug($value);
                    $custom =  getCustomer($value->idcustomer);
                
                     if(!empty($custom)){
                ?>
                                <div class="comment-main">
                                    <div class="product-detail-rate-item">
                                        <div class="product-detail-rate-avata">
                                            <img src="<?php echo $custom->avatar ?>" alt="">
                                        </div>
                    
                                        <div class="product-detail-rate-right">
                                            <div class="product-detail-rate-heading">
                                                <div class="product-detail-rate-name">
                                                    <?php echo $custom->full_name ?>
                                                </div>
                                            </div>

                                            <div class="product-detail-rate-comment">
                                                <?php echo $value->comment ?>
                                            </div>  

                                            <div class="product-detail-rate-like" >
                                                <div class="people-comment">
                                                    <span>Trả lời</span>
                                                </div>

                                                <div class="people-like" id="like_comment">
                                                    
                                                    <?php  
                                     global $session;
                                 $infoUser = $session->read('infoUser');
                                    if(!empty($infoUser)){
                                if(empty(getLike($infoUser['id'],$value->id,'comment'))){?>
                            <div class="button-like<?php echo $value->id ?>">
                                <button type="button" onclick="addlikecomment(<?php echo $value->id ?>, 'comment')"><i class='bx bxs-like'></i>                                     
                                                    <span>Thích</span></button>
                            </div>
                                <?php }else{
                                  
                                 ?>
                                    <div class="button-like<?php echo $value->id ?>">

                                <button type="button" onclick="delelelikecomment(<?php echo $value->id ?>, 'comment')" style="background-color: rgb(24, 129, 129); color: rgb(255, 255, 255);"><i class='bx bxs-like'></i>                                     
                                                    <span>Thích</span></button><?php echo $value->number_like ?>
                            </div>
                           
                                <?php }  }else{ ?>
                                     <div class="button-like<?php echo $value->id ?>">
                                        <a  class="like"  data-bs-toggle="modal" data-bs-target="#exampleModal"><button type="button" ><i class='bx bxs-like'></i>                                     
                                                    <span>Thích</span></a>
                                        </div>
                                <?php   } ?>
                                                </div>

                                                <div class="people-time">
                                                    <?php echo date("d/m/Y H:i:s",$value->created); ?>
                                                </div>
                                            </div> 

                                        </div>
                                    </div>
                                </div>
                         <?php if(!empty($value->reply)){ ?>
                                <!-- Comment phụ -->
                                <div class="comment-extra">
                                    <div class="product-detail-rate-item">
                                        <div class="product-detail-rate-avata">
                                            <img src="<?php echo $urlThemeActive ?>asset/image/logo.png" alt="">
                                        </div>
                    
                                        <div class="product-detail-rate-right">
                                            <div class="product-detail-rate-heading">
                                                <div class="product-detail-rate-name">
                                                    Bumas
                                                </div>
                                            </div>

                                            <div class="product-detail-rate-comment">
                                                <?php echo @$value->reply ?>
                                            </div>  

                                            <div class="product-detail-rate-like" >
                                                <div class="people-comment">
                                                    <span>Trả lời</span>
                                                </div>

                                             
                                                
                                                <div class="people-time">
                                                   <?php echo date("d/m/Y H:i:s",$value->updated_at); ?>
                                                </div>
                                            </div> 
                                        </div>
                                    </div>
                                </div> 
<?php }} }}else{ ?>
                           <div class="no_evaluate"><h5>Sản phẩm chưa có bình luận nào </h5></div>
                           <?php } ?>
                          
                            </div>

                        </div>
                           <?php  
                                    if(!empty($infoUser)){
                                        ?>
                        <div class="product-detail-comment-right col-lg-4 col-12">
                            <div class="product-detail-comment-right-title">
                                <p>Gửi thảo luận</p>
                            </div>

                            <div class="product-detail-comment-right-title small-text">
                                <p>Chia sẻ cảm nhận hoặc thắc mắc của bạn về sản phẩm này</p>
                            </div>

                            <div class="product-detail-rate-comment">
                               
                                    <div class="product-detail-rate-comment-avata">
                                        <img src="<?php echo $infoUser['avatar'] ?>" alt="">
                                        <input type="text" class="form-control"name="comment" id="comment"  aria-describedby="emailHelp" placeholder="Mời bạn nhập bình luận">
                                    </div>

                                    <button type="submit" class="btn btn-primary"  onclick="addComment()">Gửi</button>
                               
                            </div>
                            

                        </div> 
                    <?php }else{?>
                        <div class="product-detail-comment-right col-lg-4 col-12">
                            <div class="product-detail-comment-right-title">
                                <p>Gửi thảo luận</p>
                            </div>

                            <div class="product-detail-comment-right-title small-text">
                                <p>Chia sẻ cảm nhận hoặc thắc mắc của bạn về sản phẩm này</p>
                            </div>

                            <div class="product-detail-rate-comment">
                                <form action="">
                                    <div class="product-detail-rate-comment-avata">
                                        <img src="<?php echo $urlThemeActive ?>asset/image/user-placeholder.png" alt="">
                                        <input type="text" class="form-control"name="comment" id="comment"  aria-describedby="emailHelp" placeholder="Mời bạn nhập bình luận">
                                    </div>

                                    <button type="button" class="send-no btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Gửi</button>
                                </form>
                            </div>
                        </div> 
                       <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        
    </main>
<script type="text/javascript">
$(document).ready(function() {
   <?php     if(!empty($infoUser)){
         if(empty(getLike($infoUser['id'],$product->id,'product'))){ ?>
        $('#delelelike').remove();
        $('#addlike').show();

        $('#delelelikemobile').remove();
        $('#addlikemobile').show();
    <?php }else{ ?>
        $('#addlike').remove();
        $('#delelelike').show();

        $('#addlikemobile').remove();
        $('#delelelikemobile').show();
   <?php }} ?>
});
</script>
<script>
    function updateCountdown() {
      // Thời gian bạn muốn đếm ngược đến (ví dụ: 2023-12-31 23:59:59)
     
      <?php if(!empty(@$setting['targetTime'])){?>
        const targetTime = new Date("<?php echo date('Y-m-d H:i:s' , @$setting['targetTime']) ?>").getTime();

    <?php }else{?>
     const targetTime = 0;
     <?php } ?>

      // Lấy thời gian hiện tại
      const currentTime = new Date().getTime();

      // Tính thời gian còn lại
      const timeLeft = targetTime - currentTime;

      if (timeLeft <= 0) {
         $("#info_flash").css('display', 'none');
      } else {
        const days = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
        const hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);
        var html = '';
        html +='                       <div class="time-flash-number">'
        html +='                           <p>'+String(days).padStart(2, '0')+'</p>'
        html +='                       </div>'
        html +='                       <div class="time-flash-number">'
        html +='                           <p>'+String(hours).padStart(2, '0')+'</p>'
        html +='                       </div>'
        html +='                       <div class="time-flash-number">'
        html +='                           <p>'+String(minutes).padStart(2, '0')+'</p>'
        html +='                       </div>'
        html +='                       <div class="time-flash-number">'
        html +='                           <p>'+String(seconds).padStart(2, '0')+'</p>'
        html +='                       </div>'


        document.getElementById("countdown").innerHTML = html;
        //document.getElementById("countdown").innerHTML = `Còn lại:  ngày, ${hours} giờ, ${minutes} phút, ${seconds} giây`;
      }
    }



    // Cập nhật thời gian còn lại mỗi giây
    setInterval(updateCountdown, 1000);

    // Gọi hàm cập nhật ngay khi trang được tải
    updateCountdown();
</script>
<script  type="text/javascript">
function addlike(){
    $.ajax({
            method: 'POST',
            url: '/apis/addlike',
            data: { idobject: '<?php echo @$product->id; ?>',
                type: 'product',
                idcustomer: <?php echo @$infoUser['id'] ?>,
            },
            success:function(res){
                console.log(res);
                var html = '';
                document.getElementById("myLikeNoti").style.display = 'block';
                document.getElementById("myLike").style.display = 'none';
                
                    html= '<div class="button-like" id="delelelike"><button type="button" onclick="delelelike()"><img src="<?php echo $urlThemeActive;?>asset/image/heart.png" alt=""></button></div>';
                    htmlmobile= '<div class="button-like" id="delelelikemobile"><button type="button" onclick="delelelike()"><img src="<?php echo $urlThemeActive;?>asset/image/heart.png" alt=""><p >Yêu thích</p></button></div>';
                $('#addlike').remove();
                $('#addlikemobile').remove();

                  document.getElementById("place-detail").innerHTML = html;
                  document.getElementById("place-mobile").innerHTML = htmlmobile;

                  document.getElementById("number_like").innerHTML = res.number_like;

                   // Lấy tham chiếu đến phần tử cần thay đổi CSS
                var myElement = document.getElementById('myLikeNoti');

                // Hàm thay đổi CSS
                function changeCSS() {
                    myElement.style.display = 'none';
                }

                // Đặt hẹn giờ để thực hiện thay đổi sau 10 giây
                setTimeout(changeCSS, 3000);

                 // location.reload();
            }
        })
            
}
function delelelike(){

          $.ajax({
                method: 'POST',
                url: '/apis/delelelike',
                data: { idobject: '<?php echo @$product->id; ?>',
                    type: 'product',
                    idcustomer: <?php echo @$infoUser['id'] ?>,
                },
                success:function(res){
                    console.log(res);myLike
                    document.getElementById("myLike").style.display = 'block';
                    document.getElementById("myLikeNoti").style.display = 'none';

                    html= '<div class="button-like" id="addlikemobile"><button type="button" onclick="addlike()"><img src="<?php echo $urlThemeActive;?>asset/image/iconempty.png" alt=""></button></div>'
                    htmlmobile= '<div class="button-like" id="addlikemobile"><button type="button" onclick="addlike()"><img src="<?php echo $urlThemeActive;?>asset/image/iconempty.png" alt=""></button><p >Yêu thích</p></div>'
                $('#delelelike').remove();
                $('#delelelikemobile').remove();

                  document.getElementById("place-detail").innerHTML = html;
                  document.getElementById("place-mobile").innerHTML = htmlmobile;

                  document.getElementById("number_like").innerHTML = res.number_like;

                  var myElement = document.getElementById('myLike');

                // Hàm thay đổi CSS
                function changeCSS() {
                    myElement.style.display = 'none';
                }

                // Đặt hẹn giờ để thực hiện thay đổi sau 10 giây
                setTimeout(changeCSS, 3000);
                }
            })
               
} 

function addlikecomment(idobject, comment){
    $.ajax({
            method: 'POST',
            url: '/apis/addlike',
            data: { idobject: idobject,
                type: comment,
                idcustomer: <?php echo @$infoUser['id'] ?>,
            },
            success:function(res){
              console.log(res);
                $('#like_save').load(location.href + ' #like_save>*');
                $('#like_comment .button-like'+idobject+' button').css('background-color', '#188181');
                $('#like_comment .button-like'+idobject+' button').css('color', '#fff')
                $('.button-like i').css('color', '#fff');
                 location.reload();
            }
        })
            
}
function  delelelikecomment(idobject, comment){

          $.ajax({
                method: 'POST',
                url: '/apis/delelelike',
                data: { idobject: idobject,
                    type: comment,
                    idcustomer: <?php echo @$infoUser['id'] ?>,
                },
                success:function(res){
                  console.log(res);
                    $('#like_save').load(location.href + ' #like_save>*');
                    $('#like_comment .button-like'+idobject+' button').css('background-color', 'rgb(24 129 129 / 0%)');
                    $('#like_comment .button-like'+idobject+' button').css('color', '#3F4042')
                    $('.button-like i').css('color', '#126B66');
                }
            })
               
} 

function addComment(){
    var comment= $('#comment').val();

    $.ajax({
                method: 'POST',
                url: '/apis/addComment',
                data: { idobject: '<?php echo @$product->id; ?>',
                    type: 'product',
                    comment: comment,
                    idcustomer: <?php echo @$infoUser['id'] ?>,
                },
                success:function(res){
                  console.log(res);
                   // location.reload();
                   
                   document.getElementById("myComment").style.display = 'block';
                   var myElement = document.getElementById('myComment');

                // Hàm thay đổi CSS
                function changeCSS() {
                    myElement.style.display = 'none';
                }

                // Đặt hẹn giờ để thực hiện thay đổi sau 10 giây
                setTimeout(changeCSS, 3000);
                }
            })
               
} 

function deteleComment($id){

    $.ajax({
                method: 'POST',
                url: '/apis/deleleComment',
                data: { id: $id },
                success:function(res){
                  console.log(res);
                  location.reload();
                }
            })
               
        }

function deteleComment($id){

    $.ajax({
                method: 'POST',
                url: '/apis/deleleComment',
                data: { id: $id },
                success:function(res){
                  console.log(res);
                  location.reload();
                }
            })
               
}
</script>
<script type="text/javascript">
    function searchEvaluates(point){
        console.log(point);
         $.ajax({
                method: 'POST',
                url: '/apis/searchEvaluateAPI',
                data: { id_product: <?php echo $product->id ?>, point: point },
                success:function(res){
                    console.log(res);
                    if(res.code==1){
                         var html = '';
                        for (i = 0; i < res.data.length; i++) {
                            var image = '';
                           var point = 100 - (res.data[i].point/5) / 1 * 100;
                           var originalDate = new Date(res.data[i].created_at);

                            // Lấy thông tin về ngày, tháng, năm và giờ, phút
                            var day = originalDate.getDate();
                            var month = originalDate.getMonth() + 1; // Tháng trong JavaScript đếm từ 0, nên cần cộng thêm 1
                            var year = originalDate.getFullYear();
                            var hour = originalDate.getHours();
                            var minute = originalDate.getMinutes();

                            // Tạo chuỗi mới với định dạng mong muốn
                            var date = `${hour}:${minute} ${day}/${month}/${year}`;

                            image = JSON.parse(res.data[i].image); 
                            html +=' <div class="product-detail-rate-item">'
                            html +='    <div class="product-detail-rate-avata">'
                            html +='        <img src="'+res.data[i].avatar+'" alt="">'
                            html +='    </div>'
            
                            html +='    <div class="product-detail-rate-right">'
                            html +='        <div class="product-detail-rate-heading">'
                            html +='            <div class="product-detail-rate-name">'+res.data[i].full_name+'</div>'
            
                            html +='            <div class="product-detail-rate-date">'+date+'</div>'
                            html +='        </div>'
            
                            html +='        <div class="product-detail-rate-star"><div class="stars" style="color: gold; width: 95px;">'
                            html +='                <i class="bx bxs-star"></i>'
                            html +='                 <i class="bx bxs-star"></i>'
                            html +='                <i class="bx bxs-star"></i>'
                            html +='                <i class="bx bxs-star"></i>'
                            html +='                <i class="bx bxs-star"></i>'
                            html +='                <div class="overlay" style="width: '+point+'%"></div>'
                            html +='            </div>  '
                            html +='        </div>  '
            
                            html +='        <div class="product-details-rate-comment">'+res.data[i].content+'</div>'  
            
                            html +='        <div class="product-detail-rate-image">'
                             for(var key in image) {
                                if (image.hasOwnProperty(key)) {
                                    if (image[key] != '') {
                                console.log(image[key]);
                           html +='            <img src="'+image[key]+'" alt="">'
                        }}}
                            html +='        </div> '

                                    
                            html +='    </div>'
                            html +='</div>'

                        }
                        document.getElementById("evaluate").innerHTML = html;
                    }else{
                         document.getElementById("evaluate").innerHTML = '<div class="no_evaluate"><h5>Sản phẩm chưa có đánh giá nào </h5></div>';
                    }
                }
            });
               
        }
</script>
<script type="text/javascript">
    function plusQuantity()
    {
        let quantity = parseInt($('#quantity_buy').val());
        quantity++;
        $('#quantity_buy').val(quantity);
    }

    function minusQuantity()
    {
        let quantity = parseInt($('#quantity_buy').val());
        quantity--;
        if(quantity<1) quantity=1;
        $('#quantity_buy').val(quantity);
    }

    function addProductCart(idProduct, status){
        let quantity = parseInt($('#quantity_buy').val());
        console.log(status);

        $.ajax({
            method: "GET",
            url: "/apis/addProductToCart/?id_product="+idProduct+"&quantity="+quantity+"&status="+status
        })
        .done(function( msg ) {
            console.log(msg);

            document.getElementById("count").innerHTML = msg.count;
            if(status=='true'){
                window.location = '/gio-hang';
            }else{
                document.getElementById("myElement").style.display = 'block';

                var myElement = document.getElementById('myElement');

                // Hàm thay đổi CSS
                function changeCSS() {
                    myElement.style.display = 'none';
                }

                // Đặt hẹn giờ để thực hiện thay đổi sau 10 giây
                setTimeout(changeCSS, 3000);
            }
        });
    }
</script>


 <script>
    // Lấy tham chiếu đến phần tử cần thay đổi CSS
    
</script>
<script>
   
</script>


<?php
getFooter();?>