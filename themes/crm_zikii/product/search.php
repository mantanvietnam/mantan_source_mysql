<?php
getHeader();

global $urlThemeActive;
global $settingThemes;
?>

<style>
    #section-cateogry-product > div > div > div.col-lg-3.col-12 > div > div:nth-child(1) > ul > li:nth-child(2) > a{
        color: #000;
        font-weight: bold;
    }
</style>


 <main>
        <section id="section-page-heading">
            <div class="container">
                <div class="breadcrumb justify-content-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                          <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                          <li class="breadcrumb-item active" aria-current="page">Tìm kiếm</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </section>

        <section id="section-category-product-page" class="">
            <div class="container">
                <div class="row">
                    <!-- sidebar -->
                    <div class="col-lg-3 sidebar">
                        <div class="category-product-sidebar">
                            <div class="sidebar-heading">
                                <div class="sidebar-title">
                                    <span>Chuyên mục sản phẩm</span>
                                </div>
                            </div>

                            <div class="sidebar-listcate">
                                <ul>
                                    <?php $category = getCategorieProduct();
                                        if(!empty($category)){
                                            foreach($category as $key => $item){
                                                echo '<li><a href="/category/'.$item->slug.'.html">'.$item->name.'</a></li>';
                                            }
                                        }
                                     ?>
                                </ul>
                            </div>
                        </div>

                        <div class="background-sidebar">
                            <img src="<?php echo $settingThemes['image_qc']; ?>" alt="">
                        </div>
                    </div>

                    <div class="col-lg-9 col-md-12">
                        <div class="category-product-filter">
                            <div class="form">
                                <form onsubmit="" action="/search-product" method="get" id="myForm" class="form-custom-1 py-3">
                                <div class="category-product-filter-inner">
                                    <div class="input-search">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                         <!-- <img src="<?php echo $urlThemeActive ?>asset/image/iconsearch.png" alt=""> -->
                                        <input placeholder="Tìm kiếm theo sản phẩm" type="text" class="form-control" id="" name="key" aria-describedby="">                               
                                    </div>

                                    <div class="sort-product">
                                        <p>Sắp xếp</p>
                                        <!-- <select class="form-select" aria-label="Default select example">
                                            <option selected>Thứ tự mặc định</option>
                                            <option value="1">Thứ tự theo mức độ phổ biến</option>
                                            <option value="2">Mới nhất</option>
                                            <option value="3">Thứ tự theo giá: thấp đến cao</option>
                                            <option value="4">Thứ tự theo giá: cao xuống thấp</option>
                                        </select> -->
                                        <select class="form-select form-select-sm" id="order"  onchange="actionSelect(this);"  name="order">
                                            <option value="">Sắp xếp theo</option>
                                            <option <?php  if(!empty($_GET['order']) && @$_GET['order']==1){ echo 'selected'; } ?> data-link="/search-product?order=1" value="1">Sản phẩm bán chạy nhất</option>
                                            <option <?php  if(!empty($_GET['order']) && @$_GET['order']==2){ echo 'selected'; } ?> data-link="/search-product?order=2" value="2">Giá từ cao đến thấp</option>
                                            <option <?php  if(!empty($_GET['order']) && @$_GET['order']==3){ echo 'selected'; } ?> data-link="/search-product?order=3" value="3">Giá từ thấp đến cao</option>
                                            <option <?php  if(!empty($_GET['order']) && @$_GET['order']==4){ echo 'selected'; } ?> data-link="/search-product?order=4" value="4">Sản phẩm mới nhất</option>
                                        </select>
                                    </div>
                                 </div>
                             </form>
                            </div>
                        </div>

                        <div class="list-product-page">
                            <div class="row" data-aos="zoom-out-up">
                                <?php  if(!empty($list_product)){
                                foreach ($list_product as $product) {
                                    $link = '/san-pham/'.$product->slug.'.html';
                                    echo '<div class="col-lg-4 col-md-6 col-12 product-hot-item">
                                        <div class="product-hot-item-inner">
                                            <div class="product-hot-image">
                                                <a href="'.$link.'">
                                                    <img src="'.$product->image.'" alt="">
                                                </a>
                                            </div>
                
                                            <div class="product-hot-detail">
                                                <div class="product-hot-name">
                                                    <a href="'.$link.'">'.$product->title.'</a>
                                                </div>
                
                                                <div class="product-hot-price">
                                                    <span>'.number_format($product->price).' đ</span>
                                                </div>
                
                                                <div class="product-hot-addcart">
                                                    <a href="'.$link.'">Thêm vào giỏ hàng</a>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>';
                                }
                            }?>
                                
                            </div>
                            <section id="pagination-page">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">

                            <?php
                            if (@$totalPage > 0) {
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
                        <a class="page-link" href="' . $urlPage . '1"><i class="fa-solid fa-chevron-left"></i></a>
                      </li>';

                                for ($i = $startPage; $i <= $endPage; $i++) {
                                    $active = ($page == $i) ? 'active' : '';

                                    echo '<li class="page-item ' . $active . '">
                            <a class="page-link" href="' . $urlPage . $i . '">' . $i . '</a>
                          </li>';
                                }

                                echo '<li class="page-item last">
                        <a class="page-link" href="' . $urlPage . $totalPage . '"
                          ><i class="fa-solid fa-chevron-right"></i
                        ></a>
                      </li>';
                            }
                            ?>
                        </ul>
                    </nav>
                </section>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
  <script>
function actionSelect(select)
{
    var action= select.value;
    var link= $(select).find('option:selected').attr('data-link');
    window.location= link;
   
    
}

function actioncheckbox(select)
{
    var action= select.value;
    var link= $(select).find('option:selected').attr('data-link');
    window.location= '/search-product?sela=sela';
   
    
}

    </script>
<?php
getFooter();?>