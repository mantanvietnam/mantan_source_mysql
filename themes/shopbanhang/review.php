<?php
getHeader();
global $urlThemeActive;
$settinghom = setting();

// debug($slide_home);
// debug($list_product);
?>
<main>
    <section id="section-breadcrumb">
        <div class="breadcrumb-center">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Library</a></li>
                <li class="breadcrumb-item active">Data</li>
            </ul>
        </div>
    </section>

    <div id="review">
        <div class="container">
            <div class="tab-menu">
                <ul class="nav nav-tabs">
                    <li><a class="nav-link active" data-bs-toggle="tab" href="#video-review">Nhận xét từ các KOL, KOC</a></li>
                    <li><a class="nav-link" data-bs-toggle="tab" href="#unboxing">Khách hàng đập hộp</a></li>
                    <li><a class="nav-link" data-bs-toggle="tab" href="#review-product">Review sản phẩm</a></li>
                </ul>
            </div>

            	<div class="tab-content">
                    <div id="video-review" class="tab-pane fade show active">
                        <div class="container">
                            <div class="comment-customer-slide slick">
                                 <?php if(!empty($slide_home->imageinfo)){
                        foreach($slide_home->imageinfo as $key => $item){ ?>
                                <div class="comment-customer-item">
                                    <div class="comment-customer-img">
                                        <img src="<?php echo $item->image ?>" alt="" data-bs-toggle="modal" data-bs-target="#modalvideoreviewslide<?php echo $key; ?>">
                                    </div>
                                </div>
                                <?php }} ?>
                            </div>

                            <!-- Modal video -->
                            <?php if(!empty($slide_home->imageinfo)){
                        foreach($slide_home->imageinfo as $key => $item){ ?>
                            <div class="modal-video">
                                <div class="modal fade" id="modalvideoreviewslide<?php echo $key; ?>" tabindex="-1" aria-labelledby="modalvideoreviewslide<?php echo $key; ?>Label" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                      <div class="modal-content">
                                        <div class="modal-body">
                                            <?php echo $item->description ?>
                                        </div>
                                      </div>
                                    </div>
                                </div>
                            </div>
                             <?php }} ?>
                            <!-- Kết thúc modal -->

                            <div class="comment-text-slide">
                            	<?php if(!empty($slide_home->imageinfo)){
                        foreach($slide_home->imageinfo as $key => $item){ ?>
                                <div class="comment-text-item">
                                    <div class="comment-text-name-product">
                                       <p><?php echo $item->title ?> </p>
                                    </div>

                                    <div class="commnet-text-hastag">
                                        <p><?php echo $item->link ?> </p>
                                    </div>

                                   <!--  <div class="icon-video">
                                        <div class="time">
                                            <i class="fa-regular fa-clock"></i>
                                            <p>1 tháng trước</p>
                                        </div>
                                        <div class="view">
                                            <i class="fa-regular fa-eye"></i>
                                            <p>50tr lượt xem</p>
                                        </div>
                                    </div> -->
                                </div>
								<?php }} ?>
                                
                            </div>
                        </div>

                        <!-- Danh sách video -->
                        <div class="list-video">
                            <div class="container-fluid">
                                <div class="row row-video-1">
                                    <div class="col-lg-6 col-md-6 col-sm-6 combo-1">
                                        <div class="title-review-product">
                                            <p><?php echo $setting['name_product1'] ?></p>
                                            <div class="double-line-1"></div>
                                        </div>
                                        <div class="video-review-product">
                                            <div class="video-1">
                                                <div class="image-modal">
                                                    <img src="<?php echo $setting['imagevideo11'] ?>" data-bs-toggle="modal" data-bs-target="#modalvideoreview1">
                                                </div>
                                                <div class="detail-review-video">
                                                    <p>
                                                       <?php echo $setting['name_video_11'] ?>
                                                    </p>
                                                </div>
                                                <!-- <div class="icon-video">
                                                    <div class="time">
                                                        <i class="fa-regular fa-clock"></i>
                                                        <p>1 tháng trước</p>
                                                    </div>
                                                    <div class="view">
                                                        <i class="fa-regular fa-eye"></i>
                                                        <p>50tr lượt xem</p>
                                                    </div>
                                                </div> -->
                                            </div>
                                            <div class="video-2">
                                                <div class="image-modal">
                                                    <img src="<?php echo $setting['imagevideo12'] ?>" data-bs-toggle="modal" data-bs-target="#modalvideoreview2">
                                                </div>
                                                <div class="detail-review-video">
                                                    <p>
                                                        <?php echo $setting['name_video_12'] ?>
                                                    </p>
                                                </div>
                                               <!--  <div class="icon-video">
                                                    <div class="time">
                                                        <i class="fa-regular fa-clock"></i>
                                                        <p>1 tháng trước</p>
                                                    </div>
                                                    <div class="view">
                                                        <i class="fa-regular fa-eye"></i>
                                                        <p>50tr lượt xem</p>
                                                    </div>
                                                </div> -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 combo-2">
                                        <div class="title-review-product">
                                            <p><?php echo $setting['name_product2'] ?></p>
                                            <div class="double-line-2"></div>
                                        </div>
                                        <div class="video-review-product">
                                            <div class="video-1">
                                                <div class="image-modal">
                                                    <img src="<?php echo $setting['imagevideo21'] ?>" data-bs-toggle="modal" data-bs-target="#modalvideoreview3">
                                                </div>
                                                <div class="detail-review-video">
                                                    <p>
                                                        <?php echo $setting['name_video_21'] ?>
                                                    </p>
                                                </div>
                                                <!-- <div class="icon-video">
                                                    <div class="time">
                                                        <i class="fa-regular fa-clock"></i>
                                                        <p>1 tháng trước</p>
                                                    </div>
                                                    <div class="view">
                                                        <i class="fa-regular fa-eye"></i>
                                                        <p>50tr lượt xem</p>
                                                    </div>
                                                </div> -->
                                            </div>
                                            <div class="video-2">
                                                <div class="image-modal">
                                                    <img src="<?php echo $setting['imagevideo22'] ?>" data-bs-toggle="modal" data-bs-target="#modalvideoreview4">
                                                </div>
                                                <div class="detail-review-video">
                                                    <p>
                                                        <?php echo $setting['name_video_22'] ?>
                                                    </p>
                                                </div>
                                                <!-- <div class="icon-video">
                                                    <div class="time">
                                                        <i class="fa-regular fa-clock"></i>
                                                        <p>1 tháng trước</p>
                                                    </div>
                                                    <div class="view">
                                                        <i class="fa-regular fa-eye"></i>
                                                        <p>50tr lượt xem</p>
                                                    </div>
                                                </div> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row row-video-2">
                                    <div class="col-lg-6 col-md-6 col-sm-6 combo-3">
                                        <div class="title-review-product">
                                            <p><?php echo $setting['name_product3'] ?></p>
                                            <div class="double-line-1"></div>
                                        </div>
                                        <div class="video-review-product">
                                            <div class="video-1">
                                                <div class="image-modal">
                                                    <img src="<?php echo $setting['imagevideo31'] ?>" data-bs-toggle="modal" data-bs-target="#modalvideoreview5">
                                                </div>
                                                <div class="detail-review-video">
                                                    <p>
                                                        <?php echo $setting['name_video_31'] ?>
                                                    </p>
                                                </div>
                                                <div class="icon-video">
                                                    <div class="time">
                                                        <i class="fa-regular fa-clock"></i>
                                                        <p>1 tháng trước</p>
                                                    </div>
                                                    <div class="view">
                                                        <i class="fa-regular fa-eye"></i>
                                                        <p>50tr lượt xem</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="video-2">
                                                <div class="image-modal">
                                                    <img src="<?php echo $setting['imagevideo32'] ?>" data-bs-toggle="modal" data-bs-target="#modalvideoreview6">
                                                </div>
                                                <div class="detail-review-video">
                                                    <p>
                                                        <?php echo $setting['name_video_32'] ?>
                                                    </p>
                                                </div>
                                                <div class="icon-video">
                                                    <div class="time">
                                                        <i class="fa-regular fa-clock"></i>
                                                        <p>1 tháng trước</p>
                                                    </div>
                                                    <div class="view">
                                                        <i class="fa-regular fa-eye"></i>
                                                        <p>50tr lượt xem</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 combo-4">
                                        <div class="title-review-product">
                                            <p><?php echo $setting['name_product4'] ?></p>
                                            <div class="double-line-2"></div>
                                        </div>
                                        <div class="video-review-product">
                                            <div class="video-1">
                                                <div class="image-modal">
                                                    <img src="<?php echo $setting['imagevideo41'] ?>" data-bs-toggle="modal" data-bs-target="#modalvideoreview7">
                                                </div>
                                                <div class="detail-review-video">
                                                    <p>
                                                        <?php echo $setting['name_video_41'] ?>
                                                    </p>
                                                </div>
                                               <!--  <div class="icon-video">
                                                    <div class="time">
                                                        <i class="fa-regular fa-clock"></i>
                                                        <p>1 tháng trước</p>
                                                    </div>
                                                    <div class="view">
                                                        <i class="fa-regular fa-eye"></i>
                                                        <p>50tr lượt xem</p>
                                                    </div>
                                                </div> -->
                                            </div>
                                            <div class="video-2">
                                                <div class="image-modal">
                                                    <img src="<?php echo $setting['imagevideo42'] ?>" data-bs-toggle="modal" data-bs-target="#modalvideoreview8">
                                                </div>
                                                <div class="detail-review-video">
                                                    <p>
                                                        <?php echo $setting['name_video_42'] ?>
                                                    </p>
                                                </div>

                                                <!-- <div class="icon-video">
                                                    <div class="time">
                                                        <i class="fa-regular fa-clock"></i>
                                                        <p>1 tháng trước</p>
                                                    </div>
                                                    <div class="view">
                                                        <i class="fa-regular fa-eye"></i>
                                                        <p>50tr lượt xem</p>
                                                    </div>
                                                </div> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Modal video -->
                        <!-- Sản phẩm 1 -->
                        <div class="modal-video">
                            <div class="modal fade" id="modalvideoreview1" tabindex="-1" aria-labelledby="modalvideoreview1Label" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                  <div class="modal-content">
                                    <div class="modal-body">
                                       <?php echo $setting['embedded11'] ?>
                                    </div>
                                  </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-video">
                            <div class="modal fade" id="modalvideoreview2" tabindex="-1" aria-labelledby="modalvideoreview2Label" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                  <div class="modal-content">
                                    <div class="modal-body">
                                        <?php echo $setting['embedded12'] ?>
                                    </div>
                                  </div>
                                </div>
                            </div>
                        </div>

                        <!-- Sản phẩm 2 -->
                        <div class="modal-video">
                            <div class="modal fade" id="modalvideoreview3" tabindex="-1" aria-labelledby="modalvideoreview3Label" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                  <div class="modal-content">
                                    <div class="modal-body">
                                        <?php echo $setting['embedded21'] ?>
                                    </div>
                                  </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-video">
                            <div class="modal fade" id="modalvideoreview4" tabindex="-1" aria-labelledby="modalvideoreview4Label" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                  <div class="modal-content">
                                    <div class="modal-body">
                                        <?php echo $setting['embedded22'] ?>
                                    </div>
                                  </div>
                                </div>
                            </div>
                        </div>

                        <!-- Sản phẩm 3 -->
                        <div class="modal-video">
                            <div class="modal fade" id="modalvideoreview5" tabindex="-1" aria-labelledby="modalvideoreview5Label" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                  <div class="modal-content">
                                    <div class="modal-body">
                                        <?php echo $setting['embedded31'] ?>
                                    </div>
                                  </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-video">
                            <div class="modal fade" id="modalvideoreview6" tabindex="-1" aria-labelledby="modalvideoreview6Label" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                  <div class="modal-content">
                                    <div class="modal-body">
                                        <?php echo $setting['embedded32'] ?>
                                    </div>
                                  </div>
                                </div>
                            </div>
                        </div>

                        <!-- Sản phẩm 4 -->
                        <div class="modal-video">
                            <div class="modal fade" id="modalvideoreview7" tabindex="-1" aria-labelledby="modalvideoreview7Label" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                    <div class="modal-body">
                                        <?php echo $setting['embedded41'] ?>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-video">
                            <div class="modal fade" id="modalvideoreview8" tabindex="-1" aria-labelledby="modalvideoreview8Label" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                    <div class="modal-body">
                                        <?php echo $setting['embedded42'] ?>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="unboxing" class="tab-pane fade">

                        <!-- Khi đã đăng nhập -->
                        <div class="row log-in">
                            <div class="col-lg-8 col-md-12 col-sm-12">
                                <div class="title-unbox">
                                    <p>Tìm kiếm theo sản phẩm</p>
                                </div>
                                <div class="list-product-review">
                                    <?php if(!empty($list_product)){
                                        foreach($list_product as $key => $item){
                                     ?>
                                    <div class="item-slick-product">
                                        <a href="/product/<?php echo $item->slug ?>">
                                            <img src="<?php echo $item->image; ?>">
                                            <p><?php echo $item->title; ?></p>
                                        </a>
                                    </div>
                                    <?php }} ?>

                                </div>
                                <div class="content-unbox unbox-1">
                                    <div class="detail-unbox">
                                        <div class="avt-user">
                                            <img src="../asset/image/icon-avt.png">
                                        </div>
                                        <div class="text-detail">
                                            <h4>
                                                <span>Thùy Dương</span> chia sẻ hình ảnh đập hộp trên Tiktok về
                                                <span>Máy Massage Cổ Vai Gáy Bumas M3 pro</span> và
                                                <span>nhận được voucher 50k</span> ( cho đơn từ 0đ )
                                            </h4>
                                            <p>2 ngày trước</p>
                                        </div>
                                        <div class="icon-product">
                                            <img src="../asset/image/mini-product.png">
                                        </div>
                                    </div>
                                    <div class="image-unbox">
                                        <p>Đập hộp #Unboxing#Bumas</p>
                                        <img src="../asset/image/img-unbox.png">
                                    </div>
                                    <div class="icon-interact">
                                        <a class="like"><i class="fa-regular fa-thumbs-up"></i>1145</a>
                                        <a class="share"><i class="fa-solid fa-share"></i>214</a>
                                    </div>
                                </div>

                                <div class="content-unbox unbox-2">
                                    <div class="detail-unbox">
                                        <div class="avt-user">
                                            <img src="../asset/image/icon-avt.png">
                                        </div>
                                        <div class="text-detail">
                                            <h4>
                                                <span>Thùy Dương</span> chia sẻ hình ảnh đập hộp trên Tiktok về
                                                <span>Máy Massage Cổ Vai Gáy Bumas M3 pro</span> và
                                                <span>nhận được voucher 50k</span> ( cho đơn từ 0đ )
                                            </h4>
                                            <p>2 ngày trước</p>
                                        </div>
                                        <div class="icon-product">
                                            <img src="../asset/image/mini-product.png">
                                        </div>
                                    </div>
                                    <div class="image-unbox">
                                        <p>Đập hộp #Unboxing#Bumas</p>
                                        <img src="../asset/image/img-unbox.png">
                                    </div>
                                    <div class="icon-interact">
                                        <a class="like"><i class="fa-regular fa-thumbs-up"></i>1145</a>
                                        <a class="share"><i class="fa-solid fa-share"></i>214</a>
                                    </div>
                                </div>

                                <div class="icon-loading">
                                    <i class="fa-solid fa-spinner"></i>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-12 col-sm-12">
                                <div class="share-link">
                                    <div class="title-share-link">
                                        <h4>Chia sẻ link đập hộp</h4>
                                        <p>Để được nhận
                                            <span>voucher 50K cho đơn từ 0đ</span>
                                        </p>
                                    </div>

                                    <div class="content-share-link">
                                        <div class="infor-user">
                                            <img src="../asset/image/icon-avt.png">
                                            <p>Thùy Dương</p>
                                        </div>
                                        <div class="input-link">
                                            <input type="text" id="note" placeholder="Chia sẻ link đập hộp tại đây">
                                            <div class="btn-submit">
                                                <button onclick="addReview()">Chia sẻ</button>
                                            </div>
                                        </div>
                                        <div class="detail-share-link">
                                            <p>Những lưu ý cần biết để nhận thưởng 50.000đ + 150 Lixicoin:</p>
                                            <ul>
                                                <li>Video hợp lệ là video được đăng tải ở chế độ công khai trên ứng dụng TikTok hoặc bất cứ ứng dụng nào với nội dung: Unboxing đơn hàng Bumas, hoặc review sản phẩm bạn mua tại Bumas.</li>
                                                <li>Chỉ ghi nhận 1 video đập hộp cho mỗi đơn hàng .</li>
                                                <li>Caption cần đính kèm đầy đủ hashtag #Unboxing #Bumas</li>
                                                <li>Sau khi đăng tải Video và thực hiện đúng yêu cầu trên, dán link video vào mục "chia sẻ link video đập hộp".</li>
                                                <li>Đội ngũ Bumas sẽ
                                                    <span>ểm duyệt video trong vòng 48 giờ</span> làm việc (không tính Chủ nhật). Nếu đạt yêu cầu, bạn sẽ được
                                                    <span>nhận ngay voucher 50k</span> vào kho voucher của bạn.
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <!-- Khi chưa đăng nhập -->
                        <div class="no-log-in">
                            <div class="title-share-link">
                                <h4>Chia sẻ link đập hộp</h4>
                                <p>Để được nhận
                                    <span>voucher 50K cho đơn từ 0đ</span>
                                </p>
                            </div>

                            <div class="content-share-link">

                                <div class="input-link">
                                    <input type="text" placeholder="Chia sẻ link đập hộp tại đây">
                                    <div class="btn-submit">
                                        <button>Chia sẻ</button>
                                    </div>
                                </div>
                                <div class="detail-share-link">
                                    <p>Những lưu ý cần biết để nhận thưởng 50.000đ + 150 Lixicoin:</p>
                                    <ul>
                                        <li>Video hợp lệ là video được đăng tải ở chế độ công khai trên ứng dụng TikTok hoặc bất cứ ứng dụng nào với nội dung: Unboxing đơn hàng Bumas, hoặc review sản phẩm bạn mua tại Bumas.</li>
                                        <li>Chỉ ghi nhận 1 video đập hộp cho mỗi đơn hàng .</li>
                                        <li>Caption cần đính kèm đầy đủ hashtag #Unboxing #Bumas</li>
                                        <li>Sau khi đăng tải Video và thực hiện đúng yêu cầu trên, dán link video vào mục "chia sẻ link video đập hộp".</li>
                                        <li>Đội ngũ Bumas sẽ
                                            <span>ểm duyệt video trong vòng 48 giờ</span> làm việc (không tính Chủ nhật). Nếu đạt yêu cầu, bạn sẽ được
                                            <span>nhận ngay voucher 50k</span> vào kho voucher của bạn.
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="review-product" class="tab-pane fade">
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
                                        <a href="/product/<?php echo $item->slug ?>">
                                            <img src="<?php echo $item->image; ?>">
                                            <p><?php echo $item->title; ?></p>
                                        </a>
                                    </div>
                                    <?php }}} ?>

                                    </div>
                                    <?php if(!empty($list_product)){
                                        foreach($list_product as $key => $item){
                                            if(!empty($item->evaluate)){
                                              foreach($item->evaluate as $k => $value){  
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
                                                        <span><?php echo $item->title ?></span>
                                                    </h4>
                                                    <div class="five-star">
                                                        <ul>
                                                            <li><i class="fa-solid fa-star"></i></li>
                                                            <li><i class="fa-solid fa-star"></i></li>
                                                            <li><i class="fa-solid fa-star"></i></li>
                                                            <li><i class="fa-solid fa-star"></i></li>
                                                            <li><i class="fa-regular fa-star"></i></li>
                                                        </ul>
                                                        <p>2 ngày trước</p>
                                                    </div>

                                                </div>
                                                <div class="icon-product">
                                                    <img src="<?= $urlThemeActive ?>/asset/image/mini-product.png">
                                                </div>
                                            </div>
                                            <div class="image-unbox">
                                                <p><?php echo $value->content ?></p>
                                                 <?php if(!empty($value->image)){
                                                        foreach($value->image as $image) {
                                                        if(!empty($image)){
                                                    ?>
                                                    <img src="<?php echo $image;?>" alt="">
                                                <?php }}} ?>
                                            </div>
                                            <!-- <div class="icon-interact">
                                                <a class="like"><i class="fa-regular fa-thumbs-up"></i>1145</a>
                                                <a class="share"><i class="fa-solid fa-share"></i>214</a>
                                            </div> -->
                                        </div>
                                    <?php }}}} ?>
                                    

                                    <div class="icon-loading">
                                        <i class="fa-solid fa-spinner"></i>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-12 col-sm-12">
                                    <div class="title-rating">
                                        <p>Tìm kiếm theo sao</p>
                                    </div>
                                    <div class="star-rating">
                                        <div class="item-star-rating">
                                            <button>Tất cả</button>
                                        </div>
                                        <div class="item-star-rating">
                                            <button>1 sao</button>
                                        </div>
                                        <div class="item-star-rating">
                                            <button>2 sao</button>
                                        </div>
                                        <div class="item-star-rating">
                                            <button>3 sao</button>
                                        </div>
                                        <div class="item-star-rating">
                                            <button>4 sao</button>
                                        </div>
                                        <div class="item-star-rating">
                                            <button>5 sao</button>
                                        </div>
                                        <div class="item-star-rating">
                                            <button>Có hình ảnh/video</button>
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