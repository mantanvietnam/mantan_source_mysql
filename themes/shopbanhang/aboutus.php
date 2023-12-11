    <?php
getHeader();
global $urlThemeActive;
global $session;
$infoUser = $session->read('infoUser');     


?>
  <main>
        <section id="section-breadcrumb">
            <div class="breadcrumb-center">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item"><a href="/">Home</a></li>
                  <li class="breadcrumb-item"><a href="#">About us</a></li>
                </ul>
            </div>
        </section>

        <section id="section-banner-aboutus">
            <div class="container">
                <div class="banner-aboutus">
                    <img src="<?php echo @$setting['image_banner'] ?>" alt="">
                </div>
            </div>
        </section>

        <section id="section-story">
            <div class="container container-padding">
                <div class="title-story">
                    <h2>Câu chuyện BUMAS</h2>
                </div>
    
                <div class="content-story"><?php echo nl2br(@$setting['content']) ?></div>
            </div>
        </section>

        <section class="section-content-image" id="section-content-image-left">
            <div class="container container-padding">
                <div class="row">
                    <div class="about-content-image-left-box col-lg-6 col-12">
                        <div class="about-content-image">
                            <img src="<?php echo @$setting['image_left'] ?>" alt="">
                        </div>
                    </div>
    
                    <div class="about-content-text col-lg-6 col-12"><?php echo nl2br(@$setting['content_right']) ?></div>
                </div>
            </div>
        </section>

        <section class="section-content-image" id="section-content-image-right">
            <div class="container container-padding">
                <div class="row">
                    <div class="col-lg-6 col-12">
                        <div class="about-content-text"><?php echo nl2br(@$setting['content_left']) ?></div>
                    </div>

                    <div class="col-lg-6 col-12 about-content-image-right-box">
                        <div class="about-content-image">
                            <img src="<?php echo @$setting['image_right'] ?>" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="section-about-misstion">
            <div class="container container-padding">
                <div class="about-misstion-box">
                    <div class="title-mission">
                        <h2>Sứ mệnh</h2>
                    </div>
        
                    <div class="content-mission">
                        <?php echo @$setting['mission'] ?>
                    </div>
                </div>
            </div>
        </section>

        <section id="section-about-value">
            <div class="container container-padding">
                <div class="title-value">
                    <h2>Giá trị cốt lõi</h2>
                </div>
                <div class="value-group">
                    <div class="value-item-3">
                        <div class="value-item-detail">
                            <div class="value-item-icon">
                                <img src="<?php echo @$setting['image_core1'] ?>" alt="">
                            </div>

                            <div class="value-item-text">
                                <p><?php echo @$setting['name_core1'] ?></p>
                            </div>
                        </div>

                        <div class="value-item-detail">
                            <div class="value-item-icon">
                                <img src="<?php echo @$setting['image_core2'] ?>" alt="">
                            </div>

                            <div class="value-item-text">
                                <p><?php echo @$setting['name_core2'] ?></p>
                            </div>
                        </div>

                        <div class="value-item-detail">
                            <div class="value-item-icon">
                                <img src="<?php echo @$setting['image_core3'] ?>" alt="">
                            </div>

                            <div class="value-item-text">
                                <p><?php echo @$setting['name_core3'] ?></p>
                            </div>
                        </div>
                    </div>

                    <div class="value-item-2">
                        <div class="value-item-detail">
                            <div class="value-item-icon">
                                <img src="<?php echo @$setting['image_core4'] ?>" alt="">
                            </div>

                            <div class="value-item-text">
                                <p><?php echo @$setting['name_core4'] ?></p>
                            </div>
                        </div>

                        <div class="value-item-detail">
                            <div class="value-item-icon">
                                <img src="<?php echo @$setting['image_core5'] ?>" alt="">
                            </div>

                            <div class="value-item-text">
                                <p><?php echo @$setting['name_core5'] ?></p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="section-about-number">
            <div class="container container-padding">
                <div class="box-about-number">
                    <div class="title-number">
                        <h2>Những con số ấn tượng</h2>
                    </div>
    
                    <div class="value-group">
                        <div class="value-item-2">
                            <div class="value-item-detail">
                                <div class="value-item-icon">
                                    <img src="<?php echo @$setting['image_impression1'] ?>" alt="">
                                </div>
    
                                <div class="value-item-text">
                                    <p><?php echo @$setting['name_impression1'] ?></p>
                                </div>
                            </div>
    
                            <div class="value-item-detail">
                                <div class="value-item-icon">
                                    <img src="<?php echo @$setting['image_impression2'] ?>" alt="">
                                </div>
    
                                <div class="value-item-text">
                                    <p><?php echo @$setting['name_impression2'] ?></p>
    
                                </div>
                            </div>
                        </div>
    
                        <div class="value-item-3">
                            <div class="value-item-detail">
                                <div class="value-item-icon-six">
                                    <img src="<?php echo @$setting['image_impression3'] ?>" alt="">
                                </div>
    
                                <div class="value-item-text">
                                    <p><?php echo @$setting['name_impression3'] ?></p>
                                </div>
                            </div>
    
                            <div class="value-item-detail">
                                <div class="value-item-icon-six">
                                    <img src="<?php echo @$setting['image_impression4'] ?>" alt="">
                                </div>
    
                                <div class="value-item-text">
                                    <p><?php echo @$setting['name_impression4'] ?></p>
                                </div>
                            </div>
    
                            <div class="value-item-detail">
                                <div class="value-item-icon-last">
                                    <img src="<?php echo @$setting['image_impression5'] ?>" alt="">
                                </div>
    
                                <div class="value-item-text">
                                    <p><?php echo @$setting['name_impression5'] ?>
                                        <!-- <span>(tính đến thời điểm hiện tại)</span> -->
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="section-aboutus-bottom">
            <div class="container container-padding">
                <div class="background-about-bottom">
                    <img src="<?php echo @$setting['image'] ?>" alt="">
                </div>
               
                <div class="text-italic-blue"><?php echo @$setting['content_below'] ?></div>
            </div>
        </section>






                
    </main>
<?php
getFooter();?>