<?php
getHeader();
global $urlThemeActive;
global $session;
$settinghom = setting();

// debug($slide_home);
// debug($list_product);
?>
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
                    <li><a class="nav-link active" href="nhan_xet_tu_kol">Nhận xét từ các KOL, KOC</a></li>
                    <li><a class="nav-link" href="khach_hang_dap_hop">Khách hàng đập hộp</a></li>
                    <li><a class="nav-link" href="review_san_pham">Review sản phẩm</a></li>
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
                                        <div class="pro-review-link" data-bs-toggle="modal" data-bs-target="#modalvideoreviewslide<?php echo $key; ?>">
                                            <img src="<?php echo $urlThemeActive ?>/asset/image/play.png" alt="">
                                        </div>
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
                                        <p><?php echo $item->hastag ?> </p>
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
                                                    <img src="<?php echo $setting['imagevideo32'] ?>" data-bs-toggle="modal" data-bs-target="#modalvideoreview6">
                                                </div>
                                                <div class="detail-review-video">
                                                    <p>
                                                        <?php echo $setting['name_video_32'] ?>
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
                </div>

            </div>

        </div>
    </div>
</main>

<?php
getFooter();?>