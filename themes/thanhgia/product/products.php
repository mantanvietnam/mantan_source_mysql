<?php getHeader();?>
    <main>
        <section id="section-breadcrumb">
            <div class="container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Sản phẩm</li>
                    </ol>
                </nav>
            </div>
        </section>

        <section id="section-product-cat">
            <div class="container">
                <div class="row">
                    <div class="product-cat-heading">
                        <div class="product-cat-title">
                            <h1>Sản phẩm</h1>
                            <p><strong><?php echo number_format($totalData);?></strong> sản phẩm</p>
                        </div>

                        <div class="product-cat-filter-button" >
                            <p><i class="fa-solid fa-filter"></i> Bộ lọc</p>
                        </div>

                        <div class="product-cat-sort">
                            <span class="title">Sắp xếp theo</span>
                            <span class="text">Mới nhất</span>
                            <span class="icon"><i class="fa-solid fa-chevron-down"></i></span>
                            
                            <ul class="sort-list">
                                <li>Giá tăng dần</li>
                                <li>Giá giảm dần</li>
                                <li>Cũ nhất</li>
                                <li>Mới nhất</li>
                            </ul>
                        </div>
                    </div>


                    <div class="com-12 list-product-cat">
                        <div class="row">
                            <?php 
                            if(!empty($list_product)){
                                foreach ($list_product as $product) {
                                    $link = '/product/'.$product->slug.'.html';

                                    $giam = 0;
                                    if(!empty($product->price_old) && !empty($product->price)){
                                        $giam = 100 - 100*$product->price/$product->price_old;
                                    }

                                    if($giam>0){
                                        $giam = '<img src="'.$urlThemeActive.'/asset/img/frame1_5f151d3f2bce42b99a356c60c1cf7864.jpg" alt="">
                                                    <div class="item-sale">
                                                        <span><i class="fa-solid fa-bolt"></i> -'.$giam.'%</span>
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

                                    echo '  <div class="col-lg-3 col-md-6 col-6 product-featured-item product-list-item">
                                                <div class="product-featured-inner">
                                                    <div class="product-featured-img">
                                                        <a href="'.$link.'"><img src="'.$product->image.'" alt=""></a>
                                                        '.$giam.'
                                                    </div>
                            
                                                    <div class="product-featured-details">
                                                        <div class="product-featured-title">
                                                            <a href="'.$link.'">'.$product->title.'</a>
                                                        </div>
                                                        <div class="product-featured-price">
                                                            <span class="price">'.$price.'</span>
                                                            <span class="price-del">'.$price_old.'</span>
                                                        </div> 
                                                        <div class="product-button-action">
                                                            <div class="product-button-cart">
                                                                <a href="'.$link.'" class="button-cart">
                                                                    <i class="fa-solid fa-cart-shopping"></i><span>Thêm vào giỏ</span>    
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div> 
                                                </div>
                                            </div>';
                                }
                            }
                            ?>

                            <!-- Phân trang -->
                            <div class="col-12 col-md-12 col-lg-12">
                                <div class="demo-inline-spacing">
                                  <nav aria-label="Page navigation">
                                    <ul class="pagination justify-content-center">
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
                                            
                                            echo '<li class="page-item first">
                                                    <a class="page-link" href="'.$urlPage.'1"
                                                      ><i class="tf-icon bx bx-chevrons-left"></i
                                                    ></a>
                                                  </li>';
                                            
                                            for ($i = $startPage; $i <= $endPage; $i++) {
                                                $active= ($page==$i)?'active':'';

                                                echo '<li class="page-item '.$active.'">
                                                        <a class="page-link" href="'.$urlPage.$i.'">'.$i.'</a>
                                                      </li>';
                                            }

                                            echo '<li class="page-item last">
                                                    <a class="page-link" href="'.$urlPage.$totalPage.'"
                                                      ><i class="tf-icon bx bx-chevrons-right"></i
                                                    ></a>
                                                  </li>';
                                        }
                                      ?>
                                    </ul>
                                  </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="section-overlay"></section>
        
        <section id="section-filter-box">
            <div class="filter-box-inner">
                <div class="filter-box-header">
                    <p>Bộ lọc</p>
                    <p class="close-filter"><i class="fa-solid fa-x"></i></p>
                </div>

                <div class="filter-box-content">
                    <form action="/search-product" method="get">
                        <!-- Danh mục -->
                        <div class="filter-group filter-search">
                            <div class="filter-group-block">
                                <div class="filter-subtitle">
                                    <span>Tên sản phẩm</span>
                                </div>

                                <div class="filter-content">
                                    <input type="text" placeholder="Nhập tên sản phẩm" name="key" value="<?php echo @$_GET['key'];?>">
                                </div>
                            </div>
                        </div>

                        <!-- Danh mục -->
                        <div class="filter-group filter-trademark">
                            <div class="filter-group-block">
                                <div class="filter-subtitle">
                                    <span>Danh mục sản phẩm</span>
                                </div>

                                <div class="filter-content">
                                    <ul class="filter-list-menu">
                                        <?php 
                                        if(!empty($category_all)){
                                            foreach ($category_all as $key => $value) {
                                                $checked = '';
                                                if(!empty($_GET['category']) && in_array($value->id, $_GET['category'])){
                                                    $checked = 'checked';
                                                }

                                                echo '  <li>
                                                            <input '.$checked.' type="checkbox" id="category'.$value->id.'" name="category[]" value="'.$value->id.'">
                                                            <label for="category'.$value->id.'">'.$value->name.'</label>
                                                        </li>';
                                            }
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Nhà sản xuất -->
                        <div class="filter-group filter-trademark">
                            <div class="filter-group-block">
                                <div class="filter-subtitle">
                                    <span>Nhà sản xuất</span>
                                </div>

                                <div class="filter-content">
                                    <ul class="filter-list-menu">
                                        <?php 
                                        if(!empty($manufacturer_all)){
                                            foreach ($manufacturer_all as $key => $value) {
                                                $checked = '';
                                                if(!empty($_GET['manufacturer']) && in_array($value->id, $_GET['manufacturer'])){
                                                    $checked = 'checked';
                                                }

                                                echo '  <li>
                                                            <input '.$checked.' type="checkbox" id="manufacturer'.$value->id.'" name="manufacturer[]" value="'.$value->id.'">
                                                            <label for="manufacturer'.$value->id.'">'.$value->name.'</label>
                                                        </li>';
                                            }
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Giá -->
                        <div class="filter-group filter-price">
                            <div class="filter-group-block">
                                <div class="filter-subtitle">
                                    <span>Khoảng giá</span>
                                </div>

                                <div class="filter-content">
                                    <div class="row">
                                        <div class="col-sm-12">
                                        <div id="slider-range"></div>
                                        </div>
                                    </div>
                                    <div class="slider-labels">
                                        <div class="caption">
                                        <strong>Từ:</strong> <span id="slider-range-value1"></span>
                                        </div>
                                        <div class="text-right caption">
                                        <strong>Đến:</strong> <span id="slider-range-value2"></span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <input type="hidden" name="min-value" id="min-value" value="">
                                            <input type="hidden" name="max-value" id="max-value" value="">
                                        </div>
                                    </div>

                                    <script type="text/javascript">
                                        var minPrice = <?php echo (int) @$_GET['min-value'];?>;
                                        var maxPrice = <?php echo (!empty($_GET['max-value']))?(int) $_GET['max-value']:5000000;?>;
                                    </script>
                                </div>
                            </div>
                        </div>

                        <div class="button-filter-box">
                            <button class="filter-button-submmit" type="submit">Tìm kiếm</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>
</body>

<?php getFooter();?>