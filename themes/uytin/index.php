<?php 
  getHeader(); 
  global $themeSettings;
?>

<main id="main">
  <!-- ======= KHỐI ĐẦU TRANG ======= -->
  <?php if(!empty($themeSettings['title1'])){ ?>
  <section id="hero" class="hero d-flex align-items-center">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 d-flex flex-column justify-content-center">
          <h1 data-aos="fade-up"><?php echo @$themeSettings['title1']; ?></h1>
          <span data-aos="fade-up" data-aos-delay="400"><?php echo @$themeSettings['content1']; ?></span>
          <div data-aos="fade-up" data-aos-delay="600">
            <div class="text-center text-lg-start">
              <a href="<?php echo @$themeSettings['linkgetstarted']; ?>" class="btn-get-started scrollto d-inline-flex align-items-center justify-content-center align-self-center">
                <span><?php echo @$themeSettings['submit1']; ?></span>
                <i class="bi bi-arrow-right"></i>
              </a>
            </div>
          </div>
        </div>
        <div class="col-lg-6 hero-img" data-aos="zoom-out" data-aos-delay="200">
          <img src="<?php echo @$themeSettings['imagetop1']; ?>" class="img-fluid" alt="">
        </div>
      </div>
    </div>
  </section>
  <?php }?>

  <!-- ======= KHỐI DỊCH VỤ ======= -->
  <?php if(!empty($themeSettings['title5'])){ ?>
  <section id="features" class="features">
    <div class="container" data-aos="fade-up">
      <header class="section-header">
        <p><?php echo @$themeSettings['title5']; ?></p>
        <span><?php echo @$themeSettings['minuscule5']; ?></span>
      </header>

      <div class="row">
        <div class="col-lg-12 mt-12 mt-lg-0">
            <div class="row align-self-center gy-4">
              <?php 
              $delay = 100;
              for($i=1;$i<=9;$i++){
                if(!empty($themeSettings['checkbox'.$i])){
                  $delay += 100;
                  
                  echo '<div class="col-md-4" data-aos="zoom-out" data-aos-delay="'.$delay.'">
                          <div class="feature-box d-flex align-items-center">
                            <i class="bi bi-check"></i>
                            <p class="h3">'.$themeSettings['checkbox'.$i].'</p>
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
  <?php }?>

  <!-- ======= KHỐI CHỨC NĂNG ======= -->
  <?php if(!empty($themeSettings['title8'])){ ?>
  <section id="services" class="services">
    <div class="container" data-aos="fade-up">

      <header class="section-header">
        <p><?php echo @$themeSettings['title8']; ?></p>
        <span><?php echo @$themeSettings['tminuscule8']; ?></span>
      </header>

      <div class="row gy-4">
        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
          <div class="service-box blue">
            <i class="ri-home-gear-line icon"></i>
            <h3><?php echo @$themeSettings['title801']; ?></h3>
            <p><?php echo @$themeSettings['content801']; ?></p>
            <a href="<?php echo @$themeSettings['link801']; ?>" class="read-more"><span>XEM THÊM</span> <i class="bi bi-arrow-right"></i></a>
          </div>
        </div>

        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
          <div class="service-box orange">
            <i class="ri-store-2-line icon"></i>
            <h3><?php echo @$themeSettings['title802']; ?></h3>
            <p><?php echo @$themeSettings['content802']; ?></p>
            <a href="<?php echo @$themeSettings['link802']; ?>" class="read-more"><span>XEM THÊM</span> <i class="bi bi-arrow-right"></i></a>
          </div>
        </div>

        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
          <div class="service-box green">
            <i class="ri-basketball-line icon"></i>
            <h3><?php echo @$themeSettings['title803']; ?></h3>
            <p><?php echo @$themeSettings['content803']; ?></p>
            <a href="<?php echo @$themeSettings['link803']; ?>" class="read-more"><span>XEM THÊM</span> <i class="bi bi-arrow-right"></i></a>
          </div>
        </div>

        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
          <div class="service-box red">
            <i class=" ri-vidicon-2-line icon"></i>
           <h3><?php echo @$themeSettings['title804']; ?></h3>
            <p><?php echo @$themeSettings['content804']; ?></p>
            <a href="<?php echo @$themeSettings['link804']; ?>" class="read-more"><span>XEM THÊM</span> <i class="bi bi-arrow-right"></i></a>
          </div>
        </div>

        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">
          <div class="service-box purple">
            <i class=" ri-home-heart-line icon"></i>
            <h3><?php echo @$themeSettings['title805']; ?></h3>
            <p><?php echo @$themeSettings['content805']; ?></p>
            <a href="<?php echo @$themeSettings['link805']; ?>" class="read-more"><span>XEM THÊM</span> <i class="bi bi-arrow-right"></i></a>
          </div>
        </div>

        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="700">
          <div class="service-box pink">
            <i class="ri-map-pin-line icon"></i>
            <h3><?php echo @$themeSettings['title806']; ?></h3>
            <p><?php echo @$themeSettings['content806']; ?></p>
            <a href="<?php echo @$themeSettings['link806']; ?>" class="read-more"><span>XEM THÊM</span> <i class="bi bi-arrow-right"></i></a>
          </div>
        </div>

      </div>
    </div>
  </section>
  <?php }?>
         
  <!-- ======= KHỐI SLIDE ĐỐI TÁC ======= -->
  <?php if(!empty($themeSettings['titletaitro'])){ ?>
  <secction id="clients" class="clients">
    <div class="container" data-aos="fade-up">
      <header class="section-header">
        <p><?php echo @$themeSettings['titletaitro']; ?></p>
        <span><?php echo @$themeSettings['nametaitro']; ?></span>
      </header>

      <div class="clients-slider swiper-container">
        <div class="swiper-wrapper align-items-center">
            <?php 
            if(!empty($slide_tai_tro)){
              foreach($slide_tai_tro as $key=>$items){ 
                echo '<div class="swiper-slide"><img src="'.$items->image.'" class="img-fluid" alt=""></div>';
              }
            }
            ?>
        </div>
      </div>
    </div>
  </section>
  <?php }?>

  <!-- ======= FEEDBACK OF CUSTOMERS ======= -->
  <?php if(!empty($themeSettings['title11'])){ ?>
  <section id="testimonials" class="testimonials services">
    <div class="container" data-aos="fade-up">

      <header class="section-header">
        <p>  <?php echo @$themeSettings['title11']; ?></p>
        <span>  <?php echo @$themeSettings['tminuscule11']; ?></span>
      </header>

      <div class="testimonials-slider swiper-container" data-aos="fade-up" data-aos-delay="200">
        <div class="swiper-wrapper">
            <?php
              $feedBack = getListFeedback();
              
              if(!empty($feedBack)){
                foreach ($feedBack as $item) { 
                  echo '<div class="swiper-slide">
                          <div class="testimonial-item">
                            <div class="stars">
                              <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                            </div>
                            <p>'.$item->content.'</p>
                            <div class="profile mt-auto">
                              <img src="'.$item->avatar.'" class="testimonial-img" alt="">
                              <p class="h3">'.$item->fullName.'</p>
                              <p class="h4">'.$item->position.'</p>
                            </div>
                          </div>
                        </div>';
                }  
              }
            ?>
        </div>
        <div class="swiper-pagination"></div>
      </div>
    </div>
  </section>
  <?php }?>

  <!-- ======= ĐỘI NGŨ NHÂN SỰ ======= -->
  <?php if(!empty($themeSettings['title12'])){ ?>
  <section id="team" class="team">
    <div class="container" data-aos="fade-up">

      <header class="section-header">
        <p> <?php echo @$themeSettings['title12']; ?></p>
        <span> <?php echo @$themeSettings['tminuscule12']; ?></span>
      </header>

      <div class="row gy-4">
        <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
          <div class="member">
            <div class="member-img">
              <img src="<?php echo @$themeSettings['avatar121']; ?>" class="img-fluid" alt="">
            </div>
            <div class="member-info">
              <p class="h4"><?php echo @$themeSettings['fullName121']; ?><p>
              <span> <?php echo @$themeSettings['positions121']; ?></span>
              <p> <?php echo @$themeSettings['content121']; ?></p>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
           <div class="member">
            <div class="member-img">
              <img src=" <?php echo @$themeSettings['avatar122']; ?>" class="img-fluid" alt="">
            </div>
            <div class="member-info">
              <p class="h4"> <?php echo @$themeSettings['fullName122']; ?><p>
              <span> <?php echo @$themeSettings['positions122']; ?></span>
              <p> <?php echo @$themeSettings['content122']; ?></p>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="300">
          <div class="member">
            <div class="member-img">
              <img src=" <?php echo @$themeSettings['avatar123']; ?>" class="img-fluid" alt="">
            </div>
            <div class="member-info">
              <p class="h4"> <?php echo @$themeSettings['fullName123']; ?><p>
              <span> <?php echo @$themeSettings['positions123']; ?></span>
              <p> <?php echo @$themeSettings['content123']; ?></p>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="400">
           <div class="member">
            <div class="member-img">
              <img src=" <?php echo @$themeSettings['avatar124']; ?>" class="img-fluid" alt="">
            </div>
            <div class="member-info">
              <p class="h4"> <?php echo @$themeSettings['fullName124']; ?><p>
              <span> <?php echo @$themeSettings['positions124']; ?></span>
              <p> <?php echo @$themeSettings['content124']; ?></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <?php }?>

  <!-- ======= TIN TỨC MỚI ======= -->
  <?php if(!empty($themeSettings['title14'])){ ?>
  <section id="news" class="team">
    <div class="container" data-aos="fade-up">
      <div class="container">
        <header class="section-header">
          <p> <?php echo @$themeSettings['title14']; ?></p>
          <span> <?php echo @$themeSettings['tminuscule14']; ?></span>
        </header>

        <div class="testimonials-slider swiper-container" data-aos="fade-up" data-aos-delay="200">
          <div class="swiper-wrapper">
            <?php 
              if(!empty($news)) { 
                foreach ($news as $key => $value) {
                  echo '<div class="swiper-slide">
                          <div class="testimonial-item">
                            <div class="carousel-cell my-carousel-cell-notice" style=" padding: 20px;">
                              <a href="/'.$value->slug.'.html">
                                <img src="'.@$value->image.'" style=" width: 100%;height: 190px;" alt="">
                                <div class="time-notice">'.date('d/m/Y',$value->time).'</div>
                                <p class="title-notice">'.$value->title.'</p>
                              </a>
                            </div>
                          </div>
                        </div>';
                }  
              }
            ?>
          </div>
          <br>
          <div class="swiper-pagination"></div>
        </div>
      </div>
    </div>
  </section>
  <?php }?>
   
</main>

<?php getFooter();?>