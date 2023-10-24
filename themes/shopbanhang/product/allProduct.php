<?php
getHeader();
global $urlThemeActive;
?>

<main>
        <section id="section-breadcrumb">
            <div class="breadcrumb-center">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item"><a href="#">Library</a></li>
                  <li class="breadcrumb-item active">Data</li>
                </ul>
            </div>
        </section>

        <section id="section-banner-home">
            <div class="container">
                <div class="banner-home-slide">
                    <div class="banner-home-item">
                        <img src="<?php echo $urlThemeActive ?>asset/image/background-home.png" alt="">
                    </div>
    
                    <div class="banner-home-item">
                        <img src="<?php echo $urlThemeActive ?>asset/image/background-home.png" alt="">
                    </div>
    
                    <div class="banner-home-item">
                        <img src="<?php echo $urlThemeActive ?>asset/image/background-home.png" alt="">
                    </div>
                </div>
            </div>
        </section>

        <section id="section-cateogry-product">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-12">
                        <div class="search-category-product">
                            <form action="">
                                <img src="<?php echo $urlThemeActive ?>asset/image/iconsearch.png" alt="">
                                <input placeholder="Tìm kiếm theo sản phẩm" type="text" class="form-control" id="" aria-describedby="">
                            </form>
                        </div>

                        <div class="category-product-menu">
                            <div class="category-product-item">
                                <ul>
                                    <div class="category-product-menu-title">
                                        <p>Danh mục sản phẩm </p>
                                    </div>
                                    <li><a href="">Tất cả sản phẩm</a></li>
                                    <li><a href="">Bumas Care</a></li>
                                    <li><a href="">Bumas Home</a></li>
                                </ul>
                            </div>
                            
                            <div class="category-product-item">
                                <ul>
                                    <div class="category-product-menu-title">
                                        <p>Combo quà tặng</p>
                                    </div>
                                    <li><a href="">Quà tặng dành cho cha mẹ</a></li>
                                    <li><a href="">Bumas Care</a></li>
                                    <li><a href="">Bumas Home</a></li>
                                </ul>
                            </div>

                            <div class="banner-category">
                                <div class="banner-category-image">
                                    <img src="<?php echo $urlThemeActive ?>asset/image/banner-cate.png" alt="">
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-lg-9 col-12">
                        <div class="row">
                            <!-- seclect -->
                            <div class="product-select col-12">
                                <div class="product-select-box">
                                    <div class="product-select-item product-select-left">
                                        <div class="heading-check">
                                            <span>Khuyễn mãi</span>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                                        </div>
                                    </div>
        
                                    <div class="product-select-item product-select-right">
                                        <div class="heading-check">
                                            <span>Sắp xếp</span>
                                        </div>
                                        <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                                            <option selected>Open this select menu</option>
                                            <option value="1">Sản phẩm bán chạy nhất</option>
                                            <option value="2">Giá từ cao đến thấp</option>
                                            <option value="3">Giá từ thấp đến cao</option>
                                            <option value="4">Sản phẩm mới nhất</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- sản phẩm -->
                            <div class="col-lg-3 col-md-3 col-sm-3 col-12 product-item">
                                <div class="product-item-inner">
                                    <div class="ribbon ribbon-top-right"><span>33%</span></div>
                                    <div class="product-img">
                                        <a href=""><img src="<?php echo $urlThemeActive ?>asset/image/topsearch.png" alt=""></a>
                                    </div>
        
                                    <div class="product-info">
                                        <div class="product-name">
                                            <a href="">Đai Chườm Nóng Massage Giảm Đau Bụng Kinh BUMAS BU01</a>
                                        </div>
        
                                        <div class="product-price">
                                            <p>1.0000.000</p>
                                        </div>
        
                                        <div class="product-discount">
                                            <del>500.000</del><span> (50%)</span>
                                        </div>
                                    </div>
        
                                    <div class="progress-box">
                                        <div class="product-progress">
                                            <div class="text-progress">Sản phẩm 30 Đã bán</div>
                                            <div class="sale-progress-val" style="width: 32%"></div>
                                        </div>
                                    </div>
        
                                    <div class="product-rate">
                                        <div class="rate-best-item rate-star">
                                            <img src="<?php echo $urlThemeActive ?>asset/image/star.png" alt="">
                                            <p>4.8 <span>(34)</span></p>
                                        </div>
        
                                        <div class="rate-best-item rate-sold">
                                            <p>2.6k Đã bán</p>
                                            <img src="<?php echo $urlThemeActive ?>asset/image/heart.png" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
        
                            <div class="col-lg-3 col-md-3 col-sm-3 col-12 product-item">
                                <div class="product-item-inner">
                                    <div class="ribbon ribbon-top-right"><span>33%</span></div>
                                    <div class="product-img">
                                        <a href=""><img src="<?php echo $urlThemeActive ?>asset/image/topsearch.png" alt=""></a>
                                    </div>
        
                                    <div class="product-info">
                                        <div class="product-name">
                                            <a href="">Đai Chườm Nóng Massage Giảm Đau Bụng Kinh BUMAS BU01</a>
                                        </div>
        
                                        <div class="product-price">
                                            <p>1.0000.000</p>
                                        </div>
        
                                        <div class="product-discount">
                                            <del>500.000</del><span> (50%)</span>
                                        </div>
                                    </div>
        
                                    <div class="progress-box">
                                        <div class="product-progress">
                                            <div class="text-progress">Sản phẩm 30 Đã bán</div>
                                            <div class="sale-progress-val" style="width: 32%"></div>
                                        </div>
                                    </div>
        
                                    <div class="product-rate">
                                        <div class="rate-best-item rate-star">
                                            <img src="<?php echo $urlThemeActive ?>asset/image/star.png" alt="">
                                            <p>4.8 <span>(34)</span></p>
                                        </div>
        
                                        <div class="rate-best-item rate-sold">
                                            <p>2.6k Đã bán</p>
                                            <img src="<?php echo $urlThemeActive ?>asset/image/heart.png" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
        
                            <div class="col-lg-3 col-md-3 col-sm-3 col-12 product-item">
                                <div class="product-item-inner">
                                    <div class="ribbon ribbon-top-right"><span>33%</span></div>
                                    <div class="product-img">
                                        <a href=""><img src="<?php echo $urlThemeActive ?>asset/image/topsearch.png" alt=""></a>
                                    </div>
        
                                    <div class="product-info">
                                        <div class="product-name">
                                            <a href="">Đai Chườm Nóng Massage Giảm Đau Bụng Kinh BUMAS BU01</a>
                                        </div>
        
                                        <div class="product-price">
                                            <p>1.0000.000</p>
                                        </div>
        
                                        <div class="product-discount">
                                            <del>500.000</del><span> (50%)</span>
                                        </div>
                                    </div>
        
                                    <div class="progress-box">
                                        <div class="product-progress">
                                            <div class="text-progress">Sản phẩm 30 Đã bán</div>
                                            <div class="sale-progress-val" style="width: 32%"></div>
                                        </div>
                                    </div>
        
                                    <div class="product-rate">
                                        <div class="rate-best-item rate-star">
                                            <img src="<?php echo $urlThemeActive ?>asset/image/star.png" alt="">
                                            <p>4.8 <span>(34)</span></p>
                                        </div>
        
                                        <div class="rate-best-item rate-sold">
                                            <p>2.6k Đã bán</p>
                                            <img src="<?php echo $urlThemeActive ?>asset/image/heart.png" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
        
                            <div class="col-lg-3 col-md-3 col-sm-3 col-12 product-item">
                                <div class="product-item-inner">
                                    <div class="ribbon ribbon-top-right"><span>33%</span></div>
                                    <div class="product-img">
                                        <a href=""><img src="<?php echo $urlThemeActive ?>asset/image/topsearch.png" alt=""></a>
                                    </div>
        
                                    <div class="product-info">
                                        <div class="product-name">
                                            <a href="">Đai Chườm Nóng Massage Giảm Đau Bụng Kinh BUMAS BU01</a>
                                        </div>
        
                                        <div class="product-price">
                                            <p>1.0000.000</p>
                                        </div>
        
                                        <div class="product-discount">
                                            <del>500.000</del><span> (50%)</span>
                                        </div>
                                    </div>
        
                                    <div class="progress-box">
                                        <div class="product-progress">
                                            <div class="text-progress">Sản phẩm 30 Đã bán</div>
                                            <div class="sale-progress-val" style="width: 32%"></div>
                                        </div>
                                    </div>
        
                                    <div class="product-rate">
                                        <div class="rate-best-item rate-star">
                                            <img src="<?php echo $urlThemeActive ?>asset/image/star.png" alt="">
                                            <p>4.8 <span>(34)</span></p>
                                        </div>
        
                                        <div class="rate-best-item rate-sold">
                                            <p>2.6k Đã bán</p>
                                            <img src="<?php echo $urlThemeActive ?>asset/image/heart.png" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-3 col-sm-3 col-12 product-item">
                                <div class="product-item-inner">
                                    <div class="ribbon ribbon-top-right"><span>33%</span></div>
                                    <div class="product-img">
                                        <a href=""><img src="<?php echo $urlThemeActive ?>asset/image/topsearch.png" alt=""></a>
                                    </div>
        
                                    <div class="product-info">
                                        <div class="product-name">
                                            <a href="">Đai Chườm Nóng Massage Giảm Đau Bụng Kinh BUMAS BU01</a>
                                        </div>
        
                                        <div class="product-price">
                                            <p>1.0000.000</p>
                                        </div>
        
                                        <div class="product-discount">
                                            <del>500.000</del><span> (50%)</span>
                                        </div>
                                    </div>
        
                                    <div class="progress-box">
                                        <div class="product-progress">
                                            <div class="text-progress">Sản phẩm 30 Đã bán</div>
                                            <div class="sale-progress-val" style="width: 32%"></div>
                                        </div>
                                    </div>
        
                                    <div class="product-rate">
                                        <div class="rate-best-item rate-star">
                                            <img src="<?php echo $urlThemeActive ?>asset/image/star.png" alt="">
                                            <p>4.8 <span>(34)</span></p>
                                        </div>
        
                                        <div class="rate-best-item rate-sold">
                                            <p>2.6k Đã bán</p>
                                            <img src="<?php echo $urlThemeActive ?>asset/image/heart.png" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div> 
                        </div>  
                    </div>
                </div>
            </div>
        </section>
    </main>
<?php
getFooter();?>