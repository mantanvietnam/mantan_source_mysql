
<?php 
    global $settingThemes;
    global $modelAlbums;
    global $modelAlbuminfos;
?>

    <?php getHeader();?>

    
    <main>
        <?php
        if(!empty($slide_home)){
        echo'
        <section id="section-home-banner" class="section-home-banner-background">
            <div class="home-banner">
                <div class="logo-banner-box">
                    <div class="container">
                        <div class="logo-warm">
                            <img src="'; echo $urlThemeActive; echo'/asset/img/WARM-horz-EN-_1_.jpg" alt="">
                        </div>
                    </div>
                </div>
                <div class="banner-home-slide">';
                
                foreach($slide_home as $key => $value){
                echo'
                    <div class="banner-img">
                        <img src="'.$value->image.'" alt="">
                        <div class="description-img">
                            <div class="container">
                                <p>'.$value->description.'</p>
                            </div>   
                        </div>
                    </div>
                ';
                }
                echo'
                </div>
            </div>
        </section>';
        }
        ?>

        <!-- <section id="section-logo-home">
            <div class="container-fluid logo-home-box">
                <div class="logo-home-item">

                    <div class="logo-home-img logo-home-0">
                        <img src="<?php echo $urlThemeActive;?>/asset/img/gateway.png" alt="">
                    </div>

                    <div class="logo-home-img logo-home-1">
                        <img src="<?php echo $urlThemeActive;?>/asset/img/Logo-set-with-GG-EU-emblem (1).png" alt="">
                    </div>
        
                    <div class="logo-home-img logo-home-2">
                        <img src="<?php echo $urlThemeActive;?>/asset/img/logo-afd.png" alt="">
                    </div>
                </div>
                
            </div>
        </section> -->

        <!-- WARM Facility -->
        <section id="section-facility" data-aos="fade-up">
            <div class="title-section">
                <h1><?php echo @$settingThemes['title_section_1'];?></h1>
                <div class="title-divide-section"></div>
            </div>

            <div style="background-image: url(<?php echo $urlThemeActive;?>/asset/img/facility-background.png)" class="facility-content-background">
                <div class="container facility-content">
                    <div class="row">
                        <div class="col-lg-5 col-md-5 col-sm-12 col-12 facility-content-left">
                            <div class="title-facility-content">
                                <h2><?php echo @$settingThemes['title_content_section_1'];?></h2>
                            </div>

                            <div class="introduce-facility-content">
                                <h3><?php echo @$settingThemes['title_sub_section_1'];?></h3>
                            </div>

                            <div class="text-facility-content">
                                <h3><?php echo @$settingThemes['content_section_1'];?></h3>
                            </div>
                        </div>

                        <div class="col-lg-7 col-md-7 col-sm-12 col-12 facility-content-right">
                            <iframe src="<?php echo @$settingThemes['link_video_section_1'];?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>                        
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <!-- Our Projects -->
        <section id="section-project" data-aos="fade-up">
            <div class="title-section">
                <h1><?php echo @$settingThemes['title_section_2'];?></h1>
                <div class="title-divide-section"></div>
            </div>
            <div class="project-content">
                <div class="project-slide">
                    <?php 
                    // debug($home_projects);
                    if(!empty($home_projects)){
                        foreach($home_projects as $key => $value){
                            if($value->status == 'active')
                            echo'
                            <div class="project-item">
                                <div class="project-item-title">
                                    <h2><strong>'.$value->title.'</strong> Project</h2> 
                                </div>

                                <div class="project-item-img">
                                    <a href="'.$value->slug_drive.'"><img src="'.$value->image.'" alt=""></a>
                                </div>
                            </div>';
                        }
                    }
                    ?>
                </div>
            </div>
        </section>

        <!-- key date -->
        <section data-aos="fade-up" style="background-image: url(<?php echo $urlThemeActive;?>/asset/img/background-keydate.png);" id="section-keydate">
            <div class="title-section">
                <h1><?php echo @$settingThemes['title_section_3'];?></h1>
                <div class="title-divide-section"></div>
            </div>

            <div class="keydate-content">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-7 col-md-7 col-12 keydate-left">
                            <div class="keydate-grant">
                                <span class="odometer keydate-number"><?php echo @$settingThemes['content_1_section_3'];?></span><span class="tranform-text">M</span>
                                <p><?php echo @$settingThemes['title_content_1_section_3'];?></p>
                            </div>

                            <div class="keydate-loan">
                                <span class="odometer2 my-numbers keydate-number"><?php echo @$settingThemes['content_2_section_3'];?></span><span class="tranform-text">M</span>
                                <p><?php echo @$settingThemes['title_content_2_section_3'];?></p>
                            </div>

                            <div class="keydate-years">
                                <span class="odometer3 my-numbers number-years"><?php echo @$settingThemes['content_3_section_3'];?> </span>&nbsp; &nbsp;<span class="tranform-text">Years</span>
                                <p><?php echo @$settingThemes['title_content_3_section_3'];?></p>
                            </div>
                        </div>
        
                        <div class="col-lg-5 col-md-5 col-12 keydate-right">
                            <span class="odometer4 number-project"><?php echo @$settingThemes['content_4_section_3'];?></span><span class="tranform-text">&nbsp;Projects</span>
                            <p><?php echo @$settingThemes['title_content_4_section_3'];?></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- photo -->
        <section data-aos="fade-up" style="background-image: url(<?php echo $urlThemeActive;?>/asset/img/background-photo.png);" id="section-photo">
            <div class="title-section">
                <h1><?php echo @$settingThemes['title_section_4'];?></h1>
                <div class="title-divide-section"></div>
            </div>

            <div class="photo-content">
                <div class="photo-slide">
                    <?php
                        if(!empty($album_photo)){
                            foreach($album_photo as $key => $value){
                                echo'
                                <div class="photo-item">
                                    <div class="photo-item-img">
                                        <img src="'.$value->image.'" alt="">
                                    </div>
                                </div>';
                            }
                        }
                    ?>
                  
                </div>

                <div class="photo-link">
                    <a href="/thematicPhoto/i-resilience-of-cities-and-territories-to-climate-change-and-natural-hazards-1-16.html">GO TO PHOTO <strong>GALLERY</strong></a>
                </div>
            </div>
        </section>
        
    </main>

<section id="footer-home">
    <?php getFooter();?>
</section>