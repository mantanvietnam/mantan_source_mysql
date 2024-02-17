<?php getHeader();?>
	<div class="page-breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 class="rs clsH3Blog">Thông tin tài khoản</h1>
                    <p>Điểm tích lũy của bạn: <span class="my_c_green"><?php echo @number_format($tmpVariable['infoCustom']['point']);?> điểm</span></p>
                </div>
            </div>
        </div>
    </div> <!-- ::::::  End  Breadcrumb Section  ::::::  -->

    <main id="main-container" class="main-container">
        <div class="container">
            <div class="row flex-column-reverse flex-lg-row">
                <!-- Start Leftside - Sidebar Widget -->
                <?php getSidebar();?>
                <!-- End Left Sidebar Widget -->

                <!-- Start Rightside - Product Type View -->
                <div class="col-lg-9">

                    <ul class="wr_items">
						<li class="items-inner"><span>Tên tài khoản</span> <span><?php echo $tmpVariable['infoCustom']['cus_name'] ?></span> </li>
						<li class="items-inner"><span>Số điện thoại</span> <span><?php echo $tmpVariable['infoCustom']['phone'] ?></span> </li>
						<li class="items-inner"><span>Email</span> <span><?php echo $tmpVariable['infoCustom']['email'] ?></span> </li>
						<li class="items-inner"><span>Điểm tích lũy</span> <span><?php echo @number_format($tmpVariable['infoCustom']['point']) ?></span></li>
                        <a href="<?php echo $urlHomes ?>listOrder"><li class="items-inner"><span>Đơn hàng của bạn</span><i class="fal fa-file-alt"></i></li></a>
						<a href="<?php echo $urlHomes ?>gift"><li class="items-inner"><span>Đổi quà</span><i class="fal fa-gift"></i></li></a>
						<a href="<?php echo $urlHomes ?>listGiftUser"><li class="items-inner"><span>Quà đã đổi</span> <i class="fal fa-gift-card"></i></li></a>
						<li class="items-inner"><span>SĐT Giới thiệu</span> <span><?php echo @$tmpVariable['infoCustom']['phoneAffiliate'] ?></span></li>
						<a href="<?php echo $urlHomes ?>logout"><li class="items-inner"><span>Đăng xuất</span> <i class="fas fa-sign-out-alt"></i></li></a>
					</ul>

                </div>  <!-- Start Rightside - Product Type View -->
            </div>
        </div>
    </main>  <!-- :::::: End MainContainer Wrapper :::::: -->

<?php getFooter() ?>