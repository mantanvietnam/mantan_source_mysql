<?php
getHeader();
global $urlThemeActive;

$setting = setting();

$slide_home= slide_home($setting['id_slide']);
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
        <section id="sale99">
            <div class="container">
                <div class="banner-sale">
                    <img src="<?php echo $setting->baner_sele ?>">
                </div>
                <div class="endow">
                    <h3>Ưu đãi độc quyền 10.10</h3>
                    <p>Voucher độc quyền từ website
                        <span>Quà tặng đi kèm siêu to</span>
                    </p>
                </div>
                <div class="combo-voucher">
                    <div class="item-voucher">
                        <img src="<?php echo $setting->background_sele ?>">
                        <div class="detail-voucher-sale">
                            <p>V100</p>
                            <span>giảm 100k cho đơn hàng khi mua sắm tại Bumas. Đơn tối thiểu 1 triệu</span>
                        </div>
                    </div>

                    <div class="item-voucher">
                        <img src="<?php echo $urlThemeActive ?>asset/image/voucher.png">
                        <div class="detail-voucher-sale">
                            <p>V100</p>
                            <span>giảm 100k cho đơn hàng khi mua sắm tại Bumas. Đơn tối thiểu 1 triệu</span>
                        </div>
                    </div>

                    <div class="item-voucher">
                        <img src="<?php echo $urlThemeActive ?>asset/image/voucher.png">
                        <div class="detail-voucher-sale">
                            <p>V100</p>
                            <span>giảm 100k cho đơn hàng khi mua sắm tại Bumas. Đơn tối thiểu 1 triệu</span>
                        </div>
                    </div>
                </div>
                <div class="top-deal">
                    <img src="<?php echo $urlThemeActive ?>asset/image/bg-sale.png">
                    <div class="group-deal">
                        <div class="list-product list-product-1">
                            <div class="row">
                                <div class="col-lg-3 col-md-3 col-sm-3 col-12 best-sale-item">
                                    <div class="best-sale-item-inner">
                                        <div class="ribbon ribbon-top-right"><span>33%</span></div>
                                        <div class="best-sale-img">
                                            <a href=""><img src="<?php echo $urlThemeActive ?>asset/image/topsearch.png" alt=""></a>
                                        </div>

                                        <div class="best-sale-info">
                                            <div class="best-sale-name">
                                                <a href="">Đai Chườm Nóng Massage Giảm Đau Bụng Kinh BUMAS BU01</a>
                                            </div>

                                            <div class="best-sale-price">
                                                <p>1.0000.000</p>
                                            </div>

                                            <div class="best-sale-discount">
                                                <del>500.000</del><span> (50%)</span>
                                            </div>
                                        </div>

                                        <div class="progress-box">
                                            <div class="best-sale-progress">
                                                <div class="text-progress">Sản phẩm 30 Đã bán</div>
                                                <div class="sale-progress-val" style="width: 32%"></div>
                                            </div>
                                        </div>

                                        <div class="best-sale-rate">
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

                                <div class="col-lg-3 col-md-3 col-sm-3 col-12 best-sale-item">
                                    <div class="best-sale-item-inner">
                                        <div class="ribbon ribbon-top-right"><span>33%</span></div>

                                        <div class="best-sale-img">
                                            <a href=""><img src="<?php echo $urlThemeActive ?>asset/image/topsearch.png" alt=""></a>
                                        </div>

                                        <div class="best-sale-info">
                                            <div class="best-sale-name">
                                                <a href="">Đai Chườm Nóng Massage Giảm Đau Bụng Kinh BUMAS BU01</a>
                                            </div>

                                            <div class="best-sale-price">
                                                <p>1.0000.000</p>
                                            </div>

                                            <div class="best-sale-discount">
                                                <del>500.000</del><span> (50%)</span>
                                            </div>
                                        </div>

                                        <div class="progress-box">
                                            <div class="best-sale-progress">
                                                <div class="text-progress">Sản phẩm 30 Đã bán</div>
                                                <div class="sale-progress-val" style="width: 32%"></div>
                                            </div>
                                        </div>

                                        <div class="best-sale-rate">
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

                                <div class="col-lg-3 col-md-3 col-sm-3 col-12 best-sale-item">
                                    <div class="best-sale-item-inner">
                                        <div class="ribbon ribbon-top-right"><span>33%</span></div>

                                        <div class="best-sale-img">
                                            <a href=""><img src="<?php echo $urlThemeActive ?>asset/image/topsearch.png" alt=""></a>
                                        </div>

                                        <div class="best-sale-info">
                                            <div class="best-sale-name">
                                                <a href="">Đai Chườm Nóng Massage Giảm Đau Bụng Kinh BUMAS BU01</a>
                                            </div>

                                            <div class="best-sale-price">
                                                <p>1.0000.000</p>
                                            </div>

                                            <div class="best-sale-discount">
                                                <del>500.000</del><span> (50%)</span>
                                            </div>
                                        </div>

                                        <div class="progress-box">
                                            <div class="best-sale-progress">
                                                <div class="text-progress">Sản phẩm 30 Đã bán</div>
                                                <div class="sale-progress-val" style="width: 32%"></div>
                                            </div>
                                        </div>

                                        <div class="best-sale-rate">
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

                                <div class="col-lg-3 col-md-3 col-sm-3 col-12 best-sale-item">
                                    <div class="best-sale-item-inner">
                                        <div class="ribbon ribbon-top-right"><span>33%</span></div>

                                        <div class="best-sale-img">
                                            <a href=""><img src="<?php echo $urlThemeActive ?>asset/image/topsearch.png" alt=""></a>
                                        </div>

                                        <div class="best-sale-info">
                                            <div class="best-sale-name">
                                                <a href="">Đai Chườm Nóng Massage Giảm Đau Bụng Kinh BUMAS BU01</a>
                                            </div>

                                            <div class="best-sale-price">
                                                <p>1.0000.000</p>
                                            </div>

                                            <div class="best-sale-discount">
                                                <del>500.000</del><span> (50%)</span>
                                            </div>
                                        </div>

                                        <div class="progress-box">
                                            <div class="best-sale-progress">
                                                <div class="text-progress">Sản phẩm 30 Đã bán</div>
                                                <div class="sale-progress-val" style="width: 32%"></div>
                                            </div>
                                        </div>

                                        <div class="best-sale-rate">
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
                        <div class="list-product">
                            <div class="row">
                                <div class="col-lg-3 col-md-3 col-sm-3 col-12 best-sale-item">
                                    <div class="best-sale-item-inner">
                                        <div class="ribbon ribbon-top-right"><span>33%</span></div>
                                        <div class="best-sale-img">
                                            <a href=""><img src="<?php echo $urlThemeActive ?>asset/image/topsearch.png" alt=""></a>
                                        </div>

                                        <div class="best-sale-info">
                                            <div class="best-sale-name">
                                                <a href="">Đai Chườm Nóng Massage Giảm Đau Bụng Kinh BUMAS BU01</a>
                                            </div>

                                            <div class="best-sale-price">
                                                <p>1.0000.000</p>
                                            </div>

                                            <div class="best-sale-discount">
                                                <del>500.000</del><span> (50%)</span>
                                            </div>
                                        </div>

                                        <div class="progress-box">
                                            <div class="best-sale-progress">
                                                <div class="text-progress">Sản phẩm 30 Đã bán</div>
                                                <div class="sale-progress-val" style="width: 32%"></div>
                                            </div>
                                        </div>

                                        <div class="best-sale-rate">
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

                                <div class="col-lg-3 col-md-3 col-sm-3 col-12 best-sale-item">
                                    <div class="best-sale-item-inner">
                                        <div class="ribbon ribbon-top-right"><span>33%</span></div>

                                        <div class="best-sale-img">
                                            <a href=""><img src="<?php echo $urlThemeActive ?>asset/image/topsearch.png" alt=""></a>
                                        </div>

                                        <div class="best-sale-info">
                                            <div class="best-sale-name">
                                                <a href="">Đai Chườm Nóng Massage Giảm Đau Bụng Kinh BUMAS BU01</a>
                                            </div>

                                            <div class="best-sale-price">
                                                <p>1.0000.000</p>
                                            </div>

                                            <div class="best-sale-discount">
                                                <del>500.000</del><span> (50%)</span>
                                            </div>
                                        </div>

                                        <div class="progress-box">
                                            <div class="best-sale-progress">
                                                <div class="text-progress">Sản phẩm 30 Đã bán</div>
                                                <div class="sale-progress-val" style="width: 32%"></div>
                                            </div>
                                        </div>

                                        <div class="best-sale-rate">
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

                                <div class="col-lg-3 col-md-3 col-sm-3 col-12 best-sale-item">
                                    <div class="best-sale-item-inner">
                                        <div class="ribbon ribbon-top-right"><span>33%</span></div>

                                        <div class="best-sale-img">
                                            <a href=""><img src="<?php echo $urlThemeActive ?>asset/image/topsearch.png" alt=""></a>
                                        </div>

                                        <div class="best-sale-info">
                                            <div class="best-sale-name">
                                                <a href="">Đai Chườm Nóng Massage Giảm Đau Bụng Kinh BUMAS BU01</a>
                                            </div>

                                            <div class="best-sale-price">
                                                <p>1.0000.000</p>
                                            </div>

                                            <div class="best-sale-discount">
                                                <del>500.000</del><span> (50%)</span>
                                            </div>
                                        </div>

                                        <div class="progress-box">
                                            <div class="best-sale-progress">
                                                <div class="text-progress">Sản phẩm 30 Đã bán</div>
                                                <div class="sale-progress-val" style="width: 32%"></div>
                                            </div>
                                        </div>

                                        <div class="best-sale-rate">
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

                                <div class="col-lg-3 col-md-3 col-sm-3 col-12 best-sale-item">
                                    <div class="best-sale-item-inner">
                                        <div class="ribbon ribbon-top-right"><span>33%</span></div>

                                        <div class="best-sale-img">
                                            <a href=""><img src="<?php echo $urlThemeActive ?>asset/image/topsearch.png" alt=""></a>
                                        </div>

                                        <div class="best-sale-info">
                                            <div class="best-sale-name">
                                                <a href="">Đai Chườm Nóng Massage Giảm Đau Bụng Kinh BUMAS BU01</a>
                                            </div>

                                            <div class="best-sale-price">
                                                <p>1.0000.000</p>
                                            </div>

                                            <div class="best-sale-discount">
                                                <del>500.000</del><span> (50%)</span>
                                            </div>
                                        </div>

                                        <div class="progress-box">
                                            <div class="best-sale-progress">
                                                <div class="text-progress">Sản phẩm 30 Đã bán</div>
                                                <div class="sale-progress-val" style="width: 32%"></div>
                                            </div>
                                        </div>

                                        <div class="best-sale-rate">
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
            </div>
        </section>
    </main>
<?php
getFooter();?>