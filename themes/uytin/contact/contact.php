<?php getHeader(); ?>

    <section class="body-contact">
        <div class="padding-container" style="margin-top: 50px">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-6 above-iframe-contact">
                        <div class="iframe-contact">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.5717297742362!2d105.81937561488303!3d21.00979778600871!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ac820b654071%3A0x9462933c69bfea22!2zNDYgTmcuIDcgUC4gVGjDoWkgSMOgLCBUcnVuZyBMaeG7h3QsIMSQ4buRbmcgxJBhLCBIw6AgTuG7mWksIFZpZXRuYW0!5e0!3m2!1sen!2s!4v1662694396511!5m2!1sen!2s" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                    <div class="col-6 above-iframe-contact">
                        <div class="form-contact">
                        <div class="contact_with-us mt-45">
                            <div class="title-cwu">
                                <h3>Hãy kết nối với chúng tôi để được hỗ trợ</h3>
                            </div>
                            <div role="form" class="box-form-contact mt-20">

                                    <div class="form-contact container">
                                        <form action="" method="post">
                                            <input type="hidden" name="_csrfToken" value="<?php echo $csrfToken;?>">
                                            <?php echo $mess;?>
                                            <div class="row">
                                                <label class="col-6 mb-10 form-focus pdl-5 pdr-5 mb-3">
                                                    <span class="text-name">
                                                        <input class="form-control" type="text" name="name" value="" size="40" placeholder="Họ và tên">
                                                    </span>
                                                </label>
                                                <label class="col-6 mb-10 form-focus pdl-5 pdr-5 mb-3">
                                                    <span class="email-contact">
                                                        <input class="form-control"  type="email" name="email" value="" size="40" placeholder="Email" required="required">
                                                    </span>
                                                </label>
                                                <label class="col-6 mb-10 form-focus pdl-5 pdr-5 mb-3">
                                                    <span class="tel-contact">
                                                        <input class="form-control"  type="text" name="phone_number" value="" size="40" placeholder="Số điện thoại">
                                                    </span>
                                                </label>
                                                <label class="col-6 mb-10 form-focus pdl-5 pdr-5 mb-3">
                                                    <span class="text-address">
                                                        <input class="form-control"  type="text" name="subject" value="" size="40" placeholder="Tiêu đề">
                                                    </span>
                                                </label>
                                                <label class="col-12 mb-10 form-focus pdl-5 pdr-5 mb-3">
                                                    <div class="textarea-noidung">
                                                        <textarea class="form-control"  name="content" rows="6" placeholder="Lời nhắn"></textarea>
                                                    </div>
                                                </label>
                                                
                                                <label class="col-12 pdl-5 pdr-5">
                                                    <div class="type-submit">
                                                        <input class="btn btn-primary" type="submit" value="Gửi yêu cầu liên hệ" id="bt-gui">
                                                    </div>
                                                </label>
                                            </div>
                                        </form>
                                    </div>
                             
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
<?php getFooter(); ?> 