<?php
getHeader();
global $urlThemeActive;
?>
    <script src="<?php echo $urlThemeActive ?>css/style2.css"></script>


    <main>
        <section id="banner-home-360" class="page-banner">
            <div class="box-iframe">
                <iframe src="<?php echo @$setting['link_image360'];?>"
                        frameborder="0"></iframe>
            </div>
        </section>

        <section id="particle-js">
            <div class="relative">
                <!-- particles.js container -->
                <div id="particles-js"></div>
               
                <div class="welcome-tayho-360 absolute">
                    <div class="text-welcome">
                        <p class="in-text-welcome-1"><?php echo @$setting['welcome1'];?></p>
                        <p class="in-text-welcome-2"><?php echo @$setting['welcome2'];?></p>
                        <div class="article-space"></div>
                    </div>
                    <div class="list-tabs list-tabs-none">
                        <?php 
                $destination = destination();
                
            ?>
                        <div class="lshowcase-logos">
                            <div class="lshowcase-flex">
                                <div class="box-sum">
                                    <a href="<?php echo @$destination[1]['urlSlug'] ?>">
                                        <div class="lshowcase-thumb lshowcase-box-10">
                                            <div class="lshowcase-wrap-responsive">
                                                <div class="lshowcase-boxInner">
                                                    <img src="<?php echo $destination[1]['image']?>"
                                                        class="lshowcase-thumb" alt="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-tabs">
                                            <p><?php echo $destination[1]['name']?></p>
                                        </div>
                                    </a>
                                </div>
                                <div class="box-sum">
                                    <a href="<?php echo @$destination[2]['urlSlug'] ?>">
                                        <div class="lshowcase-thumb lshowcase-box-10">
                                            <div class="lshowcase-wrap-responsive">
                                                <div class="lshowcase-boxInner">
                                                    <img src="<?php echo $destination[2]['image']?>"
                                                        class="lshowcase-thumb" alt="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-tabs">
                                            <p><?php echo $destination[2]['name']?></p>
                                        </div>
                                    </a>
                                </div>
                                <div class="box-sum">
                                    <a href="<?php echo @$destination[3]['urlSlug'] ?>">
                                        <div class="lshowcase-thumb lshowcase-box-10">
                                            <div class="lshowcase-wrap-responsive">
                                                <div class="lshowcase-boxInner">
                                                    <img src="<?php echo $destination[3]['image']?>"
                                                        class="lshowcase-thumb" alt="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-tabs">
                                            <p><?php echo $destination[3]['name']?></p>
                                        </div>
                                    </a>
                                </div>
                                <div class="box-sum">
                                    <a href="<?php echo @$destination[4]['urlSlug'] ?>">
                                        <div class="lshowcase-thumb lshowcase-box-10">
                                            <div class="lshowcase-wrap-responsive">
                                                <div class="lshowcase-boxInner">
                                                    <img src="<?php echo $destination[4]['image']?>"
                                                        class="lshowcase-thumb"
                                                        alt="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-tabs">
                                            <p><?php echo $destination[4]['name']?></p>
                                        </div>
                                    </a>
                                </div>
                                <div class="box-sum">
                                    <a href="<?php echo @$destination[5]['urlSlug'] ?>">
                                        <div class="lshowcase-thumb lshowcase-box-10">
                                            <div class="lshowcase-wrap-responsive">
                                                <div class="lshowcase-boxInner">
                                                    <img src="<?php echo $destination[5]['image']?>"
                                                        class="lshowcase-thumb" alt="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-tabs">
                                            <p><?php echo $destination[5]['name']?></p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="lshowcase-flex">
                                <div class="box-sum">
                                    <a href="<?php echo @$destination[6]['urlSlug'] ?>">
                                        <div class="lshowcase-thumb lshowcase-box-10">
                                            <div class="lshowcase-wrap-responsive">
                                                <div class="lshowcase-boxInner">
                                                    <img src="<?php echo $destination[6]['image']?>"
                                                        class="lshowcase-thumb"
                                                        alt="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-tabs">
                                            <p><?php echo $destination[6]['name']?></p>
                                        </div>
                                    </a>
                                </div>
                                <div class="box-sum">
                                    <a href="<?php echo @$destination[7]['urlSlug'] ?>">
                                        <div class="lshowcase-thumb lshowcase-box-10">
                                            <div class="lshowcase-wrap-responsive">
                                                <div class="lshowcase-boxInner">
                                                    <img src="<?php echo $destination[7]['image']?>"
                                                        class="lshowcase-thumb"
                                                        alt="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-tabs">
                                            <p><?php echo $destination[7]['name']?></p>
                                        </div>
                                    </a>
                                </div>
                                <div class="box-sum">
                                    <a href="<?php echo @$destination[8]['urlSlug'] ?>">
                                        <div class="lshowcase-thumb lshowcase-box-10">
                                            <div class="lshowcase-wrap-responsive">
                                                <div class="lshowcase-boxInner">
                                                    <img src="<?php echo $destination[8]['image']?>"
                                                        class="lshowcase-thumb" alt="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-tabs">
                                            <p><?php echo $destination[8]['name']?></p>
                                        </div>
                                    </a>
                                </div>
                                <div class="box-sum">
                                    <a href="<?php echo @$destination[9]['urlSlug'] ?>">
                                        <div class="lshowcase-thumb lshowcase-box-10">
                                            <div class="lshowcase-wrap-responsive">
                                                <div class="lshowcase-boxInner">
                                                    <img src="<?php echo $destination[9]['image']?>"
                                                        class="lshowcase-thumb" alt="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-tabs">
                                            <p><?php echo $destination[9]['name']?></p>
                                        </div>
                                    </a>
                                </div>
                               
                            </div>
                        </div>
                    </div>
                    <div class="list-tabs list-tabs-mobile">
                        <div class="lshowcase-logos">
                            <div class="lshowcase-flex">
                                <div class="box-sum">
                                    <a href="<?php echo @$destination[1]['urlSlug'] ?>">
                                        <div class="lshowcase-thumb lshowcase-box-10">
                                            <div class="lshowcase-wrap-responsive">
                                                <div class="lshowcase-boxInner">
                                                    <img src="<?php echo $destination[1]['image']?>"
                                                         class="lshowcase-thumb" alt="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-tabs">
                                            <p><?php echo $destination[1]['name']?></p>
                                        </div>
                                    </a>
                                </div>
                                <div class="box-sum">
                                    <a href="<?php echo @$destination[2]['urlSlug'] ?>">
                                        <div class="lshowcase-thumb lshowcase-box-10">
                                            <div class="lshowcase-wrap-responsive">
                                                <div class="lshowcase-boxInner">
                                                    <img src="<?php echo $destination[2]['image']?>"
                                                         class="lshowcase-thumb" alt="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-tabs">
                                            <p><?php echo $destination[2]['name']?></p>
                                        </div>
                                    </a>
                                </div>
                                <div class="box-sum">
                                    <a href="<?php echo @$destination[3]['urlSlug'] ?>">
                                        <div class="lshowcase-thumb lshowcase-box-10">
                                            <div class="lshowcase-wrap-responsive">
                                                <div class="lshowcase-boxInner">
                                                    <img src="<?php echo $destination[3]['image']?>"
                                                         class="lshowcase-thumb" alt="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-tabs">
                                            <p><?php echo $destination[3]['name']?></p>
                                        </div>
                                    </a>
                                </div>
                                <div class="box-sum">
                                    <a href="<?php echo @$destination[4]['urlSlug'] ?>">
                                        <div class="lshowcase-thumb lshowcase-box-10">
                                            <div class="lshowcase-wrap-responsive">
                                                <div class="lshowcase-boxInner">
                                                    <img src="<?php echo $destination[4]['image']?>"
                                                         class="lshowcase-thumb"
                                                         alt="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-tabs">
                                            <p><?php echo $destination[4]['name']?></p>
                                        </div>
                                    </a>
                                </div>
                                <div class="box-sum">
                                    <a href="<?php echo @$destination[5]['urlSlug'] ?>">
                                        <div class="lshowcase-thumb lshowcase-box-10">
                                            <div class="lshowcase-wrap-responsive">
                                                <div class="lshowcase-boxInner">
                                                    <img src="<?php echo $destination[5]['image']?>"
                                                         class="lshowcase-thumb" alt="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-tabs">
                                            <p><?php echo $destination[5]['name']?></p>
                                        </div>
                                    </a>
                                </div>
                                <div class="box-sum">
                                    <a href="<?php echo @$destination[6]['urlSlug'] ?>">
                                        <div class="lshowcase-thumb lshowcase-box-10">
                                            <div class="lshowcase-wrap-responsive">
                                                <div class="lshowcase-boxInner">
                                                    <img src="<?php echo $destination[6]['image']?>"
                                                         class="lshowcase-thumb"
                                                         alt="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-tabs">
                                            <p><?php echo $destination[6]['name']?></p>
                                        </div>
                                    </a>
                                </div>
                                <div class="box-sum">
                                    <a href="<?php echo @$destination[7]['urlSlug'] ?>">
                                        <div class="lshowcase-thumb lshowcase-box-10">
                                            <div class="lshowcase-wrap-responsive">
                                                <div class="lshowcase-boxInner">
                                                    <img src="<?php echo $destination[7]['image']?>"
                                                         class="lshowcase-thumb"
                                                         alt="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-tabs">
                                            <p><?php echo $destination[7]['name']?></p>
                                        </div>
                                    </a>
                                </div>
                                <div class="box-sum">
                                    <a href="<?php echo @$destination[8]['urlSlug'] ?>">
                                        <div class="lshowcase-thumb lshowcase-box-10">
                                            <div class="lshowcase-wrap-responsive">
                                                <div class="lshowcase-boxInner">
                                                    <img src="<?php echo $destination[8]['image']?>"
                                                         class="lshowcase-thumb" alt="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-tabs">
                                            <p><?php echo $destination[8]['name']?></p>
                                        </div>
                                    </a>
                                </div>
                                <div class="box-sum">
                                    <a href="<?php echo @$destination[9]['urlSlug'] ?>">
                                        <div class="lshowcase-thumb lshowcase-box-10">
                                            <div class="lshowcase-wrap-responsive">
                                                <div class="lshowcase-boxInner">
                                                    <img src="<?php echo $destination[9]['image']?>"
                                                         class="lshowcase-thumb" alt="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-tabs">
                                            <p><?php echo $destination[9]['name']?></p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="event-home" style="position: relative;">
            <div class="event-home-title">
                <p>Sự kiện</p>
                <div class="article-space"></div>
            </div>
            <div class="box-event-home">
                <div class="relative">
                    <?php include('mon.php') ?>

                    </div>
                    <div class="in-box-event-home box-month-event">
                        <?php if(!empty($tmpVariable['listDataEvent'])) {
                            foreach ($tmpVariable['listDataEvent'] as $keyEvent => $valueEvent) {

                         ?>
                        <div class="slide-event-home">
                            <div class="item-event-home absolute">
                                <div class="box-img-item-eh">
                                    <img src="<?php echo $valueEvent['image']; ?>" alt="">
                                </div>
                            </div>
                            <div class="info-event-home">
                                <div class="name-event-home">
                                    <p><?php echo $valueEvent['name']; ?> </p>
                                </div>
                                <div class="description-event-home">
                                    <p class="title-des">Giới thiệu</p>
                                    <p class="text-des"><?php echo $valueEvent['introductory']; ?> </p>
                                </div>
                                <div class="local-event-home">
                                    <ul>
                                        <li>
                                            <i class="fa-solid fa-location-dot"></i>
                                            <p><?php echo $valueEvent['address']; ?></p>
                                        </li>
                                        <li>
                                            <i class="fa-solid fa-calendar-days"></i>
                                            <p><?php echo date("d/m/Y",$valueEvent['datestart']); ?></p>
                                        </li>
                                        <li>
                                            <i class="fa-solid fa-phone"></i>
                                            <p><?php echo $valueEvent['phone']; ?></p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <?php } }else { ?>
                           <div class="slide-event-home">
                            <div class="item-event-home absolute">
                                <div class="box-img-item-eh">
                                    <img src="<?= $urlThemeActive ?>/img/thaianhimg/eventhome.png" alt="">
                                </div>
                            </div>
                            <div class="info-event-home">
                                <div class="name-event-home">
                                    <p>Chưa có sự kiện nào đang diễn ra.</p>
                                </div>
                            </div>
                        </div>
                        <?php
                        } ?>
                    </div>

                </div>
            </div>
            <a href="/su_kien">
                <button class="view_moreEvent">
                    Xem thêm <i class="fa-solid fa-angles-right"></i>
                </button>
            </a>
        </section> 



        <section id="travel-guide">
            <div class="event-home-title">
                <p>Cẩm nang du lịch</p>
                <div class="article-space"></div>
            </div>
            <div class="box-guide">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="box-service">
                                <div class="box-image">
                                    <img src="<?php echo @$setting['image_travel1'];?>" width="100%" height="auto"
                                         alt="">
                                </div>
                                <div class="over_black"></div>
                                <div class="title-service-details">
                                    <h4 class="flower_line mb-20"><?php echo @$setting['title_travel1'];?></h4>
                                </div>
                                <div class="overplay_content">
                                    <div class="overplay_text">
                                        <h4><?php echo @$setting['title_travel1'];?></h4>
                                        <div class="btn_trang text_center absolute">
                                            <a href="<?php echo @$setting['link_travel1'];?>">Xem tất cả <i
                                                    class="fa-solid fa-angle-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="box-service">
                                <div class="box-image">
                                    <img src="<?php echo @$setting['image_travel2'];?>" width="100%" height="auto"
                                         alt="">
                                </div>
                                <div class="over_black"></div>
                                <div class="title-service-details">
                                    <h4 class="flower_line mb-20"><?php echo @$setting['title_travel2'];?></h4>
                                </div>
                                <div class="overplay_content">
                                    <div class="overplay_text">
                                        <h4><?php echo @$setting['title_travel2'];?></h4>
                                        <div class="btn_trang text_center absolute">
                                            <a href="<?php echo @$setting['link_travel2'];?>">Xem tất cả <i
                                                    class="fa-solid fa-angle-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="box-service">
                                <div class="box-image">
                                    <img src="<?php echo @$setting['image_travel3'];?>" width="100%" height="auto"
                                         alt="">
                                </div>
                                <div class="over_black"></div>
                                <div class="title-service-details">
                                    <h4 class="flower_line mb-20"><?php echo @$setting['title_travel3'];?></h4>
                                </div>
                                <div class="overplay_content">
                                    <div class="overplay_text">
                                        <h4><?php echo @$setting['title_travel3'];?></h4>
                                        <div class="btn_trang text_center absolute">
                                            <a href="<?php echo @$setting['link_travel3'];?>">Xem tất cả <i
                                                    class="fa-solid fa-angle-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="box-service">
                                <div class="box-image">
                                    <img src="<?php echo @$setting['image_travel4'];?>" width="100%" height="auto"
                                         alt="">
                                </div>
                                <div class="over_black"></div>
                                <div class="title-service-details">
                                    <h4 class="flower_line mb-20"><?php echo @$setting['title_travel4'];?></h4>
                                </div>
                                <div class="overplay_content">
                                    <div class="overplay_text">
                                        <h4><?php echo @$setting['title_travel4'];?></h4>
                                        <div class="btn_trang text_center absolute">
                                            <a href="<?php echo @$setting['link_travel4'];?>">Xem tất cả <i
                                                    class="fa-solid fa-angle-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="news-home">
            <div class="event-home-title">
                <p>Tin tức nổi bật</p>
                <div class="article-space"></div>
            </div>
            <div class="all-news-home">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-7">

                            <div class="tab-content" id="myTabContent">
                                 <?php if(!empty($tmpVariable['listDataPost'])) {
                            foreach ($tmpVariable['listDataPost'] as $keyPost => $valuePost) {
                               $keyPost = $keyPost+1;

                         ?>
                                <div class="tab-pane fade <?php echo(@$keyPost==1)? 'show active': ''; ?> " id="newsHome_<?php echo @$keyPost;?>" role="tabpanel" aria-labelledby="newsHometab_<?php echo @$keyPost;?>">
                                    <div class="box-image-news">
                                        <a href="/<?php echo @$valuePost['slug'];?>.html"><img src="<?php echo @$valuePost['image'];?>" alt=""></a>
                                    </div>
                                </div>
                              <?php }} ?> 
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="box-news">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                   <?php if(!empty($tmpVariable['listDataPost'])) {
                            foreach ($tmpVariable['listDataPost'] as $keyPosts => $valuePost) {
                               $keyPostss = $keyPosts+1;

                         ?>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link <?php echo(@$keyPostss==1)? 'active':' '; ?> " id="newsHometab_<?php echo @$keyPostss;?>" data-bs-toggle="tab"
                                                data-bs-target="#newsHome_<?php echo @$keyPostss;?>" type="button" role="tab"
                                                aria-controls="newsHome_<?php echo @$keyPostss;?>" aria-selected=" <?php echo(@$keyPostss==1)? 'true':'false'; ?>" tabindex="<?php echo(@$keyPostss==1)? '':'-1'; ?>">
                                            <ul>
                                                <li class="list-styled"><?php echo @$valuePost['title'];?>
                                                </li>
                                            </ul>
                                        </button>
                                    </li>
                                    <?php }} ?> 
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div id="tour-travel-home">
            <div class="event-home-title">
                <p>Tour du lịch</p>
                <div class="article-space"></div>
            </div>
            <div class="container">
                <div class="box-slide-tth row">
                      <?php if(!empty($tmpVariable['listDataTour'])) {
                            foreach ($tmpVariable['listDataTour'] as $keyTour => $valueTour) {
                               $keyPostss = $keyPosts+1;

                         ?>
                    <div class="col-lg-3 pd-tth">
                        <div class="box-tth">
                            <a href="/chi_tiet_tour/<?php echo @$valueTour['urlSlug'];?>.html">
                                <div class="box-image">
                                    <img src="<?php echo @$valueTour['image'];?>" alt="">
                                </div>
                                <div class="box-info">
                                    <div class="type-tour">
                                        <p><?php echo @$valueTour['timetravel'];?></p>
                                    </div> 
                                    <div class="title-tour">
                                        <p><?php echo @$valueTour['name'];?></p>
                                    </div>
                                     <div class="price-tour">
                                        <span><?php echo number_format(@$valueTour['price']);?> VNĐ</span>
                                    </div> 
                                </div>
                            </a>
                        </div>
                    </div>

                     <?php }} ?> 
                  
                </div>
            </div>
        </div>

        <div id="map-home">
            <div class="event-home-title">
                <p>Bản đồ 360</p>
                <div class="article-space"></div>
            </div>
           
            <?php 
                //include("findnear_google_map.php"); 
                include("findnear_openstreet_map.php"); 
            ?>
        </div>

        <div id="viet-nam-360">
            <div class="event-home-title">
                <p>Việt Nam 360</p>
                <div class="article-space"></div>
            </div>
            <div class="">
                <p class="vn360-description">Hãy khám phá những điểm đến tuyệt vời không thể bỏ lỡ ở Việt Nam</p>
            </div>
            <div class="container">
                <div class="row">
                    <div class="flex slide-vn360">
                        <?php if(!empty($tmpVariable['listDataImage'])) {
                            foreach ($tmpVariable['listDataImage'] as $keyImage => $valueImage) {
                          

                         ?>
                        <div class="box-image-vn360">
                           <a href="<?php echo @$valueImage['image360'];?>" target="_blank"> <img src="<?php echo @$valueImage['image'];?>" alt=""></a>
                        </div>

                    <?php }} ?>
                        
                    </div>
                </div>
            </div>
        </div>


    </main>
    <style type="text/css">
        #mapid {
            width: 100%;
            height: 500px;
        }
    </style>
    <script src="<?php echo $urlThemeActive ?>js/js.js"></script>
    <script src="<?php echo $urlThemeActive ?>js/particles.min.js"></script>
    <script src="<?php echo $urlThemeActive ?>js/particle.js"></script>
 <script type="text/javascript">
    // load event
