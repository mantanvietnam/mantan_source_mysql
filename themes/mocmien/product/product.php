<?php  
getHeader();
    global $urlThemeActive;
    global $settingThemes;
?>
<style>
    #quantity_buy {
    width: 50px; 
    height: 30px;
    font-size: 14px;
    padding: 5px;
    text-align: center;
    }

    .count-sale {
      display: inline-block;
      background-color: white; /* Màu nền trắng */
      padding: 10px 15px; /* Khoảng cách bên trong */
      margin: 0 5px; /* Khoảng cách giữa các số */
      border-radius: 12px; /* Bo tròn */
      font-size: 1.5rem; /* Kích thước chữ */
      font-weight: bold; /* Đậm chữ */
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Tạo bóng nhẹ */
      color: black;
    }
</style>
    <!-- địa chỉ trang -->
    <div class="bg-gray-100">
      <div
        class="gap-3 py-4 mx-mobile md:mx-6 lg:mx-16 xl:mx-28 d-flex align-items-center"
      >
        <div>
          <img src="<?php echo @$urlThemeActive; ?>/assets/images/Stroke.png" alt="" />
        </div>
        <a href="/">Trang chủ</a>
        <span>/</span>
        <a href="/categories">Danh mục sản phẩm</a>
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
              alt="Main Image"
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
          <span class=""><?php echo @$settingThemes['sale_title']; ?></span>
          <div class="mt-2 sm:mt-0">
            <span class="count-sale" id="days"><?php echo @$settingThemes['day']; ?></span>
            <span class="count-sale" id="hours"><?php echo @$settingThemes['hours']; ?></span>
            <span class="count-sale" id="minutes"><?php echo @$settingThemes['minutes']; ?></span>
            <span class="count-sale" id="seconds"><?php echo @$settingThemes['seconds']; ?></span>
          </div>
        </div>

        <div
          class="mt-4 w-100 d-flex align-items-center justify-content-between"
        >
          <div class="quantity-control">
            <button type="button" class="quantity-control-btn" id="decrease" onclick="minusQuantity();">
              -
            </button>
            <input id="quantity_buy" value="1" min="1" readonly>
            <button type="button" class="quantity-control-btn" id="increase" onclick="plusQuantity();">
              +
            </button>
          </div>
          <button type="button" class="btn btn-buy-now w-50" onclick="addProductCart(<?php echo $product->id;?>)">MUA NGAY</button>
          <div class="hidden sm:flex">
            <div class="icon-button hover:scale-105 ease-in">
              <img src="<?php echo @$urlThemeActive; ?>/assets/images/iconShopWhite.png" alt="" width="20" />
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
        if (!empty($other_product)) {
            foreach ($other_product as $key => $value) {
                // Kiểm tra giá sản phẩm
                if (!empty($value->price)) {
                    $price = number_format($value->price) . 'đ';
                } else {
                    $price = 'Giá liên hệ';
                }
                $link = '/product/' . htmlspecialchars($product->slug) . '.html';

                // Hiển thị sản phẩm liên quan
                echo '
                    <div class="flex flex-col items-center justify-between mb-4 sm:flex-row">
                        <div class="flex items-center">
                            <img src="' . $value->image . '" alt="' . $value->title . '" class="w-12 h-12 mr-4 rounded" height="50" width="50">
                            <p class="text-sm lg:w-[70%] xl:w-full description">' . $value->title . '</p>
                        </div>
                        <div class="flex items-center mt-2 sm:mt-0">
                            <div class="flex items-center justify-center w-10 h-10 p-2 border border-gray-500 rounded-full hover:scale-105 cursor-pointer ease-in">
                                <img src="' . $urlThemeActive . 'assets/images/iconShopWhite.png" alt="Shop Icon" class="w-6 h-6">
                            </div>
                            <a href="'.$link.'" class="px-4 py-2 ml-4 text-sm font-semibold text-white bg-green-600 rounded-full whitespace-nowrap hover:opacity-85">
                                MUA NGAY
                            </a>
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
            <div class="flex mt-4 space-x-4 overflow-x-auto md:overflow-visible scroll-smooth whitespace-nowrap">
                <button
                    class="px-4 py-2 text-white bg-blue-900 rounded-full active"
                    id="btn-info"
                    onclick="showTab('info')"
                >
                    Thông tin sản phẩm
                </button>
                <button 
                    class="px-4 py-2 text-gray-400"
                    id="btn-specs"
                    onclick="showTab('specs')"
                >
                    Đặc điểm nổi bật
                </button>
                <button 
                    class="px-4 py-2 text-gray-400"
                    id="btn-reviews"
                    onclick="showTab('reviews')"
                >
                    Đánh giá & Nhận xét
                </button>
            </div>

            <div class="mt-4 text-gray-400 tab-content" id="info">
                <?php echo $product->info; ?>
            </div>
            <div class="mt-4 text-gray-400 tab-content hidden" id="specs">
                <?php echo $product->rule; ?>
            </div>
            <div class="mt-4 text-gray-400 tab-content hidden" id="reviews">
            </div>
        </div>
    </div>


    <!-- footer -->
    <?php getFooter(); ?>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

    function showTab(tabId) {
    // Ẩn tất cả các tab
    const tabs = document.querySelectorAll('.tab-content');
    tabs.forEach(tab => {
        tab.classList.add('hidden');
    });

    // Loại bỏ lớp 'active' khỏi tất cả các nút
    const buttons = document.querySelectorAll('button');
    buttons.forEach(button => {
        button.classList.remove('active');
        button.classList.add('text-gray-400');
    });

    // Hiển thị tab được chọn
    const activeTab = document.getElementById(tabId);
    activeTab.classList.remove('hidden');

    // Thêm lớp 'active' cho nút đang được nhấn
    const activeButton = document.querySelector(`#btn-${tabId}`);
    activeButton.classList.add('active');
    activeButton.classList.remove('text-gray-400');
}

 // Nhận giá trị ban đầu từ PHP
 let days = parseInt(document.getElementById('days').textContent);
  let hours = parseInt(document.getElementById('hours').textContent);
  let minutes = parseInt(document.getElementById('minutes').textContent);
  let seconds = parseInt(document.getElementById('seconds').textContent);

  console.log(days)
  console.log(hours)
  console.log(minutes)
  console.log(seconds)

  // Hàm cập nhật hiển thị thời gian đếm ngược
  function updateCountdown() {
    if (seconds > 0) {
      seconds--;
    } else if (minutes > 0) {
      minutes--;
      seconds = 59;
    } else if (hours > 0) {
      hours--;
      minutes = 59;
      seconds = 59;
    } else if (days > 0) {
      days--;
      hours = 23;
      minutes = 59;
      seconds = 59;
    } else {
      // Khi hết thời gian, dừng đếm ngược
      clearInterval(countdownInterval);
      alert('Countdown completed!');
    }

    // Cập nhật giá trị hiển thị trên giao diện
    document.getElementById('days').textContent = days;
    document.getElementById('hours').textContent = hours.toString().padStart(2, '0');
    document.getElementById('minutes').textContent = minutes.toString().padStart(2, '0');
    document.getElementById('seconds').textContent = seconds.toString().padStart(2, '0');
  }

  // Gọi hàm updateCountdown mỗi giây
  const countdownInterval = setInterval(updateCountdown, 1000);

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