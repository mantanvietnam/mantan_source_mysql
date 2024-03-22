<?php
getHeader();
global $urlThemeActive;
?>
    <main>
        <section id="section-banner">
            <img src="<?php echo @$setting['background_top'] ?>" alt="">
        </section>

        <section id="section-introduce">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 introduce-left" data-aos="fade-right">
                        <div class="introduce-img">
                            <img src="<?php echo @$setting['image_avatar'] ?>" alt="">
                        </div>
                    </div>
    
                    <div class="col-lg-9 introduce-right" data-aos="fade-left">
                        <em>"<?php echo @$setting['title_top'] ?>”</em>
                        <p><?php echo nl2br(@$setting['content_top']) ?></p>
                    </div>
                </div>
            </div>
        </section>

        <section id="section-commit" style="background-image: url(<?php echo @$setting['background_2'] ?>);">
            <div class="container" class="text-center">
                <div class="section-title text-center" data-aos="zoom-in-up">
                    <h2><?php echo @$setting['title_ck'] ?></h2>
                    <p><?php echo @$setting['content_ck'] ?></p>
                </div>

                <div class="commit-list" data-aos="zoom-in-up">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="commit-item">
                                <div class="commit-image">
                                    <img src="<?php echo @$setting['image_ck_1'] ?>" alt="">
                                </div>

                                <div class="commit-content">
                                    <div class="commit-title">
                                        <h3><?php echo @$setting['title_ck_1'] ?></h3>
                                    </div>

                                    <div class="commit-description">
                                        <p><?php echo @$setting['content_ck_1'] ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="commit-item">
                                <div class="commit-image">
                                    <img src="<?php echo @$setting['image_ck_2'] ?>" alt="">
                                </div>

                                <div class="commit-content">
                                    <div class="commit-title">
                                        <h3><?php echo @$setting['title_ck_2'] ?></h3>
                                    </div>

                                    <div class="commit-description">
                                        <p><?php echo @$setting['content_ck_2'] ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="commit-item">
                                <div class="commit-image">
                                    <img src="<?php echo @$setting['image_ck_3'] ?>" alt="">
                                </div>

                                <div class="commit-content">
                                    <div class="commit-title">
                                        <h3><?php echo @$setting['title_ck_3'] ?></h3>
                                    </div>

                                    <div class="commit-description">
                                        <p><?php echo @$setting['content_ck_3'] ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>

        <section id="section-special">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6" data-aos="zoom-in-up">
                        <div class="special-img">
                            <img src="<?php echo @$setting['image_avatar1'] ?>" alt="">
                        </div>
                    </div>

                    <div class="col-lg-6" data-aos="zoom-in-down">
                        <div class="special-content">
                            <div class="special-title">
                                <h2><?php echo @$setting['title_gt'] ?></h2>
                            </div>
                            <div class="special-description">
                                <p><?php echo @$setting['content_gt'] ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="section-collection">
            <div class="container">
                <div class="section-title text-center" data-aos="zoom-in-up">
                    <h2><?php echo @$setting['title_al'] ?></h2>
                    <p><?php echo @$setting['content_al'] ?></p>
                </div>
            </div>

            <div class="container-fluid">
                <div class="collection-list" data-aos="zoom-in-left">
                   <?php if(!empty($album_home->imageinfo)){
                        foreach($album_home->imageinfo as $item){
                            echo '<div class="collection-item">
                        <div class="collection-item-inner">
                            <a href="'.@$item->image.'">
                                <img src="'.@$item->image.'" alt="">
                            </a>
                        </div>
                    </div>';
                        }
                   } ?>
                    

                </div>
            </div>
        </section>

        <section id="section-service" style="background-image: url(<?php echo @$setting['background_5'] ?>);">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5">
                        <div class="service-left" data-aos="zoom-in-right">
                            <div class="service-img">
                                <img src="<?php echo @$setting['image_3'] ?>" alt="">
                                <div class="service-left-text">
                                    <p><?php echo @$setting['content_dv_image'] ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-7">
                        <div class="service-right" data-aos="zoom-in-left">
                            <div class="section-title">
                                <h2><?php echo @$setting['title_dv'] ?></h2>
                                <p><?php echo @$setting['content_dv'] ?></p>
                            </div>

                            <div class="service-right-list">
                                <div class="service-right-item">
                                    <div class="service-right-img">
                                        <img src="<?php echo @$setting['image_dv_1'] ?>" alt="">
                                    </div>

                                    <div class="service-right-detail">
                                        <div class="service-right-title">
                                            <h3><?php echo @$setting['title_dv_1'] ?></h3>
                                        </div>

                                        <div class="service-right-description">
                                            <p><?php echo @$setting['content_dv_1'] ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="service-right-item">
                                    <div class="service-right-img">
                                        <img src="<?php echo @$setting['image_dv_2'] ?>" alt="">
                                    </div>

                                    <div class="service-right-detail">
                                        <div class="service-right-title">
                                            <h3><?php echo @$setting['title_dv_2'] ?></h3>
                                        </div>

                                        <div class="service-right-description">
                                            <p><?php echo @$setting['content_dv_2'] ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="service-right-item">
                                    <div class="service-right-img">
                                        <img src="<?php echo @$setting['image_dv_3'] ?>" alt="">
                                    </div>

                                    <div class="service-right-detail">
                                        <div class="service-right-title">
                                            <h3><?php echo @$setting['title_dv_3'] ?></h3>
                                        </div>

                                        <div class="service-right-description">
                                            <p><?php echo @$setting['content_dv_3'] ?></p>
                                        </div>
                                    </div>
                                </div>

                                
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="section-contact" style="background-image: url(<?php echo @$setting['background_6'] ?>);">
            <div class="container">
                <div class="section-title text-center" data-aos="zoom-in-up">
                    <h2><?php echo @$setting['title_lh'] ?></h2>
                    <p><?php echo @$setting['content_lh'] ?></p>
                </div>

                <div class="link-phone text-center" data-aos="zoom-in-up">
                    <div class="link-phone-item">
                        <a href="<?php echo @$setting['phone'] ?>">
                            <i class="fa-solid fa-phone"></i>
                            <span><?php echo @$setting['phone'] ?></span>
                        </a>
                    </div>

                    <div class="link-phone-text">
                        <p><?php echo @$setting['content_lh2'] ?></p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="contact-content" data-aos="zoom-out-up">
                            <div class="contact-form">
                                <form action="">
                                    <div class="form-title">
                                        <p><?php echo @$setting['title_gtf'] ?></p>
                                    </div>

                                    <div class="form-description">
                                        <p><?php echo nl2br(@$setting['content_lht']); ?></p>
                                    </div>
                                    <div id="success"></div>
                                    <div class="form-box">
                                        <div class="mb-3">
                                            <input type="text" class="form-control" id="name" placeholder="Họ và tên..." aria-describedby="emailHelp" required>
                                        </div>

                                        <div class="mb-3">
                                            <input type="email" class="form-control" id="email" placeholder="Email..." required>
                                        </div>

                                        <div class="mb-3">
                                            <input type="phone" class="form-control" id="phone" placeholder="Số điện thoại...">
                                        </div>

                                        <div class="mb-3">
                                            <textarea name="textarea-861" id='massage' cols="40" rows="7" class="form-control"  placeholder="Ghi chú thêm..."></textarea>                                        
                                        </div>

                                        <button type="button" onclick="contact()" class="btn btn-primary">Đăng ký ngay</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="contact-img" data-aos="zoom-out-right">
                            <img src="<?php echo @$setting['image4'] ?>" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="section-blog">
            <div class="container">
                <div class="section-title text-center" data-aos="zoom-in-up">
                    <h2><?php echo @$setting['title_tt'] ?></h2>
                    <p><?php echo @$setting['content_tt'] ?></p>
                </div>

                <div class="blog-list" data-aos="zoom-out">
                    <div class="row">
                        <?php if(!empty($listDataNew)){
                            foreach($listDataNew as $item){
                                echo '<div class="col-lg-3">
                            <div class="blog-item">
                                <a href="'.@$item->slug.'.html">
                                    <div class="blog-img">
                                        <img src="'.@$item->image.'" alt="">
                                    </div>
                                    
                                    <div class="blog-text">
                                        <div class="blog-title">
                                            <p>'.@$item->title.'</p>
                                        </div>
    
                                        <div class="blog-description">
                                            <p>'.@$item->description.'</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>';
                            }
                        } ?>
                        

                       


                    </div>
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
                subject: 'Liên hệ',
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
