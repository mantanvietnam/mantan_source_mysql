<?php getHeader();?>

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

        <section id="section-page-title">
            <div class="title-section">
                <h1>NEWS & EVENTS</h1>
                <div class="title-divide-section"></div>
            </div>
        </section>

        <!-- news highlighs -->
        <section id="section-news-highlights">
            <div class="section-news-highlights-inner">
                <div class="background-image-news" style="background-image: url(<?php echo $urlThemeActive;?>/asset/img/background-news.png);"></div>
                <div class="background-news-overlay"></div>
                <div class="container">
                <div class="news-highlight">
                        <h2><?php echo $category_post[2]->name ?></h2>
                    </div>
                    <div class="news-highlight-inner">
                        <div class="news-highligh-slide">
                            <?php 
                                if(!empty($highligh_post)){
                                    foreach($highligh_post as $key => $value){
                                    echo' 
                                    <div class="news-highligh-item">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-4 col-sm-12 col-12 news-left">
                                                <div class="img-news-item">
                                                    <img src="'.$value->image.'" alt="">
                                                </div>
                
                                                <div class="title-news-slide">
                                                    <h3>'.$value->title.'</h3>
                                                </div>
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-12 col-12 news-right">
                                                <div class="news-right-inner">
                                                    <div class="news-right-content">
                                                        '.nl2br($value->description).'
                                                    </div>
                                                    <div class="news-right-button">
                                                        <a href="'.$value->slug.'.html">Read more </a>
                                                        <img src="'.$urlThemeActive.'/asset/img/arow.png" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>';
                                    }
                                }
                            ?>
                        </div>
                    </div>
                </div>

                <div class="news-highlight-child">
                    <div class="news-highlight-child-inner">
                        <div class="news-highlight-child-slide">
                            <?php 
                                if(!empty($highligh_post)){
                                    foreach($highligh_post as $key => $value){
                                        echo' 
                                        <div class="news-child-item">
                                            <div class="news-child-img">
                                                <img src="'.$value->image.'" alt="">
                                            </div>
                                            <div class="news-child-title">
                                                <p>'.$value->title.'</p>
                                            </div>
                                        </div>';
                                    }
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php $listEvent = getEvent();
            if(!empty($listEvent)){
         ?>

                <!-- upcoming -->
                <section id="section-event">
            <div class="container">
                <div class="event-item-box d-flex">
                    <?php foreach($listEvent as $key => $item){
                        $class = 'event-item-1';
                        if($key==1){
                             $class = 'event-item-2';
                        }
                    echo '<div class="event-item '.$class.'">
                        <div class="event-meta">
                            <span>'.$item->name.'</span>
                        </div>

                        <div class="event-name">
                            <h3>'.$item->content.'</h3>
                        </div>

                        <div class="event-date">
                            <span>'.date('d F Y', $item->time_create).'</span>
                        </div>
                    </div>';
                 } ?>

                    <!-- <div class="event-item event-item-2">
                        <div class="event-meta">
                            <span>Project launching workshop </span>
                        </div>

                        <div class="event-name">
                            <h3>Coastal sustainable and preventive protection in Quang Nam province</h3>
                        </div>

                        <div class="event-date">
                            <span>23 February 2024   </span>
                        </div>
                    </div> -->

                    <div class="event-item event-item-3">
                        <div class="row row-event-item">
                            <div class="col-lg-4 event-title-1">
                            </div>

                            <div class="col-lg-4 event-title-2">
                            </div>

                            <div class="col-lg-4 event-title-3">
                            </div>
                        </div>
                        <div class="event-title">
                            <h2>UPCOMING 
                                <br>
                                EVENTS</h2>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php } ?>

        <!-- news facility -->
        <section id="section-news-facility" class="section-news-ribbon">
            <div class="section-news-facility-inner">
                <div class="container">
                    <div class="news-title-section-cate">
                        <h2><?php echo $category_post[1]->name ?></h2>
                    </div>
                </div>

                    
                <div class="news-slide news-slide-left">
                    
                    <?php 
                        if(!empty($facility_post)){
                            foreach($facility_post as $key => $value){
                                echo' 
                                <div class="news-slide-item">
                                    <div class="news-slide-item-inner">
                                        <div class="news-item-img">
                                            <img src="'.$value->image.'" alt="">
                                        </div>
                
                                        <div class="news-item-content">
                                            <p>'.$value->title.'</p>
                                        </div>
            
                                        <div class="news-right-button-news">
                                            <a href="'.$value->slug.'.html">Read more </a> 
                                            <img src="'.$urlThemeActive.'/asset/img/arow.png" alt="">
                                        </div>
                                    </div>
                                </div>';
                            }
                        }
                    ?>
                </div>
            </div>
        </section>


        <!-- news project -->
        <section id="section-news-facility" class="section-news-project">
            <div class="section-news-facility-inner">
                <div class="container">
                    <div class="news-title-section-cate">
                        <h2><?php echo $category_post[3]->name ?></h2>
                    </div>
                </div>

                    
                <div class="news-slide">
                    <?php 
                        if(!empty($facility_post)){
                            foreach($project_post as $key => $value){
                                echo' 
                                <div class="news-slide-item">
                                    <div class="news-slide-item-inner">
                                        <div class="news-item-img">
                                            <img src="'.$value->image.'" alt="">
                                        </div>
                
                                        <div class="news-item-content">
                                            <p>'.$value->title.'</p>
                                        </div>
            
                                        <div class="news-right-button-news">
                                            <a href="'.$value->slug.'.html">Read more </a> 
                                            <img src="'.$urlThemeActive.'/asset/img/arow.png" alt="">
                                        </div>
                                    </div>
                                </div>';
                            }
                        }
                    ?>


                </div>
            </div>
        </section>

    </main>

<?php getFooter();?>