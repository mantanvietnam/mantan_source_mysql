<?php 
    getHeader();
    global $settingThemes; 
?> 

    <!-- slider -->
    <!-- <div id="carouselExampleInterval" class="mx-mobile md:mx-6 lg:mx-16 xl:mx-20 carousel slide banner-slider" data-bs-ride="carousel">
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
    <div class="banner-slider"> 
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
    <div class='mx-mobile md:mx-6 lg:mx-16 xl:mx-20 d-xxl-flex recommend-container d-none'>
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

      <!-- sửa -->
      <div class='special-product'>
          <div class='sp-title'>Các sản phẩm nổi bật</div>
          <?php if (!empty($hot_product)): ?>
              <?php foreach ($hot_product as $product): ?>
                  <?php 
                      $link = '/product/' . htmlspecialchars($product->slug) . '.html'; 
                      $title = htmlspecialchars($product->title);
                      $shortTitle = mb_strimwidth($title, 0, 40, "...");
                  ?>
                  <div class='sp-container'>
                      <a href="<?php echo $link; ?>" class="sp-first">
                          <img src="<?php echo htmlspecialchars($product->image); ?>" alt="Sản phẩm nổi bật" class="w-12 h-12">
                          <span><?php echo $shortTitle; ?></span>
                      </a>
                      <div class='sp-first-btn'>
                          <a href="<?php echo htmlspecialchars($link); ?>">
                              <img src="<?php echo htmlspecialchars($urlThemeActive); ?>/assets/images/btn-ar.png" alt="Xem chi tiết">
                          </a>
                      </div>
                  </div>
              <?php endforeach; ?>
          <?php else: ?>
              <p>Hiện tại không có sản phẩm nổi bật nào.</p>
          <?php endif; ?>
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
            <div class="video-embed">
                <!-- Nhúng video YouTube bằng iframe -->
                <iframe width="291" height="160" src="<?php echo @$settingThemes['video_1']; ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
      </div>
    </div>
    </div>

    <!-- chính sách -->
     <div class='delivary-container'>
      <div class='mx-mobile md:mx-6 lg:mx-16 xl:mx-20 delivary-container-2 justify-content-md-between'>
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

      <!-- sửa -->
     <!-- danh mục sản phẩm -->
      <div class='mx-mobile md:mx-6 lg:mx-16 xl:mx-20 category-container'>
        <div class='list-category-header'>
          <span><span class='color-green'>DANH MỤC</span> SẢN PHẨM</span>
          <a href="/categories" class='more-btn'>
            <div class=''>Xem thêm</div>
            <img src="<?php echo $urlThemeActive; ?>/assets/images/arr.png" alt="">
          </a>
        </div>
        <div class='gap-1 row'>
          <?php if (!empty($category_product)): ?>
            <?php foreach ($category_product as $category): ?>
              <?php $link = '/category/' . htmlspecialchars($category->slug) . '.html'; ?>
                <a href="<?php echo $link; ?>" class="col category-item">
                  <div class='category-item-img'>
                    <img src="<?php  echo htmlspecialchars($category->image);  ?>" alt="tinhchatdinhduong">
                  </div>
                  <span><?php  echo htmlspecialchars($category->name); ?></span>
                </a>
            <?php endforeach; ?>
          <?php else: ?>
              <p>Hiện tại không có danh mục nào.</p>
          <?php endif; ?>
        </div>
      </div>

      <!-- câu chuyện -->
      <div class='mx-mobile md:mx-6 lg:mx-16 xl:mx-20 gap-4 story-container flex-lg-row flex-column gap-lg-0 align-items-lg-start'>
      <div class='ceo-img'>
        <img src="<?php echo @$settingThemes['image_story'] ?>" alt="ceo">
      </div>
      <div class='story-content'>
        <span><span class='color-green'>CÂU CHUYỆN</span> MỘC MIÊN</span>
        <div class='graph-containe'>
          <div class='text-style'><?php echo @$settingThemes['big_content']; ?></div>
          <div class='text-style-2'><?php echo @$settingThemes['small_content']; ?></div>
        </div>
        <div class='intro-btn'>
          <a href="<?php echo @$settingThemes['link_story'] ?>" class=''>Tìm hiểu thêm</a>
        </div>
      </div>
      </div>

      <!-- Uy tín -->
      <div class='mx-mobile md:mx-6 lg:mx-16 xl:mx-20 legit-container'>
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
              <img src="<?php echo @$settingThemes['legit_icon']; ?>" alt="">
              <div class='legit-item-text'><?php echo @$settingThemes['legit_content_1']; ?></div>
            </div>
            <div class='legit-item'>
              <img src="<?php echo @$settingThemes['legit_icon']; ?>" alt="">
              <div>
                <div class='legit-item-text'><?php echo @$settingThemes['legit_content_2']; ?></div>
              </div>
            </div>
            <div class='legit-item'>
              <img src="<?php echo @$settingThemes['legit_icon']; ?>" alt="">
              <div class='legit-item-text'><?php echo @$settingThemes['legit_content_3']; ?></div>
            </div>
            <div class='legit-item'>
              <img src="<?php echo @$settingThemes['legit_icon']; ?>" alt="">
              <div class='legit-item-text'><?php echo @$settingThemes['legit_content_4']; ?></div>
            </div>
            <div class='legit-item'>
              <img src="<?php echo @$settingThemes['legit_icon']; ?>" alt="">
              <div class='legit-item-text'><?php echo @$settingThemes['legit_content_5']; ?></div>
            </div>
            <div class='legit-item'>
              <img src="<?php echo @$settingThemes['legit_icon']; ?>" alt="">
              <div class='legit-item-text'><?php echo @$settingThemes['legit_content_6']; ?></div>
            </div>
          </div>
        </div>
        <iframe class="d-lg-block d-none produce-video" width="399" height="236" 
                src="<?php echo @$settingThemes['video_2']; ?>" 
                frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                allowfullscreen>
        </iframe>
      </div>

      <!-- sửa -->
      <!-- sản phẩm bán chạy -->
      <div class='mx-mobile md:mx-6 lg:mx-16 xl:mx-20 mt-5 bestsell-container'>
        <div class='list-category-header'>
          <span><span class='color-green'>SẢN PHẨM</span> ĐƯỢC QUAN TÂM NHẤT</span>
          <a href="/categories" class='more-btn'>
            <div class=''>Xem thêm</div>
            <img src="<?= $urlThemeActive?>/assets/images/arr.png" alt="">
          </a>
        </div>
        <div class='row bestsell-list-container'>
          <?php if (!empty($best_selling_products)): ?>
            <?php foreach ($best_selling_products as $seller_product): ?>
              <?php $link = '/product/' . htmlspecialchars($seller_product->slug) . '.html'; ?>
              <!-- product cart -->
              <a href=<?= $link ?> class="col bestsell-product-container">
                <div class='bestsell-product-image'>
                  <img src="<?php echo htmlspecialchars($seller_product->image); ?>" alt="">
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
                  <span><?php echo htmlspecialchars($seller_product->title); ?></span>
                </div>
                <div class='bestsell-product-price-container'>
                  <div class='bestsell-product-current-price'>
                      <?php echo number_format($seller_product->price, 0, ',', '.') . ' VNĐ'; ?>
                  </div>
                  <div class='bestsell-product-old-price'>
                      <?php echo number_format($seller_product->price_old, 0, ',', '.') . ' VNĐ'; ?>
                  </div>
                </div>
                <div class='bestsell-product-selling'>
