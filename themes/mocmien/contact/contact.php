<?php 
    global $settingThemes;
    getHeader();
?>
<style>
    #section-contact-content {
    padding: 40px 0;
}
.contact-box-left h2, .contact-box-right h2 {
    font-size: 28px;
    margin-bottom: 20px;
}
.contact-box-left form .form-control {
    border-radius: 8px;
    padding: 10px 15px;
    border: 1px solid #ccc;
}
.contact-box-left form button {
    background-color: #007bff;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 8px;
    transition: background-color 0.3s;
}
.contact-box-left form button:hover {
    background-color: #0056b3;
}
.contact-info .contact-info-item img {
    width: 40px;
    height: 40px;
}
.contact-info .contact-info-detail p {
    margin: 0;
}
.btn-primary {
    background-color: #25982b !important;
    border-color: #25982b !important;
}


</style>
<main>
    <section id="section-contact-content">
        <div class="container">
            <div class="row">
                <!-- Form Liên Hệ -->
                <div class="col-lg-6 col-md-12 col-12 contact-box-left">
                    <h2>Gửi thắc mắc cho chúng tôi</h2>
                    <?php if (!empty($mess)) { echo "<div class='alert alert-success'>$mess</div>"; } ?>
                    <p>Nếu bạn có thắc mắc gì, hãy gửi yêu cầu cho chúng tôi, và chúng tôi sẽ liên lạc lại với bạn sớm nhất có thể.</p>
                    <form action="" method="post">
                        <input type="hidden" name="_csrfToken" value="<?php echo $csrfToken; ?>">
                        <div class="contact-form">
                            <div class="row g-3">
                                <!-- Tên -->
                                <div class="col-12">
                                    <div class="input-group">
                                        <input class="form-control" name="name" type="text" placeholder="Tên của bạn" required>
                                    </div>
                                </div>
                                <!-- Email -->
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <input class="form-control" name="email" type="email" placeholder="Email của bạn">
                                    </div>
                                </div>
                                <!-- Số điện thoại -->
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <input class="form-control" name="phone_number" type="text" placeholder="Số điện thoại của bạn" required>
                                    </div>
                                </div>
                                <!-- Tiêu đề -->
                                <div class="col-12">
                                    <div class="input-group">
                                        <input class="form-control" name="subject" type="text" placeholder="Tiêu đề" required>
                                    </div>
                                </div>
                                <!-- Nội dung -->
                                <div class="col-12">
                                    <div class="input-group">
                                        <textarea class="form-control" name="content" placeholder="Nội dung" rows="5" required></textarea>
                                    </div>
                                </div>
                                <!-- Nút Gửi -->
                                <div class="col-12">
                                    <button class="btn btn-primary w-100">Gửi cho chúng tôi</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Thông Tin Liên Hệ -->
                <div class="col-lg-6 col-md-12 col-12 contact-box-right">
                    <h2>Thông tin liên hệ</h2>
                    <div class="contact-info">
                        <!-- Địa chỉ -->
                        <div class="contact-info-item d-flex align-items-center mb-3">
                            <div class="contact-info-img me-3">
                                <img src="<?php echo $urlThemeActive; ?>assets/images/place.png" alt="Địa chỉ">
                            </div>
                            <div class="contact-info-detail">
                                <strong>Địa chỉ</strong>
                                <p><?php echo $contactSite['address']; ?></p>
                            </div>
                        </div>
                        <!-- Số điện thoại -->
                        <div class="contact-info-item d-flex align-items-center mb-3">
                            <div class="contact-info-img me-3">
                                <img src="<?php echo $urlThemeActive; ?>assets/images/telephone.png" alt="Số điện thoại">
                            </div>
                            <div class="contact-info-detail">
                                <strong>Số điện thoại</strong>
                                <p><?php echo $contactSite['phone']; ?></p>
                            </div>
                        </div>
                        <!-- Email -->
                        <div class="contact-info-item d-flex align-items-center">
                            <div class="contact-info-img me-3">
                                <img src="<?php echo $urlThemeActive; ?>assets/images/email.png" alt="Email">
                            </div>
                            <div class="contact-info-detail">
                                <strong>Email</strong>
                                <p><?php echo $contactSite['email']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<?php getFooter(); ?>


