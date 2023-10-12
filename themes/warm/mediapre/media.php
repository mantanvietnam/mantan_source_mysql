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
        <section id="section-facility">
            <div class="title-section">
                <h1>WARM Videos</h1>
                <div class="title-divide-section"></div>
            </div>

            <div style="background-image: url(<?php echo $urlThemeActive;?>/asset/img/facility-background.png)" class="facility-content-background">
                <div class="container facility-content">
                    <div class="row">
                        <div class="col-lg-5 col-md-5 col-sm-12 col-12 facility-content-left">
                            <div class="title-facility-content title-media-content">
                                <h2><?php echo $data_value['title'] ?></h2>
                            </div>

                            <div class="introduce-facility-content">
                                <h3><?php echo $data_value['description'] ?></h3>
                            </div>

                            <div class="text-facility-content"><?php echo $data_value['content'] ?></div>
                        </div>

                        <div class="col-lg-7 col-md-7 col-sm-12 col-12 facility-content-right">
                            <iframe src="https://www.youtube.com/embed/<?php echo $data_value['video'] ?>?si=ASZfY3b7spvtYlPy" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>                            <div class="media-link-iframe">
                                <a href="">GO TO <strong>VIDEO GALERY</strong></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Warm photo collection -->
        <section id="section-photo" class="section-photo-collection">
            <div class="title-section">
                <h1>WARM photo collections</h1>
                <div class="title-divide-section"></div>
            </div>
            
            <div class="photo-top">
                <div class="container">
                    <div class="photo-slide-top">
                        <?php foreach($slide_home->imageinfo as $key => $item){ ?>
                        <div class="photo-slide-top-item">
                            <div class="photo-slide-top-item-image">
                                <img src="<?php echo $item->image;?>" alt="">
                            </div>
                            <div class="photo-slide-top-item-description">
                                <p><?php echo $item->description;?></p>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>

            <div class="photo-slide-bottom-background">
                <div class="container">
                    <div class="photo-slide-bottom">
                        
                         <?php foreach($slide_home->imageinfo as $key => $item){ ?>
                        <div class="photo-slide-bottom-item">
                            <img src="<?php echo $item->image;?>" alt="">
                        </div>
                        <?php } ?>
                        
                    </div>
                </div>
            </div>

            <div class="blue-link-media">
                <a href="">GO TO <strong>PHOTO GALERY</strong></a>
            </div>
        </section>

        <section id="section-press-releases">
            <div class="title-section">
                <h1>Press Releases</h1>
                <div class="title-divide-section"></div>
            </div>

            <div class="news-press">
                <div class="news-press-inner">
                    <div class="news-press-slide">
                        <?php foreach($media as $key => $item){ ?>
                        <div class="news-press-item">
                            <div class="news-press-item-inner">
                                <div class="news-item-img">
                                    <img src="<?php echo $item->image;?>" alt="">
                                </div>
        
                                <div class="news-item-content">
                                    <a target="_blank" href="<?php echo $item->link;?>"><?php echo $item->name;?></a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                        
                    </div>
                </div>

                <div class="blue-link-media">
                    <a href="">GO TO <strong>PRESS RELEASES</strong></a>
                </div>
            </div>
        </section>


        <!-- section on media -->
        <!-- <secttion id="section-on-media">
            <div class="title-section">
                <h1>WARM on media</h1>
                <div class="title-divide-section"></div>
            </div>

            <div class="on-media-list">
                <div class="container">
                    <div class="row">
                        <div class="on-media-inner">
                            Tin tức nổi bật media 
                            <div class="on-media-highligh col-12">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                        <div class="news-item-title">
                                            <p>Workshop “Hoi An coastline management strategy for sustainability”</p>
                                        </div>

                                        <div class="news-item-description">
                                            Chairing the workshop were: Vice Chairman of Quang Nam Provincial People's Committee Ho Quang Buu, Director of the French Development Agency in Vietnam Hervé Conan and Chief Representative of the European Union Cooperation Department Kristina Buende. Attending were more than 20 domestic and international experts and the Hoi An tourism community.
                                        </div>

                                        <div class="news-right-button-news">
                                            <a href="">Read more </a> 
                                            <img src="<?php echo $urlThemeActive;?>/asset/img/arow.png" alt="">
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                        <div class="news-item-img">
                                            <img src="<?php echo $urlThemeActive;?>/asset/img/Workshop Quang Nam_090923 (C)-17.jpg" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>


                           
                            <div class="row on-media-extra-row">
                                <div class="row">
                                      
                                    <div class="on-media-extra-item col-lg-6 col-md-6 col-sm-6 col-12 on-media-extra-left">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                                <div class="news-item-img">
                                                    <img src="<?php echo $urlThemeActive;?>/asset/img/Workshop Quang Nam_090923 (C)-17.jpg" alt="">
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                                <div class="news-item-title">
                                                    <p>Workshop “Hoi An coastline management strategy for sustainability”</p>
                                                </div>
        
                                                <div class="news-item-description">
                                                    Chairing the workshop were: Vice Chairman of Quang Nam Provincial People's Committee Ho Quang Buu, Director of the French Development Agency in Vietnam Hervé Conan and Chief Representative of the European Union Cooperation Department Kristina Buende. Attending were more than 20 domestic and international experts and the Hoi An tourism community.
                                                </div>
        
                                                <div class="news-right-button-news">
                                                    <a href="">Read more </a> 
                                                    <img src="<?php echo $urlThemeActive;?>/asset/img/arow.png" alt="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                               
                                    <div class="on-media-extra-item col-lg-6 col-md-6 col-sm-6 col-12 on-media-extra-right">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                                <div class="news-item-img">
                                                    <img src="<?php echo $urlThemeActive;?>/asset/img/Workshop Quang Nam_090923 (C)-17.jpg" alt="">
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                                <div class="news-item-title">
                                                    <p>Workshop “Hoi An coastline management strategy for sustainability”</p>
                                                </div>
        
                                                <div class="news-item-description">
                                                    Chairing the workshop were: Vice Chairman of Quang Nam Provincial People's Committee Ho Quang Buu, Director of the French Development Agency in Vietnam Hervé Conan and Chief Representative of the European Union Cooperation Department Kristina Buende. Attending were more than 20 domestic and international experts and the Hoi An tourism community.
                                                </div>
        
                                                <div class="news-right-button-news">
                                                    <a href="">Read more </a> 
                                                    <img src="<?php echo $urlThemeActive;?>/asset/img/arow.png" alt="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="blue-link-media">
                                <a href="">GO TO <strong>PHOTO GALERY</strong></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </secttion> -->
    </main>

<?php getFooter();?>