<<<<<<< HEAD
                <span><?php echo $seller_product->view . ' Lượt xem'; ?></span>
=======
                <span><?php echo $seller_product->view . ' Lượt truy cập'; ?></span>
>>>>>>> 59318f8831ad034e7ef2a13df396ebf14f754f0b
                  <!-- <div>
                    <img src="<?= $urlThemeActive?>/assets/images/tym.png" alt="">
                  </div> -->
                </div>
              </a>
              <?php endforeach; ?>
          <?php else: ?>
              <p>Hiện tại không có danh mục nào.</p>
          <?php endif; ?>
        </div>
      </div>

      <!-- Hướng dẫn sử dụng -->
      <div class='mx-mobile md:mx-6 lg:mx-16 xl:mx-20 gap-3 mt-5 instruction-container d-none d-xxl-flex justify-content-center align-items-center'>
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
      <div class='mx-mobile md:mx-6 lg:mx-16 xl:mx-20 mt-5 container-combo'>
        <div class='list-category-header'>
          <span>SẢN PHẨM THEO <span class='color-green'>COMBO</span></span>
          <a href="/categories" class='more-btn'>
            <div class=''>Xem thêm</div>
            <img src="<?= $urlThemeActive?>/assets/images/arr.png" alt="">
          </a>
        </div>
        <div class='row bestsell-list-container'>
          <?php if (!empty($comboProducts)): ?>
            <?php foreach ($comboProducts as $comboProduct): ?>
              <?php $link = '/product/' . htmlspecialchars($comboProduct->slug) . '.html'; ?>
              <!-- product cart -->
              <a href=<?= $link ?> class="col bestsell-product-container">
                <div class='bestsell-product-image'>
                  <img src="<?php echo htmlspecialchars($comboProduct->image); ?>" alt="">
                </div>
                
                <div class='bestsell-product-title'>
                  <span><?php echo htmlspecialchars($comboProduct->title); ?></span>
                </div>
                <div class='bestsell-product-price-container'>
                  <div class='bestsell-product-current-price'><?php echo number_format($comboProduct->price, 0, ',', '.') . ' VNĐ'; ?></div>
                  <div class='bestsell-product-old-price'><?php echo number_format($comboProduct->price_old, 0, ',', '.') . ' VNĐ'; ?></div>
                </div>
                <div class='bestsell-product-selling'>
