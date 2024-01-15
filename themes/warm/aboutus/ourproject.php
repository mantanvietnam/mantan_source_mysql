<?php 
    global $settingThemes;
    global $modelAlbums;
    global $modelAlbuminfos;
?>
<?php getHeader();
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
                <h1>OUR PROJECTS</h1>
                <div class="title-divide-section"></div>
            </div>

            <duv class="facility-background">
                <div class="facility-background-inner" sytle="background-image: url(<?php echo @$data->banner ?>)">
                    <div class="facility-background" style="background-image: url(<?php echo @$data->banner ?>);"></div>
                    <div class="facility-overlay ourproject-overlay"></div>
                    <div class="facility-overlay-right ourproject-overlayright"></div>
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6 col-md-12 col-sm-12 col-12 facility-background-box facility-background-box-2">
                                <div class="facility-background-title-2">
                                    <h2><?php echo @$data->title ?> PROJECT</h2>
                                </div>

                                <div class="facility-background-content">
                                    <div class="facility-content-item">
                                        <h3>Project name: </h3>
                                        <p><?php echo @$data->name_project ?></p>
                                    </div>

                                    <div class="facility-content-item">
                                        <h3>Project duration: </h3>
                                        <p><?php echo @$data->duration ?></p>
                                    </div>

                                    <div class="facility-content-item">
                                        <h3>Lead agency: </h3>
                                        <p><?php echo @$data->lead_agency ?></p>
                                    </div>

                                    <div class="facility-content-item">
                                        <h3>Implementing agency: </h3>
                                        <p><?php echo @$data->implementing_agency ?></p>
                                    </div>

                                    <div class="facility-content-item">
                                        <h3>Donors:  </h3>
                                        <p><?php echo @$data->donor ?></p>
                                    </div>

                                    <div class="facility-content-item">
                                        <h3>Total investment cost: </h3>
                                        <p><?php echo @$data->investment ?></p>
                                    </div>

                                    <div class="facility-content-item-button">
                                        <button>
                                            <a target="_blank" href="<?php echo @$data->slug_drive ?>">Download Factsheet</a>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                      
                    </div>
                </div>
            </duv>
        </section>
        <!--  -->
        <?php if(!empty($listVideo)){ ?>
        <section id="section-video-ourproject">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="slide-ourproject-video col-lg-8 col-md-12">
                        <div class="slide-ourproject-video-inner">
                            <?php foreach($listVideo  as $key => $value){ ?>
                            <div class="slide-ourproject-video-item">
                                <div class="video-ourproject-title">
                                    <h2>
                                        <?php echo $value->title; ?>
                                    </h2>
                                </div>
                                <div class="slide-ourproject-video-iframe">
                                    <iframe width="1257" height="707" src="https://www.youtube.com/embed/<?php echo $value->link; ?>" title="Reducing inequality, a question of survival" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                                </div>
                            </div>
    
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php } 
     if(!empty($listPhoto)){ ?>
        <!-- Warm photo collection -->
        <section id="section-photo" class="section-photo-collection section-photo-ourproject">
            <div class="ourproject-top">
                <div class="container">
                    <div class="photo-slide-top">
                        <?php foreach($listPhoto as $key => $item){ ?>
                        <div class="ourproject-slide-top-item">
                            
                            <div class="row">
                                <div class="ourproject-top-left col-lg-4 col-12">
                                    <div class="ourproject-top-left-title">
                                        <p>PROJECT PHOTO</p>
                                        <div class="ourproject-top-left-link">
                                            <a href="<?php echo $Photo->author ?>">GO TO PHOTO GALLERY</a>
                                        </div>
                                    </div>
                                    <div class="ourproject-top-left-bot">
                                        <p><?php echo $item->description ?></p>
                                    </div>
                                </div>

                                <div class="ourproject-top-right col-lg-8 col-12">
                                    <div class="ourproject-top-right-inner">
                                        <img src="<?php echo $item->image ?>" alt="">
                                    </div>
                                </div>
                            </div>
                          
                        </div>
                         <?php } ?>
                    </div>
                </div>
            </div>
            

            <div class="photo-slide-bottom-background">
                <div class="container">
                    <div class="photo-slide-bottom">
                        <?php foreach($listPhoto as $key => $item){ 
                          echo   '<div class="photo-slide-bottom-item">
                                <img src="'.@$item->image.'" alt="">
                            </div>';
                        }

                        ?>
                       
                    </div>
                </div>
            </div>
        </section>
        <?php } 
         if(!empty($listPosts)){ ?>
        <!-- Project's news -->
        <section id="section-press-releases" class="ourproject-news">
            <div class="title-section">
                <h1>Project news</h1>
                <div class="title-divide-section"></div>
            </div>

            <div class="news-press">
                <div class="news-press-inner">
                    <div class="news-press-slide">
                        <?php foreach($listPosts as $key => $item){ 
                        echo '<div class="news-press-item">
                            <div class="news-press-item-inner">
                                <div class="news-item-img">
                                    <a href="/'.@$item->slug.'.html"><img src="'.@$item->image.'" alt=""></a>
                                </div>
        
                                <div class="news-item-content">
                                    <a href="/'.@$item->slug.'.html">'.@$item->title.'</a>
                                </div>
                            </div>
                        </div>';
                    }?>

                       
                    </div>
                </div>
            </div>
        </section>
    <?php } 
         if(!empty($listPosts2)){ ?>
        <!-- Project's press releases -->
         <section id="section-press-releases" class="ourproject-news">
            <div class="title-section">
                <h1>Project press releases</h1>
                <div class="title-divide-section"></div>
            </div>

            <div class="news-press">
                <div class="news-press-inner">
                    <div class="news-press-slide">
                        
                        <?php foreach($listPosts2 as $key => $item){ 
                            echo '<div class="news-press-item">
                                <div class="news-press-item-inner">
                                    <div class="news-item-img">
                                        <a target="_blank" href="'.@$item->link.'"><img src="'.@$item->image.'" alt=""></a>
                                    </div>
            
                                    <div class="news-item-content">
                                        <a target="_blank" href="'.@$item->link.'">'.@$item->name.'</a>
                                    </div>
                                </div>
                            </div>';
                        }?>
                    </div>
                </div>
            </div>
        </section>
        <?php } ?>
    </main>

<?php getFooter();?>