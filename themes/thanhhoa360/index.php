<?php


getHeader();
global $urlThemeActive;
?>
<style type="text/css">
    .events-slide .slick-list .slick-track{
            transform: translate3d(0px, 0px, 0px)!important;
    }
    .location-container {
opacity:1;

}

.location-container-rev{
    flex-direction: row-reverse !important;
}
.test{
  flex-wrap: no-wrap !important;
  display: flex;

}
.dropdown-item{
  color: black !important;
}

.btn-more a{
 text-decoration: none !important;
 color: black;
}
.location-info{
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  height: 100%;

}

.bestnew-info{
  justify-content: space-around;
}

.location-container{
  margin: 0 100px;
}

.location-info {
  height: 100%;
  justify-content: space-between;
}

.container-fluid {
    --bs-gutter-x: 0rem;
}

.swiper-slide img{
  height: auto !important;
  width :100% !important;
}

.mySwiper2 {
    height: 40%;
    width: 100%;
}
.locations a{ 
text-decoration:none !important;
color: black;
}
.new-container a{
  text-decoration:none !important;
  color: black;
}
.best-new-container a{
  text-decoration:none !important;
  color: black;
}
.slider-header span {
  width: auto;

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
            <div class='header-btn header-btn-1' onclick="handleView360()">
              <span>Xem toàn cảnh 360</span>
              <div>
                <img src="<?= $urlThemeActive ?>images/arr-red.png" alt="">
              </div>
            </div>
            <a class='header-btn header-btn-2' href='<?php echo $setting['link_image360'] ?>'  target="_blank">
              <span>Truy cập link 360</span>
              <div>
                <img src="<?= $urlThemeActive ?>images/arr-white.png" alt="">
              </div>
            </a>
          </div>
         </div>
      </div>
     <div class='btn-stop-watch'  onclick="stop360View()">
      <span>Dừng xem 360</span>
     </div>

    </div>
    <!-- điểm đến tiêu biểu -->
    <div class='container-fluid' style="margin:0;">
    <?php foreach ($listHistorie as $key => $value): ?>
      <!----lỗi location-container ở js -->

      <div class='location-container <?php echo $key % 2 === 1 ? "location-container-rev" : ""; ?> flex-lg-row mt-5 '>

        <div class='location-des-container'>
        <?php if ($key === 0): ?>
          <div class='locations-title mb-5'>
            <!-- <span>Điểm đến</span> -->
            <span>Di tích Lịch sử </span>
            <span>Văn hóa</span>
          </div>
        <?php endif; ?>
          <div class='location-info'>
            <div class= "locations">
            <a  href="/chi_tiet_di_tich_lich_su/<?php echo @$value->urlSlug ?>.html" >
            <h2><?php echo @$value->name ?></h2>
            <img src="<?= $urlThemeActive ?>images/location.png" alt="address"> </a>
            <span class='fw-bold'><?php echo @$value->address ?></span> </a>
<br></br>
            <span><?php echo @$value->introductory ?></span>

            </div>
            <div class='btn-more mb-5 mt-2'>
              <a  href="/chi_tiet_di_tich_lich_su/<?php echo @$value->urlSlug ?>.html" >
              <span>Xem chi tiết</span> 
              <div>
                <img src="<?= $urlThemeActive ?>images/arr-red.png" alt=""> </a>
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
      <div class="test align-items-center justify-content-center gap-2">
        <!-- tin tức -->
        <?php if (!empty($mostViewedPosts)): ?>
            <?php foreach ($mostViewedPosts as $post): ?>
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 new-container">
        <a href="/<?php echo @$post->slug; ?>.html">
          <div class='new-img'>
           
            <img src="<?php echo $post['image']; ?>" alt="">
          </div>
          <h3><?php echo $post['title']; ?></h3></a>
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
          <span id="current-month">Tháng 12</span>
        </div>
      </div>
      <?php if(!empty($listDataEvent)) {
        foreach ($listDataEvent as $keyEvent => $valueEvent) {
        ?>
      <div class="best-new-container mt-4">
      <a style="width : 100%" href="/chi_tiet_su_kien/<?php echo @$valueEvent->urlSlug; ?>.html">
        <div  class="best-new-img">
          
          <img id="best-new-img" style="width : 100%" src="<?php echo @$valueEvent->image; ?>" alt="best">
        </div>
        <h3 id="event-title" class="mt-3">
        <?php echo @$valueEvent->name; ?></a>
        </h3>
        <div class="bestnew-info d-flex">
          <div id="event-description" class="bestnew-des">
          <?php echo @$valueEvent->introductory; ?>
          </div>
          <div class="bn-contacts">
            <div class="bn-contact">
              <img  src="<?= $urlThemeActive ?>images/date.png" alt="date">
              <span id="event-date"><?php echo date("d/m/Y",@$valueEvent->datestart); ?> - <?php echo date("d/m/Y",@$valueEvent->dateEnd); ?></span>
            </div>
            <div class="bn-contact">
              <img src="<?= $urlThemeActive ?>images/location.png" alt="address">
              <span id="event-address"> <?php echo @$valueEvent->address; ?></span>
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
  
  <!-- Swiper -->
<div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff" class="swiper mySwiper2">
  <div class="swiper-wrapper">
    <?php if (!empty($listDataImage)) { 
      foreach ($listDataImage as $key => $item) { ?>
        <div class="swiper-slide">
          <a href="<?php echo @$item->image360; ?>" target="_blank">
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
  
  <!-- Pagination nếu cần -->
  <div class="swiper-pagination"></div>

  <!-- Các nút điều hướng -->
  <div class="swiper-button-next custom-next"></div>
  <div class="swiper-button-prev custom-prev"></div>
</div>
</div>

<!-- Swiper -->

<script type="text/javascript">
// Khởi tạo Swiper
var swiper = new Swiper('.mySwiper2', {
  slidesPerView: 3, // Số slide hiển thị cùng lúc
  spaceBetween: 10, // Khoảng cách giữa các slide
  navigation: {
    nextEl: '.custom-next', // Tùy chỉnh nút "Next"
    prevEl: '.custom-prev'  // Tùy chỉnh nút "Prev"
  },
  pagination: {
    el: '.swiper-pagination',
    clickable: true, // Cho phép người dùng nhấp vào để chuyển slide
  },
  breakpoints: {
    // Responsive tùy theo kích thước màn hình
    640: {
      slidesPerView: 1,
      spaceBetween: 5,
    },
    768: {
      slidesPerView: 2,
      spaceBetween: 10,
    },
    1024: {
      slidesPerView: 3,
      spaceBetween: 15,
    }
  },
});


function handleView360() {
  // Lấy thẻ .header-container và toggle class no-overlay
  const headerContainer = document.querySelector('.header-container');
  if (headerContainer) {
    headerContainer.classList.toggle('no-overlay');
  } else {
    console.error('Element .header-container không tồn tại.');
  }

  // Hiển thị nút .btn-stop-watch
  const stopWatchBtn = document.querySelector('.btn-stop-watch');
  if (stopWatchBtn) {
    stopWatchBtn.style.display = 'flex';
  } else {
    console.error('Element .btn-stop-watch không tồn tại.');
  }

  // Ẩn thẻ .header-back-container
  const headerBackContainer = document.querySelector('.header-back-container');
  if (headerBackContainer) {
    headerBackContainer.classList.add('hidden');
  } else {
    console.error('Element .header-back-container không tồn tại.');
  }
}

function stop360View() {
  // Bỏ class no-overlay khỏi .header-container
  const headerContainer = document.querySelector('.header-container');
  if (headerContainer) {
    headerContainer.classList.remove('no-overlay');
  } else {
    console.error('Không tìm thấy .header-container');
  }

  // Ẩn nút .btn-stop-watch
  const stopWatchBtn = document.querySelector('.btn-stop-watch');
  if (stopWatchBtn) {
    stopWatchBtn.style.display = 'none'; // Ẩn nút
  } else {
    console.error('Không tìm thấy .btn-stop-watch');
  }

  // Hiển thị lại thẻ .header-back-container
  const headerBackContainer = document.querySelector('.header-back-container');
  if (headerBackContainer) {
    headerBackContainer.classList.remove('hidden'); // Loại bỏ class 'hidden'
  } else {
    console.error('Không tìm thấy .header-back-container');
  }

  console.log('Đã dừng xem toàn cảnh 360');
}

</script>



<?php getFooter();?>