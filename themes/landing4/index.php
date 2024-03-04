<?php
getHeader();
global $urlThemeActive;
?>
<main>
    <section id="section-banner">
        <div class="banner-home" style="background-image: url(<?php echo @$setting['background_top'];?>);">
            <div class="banner-overlay"></div>
            <div class="banner-content">
                <div class="container">
                    <div class="content-box">
                        <div class="content-first">
                            <p><?php echo @$setting['title_top_nho'];?></p>
                        </div>
                        <div class="content-second">
                            <h1><?php echo @$setting['title_top_to'];?></h1>
                        </div>
                        <div class="content-third">
                            <span><?php echo @$setting['content_top'];?></span>
                        </div>

                        <div class="content-btn">
                            <a href="<?php echo @$setting['link_top'];?>">Đăng ký</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="section-introduce" class="section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-5 col-sm-6 col-xs-12 introduce-left">
                    <div class="introduce-avata" data-aos="fade-right">
                        <img src="<?php echo @$setting['image_avatar'];?>" alt="">
                    </div>
                </div>

                <div class="col-md-7 col-sm-6 col-xs-12 introduce-right" data-aos="fade-left">
                    <div class="section-title" data-aos="flip-up" data-aos-duration="4000">
                        <div class="block-title">
                            <p class="justify-content-start">
                                <span></span>
                                Giới thiệu về tôi
                            </p>
                        </div>
                    </div>
                    <div class="introduce-content">
                        <div class="introduce-title">
                            <h4><?php echo @$setting['title_2'];?></h4>
                        </div>
                        <div class="introduce-detail">
                            <p><?php echo @$setting['content_1'];?></p>
                        </div>

                        <div class="introduce-info">
                            <div class="introduce-info-item">
                                <div class="introduce-icon">
                                    <i class="<?php echo @$setting['icon_mn_1'];?>"></i>
                                </div>

                                <div class="introduce-intro-text">
                                    <div class="introduce-intro-tiitle">
                                      <?php echo @$setting['title_mn_1'];?>
                                  </div>

                                  <div class="introduce-intro-description">
                                     <?php echo @$setting['content_mn_1'];?>
                                 </div>
                             </div>
                         </div>
                         <div class="introduce-info-item">
                            <div class="introduce-icon">
                                <i class="<?php echo @$setting['icon_mn_2'];?>"></i>
                            </div>

                            <div class="introduce-intro-text">
                                <div class="introduce-intro-tiitle">
                                  <?php echo @$setting['title_mn_2'];?>
                              </div>

                              <div class="introduce-intro-description">
                                 <?php echo @$setting['content_mn_2'];?>
                             </div>
                         </div>
                     </div>
                     <div class="introduce-info-item">
                        <div class="introduce-icon">
                            <i class="<?php echo @$setting['icon_mn_3'];?>"></i>
                        </div>

                        <div class="introduce-intro-text">
                            <div class="introduce-intro-tiitle">
                              <?php echo @$setting['title_mn_3'];?>
                          </div>

                          <div class="introduce-intro-description">
                             <?php echo @$setting['content_mn_3'];?>
                         </div>
                     </div>
                 </div>
                 
             </div>

         </div>
     </div>
 </div>
</div>
</section>

