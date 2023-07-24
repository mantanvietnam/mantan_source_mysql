<div class="col-lg-3 col-md-12 col-12 news-right"> 
    <div class="box-post-info">
        <div class="accordion">
            <!-- Bài viết mới -->
            <div class="accordion-item accordion-post-new">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapsePostNew" aria-expanded="true" aria-controls="panelsStayOpen-collapsePostNew">
                        Sản phẩm mới nhất
                    </button>
                </h2>
                <div id="panelsStayOpen-collapsePostNew" class="accordion-collapse collapse show">
                    <div class="accordion-body">
                        <?php 
                        if(!empty($new_product)){
                            foreach ($new_product as $key => $value) {
                                $link = '/product/'.$value->slug.'.html';

                                echo '<div class="post-new">
                                        <div class="post-new-item">
                                            <div class="post-new-img">
                                                <img src="'.$value->image.'" alt="">
                                            </div>
                                            <div class="post-new-detail">
                                                <h3 class="post-new-title">
                                                    <a href="'.$link.'">'.$value->title.'</a>
                                                </h3>
                                                <div class="post-new-meta">
                                                    <span class="post-new-cate">'.number_format($value->price).'đ</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>';
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>

            <!-- Danh mục bài viết -->
            <div class="accordion-item accordion-post-cate">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapsePostCate" aria-expanded="true" aria-controls="panelsStayOpen-collapsePostCate">
                        Danh mục tin tức
                    </button>
                </h2>
                <div id="panelsStayOpen-collapsePostCate" class="accordion-collapse collapse show">
                    <div class="accordion-body">
                        <!-- Danh mục menu -->
                        <div class="menu-cat">
                            <ul class="menu-cat-list">
                                <?php 
                                if(!empty($category_post)){
                                    foreach ($category_post as $key => $value) {
                                        echo '<li class="menu-cat-lv0">
                                                <a href="/'.$value->slug.'.html">'.$value->name.'</a>
                                            </li>';
                                    }
                                }
                                ?>
                            </ul>
                        </div>

                        <!--  -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>