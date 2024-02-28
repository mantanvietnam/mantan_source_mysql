<?php
getHeader();
global $urlThemeActive;
$setting = setting();
?>

    <main>
        <section id="section-blog" class="section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-12">
                         <div class="post-title">
                            <h1><?php echo $post->title; ?></h1>
                        </div>

                        <div class="post-date">
                            <i class="fa-regular fa-clock"></i>&nbsp Đăng lúc: <span><?php echo date('H:i d/m/Y',$post->time); ?></span>
                        </div>

                        <div class="post-image">
                            <img src="<?php echo $post->image; ?>" alt="">
                        </div>

                        <div class="post-content">
                            <?php echo $post->content; ?>
                        </div>
                    </div>
                    <!-- sidebar -->
                    <div class="col-lg-4 col-md-12">
                        <div class="banner-sidebar">
                            <img src="<?php echo @$setting['image_Port'];?>" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="section-blog" class="section-padding">
            <div class="container">
                <div class="section-title text-center" data-aos="flip-up" data-aos-duration="4000">
                    <h2 class="text-center">Bài viết <span>liên quan</span></h2>
                    <div class="border-heading"></div>
                </div>

                <div class="news-list">
                    
                    <?php
                            if(!empty($otherPosts)){
                                foreach ($otherPosts as $item) {
                                    
                            echo '<div class="blog-item">
                                    <div class="blog-img">
                                        <a href="/'.@$item->slug.'.html"><img src="'.@$item->image.'" alt=""></a>
                                    </div>

                                    <div class="blog-detail">
                                        <div class="blog-meta">
                                            <i class="fa-regular fa-clock"></i> <span>'.date('H:i d/m/Y',$item->time).'</span>
                                        </div>

                                        <div class="blog-title">
                                            <a href="/'.@$item->slug.'.html">
                                                <h4>'.@$item->title.'</h4>
                                            </a>
                                        </div>

                                        <div class="blog-description">
                                            <p>'.@$item->description.'</p>
                                        </div>

                                        <div class="blog-link">
                                            <a href="/'.@$item->slug.'.html">Read More</a>
                                        </div>
                                    </div>
                                </div>';

                        } } ?>

                    
                </div>
            </div>
        </section>
    </main>
<?php
getFooter();?>
 