<<<<<<< HEAD
                <span><?php echo $seller_product->view . ' Lượt xem'; ?></span>
=======
                <span><?php echo $seller_product->view . ' Lượt truy cập'; ?></span>
>>>>>>> 59318f8831ad034e7ef2a13df396ebf14f754f0b
                  <!-- <div class="star-rating">
                    <div class="star filled">★</div>
                    <div class="star filled">★</div>
                    <div class="star filled">★</div>
                    <div class="star half">★</div>
                    <div class="star">★</div>
                  </div>
                  <div class='product-tym'>
                    <img src="<?= $urlThemeActive?>/assets/images/tym.png" alt="tym">
                  </div> -->
                </div>
              </a>
              <?php endforeach; ?>
          <?php else: ?>
              <p>Hiện tại không có danh mục nào.</p>
          <?php endif; ?>
        </div>
      </div>

      <!-- bộ sưu tập mơi -->
       <div class='mx-mobile md:mx-6 lg:mx-16 xl:mx-20 mt-5 new-collection-container'>
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
       <div class='mx-mobile md:mx-6 lg:mx-16 xl:mx-20 mt-5 event-container'>
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
      <div class='mx-mobile md:mx-6 lg:mx-16 xl:mx-20 mt-5 new-section-container'>
        <div class='list-category-header'>
          <span><span class='color-green'>TIN TỨC</span> TỪ MỘC MIÊN</span>
          <a class='more-btn' href="/posts">
            <div class=''>Xem thêm</div>
            <img src="<?= $urlThemeActive?>/assets/images/arr.png" alt="">
          </a>
        </div>

        <div class='gap-4 mt-5 news-container row gap-md-0'>
            <?php 
                if(!empty($listDatatop)){
                    foreach ($listDatatop as $key => $value) {
                        $link = '/'.$value->slug.'.html';

                        echo '<div class="col-lg-4 col-12 col-md-6 news-items">
                                <div class="news-items-img">
                                    <a href="'.$link.'"><img src="'.$value->image.'" alt=""></a>
                                </div>
                                <a href="'.$link.'"><h3>'.$value->title.'</h3></a>
                                <span>'.$value->description.'</span>
                          </div>';
                        }   
                      }
                ?>
        </div>
      </div>

<?php getFooter(); ?>