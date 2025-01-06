<?php  
    global $urlThemeActive;
    global $settingThemes;
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Mộc Miên</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />

    <link rel="stylesheet" href="<?php echo @$urlThemeActive; ?>/styles/globle.css" />
    <link rel="stylesheet" href="<?php echo @$urlThemeActive; ?>/styles/index.css" />
    <link rel="stylesheet" href="<?php echo @$urlThemeActive; ?>/styles/dathang.css" />
    <link rel="stylesheet" href="<?php echo @$urlThemeActive; ?>/styles/chitietSP.css" />
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      type="text/css"
      href="starability-minified/starability-all.min.css"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
    />
  </head>
  <body>
    <!-- contact -->
    <div class="content-center text-white bg-green contact">
      <span class="">Hotline Mộc Miên: <?php echo @$settingThemes['title_main'];?></span>
    </div>
    <!-- responsive search -->
    <div class="container pt-4 d-sm-none d-flex input-group">
      <input
        type="text"
        class="form-control"
        placeholder="Tìm kiếm..."
        aria-label="Search input"
        aria-describedby="button-search"
      />
      <button
        class="btn btn-primary bg-green search-btn"
        type="button"
        id="button-search"
      >
        <i class="fas fa-search"></i>
        <!-- Icon kính lúp -->
      </button>
    </div>

    <!-- header -->
    <div class="mx-mobile md:mx-6 lg:mx-16 xl:mx-28 header-container">
      <!-- logo -->
      <div>
        <img src="<?php echo @$urlThemeActive; ?>/assets/images/logo.png" alt="logo" />
      </div>
      <!-- Thanh tìm kiếm với icon kính lúp -->
      <div class="d-sm-flex d-none input-group header-search-container">
        <input
          type="text"
          class="form-control"
          placeholder="Tìm kiếm..."
          aria-label="Search input"
          aria-describedby="button-search"
        />
        <button
          class="btn btn-primary bg-green search-btn"
          type="button"
          id="button-search"
        >
          <i class="fas fa-search"></i>
          <!-- Icon kính lúp -->
        </button>
      </div>
      <!-- điều hướng -->
      <div class="d-lg-flex d-none header-nav">
        <a class="nav-item">
          <img src="<?php echo @$urlThemeActive; ?>/assets/images/system-icon.png" alt="" />
          <span>Hệ thống cửa hàng</span>
        </a>
        <a class="nav-item" href="/cart">
          <img src="<?php echo @$urlThemeActive; ?>/assets/images/card-icon.png" alt="" />
          <span>Giỏ hàng</span>
        </a>
        <div class="dropdown nav-item">
          <button
            class="btn btn-secondary drop-menu-2"
            type="button"
            data-bs-toggle="dropdown"
            aria-expanded="false"
          >
            <img src="<?php echo @$urlThemeActive; ?>/assets/images/user-icon.png" alt="" />
            <span>Tài khoản</span>
            <img src="<?php echo @$urlThemeActive; ?>/assets/images/a-down.png" alt="" />
          </button>
          <ul class="dropdown-menu">
            <li>
              <a class="dropdown-item" href="#">
                <span>Thông tin tài khoản</span>
              </a>
            </li>
            <li>
              <a class="dropdown-item" href="#">
                <span>Đăng xuất</span>
              </a>
            </li>
          </ul>
        </div>
      </div>

      <!-- dropdowwn -->
      <div class="dropdown d-lg-none d-block">
        <button
          class="btn btn-secondary drop-menu"
          type="button"
          data-bs-toggle="dropdown"
          aria-expanded="false"
        >
          <img src="<?php echo @$urlThemeActive; ?>/assets/images/nav-menu.png" alt="" />
          <span>Menu</span>
        </button>
        <ul class="dropdown-menu pr-[20px]">
          <li>
            <a class="dropdown-item nav-item" href="#">
              <img src="<?php echo @$urlThemeActive; ?>/assets/images/system-icon.png" alt="" />
              <span>Hệ thống cửa hàng</span>
            </a>
          </li>
          <li>
            <a class="dropdown-item nav-item" href="#">
              <img src="<?php echo @$urlThemeActive; ?>/assets/images/card-icon.png" alt="" />
              <span>Giỏ hàng</span>
            </a>
          </li>
          <li>
            <a class="dropdown-item nav-item" href="#">
              <img src="<?php echo @$urlThemeActive; ?>/assets/images/user-icon.png" alt="" />
              <span>Tài khoản</span>
            </a>
          </li>
        </ul>
      </div>
    </div>

    <!-- điều hướng -->
    <div class="content-center bg-green navigation">
      <div class="container nav-container">
        <?php 
                $menu = getMenusDefault();
            ?>
            <?php if(!empty($menu)): ?>
              <?php foreach($menu as $key => $value): ?>
                <?php if(!empty($value->sub)): ?>
                      <li class="nav-item dropdown">
                          <a class="nav-link dropdown-toggle" href="javascript:void(0);" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                              <span><?php echo $value->name; ?></span>
                          </a>
                          <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                              <?php foreach ($value->sub as $sub): ?>
                              <li><a class="dropdown-item" href="<?php echo $sub->link; ?>"><?php echo $sub->name; ?></a></li>
                              <?php endforeach; ?>
                          </ul> 
                      </li>
                  <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $value->link; ?>"><span><?php echo $value->name; ?></span></a>
                    </li>
                <?php endif; ?>
              <?php endforeach; ?>
            <?php endif; ?> 
      </div>
    </div>

    <!-- địa chỉ trang -->
    <div class="bg-gray-100">
      <div
        class="gap-3 py-4 mx-mobile md:mx-6 lg:mx-16 xl:mx-28 d-flex align-items-center"
      >
        <div>
          <img src="<?php echo @$urlThemeActive; ?>/assets/images/Stroke.png" alt="" />
        </div>
        <span>Trang chủ</span>
        <span>/</span>
        <span>Danh mục sản phẩm</span>
        <span>/</span>
        <span class="current-page fw-bolder text-[18px]"><?php echo $product->title;?></span>
      </div>
    </div>

    <!-- thông tin sản phẩm -->
    <div
      class="flex flex-col mt-4 mb-10 mx-mobile md:mx-6 lg:mx-16 lg:flex-row xl:mx-28"
    >
      <!-- Phần 1: 3 ảnh dọc -->
      <div class="hidden xl:flex w-[15%]">
        <div class="flex flex-col space-y-4 thumbnails-container">
          <div class="thumbnail">
              <?php 
              if(!empty($product->images)){
                  foreach ($product->images as $images) {
                      echo '
                              <img src="'.$images.'" class="img-fluid thumbnail-image rounded-xl">
                            ';
                        }
                    }
              ?>
          </div>
        </div>
      </div>
      <!-- Phần 2: 1 ảnh lớn -->
      <div class="w-full lg:w-[64%] xl:w-[49%]">
        <div class="xl:ml-2">
          <div class="thumbnail h-100">
            <img
              id="main-image"
              alt=""
              class="img-fluid rounded-xl"
              src="<?php echo @$urlThemeActive; ?>/assets/images/trisacto.png"
            />
          </div>
        </div>
      </div>

      <!-- Phần 3: Thông tin sản phẩm -->
      <div class="mt-4 lg:ml-6 lg:mt-0">
        <h5 class="font-bold text-success">Chăm Sóc Da</h5>
        <h2 class="my-2 text-xl font-bold">
          <?php echo $product->title;?>
        </h2>
        <div class="d-flex align-items-center">
          <div class="me-2">
            <i class="fas fa-star text-warning"> </i>
            <i class="fas fa-star text-warning"> </i>
            <i class="fas fa-star text-warning"> </i>
            <i class="fas fa-star text-warning"> </i>
            <i class="fas fa-star text-warning"> </i>
          </div>
          <span>| Xuất xứ: <strong><?php echo $manufacturer->name;?></strong></span>
        </div>
        <p class="mt-2">Tình trạng: <strong><?php echo ($product->quantity > 0)?'Còn hàng':'Hết hàng';?></strong></p>
        <p class="my-2 price d-flex justify-content-between">
          <span><?php echo ($product->price > 0)?number_format($product->price).'đ':'Liên hệ';?> </span><span class="old-price"><?php echo ($product->price_old > 0)?number_format($product->price_old).'đ':'';?></span>
        </p>

        <div
          class="flex flex-col my-4 text-white countdown sm:flex-row justify-content-between align-items-center"
        >
          <span class="">BLACK FRIDAY SIÊU SALE</span>
          <div class="mt-2 sm:mt-0">
            <span class="count-number">01</span>
            <span class="count-number">23</span>
            <span class="count-number">11</span>
            <span class="count-number">02</span>
          </div>
        </div>

        <div
          class="mt-4 w-100 d-flex align-items-center justify-content-between"
        >
          <div class="quantity-control">
            <button type="button" class="quantity-control-btn" id="decrease" onclick="minusQuantity();">
              -
            </button>
            <span id="quantity">1</span>
            <button type="button" class="quantity-control-btn" id="increase" onclick="plusQuantity();">
              +
            </button>
          </div>
          <button type="button" class="btn btn-buy-now w-50" onclick="addProductCart(<?php echo $product->id;?>)">MUA NGAY</button>
          <div class="hidden sm:flex">
            <div class="icon-button hover:scale-105 ease-in">
              <img src="<?php echo @$urlThemeActive; ?>/assets/images/iconShopWhite.png" alt="" width="20" />
            </div>
            <div class="icon-button hover:scale-105 cursor-pointer ease-in">
              <img
                src="<?php echo @$urlThemeActive; ?>/assets/images/iconHeartWhite.png"
                alt=""
                width="20"
              />
            </div>
          </div>
        </div>
        <div class="flex items-center justify-center mt-4 sm:hidden">
          <div class="icon-button hover:scale-105 cursor-pointer ease-in">
            <img src="<?php echo @$urlThemeActive; ?>/assets/images/iconShopWhite.png" alt="" width="20" />
          </div>
          <div class="icon-button hover:scale-105 ease-in">
            <img src="<?php echo @$urlThemeActive; ?>/assets/images/iconHeartWhite.png" alt="" width="20" />
          </div>
        </div>
        <div class="mt-3 row g-2">
          <div class="col-sm-6 d-flex align-items-center">
            <i class="fas fa-truck text-success me-2"></i>
            <span><strong>MIỄN PHÍ GIAO HÀNG</strong> 24h</span>
          </div>
          <div class="col-sm-6 d-flex align-items-center">
            <i class="fas fa-check-circle text-success me-2"></i>
            <span>Cam kết <strong>HÀNG CHÍNH HÃNG</strong></span>
          </div>
          <div class="col-sm-6 d-flex align-items-center">
            <i class="fas fa-undo text-success me-2"></i>
            <span>Đổi/trả hàng trong <strong>7 NGÀY</strong></span>
          </div>
          <div class="col-sm-6 d-flex align-items-center">
            <i class="fas fa-shield-alt text-success me-2"></i>
            <span>Nguồn gốc xuất xứ <strong>ĐẢM BẢO UY TÍN</strong></span>
          </div>
        </div>
      </div>
    </div>

    <!-- sản phẩm liên quan -->
    <div class="flex items-center justify-center py-10 bg-gray-100">
      <div class="mx-mobile md:mx-6 lg:mx-0 w-full lg:w-[80%] p-4 bg-white border-1 border-[#F2C538] rounded-lg">
        <h2 class="mb-4 text-[18px] leading-[24px] font-semibold">Sản phẩm liên quan</h2>
            <?php
                if(!empty($other_product)){
                  foreach ($other_product as $key => $value) {
                                                    
                    if(!empty($product->price)){
                        $price = number_format($product->price).'đ';
                    }else{
                        $price = 'Giá liên hệ';
                    }

                    echo '<div class="flex flex-col items-center justify-between mb-4 sm:flex-row">
                            <div class="flex items-center">
                                <img src="'.$value->image.'" alt="" class="w-12 h-12 mr-4 rounded" height="50" width="50">
                                <p class="text-sm lg:w-[70%] xl:w-full description">'.$value->title.'</p>
                            </div>
                            <div class="flex items-center mt-2 sm:mt-0">
                                <div class="flex items-center justify-center w-10 h-10 p-2 border border-gray-500 rounded-full hover:scale-105 cursor-pointer ease-in">
                                  <img src="<?php echo @$urlThemeActive; ?>assets/images/iconShopWhite.png" alt="" class="w-6 h-6">
                                </div>
                                <button class="px-4 py-2 ml-4 text-sm font-semibold text-white bg-green-600 rounded-full whitespace-nowrap hover:opacity-85">
                                    MUA NGAY
                                </button>
                            </div>
                        </div>';
                    }
                }
            ?>
        </div>
    </div>

    <!-- Về sản phẩm -->
    <div class="text-gray-800 bg-white">
      <div class="py-4 mx-mobile md:mx-6 lg:mx-16 xl:mx-28">
        <h1 class="text-[28px] font-bold leading-[36px] mt-[30px] mb-[35px]">
          Về <span class="text-green-600">sản phẩm</span>
        </h1>
        <div
          class="flex mt-4 space-x-4 overflow-x-auto md:overflow-visible scroll-smooth whitespace-nowrap"
        >
          <button
            class="px-4 py-2 text-white bg-blue-900 rounded-full active"
            id="btn-info"
          >
            Thông tin sản phẩm
          </button>
          <button class="px-4 py-2 text-gray-400" id="btn-specs">
            Thông số sản phẩm
          </button>
          <button class="px-4 py-2 text-gray-400" id="btn-reviews">
            Đánh giá & Nhận xét
          </button>
        </div>
        <div class="mt-4 text-gray-400" id="btn-info">
          <?php echo $product->info;?>
        </div>
      </div>
    </div>

    <!-- sản phẩm bán chạy -->
    <div class="mt-5 bestsell-container">
      <div class="mx-mobile md:mx-6 lg:mx-16 xl:mx-28 list-category-header">
        <span>SẢN PHẨM <span class="color-green">MỚI</span></span>
        <a class="more-btn">
          <div class="">Xem thêm</div>
          <img src="<?php echo @$urlThemeActive; ?>/assets/images/arr.png" alt="" />
        </a>
      </div>
      <div class="row bestsell-list-container">
        <?php 
            if(!empty($new_product)){
                foreach ($new_product as $product) {
                $link = '/product/'.$product->slug.'.html';

                $giam = 0;
                if(!empty($product->price_old) && !empty($product->price)){
                    $giam = 100 - 100*$product->price/$product->price_old;
                }

                if($giam>0){
                    $giam = '
                        <div class="item-sale">
                            <span><i class="fa-solid fa-bolt"></i> -'.round($giam).'%</span>
                        </div>';
                    }else{
                      $giam = '';
                    }

                if(!empty($product->price)){
                    $price = number_format($product->price).'đ';
                }else{
                    $price = 'Giá liên hệ';
                }

                if(!empty($product->price_old)){
                    $price_old = number_format($product->price_old).'đ';
                }else{
                    $price_old = '';
                }

                echo '  <div class="col bestsell-product-container">
                            <div class="bestsell-product-image">
                                <a href="'.$link.'"><img src="'.$product->image.'" alt=""></a>
                                '.$giam.' 
                            </div>
                            <div class="bestsell-product-title">
                                <span>'.$product->title.'</span>
                            </div>
                            <div class="bestsell-product-price-container">
                                <div class="bestsell-product-current-price">'.$price.'</div>
                                <div class="bestsell-product-old-price">'.$price_old.'</div>
                            </div>
                            <div class="bestsell-product-selling">
                                <div class="star-rating">
                                    <div class="star filled">★</div>
                                    <div class="star filled">★</div>
                                    <div class="star filled">★</div>
                                    <div class="star half">★</div>
                                    <div class="star">★</div>
                                </div>
                            </div>
                        </div>';
                      }
                  }
            ?>
    </div>
  </div>

    <!-- footer -->
    <div class="mt-5 footer-container">
      <div class="px-4 pt-5 pb-5 mx-mobile md:mx-6 lg:mx-16 xl:mx-28">
        <div class="row">
          <div
            class="col-lg-3 col-12 footer-frist-container d-flex flex-column"
          >
            <div class="gap-3 d-flex align-items-center">
              <div><img src="<?php echo @$urlThemeActive; ?>/assets/images/logo.png" alt="logo" /></div>
            </div>
            <div class="mt-4 mb-3 bestnew-info">
              <div class="gap-3 bn-contacts">
                <div class='bn-contact'>
                    <span><?php echo @$settingThemes['footer_address']; ?></span>
                  </div>
                  <div class='bn-contact'>
                    <span><?php echo @$settingThemes['footer_email']; ?></span>
                  </div>
                  <div class='bn-contact'>
                    <span><?php echo @$settingThemes['footer_phone_number']; ?></span>
                  </div>
              </div>
            </div>
          </div>
          <div
            class="gap-3 text-white col-lg-3 col-6 d-flex flex-column footer-mid"
          >
            <h2>VỀ MỘC MIÊN</h2>
            <span>Câu chuyện thương hiệu</span>
            <span>Về chúng tôi</span>
            <span>Liên hệ</span>
          </div>
          <div
            class="gap-3 text-white col-lg-3 col-6 d-flex flex-column footer-mid"
          >
            <h2>CHÍNH SÁCH</h2>
            <span>Chính sách và quy định chung</span>
            <span>Chính sách và giao nhận thanh toán</span>
            <span>Chính sách đổi trả</span>
            <span>Điều khoản sử dụng</span>
          </div>
          <div
            class="gap-3 text-white col-lg-3 col-6 d-flex flex-column footer-mid"
          >
            <h2>TẠI MỘC MIÊN</h2>
            <span>Quyền lợi thành viên</span>
            <span>Thông tin thành viên</span>
            <span>Theo dõi đơn hàng</span>
            <span>Hướng dẫn mua hàng Online</span>
            <div class='gap-2 d-flex'>
                <a href="<?php echo $settingThemes['instagram_link'] ?>" class='social-icon'><img src="<?= $urlThemeActive?>/assets/images/insta.png" alt="insta"></a>
                <a href="<?php echo $settingThemes['facebook_link'] ?>" class='social-icon'><img src="<?= $urlThemeActive?>/assets/images/fb.png" alt="fb"></a>
                <a href="<?php echo $settingThemes['linkedin_link'] ?>" class='social-icon'><img src="<?= $urlThemeActive?>/assets/images/linkedin.png" alt="linkedin"></a>
                <a href="<?php echo $settingThemes['youtube_link'] ?>" class='social-icon'><img src="<?= $urlThemeActive?>/assets/images/yt.png" alt="youtube"></a>
              </div>
          </div>
        </div>
        <h2 class="footer-slogant color-green">MỘC MIÊN - ĐẸP THUẦN NHIÊN!</h2>
      </div>
    </div>
  </body>

  <script type="text/javascript">
    function plusQuantity()
    {
        let quantity = parseInt($('#quantity_buy').val());
        quantity++;
        $('#quantity_buy').val(quantity);
    }

    function minusQuantity()
    {
        let quantity = parseInt($('#quantity_buy').val());
        quantity--;
        if(quantity<1) quantity=1;
        $('#quantity_buy').val(quantity);
    }

    function addProductCart(idProduct)
    {
        let quantity = parseInt($('#quantity_buy').val());

        $.ajax({
            method: "GET",
            url: "/addProductToCart/?id_product="+idProduct+"&quantity="+quantity
        })
        .done(function( msg ) {
            window.location = '/cart';
        });
    }
</script>

  <script src="<?php echo @$urlThemeActive; ?>/scripts/index.js"></script>

  <script
    src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"
  ></script>
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
    crossorigin="anonymous"
  ></script>
</html>