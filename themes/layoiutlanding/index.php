<?php
getHeader();
global $urlThemeActive;
?>
<main>
        <section id="section-banner">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="banner-content d-flex justify-content-center flex-column">
                            <h3>Xin chào!</h3>
                            <h1>
                                <span class="cd-words-wrapper">
                                    <b class="is-visible"><span class="gold-title"><?php echo @$setting['full_name'];?></span></b>
                                </span>
                            </h1>
                            <p><?php echo @$setting['content_top'];?></p>
                            <div class="link-banner">
                                <a href="<?php echo @$setting['link_top'];?>" class="main-button">Đăng ký</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="section-introduce" class="section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-md-5 col-sm-6 col-xs-12">
                        <div class="introduce-avata" data-aos="fade-right">
                            <img src="<?php echo @$setting['image_Portrait'];?>" alt="">
                        </div>
                    </div>

                    <div class="col-md-7 col-sm-6 col-xs-12" data-aos="fade-left">
                        <div class="introduce-content">
                            <h4>Tôi Là Người <span><?php echo @$setting['iamhuman'];?></span></h4>
                            <p><?php echo @$setting['content_2'];?></p>
                            <div class="introduce-detail-list">
                                <div class="introduce-detail-item">
                                    <span>Tên</span>: <?php echo @$setting['fullname'];?>
                                </div>

                                <div class="introduce-detail-item">
                                    <span>Số điện thoại</span>: <?php echo @$setting['phone'];?>
                                </div>

                                <div class="introduce-detail-item">
                                    <span>Email</span>: <?php echo @$setting['email'];?>
                                </div>

                                <div class="introduce-detail-item">
                                    <span>Địa chỉ</span>: <?php echo @$setting['address'];?>
                                </div>

                                <a href="<?php echo @$setting['link_2'];?>" class="btn main-button">Đăng ký</a>
                    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="section-service" class="section-padding">
            <div class="container">
                <div class="section-title text-center" data-aos="flip-up" data-aos-duration="4000">
                    <h2 class="text-center">Dịch <span>vụ</span></h2>
                    <div class="border-heading"></div>
                </div>
                <div class="service-list" data-aos="fade-down">
                    <div class="row">
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="service-item text-center">
                                <div class="service-icon">
                                    <i class="fa-solid fa-heart"></i>
                                </div>

                                <div class="service-title">
                                    <h4><?php echo @$setting['service1'];?></h4>
                                </div>
    
                                <div class="service-description">
                                    <p><?php echo @$setting['content_service1'];?></p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="service-item text-center">
                                <div class="service-icon">
                                    <i class="fa-solid fa-heart"></i>
                                </div>

                                 <div class="service-title">
                                    <h4><?php echo @$setting['service2'];?></h4>
                                </div>
    
                                <div class="service-description">
                                    <p><?php echo @$setting['content_service2'];?></p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="service-item text-center">
                                <div class="service-icon">
                                    <i class="fa-solid fa-heart"></i>
                                </div>

                                <div class="service-title">
                                    <h4><?php echo @$setting['service3'];?></h4>
                                </div>
    
                                <div class="service-description">
                                    <p><?php echo @$setting['content_service3'];?></p>
                                </div>
                            </div>
                        </div>

                        <!-- <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="service-item text-center">
                                <div class="service-icon">
                                    <i class="fa-solid fa-heart"></i>
                                </div>

                                <div class="service-title">
                                    <h4>KIẾN TẠO CUỘC ĐỜI BẠN</h4>
                                </div>
    
                                <div class="service-description">
                                    <p>Chúng tôi là bệ phóng giúp con đường trở thành ngôi sao, trở thành diễn giả hay nhân vật thu hút một cách nhanh chóng.</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="service-item text-center">
                                <div class="service-icon">
                                    <i class="fa-solid fa-heart"></i>
                                </div>

                                <div class="service-title">
                                    <h4>Hỗ trợ</h4>
                                </div>
    
                                <div class="service-description">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed eiusmod tempor 
                                        incididunt ut labore et dolore.</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="service-item text-center">
                                <div class="service-icon">
                                    <i class="fa-solid fa-heart"></i>
                                </div>

                                <div class="service-title">
                                    <h4>Hỗ trợ</h4>
                                </div>
    
                                <div class="service-description">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed eiusmod tempor 
                                        incididunt ut labore et dolore.</p>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </section>
        
        <section id="section-background" style="background-image: url(<?php echo @$setting['background_4'];?>);">
            <div class="container">
                <div class="section-background-title text-center" data-aos="fade-down">
                    <h3><?php echo @$setting['content_4'];?></h3>
                    <a href="<?php echo @$setting['link_4'];?>" class="btn main-button">Đăng ký</a>
                </div>
            </div>
        </section>

        <section id="section-library" class="section-padding">
            <div class="container">
                <div class="section-title text-center" data-aos="flip-up" data-aos-duration="4000">
                    <h2 class="text-center">Thư <span>viện</span></h2>
                    <div class="border-heading"></div>
                </div>

                <div class="library-list" data-aos="zoom-out-left">
                    <div class="row">
                        
                        <?php if(!empty($album_home->imageinfo)){
                            foreach($album_home->imageinfo as $key => $item){
                                echo '<div class="col-md-4 col-sm-6 col-xs-12 library-item">
                                    <div class="library-image">
                                        <a href="'.$item->link.'">
                                            <img src="'.$item->image.'" alt="">
                                        </a>
                                    </div>
                                </div>';
                            }
                        }?>

                        
                    </div>

                    <div class="contact-button text-center">
                        <button type="submit" onclick="loadMore()" class="btn main-button">Xem thêm</button>
                    </div>`  
                </div>
            </div>
        </section>

        <section id="section-background" class="section-count" style="background-image: url(<?php echo @$setting['background_5'];?>);">
            <div class="container">
                <div class="section-background-title list-count text-center">
                    <div class="row">
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="item-count">
                                <h3>
                                    <span><?php echo @$setting['statistics1'];?></span>
                                </h3>
                                <h5><?php echo @$setting['content_statistics1'];?></h5>
                            </div>
                        </div>
    
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="item-count">
                                <h3>
                                    <span><?php echo @$setting['statistics2'];?></span>
                                </h3>
                                <h5><?php echo @$setting['content_statistics2'];?></h5>
                            </div>
                        </div>
    
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="item-count">
                                <h3>
                                    <span><?php echo @$setting['statistics3'];?></span>
                                </h3>
                                <h5><?php echo @$setting['content_statistics3'];?></h5>
                            </div>
                        </div>
    
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="item-count">
                                <h3>
                                    <span><?php echo @$setting['statistics4'];?></span>
                                </h3>
                                <h5><?php echo @$setting['content_statistics4'];?></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="section-blog" class="section-padding">
            <div class="container">
                <div class="section-title text-center" data-aos="flip-up" data-aos-duration="4000">
                    <h2 class="text-center">Tin <span>tức</span></h2>
                    <div class="border-heading"></div>
                </div>

                <div class="blog-list" data-aos="zoom-in">
                   <?php

                        if(!empty($listDataNew)){
                            foreach($listDataNew as $item){
                                
                                echo '<div class="blog-item">
                                        <div class="blog-img">
                                            <a href="/'.@$item->slug.'.html"><img src="'.@$item->image.'" alt=""></a>
                                        </div>

                                        <div class="blog-detail">
                                            <div class="blog-meta">
                                                <i class="fa-regular fa-clock"></i> <span>'.date('d/m/Y', $item->time).'</span>
                                            </div>

                                            <div class="blog-title">
                                                <a href="/'.@$item->slug.'.html">
                                                    <h4>'.@$item->title.'</h4>
                                                </a>
                                            </div>

                                            <div class="blog-description">
                                                <p>'.@$item->description.'</p>
                                            </div>
                                            
                                            <div class="blog-link">
                                                <a href="/'.@$item->slug.'.html">Read More</a>
                                            </div>
                                        </div>
                                    </div>';
                            }
                        }
                    ?>
                    </div>
            </div>
        </section>

        <section id="section-contact" class="section-padding">
            <div class="container">
                <div class="section-title text-center" data-aos="flip-down">
                    <h2 class="text-center">Liên <span>hệ</span></h2>
                    <div class="border-heading"></div>
                </div>

                <div class="form-contact">
                    <form action="/contact" method="post">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <input type="text" class="form-control" name="name" placeholder="Họ và tên" required>
                                <input type="hidden" value="<?php echo $csrfToken; ?>" name="_csrfToken">
                            </div>
    
                            <div class="form-group col-md-4">
                                <input type="email" class="form-control" name="email" placeholder="Email" required>
                            </div>
    
                            <div class="form-group col-md-4">
                                <input type="text" class="form-control" name="subject" placeholder="Chủ đề" required>
                            </div>

                            <div class="form-group col-md-12">
                                <textarea rows="6" name="content" class="form-control" placeholder="Nội dung" required="required"></textarea>
                            </div>
                            
                            <div class="contact-button text-center">
                                <button type="submit" class="btn main-button">Gửi</button>
                            </div>`                                                                                                                                         
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>
<?php
getFooter();?>