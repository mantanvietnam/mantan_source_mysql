<?php
getHeader();
global $urlThemeActive;
?>
<style type="text/css">
    .events-slide .slick-list .slick-track{
            transform: translate3d(0px, 0px, 0px)!important;
    }
</style>
  <main>
       <!--  Phần Banner 360  -->

    <section class="hero" id="banner360">
      <div class="container-fluid p-0">
          <div class="hero-image">
              <!-- Lớp phủ phía trước iframe -->
              <div class="iframe-cover" id="iframeCover"></div>
  
              <div class="iframe-360">
                  <iframe
                      style="width: 100%; height: calc(100vh - 80px);"
                      src="<?php echo $setting['link_image360'] ?>"
                      frameborder="0"
                  ></iframe>
              </div>
  
              <!-- Nội dung hero overlay -->
              <div class="hero-overlay" id="heroOverlay">
                  <a href="<?php echo $setting['link_image360'] ?>"  class="btn btn-primary" id="view360Btn">Xem toàn cảnh 360</a>
              </div>
          </div>
      </div>
    </section>


     <!-- Destinations Section -->
    <section class="destinations py-5 mx-5">
        <div class="container-fluid">
            <h2 class=" mb-4"><?php echo @$setting['title2'] ?></h2>
            <p class="text-muted mb-5"><?php echo @$setting['text_2'] ?></p>

            <div class="row g-4">
                <?php 
                    if(!empty($listPlace)){
                        foreach($listPlace as $key => $item){
                            if ($key % 2 == 0) {
                                echo ' <div class="row align-items-center mb-4 ma4">
                    <div class="col-md-7 my-4">
                        <img src="'.$item->image.'" class="img-fluid rounded img-desti" alt="'.$item->name.'">
                    </div>
                    <div class="col-md-5 text-end text-representative">
                      <div class="infomation">
                        <p class="text-primary">'.$item->name.'</p>
                        <h2 class="address">'.$item->address.'</h2>
                        <h3 class="text-muted">'.$item->introductory.'</h3>
                      </div>
                        <a href="chi_tiet_danh_lam/'.$item->urlSlug.'.html" class=" btn-edit mb-4">Xem chi tiết<i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </div>';

                            }else{
                                echo '<div class="row align-items-center mb-4">
                    <div class="col-md-5 text-representative">
                      <div class="infomation">
                        <p class="text-primary">'.$item->name.'</p>
                        <h2 class="address">'.$item->address.'</h2>
                        <h3 class="text-muted">'.$item->introductory.'</h3>
                      </div>
                        <a href="chi_tiet_danh_lam/'.$item->urlSlug.'.html" class=" btn-edit mb-4">Xem chi tiết<i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                    <div class="col-md-7">
                        <img src="'.$item->image.'" class="img-fluid rounded img-desti" alt="'.$item->name.'">
                    </div>
                    
                </div>';
                            }

                        }
                    }

                 ?>
               
            </div>
        </div>
    </section>

    <section class="news container py-5">
      <div class="news-text d-flex">
          <p class="left-text col-md-7"><?php echo @$setting['text_3'] ?></p>
          <h2 class="text-end col-md-5 mb-4 right-text"><?php echo @$setting['title3'] ?></h2>
      </div>
      <div class="swiper-container">
          <div class="swiper-wrapper d-flex">
            <?php if(!empty($listDataPost)){
                        foreach($listDataPost as $key => $item){
                            echo'<div class="swiper-slide col-lg-4">
                                  <div class="card bg-dark text-white card-news card-hover" >
                                       <a  href="/'.$item->slug.'.html"><img src="'.@$item->image.'" class="card-img" alt="...">
                                      <div class="card-img-overlay d-flex flex-column justify-content-end overlay-content">
                                          <h5 class="card-title">'.@$item->title.'</h5>
                                          <p class="card-text">Ngày '.date('d/m/Y',@$item->time).'</p>
                                          <div class="card-content hidden">
                                              <a  href="/'.$item->slug.'.html" class="btn mt-2 but-hou">Xem chi tiết</a>
                                          </div>
                                      </div>
                                      </a>  
                                  </div>
                              </div>';
                          }
                      }
                      ?>
              
          </div>
          <div class="swiper-button-prev"></div>
          <div class="swiper-button-next"></div>
      </div>
  </section>
   <!-- Slider Section -->
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
        <?php if(!empty($listDataEvent)) {
          foreach ($listDataEvent as $keyEvent => $valueEvent) {

           ?>
           <div class="slide-event-home">
            <div class="item-event-home absolute">
              <div class="box-img-item-eh">
                <img src="<?php echo $valueEvent->image; ?>" alt="">
              </div>
            </div>
            <div class="info-event-home">
              <div class="name-event-home">
                <p><?php echo $valueEvent['name']; ?> </p>
              </div>
              <div class="description-event-home">
                <p class="title-des">Giới thiệu</p>
                <p class="text-des"><?php echo $valueEvent->introductory; ?> </p>
              </div>
              <div class="local-event-home">
                <ul>
                  <li>
                    <i class="fa-solid fa-location-dot"></i>
                    <p><?php echo $valueEvent->address; ?></p>
                  </li>
                  <li>
                    <i class="fa-solid fa-calendar-days"></i>
                    <p><?php echo date("d/m/Y",$valueEvent->datestart); ?></p>
                  </li>
                  <li>
                    <i class="fa-solid fa-phone"></i>
                    <p><?php echo $valueEvent->phone; ?></p>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        <?php } }else { ?>
          <div class="slide-event-home">
            <div class="item-event-home absolute">
              <div class="box-img-item-eh">
                <img src="https://laocai360.vingg.vn/upload/admin/files/dt1%20(2).png" alt="">
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
    <a href="/su_kien">
      <button class="view_moreEvent">
        Xem thêm <i class="fa-solid fa-angles-right"></i>
      </button>
    </a>
  </section> 

   <section class="map">
        <div class="container-fluid">
            <!-- Phần tiêu đề -->
            <div class="text-map">
                <h1><?php echo @$setting['title4'] ?></h1>
                <h5><?php echo @$setting['text_4'] ?></h5>
            </div>
    
            <!-- Phần bản đồ và tùy chọn điểm đến -->
            <div class="img-map">
                <?php //include("findnear_openstreet_map.php"); ?>
               <?php include("findnear_openstreet_map.php"); ?>
                </div>
        </div>
    </section>
      <section class="vietnam-360">
        <div class="container">
            <h2><?php echo @$setting['title5'] ?></h2>
            <p><?php echo @$setting['text_5'] ?></p>
            <div class="slide" style="margin: 25px 0;">
                <!-- Slide 1 -->
                <?php 
                  if(!empty($listDataImage)){
                    foreach($listDataImage as $key => $item){
                      echo '<div class="slide col-lg-3">
                      <a href="'.$item->link.'" target="_bank">
                    <img src="'.$item->image.'" alt="'.$item->name.'">
                    <div class="arrow-overlay">
                        <i class="fa-solid fa-arrow-right fa-rotate-by fa-xl" style="--fa-rotate-angle: 45deg;"></i>
                    </div>
                    </a>
                </div>';
                    }
                  }
                 ?>
                
                
            </div>
        </div>
    </section>
    
  </main>

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
  $('.in-box-event-home_1').slick({

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
  var month = $('.slick-center').attr('data-month');

  console.log(month); 
  /*if(e = 1){
    if(month==12){
        month = 1
    }else{
        month = Number(month) + 1;
    }
    
  }else{
     if(month==1){
        month = 12
    }else{
        mmonth = Number(month) - 1;
    }
    }
  */
    
  $.ajax({
      type: "GET",
      url: '/apis/ajax_event',
      data:{ month:month }
    }).done(function( msg ) {
        console.log(msg); 
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


$(document).ready(function () {
    $(".rotate").click(function () {
        $(this).toggleClass("right");
        $('.box-menu-map').slideToggle();
        console.log('a')
    })
  });

</script> 
<?php
getFooter();?>