<section id="section-service" class="section-padding">
    <div class="container">
        <div class="section-title text-center" data-aos="flip-up" data-aos-duration="4000">
            <div class="block-title">
                <p>
                    <span></span>
                    Dịch vụ
                </p>
            </div>
            <h3 class="text-center"><?php echo @$setting['title_dichvu'] ?></h3>
            <div class="border-heading"></div>
        </div>

        <div class="service-list">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="service-item">
                        <div class="service-icon">
                            <i class="<?php echo @$setting['icon_dichvu_1'] ?>"></i>
                        </div>
                        
                        <div class="service-name">
                            <p><?php echo @$setting['title_dichvu_1'] ?></p>
                        </div>
                        
                        <div class="service-description">
                            <p><?php echo @$setting['content_dichvu_1'] ?></p>
                        </div>
                        
                        <img  class="img-one" src="<?php echo $urlThemeActive ?>/asset/img/service-shape.png" alt="">
                        <img  class="img-two" src="<?php echo $urlThemeActive ?>/asset/img/service-shape1.png" alt="">
                        
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="service-item">
                        <div class="service-icon">
                            <i class="<?php echo @$setting['icon_dichvu_2'] ?>"></i>
                        </div>
                        
                        <div class="service-name">
                            <p><?php echo @$setting['title_dichvu_2'] ?></p>
                        </div>
                        
                        <div class="service-description">
                            <p><?php echo @$setting['content_dichvu_2'] ?></p>
                        </div>
                        
                        <img  class="img-one" src="<?php echo $urlThemeActive ?>/asset/img/service-shape.png" alt="">
                        <img  class="img-two" src="<?php echo $urlThemeActive ?>/asset/img/service-shape1.png" alt="">
                        
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="service-item">
                        <div class="service-icon">
                            <i class="<?php echo @$setting['icon_dichvu_3'] ?>"></i>
                        </div>
                        
                        <div class="service-name">
                            <p><?php echo @$setting['title_dichvu_3'] ?></p>
                        </div>
                        
                        <div class="service-description">
                            <p><?php echo @$setting['content_dichvu_3'] ?></p>
                        </div>
                        
                        <img  class="img-one" src="<?php echo $urlThemeActive ?>/asset/img/service-shape.png" alt="">
                        <img  class="img-two" src="<?php echo $urlThemeActive ?>/asset/img/service-shape1.png" alt="">
                        
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="service-item">
                        <div class="service-icon">
                            <i class="<?php echo @$setting['icon_dichvu_4'] ?>"></i>
                        </div>
                        
                        <div class="service-name">
                            <p><?php echo @$setting['title_dichvu_4'] ?></p>
                        </div>
                        
                        <div class="service-description">
                            <p><?php echo @$setting['content_dichvu_4'] ?></p>
                        </div>
                        
                        <img  class="img-one" src="<?php echo $urlThemeActive ?>/asset/img/service-shape.png" alt="">
                        <img  class="img-two" src="<?php echo $urlThemeActive ?>/asset/img/service-shape1.png" alt="">
                        
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="service-item">
                        <div class="service-icon">
                            <i class="<?php echo @$setting['icon_dichvu_5'] ?>"></i>
                        </div>
                        
                        <div class="service-name">
                            <p><?php echo @$setting['title_dichvu_5'] ?></p>
                        </div>
                        
                        <div class="service-description">
                            <p><?php echo @$setting['content_dichvu_5'] ?></p>
                        </div>
                        
                        <img  class="img-one" src="<?php echo $urlThemeActive ?>/asset/img/service-shape.png" alt="">
                        <img  class="img-two" src="<?php echo $urlThemeActive ?>/asset/img/service-shape1.png" alt="">
                        
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="service-item">
                        <div class="service-icon">
                            <i class="<?php echo @$setting['icon_dichvu_6'] ?>"></i>
                        </div>
                        
                        <div class="service-name">
                            <p><?php echo @$setting['title_dichvu_6'] ?></p>
                        </div>
                        
                        <div class="service-description">
                            <p><?php echo @$setting['content_dichvu_6'] ?></p>
                        </div>
                        
                        <img  class="img-one" src="<?php echo $urlThemeActive ?>/asset/img/service-shape.png" alt="">
                        <img  class="img-two" src="<?php echo $urlThemeActive ?>/asset/img/service-shape1.png" alt="">
                        
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</section>

<section id="section-library" class="section-padding">
    <div class="container">
        <div class="section-title text-center" data-aos="flip-up" data-aos-duration="4000">
            <div class="block-title">
                <p>
                    <span></span>
                    Thư viện
                </p>
            </div>
            <h3 class="text-center"><?php echo @$setting['title_album'] ?></h3>
            <div class="border-heading"></div>
        </div>

        <div class="library-list" data-aos="zoom-out-left">
            <div class="row">
                <?php if(!empty($album_home->imageinfo)){
                    foreach($album_home->imageinfo as $item){
                        echo ' <div class="col-md-4 col-sm-6 col-xs-12 library-item">
                        <div class="library-image">
                        <a href="'.$item->image.'">
                        <img src="'.$item->image.'" alt="">
                        </a>
                        </div>
                        </div>';
                    }
                } ?>
                

                
            </div>
        </div>
    </div>
</section>

