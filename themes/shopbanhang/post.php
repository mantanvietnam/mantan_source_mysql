<?php
getHeader();
global $urlThemeActive;
?>
 <main>
        <section id="section-breadcrumb">
            <div class="breadcrumb-center">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item"><a href="#">Library</a></li>
                  <li class="breadcrumb-item active">Data</li>
                </ul>
            </div>
        </section>

        <section id="section-blog-detail">
            <div class="container">
                <div class="title-blog-detail">
                    <h1><?php echo $post->title; ?></h1>
                </div>
    
                <div class="blog-detail-meta">
                    <div class="blog-detail-date">
                        <p><?php echo date('H:i d/m/Y',$post->time); ?></p>
                    </div>
    
                    <div class="blog-detail-time">
                        <p><?php echo @$item->author ?></p>
                    </div>
                </div>

                <div class="blog-detail-content"><?php echo $post->content; ?></div>
            </div>
        </section>

        <section id="section-blog-like">
            <div class="blog-last-inner">
                <div class="container">
                    <div class="row">
                        <div class="title-blog-like">
                            <p>Có thể bạn sẽ thích</p>
                        </div>
                         <?php
                         	if(!empty($otherPosts)){
                                foreach ($otherPosts as $item) {
                                    ?>
                        <div class="blog-last-item col-lg-4 col-md-4 col-sm-4 col-12">
                            <div class="blog-last-title">
                                <a href="/<?php echo @$item->slug ?>.html"><?php echo @$item->title ?></a>
                            </div>

                            <div class="blog-last-meta">
                                <p class="blog-last-date"><?php echo date('H:i d/m/Y',$item->time); ?></p>
                                <p class="blog-last-category"><?php echo @$item->author ?></p>
                            </div>

                            <div class="blog-last-image">
                                <a href="/<?php echo @$item->slug ?>.html"><a href=""><img src="<?php echo @$item->image ?>" alt=""></a></a>
                            </div>
                        </div>
                    <?php } } ?>
                    </div>
                </div>
            </div>
        </section>
    </main>
<?php
getFooter();?>