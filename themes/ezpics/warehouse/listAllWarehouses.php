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
                      <li class="breadcrumb-item active" aria-current="page">Kho</li>
                    </ol>
                </nav>
            </div>
        </section>

        <section id="section-warehouse-cat">
            <div class="container">
                <div class="row">
                    <div class="warehouse-cat-heading">
                        <div class="warehouse-cat-title">
                            <h1>Tất cả kho</h1>
                            <p><strong><?php echo $totalData; ?></strong> kho</p>
                        </div>

                        <div class="warehouse-cat-filter-button" >
                            <p><i class="fa-solid fa-filter"></i> Bộ lọc</p>
                        </div>

                        <div class="warehouse-cat-sort">
                            <span class="title">Sắp xếp theo</span>
                            <span class="text">Mới nhất</span>
                            <span class="icon"><i class="fa-solid fa-chevron-down"></i></span>
                            
                            <ul class="sort-list">
                                <li><a href="/allWarehouse?order=1">Giá tăng dần</a></li>
                                <li><a href="/allWarehouse?order=2">Giá giảm dần</a></li>
                                <li><a href="/allWarehouse?order=3">Cũ nhất</a></li>
                                <li><a href="/allWarehouse?order=4">Mới nhất</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="list-warehouse-cat">
                        <div class="row">
                             <?php 
                                if(!empty($listData)){   
                                    foreach($listData as $key => $item){?>
                            <div class="col-lg-3 col-md-3 col-6 warehouse-item">
                                <div class="warehouse-item-img">
                                    <div class="deadline-warehouse">
                                        <p><i class="fa-solid fa-clock"></i> <?php echo @$item->date_use ?> ngày</p>
                                    </div>
                                    <a href="/detailWarehouse/<?php echo @$item->slug.'-'.@$item->id ?>.html"><img src="<?php echo @$item->thumbnail ?>" alt=""></a>
                                </div>
    
                                <div class="warehouse-item-info">
                                    <div class="warehouse-item-title">
                                        <h3>
                                            <a href="/detailWarehouse/<?php echo @$item->slug.'-'.@$item->id ?>.html"><?php echo @$item->name ?></a>
                                        </h3>
                                    </div>
                
                                    <div class="warehouse-item-price">
                                        <p><?php echo number_format($item->price) ?> đ</p>
                                    </div>
                
                                    <div class="warehouse-item-selled">
                                        <p>Đã bán: <span><?php echo @$item->price ?></span></p>
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
                                <input type="text" placeholder="Nhập tên sản phẩm">
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
                                        <input type="hidden" name="min-value" value="">
                                        <input type="hidden" name="max-value" value="">
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
            </div>
        </section>
    </main>
<?php getFooter();?>   