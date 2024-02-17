<?php getHeader();
global $urlHomes;
?>
	<!-- ::::::  Start  Breadcrumb Section  ::::::  -->
    <div class="page-breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 class="rs clsH3Blog">TÍCH ĐIỂM ĐỔI QUÀ</h1>
                    <p>Điểm tích lũy của bạn: <span class="my_c_green"><?php echo @number_format($tmpVariable['infoCustom']['user']['Custom']['point']);?> điểm</span></p>
                </div>
            </div>
        </div>
    </div> <!-- ::::::  End  Breadcrumb Section  ::::::  -->

    <!-- :::::: Start Main Container Wrapper :::::: -->
    <main id="main-container" class="main-container">
        <div class="container">
            <div class="row flex-column-reverse flex-lg-row">
                <!-- Start Leftside - Sidebar Widget -->
                <?php getSidebar();?>
                <!-- End Left Sidebar Widget -->

                <!-- Start Rightside - Product Type View -->
                <div class="col-lg-9">

                    <div class="product-tab-area">
                        <div class="tab-content tab-animate-zoom">
                            <div class="tab-pane shop-grid active" id="sort-grid">
                                <div class="row">
                                    <div class="col-12 clsFl_r ">
                                        <a href="<?php echo $urlHomes ?>listGiftUser/" class="btn_dkdn btn-doiqua">Quà đã đổi</a>
                                    </div>
                                    <?php 
                                    if(!empty($tmpVariable['listData']['listGiftExchange'])){
                                        foreach ($tmpVariable['listData']['listGiftExchange'] as $key => $value) { ?>
                                            <!-- Start Single Default Product -->
                                            <div class="col-sm-6 col-md-4 col-6">
                                                <div class="product__box product__default--single text-center">
                                                <!-- Start Product Image -->
                                                    <div class="product__img-box  pos-relative">
                                                        <a onclick="return checkPoint(<?php echo number_format($value['GiftExchange']['point']); ?>);" class="my_product__img-box" style="display: inline-flex;align-items:center" href="<?php echo '/activeGift/?id='.$value['GiftExchange']['id']; ?>" class="product__img--link">
                                                            <img class="product__img img-fluid" src="<?php echo $value['GiftExchange']['image']; ?>" alt="">
                                                        </a>
                                                        <!-- Start Procuct Label -->
                                                        
                                                        <!-- End Procuct Label -->
                                                        <!-- Start Product Action Link-->
                                                        <ul class="product__action--link pos-absolute">
                                                            <li><a onclick="return checkPoint(<?php echo number_format($value['GiftExchange']['point']); ?>);" href="<?php echo '/activeGift/?id='.$value['GiftExchange']['id']; ?>" ><i class="icon-shopping-cart"></i></a></li>
                                                            
                                                        </ul> <!-- End Product Action Link -->
                                                    </div> <!-- End Product Image -->
                                                    <!-- Start Product Content -->
                                                    <div class="product__content m-t-20">
                                                        
                                                        <a onclick="return checkPoint(<?php echo number_format($value['GiftExchange']['point']); ?>);" href="<?php echo '/activeGift/?id='.$value['GiftExchange']['id']; ?>" class="product__link"><?php echo $value['GiftExchange']['content']; ?></a>
                                                        <div class="product__price m-t-5">
                                                            <span class="product__price my_f_weight_none">Trị giá: <?php echo number_format($value['GiftExchange']['point']); ?> điểm</span>
                                                        </div>
                                                    </div> <!-- End Product Content -->
                                                </div>
                                            </div>
                                             <!-- End Single Default Product -->
                                    <?php
                                        } 
                                    }
                                    ?>
                                </div>
                            </div>
                            
                        </div>
                    </div>

                </div>  <!-- Start Rightside - Product Type View -->
            </div>
        </div>
    </main>  <!-- :::::: End MainContainer Wrapper :::::: -->
<!-- Start Modal Add cart -->

<script type="text/javascript">
    var pointCus= <?php echo @number_format($tmpVariable['infoCustom']['user']['Custom']['point']);?>;

    function checkPoint(pointGift)
    {
        if(pointGift>pointCus){
            alert('Điểm tích lũy của bạn không đủ để đổi quà này');
            return false;
        }else{
            return confirm('Bạn sẽ bị trừ '+pointGift+' điểm khi đổi quà này');
        }
    }
</script>
<?php getFooter() ?>