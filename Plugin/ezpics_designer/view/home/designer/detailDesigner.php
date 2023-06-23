<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
     <!-- Favicon -->
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
                                <button class="button-share">Chia sẻ</button>
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
                                <nav>
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                        <button class="nav-link active" id="nav-product-tab" data-bs-toggle="tab" data-bs-target="#nav-product" type="button" role="tab" aria-controls="nav-product" aria-selected="true">Sản phẩm</button>
                                        <button class="nav-link" id="nav-portfolio-tab" data-bs-toggle="tab" data-bs-target="#nav-portfolio" type="button" role="tab" aria-controls="nav-portfolio" aria-selected="false">Portfolio</button>
                                    </div>
                                </nav>

                                <div class="designer-search">
                                	<form class="search-input d-none d-md-block" action="" method="get">
                                    	<input placeholder="Tìm kiếm sản phẩm" type="text" value="<?php echo @$_GET['name'] ?>" name="name">
                                    </form>
                                </div>
                            </div>

                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-product" role="tabpanel" aria-labelledby="nav-product-tab">
                                    <div class="row">

                                    	<?php if(!empty($product)){	
                                    		foreach($product as $key => $item){
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
                                    <img class="img-certification" src="<?php echo @$designer->certificate ?>" alt="">
                                    <?php if(!empty($designer->file_cv)){?>
                                    	<img class="img-certification" src="<?php echo @$designer->file_cv ?>" alt="">
                                   <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
    </main>
</body>

</html>