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
                  <h1 class="hero-title"><?php echo @$setting['title1'] ?></h1>
                  <p class="hero-description"><?php echo @$setting['text_1'] ?></p>
                  <a href="<?php echo $setting['link_image360'] ?>" target="_blank" class="btn btn-primary" id="view360Btn">Xem toàn cảnh 360</a>
              </div>
          </div>
      </div>
    </section>


     <!-- Destinations Section -->
    <section class="destinations py-5 mx-5">
        <div class="container-fluid">
            <h2 class=" mb-4">Điểm đến Văn hóa - Du lịch tiêu biểu</h2>
            <p class="text-muted mb-5">Khám phá Điểm đến Văn hóa - Du lịch tiêu biểu huyện Mai Châu</p>

            <div class="row g-4">
                <div class="row align-items-center mb-4">
                    <div class="col-md-7">
                        <img src="./img/dt1 (2).png" class="img-fluid rounded img-desti" alt="Đền Mẫu">
                    </div>
                    <div class="col-md-5 text-end text-representative">
                      <div class="infomation">
                        <p class="text-primary">Đền Mẫu</p>
                        <h2 class="address">Đường Bãi Sậy, thành phố Hưng Yên</h2>
                        <h3 class="text-muted">Nằm ở đường Bãi Sậy, thành phố Hưng Yên, đền Mẫu tọa lạc bên hồ bán nguyệt chứa đựng những giá trị văn hóa vật thể và phi vật thể có giá trị độc đáo của phố Hiến.</h3>
                      </div>
                        <a href="#" class=" btn-edit mb-4">Xem chi tiết<i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </div>

                <div class="row align-items-center mb-4">
                    <div class="col-md-5 text-representative">
                      <div class="infomation">
                        <p class="text-primary">Đền Mẫu</p>
                        <h2 class="address">Đường Bãi Sậy, thành phố Hưng Yên</h2>
                        <h3 class="text-muted">Nằm ở đường Bãi Sậy, thành phố Hưng Yên, đền Mẫu tọa lạc bên hồ bán nguyệt chứa đựng những giá trị văn hóa vật thể và phi vật thể có giá trị độc đáo của phố Hiến.</h3>
                      </div>
                        <a href="#" class=" btn-edit mb-4">Xem chi tiết<i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                    <div class="col-md-7">
                        <img src="./img/dt1 (2).png" class="img-fluid rounded img-desti" alt="Chợ Cốc Lếu">
                    </div>
                    
                </div>

                <div class="row align-items-center mb-4">
                    <div class="col-md-7 text-end">
                        <img src="./img/dt1 (2).png" class="img-fluid rounded img-desti" alt="Công viên Hồ Chí Minh">
                    </div>
                    <div class="col-md-5 text-end text-representative">
                      <div class="infomation">
                        <p class="text-primary">Đền Mẫu</p>
                        <h2 class="address">Đường Bãi Sậy, thành phố Hưng Yên</h2>
                        <h3 class="text-muted">Nằm ở đường Bãi Sậy, thành phố Hưng Yên, đền Mẫu tọa lạc bên hồ bán nguyệt chứa đựng những giá trị văn hóa vật thể và phi vật thể có giá trị độc đáo của phố Hiến.</h3>
                      </div>
                        <a href="#" class=" btn-edit mb-4">Xem chi tiết<i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="news container py-5">
      <div class="news-text d-flex">
          <p class="left-text col-md-7">We're a community dedicated to empowering lives through fitness. Our experienced trainers, state-of-the-art facilities, and diverse range of classes create an environment</p>
          <h2 class="text-end col-md-5 mb-4 right-text">Tin tức mới nhất</h2>
      </div>
      <div class="swiper-container">
          <div class="swiper-wrapper d-flex">
              <div class="swiper-slide col-lg-4">
                  <div class="card bg-dark text-white card-news card-hover" >
                      <img src="./img/dt1 (2).png" class="card-img" alt="...">
                      <div class="card-img-overlay d-flex flex-column justify-content-end overlay-content">
                          <h5 class="card-title">Lào Cai tổ chức chuỗi sự kiện chào đón năm 2024</h5>
                          <p class="card-text">Ngày 20/09/2024</p>
                          <div class="card-content hidden">
                              <button class="btn mt-2 but-hou">Xem chi tiết</button>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="swiper-slide col-lg-4">
                  <div class="card bg-dark text-white card-news card-hover" >
                      <img src="./img/dt1 (2).png" class="card-img" alt="...">
                      <div class="card-img-overlay d-flex flex-column justify-content-end overlay-content">
                          <h5 class="card-title">Lào Cai: Nhiều sự kiện hấp dẫn du khách</h5>
                          <p class="card-text">Ngày 20/09/2024</p>
                          <div class="card-content hidden">
                              <button class="btn mt-2 but-hou">Xem chi tiết</button>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="swiper-slide col-lg-4">
                  <div class="card bg-dark text-white card-news card-hover" >
                      <img src="./img/dt1 (2).png" class="card-img" alt="...">
                      <div class="card-img-overlay d-flex flex-column justify-content-end overlay-content">
                          <h5 class="card-title">10 sự kiện tiêu biểu Lào Cai năm 2022</h5>
                          <p class="card-text">Ngày 20/09/2024</p>
                          <div class="card-content hidden">
                              <button class="btn mt-2 but-hou">Xem chi tiết</button>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="swiper-slide">
                  <div class="card bg-dark text-white card-news card-hover" >
                      <img src="./img/dt1 (2).png" class="card-img" alt="...">
                      <div class="card-img-overlay d-flex flex-column justify-content-end overlay-content">
                          <h5 class="card-title">10 sự kiện tiêu biểu Lào Cai năm 2022</h5>
                          <p class="card-text">Ngày 20/09/2024</p>
                          <div class="card-content hidden">
                              <button class="btn mt-2 but-hou">Xem chi tiết</button>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="swiper-slide">
                  <div class="card bg-dark text-white card-news card-hover">
                      <img src="./img/dt1 (2).png" class="card-img" alt="...">
                      <div class="card-img-overlay d-flex flex-column justify-content-end overlay-content">
                          <h5 class="card-title">10 sự kiện tiêu biểu Lào Cai năm 2022</h5>
                          <p class="card-text">Ngày 20/09/2024</p>
                          <div class="card-content hidden">
                              <button class="btn mt-2 but-hou">Xem chi tiết</button>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="swiper-button-prev"></div>
          <div class="swiper-button-next"></div>
      </div>
  </section>
   <!-- Slider Section -->
   <section id="event-section">
    <div class="event-container container-fluid">
        <p class="event-head">Sự kiện của tháng</p>
        <!-- Month Slider -->
        <div class="event-slider-container">
            <div class="slider-buttons">
                <button class="prev-button"><i class="fa-solid fa-arrow-left"></i></button>
            </div>
            <div class="month-slider">
              <div class="month-item" data-month="1">Tháng 1</div>
                <div class="month-item" data-month="2">Tháng 2</div>
                <div class="month-item" data-month="3">Tháng 3</div>
                <div class="month-item" data-month="4">Tháng 4</div>
                <div class="month-item" data-month="5">Tháng 5</div>
                <div class="month-item" data-month="6">Tháng 6</div>
                <div class="month-item" data-month="7">Tháng 7</div>
                <div class="month-item" data-month="8">Tháng 8</div>
                <div class="month-item" data-month="9">Tháng 9</div>
                <div class="month-item" data-month="10">Tháng 10</div>
                <div class="month-item" data-month="11">Tháng 11</div>
                <div class="month-item" data-month="12">Tháng 12</div>
                
            </div>
            <div class="slider-buttons">
                <button class="next-button"><i class="fa-solid fa-arrow-right"></i></button>
            </div>
        </div>

        <!-- Event Content -->
        <div class="event-content">
            <!-- Tháng 11 -->
            <div class="event-details" data-month="11">
              <div class="event-details-flex">
                <img src="./img/dt1 (2).png" alt="Tháng 11">
                <div class="event-text">
                    <h3>LỄ HỘI HOA TAM GIÁC MẠCH</h3>
                    <p class="my-3">Giới Thiệu</p>
                    <p>Lễ hội lớn diễn ra tại Hà Giang trong tháng 11.</p>
                    <ul>
                      <li><i class="fa fa-map-marker my-1"></i> Hà Giang</li>
                      <li><i class="fa fa-calendar my-1"></i> 15/11/2024</li>
                      <li><i class="fa fa-phone my-1"></i> 0123 456 111</li>
                    </ul>
                </div>
              </div>
            </div>

            <!-- Tháng 12 -->
            <div class="event-details" data-month="12" style="display: none;">
              <div class="event-details-flex">
                <img src="./img/dt1 (2).png" alt="Tháng 11">
                <div class="event-text">
                    <h3>LỄ HỘI HOA TAM GIÁC MẠCH</h3>
                    <p class="my-3">Giới Thiệu</p>
                    <p>Lễ hội lớn diễn ra tại Hà Giang trong tháng 11.</p>
                    <ul>
                      <li><i class="fa fa-map-marker my-1"></i> Hà Giang</li>
                      <li><i class="fa fa-calendar my-1"></i> 15/11/2024</li>
                      <li><i class="fa fa-phone my-1"></i> 0123 456 111</li>
                    </ul>
                </div>
              </div>
            </div>

            <!-- Tháng 1 -->
            <div class="event-details" data-month="1" style="display: none;">
              <div class="event-details-flex">
                <img src="./img/dt1 (2).png" alt="Tháng 11">
                <div class="event-text">
                    <h3>LỄ HỘI HOA TAM GIÁC MẠCH</h3>
                    <p class="my-3">Giới Thiệu</p>
                    <p>Lễ hội lớn diễn ra tại Hà Giang trong tháng 11.</p>
                    <ul>
                      <li><i class="fa fa-map-marker my-1"></i> Hà Giang</li>
                      <li><i class="fa fa-calendar my-1"></i> 15/11/2024</li>
                      <li><i class="fa fa-phone my-1"></i> 0123 456 111</li>
                    </ul>
                </div>
              </div>
            </div>

            <!-- Tháng 2 -->
            <div class="event-details" data-month="2" style="display: none;">
              <div class="event-details-flex">
                <img src="./img/dt1 (2).png" alt="Tháng 11">
                <div class="event-text">
                    <h3>LỄ HỘI HOA TAM GIÁC MẠCH</h3>
                    <p class="my-3">Giới Thiệu</p>
                    <p>Lễ hội lớn diễn ra tại Hà Giang trong tháng 11.</p>
                    <ul>
                      <li><i class="fa fa-map-marker my-1"></i> Hà Giang</li>
                      <li><i class="fa fa-calendar my-1"></i> 15/11/2024</li>
                      <li><i class="fa fa-phone my-1"></i> 0123 456 111</li>
                    </ul>
                </div>
              </div>
            </div>

            <div class="event-details" data-month="3" style="display: none;">
              <div class="event-details-flex">
                <img src="./img/dt1 (2).png" alt="Tháng 11">
                <div class="event-text">
                    <h3>LỄ HỘI HOA TAM GIÁC MẠCH</h3>
                    <p class="my-3">Giới Thiệu</p>
                    <p>Lễ hội lớn diễn ra tại Hà Giang trong tháng 11.</p>
                    <ul>
                      <li><i class="fa fa-map-marker my-1"></i> Hà Giang</li>
                      <li><i class="fa fa-calendar my-1"></i> 15/11/2024</li>
                      <li><i class="fa fa-phone my-1"></i> 0123 456 111</li>
                    </ul>
                </div>
              </div>
            </div>

            <div class="event-details" data-month="4" style="display: none;">
              <div class="event-details-flex">
                <img src="./img/dt1 (2).png" alt="Tháng 11">
                <div class="event-text">
                    <h3>LỄ HỘI HOA TAM GIÁC MẠCH</h3>
                    <p class="my-3">Giới Thiệu</p>
                    <p>Lễ hội lớn diễn ra tại Hà Giang trong tháng 11.</p>
                    <ul>
                      <li><i class="fa fa-map-marker my-1"></i> Hà Giang</li>
                      <li><i class="fa fa-calendar my-1"></i> 15/11/2024</li>
                      <li><i class="fa fa-phone my-1"></i> 0123 456 111</li>
                    </ul>
                </div>
              </div>
            </div>

            <div class="event-details" data-month="5" style="display: none;">
              <div class="event-details-flex">
                <img src="./img/dt1 (2).png" alt="Tháng 11">
                <div class="event-text">
                    <h3>LỄ HỘI HOA TAM GIÁC MẠCH</h3>
                    <p class="my-3">Giới Thiệu</p>
                    <p>Lễ hội lớn diễn ra tại Hà Giang trong tháng 11.</p>
                    <ul>
                      <li><i class="fa fa-map-marker my-1"></i> Hà Giang</li>
                      <li><i class="fa fa-calendar my-1"></i> 15/11/2024</li>
                      <li><i class="fa fa-phone my-1"></i> 0123 456 111</li>
                    </ul>
                </div>
              </div>
            </div>

            <div class="event-details" data-month="6" style="display: none;">
              <div class="event-details-flex">
                <img src="./img/dt1 (2).png" alt="Tháng 11">
                <div class="event-text">
                    <h3>LỄ HỘI HOA TAM GIÁC MẠCH</h3>
                    <p class="my-3">Giới Thiệu</p>
                    <p>Lễ hội lớn diễn ra tại Hà Giang trong tháng 11.</p>
                    <ul>
                      <li><i class="fa fa-map-marker my-1"></i> Hà Giang</li>
                      <li><i class="fa fa-calendar my-1"></i> 15/11/2024</li>
                      <li><i class="fa fa-phone my-1"></i> 0123 456 111</li>
                    </ul>
                </div>
              </div>
            </div>

            <div class="event-details" data-month="7" style="display: none;">
              <div class="event-details-flex">
                <img src="./img/dt1 (2).png" alt="Tháng 11">
                <div class="event-text">
                    <h3>LỄ HỘI HOA TAM GIÁC MẠCH</h3>
                    <p class="my-3">Giới Thiệu</p>
                    <p>Lễ hội lớn diễn ra tại Hà Giang trong tháng 11.</p>
                    <ul>
                      <li><i class="fa fa-map-marker my-1"></i> Hà Giang</li>
                      <li><i class="fa fa-calendar my-1"></i> 15/11/2024</li>
                      <li><i class="fa fa-phone my-1"></i> 0123 456 111</li>
                    </ul>
                </div>
              </div>
            </div>

            <div class="event-details" data-month="8" style="display: none;">
              <div class="event-details-flex">
                <img src="./img/dt1 (2).png" alt="Tháng 11">
                <div class="event-text">
                    <h3>LỄ HỘI HOA TAM GIÁC MẠCH</h3>
                    <p class="my-3">Giới Thiệu</p>
                    <p>Lễ hội lớn diễn ra tại Hà Giang trong tháng 11.</p>
                    <ul>
                      <li><i class="fa fa-map-marker my-1"></i> Hà Giang</li>
                      <li><i class="fa fa-calendar my-1"></i> 15/11/2024</li>
                      <li><i class="fa fa-phone my-1"></i> 0123 456 111</li>
                    </ul>
                </div>
              </div>
            </div>

            <div class="event-details" data-month="9" style="display: none;">
              <div class="event-details-flex">
                <img src="./img/dt1 (2).png" alt="Tháng 11">
                <div class="event-text">
                    <h3>LỄ HỘI HOA TAM GIÁC MẠCH</h3>
                    <p class="my-3">Giới Thiệu</p>
                    <p>Lễ hội lớn diễn ra tại Hà Giang trong tháng 11.</p>
                    <ul>
                      <li><i class="fa fa-map-marker my-1"></i> Hà Giang</li>
                      <li><i class="fa fa-calendar my-1"></i> 15/11/2024</li>
                      <li><i class="fa fa-phone my-1"></i> 0123 456 111</li>
                    </ul>
                </div>
              </div>
            </div>

            <div class="event-details" data-month="10" style="display: none;">
              <div class="event-details-flex">
                <img src="./img/dt1 (2).png" alt="Tháng 11">
                <div class="event-text">
                    <h3>LỄ HỘI HOA TAM GIÁC MẠCH</h3>
                    <p class="my-3">Giới Thiệu</p>
                    <p>Lễ hội lớn diễn ra tại Hà Giang trong tháng 11.</p>
                    <ul>
                      <li><i class="fa fa-map-marker my-1"></i> Hà Giang</li>
                      <li><i class="fa fa-calendar my-1"></i> 15/11/2024</li>
                      <li><i class="fa fa-phone my-1"></i> 0123 456 111</li>
                    </ul>
                </div>
              </div>
            </div>
        </div>
    </div>
  </section>

    <section
    <section id="map">
        <div class="row">
            <div class="map-title">
                <h2>Bản đồ Số</h2>
                <p>Trải nghiệm tham quan ảo thông minh và tiện ích qua Bản đồ số</p>
            </div>
        </div>
        <div class="row">
            <div class="map-iframe">
               <?php include("findnear_openstreet_map.php"); ?>
            </div>
        </div>

    </section>

    <section id="destinations">
        <div class="destinations-title">
            <h2>VIỆT NAM 360</h2>
            <p>Khám phá những điểm đến tuyệt vời không thể bỏ lỡ ở Việt Nam</p>
        </div>

        <div class="container">
            <div class="destinations-slide">
                
                <?php if(!empty($listDataImage)){ 
                      foreach ($listDataImage as $key => $item) {
               echo' <div class="item-destinations-slide">
                    <a href="'.@$item->image360.'" target="_blank">
                        <img src="'.@$item->image.'" alt="">
                    </a>
                </div>';

                }} ?>
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
