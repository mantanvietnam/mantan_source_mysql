
<?php include(__DIR__.'/../headerPublic.php') ; ?>
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
                            <p>Tác giả: <a class="product-name-user" href="<?php echo $user->link_open_app ; ?>"><?php echo $user->name ?></a></p>
                            <p>Lượt xem: <span><?php echo $product->views ?></span></p>
                            <!-- <p>Đã bán: <span><?php echo $product->sold ?></span></p>
                            <div class="price-product">
                                <p>Giá bán: <span><?php echo $sale_price  ?></span></p>
                            </div> -->
                            <p>Đã tạo: <span><?php echo number_format($product->export_image) ?> ảnh</span></p>
                            <?php if(!empty($description)){ ?>
                            <p><span><?php echo $description ?></span></p>
                            <?php } ?>
                        </div>
                        <br>
                        <br>
                        <div class="product-button">
                            <!-- <button><a href="<?php echo $link_open_app ?>">Mua mẫu ngay</a></button> -->
                            <button type="button" class="btn btn-warning mt-3" onclick="showPopup();">
                            <i class="fa-solid fa-pen-to-square"></i> Nhập thông tin
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php   } ?>
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
                        $price = ' <p>Miễn phí</p>';
                    }else{
                        $price =  '<p>'.number_format($item->sale_price).'đ</p>';
                    }

                    if($item->price>0){
                        $price .= '  <p><del>'.number_format($item->price).'đ</del</p>';
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
                                        <?php echo $price ?>
                                    </div>
                                </a>
                            </div>
                        <?php }}} ?>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <script type="text/javascript">
        function showPopup()
        {
            $('#exampleModal').modal('show');
        }
    </script>
    <!-- Modal -->

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <form action="/create-image-series" method="post" enctype="multipart/form-data">
            <input type="hidden" name="_csrfToken" value="<?php echo $csrfToken;?>" />
            <input type="hidden" name="id" value="<?php echo $product->id;?>">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nhập thông tin</h5>
              </div>
              <div class="modal-body">
                <?php 
                    if(!empty($listLayer)){
                        foreach ($listLayer as $layer) {
                            $content = json_decode($layer->content, true);

                            if(!empty($content['variable']) && !empty($content['variableLabel'])){
                                echo '<p>'.$content['variableLabel'].'</p>';

                                if($content['type'] == 'text'){
                                    echo '<input required type="text" name="'.$content['variable'].'" value="" class="form-control" />';
                                }else if($content['type'] == 'image'){
                                    echo '<input required type="file" name="'.$content['variable'].'" value="" class="form-control" />';
                                }


                            }
                        }
                    }
                ?>

              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-warning">Tạo file</button>
              </div>
            </div>
        </form>
      </div>
    </div>
    
    <?php include(__DIR__.'/../footerPublic.php') ; ?>