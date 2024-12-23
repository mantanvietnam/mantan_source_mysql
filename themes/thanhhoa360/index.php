<?php
getHeader();
global $urlThemeActive;
?>
<style type="text/css">
    .events-slide .slick-list .slick-track{
            transform: translate3d(0px, 0px, 0px)!important;
    }
    .location-container {
  display: block;
}
</style>
<iframe class='iframe-import' src="<?php echo $setting['link_image360'] ?>" frameborder="0"></iframe>
      <div class='header-back-container container flex-lg-row'>
        <!-- title -->
         <div class='header-back-title-container'>
          <span><?php echo $setting['welcome1'] ?></span>
          <span><?php echo $setting['welcome2'] ?></span>
         </div>
         <div class='header-group-btn'>
          <span class='header-slogant'><?php echo $setting['content_welcome'] ?></span>
          <div class='btn-header-container flex-lg-row'>
            <div class='header-btn header-btn-1'>
              <span>Xem toàn cảnh 360</span>
              <div>
                <img src="<?= $urlThemeActive ?>images/arr-red.png" alt="">
              </div>
            </div>
            <a class='header-btn header-btn-2' href='<?php echo $setting['link_image360'] ?>'>
              <span>Truy cập link 360</span>
              <div>
                <img src="<?= $urlThemeActive ?>images/arr-white.png" alt="">
              </div>
            </a>
          </div>
         </div>
      </div>
     <div class='btn-stop-watch'>
      <span>Dừng xem 360</span>
     </div>

    </div>
    <!-- điểm đến tiêu biểu -->
    <div class='container-fluid'>
    <?php foreach ($listHistorie as $key => $value): ?>
      <!----lỗi location-container ở js -->
      <div class='location-contain <?php echo $key % 2 === 1 ? "location-container-rev" : ""; ?> flex-lg-row mt-5 mx-5'>
        <div class='location-des-container'>
        <?php if ($key === 0): ?>
          <div class='locations-title mb-5'>
            <span>Điểm đến</span>
            <span>Văn hóa - Du lịch</span>
            <span>Tiêu biểu</span>
          </div>
        <?php endif; ?>
          <div class='location-info'>
            <h2><?php echo @$value->name ?></h2>
            <span class='fw-bold'><?php echo @$value->address ?></span>
            <span><?php echo @$value->introductory ?></span>
            <div href="/chi_tiet_di_tich_lich_su/<?php echo @$value->urlSlug ?>.html" class='btn-more mb-5 mt-2'>
              <span>Xem chi tiết</span>
              <div>
                <img src="<?= $urlThemeActive ?>images/arr-red.png" alt="">
              </div>
            </div>
          </div>
        </div>
        <div class='location-image-container'>
          <img src="<?php echo @$value->image ?>" alt="<?php echo @$value->name ?>">
        </div>
      </div>
    <?php endforeach; ?>

    <!-- tin tức mới nhất -->
    <?php
      $order = array('view' => 'desc');
      $mostViewedPosts = $modelPosts->find()
          ->limit(4)
          ->page(1)
          ->order($order)
          ->all()
          ->toList();
    ?> 
    <div class='container news-container mt-5' id='news'>
      <div class='news-header'>
        <h2>Tin tức mới nhất</h2>
      </div>
      <div class="row align-items-center justify-content-center gap-2">
        <!-- tin tức -->
        <?php if (!empty($mostViewedPosts)): ?>
            <?php foreach ($mostViewedPosts as $post): ?>
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 new-container">
          <div class='new-img'>
            <img src="<?php echo $post['image']; ?>" alt="">
          </div>
          <h3><?php echo $post['title']; ?></h3>
          <span><?php echo $post['description']; ?></span>
        </div>
        <?php endforeach; ?>
        <?php else: ?>
        <div class="col-12">
            <p>Không có tin tức nào để hiển thị.</p>
        </div>
        <?php endif; ?>
      </div>
      
    </div>
    <!-- Sự kiện của tháng -->
    <div class="container mt-5">
      <div class="news-header newmonth-header">
        <h2>Sự kiện của tháng</h2>
        <div class="setmoth">
          <div>
            <button id="btn-back"><img src="<?= $urlThemeActive ?>images/back-btn.png" alt="back"></button>
            <button id="btn-next"><img src="<?= $urlThemeActive ?>images/next-btn.png" alt="next"></button>
          </div>
          <?php include('mon.php'); ?>
        </div>
      </div>
      <?php if(!empty($listDataEvent)) {
        foreach ($listDataEvent as $keyEvent => $valueEvent) {
        ?>
      <div class="best-new-container mt-4">
        <div class="best-new-img">
          <img id="best-new-img" src="<?php echo $valueEvent->image; ?>" alt="best">
        </div>
        <h3 href="/chi_tiet_su_kien/<?php echo @$valueEvent->urlSlug; ?>.html" id="event-title" class="mt-3">
        <?php echo @$valueEvent->name; ?>
        </h3>
        <div class="bestnew-info">
          <div id="event-description" class="bestnew-des">
          <?php echo @$valueEvent->introductory; ?>
          </div>
          <div class="bn-contacts">
            <div class="bn-contact">
              <img href="/chi_tiet_su_kien/<?php echo @$valueEvent->urlSlug; ?>.html" src="<?= $urlThemeActive ?>images/date.png" alt="date">
              <span id="event-date">Ngày<?php echo date("d/m/Y",@$valueEvent->datestart); ?> - Ngày <?php echo date("d/m/Y",@$valueEvent->dateEnd); ?></span>
            </div>
            <div class="bn-contact">
              <img src="<?= $urlThemeActive ?>images/phone.png" alt="phone">
              <span id="event-phone"><?php echo @$valueEvent->phone; ?></span>
            </div>
          </div>
        </div>
      </div>
      <?php } }else { ?>
        <div class="no-events-container text-center mt-5">
            <img src="<?php echo $setting['image_logo'] ?>" alt="No Events" style="max-width: 300px; margin: 0 auto;">
            <h3 class="mt-3">Chưa có sự kiện nào xảy ra trong thời gian này!</h3>
            <p>Hãy quay lại sau để xem thêm thông tin sự kiện.</p>
        </div>
    <?php } ?>
    </div>
    
    <!-- Bản đồ thanh hóa -->
    <?php include("findnear_openstreet_map.php"); ?>

    <!-- slider -->
    <div class='container mt-5'>
  <div class='slider-header mb-5'>
    <h2>Việt Nam 360</h2>
    <span>Khám phá những điểm đến tuyệt vời không thể bỏ lỡ ở Việt Nam</span>
  </div>
  
  <!-- Swiper lớn -->
  <div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff" class="swiper mySwiper2">
    <div class="swiper-wrapper">
      <?php if (!empty($listDataImage)) { 
        foreach ($listDataImage as $key => $item) { ?>
          <div class="swiper-slide">
            <a href="<?php echo @$item->image360; ?>">
              <img src="<?php echo @$item->image; ?>" alt="Vietnam 360 Image <?php echo $key + 1; ?>" />
            </a>
          </div>
      <?php } 
      } else { ?>
        <div class="swiper-slide">
          <p>Không có hình ảnh để hiển thị.</p>
        </div>
      <?php } ?>
    </div>
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
  </div>
  
  <!-- Swiper nhỏ (thumbnail) -->
  <div thumbsSlider="" class="swiper mySwiper mt-4">
    <div class="swiper-wrapper">
      <?php if (!empty($listDataImage)) { 
        foreach ($listDataImage as $key => $item) { ?>
          <div class="swiper-slide">
            <a href="<?php echo @$item->image360; ?>">
              <img src="<?php echo @$item->image360; ?>" alt="Vietnam 360 Thumbnail <?php echo $key + 1; ?>" />
            </a>
          </div>
      <?php } 
      } else { ?>
        <div class="swiper-slide">
          <p>Không có hình ảnh thu nhỏ.</p>
        </div>
      <?php } ?>
    </div>
  </div>
