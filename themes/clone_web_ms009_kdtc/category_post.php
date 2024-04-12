<?php getHeader();?>
    <main>
        <section id="blog">
            <div id="section-news">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-12 news-left">
                            <h1><?php echo $category->name;?></h1>
                            <div class="row post-list">
                                <?php 
                                if(!empty($listPosts)){
                                    foreach ($listPosts as $key => $value) {
                                        $link = '/'.$value->slug.'.html';

                                        echo '<div class="post-item col-lg-4 col-md-6 col-12">
                                                <div class="post-box">
                                                    <div class="post-box-img">
                                                        <a href="'.$link.'"><img src="'.$value->image.'" alt=""></a>
                                                    </div>

                                                    <div class="post-box-detail">
                                                        <h3 class="post-title">
                                                            <a href="'.$link.'">'.$value->title.'</a>
                                                        </h3>
                                                        <div class="post-entry">
                                                            <p>'.$value->description.'</p>
                                                        </div>
                                                        <div class="post-meta">
                                                            <span class="post-author">'.date('d/m/Y', $value->time).'</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>';
                                    }
                                }
                                ?>

                                <!-- Phân trang -->
                                <div class="col-12 col-md-12 col-lg-12">
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
<?php getFooter();?>