<?php getHeader();?>

    <article>
        <div class="container setting-page-contact">
            <form class="d-flex form-search search-mobile">
                <input class="form-control me-2" type="search" placeholder="Tìm kiếm..." aria-label="Search">
                <button class="btn btn-outline-success" pac type="submit">Search</button>
            </form>

            <div class="google-map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d465.60342595455273!2d105.80066917249044!3d20.99955445627723!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135acbcb952af37%3A0x347e82aad1e7ffaf!2sVincem%20Comatce%20Tower!5e0!3m2!1svi!2s!4v1696242857253!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>            <div class="setting-grid-contact">
                <div class="intro-contact-left">
                    <div class="contact-me">
                        <div class="title-main-home mg-bt-24">
                            <h3 class="text-uppcase">liên hệ với chúng tôi</h3>
                            <div class="border-title-main-home"></div>      
                        </div>
                        <p>Hãy để đội ngũ tư vấn hỗ trợ bạn bất kỳ nơi đâu
                        </p>
                    </div>
                    <div class="intro-contact">
                        <div class="title-main-home mg-bt-24">
                            <h3 class="text-uppcase">thông tin liên hệ</h3>
                            <div class="border-title-main-home"></div>      
                        </div>
                        <ul class="">
                            <li class="item-list-contact">
                                <span class="icon-address-contact">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                      </svg>
                                      
                                      
                                </span>
                                <div class="text-page-contact">
                                    <p>Địa chỉ: <span><?php echo $contactSite['address']; ?></span></p>
                                </div>
        
                            </li>
                            <li class="item-list-contact">
                                <span class="icon-address-contact">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                                      </svg>
                                </span>
                                <div class="text-page-contact">
                                    <p>Số điện thoại: <span><?php echo $contactSite['phone']; ?></span></p>
                                </div>
        
                            </li>
                            <li class="item-list-contact">
                                <span class="icon-address-contact">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 9v.906a2.25 2.25 0 01-1.183 1.981l-6.478 3.488M2.25 9v.906a2.25 2.25 0 001.183 1.981l6.478 3.488m8.839 2.51l-4.66-2.51m0 0l-1.023-.55a2.25 2.25 0 00-2.134 0l-1.022.55m0 0l-4.661 2.51m16.5 1.615a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V8.844a2.25 2.25 0 011.183-1.98l7.5-4.04a2.25 2.25 0 012.134 0l7.5 4.04a2.25 2.25 0 011.183 1.98V19.5z" />
                                      </svg>
                                      
                                      
                                </span>
                                <div class="text-page-contact">
                                    <p>Email: <span><?php echo $contactSite['email']; ?></span></p>
                                </div>
                            </li>
                        </ul>
                    </div>                    
                </div>
                <div class="intro-contact-right">
                    <div class="info-contact-right">
                        <h3 style="font-size: 33px;">HỖ TRỢ GIẢI PHÁP</h3>
                        <form action="" method="post">
                            <input type="hidden" name="_csrfToken" value="<?php echo $csrfToken;?>">
                            <div class="mb-3">
                                <input value="" name="name" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Họ và tên" required>
                            </div>
                            <div class="mb-3">
                                <input type="phone" value="" name="phone_number" class="form-control" id="exampleFormControlInput1" placeholder="Số điện thoại" required>
                            </div>
                            <div class="mb-3">
                                <input class="form-control" type="email" placeholder="Email của bạn" value="" name="email" required>
                            </div>

                            <div class="mb-3">
                                <input class="form-control" type="text" placeholder="Tiêu đề" required value="" name="subject">
                            </div>

                            <div class="mb-3">
                                <textarea class="form-control" name="content" id="exampleFormControlTextarea1" rows="3" placeholder="Nội dung cần hỗ trợ.." required></textarea>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Hoàn thành</button>
                            </div>
                        </form>
                        <?php echo $mess;?>

                    </div>
                </div>
            </div>


        </div>
    </article>
<?php getFooter();?>
