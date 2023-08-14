<?php 
    global $settingThemes;
    getHeader();
?>
<main>
        <section id="section-breadcrumb">
            <div class="container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
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
                            <h1>Tất cả sản phẩm</h1>
                            <p><strong>6</strong> sản phẩm</p>
                        </div>

                        <div class="product-cat-filter-button" >
                            <p><i class="fa-solid fa-filter"></i> Bộ lọc</p>
                        </div>

                        <div class="product-cat-sort">
                            <span class="title">Sắp xếp theo</span>
                            <span class="text">Mới nhất</span>
                            <span class="icon"><i class="fa-solid fa-chevron-down"></i></span>
                            
                            <ul class="sort-list">
                                <li><a href="/allProduct?order=1">Giá tăng dần</a></li>
                                <li><a href="/allProduct?order=2">Giá giảm dần</a></li>
                                <li><a href="/allProduct?order=3">Cũ nhất</a></li>
                                <li><a href="/allProduct?order=4">Mới nhất</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="list-product-cat">
                        <div class="row">
                            <?php 
                                if(!empty($listData)){   
                                    foreach($listData as $key => $item){
                                        if($item->sale_price==0){
                                            $price = ' <p>Miễn phí</p>';
                                        }else{
                                            $price =  '<p>'.number_format($item->sale_price).'đ</p>';
                                        }

                                        if($item->price>0){
                                            $price .= '  <p><del>'.number_format($item->price).'đ</del</p>';
                                        }

                                        $thumbnail = (!empty($item->thumbnail))?$item->thumbnail:$item->image;
                                    ?>
                            <div class="col-lg-3 col-md-3 col-6 product-item">
                                <div class="product-item-img">
                                    <a href="/detail/<?php echo @$item->slug.'-'.@$item->id ?>.html"><img src="<?php echo $thumbnail; ?>" alt=""></a>
                                </div>
        
                                <div class="product-item-info">
                                    <div class="product-item-title">
                                        <h3>
                                            <a href="/detail/<?php echo @$item->slug.'-'.@$item->id ?>.html"><?php echo @$item->name ?></a>
                                        </h3>
                                    </div>
                
                                    <div class="product-item-price">
                                      <?php echo $price ?>
                                    </div>
                
                                    <div class="product-item-selled">
                                        <p>Đã bán: <span> <?php echo @$item->sold ?></span></p>
                                    </div>
                                </div>
                            </div>
                             <?php }} ?>
                        </div>
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
                                                          ><i class="fa-solid fa-chevron-left"></i></a>
                                                      </li>';
                                                
                                                for ($i = $startPage; $i <= $endPage; $i++) {
                                                    $active= ($page==$i)?'active':'';

                                                    echo '<li class="page-item '.$active.'">
                                                            <a class="page-link" href="'.$urlPage.$i.'">'.$i.'</a>
                                                          </li>';
                                                }

                                                echo '<li class="page-item last">
                                                        <a class="page-link" href="'.$urlPage.$totalPage.'"
                                                          ><i class="fa-solid fa-chevron-right"></i></a>
                                                      </li>';
                                            }
                                          ?>
                                        </ul>
                                      </nav>
                                    </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="section-overlay"></section>
        
        <section id="section-filter-box">
            <div class="filter-box-inner">
                 <form action="" method="GET">
                    <div class="filter-box-header">
                        <p>Bộ lọc</p>
                        <p class="close-filter"><i class="fa-solid fa-x"></i></p>
                    </div>

                    <div class="filter-box-content">
                        <!-- Danh mục -->
                        <div class="filter-group filter-search">
                            <div class="filter-group-block">
                                <div class="filter-subtitle">
                                    <span>Tên sản phẩm</span>
                                </div>

                                <div class="filter-content">
                                    <input type="text" name="name" placeholder="Nhập tên sản phẩm">
                                </div>
                            </div>
                        </div>

                        <!-- Danh mục -->
                        <div class="filter-group filter-trademark">
                            <div class="filter-group-block">
                                <div class="filter-subtitle">
                                    <span>Danh mục</span>
                                </div>

                                <div class="filter-content">
                                    <select name="category" class="form-select color-dropdown">
                                          <option value=""></option>
                                        <?php  if(!empty($listCategory)){   
                                    foreach($listCategory as $key => $item){ ?>
                                        <option value="<?php echo $item->id ?>"><?php echo $item->name ?></option>
                                         <?php }} ?>
                                        
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Giá -->
                        <div class="filter-group filter-price">
                            <div class="filter-group-block">
                                <div class="filter-subtitle">
                                    <span>Khoảng giá</span>
                                </div>

                                <!-- <div class="filter-content">
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
                                        <form>
                                            <input type="hidden" name="min-value" id="min-value" value="">
                                            <input type="hidden" name="max-value" id="max-value" value="">
                                        </form>
                                        </div>
                                    </div>
                                </div> -->
                                <select name="price" class="form-select color-dropdown">
                                    <option></option>
                                    <option value="0-0">Miễn phí</option>
                                    <option value="1-9999">Dưới 10.000đ</option>
                                    <option value="10000-100000">từ 10.000đ đếm 100.000đ</option>
                                    <option value="1111111">trên 100.000đ</option>
                                </select>
                                 
                            </div>
                        </div>

                        <div class="button-filter-box">
                            <button class="filter-button-submmit" type="submit">Lọc</button>
                        </div>

                    </div>
                </form>
            </div>
        </section>
    </main>

<?php getFooter();?>   