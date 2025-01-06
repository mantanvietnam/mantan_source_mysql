<?php
	global $urlThemeActive; 
	getHeader();
?>
	<!-- địa chỉ trang -->
    <div class='container gap-3 d-flex align-items-center location-page'>
      <div>
        <img src="<?php echo @$urlThemeActive; ?>assets/images/Stroke.png" alt="">
      </div>
      <a href="/">Trang chủ</a>
      <span>/</span>
      <span class='current-page'>Tất cả sản phẩm</span>
    </div>
	<!-- tiêu đề và tìm kiếm sản phẩm -->
    <div class='container'>
    <div class='title-section'>
      <span class='color-green'>DANH MỤC</span>
      <span>SẢN PHẨM</span>
    </div>
    <div class='d-flex flex-column gap-4 flex-xl-row mt-4 align-items-center justify-content-between'>
  
    </div>
    </div>

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
    <div class='container mt-4 d-flex gap-2'>
    <?php
   if($totalPage>0){
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