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

        <section id="section-service" style="background-image: url(./asset/img/img90.png);">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5">
                        <div class="service-left" data-aos="zoom-in-right">
                            <div class="service-img">
                                <img src="./asset/img/img55.jpg" alt="">
                                <div class="service-left-text">
                                    <p>“Cảm ơn tất cả những người phụ nữ xinh đẹp đã lựa chọn SHIUNKO để đồng hành. SHIUNKO chắc chắn sẽ làm hài lòng và mong được phục vụ quý khách những lần tiếp theo”.
                                        Thanks for you!</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-7">
                        <div class="service-right" data-aos="zoom-in-left">
                            <div class="section-title">
                                <h2>CÁC LOẠI MÀU SON CỦA SHIUNKO</h2>
                                <p>Thỏa sức lựa chọn màu son yêu thích theo gu của riêng bạn:</p>
                            </div>

                            <div class="service-right-list">
                                <div class="service-right-item">
                                    <div class="service-right-img">
                                        <img src="./asset/img/mau-son-1-300x203.png" alt="">
                                    </div>

                                    <div class="service-right-detail">
                                        <div class="service-right-title">
                                            <h3>ORANGE PEACH</h3>
                                        </div>

                                        <div class="service-right-description">
                                            <p>Màu hồng cam trẻ trung, cá tính và sexy phù hợp với mọi loại da. Màu son này giúp da bạn sáng lên 1 tone mà không cần makeup. Những bữa tiệc cuối tuần, party,.. nếu sở hữu Orange Peach, bạn sẽ là cô gái vô cùng nổi bật</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="service-right-item">
                                    <div class="service-right-img">
                                        <img src="./asset/img/mau-son-1-300x203.png" alt="">
                                    </div>

                                    <div class="service-right-detail">
                                        <div class="service-right-title">
                                            <h3>ORANGE PEACH</h3>
                                        </div>

                                        <div class="service-right-description">
                                            <p>Màu hồng cam trẻ trung, cá tính và sexy phù hợp với mọi loại da. Màu son này giúp da bạn sáng lên 1 tone mà không cần makeup. Những bữa tiệc cuối tuần, party,.. nếu sở hữu Orange Peach, bạn sẽ là cô gái vô cùng nổi bật</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="service-right-item">
                                    <div class="service-right-img">
                                        <img src="./asset/img/mau-son-1-300x203.png" alt="">
                                    </div>

                                    <div class="service-right-detail">
                                        <div class="service-right-title">
                                            <h3>ORANGE PEACH</h3>
                                        </div>

                                        <div class="service-right-description">
                                            <p>Màu hồng cam trẻ trung, cá tính và sexy phù hợp với mọi loại da. Màu son này giúp da bạn sáng lên 1 tone mà không cần makeup. Những bữa tiệc cuối tuần, party,.. nếu sở hữu Orange Peach, bạn sẽ là cô gái vô cùng nổi bật</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="section-contact" style="background-image: url(./asset/img/img8.png);">
            <div class="container">
                <div class="section-title text-center" data-aos="zoom-in-up">
                    <h2>TỔNG ĐÀI TƯ VẤN MIỄN PHÍ</h2>
                    <p>Đừng ngần ngại! Hãy gọi ngay đến tổng đài tư vấn miễn cước của chúng tôi để được tư vấn trực tiếp</p>
                </div>

                <div class="link-phone text-center" data-aos="zoom-in-up">
                    <div class="link-phone-item">
                        <a href="">
                            <i class="fa-solid fa-phone"></i>
                            <span>0972-939-xxx</span>
                        </a>
                    </div>

                    <div class="link-phone-text">
                        <p>Nếu đã tìm hiểu kỹ về sản phẩm, quý khách có thể nhanh chóng đặt mua <br>
                            bằng cách thực hiện đầy đủ mẫu form sau và gửi đăng ký.</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="contact-content" data-aos="zoom-out-up">
                            <div class="contact-form">
                                <form action="">
                                    <div class="form-title">
                                        <p>Đặt hàng ngay hôm nay để nhận những ưu đãi hấp dẫn:</p>
                                    </div>

                                    <div class="form-description">
                                        <ul>
                                            <li>
                                                Miễn phí ship hàng toàn quốc.
                                            </li>

                                            <li>
                                                Cơ hội nhận Voucher mua hàng trị giá 500K cho 25 người đầu tiên.
                                            </li>
                                        </ul>
                                    </div>

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
                                            <textarea name="textarea-861" cols="40" rows="7" class="form-control"  placeholder="Ghi chú thêm..."></textarea>                                        
                                        </div>

                                        <button type="submit" class="btn btn-primary">Đăng ký ngay</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="contact-img" data-aos="zoom-out-right">
                            <img src="./asset/img/son-shiunko-2.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="section-blog">
            <div class="container">
                <div class="section-title text-center" data-aos="zoom-in-up">
                    <h2>TIN TỨC – BÀI VIẾT</h2>
                    <p>Dưới đây là một số bài viết tổng hợp về tin tức và sắc đẹp phái nữ!.</p>
                </div>

                <div class="blog-list" data-aos="zoom-out">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="blog-item">
                                <a href="">
                                    <div class="blog-img">
                                        <img src="./asset/img/phuong-phap-giam-can-low-carbohydrate.jpg" alt="">
                                    </div>
                                    
                                    <div class="blog-text">
                                        <div class="blog-title">
                                            <p>10 Chế độ ăn giảm cân Nhanh & Hiệu quả nhất thế giới</p>
                                        </div>
    
                                        <div class="blog-description">
                                            <p>Chế độ ăn giảm cân gần đây được rất nhiều bạn quan tâm, đặc biệt là ...</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="blog-item">
                                <a href="">
                                    <div class="blog-img">
                                        <img src="./asset/img/phuong-phap-giam-can-low-carbohydrate.jpg" alt="">
                                    </div>
                                    
                                    <div class="blog-text">
                                        <div class="blog-title">
                                            <p>10 Chế độ ăn giảm cân Nhanh & Hiệu quả nhất thế giới</p>
                                        </div>
    
                                        <div class="blog-description">
                                            <p>Chế độ ăn giảm cân gần đây được rất nhiều bạn quan tâm, đặc biệt là ...</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                            
                        <div class="col-lg-3">
                            <div class="blog-item">
                                <a href="">
                                    <div class="blog-img">
                                        <img src="./asset/img/phuong-phap-giam-can-low-carbohydrate.jpg" alt="">
                                    </div>
                                    
                                    <div class="blog-text">
                                        <div class="blog-title">
                                            <p>10 Chế độ ăn giảm cân Nhanh & Hiệu quả nhất thế giới</p>
                                        </div>
    
                                        <div class="blog-description">
                                            <p>Chế độ ăn giảm cân gần đây được rất nhiều bạn quan tâm, đặc biệt là ...</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>


                        <div class="col-lg-3">
                            <div class="blog-item">
                                <a href="">
                                    <div class="blog-img">
                                        <img src="./asset/img/phuong-phap-giam-can-low-carbohydrate.jpg" alt="">
                                    </div>
                                    
                                    <div class="blog-text">
                                        <div class="blog-title">
                                            <p>10 Chế độ ăn giảm cân Nhanh & Hiệu quả nhất thế giới</p>
                                        </div>
    
                                        <div class="blog-description">
                                            <p>Chế độ ăn giảm cân gần đây được rất nhiều bạn quan tâm, đặc biệt là ...</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>                    
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
