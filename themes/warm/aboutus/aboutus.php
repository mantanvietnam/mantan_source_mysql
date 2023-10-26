<?php 
    global $settingThemes;
    global $modelAlbums;
    global $modelAlbuminfos;
?>
<?php getHeader();
    //sdebug($media);
   //  debug($data);
?>
  <main>
        <!--  -->
        <section id="section-home-banner" class="section-logo-header">
            <div class="home-banner">
                <div class="logo-banner-box">
                    <div class="container">
                        <div class="logo-warm">
                            <img src="<?php echo $urlThemeActive;?>/asset/img/WARM-horz-EN-_1_.jpg" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- WARM Facility -->
        <section id="section-facility" class="section-facility-content" >
            <div class="title-section">
                <h1>WARM Facility</h1>
                <div class="title-divide-section"></div>
            </div>

            <div style="background-image: url(<?php echo $urlThemeActive;?>/asset/img/facility-background.png)" class="facility-content-background">
                <div class="container facility-content">
                    <div class="row">
                        <div class="col-lg-5 col-md-12 col-sm-12 col-12 facility-content-left">
                            <div class="text-facility-content">
                                <?php echo $data_value['content'] ?>
                            </div>

                            <div class="text-facility-link">
                                <a href="http://warm.creatio.vn/themes/warm/html/page/warmfacility.html">Read more <i class="fa-solid fa-angles-right"></i></a>
                            </div>
                        </div>

                        <div class="col-lg-7 col-md-12 col-sm-12 col-12 facility-content-right">
                            <iframe src="https://www.youtube.com/embed/lrMdIYQch1o" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>                        
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- our Projects -->
        <section id="section-project-page">
            <div class="title-section">
                <h1>WARM Projects</h1>
                <div class="title-divide-section"></div>
            </div>

            <div class="project-accordior-box">
                <div class="container">
                    <div class="row row-project-accordior-box">
                        <div class="col-lg-10 col-sm-10 col-md-10 col-12 d-flex align-items-start project-accordior">
                            <div class="col-lg-4 col-md-4 col-12 project-nav nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            	 <?php
                                  foreach($Project as $key => $item){ ?>
                                <button class="nav-link <?php if($key==0){echo 'active';} ?>" id="v-pills-place<?php echo $item->id; ?>-tab" data-bs-toggle="pill" data-bs-target="#v-pills-place<?php echo $item->id; ?>" type="button" role="tab" aria-controls="#v-pills-place<?php echo $item->id; ?>" aria-selected="true"><?php echo $item->title; ?></button>
                               <?php } ?>
                            </div>
                            <div class="col-lg-8 col-md-8 col-12 project-tab-content tab-content" id="v-pills-tabContent">
                                <!-- Dien Bien -->
                                 <?php foreach($Project as $key => $item){ ?>
                                <div class="tab-pane fade  <?php if($key==0){echo 'show active';} ?>" id="v-pills-place<?php echo $item->id; ?>" role="tabpanel" aria-labelledby="v-pills-place<?php echo $item->id; ?>-tab">
                                    <div class="project-accordior-image">
                                        <img src="<?php echo $item->image ?>" alt="">
                                    </div>
                                    <div class="project-accordior-detail">
                                        <div class="project-detail project-name">
                                            <div class="project-detail-left">
                                                <strong>Project name:</strong>
                                            </div>

                                            <div class="project-detail-right">
                                                <p><?php echo $item->name_project ?></p>                
                                            </div>
                                        </div>

                                        <div class="project-detail project-name">
                                            <div class="project-detail-left">
                                                <strong>Project duration:</strong>
                                            </div>

                                            <div class="project-detail-right">
                                                <p><?php echo $item->duration ?></p>
                                            </div>
                                        </div>

                                        <div class="project-detail project-name">
                                            <div class="project-detail-left">
                                                <strong>Lead agency:</strong>
                                            </div>

                                            <div class="project-detail-right">
                                                <p><?php echo $item->lead_agency ?></p>
                                            </div>
                                        </div>

                                        <div class="project-detail project-name">
                                            <div class="project-detail-left">
                                                <strong>Implementing agency:</strong>
                                            </div>

                                            <div class="project-detail-right">
                                                <p><?php echo $item->implementing_agency ?></p>
                                            </div>
                                        </div>

                                        <div class="project-detail project-name">
                                            <div class="project-detail-left">
                                                <strong>Donors:</strong>
                                            </div>

                                            <div class="project-detail-right">
                                                <p><?php echo $item->donor ?></p>
                                            </div>
                                        </div>

                                        <div class="project-detail project-name">
                                            <div class="project-detail-left">
                                                <strong>Total investment cost:</strong>
                                            </div>

                                            <div class="project-detail-right">
                                                <p><?php echo $item->investment ?></p>
                                            </div>
                                        </div>
                                        <div class="opportunity-button">
                                            <a href="<?php echo $item->slug_drive ?>"><img src="<?php echo $urlThemeActive;?>/asset/img/down-arrow_2989995.svg" alt=""></a>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                                

                            </div>
                        </div> 
                    </div>

                </div>
            </div>
        </section>
        
        <!-- Our partner -->
        <!-- <section id="section-our-partner">
            <div class="title-section">
                <h1>Our partners </h1>
                <div class="title-divide-section"></div>
            </div>

            <div class="container">
                <div class="list-partner">
                	 <?php foreach($slide_home->imageinfo as $key => $item){ ?>
                    <div class="partner-item">
                        <div class="partner-logo">
                            <img src="<?php echo $item->image;?>" alt="">
                        </div>
    
                        <div class="partner-name">
                            <p><?php echo $item->title ;?></p>
                        </div>
                    </div>
    				 <?php } ?>
    
                    
                </div>
            </div>
        </section> -->

        <section id="section-our-partner">
            <div class="title-section">
                <h1>Our partners </h1>
                <div class="title-divide-section"></div>
            </div>

            <div class="container">
                <div class="list-partner">
                    <div class="partner-item">
                        <div class="partner-logo">
                            <img src="<?php echo $urlThemeActive;?>/asset/img/logopartner.png" alt="">
                        </div>
    
                        <div class="partner-name">
                            <p>MINISTRY OF CONSTRUCTION</p>
                        </div>
                    </div>
    
                    <div class="partner-item partner-item2">
                        <div class="partner-logo">
                            <img src="<?php echo $urlThemeActive;?>/asset/img/logo2.png" alt="">
                        </div>

                        <div class="partner-name">
                            <p>MINISTRY OF NATURAL RESOURCES AND ENVIRONMENT</p>
                        </div>
                    </div>
    
                    <div class="partner-item partner-item3">
                        <div class="partner-logo">
                            <img src="<?php echo $urlThemeActive;?>/asset/img/logo-3.png" alt="">
                        </div>

                        <div class="partner-name">
                            <p>MINISTRY OF AGRICULTURE AND RURAL DEVELOPMENT</p>
                        </div>
                    </div>
    
                    <div class="partner-item">
                        <div class="partner-logo">
                            <img src="<?php echo $urlThemeActive;?>/asset/img/logopartner.png" alt="">
                        </div>
    
                        <div class="partner-name">
                            <p>PEOPLE'S COMMITTEE OF Bac Kan PROVINCE</p>
                        </div>
                    </div>
    
                    <div class="partner-item">
                        <div class="partner-logo">
                            <img src="<?php echo $urlThemeActive;?>/asset/img/logopartner.png" alt="">
                        </div>
    
                        <div class="partner-name">
                            <p>PEOPLE'S COMMITTEE OF Dien Bien PROVINCE</p>
                        </div>
                    </div>
    
                    <div class="partner-item">
                        <div class="partner-logo">
                            <img src="<?php echo $urlThemeActive;?>/asset/img/logopartner.png" alt="">
                        </div>
                        <div class="partner-name">
                            <p>PEOPLE'S COMMITTEE OF Son La PROVINCE</p>
                        </div>
                    </div>

                    <div class="partner-item">
                        <div class="partner-logo">
                            <img src="<?php echo $urlThemeActive;?>/asset/img/logopartner.png" alt="">
                        </div>
    
                        <div class="partner-name">
                            <p>PEOPLE'S COMMITTEE OF Lang Son PROVINCE</p>
                        </div>
                    </div>

                    <div class="partner-item">
                        <div class="partner-logo">
                            <img src="<?php echo $urlThemeActive;?>/asset/img/logopartner.png" alt="">
                        </div>
    
                        <div class="partner-name">
                            <p>PEOPLE'S COMMITTEE OF Quang Tri PROVINCE</p>
                        </div>
                    </div>

                    <div class="partner-item">
                        <div class="partner-logo">
                            <img src="<?php echo $urlThemeActive;?>/asset/img/logopartner.png" alt="">
                        </div>
    
                        <div class="partner-name">
                            <p>PEOPLE'S COMMITTEE OF Quang Nam PROVINCE</p>
                        </div>
                    </div>

                    <div class="partner-item">
                        <div class="partner-logo">
                            <img src="<?php echo $urlThemeActive;?>/asset/img/logopartner.png" alt="">
                        </div>
    
                        <div class="partner-name">
                            <p>PEOPLE'S COMMITTEE OF Ninh Thuan PROVINCE</p>
                        </div>
                    </div>

                    <div class="partner-item">
                        <div class="partner-logo">
                            <img src="<?php echo $urlThemeActive;?>/asset/img/logopartner.png" alt="">
                        </div>
    
                        <div class="partner-name">
                            <p>PEOPLE'S COMMITTEE OF Vinh Long PROVINCE</p>
                        </div>
                    </div>

                    <div class="partner-item">
                        <div class="partner-logo">
                            <img src="<?php echo $urlThemeActive;?>/asset/img/logopartner.png" alt="">
                        </div>
    
                        <div class="partner-name">
                            <p>PEOPLE'S COMMITTEE OF Hau Giang PROVINCE</p>
                        </div>
                    </div>

                    <div class="partner-item">
                        <div class="partner-logo">
                            <img src="<?php echo $urlThemeActive;?>/asset/img/logopartner.png" alt="">
                        </div>
    
                        <div class="partner-name">
                            <p>PEOPLE'S COMMITTEE OF Ca Mau PROVINCE</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- keydata -->
         <!-- key date -->
         <section style="background-image: url(<?php echo $urlThemeActive;?>/asset/img/background-keydate.png);" id="section-keydate">
            <div class="title-section">
                <h1>Key data</h1>
                <div class="title-divide-section"></div>
            </div>

            <div class="keydate-content">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-7 col-md-7 col-12 keydate-left">
                            <div class="keydate-grant">
                                <span class="odometer keydate-number">0</span><span class="tranform-text"> M</span>
                                <p>grant by EU</p>
                            </div>

                            <div class="keydate-loan">
                                <span class="odometer2 keydate-number">200</span><span class="tranform-text"> M</span>
                                <p>loan by AFD</p>
                            </div>

                            <div class="keydate-years">
                                <span class="odometer3 my-numbers number-years">0</span><span class="tranform-text">&nbsp;Years</span>
                                <p>2021-2029</p>
                            </div>
                        </div>
        
                        <div class="col-lg-5 col-md-5 col-12 keydate-right">
                            <span><span class="odometer4 number-project">0</span><span class="tranform-text">&nbsp;Projects</span>
                            <p>Bac Kan, Dien Bien, Son La, Lang Son, Quang Tri, Quang Nam, Ninh Thuan, Vinh Long, Hau Giang, Ca Mau; and other potential projects</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>

<?php getFooter();?>