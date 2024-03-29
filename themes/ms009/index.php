<?php
getHeader();
global $urlThemeActive;
?>
<main>
    <section id="section-banner" style="background-image: url(<?php echo @$setting['background_top'] ?>);">
        <div class="banner-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 banner-left">
                        <div class="banner-left-inner">
                            <div class="banner-title-small">
                                <p><?php echo @$setting['title_top_nho'] ?></p>
                            </div>
                            <div class="banner-title-big">
                                <h2><?php echo @$setting['title_top_to'] ?></h2>
                            </div>
                            <div class="banner-description">
                                <p><?php echo @$setting['content_top'] ?></p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 banner-right">
                        <div class="banner-right-img">
                            <img src="<?php echo @$setting['image_top'] ?>" alt="">
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
                    <span><?php echo @$setting['title_dv_nho'] ?></span>
                </div>

                <div class="title-big">
                    <span><?php echo @$setting['title_dv_to'] ?></span>
                </div>

                <div class="title-description">
                    <p><?php echo @$setting['content_dv'] ?></p>
                </div>
            </div>

            <div class="service-list">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="service-item">
                            <div class="service-img">
                                <img src="<?php echo @$setting['image_dv_1'] ?>" alt="">                                
                            </div> 

                            <div class="service-detail">
                                <div class="service-item-title">
                                    <p><?php echo @$setting['title_dv_1'] ?></p>
                                </div>

                                <div class="service-item-description">
                                    <p><?php echo @$setting['content_dv_1'] ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="service-item">
                            <div class="service-img">
                                <img src="<?php echo @$setting['image_dv_2'] ?>" alt="">                                
                            </div> 

                            <div class="service-detail">
                                <div class="service-item-title">
                                    <p><?php echo @$setting['title_dv_2'] ?></p>
                                </div>

                                <div class="service-item-description">
                                    <p><?php echo @$setting['content_dv_2'] ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="service-item">
                            <div class="service-img">
                                <img src="<?php echo @$setting['image_dv_3'] ?>" alt="">                                
                            </div> 

                            <div class="service-detail">
                                <div class="service-item-title">
                                    <p><?php echo @$setting['title_dv_3'] ?></p>
                                </div>

                                <div class="service-item-description">
                                    <p><?php echo @$setting['content_dv_3'] ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-lg-3">
                        <div class="service-item">
                            <div class="service-img">
                                <img src="<?php echo @$setting['image_dv_4'] ?>" alt="">                                
                            </div> 

                            <div class="service-detail">
                                <div class="service-item-title">
                                    <p><?php echo @$setting['title_dv_4'] ?></p>
                                </div>

                                <div class="service-item-description">
                                    <p><?php echo @$setting['content_dv_4'] ?></p>
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
                        <img src="<?php echo @$setting['image_gt'] ?>" alt="">
                    </div>
                </div>

                <div class="col-lg-6 col-md-12 about-right">
                    <div class="section-title">
                        <div class="title-small">
                            <span><?php echo @$setting['title_gt_nho'] ?></span>
                        </div>

                        <div class="title-big">
                            <span><?php echo @$setting['title_gt_to'] ?></span>
                        </div>

                        <div class="title-description">
                            <p><?php echo @$setting['content_gt_den'] ?></p>
                        </div>
                    </div>

                    <div class="about-content">
                        <p><?php echo @$setting['content_gt_tim'] ?></p>
                        <div class="button-link">
                            <a href="<?php echo @$setting['link_gt'] ?>">Xem thêm</a>
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
                    <span><?php echo @$setting['title_ds_nho'] ?></span>
                </div>

                <div class="title-big">
                    <span><?php echo @$setting['title_ds_to'] ?></span>
                </div>

                <div class="title-description">
                    <p><?php echo @$setting['content_ds'] ?></p>
                </div>
            </div>

            <div class="why-content">
                <div class="row">
                    <div class="col-lg-4 col-md-12">
                        <div class="why-item-left">
                            <div class="why-box">
                                <div class="icon-box-text text-end">
                                    <div class="icon-title">
                                        <span><?php echo @$setting['title_ds_1'] ?></span>
                                    </div>

                                    <div class="icon-description">
                                        <span><?php echo @$setting['content_ds_1'] ?></span>
                                    </div>
                                </div>

                                <div class="icon-box-img">
                                    <img src="<?php echo $urlThemeActive ?>/asset/image/check-01.png" alt="">
                                </div>
                            </div>

                            <div class="why-box box-padding-right">
                                <div class="icon-box-text text-end">
                                    <div class="icon-title">
                                        <span><?php echo @$setting['title_ds_2'] ?></span>
                                    </div>

                                    <div class="icon-description">
                                        <span><?php echo @$setting['content_ds_2'] ?></span>
                                    </div>
                                </div>

                                <div class="icon-box-img">
                                    <img src="<?php echo $urlThemeActive ?>/asset/image/check-01.png" alt="">
                                </div>
                            </div>

                            <div class="why-box box-padding-right">
                                <div class="icon-box-text text-end">
                                    <div class="icon-title">
                                        <span><?php echo @$setting['title_ds_3'] ?></span>
                                    </div>

                                    <div class="icon-description">
                                        <span><?php echo @$setting['content_ds_3'] ?></span>
                                    </div>
                                </div>

                                <div class="icon-box-img">
                                    <img src="<?php echo $urlThemeActive ?>/asset/image/check-01.png" alt="">
                                </div>
                            </div>

                            <div class="why-box">
                                <div class="icon-box-text text-end">
                                    <div class="icon-title">
                                        <span><?php echo @$setting['title_ds_4'] ?></span>
                                    </div>

                                    <div class="icon-description">
                                        <span><?php echo @$setting['content_ds_4'] ?></span>
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
                                <img src="<?php echo @$setting['image_ds'] ?>" alt="">
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
                                        <span><?php echo @$setting['title_ds_5'] ?></span>
                                    </div>

                                    <div class="icon-description">
                                        <span><?php echo @$setting['content_ds_5'] ?></span>
                                    </div>
                                </div>
                            </div>

                            <div class="why-box box-padding-left">
                                <div class="icon-box-img">
                                    <img src="<?php echo $urlThemeActive ?>/asset/image/check-01.png" alt="">
                                </div>

                                <div class="icon-box-text text-start">
                                    <div class="icon-title">
                                        <span><?php echo @$setting['title_ds_6'] ?></span>
                                    </div>

                                    <div class="icon-description">
                                        <span><?php echo @$setting['content_ds_6'] ?></span>
                                    </div>
                                </div>
                            </div>

                            <div class="why-box box-padding-left">
                                <div class="icon-box-img">
                                    <img src="<?php echo $urlThemeActive ?>/asset/image/check-01.png" alt="">
                                </div>

                                <div class="icon-box-text text-start">
                                    <div class="icon-title">
                                        <span><?php echo @$setting['title_ds_7'] ?></span>
                                    </div>

                                    <div class="icon-description">
                                        <span><?php echo @$setting['content_ds_7'] ?></span>
                                    </div>
                                </div>
                            </div>

                            <div class="why-box">
                                <div class="icon-box-img">
                                    <img src="<?php echo $urlThemeActive ?>/asset/image/check-01.png" alt="">
                                </div>

                                <div class="icon-box-text text-start">
                                    <div class="icon-title">
                                        <span><?php echo @$setting['title_ds_8'] ?></span>
                                    </div>

                                    <div class="icon-description">
                                        <span><?php echo @$setting['content_ds_8'] ?></span>
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
                                <span><?php echo @$setting['title_lh_nho'] ?></span>
                            </div>

                            <div class="title-big">
                                <span><?php echo @$setting['title_lh_to'] ?></span>
                            </div>
                             <p id="success"></p>
                        </div>
                        <form action="" id="myForm">
                            <div class="row">
                                <div class="col-lg-6 input-contact">
                                    <input type="text" class="form-control" id="name" required="" placeholder="Họ và tên">
                                </div>

                                <div class="col-lg-6 input-contact">
                                    <input type="text" class="form-control" id="phone" required="" placeholder="Số điện thoại">
                                </div>

                                <div class="col-lg-6 input-contact">
                                    <input type="text" class="form-control" id="" required="" placeholder="Email">
                                </div>

                                <div class="col-lg-6 input-contact">
                                    <input type="text" class="form-control" id="subject" required="" placeholder="Chủ đề">
                                </div>

                                <div class="col-lg-12 input-contact">
                                    <textarea class="form-control" id="content" required="" placeholder="Nội dung" rows="6" cols="40"></textarea>
                                </div>

                                <div class="button-link">
                                    <button type="button" onclick="contact()">Gửi</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-lg-6 form-right">
                    <div class="form-img">
                        <img src="<?php echo @$setting['image_lh'] ?>" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="section-learn">
        <div class="container">
            <div class="section-title text-center m-auto">
                <div class="title-small">
                    <span><?php echo @$setting['title_sp_nho'] ?></span>
                </div>

                <div class="title-big">
                    <span><?php echo @$setting['title_sp_to'] ?></span>
                </div>

                <div class="title-description">
                    <p><?php echo @$setting['content_sp'] ?></p>
                </div>
            </div>

            <div class="learn-content">
                <div class="row">
                    <div class="col-lg-4 col-md-12">
                        <div class="learn-item">
                            <div class="learn-img">
                                <img src="<?php echo @$setting['image_sp_1'] ?>" alt="">
                            </div>

                            <div class="learn-detail">
                                <div class="learn-name">
                                    <span><?php echo @$setting['title_sp_1'] ?></span>
                                </div>

                                <div class="learn-description">
                                    <p><?php echo @$setting['content_sp_1'] ?></p>
                                </div>

                                <div class="learn-price">
                                    <span class="price-number"><?php echo @$setting['price_sp_1'] ?></span>
                                </div>

                                <div class="button-link">
                                    <a href="<?php echo @$setting['link_sp_1'] ?>">Đăng ký ngay</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <div class="learn-item">
                            <div class="learn-img">
                                <img src="<?php echo @$setting['image_sp_2'] ?>" alt="">
                            </div>

                            <div class="learn-detail">
                                <div class="learn-name">
                                    <span><?php echo @$setting['title_sp_2'] ?></span>
                                </div>

                                <div class="learn-description">
                                    <p><?php echo @$setting['content_sp_2'] ?></p>
                                </div>

                                <div class="learn-price">
                                    <span class="price-number"><?php echo @$setting['price_sp_2'] ?></span>
                                </div>

                                <div class="button-link">
                                    <a href="<?php echo @$setting['link_sp_2'] ?>">Đăng ký ngay</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <div class="learn-item">
                            <div class="learn-img">
                                <img src="<?php echo @$setting['image_sp_3'] ?>" alt="">
                            </div>

                            <div class="learn-detail">
                                <div class="learn-name">
                                    <span><?php echo @$setting['title_sp_3'] ?></span>
                                </div>

                                <div class="learn-description">
                                    <p><?php echo @$setting['content_sp_3'] ?></p>
                                </div>

                                <div class="learn-price">
                                    <span class="price-number"><?php echo @$setting['price_sp_3'] ?></span>
                                </div>

                                <div class="button-link">
                                    <a href="<?php echo @$setting['link_sp_3'] ?>">Đăng ký ngay</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </section>

    <section id="section-comment" style="background-image: url(<?php echo @$setting['background_feedback'] ?>);">
        <div class="container">
            <div class="comment-list">
                <?php if(!empty(getListFeedback())){
                            foreach(getListFeedback() as $item){
                                echo '<div class="comment-item">
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
                } ?>
                

                
            </div>
        </div>
    </section>

    <section id="section-news">
        <div class="container">
            <div class="section-title text-center m-auto">
                <div class="title-small">
                    <span><?php echo @$setting['title_tt_nho'] ?></span>
                </div>

                <div class="title-big">
                    <span><?php echo @$setting['title_tt_to'] ?></span>
                </div>

                <div class="title-description">
                    <p><?php echo @$setting['content_tt'] ?></p>
                </div>
            </div>
            <div class="news-list">
                <?php if(!empty($listDataNew)){
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
                } ?>
                

             
            </div>
        </div>
    </section>
</main>
<script type="text/javascript">
        function contact(){
            var name = $('#name').val();
            var email = $('#email').val();
            var phone = $('#phone').val();
            var content = $('#massage').val();
  console.log(name);
            $.ajax({
            method: 'POST',
             url: "/apis/contactAPI",
            data: {
                name: name,
                phone: phone,  
                email: email,
                subject: 'Đăng ký hóa học',
                content: content,  
               },
                /*success:function(res){
                  document.getElementById("success").innerHTML = 'bạn đăng ký thành công';
                  var myForm = document.getElementById("myForm");
                  
                }*/
            }).done(function(msg) {
                    console.log(msg);
                    
                    var html = '<p>'+msg.mess+'</p>';
                    document.getElementById("success").innerHTML = html;

                    var myForm = document.getElementById("myForm");
                    myForm.reset();

                });
        }
    </script>
<?php
getFooter();?>
