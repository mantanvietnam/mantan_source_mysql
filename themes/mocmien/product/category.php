<?php
	global $urlThemeActive; 
	getHeader();
?>
<style>
    /* Container chính cho phân trang */
    .pagination-container {
        display: flex;
        justify-content: center; /* Căn giữa */
        margin-top: 20px;
    }

    /* Các phần tử trang */
    .page-number {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 30px; /* Đặt kích thước cho mỗi nút */
        height: 30px;
        background-color: #f0f0f0;
        border-radius: 50%; /* Tạo hình tròn */
        text-align: center;
        margin: 0 5px;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.3s ease;
    }

    /* Hiệu ứng hover cho các nút phân trang */
    .page-number:hover {
        background-color: #4CAF50; /* Màu xanh khi hover */
        color: white; /* Màu chữ trắng */
        transform: scale(1.1); /* Phóng to nút khi hover */
    }

    /* Nút trang đang được chọn (active) */
    .page-number.active {
        background-color: #4CAF50; /* Màu nền xanh cho nút active */
        color: white; /* Màu chữ trắng */
        font-weight: bold;
    }

    /* Liên kết trong các nút trang */
    .page-number a {
        text-decoration: none;
        color: inherit;
        font-size: 14px;
        font-weight: normal;
    }

    /* Điều chỉnh cho nút phân trang khi không được chọn */
    .page-number:not(.active) a {
        color: #333;
    }

    /* Thêm khoảng cách giữa các phần tử */
    .page-number:not(:last-child) {
        margin-right: 8px;
    }

    /* Thêm phần margin cho container để tránh chồng lấn */
    .container.mt-4 {
        margin-top: 40px;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .page-number {
            width: 25px; /* Điều chỉnh kích thước cho màn hình nhỏ */
            height: 25px;
        }
    }
</style>
	<!-- địa chỉ trang -->
    <div class='container gap-3 d-flex align-items-center location-page'>
      <div>
        <img src="<?php echo @$urlThemeActive; ?>assets/images/Stroke.png" alt="">
      </div>
      <span><a href="/">Trang chủ</a></span>
      <span>/</span>
      <span class='current-page'><?php echo $category->name;?></span>
    </div>
	<!-- tiêu đề và tìm kiếm sản phẩm -->
    <div class='container'>
    <div class='title-section'>
      <span class='color-green'>DANH MỤC</span>
      <span>SẢN PHẨM</span>
    </div>
    <div class='d-flex flex-column gap-4 flex-xl-row mt-4 align-items-center justify-content-between'>
      <!-- tìm kiếm -->
      <div class="d-flex input-group header-search-container w-75">
        <input type="text" class="form-control" placeholder="Tìm kiếm trong danh mục" aria-label="Search input" aria-describedby="button-search">
        <button class="btn btn-primary bg-green search-btn" type="button" id="button-search">
          <i class="fas fa-search"></i> <!-- Icon kính lúp -->
        </button>
      </div>
      <!-- giá sản phẩm -->
      <div class='d-flex gap-4 flex-column flex-md-row'>
        <div class="dropdown">
          <button class="btn btn-secondary dropdown-toggle list-btn" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
            <div class='d-flex align-items-center justify-content-between'>
              <span class=''>Giá sản phẩm</span>
              <div class='down-arr'>
                <img src="<?php echo @$urlThemeActive; ?>/assets/images/down-arr.png" alt="">
              </div>
            </div>
          </button>
          <ul class="dropdown-menu w-100" aria-labelledby="dropdownMenuButton1">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </div>
          <!-- giá sản phẩm -->
          <div class="dropdown">
          <button class="btn btn-secondary dropdown-toggle list-btn" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
            <div class='d-flex align-items-center justify-content-between'>
              <span class=''>COMBO</span>
              <div class='down-arr'>
                <img src="<?php echo @$urlThemeActive; ?>/assets/images/down-arr.png" alt="">
              </div>
            </div>
          </button>
          <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </div>
      </div>
      
    </div>
    </div>

    <!-- danh mục các sản phẩm -->
    <div class='container category-nav-container mt-4'>
      <div class='category-nav-item active'>
        <span>Tất cả các sản phẩm</span>
      </div>
      <div class='category-nav-item'>
        <span>Bộ sản phẩm trị sắc tố</span>
      </div>
      <div class='category-nav-item'>
        <span>Bộ sản phẩm trị mụn, thâm</span>
      </div>
      <div class='category-nav-item'>
        <span>Bộ sản phẩm trị giãn mao mạch, da mỏng yếu</span>
      </div>
    </div>

    <!-- sản phẩm theo combo -->
    <div class='container mt-4'>
      	<div class='row bestsell-list-container'>
      		<?php 
                            if(!empty($list_product)){
                                foreach ($list_product as $product) {
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

    <!-- pagination -->
    <div class='pagination-container mt-4 d-flex gap-2'>
    <?php
        if($totalPage > 0){
            if ($page > 5) {
                $startPage = $page - 5;
            } else {
                $startPage = 1;
            }

            if ($totalPage > $page + 5) {
                $endPage = $page + 5;
            } else {
                $endPage = $totalPage;
            }

            for ($i = $startPage; $i <= $endPage; $i++) {
                $activeClass = ($page == $i) ? 'active' : '';
                echo '<div class="d-flex align-items-center justify-content-center page-number ' . $activeClass . '">
                        <a href="' . $urlPage . $i . '">' . $i . '</a>
                    </div>';
            }
        }
        ?>
    </div>
<?php getFooter(); ?>