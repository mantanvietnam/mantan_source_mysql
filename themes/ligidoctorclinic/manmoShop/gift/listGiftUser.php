<?php getHeader() ?>
	<!-- ::::::  Start  Breadcrumb Section  ::::::  -->
    <div class="page-breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 class="rs clsH3Blog">QÙA TẶNG CỦA BẠN</h1>
                    <ul class="list-inline rs">
                        <li class="list-inline-item"><a href="/">TRANG CHỦ</a></li>
                        <li class="list-inline-item"><i class="fa fa-angle-right" aria-hidden="true"></i></li>
                        <li class="list-inline-item">QUÀ TẶNG</li>
                    </ul>
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
                                        <a href="<?php echo $urlHomes ?>gift/" class="btn_dkdn btn-doiqua">Đổi quà</a>
                                    </div>
                                    <?php 
                                    if(!empty($tmpVariable['listGift']['listData'])){
                                        foreach ($tmpVariable['listGift']['listData'] as $key => $value) { 
                                            $status= ($value['RequestGiftExchange']['status']=='new')?'Chưa sử dụng':'Đã sử dụng';
                                            ?>
                                            <!-- Start Single Default Product -->
                                            <div class="col-md-4 col-12">
                                                <div class="product__box product__default--single text-center">
                                                <!-- Start Product Image -->
                                                    <div class="product__img-box  pos-relative">
                                                        <img class="product__img img-fluid" src="<?php echo $value['RequestGiftExchange']['infoGiftExchange']['image']; ?>" alt="">
                                                    </div> <!-- End Product Image -->
                                                    <!-- Start Product Content -->
                                                    <div class="product__content m-t-20">
                                                        <?php echo $value['RequestGiftExchange']['infoGiftExchange']['content']; ?>
                                                        <div class="product__price m-t-5">
                                                            <span class="product__price">Mã đổi quà: <?php echo $value['RequestGiftExchange']['code']; ?></span>
                                                        </div>
                                                        <br/>
                                                        <span><?php echo $status;?></span>
                                                    </div> <!-- End Product Content -->
                                                </div>
                                            </div>
                                             <!-- End Single Default Product -->
                                    <?php }
                                    } else{ ?>
                                        <div class="col-md-4 col-12 m-t-10">Bạn chưa có yêu cầu đổi quà nào </div>
                                    <?php
                                    } ?>
                                </div>
                            </div>
                            
                        </div>
                    </div>

                </div>  <!-- Start Rightside - Product Type View -->
            </div>
        </div>
    </main>  <!-- :::::: End MainContainer Wrapper :::::: -->
<!-- Start Modal Add cart -->

<?php getFooter() ?>

<?php if(!empty($tmpVariable['mess'])) { ?>
    <div id="messModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Thông báo</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <?php
                        echo $tmpVariable['mess'];  
                    ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('#messModal').modal('show');
    </script>
<?php } ?>