<?php
getHeader();
global $urlThemeActive;

$setting = setting();
?>
        <!-- SLider -->
        <div class="slider" style="background-image: url(<?php echo show_text_clone(@$setting['background_top']);?>);">
            <div class="boss-img">
                <img src="<?php echo show_text_clone(@$setting['image_Portrait']);?>" alt="">
            </div>
            <div class="container">
                <div class="row">
                    <div class="slider-box">
                        <h1><?php echo show_text_clone(@$setting['full_name']);?></h1>
                        <h3><?php echo show_text_clone(@$setting['content_top1']);?></h3>
                        <p><?php echo show_text_clone(@$setting['content_top2']);?></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Button -->
        <div class="slide-btn">
            <div class="language-btn">
                
            </div>
            <div class="slide-video-btn">
                <a id="openModalVideo">
                    <i class="fa-solid fa-play" style="color: #ffffff;"></i>
                </a>
            </div>
            <div class="slide-contact-icon">
                <ul>
                    <li><a href=""><i class="fa-brands fa-facebook"></i></a></li>
                    <li><a href=""><i class="fa-brands fa-square-x-twitter"></i></a></li>
                    <li><a href=""><i class="fa-brands fa-linkedin-in"></i></a></li>
                    <li><a href=""><i class="fa-brands fa-instagram"></i></a></li>
                </ul>
            </div>
        </div>

        <div id="modal-video">
            <iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo show_text_clone(@$setting['code_videoyoutube']);?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                allowfullscreen></iframe> </div>

    </section>

    <section id="about" style="background-image: url(<?php echo show_text_clone(@$setting['background_2']);?>);">
        <div class="overlay"></div>
        <div class="container">
            
            <div class="row">
                <div class="col-lg-5 col-md-12 col-sm-12">
                    <div class="about-thumb">
                        <img src="<?php echo show_text_clone(@$setting['image_Portrait2']);?>" alt="">
                    </div>
                </div>
                <div class="col-lg-7 col-md-12 col-sm-12">
                    <div class="about-title">
                        <h2><span><?php echo show_text_clone(@$setting['full_name']);?></span> là ai?</h2>
                    </div>
                    <div class="about-content">
                        <h3> 
                            <?php echo @$session->read('infoMemberWeb')->name_position;?> <span><?php echo show_text_clone(@$setting['full_name']);?></span>
                        </h3>

                        <p><?php echo show_text_clone(@$setting['content_2']);?></p>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <div class="about-detail first">
                                <div class="content">
                                    <h2>Họ và tên</h2>
                                    <p><?php echo show_text_clone(@$setting['full_name']);?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <div class="about-detail">
                                <div class="content">
                                    <h2>Email</h2>
                                    <p><?php echo show_text_clone(@$setting['email']);?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <div class="about-detail">
                                <div class="content">
                                    <h2>Địa chỉ</h2>
                                    <p><?php echo show_text_clone(@$setting['address']);?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <div class="about-detail">
                                <div class="content">
                                    <h2>Số điện thoại</h2>
                                    <p><?php echo show_text_clone(@$setting['phone']);?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <section id="services">
        <div class="container">
            <div class="row">
                <div class="services-title">
                    <h2>Tôi <span>có thể giúp gì</span> cho bạn?</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="services-box">
                        <div class="services-icon">
                            <i class="<?php echo show_text_clone(@$setting['icon1']);?>"></i>
                        </div>
                        <div class="services-detail">
                            <h2>
                                <?php echo show_text_clone(@$setting['service1']);?>
                            </h2>
                            <p><?php echo show_text_clone(@$setting['content_service1']);?></p>
                        </div>
                        <div class="services-btn">
                            <!-- <a href="">
                                Read more
                            </a> -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="services-box">
                        <div class="services-icon">
                            <i class="<?php echo show_text_clone(@$setting['icon2']);?>"></i>
                        </div>
                        <div class="services-detail">
                            <h2>
                                <?php echo show_text_clone(@$setting['service2']);?>
                            </h2>
                            <p><?php echo show_text_clone(@$setting['content_service2']);?></p>
                        </div>
                        <div class="services-btn">
                            <!-- <a href="">
                                Read more
                            </a> -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="services-box">
                        <div class="services-icon">
                            <i class="<?php echo show_text_clone(@$setting['icon3']);?>"></i>
                        </div>
                        <div class="services-detail">
                            <h2>
                                <?php echo show_text_clone(@$setting['service3']);?>
                            </h2>
                            <p><?php echo show_text_clone(@$setting['content_service3']);?></p>
                        </div>
                        <div class="services-btn">
                            <!-- <a href="">
                                Read more
                            </a> -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="services-box">
                        <div class="services-icon">
                            <i class="<?php echo show_text_clone(@$setting['icon4']);?>"></i>
                        </div>
                        <div class="services-detail">
                            <h2>
                                <?php echo show_text_clone(@$setting['service4']);?>
                            </h2>
                            <p><?php echo show_text_clone(@$setting['content_service4']);?></p>
                        </div>
                        <div class="services-btn">
                            <!-- <a href="">
                                Read more
                            </a> -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="services-box">
                        <div class="services-icon">
                            <i class="<?php echo show_text_clone(@$setting['icon5']);?>"></i>
                        </div>
                        <div class="services-detail">
                            <h2>
                                <?php echo show_text_clone(@$setting['service5']);?>
                            </h2>
                            <p><?php echo show_text_clone(@$setting['content_service5']);?></p>
                        </div>
                        <div class="services-btn">
                            <!-- <a href="">
                                Read more
                            </a> -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="services-box">
                        <div class="services-icon">
                            <i class="<?php echo show_text_clone(@$setting['icon6']);?>"></i>
                        </div>
                        <div class="services-detail">
                            <h2>
                                <?php echo show_text_clone(@$setting['service6']);?>
                            </h2>
                            <p><?php echo show_text_clone(@$setting['content_service6']);?></p>
                        </div>
                        <div class="services-btn">
                            <!-- <a href="">
                                Read more
                            </a> -->
                        </div>
                    </div>
                </div>
               
            </div>
        </div>
    </section>

    <section id="brand" style="background-image: url(<?php echo show_text_clone(@$setting['background_3']);?>);">
        <div class="container">
            <div class="row">
                <div class="brand-slide">
                    <?php if(!empty($album_home1->imageinfo)){
                    foreach($album_home1->imageinfo as $item)
                   echo'<div class="item-brand-slide">
                        <img src="'.@$item->image.'" alt="">
                    </div>';
               } ?>
                    
                </div>
            </div>
        </div>
    </section>

 

    <section id="related-images">
        <div class="related-title">
            <h2>
                Hình ảnh đội nhóm của tôi <span></span>
            </h2>
        </div>
        <div class="container">

            <div class="list-images">
                 <?php if(!empty($album_home2->imageinfo)){
                    foreach($album_home2->imageinfo as $item)
                   echo'<div class="item-image">
                        <img src="'.@$item->image.'" alt="">
                    </div>';
               } ?>
                
            </div>
        </div>
        </div>
    </section>


    <section id="testimonial" style="background-image: url(<?php echo show_text_clone(@$setting['background_4']);?>);">

        <div class="testimonial-overlay"></div>

        <div class="container">
            <div class="row">
                <div class="testimonial-title">
                    <!-- <p>TESTIMONIAL</p> -->
                    <h2>
                        Mọi người <span>đã nói gì</span> về tôi?
                    </h2>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <div class="testimonial-content">
                        <div class="testimonial-detail">
                            <h5>Khách hàng đã nói gì?</h5>
                            <h3><?php echo show_text_clone(@$setting['textred']);?></h3>
                            <p><?php echo show_text_clone(@$setting['textwhite']);?></p>
                        </div>
                        <div class="testimonial-btn">
                            <a href="">
                                <i class="fa-solid fa-user-tie"></i> Để lại cảm nhận
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-12 col-sm-12">
                    <div class="testimonial-slide">
                        <?php 
                        if(function_exists('getListFeedback')) $feedBack= getListFeedback();
                        
                        if(!empty($feedBack)){
                            foreach($feedBack as $item){
                                echo ' <div class="item-testimonial-slide">
                            <div class="person-detail">
                                <div class="person-img">
                                    <img src="'.$item->avatar.'" alt="">
                                </div>
                                <div class="person-name">
                                    <h3>'.$item->full_name.'</h3>
                                    <p>'.$item->position.'</p>
                                </div>
                            </div>
                            <div class="testimonial-slide-text">
                                <p>'.$item->content.'</p>
                            </div>
                            <div class="testimonial-slide-icon">
                                <ul>
                                    <li><i class="fa-solid fa-star"></i></li>
                                    <li><i class="fa-solid fa-star"></i></li>
                                    <li><i class="fa-solid fa-star"></i></li>
                                    <li><i class="fa-solid fa-star"></i></li>
                                    <li><i class="fa-solid fa-star"></i></li>
                                </ul>
                                <p>/ 5</p>
                            </div>
                            <div class="img99">
                                <img src="<?php echo $urlThemeActive; ?>/image/quote.png " alt="">
                            </div>
                        </div>';
                    }
                }?>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="blog">
        <div class="container">
            <div class="row">
                <div class="blog-title">
                    <div class="blog-title">
                        <p>Khóa học</p>
                        <h2>
                            Các sự kiện mà tôi đã tham gia<span></span>
                        </h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php if(!empty($listDataNew)){
                    foreach($listDataNew as $item){
                        echo '<div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="blog-box">
                        <div class="block-img">
                            <img src="'.$item->image.'" alt="">
                            <!-- <div class="blog-btn">
                                <a href="#">
                                    Xem thêm
                                </a>
                            </div> -->
                        </div>
                        <div class="blog-box-content">
                            <!-- <span>March 8, 2023</span> -->
                            <h2><a href="/'.$item->slug.'.html">'.$item->title.'</a></h2>
                            <p>'.$item->description.'</p>
                        </div>
                    </div>
                </div>';
                    }
                } ?>
                


                
            </div>
        </div>
    </section>

<?php
getFooter();?>