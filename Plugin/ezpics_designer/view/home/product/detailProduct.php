<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <?php mantan_header();?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="icon" type="image/x-icon" href="https://designer.ezpics.vn/plugins/ezpics_designer/view/home/assets/img/avatar-ezpics.png" />

    <link rel="stylesheet" href="/plugins/ezpics_designer/view/home/designer/assets/css/style.css?time=<?php echo  getdate()[0]; ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css"  href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
      <script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'G-PCQ02R5K9G');
	</script>
</head>
<body>
<header>
    <section class="section-header">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid header-menu-mobile">
                <button class="button-header">
                    <i class="fa-solid fa-bars"></i>
                </button>

                <div class="logo-header">
                        <a href="#"><img src="https://designer.ezpics.vn/plugins/ezpics_designer/view/home/assets/img/avatar-ezpics.png" alt=""></a>
                </div>

                <div class="menu-mobile">
                    <ul class="navbar-nav mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="https://ezpics.vn/tinh-nang/">TÍNH NĂNG</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="https://ezpics.vn/mau-thiet-ke-noi-bat/">MẪU THIẾT KẾ NỔI BẬT</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="https://huongdan.ezpics.vn/">HƯỚNG DẪN SỬ DỤNG</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="https://ezpics.vn/category/blog/">BLOG</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="https://ezpics.vn/lien-he/">LIÊN HỆ</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="container-fluid">
                <div class="navbar-header collapse navbar-collapse" id="navbarTogglerDemo01">
                <div class="col-5 header-menu">
                    <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="https://ezpics.vn/tinh-nang/">TÍNH NĂNG</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="https://ezpics.vn/mau-thiet-ke-noi-bat/">MẪU THIẾT KẾ NỔI BẬT</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="https://huongdan.ezpics.vn/">HƯỚNG DẪN SỬ DỤNG</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="https://ezpics.vn/category/blog/">BLOG</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="https://ezpics.vn/lien-he/">LIÊN HỆ</a>
                    </li>
                    </ul>
                </div>

                <div class="col-2">
                    <div class="logo-header">
                        <a href="#"><img src="https://designer.ezpics.vn/plugins/ezpics_designer/view/home/assets/img/avatar-ezpics.png" alt=""></a>
                    </div>
                </div>
                

                <div class="col-5 header-search">
                    
                    <form class="d-flex">
                        <a class="download-button-header" href="https://huongdan.ezpics.vn/tai-app-ezpics">TẢI EZPICS MIỄN PHÍ</a>
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </form>
                </div>
                </div>
            </div>
            </nav>
    </section>
