<?php 
	getHeader();
	global $urlThemeActive; 
?>
<main>
        <section id="section-banner-top" class="introduction-pg">
            <div class="container">
                <div class="banner-contain">
                    <div>
                        <div class="desktop-banner">
                            <img src="<?php echo $urlThemeActive; ?>/asset/image/teamwork.png" alt="">
                        </div>
                        <div class="banner-contain-title">
                            <p>CHÚNG TÔI</p>
                            <h3>Sở hữu những chiến binh <br> giàu kinh nghiệm thực chiến
                            </h3>
                        </div>
                    </div>

                </div>

                <div class="banner-contain-4">
                    <div class="banner-contain-4-background">
                        <img src="<?php echo $urlThemeActive; ?>/asset/image/intro-bg.png" alt="">
                        <div class="banner-contain-4-img">
                            <img src="<?php echo $urlThemeActive; ?>/asset/image/toptop-car.jpg" alt="">
                        </div>
                    </div>
                    <div class="banner-contain-4-text">
                        <h4>CHÚNG TÔI LÀ</h4>
                        <p>Đội ngũ Top Top với kinh nghiệm tham gia nhiều cuộc chiến trong nhiều năm liền ở thị trường công nghệ và Marketing, giờ đây chúng tôi chính thức là một đội quân hùng mạnh với mong muốn đồng hành và phát triển cùng bạn trong những
                            cuộc chiến sắp tới, thông qua các dịch vụ và giải pháp Marketing hiệu quả.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <section id="section-about-group-1">
            <div class="container">
                <div class="about-group-1">
                    <div class="row">
                        <div class="col-lg-5 col-12">
                            <div class="about-group-1-left">
                                <h4>NHỮNG DỊCH VỤ NỔI BẬT</h4>
                                <h2>LÀM VIỆC TẬN TÂM ĐÃ TẠO NÊN UY TÍN CHO TOP TOP</h2>

                                <ul>
                                    <li>Thiết kế website</li>
                                    <li>Thiết kế website</li>
                                    <li>Thiết kế website</li>
                                    <li>Thiết kế website</li>
                                    <li>Thiết kế website</li>
                                    <li>Thiết kế website</li>
                                    <li>Thiết kế website</li>
                                    <li>Thiết kế website</li>

                                </ul>
                                <div>
                                    <a href="" class="custom-btn" type="submit">Xem tất cả dịch vụ</a href="">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7 col-12">
                            <div class="about-group-1-right">
                                <img src="<?php echo $urlThemeActive; ?>/asset/image/toptop-card.jpg" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="section-personnel" class="about-group-2">
            <div class="container no-padding">
                <div class="background-image-overlay"></div>
                <div class="section-title aos-init aos-animate" data-aos="zoom-in-up">
                    <p>Nhân sự</p>
                    <h3><span>Nhân sự</span> của <span>TOP TOP</span> bao gồm những ai ?</h3>
                </div>
                <div class="personnel-content aos-init aos-animate" data-aos="zoom-in-up" id="scrollableDiv">
                    <div class="person-grid">
                        <?php 
                        if(!empty($staff)){
                            foreach ($staff as $key => $value) {
                                echo '  <div class="person">
                                            <div class="person__background person-animation-1">
                                                <img src="'.$value->image.'" alt="">
                                            </div>
                                            <div class="person__content">
                                                <p class="person__category">'.$value->name_location.'</p>
                                                <h3 class="person__heading">'.$value->name.'</h3>
                                            </div>
                                        </div>';
                            }
                        }
                        ?>
                    </div>
                </div>
        </div>
        </section>

        <section id="section-worth" class="about-group-3">
            <div class="container">
                <div class="row">
                    <div class="worth-content col-lg-4 col-md-12 col-sm-12">
                        <h4 data-aos="flip-up" class="aos-init aos-animate"><?php echo @$settingThemes['title_product_best'];?></h4>
                        <p data-aos="fade-down-right" class="aos-init aos-animate"><?php echo nl2br(@$settingThemes['des_product_best']);?></p>
                    </div>
                    <div class="worth-detail col-lg-8 col-md-12 col-sm-12">
                        <div class="row">
                            <?php
                            for ($i=1; $i <= 6 ; $i++) { 
                                echo '  <div class="item-worth col-lg-4 col-md-6 col-sm-12">
                                            <div class="worth-card card-1 aos-init aos-animate" data-aos="fade-right">
                                                <div class="imageBox">
                                                    <img src="'.@$settingThemes['image'.$i.'_product_best'].'">
                                                </div>
                                                <div class="contentBox">
                                                    <h2>'.@$settingThemes['title'.$i.'_product_best'].'</h2>
                                                    <div class="description">
                                                        <p>'.@$settingThemes['content'.$i.'_product_best'].'</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            
        </section>

        <section id="section-decoration" class="about-group-4">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9 col-12">
                        <div class="decoration-media">
                            <img src="<?php echo $urlThemeActive; ?>/asset/image/toptop-car.jpg" alt="">
                        </div>
                    </div>

                    <div class="col-lg-3 col-12 no-padding">
                        <div class="decoration-content">
                            <div class="decoration-title">
                                <h3>KHÔNG NGỪNG NỖ LỰC NÂNG CAO CHẤT LƯỢNG DỊCH VỤ</h3>
                            </div>
                            <div class="decoration-detail">
                                <p>Chiến binh của chúng tôi không ngừng nỗ lực mang đến cho bạn những trải nghiệm dịch vụ tốt nhất. Sẵn sàng hỗ trợ bạn 24/7 để giải đáp những thắc mắc và giải quyết các khó khăn bạn gặp phải trong quá trình sử dụng dịch vụ.</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <section id="section-about-group-1" class="about-group-5">
            <div class="container">
                <div class="about-group-1">
                    <div class="row">
                        <div class="col-lg-6 col-12">
                            <div class="about-group-1-left">
                                <h4>CHIẾN LỢI PHẨM SAU BAO NGÀY RA TRẬN CỦA TOP TOP</h4>
                                <p>Không nản chí trước khó khăn thử thách, không ngại đương đầu với bão giông, đội ngũ Top Top luôn tận tâm và nhiệt huyết nhằm đem đến những sản phẩm giá trị cho khách hàng. Nhờ vậy mà những dự án thiết kế website ra đời từ đội ngũ Top Top vận hành thành công và hiệu quả.</p>

                                
                                <div>
                                    <a href="" class="custom-btn" type="submit">Xem tất cả dịch vụ</a href="">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="about-group-1-right">
                                <img src="<?php echo $urlThemeActive; ?>/asset/image/toptop-card.jpg" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="section-about-group-6" class="about-group-6">
            <div class="about-group-6-img">
                <img src="<?php echo $urlThemeActive; ?>/asset/image/bannerend.webp" alt="">
            </div>

            <div class="about-group-6-content">
                <div class="container">
                    <div class="about-group-6-content-box">
                        <h3>ĐIỂM ĐA ĐẠNG CỦA TOP TOP</h3>
                        <ul>
                            <li>Sử dụng nhiều ngôn ngữ lập trình</li>
                            <li>Nhiều đối tác liên kết</li>
                            <li>Hệ sinh thái đa dạng</li>
                            <li>Sáng tạo trong thiết kế</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    </main>
<?php getFooter(); ?>