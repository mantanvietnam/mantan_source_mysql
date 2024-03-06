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
                            <i class="fa-regular fa-clock"></i>&nbsp Đăng lúc: <span><?php echo date('d/m/Y',$post->time); ?></span>
                        </div>

                        <div class="post-image">
                            <img src=" <?php echo $post->image; ?>" alt="">
                        </div>

                        <div class="post-content">
                            <?php echo $post->content; ?>
                        </div>
                    </div>
                    <!-- sidebar -->
                    <div class="col-lg-4 col-md-12">
                        <div class="banner-sidebar">
                            <img src="<?php echo @$setting['image_post']; ?>" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="section-news" class="section-padding">
            <div class="container">
                <div class="section-title text-center" data-aos="flip-up" data-aos-duration="4000">
                    <h2 class="text-center">Bài viết <span>liên quan</span></h2>
                    <div class="border-heading"></div>
                </div>

                <div class="news-list">
                     <?php if(!empty($otherPosts)){
                        foreach($otherPosts as $item){
                            echo '<div class="news-item">
                        <div class="new-item-inner">
                            <div class="news-image">
                                <a href="/'.$item->slug.'.html"><img src="'.$item->image.'" alt=""></a>
                            </div>

                            <div class="news-detail">
                                <div class="news-title">
                                    <a href="/'.$item->slug.'.html">'.$item->title.'</a>
                                </div>
    
                                <div class="news-date">
                                    <span>'.date('d/m/Y',$item->time_create).'</span>
                                </div>
    
                                <div class="news-description">'.$item->description.'</div>
    
                                <div class="news-link">
                                    <a href="/'.$item->slug.'.html">Xem chi tiết</a>
                                </div>
                            </div>
                        </div>
                    </div>';
                        }
                   } ?>
                </div>
            </div>
        </section>
    </main>



<?php
getFooter();
?>
  