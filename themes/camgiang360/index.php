<?php
getHeader();
global $urlThemeActive;
?>
<style type="text/css">
    .events-slide .slick-list .slick-track{
            transform: translate3d(0px, 0px, 0px)!important;
    }
</style>

<script>
    function scrollToContent() {
        document.getElementById("places").scrollIntoView({ behavior: "smooth" });
    }
</script>

  <main>
       <!--  Phần Banner 360  -->
    <section id="banner360">
        <div class="iframe-360">
            <iframe src="<?php echo $setting['link_image360'] ?>" frameborder="0"></iframe>
        </div>
        <!--
        <div class="iframe-360-layer">
            <a href="javascript:void(0)" class="banner360-1 banner360">Xem toàn cảnh 360</a>
            
            <a href="<?php echo $setting['link_image360'] ?>" class="banner360-3 banner360">Truy cập link 360</a>
            
        </div>
        -->
        
        <a href="javascript:void(0)" class="banner360-2 banner360" style="display: none;">Dừng xem 360</a>
        <a href="javascript:void(0)" class="banner360-1 banner360" onclick="scrollToContent();" >Xem tiếp <i class="fa-solid fa-chevron-down"></i></a>
    </section>

    <!--  Phần Places  -->
    <section id="places">
        <div class="row">
            <div class="places-title">
                <h2>Điểm đến Văn hóa - Du lịch tiêu biểu</h2>
                <p>Khám phá Điểm đến Văn hóa - Du lịch tiêu biểu huyện Cẩm Giàng</p>
            </div>
        </div>
        <div class="row">
            <div class="container-fluid">
                <div class="places-slide">
                    <?php if(!empty($listHistorie)){ 
                        foreach ($listHistorie as $key => $value){ ?>
                    <div class="item-slide">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="item-slide-img">
                                    <img src="<?php echo @$value->image ?>" alt="">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="item-slide-content">
                                    <h3><?php echo @$value->name ?></h3>
                                    <p><?php echo @$value->address ?></p>
                                    <span><?php echo @$value->introductory ?></span>
                                </div>
                                <div class="item-slide-btn">
                                    <a href="/chi_tiet_di_tich_lich_su/<?php echo @$value->urlSlug ?>.html">Xem chi tiết</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php }} ?>
                   

                </div>
            </div>
        </div>
    </section>

    <!--  Phần Event  -->
    <section id="events">
        <div class="row">
            <div class="events-title">
                <h2><?php echo $setting['title6'] ?></h2>
                <p><?php echo $setting['note6'] ?></p>
            </div>
        </div>

        <div class="container-fluid combo-slide-1">
            <?php include('mon.php') ?>
        </div>

        <div class="container-fluid combo-slide-2">
            <div class="events-slide in-box-event-home">
                <?php if(!empty($tmpVariable['listDataEvent'])) {
                            foreach ($tmpVariable['listDataEvent'] as $keyEvent => $valueEvent) {

                         ?>
                        <div class="item-events-slide">
                            <div class="events-slide-img">
                                <img src="<?php echo $valueEvent->image; ?>" alt="">
                            </div>
                            <div class="events-slide-content">
                                <div class="row">
                                    <div class="col-lg-6 col-md-7 col-sm-12">
                                        <div class="events-slide-content-box">
                                            <div class="events-slide-detail">
                                                <a href="/chi_tiet_su_kien/<?php echo @$valueEvent->urlSlug; ?>.html">
                                                    <h3><?php echo @$valueEvent->name; ?> </h3>
                                                </a>
                                                <p>Ngày<?php echo date("d/m/Y",@$valueEvent->datestart); ?> - Ngày <?php echo date("d/m/Y",@$valueEvent->dateEnd); ?></p>
                                            </div>
                                            <div class="events-slide-btn">
                                                <a href="/chi_tiet_su_kien/<?php echo @$valueEvent->urlSlug; ?>.html">Xem chi tiết</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } }else { ?>
                        <div class="item-events-slide">
                            <div class="events-slide-img">
                                <img src="<?php echo $setting['image_6'] ?>" alt="">
                            </div>
                            <div class="events-slide-content">
                                <div class="row">
                                    <div class="col-lg-6 col-md-7 col-sm-12">
                                        <div class="events-slide-content-box">
                                            <div class="events-slide-detail">
                                                    <h3>Chưa có sự kiện nào đang diễn ra.</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        } ?>
                
            </div>
        </div>

        <!-- <div class="event-bg">
            <img src="../images/bg3.png" alt="">
        </div> -->

    </section>

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
