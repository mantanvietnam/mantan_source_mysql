<?php
getHeader();
global $urlThemeActive;
?>
<main>
    <section id="section-banner" style="background-image: url(<?php echo show_text_clone(@$setting['background_top']) ?>);">
        <div class="banner-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 banner-left">
                        <div class="banner-left-inner">
                            <div class="banner-title-small">
                                <p><?php echo show_text_clone(@$setting['title_top_nho']) ?></p>
                            </div>
                            <div class="banner-title-big">
                                <h2><?php echo show_text_clone(@$setting['title_top_to']) ?></h2>
                            </div>
                            <div class="banner-description">
                                <p><?php echo nl2br(show_text_clone(@$setting['content_top'])) ?></p>
                            </div>
                            <div class="button-link mb-3">
                                <a href="#section-form">Đăng ký tham gia</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 banner-right">
                        <div class="banner-right-img">
                            <img src="<?php echo show_text_clone(@$setting['image_top']) ?>" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="section-service">
        <div class="container">
            <div class="section-title text-center m-auto">
                <div class="title-small">
                    <span><?php echo show_text_clone(@$setting['title_dv_nho']) ?></span>
                </div>

                <div class="title-big">
                    <span><?php echo show_text_clone(@$setting['title_dv_to']) ?></span>
                </div>

                <div class="title-description">
                    <p><?php echo show_text_clone(@$setting['content_dv']) ?></p>
                </div>
            </div>

            <div class="service-list">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="service-item">
                            <div class="service-img">
                                <img src="<?php echo show_text_clone(@$setting['image_dv_1']) ?>" alt="">                                
                            </div> 

                            <div class="service-detail">
                                <div class="service-item-title">
                                    <p><?php echo show_text_clone(@$setting['title_dv_1']) ?></p>
                                </div>

                                <div class="service-item-description">
                                    <p><?php echo show_text_clone(@$setting['content_dv_1']) ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="service-item">
                            <div class="service-img">
                                <img src="<?php echo show_text_clone(@$setting['image_dv_2']) ?>" alt="">                                
                            </div> 

                            <div class="service-detail">
                                <div class="service-item-title">
                                    <p><?php echo show_text_clone(@$setting['title_dv_2']) ?></p>
                                </div>

                                <div class="service-item-description">
                                    <p><?php echo show_text_clone(@$setting['content_dv_2']) ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="service-item">
                            <div class="service-img">
                                <img src="<?php echo show_text_clone(@$setting['image_dv_3']) ?>" alt="">                                
                            </div> 

                            <div class="service-detail">
                                <div class="service-item-title">
                                    <p><?php echo show_text_clone(@$setting['title_dv_3']) ?></p>
                                </div>

                                <div class="service-item-description">
                                    <p><?php echo show_text_clone(@$setting['content_dv_3']) ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-lg-3">
                        <div class="service-item">
                            <div class="service-img">
                                <img src="<?php echo show_text_clone(@$setting['image_dv_4']) ?>" alt="">                                
                            </div> 

                            <div class="service-detail">
                                <div class="service-item-title">
                                    <p><?php echo show_text_clone(@$setting['title_dv_4']) ?></p>
                                </div>

                                <div class="service-item-description">
                                    <p><?php echo show_text_clone(@$setting['content_dv_4']) ?></p>
                                </div>
                            </div>
                        </div>
                    </div> -->

                    
                </div>
            </div>
        </div>
    </section>

    <section id="section-about">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12 about-left">
                    <div class="about-left-img">
                        <img src="<?php echo show_text_clone(@$setting['image_gt']) ?>" alt="">
                    </div>
                </div>

                <div class="col-lg-6 col-md-12 about-right">
                    <div class="section-title">
                        <div class="title-small">
                            <span><?php echo show_text_clone(@$setting['title_gt_nho']) ?></span>
                        </div>

                        <div class="title-big">
                            <span><?php echo show_text_clone(@$setting['title_gt_to']) ?></span>
                        </div>

                        <div class="title-description">
                            <p><?php echo nl2br(show_text_clone(@$setting['content_gt_den'])); ?></p>
                        </div>
                    </div>

                    <div class="about-content">
                        <p><?php echo show_text_clone(@$setting['content_gt_tim']) ?></p>
                        <div class="button-link">
                            <a href="#section-form">Đăng ký tham gia</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="section-why">
        <div class="container">
            <div class="section-title text-center m-auto">
                <div class="title-small">
                    <span><?php echo show_text_clone(@$setting['title_ds_nho']) ?></span>
                </div>

                <div class="title-big">
                    <span><?php echo show_text_clone(@$setting['title_ds_to']) ?></span>
                </div>

                <div class="title-description">
                    <p><?php echo show_text_clone(@$setting['content_ds']) ?></p>
                </div>
            </div>

            <div class="why-content">
                <div class="row">
                    <div class="col-lg-4 col-md-12">
                        <div class="why-item-left">
                            <div class="why-box">
                                <div class="icon-box-text text-end">
                                    <div class="icon-title">
                                        <span><?php echo show_text_clone(@$setting['title_ds_1']) ?></span>
                                    </div>

                                    <div class="icon-description">
                                        <span><?php echo show_text_clone(@$setting['content_ds_1']) ?></span>
                                    </div>
                                </div>

                                <div class="icon-box-img">
                                    <img src="<?php echo $urlThemeActive ?>/asset/image/check-01.png" alt="">
                                </div>
                            </div>

                            <div class="why-box box-padding-right">
                                <div class="icon-box-text text-end">
                                    <div class="icon-title">
                                        <span><?php echo show_text_clone(@$setting['title_ds_2']) ?></span>
                                    </div>

                                    <div class="icon-description">
                                        <span><?php echo show_text_clone(@$setting['content_ds_2']) ?></span>
                                    </div>
                                </div>

                                <div class="icon-box-img">
                                    <img src="<?php echo $urlThemeActive ?>/asset/image/check-01.png" alt="">
                                </div>
                            </div>

                            <div class="why-box box-padding-right">
                                <div class="icon-box-text text-end">
                                    <div class="icon-title">
                                        <span><?php echo show_text_clone(@$setting['title_ds_3']) ?></span>
                                    </div>

                                    <div class="icon-description">
                                        <span><?php echo show_text_clone(@$setting['content_ds_3']) ?></span>
                                    </div>
                                </div>

                                <div class="icon-box-img">
                                    <img src="<?php echo $urlThemeActive ?>/asset/image/check-01.png" alt="">
                                </div>
                            </div>

                            <div class="why-box">
                                <div class="icon-box-text text-end">
                                    <div class="icon-title">
                                        <span><?php echo show_text_clone(@$setting['title_ds_4']) ?></span>
                                    </div>

                                    <div class="icon-description">
                                        <span><?php echo show_text_clone(@$setting['content_ds_4']) ?></span>
                                    </div>
                                </div>

                                <div class="icon-box-img">
                                    <img src="<?php echo $urlThemeActive ?>/asset/image/check-01.png" alt="">
                                </div>
                            </div>

                            <div class="why-col-line">
                                <img src="<?php echo $urlThemeActive ?>/asset/image/hinh2-1.png" alt="">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-12">
                        <div class="why-item-center">
                            <div class="why-img">
                                <img src="<?php echo show_text_clone(@$setting['image_ds']) ?>" alt="">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-12">
                        <div class="why-item-right">
                            <div class="why-col-line">
                                <img src="<?php echo $urlThemeActive ?>/asset/image/get-image-v30909.png" alt="">
                            </div>

                            <div class="why-box">
                                <div class="icon-box-img">
                                    <img src="<?php echo $urlThemeActive ?>/asset/image/check-01.png" alt="">
                                </div>

                                <div class="icon-box-text text-start">
                                    <div class="icon-title">
                                        <span><?php echo show_text_clone(@$setting['title_ds_5']) ?></span>
                                    </div>

                                    <div class="icon-description">
                                        <span><?php echo show_text_clone(@$setting['content_ds_5']) ?></span>
                                    </div>
                                </div>
                            </div>

                            <div class="why-box box-padding-left">
                                <div class="icon-box-img">
                                    <img src="<?php echo $urlThemeActive ?>/asset/image/check-01.png" alt="">
                                </div>

                                <div class="icon-box-text text-start">
                                    <div class="icon-title">
                                        <span><?php echo show_text_clone(@$setting['title_ds_6']) ?></span>
                                    </div>

                                    <div class="icon-description">
                                        <span><?php echo show_text_clone(@$setting['content_ds_6']) ?></span>
                                    </div>
                                </div>
                            </div>

                            <div class="why-box box-padding-left">
                                <div class="icon-box-img">
                                    <img src="<?php echo $urlThemeActive ?>/asset/image/check-01.png" alt="">
                                </div>

                                <div class="icon-box-text text-start">
                                    <div class="icon-title">
                                        <span><?php echo show_text_clone(@$setting['title_ds_7']) ?></span>
                                    </div>

                                    <div class="icon-description">
                                        <span><?php echo show_text_clone(@$setting['content_ds_7']) ?></span>
                                    </div>
                                </div>
                            </div>

                            <div class="why-box">
                                <div class="icon-box-img">
                                    <img src="<?php echo $urlThemeActive ?>/asset/image/check-01.png" alt="">
                                </div>

                                <div class="icon-box-text text-start">
                                    <div class="icon-title">
                                        <span><?php echo show_text_clone(@$setting['title_ds_8']) ?></span>
                                    </div>

                                    <div class="icon-description">
                                        <span><?php echo show_text_clone(@$setting['content_ds_8']) ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="section-form">
        <div class="container-fluid" style="">
            <div class="row">
                <div class="col-lg-6 form-left">
                    <div class="form-content">
                        <div class="section-title">
                            <div class="title-small">
                                <span><?php echo show_text_clone(@$setting['title_lh_nho']) ?></span>
                            </div>

                            <div class="title-big">
                                <span><?php echo show_text_clone(@$setting['title_lh_to']) ?></span>
                            </div>
                             <p id="success"></p>
                        </div>
                        <form action="/registerEvent" id="myForm" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="_csrfToken" value="<?php echo $csrfToken;?>">
                            <input type="hidden" name="id_group" value="<?php echo @$setting['id_group_customer'];?>">
                            <div class="row">
                                <div class="col-lg-6 input-contact">
                                    <label>Họ và tên *</label>
                                    <input type="text" class="form-control" name="name" required="" placeholder="">
                                </div>

                                <div class="col-lg-6 input-contact">
                                    <label>Số điện thoại *</label>
                                    <input type="text" class="form-control" name="phone" required="" placeholder="">
                                </div>

                                <div class="col-lg-6 input-contact">
                                    <label>Email</label>
                                    <input type="text" class="form-control" name="email" placeholder="">
                                </div>

                                <div class="col-lg-6 input-contact">
                                    <label>Ảnh đại diện của bạn *</label>
                                    <input type="file" class="form-control" name="avatar" required="" placeholder="">
                                </div>

                                <div class="button-link">
                                    <button type="submit">Đăng ký</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-lg-6 form-right">
                    <div class="form-img">
                        <img src="<?php echo show_text_clone(@$setting['image_lh']) ?>" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="section-learn">
        <div class="container">
            <div class="section-title text-center m-auto">
                <div class="title-small">
                    <span><?php echo show_text_clone(@$setting['title_sp_nho']) ?></span>
                </div>

                <div class="title-big">
                    <span><?php echo show_text_clone(@$setting['title_sp_to']) ?></span>
                </div>

                <div class="title-description">
                    <p><?php echo show_text_clone(@$setting['content_sp']) ?></p>
                </div>
            </div>

            <div class="learn-content">
                <div class="row">
                    <div class="col-lg-4 col-md-12">
                        <div class="learn-item">
                            <div class="learn-img">
                                <img src="<?php echo show_text_clone(@$setting['image_sp_1']) ?>" alt="">
                            </div>

                            <div class="learn-detail">
                                <div class="learn-name">
                                    <span><?php echo show_text_clone(@$setting['title_sp_1']) ?></span>
                                </div>

                                <div class="learn-description">
                                    <p><?php echo show_text_clone(@$setting['content_sp_1']) ?></p>
                                </div>

                                <div class="learn-price">
                                    <span class="price-number"><?php echo show_text_clone(@$setting['price_sp_1']) ?></span>
                                </div>

                                <div class="button-link">
                                    <a href="<?php echo show_text_clone(@$setting['link_sp_1']) ?>">Đăng ký ngay</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <div class="learn-item">
                            <div class="learn-img">
                                <img src="<?php echo show_text_clone(@$setting['image_sp_2']) ?>" alt="">
                            </div>

                            <div class="learn-detail">
                                <div class="learn-name">
                                    <span><?php echo show_text_clone(@$setting['title_sp_2']) ?></span>
                                </div>

                                <div class="learn-description">
                                    <p><?php echo show_text_clone(@$setting['content_sp_2']) ?></p>
                                </div>

                                <div class="learn-price">
                                    <span class="price-number"><?php echo show_text_clone(@$setting['price_sp_2']) ?></span>
                                </div>

                                <div class="button-link">
                                    <a href="<?php echo show_text_clone(@$setting['link_sp_2']) ?>">Đăng ký ngay</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <div class="learn-item">
                            <div class="learn-img">
                                <img src="<?php echo show_text_clone(@$setting['image_sp_3']) ?>" alt="">
                            </div>

                            <div class="learn-detail">
                                <div class="learn-name">
                                    <span><?php echo show_text_clone(@$setting['title_sp_3']) ?></span>
                                </div>

                                <div class="learn-description">
                                    <p><?php echo show_text_clone(@$setting['content_sp_3']) ?></p>
                                </div>

                                <div class="learn-price">
                                    <span class="price-number"><?php echo show_text_clone(@$setting['price_sp_3']) ?></span>
                                </div>

                                <div class="button-link">
                                    <a href="<?php echo show_text_clone(@$setting['link_sp_3']) ?>">Đăng ký ngay</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </section>
    
    <?php 
    if(function_exists('getListFeedback')){
        $getListFeedback = getListFeedback();

        if(!empty($getListFeedback)){
            echo '<section id="section-comment" style="background-image: url('.show_text_clone(@$setting['background_feedback']).');">
                    <div class="container">
                        <div class="comment-list">';
                            foreach($getListFeedback as $item){
                                echo '  <div class="comment-item">
                                            <div class="comment-content">
                                                <p>'.@$item->content.'</p>
                                            </div>

                                            <div class="comment-img">
                                                <img src="'.@$item->avatar.'" alt="">
                                            </div>

                                            <div class="comment-name">
                                                <span>'.@$item->full_name.'</span>
                                            </div>
                                        </div>';
                            }

                echo '  </div>
                    </div>
                </section>';
        } 
    }
    ?>

    <?php if(!empty($listDataNew)){ ?>
    <section id="section-news">
        <div class="container">
            <div class="section-title text-center m-auto">
                <div class="title-small">
                    <span><?php echo show_text_clone(@$setting['title_tt_nho']) ?></span>
                </div>

                <div class="title-big">
                    <span><?php echo show_text_clone(@$setting['title_tt_to']) ?></span>
                </div>

                <div class="title-description">
                    <p><?php echo show_text_clone(@$setting['content_tt']) ?></p>
                </div>
            </div>
            <div class="news-list">
                <?php 
                    foreach($listDataNew as $item){
                        echo '<div class="news-item">
                    <div class="news-img">
                        <a href="/'.@$item->slug.'.html"><img src="'.@$item->image.'" alt=""></a>
                    </div>

                    <div class="news-text">
                        <div class="news-name">
                            <a href="/'.@$item->slug.'.html">'.@$item->title.'</a>
                        </div>

                        <div class="news-link">
                            <a href="/'.@$item->slug.'.html">Xem thêm</a>
                        </div>
                    </div>
                </div>';
                    }
                ?>
            </div>
        </div>
    </section>
    <?php }?>
    
</main>

<?php getFooter();?>