function loadEvent(e) {
  var month = $(e).attr('data-month');
  console.log(month);
  //var url = 'su_kien?month='+month;
  $.ajax({
      type: "GET",
      url: '/apis/ajax_event',
      data:{ month:month }
    }).done(function( msg ) {
        console.log(msg);
      /*var msg = JSON.parse(msg);
      console.log(msg);*/
      $('.in-box-event-home').html(msg.text);
    });
     eventhome();
    
}

function eventhome(){
  $('.in-box-event-home').slick({

    dots: false,

    infinite: true,

    arrows: true,

    speed: 500,

    fade: true,

    cssEase: 'linear',

    prevArrow: `<button type='button' class='slick-prev pull-left'><i class="fa-solid fa-angle-left"></i></button>`,

    nextArrow: `<button type='button' class='slick-next pull-right'><i class="fa-solid fa-angle-right"></i></button>`

  });
}

function loadEventNextPrev(e) {
  var month = $('.slick-current').attr('data-month');

  if(e = 1){
    month = Number(month) + 1;
  }else{
     month = Number(month) - 1;
  }
  console.log(month);   
  $.ajax({
      type: "GET",
      url: '/apis/ajax_event',
      data:{ month:month }
    }).done(function( msg ) {
     //document.getElementById("event-month-s").remove();
      $('.in-box-event-home').html(msg.text);
    });
     eventhome();

}

// menu scroll 
$(document).ready(function() {
    const button = document.querySelector(".mon-pull-right");
    button.setAttribute("onclick", "loadEventNextPrev(1)");

   const butt = document.querySelector(".mon-pull-left");
   butt.setAttribute("onclick", "loadEventNextPrev(2)");
});

</script> 

<?php
getFooter();?>
