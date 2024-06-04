<?php getHeader(); ?>
<main>
        <section id="section-banner-top">
            <div class="container">
                <div class="banner-contain">
                    <div class="desktop-banner">
                        <img src="<?php echo @$urlThemeActive; ?>/asset/image/teamwork.png" alt="">
                    </div>
                    <div class="banner-contain-title">
                        <p>Tin Tức</p>
                        <h3>Những <span>tin tức</span> chúng tôi <br> cung cấp cho khách hàng</h3>
                    </div>


                </div>
            </div>
        </section>

        <section id="section-all-posts">
            <div class="container">
                <div class="list-post">
                    <div class="row">
                        <?php 
                            if(!empty($listPosts)){
                                foreach ($listPosts as $key => $value) {
                                    $link = '/'.$value->slug.'.html';

                                    echo '<div class="item-post col-lg-4 col-md-6 col-12">
                                            <div class="post-content">
                                                <div class="post-img">
                                                    <a href="'.$link.'" tabindex="0"><img src="'.$value->image.'" alt=""></a>
                                                </div>
                                                <div class="post-detail">
                                                    <div class="post-timepost">
                                                        <p>
                                                            <i class="fa-regular fa-calendar-days aria-hidden="true"></i> <p class="date">'.date('d/m/Y', $value->time).'</p>
                                                        </p>
                                                    </div>

                                                    <div class="post-title">
                                                        <a href="'.$link.'">'.$value->title.'</a>
                                                    </div>

                                                    <div class="post-text">
                                                        <p>'.$value->description.'</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    ';
                                }
                            }
                        ?>
                    </div>
                </div>
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
                                                <a class="page-link" href="'.$urlPage.'1"><i class="fa-solid fa-chevron-left"></i></a>
                                            </li>';
                                            
                                        for ($i = $startPage; $i <= $endPage; $i++) {
                                            $active= ($page==$i)?'active':'';

                                            echo '<li class="page-item '.$active.'">
                                                    <a class="page-link" href="'.$urlPage.$i.'">'.$i.'</a>
                                                </li>';
                                            }

                                        echo '<li class="page-item last">
                                                <a class="page-link" href="'.$urlPage.$totalPage.'"><i class="fa-solid fa-chevron-right"></i></a>
                                            </li>';
                                    }
                                ?>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </section>

    </main>
<?php getFooter(); ?>