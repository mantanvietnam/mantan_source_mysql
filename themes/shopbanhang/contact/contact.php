<?php
getHeader();
global $urlThemeActive;

$setting = setting();

$slide_home= slide_home($setting['id_slide']);
?>
<main>
        <section id="section-breadcrumb">
            <div class="breadcrumb-center">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                  <li class="breadcrumb-item"><a href="#">Liên Hệ</a></li>
                </ul>
            </div>
        </section>

        <section id="section-contact">
            <div class="container">
                <div class="contact-title">
                    <h1>Liên hệ với BUMAS</h1>
                </div>

                <div class="contact-description">
                    <p>Bất kỳ thắc mắc hay cần sự hỗ trợ, bạn có thể liên hệ với BUMAS bằng một trong các phương thức dưới đây mà bạn cảm thấy phù hợp nhất:</p>
                </div>

                <div class="group-icon">
                    <div class="group-icon-item">
                        <div class="icon-item">
                            <img src="<?php echo $urlThemeActive ?>/asset/image/place.png" alt="">
                        </div>

                        <div class="text-item">
                            <p><?php echo $contactSite['address'] ?></p>
                        </div>
                    </div>

                    <div class="group-icon-item">
                        <div class="icon-item">
                            <img src="<?php echo $urlThemeActive ?>/asset/image/email.png" alt="">
                        </div>

                        <div class="text-item">
                            <p><?php echo $contactSite['email'] ?></p>
                        </div>
                    </div>

                    <div class="group-icon-item">
                        <div class="icon-item">
                            <img src="<?php echo $urlThemeActive ?>/asset/image/phone.png" alt="">
                        </div>

                        <div class="text-item">
                            <p><?php echo $contactSite['phone'] ?></p>
                        </div>
                    </div>
                </div>


                <div class="contact-form">
                    <div class="contact-text">
                        <p>Điền thông tin liên hệ để chúng tôi có thể gọi trực tiếp hỗ trợ các bạn</p>
                    </div>
                    <form id="formContact" onsubmit="" action="<?= $routesPlugin["contact"] ?>" method="post" class="form-custom-1 py-3">
                        <div class="row">
                            <div class="mb-3 col-lg-6 col-12">
                                <input placeholder="Họ và tên" type="text" class="form-control" name="name" id="name" required>
                                <input type="hidden" value="<?php echo $csrfToken; ?>" name="_csrfToken">
                            </div>

                            <div class="mb-3 col-lg-6 col-12">
                                <input placeholder="Số điện thoại" type="text" class="form-control"name="phone"  id="phone" required>
                            </div>
    
                            <div class="mb-3 col-12">
                                <input placeholder="Email" type="email" class="form-control" name="email"  id="email" required>
                            </div>

                            <div class="mb-3 col-12 form-radius">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                    <label class="form-check-label" value="Tư vấn" for="flexRadioDefault1">
                                        Tư vấn
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                                    <label class="form-check-label" value="Hợp tác" for="flexRadioDefault2">
                                        Hợp tác
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault3">
                                    <label class="form-check-label" value="Góp ý sản phẩm" for="flexRadioDefault3">
                                        Góp ý sản phẩm
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault4" checked>
                                    <label class="form-check-label" value="Khác" for="flexRadioDefault4">
                                      Khác
                                    </label>
                                </div>
                            </div>
    
                            <div class="mb-3 col-12">
                                <textarea class="form-control" placeholder="Nội dung" name="content" rows="7"></textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Gửi</button>
                    </form>
                </div>
            </div>
        </section>
<?php if(!empty($mess)){?>
        <div class="box-confirm-cart box-confirm-like" id="myLike"  style=" display: block; ">
            <div class="box-confirm-cart-title confirm-like">
                <p><?php echo @$mess; ?></p>
                <div class="close-button">
                    <i class="fa-solid fa-xmark"></i>
                </div>
            </div>
        </div>

<script>
  var myElement = document.getElementById('myLike');

    // Hàm thay đổi CSS
    function changeCSS() {
        myElement.style.display = 'none';
    }

    // Đặt hẹn giờ để thực hiện thay đổi sau 10 giây
    setTimeout(changeCSS, 3000);
</script>
<?php } ?>
    </main>
<?php
getFooter();?>