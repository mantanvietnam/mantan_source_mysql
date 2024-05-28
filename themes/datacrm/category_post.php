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
                        <div class="item-post col-lg-4 col-md-6 col-sm-12">
                            <div class="post-content">
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
                            </div>
                        </div>
                    </div>

                </div>
                <div class="post-pagenation">
                    <div class="pagenation-arrow pagenation-prev">
                        <button><i class="fa-solid fa-chevron-left"></i></button>
                    </div>

                    <div class="page-number">
                        <button>1</button>
                        <button>2</button>
                        <button class="no-event">...</button>
                        <button>5</button>
                        <button>6</button>
                    </div>

                    <div class="pagenation-arrow pagenation-next">
                        <button><i class="fa-solid fa-chevron-right"></i></button>
                    </div>
                </div>
            </div>

        </section>

    </main>
<?php getFooter(); ?>