</div>


    <!-- Swiper -->

    <script type="text/javascript">
// Hàm tải sự kiện theo tháng
function loadEvent(month) {
    console.log(`[loadEvent] Bắt đầu tải sự kiện cho tháng: ${month}`);

    $.ajax({
        type: "GET",
        url: '/apis/ajax_event',
        data: { month: month },
        beforeSend: function() {
            console.log(`[loadEvent] Đang gửi yêu cầu AJAX với month=${month}`);
        }
    }).done(function(response) {
        console.log(`[loadEvent] Yêu cầu AJAX thành công. Dữ liệu trả về:`, response);

        // Cập nhật giao diện sự kiện
        $('.in-box-event-home').html(response.text);

        // Khởi chạy lại slick slider sau khi cập nhật sự kiện
        eventhome();
    }).fail(function(error) {
        console.error(`[loadEvent] Yêu cầu AJAX thất bại. Lỗi:`, error);
    }).always(function() {
        console.log(`[loadEvent] Kết thúc quá trình tải sự kiện cho tháng: ${month}`);
    });
}

// Hàm khởi chạy lại slick slider
function eventhome() {
    console.log(`[eventhome] Khởi chạy slick slider.`);

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

    console.log(`[eventhome] Slick slider đã được khởi chạy.`);
}

// Hàm xử lý khi nhấn nút chuyển tháng
function handleMonthChange(direction) {
    console.log(`[handleMonthChange] Đã nhấn nút: ${direction}`);

    let currentMonth = parseInt($('.slick-center').attr('data-month')) || new Date().getMonth() + 1;
    console.log(`[handleMonthChange] Tháng hiện tại: ${currentMonth}`);

    // Tính toán tháng mới
    let newMonth = direction === "next" ? currentMonth + 1 : currentMonth - 1;

    // Xử lý vòng lặp tháng (1-12)
    if (newMonth > 12) newMonth = 1;
    if (newMonth < 1) newMonth = 12;

    console.log(`[handleMonthChange] Tháng mới sau khi tính toán: ${newMonth}`);

    // Gọi hàm tải sự kiện với tháng mới
    loadEvent(newMonth);
}

// Gắn sự kiện cho các nút điều hướng
$('#btn-next').on('click', function() {
    console.log(`[Event] Đã nhấn nút Next.`);
    handleMonthChange("next");
});

$('#btn-back').on('click', function() {
    console.log(`[Event] Đã nhấn nút Back.`);
    handleMonthChange("back");
});

// Gọi lần đầu để khởi chạy slider và tải sự kiện ban đầu
$(document).ready(function() {
    const initialMonth = new Date().getMonth() + 1;
    console.log(`[Document Ready] Tải sự kiện ban đầu cho tháng: ${initialMonth}`);
    loadEvent(initialMonth); // Tải sự kiện cho tháng hiện tại
});
</script>

<?php getFooter();?>