</header>


    <main>
      
        <?php
            if(!empty($product)){
                if($product->sale_price==0){
                    $sale_price = 'Miễn phí';
                }else{
                    $sale_price = number_format($product->sale_price).'đ';
                }

                if($product->price>0){
                    $sale_price .= ' <del>'.number_format($product->price).'đ</del>';
                }

                $description = (!empty($product->description))?nl2br($product->description):''?>
        <section id="product-details">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 col-md-7 col-12 product-img">
                        <div class="product-img-item">
                            <img src="<?php echo $product->image ?>" alt="">
                        </div>
                    </div>

                    <div class="col-lg-5 col-md-5 col-12 product-information">
                        <h1 class="product-title"><?php echo $product->name ?></h1>
                        <div>
                            <p>Tác giả: <span><?php echo $user->name ?></span></p>
                            <p>Lượt xem: <span><?php echo $product->views ?></span></p>
                            <p>Đã bán: <span><?php echo $product->sold ?></span></p>
                            <div class="price-product">
                                <p>Giá bán: <span><?php echo $sale_price  ?></span></p>
                            </div>
                            <?php if(!empty($description)){ ?>
                            <p>Mô tả: <span><?php echo $description ?></span></p>
                            <?php } ?>
                        </div>
                        <br>
                        <br>
                        <div class="product-button">
                            <button><a href="<?php echo $link_open_app ?>">Mua mẫu ngay</a></button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
	<?php	} ?>
        <section id="product-other">
            <div class="product-other-title">
                <div class="container">
                    <h2>Sản phẩm khác</h2>
                </div>
            </div>

            <div class="product-other-list">
                <div class="container">
                    <div class="product-other-slide">
                    	<?php if (!empty($dataOther)){
                    		foreach($dataOther as $key => $item){
                    			if(@$item->id != $product->id){
                    				if($item->sale_price==0){
						$price = 'Miễn phí';
					}else{
						$price = number_format($item->sale_price).'đ';
					}

					if($item->price>0){
						$price .= ' <del>'.number_format($item->price).'đ</del>';
					}
                    	?>
	                        <div class="product-item col-xl-3 col-lg-4 col-md-4">
	                            <a href="/detail/<?php echo @$item->name.'-'.@$item->id ?>.html">
	                                <div class="product-img">
	                                    <img src="<?php echo @$item->thumbnail ?>" alt="">
	                                </div>
	                                <div class="product-title">
	                                    <p><?php echo @$item->name ?></p>
	                                </div>
	                                <div class="product-sold">
	                                    <p>Đã bán :<span><?php echo @$item->sold ?></span></p>
	                                </div>
	                                <div class="product-price">
	                                    <p><?php echo $price ?>	</p>
	                                </div>
	                            </a>
	                        </div>
                        <?php }}} ?>
                    </div>
                </div>
            </div>
        </section>
        
    </main>
    
    <footer>
        <section id="section-footer">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-5 col-md-5 footer-left">
                        <div class="logo-footer">
                            <img src="https://designer.ezpics.vn/plugins/ezpics_designer/view/home/assets/img/avatar-ezpics.png" alt="">
                        </div>

                        <div class="downloadapp-footer">
                            <div class="downloadapp-footer-title">
                                <p>Tải ứng dụng miễn phí</p>
                            </div>

                            <div class="downloadapp-footer-item">
                                <a href="https://apps.apple.com/vn/app/ezpics-kho-m%E1%BA%ABu-thi%E1%BA%BFt-k%E1%BA%BF-%E1%BA%A3nh/id1659195883?l=vi"><img src="/plugins/ezpics_designer/view/home/designer/assets/img/logo-appstore-download-300x95.png" alt=""></a>
                                <a href="https://play.google.com/store/apps/details?id=vn.ezpics&hl=vi&gl=US"><img src="/plugins/ezpics_designer/view/home/designer/assets/img/Logo-google-play-store-e1578969817208-300x95.png" alt=""></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-3 col-md-3 footer-right">
                        <div class="menu-footer menu-footer-one">
                            <ul>
                                <p>Công cụ thiết kế ảnh</p>
                                <li>Thiết kế Banner - Poster độc đáo</li>
                                <li>Dành cho lập trình viên</li>
                                <li>Dành cho Nhà Thiết Kế</li>
                                <li>Giải pháp doanh nghiệp</li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-12 col-lg-3 col-md-3 footer-right">
                        <div class="menu-footer menu-footer-two">
                            <ul>
                                <p>GIỚI THIỆU</p>
                                <li>Giới thiệu</li>
                                <li>Blog</li>
                                <li>Công việc</li>
                                <li>Nhãn hiệu</li>
                                <li>Thông tin truyền thông</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="section-footer-bottom">
            <div class="container footer-bottom-container">
                <div class="footer-bottom-link">
                    <a>Điều khoản sử dụng</a>
                    <a>Chính sách quyền riêng tư</a>
                    <a>Chính sách bảo mật</a>
                </div>

                <div class="footer-bottom-copyright">
                    <p>@2023 Ezpics.vn</p>
                </div>
            </div>
        </section>
 
   <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script type="text/javascript" src="/plugins/ezpics_designer/view/home/designer/assets/js/slick.js?time=<?php echo  getdate()[0]; ?>"></script>

</footer>
</body>

</html>