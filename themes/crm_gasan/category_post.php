<?php
getHeader();
global $urlThemeActive;

?>

    <main>
        <section id="section-page-heading">
            <div class="container">
                <div class="background-title">
                    <h1><?php echo $category['name'];?></h1>
                </div>
                
                <div class="breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                          <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                          <li class="breadcrumb-item active" aria-current="page"><?php echo $category['name'];?></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </section>

        <section id="section-page-blog">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="page-blog-list">
                            <?php
                    if (!empty($listPosts)) {
                        foreach ($listPosts as $item) {
                           echo '<div class="page-blog-item">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-12 page-blog-image">
                                        <div class="page-blog-image-inner">
                                            <a href=""><img src="'.$item->image.'" alt=""></a>
                                        </div>
                                    </div>

                                    <div class="col-lg-8 col-md-8 col-12">
                                        <div class="page-blog-detail">
                                            <div class="page-blog-title">
                                                <h3><a href="/'.@$item->slug.'.html">'.@$item->title.' </a></h3>
                                            </div>
                                            <div class="page-blog-devide"></div>
                                            <div class="page-blog-description">'.@$item->description.'</div>
                                            <div class="page-blog-button">
                                                <a href="/'.@$item->slug.'.html">Xem thêm</a>
                                            </div>
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

                     <div class="col-lg-3 sidebar">
                        <div class="page-blog-sidebar">
                            <div class="sidebar-heading">
                                <div class="sidebar-title">
                                    <span>Bài viết nổi bật</span>
                                </div>
                            </div>

                            <div class="sidebar-listpost">
                                
                                <?php  if(!empty(getPostPin())){
                                    foreach(getPostPin() as $key => $item){
                                        echo '<div class="sidebar-post-item">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-3 col-sm-5 col-post-image">
                                            <div class="sidebar-post-image">
                                                <img src="'.@$item->image.'" alt="">
                                            </div>
                                        </div>

                                        <div class="col-lg-7 col-md-9 col-sm-7 col-post-title">
                                            <div class="sidebar-post-title">
                                                <a href="/'.@$item->slug.'.html">'.@$item->title.'</a>  
                                            </div>
                                        </div>
                                    </div>
                                </div>';
                                    }
                                } ?>                         
                            </div>
                        </div>

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
                    </div>
                </div>
            </div>
        </section>
    </main>

<?php
getFooter();?>