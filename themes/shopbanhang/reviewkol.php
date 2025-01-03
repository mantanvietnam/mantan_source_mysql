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
                    <li><a class="nav-link active" href="nhan-xet-tu-kol">Nhận xét từ các KOL, KOC</a></li>
                    <li><a class="nav-link" href="khach-hang-dap-hop">Khách hàng đập hộp</a></li>
                    <li><a class="nav-link" href="review-san-pham">Feedback khách hàng</a></li>
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
                                        <div class="modal-header">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <?php
                                                if(!empty($item->description)){
                                                    echo $item->description;
                                                }elseif(!empty($item->youtube)){
                                                    echo '<iframe width="320" height="300" src="https://www.youtube.com/embed/'.$item->youtube.'?si=UGeHLtr6Tqz9uZXq" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>';
                                                }
                                             ?>
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
                                    <div class="col-lg-6 col-md-12 col-sm-12 combo-1">
                                        <div class="title-review-product">
                                            <p><?php echo $setting['name_product1'] ?></p>
                                            <div class="double-line-1"></div>
                                        </div>
                                        <div class="video-review-product">
                                            <div class="video-1">
                                                <div class="image-modal">
                                                    <img src="<?php echo $setting['imagevideo11'] ?>" data-bs-toggle="modal" data-bs-target="#modalvideoreview1">
                                                    <div class="pro-review-link" data-bs-toggle="modal" data-bs-target="#modalvideoreview1">
                                                        <img src="<?php echo $urlThemeActive ?>/asset/image/play.png" alt="">
                                                    </div>
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
                                                    <div class="pro-review-link" data-bs-toggle="modal" data-bs-target="#modalvideoreview2">
                                                        <img src="<?php echo $urlThemeActive ?>/asset/image/play.png" alt="">
                                                    </div>
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
                                    <div class="col-lg-6 col-md-12 col-sm-12 combo-2">
                                        <div class="title-review-product">
                                            <p><?php echo $setting['name_product2'] ?></p>
                                            <div class="double-line-2"></div>
                                        </div>
                                        <div class="video-review-product">
                                            <div class="video-1">
                                                <div class="image-modal">
                                                    <img src="<?php echo $setting['imagevideo21'] ?>" data-bs-toggle="modal" data-bs-target="#modalvideoreview3">
                                                    <div class="pro-review-link" data-bs-toggle="modal" data-bs-target="#modalvideoreview3">
                                                        <img src="<?php echo $urlThemeActive ?>/asset/image/play.png" alt="">
                                                    </div>
                                                    
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
                                                    <div class="pro-review-link" data-bs-toggle="modal" data-bs-target="#modalvideoreview4">
                                                        <img src="<?php echo $urlThemeActive ?>/asset/image/play.png" alt="">
                                                    </div>
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
                                    <div class="col-lg-6 col-md-12 col-sm-12 combo-3">
                                        <div class="title-review-product">
                                            <p><?php echo $setting['name_product3'] ?></p>
                                            <div class="double-line-1"></div>
                                        </div>
                                        <div class="video-review-product">
                                            <div class="video-1">
                                                <div class="image-modal">
                                                    <img src="<?php echo $setting['imagevideo31'] ?>" data-bs-toggle="modal" data-bs-target="#modalvideoreview5">
                                                    <div class="pro-review-link" data-bs-toggle="modal" data-bs-target="#modalvideoreview5">
                                                        <img src="<?php echo $urlThemeActive ?>/asset/image/play.png" alt="">
                                                    </div>
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
                                                    <div class="pro-review-link" data-bs-toggle="modal" data-bs-target="#modalvideoreview6">
                                                        <img src="<?php echo $urlThemeActive ?>/asset/image/play.png" alt="">
                                                    </div>
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
                                    <div class="col-lg-6 col-md-12 col-sm-12 combo-4">
                                        <div class="title-review-product">
                                            <p><?php echo $setting['name_product4'] ?></p>
                                            <div class="double-line-2"></div>
                                        </div>
                                        <div class="video-review-product">
                                            <div class="video-1">
                                                <div class="image-modal">
                                                    <img src="<?php echo $setting['imagevideo41'] ?>" data-bs-toggle="modal" data-bs-target="#modalvideoreview7">
                                                    <div class="pro-review-link" data-bs-toggle="modal" data-bs-target="#modalvideoreview7">
                                                        <img src="<?php echo $urlThemeActive ?>/asset/image/play.png" alt="">
                                                    </div>
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
                                                    <div class="pro-review-link" data-bs-toggle="modal" data-bs-target="#modalvideoreview8">
                                                        <img src="<?php echo $urlThemeActive ?>/asset/image/play.png" alt="">
                                                    </div>
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
                                    <div class="modal-header">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                       <?php
                                            if(!empty($setting['embedded11'])){
                                                echo $setting['embedded11'];
                                            }elseif(!empty($setting['youtube_11'])){
                                                echo '<iframe width="320" height="300" src="https://www.youtube.com/embed/'.$setting['youtube_11'].'?si=UGeHLtr6Tqz9uZXq" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>';
                                            }
                                        ?>
                                    </div>
                                  </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-video">
                            <div class="modal fade" id="modalvideoreview2" tabindex="-1" aria-labelledby="modalvideoreview2Label" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <?php
                                            if(!empty($setting['embedded12'])){
                                                echo $setting['embedded12'];
                                            }elseif(!empty($setting['youtube_12'])){
                                                echo '<iframe width="320" height="300" src="https://www.youtube.com/embed/'.$setting['youtube_12'].'?si=UGeHLtr6Tqz9uZXq" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>';
                                            }
                                        ?>
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
                                    <div class="modal-header">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <?php
                                            if(!empty($setting['embedded21'])){
                                                echo $setting['embedded21'];
                                            }elseif(!empty($setting['youtube_21'])){
                                                echo '<iframe width="320" height="300" src="https://www.youtube.com/embed/'.$setting['youtube_21'].'?si=UGeHLtr6Tqz9uZXq" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>';
                                            }
                                        ?>
                                    </div>
                                  </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-video">
                            <div class="modal fade" id="modalvideoreview4" tabindex="-1" aria-labelledby="modalvideoreview4Label" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <?php
                                            if(!empty($setting['embedded22'])){
                                                echo $setting['embedded22'];
                                            }elseif(!empty($setting['youtube_22'])){
                                                echo '<iframe width="320" height="300" src="https://www.youtube.com/embed/'.$setting['youtube_22'].'?si=UGeHLtr6Tqz9uZXq" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>';
                                            }
                                        ?>
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
                                    <div class="modal-header">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <?php
                                            if(!empty($setting['embedded31'])){
                                                echo $setting['embedded31'];
                                            }elseif(!empty($setting['youtube_31'])){
                                                echo '<iframe width="320" height="300" src="https://www.youtube.com/embed/'.$setting['youtube_31'].'?si=UGeHLtr6Tqz9uZXq" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>';
                                            }
                                        ?>
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
                                        <?php
                                            if(!empty($setting['embedded32'])){
                                                echo $setting['embedded32'];
                                            }elseif(!empty($setting['youtube_32'])){
                                                echo '<iframe width="320" height="300" src="https://www.youtube.com/embed/'.$setting['youtube_32'].'?si=UGeHLtr6Tqz9uZXq" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>';
                                            }
                                        ?>
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
                                        <div class="modal-header">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <?php
                                            if(!empty($setting['embedded41'])){
                                                echo $setting['embedded41'];
                                            }elseif(!empty($setting['youtube_41'])){
                                                echo '<iframe width="320" height="300" src="https://www.youtube.com/embed/'.$setting['youtube_41'].'?si=UGeHLtr6Tqz9uZXq" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>';
                                            }
                                        ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-video">
                            <div class="modal fade" id="modalvideoreview8" tabindex="-1" aria-labelledby="modalvideoreview8Label" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <?php
                                            if(!empty($setting['embedded42'])){
                                                echo $setting['embedded42'];
                                            }elseif(!empty($setting['youtube_42'])){
                                                echo '<iframe width="320" height="300" src="https://www.youtube.com/embed/'.$setting['youtube_42'].'?si=UGeHLtr6Tqz9uZXq" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>';
                                            }
                                        ?>
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