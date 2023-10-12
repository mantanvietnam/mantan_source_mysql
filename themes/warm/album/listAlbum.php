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
                      <img src="<?php echo $urlThemeActive;?>/asset/img/WARM-horz-EN-_1_.jpg" alt="">
                  </div>
              </div>
          </div>
      </div>
    </section>

    <div class="title-section">
      <h1>WARM PHOTOS</h1>
      <div class="title-divide-section"></div>
    </div>
    <div class="banner-warm-video">
      <div class="container">
        <div class="setting-banner-warm-video">
          <div class="swiper galleryToptwo">
            <div class="swiper-wrapper">
               
                <?php
                if($data->imageinfo){
                 foreach($data->imageinfo as $key => $value){ ?>
                <div class="swiper-slide" id="swiper-1">

                  <div class="row">
                    <div class="col-4 text-banner-warm-video">
                        <h2><?php echo $category->name; ?></h2>
                        <P><?php echo $value->description; ?></P>
                    </div>
                    <div class="col-8 image-banner-warm-video-one">
                      <img src="<?php echo $value->image; ?>"/>
                    </div>
                      
                  </div>
                </div>
               <?php }} ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="nav-tab-warm-video">
      <div class="container">
          <div class="setting-nav-tab-warm-video">
              <div class="setting-column-warm-video">
                  <div class="btn-tab-warm-video nav flex-column nav-pills">
                    <?php foreach($listData as $key => $item){ ?>
                    <a href="/thematicPhoto/<?php echo $item->slug.'-'.$item->id.'.html'; ?>" class=""><?php echo $item->title; ?></a>
                    <?php } ?>
                  </div>               
                  <div class="list-img-warm-video tab-content" id="v-pills-tabContent">
                      <div class="tab-pane fade show active bac-kan" role="tabpanel" aria-labelledby="bac-kan-tab">
                          <div class="swiper galleryThumbstwo">
                              <div class="swiper-wrapper">
                                <?php
                                if($data->imageinfo){
                                 foreach($data->imageinfo as $key => $value){ ?>
                                <div class="swiper-slide">
                                  <img src="<?php echo $value->image; ?>" />
                                </div>
                                <?php }} ?>
                              </div>
                          </div>
                
                      </div>

                      <!-- pagination -->
                      <section id="section-pagination-transparent">
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
                      </section>
                  </div>                  
              </div>

          </div>
      </div>
    </div>
  </main>
<?php getFooter();?>