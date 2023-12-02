<?php
getHeader();
global $urlThemeActive;
global $session;
$settinghom = setting();

// debug($slide_home);
// debug($list_product);
?>
<link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
<main>
    <section id="section-breadcrumb">
        <div class="breadcrumb-center">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                <li class="breadcrumb-item active">Review sản phẩm</li>
            </ul>
        </div>
    </section>

    <div id="review">
        <div class="container">
            <div class="tab-menu">
                <ul class="nav nav-tabs">
                    <li><a class="nav-link" href="nhan_xet_tu_kol">Nhận xét từ các KOL, KOC</a></li>
                    <li><a class="nav-link" href="khach_hang_dap_hop">Khách hàng đập hộp</a></li>
                    <li><a class="nav-link active" href="review_san_pham">Review sản phẩm</a></li>
                </ul>
            </div>

            	<div class="tab-content">
                    <div id="review-product" class="tab-pane fade show active">
                        <div class="list-review">
                            <div class="row log-in">
                                <div class="col-lg-8 col-md-12 col-sm-12">
                                    <div class="title-unbox">
                                        <p>Tìm kiếm theo sản phẩm</p>
                                    </div>
                                    <div class="list-product-review">

                                    <?php if(!empty($list_product)){
                                        foreach($list_product as $key => $item){
                                            if(!empty($item->evaluate)){
                                     ?>
                                    <div class="item-slick-product">
                                        <a href="/review_san_pham?id_product=<?php echo $item->id ?>">
                                            <img src="<?php echo $item->image; ?>">
                                            <p><?php echo $item->title; ?></p>
                                        </a>
                                    </div>
                                    <?php }}} ?>

                                    </div>
                                    <?php
                                            if(!empty($evaluate)){
                                              foreach($evaluate as $k => $value){  
                                                    $value->image = json_decode($value->image, true);
                                     ?>
                                        <div class="content-unbox posts">
                                            <div class="detail-unbox">
                                                <div class="avt-user">
                                                    <img src="<?php echo $value->avatar ?>">
                                                </div>
                                                <div class="text-detail">
                                                    <h4>
                                                        <span><?php echo $value->full_name ?></span> đã viết đánh giá sản phẩm
                                                        <span><?php echo $value->product->title ?></span>
                                                    </h4>
                                                    <div class="five-star product-detail-rate-star">
                                                        
                                                         <?php $point = 100 - ($value->point/5) / 1 * 100 ?>
                                                        <div class="stars" style="color: gold;">
                                                                <i class='bx bxs-star'></i>
                                                                <i class='bx bxs-star'></i>
                                                                <i class='bx bxs-star'></i>
                                                                <i class='bx bxs-star'></i>
                                                                <i class='bx bxs-star'></i>
                                                                <div class="overlay" style="width: <?php echo $point ?>%"></div>

                                                            </div> 
                                                      
                                                    </div>

                                                </div>
                                                <div class="icon-product">
                                                    <img src="<?php echo $value->product->image ?>">
                                                </div>
                                            </div>
                                            <div class="image-unbox">
                                                <p><?php echo $value->content ?></p>
                                                
                                                <?php 
                                                    if(!empty($value->image)){
                                                        $check = false;

                                                        foreach($value->image as $image) {
                                                            if(!empty($image)){
                                                                $check = true;
                                                            }
                                                        }

                                                        if($check){
                                                            echo '<div class="slide-rate-image">';
                                                            
                                                            foreach($value->image as $image) {
                                                                if(!empty($image)){
                                                                    echo '<img src="'.$image.'" alt="">';
                                                                }
                                                            }

                                                            echo '</div>';
                                                        }
                                                    } 
                                                ?>
                                                
                                            </div>
                                            <!-- <div class="icon-interact">
                                                <a class="like"><i class="fa-regular fa-thumbs-up"></i>1145</a>
                                                <a class="share"><i class="fa-solid fa-share"></i>214</a>
                                            </div> -->
                                        </div>
                                    <?php }} ?>
                                    

                                    <!-- <div class="icon-loading">
                                        <i class="fa-solid fa-spinner"></i>
                                    </div> -->
                                </div>

                                <div class="col-lg-4 col-md-12 col-sm-12">
                                    <div class="title-rating">
                                        <p>Tìm kiếm theo sao</p>
                                    </div>
                                    <div class="star-rating">
                                        <div class="item-star-rating">
                                            <a href="/review_san_pham">Tất cả</a>
                                        </div>
                                        <div class="item-star-rating">
                                            <a href="/review_san_pham?point=1">1 sao</a>
                                        </div>
                                        <div class="item-star-rating">
                                            <a href="/review_san_pham?point=2">2 sao</a>
                                        </div>
                                        <div class="item-star-rating">
                                            <a href="/review_san_pham?point=3">3 sao</a>
                                        </div>
                                        <div class="item-star-rating">
                                            <a href="/review_san_pham?point=4">4 sao</a>
                                        </div>
                                        <div class="item-star-rating">
                                            <a href="/review_san_pham?point=5">5 sao</a>
                                        </div>
                                        <div class="item-star-rating">
                                            <a href='/review_san_pham?image={"1":"","2":"","3":"","4":"","5":""}'>Có hình ảnh/video</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</main>
<script type="text/javascript">
    function addReview(){
        var note = $('#note').val();
 console.log(note);
        $.ajax({
                method: 'GET',
                url: '/apis/addReview',
                data: { note: note },
                success:function(res){
                  console.log(res);
                  // location.reload();
                }
            })
    }
</script>
<?php
getFooter();?>