<?php
getHeader();
global $urlThemeActive;
$setting = setting();
?>


    <main>
        <section id="section-breadcrumb" style="background-image: url(<?php echo @$setting['background_post'] ?>);">
            <div class="container">
                <div class="background-banner">
                    <h1><?php echo @$post->title ?></h1>
                </div>
            
                <div class="background-opacity"></div>
            </div>
        </section>

        <section id="section-post-detail">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 sidebar ">
                        <div class="sidebar-img">
                            <img src="<?php echo @$post->image ?>" alt="">
                        </div>
                    </div>

                    <div class="col-lg-9 post-right"><?php echo @$post->content ?></div>
                </div>
            </div>
        </section>

        <section id="section-news">
            <div class="container">
                <div class="section-title text-center m-auto">
                    <div class="title-big title-other-post">
                        <span>Bài viết khác</span>
                    </div>
                </div>
                <div class="news-list">
                      <?php if(!empty($otherPosts)){
                    foreach($otherPosts as $item){
                        echo '<div class="news-item">
                    <div class="news-img">
                        <a href="/'.@$item->slug.'.html"><img src="'.@$item->image.'" alt=""></a>
                    </div>

                    <div class="news-text">
                        <div class="news-name">
                            <a href="/'.@$item->slug.'.html">'.@$item->title.'</a>
                        </div>

                        <div class="news-link">
                            <a href="/'.@$item->slug.'.html">Xem thêm</a>
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
getFooter();?>
 