<?php getHeader();?>
    <article>
        <div class="container setting-news-product">
            <div class="row">
                <div class="col-9">
                    <form class="d-flex form-search search-mobile">
                        <input class="form-control me-2" type="search" placeholder="Tìm kiếm..." aria-label="Search">
                        <button class="btn btn-outline-success" pac type="submit">Search</button>
                    </form>
                    <nav class="breadcrumb-news-detail" style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item color-post"><a href="#">Tin tức</a></li>
                            <li class="breadcrumb-item post-now" aria-current="page"><a href="#"><?php echo $category->name; ?></a></li>
                        </ol>
                    </nav>

                    <div class="gird setting-news-product">
                        <?php
                            if(!empty($listPosts)){
                                foreach($listPosts as $key => $value){
                                    echo'
                                    <div class="list-product-item">
                                        <a href="'.$value->slug.'.html">
                                            <div class="imgage-product-item">
                                                <img src="'.$value->image.'" alt="">
                                            </div>
                                            <div class="intro-product-item">
                                                <h4>'.$value->title.'</h4>

                                                <p class="desciption-intro-product">'.$value->desciption.'</p>
                                                    <p class="btn-news">Chi tiết <span><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                                    </svg>
                                                    </span>
                                                </p>
                                            </div>                                
                                        </a>
                                    </div>';

                               
                                }
                            }
                               
                        ?>
                    </div>
                    <!-- <nav aria-label="Page navigation example">
                        <ul class="pagination justify-center navigation-news-product">
                            <li class="page-item">
                            <a class="page-link page-link-btn" href="#" aria-label="Previous">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                                    </svg>
                                    
                            </a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                            <a class="page-link page-link-btn " href="#" aria-label="Next">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                    </svg>
                                    
                            </a>
                            </li>
                        </ul>
                    </nav> -->

                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-center navigation-news-product">
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
                                
                                echo '<li class="page-item">
                                            <a class="page-link page-link-btn arrow-page" href="'.$urlPage.'1">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                                                </svg>
                                            </a>
                                        </li>';
                                
                                for ($i = $startPage; $i <= $endPage; $i++) {
                                    $active= ($page==$i)?'active':'';

                                    echo '<li class="page-item '.$active.'">
                                            <a class="page-link" href="'.$urlPage.$i.'">'.$i.'</a>
                                            </li>';
                                }

                                echo '<li class="page-item">
                                            <a class="page-link page-link-btn arrow-page" href="'.$urlPage.$totalPage.'"> 
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                                </svg>
                                            </a>
                                        </li>';
                            }
                            ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </article>
<?php getFooter();?>