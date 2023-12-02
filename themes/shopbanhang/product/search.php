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
                  <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                  <li class="breadcrumb-item"><a href="/allProduct">Sản Phẩm</a></li>
                  <!-- <li class="breadcrumb-item active">Data</li> -->
                </ul>
            </div>
        </section>

        <div class="container">
            <section id="section-banner-home">
                <div class="">
                    <div class="banner-home-slide">
                        <?php if(!empty($slide_home->imageinfo)){
                            foreach($slide_home->imageinfo as $key => $item){ ?>
                    <div class="banner-home-item">
                        <a href="<?php echo $item->link ?>">
                        <img src="<?php echo $item->image ?>" alt="">
                        </a>
                    </div>
                <?php }} ?>
                    </div>
                </div>
            </section>
        </div>
      

        <section id="section-group-by">
            <div class="container">
                <div class="search-form-category">
                    <form action="/search-product" method="get" id="myForm" >
                        <div class="row">
                            <div class="search-category-product col-lg-3 col-md-3 col-sm-3 col-12">
                                <img src="<?php echo $urlThemeActive ?>asset/image/iconsearch.png" alt="">
                                <input placeholder="Tìm kiếm theo sản phẩm" type="text" class="form-control" id="key" value="<?php echo @$_GET['key'] ?>" name="key" aria-describedby="">
                                <input class="form-check-input" type="hidden" name="category_id" id="inlineCheckbox1" value="<?php echo @$_GET['category_id']; ?>">
                                <input class="form-check-input" type="hidden" id="selaqqqqqqqq"   name="selaa" id="inlineCheckbox1" value="qqq">
                            </div>
                            <div class="product-select col-lg-9 col-md-9 col-sm-9 col-12">
                                <div class="product-select-box">
                                    <div class="product-select-item product-select-left">
                                        <div class="heading-check">
                                            <span>Khuyễn mãi</span>
                                        </div>
                                        <div class="form-check ">
                                            <input class="form-check-input" type="checkbox" id="sela" onclick="actioncheckbox(<?php  if(!empty($_GET['sela'])){ echo '1'; }else{ echo '0'; } ?>)"  name="sela" id="inlineCheckbox1" <?php  if(!empty($_GET['sela'])){ echo 'checked'; } ?> value="sela">

                                             
                                        </div>
                                    </div>

                                    <div class="product-select-item product-select-right">
                                        <div class="heading-check">
                                            <span>Sắp xếp</span>
                                        </div>
                                        <select class="form-select form-select-sm" id="order"  onchange="actionSelect(this);"  name="order">
                                            <option value="">Sắp xếp theo</option>
                                            <option <?php  if(!empty($_GET['order']) && @$_GET['order']==1){ echo 'selected'; } ?> data-link="/search-product?order=1" value="1">Sản phẩm bán chạy nhất</option>
                                            <option <?php  if(!empty($_GET['order']) && @$_GET['order']==2){ echo 'selected'; } ?> data-link="/search-product?order=2" value="2">Giá từ cao đến thấp</option>
                                            <option <?php  if(!empty($_GET['order']) && @$_GET['order']==3){ echo 'selected'; } ?> data-link="/search-product?order=3" value="3">Giá từ thấp đến cao</option>
                                            <option <?php  if(!empty($_GET['order']) && @$_GET['order']==4){ echo 'selected'; } ?> data-link="/search-product?order=4" value="4">Sản phẩm mới nhất</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>

        <section id="section-cateogry-product">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-12">
                        <!-- <div class="search-category-product">
                            <form onsubmit="" action="/allProduct" method="get" class="form-custom-1 py-3">
                                <img src="<?php echo $urlThemeActive ?>asset/image/iconsearch.png" alt="">
                                <input placeholder="Tìm kiếm theo sản phẩm" type="text" class="form-control" id="" name="name" aria-describedby="">
                            </form>
                        </div> -->

                        <div class="category-product-menu">
                            <div class="category-product-item">
                                <ul>
                                    <div class="category-product-menu-title">
                                        <p>Danh mục sản phẩm </p>
                                    </div>
                                    <?php 
                                        if(!empty($category_all)){
                                            foreach ($category_all as $key => $value) {
                                                if(@$value->description!='combo'){
                                                    echo '  <li><a href="/danh-muc/'.$value->slug.'.html">'.$value->name.'</a></li>';
                                                }
                                            }
                                        }
                                        ?>
                                </ul>
                            </div>
                            
                            <div class="category-product-item">
                                <ul>
                                    <div class="category-product-menu-title">
                                        <p>Combo quà tặng</p>
                                    </div>
                                    <?php 
                                        if(!empty($category_all)){
                                            foreach ($category_all as $key => $value) {
                                                if(@$value->description=='combo'){
                                                    echo '  <li><a href="/danh-muc/'.$value->slug.'.html">'.$value->name.'</a></li>';
                                                }
                                            }
                                        }
                                        ?>
                                </ul>
                            </div> 

                            <div class="banner-category">
                                <div class="banner-category-image">
                                    <img src="<?php echo @$setting['baner_product'] ?>" alt="">
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-lg-9 col-12">
                        <div class="row">
                            <!-- seclect -->
                            <!-- <form onsubmit="" action="/allProduct" method="get" id="myForm" class="form-custom-1 py-3">
                                <div class="product-select col-12">
                                    <div class="product-select-box">
                                        <div class="product-select-item product-select-left">
                                            <div class="heading-check">
                                                <span>Khuyễn mãi</span>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox"  onclick="document.getElementById('myForm').submit();"  name="sela" id="inlineCheckbox1" value="sela">
                                            </div>
                                        </div>
            
                                        <div class="product-select-item product-select-right">
                                            <div class="heading-check">
                                                <span>Sắp xếp</span>
                                            </div>
                                            <select class="form-select form-select-sm" id="order"   name="order" aria-label=".form-select-sm example">
                                                <option selected>Open this select menu</option>
                                                <option value="1">Sản phẩm bán chạy nhất</option>
                                                <option value="2">Giá từ cao đến thấp</option>
                                                <option value="3">Giá từ thấp đến cao</option>
                                                <option value="4">Sản phẩm mới nhất</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </form> -->

                            <!-- sản phẩm -->
                            <?php  if(!empty($list_product)){
                                foreach ($list_product as $product) {
                                    $link = '/san-pham/'.$product->slug.'.html';
                                     $giam = 0;
                                    if(!empty($product->price_old) && !empty($product->price)){
                                        $giam = 100 - 100*$product->price/$product->price_old;
                                    }

                                    $ban = 0;
                                    if(!empty($product->quantity) && !empty($product->sold)){
                                        if($product->quantity>$product->sold){
                                            $ban = 100*$product->sold/$product->quantity;
                                        }
                                    }
                                 ?>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-6 product-item">
                                <div class="product-item-inner">
                                    
                                    <?php if(!empty($product->flash_sale)){
                                    if($giam>0 ){ ?>
                                        <div class="ribbon ribbon-top-right"><span><?php echo number_format($giam) ?>%</span></div>
                                    <?php }} ?>
                                    <div class="product-img">
                                        <a href="<?php echo $link ?>"><img src="<?php echo $product->image ?>" alt=""></a>
                                    </div>
        
                                    <div class="product-info">
                                        <div class="product-name">
                                            <a href="<?php echo $link ?>"><?php echo $product->title ?></a>
                                        </div>
        
                                        <div class="product-price">
                                            <p><?php echo number_format($product->price) ?>đ</p>
                                        </div>
        
                                        <div class="product-discount">
                                           <?php if(!empty($product->price_old)){ ?>
                                            <del><?php  echo number_format($product->price_old); ?>đ</del><?php if(empty($product->flash_sale)){
                                    if($giam>0 ){ ?> <span> (<?php echo number_format($giam) ?>%)</span>   <?php }} ?>
                                            <?php }else{ echo '&nbsp;';} ?>
                                        </div>
                                    </div>
        
                                     <?php if (!empty($product->flash_sale)){ ?>
                                    <div class="progress-box">
                                        <div class="product-progress">
                                            <div class="text-progress">Sản phẩm <?php echo $product->sold ?> Đã bán</div>
                                            <div class="sale-progress-val" style="width: <?php echo $ban; ?>%"></div>
                                        </div>
                                    </div>
                                     <?php }else{ echo '<div class="mb-5"></div>'; } ?>
        
                                    <div class="product-rate">
                                        <div class="rate-best-item rate-star">
                                            <img src="<?php echo $urlThemeActive ?>asset/image/star.png" alt="">
                                             <?php if(!empty($product->point) && !empty($product->evaluatecount)){ ?>
                                             <p><?php echo number_format(@$product->point,1); ?> <span>(<?php echo @$product->evaluatecount ?>)</span></p>
                                         <?php }else{ echo '<p><span>(0)</span></p>'; } ?>
                                        </div>
        
                                        <div class="rate-best-item rate-sold">
                                            <p><?php echo $product->sold ?>  Đã bán</p>
                                            <img src="<?php echo $urlThemeActive ?>asset/image/heart.png" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php }} ?>
                             <!-- <div class="col-12 col-md-12 col-lg-12">
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
                            </div> -->
                        </div>  
                    </div>
                </div>
            </div>
        </section>
    </main>
<!--  <script type="text/javascript">
     const dropdown = document.getElementById("order");

dropdown.addEventListener("change", function() {
  
  document.getElementById("myForm").submit();
});
 </script> -->

  <script>
function actionSelect(select)
{
    var action= select.value;
    var link= $(select).find('option:selected').attr('data-link');
    window.location= link;
   
    
}

function actioncheckbox(select)
{
    if(select!=1){
        window.location= '/search-product?sela=sela';
    }else{
        window.location= '/search-product';
    }
    
}

    </script>


<?php
getFooter();?>