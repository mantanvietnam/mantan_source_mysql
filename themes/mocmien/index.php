<?php 
    getHeader();
    global $settingThemes; 
?> 

    <!-- slider -->
    <!-- <div id="carouselExampleInterval" class="container carousel slide banner-slider" data-bs-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active" data-bs-interval="10000">
          <img src="<?= $urlThemeActive?>/assets/images/slide1.png" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item" data-bs-interval="2000">
          <img src="<?= $urlThemeActive?>/assets/images/slide2.png" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
          <img src="<?= $urlThemeActive?>/assets/images/slide3.png" class="d-block w-100" alt="...">
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div> -->
    <!-- Swiper -->
    <div class="px-5 banner-slider"> 
        <div class="swiper mySwiper"> 
            <div class="swiper-wrapper">
                <?php 
                  if(!empty($slide_home)){
                    foreach ($slide_home as $key => $value) {
                      echo '  <div class="swiper-slide slider-img-container">
                                  <img src="'.$value->image.'" alt="">
                              </div>
                              <div class="swiper-pagination"></div>
                          ';
                        }
                      }
                ?>
            </div>
        </div>
    </div>

    <!-- Quảng cáo -->
    <div class='container d-xxl-flex recommend-container d-none'>
    <!-- giới thiệu -->
    <div class='recommend-intro'>
      <div class='d-flex flex-column'>
        <div class='intro-title intro-text'>Mộc Miên</div>
        <div class='intro-text'>Hành trình</div>
        <div class='intro-text'>tái tạo làn da</div>
        <div class='intro-btn'>
          <a href="" class=''>Khám phá sản phẩm</a>
        </div>
      </div>
      <div class='special-product'>
        <div class='sp-title'>Các sản phẩm nổi bật</div>
        <div class='sp-container'>
          <div class='sp-first'>
            <img src="<?= $urlThemeActive?>/assets/images/sp1.png" alt="btn">
            <span>Sữa rửa mặt mướp đắng</span>
          </div>
          <div class='sp-first-btn'>
            <img src="<?= $urlThemeActive?>/assets/images/btn-ar.png" alt="btn">
          </div>
        </div>
        <div class='sp-container'>
          <div class='sp-first'>
            <img src="<?= $urlThemeActive?>/assets/images/sp2.png" alt="btn">
            <span>Dầu tẩy trang</span>
          </div>
          <div class='sp-first-btn'>
            <img src="<?= $urlThemeActive?>/assets/images/btn-ar.png" alt="btn">
          </div>
        </div>
        <div class='mb-4 sp-container'>
          <div class='sp-first'>
            <img src="<?= $urlThemeActive?>/assets/images/sp3.png" alt="btn">
            <span>Cao mướp đắng trị mụn</span>
          </div>
          <div class='sp-first-btn'>
            <img src="<?= $urlThemeActive?>/assets/images/btn-ar.png" alt="btn">
          </div>
        </div>
      </div>
    </div>
    <!-- Ảnh chính -->
    <div class='recommend-img-container'>
      <img src="<?= $urlThemeActive?>/assets/images/botmuopdang.png" alt="">
    </div>
    <!-- đánh giá -->
    <div class='review-container'>
      <div class='review-view'>
        <div>
          <img src="<?= $urlThemeActive?>/assets/images/star.png" alt="star">
        </div>
        <div class='review'>“Sử dụng các sản phẩm tái tạo làn da của Mộc Miên giúp tôi như trở về tuổi thanh xuân”</div>
        <div class='review-text-1'>Người dùng Mộc Miên -</div>
        <div>
          <img src="<?= $urlThemeActive?>/assets/images/groupp.png" alt="">
        </div>
        <div class='review-text-2'>Rất hài lòng với kết quả!</div>
      </div>
      <div class='video-container'>
        <div class='video-title'>Quy trình sản xuất</div>
        <video class='produce-video' controls width="291" height="160">
          <!-- Nguồn video -->
          <source src="video.mp4" type="video/mp4">
          <source src="video.webm" type="video/webm">
          <!-- Thông báo khi trình duyệt không hỗ trợ -->
          Trình duyệt của bạn không hỗ trợ thẻ video. 
          Vui lòng nâng cấp hoặc sử dụng trình duyệt khác.
      </video>
      </div>
    </div>
    </div>

    <!-- chính sách -->
     <div class='delivary-container'>
      <div class='container delivary-container-2 justify-content-md-between'>
        <div class='delivary'>
          <div>
            <img src="<?php echo @$settingThemes['images_1']; ?>" alt="logo">
          </div>
          <div class='delivary-title-container'>
            <span class='text-1'><?php echo @$settingThemes['delivery_title_1']; ?></span>
            <span class='text-2'><?php echo @$settingThemes['delivery_content_1']; ?></span>
          </div>
        </div>
        <div class='delivary'>
          <div>
            <img src="<?php echo @$settingThemes['images_2']; ?>" alt="logo">
          </div>
          <div class='delivary-title-container'>
            <span class='text-1'><?php echo @$settingThemes['delivery_title_2']; ?></span>
            <span class='text-2'><?php echo @$settingThemes['delivery_content_2']; ?></span>
          </div>
        </div>
        <div class='delivary'>
          <div>
            <img src="<?php echo @$settingThemes['images_3']; ?>" alt="logo">
          </div>
          <div class='delivary-title-container'>
            <span class='text-1'><?php echo @$settingThemes['delivery_title_3']; ?></span>
            <span class='text-2'><?php echo @$settingThemes['delivery_content_3']; ?></span>
          </div>
        </div>
      </div>
     </div>

     <!-- danh mục sản phẩm -->
      <div class='container category-container'>
        <div class='list-category-header'>
          <span><span class='color-green'>DANH MỤC</span> SẢN PHẨM</span>
          <a class='more-btn'>
            <div class=''>Xem thêm</div>
            <img src="<?= $urlThemeActive?>/assets/images/arr.png" alt="">
          </a>
        </div>
        <div class='gap-1 row'>
          <div class="col category-item">
            <div class='category-item-img'>
              <img src="<?= $urlThemeActive?>/assets/images/trisacto.png" alt="tinhchatdinhduong">
            </div>
            <span>Tinh chất dưỡng</span>
          </div>
          <div class="col category-item">
            <div class='category-item-img'>
              <img src="<?= $urlThemeActive?>/assets/images/ngannguamun.png" alt="tinhchatdinhduong">
            </div>
            <span>Sửa rửa mặt</span>
          </div>
          <div class="col category-item">
            <div class='category-item-img'>
              <img src="<?= $urlThemeActive?>/assets/images/combo1.png" alt="tinhchatdinhduong">
            </div>
            <span>Mặt nạ</span>
          </div>
        </div>
      </div>

      <!-- câu chuyện -->
      <div class='container gap-4 story-container flex-lg-row flex-column gap-lg-0 align-items-lg-start'>
      <div class='ceo-img'>
        <img src="<?= $urlThemeActive?>/assets/images/ceo.png" alt="ceo">
      </div>
      <div class='story-content'>
        <span><span class='color-green'>CÂU CHUYỆN</span> MỘC MIÊN</span>
        <div class='graph-containe'>
          <div class='text-style'>Hành trình đi tìm vẻ đẹp thuần nhiên và niềm tin yêu mãnh liệt với làn da không tuổi của Mộc Miên - ĐẸP THUẦN NHIÊN! </div>
          <div class='text-style-2'>Có những ngày, cuộc sống dường như đặt ra cho bạn một thử thách mà nếu không vượt qua, bạn sẽ mãi mãi ở lại nơi vạch xuất phát. Với tôi – Đặng Hoa, chuyên gia da liễu thuần nhiên, hành trình ấy đã đi qua biết bao nước mắt, thử thách và cả những khoảnh khắc muốn từ bỏ. Nhưng chính từ đó, tôi tìm ra sứ mệnh thật sự của mình: giúp hàng ngàn làn da tổn thương tìm lại vẻ đẹp tự nhiên, bền vững, không xâm lấn, ko đổ lỗi do cơ địa!
            Hơn ai hết, tôi hiểu rõ cảm giác mất tự tin khi đối diện với làn da đầy mụn, thâm hay nám. Những năm tháng đầu tiên 2019, khi còn là 1 giáo viên- tôi cũng từng là nạn nhân của 1 spa ở  Đà Nẵng cùng các sản phẩm kém chất lượng – những lời quảng cáo hão huyền khiến làn da tổn thương nặng nề, bị hoại tử.</div>
        </div>
        <div class='intro-btn'>
          <a href="" class=''>Tìm hiểu thêm</a>
        </div>
      </div>
      </div>

      <!-- Uy tín -->
      <div class='container legit-container'>
        <div>
          <div class='legit-title'>
            <div class='gap-4 d-flex flex-column flex-md-row align-items-center'>
              <span><span class='color-green'>UY TÍN</span> MANG LẠI</span>
              <div>
                <img src="<?= $urlThemeActive?>/assets/images/star.png" alt="">
              </div>
            </div>
            <span class='mt-3 color-green mt-md-0'>THƯƠNG HIỆU SẮC ĐẸP</span>
          </div>
          <div class='legit-items'>
            <div class='legit-item'>
              <img src="<?= $urlThemeActive?>/assets/images/tick.png" alt="">
              <div class='legit-item-text'>Mụn hết 100%, ko hết mụn hoàn tiền, không đổ lỗi do cơ địa</div>
            </div>
            <div class='legit-item'>
              <img src="<?= $urlThemeActive?>/assets/images/tick.png" alt="">
              <div>
                <div class='legit-item-text'>Sắc tố( nám, chàm, bớt...) hết 70_90% tùy độ tuổi và nguyên nhân khởi phát.</div>
                <div class='legit-item-text'>Không đẹp hoàn tiền, kích ứng đền gấp 3. Không đổ lỗi do cơ địa.</div>
              </div>
            </div>
            <div class='legit-item'>
              <img src="<?= $urlThemeActive?>/assets/images/tick.png" alt="">
              <div class='legit-item-text'>Căng bóng trẻ hóa, xóa nhăn: 80_95%, không đẹp hoàn tiền, không đổ lỗi do cơ địa</div>
            </div>
            <div class='legit-item'>
              <img src="<?= $urlThemeActive?>/assets/images/tick.png" alt="">
              <div class='legit-item-text'>Khách hàng sử dụng đúng, đủ đều theo phác đồ, không tự ý mix bất kì sp, hoạt chất nào bên ngoài, kể cả nước cất tinh khiết</div>
            </div>
            <div class='legit-item'>
              <img src="<?= $urlThemeActive?>/assets/images/tick.png" alt="">
              <div class='legit-item-text'>Không kinh doanh được, không ra đơn dc trong 30 ngày được đổi trả hàng, không mất chi phí gì thêm.</div>
            </div>
            <div class='legit-item'>
              <img src="<?= $urlThemeActive?>/assets/images/tick.png" alt="">
              <div class='legit-item-text'>Được đào tạo chuyên sâu về da liễu, quy trình tư vấn, thăm khám, chốt đơn, ra đơn trong 24h _7 ngày</div>
            </div>
          </div>
        </div>
        <video class='d-lg-block d-none produce-video' controls width="291" height="160">
          <!-- Nguồn video -->
          <source src="video.mp4" type="video/mp4">
          <source src="video.webm" type="video/webm">
          <!-- Thông báo khi trình duyệt không hỗ trợ -->
          Trình duyệt của bạn không hỗ trợ thẻ video. 
          Vui lòng nâng cấp hoặc sử dụng trình duyệt khác.
      </video>
      </div>

      <!-- sản phẩm bán chạy -->
      <div class='container mt-5 bestsell-container'>
        <div class='list-category-header'>
          <span><span class='color-green'>SẢN PHẨM</span> BÁN CHẠY</span>
          <a class='more-btn'>
            <div class=''>Xem thêm</div>
            <img src="<?= $urlThemeActive?>/assets/images/arr.png" alt="">
          </a>
        </div>
        <div class='row bestsell-list-container'>
          <!-- product cart -->
          <div class="col bestsell-product-container">
            <div class='bestsell-product-image'>
              <img src="<?= $urlThemeActive?>/assets/images/product1.png" alt="">
            </div>
            <div class='gap-2 d-flex'>
              <div class='tag-container combo-tag'>
                <span>COMBO</span>
              </div>
              <div class='tag-container new-tag'>
                <span>NEW</span>
              </div>
            </div>
            <div class='bestsell-product-title'>
              <span>COMBO x2 đặc trị mụn - Cao mướp đắng khổ qua, bột mướp đắng, sữa rửa mặt mướp đắng</span>
            </div>
            <div class='bestsell-product-price-container'>
              <div class='bestsell-product-current-price'>329,000đ</div>
              <div class='bestsell-product-old-price'>579,000đ</div>
            </div>
            <div class='bestsell-product-selling'>
              <span>3,7k đã bán</span>
              <div>
                <img src="<?= $urlThemeActive?>/assets/images/tym.png" alt="">
              </div>
            </div>
          </div>
          <!-- product cart -->
          <div class="col bestsell-product-container">
            <div class='bestsell-product-image'>
              <img src="<?= $urlThemeActive?>/assets/images/product1.png" alt="">
            </div>
            <div class='gap-2 d-flex'>
              <div class='tag-container combo-tag'>
                <span>COMBO</span>
              </div>
              <div class='tag-container new-tag'>
                <span>NEW</span>
              </div>
            </div>
            <div class='bestsell-product-title'>
              <span>COMBO x2 đặc trị mụn - Cao mướp đắng khổ qua, bột mướp đắng, sữa rửa mặt mướp đắng</span>
            </div>
            <div class='bestsell-product-price-container'>
              <div class='bestsell-product-current-price'>329,000đ</div>
              <div class='bestsell-product-old-price'>579,000đ</div>
            </div>
            <div class='bestsell-product-selling'>
              <span>3,7k đã bán</span>
              <div>
                <img src="<?= $urlThemeActive?>/assets/images/tym.png" alt="">
              </div>
            </div>
          </div>
          <!-- product cart -->
          <div class="col bestsell-product-container">
            <div class='bestsell-product-image'>
              <img src="<?= $urlThemeActive?>/assets/images/product1.png" alt="">
            </div>
            <div class='gap-2 d-flex'>
              <div class='tag-container combo-tag'>
                <span>COMBO</span>
              </div>
              <div class='tag-container new-tag'>
                <span>NEW</span>
              </div>
            </div>
            <div class='bestsell-product-title'>
              <span>COMBO x2 đặc trị mụn - Cao mướp đắng khổ qua, bột mướp đắng, sữa rửa mặt mướp đắng</span>
            </div>
            <div class='bestsell-product-price-container'>
              <div class='bestsell-product-current-price'>329,000đ</div>
              <div class='bestsell-product-old-price'>579,000đ</div>
            </div>
            <div class='bestsell-product-selling'>
              <span>3,7k đã bán</span>
              <div>
                <img src="<?= $urlThemeActive?>/assets/images/tym.png" alt="">
              </div>
            </div>
          </div>
          <!-- product cart -->
          <div class="col bestsell-product-container">
            <div class='bestsell-product-image'>
              <img src="<?= $urlThemeActive?>/assets/images/product1.png" alt="">
            </div>
            <div class='gap-2 d-flex'>
              <div class='tag-container combo-tag'>
                <span>COMBO</span>
              </div>
              <div class='tag-container new-tag'>
                <span>NEW</span>
              </div>
            </div>
            <div class='bestsell-product-title'>
              <span>COMBO x2 đặc trị mụn - Cao mướp đắng khổ qua, bột mướp đắng, sữa rửa mặt mướp đắng</span>
            </div>
            <div class='bestsell-product-price-container'>
              <div class='bestsell-product-current-price'>329,000đ</div>
              <div class='bestsell-product-old-price'>579,000đ</div>
            </div>
            <div class='bestsell-product-selling'>
              <span>3,7k đã bán</span>
              <div>
                <img src="<?= $urlThemeActive?>/assets/images/tym.png" alt="">
              </div>
            </div>
          </div>
          <!-- product cart -->
          <div class="col bestsell-product-container">
            <div class='bestsell-product-image'>
              <img src="<?= $urlThemeActive?>/assets/images/product1.png" alt="">
            </div>
            <div class='gap-2 d-flex'>
              <div class='tag-container combo-tag'>
                <span>COMBO</span>
              </div>
              <div class='tag-container new-tag'>
                <span>NEW</span>
              </div>
            </div>
            <div class='bestsell-product-title'>
              <span>COMBO x2 đặc trị mụn - Cao mướp đắng khổ qua, bột mướp đắng, sữa rửa mặt mướp đắng</span>
            </div>
            <div class='bestsell-product-price-container'>
              <div class='bestsell-product-current-price'>329,000đ</div>
              <div class='bestsell-product-old-price'>579,000đ</div>
            </div>
            <div class='bestsell-product-selling'>
              <span>3,7k đã bán</span>
              <div>
                <img src="<?= $urlThemeActive?>/assets/images/tym.png" alt="">
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Hướng dẫn sử dụng -->
      <div class='container gap-3 mt-5 instruction-container d-none d-xxl-flex justify-content-center align-items-center'>
        <div>
          <img src="<?= $urlThemeActive?>/assets/images/huongdan1.png" alt="huongdan1">
        </div>
        <div class='gap-3 d-flex flex-column'>
          <div>
            <img src="<?= $urlThemeActive?>/assets/images/huongdan2.png" alt="">
          </div>
          <div>
            <img src="<?= $urlThemeActive?>/assets/images/huongdan3.png" alt="">
          </div>
        </div>
      </div>

      <!-- sản phẩm theo combo -->
      <div class='container mt-5 container-combo'>
        <div class='list-category-header'>
          <span>SẢN PHẨM THEO <span class='color-green'>COMBO</span></span>
          <a class='more-btn'>
            <div class=''>Xem thêm</div>
            <img src="<?= $urlThemeActive?>/assets/images/arr.png" alt="">
          </a>
        </div>
        <div class='row bestsell-list-container'>
          <!-- product cart -->
          <div class="col bestsell-product-container">
            <div class='bestsell-product-image'>
              <img src="<?= $urlThemeActive?>/assets/images/product1.png" alt="">
            </div>
            
            <div class='bestsell-product-title'>
              <span>COMBO x2 đặc trị mụn - Cao mướp đắng khổ qua, bột mướp đắng, sữa rửa mặt mướp đắng</span>
            </div>
            <div class='bestsell-product-price-container'>
              <div class='bestsell-product-current-price'>329,000đ</div>
              <div class='bestsell-product-old-price'>579,000đ</div>
            </div>
            <div class='bestsell-product-selling'>
              <div class="star-rating">
                <div class="star filled">★</div>
                <div class="star filled">★</div>
                <div class="star filled">★</div>
                <div class="star half">★</div>
                <div class="star">★</div>
              </div>
              <div class='product-tym'>
                <img src="<?= $urlThemeActive?>/assets/images/tym.png" alt="tym">
              </div>
            </div>
          </div>
          <!-- product cart -->
          <div class="col bestsell-product-container">
            <div class='bestsell-product-image'>
              <img src="<?= $urlThemeActive?>/assets/images/product1.png" alt="">
            </div>
            
            <div class='bestsell-product-title'>
              <span>COMBO x2 đặc trị mụn - Cao mướp đắng khổ qua, bột mướp đắng, sữa rửa mặt mướp đắng</span>
            </div>
            <div class='bestsell-product-price-container'>
              <div class='bestsell-product-current-price'>329,000đ</div>
              <div class='bestsell-product-old-price'>579,000đ</div>
            </div>
            <div class='bestsell-product-selling'>
              <div class="star-rating">
                <div class="star filled">★</div>
                <div class="star filled">★</div>
                <div class="star filled">★</div>
                <div class="star half">★</div>
                <div class="star">★</div>
              </div>
              <div class='product-tym'>
                <img src="<?= $urlThemeActive?>/assets/images/tym.png" alt="">
              </div>
            </div>
          </div>
          <!-- product cart -->
          <div class="col bestsell-product-container">
            <div class='bestsell-product-image'>
              <img src="<?= $urlThemeActive?>/assets/images/product1.png" alt="">
            </div>
            
            <div class='bestsell-product-title'>
              <span>COMBO x2 đặc trị mụn - Cao mướp đắng khổ qua, bột mướp đắng, sữa rửa mặt mướp đắng</span>
            </div>
            <div class='bestsell-product-price-container'>
              <div class='bestsell-product-current-price'>329,000đ</div>
              <div class='bestsell-product-old-price'>579,000đ</div>
            </div>
            <div class='bestsell-product-selling'>
              <div class="star-rating">
                <div class="star filled">★</div>
                <div class="star filled">★</div>
                <div class="star filled">★</div>
                <div class="star half">★</div>
                <div class="star">★</div>
              </div>
              <div class='product-tym'>
                <img src="<?= $urlThemeActive?>/assets/images/tym.png" alt="">
              </div>
            </div>
          </div>
          <!-- product cart -->
          <div class="col bestsell-product-container">
            <div class='bestsell-product-image'>
              <img src="<?= $urlThemeActive?>/assets/images/product1.png" alt="">
            </div>
            
            <div class='bestsell-product-title'>
              <span>COMBO x2 đặc trị mụn - Cao mướp đắng khổ qua, bột mướp đắng, sữa rửa mặt mướp đắng</span>
            </div>
            <div class='bestsell-product-price-container'>
              <div class='bestsell-product-current-price'>329,000đ</div>
              <div class='bestsell-product-old-price'>579,000đ</div>
            </div>
            <div class='bestsell-product-selling'>
              <div class="star-rating">
                <div class="star filled">★</div>
                <div class="star filled">★</div>
                <div class="star filled">★</div>
                <div class="star half">★</div>
                <div class="star">★</div>
              </div>
              <div class='product-tym'>
                <img src="<?= $urlThemeActive?>/assets/images/tym.png" alt="">
              </div>
            </div>
          </div>
          <!-- product cart -->
          <div class="col bestsell-product-container">
            <div class='bestsell-product-image'>
              <img src="<?= $urlThemeActive?>/assets/images/product1.png" alt="">
            </div>
            
            <div class='bestsell-product-title'>
              <span>COMBO x2 đặc trị mụn - Cao mướp đắng khổ qua, bột mướp đắng, sữa rửa mặt mướp đắng</span>
            </div>
            <div class='bestsell-product-price-container'>
              <div class='bestsell-product-current-price'>329,000đ</div>
              <div class='bestsell-product-old-price'>579,000đ</div>
            </div>
            <div class='bestsell-product-selling'>
              <div class="star-rating">
                <div class="star filled">★</div>
                <div class="star filled">★</div>
                <div class="star filled">★</div>
                <div class="star half">★</div>
                <div class="star">★</div>
              </div>
              <div class='product-tym'>
                <img src="<?= $urlThemeActive?>/assets/images/tym.png" alt="">
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- bộ sưu tập mơi -->
       <div class='container mt-5 new-collection-container'>
        <div class='mb-4 new-collection-title'>
          <div class='col-6 d-flex flex-column collection-title'>
            <span>BỘ SƯU TẬP MỚI:</span>
            <span class='color-green'>SẢN PHẨM TỪ MƯỚP ĐẮNG</span>
          </div>
          <span class='col-6 new-collection-title-des'>Được chiết xuất từ mướp đắng tươi mát, sản phẩm không chỉ giúp làm sạch sâu, loại bỏ bã nhờn mà còn cung cấp dưỡng chất giúp làn da sáng khỏe và mịn màng. Mỗi món đồ trong bộ sưu tập đều được nghiên cứu và phát triển tỉ mỉ, kết hợp giữa truyền thống và khoa học hiện đại, mang lại hiệu quả rõ rệt và an toàn mọi loại da.</span>
        </div>
        <div class='gap-4 d-flex flex-column justify-content-between flex-md-row'>
          <div class='collection-nav-container'>
            <div class="collection-nav-item active" data-target="all">
              <span>Tất cả</span>
            </div>
            <div class="collection-nav-item" data-target="tinh-chat">
              <span>Tinh chất</span>
            </div>
            <div class="collection-nav-item" data-target="sua-rua-mat">
              <span>Sữa rửa mặt</span>
            </div>
            <div class="collection-nav-item" data-target="san-pham-bot">
              <span>Sản phẩm bột</span>
            </div>
          </div>
          <a class='d-flex text-decoration-none align-items-center'>
            <div class='color-green btn-more-collection'>Xem tất cả</div>
            <div>
              <img src="<?= $urlThemeActive?>/assets/images/arr.png" alt="xem thêm">
            </div>
          </a>
        </div>
        <!-- Collection Container - Tất cả -->
        <div class='mt-5 collection-container row' data-category="all">
          <div class='col-12 col-lg-6'>
            <div class='collection-frist-container'>
              <img src="<?= $urlThemeActive?>/assets/images/combo1.png" alt="">
              <div class='collection-frist-des'>
                <h5>COMBO x2 đặc trị mụn - Cao mướp đắng khổ qua, bột mướp đắng, sữa rửa mặt mướp đắng</h5>
                <div class='d-flex align-items-center justify-content-between'>
                  <div class='d-flex flex-column collection-frist-price'>
                    <span>Giá sản phẩm</span>
                    <span class='color-green'>600.000đ</span>
                  </div>
                  <div class='intro-btn'>
                    <a href="" class=''>Mua ngay</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class='gap-4 mt-4 col-lg-3 col-6 d-flex flex-column justify-content-between mt-lg-0'>
            <div class='collection-mid-img'>
              <img src="<?= $urlThemeActive?>/assets/images/cbd1.png" alt="">
            </div>
            <div class='collection-mid-img'>
              <img src="<?= $urlThemeActive?>/assets/images/cbd1.png" alt="">
            </div>
          </div>
          <div class='gap-4 mt-4 col-lg-3 col-6 d-flex flex-column justify-content-between mt-lg-0'>
            <div class='collection-mid-img'>
              <img src="<?= $urlThemeActive?>/assets/images/cbd1.png" alt="">
            </div>
            <div class='collection-mid-img'>
              <img src="<?= $urlThemeActive?>/assets/images/cbd1.png" alt="">
            </div>
          </div>
        </div>
         <!-- Collection Container - Tinh chất -->
         <div class='mt-5 collection-container row d-none' data-category="tinh-chat">
          <div class='col-6'>
            <div class='collection-frist-container'>
              <img src="<?= $urlThemeActive?>/assets/images/combo1.png" alt="">
              <div class='collection-frist-des'>
                <h5>Tinh chất mướp đắng đặc trị</h5>
                <div class='d-flex align-items-center justify-content-between'>
                  <div class='d-flex flex-column collection-frist-price'>
                    <span>Giá sản phẩm</span>
                    <span class='color-green'>600.000đ</span>
                  </div>
                  <div class='intro-btn'>
                    <a href="" class=''>Mua ngay</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class='col-3 d-flex flex-column justify-content-between'>
            <div class='collection-mid-img'>
              <img src="<?= $urlThemeActive?>/assets/images/cbd1.png" alt="">
            </div>
            <div class='collection-mid-img'>
              <img src="<?= $urlThemeActive?>/assets/images/cbd1.png" alt="">
            </div>
          </div>
          <div class='col-3 d-flex flex-column justify-content-between'>
            <div class='collection-mid-img'>
              <img src="<?= $urlThemeActive?>/assets/images/cbd1.png" alt="">
            </div>
            <div class='collection-mid-img'>
              <img src="<?= $urlThemeActive?>/assets/images/cbd1.png" alt="">
            </div>
          </div>
        </div>
        <!-- Collection Container - sữa rửa mặt -->
        <div class='mt-5 collection-container row d-none' data-category="sua-rua-mat">
          <div class='col-6'>
            <div class='collection-frist-container'>
              <img src="<?= $urlThemeActive?>/assets/images/combo1.png" alt="">
              <div class='collection-frist-des'>
                <h5>Tinh chất mướp đắng đặc trị</h5>
                <div class='d-flex align-items-center justify-content-between'>
                  <div class='d-flex flex-column collection-frist-price'>
                    <span>Giá sản phẩm</span>
                    <span class='color-green'>600.000đ</span>
                  </div>
                  <div class='intro-btn'>
                    <a href="" class=''>Mua ngay</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class='col-3 d-flex flex-column justify-content-between'>
            <div class='collection-mid-img'>
              <img src="<?= $urlThemeActive?>/assets/images/cbd1.png" alt="">
            </div>
            <div class='collection-mid-img'>
              <img src="<?= $urlThemeActive?>/assets/images/cbd1.png" alt="">
            </div>
          </div>
          <div class='col-3 d-flex flex-column justify-content-between'>
            <div class='collection-mid-img'>
              <img src="<?= $urlThemeActive?>/assets/images/cbd1.png" alt="">
            </div>
            <div class='collection-mid-img'>
              <img src="<?= $urlThemeActive?>/assets/images/cbd1.png" alt="">
            </div>
          </div>
        </div>
        <!-- Collection Container - Sản phẩm bột -->
        <div class='mt-5 collection-container row d-none' data-category="san-pham-bot">
          <div class='col-6'>
            <div class='collection-frist-container'>
              <img src="<?= $urlThemeActive?>/assets/images/combo1.png" alt="">
              <div class='collection-frist-des'>
                <h5>Tinh chất mướp đắng đặc trị</h5>
                <div class='d-flex align-items-center justify-content-between'>
                  <div class='d-flex flex-column collection-frist-price'>
                    <span>Giá sản phẩm</span>
                    <span class='color-green'>600.000đ</span>
                  </div>
                  <div class='intro-btn'>
                    <a href="" class=''>Mua ngay</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class='col-3 d-flex flex-column justify-content-between'>
            <div class='collection-mid-img'>
              <img src="<?= $urlThemeActive?>/assets/images/cbd1.png" alt="">
            </div>
            <div class='collection-mid-img'>
              <img src="<?= $urlThemeActive?>/assets/images/cbd1.png" alt="">
            </div>
          </div>
          <div class='col-3 d-flex flex-column justify-content-between'>
            <div class='collection-mid-img'>
              <img src="<?= $urlThemeActive?>/assets/images/cbd1.png" alt="">
            </div>
            <div class='collection-mid-img'>
              <img src="<?= $urlThemeActive?>/assets/images/cbd1.png" alt="">
            </div>
          </div>
        </div>
       </div>
       <!-- Sự kiện sắp tới -->
       <div class='container mt-5 event-container'>
        <div class='list-category-header'>
          <span><span class='color-green'>SỰ KIỆN</span> SẮP TỚI</span>
        </div>
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
          </div>
          <div class="carousel-inner">
            <div class="carousel-item active">
              <div class='event-img'>
                <img src="<?= $urlThemeActive?>/assets/images/combo1.png" alt="Sự kiện sắp tới">
              </div>
              <div class='event-content'>
                <h3>“Suncare.Skincare: Let The Sunshine In” – Ngày hội chống nắng IMAGE Skincare 2024</h3>
                <span>Với chủ đề “Suncare. Skincare: Let The Sunshine In”, sự kiện ra mắt dòng chống nắng mới của IMAGE Skincare đã diễn ra tại Thảo Điền, Quận 2, TP.HCM. Đây là dịp để thương hiệu mỹ phẩm danh tiếng đến từ Hoa Kỳ trình làng dòng sản phẩm chống nắng mới nhất của mình, đồng thời tạo ra một không gian trải nghiệm đẳng cấp cho khách mời.</span>
                <div class='d-flex align-items-center justify-content-between'>
                  <div class='gap-3 d-flex align-items-center'>
                    <div>
                      <img src="<?= $urlThemeActive?>/assets/images/diengia.png" alt="Avt">
                    </div>
                    <span class='text-black'>Diễn giả: Đặng Hoa</span>
                  </div>
                  <span>
                    Thời gian: 13/12/2024
                  </span>
                </div>
              </div>
            </div>
            <div class="carousel-item">
              <div class='event-img'>
                <img src="<?= $urlThemeActive?>/assets/images/combo1.png" alt="Sự kiện sắp tới">
              </div>
              <div class='event-content'>
                <h3>“Suncare.Skincare: Let The Sunshine In” – Ngày hội chống nắng IMAGE Skincare 2024</h3>
                <span>Với chủ đề “Suncare. Skincare: Let The Sunshine In”, sự kiện ra mắt dòng chống nắng mới của IMAGE Skincare đã diễn ra tại Thảo Điền, Quận 2, TP.HCM. Đây là dịp để thương hiệu mỹ phẩm danh tiếng đến từ Hoa Kỳ trình làng dòng sản phẩm chống nắng mới nhất của mình, đồng thời tạo ra một không gian trải nghiệm đẳng cấp cho khách mời.</span>
                <div class='d-flex align-items-center justify-content-between'>
                  <div class='gap-3 d-flex align-items-center'>
                    <div>
                      <img src="<?= $urlThemeActive?>/assets/images/diengia.png" alt="Avt">
                    </div>
                    <span class='text-black'>Diễn giả: Đặng Hoa</span>
                  </div>
                  <span>
                    Thời gian: 13/12/2024
                  </span>
                </div>
              </div>
            </div>
            <div class="carousel-item">
              <div class='event-img'>
                <img src="<?= $urlThemeActive?>/assets/images/combo1.png" alt="Sự kiện sắp tới">
              </div>
              <div class='event-content'>
                <h3>“Suncare.Skincare: Let The Sunshine In” – Ngày hội chống nắng IMAGE Skincare 2024</h3>
                <span>Với chủ đề “Suncare. Skincare: Let The Sunshine In”, sự kiện ra mắt dòng chống nắng mới của IMAGE Skincare đã diễn ra tại Thảo Điền, Quận 2, TP.HCM. Đây là dịp để thương hiệu mỹ phẩm danh tiếng đến từ Hoa Kỳ trình làng dòng sản phẩm chống nắng mới nhất của mình, đồng thời tạo ra một không gian trải nghiệm đẳng cấp cho khách mời.</span>
                <div class='d-flex align-items-center justify-content-between'>
                  <div class='gap-3 d-flex align-items-center'>
                    <div>
                      <img src="<?= $urlThemeActive?>/assets/images/diengia.png" alt="Avt">
                    </div>
                    <span class='text-black'>Diễn giả: Đặng Hoa</span>
                  </div>
                  <span>
                    Thời gian: 13/12/2024
                  </span>
                </div>
              </div>
            </div>
          </div>
          <!-- Nút tùy chỉnh -->
          <div class="custom-controls">
            <button class="custom-prev" onclick="prevSlide()">
              <img src="<?= $urlThemeActive?>/assets/images/arr-next.png" alt="">
            </button>
            <button class="custom-next" onclick="nextSlide()">
              <img src="<?= $urlThemeActive?>/assets/images/arr-next.png" alt="">
            </button>
          </div>
        </div>
       </div>

       <!-- Tin tức từ mộc miên -->
      <div class='container mt-5 new-section-container'>
        <div class='list-category-header'>
          <span><span class='color-green'>TIN TỨC</span> TỪ MỘC MIÊN</span>
          <a class='more-btn'>
            <div class=''>Xem thêm</div>
            <img src="<?= $urlThemeActive?>/assets/images/arr.png" alt="">
          </a>
        </div>
        <div class='gap-4 d-flex flex-column justify-content-between flex-md-row'>
          <div class='news-nav-container'>
            <div class="news-nav-item active" data-target="review">
              <span>Góc review</span>
            </div>
            <div class="news-nav-item" data-target="su-kien">
              <span>Sự kiện</span>
            </div>
            <div class="news-nav-item" data-target="tin-tuc">
              <span>Tin tức</span>
            </div>
            <div class="news-nav-item" data-target="cham-soc-da">
              <span>Cách chăm sóc làn da</span>
            </div>
            <div class="news-nav-item" data-target="bi-quyet">
              <span>Bí quyết khỏe đẹp</span>
            </div>
          </div>
        </div>
        <!-- góc review -->
        <div class='gap-4 mt-5 news-container row gap-md-0' data-category="review">
          <div class='col-lg-4 col-12 col-md-6 news-items'>
            <div class='news-items-img'>
              <img src="<?= $urlThemeActive?>/assets/images/tt.png" alt="tin tức">
            </div>
            <h3>
              REVIEW Nước Hoa Hồng Facial Toner - Fresh Hydranation của nhà MỘC MIÊN
            </h3>
            <span>
              Lorem ipsum dolor sit amet. Ut officiis perferendis eos consequatur accusamus ut iure rerum et sequi sint qui saepe internos et eligendi autem aut obcaecati eveniet. Et sequi dolore vel suscipit praesentium sed molestias nobis qui error galisum et quia adipisci.
            </span>
          </div>
          <div class='col-lg-4 col-12 col-md-6 news-items'>
            <div class='news-items-img'>
              <img src="<?= $urlThemeActive?>/assets/images/tt.png" alt="tin tức">
            </div>
            <h3>
              REVIEW Nước Hoa Hồng Facial Toner - Fresh Hydranation của nhà MỘC MIÊN
            </h3>
            <span>
              Lorem ipsum dolor sit amet. Ut officiis perferendis eos consequatur accusamus ut iure rerum et sequi sint qui saepe internos et eligendi autem aut obcaecati eveniet. Et sequi dolore vel suscipit praesentium sed molestias nobis qui error galisum et quia adipisci.
            </span>
          </div>
          <div class='col-lg-4 col-12 col-md-6 news-items'>
            <div class='news-items-img'>
              <img src="<?= $urlThemeActive?>/assets/images/tt.png" alt="tin tức">
            </div>
            <h3>
              REVIEW Nước Hoa Hồng Facial Toner - Fresh Hydranation của nhà MỘC MIÊN
            </h3>
            <span>
              Lorem ipsum dolor sit amet. Ut officiis perferendis eos consequatur accusamus ut iure rerum et sequi sint qui saepe internos et eligendi autem aut obcaecati eveniet. Et sequi dolore vel suscipit praesentium sed molestias nobis qui error galisum et quia adipisci.
            </span>
          </div>
        </div>
         <!-- Sự kiện -->
         <div class='gap-4 mt-5 news-container row gap-md-0 d-none' data-category="su-kien">
          <div class='col-lg-4 col-12 col-md-6 news-items'>
            <div class='news-items-img'>
              <img src="<?= $urlThemeActive?>/assets/images/botmuopdang.png" alt="tin tức">
            </div>
            <h3>
              REVIEW Nước Hoa Hồng Facial Toner - Fresh Hydranation của nhà MỘC MIÊN
            </h3>
            <span>
              Lorem ipsum dolor sit amet. Ut officiis perferendis eos consequatur accusamus ut iure rerum et sequi sint qui saepe internos et eligendi autem aut obcaecati eveniet. Et sequi dolore vel suscipit praesentium sed molestias nobis qui error galisum et quia adipisci.
            </span>
          </div>
          <div class='col-lg-4 col-12 col-md-6 news-items'>
            <div class='news-items-img'>
              <img src="<?= $urlThemeActive?>/assets/images/botmuopdang.png" alt="tin tức">
            </div>
            <h3>
              REVIEW Nước Hoa Hồng Facial Toner - Fresh Hydranation của nhà MỘC MIÊN
            </h3>
            <span>
              Lorem ipsum dolor sit amet. Ut officiis perferendis eos consequatur accusamus ut iure rerum et sequi sint qui saepe internos et eligendi autem aut obcaecati eveniet. Et sequi dolore vel suscipit praesentium sed molestias nobis qui error galisum et quia adipisci.
            </span>
          </div>
          <div class='col-lg-4 col-12 col-md-6 news-items'>
            <div class='news-items-img'>
              <img src="<?= $urlThemeActive?>/assets/images/botmuopdang.png" alt="tin tức">
            </div>
            <h3>
              REVIEW Nước Hoa Hồng Facial Toner - Fresh Hydranation của nhà MỘC MIÊN
            </h3>
            <span>
              Lorem ipsum dolor sit amet. Ut officiis perferendis eos consequatur accusamus ut iure rerum et sequi sint qui saepe internos et eligendi autem aut obcaecati eveniet. Et sequi dolore vel suscipit praesentium sed molestias nobis qui error galisum et quia adipisci.
            </span>
          </div>
        </div>
         <!-- tin tức -->
         <div class='gap-4 mt-5 news-container row gap-md-0 d-none' data-category="tin-tuc">
          <div class='col-lg-4 col-12 col-md-6 news-items'>
            <div class='news-items-img'>
              <img src="<?= $urlThemeActive?>/assets/images/tt.png" alt="tin tức">
            </div>
            <h3>
              REVIEW Nước Hoa Hồng Facial Toner - Fresh Hydranation của nhà MỘC MIÊN
            </h3>
            <span>
              Lorem ipsum dolor sit amet. Ut officiis perferendis eos consequatur accusamus ut iure rerum et sequi sint qui saepe internos et eligendi autem aut obcaecati eveniet. Et sequi dolore vel suscipit praesentium sed molestias nobis qui error galisum et quia adipisci.
            </span>
          </div>
          <div class='col-lg-4 col-12 col-md-6 news-items'>
            <div class='news-items-img'>
              <img src="<?= $urlThemeActive?>/assets/images/tt.png" alt="tin tức">
            </div>
            <h3>
              REVIEW Nước Hoa Hồng Facial Toner - Fresh Hydranation của nhà MỘC MIÊN
            </h3>
            <span>
              Lorem ipsum dolor sit amet. Ut officiis perferendis eos consequatur accusamus ut iure rerum et sequi sint qui saepe internos et eligendi autem aut obcaecati eveniet. Et sequi dolore vel suscipit praesentium sed molestias nobis qui error galisum et quia adipisci.
            </span>
          </div>
          <div class='col-lg-4 col-12 col-md-6 news-items'>
            <div class='news-items-img'>
              <img src="<?= $urlThemeActive?>/assets/images/tt.png" alt="tin tức">
            </div>
            <h3>
              REVIEW Nước Hoa Hồng Facial Toner - Fresh Hydranation của nhà MỘC MIÊN
            </h3>
            <span>
              Lorem ipsum dolor sit amet. Ut officiis perferendis eos consequatur accusamus ut iure rerum et sequi sint qui saepe internos et eligendi autem aut obcaecati eveniet. Et sequi dolore vel suscipit praesentium sed molestias nobis qui error galisum et quia adipisci.
            </span>
          </div>
        </div>
         <!-- Cách chăm sóc làn da -->
         <div class='gap-4 mt-5 news-container row gap-md-0 d-none' data-category="cham-soc-da">
          <div class='col-lg-4 col-12 col-md-6 news-items'>
            <div class='news-items-img'>
              <img src="<?= $urlThemeActive?>/assets/images/tt.png" alt="tin tức">
            </div>
            <h3>
              REVIEW Nước Hoa Hồng Facial Toner - Fresh Hydranation của nhà MỘC MIÊN
            </h3>
            <span>
              Lorem ipsum dolor sit amet. Ut officiis perferendis eos consequatur accusamus ut iure rerum et sequi sint qui saepe internos et eligendi autem aut obcaecati eveniet. Et sequi dolore vel suscipit praesentium sed molestias nobis qui error galisum et quia adipisci.
            </span>
          </div>
          <div class='col-lg-4 col-12 col-md-6 news-items'>
            <div class='news-items-img'>
              <img src="<?= $urlThemeActive?>/assets/images/tt.png" alt="tin tức">
            </div>
            <h3>
              REVIEW Nước Hoa Hồng Facial Toner - Fresh Hydranation của nhà MỘC MIÊN
            </h3>
            <span>
              Lorem ipsum dolor sit amet. Ut officiis perferendis eos consequatur accusamus ut iure rerum et sequi sint qui saepe internos et eligendi autem aut obcaecati eveniet. Et sequi dolore vel suscipit praesentium sed molestias nobis qui error galisum et quia adipisci.
            </span>
          </div>
          <div class='col-lg-4 col-12 col-md-6 news-items'>
            <div class='news-items-img'>
              <img src="<?= $urlThemeActive?>/assets/images/tt.png" alt="tin tức">
            </div>
            <h3>
              REVIEW Nước Hoa Hồng Facial Toner - Fresh Hydranation của nhà MỘC MIÊN
            </h3>
            <span>
              Lorem ipsum dolor sit amet. Ut officiis perferendis eos consequatur accusamus ut iure rerum et sequi sint qui saepe internos et eligendi autem aut obcaecati eveniet. Et sequi dolore vel suscipit praesentium sed molestias nobis qui error galisum et quia adipisci.
            </span>
          </div>
        </div>
         <!-- Bí quyết làm đẹp -->
         <div class='gap-4 mt-5 news-container row gap-md-0 d-none' data-category="bi-quyet">
          <div class='col-lg-4 col-12 col-md-6 news-items'>
            <div class='news-items-img'>
              <img src="<?= $urlThemeActive?>/assets/images/tt.png" alt="tin tức">
            </div>
            <h3>
              REVIEW Nước Hoa Hồng Facial Toner - Fresh Hydranation của nhà MỘC MIÊN
            </h3>
            <span>
              Lorem ipsum dolor sit amet. Ut officiis perferendis eos consequatur accusamus ut iure rerum et sequi sint qui saepe internos et eligendi autem aut obcaecati eveniet. Et sequi dolore vel suscipit praesentium sed molestias nobis qui error galisum et quia adipisci.
            </span>
          </div>
          <div class='col-lg-4 col-12 col-md-6 news-items'>
            <div class='news-items-img'>
              <img src="<?= $urlThemeActive?>/assets/images/tt.png" alt="tin tức">
            </div>
            <h3>
              REVIEW Nước Hoa Hồng Facial Toner - Fresh Hydranation của nhà MỘC MIÊN
            </h3>
            <span>
              Lorem ipsum dolor sit amet. Ut officiis perferendis eos consequatur accusamus ut iure rerum et sequi sint qui saepe internos et eligendi autem aut obcaecati eveniet. Et sequi dolore vel suscipit praesentium sed molestias nobis qui error galisum et quia adipisci.
            </span>
          </div>
          <div class='col-lg-4 col-12 col-md-6 news-items'>
            <div class='news-items-img'>
              <img src="<?= $urlThemeActive?>/assets/images/tt.png" alt="tin tức">
            </div>
            <h3>
              REVIEW Nước Hoa Hồng Facial Toner - Fresh Hydranation của nhà MỘC MIÊN
            </h3>
            <span>
              Lorem ipsum dolor sit amet. Ut officiis perferendis eos consequatur accusamus ut iure rerum et sequi sint qui saepe internos et eligendi autem aut obcaecati eveniet. Et sequi dolore vel suscipit praesentium sed molestias nobis qui error galisum et quia adipisci.
            </span>
          </div>
        </div>
      </div>

<?php getFooter(); ?>