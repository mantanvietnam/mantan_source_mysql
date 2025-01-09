<?php
	global $urlThemeActive; 
	getHeader();
?>
<div id="checkout-container" class="flex justify-center mt-10">
      <div class="w-full max-w-4xl p-4 rounded-xl bg-blue-50">
        <div class="flex items-center justify-between">
          <!-- Step Indicators -->
          <div class="flex flex-col items-center step" data-step="1">
            <div
              class="flex items-center justify-center w-12 h-12 text-white bg-blue-900 rounded-xl icon"
            >
              <i class="fas fa-shopping-bag"></i>
            </div>
            <span class="mt-2 text-black">Giỏ hàng</span>
          </div>
          <div
            class="flex-grow mx-2 mb-4 border-t-2 border-gray-300 border-dotted"
          ></div>
          <div class="flex flex-col items-center step" data-step="2">
            <div
              class="flex items-center justify-center w-12 h-12 text-gray-500 bg-gray-200 rounded-xl icon"
            >
              <i class="fas fa-user-friends"></i>
            </div>
            <span class="mt-2 text-gray-500">Thông tin đặt hàng</span>
          </div>
          <div
            class="flex-grow mx-2 mb-4 border-t-2 border-gray-300 border-dotted"
          ></div>
          <div class="flex flex-col items-center step" data-step="3">
            <div
              class="flex items-center justify-center w-12 h-12 text-gray-500 bg-gray-200 rounded-xl icon"
            >
              <i class="fas fa-check-circle"></i>
            </div>
            <span class="mt-2 text-gray-500">Hoàn tất</span>
          </div>
        </div>
      </div>
    </div>
    <!-- Step Contents -->
    <div class="flex justify-center my-6">
      <div class="step-content p-2" data-step="1">
        <div class="max-w-4xl">
          <?php  
          $price_total = 0;
          $total = 0;

          if(!empty($list_product)) {
              foreach ($list_product as $key => $value) {
                  $link = '/product/'.$value->slug.'.html';
                  $price_old = $value->price_old ? '<del>'.number_format($value->price_old).'₫</del>' : '';

                  $price_buy = $value->price * $value->numberOrder;
                  $price_total += $price_buy;
                  $total = $price_total;

                  echo '
                  <div class="flex items-center space-x-4">
                      <img
                          alt="Product image"
                          class="w-[104px] h-[124px] rounded-md product-image object-center object-cover"
                          src="'.$value->image.'"
                      />
                      <div class="flex-1 product-info">
                          <h2 class="text-lg font-bold product-name mb-2">
                              '.$value->title.'
                          </h2>
                          <p class="text-gray-500 product-quantity-label">Số lượng: '.$value->numberOrder.'</p>
                          <button
                              class="flex items-center mt-4 text-red-500 delete-product"
                              onclick="window.location.href=\'/deleteProductCart/?id_product='.$value->id.'\'"
                          >
                              <i class="mr-1 fas fa-trash-alt"></i> Xóa sản phẩm
                          </button>
                      </div>
                      <div class="text-right product-price">
                          <p class="text-lg font-semibold unit-price">'.number_format($price_buy).'₫</p>
                          <div class="flex items-center mt-2 quantity-control">
                              <button
                                  class="flex items-center justify-center w-8 h-8 border rounded-full btn-decrement"
                              >
                                  -
                              </button>
                              <span class="mx-2 quantity-display">'.$value->numberOrder.'</span>
                              <button
                                  class="flex items-center justify-center w-8 h-8 border rounded-full btn-increment"
                              >
                                  +
                              </button>
                          </div>
                      </div>
                  </div>
                  <hr class="my-4" />
                  ';
              }
          } else {
              echo '<p>Giỏ hàng trống</p>';
          }
          ?>
    
            <!-- Hiển thị tổng tiền -->
            <div class="flex items-center justify-between">
                <p class="text-lg font-semibold total-label">Tổng tiền</p>
                <p class="text-lg font-semibold text-green-600 total-price">
                    <?php echo number_format($price_total); ?>₫
                </p>
            </div>
            <input type="hidden" name="total" value="<?php echo $total; ?>">

            <!-- Nút Đặt hàng -->
            <div class="flex justify-center mt-4">
                <button
                    id="next-step"
                    class="px-4 py-2 text-white bg-green-500 rounded-full btn-submit hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50"
                >
                    ĐẶT HÀNG NGAY
                </button>
            </div>
        </div>
      </div>

      <div class="hidden step-content" data-step="2">
      <form action="/createOrder" method="post">
    <!-- Hidden Inputs -->
    <input type="hidden" name="id_user" value="<?php echo @$infoUser->id; ?>">
    <input type="hidden" name="_csrfToken" value="<?php echo $csrfToken; ?>">

    <div class="grid max-w-4xl sm:grid-cols-2 gap-x-8 gap-y-4 p-2">
        <h2 class="text-xl font-semibold sm:col-span-2">
            Thông tin khách mua hàng
        </h2>

        <!-- Họ và Tên -->
        <div class="sm:col-span-1">
            <label class="block mb-2 text-gray-700" for="name">Họ và tên</label>
            <input
                class="w-full p-2 border border-gray-300 rounded"
                type="text"
                id="name"
                name="full_name"
                value="<?php echo @$infoUser->full_name; ?>"
                required
            />
        </div>

        <!-- Số Điện Thoại -->
        <div class="sm:col-span-1">
            <label class="block mb-2 text-gray-700" for="phone">Số điện thoại</label>
            <input
                class="w-full p-2 border border-gray-300 rounded"
                type="text"
                id="phone"
                name="phone"
                value="<?php echo @$infoUser->phone; ?>"
                required
            />
        </div>

        <!-- Địa chỉ giao hàng -->
        <div class="col-span-2">
            <label class="block mb-2 text-gray-700" for="address">Địa chỉ giao hàng</label>
            <input
                class="w-full p-2 border border-gray-300 rounded"
                type="text"
                id="address"
                name="address"
                value="<?php echo @$infoUser->address; ?>"
                required
            />
        </div>

        <!-- Ghi chú giao hàng -->
        <div class="col-span-2">
            <label class="block mb-2 text-gray-700" for="note">Ghi chú giao hàng</label>
            <textarea
                class="w-full p-2 border border-gray-300 rounded"
                id="note"
                name="note_user"
                rows="5"
            ></textarea>
        </div>

        <hr class="col-span-2" />

        <!-- Tổng tiền -->
        <div class="flex items-center justify-between col-span-2">
            <span class="text-lg font-semibold">Tổng tiền</span>
            <span class="text-lg font-semibold text-green-500">
                <?php echo number_format($price_total, 0, '.', ','); ?>₫
            </span>
        </div>

        <!-- Nút Hoàn tất -->
        <div class="flex justify-center col-span-2 mt-4">
            <button
                id="next-step"
                class="px-4 py-2 text-white bg-green-500 rounded-full btn-submit-form hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50"
                type="submit"
            >
                HOÀN TẤT ĐẶT HÀNG NGAY
            </button>
        </div>
    </div>
</form>

      </div>
      <div class="hidden step-content" data-step="3">
        <div class="max-w-4xl text-center">
          <img
            alt="Shopping cart with gift boxes"
            class="mx-auto mb-4 w-[360px]"
            src="../assets/images/imageComplete.png"
          />
          <h1 class="mb-2 text-xl font-semibold">
            Bạn đã đặt hàng
            <span class="text-green-500"> thành công </span>
          </h1>
          <p class="mb-4 text-gray-700">
            Đơn hàng của bạn đã đặt thành công. Bạn có thể kiểm tra tình trạng
            đơn hàng
            <a class="text-green-500" href="#"> TẠI ĐÂY </a>
            , hoặc vào phần TÀI KHOẢN của bạn -&gt; Đơn hàng của tôi
          </p>
          <button
            class="px-4 py-2 text-white bg-green-500 rounded-full hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50"
          >
            TIẾP TỤC MUA HÀNG
          </button>
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
    <?php getFooter(); ?>
