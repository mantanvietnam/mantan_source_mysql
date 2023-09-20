<?php 
    global $settingThemes;
?>

<?php getHeader();?>

    <main>
        <section id="section-news-content">
            <div class="container">
                <div class="col-lg-8 col-md-8 col-sm-8 col-12 news-content-inner">
                    <div class="news-title">
                        <h1><?php echo $post->title;?></h1>
                    </div>
                    <div class="news-date">
                        <p><?php echo date('d/m/Y', $post->time);?></p>
                    </div>
                    <div class="news-detail">
                        <?php echo $post->content;?>
                    </div>
                    <div class="news-share">
                        <p>Chia sẻ</p>
                        <div class="social-group">
                            <a href=""><i class="fa-brands fa-square-facebook"></i></a>
                            <a href=""><i class="fa-brands fa-twitter"></i></a>
                        </div>
                    </div>
    
                </div>
            </div>
        </section>

        <section id="section-news-other">
            <div class="container">
                <div class="news-other-title">
                    <h2>Bài viết liên quan</h2>
                </div>

                <div class="list-library">
                    <div class="grid grid-col-3 gap-32">
                        <?php 
                        if(!empty($otherPosts)){
                            foreach ($otherPosts as $key => $value) {
                                $link = '/'.$value->slug.'.html';

                                echo '  <div class="library-item">
                                            <a href="" class="relative image-list-library ds-block">
                                                <div class="cursor-pointer setting-img-library overflow-hidden">
                                                    <img src="'.$value->image.'" alt="">
                                                </div>
                                            </a>
                                            <div class="blog-news mg-top-20 hover-left">
                                                <span class="time-news-main">'.date('d/m/Y', $value->time).'</span>
                                            </div>
                                            <div class="text-new-main mg-top-8">
                                                <a href="" class="mg-bottom-8 ds-block title-news-main">
                                                    <span class="duration-700 ease-linear bg-no-repeat hover-underline">'.$value->title.'</span>
                                                </a>
                                                <p class="description-news-main">'.$value->description.'</p>
                                            </div>
                                        </div>';
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </section>
    </main>

<?php getFooter();?>