<section id="section-ourteam" class="section-padding">
    <div class="container">
        <div class="section-title text-center" data-aos="flip-up" data-aos-duration="4000">
            <div class="block-title">
                <p>
                    <span></span>
                    Đội ngũ
                </p>
            </div>
            <h3 class="text-center"><?php echo @$setting['title_doingu'] ?></h3>
            <div class="border-heading"></div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="ourteam-item">
                    <div class="ourteam-img">
                        <img src="<?php echo @$setting['image_avatar_1'] ?>" alt="">
                        <ul class="social">
                            <li>
                                <a href="<?php echo @$setting['facebook_1'] ?>">
                                    <i class="fa-brands fa-facebook-f"></i>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo @$setting['twitter_1'] ?>">
                                    <i class="fa-brands fa-twitter"></i>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo @$setting['instagram_1'] ?>">
                                    <i class="fa-brands fa-instagram"></i>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="ourteam-detail">
                        <p class="ourteam-name"><?php echo @$setting['fullname_1'] ?></p>
                        <p class="ourteam-position"><?php echo @$setting['field_1'] ?></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="ourteam-item">
                    <div class="ourteam-img">
                        <img src="<?php echo @$setting['image_avatar_2'] ?>" alt="">
                        <ul class="social">
                            <li>
                                <a href="<?php echo @$setting['facebook_2'] ?>">
                                    <i class="fa-brands fa-facebook-f"></i>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo @$setting['twitter_2'] ?>">
                                    <i class="fa-brands fa-twitter"></i>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo @$setting['instagram_2'] ?>">
                                    <i class="fa-brands fa-instagram"></i>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="ourteam-detail">
                        <p class="ourteam-name"><?php echo @$setting['fullname_2'] ?></p>
                        <p class="ourteam-position"><?php echo @$setting['field_2'] ?></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="ourteam-item">
                    <div class="ourteam-img">
                        <img src="<?php echo @$setting['image_avatar_3'] ?>" alt="">
                        <ul class="social">
                            <li>
                                <a href="<?php echo @$setting['facebook_3'] ?>">
                                    <i class="fa-brands fa-facebook-f"></i>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo @$setting['twitter_3'] ?>">
                                    <i class="fa-brands fa-twitter"></i>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo @$setting['instagram_3'] ?>">
                                    <i class="fa-brands fa-instagram"></i>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="ourteam-detail">
                        <p class="ourteam-name"><?php echo @$setting['fullname_3'] ?></p>
                        <p class="ourteam-position"><?php echo @$setting['field_3'] ?></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="ourteam-item">
                    <div class="ourteam-img">
                        <img src="<?php echo @$setting['image_avatar_4'] ?>" alt="">
                        <ul class="social">
                            <li>
                                <a href="<?php echo @$setting['facebook_4'] ?>">
                                    <i class="fa-brands fa-facebook-f"></i>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo @$setting['twitter_4'] ?>">
                                    <i class="fa-brands fa-twitter"></i>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo @$setting['instagram_4'] ?>">
                                    <i class="fa-brands fa-instagram"></i>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="ourteam-detail">
                        <p class="ourteam-name"><?php echo @$setting['fullname_4'] ?></p>
                        <p class="ourteam-position"><?php echo @$setting['field_4'] ?></p>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</section>

<section id="section-blog" class="section-padding">
    <div class="container">
        <div class="row">
            <div class="section-title text-center" data-aos="flip-up" data-aos-duration="4000">
                <div class="block-title">
                    <p>
                        <span></span>
                        Tin tức
                    </p>
                </div>
                <h3 class="text-center">Tin tức về chúng tôi</h3>
                <div class="border-heading"></div>
            </div>

            <div class="blog-home-slide">
                <?php if(!empty($listDataNew)){
                    foreach($listDataNew as $item){
                        echo '<div class="blog-item-outer">
                        <div class="blog-item">
                        <div class="blog-top">
                        <a href="/'.@$item->slug.'.html">
                        <img src="'.@$item->image.'" alt="">
                        </a>
                        </div>

                        <div class="blog-bottom">
                        <div class="blog-meta">
                            <div class="blog-meta-item">
                                <i class="fa-regular fa-user"></i>                                        
                                <span>'.@$item->author.'</span>
                            </div>

                            <div class="blog-meta-item">
                                <i class="fa-regular fa-calendar"></i>
                                <span>'.date('d-m-Y',$item->time).'</span>
                            </div>
                        </div>

                        <div class="blog-title">
                        <a href="/'.@$item->slug.'.html">'.@$item->title.'</a>
                        </div>

                        <div class="blog-description">
                        <p>'.@$item->description.'</p>
                        </div>

                        <div class="blog-link">
                        <a href="/'.@$item->slug.'.html">Xem thêm</a>
                        </div>
                        </div>
                        </div>
                        </div>';
                    }
                } ?>
            </div>
            

            
        </div>
    </div>
</section>

