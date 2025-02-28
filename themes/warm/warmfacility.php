<?php 
    global $settingThemes;
    global $modelAlbums;
    global $modelAlbuminfos;
?>
<?php getHeader();
    // debug($listData);
   // debug($data);
?>
<main>
        <section id="section-home-banner" class="section-logo-header">
            <div class="home-banner">
                <div class="logo-banner-box">
                    <div class="container">
                        <div class="logo-warm">
                            <a href="/"><img src="<?php echo $urlThemeActive;?>/asset/img/WARM-horz-EN-_1_.jpg" alt=""></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- facility -->
        <section id="section-facility-main">
            <div class="title-section">
                <h1><?php echo $data['title_top'] ?></h1>
                <div class="title-divide-section"></div>
            </div>

            <div class="title-section-sub">
                <div class="container">
                    <?php echo $data['text_top'] ?>
                </div>
            </div>


            <duv class="facility-background">
                <div class="facility-background-inner" sytle="background-image: url( <?php echo $data['image_2'] ?>)">
                    <div class="facility-background" style="background-image: url( <?php echo $data['image_2'] ?>);"></div>
                    <div class="facility-overlay"></div>
                    <div class="facility-overlay-right"></div>
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6 col-md-12 col-sm-12 col-12 facility-background-box">
                                <div class="facility-background-title">
                                    <h2><?php echo $data['title_2'] ?></h2>
                                </div>

                                <div class="facility-background-content"><?php echo $data['text_2'] ?></div>
                            </div>
                        </div>
                      
                    </div>
                </div>
            </duv>
        </section>

        <!-- Description -->
        <section id="section-facility-description">
            <div class="facility-description-inner">
                <div class="container">
                    <div class="title-sub-section">
                        <h3><?php echo $data['title_3'] ?></h3>
                    </div>

                    <div class="facility-description-content">
                        <div class="facility-description-content-inner">
                            <div class="row">
                                <div class="col-lg-7 col-md-7 col-sm-12 col-12 description-content-left">
                                   <?php echo $data['text_3'] ?>
                                 
                                </div>
    
                                <div class="col-lg-5 col-md-5 col-sm-12 col-12 description-content-right">
                                    <div class="description-content-background">
                                        <img src="<?php echo $data['image_3'] ?>" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

       
        <!-- section facility-project -->
        <section id="section-facility-project">
            <div class="facility-project-inner">
                <div class="container">
                    <div class="title-sub-section">
                        <h3><?php echo $data['title_4'] ?> </h3>
                    </div>
                    
                    <div class="facility-project-content">
                        <?php echo $data['text_4'] ?>
                    </div>
                </div>
            </div> 
        </section>

         <!-- impact -->
         <section id="section-facility-impact">
            <div class="facility-impact-inner">
                <div class="container">
                    <div class="title-sub-section">
                        <h3><?php echo $data['title_5'] ?></h3>
                    </div>
                    
                    <div class="facility-impact-content">
                        <?php echo $data['text_5_top'] ?>
                    </div>
                </div>
            </div> 

            <div class="facility-impact-content2">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5 col-md-5 -col-sm-5 col-12 facility-impact-left">
                            <div class="facility-impact-left-background">
                                <img src="<?php echo $data['image_5'] ?>" alt="">
                            </div>
                        </div>

                        <div class="col-lg-7 col-md-7 -col-sm-7 col-12 facility-impact-right">
                            <p class="facility-impact-right-title">WARM NOTABLY CONTRIBUTES TO:</p>
                            <?php echo $data['text_5_phai'] ?>
                        </div>

                        <div class="col-lg-12 col-md-12 -col-sm-12 col-12 facility-impact-bottom">
                            <?php echo $data['text_5_duoi'] ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section id="section-facility-description" class="section-padding-facility">
            <div class="facility-description-inner">
                <div class="container">
                    <div class="title-sub-section">
                        <h3><?php echo $data['title_6'] ?></h3>
                    </div>

                    <div class="facility-description-content">
                        <div class="facility-description-content-inner">
                            <div class="row">
                                <div class="description-content-left">
                                   <?php echo $data['text_6'] ?>
                                </div>
    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="section-facility-description" class="section-padding-facility section-background-silver">
            <div class="facility-description-inner">
                <div class="container">
                    <div class="title-sub-section">
                        <h3><?php echo $data['title_7'] ?></h3>
                    </div>

                    <div class="facility-description-content">
                        <div class="facility-description-content-inner">
                            <div class="row">
                                <div class="description-content-left">
                                <?php echo $data['text_7'] ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>
    <?php getFooter();?>