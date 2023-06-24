<?php include(__DIR__.'/../headerPublic.php') ; ?>
    <main>
        <section id="designer-background">
            <img src="/plugins/ezpics_designer/view/home/designer/assets/img/background-banner-header.png" alt="">
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
                                <img src="/plugins/ezpics_designer/view/home/designer/assets/img/tich-xanh.png" alt="">
                            </div>

                            <div class="designer-button-group">
                                <a class="button-share" href="<?php echo $designer->link_open_app ; ?>"><i class="fa-solid fa-user-plus"></i> Theo dõi</a>
                                <a class="button-share button-share-link" onclick="copyToClipboard('https://designer.ezpics.vn/designer/<?php echo createSlugMantan($designer->name).'-'.$designer->id; ?>.html','share')"><i class="fa-solid fa-share-nodes"></i></a>
                            </div>

                            <div class="designer-bio">
                                <p><?php echo $designer->description ?></p>
                            </div>

                            <div class="designer-contact">
                                <p class="designer-social"><i class="fa-solid fa-envelope"></i> <?php echo $designer->email ?></p>
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
                                        <button class="nav-link" id="nav-storage-tab" data-bs-toggle="tab" data-bs-target="#nav-storage" type="button" role="tab" aria-controls="nav-storage" aria-selected="false">Kho</button>

                                    </div>
                                </nav>

                                <div class="designer-search">
                                	<form class="search-input d-md-block" action="" method="get">
                                    	<input placeholder="Tìm kiếm sản phẩm" type="text" value="<?php echo @$_GET['name'] ?>" name="name">
                                    </form>
                                </div>
                            </div>

                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-product" role="tabpanel" aria-labelledby="nav-product-tab">
                                    <div class="row">

                                    	<?php 
                                        if(!empty($product)){	
                                    		foreach($product as $key => $item){
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
                                        <div class="product-item col-xl-3 col-lg-4 col-md-4">
                                            <a href="/detail/<?php echo @$item->slug.'-'.@$item->id ?>.html">
                                                <div class="product-img">
                                                    <img src="<?php echo $thumbnail; ?>" alt="">
                                                </div>
                                                <div class="product-title">
                                                    <p><?php echo @$item->name ?></p>
                                                </div>
                                                <div class="product-sold">
                                                    <p>Đã bán :<span> <?php echo @$item->sold ?></span></p>
                                                </div>
                                                <div class="product-price">
                                                    <?php echo $price ?>
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

                                <div class="tab-pane fade" id="nav-storage" role="tabpanel" aria-labelledby="nav-storage-tab">
                                    <div class="row">
                                        <?php  if(!empty($Warehouse)){
                                                foreach($Warehouse as $key => $item){
                                         ?>
                                            <div class="product-item col-xl-3 col-lg-4 col-md-4">
                                                <a href="/detailWarehouse/<?php echo @$item->slug.'-'.@$item->id ?>.html">
                                                    <div class="product-img">
                                                        <img src="<?php echo @$item->thumbnail ?>" alt="">
                                                    </div>
                                                    <div class="product-title">
                                                        <p><?php echo @$item->name ?></p>
                                                    </div>
                                                    <div class="product-sold">
                                                        <p>Đã bán :<span><?php echo @$item->date_use ?></span></p>
                                                    </div>
                                                    <div class="product-price">
                                                        <p><?php echo number_format($item->price) ?> đ</p>
                                                        <p class="day-storage">30 ngày</p>
                                                    </div>
                                                </a>
                                            </div>

                                        <?php }} ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
    </main>

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
            alert('Đã sao chép link chia sẻ vào bộ nhớ đệm của bạn.');
        }
    </script>

    <?php include(__DIR__.'/../footerPublic.php') ; ?>