<section id="section-contact-info" class="section-padding">
    <div class="container">
        <div class="section-title text-center" data-aos="flip-up" data-aos-duration="4000">
            <div class="block-title">
                <p>
                    <span></span>
                    Liên hệ
                </p>
            </div>
            <h3 class="text-center">Thông tin liên hệ</h3>
        </div>

        <div class="contact-info-box">
            <div class="row">
                <div class="col-lg-4 contact-info-item">
                    <div class="contact-info-inner">
                        <div class="contact-info-icon">
                            <i class="<?php echo @$setting['icon_lh_1'] ?>"></i>
                        </div>

                        <div class="contact-info-name">
                            <h4><?php echo @$setting['title_lh_1'] ?></h4>
                        </div>

                        <div class="contact-info-detail">
                            <p><?php echo @$setting['content_lh_1'] ?></p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 contact-info-item">
                    <div class="contact-info-inner">
                        <div class="contact-info-icon">
                            <i class="<?php echo @$setting['icon_lh_2'] ?>"></i>
                        </div>

                        <div class="contact-info-name">
                            <h4><?php echo @$setting['title_lh_2'] ?></h4>
                        </div>

                        <div class="contact-info-detail">
                            <p><?php echo @$setting['content_lh_2'] ?></p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 contact-info-item">
                    <div class="contact-info-inner">
                        <div class="contact-info-icon">
                            <i class="<?php echo @$setting['icon_lh_3'] ?>"></i>
                        </div>

                        <div class="contact-info-name">
                            <h4><?php echo @$setting['title_lh_3'] ?></h4>
                        </div>

                        <div class="contact-info-detail">
                            <p><?php echo @$setting['content_lh_3'] ?></p>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</section>

<section id="section-contact-form" class="section-padding" style="background-image: url(<?php echo @$setting['background_4']; ?>);">
    <div class="banner-overlay"></div>
    <div class="contact-form-box">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-xl-6">
                    <div class="section-title text-center">
                        <h3 class="text-center">Gửi thông tin đăng ký</h3>
                        <div id="messReg" class="text-center"></div>
                    </div>
                    
                    <div class="form-contact">
                        <form action="">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input type="text" id="name" class="form-control" placeholder="Họ và tên" required>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input type="email" id="email" class="form-control" placeholder="Email" required>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <input type="text" id="phone" class="form-control" placeholder="Số điện thoại">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <input type="text" id="subject" class="form-control" placeholder="Chủ đề">
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <textarea name="message" id="message" class="form-control" cols="30" rows="5" required="" placeholder="Nội dung"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <button type="button" onclick="contac();" class="default-btn">Gửi</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</main>

<script>
    // Khai báo một biến để lưu trữ trạng thái của AOS (có animation hay không)
    var aosEnabled = true;

    // Khởi tạo AOS với các cài đặt mặc định
    function initAOS() {
        AOS.init({
            // Các tùy chọn AOS ở đây...
        });
    }

    // Kiểm tra kích thước màn hình và tắt animation nếu cần
    function handleAnimation() {
        if (window.innerWidth < 768) { // Nếu là màn hình nhỏ hơn 768px (ví dụ: điện thoại)
            if (aosEnabled) { // Kiểm tra xem AOS đã được kích hoạt hay chưa
                AOS.init({
                    disable: true // Tắt animation
                });
                aosEnabled = false; // Ghi nhớ rằng AOS đã được tắt
            }
        } else { // Nếu là màn hình lớn hơn hoặc bằng 768px
            if (!aosEnabled) { // Kiểm tra xem AOS đã bị tắt hay chưa
                initAOS(); // Khởi tạo AOS lại để kích hoạt animation
                aosEnabled = true; // Ghi nhớ rằng AOS đã được kích hoạt lại
            }
        }
    }

    // Gọi hàm khi trang được tải và khi cửa sổ được resize
    window.addEventListener('load', function() {
        initAOS(); // Khởi tạo AOS khi trang được tải
        handleAnimation(); // Kiểm tra và tắt animation khi trang được tải
    });
    window.addEventListener('resize', handleAnimation); // Kiểm tra và tắt animation khi cửa sổ được resize
</script>

<script type="text/javascript">
 function contac(){
    var name = $('#name').val();
    var email = $('#email').val();
    var phone = $('#phone').val();
    var subject = $('#subject').val();
    var content = $('#message').val();

    $.ajax({
        method: "POST",
        data: {
            name: name,
            phone: phone,  
            email: email,
            subject: subject,  
            content: content,  
        },
        url: "/apis/contactAPI"
    }).done(function(msg) {
        console.log(msg);
        
        var html = '<p style="color: white;">'+msg.mess+'</p>';
        document.getElementById("messReg").innerHTML = html;

                    // }
                    
                });
}
</script>
<?php
getFooter();?>
