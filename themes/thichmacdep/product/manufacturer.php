<?php
	global $urlThemeActive; 
	getHeader();
?>
	<!-- địa chỉ trang -->
    <div class='container gap-3 d-flex align-items-center location-page'>
      <div>
        <img src="<?php echo @$urlThemeActive; ?>assets/images/Stroke.png" alt="">
      </div>
      <span>Trang chủ</span>
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
                                                    <div>' . $product->view . ' Lượt xem</div>
                                                </div>
                                            </div>';
                                }
                            }
                            ?>
      	</div>
    </div>

    <!-- pagination -->
    <div class='container mt-4 d-flex gap-2'>
      <div class='d-flex align-items-center justify-content-center page-number active'>
        <span>1</span>
      </div>
      <div class='d-flex align-items-center justify-content-center page-number'>
        <span>2</span>
      </div>
      <div class='d-flex align-items-center justify-content-center page-number'>
        <span>3</span>
      </div>
      <div class='d-flex align-items-center justify-content-center page-number'>
        <span>4</span>
      </div>
    </div>
<?php getFooter(); ?>