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
    <div class="title-section">
        <h1>WARM VIDEOS</h1>
        <div class="title-divide-section"></div>
      </div>
      <div class="banner-warm-video">
        <div class="container">
            <div class="setting-banner-warm-video">
                <div id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="id-banner-warm-one-one" role="tabpanel"
                        aria-labelledby="banner-warm-one-one-tab">
    
                        <div class="swiper galleryTop">
    
                          <div class="swiper-wrapper">
                             <?php
                                if(!empty($data->imageinfo)){
                                 foreach($data->imageinfo as $key => $value){ ?>
                            <div class="swiper-slide" id="swiper-<?php echo $value->id; ?>">
    
                              <div class="row">
                                <div class="col-4 text-banner-warm-video">
                                    <h2>PROJECT <br>videos</h2>
                                </div>
                                <div class="col-8 image-banner-warm-video-one">
                                  <iframe width="1257" height="707" src="https://www.youtube.com/embed/<?php echo $value->link; ?>" title="Reducing inequality, a question of survival" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                                </div>
                                  
                              </div>
                            </div>
                        <?php }} ?>
                            
                            <!-- <div class="swiper-slide">
                                <img src="https://swiperjs.com/demos/images/nature-10.jpg" />
                            </div>
                              <div class="swiper-slide">
                                  <img src="https://swiperjs.com/demos/images/nature-10.jpg" />
                              </div>
                            <div class="swiper-slide">
                              <img src="https://swiperjs.com/demos/images/nature-10.jpg" />
                          </div>
                            <div class="swiper-slide">
                              <img src="https://swiperjs.com/demos/images/nature-10.jpg" />
                          </div>
                            <div class="swiper-slide">
                              <img src="https://swiperjs.com/demos/images/nature-10.jpg" />
                          </div>
                            <div class="swiper-slide">
                              <img src="https://swiperjs.com/demos/images/nature-10.jpg" />
                          </div>
                            <div class="swiper-slide">
                              <img src="https://swiperjs.com/demos/images/nature-10.jpg" />
                          </div>
                            <div class="swiper-slide">
                                <img src="https://swiperjs.com/demos/images/nature-10.jpg" />
                            </div> -->
                          </div>
                        </div>
                        </div>
                    </div>
            </div>
    
        </div>
      </div>
    
      <div class="nav-tab-warm-video">
        <div class="container">
            <div class="setting-nav-tab-warm-video">
                <div class="setting-column-warm-video">
                    <div class="btn-tab-warm-video nav flex-column nav-pills btn-tab-nopadding" id="v-pills-tab" role="tablist"
                        aria-orientation="vertical">
    
                        <?php foreach($listData as $key => $item){ ?>
                            <a href="/projectVideo/<?php echo $item->slug.'.html'; ?>" class=""><?php echo $item->title; ?></a>
                        <?php } ?>
                    </div>               
                    <div class="list-img-warm-video tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="id-banner-warm-one-one test1" role="tabpanel"
                            aria-labelledby="banner-warm-one-one-tab">
                            <div class="swiper galleryThumbs">
    
                              <div class="swiper-wrapper">
                                
                                 <?php
                                if(!empty($data->imageinfo)){
                                 foreach($data->imageinfo as $key => $value){ ?>
                                <div class="swiper-slide">
                                  <a class="link-image-swiper" href="#swiper-<?php echo $value->id; ?>">
                                    <div class="setting-image-galleryThumbs">
                                      <img src="<?php echo $value->image; ?>" />
                                      <div class="icon-image-galleryThums">
                                        <i class="fa-solid fa-circle-play"></i>
                                      </div>  
                                    </div>
    
                                    <p><?php echo $value->title; ?></p>
                                    
                                  </a>
                                </div>
                                <?php }} ?>
                                
                              </div>
                            </div>
                           <!--  <section id="section-pagination-transparent">
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination">
                                      <li class="page-item page-control">
                                        <a class="page-link" href="#" aria-label="Previous">
                                          <span aria-hidden="true"><i class="fa-solid fa-caret-left"></i></span>
                                        </a>
                                      </li>
                                      <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                      <li class="page-item"><a class="page-link" href="#">2</a></li>
                                      <li class="page-item"><a class="page-link" href="#">3</a></li>
                                      <li class="page-item page-control">
                                        <a class="page-link" href="#" aria-label="Next">
                                          <span aria-hidden="true"><i class="fa-solid fa-caret-right"></i></span>
                                        </a>
                                      </li>
                                    </ul>
                                </nav>
                            </section> -->
                        </div>
    
                    </div>                  
                </div>
    
            </div>
        </div>
      </div>
  </main>

<?php getFooter();?>