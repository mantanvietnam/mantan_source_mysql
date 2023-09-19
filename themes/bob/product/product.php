<?php getHeader();?>
    
    <script src="https://unpkg.com/js-image-zoom@0.7.0/js-image-zoom.js" type="application/javascript"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"/>

    <main>
        <section class="duong-dan-product mg-top-24">
            <div class="container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb text-gray-400 list-duong-dan">
                      <li class="breadcrumb-item"><a href="/">Trang Chủ</a></li>
                      <li class="breadcrumb-item"><a href="/products">Sản Phẩm</a></li>
                      <li class="breadcrumb-item active font-semibold" aria-current="page"><?php echo $product->title;?></li>
                    </ol>
                  </nav>
            </div>
        </section>

        <section class="intro-product-details">
            <div class="container">
                <div class="row gap-48">
                    <div class="col-4 relative img-product-details">
                        <div class="pd-img-zoom height-540 img-zoom-desktop">
                            <div class="img-zoom-container" onmouseleave="zoomOut();" >
                                <img id="myimage" src="<?php echo $product->image;?>" onmouseenter="imageZoom('myimage', 'myresult');" 
                                width="300" height="240">
                                <div id="myresult" class="img-zoom-result"></div>
                            </div>
                        </div>
                          
                        <div class="pd-img-zoom height-540 img-zoom-mobile">
                            <img id="myimage" src="<?php echo $product->image;?>" onmouseenter="imageZoom('myimage', 'myresult');" 
                            width="300" height="240">
                        </div>

                        <div class="icon-facebook-twiter">
                            <span>Chia sẻ</span>
                            
                            <a href="" target="_blank" class="mg-left-16">
                                <span class="fill-current text-gray-700 cursor-pointer duration-500 hover-text-primary">
                                    <svg width="25" height="25" viewBox="0 0 25 25" xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_123_2578)">
                                          <path d="M21.5205 0.988281H3.52051C1.86601 0.988281 0.520508 2.33378 0.520508 3.98828V21.9883C0.520508 23.6428 1.86601 24.9883 3.52051 24.9883H21.5205C23.175 24.9883 24.5205 23.6428 24.5205 21.9883V3.98828C24.5205 2.33378 23.175 0.988281 21.5205 0.988281Z"></path>
                                          <path d="M20.7705 12.9883H17.0205V9.98828C17.0205 9.16028 17.6925 9.23828 18.5205 9.23828H20.0205V5.48828H17.0205C14.535 5.48828 12.5205 7.50278 12.5205 9.98828V12.9883H9.52051V16.7383H12.5205V24.9883H17.0205V16.7383H19.2705L20.7705 12.9883Z" fill="white"></path>
                                        </g>
                                        <defs>
                                          <clipPath id="clip0_123_2578">
                                            <rect width="24" height="24" fill="white" transform="translate(0.520508 0.988281)"></rect>
                                          </clipPath>
                                        </defs>
                                      </svg>
                                </span>
                            </a>
                            
                            <a href="" target="_blank" class="mg-left-16">
                                <span class="fill-current text-gray-700 cursor-pointer duration-500 hover-text-primary">
                                    <svg width="25" height="25" viewBox="0 0 25 25" xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_123_2585)">
                                          <path d="M24.5195 5.54678C23.627 5.93828 22.676 6.19778 21.6845 6.32378C22.7045 5.71478 23.483 4.75778 23.849 3.60428C22.898 4.17128 21.848 4.57178 20.729 4.79528C19.826 3.83378 18.539 3.23828 17.135 3.23828C14.411 3.23828 12.218 5.44928 12.218 8.15978C12.218 8.54978 12.251 8.92478 12.332 9.28178C8.24153 9.08228 4.62203 7.12178 2.19053 4.13528C1.76603 4.87178 1.51703 5.71478 1.51703 6.62228C1.51703 8.32628 2.39453 9.83678 3.70253 10.7113C2.91203 10.6963 2.13653 10.4668 1.47953 10.1053C1.47953 10.1203 1.47953 10.1398 1.47953 10.1593C1.47953 12.5503 3.18503 14.5363 5.42153 14.9938C5.02103 15.1033 4.58453 15.1558 4.13153 15.1558C3.81653 15.1558 3.49853 15.1378 3.20003 15.0718C3.83753 17.0203 5.64653 18.4528 7.79753 18.4993C6.12353 19.8088 3.99803 20.5978 1.69703 20.5978C1.29353 20.5978 0.906531 20.5798 0.519531 20.5303C2.69903 21.9358 5.28203 22.7383 8.06753 22.7383C17.1215 22.7383 22.0715 15.2383 22.0715 8.73728C22.0715 8.51978 22.064 8.30978 22.0535 8.10128C23.03 7.40828 23.8505 6.54278 24.5195 5.54678Z"></path>
                                        </g>
                                        <defs>
                                          <clipPath id="clip0_123_2585">
                                            <rect width="24" height="24" fill="white" transform="translate(0.519531 0.988281)"></rect>
                                          </clipPath>
                                        </defs>
                                      </svg>
                                </span>
                            </a>
                          </div>

                    </div>
                    <div class="col-8 pd-left-48 thong-so-product-details">
                        <div class="thong-so-product mg-bottom-20">
                            <div class="name-product">
                                <h1 class="text-gray-700 mg-bottom-4"><?php echo $product->title;?></h1>
                                <h3 class="mg-bottom-4"><?php echo $product->code;?></h3>
                                <div class="price-product">
                                    <h4 class="text-gray-700">Giá Bán:</h4>
                                    <span><?php echo ($product->price > 0)?number_format($product->price).'đ':'Liên hệ';?> </span><del><?php echo ($product->price_old > 0)?number_format($product->price_old).'đ':'';?></del>
                                </div>
                            </div>

                            <div class="intro-product mg-top-16">
                                <div class="material mg-bottom-6 flex justify-space align-center">
                                    <p>Tình trạng</p>
                                    <p><?php echo ($product->quantity > 0)?'Còn hàng':'Hết hàng';?></p>
                                </div>
                                <div class="classify mg-bottom-6 flex justify-space align-center">
                                    <p>Nhà sản xuất</p>
                                    <p><a href="/manufacturer/<?php echo $manufacturer->slug;?>.html"><?php echo $manufacturer->name;?></a></p>
                                </div>
                            </div>
                        </div>

                        <div class="description mg-bottom-24">
                            <p class="text-gray-700">Mô tả sản phẩm</p>
                            <p class="max-w-480"><?php echo $product->description;?></p>
                        </div>
                        <div class="button-product-details">
                            <button class="button-gio" onclick="addProductToCart(<?php echo $product->id;?>)" href="javascript:void(0);" >Thêm vào giỏ hàng</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="related-products" class="">
            <div class="container">
                <div class="setting-related">
                    <h3 class="titel-related">Sản phẩm liên quan</h3>
                </div>

                <div class="swiper-related swiper">

                    <div class="swiper-wrapper">
                        <?php
                            if(!empty($other_product)){
                                foreach ($other_product as $key => $value) {
                                    if(!empty($value->price)){
                                        $price = number_format($value->price).'đ';
                                    }else{
                                        $price = 'Giá liên hệ';
                                    }

                                    $link = '/product/'.$value->slug.'.html';

                                    echo '  <div class="swiper-slide">
                                                <div class="group-product">
                                                    <div class="img-product relative">
                                                        <img src="'.$value->image.'" alt="">
                                                        <div class="opacity-0 group-hover-opacity-50 bg-gray-800 duration-500 absolute h-full w-full top-0"></div>
                                                        <div class="click-product absolute group-hover-opacity-100 opacity-0 duration-500 w-100 top-0 setting-click ">
                                                            
                                                            <a href="'.$link.'" class="duration-500 w-full text-white border border-white setting-button-click button-click-hover hover-border-gray-800 hover-text-gray-800 hover-bg-white">Xem chi tiết</a>
                                                            
                                                            <a href="javascript:void(0);" onclick="addProductToCart('.$value->id.')" class="duration-500 w-full text-black setting-button-click border-black bg-white hover-border-white hover-text-white hover-bg-black">Thêm vào giỏ hàng</a>
                                                        </div>
                                                    </div>
                                                    <div class="content-product">
                                                        <p>'.$value->code.'</p>
                                                        <h5>'.$value->title.'</h5>
                                                    </div>
                                                </div>              
                                            </div>';
                                }
                            }
                        ?>
                    </div>
                  

                    <div class="swiper-button-prev button-swiper"></div>
                    <div class="swiper-button-next button-swiper"></div>
                  
                  </div>
                  </script>
            </div>
        </section>
    </main>
   
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
<?php getFooter();?>