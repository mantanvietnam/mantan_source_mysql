<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/x-icon" href="https://designer.ezpics.vn/plugins/ezpics_designer/view/home/assets/img/avatar-ezpics.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <?php mantan_header();?>
    <link rel="stylesheet" href="/plugins/ezpics_designer/view/home/designer/assets/css/style.css?time=<?php echo  getdate()[0]; ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</head>
<body>
    <header>

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


        <section class="section-header">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
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
        <section id="designer-background">
            <img src="/plugins/ezpics_designer/view/home/designer/assets/img/banner.png" alt="">
        </section>
        <section id="designer-content">
            <div class="container-fluid">
                <div class="row row-designer-content">
                     <div class="col-lg-4 designer-information">
                        <div class="box-information">
                            <div class="designer-avatar">
                                <img src="<?php echo $designer->avatar ?>" alt="">
                            </div>

                            <div class="designer-name">
                                <p><?php echo $designer->name ?></p>
                            </div>

                            <div class="designer-button-group">
                                <a class="button-share" href="https://ezpics.page.link/vn1s">Theo dõi</a>
                                <a class="button-share" onclick="copyToClipboard('https://designer.ezpics.vn/designer/<?php echo $designer->name.'-'.$designer->id; ?>.html','share')"><i class="fa-solid fa-share-nodes"></i></a>
                            </div>

                            <div class="designer-bio">
                                <p><?php echo $designer->description ?></p>
                            </div>

                            <div class="designer-contact">
                                <p class="designer-social"><i class="fa-brands fa-facebook"></i> <?php echo $designer->email ?></p>
                                <p class="designer-social"><i class="fa-solid fa-phone"></i> <?php echo substr($designer->phone,0,5);?>***** </p>
                            </div>

                            <div class="designer-statistical">
                                <div class="designer-statistical-item">
                                    <div class="number-statistical">
                                        <p><?php echo @$quantityProduct ?></p>
                                    </div>
                                    <div class="name-statistical">
                                        <p>Mẫu thiết kế</p>
                                    </div>
                                </div>

                                <div class="designer-statistical-item">
                                    <div class="number-statistical">
                                        <p><?php echo @$quantityFollow ?></p>
                                    </div>
                                    <div class="name-statistical">
                                        <p>Theo dõi</p>
                                    </div>
                                </div>

                                <div class="designer-statistical-item">
                                    <div class="number-statistical">
                                        <p><?php echo @$quantitySell ?></p>
                                    </div>
                                    <div class="name-statistical">
                                        <p>Số lượng bán</p>
                                    </div>
                                </div>

                                <div class="designer-statistical-item">
                                    <div class="number-statistical">
                                        <p><?php echo @$quantityWarehouse ?></p>
                                    </div>
                                    <div class="name-statistical">
                                        <p>Số lượng kho</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-8 designer-product">
                        <div class="box-product">
                            <div class="top-box-product">
                                <h1 class="name-storage"><?php echo $Warehouse->name ?></h1>
                                <div class="designer-search">
                                    <form class="search-input d-none d-md-block" action="" method="get">
                                        <input placeholder="Tìm kiếm sản phẩm" type="text" value="<?php echo @$_GET['name'] ?>" name="name">
                                    </form>
                                </div>
                            </div>

                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-product" role="tabpanel" aria-labelledby="nav-product-tab">
                                    <div class="row">
                                        <?php if(!empty($listData)){ 
                                            foreach($listData as $key => $item){
                                         ?>
                                        <div class="product-item col-xl-3 col-lg-4 col-md-4">
                                            <a href="/detail/<?php echo @$item->slug.'-'.@$item->id ?>.html">
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
                                                    <p><?php echo number_format(@$item->price) ?>đ</p>
                                                </div>
                                            </a>
                                        </div>
                                         <?php }} ?>
                                    </div>
                                    <!-- Phân trang -->
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
                                <div class="tab-pane fade" id="nav-portfolio" role="tabpanel" aria-labelledby="nav-portfolio-tab">
                                    <img class="img-certification" src="../assets/img/file_0.png" alt="">
                                </div>
                            </div>
                        </div>
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
<script type="text/javascript">
  function copyToClipboard(textCopy,messId) {
    // Create a "hidden" input
    var aux = document.createElement("input");

    // Assign it the value of the specified element
    aux.setAttribute("value", textCopy);

    // Append it to the body
    document.body.appendChild(aux);

    // Highlight its content
    aux.select();

    // Copy the highlighted text
    document.execCommand("copy");

    // Remove it from the body
    document.body.removeChild(aux);

    // show mess
    alert('bạn đã sao chép link chia sẻ');

}
</script>
</html>