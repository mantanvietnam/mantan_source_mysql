<?php 
global $urlThemeActive;
$setting = setting(); 
?>
   
    <section id="contact" style="background-image: url(<?php echo show_text_clone(@$setting['background_4']);?>);">
        <div class="testimonial-overlay"></div>
        <div class="container">
            <div class="row">
                <div class="contact-title">
                    <div class="contact-title">
                        <p>Thông tin liện lạc</p>
                        <h2>
                            Hãy <span>liên lạc</span> với tôi
                        </h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 log-md-6 col-sm-12">
                    <div class="contact-img">
                        <img src="<?php echo show_text_clone(@$setting['image_cd']);?>" alt="">
                    </div>
                </div>

                <div class="col-lg-6 log-md-6 col-sm-12">
                    <div class="contact-group">
                        <div class="contact-group-title">
                            <h5>Tin nhắn</h5>
                            <h3>Viết gì đó cho tôi</h3>
                        </div>
                        <div class="contact-text">
                            <p>
                                <span>Số điện thoại :</span> <?php echo show_text_clone(@$setting['phone']); ?>
                            </p>
                            <p>
                                <span>Email  :</span> <?php echo show_text_clone(@$setting['email']); ?>
                            </p>
                            <p>
                                <span>Địa chỉ  :</span> <?php echo show_text_clone(@$setting['address']); ?>
                            </p>
                        </div>
                        <form action="">
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-input">
                                        <input type="text" name="name" id="name" placeholder="Họ và tên" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-input">
                                        <input type="text" name="email" id="email" placeholder="Email" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-input">
                                        <input type="text" name="phone" id="phone" placeholder="Điện thoại" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-input">
                                        <input type="text" name="Subject" id="Subject" placeholder="Vấn đề cần tư vấn" required>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-input">
                                        <textarea name="massage" cols="30" id="massage" rows="7" placeholder="Nhập ý kiến của bạn" required></textarea>
                                    </div>
                                    <div class="form-btn-submid">
                                        <button onclick="contac();">
                                            Gửi tin nhắn
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="copy-right">
                <p><?php echo show_text_clone(@$setting['textfooter']); ?></p>
            </div>
            <div class="footer-icon">
                <ul>
                    <li><a href="<?php echo show_text_clone(@$setting['facebook']); ?>"><i class="fa-brands fa-facebook-f"></i></a></li>
                    <li><a href="<?php echo show_text_clone(@$setting['youtube']); ?>"><i class="fa-brands fa-youtube"></i></a></li>
                    <li><a href="<?php echo show_text_clone(@$setting['instagram']); ?>"><i class="fa-brands fa-instagram"></i></a></li>
                    <li><a href="<?php echo show_text_clone(@$setting['zalo']); ?>"><i class="fa-solid fa-z"></i></a></li>
                    <li><a href="<?php echo show_text_clone(@$setting['instagram']); ?>"><i class="fa-brands fa-instagram"></i></a></li>
                </ul>
            </div>
        </div>

    </section>

    <section id="scroll-top">
        <a id="scroll-top-btn" onclick="scrollToTop()">
            <i class="fa-solid fa-angles-up"></i>
        </a>
    </section>
    <script type="text/javascript">
       function contac(){
            var name = $('#name').val();
            var email = $('#email').val();
            var phone = $('#phone').val();
            var subject = $('#subject').val();
            var content = $('#massage').val();

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
                    // if(msg.code==1){
                    //     location.reload();
                    // }else{
                    //     var html = '<p class="text-danger">'+msg.messages+'</p>';
                    //     document.getElementById("messReg").innerHTML = html;

                    // }
                   
                });
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="<?php echo $urlThemeActive ?>/js/main.js"></script>
</body>

</html>

