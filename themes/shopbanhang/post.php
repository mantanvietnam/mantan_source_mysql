<?php
getHeader();
global $urlThemeActive;
?>
    <main>
        <section id="section-breadcrumb">
            <div class="container">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                  <li class="breadcrumb-item"><a href="#">Bài viết</a></li>
                  <li class="breadcrumb-item active">Chi tiết bài viết</li>
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
                <div class="blog-detail-description">
                    <p><?php echo @$post->description ?></p>
                </div>

                <div class="row">
                    <div class="col-lg-8 col-12 big-blog-detai">
                        <div class="blog-detail-content"><?php echo $post->content; ?></div>
                    </div>

                    <div class="col-lg-4 col-12 menu-blog-detail">
                        <div id="table-of-contents">
                            <h2>Mục lục</h2>
                            <ul id="toc-list"></ul>
                        </div>
                    </div>
                </div>
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
                                <a href="/<?php echo @$item->slug ?>.html"><img src="<?php echo @$item->image ?>" alt=""></a>
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