<?php getHeader();?>
	<!-- ::::::  Start  Breadcrumb Section  ::::::  -->
    <div class="page-breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 class="rs clsH3Blog">Combo sản phẩm</h1>
                    <ul class="list-inline rs">
                        <li class="list-inline-item"><a href="/">Trang chủ</a></li>
                        <li class="list-inline-item"><i class="fa fa-angle-right" aria-hidden="true"></i></li>
                        <li class="list-inline-item">Combo sản phẩm</li>
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
                            <div class="tab-pane show active shop-grid" id="sort-grid">
                                <div class="row">
                                    <?php 
                                    if(!empty($tmpVariable['listData'])){
                                        foreach ($tmpVariable['listData'] as $key => $value) { 
                                            ?>
                                        <!-- Start Single Default Product -->
                                        <div class="col-md-4 col-12">
                                            <div class="product__box product__default--single text-center">
                                            <!-- Start Product Image -->
                                                <div class="product__img-box  pos-relative">
                                                    <a style="height:280px;display:flex;align-items:center;justify-content:center" href="<?php echo $value['Merchandise']['urlProductDetail']; ?>" class="product__img--link">
                                                        <img class="product__img img-fluid" src="<?php echo $value['Merchandise']['image']; ?>" alt="">
                                                    </a>
                                                   
                                                    <!-- Start Product Action Link-->
                                                    <ul class="product__action--link pos-absolute">
                                                        <li><a onclick="addToCartQuick('<?php echo $value['Merchandise']['id'] ?>')" href="#modalAddCart<?php echo $key ?>" data-toggle="modal"><i class="icon-shopping-cart"></i></a></li>
                                                        
                                                        <li><a href="#modalQuickViewCate<?php echo $key ?>" data-toggle="modal"><i class="icon-eye"></i></a></li>
                                                    </ul> <!-- End Product Action Link -->
                                                </div> <!-- End Product Image -->
                                                <!-- Start Product Content -->
                                                <div class="product__content m-t-20">
                                                    <ul class="product__review">
                                                        <li class="product__review--fill"><i class="icon-star"></i></li>
                                                        <li class="product__review--fill"><i class="icon-star"></i></li>
                                                        <li class="product__review--fill"><i class="icon-star"></i></li>
                                                        <li class="product__review--fill"><i class="icon-star"></i></li>
                                                        <li class="product__review--fill"><i class="icon-star"></i></li>
                                                    </ul>
                                                    <a href="<?php echo $value['Merchandise']['urlProductDetail']; ?>" class="product__link"><?php echo $value['Merchandise']['name']; ?></a>
                                                    <div class="product__price m-t-5">
                                                        <span class="product__price"><?php echo number_format($value['Merchandise']['price']); ?>đ</span>
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

                    <!-- post pagination -->

                        <?php

                        $page = $tmpVariable['page'];
                        $totalPage = $tmpVariable['totalPage'];
                        $startPage = $tmpVariable['headPage'];
                        $endPage = $tmpVariable['endPage'];
                        $back = $tmpVariable['back'];
                        $next = $tmpVariable['next'];
                        $urlPage = $tmpVariable['urlPage'];
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
                        
                        if($totalPage>1){
                        ?>
                     
                        <!-- post pagination --> 

                    <div class="page-pagination">
                        <ul class="page-pagination__list">
                            <li class="page-pagination__item"><a class="page-pagination__link"  href="<?php echo $urlPage . $back ?>">Trước</a>
                            </li>
                            <?php for ($i = $startPage; $i <= $endPage; $i++) { ?>
                                    <li class="page-pagination__item"><a class="page-pagination__link <?php echo $i==$page?'active" ':'" href="'.$urlPage.$i.'"' ?>"><?php echo $i; ?></a></li>
                            <?php 
                        	} ?>

                            <li class="page-pagination__item"><a class="page-pagination__link"  href="<?php echo $urlPage . $next ?>">Sau</a>
                            </li>
                          </ul>
                    </div>
                <?php } ?>
                </div>  <!-- Start Rightside - Product Type View -->
            </div>
        </div>
    </main>  <!-- :::::: End MainContainer Wrapper :::::: -->
<!-- Start Modal Add cart -->
<?php
if(!empty($tmpVariable['listData'])){
foreach ($tmpVariable['listData'] as $key => $value) { ?>
<div class="modal fade" id="modalAddCart<?php echo $key ?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col text-right">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true"> <i class="fal fa-times"></i></span>
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-7">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="modal__product-img">
                                        <img class="img-fluid" src="<?php echo $value['Merchandise']['image'] ?>" alt="">
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="link--green link--icon-left"><i class="fal fa-check-square"></i>Đã thêm vào giỏ hàng!</div>
                                    <div class="modal__product-cart-buttons m-tb-15">
                                        <a href="/cart" class="btn btn--box  btn--tiny btn--green btn--green-hover-black btn--uppercase">Giỏ hàng</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5 modal__border">
                            <ul class="modal__product-shipping-info">
                                
                                <li>Tổng giá: <span><?php echo number_format($value['Merchandise']['price']) ?>đ</span></li>
                                <li><a href="#" class="btn text-underline color-green" data-dismiss="modal">TIẾP TỤC MUA HÀNG</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End Modal Add cart -->
<div class="modal fade" id="modalQuickViewCate<?php echo $key ?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col text-right">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true"> <i class="fal fa-times"></i></span>
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="product-gallery-box m-b-60">
                                <div class="modal-product-image--large">
                                    <img class="img-fluid" src="<?php echo $value['Merchandise']['image'] ?>" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="product-details-box">
                                <div style="font-size:1.25em" class="title title--normal m-b-20"><?php echo $value['Merchandise']['name'] ?></div>
                                <div class="product__price">
                                    <span class="product__price-del"><?php echo number_format($value['Merchandise']['price']) ?>đ</span>
                                </div>
                                <ul class="product__review m-t-15">
                                    <li class="product__review--fill"><i class="icon-star"></i></li>
                                    <li class="product__review--fill"><i class="icon-star"></i></li>
                                    <li class="product__review--fill"><i class="icon-star"></i></li>
                                    <li class="product__review--fill"><i class="icon-star"></i></li>
                                    <li class="product__review--fill"><i class="icon-star"></i></li>
                                </ul>
                                <div class="product__desc m-t-25 m-b-30">
                                    <p>
                                        <?php 
                                            if(!empty($value['Merchandise']['combo'])){
                                                echo '  <table class="table table-bordered">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">Sản phẩm</th>
                                                                    <th scope="col">Số lượng</th>
                                                                    </tr>
                                                            </thead>
                                                            <tbody>';
                                                            foreach ($value['Merchandise']['combo'] as $item) {

                                                                echo '  <tr>
                                                                            <td>'.$item['Merchandise']['name'].'</td>
                                                                            <td>'.number_format($item['Merchandise']['numberCombo']).' '.@$item['Merchandise']['unit'].'</td>
                                                                        </tr>';
                                                            }
                                                echo        '</tbody>
                                                        </table>';
                                            }else{
                                                echo @nl2br($value['Merchandise']['note']);
                                            }
                                        ?>  
                                    </p>
                                </div>

                                <div class="product-var p-t-30">
                                    <div class="product-quantity product-var__item d-flex align-items-center flex-wrap">
                                        <span class="product-var__text">Số lượng: </span>
                                        <form class="modal-quantity-scale m-l-20">
                                            <div style="width:20px" class="value-button" id="modal-decrease" onclick="decreaseValueCate('<?php echo $value['Merchandise']['id'] ?>')">-</div>
                                            <input style="text-align:center" type="number" id="modal-numberCate<?php echo $value['Merchandise']['id'] ?>" value="1" />
                                            <div style="width:20px" class="value-button" id="modal-increase" onclick="increaseValueCate('<?php echo $value['Merchandise']['id'] ?>')">+</div>
                                        </form>
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="link--green link--icon-left"><i class="fal fa-check-square"></i><span id="mesCate<?php echo $value['Merchandise']['id'] ?>"></span></div>
                                    <div class="modal__product-cart-buttons m-tb-15">
                                        <a onclick="addToCart('<?php echo $value['Merchandise']['id'] ?>')" class="btn btn--box  btn--tiny btn--green btn--green-hover-black btn--uppercase">Thêm vào giỏ hàng</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End Modal Quickview cart -->
<?php
}
}?>
<?php getFooter() ?>
<script>

    // in_number all
        function increaseValueCate(in_number) {
          var value = parseInt(document.getElementById('modal-numberCate'+in_number).value, 10);
          value = isNaN(value) ? 0 : value;
          value++;
          document.getElementById('modal-numberCate'+in_number).value = value;
        }
        function decreaseValueCate(in_number) {
          var value = parseInt(document.getElementById('modal-numberCate'+in_number).value, 10);
          value = isNaN(value) ? 0 : value;
          value < 1 ? value = 1 : '';
          value--;
          document.getElementById('modal-numberCate'+in_number).value = value;
        }

    // cart all
    
        function addToCartQuick(idProductShow) {
            var number= 1;
            $.ajax({
              type: "POST",
              url: "/saveOrderProduct_addProduct",
              data: {id:idProductShow,numberOrder:number}
            }).done(function( msg ) {
                var slCart = $('#id_NumberProduct').text();
                slCart = parseInt(slCart);
                slCart = slCart+1;
                $('.wishlist-item-count').text(slCart);
            });
        }

        function addToCart(idProductShow) {
            var number= $('#modal-numberCate'+idProductShow).val();
            $.ajax({
              type: "POST",
              url: "/saveOrderProduct_addProduct",
              data: {id:idProductShow,numberOrder:number}
            }).done(function( msg ) {
                document.getElementById("mesCate"+idProductShow).innerHTML = "Sản phẩm đã được thêm vào giỏ hàng";

                var slCart = $('#id_NumberProduct').text();
                slCart = parseInt(slCart);
                slCart = slCart+1;
                $('.wishlist-item-count').text(slCart);
            });
        }
   
</script>