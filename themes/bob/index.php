<?php 
    global $settingThemes;
    global $modelAlbums;
?>

<?php getHeader();?>

    <main> 
        <?php
            if(!empty($slide_home)){
                echo'
                <section id="section-banner-home">
                    <div class="banner-home-slide">';
                    foreach($slide_home as $key => $value){
                        echo'
                        <div class="banner-slide-img">
                            <img src="'.$value->image.'" alt="">
                        </div>';
                    }

                    echo'
                    </div>
            </section>';
            };

        ?>
        <section id="section-home-introduce">
            <div class="container">
                <div class="row row-home-introduce">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="home-inrtroduce-box">
                            <div class="title-main-section">
                                <h1><?php echo @$settingThemes['title_section1']; ?></h1>
                            </div>
                            <div class="title-sub-section">
                                <p><?php echo @$settingThemes['titlesub_section1'];?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="section-category-product">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-lg-4 col-12 category-product-item">
                        <div class="category-product-box">
                            <div class="category-product-overlay"></div>
                            <div class="category-product-img">
                                <a href="">
                                    <img src="<?php echo $urlThemeActive; ?>/asset/img/P7fB90FcgdY69rXUY6MsNtvKiRSpkj14DkpEIZn4.jpg" alt="">
                                </a>
                            </div>
                            <div class="category-product-info">
                                <div class="category-product-info-title">
                                    <a href="">Yen Lam Melamine</a>
                                </div>
                                <div class="category-product-info-description">
                                    <p href="">Melamine là lớp nhựa phủ bề mặt chống trầy xước, có tính thẩm mỹ rất cao và phong phú màu sắc. Hiện nay, Yên Lâm có sẵn 80 mã màu melamine từ các loại vân gỗ như: Walnut (óc chó), Oak (sồi), Maple, Beech,  ... đến vân đá, xi măng, bê tông, ... vô cùng đa dạng để Qúy Khách hàng lựa chọn.</p>
                                </div>
                                <div class="category-product-info-button">
                                    <a href="">Xem tất cả</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-lg-4 col-12 category-product-item">
                        <div class="category-product-box">
                            <div class="category-product-overlay"></div>
                            <div class="category-product-img">
                                <a href="">
                                    <img src="<?php echo $urlThemeActive; ?>/asset/img/P7fB90FcgdY69rXUY6MsNtvKiRSpkj14DkpEIZn4.jpg" alt="">
                                </a>
                            </div>
                            <div class="category-product-info">
                                <div class="category-product-info-title">
                                    <a href="">Yen Lam Melamine</a>
                                </div>
                                <div class="category-product-info-description">
                                    <p href="">Melamine là lớp nhựa phủ bề mặt chống trầy xước, có tính thẩm mỹ rất cao và phong phú màu sắc. Hiện nay, Yên Lâm có sẵn 80 mã màu melamine từ các loại vân gỗ như: Walnut (óc chó), Oak (sồi), Maple, Beech,  ... đến vân đá, xi măng, bê tông, ... vô cùng đa dạng để Qúy Khách hàng lựa chọn.</p>
                                </div>
                                <div class="category-product-info-button">
                                    <a href="">Xem tất cả</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-lg-4 col-12 category-product-item">
                        <div class="category-product-box">
                            <div class="category-product-overlay"></div>
                            <div class="category-product-img">
                                <a href="">
                                    <img src="<?php echo $urlThemeActive; ?>/asset/img/P7fB90FcgdY69rXUY6MsNtvKiRSpkj14DkpEIZn4.jpg" alt="">
                                </a>
                            </div>
                            <div class="category-product-info">
                                <div class="category-product-info-title">
                                    <a href="">Yen Lam Melamine</a>
                                </div>
                                <div class="category-product-info-description">
                                    <p href="">Melamine là lớp nhựa phủ bề mặt chống trầy xước, có tính thẩm mỹ rất cao và phong phú màu sắc. Hiện nay, Yên Lâm có sẵn 80 mã màu melamine từ các loại vân gỗ như: Walnut (óc chó), Oak (sồi), Maple, Beech,  ... đến vân đá, xi măng, bê tông, ... vô cùng đa dạng để Qúy Khách hàng lựa chọn.</p>
                                </div>
                                <div class="category-product-info-button">
                                    <a href="">Xem tất cả</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-lg-4 col-12 category-product-item">
                        <div class="category-product-box">
                            <div class="category-product-overlay"></div>
                            <div class="category-product-img">
                                <a href="">
                                    <img src="<?php echo $urlThemeActive; ?>/asset/img/P7fB90FcgdY69rXUY6MsNtvKiRSpkj14DkpEIZn4.jpg" alt="">
                                </a>
                            </div>
                            <div class="category-product-info">
                                <div class="category-product-info-title">
                                    <a href="">Yen Lam Melamine</a>
                                </div>
                                <div class="category-product-info-description">
                                    <p href="">Melamine là lớp nhựa phủ bề mặt chống trầy xước, có tính thẩm mỹ rất cao và phong phú màu sắc. Hiện nay, Yên Lâm có sẵn 80 mã màu melamine từ các loại vân gỗ như: Walnut (óc chó), Oak (sồi), Maple, Beech,  ... đến vân đá, xi măng, bê tông, ... vô cùng đa dạng để Qúy Khách hàng lựa chọn.</p>
                                </div>
                                <div class="category-product-info-button">
                                    <a href="">Xem tất cả</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-lg-4 col-12 category-product-item">
                        <div class="category-product-box">
                            <div class="category-product-overlay"></div>
                            <div class="category-product-img">
                                <a href="">
                                    <img src="<?php echo $urlThemeActive; ?>/asset/img/P7fB90FcgdY69rXUY6MsNtvKiRSpkj14DkpEIZn4.jpg" alt="">
                                </a>
                            </div>
                            <div class="category-product-info">
                                <div class="category-product-info-title">
                                    <a href="">Yen Lam Melamine</a>
                                </div>
                                <div class="category-product-info-description">
                                    <p href="">Melamine là lớp nhựa phủ bề mặt chống trầy xước.</p>
                                </div>
                                <div class="category-product-info-button">
                                    <a href="">Xem tất cả</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-lg-4 col-12 category-product-item">
                        <div class="category-product-box">
                            <div class="category-product-overlay"></div>
                            <div class="category-product-img">
                                <a href="">
                                    <img src="<?php echo $urlThemeActive; ?>/asset/img/P7fB90FcgdY69rXUY6MsNtvKiRSpkj14DkpEIZn4.jpg" alt="">
                                </a>
                            </div>
                            <div class="category-product-info">
                                <div class="category-product-info-title">
                                    <a href="">Yen Lam Melamine</a>
                                </div>
                                <div class="category-product-info-description">
                                    <p href="">Melamine là lớp nhựa phủ bề mặt chống trầy xước, có tính thẩm mỹ rất cao và phong phú màu sắc. Hiện nay, Yên Lâm có sẵn 80 mã màu melamine từ các loại vân gỗ như: Walnut (óc chó), Oak (sồi), Maple, Beech,  ... đến vân đá, xi măng, bê tông, ... vô cùng đa dạng để Qúy Khách hàng lựa chọn.</p>
                                </div>
                                <div class="category-product-info-button">
                                    <a href="">Xem tất cả</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="section-product">
            <div class="container">
                <div class="title-box-section">
                    <div class="title-main-section">
                        <h1><?php echo @$settingThemes['title_section2'];?></h1>
                    </div>
                    <div class="title-sub-section">
                        <p><?php echo @$settingThemes['titlesub_section2'];?></p>
                    </div>
                </div>
                    <div class="list-product">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-12 product-item">
                                <div class="product-inner">
                                    <div class="product-overlay"></div>
                                    <div class="product-img">
                                        <a href="">
                                            <img src="<?php echo $urlThemeActive; ?>/asset/img/kqQqoU8ZlmACbWrFmW4fiLR7UC498u6SC3CRTut6.jpg" alt="">
                                        </a>
                                    </div>
    
                                    <div class="product-info">
                                        <div class="product-info-category">
                                            <span>Resort – Khách sạn</span>
                                            <span>| Hồ Chí Minh</span>
                                        </div>
    
                                        <div class="product-info-title">
                                            <a href="">JW MARRIOTT CAM RANH</a>
                                        </div>
    
                                        <div class="product-info-code">
                                            <span>Mã sản phẩm <span class="code">NV01</span></span>
                                        </div>
    
                                        <a class="product-info-button" href="">Xem chi tiết</a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-4 col-12 product-item">
                                <div class="product-inner">
                                    <div class="product-overlay"></div>
                                    <div class="product-img">
                                        <a href="">
                                            <img src="<?php echo $urlThemeActive; ?>/asset/img/kqQqoU8ZlmACbWrFmW4fiLR7UC498u6SC3CRTut6.jpg" alt="">
                                        </a>
                                    </div>
    
                                    <div class="product-info">
                                        <div class="product-info-category">
                                            <span>Resort – Khách sạn</span>
                                            <span>| Hồ Chí Minh</span>
                                        </div>
    
                                        <div class="product-info-title">
                                            <a href="">JW MARRIOTT CAM RANH</a>
                                        </div>
    
                                        <div class="product-info-code">
                                            <span>Mã sản phẩm <span class="code">NV01</span></span>
                                        </div>
    
                                        <a class="product-info-button" href="">Xem chi tiết</a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-4 col-12 product-item">
                                <div class="product-inner">
                                    <div class="product-overlay"></div>
                                    <div class="product-img">
                                        <a href="">
                                            <img src="<?php echo $urlThemeActive; ?>/asset/img/kqQqoU8ZlmACbWrFmW4fiLR7UC498u6SC3CRTut6.jpg" alt="">
                                        </a>
                                    </div>
    
                                    <div class="product-info">
                                        <div class="product-info-category">
                                            <span>Resort – Khách sạn</span>
                                            <span>| Hồ Chí Minh</span>
                                        </div>
    
                                        <div class="product-info-title">
                                            <a href="">JW MARRIOTT CAM RANH</a>
                                        </div>
    
                                        <div class="product-info-code">
                                            <span>Mã sản phẩm <span class="code">NV01</span></span>
                                        </div>
    
                                        <a class="product-info-button" href="">Xem chi tiết</a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-4 col-12 product-item">
                                <div class="product-inner">
                                    <div class="product-overlay"></div>
                                    <div class="product-img">
                                        <a href="">
                                            <img src="<?php echo $urlThemeActive; ?>/asset/img/kqQqoU8ZlmACbWrFmW4fiLR7UC498u6SC3CRTut6.jpg" alt="">
                                        </a>
                                    </div>
    
                                    <div class="product-info">
                                        <div class="product-info-category">
                                            <span>Resort – Khách sạn</span>
                                            <span>| Hồ Chí Minh</span>
                                        </div>
    
                                        <div class="product-info-title">
                                            <a href="">JW MARRIOTT CAM RANH</a>
                                        </div>
    
                                        <div class="product-info-code">
                                            <span>Mã sản phẩm <span class="code">NV01</span></span>
                                        </div>
    
                                        <a class="product-info-button" href="">Xem chi tiết</a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-4 col-12 product-item">
                                <div class="product-inner">
                                    <div class="product-overlay"></div>
                                    <div class="product-img">
                                        <a href="">
                                            <img src="<?php echo $urlThemeActive; ?>/asset/img/kqQqoU8ZlmACbWrFmW4fiLR7UC498u6SC3CRTut6.jpg" alt="">
                                        </a>
                                    </div>
    
                                    <div class="product-info">
                                        <div class="product-info-category">
                                            <span>Resort – Khách sạn</span>
                                            <span>| Hồ Chí Minh</span>
                                        </div>
    
                                        <div class="product-info-title">
                                            <a href="">JW MARRIOTT CAM RANH</a>
                                        </div>
    
                                        <div class="product-info-code">
                                            <span>Mã sản phẩm <span class="code">NV01</span></span>
                                        </div>
    
                                        <a class="product-info-button" href="">Xem chi tiết</a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-4 col-12 product-item">
                                <div class="product-inner">
                                    <div class="product-overlay"></div>
                                    <div class="product-img">
                                        <a href="">
                                            <img src="<?php echo $urlThemeActive; ?>/asset/img/kqQqoU8ZlmACbWrFmW4fiLR7UC498u6SC3CRTut6.jpg" alt="">
                                        </a>
                                    </div>
    
                                    <div class="product-info">
                                        <div class="product-info-category">
                                            <span>Resort – Khách sạn</span>
                                            <span>| Hồ Chí Minh</span>
                                        </div>
    
                                        <div class="product-info-title">
                                            <a href="">JW MARRIOTT CAM RANH</a>
                                        </div>
    
                                        <div class="product-info-code">
                                            <span>Mã sản phẩm <span class="code">NV01</span></span>
                                        </div>
    
                                        <a class="product-info-button" href="">Xem chi tiết</a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-4 col-12 product-item">
                                <div class="product-inner">
                                    <div class="product-overlay"></div>
                                    <div class="product-img">
                                        <a href="">
                                            <img src="<?php echo $urlThemeActive; ?>/asset/img/kqQqoU8ZlmACbWrFmW4fiLR7UC498u6SC3CRTut6.jpg" alt="">
                                        </a>
                                    </div>
    
                                    <div class="product-info">
                                        <div class="product-info-category">
                                            <span>Resort – Khách sạn</span>
                                            <span>| Hồ Chí Minh</span>
                                        </div>
    
                                        <div class="product-info-title">
                                            <a href="">JW MARRIOTT CAM RANH</a>
                                        </div>
    
                                        <div class="product-info-code">
                                            <span>Mã sản phẩm <span class="code">NV01</span></span>
                                        </div>
    
                                        <a class="product-info-button" href="">Xem chi tiết</a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-4 col-12 product-item">
                                <div class="product-inner">
                                    <div class="product-overlay"></div>
                                    <div class="product-img">
                                        <a href="">
                                            <img src="<?php echo $urlThemeActive; ?>/asset/img/kqQqoU8ZlmACbWrFmW4fiLR7UC498u6SC3CRTut6.jpg" alt="">
                                        </a>
                                    </div>
    
                                    <div class="product-info">
                                        <div class="product-info-category">
                                            <span>Resort – Khách sạn</span>
                                            <span>| Hồ Chí Minh</span>
                                        </div>
    
                                        <div class="product-info-title">
                                            <a href="">JW MARRIOTT CAM RANH</a>
                                        </div>
    
                                        <div class="product-info-code">
                                            <span>Mã sản phẩm <span class="code">NV01</span></span>
                                        </div>
    
                                        <a class="product-info-button" href="">Xem chi tiết</a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-4 col-12 product-item">
                                <div class="product-inner">
                                    <div class="product-overlay"></div>
                                    <div class="product-img">
                                        <a href="">
                                            <img src="<?php echo $urlThemeActive; ?>/asset/img/kqQqoU8ZlmACbWrFmW4fiLR7UC498u6SC3CRTut6.jpg" alt="">
                                        </a>
                                    </div>
    
                                    <div class="product-info">
                                        <div class="product-info-category">
                                            <span>Resort – Khách sạn</span>
                                            <span>| Hồ Chí Minh</span>
                                        </div>
    
                                        <div class="product-info-title">
                                            <a href="">JW MARRIOTT CAM RANH</a>
                                        </div>
    
                                        <div class="product-info-code">
                                            <span>Mã sản phẩm <span class="code">NV01</span></span>
                                        </div>
    
                                        <a class="product-info-button" href="">Xem chi tiết</a>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
        </section>

        <!-- Đăng dự án miễn phí -->
        <section style="background-image: url(<?php echo $urlThemeActive; ?>/asset/img/image-laptop.jpg);" id="section-home-contact">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 col-md-5 col-12 home-contact-left">
                        <div class="title-home-contact">
                            <p><?php echo @$settingThemes['title_section3'];?></p>
                        </div>

                        <div class="sub-home-contact">
                            <span><?php echo @$settingThemes['titlesub_section3']; ?></span>
                        </div>

                        <div class="button-home-contact">
                            <a href="">Đăng dự án miễn phí</a>
                        </div>
                    </div>
    
                    <div class="col-lg-7 col-md-7 col-12 home-contact-right">
                        <div class="home-contact-right-img">
                            <img src="<?php echo @$settingThemes['image_section3']; ?>" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php getFooter();?>
